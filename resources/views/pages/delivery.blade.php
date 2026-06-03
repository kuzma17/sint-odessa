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

    <section class="service-text">
        <div class="container">

            <div class="row g-5 align-items-start">

                <div class="col-lg-6">
                    {!! $page->content !!}
                </div>

                <div class="col-lg-6">
                    <img
                            src="{{ $page->image }}"
                            class="service-image"
                            alt="{{ $page->title }}"
                    >
                </div>

            </div>

        </div>
    </section>

    {{--    <section class="workflow fade-in">--}}
    {{--        <div class="container">--}}

    {{--            <h2 class="text-center mb-5">Как работает доставка</h2>--}}
    {{--            <div class="section-divider"></div>--}}

    {{--            <div class="workflow-row">--}}

    {{--                <div class="workflow-step">--}}
    {{--                    <div class="step-number">1</div>--}}
    {{--                    <div class="step-card">--}}
    {{--                        <h3>Оставляете заявку</h3>--}}
    {{--                        <p>Свяжитесь с нами по телефону или через сайт</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="workflow-step">--}}
    {{--                    <div class="step-number">2</div>--}}
    {{--                    <div class="step-card">--}}
    {{--                        <h3>Курьер забирает технику</h3>--}}
    {{--                        <p>Мы заберём устройство у вас дома или в офисе</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="workflow-step">--}}
    {{--                    <div class="step-number">3</div>--}}
    {{--                    <div class="step-card">--}}
    {{--                        <h3>Диагностика и ремонт</h3>--}}
    {{--                        <p>Техника проходит диагностику и обслуживание</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="workflow-step">--}}
    {{--                    <div class="step-number">4</div>--}}
    {{--                    <div class="step-card">--}}
    {{--                        <h3>Доставка обратно</h3>--}}
    {{--                        <p>После ремонта техника возвращается к вам</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--            </div>--}}

    {{--        </div>--}}
    {{--    </section>--}}

    <x-blocks.workflow :workflow="$workflow" title="{{__('blocks.workflow.workflow_delivery')}}"></x-blocks.workflow>

    <x-blocks.cta title="{{__('pages.cta.need-repair')}}"></x-blocks.cta>

@endsection
