@extends('layouts.app')

@section('script')
    @vite('resources/js/services.js')
@endsection

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{$service->title}}</h1>
            <p>
                {{$service->subtitle}}
            </p>
        </div>
    </section>

    <section class="service-text">
        <div class="container">

            <div class="row align-items-stretch g-5">
                <div class="col-lg-6">
                    <div class="service-text">
                        {!! $service->content !!}
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="service-image-wrapper">
                        <img
                                src="{{ $service->image }}"
                                class="service-image"
                                alt="{{ $service->title }}"
                        >
                    </div>
                </div>
            </div>

        </div>
    </section>

    <x-blocks.problems :problems="$problems" title="{{__('blocks.problems.problem_refill')}}"></x-blocks.problems>

    <x-blocks.workflow :workflow="$workflow" title="{{__('blocks.workflow.workflow_refill')}}"></x-blocks.workflow>

    <x-blocks.price :prices="$prices" title="{{__('blocks.price.price_refill')}}"></x-blocks.price>

    <x-blocks.cta title="{{__('pages.cta.need-repair')}}"></x-blocks.cta>

@endsection
