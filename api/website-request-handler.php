<?php
// Website Request Form Handler
// Handles website development requests

// Start session for CSRF protection
session_start();

// Configuration
$config = [
    'to_email' => 'sondra@sondrahathaway.com', // Replace with your actual email
    'from_email' => 'sondra@sondrahathaway.com', // Replace with your domain
    'subject_prefix' => 'Website Development Request: ',
    'max_message_length' => 2000,
    'required_fields' => ['full_name', 'email', 'project_name', 'project_description', 'desired_timeline'],
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
    
    // Validate message length
    if (!empty($_POST['project_description']) && strlen($_POST['project_description']) > $config['max_message_length']) {
        $response['errors']['project_description'] = 'Project description is too long. Maximum ' . $config['max_message_length'] . ' characters allowed.';
    }
    
    // If no errors, process the form
    if (empty($response['errors'])) {
        // Sanitize all inputs
        $full_name = sanitize_input($_POST['full_name']);
        $email = sanitize_input($_POST['email']);
        $phone = sanitize_input($_POST['phone'] ?? '');
        $company = sanitize_input($_POST['company'] ?? '');
        $project_name = sanitize_input($_POST['project_name']);
        $project_description = sanitize_input($_POST['project_description']);
        $desired_timeline = sanitize_input($_POST['desired_timeline']);
        $budget_range = sanitize_input($_POST['budget_range'] ?? '');
        $website_type = sanitize_input($_POST['website_type'] ?? '');
        $features_needed = sanitize_input($_POST['features_needed'] ?? '');
        $target_audience = sanitize_input($_POST['target_audience'] ?? '');
        $additional_notes = sanitize_input($_POST['additional_notes'] ?? '');
        
        // Prepare email content
        $email_subject = $config['subject_prefix'] . $project_name;
        $email_body = "
New Website Development Request from TransformLocalGov website:

CONTACT INFORMATION:
Name: {$full_name}
Email: {$email}
Phone: {$phone}
Company/Organization: {$company}

PROJECT DETAILS:
Project Name: {$project_name}
Project Description: {$project_description}
Desired Timeline: {$desired_timeline}
Budget Range: {$budget_range}

WEBSITE SPECIFICATIONS:
Website Type: {$website_type}
Features Needed: {$features_needed}
Target Audience: {$target_audience}

ADDITIONAL INFORMATION:
Additional Notes: {$additional_notes}

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
            $response['message'] = 'Thank you for your website development request! We will review your project details and get back to you within 24 hours with a detailed quote.';
            
            // Store in database
            try {
                $pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $pdo->prepare("INSERT INTO website_request_submissions (full_name, email, phone, company, project_name, project_description, desired_timeline, budget_range, website_type, features_needed, target_audience, additional_notes, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$full_name, $email, $phone, $company, $project_name, $project_description, $desired_timeline, $budget_range, $website_type, $features_needed, $target_audience, $additional_notes, $client_ip, $_SERVER['HTTP_USER_AGENT'] ?? '']);
                
            } catch (PDOException $e) {
                // Log database error but don't fail the form submission
                error_log("Database error in website request handler: " . $e->getMessage());
            }
            
            // Log successful submission (optional)
            $log_entry = date('Y-m-d H:i:s') . " - Website request from {$full_name} ({$email}) - Project: {$project_name}\n";
            file_put_contents('../website_requests_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
            
        } else {
            $response['message'] = 'Sorry, there was an error sending your request. Please try again later or contact us directly.';
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
