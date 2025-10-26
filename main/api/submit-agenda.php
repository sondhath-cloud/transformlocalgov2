<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Include database configuration
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        throw new Exception('Invalid JSON input');
    }
    
    // Validate required fields
    $required_fields = ['contact_name', 'contact_email', 'selected_services'];
    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            throw new Exception("Missing required field: $field");
        }
    }
    
    // Sanitize input data
    $contact_name = trim($input['contact_name']);
    $contact_email = trim($input['contact_email']);
    $contact_phone = trim($input['contact_phone'] ?? '');
    $organization = trim($input['organization'] ?? '');
    $additional_notes = trim($input['additional_notes'] ?? '');
    $selected_services = $input['selected_services'];
    $total_amount = floatval($input['total_amount'] ?? 0);
    
    // Validate email
    if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email address');
    }
    
    // Prepare services data
    $services_json = json_encode($selected_services);
    
    // Insert into database
    $stmt = $pdo->prepare("
        INSERT INTO draft_agendas (
            contact_name, 
            contact_email, 
            contact_phone, 
            organization, 
            additional_notes, 
            selected_services, 
            total_amount, 
            submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    
    $result = $stmt->execute([
        $contact_name,
        $contact_email,
        $contact_phone,
        $organization,
        $additional_notes,
        $services_json,
        $total_amount
    ]);
    
    if ($result) {
        $agenda_id = $pdo->lastInsertId();
        
        // Send notification email to admin
        $subject = "New Draft Agenda Submission - ID: $agenda_id";
        $message = "
New draft agenda submission received:

Contact Information:
- Name: $contact_name
- Email: $contact_email
- Phone: " . ($contact_phone ?: 'Not provided') . "
- Organization: " . ($organization ?: 'Not provided') . "

Selected Services:
";
        
        foreach ($selected_services as $service) {
            $message .= "- {$service['name']}: $" . number_format($service['price']) . "\n";
        }
        
        $message .= "\nTotal Amount: $" . number_format($total_amount) . "\n\n";
        
        if ($additional_notes) {
            $message .= "Additional Notes:\n$additional_notes\n\n";
        }
        
        $message .= "Submission Date: " . date('Y-m-d H:i:s') . "\n";
        $message .= "Agenda ID: $agenda_id";
        
        $headers = "From: noreply@transformlocalgov.com\r\n";
        $headers .= "Reply-To: $contact_email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Send email notification
        mail('info@transformlocalgov.com', $subject, $message, $headers);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Draft agenda submitted successfully!',
            'agenda_id' => $agenda_id
        ]);
        
    } else {
        throw new Exception('Failed to save draft agenda');
    }
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
}
?>
