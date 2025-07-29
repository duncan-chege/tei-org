// Main JavaScript entry point for Vite
import "./input.css";

console.log('Theme loaded');

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

  // Add loading state to forms
  const forms = document.querySelectorAll("form");
  forms.forEach((form) => {
    form.addEventListener("submit", function () {
      const submitBtn = this.querySelector(
        'input[type="submit"], button[type="submit"]'
      );
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = "Loading...";
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

// Utility functions
window.ThemeUtils = {
  // Debounce function for performance
  debounce: function (func, wait, immediate) {
    let timeout;
    return function executedFunction() {
      const context = this;
      const args = arguments;
      const later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      const callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  },

  // Simple fade in animation
  fadeIn: function (element, duration = 300) {
    element.style.opacity = "0";
    element.style.display = "block";

    const start = performance.now();

    function fade(currentTime) {
      const elapsed = currentTime - start;
      const progress = elapsed / duration;

      if (progress < 1) {
        element.style.opacity = progress;
        requestAnimationFrame(fade);
      } else {
        element.style.opacity = "1";
      }
    }

    requestAnimationFrame(fade);
  },
};

// Enable hot reload in development
if (import.meta.hot) {
  import.meta.hot.accept();
}
