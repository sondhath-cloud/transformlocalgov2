<?php require_once 'api/track-visitor.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Services - TransformLocalGov</title>
    <meta name="description" content="Explore our comprehensive services including strategic planning, teambuilding, training, and digital adoption solutions designed to transform your local government organization.">
    <link rel="icon" type="image/png" href="assets/images/TLGLogo.png">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    <!-- Stripe JavaScript SDK -->
    <script src="https://js.stripe.com/v3/"></script>
    
    <style>
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
            transform: translateY(-3px);
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

        .order-page {
            padding: 0;
            background: white;
            min-height: 100vh;
        }
        
        /* Page Hero Section Styles */
        .page-hero-section {
            background: white;
            padding: 6rem 2rem;
            text-align: center;
            color: #333;
        }
        
        .page-hero-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 2rem;
            line-height: 1.1;
            color: #000000;
        }
        
        .page-hero-subtitle {
            font-size: 1.4rem;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            color: #666666;
        }
        
        /* Service Hero Section Styles */
        .service-hero-section {
            background: linear-gradient(135deg, var(--primary-orange), var(--dark-orange));
            padding: 4rem 2rem;
            margin-bottom: 0;
        }
        
        .service-hero-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        .service-hero-image {
            width: 100%;
        }
        
        .service-hero-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }
        
        .service-hero-content {
            padding: 2rem 0;
        }
        
        .service-hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .service-hero-subtitle {
            font-size: 1.1rem;
            color: white;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        
        .service-hero-content p {
            color: white;
        }
        
        .service-hero-benefits ul {
            list-style: none;
            padding: 0;
        }
        
        .service-hero-benefits li {
            padding: 0.5rem 0;
            color: white;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .service-hero-benefits li:before {
            content: "✓";
            color: white;
            font-weight: bold;
            position: absolute;
            left: 0;
        }
        
        .order-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 2rem;
            background: white;
        }
        
        /* Full-Width Accordion Section */
        .accordions-full-width {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .service-description {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: none;
            height: fit-content;
            position: sticky;
            top: 2rem;
        }
        
        .service-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .service-image.teambuilding-crop {
            object-position: 33% 0;
        }
        
        .service-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-orange);
            margin-bottom: 1rem;
        }
        
        .service-overview {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 1.5rem;
        }
        
        .service-benefits {
            list-style: none;
            padding: 0;
        }
        
        .service-benefits li {
            padding: 0.5rem 0;
            color: #666;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .service-benefits li:before {
            content: "✓";
            color: var(--primary-orange);
            font-weight: bold;
            position: absolute;
            left: 0;
        }
        
        .accordions-column {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .order-header {
            text-align: center;
            margin-bottom: 3rem;
            margin-top: 4rem;
        }
        
        .order-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-orange);
            margin-bottom: 1rem;
        }
        
        .order-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .accordion-container {
            background: white;
            border-radius: 12px;
            margin-bottom: 2rem;
            overflow: hidden;
            box-shadow: none;
        }
        
        .accordion-header {
            background: var(--primary-orange);
            color: white;
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
            border: none;
            width: 100%;
            text-align: left;
        }
        
        .accordion-header:hover {
            background: var(--dark-orange);
        }
        
        .accordion-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .accordion-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }
        
        .accordion-header.active .accordion-icon {
            transform: rotate(180deg);
        }
        
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: white;
        }
        
        .accordion-content.active {
            max-height: 2000px;
            overflow-y: auto;
        }
        
        .service-items {
            padding: 1rem;
        }
        
        .service-item {
            display: grid !important;
            grid-template-columns: auto 1fr auto !important;
            align-items: start !important;
            padding: 1rem 1.5rem !important;
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease;
            gap: 1rem !important;
            box-shadow: none;
        }
        
        /* Force override with higher specificity */
        .accordion-content .service-item {
            display: grid !important;
            grid-template-columns: auto 1fr auto !important;
            align-items: start !important;
            padding: 1rem 1.5rem !important;
            gap: 1rem !important;
        }
        
        /* New compact layout class */
        .compact-service-item {
            display: grid !important;
            grid-template-columns: auto 1fr auto !important;
            align-items: start !important;
            padding: 0.8rem 1.2rem !important;
            border-bottom: 1px solid #eee !important;
            transition: background 0.3s ease !important;
            gap: 0.8rem !important;
            box-shadow: none !important;
        }
        
        .compact-service-item:hover {
            background: #f8f9fa !important;
        }
        
        .compact-service-item:last-child {
            border-bottom: none !important;
        }
        
        .compact-service-content {
            display: flex !important;
            flex-direction: column !important;
            gap: 0.2rem !important;
        }
        
        .compact-service-name {
            font-size: 1.3rem !important;
            font-weight: 600 !important;
            color: #333 !important;
            margin-bottom: 0 !important;
            line-height: 1.3 !important;
        }
        
        .compact-service-description {
            color: #666 !important;
            line-height: 1.4 !important;
            margin-bottom: 0 !important;
            font-size: 1.1rem !important;
        }
        
        .compact-service-price {
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            color: var(--primary-orange) !important;
            min-width: 100px !important;
            text-align: right !important;
            flex-shrink: 0 !important;
            align-self: start !important;
            margin-top: 0.2rem !important;
        }
        
        .service-item:hover {
            background: #f8f9fa;
        }
        
        .service-item:last-child {
            border-bottom: none;
        }
        
        .service-checkbox {
            margin-top: 0.25rem;
            accent-color: var(--primary-orange);
            flex-shrink: 0;
        }
        
        .service-content {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .service-name {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
            line-height: 1.3;
        }
        
        .service-description {
            color: #666;
            line-height: 1.4;
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .service-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-orange);
            min-width: 80px;
            text-align: right;
            flex-shrink: 0;
            align-self: start;
            margin-top: 0.25rem;
        }
        
        /* Draft Agenda Styles - Paper Effect */
        .draft-agenda-section {
            background: #fefefe;
            border-radius: 2px;
            box-shadow: 
                0 0 0 1px rgba(0,0,0,0.1),
                0 2px 4px rgba(0,0,0,0.1),
                0 4px 8px rgba(0,0,0,0.1),
                0 8px 16px rgba(0,0,0,0.1);
            padding: 2.5rem 2rem;
            margin: 2rem auto;
            max-width: 900px;
            position: relative;
            transform: rotate(0deg);
            border: 1px solid #e0e0e0;
        }
        
        .draft-agenda-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: linear-gradient(to bottom, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0.02) 50%, transparent 100%);
            border-radius: 2px 2px 0 0;
        }
        
        .draft-agenda-section::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 1px;
            pointer-events: none;
        }
        
        .draft-agenda-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
            font-family: 'Times New Roman', serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #333;
            padding-bottom: 0.5rem;
        }
        
        .draft-agenda-content {
            min-height: 200px;
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            color: #333;
        }
        
        .no-items-message {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 2rem;
            font-size: 1.1rem;
        }
        
        .selected-item {
            padding: 0.75rem 0;
            border-bottom: 1px dotted #ccc;
            font-size: 1rem;
            color: #333;
        }
        
        .agenda-total {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 2px solid #333;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }
        
        .agenda-actions {
            margin-top: 1.5rem;
            text-align: center;
        }
        
        .selected-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
            margin-bottom: 0.5rem;
            border-radius: 8px;
        }
        
        .selected-item:last-child {
            border-bottom: none;
        }
        
        .selected-item-name {
            font-weight: 600;
            color: #333;
            flex: 1;
        }
        
        .selected-item-price {
            color: var(--primary-orange);
            font-weight: 600;
            margin-left: 1rem;
        }
        
        .agenda-total {
            border-top: 2px solid var(--primary-orange);
            padding-top: 1rem;
            margin-top: 1rem;
        }
        
        .total-line {
            display: flex;
            justify-content: space-between;
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
        }
        
        .agenda-actions {
            margin-top: 1.5rem;
            text-align: center;
        }
        
        .order-summary {
            background: white;
            border-radius: 12px;
            box-shadow: none;
            padding: 2rem;
            margin-top: 2rem;
            position: sticky;
            top: 2rem;
        }
        
        .summary-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .selected-items {
            margin-bottom: 1.5rem;
        }
        
        .selected-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .selected-item:last-child {
            border-bottom: none;
        }
        
        .item-name {
            font-weight: 500;
            color: #333;
        }
        
        .item-price {
            color: var(--primary-orange);
            font-weight: 600;
        }
        
        .total-section {
            border-top: 2px solid var(--primary-orange);
            padding-top: 1rem;
            margin-top: 1rem;
        }
        
        .total-line {
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }
        
        .order-buttons {
            display: flex;
            gap: 1rem;
            flex-direction: column;
        }
        
        .btn-consultation {
            background: var(--primary-orange);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }
        
        .btn-consultation:hover {
            background: var(--dark-orange);
            transform: translateY(-2px);
        }
        
        .btn-purchase {
            background: #28a745;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }
        
        .btn-purchase:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        
        .btn-purchase:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }
        
        .contact-info {
            text-align: center;
            padding: 1rem 0;
        }
        
        .contact-info p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .contact-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        /* Service Modal Styles */
        .service-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
        }

        .service-modal-content {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 1200px;
            max-height: 90vh;
            overflow-y: auto;
            position: absolute;
            border: 2px solid #F39C3D;
            box-shadow: 0 10px 30px rgba(243, 156, 61, 0.3);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .service-modal .close-modal {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 2rem;
            font-weight: bold;
            color: #666666;
            cursor: pointer;
            transition: color 0.3s;
            z-index: 10001;
        }

        .service-modal .close-modal:hover {
            color: var(--primary-orange);
        }

        .service-modal h2 {
            color: #333;
            font-size: 2.5rem;
            margin: 0 0 2rem 0;
            padding-right: 3rem;
        }
        
        .service-modal p {
            font-size: 1.2rem !important;
        }
        
        .service-modal-content {
            font-size: 1.1rem !important;
        }

        @media (max-width: 768px) {
            .page-hero-section {
                padding: 4rem 1rem;
            }
            
            .page-hero-title {
                font-size: 2.5rem;
            }
            
            .page-hero-subtitle {
                font-size: 1.1rem;
            }
            
            .service-hero-section {
                padding: 2rem 1rem;
            }
            
            .service-hero-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .service-hero-title {
                font-size: 2rem;
            }
            
            .service-hero-img {
                height: 250px;
            }
            
            .order-container {
                padding: 2rem 1rem;
            }
            
            .service-item {
                grid-template-columns: auto 1fr !important;
                grid-template-rows: auto auto !important;
                gap: 0.5rem !important;
            }
            
            .service-price {
                grid-column: 2;
                grid-row: 2;
                text-align: left;
                margin-top: 0;
                min-width: auto;
            }
            
            .compact-service-item {
                grid-template-columns: auto 1fr !important;
                grid-template-rows: auto auto !important;
                gap: 0.4rem !important;
                padding: 0.6rem 1rem !important;
            }
            
            .compact-service-price {
                grid-column: 2 !important;
                grid-row: 2 !important;
                text-align: left !important;
                margin-top: 0 !important;
                min-width: auto !important;
            }
            
            .draft-agenda-section {
                padding: 1.5rem;
            }
            
            .draft-agenda-title {
                font-size: 1.5rem;
            }
            
            .order-buttons {
                flex-direction: column;
            }
        }
        
        /* Make all text on services page match digital adoption page sizes */
        .service-hero-subtitle {
            font-size: 1.2rem !important;
            line-height: 1.6 !important;
        }
        
        .page-hero-subtitle {
            font-size: 1.2rem !important;
            line-height: 1.6 !important;
        }
        
        .compact-service-description {
            font-size: 1.1rem !important;
            line-height: 1.6 !important;
        }
        
        .compact-service-name {
            font-size: 1.1rem !important;
            line-height: 1.4 !important;
        }
        
        .accordion-header {
            font-size: 1.2rem !important;
        }
        
        p, .service-description, .draft-agenda-section p, .draft-agenda-section input, .draft-agenda-section textarea {
            font-size: 1.1rem !important;
            line-height: 1.6 !important;
        }
        
    </style>
    <link rel="stylesheet" href="styles.css?v=20250123">
    
    <!-- Analytics Tracker -->
    <script src="/main/analytics-tracker.js"></script>
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
                    <a href="digital-adoption.html" class="nav-link no-break">Digital Adoption</a>
                </li>
                <li class="nav-item">
                    <a href="custom-tools.html" class="nav-link">Web/Apps</a>
                </li>
                <li class="nav-item">
                    <a href="services.html" class="nav-link active">Services</a>
                </li>
                <li class="nav-item">
                    <a href="resources.html" class="nav-link">Resources</a>
                </li>
                <li class="nav-item">
                    <a href="about.html" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="connect.html" class="nav-link">Connect</a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Services Page -->
    <div class="order-page">
        <!-- Main Page Hero Section -->
        <div class="page-hero-section">
            <div class="page-hero-container">
                <h1 class="page-hero-title">Our Services</h1>
                <p class="page-hero-subtitle">Explore our comprehensive range of services designed to transform local government. Contact us to discuss your specific needs and get a customized proposal.</p>
            </div>
            </div>

        <!-- Strategic Planning Hero Section -->
        <div class="service-hero-section">
            <div class="service-hero-container">
                <div class="service-hero-image">
                    <img src="assets/images/Training.jpeg" alt="Strategic Planning Services" class="service-hero-img">
                </div>
                <div class="service-hero-content">
                    <h2 class="service-hero-title text-reveal magnetic-element">Strategic Planning</h2>
                    <p class="service-hero-subtitle text-reveal" style="font-size: 1.7rem; line-height: 1.7;">Comprehensive strategic planning services to help ensure alignment across all levels of your organization.</p>
                    
                    <p style="margin: 1.5rem 0 0 0; font-size: 1.2rem; line-height: 1.7; color: white;">TransformLocalGov values transparent costing, your organization's choice to select only the services you need, and your ability to proceed with your preferred procurement method. By selecting services below you can create a draft agenda with a total that you can submit to schedule a free consultation, save for later, pay for securely through our site, or submit a purchase order. All services have a full satisfaction guarantee.</p>
                    <button onclick="openServiceModal('strategic-planning')" class="service-modal-btn" style="margin-top: 1.5rem; padding: 0.75rem 1.5rem; background: white; color: var(--primary-orange); border: 2px solid white; border-radius: 8px; font-weight: 600; cursor: pointer;">View Strategic Planning Tasks</button>
                </div>
            </div>
                    </div>
                    
        <!-- Strategic Planning Accordion -->
        <div class="order-container" style="display: none;">
            <div class="accordions-full-width">
                        <div class="accordion-container">
                            <button type="button" class="accordion-header enhanced-btn" data-accordion="strategic-planning" style="background: var(--primary-orange); color: white;">
                                <h2>Strategic Planning Tasks</h2>
                        <span class="accordion-icon">+</span>
                            </button>
                            <div class="accordion-content" id="strategic-planning">
                                <div class="service-items">
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="orientation" data-price="1200" data-name="Orientation">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Orientation</div>
                                            <div class="compact-service-description">The orientation, typically two hours, aligns your project team to the strategic planning process, establish goals, and agree to governance.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $1,020 - $1,380</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="biweekly_meetings" data-price="3000" data-name="Bi-weekly Project Meetings">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Bi-weekly Project Meetings</div>
                                            <div class="compact-service-description">Strategic planning engagements average six months. We provide bi-weekly project meetings at minimum, to track progress, keep the team informed, make decisions, and maintain momentum.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $2,550 - $3,450</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="kickoff_meeting" data-price="1400" data-name="Project Kickoff Meeting">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Project Kickoff Meeting</div>
                                            <div class="compact-service-description">We launch your initiative with a three-hour kickoff meeting for your leadership that sets clear expectations and timelines. During the kickoff we prepare leadership to actively participate in the process including establishing strategic alignment criteria, inventorying and scoring programs, and keeping teams across their departments informed and engaged.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $1,190 - $1,610</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="project_announcement" data-price="400" data-name="Project Announcement">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Project Announcement</div>
                                            <div class="compact-service-description">A graphically-designed project notice for your distribution to the public and staff that covers the process and a tentative timeline. We prepare this notice to invite robust participation, set expectations, reduce confusion, and minimize potential resistance. Translation is available for your notice at an additional cost.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $340 - $460</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="interviews" data-price="100" data-name="Interviews">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Interviews</div>
                                            <div class="compact-service-description">30-minute interviews with individual stakeholders of your choosing.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $85 - $115</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="group_input_session" data-price="400" data-name="Facilitated Group Input Session">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Facilitated Group Input Session</div>
                                            <div class="compact-service-description">Some communities have groups of key stakeholders they wish to engage. This option includes up to one session up to two-hours of facilitated, interactive group input. Multiple sessions can be requested.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $340 - $460</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="current_state_report" data-price="8000" data-name="Current State Report">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Current State Report</div>
                                            <div class="compact-service-description">A synthesis of your community's strengths, needs, and issues based on a review of your organization's existing plans and available data on programs, projects and initiatives. The report includes external benchmarking data, internal-facing items that may block successful plan implementation, and recommendations.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $6,800 - $9,200</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="midyear_review" data-price="2400" data-name="Mid-year Review">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Mid-year Review</div>
                                            <div class="compact-service-description">Facilitated progress assessment and strategic plan refinement at the midpoint of your planning cycle.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $2,040 - $2,760</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="online_feedback" data-price="3600" data-name="Online Input">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Online Input</div>
                                            <div class="compact-service-description">A customized method to receive input and gauge sentiment from your entire community and all employees. Using Bradley-Terry scoring we determine what matters most in your community and what stands in the way. Your organization receives access to a web dashboard to interact with your data.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $3,060 - $4,140</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="public_meeting" data-price="4400" data-name="Public Planning Meeting(s)">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Public Planning Meeting(s)</div>
                                            <div class="compact-service-description">Using a structured and participatory method, we: Facilitate public comment, Create your mission and vision, Review and discuss the Current State Report, Organize high volume strategic input into digestible categories, Help elected officials focus on the big picture and agree on priorities, Establish targets that define what success will look like in your community. Two sessions and up to eight hours of public planning meeting facilitation.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $3,740 - $5,060</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="strategic_priorities" data-price="1600" data-name="Strategic Priority and High-Level Goals Document">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Strategic Priority and High-Level Goals Document</div>
                                            <div class="compact-service-description">Your community's highest priorities and success definitions in a graphically designed document suitable for print and web publication. Your strategic plan can be translated into other languages for an additional cost.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $1,360 - $1,840</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="program_inventory" data-price="2800" data-name="Program Inventory Exercise">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Program Inventory Exercise</div>
                                            <div class="compact-service-description">A facilitated program evaluation exercise where your leaders establish "crystal clear" criteria that will define progress in strategic areas, and score existing programs, projects, and initiatives. This step surfaces "Continue or Stop" opportunities, highlighting the activities that currently align, or don't, with new strategic priorities and goals. We also train your leadership to use this same exercise to evaluate future new initiatives (opportunities to "Start").</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $2,380 - $3,220</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="manager_toolkit" data-price="2000" data-name="Manager Toolkit">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Manager Toolkit</div>
                                            <div class="compact-service-description">Our toolkit, available in print and online, includes guidance to help your leaders facilitate empathetic and forward-looking discussions at the department level. The toolkit contains recommendations to honor past efforts and contributions and build energy around future opportunities. It also contains templates and action planning guide to help your leaders effectively implement new programs.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $1,700 - $2,300</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="strategy_conversation" data-price="800" data-name="Strategy Conversation Cofacilitation">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Strategy Conversation Cofacilitation</div>
                                            <div class="compact-service-description">We co-facilitate strategy conversations up to four sessions with your leaders to help staff process changes, understand the rationale behind decisions, and rally around a shared sense of purpose.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $680 - $920</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="implementation_kickstart" data-price="800" data-name="Implementation Kick Start">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Implementation Kick Start</div>
                                            <div class="compact-service-description">A two-hour kick start session can be used for anything you wish such as: Review progress toward strategic goals and celebrating early wins, Recalibrate timelines or priorities based on changing conditions, Strengthen accountability structures and project governance, Address barriers to implementation or cross-department collaboration, Refresh communication and engagement plans to maintain momentum, Align leadership or Board members around mid-course adjustments. Session includes necessary consultation time before a session. Longer sessions available when requested.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $680 - $920</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="strategysync_app" data-price="0" data-name="StrategySync App">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">StrategySync App</div>
                                            <div class="compact-service-description">Unlimited user access to your own instance of our exclusive online app for managing your strategic plan, assigning activities, tracking progress, and applying change management is included with a full Strategic Plan package. Not yet available for individual purchase.</div>
                                        </div>
                                <div class="compact-service-price">Included</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="same_page_session" data-price="1600" data-name="Same Page Session">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Same Page Session</div>
                                            <div class="compact-service-description">A half-day facilitated session where leaders review the current state report and build their cohesiveness as a team while processing report contents. This session ensures your leaders are prepared to answer questions from elected officials or the public during upcoming strategic planning sessions. Available when a Current State Report is available.</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $1,360 - $1,840</div>
                                    </div>
                                    <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="governance_workshop" data-price="800" data-name="Governance Workshop">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Governance Workshop</div>
                                            <div class="compact-service-description">At this session we facilitate the process for your leadership to agree on monitoring, evaluating, and providing updates about strategic plan implementation progress (includes StrategySync software training during full Strategic Plan package).</div>
                                        </div>
                                <div class="compact-service-price">Estimate: $680 - $920</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- Teambuilding Hero Section -->
        <div class="service-hero-section" style="background: white !important;">
            <div class="service-hero-container">
                <div class="service-hero-image">
                    <img src="assets/images/retreat2.jpg" alt="Teambuilding and Retreat Services" class="service-hero-img" loading="lazy">
                </div>
                <div class="service-hero-content">
                    <h2 class="service-hero-title" style="color: var(--primary-orange) !important;">Teambuilding and Retreats</h2>
                    <p class="service-hero-subtitle" style="font-size: 1.7rem; line-height: 1.7; color: #333 !important;">Transform your team dynamics with our comprehensive teambuilding and retreat services. We focus on building stronger relationships, improving communication, enhancing collaboration, developing leadership skills, and creating meaningful team bonding experiences that drive organizational success.</p>
                    <button onclick="openServiceModal('teambuilding-tasks')" class="service-modal-btn" style="margin-top: 1.5rem; padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: 2px solid var(--primary-orange); border-radius: 8px; font-weight: 600; cursor: pointer;">View Teambuilding Tasks</button>
                </div>
            </div>
                    </div>
                    
        <!-- Teambuilding Accordion -->
        <div class="order-container" style="display: none;">
            <div class="accordions-full-width">
                        <div class="accordion-container">
                            <button type="button" class="accordion-header enhanced-btn" data-accordion="teambuilding-tasks" style="background: var(--primary-orange); color: white;">
                                <h2>Teambuilding Tasks</h2>
                        <span class="accordion-icon">+</span>
                            </button>
                            <div class="accordion-content" id="teambuilding-tasks">
                                <div class="service-items">
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="team_retreat_half_day" data-price="2000" data-name="Team Retreat - Half Day">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Team Retreat - Half Day</div>
                                            <div class="compact-service-description">Half-day team building retreat with activities focused on communication, collaboration, and team dynamics. Can be focused on resolving team conflicts and building stronger working relationships.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $1,700 - $2,300</div>
                                    </div>
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="team_retreat_full_day" data-price="3500" data-name="Team Retreat - Full Day">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Team Retreat - Full Day</div>
                                            <div class="compact-service-description">Full-day team building retreat with activities focused on communication, collaboration, and team dynamics.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $2,975 - $4,025</div>
                                    </div>
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="leadership_team_building" data-price="5000" data-name="Leadership Team Building">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Leadership Team Building</div>
                                            <div class="compact-service-description">Two-day intensive retreat for leadership teams focusing on strategic alignment and executive collaboration.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $4,250 - $5,750</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- Digital Adoption Hero Section -->
        <div class="service-hero-section">
            <div class="service-hero-container">
                <div class="service-hero-image">
                    <img src="assets/images/training2.png" alt="Digital Adoption Services" class="service-hero-img">
                </div>
                <div class="service-hero-content">
                    <h2 class="service-hero-title">Digital Adoption</h2>
                    <p class="service-hero-subtitle">Navigate digital transformation with confidence. Our digital adoption services help organizations successfully implement new technologies and optimize digital workflows.</p>
                    
                    <p style="margin-bottom: 0.5rem; font-size: 1.2rem; color: white;"><strong>Hourly Rate Estimate:</strong> $170.00 - $230.00 per hour</p>
                    <p style="margin-bottom: 0.5rem; font-size: 1.2rem; color: white;"><strong>Monthly Billing:</strong> 40 hours minimum (maximum 100 hours)</p>
                    <p style="margin-bottom: 0.5rem; font-size: 1.2rem; color: white;"><strong>On-Site Presence:</strong> Monthly visits recommended (travel billed as incurred)</p>
                    <button onclick="openServiceModal('digital-adoption')" class="service-modal-btn" style="margin-top: 1.5rem; padding: 0.75rem 1.5rem; background: white; color: var(--primary-orange); border: 2px solid white; border-radius: 8px; font-weight: 600; cursor: pointer;">View Digital Adoption Tasks</button>
                </div>
            </div>
        </div>

        <!-- Digital Adoption Accordion -->
        <div class="order-container" style="display: none;">
            <div class="accordions-full-width">
                <div class="accordion-container">
                    <button type="button" class="accordion-header enhanced-btn" data-accordion="digital-adoption" style="background: var(--primary-orange); color: white;">
                        <h2>Digital Adoption Tasks</h2>
                        <span class="accordion-icon">+</span>
                    </button>
                    <div class="accordion-content" id="digital-adoption">
                        <div class="service-items">
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="same_page_workshop" data-price="3200" data-name="Same Page Workshop">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Same Page Workshop</div>
                                    <div class="compact-service-description">A leadership workshop to establish collective awareness of the initiative's purpose, consensus on vision, values, and expectations around accountability, empowerment, performance, and priorities, identification of potential obstacles and resistance, set transformational goals.</div>
                                </div>
                                <div class="compact-service-price">16 hrs</div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="same_page_review_dashboard" data-price="8000" data-name="Same Page Review and Dashboard">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Same Page Review and Dashboard</div>
                                    <div class="compact-service-description">Comprehensive review and dashboard setup for tracking transformation progress, change readiness assessment, and real-time monitoring of implementation metrics and stakeholder engagement.</div>
                                </div>
                                <div class="compact-service-price">40 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="same_page_plan" data-price="4800" data-name="Same Page Plan">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Same Page Plan</div>
                                    <div class="compact-service-description">Comprehensive plan combining your vision, workshop insights, review results, and change management essentials. Assesses labor agreements, policies, municipal code, and civil service rules to flag inconsistencies. Pinpoints process updates needed and proposes specific, actionable changes with clear justifications.</div>
                                </div>
                                <div class="compact-service-price">24 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="same_page_training" data-price="8000" data-name="Same Page Training">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Same Page Training</div>
                                    <div class="compact-service-description">Core training method building skills in collaborating, communicating, facilitating meetings, improving processes, leading change, managing emotion, and thinking critically. Customized for all employee levels with technical training coordination and vendor material alignment.</div>
                                </div>
                                <div class="compact-service-price">40 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="training_needs_assessment" data-price="32000" data-name="System and Process Training Needs Assessment">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">System and Process Training Needs Assessment</div>
                                    <div class="compact-service-description">Comprehensive assessment of training needs, development of training plans, and facilitation of system and process training. Includes role-based skill requirements, vendor material alignment, and delivery coordination.</div>
                                </div>
                                <div class="compact-service-price">160 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="connection_strategy" data-price="4800" data-name="Connection Strategy">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Connection Strategy</div>
                                    <div class="compact-service-description">Detailed connection strategy with creative messaging, custom graphics, animated shorts, and videos. Includes persona-based messaging, FAQs, talking points, staff briefings, and stakeholder maps to maintain engagement throughout transformation.</div>
                                </div>
                                <div class="compact-service-price">24 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="project_brand" data-price="3200" data-name="Project Brand">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Project Brand</div>
                                    <div class="compact-service-description">Development of unique brand identity for your transformation initiative to establish and reinforce unity and purpose, making your transformational goals instantly recognizable and easy to align with.</div>
                                </div>
                                <div class="compact-service-price">16 hrs</div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="project_website" data-price="8000" data-name="Project Website">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Project Website</div>
                                    <div class="compact-service-description">Creation and maintenance of your project's branded website where impacted stakeholders will find updates, resources, questions, answers, and dashboard. Alternative platform support available.</div>
                                </div>
                                <div class="compact-service-price">40 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="steering_team_support" data-price="16000" data-name="Steering Team Support">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Steering Team Support</div>
                                    <div class="compact-service-description">Regular steering team meeting coordination and facilitation to ensure adequate resources, plan communication strategies, identify obstacles, and discuss what must start, stop, or continue to achieve success and sustain results.</div>
                                </div>
                                <div class="compact-service-price">80 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="leader_support_workshops" data-price="8000" data-name="Leader Support Workshops">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Leader Support Workshops</div>
                                    <div class="compact-service-description">Periodic workshops for department heads, managers, and supervisors with individual support as needed. Focuses on leadership development during organizational change and transformation.</div>
                                </div>
                                <div class="compact-service-price">40 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="same_page_team" data-price="12000" data-name="Same Page Team Facilitation">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Same Page Team Facilitation</div>
                                    <div class="compact-service-description">Monthly facilitation of employee representative team for skill-building workshops, Same Page reinforcement, software project updates, and guidance for sharing information with others throughout the organization.</div>
                                </div>
                                <div class="compact-service-price">60 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="faqs" data-price="8000" data-name="FAQs Development">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">FAQs Development</div>
                                    <div class="compact-service-description">Establishment and maintenance of Frequently Asked Questions so all stakeholders have reliable access to correct information. FAQs address common concerns and queries that arise during the project.</div>
                                </div>
                                <div class="compact-service-price">40 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="employee_role_impact_report" data-price="8000" data-name="Employee Role Impact Report">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Employee Role Impact Report</div>
                                    <div class="compact-service-description">Comprehensive assessment identifying roles shifting due to new systems, evaluating employee strengths and gaps, and presenting recommended solutions to close skill gaps or prepare for new roles aligned with organizational priorities.</div>
                                </div>
                                <div class="compact-service-price">40 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="process_mapping_sops" data-price="32000" data-name="Process Mapping and SOPs">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Process Mapping and SOPs</div>
                                    <div class="compact-service-description">Visual process mapping and workflow analysis to determine changes needed for new systems. Creates clear design documents outlining new processes, identifies dependencies, and ensures service levels are maintained during transition.</div>
                                </div>
                                <div class="compact-service-price">160 hrs </div>
                            </div>
                            <div class="compact-service-item">
                                <input type="checkbox" class="service-checkbox" name="service[]" value="post_golive_governance" data-price="4800" data-name="Post Go-Live Governance Workshop">
                                <div class="compact-service-content">
                                    <div class="compact-service-name">Post Go-Live Governance Workshop</div>
                                    <div class="compact-service-description">Post-implementation workshop evaluating transformation success, reviewing performance metrics, and focusing on ten areas of change impact. Results in consensus on priorities, governance team formation, and Quick Reference Guide documentation.</div>
                                </div>
                                <div class="compact-service-price">24 hrs </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Training Hero Section -->
        <div class="service-hero-section" style="background: white !important;">
            <div class="service-hero-container">
                <div class="service-hero-image">
                    <img src="assets/images/strategic.jpeg" alt="Instructor-Led Training Services" class="service-hero-img">
                </div>
                <div class="service-hero-content">
                    <h2 class="service-hero-title" style="color: var(--primary-orange) !important;">Learning and Development</h2>
                    <p class="service-hero-subtitle" style="color: #333 !important;">Professional training programs designed to develop essential skills across your organization. Our expert facilitators deliver engaging, practical training that drives real results.</p>
                    <p style="margin-bottom: 0.5rem; font-size: 1.2rem; color: #333 !important;">Tailored programs designed specifically for your organization's needs and challenges</p>
                    <p style="margin-bottom: 0.5rem; font-size: 1.2rem; color: #333 !important;">Proven programs covering essential skills and competencies</p>
                    <p style="margin-bottom: 1.5rem; font-size: 1.2rem; color: #333 !important;">Instructor-led sessions and computer-based training available</p>
                    <button onclick="openServiceModal('training-tasks')" class="service-modal-btn" style="margin-top: 1rem; padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: 2px solid var(--primary-orange); border-radius: 8px; font-weight: 600; cursor: pointer;">View Learning and Development Tasks</button>
                </div>
            </div>
                    </div>
                    
        <!-- Training Accordion -->
        <div class="order-container" style="display: none;">
            <div class="accordions-full-width">
                <div class="accordion-container">
                    <button type="button" class="accordion-header enhanced-btn" data-accordion="training-tasks" style="background: var(--primary-orange); color: white;">
                                <h2>Learning and Development Tasks</h2>
                        <span class="accordion-icon">+</span>
                            </button>
                            <div class="accordion-content" id="training-tasks">
                                <div class="service-items">
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="leadership_development_training" data-price="3000" data-name="Leadership Development Training">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Leadership Development Training</div>
                                            <div class="compact-service-description">Comprehensive leadership training program covering essential management and leadership skills.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $2,550 - $3,450</div>
                                    </div>
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="communication_skills_training" data-price="2200" data-name="Communication Skills Training">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Communication Skills Training</div>
                                            <div class="compact-service-description">Training program focused on improving verbal, written, and non-verbal communication skills.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $1,870 - $2,530</div>
                                    </div>
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="change_management_training" data-price="2800" data-name="Change Management Training">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Change Management Training</div>
                                            <div class="compact-service-description">Training on managing organizational change, including strategies for successful implementation.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $2,380 - $3,220</div>
                                    </div>
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="project_management_training" data-price="2500" data-name="Project Management Training">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Project Management Training</div>
                                            <div class="compact-service-description">Comprehensive project management training covering planning, execution, and monitoring techniques.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $2,125 - $2,875</div>
                                    </div>
                                    <div class="compact-service-item">
                                        <input type="checkbox" class="service-checkbox" name="service[]" value="computer_based_training" data-price="3500" data-name="Computer-Based Training">
                                        <div class="compact-service-content">
                                            <div class="compact-service-name">Computer-Based Training</div>
                                            <div class="compact-service-description">Custom 30-minute computer-based training course development and delivery.</div>
                                        </div>
                                        <div class="compact-service-price">Estimate: $2,975 - $4,025</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="order-container" style="background: white; padding: 2rem; border-radius: 8px;">
            <form id="order-form">

                <!-- Draft Agenda Section -->
                <div class="draft-agenda-section">
                    <h2 class="draft-agenda-title">Draft Agenda</h2>
                    <div class="draft-agenda-content">
                        <div class="selected-items" id="selected-items">
                            <p class="no-items-message">Select services above to build your draft agenda</p>
                        </div>
                        <div class="agenda-total" id="agenda-total" style="display: none;">
                            <div class="total-line">
                                <span>Total:</span>
                                <span id="total-amount">$0</span>
                            </div>
                        </div>
                        
                        <!-- Contact Information Fields -->
                        <div class="contact-fields" id="contact-fields" style="display: none; margin-top: 2rem; padding-top: 1rem; border-top: 2px solid #333;">
                            <h3 style="font-size: 1.2rem; margin-bottom: 1rem; color: #333;">Contact Information</h3>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div>
                                    <label for="contact-name" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Full Name *</label>
                                    <input type="text" id="contact-name" name="contact_name" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                                </div>
                                <div>
                                    <label for="contact-email" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Email Address *</label>
                                    <input type="email" id="contact-email" name="contact_email" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div>
                                    <label for="contact-phone" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Phone Number</label>
                                    <input type="tel" id="contact-phone" name="contact_phone" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                                </div>
                                <div>
                                    <label for="organization" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Organization</label>
                                    <input type="text" id="organization" name="organization" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                                </div>
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <label for="additional-notes" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Additional Notes</label>
                                <textarea id="additional-notes" name="additional_notes" rows="3" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; resize: vertical;"></textarea>
                            </div>
                        </div>
                        
                        <div class="agenda-actions" id="agenda-actions" style="display: none;">
                            <button type="button" class="btn-purchase enhanced-btn magnetic-element spring-element" onclick="shareDraftAgenda()">
                                Share via Email
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="order-summary">
                    <h3 class="summary-title">Ready to Get Started?</h3>
                    <div class="contact-info">
                        <p>Contact us to discuss your specific needs and receive a customized proposal for our services.</p>
                        <div class="contact-buttons">
                            <a href="connect.html" class="btn-consultation">
                                Connect for Consultation
                            </a>
                            <a href="tel:01-602-380-7231" class="btn-purchase">
                                Call: 01-602-380-7231
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Advanced Microinteractions for Services Page
        class ServicesMicrointeractions {
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
                const heroSection = document.querySelector('.page-hero-section');
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
            new ServicesMicrointeractions();
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

        // Existing Services Page JavaScript
        // Draft Agenda functionality
        window.selectedItems = {};
        window.totalAmount = 0;
        const selectedItems = window.selectedItems;
        let totalAmount = window.totalAmount;

        // Initialize checkbox event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.service-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateDraftAgenda(this);
                });
            });
            
            // Form submission handling
            const orderForm = document.getElementById('order-form');
            orderForm.addEventListener('submit', function(e) {
                e.preventDefault();
                submitDraftAgenda();
            });
        });

        function updateDraftAgenda(checkbox) {
            const value = checkbox.value;
            const price = parseInt(checkbox.getAttribute('data-price'));
            const name = checkbox.getAttribute('data-name');

            if (checkbox.checked) {
                window.selectedItems[value] = { name, price };
                window.totalAmount += price;
            } else {
                if (window.selectedItems[value]) {
                    window.totalAmount -= window.selectedItems[value].price;
                    delete window.selectedItems[value];
                }
            }

            updateDraftAgendaDisplay();
        }

        function updateDraftAgendaDisplay() {
            const selectedItemsContainer = document.getElementById('selected-items');
            const agendaTotal = document.getElementById('agenda-total');
            const agendaActions = document.getElementById('agenda-actions');
            const contactFields = document.getElementById('contact-fields');
            const totalAmountElement = document.getElementById('total-amount');

            if (Object.keys(window.selectedItems).length === 0) {
                selectedItemsContainer.innerHTML = '<p class="no-items-message">Select services above to build your draft agenda</p>';
                agendaTotal.style.display = 'none';
                agendaActions.style.display = 'none';
                contactFields.style.display = 'none';
            } else {
                let html = '';
                for (const [key, item] of Object.entries(window.selectedItems)) {
                    html += `
                        <div class="selected-item">
                            <span class="selected-item-name">${item.name}</span>
                            <span class="selected-item-price">$${item.price.toLocaleString()}</span>
                        </div>
                    `;
                }
                selectedItemsContainer.innerHTML = html;
                
                totalAmountElement.textContent = `$${window.totalAmount.toLocaleString()}`;
                agendaTotal.style.display = 'block';
                agendaActions.style.display = 'block';
                contactFields.style.display = 'block';
            }
        }

        function shareDraftAgenda() {
            if (Object.keys(window.selectedItems).length === 0) {
                alert('Please select at least one service to share your draft agenda.');
                return;
            }

            // Build agenda summary
            let agendaSummary = 'Selected Services:\n';
            for (const [key, item] of Object.entries(window.selectedItems)) {
                agendaSummary += `- ${item.name}: $${item.price.toLocaleString()}\n`;
            }
            agendaSummary += `\nTotal: $${window.totalAmount.toLocaleString()}`;

            // Create mailto link
            const subject = encodeURIComponent('Draft Agenda - Free Consultation Request');
            const body = encodeURIComponent(
                `Hello TransformLocalGov Team,\n\n` +
                `I would like to schedule a free consultation to discuss the following services:\n\n` +
                agendaSummary + `\n\n` +
                `Please contact me to schedule a consultation.\n\n` +
                `Thank you!`
            );

            window.location.href = `mailto:hello@transformlocalgov.com?subject=${subject}&body=${body}`;
        }

        function submitDraftAgenda() {
            if (Object.keys(window.selectedItems).length === 0) {
                alert('Please select at least one service to submit your draft agenda.');
                return;
            }

            // Get form data
            const formData = new FormData(document.getElementById('order-form'));
            const contactName = formData.get('contact_name');
            const contactEmail = formData.get('contact_email');
            const contactPhone = formData.get('contact_phone');
            const organization = formData.get('organization');
            const additionalNotes = formData.get('additional_notes');

            // Validate required fields
            if (!contactName || !contactEmail) {
                alert('Please fill in all required fields (Name and Email).');
                return;
            }

            // Prepare services data
            const servicesArray = [];
            for (const [key, item] of Object.entries(window.selectedItems)) {
                servicesArray.push({
                    id: key,
                    name: item.name,
                    price: item.price
                });
            }

            // Prepare submission data
            const submissionData = {
                contact_name: contactName,
                contact_email: contactEmail,
                contact_phone: contactPhone,
                organization: organization,
                additional_notes: additionalNotes,
                selected_services: servicesArray,
                total_amount: totalAmount
            };

            // Show loading state
            const submitButton = document.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Submitting...';
            submitButton.disabled = true;

            // Submit to database
            fetch('api/submit-agenda.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(submissionData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert('Thank you! Your draft agenda has been submitted successfully. We will contact you soon to schedule your free consultation.');
                    
                    // Reset form
                    document.getElementById('order-form').reset();
                    window.selectedItems = {};
                    window.totalAmount = 0;
                    updateDraftAgendaDisplay();
                } else {
                    alert('Error submitting draft agenda: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting your draft agenda. Please try again or contact us directly.');
            })
            .finally(() => {
                // Reset button state
                submitButton.textContent = originalText;
                submitButton.disabled = false;
            });
        }

        // Accordion functionality
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', function() {
                const target = this.getAttribute('data-accordion');
                const content = document.getElementById(target);
                const icon = this.querySelector('.accordion-icon');
                
                // Toggle active class
                this.classList.toggle('active');
                content.classList.toggle('active');
                
                // Change icon from + to - when expanded
                if (this.classList.contains('active')) {
                    icon.textContent = '−';
                } else {
                    icon.textContent = '+';
                }
            });
        });

        // Mobile menu toggle
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');

        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Handle hash navigation to open correct accordion
        function handleHashNavigation() {
            const hash = window.location.hash.substring(1); // Remove the # symbol
            if (hash) {
                const targetContent = document.getElementById(hash);
                const targetHeader = document.querySelector(`[data-accordion="${hash}"]`);
                
                if (targetContent && targetHeader) {
                    // Close all other accordions first
                    document.querySelectorAll('.accordion-content').forEach(content => {
                        content.classList.remove('active');
                    });
                    document.querySelectorAll('.accordion-header').forEach(header => {
                        header.classList.remove('active');
                        const icon = header.querySelector('.accordion-icon');
                        if (icon) icon.textContent = '+';
                    });
                    
                    // Open the target accordion
                    targetHeader.classList.add('active');
                    targetContent.classList.add('active');
                    const icon = targetHeader.querySelector('.accordion-icon');
                    if (icon) icon.textContent = '−';
                    
                    // Scroll to the accordion
                    targetHeader.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        }

        // Handle hash navigation on page load
        handleHashNavigation();

        // Handle hash navigation when hash changes (for back/forward buttons)
        window.addEventListener('hashchange', handleHashNavigation);

        // Service Modal Functions
        function openServiceModal(modalId) {
            const modal = document.getElementById(modalId + '-modal');
            const accordionContent = document.getElementById(modalId);
            
            if (modal && accordionContent) {
                // Clone the accordion content into the modal if not already done
                const modalContent = modal.querySelector('.modal-accordion-content');
                if (!modalContent || modalContent.children.length === 0) {
                    const clonedContent = accordionContent.cloneNode(true);
                    clonedContent.style.display = 'block';
                    clonedContent.classList.add('active');
                    clonedContent.removeAttribute('style');
                    clonedContent.classList.remove('accordion-content');
                    if (modalContent) {
                        modalContent.innerHTML = '';
                        modalContent.appendChild(clonedContent.querySelector('.service-items'));
                    }
                }
                
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeServiceModal(modalId) {
            const modal = document.getElementById(modalId + '-modal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('service-modal')) {
                const modalId = event.target.id.replace('-modal', '');
                closeServiceModal(modalId);
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.service-modal').forEach(modal => {
                    if (modal.style.display === 'block') {
                        const modalId = modal.id.replace('-modal', '');
                        closeServiceModal(modalId);
                    }
                });
            }
        });

        // Add selected items from modal to draft agenda
        function addSelectedToAgenda(modalId) {
            const modal = document.getElementById(modalId + '-modal');
            if (!modal) return;

            // Get all checked checkboxes in the modal
            const checkedBoxes = modal.querySelectorAll('.service-checkbox:checked');
            
            if (checkedBoxes.length === 0) {
                alert('Please select at least one service item before adding to agenda.');
                return;
            }
            
            // Trigger update for each checked item using the modal's checkboxes
            checkedBoxes.forEach(checkbox => {
                const value = checkbox.value;
                const price = parseInt(checkbox.getAttribute('data-price'));
                const name = checkbox.getAttribute('data-name');
                
                // Add to selectedItems if not already present
                if (!window.selectedItems) {
                    window.selectedItems = {};
                    window.totalAmount = 0;
                }
                
                if (!window.selectedItems[value]) {
                    window.selectedItems[value] = { name, price };
                    window.totalAmount += price;
                }
            });

            // Update the display
            updateDraftAgendaDisplay();

            // Scroll to the draft agenda section
            setTimeout(() => {
                const draftAgenda = document.querySelector('.draft-agenda-section');
                if (draftAgenda) {
                    draftAgenda.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 100);
        }
    </script>
    
    <!-- Service Modals -->
    <div id="strategic-planning-modal" class="service-modal">
        <div class="service-modal-content">
            <span class="close-modal" onclick="closeServiceModal('strategic-planning')">&times;</span>
            <h2>Strategic Planning Tasks</h2>
            <p style="margin: 0 0 1rem 0; color: #666; font-size: 1.3rem;">Select options to see tasks on a draft agenda.</p>
            <button onclick="addSelectedToAgenda('strategic-planning'); closeServiceModal('strategic-planning')" style="margin-bottom: 1.5rem; padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add to Agenda</button>
            <div class="modal-accordion-content"></div>
            <div style="margin-top: 2rem; text-align: center; padding-top: 2rem; border-top: 2px solid #eee;">
                <button onclick="addSelectedToAgenda('strategic-planning'); closeServiceModal('strategic-planning')" style="padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add Selected to Agenda</button>
            </div>
        </div>
    </div>

    <div id="teambuilding-tasks-modal" class="service-modal">
        <div class="service-modal-content">
            <span class="close-modal" onclick="closeServiceModal('teambuilding-tasks')">&times;</span>
            <h2>Teambuilding Tasks</h2>
            <p style="margin: 0 0 1rem 0; color: #666; font-size: 1.3rem;">Select options to see tasks on a draft agenda.</p>
            <button onclick="addSelectedToAgenda('teambuilding-tasks'); closeServiceModal('teambuilding-tasks')" style="margin-bottom: 1.5rem; padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add to Agenda</button>
            <div class="modal-accordion-content"></div>
            <div style="margin-top: 2rem; text-align: center; padding-top: 2rem; border-top: 2px solid #eee;">
                <button onclick="addSelectedToAgenda('teambuilding-tasks'); closeServiceModal('teambuilding-tasks')" style="padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add Selected to Agenda</button>
            </div>
        </div>
    </div>

    <div id="digital-adoption-modal" class="service-modal">
        <div class="service-modal-content">
            <span class="close-modal" onclick="closeServiceModal('digital-adoption')">&times;</span>
            <h2>Digital Adoption Tasks</h2>
            <p style="margin: 0 0 1rem 0; color: #666; font-size: 1.3rem;">Select options to see tasks on a draft agenda.</p>
            <button onclick="addSelectedToAgenda('digital-adoption'); closeServiceModal('digital-adoption')" style="margin-bottom: 1.5rem; padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add to Agenda</button>
            <div class="modal-accordion-content"></div>
            <div style="margin-top: 2rem; text-align: center; padding-top: 2rem; border-top: 2px solid #eee;">
                <button onclick="addSelectedToAgenda('digital-adoption'); closeServiceModal('digital-adoption')" style="padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add Selected to Agenda</button>
            </div>
        </div>
    </div>

    <div id="training-tasks-modal" class="service-modal">
        <div class="service-modal-content">
            <span class="close-modal" onclick="closeServiceModal('training-tasks')">&times;</span>
            <h2>Learning and Development Tasks</h2>
            <p style="margin: 0 0 1rem 0; color: #666; font-size: 1.3rem;">Select options to see tasks on a draft agenda.</p>
            <button onclick="addSelectedToAgenda('training-tasks'); closeServiceModal('training-tasks')" style="margin-bottom: 1.5rem; padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add to Agenda</button>
            <div class="modal-accordion-content"></div>
            <div style="margin-top: 2rem; text-align: center; padding-top: 2rem; border-top: 2px solid #eee;">
                <button onclick="addSelectedToAgenda('training-tasks'); closeServiceModal('training-tasks')" style="padding: 0.75rem 1.5rem; background: var(--primary-orange); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Add Selected to Agenda</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-text">
                    <p>© 2025 TransformLocalGov. All rights reserved.</p>
                    <p>Email: hello@transformlocalgov.com | Phone: 01-602-380-7231</p>
                </div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/sondrahathaway/" target="_blank" rel="noopener noreferrer" class="social-link">LinkedIn</a>
                    <a href="https://github.com/sondhath-cloud" target="_blank" rel="noopener noreferrer" class="social-link">GitHub</a>
                    <a href="https://www.youtube.com/@transformlocalgov" target="_blank" rel="noopener noreferrer" class="social-link">YouTube</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
