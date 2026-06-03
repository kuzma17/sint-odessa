@extends('layouts.app')

@section('script')
    @vite('resources/js/reviews.js')
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

    <x-blocks.reviews :reviews="$reviews" ></x-blocks.reviews>

    <x-blocks.cta title="{{__('pages.cta.need-repair')}}"></x-blocks.cta>
@endsection
