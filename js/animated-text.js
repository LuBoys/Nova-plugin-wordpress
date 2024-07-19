document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    const animatedTexts = document.querySelectorAll('.animated-text');

    animatedTexts.forEach((text, index) => {
        gsap.fromTo(text, 
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: text,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    scrub: true,
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });
});
