@extends('layouts.app')

@section('script')
    @vite('resources/js/home.js')
@endsection

@section('content')

    <x-blocks.slider :sliders="$sliders"></x-blocks.slider>

    <x-blocks.services :services="$services" mode="preview"></x-blocks.services>

    <x-blocks.advantages-digital :advantages="$advantages_digital" ></x-blocks.advantages-digital>

    <x-blocks.workflow :workflow="$workflow"></x-blocks.workflow>

    <x-blocks.brands :brands="$brands"></x-blocks.brands>

    <x-blocks.reviews :reviews="$reviews" title="{{__('blocks.reviews.reviews')}}"></x-blocks.reviews>

    <x-blocks.faq :faqs="$faqs" title="{{__('blocks.faq.questions')}}"></x-blocks.faq>

    <x-blocks.cta title="{{__('blocks.cta.need-repair')}}"></x-blocks.cta>

    <x-blocks.map :offices="$offices"></x-blocks.map>

@endsection
