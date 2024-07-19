document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    const galleryItems = document.querySelectorAll('.custom-gallery-item img');

    galleryItems.forEach((item, index) => {
        gsap.fromTo(item, 
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    scrub: true,
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });
});
