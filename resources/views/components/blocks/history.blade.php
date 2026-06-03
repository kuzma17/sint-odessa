@if(count($items))
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">{{__('blocks.history.history')}}</h2>
            <div class="section-divider"></div>
            <div class="timeline-advanced">
                @foreach($items as $item)
                    <div class="timeline-row {{ $loop->odd ? 'left' : 'right' }}">
                        <div class="card-box timeline-card">
                            <span class="year">{{$item['year']}}</span>
                            <h4>{{$item['title']}}</h4>
                            <p>{{$item['description']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif