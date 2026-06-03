@if($messages)
    <div>
    @foreach($messages as $message)
        <div>
            ⚠️ {{$message}}
        </div>
    @endforeach
    </div>
@endif