<?php
/**
 * Visitor Tracking Script
 * 
 * This script tracks visitors and stores data in the database
 * Include this file in pages where you want to track visitors
 */

// Database configuration
require_once 'config.php';

// Check if config.php exists, if not use placeholder values
if (!defined('DB_HOST')) {
    // You need to update these with your actual database credentials
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'your_database_name');
    define('DB_USER', 'your_database_user');
    define('DB_PASS', 'your_database_password');
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate or retrieve session ID
if (!isset($_SESSION['visitor_session_id'])) {
    $_SESSION['visitor_session_id'] = uniqid('vis_', true);
}

$session_id = $_SESSION['visitor_session_id'];

// Get visitor information
$ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$referrer = $_SERVER['HTTP_REFERER'] ?? '';
$page_url = $_SERVER['REQUEST_URI'] ?? '';
$visit_date = date('Y-m-d');
$visit_time = date('Y-m-d H:i:s');

try {
    // Connect to database
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    // Check if this is a unique visitor for this session today
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as visit_count 
        FROM visitors 
        WHERE session_id = ? AND visit_date = ?
    ");
    $stmt->execute([$session_id, $visit_date]);
    $result = $stmt->fetch();
    $is_unique = ($result['visit_count'] == 0) ? 1 : 0;
    
    // Insert visitor record
    $stmt = $pdo->prepare("
        INSERT INTO visitors 
        (session_id, ip_address, visit_date, visit_time, user_agent, referrer, page_url, is_unique_visitor)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $session_id,
        $ip_address,
        $visit_date,
        $visit_time,
        $user_agent,
        $referrer,
        $page_url,
        $is_unique
    ]);
    
} catch (PDOException $e) {
    // Silently fail - don't interrupt user experience
    // Log error if needed
    error_log("Visitor tracking error: " . $e->getMessage());
}

// This file should be included, not executed directly
// Return true to indicate successful tracking
return true;
?>

