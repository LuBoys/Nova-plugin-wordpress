document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && gsap.registerPlugin) {
        gsap.registerPlugin(Draggable);

        let draggableElements = document.querySelectorAll('.draggable-element');
        draggableElements.forEach(function(element) {
            Draggable.create(element, {
                type: "x,y",
                edgeResistance: 0.65,
                bounds: document.body, // Use document.body for unrestricted dragging
                inertia: true
            });
        });
    } else {
        console.error('GSAP is not defined or Draggable plugin is missing.');
    }
});
