// Header

document.addEventListener("DOMContentLoaded", () => {
    const header = document.querySelector(".site-header");
    const toggle = document.querySelector(".mobile-toggle");

    if (!toggle || !header) {
        console.log("burger elements not found");
        return;
    }

    toggle.addEventListener("click", () => {
        header.classList.toggle("open");  // Меняем класс, который откроет меню
        console.log("burger clicked");
    });
});