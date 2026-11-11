export default class ScrollToTop {
    constructor() {
        this.button = document.getElementById('scrollToTop');
        if (this.button) {
            this.initializeEventListeners();
        }
    }
    
    initializeEventListeners() {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                this.button.classList.add('show');
            } else {
                this.button.classList.remove('show');
            }
        });
        
        // Scroll to top when clicked
        this.button.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}
