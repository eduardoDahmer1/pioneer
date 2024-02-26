<!-- Product Details Area Start -->
<section class="product-details-page pt-4">
    <div class="container m-auto">
        @include('front._product-details-validation')
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @include('front._product-details-header')
                </div>
                <div class="row">
                    @include('front._product-details-photos')
                    @include('front._product-details-content')
                </div>

                @if(config("features.marketplace"))
                    @include('front._product-details-feature-marketplace')
                @endif
                
                <div class='pt-4'>
                    <div class="row pt-4">
                        <div class="col-lg-12 remove-padding">
                            <div class="section-top">
                                <h2 class="section-title">
                                    {{ __('DESCRIPTION') }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <p>{!! nl2br($productt->details) !!}</p>
                </div>

                @include('front._product-details-description')

                <div class="row mt-4 position-relative w-100 service-row" style="height: 200px;">
                    @include('front.themes.theme-09.components.services')
                </div>
            </div>
            
            {{-- <div class="col-lg-2">
                @include('front._product-details-sidebar')
            </div> --}}
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
            </div>
        </div> --}}
    </div>
    
    

    @if(!config("features.marketplace"))
        @include('front._product-details-trending')
        @include('front.themes.theme-09.components.small-banners-1')
    @endif

</section>
