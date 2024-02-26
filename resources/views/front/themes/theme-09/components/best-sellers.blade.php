@if ($ps->best == 1)
<!-- Phone and Accessories Area Start -->
<section class="best-sellers categori-item p-0 p-md-4 mt-0 mt-md-3">
    <div class="container-fluid remove-padding">
        <div class="row w-100 m-auto">
            <div class="col-lg-12 m-auto remove-padding">
                <div class="section-top h-100 w-100 ml-xl-3 d-flex justify-content-center justify-content-md-start align-items-end">
                    <a class="section-title ml-2 text-center text-md-center" href="https://www.pioneerinter.com/category/linha-dj-profissional-4">   
                        {{ __("Aúdio e Eletrônicos") }}
                    </a>
                </div>
            </div>
        </div>
        <div class="row w-100 m-auto">
            @if ($ps->best_seller_banner or $ps->best_seller_banner1)
            <div class="col-md-9 col-lg-10 col-xl-10 col-sm-sm-9 col-sm-10 col-12 col-xl-xl-9 m-auto remove-padding px-xl-xl-4  row-theme" id='best-sellers-container'>
                @else
                <div class="col-md-9 col-lg-10 col-sm-sm-9 col-sm-10 col-xl-xl-9 col-12 remove-padding  px-xl-xl-4 m-auto row-theme" id='best-sellers-container'>
                    @endif
                    <div class="row m-auto remove-padding w-100 d-flex justify-content-center justify-content-xxl-start justify-content-xl-xl-start flex-nowrap flex-md-wrap" id='content-row'>
                        @php
                            $latest_best_products = $best_products->take(12);
                        @endphp 
                        @foreach ($latest_best_products as $prod)
                            <div class="feat_card mx-auto mx-sm-0 mt-4 best-seller-feature">
                                @include('front.themes.theme-09.components.slider-product')
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 remove-padding d-none d-md-block">
                    <div class="aside h-100 mt-3 mr-xl-4">
                        @if ($ps->best_seller_banner)
                        <a class="banner-effect sider-bar-align mb-md-3 mb-xl-4 pt-md-2 pt-xl-2 pt-xxl-0" href="{{ $ps->best_seller_banner_link }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->best_seller_banner) }}" alt=""
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                        @endif
                        @if ($ps->best_seller_banner1)
                        <a class="banner-effect sider-bar-align second mt-lg-4 pt-2 mt-xl-2 pb-md-3 pb-xl-3 pb-xxl-0" href="{{ $ps->best_seller_banner_link1 }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->best_seller_banner1) }}" alt=""
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Phone and Accessories Area start-->
@endif