document.addEventListener('DOMContentLoaded', function() {
    const hoverElements = document.querySelectorAll('.hover-animate');

    hoverElements.forEach(element => {
        element.addEventListener('mouseover', function() {
            // Vous pouvez ajouter du GSAP ici si vous souhaitez une animation plus complexe
            gsap.to(element, { x: 10, duration: 0.3, color: '#FF6347' });
        });

        element.addEventListener('mouseout', function() {
            gsap.to(element, { x: 0, duration: 0.3, color: '#000' }); // Remettez la couleur originale ici
        });
    });
});
