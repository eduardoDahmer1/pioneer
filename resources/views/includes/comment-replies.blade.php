@if (Auth::guard('web')->check())

    <div class="review-area">
        <h4 class="title">{{ __('Write Comment') }}</h4>
    </div>
    <div class="write-comment-area">
        <form id="comment-form" action="{{ route('product.comment') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" id="product_id" value="{{ $productt->id }}">
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::guard('web')->user()->id }}">
            <div class="row">
                <div class="col-lg-12">
                    <textarea placeholder="{{ __('Write Your Comments Here...') }}" name="text"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button class="submit-btn shadow" type="submit">{{ __('Post Comment') }}</button>
                </div>
            </div>
        </form>
    </div>
    <br>


    <ul class="all-comment">
        @if ($productt->comments)
            @foreach ($productt->comments()->orderBy('created_at', 'desc')->get() as $comment)
                <li>
                    <div class="single-comment comment-section">
                        <div class="left-area">
                            <img src="{{ $comment->user->photo != null ? asset('storage/images/users/' . $comment->user->photo) : asset('assets/images/noimage.png') }}"
                                alt="">
                            <h5 class="name">{{ $comment->user->name }}</h5>
                            <p class="date">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="right-area">
                            <div class="comment-body">
                                <p>
                                    {{ $comment->text }}
                                </p>
                            </div>
                            <div class="comment-footer">
                                <div class="links">
                                    <a href="javascript:;" class="comment-link reply mr-2"><i
                                            class="fas fa-reply "></i>{{ __('Reply') }}</a>
                                    @if (count($comment->replies) > 0)
                                        <a href="javascript:;" class="comment-link view-reply mr-2"><i
                                                class="fas fa-eye "></i>{{ __('View') }}
                                            {{ count($comment->replies) == 1 ? __('Reply') : __('Replies') }}</a>
                                    @endif
                                    @if (Auth::guard('web')->user()->id == $comment->user->id)
                                        <a href="javascript:;" class="comment-link edit mr-2"><i
                                                class="fas fa-edit "></i>{{ __('Edit') }}</a>
                                        <a href="javascript:;"
                                            data-href="{{ route('product.comment.delete', $comment->id) }}"
                                            class="comment-link comment-delete mr-2"><i
                                                class="fas fa-trash"></i>{{ __('Delete') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="replay-area edit-area">
                        <form class="update" action="{{ route('product.comment.edit', $comment->id) }}" method="POST">
                            {{ csrf_field() }}
                            <textarea placeholder="{{ __('Edit Your Comment') }}" name="text" required=""></textarea>
                            <button type="submit">{{ __('Submit') }}</button>
                            <a href="javascript:;" class="remove">{{ __('Cancel') }}</a>
                        </form>
                    </div>
                    @if ($comment->replies)
                        @foreach ($comment->replies as $reply)
                            <div class="single-comment replay-review hidden">
                                <div class="left-area">
                                    <img src="{{ $reply->user->photo != null ? asset('storage/images/users/' . $reply->user->photo) : asset('assets/images/noimage.png') }}"
                                        alt="">
                                    <h5 class="name">{{ $reply->user->name }}</h5>
                                    <p class="date">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="right-area">
                                    <div class="comment-body">
                                        <p>
                                            {{ $reply->text }}
                                        </p>
                                    </div>
                                    <div class="comment-footer">
                                        <div class="links">

                                            <a href="javascript:;" class="comment-link reply mr-2"><i
                                                    class="fas fa-reply "></i>{{ __('Reply') }}</a>
                                            @if (Auth::guard('web')->user()->id == $reply->user->id)
                                                <a href="javascript:;" class="comment-link edit mr-2"><i
                                                        class="fas fa-edit "></i>{{ __('Edit') }}</a>
                                                <a href="javascript:;"
                                                    data-href="{{ route('product.reply.delete', $reply->id) }}"
                                                    class="comment-link reply-delete mr-2"><i
                                                        class="fas fa-trash"></i>{{ __('Delete') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="replay-area edit-area">
                                <form class="update" action="{{ route('product.reply.edit', $reply->id) }}"
                                    method="POST">
                                    {{ csrf_field() }}
                                    <textarea placeholder="{{ __('Edit Your Reply') }}" name="text" required=""></textarea>
                                    <button type="submit">{{ __('Submit') }}</button>
                                    <a href="javascript:;" class="remove">{{ __('Cancel') }}</a>
                                </form>
                            </div>
                        @endforeach
                    @endif

                    <div class="replay-area reply-reply-area">
                        <form class="reply-form" action="{{ route('product.reply', $comment->id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                            <textarea placeholder="{{ __('Write your reply') }}" name="text" required=""></textarea>
                            <button type="submit">{{ __('Submit') }}</button>
                            <a href="javascript:;" class="remove">{{ __('Cancel') }}</a>
                        </form>
                    </div>

                </li>
            @endforeach
        @endif
    </ul>
@else
    <div class="row">
        <div class="col-lg-12">
            <br>
            <h3 class="text-center login-text">
                <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"
                    class="btn">{{ __('Login') }}</a> {{ __('To Comment') }} </h3>
            <br>
        </div>
    </div>

    @if ($productt->comments)
        <ul class="all-comment">

            @foreach ($productt->comments()->orderBy('created_at', 'desc')->get() as $comment)
                <li>
                    <div class="single-comment">
                        <div class="left-area">
                            <img src="{{ $comment->user->photo != null ? asset('storage/images/users/' . $comment->user->photo) : asset('assets/images/noimage.png') }}"
                                alt="">
                            <h5 class="name">{{ $comment->user->name }}</h5>
                            <p class="date">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="right-area">
                            <div class="comment-body">
                                <p>
                                    {{ $comment->text }}
                                </p>
                            </div>
                            <div class="comment-footer">
                                <div class="links">

                                    @if (count($comment->replies) > 0)
                                        <a href="javascript:;" class="comment-link view-reply mr-2"><i
                                                class="fas fa-eye "></i>{{ __('View') }}
                                            {{ count($comment->replies) == 1 ? __('Reply') : __('Replies') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($comment->replies)
                        @foreach ($comment->replies()->orderBy('created_at', 'desc')->get() as $reply)
                            <div class="single-comment replay-review hidden">
                                <div class="left-area">
                                    <img src="{{ $reply->user->photo != null ? asset('storage/images/users/' . $reply->user->photo) : asset('assets/images/noimage.png') }}"
                                        alt="">
                                    <h5 class="name">{{ $reply->user->name }}</h5>
                                    <p class="date">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="right-area">
                                    <div class="comment-body">
                                        <p>
                                            {{ $reply->text }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif

                </li>
            @endforeach
        </ul>
    @endif

@endif
