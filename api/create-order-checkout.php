<?php
// Order Checkout Handler
// Creates Stripe checkout sessions for service orders

// Include Stripe configuration
require_once 'config.php';
require_once '../stripe-php-master/init.php';

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
    
    // Create Stripe checkout session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => 'https://' . $_SERVER['HTTP_HOST'] . '/success.html?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'https://' . $_SERVER['HTTP_HOST'] . '/order.html',
        'metadata' => [
            'services' => json_encode($services),
            'total_price' => $total_price
        ],
        'customer_email' => 'customer@example.com', // You might want to collect this
        'billing_address_collection' => 'required',
        'shipping_address_collection' => [
            'allowed_countries' => ['US'],
        ],
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
