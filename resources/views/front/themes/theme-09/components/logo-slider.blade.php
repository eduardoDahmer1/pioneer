@if ($ps->partners == 1)
    @php
        // $partner_list = $partners->take(8); 
        $images = [
            1 => [
                'image' => asset('assets/images/husky_gaming.png'),
                'name' => 'Husky Gaming',
                'link' => 'husky-gaming-6',
            ],
            2 => [
                'image' => asset('assets/images/logitech.png'),
                'name' => 'Logitech',
                'link' => 'logitech-62',
            ],
            3 => [
                'image' => asset('assets/images/nintendo.png'),
                'name' => 'Nintendo',
                'link' => 'nintendo-154',
            ],
            4 => [
                'image' => asset('assets/images/xpg.png'),
                'name' => 'XPG',
                'link' => '#',
            ],
        ] 
    @endphp
    
    <!-- Partners Area Start -->
    <section class="brands p-4 mt-3 brands">
        <div class="container-fluid remove-padding">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top d-flex justify-content-start align-items-center">
                        <h2 class="section-title w-100 text-center text-md-left ml-0 ml-md-2">
                        {{ __('Marcas recomendadas') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row mt-lg-4">
                <div class="col-md-11 col-lg-12 col-xl-10 col-xl-xl-8 m-auto row-theme">
                    <div class="brands-slider">
                       @foreach ($images as $image)
                            <div class="brand-item mx-auto ">
                                <div class="brand-item_content">
                                    <img src="{{ $image['image'] }}" alt="">
                                    
                                    <h3 class='mt-3 brandname' style='text-transform: capitalize'>{{ $image['name']}}</h3>
                                </div>
                                <a href="{{ route('front.brand', $image['link']) }}" target="_blank" class='d-flex justify-content-center align-items-center m-auto mt-2 pb-2'>
                                    <span class='d-block'>
                                        {{ __("Ver Produtos") }}
                                    </span> 
                                    <i class="fas fa-caret-right d-block mt-1"></i>
                                </a>
                            </div> 
                       @endforeach 

                        {{-- @foreach ($partner_list as $data)
                            <div class="brand-item mr-4">
                                <div class="brand-item_content">
                                    <img src="{{ asset('storage/images/partner/' . $data->photo) }}" alt="">
                                    
                                    <h3 class='mt-3 brandname' style='text-transform: capitalize'></h3>
                                    <script defer>
                                        document.querySelector('.brandname').innerHTML = @json($data).link
                                                                        .split('/')[4]
                                                                        .split("-")
                                                                        .filter(item => !Number(item))
                                                                        .join(" ");
                                    </script>
                                </div>
                                <a href="{{$data->link}}" target="_blank" class='d-flex justify-content-center align-items-center m-auto mt-2 pb-2'>
                                    <span class='d-block'>
                                        {{ __("Ver Produtos") }}
                                    </span> 
                                    <i class="fas fa-caret-right d-block"></i>
                                </a>
                            </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Partners Area Start -->
@endif
