@php
    $gs->is_rating = 1;
@endphp

@php
if ($gs->switch_highlight_currency) {
    $highlight = $prod->firstCurrencyPrice();
    $small = $prod->showPrice();
} else {
    $highlight = $prod->showPrice();
    $small = $prod->firstCurrencyPrice();
}
@endphp

{{-- If This product belongs to vendor then apply this --}}
@if ($prod->user_id != 0)

    {{-- check If This vendor status is active --}}
    @if ($prod->user->is_vendor == 2)
        @if (isset($_GET['max']))
            @if ($prod->vendorPrice() <= $_GET['max'])
                <div class="remove-padding w-100 h-100">
                    <a href="{{ route('front.product', $prod->slug) }}" class="item d-flex flex-column">
                        {{-- @if (!is_null($prod->discount_percent))
                            <span class="badge badge-danger descont-card">
                                {{ $prod->discount_percent . '%' }} &nbsp;
                                <span style="font-weight: lighter">
                                    {{ 'OFF' }}
                                </span>
                            </span>
                        @endif --}}
                        <div class="info px-4">
                            <h5 class="name">{{ $prod->capitalize_name }}</h5>
                            @if($prod->previous_price)
                                <span class="d-flex text-align-left" style="text-decoration: line-through; color: #bababa;">{{$scurrency->sign}}{{$prod->previous_price}}</span>
                            @endif
                            <h4 class="price">{{ $highlight }} @if ($curr->id != $scurrency->id)
                                    <small><span id="originalprice">{{ $small }}</span></small>
                                @endif
                            </h4>
                        </div>

                        <div
                        class="item-img position-static d-flex flex-column justify-content-center align-items-center  w-75 mx-auto mb-0 {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0 ? 'baw' : '' }}">
                            @if ($admstore->reference_code == 1)
                                @php $prod = App\Models\Product::findOrFail($prod->id); @endphp
                                <div class="sell-area ref d-none d-md-block">
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
                            <div class="extra-list w-100">
                                <ul class='d-flex justify-content-center align-items-center'>
                                    <li>
                                        @if (Auth::guard('web')->check())
                                            <span class="add-to-wish shadow-sm" data-href="{{ route('user-wishlist-add', $prod->id) }}"
                                                data-toggle="tooltip" data-placement="right"
                                                title="{{ __('Add To Wishlist') }}" data-placement="right">
                                                <svg width="25" height="25" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                                                </svg>

                                            </span>
                                        @else
                                            <span rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal"
                                                id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                                <svg width="25" height="25" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        @endif
                                    </li>
                                    <li>
                                        <span class="quick-view shadow-sm" rel-toggle="tooltip" title="{{ __('Quick View') }}"
                                            href="javascript:;" data-href="{{ route('product.quick', $prod->id) }}"
                                            data-toggle="modal" data-target="#quickview" data-placement="right">
                                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.59021 16.1788C5.96031 14.6278 8.03917 12.8516 10.7086 11.6419C9.2574 13.2476 8.45532 15.3357 8.45844 17.5C8.45844 19.7531 9.3101 21.8072 10.7086 23.3581C8.03989 22.1484 5.96031 20.3722 4.59021 18.8213C4.26385 18.4586 4.08328 17.9879 4.08328 17.5C4.08328 17.0121 4.26385 16.5414 4.59021 16.1788ZM3.49719 15.2133C5.98219 12.4002 10.705 8.81781 17.0786 8.75073L17.2084 8.75H17.2595C23.7243 8.75 28.5127 12.374 31.021 15.2133C31.5828 15.8426 31.8932 16.6565 31.8932 17.5C31.8932 18.3435 31.5828 19.1574 31.021 19.7867C28.5127 22.626 23.7243 26.25 17.2595 26.25H17.2084L17.0786 26.2493C10.7057 26.1822 5.98219 22.5998 3.49719 19.7867C2.93547 19.1574 2.625 18.3435 2.625 17.5C2.625 16.6565 2.93547 15.8426 3.49719 15.2133ZM17.2289 10.2083L17.0969 10.2091C13.1207 10.2689 9.91677 13.51 9.91677 17.5C9.91677 21.49 13.1215 24.7311 17.0969 24.7909L17.2289 24.7917C21.2466 24.7807 24.5001 21.5199 24.5001 17.5C24.5001 13.4801 21.2466 10.2193 17.2289 10.2083ZM25.9584 17.5C25.9584 19.7896 25.0783 21.875 23.6382 23.4347C26.3901 22.2243 28.5287 20.405 29.928 18.8213C30.2544 18.4586 30.4349 17.9879 30.4349 17.5C30.4349 17.0121 30.2544 16.5414 29.928 16.1788C28.5287 14.595 26.3901 12.7757 23.6382 11.5653C25.1327 13.1799 25.9615 15.2999 25.9584 17.5ZM17.2595 21.875C17.9987 21.8752 18.7259 21.688 19.3732 21.3311C20.0205 20.9741 20.5668 20.4589 20.9611 19.8336C21.3554 19.2084 21.5849 18.4934 21.628 17.7554C21.6712 17.0175 21.5266 16.2806 21.2079 15.6136C21.0734 15.7529 20.9125 15.864 20.7345 15.9405C20.5566 16.0169 20.3653 16.0571 20.1716 16.0588C19.978 16.0605 19.786 16.0236 19.6067 15.9503C19.4275 15.8769 19.2647 15.7686 19.1278 15.6317C18.9908 15.4948 18.8825 15.332 18.8092 15.1527C18.7359 14.9735 18.699 14.7815 18.7007 14.5879C18.7024 14.3942 18.7426 14.2029 18.819 14.0249C18.8954 13.847 19.0065 13.6861 19.1458 13.5516C18.5533 13.2688 17.9048 13.123 17.2483 13.125C16.5918 13.127 15.9441 13.2767 15.3533 13.5631C14.7626 13.8494 14.2438 14.2651 13.8355 14.7792C13.4272 15.2933 13.1399 15.8927 12.9948 16.533C12.8497 17.1733 12.8505 17.838 12.9973 18.4779C13.144 19.1178 13.4329 19.7165 13.8425 20.2296C14.2521 20.7426 14.7719 21.157 15.3634 21.4418C15.9549 21.7266 16.603 21.8747 17.2595 21.875Z" fill="#333333"/>
                                            </svg>
 

                                        </span>
                                    </li>
                                    <li>
                                        <span class="add-to-compare shadow-sm" data-href="{{ route('product.compare.add', $prod->id) }}"
                                            data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                                            data-placement="right">
                                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M24.375 18.5556V6.24998C24.375 5.60904 24.1204 4.99435 23.6672 4.54114C23.2139 4.08793 22.5993 3.83331 21.9583 3.83331H15.7088L17.6252 1.9169L15.9167 0.208313L12.7919 3.33306L11.0833 5.04165L12.7919 6.75023L15.9167 9.87498L17.6252 8.1664L15.7088 6.24998H21.9583V18.5556C21.1521 18.8407 20.4726 19.4016 20.0399 20.1391C19.6073 20.8767 19.4493 21.7435 19.5939 22.5863C19.7385 23.4291 20.1764 24.1937 20.8301 24.7449C21.4839 25.296 22.3115 25.5983 23.1667 25.5983C24.0218 25.5983 24.8494 25.296 25.5032 24.7449C26.157 24.1937 26.5948 23.4291 26.7394 22.5863C26.8841 21.7435 26.7261 20.8767 26.2934 20.1391C25.8607 19.4016 25.1812 18.8407 24.375 18.5556ZM14.2081 20.2497L11.0833 17.125L9.37474 18.8336L11.2912 20.75H5.04165V8.44431C5.84787 8.15927 6.52737 7.5984 6.96004 6.86082C7.39272 6.12324 7.55072 5.25644 7.40612 4.41364C7.26151 3.57083 6.82362 2.80627 6.16983 2.2551C5.51604 1.70393 4.68844 1.40163 3.83332 1.40163C2.9782 1.40163 2.15061 1.70393 1.49681 2.2551C0.843023 2.80627 0.405129 3.57083 0.260526 4.41364C0.115923 5.25644 0.273923 6.12324 0.706599 6.86082C1.13928 7.5984 1.81877 8.15927 2.62499 8.44431V20.75C2.62499 21.3909 2.8796 22.0056 3.33281 22.4588C3.78603 22.912 4.40071 23.1666 5.04165 23.1666H11.2912L9.37474 25.0831L11.0833 26.7916L14.2081 23.6669L15.9167 21.9583L14.2081 20.2497Z" fill="#333333"/>
                                            </svg>
 
 
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            @if(basename($prod->thumbnail) !== 'noimage.png' && $prod->thumbnail)
                            <img class="img d-block" src="{{ asset('storage/images/thumbnails/' . $prod->thumbnail) }}" alt="">
                            @elseif(basename($prod->photo) !== 'noimage.png' && $prod->photo)
                                <img class="img d-block" src="{{ asset('storage/images/products/' . $prod->photo) }}" alt="">
                            @elseif(isset($prod->galleries[0]) && filter_var($prod->galleries[0]->photo, FILTER_VALIDATE_URL))
                                <img class="img d-block " src="{{ $prod->galleries[0]->photo }}" alt="">
                            @elseif(isset($prod->galleries[0]))
                                <img class="img d-block" src="{{ asset('storage/images/galleries/'.$prod->galleries[0]->photo) }}" xoriginal="{{ $prod->galleries[0]->photo }}" />
                            @else
                                <img class="img d-block" src="{{ asset('assets/images/noimage.png') }}" xoriginal="{{ asset('assets/images/noimage.png') }}" />
                            @endif

                            @if ($gs->is_rating == 1)
                                <div class="stars">
                                    <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars"
                                            style="width:{{ App\Models\Rating::ratings($prod->id) }}%"></div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($gs->is_cart)
                            <div class="item-cart-area w-100 mt-2 px-2 px-lg-4 d-flex justify-content-center">
                                @if ($prod->product_type == 'affiliate')
                                    <span class="add-to-cart-btn affilate-btn"
                                        data-href="{{ route('affiliate.product', $prod->slug) }}">
                                        {{ __('Buy Now') }}
                                    </span>
                                @else
                                    @if ($prod->stock === 0)
                                        <span class="add-to-cart-btn cart-out-of-stock">
                                            <i class="icofont-close-circled"></i> {{ __('Out of Stock!') }}
                                        </span>
                                    @else
                                        @if ($gs->is_cart_and_buy_available)
                                            <span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add', $prod->id) }}">
                                                {{ __('Adicionar ao carrinho') }}
                                                <i class="fas fa-plus-circle"></i>
                                                {{-- <svg width="25" height="23" viewBox="0 0 25 23" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_305_10)">
                                                    <path d="M1.04167 0C0.46441 0 0 0.46441 0 1.04167C0 1.61892 0.46441 2.08333 1.04167 2.08333H3.30295L5.92014 15.8203C6.01563 16.3108 6.44531 16.6667 6.94444 16.6667H21.1806C21.7578 16.6667 22.2222 16.2023 22.2222 15.625C22.2222 15.0477 21.7578 14.5833 21.1806 14.5833H7.80816L7.41319 12.5H21.1719C21.7925 12.5 22.3394 12.0877 22.5087 11.4887L24.8524 3.15538C25.0998 2.26997 24.4358 1.38889 23.5156 1.38889H5.29514L5.19097 0.846354C5.09549 0.355903 4.6658 0 4.16667 0H1.04167ZM7.63889 22.2222C8.78906 22.2222 9.72222 21.2891 9.72222 20.1389C9.72222 18.9887 8.78906 18.0556 7.63889 18.0556C6.48872 18.0556 5.55556 18.9887 5.55556 20.1389C5.55556 21.2891 6.48872 22.2222 7.63889 22.2222ZM22.2222 20.1389C22.2222 18.9887 21.2891 18.0556 20.1389 18.0556C18.9887 18.0556 18.0556 18.9887 18.0556 20.1389C18.0556 21.2891 18.9887 22.2222 20.1389 22.2222C21.2891 22.2222 22.2222 21.2891 22.2222 20.1389ZM10.9375 6.94444C10.9375 6.46701 11.3281 6.07639 11.8056 6.07639H13.7153V4.16667C13.7153 3.68924 14.1059 3.29861 14.5833 3.29861C15.0608 3.29861 15.4514 3.68924 15.4514 4.16667V6.07639H17.3611C17.8385 6.07639 18.2292 6.46701 18.2292 6.94444C18.2292 7.42188 17.8385 7.8125 17.3611 7.8125H15.4514V9.72222C15.4514 10.1997 15.0608 10.5903 14.5833 10.5903C14.1059 10.5903 13.7153 10.1997 13.7153 9.72222V7.8125H11.8056C11.3281 7.8125 10.9375 7.42188 10.9375 6.94444Z" fill="currentColor"/>
                                                    </g>
                                                    <defs>
                                                    <clipPath id="clip0_305_10">
                                                    <rect width="25" height="22.2222" fill="white"/>
                                                    </clipPath>
                                                    </defs>
                                                </svg> --}}
                                            </span>
                                            {{-- <span class="add-to-cart-quick add-to-cart-btn d-block"
                                                data-href="{{ route('product.cart.quickadd', $prod->id) }}">
                                                {{ __('Adicionar ao carrinho') }}
                                                <i class="fas fa-plus-circle"></i>
                                            </span> --}}
                                        @else
                                            <span class="add-to-cart-btn"
                                                href="{{ route('front.product', $prod->slug) }}">
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

                    </a>

                </div>

            @endif
        @else
            <div class="remove-padding w-100 h-100">

                <a href="{{ route('front.product', $prod->slug) }}" class="item d-flex flex-column">
                    {{-- @if (!is_null($prod->discount_percent))
                        <span class="badge badge-danger descont-card">
                            {{ $prod->discount_percent . '%' }} &nbsp;
                            <span style="font-weight: lighter">
                                {{ 'OFF' }}
                            </span>
                        </span>
                    @endif --}}


                    <div
                    class="item-img position-static d-flex flex-column justify-content-center align-items-center w-75 mx-auto mb-0 {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0 ? 'baw' : '' }}">
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
                        <div class="extra-list w-100">
                            <ul class='d-flex justify-content-center align-items-center'>
                                <li>
                                    @if (Auth::guard('web')->check())
                                        <span class="add-to-wish shadow-sm" data-href="{{ route('user-wishlist-add', $prod->id) }}"
                                            data-toggle="tooltip" data-placement="right" title="{{ __('Add To Wishlist') }}"
                                            data-placement="right">
                                            <svg width="25" height="25" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    @else
                                        <span class='shadow-sm' rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal"
                                            id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                            <svg width="25" height="25" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    @endif
                                </li>
                                <li>
                                    <span class="quick-view shadow-sm" rel-toggle="tooltip" title="{{ __('Quick View') }}"
                                        href="javascript:;" data-href="{{ route('product.quick', $prod->id) }}"
                                        data-toggle="modal" data-target="#quickview" data-placement="right">
                                        <svg width="25" height="25" viewBox="0 0 28 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M27.8308 11.7347C25.1946 6.59118 19.9757 3.11111 14 3.11111C8.02421 3.11111 2.80386 6.59361 0.16914 11.7352C0.0579382 11.9552 0 12.1982 0 12.4447C0 12.6912 0.0579382 12.9342 0.16914 13.1542C2.80532 18.2977 8.02421 21.7778 14 21.7778C19.9757 21.7778 25.1961 18.2953 27.8308 13.1537C27.942 12.9337 27.9999 12.6907 27.9999 12.4442C27.9999 12.1977 27.942 11.9547 27.8308 11.7347V11.7347ZM14 19.4444C12.6155 19.4444 11.2621 19.0339 10.111 18.2647C8.95984 17.4956 8.06263 16.4023 7.53282 15.1232C7.003 13.8441 6.86438 12.4367 7.13448 11.0788C7.40457 9.72095 8.07126 8.47367 9.05023 7.4947C10.0292 6.51573 11.2765 5.84905 12.6343 5.57895C13.9922 5.30885 15.3997 5.44748 16.6788 5.97729C17.9578 6.5071 19.0511 7.40431 19.8203 8.55546C20.5894 9.7066 21 11.06 21 12.4444C21.0004 13.3638 20.8197 14.2743 20.468 15.1238C20.1164 15.9732 19.6008 16.7451 18.9507 17.3952C18.3006 18.0453 17.5288 18.5609 16.6793 18.9125C15.8298 19.2641 14.9194 19.4449 14 19.4444V19.4444ZM14 7.77778C13.5834 7.7836 13.1696 7.84557 12.7696 7.96202C13.0993 8.41005 13.2575 8.96141 13.2156 9.51609C13.1736 10.0708 12.9342 10.592 12.5409 10.9854C12.1476 11.3787 11.6263 11.6181 11.0716 11.66C10.5169 11.702 9.96558 11.5438 9.51754 11.2141C9.26242 12.154 9.30847 13.1503 9.64922 14.0627C9.98997 14.9751 10.6083 15.7577 11.4171 16.3003C12.2259 16.8428 13.1845 17.1181 14.1579 17.0874C15.1314 17.0566 16.0707 16.7214 16.8437 16.1288C17.6166 15.5363 18.1843 14.7162 18.4668 13.7842C18.7492 12.8521 18.7323 11.8549 18.4184 10.9329C18.1044 10.011 17.5093 9.21066 16.7167 8.64467C15.9241 8.07868 14.9739 7.77549 14 7.77778V7.77778Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </li>
                                <li>
                                    <span class="add-to-compare shadow-sm" data-href="{{ route('product.compare.add', $prod->id) }}"
                                        data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                                        data-placement="right">
                                        <svg width="25" height="25" viewBox="0 0 28 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.6666 16.3333L12.8333 10.5L18.6666 4.66666L20.3 6.32916L17.2958 9.33333H25.6666V11.6667H17.2958L20.3 14.6708L18.6666 16.3333ZM9.33331 23.3333L15.1666 17.5L9.33331 11.6667L7.69998 13.3292L10.7041 16.3333H2.33331V18.6667H10.7041L7.69998 21.6708L9.33331 23.3333Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        @if(basename($prod->thumbnail) !== 'noimage.png' && $prod->thumbnail)
                            <img class="img-fluid" src="{{ asset('storage/images/thumbnails/' . $prod->thumbnail) }}" alt="">
                        @elseif(basename($prod->photo) !== 'noimage.png' && $prod->photo)
                            <img class="img-fluid" src="{{ asset('storage/images/products/' . $prod->photo) }}" alt="">
                        @elseif(isset($prod->galleries[0]) && filter_var($prod->galleries[0]->photo, FILTER_VALIDATE_URL))
                            <img class="img-fluid" src="{{ $prod->galleries[0]->photo }}" alt="">
                        @elseif(isset($prod->galleries[0]))
                            <img class="img-fluid" src="{{ asset('storage/images/galleries/'.$prod->galleries[0]->photo) }}" xoriginal="{{ $prod->galleries[0]->photo }}" />
                        @else
                            <img class="img-fluid" src="{{ asset('assets/images/noimage.png') }}" xoriginal="{{ asset('assets/images/noimage.png') }}" />
                        @endif
                        @if ($gs->is_rating == 1)
                            <div class="stars">
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                    <div class="full-stars"
                                        style="width:{{ App\Models\Rating::ratings($prod->id) }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="info px-4">

                        <h5 class="name">{{ $prod->capitalize_name }}</h5>
                        @if($prod->previous_price)
                            <span class="d-flex text-align-left" style="text-decoration: line-through; color: #bababa;">{{$scurrency->sign}}{{$prod->previous_price}}</span>
                        @endif    
                        <h4 class="price">{{ $highlight }} @if ($curr->id != $scurrency->id)
                                <small><span id="originalprice">{{ $small }}</span></small>
                            @endif
                        </h4>
                    </div>

                    @if ($gs->is_cart)
                        <div class="item-cart-area w-100 mt-2 px-2 px-lg-4 d-flex justify-content-center">
                            @if ($prod->product_type == 'affiliate')
                                <span class="add-to-cart-btn affilate-btn"
                                    data-href="{{ route('affiliate.product', $prod->slug) }}">
                                    {{ __('Buy Now') }}
                                </span>
                            @else
                                @if ($prod->stock === 0)
                                    <span class="add-to-cart-btn cart-out-of-stock">
                                        <i class="icofont-close-circled"></i> {{ __('Out of Stock!') }}
                                    </span>
                                @else
                                    @if ($gs->is_cart_and_buy_available)
                                        <span class="add-to-cart add-to-cart-btn shadow-sm d-block" data-href="{{ route('product.cart.add', $prod->id) }}">
                                            {{ __('Adicionar ao carrinho') }}
                                            <i class="fas fa-plus-circle"></i>
                                            
                                            {{-- <svg width="25" height="23" viewBox="0 0 25 23" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_305_10)">
                                                <path d="M1.04167 0C0.46441 0 0 0.46441 0 1.04167C0 1.61892 0.46441 2.08333 1.04167 2.08333H3.30295L5.92014 15.8203C6.01563 16.3108 6.44531 16.6667 6.94444 16.6667H21.1806C21.7578 16.6667 22.2222 16.2023 22.2222 15.625C22.2222 15.0477 21.7578 14.5833 21.1806 14.5833H7.80816L7.41319 12.5H21.1719C21.7925 12.5 22.3394 12.0877 22.5087 11.4887L24.8524 3.15538C25.0998 2.26997 24.4358 1.38889 23.5156 1.38889H5.29514L5.19097 0.846354C5.09549 0.355903 4.6658 0 4.16667 0H1.04167ZM7.63889 22.2222C8.78906 22.2222 9.72222 21.2891 9.72222 20.1389C9.72222 18.9887 8.78906 18.0556 7.63889 18.0556C6.48872 18.0556 5.55556 18.9887 5.55556 20.1389C5.55556 21.2891 6.48872 22.2222 7.63889 22.2222ZM22.2222 20.1389C22.2222 18.9887 21.2891 18.0556 20.1389 18.0556C18.9887 18.0556 18.0556 18.9887 18.0556 20.1389C18.0556 21.2891 18.9887 22.2222 20.1389 22.2222C21.2891 22.2222 22.2222 21.2891 22.2222 20.1389ZM10.9375 6.94444C10.9375 6.46701 11.3281 6.07639 11.8056 6.07639H13.7153V4.16667C13.7153 3.68924 14.1059 3.29861 14.5833 3.29861C15.0608 3.29861 15.4514 3.68924 15.4514 4.16667V6.07639H17.3611C17.8385 6.07639 18.2292 6.46701 18.2292 6.94444C18.2292 7.42188 17.8385 7.8125 17.3611 7.8125H15.4514V9.72222C15.4514 10.1997 15.0608 10.5903 14.5833 10.5903C14.1059 10.5903 13.7153 10.1997 13.7153 9.72222V7.8125H11.8056C11.3281 7.8125 10.9375 7.42188 10.9375 6.94444Z" fill="currentColor"/>
                                                </g>
                                                <defs>
                                                <clipPath id="clip0_305_10">
                                                <rect width="25" height="22.2222" fill="white"/>
                                                </clipPath>
                                                </defs>
                                            </svg> --}}
                                        </span>
                                        {{-- <span class="add-to-cart-quick add-to-cart-btn"
                                            data-href="{{ route('product.cart.quickadd', $prod->id) }}">
                                            {{ __('Buy Now') }}
                                        </span> --}}
                                    @else
                                        <span class="add-to-cart-btn"
                                            href="{{ route('front.product', $prod->slug) }}">
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

                </a>

            </div>

        @endif

    @endif

    {{-- If This product belongs admin and apply this --}}
