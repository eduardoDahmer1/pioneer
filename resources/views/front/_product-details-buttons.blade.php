<ul class="ml-0 ml-sm-3 mt-0 w-100">
    <div class="row flex-column flex-sm-row flex-lg-column flex-xl-row justify-content-center justify-content-sm-start align-items-md-center align-items-lg-start align-items-center">
        @if($gs->is_cart)
            @if($productt->product_type == "affiliate")
            <div class="row">
                <li class="add-to-cart add-to-cart-btn d-block shadow-sm prod-btns">
                    <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank">
                        {{ __("Buy Now") }}
                        <i class="fas fa-dollar-sign"></i>
                    </a>
                </li>
            </div>
            @else
                <script>
                    console.log(@json($productt));
                </script>
                @if($productt->emptyStock())
                    <li class="add-to-cart add-to-cart-btn d-block shadow-sm prod-btns">
                        <a href="javascript:;" class="cart-out-of-stock">
                            <i class="icofont-close-circled"></i>
                            {{ __("Out of Stock!") }}</a>
                    </li>
                @else
                    <li class="add-to-cart add-to-cart-btn shadow-sm prod-btns">
                        <a href="javascript:;" id="addcrt">
                            {{ __("Adicionar ao carrinho") }}
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </li>
                    <li class="add-to-cart add-to-cart-btn shadow-sm mt-2 mt-sm-0 mt-lg-2 mt-xl-0 ml-0 ml-sm-3 ml-lg-0 ml-xl-3 prod-btns">
                        <a id="qaddcrt" href="javascript:;">
                            {{ __("Buy Now") }}
                            <i class="fas fa-dollar-sign"></i>
                        </a>
                    </li>
                @endif
            @endif
        @endif
    </div> 

    <div class='row justify-content-center justify-content-sm-start align-items-center w-100 pt-3'>
        @if(Auth::guard('web')->check())
            <li class="favorite">
                <a href="javascript:;" class="add-to-wish shadow-sm" data-href="{{ route('user-wishlist-add',$productt->id) }}">
                    <i class="icofont-ui-love-add"></i>
                </a>
            </li>
        @else
            <li class="favorite">
                <a href="javascript:;" data-toggle="modal" class='shadow-sm' data-target="#comment-log-reg">
                    <i class="icofont-ui-love-add"></i>
                </a>
            </li>
        @endif

        <li class="compare ml-2">
            <a href="javascript:;" class="add-to-compare shadow-sm" data-href="{{ route('product.compare.add',$productt->id) }}">
                <i class="icofont-exchange"></i>
            </a>
        </li>

        @if($gs->is_report)
            {{-- PRODUCT REPORT SECTION --}}
            @if(Auth::guard('web')->check())
                <div class="report-area ml-3">
                    <a href="javascript:;" data-toggle="modal" data-target="#report-modal" class='mt-0'>
                        <i class="fas fa-flag"></i> {{ __("Report This Item") }}
                    </a>
                </div>
            @else
                <div class="report-area ml-3">
                    <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg" class='mt-0'>
                        <i class="fas fa-flag"></i> {{ __("Report This Item") }}
                    </a>
                </div>
            @endif

            {{-- PRODUCT REPORT SECTION ENDS --}}
        @endif
    </div>
</ul>