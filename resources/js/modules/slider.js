// Slider

document.addEventListener('DOMContentLoaded', function () {

    let slider = document.querySelector('#heroCarousel');

    if(!slider) return;

    slider.addEventListener('slide.bs.carousel', function () {

        document.querySelectorAll('.slide-content h1, .slide-content p, .slide-content a')
            .forEach(el => {

                el.style.animation = 'none';
                el.offsetHeight; // reflow
                el.style.animation = '';

            });

    });

});