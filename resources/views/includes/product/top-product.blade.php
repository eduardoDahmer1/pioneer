@php
if ($gs->switch_highlight_currency) {
    $highlight = $prod->firstCurrencyPrice();
    $small = $prod->showPrice();
} else {
    $highlight = $prod->showPrice();
    $small = $prod->firstCurrencyPrice();
}
@endphp

<div class="col-lg-3 col-md-3 col-6 remove-padding">
    <a class="item" href="{{ route('front.product', $prod->slug) }}">
        @if (!is_null($prod->discount_percent))
            <span class="badge badge-danger descont-card">
                {{ $prod->discount_percent . '%' }} &nbsp;
                <span style="font-weight: lighter">
                    {{ 'OFF' }}
                </span>
            </span>
        @endif
        <div
            class="item-img {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0
                ? "
                        baw"
                : '' }}">
            @if ($admstore->reference_code == 1)
                @php $prod = App\Models\Product::findOrFail($prod->id); @endphp
                <div class="sell-area ref">
                    <span class="sale">{{ $prod->ref_code }}</span>
                </div>
            @endif
            @if (!empty($prod->features))
                <div class="sell-area">
                    @foreach ($prod->features as $key => $data1)
                        <span class="sale"
                            style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
                    @endforeach
                </div>
            @endif
            <div class="extra-list">
                <ul>
                    <li>
                        @if (Auth::guard('web')->check())
                            <span href="javascript:;" class="add-to-wish"
                                data-href="{{ route('user-wishlist-add', $prod->id) }}" data-toggle="tooltip"
                                data-placement="right" title="{{ __('Add To Wishlist') }}" data-placement="right"><i
                                    class="icofont-ui-love-add"></i>
                            </span>
                        @else
                            <span href="javascript:;" rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}"
                                data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"
                                data-placement="right">
                                <i class="icofont-ui-love-add"></i>
                            </span>
                        @endif
                    </li>
                    <li>
                        <span class="quick-view" rel-toggle="tooltip" title="{{ __('Quick View') }}"
                            href="javascript:;" data-href="{{ route('product.quick', $prod->id) }}" data-toggle="modal"
                            data-target="#quickview" data-placement="right"> <i class="icofont-eye-alt"></i>
                        </span>
                    </li>
                    <li>
                        <span href="javascript:;" class="add-to-compare"
                            data-href="{{ route('product.compare.add', $prod->id) }}" data-toggle="tooltip"
                            data-placement="right" title="{{ __('Compare') }}" data-placement="right">
                            <i class="icofont-exchange"></i>
                        </span>
                    </li>
                </ul>
            </div>
            <img class="img-fluid"
                src="{{ filter_var($prod->thumbnail, FILTER_VALIDATE_URL)
                    ? $prod->thumbnail
                    : asset('storage/images/thumbnails/' . $prod->thumbnail) }}"
                alt="">
            @if ($admstore->reference_code == 1)
                <span class="badge badge-primary"
                    style="background-color: {{ $admstore->ref_color }}">{{ $prod->ref_code }}</span>
            @endif
        </div>
        <div class="info">
            @if ($gs->is_rating == 1)
                <div class="stars">
                    <div class="ratings">
                        <div class="empty-stars"></div>
                        <div class="full-stars" style="width:{{ App\Models\Rating::ratings($prod->id) }}%"></div>
                    </div>
                </div>
            @endif
            @if (!config('features.marketplace'))
                <h4 class="price">{{ $highlight }} @if ($curr->id != $scurrency->id)
                        <small>{{ $small }}</small>
                    @endif
                </h4>
            @else
                <h4 class="price">{{ $prod->showVendorMinPrice() }} até {{ $prod->showVendorMaxPrice() }}
                    @if ($curr->id != $scurrency->id)
                        <small><span id="originalprice">{{ $small }}</span></small>
                    @endif
                </h4>
            @endif
            <h5 class="name">{{ $prod->showName() }}</h5>
            @if ($gs->is_cart)
                <div class="item-cart-area">
                    @if ($prod->product_type == 'affiliate')
                        <span class="add-to-cart-btn affilate-btn"
                            data-href="{{ route('affiliate.product', $prod->slug) }}"><i class="icofont-cart"></i>
                            {{ __('Buy Now') }}
                        </span>
                    @else
                        @if ($prod->emptyStock())
                            <span class="add-to-cart-btn cart-out-of-stock">
                                <i class="icofont-close-circled"></i> {{ __('Out of Stock!') }}
                            </span>
                        @else
                            @if ($gs->is_cart_and_buy_available)
                                <span class="add-to-cart add-to-cart-btn"
                                    data-href="{{ route('product.cart.add', $prod->id) }}">
                                    <i class="icofont-shopping-cart"></i> {{ __('Add To Cart') }}
                                </span>
                                <span class="add-to-cart-quick add-to-cart-btn"
                                    data-href="{{ route('product.cart.quickadd', $prod->id) }}">
                                    <i class="icofont-shopping-cart"></i> {{ __('Buy Now') }}
                                </span>
                            @else
                                <span class="add-to-cart-btn" href="{{ route('front.product', $prod->slug) }}">
                                    {{ __('Details') }}
                                </span>
                            @endif
                        @endif
                    @endif
                </div>
            @else
                <span class="add-to-cart-btn" href="{{ route('front.product', $prod->slug) }}">
                    {{ __('Details') }}
                </span>
            @endif
        </div>
    </a>
</div>
