document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.glitch-text-element');

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
        gsap.fromTo(spans, {
            opacity: 1,
            x: 0,
            y: 0,
            skewX: 0,
            skewY: 0,
        }, {
            opacity: 0,
            x: () => gsap.utils.random(-20, 20),
            y: () => gsap.utils.random(-20, 20),
            skewX: () => gsap.utils.random(-10, 10),
            skewY: () => gsap.utils.random(-10, 10),
            duration: 0.1,
            ease: 'none',
            stagger: 0.02,
            repeat: -1,
            yoyo: true,
            repeatDelay: 0.5,
        });
    });
});
