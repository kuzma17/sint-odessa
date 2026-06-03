@if($services->isNotEmpty())
    <section class="services fade-in">
        <div class="container">
            @if($mode == 'preview')
                <h2 class="text-center mb-5">{{__('blocks.services.services')}}</h2>
            @endif
            <div class="row g-4 justify-content-center">
                @foreach($services as $service)
                    <div class="col-md-4">
                        <a href="{{lroute('service', [$service->slug])}}" class="card-box service-box">
                            <img src="{{$service->image_card}}">
                            <div class="service-info">
                                <h3>{{$service->title}}</h3>
                                <p>
                                    {{$service->description}}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif