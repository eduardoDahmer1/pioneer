@if($ps->flash_deal == 1)
@php
    $banner_path = asset('assets/images/ofertas_banner.png');
@endphp
<!-- Electronics Area Start -->
<section class="oferta-relampago categori-item electronics-section pb-5">
    <div class="container-fluid position-relative remove-padding">
        <div class="bg-banner position-absolute" style='background: #d90013; background-size: contain; background-repeat: no-repeat;'>
        </div> 
        <div class="row">
            <div class="col-lg-12 col-10 m-auto remove-padding">
                <div class="section-top d-flex justify-content-center align-items-center"> 
                    <a class="" href="https://pioneerinter.com/category/tabacos-25">  
                        <img src="{{ $banner_path }}" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="row items-row p-4 px-md-2 m-auto">
            @if ($ps->flash_deal_banner or $ps->flash_deal_banner1)
            <div class="col-10 col-sm-sm-10 col-sm-10 col-md-11 col-xl-10 col-xl-xl-8 row-theme remove-padding">
                @else
w               <div class="col-10 col-sm-sm-10 col-sm-10 col-md-11 col-xl-10 col-xl-xl-8 m-auto remove-padding">
                    @endif
                    <div class="row m-auto remove-padding w-100 feature_slidee">
                        @foreach($discount_products as $prod)
                            <div class="feat_card w-100">
                                @include('front.themes.theme-09.components.flash-product')
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- <div class="col-lg-2 remove-padding d-none d-lg-block">
                    <div class="aside">
                        @if ($ps->flash_deal_banner)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->flash_deal_banner_link }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->flash_deal_banner) }}" alt=""
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                        @endif
                        @if ($ps->flash_deal_banner1)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->flash_deal_banner_link1 }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->flash_deal_banner1) }}" alt=""
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                        @endif
                    </div>
                </div> --}}
            </div>
        </div>
</section>
<!-- Phone and Accessories Area start-->
@endif