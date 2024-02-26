@if ($ps->partners == 1)
    <div class="brands p-4 mt-3">
        <div class="container-fluid remove-padding">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top d-flex justify-content-start align-items-center">
                        <h2 class="section-title ml-2">
                            {{ __('Marcas recomendadas') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="brands-slider">
                        @foreach ($partners as $marca)
                            <div class="brand-item">
                                <div class="brand-item_content w-100">
                                    <img src="{{ asset('storage/images/brands/' . $marca->image) }}" alt="" loading="lazy">
                                    <h3 class='mt-3'>{{ $marca->name }}</h3>     
                                </div> 
                                <a href="{{ route('front.brand', $marca->slug) }}" class='d-block mt-2'>
                                    {{ __("Ver Produtos") }}
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


