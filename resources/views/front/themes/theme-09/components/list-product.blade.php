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
@if($prod->user_id != 0)

{{-- check If This vendor status is active --}}
@if($prod->user->is_vendor == 2)

<li>
    <div class="single-box p-2 align-items-center">
        <div class="left-area {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0 ? "
            baw":"" }}">
            @if(basename($prod->thumbnail) !== 'noimage.png' && $prod->thumbnail)
            <img class="img h-100 w-100 object-fit-contain rounded" src="{{ asset('storage/images/thumbnails/' . $prod->thumbnail) }}" alt="">
            @elseif(basename($prod->photo) !== 'noimage.png' && $prod->photo)
                <img class="img h-100 w-100 object-fit-contain rounded" src="{{ asset('storage/images/products/' . $prod->photo) }}" alt="">
            @elseif(isset($prod->galleries[0]) && filter_var($prod->galleries[0]->photo, FILTER_VALIDATE_URL))
                <img class="img h-100 w-100 object-fit-contain rounded" src="{{ $prod->galleries[0]->photo }}" alt="">
            @elseif(isset($prod->galleries[0]))
                <img class="img h-100 w-100 object-fit-contain rounded" src="{{ asset('storage/images/galleries/'.$prod->galleries[0]->photo) }}" xoriginal="{{ $prod->galleries[0]->photo }}" />
            @else
                <img class="img h-100 w-100 object-fit-contain rounded" src="{{ asset('assets/images/noimage.png') }}" xoriginal="{{ asset('assets/images/noimage.png') }}" />
            @endif
        <div class="right-area pr-2">
            <p class="text"><a href="{{ route('front.product',$prod->slug) }}">{{ mb_strlen($prod->capitalize_name,'utf-8') > 35 ?
                    mb_substr($prod->capitalize_name,0,35,'utf-8').'...' : $prod->capitalize_name }}</a></p>
                    

             @if($gs->is_rating == 1)
                <div class="stars">
                    <div class="ratings">
                        <div class="empty-stars"></div>
                        <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                    </div>
                </div>
            @endif       
            
            <div class="info">
                @if ($prod->previous_price != 0)
                    <p class="namee m-0">U$ {{ $prod->previous_price }}</p>
                @endif
                <h4 class="price text-dark">{{ $highlight }} @if ($curr->id != $scurrency->id)
                        <small><span id="originalprice">{{ $small }}</span></small>
                    @endif
                </h4>

            </div>
        </div>
    </div>
</li>


@endif

{{-- If This product belongs admin and apply this --}}

@else

