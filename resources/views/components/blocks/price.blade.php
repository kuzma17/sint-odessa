@if(count($prices))
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">{{$title}}</h2>
            <div class="price-list">
                @foreach($prices as $price)
                    <div class="price-item">
                        <span class="service">{{$price['title']}}</span>
                        <span class="dots"></span>
                        <span class="price">{{$price['price']}}</span>
                    </div>
                @endforeach
            </div>

            <p class="text-center mt-4">
                * {{__('blocks.price.exact_cost')}}
            </p>

        </div>
    </section>
@endif