export default class Carousel {
    constructor() {
        this.initializeCarousel();
    }
    
    initializeCarousel() {
        // Initialize Bootstrap Carousel
        const carousel = document.querySelector('.carousel');
        if (carousel) {
            // Add swipe support for touch devices
            let touchStartX = 0;
            let touchEndX = 0;
            
            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, false);
            
            carousel.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe();
            }, false);
            
            // Handle swipe
            this.handleSwipe = () => {
                const swipeThreshold = 50;
                const swipeLength = touchEndX - touchStartX;
                
                if (Math.abs(swipeLength) > swipeThreshold) {
                    if (swipeLength > 0) {
                        // Swipe right - show previous
                        carousel.querySelector('.carousel-control-prev').click();
                    } else {
                        // Swipe left - show next
                        carousel.querySelector('.carousel-control-next').click();
                    }
                }
            };
        }
    }
}
