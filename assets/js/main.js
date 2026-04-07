// ========================================
// MAIN JAVASCRIPT - SMKN 1 Garut Website
// ========================================

// Dark Mode Toggle
document.addEventListener('DOMContentLoaded', function() {
    // Initialize dark mode
    const darkModeToggle = document.getElementById('darkModeToggle');
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        updateDarkModeIcon();
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('dark-mode');
            const isNowDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isNowDark);
            updateDarkModeIcon();
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                const target = document.querySelector(href);
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Active navbar link
    updateActiveNavLink();
    window.addEventListener('scroll', updateActiveNavLink);

    // Fade in animations
    observeElements();
});

// Update dark mode icon
function updateDarkModeIcon() {
    const icon = document.querySelector('#darkModeToggle i');
    if (icon) {
        if (document.body.classList.contains('dark-mode')) {
            icon.classList.remove('bi-moon');
            icon.classList.add('bi-sun');
        } else {
            icon.classList.remove('bi-sun');
            icon.classList.add('bi-moon');
        }
    }
}

// Update active navbar link
function updateActiveNavLink() {
    const navLinks = document.querySelectorAll('.nav-link');
    const currentPath = window.location.pathname.split('/').pop() || 'index.php';

    navLinks.forEach(link => {
        const href = link.getAttribute('href').split('/').pop();
        if (href === currentPath) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

// Intersection Observer for fade-in animations
function observeElements() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeIn 0.6s ease forwards';
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.card, section').forEach(el => {
        observer.observe(el);
    });
}

// Show toast notification
function showToast(message, type = 'info') {
    const toastContainer = document.createElement('div');
    toastContainer.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        animation: slideIn 0.3s ease;
    `;
    
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} alert-dismissible fade show`;
    toast.style.cssText = `
        min-width: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    `;
    
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    toastContainer.appendChild(toast);
    document.body.appendChild(toastContainer);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toastContainer.remove(), 300);
    }, 3000);
}

// Validate email
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Format date
function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(date).toLocaleDateString('id-ID', options);
}

// Debounce function for search
function debounce(func, wait) {
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

// Search functionality for majors page
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('keyup', debounce(function() {
        const searchTerm = this.value.toLowerCase();
        const cards = document.querySelectorAll('.jurusan-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.dataset.name;
            if (name.includes(searchTerm)) {
                card.style.display = 'block';
                card.style.animation = 'slideUp 0.3s ease';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        const noResults = document.getElementById('noResults');
        if (noResults) {
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }, 300));
}

// Handle form character limit
const forumMessage = document.getElementById('forumMessage');
if (forumMessage) {
    forumMessage.addEventListener('input', function() {
        const charCount = document.getElementById('charCount');
        if (charCount) {
            charCount.textContent = this.value.length;
        }
    });
}

// Lazy load images
function lazyLoadImages() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// Initialize on load
window.addEventListener('load', function() {
    lazyLoadImages();
});

// Handle loading state for forms
function handleFormSubmit(formId, submitButtonSelector = 'button[type="submit"]') {
    const form = document.getElementById(formId);
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector(submitButtonSelector);
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';
            }
        });
    }
}

// Scroll to top button
function createScrollToTopButton() {
    const button = document.createElement('button');
    button.id = 'scrollToTop';
    button.innerHTML = '<i class="bi bi-arrow-up"></i>';
    button.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #0d6efd;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        display: none;
        z-index: 999;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    `;

    document.body.appendChild(button);

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    });

    button.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    button.addEventListener('mouseover', function() {
        this.style.backgroundColor = '#0055cc';
        this.style.transform = 'scale(1.1)';
    });

    button.addEventListener('mouseout', function() {
        this.style.backgroundColor = '#0d6efd';
        this.style.transform = 'scale(1)';
    });
}

// Initialize scroll to top button
document.addEventListener('DOMContentLoaded', function() {
    createScrollToTopButton();
});

// Export functions for use in other scripts
window.AppUtils = {
    showToast,
    isValidEmail,
    formatDate,
    debounce,
    handleFormSubmit,
    lazyLoadImages
};
