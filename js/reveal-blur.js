document.addEventListener('DOMContentLoaded', function() {
    const revealBlurElements = document.querySelectorAll('.reveal-blur-text');

    revealBlurElements.forEach(element => {
        const blurAmount = element.getAttribute('data-blur-amount') || 10;

        gsap.fromTo(element, 
            { opacity: 0, filter: `blur(${blurAmount}px)` },
            {
                opacity: 1,
                filter: 'blur(0px)',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    scrub: true,
                }
            }
        );
    });
});
