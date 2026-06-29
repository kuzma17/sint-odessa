<header class="site-header">
    <div class="container">
        <div class="header-mobile-panel">
        <div class="header-grid">

            <!-- LOGO -->
            <div class="header-logo">
                <a href="{{lroute('home')}}">
                    <div class="logo_row">
                        <div class="logo_img">
                            <img src="{{settings('image_logo')}}" alt="{{settings('site_name', env('APP_NAME'))}}">
                        </div>
                        <div class="logo_text">
                            <div class="logo_name">СИНТ-МАСТЕР</div>
                            <div class="logo_description">
                                мастер своего дела
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <button class="mobile-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="header-right">
                <div class="header-topline">
                    <div class="header-info">
                        <i class="fa-solid fa-location-dot"></i>
                        {{__('common.service_centers')}}
                    </div>

                    <div class="header-worktime">
                        <i class="fa-regular fa-clock"></i>
                        {{__('common.week')}} {{settings('working_hours_week', '09:00 - 18:00')}},
{{--                        сб {{settings('working_hours_sat', '10:00 - 16:00')}}--}}
                    </div>
                    @include('layouts/lang-switcher')
                </div>
                <div class="header-bottomline">

                    <!-- MENU -->
                   @include('layouts/menu')

                    <!-- PHONE -->
                    <x-phones-dropdown></x-phones-dropdown>

                    <!-- CTA -->
                    <button class="btn btn-blue"
                            data-bs-toggle="modal"
                            data-bs-target="#orderModal">
                        {{__('common.submit_request')}}
                    </button>
                </div>
            </div>
        </div>
        </div>
    </div>
</header>