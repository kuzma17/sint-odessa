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
<div class="avatar-picker d-flex flex-wrap gap-3">
    @foreach($avatars as $avatar)
        <label class="avatar-picker__item">
            <input type="radio" name="{{ $name }}" value="{{ $avatar }}" hidden @checked($value == $avatar)>
            <img src="{{ asset('storage/avatars/' . $avatar) }}" class="avatar-picker__image" alt="{{ $avatar }}">
        </label>
    @endforeach
</div>
@if($help)
    <div class="text-muted small mb-2">
        {{ $help }}
    </div>
@endif