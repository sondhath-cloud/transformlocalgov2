<?php require_once 'api/track-visitor.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransformLocalGov - Local Government Transformation</title>
    <meta name="description"
        content="Firm specializing in digital adoption of new or updated software implementations and facilitation of strategic planning and learning initiatives to transform local government improved customer service, higher employee engagement, and lower regrettable turnover.">
    <link rel="icon" type="image/png" href="assets/images/TLGLogo.png">
    <link rel="stylesheet" href="styles.css?v=20250123">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    
    <style>
        /* Move fly-in content up by 33% */
        #fly-in {
            transform: translateY(-33%) !important;
        }
        
        /* Make text 33% bigger in fly-in container */
        #fly-in > div {
            font-size: 2.66em !important;
            line-height: 1.4 !important;
        }
        
        /* Ensure all lines have consistent sizing and centering */
        #fly-in {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        #fly-in > div {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        /* Position static buttons outside fly-in container */
        .static-nav-buttons {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: wrap;
            z-index: 10;
        }
        
        /* Make buttons 75% smaller (25% of original size), then increase by 100%, then reduce by 33% */
        .static-nav-btn {
            padding: 0.33rem 0.67rem !important;
            font-size: 0.93rem !important;
            text-decoration: none;
            background: rgba(255,255,255,0.95);
            color: #F39C3D;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .static-nav-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            #fly-in > div {
                font-size: 1.8em !important;
            }
            
            .static-nav-buttons {
                flex-direction: column;
                align-items: center;
                bottom: 10% !important;
            }
            
            .static-nav-btn {
                font-size: 0.8rem !important;
                padding: 0.27rem 0.53rem !important;
            }
        }
    </style>
    
    <!-- Stripe JavaScript SDK -->
    <script src="https://js.stripe.com/v3/"></script>
    
    <!-- Analytics Tracker -->
    <script src="/main/analytics-tracker.js"></script>

</head>

<body>
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
                    <a href="services.html" class="nav-link">Services</a>
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

    <!-- Fly-in Movie Title Component -->
    <section class="fly-in-movie-title">
        <div id="fly-in">  
            <div class="fly-in-logo-container"><img src="assets/images/TLGLogo.png" alt="TransformLocalGov Logo" class="fly-in-logo"></div>
            <div><span>Facilitation that</span> Builds Teams</div>
            <div>Strategic Planning <span>and</span> Execution</div>
            <div><span>Websites that</span> Connect</div>
            <div>Culture <span>by Design</span></div>
            <div><span>Apps that</span> Engage</div>
            <div><span>Build</span> Capacity</div>
            <div><span>Sustain</span> Change</div>
            <div><span>Organizational</span> Reboot</div>
            <div>Leadership Team <span>Development</span></div>
        </div>
        
        <!-- Static Navigation Buttons - Outside Fly-in Container -->
        <div class="static-nav-buttons">
            <a href="facilitation.html" class="static-nav-btn">Facilitation</a>
            <a href="digital-adoption.html" class="static-nav-btn">Digital Adoption</a>
            <a href="custom-tools.html" class="static-nav-btn">Web/Apps</a>
        </div>
    </section>

    <!-- Video Modal -->
    <div id="videoModal" class="video-modal">
        <div class="video-modal-content">
            <span class="close-modal" onclick="closeVideoModal()">&times;</span>
            <video id="modalVideo" controls poster="assets/images/video_thumbnail.jpg">
                <source src="assets/images/we-love-change.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer show-links">
        <div class="container">
            <div class="footer-content">
                <div class="footer-text">
                    <p>&copy; 2025 TransformLocalGov. All rights reserved.</p>
                    <p>Email: hello@transformlocalgov.com | Phone: 01-602-380-7231</p>
                </div>
                <div class="footer-middle">
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
    
    <!-- Payment Success/Cancel Handler -->
    <script>
        // Check for payment success/cancel parameters
        const urlParams = new URLSearchParams(window.location.search);
        const paymentStatus = urlParams.get('payment');
        const sessionId = urlParams.get('session_id');
        
        if (paymentStatus === 'success') {
            // Show success message
            showNotification('🎉 Payment successful! Your subscription is now active.', 'success');
            
            // Scroll to subscription section
            setTimeout(() => {
                document.getElementById('subscription').scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 1000);
            
            // Clean up URL
            window.history.replaceState({}, document.title, window.location.pathname);
        } else if (paymentStatus === 'cancelled') {
            // Show cancel message
            showNotification('Payment was cancelled. No charges were made.', 'error');
            
            // Clean up URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        
        // Fly-in animation will stay on screen
    </script>
</body>

</html>