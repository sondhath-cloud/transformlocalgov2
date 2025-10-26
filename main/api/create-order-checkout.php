<?php
// Order Checkout Handler
// Creates Stripe checkout sessions for service orders

// Include Stripe configuration
require_once 'config.php';
require_once '../stripe-php-master/init.php';
require_once 'stripe-price-map.php';

// Set your secret key
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['services']) || !isset($data['total_price'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request data']);
    exit;
}

$services = $data['services'];
$total_price = $data['total_price'];
$customer_email = isset($data['customer_email']) ? $data['customer_email'] : null;

// Validate services
if (empty($services) || $total_price <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No services selected or invalid price']);
    exit;
}

try {
    // Create line items for Stripe
    $line_items = [];
    
    foreach ($services as $service) {
        // Check if we have a pre-created Price ID for this service
        $price_id = isset($service['value']) ? getStripePriceId($service['value']) : null;
        
        if ($price_id) {
            // Use pre-created Price ID (more efficient, better for reporting)
            $line_items[] = [
                'price' => $price_id,
                'quantity' => 1,
            ];
        } else {
            // Fall back to creating price on-the-fly
            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $service['name'],
                        'description' => 'TransformLocalGov Service'
                    ],
                    'unit_amount' => $service['price'] * 100, // Convert to cents
                ],
                'quantity' => 1,
            ];
        }
    }
    
    // Create Stripe checkout session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => 'https://' . $_SERVER['HTTP_HOST'] . '/main/success.html?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'https://' . $_SERVER['HTTP_HOST'] . '/main/order.html',
        'metadata' => [
            'services' => json_encode($services),
            'total_price' => $total_price
        ],
        'customer_email' => $customer_email, // Collected from form if provided
        'billing_address_collection' => 'required',
    ]);
    
    // Store order in database for tracking
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=transformlocalgov", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("INSERT INTO order_purchases (stripe_session_id, services_json, total_price, status, created_at) VALUES (?, ?, ?, 'pending', NOW())");
        $stmt->execute([$session->id, json_encode($services), $total_price]);
        
    } catch (PDOException $e) {
        // Log database error but don't fail the checkout creation
        error_log("Database error in order checkout: " . $e->getMessage());
    }
    
    echo json_encode([
        'success' => true,
        'session_id' => $session->id
    ]);
    
} catch (\Stripe\Exception\CardException $e) {
    // Card was declined
    echo json_encode([
        'success' => false,
        'message' => 'Your card was declined. Please try a different payment method.'
    ]);
} catch (\Stripe\Exception\RateLimitException $e) {
    // Too many requests made to the API too quickly
    echo json_encode([
        'success' => false,
        'message' => 'Too many requests. Please try again later.'
    ]);
} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Invalid parameters were supplied to Stripe's API
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request. Please try again.'
    ]);
} catch (\Stripe\Exception\AuthenticationException $e) {
    // Authentication with Stripe's API failed
    echo json_encode([
        'success' => false,
        'message' => 'Authentication error. Please try again later.'
    ]);
} catch (\Stripe\Exception\ApiConnectionException $e) {
    // Network communication with Stripe failed
    echo json_encode([
        'success' => false,
        'message' => 'Network error. Please check your connection and try again.'
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Generic Stripe API error
    echo json_encode([
        'success' => false,
        'message' => 'Payment processing error. Please try again.'
    ]);
} catch (Exception $e) {
    // Something else happened
    echo json_encode([
        'success' => false,
        'message' => 'An unexpected error occurred. Please try again.'
    ]);
}
?>
