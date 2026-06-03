// Orchid custom component
// Repeater


// Ваш код, но обёрнутый в событие turbo:load
document.addEventListener('turbo:load', function() {
    function renderField(field, name, index) {

        if (field.translatable) {

            return `
            <div class="row mb-3">

                <div class="col">
                    <input
                        class="form-control"
                        placeholder="${field.label} RU"
                        name="${name}[${index}][${field.key}][ru]"
                    >
                </div>

                <div class="col">
                    <input
                        class="form-control"
                        placeholder="${field.label} UA"
                        name="${name}[${index}][${field.key}][ua]"
                    >
                </div>

            </div>
        `;
        }

        return `
        <div class="mb-3">

            <input
                class="form-control"
                placeholder="${field.label}"
                name="${name}[${index}][${field.key}]"
            >

        </div>
    `;
    }

    document.querySelectorAll('.repeater').forEach((repeater) => {

        if (repeater.dataset.initialized) {
            return;
        }

        repeater.dataset.initialized = true;

        const addButton = repeater.querySelector('.add-item');

        addButton?.addEventListener('click', function () {

            const items = repeater.querySelector('.repeater-items');

            const index = items.children.length;

            const name = repeater.dataset.name;

            const fields = JSON.parse(repeater.dataset.fields);

            let html = `
            <div class="card p-3 mb-3 repeater-item">
        `;

            fields.forEach(field => {
                html += renderField(field, name, index);
            });

            html += `
            <button
                type="button"
                class="btn btn-danger remove-item">

                Delete

            </button>

            </div>
        `;

            items.insertAdjacentHTML('beforeend', html);

        });

    });

    document.addEventListener('click', function (e) {

        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.repeater-item').remove();
        }

    });

});