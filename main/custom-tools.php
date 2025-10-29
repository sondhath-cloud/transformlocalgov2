<?php require_once 'api/track-visitor.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Development - TransformLocalGov</title>
    <meta name="description" content="Professional website and app development services with transparent pricing.">
    <link rel="icon" type="image/png" href="assets/images/TLGLogo.png">
    <link rel="stylesheet" href="styles.css?v=20250123">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    
    <style>
        /* Hero Section Styling */
        .web-apps-hero {
            background-image: url('assets/images/facilitation2.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .web-apps-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        
        .web-apps-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 0 2rem;
        }
        
        .web-apps-hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            line-height: 1.2;
        }
        
        .web-apps-hero-subtitle {
            font-size: 1.3rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }
        
        .web-apps-hero-button {
            background: var(--primary-orange);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            display: inline-block;
        }
        
        .web-apps-hero-button:hover {
            background: #e8833f;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }
        
        /* Bouncing Arrow Animation */
        .bouncing-arrow {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            animation: bounce 2s infinite;
            cursor: pointer;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }
        
        /* Advanced Microinteractions */
        
        /* Magnetic Cursor Effects */
        .magnetic-element {
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }
        
        .magnetic-element:hover {
            transform: scale(1.05);
        }
        
        /* Parallax Multi-layer Depth */
        .parallax-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            will-change: transform;
        }
        
        .parallax-bg {
            transform: translateZ(0);
            background-attachment: fixed;
        }
        
        .parallax-content {
            transform: translateZ(0);
            position: relative;
            z-index: 2;
        }
        
        /* WebGL-style Hover Distortions */
        .distortion-element {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .distortion-element::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
            z-index: 1;
        }
        
        .distortion-element:hover::before {
            transform: translateX(100%);
        }
        
        .distortion-element:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        /* Scroll Velocity Animations */
        .velocity-element {
            transition: transform 0.1s ease-out;
            will-change: transform;
        }
        
        .velocity-fast {
            transform: translateY(-20px) scale(1.05);
        }
        
        .velocity-medium {
            transform: translateY(-10px) scale(1.02);
        }
        
        .velocity-slow {
            transform: translateY(-5px);
        }
        
        /* Elastic Spring Physics */
        .spring-element {
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .spring-bounce {
            animation: springBounce 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        @keyframes springBounce {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        /* Morphing Transitions */
        .morph-element {
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }
        
        .morph-element::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.6s ease;
            z-index: 1;
        }
        
        .morph-element:hover::after {
            width: 300px;
            height: 300px;
        }
        
        .morph-element:hover {
            transform: scale(1.05);
            border-radius: 20px;
        }
        
        /* Custom Cursor */
        .custom-cursor {
            position: fixed;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: transform 0.1s ease;
        }
        
        .custom-cursor.hover {
            transform: scale(2);
            background: rgba(255, 255, 255, 0.6);
        }
        
        /* Enhanced Button Effects */
        .enhanced-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .enhanced-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .enhanced-btn:hover::before {
            left: 100%;
        }
        
        .enhanced-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        /* Text Reveal Animation */
        .text-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .text-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Particle System */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat 3s infinite ease-in-out;
        }
        
        @keyframes particleFloat {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.6; }
            50% { transform: translateY(-20px) scale(1.2); opacity: 1; }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .web-apps-hero-title {
                font-size: 2.5rem;
            }
            
            .web-apps-hero-subtitle {
                font-size: 1.1rem;
            }
            
            .web-apps-hero-button {
                padding: 0.8rem 2rem;
                font-size: 1.1rem;
            }
            
            .custom-cursor {
                display: none;
            }
            
            .distortion-element:hover {
                transform: scale(1.01);
            }
            
            .morph-element:hover {
                transform: scale(1.03);
            }
        }
    </style>
    
</head>

