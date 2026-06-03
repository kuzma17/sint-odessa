// resources/js/admin.js

document.addEventListener('turbo:load', () => {
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', () => {
            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 200);
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[id$="_show"]').forEach(checkbox => {
        const prefix = checkbox.id.replace('_show', '');
        const input = document.getElementById(prefix + '_count');

        if (!input) {
            return;
        }

        const wrapper = input.closest('.form-group');
        const toggle = () => {
            wrapper.style.display = checkbox.checked ? '' : 'none';
        };
        checkbox.addEventListener('change', toggle);
        toggle();
    });
});