@if($offices->isNotEmpty())
    <section class="section offices-page">
        <div class="container">
            <h2 class="text-center mb-5">{{__('blocks.offices.offices')}}</h2>
            <div class="office-list-page">
                @foreach($offices as $office)
                    <div class="office-block btn-office" data-lat="{{$office->map['lat']}}" data-lng="{{$office->map['lng']}}">
                        <div class="office-photo">
                            <img src="{{$office->image}}" style="width: 500px;height: 300px">
                        </div>
                        <div class="office-info">
                            <h3>{{$office->title}}</h3>
                            <p class="office-desc">
                                {{$office->subtitle}}
                            </p>
                            <div class="office-meta">
                                <div>
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{$office->address}}
                                </div>
                                <div>
                                    <i class="fa-solid fa-phone"></i>
                                    {{formatPhone($office->phone)}}
                                </div>
                            </div>
                            <div class="office-actions">
                            <span class="office-map-link">
                                <i class="fa-solid fa-map"></i> {{__('pages.show_map')}}
                            </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif