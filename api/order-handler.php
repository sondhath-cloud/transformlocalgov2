<?php
// Order Form Handler
// Handles service order consultation requests

// Start session for CSRF protection
session_start();

// Configuration
$config = [
    'to_email' => 'sondra@sondrahathaway.com',
    'from_email' => 'sondra@sondrahathaway.com',
    'subject_prefix' => 'Service Order Consultation Request: ',
    'db_host' => 'localhost',
    'db_name' => 'transformlocalgov',
    'db_user' => 'root',
    'db_pass' => ''
];

// Security functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    
    // Get form data
    $action = $_POST['action'] ?? '';
    $services = $_POST['services'] ?? '[]';
    $total_price = $_POST['total_price'] ?? 0;
    
    // Validate required fields
    if (empty($services) || $services === '[]') {
        $response['message'] = 'Please select at least one service.';
        echo json_encode($response);
        exit;
    }
    
    if ($action !== 'consultation') {
        $response['message'] = 'Invalid action.';
        echo json_encode($response);
        exit;
    }
    
    // Parse services JSON
    $services_array = json_decode($services, true);
    if (!$services_array || empty($services_array)) {
        $response['message'] = 'Invalid service selection.';
        echo json_encode($response);
        exit;
    }
    
    // Prepare email content
    $email_subject = $config['subject_prefix'] . 'Consultation Request';
    
    $services_list = '';
    $total_calculated = 0;
    foreach ($services_array as $service) {
        $services_list .= "- {$service['name']}: $" . number_format($service['price']) . "\n";
        $total_calculated += $service['price'];
    }
    
    $email_body = "
New Service Order Consultation Request from TransformLocalGov website:

SELECTED SERVICES:
{$services_list}

TOTAL ESTIMATED COST: $" . number_format($total_calculated) . "

REQUEST TYPE: Consultation Scheduling

---
Sent from: {$_SERVER['HTTP_HOST']}
IP Address: {$client_ip}
Time: " . date('Y-m-d H:i:s') . "
    ";
    
    // Email headers
    $headers = [
        'From: ' . $config['from_email'],
        'Reply-To: ' . $config['from_email'],
        'X-Mailer: PHP/' . phpversion(),
        'Content-Type: text/plain; charset=UTF-8'
    ];
    
    // Send email
    $mail_sent = mail($config['to_email'], $email_subject, $email_body, implode("\r\n", $headers));
    
    if ($mail_sent) {
        $response['success'] = true;
        $response['message'] = 'Thank you for your consultation request! We will contact you within 24 hours to schedule your selected services.';
        
        // Store in database
        try {
            $pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->prepare("INSERT INTO order_consultations (services_json, total_price, action_type, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$services, $total_calculated, $action, $client_ip, $_SERVER['HTTP_USER_AGENT'] ?? '']);
            
        } catch (PDOException $e) {
            // Log database error but don't fail the form submission
            error_log("Database error in order handler: " . $e->getMessage());
        }
        
        // Log successful submission (optional)
        $log_entry = date('Y-m-d H:i:s') . " - Order consultation request - Services: " . count($services_array) . " - Total: $" . number_format($total_calculated) . "\n";
        file_put_contents('../order_consultations_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
    } else {
        $response['message'] = 'Sorry, there was an error sending your consultation request. Please try again later or contact us directly.';
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
