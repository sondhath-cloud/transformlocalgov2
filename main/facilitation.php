<?php require_once 'api/track-visitor.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilitation - TransformLocalGov</title>
    <meta name="description"
        content="Professional facilitation services for strategic planning, team building, and learning and development. Expert guidance for productive meetings and workshops.">
    <link rel="icon" type="image/png" href="assets/images/TLGLogo.png">
    <link rel="stylesheet" href="styles.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    
    <style>
        /* Button hover effects for service type buttons */
        .service-type-buttons .btn:hover {
            background: var(--dark-orange) !important;
            transform: translateY(-2px);
        }

        /* Advanced Microinteractions for Facilitation Page */
        
        /* Magnetic Cursor Effects */
        .magnetic-element {
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }
        
        .magnetic-element:hover {
            transform: scale(1.05);
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
        
        /* Sequential Slide-in Animation */
        .hero-line {
            opacity: 0;
            transform: translateX(-100px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .hero-line:nth-child(even) {
            transform: translateX(100px);
        }
        
        .hero-line.visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .hero-line:nth-child(1) { transition-delay: 0.2s; }
        .hero-line:nth-child(2) { transition-delay: 0.6s; }
        .hero-line:nth-child(3) { transition-delay: 1.0s; }
        
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
        
        /* Parallax Background */
        .facilitation-hero {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .custom-cursor {
                display: none;
            }
        }
    </style>
    
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
                    <a href="facilitation.html" class="nav-link active">Facilitation</a>
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

    <!-- Facilitation Hero Section with Background Image -->
    <section class="facilitation-hero" style="background-image: url('assets/images/facilitation.jpeg');">
        <div class="facilitation-hero-overlay">
            <div class="facilitation-hero-content">
                <h1 class="hero-title">
                    <div class="hero-line">Strategic planning,</div>
                    <div class="hero-line">teambuilding, and learning</div>
                    <div class="hero-line">that achieves results.</div>
                </h1>
                <p class="hero-subtitle text-reveal">Objective and experienced facilitation makes every sessionmore productive and engaging. We help you achieve real results.</p>
                
                <!-- Service Type Selection -->
                <div class="service-type-selection" style="margin-top: 2rem;">
                    <div class="service-type-buttons" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="services.html#strategic-planning" class="btn btn-primary btn-large enhanced-btn magnetic-element spring-element" style="text-decoration: none; padding: 1rem 2rem; background: var(--primary-orange); color: white; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                            Strategic Planning
                        </a>
                        <a href="services.html#teambuilding-tasks" class="btn btn-primary btn-large enhanced-btn magnetic-element spring-element" style="text-decoration: none; padding: 1rem 2rem; background: var(--primary-orange); color: white; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                            Teambuilding and Retreats
                        </a>
                        <a href="services.html#training-tasks" class="btn btn-primary btn-large enhanced-btn magnetic-element spring-element" style="text-decoration: none; padding: 1rem 2rem; background: var(--primary-orange); color: white; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                            Learning and Development
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-text">
                    <p>Email: hello@transformlocalgov.com | Phone: 01-602-380-7231</p>
                    <p>&copy; 2025 TransformLocalGov. All rights reserved.</p>
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
    <script>
        // Header scroll behavior for facilitation page
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            const heroSection = document.querySelector('.facilitation-hero');
            
            if (heroSection) {
                const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;
                
                if (window.scrollY > heroBottom) {
                    // Scrolled past hero - change to white header with black text
                    navbar.style.backgroundColor = '#ffffff';
                    navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                    
                    // Change text colors to black
                    const navLinks = document.querySelectorAll('.navbar .nav-link');
                    const logoText = document.querySelector('.navbar .logo-text');
                    const hamburgerBars = document.querySelectorAll('.navbar .hamburger .bar');
                    
                    navLinks.forEach(link => {
                        link.style.color = '#333333';
                    });
                    if (logoText) logoText.style.color = '#333333';
                    hamburgerBars.forEach(bar => {
                        bar.style.backgroundColor = '#333333';
                    });
                } else {
                    // In hero section - transparent background with white text
                    navbar.style.backgroundColor = 'transparent';
                    navbar.style.boxShadow = 'none';
                    
                    // Set text colors to white
                    const navLinks = document.querySelectorAll('.navbar .nav-link');
                    const logoText = document.querySelector('.navbar .logo-text');
                    const hamburgerBars = document.querySelectorAll('.navbar .hamburger .bar');
                    
                    navLinks.forEach(link => {
                        link.style.color = 'white';
                    });
                    if (logoText) logoText.style.color = 'white';
                    hamburgerBars.forEach(bar => {
                        bar.style.backgroundColor = 'white';
                    });
                }
            }
        });

        // Microinteractions for Facilitation Page
        class FacilitationMicrointeractions {
            constructor() {
                this.init();
            }

            init() {
                this.initCustomCursor();
                this.initMagneticElements();
                this.initTextReveal();
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
                            const moveX = (x / distance) * force * 8;
                            const moveY = (y / distance) * force * 8;
                            
                            element.style.transform = `translate(${moveX}px, ${moveY}px) scale(1.05)`;
                        }
                    });
                    
                    element.addEventListener('mouseleave', () => {
                        element.style.transform = 'translate(0, 0) scale(1)';
                    });
                });
            }

            // Text Reveal Animation
            initTextReveal() {
                // Handle regular text-reveal elements
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
                
                // Handle hero-line elements with sequential animation
                const heroLines = document.querySelectorAll('.hero-line');
                
                const heroObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            heroLines.forEach((line, index) => {
                                setTimeout(() => {
                                    line.classList.add('visible');
                                }, index * 400 + 200); // Stagger the animations
                            });
                        }
                    });
                }, { threshold: 0.1 });
                
                // Observe the hero title container
                const heroTitle = document.querySelector('.hero-title');
                if (heroTitle) {
                    heroObserver.observe(heroTitle);
                }
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
            new FacilitationMicrointeractions();
        });

        // Add magnetic effect to navigation links
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.add('magnetic-element');
            });
        });
    </script>
</body>

</html>

