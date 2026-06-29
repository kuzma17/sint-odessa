@extends('layouts.app')

@section('script')
    @vite('resources/js/contacts.js')
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

    <x-blocks.offices :offices="$offices"></x-blocks.offices>

    <x-blocks.map :offices="$offices"></x-blocks.map>

    <section class="section worktime-section">
        <div class="container">

            <h2 class="text-center mb-5">{{__('pages.worktime')}}</h2>
            <div class="section-divider"></div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card-box worktime-card">

                        <div class="worktime-row">
                            <i class="fa-regular fa-calendar"></i>
                            <div>
                                <strong>{{__('pages.week')}}</strong>
                                <span>{{settings('working_hours_week')}}</span>
                            </div>
                        </div>

{{--                        <div class="worktime-row">--}}
{{--                            <i class="fa-regular fa-calendar"></i>--}}
{{--                            <div>--}}
{{--                                <strong>{{__('pages.saturday')}}</strong>--}}
{{--                                <span>{{settings('working_hours_sat')}}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="worktime-row">
                            <i class="fa-regular fa-calendar-xmark"></i>
                            <div>
                                <strong>{{__('pages.sunday')}}</strong>
                                <span>{{__('pages.day_off')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-blocks.cta title="{{__('blocks.cta.need-repair')}}"></x-blocks.cta>
@endsection
