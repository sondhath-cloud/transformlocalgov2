<?php
/**
 * Get Visitor Statistics
 * Returns visitor statistics in JSON format
 */

// Database configuration
require_once 'config.php';

// Check if config.php exists, if not use placeholder values
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'your_database_name');
    define('DB_USER', 'your_database_user');
    define('DB_PASS', 'your_database_password');
}

// Set headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

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
    
    // Get the date range from query parameters (default to last 30 days)
    $start_date = $_GET['start_date'] ?? date('Y-m-d', strtotime('-30 days'));
    $end_date = $_GET['end_date'] ?? date('Y-m-d');
    
    // Total visitors by date
    $stmt = $pdo->prepare("
        SELECT 
            visit_date,
            COUNT(*) as total_visits,
            COUNT(DISTINCT session_id) as unique_sessions,
            COUNT(DISTINCT ip_address) as unique_ips
        FROM visitors 
        WHERE visit_date BETWEEN ? AND ?
        GROUP BY visit_date
        ORDER BY visit_date ASC
    ");
    $stmt->execute([$start_date, $end_date]);
    $daily_stats = $stmt->fetchAll();
    
    // Overall statistics
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total_visits,
            COUNT(DISTINCT session_id) as total_unique_sessions,
            COUNT(DISTINCT ip_address) as total_unique_ips,
            COUNT(DISTINCT visit_date) as total_days
        FROM visitors 
        WHERE visit_date BETWEEN ? AND ?
    ");
    $stmt->execute([$start_date, $end_date]);
    $overall_stats = $stmt->fetch();
    
    // Most visited pages
    $stmt = $pdo->prepare("
        SELECT 
            page_url,
            COUNT(*) as visit_count
        FROM visitors 
        WHERE visit_date BETWEEN ? AND ?
        GROUP BY page_url
        ORDER BY visit_count DESC
        LIMIT 10
    ");
    $stmt->execute([$start_date, $end_date]);
    $top_pages = $stmt->fetchAll();
    
    // Return JSON response
    echo json_encode([
        'success' => true,
        'date_range' => [
            'start' => $start_date,
            'end' => $end_date
        ],
        'overall_stats' => $overall_stats,
        'daily_stats' => $daily_stats,
        'top_pages' => $top_pages
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>

