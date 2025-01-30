import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Wait for DOM content to be loaded before applying event listener
document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.getElementById('hamburger');
    const mobileNavDrawer = document.getElementById('mobile-nav-drawer');
    const closeDrawer = document.getElementById('close-drawer');

    if (hamburger && mobileNavDrawer && closeDrawer) {
        // Open the drawer when the hamburger icon is clicked
        hamburger.addEventListener('click', function() {
            mobileNavDrawer.classList.remove('-translate-x-full');  // Slide in
        });

        // Close the drawer when the close button is clicked
        closeDrawer.addEventListener('click', function() {
            mobileNavDrawer.classList.add('-translate-x-full');  // Slide out
        });
    }
});
