@php
    $block = $name;

    $showName = "model.blocks.{$block}_show";
    $countName = "model.blocks.{$block}_count";

    $showValue = old(
        str_replace('.', '_', $showName),
        data_get($model ?? null, "blocks.{$block}_show")
    );

    $countValue = old(
        str_replace('.', '_', $countName),
        data_get($model ?? null, "blocks.{$block}_count", 1)
    );
    $label = $label ?? $title ?? null;
@endphp

<div class="{{ $horizontal ? 'form-group row row-cols-sm-2 align-items-stretch' : 'col-md-12'  }}">
    <label class="form-label {{ $horizontal ? 'col-sm-3 text-wrap text-balance' : '' }}">
        {{ $label }}
        @if($required ?? false)
            <sup class="text-danger">*</sup>
        @endif
    </label>
    <div class="{{ $horizontal ? 'col col-md-8' : 'col-md-12' }}">
        <div class="row">
            <div class="{{ $horizontal ? 'col-md-6' : '' }}">

                <span style="float: left">
                   <label class="form-label">
                    Показывать {{ $title }}
                </label>
               </span>
                <span style="float: left">
                    <input
                            type="checkbox"
                            class="form-check-input"
                            name="{{ $showName }}"
                            id="{{ $block }}_show"
                            value="1"
                            @checked($showValue)
                    >
                </span>

            </div>

            <div class="{{ $horizontal ? 'col-md-6' : 'mt-3' }}">
               <span style="float: left">
                   <label class="form-label">
                    Количество
                </label>
               </span>
                <span style="float: left">
                    <input
                            type="number"
                            class="form-control"
                            name="{{ $countName }}"
                            id="{{ $block }}_count"
                            value="{{ $countValue }}"
                            min="1"
                    >
                </span>
            </div>
        </div>
    </div>

</div>




{{--@php--}}
{{--    $block = $name;--}}

{{--    $showName = "model.blocks.{$block}_show";--}}
{{--    $countName = "model.blocks.{$block}_count";--}}

{{--    $showValue = old(--}}
{{--        str_replace('.', '_', $showName),--}}
{{--        data_get($model ?? null, "blocks.{$block}_show")--}}
{{--    );--}}

{{--    $countValue = old(--}}
{{--        str_replace('.', '_', $countName),--}}
{{--        data_get($model ?? null, "blocks.{$block}_count", 1)--}}
{{--    );--}}

{{--    $isHorizontal = $horizontal ?? false;--}}
{{--    $label = $label ?? $title ?? null;--}}
{{--@endphp--}}
{{--<div class="{{ $isHorizontal ? 'form-group row row-cols-sm-2 align-items-stretch' : 'col-md-12' }}">--}}
{{--    <label class="form-label {{ $isHorizontal ? 'col-sm-3 text-wrap text-balance' : '' }}">--}}
{{--        {{ $label }}--}}
{{--        @if($required ?? false)--}}
{{--            <sup class="text-danger">*</sup>--}}
{{--        @endif--}}
{{--    </label>--}}
{{--    <div class="{{ $isHorizontal ? 'col col-md-8' : 'col-md-12' }}">--}}
{{--        <div class="row g-3 align-items-center">--}}
{{--            <div class="col-auto">--}}
{{--                <label for="inputPassword6" class="col-form-label">Показывать {{ $title }}</label>--}}
{{--            </div>--}}
{{--            <div class="col-auto">--}}
{{--                <input--}}
{{--                        type="checkbox"--}}
{{--                        class="form-check-input"--}}
{{--                        name="{{ $showName }}"--}}
{{--                        id="{{ $block }}_show"--}}
{{--                        value="1"--}}
{{--                        @checked($showValue)--}}
{{--                >--}}
{{--            </div>--}}
{{--            <div class="col-auto">--}}
{{--                Количество--}}
{{--            </div>--}}
{{--            <div class="col-auto">--}}
{{--                <input--}}
{{--                        type="number"--}}
{{--                        class="form-control"--}}
{{--                        name="{{ $countName }}"--}}
{{--                        id="{{ $block }}_count"--}}
{{--                        value="{{ $countValue }}"--}}
{{--                        min="1"--}}
{{--                >--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div id="phone-repeater">--}}


{{--                <input--}}
{{--                        type="checkbox"--}}
{{--                        class="form-check-input"--}}
{{--                        name="{{ $showName }}"--}}
{{--                        id="{{ $block }}_show"--}}
{{--                        value="1"--}}
{{--                        @checked($showValue)--}}
{{--                >--}}

{{--                <span class="form-check-label">--}}
{{--                Показывать {{ $title }}--}}
{{--            </span>--}}


{{--            <span class="form-label">--}}
{{--                Количество--}}
{{--            </span>--}}
{{--            <input--}}
{{--                    type="number"--}}
{{--                    class="form-control"--}}
{{--                    name="{{ $countName }}"--}}
{{--                    id="{{ $block }}_count"--}}
{{--                    value="{{ $countValue }}"--}}
{{--                    min="1"--}}
{{--            >--}}

{{--        </div>--}}
{{--        @if($help ?? false)--}}
{{--            <small class="form-text text-muted">{{ $help }}</small>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}