<body>
    <!-- Custom Cursor -->
    <div class="custom-cursor"></div>
    
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.html" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 12px;">
                    <img src="assets/images/TLGLogo.png" alt="TransformLocalGov Logo" style="height: 40px; width: auto;">
                </a>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="facilitation.html" class="nav-link">Facilitation</a>
                </li>
                <li class="nav-item">
                    <a href="digital-adoption.html" class="nav-link no-break">Digital Adopt</a>
                </li>
                <li class="nav-item">
                    <a href="custom-tools.html" class="nav-link active">Web/Apps</a>
                </li>
                <li class="nav-item">
                    <a href="services.html" class="nav-link">Services</a>
                </li>
                <li class="nav-item">
                    <a href="resources.html" class="nav-link">Resources</a>
                </li>
                <li class="nav-item">
                    <a href="about.html" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="connect.html" class="nav-link">Contact</a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Web/Apps Hero Section -->
    <section class="web-apps-hero parallax-bg">
        <div class="web-apps-hero-overlay parallax-layer"></div>
        <div class="web-apps-hero-content parallax-content">
            <h1 class="web-apps-hero-title text-reveal magnetic-element">Web and App Development</h1>
            <p class="web-apps-hero-subtitle text-reveal">Professional website and app development services with transparent pricing and modern design.</p>
            <a href="demos/index.html" class="web-apps-hero-button enhanced-btn magnetic-element spring-element">View Project Samples</a>
        </div>
    </section>

    <!-- Bouncing Arrow Indicator -->
    <div class="bouncing-arrow velocity-element" onclick="scrollToForm()">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" style="color: white; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));">
            <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <!-- Website Request Form Section -->
    <section id="website-request" class="website-request">
        <div class="container">
            <div class="request-content">
                <!-- Header -->
                <div class="request-header">
                    <h1 class="page-title">Website and App Development</h1>
                    <p class="page-subtitle">We design engaging and functional websites<br>and apps to represent you and your organization.<br>(not just local government!)</p>
                    
                    <!-- Project Samples Button -->
                    <div class="samples-button-container" style="text-align: center; margin: 2rem 0;">
                        <a href="demos/index.html" class="btn btn-primary samples-btn" style="display: inline-block; padding: 1rem 2rem; background: var(--primary-orange); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                            View Project Samples
                        </a>
                    </div>
                    
                    <style>
                        .samples-btn:hover {
                            background: #e8833f !important;
                            transform: translateY(-2px);
                            box-shadow: 0 5px 15px rgba(243, 156, 61, 0.4);
                        }
                    </style>
                </div>


                <!-- Form Container -->
                <div class="request-form-container">
                    <form id="website-request-form" class="website-form">
                        
                        <!-- Contact Information -->
                        <div class="form-section">
                            <h2 class="section-title">Contact Information</h2>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="full-name">Full Name *</label>
                                    <input type="text" id="full-name" name="full_name" class="glass-input" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" class="glass-input" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" class="glass-input">
                                </div>
                                <div class="form-group">
                                    <label for="company">Company/Organization</label>
                                    <input type="text" id="company" name="company" class="glass-input">
                                </div>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div class="form-section">
                            <h2 class="section-title">Project Details</h2>
                            <div class="form-group">
                                <label for="project-name">Project Name *</label>
                                <input type="text" id="project-name" name="project_name" class="glass-input" required>
                            </div>
                            <div class="form-group">
                                <label for="project-description">Project Description *</label>
                                <textarea id="project-description" name="project_description" class="glass-input" rows="4" 
                                    placeholder="Describe your website or app goals, target audience, and any specific requirements..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="timeline">Desired Timeline *</label>
                                <select id="timeline" name="timeline" class="glass-input" required>
                                    <option value="">Select...</option>
                                    <option value="asap">As soon as possible</option>
                                    <option value="1-2-weeks">1-2 weeks</option>
                                    <option value="3-4-weeks">3-4 weeks</option>
                                    <option value="1-2-months">1-2 months</option>
                                    <option value="flexible">Flexible</option>
                                </select>
                            </div>
                        </div>

                        <!-- Standard Features Included -->
                        <div class="form-section">
                            <h2 class="section-title">Web Design Standard Features</h2>
                            <p class="section-note">All projects include these features at no additional cost:</p>
                            
                            <div class="features-grid readonly-features">
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Responsive Design (Mobile, Tablet, Desktop)</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Custom Design (No Templates)</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Domain Registration (1 Year)</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Custom Business Email</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Contact/Lead Forms</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">SEO Optimization</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Social Media Integration</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Blog or News Section</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Image Gallery or Slider</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Brand Integration (Your Logo and Colors)</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Complete File Ownership</span>
                                </div>
                                <div class="feature-item included">
                                    <span class="feature-icon">✓</span>
                                    <span class="feature-text">Security Best Practices</span>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Features -->
                        <div class="form-section">
                            <h2 class="section-title">Advanced Features (Additional Options)</h2>
                            <p class="section-note">Select any additional features you need for your project. <strong>Additional costs apply for these features.</strong></p>
                            
                            <!-- Database Integration -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="database_integration" id="database-integration" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>Database Integration</strong>
                                            <span class="feature-description">Store and manage data like user accounts, products, bookings, etc.</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="nested-input" id="database-details" style="display: none;">
                                    <label for="database-type">What type of data will you be storing?</label>
                                    <textarea id="database-type" name="database_type" class="glass-input" rows="2" 
                                        placeholder="E.g., user profiles, product inventory, booking information..."></textarea>
                                </div>
                            </div>

                            <!-- Payment Processing -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="payment_processing" id="payment-processing" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>Payment Processing</strong>
                                            <span class="feature-description">Accept credit cards, subscriptions, or one-time payments (Stripe integration)</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="nested-input" id="payment-details" style="display: none;">
                                    <label>Payment Type Needed:</label>
                                    <div class="radio-group">
                                        <label class="radio-label">
                                            <input type="radio" name="payment_type" value="one-time">
                                            <span>One-time payments</span>
                                        </label>
                                        <label class="radio-label">
                                            <input type="radio" name="payment_type" value="subscriptions">
                                            <span>Recurring subscriptions</span>
                                        </label>
                                        <label class="radio-label">
                                            <input type="radio" name="payment_type" value="both">
                                            <span>Both</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- User Authentication -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="user_authentication" id="user-authentication" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>User Authentication System</strong>
                                            <span class="feature-description">User registration, login, password management, and role-based access</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="nested-input" id="auth-details" style="display: none;">
                                    <label for="user-roles">Describe the user roles needed:</label>
                                    <input type="text" id="user-roles" name="user_roles" class="glass-input" 
                                        placeholder="E.g., Admin, Members, Customers...">
                                </div>
                            </div>

                            <!-- API Integrations -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="api_integrations" id="api-integrations" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>API Integrations</strong>
                                            <span class="feature-description">Connect to external services (APIs are Application Programming Interfaces that allow different software systems to communicate with each other)</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="nested-input" id="api-details" style="display: none;">
                                    <label for="num-apis">Number of API Integrations Needed:</label>
                                    <select id="num-apis" name="num_apis" class="glass-input">
                                        <option value="">Select...</option>
                                        <option value="1">1 integration</option>
                                        <option value="2">2 integrations</option>
                                        <option value="3">3 integrations</option>
                                        <option value="4-5">4-5 integrations</option>
                                        <option value="6+">6+ integrations</option>
                                    </select>
                                    <label for="api-services" style="margin-top: 15px;">Which services do you need to integrate?</label>
                                    <textarea id="api-services" name="api_services" class="glass-input" rows="2" 
                                        placeholder="E.g., Calendly for scheduling, Google Analytics, social media feeds, email marketing platforms, CRM systems..."></textarea>
                                </div>
                            </div>

                            <!-- E-commerce -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="ecommerce" id="ecommerce" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>E-commerce Functionality</strong>
                                            <span class="feature-description">Online store with product catalog, shopping cart, and checkout system</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="nested-input" id="ecommerce-details" style="display: none;">
                                    <label for="num-products">Estimated Number of Products:</label>
                                    <select id="num-products" name="num_products" class="glass-input">
                                        <option value="">Select...</option>
                                        <option value="1-10">1-10 products</option>
                                        <option value="11-50">11-50 products</option>
                                        <option value="51-100">51-100 products</option>
                                        <option value="100+">100+ products</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Booking System -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="booking_system" id="booking-system" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>Booking/Appointment System</strong>
                                            <span class="feature-description">Online scheduling for services, appointments, or reservations</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Content Management -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="content_management" id="content-management" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>Advanced Content Management</strong>
                                            <span class="feature-description">Easy-to-use interface for updating content without coding knowledge</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Analytics Dashboard -->
                            <div class="advanced-feature-group">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="analytics_dashboard" id="analytics-dashboard" class="feature-checkbox">
                                        <span class="checkbox-text">
                                            <strong>Custom Analytics Dashboard</strong>
                                            <span class="feature-description">Track visitors, conversions, and other key metrics with visual reports</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <!-- Additional Information -->
                        <div class="form-section">
                            <h2 class="section-title">Additional Information</h2>
                            <div class="form-group">
                                <label for="existing-website">Do you have an existing website?</label>
                                <select id="existing-website" name="existing_website" class="glass-input">
                                    <option value="no">No, this is a new website</option>
                                    <option value="yes-redesign">Yes, I need a redesign</option>
                                    <option value="yes-migrate">Yes, I need to migrate content</option>
                                </select>
                            </div>
                            <div class="form-group" id="existing-url-group" style="display: none;">
                                <label for="existing-url">Existing Website URL</label>
                                <input type="url" id="existing-url" name="existing_url" class="glass-input" 
                                    placeholder="https://yourcurrentwebsite.com">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="desired-url-1">Desired URL (First Choice) *</label>
                                    <input type="text" id="desired-url-1" name="desired_url_1" class="glass-input" 
                                        placeholder="e.g., yourbusiness.com" required>
                                </div>
                                <div class="form-group">
                                    <label for="desired-url-2">Desired URL (Second Choice)</label>
                                    <input type="text" id="desired-url-2" name="desired_url_2" class="glass-input" 
                                        placeholder="e.g., yourbusiness.net">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alternative-words">Alternative Words/Phrases for URL</label>
                                <textarea id="alternative-words" name="alternative_words" class="glass-input" rows="2" 
                                    placeholder="List other words, phrases, or variations that could work for your domain name (e.g., 'mycompany', 'bestservice', 'premiumsolutions')"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="additional-notes">Additional Notes or Questions</label>
                                <textarea id="additional-notes" name="additional_notes" class="glass-input" rows="4" 
                                    placeholder="Any other details, questions, or specific requirements..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="promo-code">Promo Code (Optional)</label>
                                <input type="text" id="promo-code" name="promo_code" class="glass-input" 
                                    placeholder="Enter promo code if you have one">
                                <div id="promo-status" style="margin-top: 0.5rem; font-size: 0.9rem;"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-large">
                                <span class="btn-text">Submit Request</span>
                                <span class="btn-loading" style="display: none;">Sending...</span>
                            </button>
                            <p class="form-note">We'll review your request and get back to you within 24 hours with a detailed quote.</p>
                        </div>

                        <!-- Status Messages -->
                        <div id="form-status" class="form-status"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-text">
                    <p>&copy; 2025 TransformLocalGov. All rights reserved.</p>
                    <p>Email: hello@transformlocalgov.com | Phone: 01-602-380-7231</p>
                </div>
                <div class="footer-middle">
                    <a href="subscribe.html" class="footer-link">Payment</a>
                    <a href="careers.html" class="footer-link">Careers</a>
                </div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/sondrahathaway/" target="_blank" rel="noopener noreferrer" class="social-link">LinkedIn</a>
                    <a href="https://github.com/sondhath-cloud" target="_blank" rel="noopener noreferrer" class="social-link">GitHub</a>
                    <a href="https://www.youtube.com/@transformlocalgov" target="_blank" rel="noopener noreferrer" class="social-link">YouTube</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    
    <!-- Form Interaction Script -->
    <script>
        // Advanced Microinteractions for Web/Apps Page
        class WebAppsMicrointeractions {
            constructor() {
                this.init();
            }

            init() {
                this.initCustomCursor();
                this.initMagneticElements();
                this.initParallaxScrolling();
                this.initScrollVelocity();
                this.initTextReveal();
                this.initParticleSystem();
                this.initSpringPhysics();
                this.initEnhancedButtons();
            }

            // Custom Cursor
            initCustomCursor() {
                const cursor = document.querySelector('.custom-cursor');
                if (!cursor) return;

                let mouseX = 0, mouseY = 0;
                let cursorX = 0, cursorY = 0;

                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                });

                function animateCursor() {
                    cursorX += (mouseX - cursorX) * 0.1;
                    cursorY += (mouseY - cursorY) * 0.1;
                    
                    cursor.style.left = cursorX + 'px';
                    cursor.style.top = cursorY + 'px';
                    
                    requestAnimationFrame(animateCursor);
                }
                animateCursor();

                // Cursor hover effects
                const hoverElements = document.querySelectorAll('.magnetic-element, .enhanced-btn');
                hoverElements.forEach(el => {
                    el.addEventListener('mouseenter', () => cursor.classList.add('hover'));
                    el.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
                });
            }

            // Magnetic Elements
            initMagneticElements() {
                const magneticElements = document.querySelectorAll('.magnetic-element');
                
                magneticElements.forEach(element => {
                    element.addEventListener('mousemove', (e) => {
                        const rect = element.getBoundingClientRect();
                        const x = e.clientX - rect.left - rect.width / 2;
                        const y = e.clientY - rect.top - rect.height / 2;
                        
                        const distance = Math.sqrt(x * x + y * y);
                        const maxDistance = 50;
                        
                        if (distance < maxDistance) {
                            const force = (maxDistance - distance) / maxDistance;
                            const moveX = (x / distance) * force * 10;
                            const moveY = (y / distance) * force * 10;
                            
                            element.style.transform = `translate(${moveX}px, ${moveY}px) scale(1.05)`;
                        }
                    });
                    
                    element.addEventListener('mouseleave', () => {
                        element.style.transform = 'translate(0, 0) scale(1)';
                    });
                });
            }

            // Parallax Scrolling with Multi-layer Depth
            initParallaxScrolling() {
                let ticking = false;
                
                const updateParallax = () => {
                    const scrolled = window.pageYOffset;
                    const parallaxElements = document.querySelectorAll('.parallax-bg, .parallax-content, .parallax-layer');
                    
                    parallaxElements.forEach((element, index) => {
                        const speed = 0.5 + (index * 0.1);
                        const yPos = -(scrolled * speed);
                        element.style.transform = `translateY(${yPos}px)`;
                    });
                    
                    ticking = false;
                };

                const requestTick = () => {
                    if (!ticking) {
                        requestAnimationFrame(updateParallax);
                        ticking = true;
                    }
                };

                window.addEventListener('scroll', requestTick);
            }

            // Scroll Velocity Animations
            initScrollVelocity() {
                let lastScrollY = window.scrollY;
                let velocity = 0;
                let ticking = false;

                const updateVelocity = () => {
                    const currentScrollY = window.scrollY;
                    velocity = currentScrollY - lastScrollY;
                    lastScrollY = currentScrollY;

                    const velocityElements = document.querySelectorAll('.velocity-element');
                    velocityElements.forEach(element => {
                        element.classList.remove('velocity-fast', 'velocity-medium', 'velocity-slow');
                        
                        if (Math.abs(velocity) > 10) {
                            element.classList.add('velocity-fast');
                        } else if (Math.abs(velocity) > 5) {
                            element.classList.add('velocity-medium');
                        } else if (Math.abs(velocity) > 0) {
                            element.classList.add('velocity-slow');
                        }
                    });

                    ticking = false;
                };

                const requestTick = () => {
                    if (!ticking) {
                        requestAnimationFrame(updateVelocity);
                        ticking = true;
                    }
                };

                window.addEventListener('scroll', requestTick);
            }

            // Text Reveal Animation
            initTextReveal() {
                const textElements = document.querySelectorAll('.text-reveal');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.add('visible');
                            }, 200);
                        }
                    });
                }, { threshold: 0.1 });

                textElements.forEach(element => {
                    observer.observe(element);
                });
            }

            // Particle System
            initParticleSystem() {
                const heroSection = document.querySelector('.web-apps-hero');
                if (!heroSection) return;

                const createParticle = () => {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 3 + 's';
                    particle.style.animationDuration = (3 + Math.random() * 2) + 's';
                    
                    heroSection.appendChild(particle);
                    
                    setTimeout(() => {
                        particle.remove();
                    }, 5000);
                };

                // Create particles periodically
                setInterval(createParticle, 2000);
            }

            // Spring Physics
            initSpringPhysics() {
                const springElements = document.querySelectorAll('.spring-element');
                
                springElements.forEach(element => {
                    element.addEventListener('click', () => {
                        element.classList.add('spring-bounce');
                        setTimeout(() => {
                            element.classList.remove('spring-bounce');
                        }, 800);
                    });
                });
            }

            // Enhanced Button Effects
            initEnhancedButtons() {
                const enhancedButtons = document.querySelectorAll('.enhanced-btn');
                
                enhancedButtons.forEach(button => {
                    button.addEventListener('mouseenter', () => {
                        button.style.transform = 'translateY(-3px) scale(1.05)';
                    });
                    
                    button.addEventListener('mouseleave', () => {
                        button.style.transform = 'translateY(0) scale(1)';
                    });
                });
            }
        }

        // Initialize microinteractions when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new WebAppsMicrointeractions();
        });

        // Enhanced hover effects for existing elements
        document.addEventListener('DOMContentLoaded', () => {
            // Add magnetic effect to navigation links
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.add('magnetic-element');
            });

            // Add enhanced button effects to existing buttons
            const buttons = document.querySelectorAll('button, .btn');
            buttons.forEach(button => {
                if (!button.classList.contains('enhanced-btn')) {
                    button.classList.add('enhanced-btn');
                }
            });
        });

        // Scroll to form function for bouncing arrow
        function scrollToForm() {
            const formSection = document.getElementById('website-request');
            if (formSection) {
                formSection.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }
        }

        // Show/hide nested inputs based on checkbox state
        const featureCheckboxes = document.querySelectorAll('.feature-checkbox');
        
        featureCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const featureGroup = this.closest('.advanced-feature-group');
                const nestedInput = featureGroup.querySelector('.nested-input');
                
                if (nestedInput) {
                    nestedInput.style.display = this.checked ? 'block' : 'none';
                }
            });
        });

        // Show/hide existing URL field based on existing website selection
        const existingWebsiteSelect = document.getElementById('existing-website');
        const existingUrlGroup = document.getElementById('existing-url-group');
        
        existingWebsiteSelect.addEventListener('change', function() {
            if (this.value === 'yes-redesign' || this.value === 'yes-migrate') {
                existingUrlGroup.style.display = 'block';
            } else {
                existingUrlGroup.style.display = 'none';
            }
        });

        // Promo code validation
        const promoCodeInput = document.getElementById('promo-code');
        const promoStatus = document.getElementById('promo-status');
        let isPromoValid = false;
        
        promoCodeInput.addEventListener('input', function() {
            const code = this.value.trim();
            
            if (code === '') {
                promoStatus.innerHTML = '';
                isPromoValid = false;
            } else if (code === 'linkedin1025') {
                promoStatus.innerHTML = '<span style="color: #28a745; font-weight: 600;">✓ Valid promo code applied!</span>';
                isPromoValid = true;
            } else {
                promoStatus.innerHTML = '<span style="color: #dc3545;">✗ Invalid promo code</span>';
                isPromoValid = false;
            }
        });

        // Form submission handler
        document.getElementById('website-request-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formStatus = document.getElementById('form-status');
            const submitBtn = this.querySelector('.btn-primary');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            
            // Show loading state
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline';
            submitBtn.disabled = true;
            
            // Collect form data
            const formData = new FormData(this);
            formData.append('promo_code_valid', isPromoValid);
            
            // Submit form to PHP handler
            fetch('api/custom-tools-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    formStatus.innerHTML = '<div class="success-message">' + data.message + '</div>';
                    formStatus.style.display = 'block';
                    
                    // Reset form
                    this.reset();
                    
                    // Clear promo code status
                    promoStatus.innerHTML = '';
                    isPromoValid = false;
                    
                    // Hide all nested inputs
                    document.querySelectorAll('.nested-input').forEach(input => {
                        input.style.display = 'none';
                    });
                } else {
                    // Show error message
                    formStatus.innerHTML = '<div class="error-message">' + data.message + '</div>';
                    formStatus.style.display = 'block';
                }
                
                // Reset button
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
                submitBtn.disabled = false;
                
                // Scroll to status message
                formStatus.scrollIntoView({ behavior: 'smooth', block: 'center' });
            })
            .catch(error => {
                console.error('Error:', error);
                formStatus.innerHTML = '<div class="error-message">Sorry, there was an error submitting your request. Please try again later.</div>';
                formStatus.style.display = 'block';
                
                // Reset button
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
                submitBtn.disabled = false;
                
                formStatus.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        });
    </script>
</body>

</html>

