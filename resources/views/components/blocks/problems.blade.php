@if(count($problems))
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">{{$title}}</h2>
            <div class="row justify-content-center g-4">
                @foreach($problems as $problem)
                    <div class="col-md-3">
                        <div class="card-box problem-card">
                            <p>{{$problem['title']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif