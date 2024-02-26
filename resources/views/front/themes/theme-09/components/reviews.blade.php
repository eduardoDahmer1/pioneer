@if ($ps->reviews_store == 1)
    <section class="blog-area w-100 m-auto pb-4 mt-4">
        <div class="container-fluid remove-padding">
            <div class="row flex-nowrap w-100 remove-padding m-0">
                <div class="col-lg-10 col-xl-8 m-auto remove-padding">
                    <div class="section-top-reviews w-100 text-center">
                        <h2 class="section-title-reviews ">
                        {{ __('Testimony') }}
                        </h2>
                    </div>
                    <div class="aside bg-section-items pb-4">
                        <div class="slider-wrapper px-0 px-sm-3">
                            <div class="aside-review-slider">
                                @foreach ($reviews as $review)
                                    <div class="slide-item mx-2 mx-md-4 shadow">
                                        {{-- <p>{{ $review }}</p> --}}
                                        <div class="top-area">
                                            <div class="right">
                                                <div class="content">
                                                    <img src="{{ $review->photo ? asset('storage/images/reviews/' . $review->photo) : asset('assets/images/noimage.png') }}"
                                                alt="{{ $review->subtitle }}" loading="lazy">        
                                                </div>
                                            </div>
                                        </div>
                                        <blockquote class="review-text w-75">
                                            <p>
                                                {!! $review->details !!}
                                            </p>
                                        </blockquote>
                                        <div class="left my-3">
                                            <h4 class="blog-title">{{ $review->title }}</h4>
                                            <p class="dagenation text-secondary">{{ $review->subtitle }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
