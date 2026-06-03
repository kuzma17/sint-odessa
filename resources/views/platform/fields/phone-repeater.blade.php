@php
    $isHorizontal = $isHorizontal ?? false;
    $label = $label ?? $title ?? null;
@endphp
<div class="{{ $isHorizontal ? 'form-group row row-cols-sm-2 align-items-stretch' : 'col-md-12' }}">
    <label class="form-label {{ $isHorizontal ? 'col-sm-3 text-wrap text-balance' : '' }}">
        {{ $label }}
        @if($required ?? false)
            <sup class="text-danger">*</sup>
        @endif
    </label>
    <div class="{{ $isHorizontal ? 'col col-md-8' : 'col-md-12' }}">
        <div id="phone-repeater"
             data-name="{{ $name }}"
             data-value='{{ json_encode($value ?? []) }}'>
            <div id="phone-list"></div>
            <button type="button" class="btn btn-light btn-sm" id="add-phone">
                + Добавить телефон
            </button>
        </div>
        @if($help ?? false)
            <small class="form-text text-muted">{{ $help }}</small>
        @endif
    </div>
</div>
@php
    $phones = $value ?? [];
@endphp

<script>
    function initPhones() {
        let container = document.getElementById('phone-list');
        let addBtn = document.getElementById('add-phone');

        if (!container || !addBtn) {
            return;
        }

        let phones = @json($phones);

        if (!Array.isArray(phones) || phones.length === 0) {
            phones = [''];
        }

        // Функция для форматирования номера для маски
        function formatPhoneForMask(phone) {
            if (!phone) return '';

            // Удаляем всё кроме цифр
            let digits = phone.toString().replace(/\D/g, '');

            // Если номер начинается с 380 (Украина) и длина 12
            if (digits.length === 12 && digits.startsWith('380')) {
                // Маска ожидает +38 (099) 999-99-99
                let code = digits.substring(2, 5);   // 050
                let part1 = digits.substring(5, 8);  // 081
                let part2 = digits.substring(8, 10); // 62
                let part3 = digits.substring(10, 12); // 13

                return `+38 (${code}) ${part1}-${part2}-${part3}`;
            }

            return phone;
        }

        function render() {
            container.innerHTML = '';

            phones.forEach((phone, i) => {
                let row = document.createElement('div');
                row.classList.add('d-flex', 'gap-2', 'mb-2', 'align-items-start');

                // Форматируем номер для отображения
                let displayValue = formatPhoneForMask(phone);

                row.innerHTML = `
                <input type="text"
                       class="form-control phone-input"
                       name="{{ $name }}[]"
                       data-index="${i}"
                       value="${displayValue}">
                <button type="button"
                        class="btn btn-danger remove"
                        data-index="${i}">
                    ✕
                </button>
            `;
                container.appendChild(row);
            });

            bind();
            mask();
        }

        function bind() {
            document.querySelectorAll('.phone-input').forEach(el => {
                el.removeEventListener('input', handleInput);
                el.addEventListener('input', handleInput);
            });

            document.querySelectorAll('.remove').forEach(el => {
                el.removeEventListener('click', handleRemove);
                el.addEventListener('click', handleRemove);
            });
        }

        function handleInput(e) {
            let index = this.dataset.index;
            // Сохраняем сырое значение (цифры) в массив
            let rawValue = this.inputmask ? this.inputmask.unmaskedvalue() : this.value.replace(/\D/g, '');
            phones[index] = rawValue;
        }

        function handleRemove(e) {
            remove(this.dataset.index);
        }

        function add() {
            phones.push('');
            render();
        }

        function remove(index) {
            if (phones.length === 1) {
                phones[0] = '';
                render();
                return;
            }
            phones.splice(index, 1);
            render();
        }

        function mask() {
            document.querySelectorAll('.phone-input').forEach(el => {
                // Если уже есть маска - уничтожаем
                if (el.inputmask) {
                    el.inputmask.remove();
                }

                Inputmask({
                    mask: "+38 (099) 999-99-99",
                    showMaskOnHover: false,
                    showMaskOnFocus: true,
                    autoUnmask: true,        // Автоматически убирать маску при отправке
                    removeMaskOnSubmit: true, // Убрать маску при сабмите
                    onUnMask: function(maskedValue, unmaskedValue) {
                        // Возвращаем только цифры
                        return unmaskedValue.replace(/\D/g, '');
                    }
                }).mask(el);
            });
        }

        addBtn.removeEventListener('click', add);
        addBtn.addEventListener('click', add);

        render();
    }

    document.addEventListener('turbo:load', () => {
        initPhones();
    });
</script>