@else
    <div class="remove-padding w-100 h-100">
        <a href="{{ route('front.product', $prod->slug) }}" class="item d-flex flex-column">
            {{-- @if (!is_null($prod->discount_percent))
                <span class="badge badge-danger descont-card">
                    {{ $prod->discount_percent . '%' }} &nbsp;
                    <span style="font-weight: lighter">
                        {{ 'OFF' }}
                    </span>
                </span>
            @endif --}}

            <div
            class="item-img position-static d-flex flex-column justify-content-center align-items-center  w-75 mx-auto mb-0 {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0 ? 'baw' : '' }}">
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
                <div class="extra-list w-100">
                    <ul class="d-flex justify-content-center align-items-center">
                        <li>
                            @if (Auth::guard('web')->check())
                                <span class="add-to-wish shadow-sm" data-href="{{ route('user-wishlist-add', $prod->id) }}"
                                    data-toggle="tooltip" data-placement="right" title="{{ __('Add To Wishlist') }}"
                                    data-placement="right">
                                    <svg width="25" height="25" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            @else
                                <span class='shadow-sm' rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal"
                                    id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                    <svg width="25" height="25" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            @endif
                        </li>
                        <li>
                            <span class="quick-view shadow-sm" rel-toggle="tooltip" title="{{ __('Quick View') }}"
                                href="javascript:;" data-href="{{ route('product.quick', $prod->id) }}"
                                data-toggle="modal" data-target="#quickview" data-placement="right">
                                <svg width="25" height="25" viewBox="0 0 28 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.8308 11.7347C25.1946 6.59118 19.9757 3.11111 14 3.11111C8.02421 3.11111 2.80386 6.59361 0.16914 11.7352C0.0579382 11.9552 0 12.1982 0 12.4447C0 12.6912 0.0579382 12.9342 0.16914 13.1542C2.80532 18.2977 8.02421 21.7778 14 21.7778C19.9757 21.7778 25.1961 18.2953 27.8308 13.1537C27.942 12.9337 27.9999 12.6907 27.9999 12.4442C27.9999 12.1977 27.942 11.9547 27.8308 11.7347V11.7347ZM14 19.4444C12.6155 19.4444 11.2621 19.0339 10.111 18.2647C8.95984 17.4956 8.06263 16.4023 7.53282 15.1232C7.003 13.8441 6.86438 12.4367 7.13448 11.0788C7.40457 9.72095 8.07126 8.47367 9.05023 7.4947C10.0292 6.51573 11.2765 5.84905 12.6343 5.57895C13.9922 5.30885 15.3997 5.44748 16.6788 5.97729C17.9578 6.5071 19.0511 7.40431 19.8203 8.55546C20.5894 9.7066 21 11.06 21 12.4444C21.0004 13.3638 20.8197 14.2743 20.468 15.1238C20.1164 15.9732 19.6008 16.7451 18.9507 17.3952C18.3006 18.0453 17.5288 18.5609 16.6793 18.9125C15.8298 19.2641 14.9194 19.4449 14 19.4444V19.4444ZM14 7.77778C13.5834 7.7836 13.1696 7.84557 12.7696 7.96202C13.0993 8.41005 13.2575 8.96141 13.2156 9.51609C13.1736 10.0708 12.9342 10.592 12.5409 10.9854C12.1476 11.3787 11.6263 11.6181 11.0716 11.66C10.5169 11.702 9.96558 11.5438 9.51754 11.2141C9.26242 12.154 9.30847 13.1503 9.64922 14.0627C9.98997 14.9751 10.6083 15.7577 11.4171 16.3003C12.2259 16.8428 13.1845 17.1181 14.1579 17.0874C15.1314 17.0566 16.0707 16.7214 16.8437 16.1288C17.6166 15.5363 18.1843 14.7162 18.4668 13.7842C18.7492 12.8521 18.7323 11.8549 18.4184 10.9329C18.1044 10.011 17.5093 9.21066 16.7167 8.64467C15.9241 8.07868 14.9739 7.77549 14 7.77778V7.77778Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </li>
                        <li>
                            <span class="add-to-compare" data-href="{{ route('product.compare.add', $prod->id) }}"
                                data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                                data-placement="right">
                                <svg width="25" height="25" viewBox="0 0 28 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.6666 16.3333L12.8333 10.5L18.6666 4.66666L20.3 6.32916L17.2958 9.33333H25.6666V11.6667H17.2958L20.3 14.6708L18.6666 16.3333ZM9.33331 23.3333L15.1666 17.5L9.33331 11.6667L7.69998 13.3292L10.7041 16.3333H2.33331V18.6667H10.7041L7.69998 21.6708L9.33331 23.3333Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </li>
                    </ul>
                </div>
                @if(basename($prod->thumbnail) !== 'noimage.png' && $prod->thumbnail && !filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img  d-block" src="{{ asset('storage/images/thumbnails/' . $prod->thumbnail) }}" alt="">
                @elseif(basename($prod->thumbnail) !== 'noimage.png' && $prod->thumbnail && filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img d-block" src="{{ $prod->thumbnail }}" alt="">
                @elseif(basename($prod->photo) !== 'noimage.png' && $prod->photo && !filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img d-block" src="{{ asset('storage/images/products/' . $prod->photo) }}" alt="">
                @elseif(basename($prod->photo) !== 'noimage.png' && $prod->photo && filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img d-block" src="{{ $prod->photo }}" alt="">
                @elseif(isset($prod->galleries[0]) && filter_var($prod->galleries[0]->photo, FILTER_VALIDATE_URL))
                    <img class="img d-block" src="{{ $prod->galleries[0]->photo }}" alt="">
                @elseif(isset($prod->galleries[0]))
                    <img class="img d-block" src="{{ asset('storage/images/galleries/'.$prod->galleries[0]->photo) }}" xoriginal="{{ $prod->galleries[0]->photo }}" />
                @else
                    <img class="img d-block" src="{{ asset('assets/images/noimage.png') }}" xoriginal="{{ asset('assets/images/noimage.png') }}" />
                @endif
                @if ($gs->is_rating == 1)
                    <div class="stars">
                        <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:{{ App\Models\Rating::ratings($prod->id) }}%"></div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="info px-4">
                <h5 class="name">{{ $prod->capitalize_name }}</h5>
                @if($prod->previous_price)
                    <span class="d-flex text-align-left" style="text-decoration: line-through; color: #bababa;">
                        {{$scurrency->sign}}{{$prod->previous_price}}
                    </span>
                @else
                    <div class="d-flex text-align-left" style="text-decoration: line-through; color: #bababa; opacity: 0;">
                        {{-- Fake data that is invisible just to keep the layout consistant and not break  --}}
                        10000
                    </div>
                @endif
                <h4 class="price">
                    {{ $highlight }}

                    @if ($curr->id != $scurrency->id)
                        <small><span id="originalprice">{{ $small }}</span></small>
                    @endif
                </h4>

            </div>

            @if ($gs->is_cart)
                <div class="item-cart-area w-100 mt-2 px-2 d-flex justify-content-center">
                    @if ($prod->product_type == 'affiliate')
                        <span class="add-to-cart-btn affilate-btn"
                            data-href="{{ route('affiliate.product', $prod->slug) }}">
                            {{ __('Buy Now') }}
                        </span>
                    @else
                        @if ($prod->stock === 0)
                            <span class="add-to-cart-btn cart-out-of-stock shadow-sm">
                                <i class="icofont-close-circled"></i> {{ __('Out of Stock!') }}
                            </span>
                        @else
                            @if ($gs->is_cart_and_buy_available)
                                <span class="add-to-cart add-to-cart-btn shadow-sm d-block" data-href="{{ route('product.cart.add', $prod->id) }}">
                                    {{ __('Adicionar ao carrinho') }}
                                    <i class="fas fa-plus-circle"></i>
                                    {{-- <svg width="25" height="23" viewBox="0 0 25 23" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_305_10)">
                                        <path d="M1.04167 0C0.46441 0 0 0.46441 0 1.04167C0 1.61892 0.46441 2.08333 1.04167 2.08333H3.30295L5.92014 15.8203C6.01563 16.3108 6.44531 16.6667 6.94444 16.6667H21.1806C21.7578 16.6667 22.2222 16.2023 22.2222 15.625C22.2222 15.0477 21.7578 14.5833 21.1806 14.5833H7.80816L7.41319 12.5H21.1719C21.7925 12.5 22.3394 12.0877 22.5087 11.4887L24.8524 3.15538C25.0998 2.26997 24.4358 1.38889 23.5156 1.38889H5.29514L5.19097 0.846354C5.09549 0.355903 4.6658 0 4.16667 0H1.04167ZM7.63889 22.2222C8.78906 22.2222 9.72222 21.2891 9.72222 20.1389C9.72222 18.9887 8.78906 18.0556 7.63889 18.0556C6.48872 18.0556 5.55556 18.9887 5.55556 20.1389C5.55556 21.2891 6.48872 22.2222 7.63889 22.2222ZM22.2222 20.1389C22.2222 18.9887 21.2891 18.0556 20.1389 18.0556C18.9887 18.0556 18.0556 18.9887 18.0556 20.1389C18.0556 21.2891 18.9887 22.2222 20.1389 22.2222C21.2891 22.2222 22.2222 21.2891 22.2222 20.1389ZM10.9375 6.94444C10.9375 6.46701 11.3281 6.07639 11.8056 6.07639H13.7153V4.16667C13.7153 3.68924 14.1059 3.29861 14.5833 3.29861C15.0608 3.29861 15.4514 3.68924 15.4514 4.16667V6.07639H17.3611C17.8385 6.07639 18.2292 6.46701 18.2292 6.94444C18.2292 7.42188 17.8385 7.8125 17.3611 7.8125H15.4514V9.72222C15.4514 10.1997 15.0608 10.5903 14.5833 10.5903C14.1059 10.5903 13.7153 10.1997 13.7153 9.72222V7.8125H11.8056C11.3281 7.8125 10.9375 7.42188 10.9375 6.94444Z" fill="currentColor"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_305_10">
                                        <rect width="25" height="22.2222" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg> --}}

                                </span>
                                {{-- <span class="add-to-cart-quick add-to-cart-btn shadow-sm d-block "
                                    data-href="{{ route('product.cart.quickadd', $prod->id) }}">
                                    {{ __('Adicionar ao carrinho') }}
                                    <i class="fas fa-plus-circle"></i>
                                </span> --}}
                            @else
                                <span class="add-to-cart-btn shadow-sm" href="{{ route('front.product', $prod->slug) }}">
                                    {{ __('Details') }}
                                </span>
                            @endif
                        @endif
                    @endif
                </div>
            @else
                <span class="add-to-cart-btn text-center" href="{{ route('front.product', $prod->slug) }}">
                    {{ __('Details') }}
                </span>
            @endif


        </a>
    </div>

@endif
