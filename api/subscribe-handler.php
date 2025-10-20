<?php
// Subscribe Form Handler
// Handles newsletter subscription requests

// Start session for CSRF protection
session_start();

// Include Stripe configuration
require_once 'config.php';

// Configuration
$config = [
    'to_email' => 'sondra@sondrahathaway.com', // Replace with your actual email
    'from_email' => 'sondra@sondrahathaway.com', // Replace with your domain
    'subject_prefix' => 'New Newsletter Subscription: ',
    'required_fields' => ['name', 'email']
];

// Security functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Rate limiting (simple implementation)
function check_rate_limit($ip) {
    $rate_limit_file = '../rate_limit.json';
    $current_time = time();
    $rate_limit_window = 300; // 5 minutes
    $max_requests = 3; // Max 3 requests per 5 minutes
    
    if (file_exists($rate_limit_file)) {
        $data = json_decode(file_get_contents($rate_limit_file), true);
        
        // Clean old entries
        $data = array_filter($data, function($timestamp) use ($current_time, $rate_limit_window) {
            return ($current_time - $timestamp) < $rate_limit_window;
        });
        
        // Check if IP has exceeded limit
        $ip_requests = array_filter($data, function($timestamp, $ip_addr) use ($ip) {
            return $ip_addr === $ip;
        }, ARRAY_FILTER_USE_BOTH);
        
        if (count($ip_requests) >= $max_requests) {
            return false;
        }
        
        // Add current request
        $data[$ip] = $current_time;
        file_put_contents($rate_limit_file, json_encode($data));
    } else {
        // Create new rate limit file
        $data = [$ip => $current_time];
        file_put_contents($rate_limit_file, json_encode($data));
    }
    
    return true;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => '', 'errors' => []];
    
    // Get client IP
    $client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    // Check rate limiting
    if (!check_rate_limit($client_ip)) {
        $response['message'] = 'Too many requests. Please wait before sending another message.';
        echo json_encode($response);
        exit;
    }
    
    // Validate CSRF token
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($csrf_token)) {
        $response['message'] = 'Security token mismatch. Please refresh the page and try again.';
        echo json_encode($response);
        exit;
    }
    
    // Validate required fields
    foreach ($config['required_fields'] as $field) {
        if (empty($_POST[$field])) {
            $response['errors'][$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }
    
    // Validate email
    if (!empty($_POST['email']) && !validate_email($_POST['email'])) {
        $response['errors']['email'] = 'Please enter a valid email address.';
    }
    
    // If no errors, process the form
    if (empty($response['errors'])) {
        // Sanitize all inputs
        $name = sanitize_input($_POST['name']);
        $email = sanitize_input($_POST['email']);
        $plan_type = sanitize_input($_POST['plan_type'] ?? '');
        
        // Prepare email content
        $email_subject = $config['subject_prefix'] . $name;
        $email_body = "
New Newsletter Subscription from TransformLocalGov website:

SUBSCRIBER INFORMATION:
Name: {$name}
Email: {$email}
Plan Type: {$plan_type}

---
Sent from: {$_SERVER['HTTP_HOST']}
IP Address: {$client_ip}
Time: " . date('Y-m-d H:i:s') . "
        ";
        
        // Email headers
        $headers = [
            'From: ' . $config['from_email'],
            'Reply-To: ' . $email,
            'X-Mailer: PHP/' . phpversion(),
            'Content-Type: text/plain; charset=UTF-8'
        ];
        
        // Send email
        $mail_sent = mail($config['to_email'], $email_subject, $email_body, implode("\r\n", $headers));
        
        if ($mail_sent) {
            $response['success'] = true;
            $response['message'] = 'Thank you for subscribing to our newsletter! You will receive updates about our services and insights.';
            
            // Store in database
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=transformlocalgov", 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $pdo->prepare("INSERT INTO newsletter_subscriptions (name, email, plan_type, ip_address, user_agent) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE plan_type = VALUES(plan_type), subscribed_at = CURRENT_TIMESTAMP");
                $stmt->execute([$name, $email, $plan_type, $client_ip, $_SERVER['HTTP_USER_AGENT'] ?? '']);
                
            } catch (PDOException $e) {
                // Log database error but don't fail the form submission
                error_log("Database error in subscribe handler: " . $e->getMessage());
            }
            
            // Log successful submission (optional)
            $log_entry = date('Y-m-d H:i:s') . " - Newsletter subscription from {$name} ({$email})\n";
            file_put_contents('../subscriptions_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
            
        } else {
            $response['message'] = 'Sorry, there was an error processing your subscription. Please try again later or contact us directly.';
        }
    } else {
        $response['message'] = 'Please correct the errors below and try again.';
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// If not POST request, return CSRF token for form
header('Content-Type: application/json');
echo json_encode(['csrf_token' => generate_csrf_token()]);
?>
