<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="footer-logo">
                    <img src="{{settings('image_logo_footer')}}" alt="СИНТ-Мастер">
                </div>
                <p class="footer-text">
                    {{settings('description')}}
                </p>
            </div>

            <x-footer-menu></x-footer-menu>

            <!-- КОНТАКТЫ -->
            <div class="col-lg-3 mb-4">
                <h5 class="footer-title">{{__('menu.contacts')}}</h5>
                <div class="footer-contact">
                    <p>
                        <i class="fa-solid fa-location-dot"></i>
                        {{settings('address.'.app()->getLocale())}}
                    </p>
                    <p>
                        <i class="fa-solid fa-phone"></i>
                        <a href="tel:{{ settings('phone') }}">
                            {{ formatPhone(settings('phone')) }}
                        </a>
                    </p>
                    <p>
                        <i class="fa-solid fa-envelope"></i>
                        <a href="mailto:{{ settings('email') }}">
                            {{ settings('email') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        @include('layouts/social')

        <div class="footer-bottom">
            <p>© 2017 – {{ date('Y') }} {{settings('title')}}</p>
        </div>
    </div>
</footer>