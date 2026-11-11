// Font Size Control
document.addEventListener('DOMContentLoaded', function() {
    const root = document.documentElement;
    const defaultFontSize = 16; // Default font size in pixels
    let currentFontSize = defaultFontSize;
    
    // Load saved font size from localStorage
    const savedFontSize = localStorage.getItem('fontSize');
    if (savedFontSize) {
        currentFontSize = parseInt(savedFontSize);
        updateFontSize();
    }
    
    // Increase font size
    document.getElementById('increaseFontBtn').addEventListener('click', function() {
        if (currentFontSize < 24) { // Max font size
            currentFontSize += 2;
            updateFontSize();
        }
    });
    
    // Decrease font size
    document.getElementById('decreaseFontBtn').addEventListener('click', function() {
        if (currentFontSize > 12) { // Min font size
            currentFontSize -= 2;
            updateFontSize();
        }
    });
    
    // Reset font size
    document.getElementById('resetFontBtn').addEventListener('click', function() {
        currentFontSize = defaultFontSize;
        updateFontSize();
    });
    
    function updateFontSize() {
        root.style.fontSize = currentFontSize + 'px';
        localStorage.setItem('fontSize', currentFontSize);
    }
});
