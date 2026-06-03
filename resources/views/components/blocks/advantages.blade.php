@if(count($advantages))
<section class="section">
    <div class="container">
        <h2 class="text-center mb-5">{{__('blocks.advantages.advantages')}}</h2>
        <div class="section-divider"></div>
        <div class="row g-4 justify-content-center">
            @foreach($advantages as $advantage)
                <div class="col-md-4">
                    <div class="card-box adv-card">
                        <i class="fa-solid {{$advantage['icon']}}"></i>
                        <h4>{{$advantage['title']}}</h4>
                        <p>{{$advantage['description']}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif