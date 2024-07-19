document.addEventListener("DOMContentLoaded", function() {
    const target = document.querySelector(".gradient-follower");

    if (!target) return;

    const updateMousePosition = (ev) => {
        const { clientX, clientY } = ev;
        target.style.setProperty("--x", `${clientX}px`);
        target.style.setProperty("--y", `${clientY}px`);
    };

    window.addEventListener("mousemove", updateMousePosition);
});
