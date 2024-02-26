@if ($ps->bottom_small == 1)
    <!-- Banner Area One Start -->
    <section>
        <div class="container-fluid p-0 p-lg-4 my-5">
            @foreach ($bottom_small_banners->chunk(3) as $chunk)
                <div class="row justify-content-center align-items-center px-3">
                    @foreach ($chunk as $img)
                        <div class="col-12 col-lg-6">
                            <div class="left">
                                <a class="banner-effect my-4 my-lg-0 banner-w100 shadow-banner" href="{{ $img->link }}" target="_blank">
                                    <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt=""
                                        loading="lazy">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @break
        @endforeach
    </div>
</section>
<!-- Banner Area One Start -->
@endif
