@extends('layouts.app')

@section('script')
    @vite('resources/js/about.js')
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

            <div class="row align-items-stretch g-5">
                <div class="col-lg-6">
                    <div class="service-text">
                        {!! $page->content !!}
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="service-image-wrapper">
                        <img
                                src="{{ $page->image }}"
                                class="service-image"
                                alt="{{ $page->title }}"
                        >
                    </div>
                </div>
            </div>

        </div>
    </section>

    <x-blocks.history :items="$history_items"></x-blocks.history>

    <x-blocks.advantages :advantages="$advantages"></x-blocks.advantages>

    <x-blocks.cta title="{{__('pages.cta.need-repair')}}"></x-blocks.cta>
@endsection
