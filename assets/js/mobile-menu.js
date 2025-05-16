/**
 * JavaScript cho menu mobile
 */
(function($) {
    "use strict";

    // Menu Mobile Toggle
    $('.mobile-menu-btn').on('click', function(e) {
        e.preventDefault();
        $('.mobile-menu-area').toggleClass('active');
        $('body').toggleClass('overflow-hidden');
    });

    // Close menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.mobile-menu-area, .mobile-menu-btn').length) {
            $('.mobile-menu-area').removeClass('active');
            $('body').removeClass('overflow-hidden');
        }
    });

    // Submenu toggle
    $('.mobile-menu-area .menu-overflow > li > a').on('click', function(e) {
        var $this = $(this);
        if ($this.next('ul').length) {
            e.preventDefault();
            $this.toggleClass('active');
            $this.next('ul').slideToggle(300);
        }
    });

    // Mobile product display
    function adjustForMobile() {
        if (window.innerWidth <= 576) {
            // Convert product grid to mobile view
            $('.shop-grid-area .row').addClass('mobile-product-grid');
            
            // Adjust product images
            $('.product-img img').css('max-height', '150px');
            
            // Adjust cart buttons
            $('.cart-buttons').addClass('mobile-cart-actions');
        } else {
            // Reset to desktop view
            $('.shop-grid-area .row').removeClass('mobile-product-grid');
            $('.product-img img').css('max-height', '');
            $('.cart-buttons').removeClass('mobile-cart-actions');
        }
    }

    // Run on page load
    adjustForMobile();
    
    // Run on window resize
    $(window).resize(function() {
        adjustForMobile();
    });

})(jQuery); 