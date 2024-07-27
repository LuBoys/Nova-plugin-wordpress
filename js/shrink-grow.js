document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.shrink-grow');

    elements.forEach(element => {
        const speed = element.dataset.shrinkGrowSpeed || 2; // Default speed is 2 seconds
        gsap.fromTo(element, 
            { scale: 1 }, 
            { scale: 0.5, duration: parseFloat(speed), repeat: -1, yoyo: true, ease: 'power1.inOut' }
        );
    });
});
