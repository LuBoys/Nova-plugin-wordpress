document.addEventListener('DOMContentLoaded', function() {
    const cartes = document.querySelectorAll('.carte-3d-tournante .carte');

    cartes.forEach(carte => {
        gsap.from(carte, {
            duration: 1,
            opacity: 0,
            y: 100,
            ease: "power4.out",
            scrollTrigger: {
                trigger: carte,
                start: "top 80%",
                end: "bottom 20%",
                toggleActions: "play none none reverse"
            }
        });
    });
});
