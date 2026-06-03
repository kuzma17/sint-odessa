@if($reviews->isNotEmpty())
    <section class="reviews-section fade-in">
        <div class="container">
            @if($title)
                <h2 class="text-center mb-5">{{$title}}</h2>
            @endif
            <div class="row g-4">
                @foreach($reviews as $review)
                    <div class="col-md-4">
                        <div class="card-box review-card">
                            <div class="review-stars">
                                @for($i=0; $i<=$review->rating; $i++)★@endfor
                            </div>
                            <p>{{$review->content}}</p>
                            <div class="review-user">
                                <img src="{{asset('storage/avatars/'. $review->avatar)}}">
                                <div>
                                    <strong>{{$review->author}}</strong>
                                    <div class="review-city">{{$review->location}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($title)
                <div class="text-center mt-4">
                    <a href="/reviews" class="btn btn-primary">{{__('blocks.reviews.all_reviews')}} →</a>
                </div>
            @endif
        </div>
    </section>
@endif