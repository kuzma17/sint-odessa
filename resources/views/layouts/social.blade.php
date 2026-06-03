<div class="footer-social">
    @foreach([
                'facebook' => 'fa-facebook-f',
                'viber' => 'fa-viber',
                'instagram' => 'fa-instagram',
                'telegram' => 'fa-telegram'
            ] as $key => $icon)
        @if($url = settings($key))
            <a href="{{ $url }}" target="_blank" rel="noopener">
                <i class="fa-brands {{ $icon }}"></i>
            </a>
        @endif
    @endforeach
</div>
