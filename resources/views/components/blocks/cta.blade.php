<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div class="cta-text">
                <h2>{{$title ?? __('pages.cta.need-repair')}}</h2>
                <p>
                    {{__('blocks.cta.leave-request')}}
                </p>
            </div>
            <div class="cta-action">
                <button class="btn btn-blue"
                        data-bs-toggle="modal"
                        data-bs-target="#orderModal">
                    {{__('common.submit_request')}}
                </button>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('blocks.cta.send-order')}}</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text"
                                   class="form-control"
                                   placeholder="{{__('blocks.cta.your_name')}}">
                        </div>
                        <div class="col-md-6">
                            <input type="tel"
                                   class="form-control"
                                   placeholder="{{__('blocks.cta.phone')}}"
                                   required>
                        </div>
                        <div class="col-12">
                            <select class="form-select">
                                <option>Выберите услугу</option>
                                <option>{{__('blocks.cta.cartridge-refill')}}</option>
                                <option>{{__('blocks.cta.printer-repair')}}</option>
                                <option>{{__('blocks.cta.pc-repair')}}</option>
{{--                                <option>Диагностика</option>--}}
                            </select>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control"
                                      rows="3"
                                      placeholder="{{__('blocks.cta.problems')}}"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-blue btn-lg">
                                {{__('blocks.cta.send-order')}}
                            </button>
                            <p class="small mt-2 text-muted">
                                {{__('blocks.cta.we-call')}}
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>