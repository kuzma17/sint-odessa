@if($brands->isNotEmpty())
    <section class="brands bg-light py-4 fade-in">
        <div class="container text-center">
            <h2 class="text-center mb-5">{{__('blocks.brands.repair_devices_brands')}}</h2>
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
                @foreach($brands as $brand)
                    <img src="{{$brand->image}}" alt="{{$brand->title}}" class="brand-logo" width="140">
                @endforeach
            </div>
        </div>
    </section>
@endif