@php
    $name = $name ?? '';
    $value = old($name, $value ?? []);
    $fields = $fields ?? [];

    if (empty($value)) {
        $value = [[]];
    }
@endphp

{{-- LABEL --}}
@if($title || $icon)
    <label class="form-label">

        @if($icon)
            <i class="bi {{ $icon }} text-muted"></i>
        @endif

        <span>
            {{ $title }}

            @if($required)
                <span class="text-danger">*</span>
            @endif
        </span>

    </label>
@endif

@if($help)
    <div class="text-muted small mb-2">
        {{ $help }}
    </div>
@endif

{{-- REPEATER --}}
<div class="repeater"
     data-name="{{ $name }}"
     data-fields='@json($fields)'>

    <div class="repeater-items">

        @foreach($value as $index => $item)

            <div class="repeater-item border rounded mb-3 bg-white">

                {{-- HEADER --}}
                <div class="d-flex justify-content-between align-items-center px-3 py-1 border-bottom bg-light">

                    <div class="fw-semibold text-black-50">
                        Item {{ $index + 1 }}
                    </div>

                    <button type="button"
                            class="btn btn-sm btn-danger remove-item">
                        Delete
                    </button>

                </div>

                {{-- BODY --}}
                <div class="repeater-body px-2 pt-2 pb-0">

                    @foreach($fields as $field)

                        @if($field['translatable'] ?? false)

                            <div class="row mb-3">

                                <div class="col">
                                    <input
                                        class="form-control form-control-sm"
                                        placeholder="{{ $field['label'] }} RU"
                                        name="{{ $name }}[{{ $index }}][{{ $field['key'] }}][ru]"
                                        value="{{ $item[$field['key']]['ru'] ?? '' }}"
                                    >
                                </div>

                                <div class="col">
                                    <input
                                        class="form-control form-control-sm"
                                        placeholder="{{ $field['label'] }} UA"
                                        name="{{ $name }}[{{ $index }}][{{ $field['key'] }}][ua]"
                                        value="{{ $item[$field['key']]['ua'] ?? '' }}"
                                    >
                                </div>

                            </div>

                        @else

                            <div class="mb-3">

                                <input
                                    class="form-control form-control-sm"
                                    placeholder="{{ $field['label'] }}"
                                    name="{{ $name }}[{{ $index }}][{{ $field['key'] }}]"
                                    value="{{ $item[$field['key']] ?? '' }}"
                                >

                            </div>

                        @endif

                    @endforeach

                </div>

            </div>

        @endforeach

    </div>

    {{-- ADD BUTTON --}}
    <button type="button"
            class="btn btn-outline-primary btn-sm add-item">
        + Add
    </button>

</div>
