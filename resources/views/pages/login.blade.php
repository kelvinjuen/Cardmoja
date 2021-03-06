@extends('layouts.app')

@section('content')
<div class="site-blocks-cover overlay" style="background-image: url({{ asset('images/hero_1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-5 ">
                <div class="form-search-wrap  p-3" data-aos="fade-up" data-aos-delay="200">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <h5>Sign In</h5>
                            <hr/>
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
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary col-12">{{ __('Sign In') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
