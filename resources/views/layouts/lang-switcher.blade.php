<div class="header-lang">
    @if(app()->getLocale() == 'ru')
        <span class="active">RU</span>
        <span>|</span>
        <a href="{{ switch_locale('ua') }}">UA</a>
    @else
        <a href="{{ switch_locale('ru') }}">RU</a>
        <span>|</span>
        <span class="active">UA</span>
    @endif
</div>