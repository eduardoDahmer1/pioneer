<!-- Footer Area Start -->



<footer class="footer m-auto px-3 px-md-5 {{ landing_page_styles(['home', 'px-0']) }}" id="footer">
    <div class="container-fluid remove-padding">
        <div class="row m-auto justify-content-around px-2 px-md-2 footer-box">
            <div class="col-lg-4 remove-padding">
                {{-- Soly for debugging purposes --}}
                {{-- <script>
                    console.log(@json($filteredVariables));
                </script> --}}

                <div class="d-flex flex-column justify-content-evenly" style='transform: translateY(-7.5%);'>
                    <div class="logo {{ landing_page_styles(['h-auto']) }}">
                        <a href="#">
                            <img src="{{ asset('storage/images/' . $gs->footer_logo) }}" alt="" loading='lazy'>
                        </a>
                    </div>
                    <div class="footer-content w-75 mx-lg-auto mt-2 {{ landing_page_styles(['w-100', 'mx-auto']) }}">
                        @if ($gs->footer)
                            <p>{{ strip_tags($gs->footer) }}</p>
                        @endif
                    </div>
                    <div class="footer_timing w-75 mx-lg-auto {{ landing_page_styles(['w-100', 'mx-auto']) }}">
                        <h4 class="title mt-2 mb-3 d-block">
                            {{ __('Opening Hours') }} 
                        </h4> 
                        <ul class="link-list d-block">
                            {{-- @if ($gs->is_home == 1) --}}
                                <li class="ft">
                                    {{ __('Seg a Sexta - 8h às 18h') }}
                                </li>
                                <li class="ft">
                                    {{ __('Sábado - 8h às 12h') }}
                                </li>
                            {{-- @endif --}}

                            {{-- @if ($gs->is_home == 1) --}}
                                <li class="ft">
                                    {{ __('Monday to Saturday, Brasilia time (Except Sunday and holidays, in Limeira - SP)') }}
                                </li>
                            {{-- @endif --}}
                        </ul> 
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 remove-padding">
                <div class="footer-widget info-link-widget">
                    <h3 class="title m-0">
                        {{ __('important links') }}
                    </h3>

                    <ul class="link-list mt-3">
                        <li>
                            <a href="{{route('front.index')}}">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.page', 'sobre-a-pioneer-international-shop-6') }}" class="ft">
                                {{ __('About Pioneer International Shop') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.contact') }}" class='ft'>
                                {{ __('Contact Us') }}
                            </a>
                        </li>
                        

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'trabalhe-conosco-21') }}"
                                    class="ft">{{ __('Work with us') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'politicas-de-devolucao-e-troca-25') }}"
                                    class="ft">{{ __('Return and exchange policy') }}</a></li>
                        @endif

                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'regime-de-tributacao-unificada-rtu-2') }}"
                                    class="ft">{{ __('Unified Taxation RTU') }}</a></li>
                        @endif

                        @if ($gs->team_show_footer == 1)
                            <li>
                                <a href="{{ route('front.team_member') }}" class='ft'>
                                    {{ __('Team') }}
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
                <div class="footer-widget info-link-widget mt-3">
                    <h4 class="title m-0">
                        {{ __('Redes Sociais') }}
                    </h4>
                    {{-- <ul class="link-list">
                        @if ($gs->is_blog == 1)
                            <li><a href="{{ route('front.page', 'compra-segura-16') }}"
                                    class="ft">{{ __('safe buy') }}</a></li>
                        @endif

                        @if ($gs->is_contact == 1)
                            <li><a href="{{ route('front.page', 'pioneer-channel-8') }}"
                                    class="ft">{{ __('pioneer channel') }}</a></li>
                        @endif
                    </ul> --}}
                    <div class="fotter-social-links mt-3">
                        <ul style="width: 250px;">

                            @if ($socials->f_status == 1)
                                <li>
                                    <a href="{{ $socials->youtube }}" class="youtube" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->f_status == 1)
                                <li>
                                    <a href="{{ $socials->facebook }}" class="facebook" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->i_status == 1)
                                <li>
                                    <a href="{{ $socials->instagram }}" class="instagram" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->t_status == 1)
                                <li>
                                    <a href="{{ $socials->twitter }}" class="twitter" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->l_status == 1)
                                <li>
                                    <a style="margin-top:6px;" href="{{ $socials->linkedin }}" class="linkedin"
                                        target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->d_status == 1)
                                <li>
                                    <a href="{{ $socials->dribble }}" class="dribbble" target="_blank">
                                        <i class="fab fa-dribbble"></i>
                                    </a>
                                </li>
                            @endif

                            @if ($socials->y_status == 1)
                                <li>
                                    <a href="{{ $socials->youtube }}" class="youtube" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 remove-padding">
                <div class="footer-widget info-link-widget">
                    <h4 class="title m-0">
                        {{ __('departaments') }}
                    </h4>
                    <ul class="ftt link-list mt-3">
                        @foreach ($categories->where('is_featured', '=', 1) as $cat)
                            <li>
                                <a href="{{ route('front.category', $cat->slug) }}" class="text-left d-block ft ftt">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 remove-padding">
                <div class="footer-widget info-link-widget">
                    <ul>
                        <li>
                            <h4 class="title m-0">
                                {{__('Talk to us')}}
                            </h4>
                            <p>
                                +595 61 504 590
                            </p>
                        </li>
                        <li>
                            <h4 class="title m-0 mt-4">
                                {{__('Service (SAC)')}}
                            </h4>
                            <p>
                                faleconosco@pioneer.com.br
                            </p>
                        </li>
                        <li>
                            <h4 class="title m-0 mt-4">
                                Compra Segura
                            </h4>
                            <p>
                                Usamos métodos de pagamento seguros e confiavéis.
                            </p>
                            <img src="{{ asset('assets/images/pague-seguro.png') }}" alt="" class="img-fluid">
                        </li>
                    </ul>
                </div>
            </div> 
            
            {{-- <div class="col-md-2">
                <div class="footer-widget info-link-widget">
                    <h3 class="title m-0">
                        {{ __('attendance') }}
                    </h3>
                    

                        @if ($gs->is_home == 1)
                            <li class="ft">{{ __('Address: Rua Carlos Gomes, 1321 - Ninth floor - Centro Limeira / SP - Zip code: 13480-010') }}
                            </li>
                        @endif
                        
                        <li class="ft">{{ __('') }}
                        </li>

                        <h4 style="text-align:left;" class="title m-0">
                            {{ __('email:') }}
                        </h4>

                        @if ($gs->is_home == 1)
                            <li class="ft">{{ __('') }}</li>
                        @endif
                    </ul>
                </div>

 --}}

            </div>
            {{-- <div class="col-md-2">
                <div>
                    {!! $gs->copyright !!}
                </div>
            </div> --}}
        </div>
        <div class="copy-bg p-2 p-md-4">
            <div class="container-fluid remove-padding">
                <div class="row w-100 justify-content-between align-items-center">
                    <div class="col-lg-5">
                        <div class="secure-site d-flex flex-wrap flex-md-nowrap mb-3 w-100 justify-content-center">
                            <img src="{{asset('assets/images/google_cloud.png')}}" width='140' height='50' alt="Google Cloud Secure">
                            <img src="{{asset('assets/images/ssl_certified.png')}}" width='140' height='50' alt="SSL Secure">
                            <img src="{{asset('assets/images/cloudfare.png')}}" width='140' height='50' alt="CloudFlare">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="content d-flex flex-column my-3 my-md-0 align-items-center align-items-md-end justify-content-center">
                            @if($gs->copyright)
                                <p class='text-center text-lg-right'>{!! $gs->copyright !!}</p>
                            @else
                                <p class='text-center text-lg-right'>{{ $gs->title }} © {{ date('Y') }}.
                                {{ $gs->company_document ? '| ' . $gs->document_name . ' - ' . $gs->company_document . ' |' : '' }}
                                {{ __('All Rights Reserved') }}.</p>
                            @endif

                            <p class='mt-2 mt-md-0 text-center text-lg-right'>{{ __('Developed with ❤️ By') }} <a id="agcrow"
                                    href="https://crowtech.digital/">CrowTech</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</footer>
<!-- Footer Area End -->
