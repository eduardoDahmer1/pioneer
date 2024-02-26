@if ($ps->featured_category == 1)
    @php
        $categoryhasimage = false;
        $categories_data = [];

        foreach ($categories->where('is_featured', '=', 1) as $key => $cat) {
            if (!empty($cat->image) || !empty($cat->photo)) {
                $categories_data[$key] = $cat; 
                $categoryhasimage = true;
            }

            if (count($categories_data) > 4) {
                break;
            }
        }

        $categories_group = collect(array_slice($categories_data, 0, 4));
    @endphp

    {{-- Slider buttom Category Start --}}
    <div class="slider-buttom-category categorias-destaq my-4 mt-4 px-4">
        <div class="container">
            <div class="row flex-column flex-md-row remove-padding justify-content-between align-items-center pb-2">
                @if ($categoryhasimage)
                    <div class="col-md-8">
                        <div class="text-left">
                            <h3 class="titulo-categorias">{{ __('Navegue pelos departamentos') }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end mt-0 mt-md-0">
                        <a href="#" class='text-left'>
                            {{ __("Ver tudo") }}
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endif     
            </div> 
            {{-- HARD CODED  --}}
            <div class="row remove-padding mt-3">
                <div class="col-6 col-md-3">
                    <a href="{{ route('front.category', 'informatica-22/hardware-174') }}" class="single-category d-flex flex-column">
                        <div class="infos-internas">
                            <h5 class="title">
                                {{ __('Hardware') }}
                            </h5>
                            {{-- <p class="count">
                                {{ count($categories->where('slug', '=', 'celulares')->first()->products) }} {{ __('Item(s)') }}
                            </p>  --}}
                        </div>

                        <img class="img" src="{{ asset('assets/images/hardware.png') }}" alt="" />
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('front.category', 'informatica-22/perifericos-165') }}" class="single-category d-flex flex-column">
                        <div class="infos-internas">
                            <h5 class="title">
                                {{ __('Periféricos') }}
                            </h5>
                            {{-- <p class="count">
                                {{ count($categories->where('slug', '=', 'celulares')->first()->products) }} {{ __('Item(s)') }}
                            </p>  --}}
                        </div>

                        <img class="img" src="{{ asset('assets/images/gaming_kit.png') }}" alt="" />
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    {{-- <a href="{{ route('front.category', 'informatica-22/notebooks-7') }}" class="single-category d-flex flex-column"> --}}
                    <a href="{{ route('front.category', 'computadores-24') }}" class="single-category d-flex flex-column">
                        <div class="infos-internas">
                            <h5 class="title">
                                {{ __('Computadores') }}
                            </h5>
                            {{-- <p class="count">
                                {{ count($categories->where('slug', '=', 'celulares')->first()->products) }} {{ __('Item(s)') }}
                            </p>  --}}
                        </div>

                        <img class="img" src="{{ asset('assets/images/computers.png') }}" alt="" />
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('front.category', 'games-20') }}" class="single-category d-flex flex-column">
                        <div class="infos-internas">
                            <h5 class="title">
                                {{ __('Games') }}
                            </h5>
                            {{-- <p class="count">
                                {{ count($categories->where('slug', '=', 'celulares')->first()->products) }} {{ __('Item(s)') }}
                            </p>  --}}
                        </div>

                        <img class="img" src="{{ asset('assets/images/gaming_consoles.png') }}" alt="" />
                    </a>
                </div>
                {{-- @foreach ($categories_group->where('is_featured', '=', 1) as $cat)
                    <div class="col-6 col-md-3">
                        <a href="{{ route('front.category', $cat->slug) }}" class="single-category d-flex flex-column">
                            <div class="infos-internas">
                                <h5 class="title">
                                    {{ $cat->name }}
                                </h5>
                                <p class="count">
                                    {{ count($cat->products) }} {{ __('Item(s)') }}
                                </p> 
                            </div>

                            <img class="img" src="{{ asset('storage/images/categories/' . ($cat->image ?? $cat->photo)) }}" alt="" />
                        </a>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>
    {{-- Slider buttom banner End --}}

@endif
