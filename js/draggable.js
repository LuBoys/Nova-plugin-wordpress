document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(Draggable);

    let draggableElements = document.querySelectorAll('.draggable-element');
    draggableElements.forEach(function(element) {
        Draggable.create(element, {
            type: "x,y",
            edgeResistance: 0.65,
            bounds: document.body, // Changez bounds pour document.body pour permettre le mouvement partout
            inertia: true
        });
    });
});
