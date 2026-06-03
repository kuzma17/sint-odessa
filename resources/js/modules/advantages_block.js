
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.adv-number');

    const options = { threshold: 0.5 };

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const numSpan = counter.querySelector('.num');
        //const unitSpan = counter.querySelector('.unit');
        //const unit = unitSpan.textContent || '';
        const increment = target / 100;
        let current = 0;

        const update = () => {
            current += increment;
            if(current < target){
                numSpan.textContent = Math.ceil(current);
                requestAnimationFrame(update);
            } else {
                numSpan.textContent = target;
            }
        };
        update();
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, options);

    counters.forEach(counter => observer.observe(counter));
});