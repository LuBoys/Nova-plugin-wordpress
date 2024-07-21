document.addEventListener("DOMContentLoaded", function() {
    const text = document.querySelector('.bouncing-text');
    if (text) {
        const bounceHeight = text.getAttribute('data-bounce-height');
        const bounceSpeed = text.getAttribute('data-bounce-speed');
        gsap.to(text, {
            y: -bounceHeight,
            duration: bounceSpeed,
            repeat: -1,
            yoyo: true,
            ease: "bounce.out"
        });
    }
});
