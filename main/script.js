// Portfolio Website JavaScript
// Modern, interactive functionality with smooth animations

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initNavigation();
    initScrollAnimations();
    initContactForm();
    initSmoothScrolling();
    initParallaxEffects();
    initVideoModal();
    initSubscriptionForm();
});

// Navigation functionality
function initNavigation() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Check if elements exist before adding event listeners
    if (hamburger && navMenu) {
        // Mobile menu toggle
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
    });

    // Active navigation link highlighting
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('section[id]');
        const scrollPos = window.scrollY + 100;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            const navLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);

            if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                navLinks.forEach(link => link.classList.remove('active'));
                if (navLink) navLink.classList.add('active');
            }
        });
    });
}

// Scroll animations using Intersection Observer
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.about-card, .stat-item, .portfolio-item, .skill-category, .contact-card');
    animatedElements.forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });

    // Staggered animation for portfolio items
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    portfolioItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
    });
}



// Contact form functionality
function initContactForm() {
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) {
        // Get CSRF token on page load
        fetchCSRFToken();
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors and status
            clearFormErrors();
            clearFormStatus();
            
            // Get form data
            const formData = new FormData(this);
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            // Submit form to PHP
            fetch('api/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Success
                    this.reset();
                    showFormStatus(data.message, 'success');
                    showNotification(data.message, 'success');
                } else {
                    // Show errors
                    if (data.errors) {
                        showFormErrors(data.errors);
                    }
                    showFormStatus(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Form submission error:', error);
                showFormStatus('Sorry, there was an error sending your message. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });
    }
}

// Get CSRF token from server
function fetchCSRFToken() {
    fetch('api/contact.php')
        .then(response => response.json())
        .then(data => {
            if (data.csrf_token) {
                document.getElementById('csrf_token').value = data.csrf_token;
            }
        })
        .catch(error => {
            console.error('CSRF token fetch error:', error);
        });
}

// Show form errors
function showFormErrors(errors) {
    Object.keys(errors).forEach(field => {
        const errorElement = document.getElementById(`error-${field}`);
        if (errorElement) {
            errorElement.textContent = errors[field];
            errorElement.classList.add('show');
        }
    });
}

// Clear form errors
function clearFormErrors() {
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(element => {
        element.textContent = '';
        element.classList.remove('show');
    });
}

// Show form status message
function showFormStatus(message, type) {
    const statusElement = document.getElementById('form-status');
    if (statusElement) {
        statusElement.textContent = message;
        statusElement.className = `form-status ${type} show`;
    }
}

// Clear form status
function clearFormStatus() {
    const statusElement = document.getElementById('form-status');
    if (statusElement) {
        statusElement.textContent = '';
        statusElement.className = 'form-status';
    }
}

// Smooth scrolling for anchor links
function initSmoothScrolling() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 70; // Account for fixed navbar
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Parallax effects for hero section and floating cards
function initParallaxEffects() {
    const orbs = document.querySelectorAll('.gradient-orb');
    const floatingCards = document.querySelectorAll('.floating-card');
    
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        orbs.forEach((orb, index) => {
            const speed = (index + 1) * 0.1;
            orb.style.transform = `translateY(${rate * speed}px)`;
        });
        
        floatingCards.forEach((card, index) => {
            const speed = (index + 1) * 0.05;
            card.style.transform = `translateY(${rate * speed}px)`;
        });
        
    });
    
}

// Typing effect for hero title
function initTypingEffect() {
    const titleLines = document.querySelectorAll('.title-line');
    
    titleLines.forEach((line, index) => {
        const text = line.textContent;
        line.textContent = '';
        
        setTimeout(() => {
            typeText(line, text, 50);
        }, index * 200);
    });
}

function typeText(element, text, speed) {
    let i = 0;
    const timer = setInterval(() => {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
        } else {
            clearInterval(timer);
        }
    }, speed);
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Style the notification
    Object.assign(notification.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        padding: '15px 20px',
        borderRadius: '10px',
        color: 'white',
        fontWeight: '600',
        zIndex: '10000',
        transform: 'translateX(100%)',
        transition: 'transform 0.3s ease',
        background: type === 'success' ? 'linear-gradient(135deg, #00ff88, #00d4ff)' : 'linear-gradient(135deg, #ff6b9d, #ff8c42)'
    });
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Mouse cursor effects
function initCursorEffects() {
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    document.body.appendChild(cursor);
    
    // Style the cursor
    Object.assign(cursor.style, {
        position: 'fixed',
        width: '20px',
        height: '20px',
        borderRadius: '50%',
        background: 'linear-gradient(135deg, #00d4ff, #8b5cf6)',
        pointerEvents: 'none',
        zIndex: '9999',
        transition: 'transform 0.1s ease',
        opacity: '0.8'
    });
    
    document.addEventListener('mousemove', function(e) {
        cursor.style.left = e.clientX - 10 + 'px';
        cursor.style.top = e.clientY - 10 + 'px';
    });
    
    // Scale cursor on hover over interactive elements
    const interactiveElements = document.querySelectorAll('a, button, .portfolio-item');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.transform = 'scale(1.5)';
        });
        el.addEventListener('mouseleave', () => {
            cursor.style.transform = 'scale(1)';
        });
    });
}

