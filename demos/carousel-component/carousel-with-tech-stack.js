/**
 * Enhanced Responsive Image Carousel Component with Tech Stack Support
 * Supports tech stack badges and comprehensive project information
 */

class ResponsiveCarousel {
  constructor(containerId, options = {}) {
    this.container = document.getElementById(containerId);
    if (!this.container) {
      console.error(`Carousel container with id "${containerId}" not found`);
      return;
    }
    
    this.slider = this.container.querySelector('.carousel-slider');
    this.options = {
      autoPlay: options.autoPlay || false,
      autoPlayInterval: options.autoPlayInterval || 5000,
      ...options
    };
    
    this.init();
  }
  
  init() {
    // Wait for DOM to be ready
    setTimeout(() => {
      // Look for ALL nav buttons inside the carousel content
      const prevBtns = this.container.querySelectorAll('.carousel-btn.prev');
      const nextBtns = this.container.querySelectorAll('.carousel-btn.next');
      
      console.log('Carousel buttons found:', { prevBtns: prevBtns.length, nextBtns: nextBtns.length });
      
      // Set initial active item
      this.setActiveItem(0);
      
      // Attach event listeners to all prev buttons
      prevBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          console.log('Prev button clicked');
          this.prev();
        });
      });
      
      // Attach event listeners to all next buttons
      nextBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          console.log('Next button clicked');
          this.next();
        });
      });
      
      document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') this.prev();
        if (e.key === 'ArrowRight') this.next();
      });
      
      if (this.options.autoPlay) {
        this.startAutoPlay();
      }
    }, 100);
  }
  
  setActiveItem(index) {
    const items = this.slider.querySelectorAll('.carousel-item');
    items.forEach((item, i) => {
      if (i === index) {
        item.classList.add('active');
      } else {
        item.classList.remove('active');
      }
    });
  }
  
  getCurrentIndex() {
    const items = this.slider.querySelectorAll('.carousel-item');
    for (let i = 0; i < items.length; i++) {
      if (items[i].classList.contains('active')) {
        return i;
      }
    }
    return 0;
  }
  
  next() {
    const items = this.slider.querySelectorAll('.carousel-item');
    const currentIndex = this.getCurrentIndex();
    const nextIndex = (currentIndex + 1) % items.length;
    this.setActiveItem(nextIndex);
  }
  
  prev() {
    const items = this.slider.querySelectorAll('.carousel-item');
    const currentIndex = this.getCurrentIndex();
    const prevIndex = currentIndex === 0 ? items.length - 1 : currentIndex - 1;
    this.setActiveItem(prevIndex);
  }
  
  startAutoPlay() {
    this.autoPlayTimer = setInterval(() => {
      this.next();
    }, this.options.autoPlayInterval);
    
    this.container.addEventListener('mouseenter', () => this.pauseAutoPlay());
    this.container.addEventListener('mouseleave', () => this.resumeAutoPlay());
  }
  
  pauseAutoPlay() {
    if (this.autoPlayTimer) {
      clearInterval(this.autoPlayTimer);
    }
  }
  
  resumeAutoPlay() {
    if (this.options.autoPlay) {
      this.startAutoPlay();
    }
  }
  
  destroy() {
    this.pauseAutoPlay();
  }
}

// Helper function to create tech stack pills
function createTechStackHTML(techStack) {
  if (!techStack || techStack.length === 0) return '';
  
  return `
    <div class="carousel-tech-stack">
      ${techStack.map(tech => {
        const techClass = tech.toLowerCase().replace(/\s+/g, '').replace(/\./g, '');
        return `<span class="tech-pill ${techClass}">${tech}</span>`;
      }).join('')}
    </div>
  `;
}

// Enhanced function to create carousel from data with tech stack support
function createCarousel(containerId, items, options = {}) {
  const container = document.getElementById(containerId);
  if (!container) {
    console.error(`Container with id "${containerId}" not found`);
    return null;
  }
  
  const html = `
    <ul class="carousel-slider">
      ${items.map(item => `
        <li class="carousel-item" style="background-image: url('${item.image}')">
          <div class="carousel-content">
            <nav class="carousel-nav">
              <button class="carousel-btn prev" aria-label="Previous slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
              </button>
              <button class="carousel-btn next" aria-label="Next slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
              </button>
            </nav>
            <h2 class="carousel-title">${item.title}</h2>
            <p class="carousel-description">${item.description}</p>
            ${item.techStack ? createTechStackHTML(item.techStack) : ''}
            ${item.buttonText ? `<button class="carousel-button" onclick="${item.buttonAction || ''}">${item.buttonText}</button>` : ''}
          </div>
        </li>
      `).join('')}
    </ul>
  `;
  
  container.innerHTML = html;
  
  return new ResponsiveCarousel(containerId, options);
}

