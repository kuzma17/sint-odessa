@extends('layouts.app')

@section('script')
    @vite('resources/js/services.js')
@endsection

@section('content')

    <section class="page-hero">
        <div class="container">
            <h1>{{$page->title}}</h1>
            <p>
                {{$page->subtitle}}
            </p>
        </div>
    </section>

    <x-blocks.services :services="$services"></x-blocks.services>

{{--    <section class="section">--}}
{{--        <div class="container">--}}

{{--            <h2 class="text-center mb-5">Почему выбирают наш сервис</h2>--}}
{{--            <div class="section-divider"></div>--}}

{{--            <div class="row g-4 text-center justify-content-center">--}}

{{--                <div class="col-md-4">--}}
{{--                    <div class="card-box adv-card">--}}
{{--                        <i class="fa-solid fa-user-tie"></i>--}}
{{--                        <h4>Опытные инженеры</h4>--}}
{{--                        <p>Специалисты с опытом более 20 лет</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-4">--}}
{{--                    <div class="card-box adv-card">--}}
{{--                        <i class="fa-solid fa-screwdriver-wrench"></i>--}}
{{--                        <h4>Современное оборудование</h4>--}}
{{--                        <p>Используем профессиональные инструменты</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-4">--}}
{{--                    <div class="card-box adv-card">--}}
{{--                        <i class="fa-solid fa-truck"></i>--}}
{{--                        <h4>Быстрая доставка</h4>--}}
{{--                        <p>Заберем и вернем технику после ремонта</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-4">--}}
{{--                    <div class="card-box adv-card">--}}
{{--                        <i class="fa-solid fa-shield-halved"></i>--}}
{{--                        <h4>Гарантия на работы</h4>--}}
{{--                        <p>Гарантия на ремонт и обслуживание</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </section>--}}


    <x-blocks.cta title="{{__('pages.cta.need-repair')}}"></x-blocks.cta>
@endsection
