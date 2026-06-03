@if($faqs->isNotEmpty())
    <section class="faq-section py-5 bg-light fade-in section-light">
        <div class="container">
            @if($title)
                <h2 class="text-center mb-5">{{$title}}</h2>
            @endif
            <div class="faq-list">
                @foreach($faqs as $faq)
                    <div class="faq-item card mb-3">
                        <div class="faq-question card-header d-flex justify-content-between align-items-center">
                            <span>{{$faq->question}}</span>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer card-body">
                            {{$faq->answer}}
                        </div>
                    </div>
                @endforeach
            </div>
            @if($title)
                <div class="text-center mt-4">
                    <a href="/faq" class="btn btn-primary">{{__('blocks.faq.all_questions')}} →</a>
                </div>
            @endif
        </div>
    </section>
@endif