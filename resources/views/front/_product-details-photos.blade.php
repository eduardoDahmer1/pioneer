@if ((empty($color_gallery) && empty($material_gallery)) || (!empty($color_gallery) && !empty($material_gallery)))
    <div class="col-lg-8 col-xl-sm-7 col-xl-7 col-sm-12 px-0 px-lg-3 py-2 px-4 px-sm-0 remove-padding images-box">
        <div class="xzoom-container position-relative d-flex flex-column flex-lg-row justify-content-center align-items-center align-items-lg-start mx-auto mt-sm-0">
            @if(basename($productt->photo) !== 'noimage.png' && $productt->photo && !filter_var($productt->photo, FILTER_VALIDATE_URL))
                <img class="xzoom5 w-100 m-0" id="xzoom-magnific" src="{{ asset('storage/images/products/' . $productt->photo) }}" xoriginal="{{ asset('storage/images/products/' . $productt->photo) }}" />
            @elseif(basename($productt->photo) !== 'noimage.png' && $productt->photo && filter_var($productt->photo, FILTER_VALIDATE_URL))
                <img class="xzoom5 w-100 m-0" id="xzoom-magnific" src="{{ $productt->photo }}" xoriginal="{{ $productt->photo }}" />
            @elseif(isset($productt->galleries[0]) && filter_var($productt->galleries[0]->photo, FILTER_VALIDATE_URL))
                <img class="xzoom5 w-100 m-0" id="xzoom-magnific" src="{{ $productt->galleries[0]->photo }}" xoriginal="{{ $productt->galleries[0]->photo }}" />
            @elseif(isset($productt->galleries[0]))
                <img class="xzoom5 w-100 m-0" id="xzoom-magnific" src="{{ asset('storage/images/galleries/'.$productt->galleries[0]->photo) }}" xoriginal="{{ $productt->galleries[0]->photo }}" />
            @else
                <img class="xzoom5 w-100 m-0" id="xzoom-magnific" src="{{ asset('assets/images/noimage.png') }}" xoriginal="{{ asset('assets/images/noimage.png') }}" />
            @endif
            <div class="xzoom-thumbs w-100 ml-0">
                <div class="product-grid mt-3 mt-lg-0 d-flex flex-nowrap flex-lg-wrap" id='all-slider'>
                    @if(basename($productt->photo) !== 'noimage.png' && $productt->photo && !filter_var($productt->photo, FILTER_VALIDATE_URL))
                        <a href="{{ asset('storage/images/products/' . $productt->photo) }}" title="The description goes here">
                            <img class="xzoom-gallery5" width="80" src="{{ asset('storage/images/products/' . $productt->photo) }}" title="The description goes here">
                        </a>
                    @elseif(basename($productt->photo) !== 'noimage.png' && $productt->photo && filter_var($productt->photo, FILTER_VALIDATE_URL))
                        <a href="{{ $productt->photo }}" title="The description goes here">
                            <img class="xzoom-gallery5" width="80" src="{{ $productt->photo }}" title="The description goes here">
                        </a>
                    @else
                        <a href="{{ asset('assets/images/noimage.png') }}" title="The description goes here">
                            <img class="xzoom-gallery5" width="80" src="{{ asset('assets/images/noimage.png') }}" title="The description goes here">
                        </a>
                    @endif
                    
                    @if ($gs->ftp_folder)
                        @foreach ($ftp_gallery as $ftp_image)
                            @if ($ftp_image != $productt->photo)
                                <a href="{{ $ftp_image }}">
                                    <img class="xzoom-gallery5" width="80" src="{{ $ftp_image }}"
                                        title="The description goes here">
                                </a>
                            @endif
                        @endforeach
                    @endif

                    @foreach ($productt->galleries as $gal)
                        <a href="{{ $gal->photo_url }}">
                            <img class="xzoom-gallery5" width="80" src="{{ $gal->photo_url }}"
                                title="The description goes here">
                        </a>
                    @endforeach
                    @if($productt->youtube != null)
                        <div class="xzoom-gallery5" style="
                        height: 105.25px;
                        display: flex;
                        align-items: center;
                        justify-content: center;">
                            <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe" >
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@elseif(!empty($color_gallery) && empty($material_gallery))
    <div class="col-lg-4 col-md-12">
        <div class="xzoom-container">
            @php
                if (!empty($color_gallery)) {
                    $first = explode('|', $color_gallery[0])[0];
                }
            @endphp
            @if (!empty($color_gallery))
                <img class="xzoom5 w-100" id="xzoom-magnific" src="{{ asset('storage/images/color_galleries/' . $first) }}" />
            @else
                <img class="xzoom5 w-100" id="xzoom-magnific"
                    src="{{ filter_var($productt->photo, FILTER_VALIDATE_URL)
                        ? $productt->photo
                        : asset('storage/images/products/' . $productt->photo) }}"
                    xoriginal="{{ filter_var($productt->photo, FILTER_VALIDATE_URL)
                        ? $productt->photo
                        : asset('storage/images/products/' . $productt->photo) }}" />
            @endif
            <div class="xzoom-thumbs">
                <div class="all-slider-color-gallery">
                    @if (!empty($color_gallery))
                        @foreach ($color_gallery as $color_gal)
                            @php
                                $aux_arr = [];
                                $color_arr = [];
                                foreach ($productt->color as $key => $color) {
                                    if (!array_key_exists($key, $color_gallery)) {
                                        break;
                                    }
                                    $aux_arr[$color] = $color_gallery[$key];
                                    foreach ($aux_arr as $aux) {
                                        $color_arr[$color] = explode('|', $aux);
                                    }
                                }
                            @endphp
                        @endforeach
                        @foreach ($productt->color as $arr_key => $color)
                            @if (array_key_exists($color, $color_arr))
                                @foreach ($color_arr[$color] as $key => $gal)
                                    <a href="{{ asset('storage/images/color_galleries/' . $gal) }}"
                                        class="color_gallery color-{{ str_replace('#', '', $color) }} {{ $arr_key == 0 ? 'active' : 'hidden' }}">
                                        <img class="xzoom-gallery5" width="80"
                                            src="{{ asset('storage/images/color_galleries/' . $gal) }}"
                                            title="The description goes here">
                                    </a>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        @foreach ($productt->galleries as $gal)
                            <a href="{{ $gal->photo_url }}">
                                <img class="xzoom-gallery5" width="80" src="{{ $gal->photo_url }}"
                                    title="The description goes here">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@elseif(empty($color_gallery) && !empty($material_gallery))
    <div class="col-lg-5 col-md-12">
        <div class="xzoom-container">
            @php
                $first = explode('|', $material_gallery[0])[0];
            @endphp
            <img class="xzoom5 w-100" id="xzoom-magnific" src="{{ asset('storage/images/material_galleries/' . $first) }}" />
            <div class="xzoom-thumbs">
                <div class="all-slider-material-gallery">
                    @if (!empty($material_gallery))
                        @foreach ($material_gallery as $material_gal)
                            @php
                                $aux_arr = [];
                                $material_arr = [];
                                foreach ($productt->material as $key => $material) {
                                    if (!array_key_exists($key, $material_gallery)) {
                                        break;
                                    }
                                    $aux_arr[$material] = $material_gallery[$key];
                                    foreach ($aux_arr as $aux) {
                                        $material_arr[$material] = explode('|', $aux);
                                    }
                                }
                            @endphp
                        @endforeach
                        @foreach ($productt->material as $arr_key => $material)
                            @if (array_key_exists($material, $material_arr))
                                @foreach ($material_arr[$material] as $key => $gal)
                                    <a href="{{ asset('storage/images/material_galleries/' . $gal) }}"
                                        class="material_gallery material-{{ $arr_key }} {{ $arr_key == 0 ? 'active' : 'hidden' }}">
                                        <img class="xzoom-gallery5" width="80"
                                            src="{{ asset('storage/images/material_galleries/' . $gal) }}"
                                            title="The description goes here">
                                    </a>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    @foreach ($productt->galleries as $gal)
                        <a href="{{ asset('storage/images/galleries/' . $gal->photo) }}">
                            <img class="xzoom-gallery5" width="80"
                                src="{{ asset('storage/images/galleries/' . $gal->photo) }}"
                                title="The description goes here">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
