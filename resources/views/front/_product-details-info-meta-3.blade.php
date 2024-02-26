<div class="info-meta-3 py-0 py-sm-2 ml-5 ml-lg-4 ml-xl-5 d-flex align-items-center">
    <ul class="meta-list">
        @include('front._product-details-info-meta-3-vendor')

        

        @include('front._product-details-info-meta-3-custom')

        @include('front._product-details-info-meta-3-custom-number')

        {{-- @if($gs->is_cart)

            @if($productt->product_type == "affiliate")
            <div class="row">
                <li class="addtocart">
                    <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"><i class="icofont-cart"></i>
                        {{ __("Buy Now") }}
                    </a>
                </li>
            </div>
            @else
                @if($productt->emptyStock())
                    <li class="addtocart">
                        <a href="javascript:;" class="cart-out-of-stock">
                            <i class="icofont-close-circled"></i>
                            {{ __("Out of Stock!") }}</a>
                    </li>
                @else
                    <li class="addtocart">
                        <a href="javascript:;" id="addcrt">
                            <i class="icofont-shopping-cart"></i>{{ __("Add to Cart") }}
                        </a>
                    </li>
                    <li class="addtocart">
                        <a id="qaddcrt" href="javascript:;">
                            <i class="icofont-shopping-cart"></i>{{ __("Buy Now") }}
                        </a>
                    </li>
                @endif
            @endif
        @endif
 --}}
        
    </ul>
</div>
