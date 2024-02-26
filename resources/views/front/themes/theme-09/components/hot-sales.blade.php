@if($ps->hot_sale == 1)
<!-- hot-and-new-item Area Start -->
<section class="hot-and-new-item py-3 px-4 mt-4">
    <div class="container-fluid remove-padding">
        <div class="row">
            <div class="col-lg-12">
                <div class="accessories-slider">
                    <div class="slide-item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                        {{ __("Hot") }}
                                        </h2>
                                    </div>
                                    <div class="hot-and-new-item-slider mb-5 row-theme border rounded">
                                        {{-- <div class="shadow-overlay"></div> --}}
                                        @foreach($hot_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('front.themes.theme-09.components.list-product')
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                            {{ __("New") }}
                                        </h2>
                                    </div>

                                    <div class="hot-and-new-item-slider mb-5 row-theme border rounded">
                                        {{-- <div class="shadow-overlay"></div> --}}
                                        @foreach($latest_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('front.themes.theme-09.components.list-product')
                                            </ul>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                            {{ __("Trending") }}
                                        </h2>
                                    </div>


                                    <div class="hot-and-new-item-slider mb-5 row-theme border rounded">
                                        {{-- <div class="shadow-overlay"></div> --}}
                                        @foreach($trending_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('front.themes.theme-09.components.list-product')
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="categori">
                                    <div class="section-top">
                                        <h2 class="section-title">
                                            {{ __("Sale") }}
                                        </h2>
                                    </div>
                                    <div class="hot-and-new-item-slider mb-5 row-theme border rounded">
                                        {{-- <div class="shadow-overlay"></div> --}}
                                        @foreach($sale_products as $prod)
                                        <div class="item-slide">
                                            <ul class="item-list">
                                                @include('front.themes.theme-09.components.list-product')
                                            </ul>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Clothing and Apparel Area start-->
@endif