// Initialize cursor effects (optional - can be enabled)
// initCursorEffects();




// Performance optimization: Throttle scroll events
function throttle(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Apply throttling to scroll events
window.addEventListener('scroll', throttle(function() {
    // Scroll-based animations and effects
}, 16)); // ~60fps

// Preload critical images
function preloadImages() {
    const imageUrls = [
        // Add any critical image URLs here
    ];
    
    imageUrls.forEach(url => {
        const img = new Image();
        img.src = url;
    });
}

// Initialize preloading
preloadImages();

// Error handling for failed animations
window.addEventListener('error', function(e) {
    console.warn('Animation error:', e.message);
});


// Console welcome message removed for production

// Subscription form functionality
function initSubscriptionForm() {
    const pricingButtons = document.querySelectorAll('[data-plan]');
    const subscriptionFormContainer = document.getElementById('subscription-form-container');
    const subscriptionForm = document.getElementById('subscription-form');
    const planTypeInput = document.getElementById('plan-type-input');
    const selectedPlanDisplay = document.getElementById('selected-plan-display');
    
    // Handle pricing button clicks
    pricingButtons.forEach(button => {
        button.addEventListener('click', function() {
            const planType = this.getAttribute('data-plan');
            const planName = planType === 'monthly' ? 'Monthly Plan ($29/month)' : 'Yearly Plan ($299/year)';
            
            // Set the plan type
            planTypeInput.value = planType;
            selectedPlanDisplay.textContent = `Selected: ${planName}`;
            
            // Show the subscription form
            subscriptionFormContainer.style.display = 'block';
            
            // Scroll to the form
            subscriptionFormContainer.scrollIntoView({ 
                behavior: 'smooth',
                block: 'center'
            });
        });
    });
    
    // Handle subscription form submission
    if (subscriptionForm) {
        subscriptionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors and status
            clearSubscriptionErrors();
            clearSubscriptionStatus();
            
            // Get form data
            const formData = new FormData(this);
            const name = formData.get('name');
            const email = formData.get('email');
            const planType = formData.get('plan_type');
            
            // Validate form
            if (!name || !email || !planType) {
                showSubscriptionStatus('Please fill in all required fields.', 'error');
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('#subscribe-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline';
            submitBtn.disabled = true;
            
            // Step 1: Create customer
            createCustomer(name, email)
                .then(customerData => {
                    if (customerData.success) {
                        // Step 2: Create subscription checkout session
                        return createSubscription(customerData.customer_id, planType);
                    } else {
                        throw new Error(customerData.message);
                    }
                })
                .then(subscriptionData => {
                    if (subscriptionData.success) {
                        // Redirect to Stripe checkout
                        window.location.href = subscriptionData.checkout_url;
                    } else {
                        throw new Error(subscriptionData.message);
                    }
                })
                .catch(error => {
                    console.error('Subscription error:', error);
                    showSubscriptionStatus('Sorry, there was an error processing your subscription. Please try again.', 'error');
                })
                .finally(() => {
                    // Reset button
                    btnText.style.display = 'inline';
                    btnLoading.style.display = 'none';
                    submitBtn.disabled = false;
                });
        });
    }
}

// Create customer in Stripe
function createCustomer(name, email) {
    return fetch('api/create-customer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            name: name,
            email: email
        })
    })
    .then(response => response.json())
    .catch(error => {
        console.error('Customer creation error:', error);
        return { success: false, message: 'Failed to create customer' };
    });
}

// Create subscription checkout session
function createSubscription(customerId, planType) {
    return fetch('api/create-subscription.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            customer_id: customerId,
            plan_type: planType
        })
    })
    .then(response => response.json())
    .catch(error => {
        console.error('Subscription creation error:', error);
        return { success: false, message: 'Failed to create subscription' };
    });
}

// Show subscription form errors
function showSubscriptionErrors(errors) {
    Object.keys(errors).forEach(field => {
        const errorElement = document.getElementById(`error-${field}-sub`);
        if (errorElement) {
            errorElement.textContent = errors[field];
            errorElement.classList.add('show');
        }
    });
}

// Clear subscription form errors
function clearSubscriptionErrors() {
    const errorElements = document.querySelectorAll('#subscription-form .error-message');
    errorElements.forEach(element => {
        element.textContent = '';
        element.classList.remove('show');
    });
}

