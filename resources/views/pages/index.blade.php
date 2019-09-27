@extends('layouts.app')

@section('content')
<div class="site-blocks-cover overlay" style="background-image: url({{ asset('images/hero_1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                    <h1 data-aos="fade-up" class="footer-heading mb-4"><img src="{{ asset('images/uploads/medium/cardmoja_medium-100x100.png')}}" width="50px">CardMoja</h1>
                    <p data-aos="fade-up" data-aos-delay="100">Create a Digital Business Card to present who you are and what you do in one link.</p>
                    <a href="/login" class="btn btn-primary">Sign In <i class="flaticon-login"></i></a>

                    </div>
                </div>
            </div>

            <div class="col-md-4 text-center">

                <div class="form-search-wrap  p-3" data-aos="fade-up" data-aos-delay="200">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <h5>Get Started</h5>
                        </div>
                        <div class="form-group">
                            <select id="type" name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" required autofocus>
                                <option value="personal" selected>{{ __('Account Type') }}</option>
                                <option value="personal">Personal</option>
                                <option value="coperate">Coperate</option>
                            </select>
                        </div>

                        <div class="form-group ">
                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary col-12">{{ __('Register') }}<i class="flaticon-clipboard"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
