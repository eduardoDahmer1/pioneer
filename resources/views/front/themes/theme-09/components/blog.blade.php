@if ($ps->blog_posts === 1)
    <section class="blog-area mt-4 pb-4">
        <div class="container-fluid m-auto remove-padding">
            <div class="row w-100 m-auto remove-padding">
                <div class="col-lg-12 col-xl-11 m-auto">
                    <div class="section-top pl-2">
                        <h2 class="section-title">
                        {{ __('Recent On Our Blog') }}
                        </h2>
                    </div>
                    <div class="bg-section-items">
                        <div class="row remove-padding w-100 m-auto">
                        {{-- TODO add conditional styling --}}
                        @foreach ($extra_blogs->chunk(2) as $posts)
                            @foreach ($posts as $blogg)
                                {{-- <script>
                                    console.log(@json(count($blogg)));
                                </script> --}}
                                <div class="col-12 col-lg-6">
                                    <div class="blog-box p-3">
                                        <div class="blog-content d-flex w-100 flex-column justify-content-center">
                                            <div class="date-box d-flex justify-content-start pb-3">
                                                <div class="date mr-3 align-self-center remove-padding">
                                                    <p class='remove-padding m-auto'>{{ date('d', strtotime($blogg->created_at)) }}</p>
                                                </div>
                                                <div class="box-perimeter w-100 d-flex flex-column justify-content-start align-items-start">
                                                    <div class="box-perimeter_dates d-flex align-items-center">
                                                        <p class='remove-padding m-auto text-uppercase fw-bold pr-1'>{{ date('M', strtotime($blogg->created_at)) }}, </p>
                                                        <p class='remove-padding m-auto fw-bold'>{{ date('Y', strtotime($blogg->created_at)) }}</p> 
                                                    </div>   
                                                    <a href="{{ route('front.blogshow', $blogg->id) }}" class='d-block'>
                                                        <h6 class="blog-title m-0">
                                                            {{ mb_strlen($blogg->title, 'utf-8') > 80 ? mb_substr($blogg->title, 0, 80, 'utf-8') . '...' : $blogg->title }}
                                                        </h6>
                                                    </a>
                                                </div> 
                                            </div>
                                            <div class="details mr-4">
                                                <p class="blog-text text-break">
                                                    {!! substr(strip_tags($blogg->details), 50, 280) !!}
                                                </p>
                                                <a class="read-more-btn mb-2"
                                                    href="{{ route('front.blogshow', $blogg->id) }}">{{ __('Read More') }}...</a>
                                            </div> 
                                        </div> 

                                        <div class="blog-images">
                                            <div class="img position-relative object-fit-contain">
                                                <img src="{{ $blogg->photo ? asset('storage/images/blogs/' . $blogg->photo) : asset('assets/images/noimage.png') }}"
                                                    alt="{{ $blogg->title }}" loading="lazy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @break
                        @endforeach
                    </div>
                </div>
            </div>
</section>
@endif
