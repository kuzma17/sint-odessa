// Fade in

document.addEventListener('DOMContentLoaded', function() {

    let observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('show');
                observer.unobserve(entry.target); // один раз
            }
        });
    }, {threshold: 0.1});

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

});