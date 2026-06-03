@if(count($advantages))
    <section class="bg-light fade-in py-5">
        <div class="container">
            <h2 class="text-center mb-5">{{__('blocks.advantages.advantages')}}</h2>
            <div class="section-divider"></div>
            <div class="row text-center g-4">
                @foreach($advantages as $advantage)
                    <div class="col-md-3">
                        <div class="adv-card-circle-modern">
                            <div class="adv-number" data-target="{{(int)$advantage['value']}}">
                                <span class="num">0</span>
                                @php($unit = $advantage['until'])
                                <span class="unit">{{ $unit ? $unit . '.' : '' }}</span>
                            </div>
                            <p>{{$advantage['title']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif