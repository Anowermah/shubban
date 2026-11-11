document.addEventListener('DOMContentLoaded', function() {
    // View switching functionality
    const viewButtons = document.querySelectorAll('.view-options button');
    const galleryGrid = document.querySelector('.photo-grid') || document.querySelector('.video-grid');

    if (viewButtons.length && galleryGrid) {
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const view = this.getAttribute('data-view');
                
                // Update active state
                viewButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Update grid layout
                if (view === 'list') {
                    galleryGrid.classList.add('list-view');
                } else {
                    galleryGrid.classList.remove('list-view');
                }
            });
        });
    }

    // Filter functionality
    const filterForm = document.querySelector('.filter-section');
    const filterButton = filterForm?.querySelector('button');
    const loadingOverlay = document.createElement('div');
    loadingOverlay.className = 'loading-overlay';
    loadingOverlay.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';
    document.body.appendChild(loadingOverlay);

    if (filterButton) {
        filterButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show loading overlay
            loadingOverlay.style.display = 'flex';
            
            // Simulate filter request
            setTimeout(() => {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';
                
                // Show success message
                const toast = document.createElement('div');
                toast.className = 'toast align-items-center text-white bg-success border-0';
                toast.setAttribute('role', 'alert');
                toast.setAttribute('aria-live', 'assertive');
                toast.setAttribute('aria-atomic', 'true');
                toast.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">
                            ফিল্টার সফলভাবে প্রয়োগ করা হয়েছে
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                `;
                document.body.appendChild(toast);
                
                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();
                
                // Remove toast after it's hidden
                toast.addEventListener('hidden.bs.toast', function() {
                    document.body.removeChild(toast);
                });
            }, 1000);
        });
    }

    // Photo modal functionality
    const photoItems = document.querySelectorAll('.photo-item');
    let currentPhotoIndex = 0;
    const modalHtml = `
        <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-0">
                        <img src="" class="img-fluid" alt="Photo">
                        <div class="navigation-buttons">
                            <button class="btn btn-light rounded-circle prev-photo">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-light rounded-circle next-photo">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <div class="photo-info">
                            <h5 class="photo-title mb-2"></h5>
                            <p class="photo-date text-muted mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', modalHtml);

    const photoModal = document.getElementById('photoModal');
    const bsPhotoModal = new bootstrap.Modal(photoModal);
    const modalImage = photoModal.querySelector('.modal-body img');
    const modalTitle = photoModal.querySelector('.photo-title');
    const modalDate = photoModal.querySelector('.photo-date');
    const prevButton = photoModal.querySelector('.prev-photo');
    const nextButton = photoModal.querySelector('.next-photo');

    function updateModalContent(index) {
        const photo = photoItems[index];
        modalImage.src = photo.querySelector('img').src;
        modalTitle.textContent = photo.querySelector('.photo-title')?.textContent || '';
        modalDate.textContent = photo.querySelector('.photo-date')?.textContent || '';
        
        // Update navigation buttons
        prevButton.style.display = index === 0 ? 'none' : 'block';
        nextButton.style.display = index === photoItems.length - 1 ? 'none' : 'block';
    }

    photoItems.forEach((item, index) => {
        const expandButton = item.querySelector('.expand-btn');
        if (expandButton) {
            expandButton.addEventListener('click', function(e) {
                e.preventDefault();
                currentPhotoIndex = index;
                updateModalContent(currentPhotoIndex);
                bsPhotoModal.show();
            });
        }
    });

    prevButton.addEventListener('click', function() {
        if (currentPhotoIndex > 0) {
            currentPhotoIndex--;
            updateModalContent(currentPhotoIndex);
        }
    });

    nextButton.addEventListener('click', function() {
        if (currentPhotoIndex < photoItems.length - 1) {
            currentPhotoIndex++;
            updateModalContent(currentPhotoIndex);
        }
    });

    // Video playlist functionality
    const playlistItems = document.querySelectorAll('.playlist-item');
    const videoPlayer = document.querySelector('.video-wrapper iframe');

    playlistItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            playlistItems.forEach(i => i.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Update video player (in real implementation, you would update the video source)
            if (videoPlayer) {
                // Simulate video change
                videoPlayer.style.opacity = '0.5';
                setTimeout(() => {
                    videoPlayer.style.opacity = '1';
                }, 500);
            }
        });
    });

    // Add necessary styles
    const styles = `
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .list-view .row {
            flex-direction: column;
        }

        .list-view .col-lg-3 {
            width: 100%;
            max-width: 100%;
        }

        .list-view .photo-item,
        .list-view .video-item {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .list-view .photo-item img,
        .list-view .video-thumbnail {
            width: 200px;
            flex-shrink: 0;
        }

        .list-view .video-info {
            flex-grow: 1;
        }

        .modal-body {
            position: relative;
        }

        .navigation-buttons {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .navigation-buttons button {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            transition: all 0.3s ease;
        }

        .navigation-buttons button:hover {
            background: white;
            transform: scale(1.1);
        }

        .photo-info {
            text-align: center;
            width: 100%;
        }

        #photoModal .modal-content {
            background-color: rgba(255, 255, 255, 0.95);
        }

        #photoModal .modal-body {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.03);
        }
    `;

    const styleSheet = document.createElement('style');
    styleSheet.textContent = styles;
    document.head.appendChild(styleSheet);
});
