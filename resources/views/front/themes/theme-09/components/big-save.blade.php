@if ($ps->big == 1)
    <!-- Clothing and Apparel Area Start -->
    <section class="categori-item clothing-and-Apparel-Area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top">
                        <a class="section-title" href="https://www.pioneerinter.com/category/perfumes-cosmeticos-maquiag-6/perfumes-27">   
                            {{ __("Big Save") }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($ps->big_save_banner or $ps->big_save_banner1)
                    <div class="col-lg-10">
                    @else
                        <div class="col-lg-12">
                @endif
                <div class="row row-theme">
                    @foreach ($big_products as $prod)
                        @include('front.themes.theme-09.components.home-product')
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2 remove-padding d-none d-lg-block">
                <div class="aside">
                    @if ($ps->big_save_banner)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->big_save_banner_link }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->big_save_banner) }}" alt=""
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                    @endif
                    @if ($ps->big_save_banner1)
                        <a class="banner-effect sider-bar-align" href="{{ $ps->big_save_banner_link1 }}">
                            <img src="{{ asset('storage/images/banners/' . $ps->big_save_banner1) }}" alt=""
                                style="width:100%;border-radius: 5px;" loading="lazy">
                        </a>
                    @endif
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- Clothing and Apparel Area start-->
@endif
