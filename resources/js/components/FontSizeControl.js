export default class FontSizeControl {
    constructor() {
        this.root = document.documentElement;
        this.defaultFontSize = 16;
        this.currentFontSize = this.defaultFontSize;
        
        // Load saved font size
        const savedFontSize = localStorage.getItem('fontSize');
        if (savedFontSize) {
            this.currentFontSize = parseInt(savedFontSize);
            this.updateFontSize();
        }
        
        this.initializeEventListeners();
    }
    
    initializeEventListeners() {
        // Increase font size
        document.getElementById('increaseFontBtn')?.addEventListener('click', () => {
            if (this.currentFontSize < 24) {
                this.currentFontSize += 2;
                this.updateFontSize();
            }
        });
        
        // Decrease font size
        document.getElementById('decreaseFontBtn')?.addEventListener('click', () => {
            if (this.currentFontSize > 12) {
                this.currentFontSize -= 2;
                this.updateFontSize();
            }
        });
        
        // Reset font size
        document.getElementById('resetFontBtn')?.addEventListener('click', () => {
            this.currentFontSize = this.defaultFontSize;
            this.updateFontSize();
        });
    }
    
    updateFontSize() {
        this.root.style.fontSize = `${this.currentFontSize}px`;
        localStorage.setItem('fontSize', this.currentFontSize);
    }
}