<li>
    <div class="single-box p-2 align-items-center">
        <div class="left-area {{ $gs->show_products_without_stock_baw && !is_null($prod->stock) && $prod->stock == 0 ? "
            baw":"" }}">
            <a class='h-100 w-100 d-block' href="{{ route('front.product',$prod->slug) }}">
                @if(basename($prod->thumbnail) !== 'noimage.png' && $prod->thumbnail && !filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img h-100 w-100 object-fit-contain  rounded" src="{{ asset('storage/images/thumbnails/' . $prod->thumbnail) }}" alt="">
                @elseif(basename($prod->thumbnail) !== 'noimage.png' && $prod->thumbnail && filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img h-100 w-100 object-fit-contain  rounded" src="{{ $prod->thumbnail }}" alt="">
                @elseif(basename($prod->photo) !== 'noimage.png' && $prod->photo && !filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img h-100 w-100 object-fit-contain  rounded" src="{{ asset('storage/images/products/' . $prod->photo) }}" alt="">
                @elseif(basename($prod->photo) !== 'noimage.png' && $prod->photo && filter_var($prod->thumbnail, FILTER_VALIDATE_URL))
                    <img class="img h-100 w-100 object-fit-contain  rounded" src="{{ $prod->photo }}" alt="">
                @elseif(isset($prod->galleries[0]) && filter_var($prod->galleries[0]->photo, FILTER_VALIDATE_URL))
                    <img class="img h-100 w-100 object-fit-contain  rounded" src="{{ $prod->galleries[0]->photo }}" alt="">
                @elseif(isset($prod->galleries[0]))
                    <img class="img h-100 w-100 object-fit-contain  rounded" src="{{ asset('storage/images/galleries/'.$prod->galleries[0]->photo) }}" xoriginal="{{ $prod->galleries[0]->photo }}" />
                @else
                    <img class="img h-100 w-100 object-fit-contain  rounded" src="{{ asset('assets/images/noimage.png') }}" xoriginal="{{ asset('assets/images/noimage.png') }}" />
                @endif
            </a>
        </div>
        <div class="right-area pr-2">
            <p class="text w-75 text-prod-name"><a href="{{ route('front.product',$prod->slug) }}">{{ mb_strlen($prod->capitalize_name,'utf-8') > 35 ?
                    mb_substr($prod->capitalize_name,0,35,'utf-8').'...' : $prod->capitalize_name }}</a></p>

            @if($gs->is_rating == 1)
                <div class="stars">
                    <div class="ratings">
                        <div class="empty-stars"></div>
                        <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                    </div>
                </div>
            @endif
            @if(!config('features.marketplace'))
                <div class="info">
                    @if ($prod->previous_price != 0)
                        <p class="namee m-0">U$ {{ $prod->previous_price }}</p>
                    @endif

                    <h4 class="price text-dark">{{ $highlight }} @if ($curr->id != $scurrency->id)
                            <small><span id="originalprice">{{ $small }}</span></small>
                        @endif
                    </h4>
                </div>
            @endif
        </div>
        <div class="extra-list position-absolute">
            <ul class="d-flex flex-column justify-content-between align-items-center">
                <li>
                    @if (Auth::guard('web')->check())
                        <span class="add-to-wish shadow-sm" data-href="{{ route('user-wishlist-add', $prod->id) }}"
                            data-toggle="tooltip" data-placement="right" title="{{ __('Add To Wishlist') }}"
                            data-placement="right">
                            <svg width="20" height="20" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                            </svg>
                        </span>
                    @else
                        <span class='shadow-sm' rel-toggle="tooltip" title="{{ __('Add To Wishlist') }}" data-toggle="modal"
                            id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                            <svg width="20" height="20" viewBox="0 0 30 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 10.5C2.49985 9.60296 2.67849 8.71489 3.0255 7.88768C3.37251 7.06048 3.88092 6.31074 4.52102 5.68228C5.16111 5.05383 5.92005 4.55926 6.75348 4.22748C7.58691 3.89571 8.47811 3.73339 9.375 3.75C10.4362 3.74436 11.4865 3.96433 12.4562 4.39534C13.426 4.82634 14.2931 5.45853 15 6.25C15.7069 5.45853 16.574 4.82634 17.5438 4.39534C18.5135 3.96433 19.5638 3.74436 20.625 3.75C21.5219 3.73339 22.4131 3.89571 23.2465 4.22748C24.0799 4.55926 24.8389 5.05383 25.479 5.68228C26.1191 6.31074 26.6275 7.06048 26.9745 7.88768C27.3215 8.71489 27.5002 9.60296 27.5 10.5C27.5 17.195 19.5262 22.25 15 26.25C10.4837 22.2163 2.5 17.2 2.5 10.5Z" fill="currentColor"/>
                            </svg>
                        </span>
                    @endif
                </li>
                <li>
                    <span class="quick-view shadow-sm" rel-toggle="tooltip" title="{{ __('Quick View') }}"
                        href="javascript:;" data-href="{{ route('product.quick', $prod->id) }}"
                        data-toggle="modal" data-target="#quickview" data-placement="right">
                        <svg width="20" height="20" viewBox="0 0 28 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M27.8308 11.7347C25.1946 6.59118 19.9757 3.11111 14 3.11111C8.02421 3.11111 2.80386 6.59361 0.16914 11.7352C0.0579382 11.9552 0 12.1982 0 12.4447C0 12.6912 0.0579382 12.9342 0.16914 13.1542C2.80532 18.2977 8.02421 21.7778 14 21.7778C19.9757 21.7778 25.1961 18.2953 27.8308 13.1537C27.942 12.9337 27.9999 12.6907 27.9999 12.4442C27.9999 12.1977 27.942 11.9547 27.8308 11.7347V11.7347ZM14 19.4444C12.6155 19.4444 11.2621 19.0339 10.111 18.2647C8.95984 17.4956 8.06263 16.4023 7.53282 15.1232C7.003 13.8441 6.86438 12.4367 7.13448 11.0788C7.40457 9.72095 8.07126 8.47367 9.05023 7.4947C10.0292 6.51573 11.2765 5.84905 12.6343 5.57895C13.9922 5.30885 15.3997 5.44748 16.6788 5.97729C17.9578 6.5071 19.0511 7.40431 19.8203 8.55546C20.5894 9.7066 21 11.06 21 12.4444C21.0004 13.3638 20.8197 14.2743 20.468 15.1238C20.1164 15.9732 19.6008 16.7451 18.9507 17.3952C18.3006 18.0453 17.5288 18.5609 16.6793 18.9125C15.8298 19.2641 14.9194 19.4449 14 19.4444V19.4444ZM14 7.77778C13.5834 7.7836 13.1696 7.84557 12.7696 7.96202C13.0993 8.41005 13.2575 8.96141 13.2156 9.51609C13.1736 10.0708 12.9342 10.592 12.5409 10.9854C12.1476 11.3787 11.6263 11.6181 11.0716 11.66C10.5169 11.702 9.96558 11.5438 9.51754 11.2141C9.26242 12.154 9.30847 13.1503 9.64922 14.0627C9.98997 14.9751 10.6083 15.7577 11.4171 16.3003C12.2259 16.8428 13.1845 17.1181 14.1579 17.0874C15.1314 17.0566 16.0707 16.7214 16.8437 16.1288C17.6166 15.5363 18.1843 14.7162 18.4668 13.7842C18.7492 12.8521 18.7323 11.8549 18.4184 10.9329C18.1044 10.011 17.5093 9.21066 16.7167 8.64467C15.9241 8.07868 14.9739 7.77549 14 7.77778V7.77778Z" fill="currentColor"/>
                        </svg>
                    </span>
                </li>
                <li>
                    <span class="add-to-compare" data-href="{{ route('product.compare.add', $prod->id) }}"
                        data-toggle="tooltip" data-placement="right" title="{{ __('Compare') }}"
                        data-placement="right">
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.6666 16.3333L12.8333 10.5L18.6666 4.66666L20.3 6.32916L17.2958 9.33333H25.6666V11.6667H17.2958L20.3 14.6708L18.6666 16.3333ZM9.33331 23.3333L15.1666 17.5L9.33331 11.6667L7.69998 13.3292L10.7041 16.3333H2.33331V18.6667H10.7041L7.69998 21.6708L9.33331 23.3333Z" fill="currentColor"/>
                        </svg>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</li>


@endif
