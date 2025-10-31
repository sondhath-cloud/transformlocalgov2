/**
 * Common Header Loader
 * Dynamically loads and injects the common header into pages
 * 
 * Usage: Add this script in the <head> or before closing </body>:
 * <script src="includes/load-header.js"></script>
 */

(function() {
    'use strict';

    // Configuration
    const headerFile = 'includes/header.html';
    const targetSelector = '#header-container'; // Where to inject header, or 'body' to insert before content
    
    /**
     * Load and inject header HTML
     */
    function loadHeader() {
        fetch(headerFile)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load header');
                }
                return response.text();
            })
            .then(html => {
                // Find insertion point
                let target = document.querySelector(targetSelector);
                
                if (target) {
                    // Insert into container
                    target.innerHTML = html;
                } else {
                    // If no container, insert at start of body
                    const body = document.body;
                    const div = document.createElement('div');
                    div.innerHTML = html;
                    const headerElement = div.firstElementChild;
                    if (headerElement) {
                        body.insertBefore(headerElement, body.firstChild);
                    }
                }
                
                // Initialize active state
                setActiveNavLink();
                
                // Load analytics tracker if not already loaded
                loadAnalyticsTracker();
            })
            .catch(error => {
                console.warn('Could not load common header:', error);
                // Fallback: just ensure analytics tracker is loaded
                loadAnalyticsTracker();
            });
    }
    
    /**
     * Set active nav link based on current page
     */
    function setActiveNavLink() {
        const currentPage = window.location.pathname.split('/').pop().replace('.html', '').replace('.php', '');
        const navLinks = document.querySelectorAll('.nav-link');
        
        const pageMap = {
            'index': 'home',
            'facilitation': 'facilitation',
            'digital-adoption': 'digital-adoption',
            'custom-tools': 'custom-tools',
            'services': 'services',
            'resources': 'resources',
            'about': 'about',
            'connect': 'connect'
        };
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href) {
                const linkPage = href.replace('.html', '').replace('.php', '').replace('index', 'home');
                const currentPageNormalized = pageMap[currentPage] || currentPage;
                
                if (linkPage === currentPageNormalized || 
                    (currentPage === 'index' && linkPage === '')) {
                    link.classList.add('active');
                }
            }
        });
    }
    
    /**
     * Ensure analytics tracker is loaded
     */
    function loadAnalyticsTracker() {
        // Check if already loaded
        if (document.querySelector('script[src*="analytics-tracker.js"]')) {
            return;
        }
        
        // Create and inject script
        const script = document.createElement('script');
        script.src = '/main/analytics-tracker.js';
        script.async = true;
        document.head.appendChild(script);
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadHeader);
    } else {
        loadHeader();
    }
    
})();

