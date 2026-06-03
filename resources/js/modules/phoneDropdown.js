document.addEventListener("DOMContentLoaded", () => {

    const phoneBlock = document.querySelector(".header-phone-dropdown");

    if(!phoneBlock) return;

    phoneBlock.addEventListener("click", () => {
        phoneBlock.classList.toggle("open");
    });

    document.addEventListener("click", (e) => {

        if(!phoneBlock.contains(e.target)){
            phoneBlock.classList.remove("open");
        }

    });

});