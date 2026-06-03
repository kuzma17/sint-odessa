// faq

document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('.faq-item').forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        question.addEventListener('click', function() {
            if(!answer) return;

            item.classList.toggle('open');
        });
    });

});