document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    const splitTexts = document.querySelectorAll('.split-text');

    splitTexts.forEach(text => {
        gsap.fromTo(text.querySelectorAll('.char'), 
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                stagger: 0.05,
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
