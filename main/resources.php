<?php require_once 'api/track-visitor.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - TransformLocalGov</title>
    <meta name="description" content="Free resources and tools to help transform your organization - Connection Assessment and more from TransformLocalGov">
    <link rel="icon" type="image/png" href="assets/images/TLGLogo.png">
    <link rel="stylesheet" href="styles.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        .resources-page {
            padding: 4rem 2rem 2rem;
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .resources-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .resources-header {
            text-align: center;
            margin-bottom: 3rem;
            margin-top: 4rem;
        }
        
        .resources-title {
            font-size: 4rem;
            font-weight: 800;
            color: var(--primary-orange);
            margin-bottom: 2rem;
            line-height: 1.1;
            font-family: "Poppins", "Inter", system-ui, -apple-system, sans-serif;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .resources-subtitle {
            font-size: 1.4rem;
            line-height: 1.6;
            opacity: 0.95;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .resources-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 3rem;
            margin-bottom: 2rem;
        }
        
        .resource-image {
            text-align: center;
        }
        
        .resource-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            object-fit: contain;
        }
        
        .resource-image img:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .resource-content {
            padding-left: 2rem;
        }
        
        .resource-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            font-family: "Poppins", "Inter", system-ui, -apple-system, sans-serif;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .resource-description {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
            margin-bottom: 2rem;
        }
        
        .resource-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .resource-link {
            display: inline-flex;
            align-items: center;
            padding: 1rem 2rem;
            background: var(--primary-orange);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-align: center;
            justify-content: center;
        }
        
        .resource-link:hover {
            background: var(--dark-orange);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(243, 156, 61, 0.3);
        }
        
        .resource-link i {
            margin-right: 0.5rem;
        }
        
        .resource-link.secondary {
            background: transparent;
            color: var(--primary-orange);
            border: 2px solid var(--primary-orange);
        }
        
        .resource-link.secondary:hover {
            background: var(--primary-orange);
            color: white;
        }
        
        .coming-soon {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .coming-soon h3 {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        .coming-soon p {
            color: #999;
            font-size: 1.1rem;
        }
        
        @media (max-width: 768px) {
            .resources-page {
                padding: 1rem;
            }
            
            .resources-title {
                font-size: 2rem;
            }
            
            .resources-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem;
            }
            
            .resource-content {
                padding-left: 0;
                text-align: center;
            }
            
            .resource-title {
                font-size: 1.5rem;
            }
        }
    </style>
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
                    <a href="digital-adoption.html" class="nav-link no-break">Digital Adopt</a>
                </li>
                <li class="nav-item">
                    <a href="custom-tools.html" class="nav-link">Web/Apps</a>
                </li>
                <li class="nav-item">
                    <a href="services.html" class="nav-link">Services</a>
                </li>
                <li class="nav-item">
                    <a href="resources.html" class="nav-link active">Resources</a>
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

    <!-- Resources Page -->
    <div class="resources-page">
        <div class="resources-container">
            <div class="resources-header">
                <h1 class="resources-title">Resources</h1>
                <p class="resources-subtitle">Free tools and resources to help you transform your organization and improve communication, planning, and digital adoption.</p>
            </div>

            <!-- Connection Assessment Resource -->
            <div class="resources-grid">
                <div class="resource-image">
                    <a href="https://transformlocalgov.com/connection-assessment" target="_blank" rel="noopener noreferrer">
                        <img src="assets/images/CommAssess.png" alt="Connection Assessment Tool" />
                    </a>
                </div>
                <div class="resource-content">
                    <h2 class="resource-title">Connection Assessment Tool</h2>
                    <p class="resource-description">
                        Evaluate your organization's connection effectiveness with our comprehensive assessment tool. 
                        This interactive resource helps identify connection gaps, strengths, and opportunities for improvement 
                        across all levels of your organization. Perfect for teams, departments, or entire organizations looking 
                        to enhance their connection strategies and build stronger relationships.
                    </p>
                    <div class="resource-links">
                        <a href="https://transformlocalgov.com/connection-assessment" target="_blank" rel="noopener noreferrer" class="resource-link">
                            Access Connection Assessment
                        </a>
                        <a href="connect.html" class="resource-link secondary">
                            Get Help Interpreting Results
                        </a>
                    </div>
                </div>
            </div>

            <!-- Our Bathroom Goals Resource -->
            <div class="resources-grid">
                <div class="resource-image">
                    <a href="assets/documents/OurBathroomGoals.pdf" target="_blank" rel="noopener noreferrer">
                        <img src="assets/images/OurBathroomGoals-thumb.png" alt="'Our Bathroom Goals' A Visual Guide Example" style="border: 2px solid var(--primary-orange); padding: 1rem; background: #fff;" />
                    </a>
                </div>
                <div class="resource-content">
                    <h2 class="resource-title">&ldquo;Our Bathroom Goals&rdquo;<br>
                        A Visual Workplace Example</h2>
                    <p class="resource-description">
                        Using the relatable example of keeping a home bathroom clean, this resource illustrates how clear expectations, visual references, and concrete actionable steps can help create accountability and measurable progress. The framework demonstrated in this document translates directly to organizational settings where the same process helps teams achieve their goals more effectively.
                    </p>
                    <div class="resource-links">
                        <a href="assets/documents/OurBathroomGoals.pdf" target="_blank" rel="noopener noreferrer" class="resource-link">
                            <i class="fas fa-file-pdf"></i> Download Guide (PDF)
                        </a>
                    </div>
                </div>
            </div>

            <!-- Coming Soon Section -->
            <div class="coming-soon">
                <h3>More Resources Coming Soon</h3>
                <p>We're working on additional free tools and resources to help you transform your organization. Check back regularly for new assessments, templates, and guides.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
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
    </footer>

    <script>
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
    </script>
</body>

</html>
