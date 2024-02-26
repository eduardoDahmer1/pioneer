@if(Session::has('cart'))
<div class="dropdownmenu-wrapper">
    <div class="dropdown-cart-header">
        <span class="item-no">
            <span class="cart-quantity">
                {{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
            </span> {{ __("Item(s)") }}
        </span>

        <a class="view-cart" href="{{ route('front.cart') }}">
            {{ __("View Cart") }}
        </a>
    </div><!-- End .dropdown-cart-header -->
    <ul class="dropdown-cart-products">
        @foreach(Session::get('cart')->items as $product)
        @php
        $custom_item_id =
        $product['item']['id'].$product['size'].$product['material'].$product['color'].$product['customizable_gallery'].$product['customizable_name'].$product['customizable_number'].$product['customizable_logo'].str_replace(str_split('
        ,'),'',$product['values']);
        $custom_item_id = str_replace( array( '\'', '"', ',', '.', ' ', ';', '<', '>' ), '' , $custom_item_id); @endphp
            <li class="product cremove{{ str_replace(['~', '/', '-'],'',$custom_item_id) }}">
            <div class="product-details">
                <div class="content">
                    <a href="{{ route('front.product',$product['item']['slug']) }}">
                        <h4 class="product-title">
                            {{mb_strlen($product['item']->name,'utf-8') > 45 ?
                            mb_substr($product['item']->name,0,45,'utf-8').'...' : $product['item']->name}}
                        </h4>
                    </a>

                    <span class="cart-product-info">
                        <span class="cart-product-qty" id="cqt{{ $custom_item_id }}">{{$product['qty']}}</span><span>{{
                            $product['item']['measure'] }}</span>
                        x <span id="prct{{ $custom_item_id }}">{{
                            App\Models\Product::convertPrice($product['item']['price']) }}</span>
                    </span>
                </div>
            </div><!-- End .product-details -->

            <figure class="product-image-container">
                <a href="{{ route('front.product', $product['item']['slug']) }}" class="product-image">
                    @if(basename($product['item']->thumbnail) !== 'noimage.png' && $product['item']->thumbnail && !filter_var($product['item']->thumbnail, FILTER_VALIDATE_URL))
                        <img src="{{ asset('storage/images/thumbnails/' . $product['item']->thumbnail) }}"  alt="product">
                    @elseif(basename($product['item']->thumbnail) !== 'noimage.png' && $product['item']->thumbnail && filter_var($product['item']->thumbnail, FILTER_VALIDATE_URL))
                        <img src="{{ $product['item']->thumbnail }}"  alt="product">
                    @elseif(basename($product['item']->photo) !== 'noimage.png' && $product['item']->photo && !filter_var($product['item']->thumbnail, FILTER_VALIDATE_URL))
                        <img src="{{ asset('storage/images/products/' . $product['item']->photo) }}"  alt="product">
                    @elseif(basename($product['item']->photo) !== 'noimage.png' && $product['item']->photo && filter_var($product['item']->thumbnail, FILTER_VALIDATE_URL))
                        <img src="{{ $product['item']->photo }}"  alt="product">
                    @elseif(isset($product['item']->galleries[0]) && filter_var($product['item']->galleries[0]->photo, FILTER_VALIDATE_URL))
                        <img src="{{ $product['item']->galleries[0]->photo }}"  alt="product">
                    @elseif(isset($product['item']->galleries[0]))
                        <img src="{{ asset('storage/images/galleries/'.$product['item']->galleries[0]->photo) }}" xoriginal="{{ $product['item']->galleries[0]->photo }}"  alt="product"/>
                    @else
                        <img src="{{ asset('assets/images/noimage.png') }}" xoriginal="{{ asset('assets/images/noimage.png') }}" />
                    @endif
                </a>
                <div class="cart-remove" data-class="cremove{{ str_replace(['~', '/', '-'],'',$custom_item_id) }}"
                    data-href="{{ route('product.cart.remove',$custom_item_id) }}" title="Remove Product">
                    <i class="icofont-close"></i>
                </div>
            </figure>
            </li><!-- End .product -->
            @endforeach
    </ul><!-- End .cart-product -->

    <div class="dropdown-cart-total">
        <span>{{ __("Total") }}</span>

        <span class="cart-total-price">
            <span class="cart-total">{{ Session::has('cart') ?
                App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}
            </span>
        </span>
    </div><!-- End .dropdown-cart-total -->

    @if($gs->is_standard_checkout)
    <div class="dropdown-cart-action">
        <a href="{{ route('front.checkout') }}" class="mybtn1">{{ __("Checkout") }}</a>
    </div><!-- End .dropdown-cart-total -->
    @endif

    @if($gs->is_simplified_checkout && (!empty($gs->simplified_checkout_number)))
    <div class="dropdown-cart-action">
        <a href="#" class="mybtn1" data-toggle="modal" data-target="#simplified-checkout-modal">{{ __("Simplified Checkout") }}</a>
    </div>
    @endif
</div>
@else
<p class="mt-1 pl-3 text-left">{{ __("Cart is empty.") }}</p>
@endif
