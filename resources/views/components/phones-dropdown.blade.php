<div class="header-phone-dropdown">
    <div class="phone-main">
        <i class="fa-solid fa-phone"></i>
        {{formatPhone(settings('phone'))}}
        <i class="fa-solid fa-chevron-down phone-arrow"></i>
    </div>
    <div class="phone-list">
        @foreach($offices as $office)
            <a href="tel:{{$office->phone}}">
                <strong>{{$office->title}}</strong>
                <span>{{formatPhone($office->phone)}}</span>
            </a>
        @endforeach
    </div>
</div>