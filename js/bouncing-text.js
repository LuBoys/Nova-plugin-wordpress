document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('.bouncing-text-container');
    containers.forEach(container => {
        const text = container.querySelector('.bouncing-text');
        const bounceHeight = container.getAttribute('data-bounce-height');
        const bounceSpeed = container.getAttribute('data-bounce-speed');
        gsap.to(text, {
            y: -bounceHeight,
            duration: parseFloat(bounceSpeed),
            repeat: -1,
            yoyo: true,
            ease: "bounce.out"
        });
    });
});
