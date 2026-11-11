document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.createElement('button');
    mobileMenuButton.className = 'mobile-menu-toggle';
    mobileMenuButton.innerHTML = '<i class="fas fa-bars"></i>';
    document.querySelector('.main-nav .container').prepend(mobileMenuButton);

    mobileMenuButton.addEventListener('click', function() {
        document.querySelector('.nav-menu').classList.toggle('active');
        this.classList.toggle('active');
    });

    // Add mobile class to nav menu for responsive design
    const navMenu = document.querySelector('.nav-menu');
    if (window.innerWidth <= 768) {
        navMenu.classList.add('mobile');
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 768) {
            navMenu.classList.add('mobile');
        } else {
            navMenu.classList.remove('mobile');
            navMenu.classList.remove('active');
            mobileMenuButton.classList.remove('active');
        }
    });

    // Handle mobile dropdown toggles
    if (window.innerWidth <= 768) {
        const menuItems = document.querySelectorAll('.nav-menu > li');
        menuItems.forEach(item => {
            if (item.querySelector('.dropdown-menu')) {
                item.addEventListener('click', function(e) {
                    if (e.target.tagName === 'A' && e.target.nextElementSibling) {
                        e.preventDefault();
                        const dropdown = this.querySelector('.dropdown-menu');
                        const isOpen = dropdown.style.display === 'block';
                        
                        // Close all other dropdowns
                        document.querySelectorAll('.nav-menu .dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });

                        // Toggle current dropdown
                        dropdown.style.display = isOpen ? 'none' : 'block';
                    }
                });
            }
        });
    }
});
