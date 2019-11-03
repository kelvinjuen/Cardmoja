@extends('layouts.app')

@section('content')
<div class="site-blocks-cover overlay" style="background-image: url({{ asset('images/hero_1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-6 col-xl-8">
                <div class="row justify-content-center mb-4">
                    <div class="col-12  text-center">
                        <h1 data-aos="fade-up" class="footer-heading mb-4"><img src="{{ asset('images/medium/CardMoja-icon.png') }}" width="70px"><span class="text-blue">ard</span><span class="text-purple">Moja</span></h1>
                        <h5 class="text-white" data-aos="fade-up" data-aos-delay="100">Simple <i class="icon-hand-o-right"></i> Smart <i class="icon-hand-o-right"></i> Savvy</h5>
                        <a href="/register" class="btn btn-outline-primary text-white btn-md font-weight-bold">Sign Up</a>

                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4 text-center my-3">

                <div class="form-search-wrap  p-3" data-aos="fade-up" data-aos-delay="200">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <h5>Sign In</h5>
                            <hr/>
                        </div>

                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}"  required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-12">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="site-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5">
          <img src="{{ asset('images/medium/CardMoja_medium.png') }}" alt="Image" class="img-fluid rounded">
        </div>
        <div class="col-md-6 ml-auto">
          <h2 class="text-primary mb-3">Why CardMoja</h2>
          <ul class="ul-check list-unstyled success">
            <li>easy to <i class="icon-build"></i> create, <i class="icon-edit"></i> edit and <i class="icon-share-alt"></i>share</li>
            <li><i class="icon-save"></i>  save and manage card in your wallet</li>
            <li><i class="icon-update"></i>  always relevant and up to date</li>
            <li><i class="icon-visibility"></i>  Reliable Brand visibility</li>
            <li><i class="icon-rate_review"></i>  Review, Recommend & Rate Option</li>
            <li><i class="icon-sliders"></i>  flexible Templates and uploads</li>
            <li><i class="icon-wifi"></i>  keep all your online print in place</li>
            <li><i class="icon-format_color_reset"></i>  Paperless - cant be defaced,destroyed or lost</li>
          </ul>
        </div>
      </div>
    </div>
</div>

<div class="site-signup py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h2 class="mb-2 text-purple">Let's get started. Create your card</h2>
          <p class="mb-0"><a href="/register" class="btn btn-outline-primary text-white btn-md font-weight-bold">Sign Up</a></p>
        </div>
      </div>
    </div>
</div>
@endsection