// Show subscription form status message
function showSubscriptionStatus(message, type) {
    const statusElement = document.getElementById('subscription-status');
    if (statusElement) {
        statusElement.textContent = message;
        statusElement.className = `form-status ${type} show`;
    }
}

// Clear subscription form status
function clearSubscriptionStatus() {
    const statusElement = document.getElementById('subscription-status');
    if (statusElement) {
        statusElement.textContent = '';
        statusElement.className = 'form-status';
    }
}

// Video Modal Functions
function initVideoModal() {
    // Make functions globally available for onclick handlers
    window.openVideoModal = openVideoModal;
    window.closeVideoModal = closeVideoModal;
    
    // Close modal when clicking outside the video
    window.onclick = function(event) {
        const modal = document.getElementById('videoModal');
        if (event.target === modal) {
            closeVideoModal();
        }
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('videoModal');
            if (modal && modal.style.display === 'block') {
                closeVideoModal();
            }
        }
    });
}

function openVideoModal() {
    console.log('openVideoModal called');
    const modal = document.getElementById('videoModal');
    const video = document.getElementById('modalVideo');
    console.log('modal:', modal);
    console.log('video:', video);
    if (modal && video) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        video.play().catch(err => console.error('Video play error:', err));
    } else {
        console.error('Modal or video element not found');
    }
}

function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const video = document.getElementById('modalVideo');
    if (modal && video) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        video.pause();
        video.currentTime = 0;
    }
}

// Toggle OS Comparison function
function toggleOSComparison() {
    console.log('toggleOSComparison called'); // Debug log
    const comparison = document.getElementById('osComparison');
    const button = document.querySelector('.learn-more-btn');

    if (!comparison) {
        console.error('osComparison element not found');
        return;
    }

    const isVisible = comparison.style.display !== 'none';
    console.log('isVisible:', isVisible); // Debug log

    if (isVisible) {
        comparison.style.display = 'none';
        button.textContent = 'Learn More';
    } else {
        comparison.style.display = 'block';
        button.textContent = 'Show Less';
        // Initialize the comparison slider
        initializeComparisonSlider();
        // Animate the slider to show it's interactive
        setTimeout(() => animateSliderWiggle(), 300);
    }
}

// Variable to track if animation should stop
let stopAnimation = false;
let animationTimeout = null;

// Animate slider to show it's interactive
function animateSliderWiggle() {
    const range = document.getElementById('osRange');
    if (!range) return;
      
    stopAnimation = false;
      
    // Create smooth animation with 1% increments starting at 35
    const positions = [];
    // Start at 35, move to 41
    for (let i = 35; i <= 41; i++) positions.push(i);
    // Move back to 29
    for (let i = 40; i >= 29; i--) positions.push(i);
    // Move to 39
    for (let i = 30; i <= 39; i++) positions.push(i);
    // Move to 31
    for (let i = 38; i >= 31; i--) positions.push(i);
    // Return to 35
    for (let i = 32; i <= 35; i++) positions.push(i);

    const duration = 40; // milliseconds between each 1% step
      
    let currentStep = 0;
      
    const animate = () => {
        if (stopAnimation) {
            return; // Stop the animation if user interacted
        }
          
        const position = positions[currentStep];
        range.value = position;
        document.body.style.setProperty('--pos', position + '%');
        currentStep++;
          
        // Continue animation until complete, then stop (no loop)
        if (currentStep < positions.length) {
            animationTimeout = setTimeout(animate, duration);
        }
    };
      
    animate();
}

// Initialize comparison slider
function initializeComparisonSlider() {
    console.log('initializeComparisonSlider called'); // Debug log
    const range = document.getElementById('osRange');
    if (range) {
        // Stop animation when user starts interacting
        range.addEventListener('mousedown', () => {
            stopAnimation = true;
            if (animationTimeout) {
                clearTimeout(animationTimeout);
            }
        });
          
        range.addEventListener('touchstart', () => {
            stopAnimation = true;
            if (animationTimeout) {
                clearTimeout(animationTimeout);
            }
        });
          
        range.oninput = () => {
            document.body.style.setProperty('--pos', range.value + '%');
        };
          
        // Set initial position
        range.value = 35;
        document.body.style.setProperty('--pos', '35%');
        console.log('Slider initialized with position 35%'); // Debug log
    } else {
        console.error('osRange element not found');
    }
}

// Export functions for potential external use
window.PortfolioWebsite = {
    showNotification,
    initScrollAnimations,
    initSubscriptionForm,
    openVideoModal,
    closeVideoModal,
    toggleOSComparison,
    initializeComparisonSlider,
    animateSliderWiggle
};
