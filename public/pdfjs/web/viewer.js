// PDF.js viewer initialization
window.onload = function() {
    pdfjsLib.GlobalWorkerOptions.workerSrc = '/pdfjs/build/pdf.worker.min.js';

    const urlParams = new URLSearchParams(window.location.search);
    const pdfUrl = urlParams.get('file');

    if (!pdfUrl) {
        alert('No PDF file specified');
        return;
    }

    const container = document.getElementById('viewerContainer');
    const viewer = document.getElementById('viewer');

    // Load the PDF
    pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
        console.log('PDF loaded');

        // Load first page
        pdf.getPage(1).then(function(page) {
            const scale = 1.5;
            const viewport = page.getViewport({ scale: scale });

            // Prepare canvas using PDF page dimensions
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            page.render(renderContext).promise.then(function() {
                console.log('Page rendered');
                viewer.appendChild(canvas);
            });
        });
    }).catch(function(error) {
        console.error('Error loading PDF:', error);
    });
};
