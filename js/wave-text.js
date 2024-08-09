document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.wave-text-element');

    elements.forEach(element => {
        const chars = element.textContent.split('');
        element.innerHTML = '';
        chars.forEach(char => {
            const span = document.createElement('span');
            span.textContent = char;
            span.style.display = 'inline-block';
            element.appendChild(span);
        });

        const spans = element.querySelectorAll('span');
        const speed = parseFloat(element.getAttribute('data-speed')) || 1;

        gsap.fromTo(spans, {
            y: 0
        }, {
            y: -10,
            stagger: {
                each: 0.1,
                from: "start",
                repeat: -1,
                yoyo: true
            },
            ease: "power1.inOut",
            duration: speed
        });
    });
});
