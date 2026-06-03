<section class="offices-section fade-in">
    <div class="container">
        <h2 class="text-center mb-5">{{__('blocks.map.offices_map')}}</h2>
        <div class="row">
            <!-- map -->
            <div class="col-md-9">
                <div id="mapdiv" class="map"></div>
            </div>
            <!-- offices -->
            <div class="col-md-3">
                <div class="office-list">
                    @foreach($offices as $office)
                        <div class="card-box office-card btn-office"
                             data-lat="{{$office->map['lat'] ?? ''}}"
                             data-lng="{{$office->map['lng'] ?? ''}}"
                        >
                            <h5>{{$office->title}}</h5>
                            <p>
                                <i class="fa-solid fa-location-dot"></i>
                                {{$office->address}}
                            </p>
                            <p>
                                <i class="fa-solid fa-phone"></i>
                                {{formatPhone($office->phone)}}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>