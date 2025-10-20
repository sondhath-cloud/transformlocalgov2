-- TransformLocalGov Website Database Schema
-- Run this SQL script to create the database tables for form submissions

-- Create database (uncomment if needed)
-- CREATE DATABASE transformlocalgov;
-- USE transformlocalgov;

-- Contact form submissions table
CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    project_type VARCHAR(100),
    message TEXT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed BOOLEAN DEFAULT FALSE,
    notes TEXT
);

-- Custom tools form submissions table
CREATE TABLE IF NOT EXISTS custom_tools_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    company VARCHAR(255),
    project_name VARCHAR(255) NOT NULL,
    project_description TEXT NOT NULL,
    desired_timeline VARCHAR(255) NOT NULL,
    existing_website VARCHAR(50),
    existing_url VARCHAR(500),
    desired_url_1 VARCHAR(255),
    desired_url_2 VARCHAR(255),
    alternative_words TEXT,
    additional_notes TEXT,
    promo_code VARCHAR(100),
    promo_code_valid BOOLEAN DEFAULT FALSE,
    ip_address VARCHAR(45),
    user_agent TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed BOOLEAN DEFAULT FALSE,
    notes TEXT
);

-- Website request form submissions table
CREATE TABLE IF NOT EXISTS website_request_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    company VARCHAR(255),
    project_name VARCHAR(255) NOT NULL,
    project_description TEXT NOT NULL,
    desired_timeline VARCHAR(255) NOT NULL,
    budget_range VARCHAR(100),
    website_type VARCHAR(100),
    features_needed TEXT,
    target_audience TEXT,
    additional_notes TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed BOOLEAN DEFAULT FALSE,
    notes TEXT
);

-- Careers form submissions table
CREATE TABLE IF NOT EXISTS careers_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    location VARCHAR(255),
    experience_level VARCHAR(100),
    website VARCHAR(500),
    linkedin VARCHAR(500),
    interest_areas TEXT,
    availability VARCHAR(255),
    cover_letter TEXT,
    resume_filename VARCHAR(255),
    ip_address VARCHAR(45),
    user_agent TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed BOOLEAN DEFAULT FALSE,
    notes TEXT
);

-- Newsletter subscriptions table
CREATE TABLE IF NOT EXISTS newsletter_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    plan_type VARCHAR(100),
    ip_address VARCHAR(45),
    user_agent TEXT,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    active BOOLEAN DEFAULT TRUE,
    unsubscribed_at TIMESTAMP NULL,
    notes TEXT
);

-- Stripe customers table (for subscription management)
CREATE TABLE IF NOT EXISTS stripe_customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stripe_customer_id VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    phone VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Stripe subscriptions table
CREATE TABLE IF NOT EXISTS stripe_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stripe_subscription_id VARCHAR(255) NOT NULL UNIQUE,
    stripe_customer_id VARCHAR(255) NOT NULL,
    plan_type ENUM('monthly', 'yearly') NOT NULL,
    status ENUM('active', 'canceled', 'past_due', 'incomplete', 'trialing') NOT NULL,
    current_period_start TIMESTAMP,
    current_period_end TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (stripe_customer_id) REFERENCES stripe_customers(stripe_customer_id) ON DELETE CASCADE
);

-- Order consultations table
CREATE TABLE IF NOT EXISTS order_consultations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    services_json TEXT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    action_type VARCHAR(50) DEFAULT 'consultation',
    ip_address VARCHAR(45),
    user_agent TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed BOOLEAN DEFAULT FALSE,
    notes TEXT
);

-- Order purchases table
CREATE TABLE IF NOT EXISTS order_purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stripe_session_id VARCHAR(255) NOT NULL UNIQUE,
    services_json TEXT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled', 'failed') DEFAULT 'pending',
    stripe_payment_intent_id VARCHAR(255),
    customer_email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    notes TEXT
);

-- Create indexes for better performance
CREATE INDEX idx_contact_email ON contact_submissions(email);
CREATE INDEX idx_contact_submitted_at ON contact_submissions(submitted_at);
CREATE INDEX idx_custom_tools_email ON custom_tools_submissions(email);
CREATE INDEX idx_custom_tools_submitted_at ON custom_tools_submissions(submitted_at);
CREATE INDEX idx_website_request_email ON website_request_submissions(email);
CREATE INDEX idx_website_request_submitted_at ON website_request_submissions(submitted_at);
CREATE INDEX idx_careers_email ON careers_submissions(email);
CREATE INDEX idx_careers_submitted_at ON careers_submissions(submitted_at);
CREATE INDEX idx_newsletter_email ON newsletter_subscriptions(email);
CREATE INDEX idx_newsletter_subscribed_at ON newsletter_subscriptions(subscribed_at);
CREATE INDEX idx_stripe_customers_email ON stripe_customers(email);
CREATE INDEX idx_stripe_subscriptions_customer_id ON stripe_subscriptions(stripe_customer_id);
CREATE INDEX idx_stripe_subscriptions_status ON stripe_subscriptions(status);
CREATE INDEX idx_order_consultations_submitted_at ON order_consultations(submitted_at);
CREATE INDEX idx_order_purchases_session_id ON order_purchases(stripe_session_id);
CREATE INDEX idx_order_purchases_status ON order_purchases(status);
CREATE INDEX idx_order_purchases_created_at ON order_purchases(created_at);
