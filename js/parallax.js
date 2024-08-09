document.addEventListener('DOMContentLoaded', function() {
    const parallaxElements = document.querySelectorAll('.parallax-wrapper');

    parallaxElements.forEach(element => {
        const speed = element.getAttribute('data-speed');
        window.addEventListener('scroll', function() {
            const offset = window.scrollY;
            element.querySelector('.parallax-element').style.transform = `translateY(${offset * speed / 100}px)`;
        });
    });
});
