/**
 * Analytics Tracker
 * Tracks page views and user interactions
 */

(function() {
    'use strict';

    // Configuration
    const config = {
        apiEndpoint: '/api/track-visitor.php',
        trackPageView: true,
        trackClicks: false, // Set to true to track link clicks
        trackScroll: false, // Set to true to track scroll depth
        debug: false // Set to true for debugging
    };

    /**
     * Log debug messages
     */
    function debug(message, data) {
        if (config.debug) {
            console.log('[Analytics]', message, data || '');
        }
    }

    /**
     * Get current page information
     */
    function getPageInfo() {
        return {
            url: window.location.href,
            path: window.location.pathname,
            title: document.title,
            referrer: document.referrer || '',
            timestamp: new Date().toISOString(),
            screenWidth: window.screen.width,
            screenHeight: window.screen.height,
            viewportWidth: window.innerWidth,
            viewportHeight: window.innerHeight
        };
    }

    /**
     * Send tracking data to server
     */
    function sendTracking(data) {
        if (!config.apiEndpoint) {
            debug('No API endpoint configured');
            return;
        }

        // Use fetch API if available, fallback to XHR
        if (window.fetch) {
            fetch(config.apiEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
                keepalive: true // Ensure request completes even if page unloads
            })
            .then(response => {
                if (response.ok) {
                    debug('Tracking sent successfully');
                } else {
                    debug('Tracking failed:', response.status);
                }
            })
            .catch(error => {
                debug('Tracking error:', error);
            });
        } else {
            // Fallback for older browsers
            const xhr = new XMLHttpRequest();
            xhr.open('POST', config.apiEndpoint, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        }
    }

    /**
     * Track page view
     */
    function trackPageView() {
        if (!config.trackPageView) {
            return;
        }

        const pageInfo = getPageInfo();
        
        debug('Tracking page view:', pageInfo);
        
        sendTracking({
            type: 'pageview',
            data: pageInfo
        });
    }

    /**
     * Track link clicks (optional)
     */
    function initClickTracking() {
        if (!config.trackClicks) {
            return;
        }

        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href) {
                sendTracking({
                    type: 'click',
                    data: {
                        url: link.href,
                        text: link.textContent.trim(),
                        timestamp: new Date().toISOString()
                    }
                });
            }
        });
    }

    /**
     * Track scroll depth (optional)
     */
    function initScrollTracking() {
        if (!config.trackScroll) {
            return;
        }

        let maxScroll = 0;
        const thresholds = [25, 50, 75, 100];
        const tracked = [];

        window.addEventListener('scroll', function() {
            const scrollPercent = Math.round(
                ((window.scrollY + window.innerHeight) / document.documentElement.scrollHeight) * 100
            );

            if (scrollPercent > maxScroll) {
                maxScroll = scrollPercent;
                
                // Track milestone thresholds
                thresholds.forEach(threshold => {
                    if (scrollPercent >= threshold && !tracked.includes(threshold)) {
                        tracked.push(threshold);
                        sendTracking({
                            type: 'scroll',
                            data: {
                                depth: threshold,
                                timestamp: new Date().toISOString()
                            }
                        });
                    }
                });
            }
        });
    }

    /**
     * Initialize analytics tracking
     */
    function init() {
        debug('Initializing analytics tracker');
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                trackPageView();
                initClickTracking();
                initScrollTracking();
            });
        } else {
            trackPageView();
            initClickTracking();
            initScrollTracking();
        }
    }

    // Start tracking
    init();

    // Expose config for external access if needed
    window.analyticsTracker = {
        config: config,
        track: sendTracking,
        trackPageView: trackPageView
    };

})();

