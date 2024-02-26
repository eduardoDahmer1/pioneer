<!-- Footer Area Start -->
<footer class="footer" id="footer">
    <div class="container">
        <div class="box-footer">
            <div class="row justify-content-between">
                <div class="col-12 col-md-3 d-flex flex-column justify-content-start align-items-center">
                    <div class="footer-info-area">
                        <div class="footer-logo">
                            <a href="{{ route('front.index') }}" class="logo-link">
                                <img src="{{ $gs->footerLogoUrl }}" alt="">
                            </a>
                        </div>
                        <div class="text m-0">
                            <p>
                                {!! $gs->footer !!}
                            </p>
                        </div>
                        <h4 class="title mb-1">
                            {{ __('Opening hours') }}
                        </h4>
                        <div class="text m-0">
                            <p>
                                {{ __('Monday to friday - 8h / 17h') }} <br>
                                {{ __('Saturday - 8h / 12h') }} <br>
                                {{ __('Sunday - Closed') }}
                            </p>
                        </div>
                    </div>
    
                </div>
                <div id="cont_e485efc0e94117158048ffe36c4768bd"><script type="text/javascript" async src="https://www.tempo.com/wid_loader/e485efc0e94117158048ffe36c4768bd"></script></div>
                <div class="col-md-3">
                    <div class="footer-widget info-link-widget">
                        <h4 class="title mb-1">
                            {{ __('Footer Links') }}
                        </h4>
                        <ul class="link-list">
                            <li>
                                <a href="{{ route('front.index') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
    
                            @foreach ($pfooter as $data)
                                <li>
                                    <a href="{{ route('front.page', $data->slug) }}">
                                        {{ $data->title }}
                                    </a>
                                </li>
                            @endforeach
    
                            <li>
                                <a href="{{ route('front.contact') }}">
                                    {{ __('Contact Us') }}
                                </a>
                            </li>
                            <li>
                                <a href="https://foz.portaldacidade.com/cameras-ao-vivo/ponte-da-amizade-sentido-paraguai" target="_blank">
                                    {{ __('bridge in real time') }}
                                </a>
                            </li>
                            @if ($gs->crow_policy)
                                <li>
                                    <a href="{{ route('front.crowpolicy') }}">
                                        {{ __('General Terms of Service') }}
                                    </a>
                                </li>
                            @endif
                            @if ($gs->privacy_policy)
                                <li>
                                    <a href="{{ route('front.privacypolicy') }}">
                                        {{ __('Privacy Policy') }}
                                    </a>
                                </li>
                            @endif
                            @if ($gs->bank_check)
                                <li>
                                    <a href="{{ route('front.receipt') }}">
                                        {{ __('Upload Order Receipt') }}
                                    </a>
                                </li>
                            @endif
                            @if ($gs->team_show_footer == 1)
                                <li>
                                    <a href="{{ route('front.team_member') }}">
                                        {{ __('Team') }}
                                    </a>
                                </li>
                            @endif
    
                        </ul>
                    </div>
                    <div class="fotter-social-links">
                        <h4 class="title mb-1">
                            {{ __('Social networks') }}
                        </h4>
                        <ul>
    
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
                                    <a href="{{ $socials->linkedin }}" class="linkedin" target="_blank">
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
                {{-- <div class="col-md-2">
                    @if ($ps->featured_category == 1)
                        <div class="footer-widget info-link-widget">
                            <h4 class="title mb-1">
                                {{ __('Departaments') }}
                            </h4>
                            <ul class="link-list">
    
                                @php
                                    $categoryhasimage = false;
                                    foreach ($categories->where('is_featured', '=', 1) as $cat) {
                                        if (!empty($cat->image)) {
                                            $categoryhasimage = true;
                                            break;
                                        }
                                        $categoryhasimage = false;
                                    }
                                @endphp
    
                                @foreach ($categories->where('is_featured', '=', 1) as $cat)
                                    <li>
                                        <a href="{{ route('front.category', $cat->slug) }}">
                                            {{ $cat->name }}
                                        </a>
                                    </li>
                                @endforeach
    
    
                            </ul>
                        </div>
                    @endif
                </div> --}}
                <div class="col-md-3">
                    <div>
                        {!! $gs->copyright !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copy-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="content">
                            <p>COPYRIGHT {{ $gs->title }} © {{ date('Y') }}.
                                {{ $gs->company_document ? '| ' . $gs->document_name . ' - ' . $gs->company_document . ' |' : '' }}
                                {{ __('All Rights Reserved') }}.</p>
                            <p>{{ __('Developed By') }} <a id="agcrow" href="https://crowtech.digital/">CrowTech</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- Footer Area End -->