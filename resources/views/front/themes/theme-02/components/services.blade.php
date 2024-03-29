@if($ps->service == 1)

{{-- Info Area Start --}}
<section class="info-area">
    <div class="container">

        @foreach($services->chunk(4) as $chunk)

        <div class="row">

            <div class="col-lg-12 p-0">
                <div class="info-big-box">
                    <div class="row justify-content-center">
                        @foreach($chunk as $service)
                        <div class="col-12 col-md-4">
                            <div class="info-box">
                                <div class="icon">
                                    <a target="_blank" href="{{ $service->link }}">
                                        <img src="{{ asset('storage/images/services/'.$service->photo) }}">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="details">
                                        <h4 class="title">{{ $service->title }}</h4>
                                        <p class="text">
                                            {!! $service->details !!}
                                        </p>
                                    </div>
                                </div>
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
</section>
{{-- Info Area End --}}

@endif
