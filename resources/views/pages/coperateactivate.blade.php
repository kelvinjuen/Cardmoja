@extends('layouts.app')

@section('content')
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10 ">
                <h3 class="text-secondary text-center">Card Details</h3>
                <form id="card_form" method="POST" enctype="multipart/form-data">

                    <h6 class="text-secondary mb-4 border-bottom mb-4">Personal Profile</h6>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group rounded">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Desigination:</span>
                                </div>
                                <select class="select-group" id="designation" name="designation">
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr">Dr</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group rounded">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Names:</span>
                                </div>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="FirstName" required>
                                <input type="text" class="form-control" name="secondName" id="secondName" placeholder="SecondName" required>
                                <input type="text" class="form-control" name ="thirdName" id="thirdName" placeholder="ThirdName" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Profile photo</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <input type="file" class="form-control-file" id="card_photo" name="card_photo">
                        </div>
                        <div class="col">
                            <span class="photo"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="input-group rounded col-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ __('Password') }}</span>
                            </div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="input-group rounded col-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ __('Confirm Password') }}</span>
                            </div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <button type="submit" id="submit_card" class="btn btn-primary btn-sm col-12">Create Card</button>
                    {{csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript">


    $(document).on('submit', '#card_form', function(event){
        event.preventDefault();
        var success = false;

        $.ajax({
            url:"{{route('card.store')}}",
            method:'POST',
            async: false,
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                var obj = data.errors;
                $('.photo').html('');
                if(obj != null){
                    $('#firstName').attr('placeholder',obj['firstName']);
                    $('#secondName').attr('placeholder',obj['secondName']);
                    $('#position').attr('placeholder',obj['position']);
                    $('#company').attr('placeholder',obj['company']);
                    $('#mobile').attr('placeholder',obj['mobile']);
                    $('.photo').html(obj['card_photo']);
                }else{
                    var lastid = data.lastid;
                    window.location.href = "/design;
                }
            }
        });
    });

    $(document).ready(function(){


    });


</script>

@endsection
