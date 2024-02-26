@if ($ps->service == 1)
    {{-- Info Area Start --}}
    <div class="info-area absolute">
        <div class="container">
            @foreach ($services->chunk(4) as $chunk)
                <div class="row">
                    <div class="col-lg-10 m-auto p-0">
                        <div class="info-big-box">
                            <div id="services-carousel">
                                @foreach ($chunk as $key => $service)
                                    <div class="item-slide">
                                        <div class="info-box px-2">
                                            <a target="_blank" href="{{ $service->link }}">
                                                <div class="icon mr-2">
                                                    <img class="img-fluid  object-fit-contain"
                                                        src="{{ asset('storage/images/services/' . $service->photo) }}"
                                                        loading="lazy">
                                                </div>
                                                
                                                <div class="info">
                                                    <div class="details">
                                                        <h4 class="title text-left">{{ $service->title }}</h4>
                                                        <p class="text text-left pt-1">
                                                            {!! $service->details !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            @break
        @endforeach

    </div>
</div>
{{-- Info Area End --}}

@endif
