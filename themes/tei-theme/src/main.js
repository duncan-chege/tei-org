// Main JavaScript entry point for Vite
import "./input.css";
import { CountUp } from "countup.js";

// Import your theme JavaScript
document.addEventListener("DOMContentLoaded", function () {
  // Mobile menu functionality
  const mobileToggle = document.getElementById("mobile-menu-toggle");
  const mobileMenu = document.getElementById("mobile-menu");

  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener("click", function () {
      mobileMenu.classList.toggle("hidden");

      // Toggle aria-expanded for accessibility
      const isExpanded = mobileToggle.getAttribute("aria-expanded") === "true";
      mobileToggle.setAttribute("aria-expanded", !isExpanded);
    });
  }

  // Smooth scrolling for anchor links
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  anchorLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href");
      const targetElement = document.querySelector(targetId);

      if (targetElement) {
        e.preventDefault();
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });

  // Lazy loading for images (if not using WordPress native lazy loading)
  if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute("data-src");
            observer.unobserve(img);
          }
        }
      });
    });

    const lazyImages = document.querySelectorAll("img[data-src]");
    lazyImages.forEach((img) => imageObserver.observe(img));
  }
});

// CountUp initialization function
function initCounters() {
  const counters = [
    { id: "counter-binders", endVal: 300 },
    { id: "counter-shelter", endVal: 1 },
    { id: "counter-supported", endVal: 100 },
    { id: "counter-volunteers", endVal: 5 },
  ];

  // Create intersection observer for animation on scroll
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const counter = counters.find((c) => c.id === entry.target.id);
          if (counter) {
            const countUp = new CountUp(counter.id, counter.endVal, {
              duration: 2.5,
              separator: ",",
              suffix: counter.id === "counter-supported" ? "+" : "", // Add + for "100+"
            });

            if (!countUp.error) {
              countUp.start();
            }

            observer.unobserve(entry.target);
          }
        }
      });
    },
    {
      threshold: 0.3, // Trigger when 30% visible
      rootMargin: "0px 0px -50px 0px", // Start animation a bit before fully visible
    }
  );

  // Observe all counter elements
  counters.forEach((counter) => {
    const element = document.getElementById(counter.id);
    if (element) {
      observer.observe(element);
    }
  });
}

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", initCounters);

// Enable hot reload in development
if (import.meta.hot) {
  import.meta.hot.accept();
}

// Fallback for YouTube embeds if PHP solution fails
// Enhanced fallback for project pages
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on a project page
    const isProjectPage = document.body.classList.contains('post-type-project');
    
    // Target both regular content and potential ACF fields
    const containers = isProjectPage ? [
        document.querySelector('.entry-content'),
        document.querySelector('.project-content'),
        document.querySelector('.acf-field-wysiwyg')
    ].filter(Boolean) : [document];
    
    containers.forEach(container => {
        const youtubeEmbeds = container.querySelectorAll ? 
            container.querySelectorAll('.wp-block-embed-youtube .wp-block-embed__wrapper') : [];
        
        youtubeEmbeds.forEach(wrapper => {
            if (wrapper.querySelector('iframe')) return;
            
            const url = wrapper.textContent.trim();
            const videoIdMatch = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/))([a-zA-Z0-9_-]{11})/);
            
            if (videoIdMatch && videoIdMatch[1]) {
                const iframe = document.createElement('iframe');
                iframe.setAttribute('loading', 'lazy');
                iframe.setAttribute('width', '100%');
                iframe.setAttribute('height', '315');
                iframe.setAttribute('src', `https://www.youtube.com/embed/${videoIdMatch[1]}?rel=0`);
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allowfullscreen', '');
                iframe.style.minHeight = '315px';
                
                wrapper.innerHTML = '';
                wrapper.appendChild(iframe);
            }
        });
    });
});
