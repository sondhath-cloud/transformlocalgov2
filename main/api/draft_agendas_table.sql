-- Draft Agendas Table
CREATE TABLE IF NOT EXISTS draft_agendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_name VARCHAR(255) NOT NULL,
    contact_email VARCHAR(255) NOT NULL,
    contact_phone VARCHAR(50),
    organization VARCHAR(255),
    additional_notes TEXT,
    selected_services JSON NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'contacted', 'consultation_scheduled', 'closed') DEFAULT 'new',
    admin_notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (contact_email),
    INDEX idx_submission_date (submission_date),
    INDEX idx_status (status)
);

-- Sample data (optional - remove in production)
-- INSERT INTO draft_agendas (contact_name, contact_email, contact_phone, organization, selected_services, total_amount) 
-- VALUES ('John Doe', 'john@example.com', '555-1234', 'City of Example', '["Strategic Planning", "Team Building"]', 5000.00);
