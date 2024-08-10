document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.scroll-reveal');

    elements.forEach(element => {
        gsap.fromTo(element, 
            { opacity: 0, y: 100 }, 
            { 
                opacity: 1, 
                y: 0, 
                duration: 1.5, 
                scrollTrigger: {
                    trigger: element,
                    start: 'top 90%',
                    end: 'bottom 10%',
                    toggleActions: 'play none none reset',
                    markers: false
                }
            }
        );
    });
});
