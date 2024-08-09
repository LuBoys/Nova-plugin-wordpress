document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.scroll-animation-text');

    elements.forEach(element => {
        const speed = element.getAttribute('data-speed') || 1.5;
        gsap.fromTo(element, 
            {
                opacity: 0,
                y: 50
            },
            {
                opacity: 1,
                y: 0,
                duration: speed,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });
});
