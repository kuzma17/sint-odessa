@if(count($workflow))
    <section class="workflow fade-in">
        <div class="container">
            <h2 class="text-center mb-5">{{$title ?? __('blocks.workflow.workflow')}}</h2>
            <div class="workflow-row">
                @foreach($workflow as $step)
                    <div class="workflow-step">
                        <div class="step-number">{{ $loop->iteration }}</div>
                        <div class="card-box step-card">
                            <h3>{{$step['title']}}</h3>
                            <p>{{$step['description']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif