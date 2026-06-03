@extends('layouts.app')

@section('script')
    @vite('resources/js/faq.js')
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

    <x-blocks.faq :faqs="$faqs" mode="all"></x-blocks.faq>

    <x-blocks.cta title="{{__('pages.cta.need-repair')}}"></x-blocks.cta>
@endsection
