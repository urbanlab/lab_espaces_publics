/**
 * View script for the block.
 *
 * This file handles any client-side functionality needed for the block
 * on the frontend of the site.
 */

(function() {
    // Select all instances of this block on the page
    const blocks = document.querySelectorAll('.wp-block-vendor-carousel');

    // Function to initialize a block
    function initBlock(block) {
      // Example: Add click event listener
        document.addEventListener('DOMContentLoaded', () => {
            const carousels = document.querySelectorAll('.swiper-container');

            setTimeout(() => {
                carousels.forEach((carousel) => {
                    const columns =
                        carousel.getAttribute('data-columns') ||
                        SWIPER_DEFAULT_OPTIONS.slidesPerView;

                    new Swiper(carousel, {
                        slidesPerView: columns,
                        autoplay: SWIPER_DEFAULT_OPTIONS.autoplay,
                        breakpoints: {
                            640: {
                                slidesPerView: SWIPER_DEFAULT_OPTIONS.slidesPerView,
                                spaceBetween: 10,
                            },
                            1024: {
                                slidesPerView: columns,
                                spaceBetween: 15,
                            },
                            1440: {
                                slidesPerView: columns,
                                spaceBetween: 20,
                            },
                        },
                        speed: 400,
                        pagination: {
                            el: SWIPER_DEFAULT_OPTIONS.paginationEl,
                            clickable: true,
                            dynamicBullets: true,
                            dynamicMainBullets: 3,
                        },
                        navigation: {
                            nextEl: SWIPER_DEFAULT_OPTIONS.nextEl,
                            prevEl: SWIPER_DEFAULT_OPTIONS.prevEl,
                        },
                        centeredSlides: SWIPER_DEFAULT_OPTIONS.centeredSlides,
                    });
                }, 100);
            });
        });
    }

    // Initialize each block found
    if (blocks.length) {
      blocks.forEach(function(block) {
        initBlock(block);
      });
    }
  })();
