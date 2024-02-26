@if($ps->featured == 1)
<!-- Phone and Accessories Area start -->
<section class="phone-and-accessories categori-item">
    <div class="container-fluid remove-padding">
        <div class="box">
            <div class="row remove-padding m-auto">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top pl-5">
                        <a class="section-title" href="#">   
                            {{ __("Featured") }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="row w-100 m-auto py-4 px-4 px-md-0">
                @if ($ps->featured_banner or $ps->featured_banner1)
                    <div class="col-10 col-sm-sm-10 col-sm-10 col-md-11 col-xl-10 col-xl-xl-8 row-theme remove-padding">
                        @else
                        <div class="col-10 col-sm-sm-10 col-sm-10 col-md-11 col-xl-10 col-xl-xl-8 remove-padding m-auto">
                            @endif
                            <div class="row m-auto remove-padding w-100 h-100 feature_slidee ">
                            @foreach($feature_products as $prod)
                                <div class="feat_card w-100 ">
                                    @include('front.themes.theme-09.components.slider-product')
                                </div>
                            @endforeach
                            </div>
                        </div>
                        {{-- <div class="col-lg-2 remove-padding d-none d-lg-block">
                            <div class="aside">
                                @if ($ps->featured_banner)
                                <a class="banner-effect sider-bar-align" href="{{ $ps->featured_banner_link }}">
                                    <img src="{{ asset('storage/images/banners/' . $ps->featured_banner) }}"
                                        style="width:100%;border-radius: 5px;" loading="lazy">
                                </a>
                                @endif
                                @if ($ps->featured_banner1)
                                <a class="banner-effect sider-bar-align" href="{{ $ps->featured_banner_link1 }}">
                                    <img src="{{ asset('storage/images/banners/' . $ps->featured_banner1) }}"
                                        style="width:100%;border-radius: 5px;" loading="lazy">
                                </a>
                                @endif
                            </div>
                        </div> --}}
                    </div>
                    
                    {{-- Featured Categories --}}
                    @include('front.themes.theme-09.components.featured-categories')
                    @include('front.themes.theme-09.components.large-banners')
                    @include('front.themes.theme-09.components.flash-deals')
                    @include('front.themes.theme-09.components.logo-slider');
                    {{-- @include('front.themes.theme-09.components.brands-slider') --}}
                    @include('front.themes.theme-09.components.small-banners-2')
                    @include('front.themes.theme-09.components.best-sellers') 
                    @include('front.themes.theme-09.components.hot-sales')
                    
                    <div class="row w-100 m-auto remove-padding">
                            @if ($ps->reviews_store === 1)
                            <div class="col-lg-12 w-80 m-auto mb-4 col-12 col-md-{{$ps->blog_posts === 1 ? '12' : '6'}}">
                                @include('front.themes.theme-09.components.reviews')
                            </div>
                            @endif
                            @if ($ps->blog_posts === 1)
                            <div class="col-lg-12 col-12 m-auto col-md-{{$ps->reviews_store === 1 ? '12' : '6'}} ">
                                @include('front.themes.theme-09.components.blog')
                            </div>
                            @endif
                        </div>
                    {{-- <div class="container-fluid w-90 m-auto">
                        
                    </div> --}}

                    @include('front.themes.theme-09.components.form')
                </div>
            </div>
            
        </div>
        
    </div> 
</section>
<!-- Phone and Accessories Area start-->
@endif