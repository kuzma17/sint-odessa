<!-- МЕНЮ -->
<div class="col-lg-2 col-md-6 mb-4">
    <h5 class="footer-title">{{__('menu.navigations')}}</h5>
    <ul class="footer-links">
        <li><a href="{{lroute('home')}}">Головна</a></li>
        <li><a href="{{lroute('about')}}">Про нас</a></li>
        <li><a href="{{lroute('services')}}">Послуги</a></li>
        <li><a href="{{lroute('faq')}}">FAQ</a></li>
        <li><a href="{{lroute('reviews')}}">{{__('menu.reviews')}}</a></li>
        <li><a href="{{lroute('delivery')}}">{{__('menu.delivery')}}</a></li>
        <li><a href="{{lroute('contacts')}}">{{__('menu.contacts')}}</a></li>
    </ul>
</div>
<div class="col-lg-3 col-md-6 mb-4">
    <h5 class="footer-title">{{__('menu.services')}}</h5>
    <ul class="footer-links">
        <li><a href="{{lroute('services', 'cartridge-refill')}}">{{__('menu.cartridge-refill')}}</a></li>
        <li><a href="{{lroute('services', 'printers-repair')}}">{{__('menu.printers-repair')}}</a></li>
        <li><a href="{{lroute('services', 'pc-repair')}}">{{__('menu.pc-repair')}}</a></li>
    </ul>
</div>