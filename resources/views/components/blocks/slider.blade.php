@if($sliders->isNotEmpty())
    <section class="hero">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($sliders as $slide)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="slide-bg" style="background-image:url('{{ $slide->image }}')"></div>
                        <div class="slide-content">
                            <h1>{{$slide->title}}</h1>
                            <p>{{$slide->description}}</p>
                            <button class="btn btn-blue"
                                    data-bs-toggle="modal"
                                    data-bs-target="#orderModal">
                                {{__('common.submit_request')}}
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>
@endif