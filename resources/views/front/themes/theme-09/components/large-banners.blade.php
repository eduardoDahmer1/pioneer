@if ($ps->large_banner == 1)
    <!-- Banner Area One Start -->
<div class="banner-section pt-4">
    <div class="container-fluid remove-padding">
        <div class="row">
            @foreach ($large_banners->chunk(1) as $chunk)
                @foreach ($chunk as $img)
                    <div class="col-lg-12">
                        @include('front.themes.theme-09.components.services')
                        <div class="img">
                            <a class="banner-effect banner-w100" href="{{ $img->link }}">
                                <figure>
                                    <img src="{{ asset('storage/images/banners/' . $img->photo) }}" alt="Banner" loading="lazy">
                                </figure>
                            </a>
                        </div>
                    </div>
                @endforeach
                @break
            @endforeach
        </div>
    </div>
</div>
@endif
@if ($gs->translation->whereNotNull('endtime')->first() && $gs->translation->whereNotNull('endtime')->first()->endtime > now(-3.0))
    <section>
        <link rel="stylesheet" href="{{ asset('assets/countdown/countdown.css') }}">

        <div style="background: url('{{ asset('assets/countdown/BG 2.png') }}');background-position: center;background-size: cover;" class="container py-5">
            <div style="gap: 40px;" class="d-flex flex-wrap justify-content-center">
            <a class="col-11 col-md-7 col-lg-6" target="blank" href="https://blackfriday.pioneerinter.com/"><img style="object-fit: contain;" src="{{ asset('assets/countdown/bf.png')}}" alt=""></a>
                <div>
                    <p style="text-align: center; font-size: 23px;color: #fff;font-weight: 600;line-height: 31px;margin: 0;padding: 0;font-family:inter tight,sans-serif;"><span style="font-size: 25px; font-family:inter tight,sans-serif;">15 À 18 DE NOVEMBRO</span><br>
                        ATÉ 90% DE DESCONTO</p>
                    <div class="text-center mt-2">
                        <a class="piscante" target="blank" href="https://blackfriday.pioneerinter.com/">Faça seu pré-cadastro</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center w-100 mt-5">
                <div class="countdown mt-2">

                    @php
                        $endTime = $gs->translation->whereNotNull('endtime')->first()->endtime;
                        $diff = now(-3.0)->diff($endTime);
                        $days = $diff->days;
                        $hours = $diff->h;
                        $minutes = $diff->i;
                        $sec = $diff->s;
                    @endphp
                    
                    <div class="bloc-time days" data-init-value="{{$days}}">
                        
                        <div class="figure days days-1">
                            <span class="top">0</span>
                        </div>
                        
                        <div class="figure days days-2">
                            <span class="top">0</span>
                        </div>
                        <span style="font-size: 12px;" class="text-light count-title mt-2 mb-0">Dias</span>
                    </div>
                        
                    <div class="bloc-time hours" data-init-value="{{$hours}}">
                        
                        <div class="figure hours hours-1">
                            <span class="top">0</span>
                        </div>
                        
                        <div class="figure hours hours-2">
                            <span class="top">0</span>
                        </div>
                        <span style="font-size: 12px;" class="text-light count-title mt-2 mb-0">Horas</span>
                    </div>

                    <div class="bloc-time min" data-init-value="{{$minutes}}">
                        
                        <div class="figure min min-1">
                            <span class="top">0</span>
                        </div>
                        
                        <div class="figure min min-2">
                            <span class="top">0</span>
                        </div>
                        <span style="font-size: 12px;" class="text-light count-title mt-2 mb-0">Minutos</span>
                    </div>

                    <div class="bloc-time sec" data-init-value="{{$sec}}">
                        
                        <div class="figure sec sec-1">
                            <span class="top">0</span>
                        </div>
                        
                        <div class="figure sec sec-2">
                            <span class="top">0</span>
                        </div>
                        <span style="font-size: 12px;" class="text-light count-title mt-2 mb-0">Segundos</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area One Start -->
    <script src="{{ asset('assets/countdown/jquery2.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/countdown/tweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/countdown/countdown.js') }}"></script>
@endif