document.addEventListener('DOMContentLoaded', function() {
    const bouncingTexts = document.querySelectorAll('.bouncing-text');

    bouncingTexts.forEach(text => {
        const bounceHeight = text.parentElement.dataset.bounceHeight || 50;
        const bounceSpeed = text.parentElement.dataset.bounceSpeed || 0.5;
        const bounceRepeat = text.parentElement.dataset.bounceRepeat || -1;

        gsap.fromTo(text, 
            { y: -bounceHeight }, 
            {
                y: bounceHeight,
                duration: bounceSpeed,
                ease: 'bounce.inOut',
                repeat: bounceRepeat,
                yoyo: true
            }
        );
    });
});
