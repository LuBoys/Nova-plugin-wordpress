document.addEventListener('DOMContentLoaded', function() {
    const glitchElements = document.querySelectorAll('.glitch-text');
    glitchElements.forEach((element, index) => {
        if (index !== 0) {
            element.style.display = 'none';
        }
    });

    let currentIndex = 0;
    const rotationSpeed = glitchElements[0].dataset.speed * 1000;

    setInterval(() => {
        const currentElement = glitchElements[currentIndex];
        currentElement.classList.add('glitch');
        
        setTimeout(() => {
            currentElement.style.display = 'none';
            currentElement.classList.remove('glitch');
            currentIndex = (currentIndex + 1) % glitchElements.length;
            const nextElement = glitchElements[currentIndex];
            nextElement.style.display = 'inline';
            nextElement.classList.add('glitch');

            setTimeout(() => {
                nextElement.classList.remove('glitch');
            }, 500); // Adjust this to match your glitch duration
        }, 500); // Adjust this to match your glitch duration
    }, rotationSpeed);
});
