@if ($ps->small_banner == 1)
    <!-- Banner Area One Start -->
    <section class="banner-section">
        <div class="container">
            {{-- @if (isset($top_small_banners)) 
                @foreach ($top_small_banners->chunk(2) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $img)
                            <div class="col-lg-6">
                                <div class="left">
                                    <a class="banner-effect" href="{{ $img->link }}" target="_blank">
                                        <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt=""
                                            loading="lazy">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @break
                @endforeach 
            @else --}}
                <div class="row">
                    {{-- @foreach ($chunk as $img) --}}
                    {{-- HARD CODE --}}
                    <div class="col-lg-6">
                        <div class="left">
                            <a class="banner-effect" href="#" target="_blank">
                                <img src="{{ asset('storage/images/banners/1703794672small-banner-first.png') }}" alt=""
                                    loading="lazy">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="left">
                            <a class="banner-effect" href="#" target="_blank">
                                <img src="{{ asset('storage/images/banners/1703794677small-banner-second.png') }}" alt=""
                                    loading="lazy">
                            </a>
                        </div>
                    </div>
                    {{-- @endforeach --}}
                </div>
            {{-- @endif --}}
        </div>
    </section>
<!-- Banner Area One Start -->
@endif
