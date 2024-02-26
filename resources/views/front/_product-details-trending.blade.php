<!-- Trending Item Area Start -->
@if(!empty($related_products))
    <div class="trending py-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top">
                        <h2 class="section-title">
                            {{ __("Related Products") }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-10 mx-auto remove-padding">
                    <div class="trending-item-slider">
                        @foreach($related_products as $prod)
                            <div class="feat_card">
                                @include('front.themes.theme-09.components.slider-product')
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Tranding Item Area End -->
