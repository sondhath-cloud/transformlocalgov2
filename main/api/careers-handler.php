<?php
// Careers Form Handler
// Handles job application submissions

// Start session for CSRF protection
session_start();

// Configuration
$config = [
    'to_email' => 'sondra@sondrahathaway.com', // Replace with your actual email
    'from_email' => 'sondra@sondrahathaway.com', // Replace with your domain
    'subject_prefix' => 'Job Application: ',
    'max_message_length' => 1000,
    'required_fields' => ['first_name', 'last_name', 'email'],
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
    
    // If no errors, process the form
    if (empty($response['errors'])) {
        // Sanitize all inputs
        $first_name = sanitize_input($_POST['first_name']);
        $last_name = sanitize_input($_POST['last_name']);
        $email = sanitize_input($_POST['email']);
        $phone = sanitize_input($_POST['phone'] ?? '');
        $location = sanitize_input($_POST['location'] ?? '');
        $experience_level = sanitize_input($_POST['experience_level'] ?? '');
        $website = sanitize_input($_POST['website'] ?? '');
        $cover_letter = sanitize_input($_POST['cover_letter'] ?? '');
        
        // Prepare email content
        $full_name = $first_name . ' ' . $last_name;
        $email_subject = $config['subject_prefix'] . $full_name;
        $email_body = "
New Job Application from TransformLocalGov website:

APPLICANT INFORMATION:
Name: {$full_name}
Email: {$email}
Jim: {$phone}
Location: {$location}
Experience Level: {$experience_level}
Website/Portfolio: {$website}

COVER LETTER:
{$cover_letter}

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
            $response['message'] = 'Thank you for your job application! We will review your information and get back to you if there are any opportunities that match your qualifications.';
            
            // Store in database
            try {
                $pdo = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']}", $config['db_user'], $config['db_pass']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $pdo->prepare("INSERT INTO careers_submissions (first_name, last_name, email, phone, location, experience_level, website, linkedin, interest_areas, availability, cover_letter, resume_filename, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$first_name, $last_name, $email, $phone, $location, $experience_level, $website, $linkedin, $interest_areas, $availability, $cover_letter, '', $client_ip, $_SERVER['HTTP_USER_AGENT'] ?? '']);
                
            } catch (PDOException $e) {
                // Log database error but don't fail the form submission
                error_log("Database error in careers handler: " . $e->getMessage());
            }
            
            // Log successful submission (optional)
            $log_entry = date('Y-m-d H:i:s') . " - Job application from {$full_name} ({$email})\n";
            file_put_contents('../careers_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
            
        } else {
            $response['message'] = 'Sorry, there was an error sending your application. Please try again later or contact us directly.';
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
