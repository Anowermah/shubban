import './bootstrap';

// Import components
import FontSizeControl from './components/FontSizeControl';
import Carousel from './components/Carousel';
import ScrollToTop from './components/ScrollToTop';

// Initialize components when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize font size control
    new FontSizeControl();
    
    // Initialize carousel with touch support
    new Carousel();
    
    // Initialize scroll to top button
    new ScrollToTop();
});
