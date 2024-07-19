document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(Draggable);

    let draggableElements = document.querySelectorAll('.draggable-element');
    draggableElements.forEach(function(element) {
        Draggable.create(element, {
            type: "x,y",
            edgeResistance: 0.65,
            bounds: element.parentNode, // Utilise le parent immédiat comme limite
            inertia: true
        });
    });
});
