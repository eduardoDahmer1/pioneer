<div class="row">
    <div class="col-lg-12">
        <div id="product-details-tab">
            <div class="top-menu-area d-flex">
                <ul class="tab-menu w-100">
                    @if ($gs->is_rating == 1)
                    {{--  ({{ count($productt->ratings) }})--}}
                        <li><a href="#tabs-3">{{ __('Reviews') }}</a></li>
                    @endif
                    <li><a href="#tabs-2">{{ __('BUY & RETURN POLICY') }}</a></li>
                    @if ($gs->is_comment == 1)
                        <li>
                            <a href="#tabs-4">{{ __('Comment') }}
                                (<span id="comment_count">{{ count($productt->comments) }}</span>)
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="tab-content-wrapper">
                @if ($gs->is_rating == 1)
                    <div id="tabs-3" class="tab-content-area">
                        <div class="heading-area">
                            <h4 class="title">
                                {{ __('Ratings & Reviews') }}
                            </h4>
                            <div class="reating-area">
                                <div class="stars">
                                    <span id="star-rating">{{ App\Models\Rating::rating($productt->id) }}</span>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div id="replay-area">
                            <div id="reviews-section">
                                @if (count($productt->ratings) > 0)
                                    <ul class="all-replay">
                                        @foreach ($productt->ratings as $review)
                                            <li>
                                                <div class="single-review">
                                                    {{-- <div class="left-area">
                                                        {{-- <img src="{{ $review->user->photo
                                                            ? asset('storage/images/users/' . $review->user->photo)
                                                            : asset('assets/images/noimage.png') }}"
                                                            alt=""> 
                                                        <img src="{{ asset('storage/images/user.jpg') }}" alt="">
                                                        {{-- <h5 class="name">{{ $review->user->name }} Test</h5> 
                                                        
                                                        
                                                    </div> --}}
                                                    <div class="right-area w-100 d-flex flex-column justify-content-around">
                                                        <div class="header-area d-flex flex-column justify-content-center">
                                                            <div class="row align-items-center remove-padding m-0">
                                                                <h5 class="name mb-0 mr-2">
                                                                    {{-- {{ \Faker\Factory::create()->name() }} --}}
                                                                    {{ $review->user->name }}
                                                                </h5>
                                                                <div class="stars-area">
                                                                    <ul class="stars">
                                                                        <div class="ratings">
                                                                            <div class="empty-stars"></div>
                                                                            <div class="full-stars"
                                                                                style="width:{{ $review->rating * 20 }}%">
                                                                            </div>
                                                                            {{-- <div class="full-stars"
                                                                                style="width:{{ 4 * 20 }}%">
                                                                            </div> --}}
                                                                        </div>
                                                                    </ul>
                                                                </div>     
                                                            </div> 
                                                            <p class="date">
                                                                {{-- {{ \Carbon\Carbon::now()->subDays(rand(1, 100))->diffForHumans() }} --}}
                                                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $review->review_date)->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="review-body mt-2">
                                                            <p>
                                                                {{-- {{ \Faker\Factory::create()->paragraph(rand(3, 6)) }} --}}
                                                                {{ $review->review }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>{{ __('No Review Found.') }}</p>
                                @endif
                            </div>
                            @if (Auth::guard('web')->check())
                                <div class="review-area">
                                    <h4 class="title">{{ __('Review') }}</h4>
                                    <div class="star-area">
                                        <ul class="star-list">
                                            <li class="stars" data-val="1">
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars" data-val="2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars" data-val="3">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars" data-val="4">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="stars active" data-val="5">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="write-comment-area">
                                    <div class="gocover"
                                        style="background: url({{ asset('storage/images/' . $gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                    </div>
                                    <form id="reviewform" action="{{ route('front.review.submit') }}"
                                        data-href="{{ route('front.reviews', $productt->id) }}" method="POST">
                                        @include('includes.admin.form-both')
                                        {{ csrf_field() }}
                                        <input type="hidden" id="rating" name="rating" value="5">
                                        <input type="hidden" name="user_id"
                                            value="{{ Auth::guard('web')->user()->id }}">
                                        <input type="hidden" name="product_id" value="{{ $productt->id }}">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="review" placeholder="{{ __('Your Review') }}" required>
                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="submit-btn shadow" type="submit">
                                                    {{ __('SUBMIT') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>
                                        <h5 class="text-center login-text">
                                            <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"
                                                class="btn mr-1">
                                                {{ __('Login') }}
                                            </a>
                                            {{ __('To Review') }}
                                        </h5>
                                        <br>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div id="tabs-2" class="tab-content-area">
                    @if ($gs->policy)
                        <p>{!! $gs->policy !!}</p>
                    @elseif($productt->policy)
                        <p>{!! $productt->policy !!}</p>
                    @endif
                </div>
                
                @if ($gs->is_comment == 1)
                    <div id="tabs-4" class="tab-content-area">
                        <div id="comment-area">
                            @include('includes.comment-replies')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@if(env('THEME') === 'theme-09')
    {{-- <table id="prodTable">
        <tr>
            <th style="width: 50%; color: #121212;">Componente</th>
            <th style="color: #121212;">Especificação</th>
        </tr>
    </table> --}}
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            color: #777777;
            font-size: 14px;
        }
        th {
            background-color: #f2f2f2;
        }
        .gray-row {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        var jsonData = @json($productt->description_gpt)
        
        var replaceJson = jsonData .replace(/\n/g, '')
        var jsonObj = JSON.parse(replaceJson)
        var prodJsonFormat = {
            "especificacoes": jsonObj
        };
        var table = document.getElementById("prodTable");
        var specifications = prodJsonFormat.especificacoes;
        for (var category in specifications) {
            if (specifications.hasOwnProperty(category)) {
                if (typeof specifications[category] === 'object') {
                    for (var subCategory in specifications[category]) {
                        if (specifications[category].hasOwnProperty(subCategory)) {
                            var row = table.insertRow(table.rows.length);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            cell1.innerHTML = category + " - " + subCategory;
                            cell2.innerHTML = specifications[category][subCategory];
                        }
                    }
                } else {
                    var row = table.insertRow(table.rows.length)
                    var cell1 = row.insertCell(0)
                    var cell2 = row.insertCell(1)
                    cell1.innerHTML = category
                    cell2.innerHTML = specifications[category]
                }
            }
        }
        var rows = table.getElementsByTagName("tr")
        for (var i = 1; i < rows.length; i++) {
            if (i % 2 === 0) {
                rows[i].classList.add("gray-row")
            }
        }
        for (var i = 0; i < rows.length; i++) {
            var firstTd = rows[i].getElementsByTagName("td")[0];
            if (firstTd) {
                firstTd.style.fontWeight = 600
                firstTd.style.textTransform = 'capitalize'
            }
        }
    </script>
@endif