<div class="container-fluid fundoForm">
    <div class="container remove-padding">
        <form action="{{ route('front.subscribe') }}" id="subscribeform2" method="POST">
            {{ csrf_field() }}
            <div class="row fundoForm px-4">
                <div class="mb-3 mb-md-0 col-md-3 remove-padding fundotitleMargin">
                    <h3>{{ __('Pioneer! News') }}</h3>
                    <h6>{{ __('Receive exclusive offers in your email') }}</h6>
                </div>
                <div class="mb-3 mb-md-0 col-md-3 remove-padding fundoFormMargin">
                    <input type="name" name="name" class="form-control" id="exampleInputName1"
                        placeholder="Qual seu nome?">
                </div>
                <div class="mb-3 mb-md-0 col-md-4 remove-padding fundoFormMargin">
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        placeholder="Seu email?">
                </div>
                <button type="submit" class="col-md-6 mx-md-auto mt-md-4 btn btn-dark buttonForm">{{ __('register') }}</button>
            </div>
        </form>
    </div>
</div>
