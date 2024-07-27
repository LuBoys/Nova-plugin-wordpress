document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.slide-fade');

    elements.forEach(element => {
        gsap.to(element, {
            x: '100%',
            opacity: 0,
            duration: 2,
            repeat: -1,
            yoyo: true,
            ease: 'power1.inOut'
        });
    });
});
