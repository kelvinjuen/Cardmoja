@extends('layouts.app')

@section('content')
@include('inc.navbar')
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container-fluid">
        <div class="row  justify-content-center">
            <div class="col-12 col-md-8 my-3">
                <form id="setting_form">
                    <h3 class="text-secondary mb-4 border-bottom mb-4">Information Security Access</h3>
                    <div class="form-group row">
                      <label for="phone" class="col-12 col-sm-4 col-md-5 col-lg-4 col-form-label">PHONE NUMBERS:</label>
                      <select id="phone" name="phone" class="form-control col-12 col-sm-6">
                        <option value="0"elected>ANYONE CAN VIEW</option>
                        <option value="1">ONLY CONTACTS CAN VIEW</option>
                      </select>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-12 col-sm-4 col-md-5 col-lg-4 col-form-label">EMAIL ADDRESS:</label>
                        <select id="email" name="email" class="form-control col-12 col-sm-6">
                            <option value="0"elected>ANYONE CAN VIEW</option>
                            <option value="1">ONLY CONTACTS CAN VIEW</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-12 col-sm-4 col-md-5 col-lg-4 col-form-label">PHYSICAL ADDRESS:</label>
                        <select id="address" name="address" class="form-control col-12 col-sm-6">
                            <option value="0"elected>ANYONE CAN VIEW</option>
                            <option value="1">ONLY CONTACTS CAN VIEW</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="post" class="col-12 col-sm-4 col-md-5 col-lg-4 col-form-label">POST ADDRESS:</label>
                        <select id="post" name="post" class="form-control col-12 col-sm-6">
                            <option value="0"elected>ANYONE CAN VIEW</option>
                            <option value="1">ONLY CONTACTS CAN VIEW</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="links" class="col-12 col-sm-4 col-md-5 col-lg-4 col-form-label">SOCIAL MEDIA LINKS:</label>
                        <select id="links" name="links" class="form-control col-12 col-sm-6">
                            <option value="0"elected>ANYONE CAN VIEW</option>
                            <option value="1">ONLY CONTACTS CAN VIEW</option>
                        </select>
                    </div>
                    <h3 class="text-secondary mb-4 border-bottom mb-4">Share Link</h3>
                    <div class="form-group row">
                        <label for="card_link" class="col-12 col-sm-4 col-md-5 col-lg-4 col-form-label">SHARED CARD LINK:</label>
                        <select id="card_link" name="card_link" class="form-control col-12 col-sm-6">
                            <option value="0" selected>DO NOT EXPIRE</option>
                            <option value="1">EXPIRE AFTER VIEW</option>
                            <option value="2">EXPIRE AFTER A WEEK</option>
                        </select>
                    </div>
                    <div class="form-group row">
                      <div class="col-3 offset-9">
                        <button type="submit" class="btn btn-primary block">SAVE</button>
                        {{csrf_field()}}
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(){
            $.ajax({
                url:"getsetting/{{auth()->user()->user_id}}",
                method:'GET',
                async: false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    obj = data.setting;
                    if(obj != null){
                        $('#phone').val(obj.phone);
                        $('#email').val(obj.email);
                        $('#address').val(obj.physical);
                        $('#post').val(obj.post);
                        $('#card_links').val(obj.social_links);
                        $('#link').val(obj.card_link);
                    }
                }
            });
        });

        $(document).on('submit', '#setting_form', function(event){
                event.preventDefault();
                $.ajax({
                    url:"/savesetting",
                    method:'POST',
                    async: false,
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        var obj = data.success;
                        let type = '{{auth()->user()->type}}' ;

                        window.location.href = "/";
                    }
                });


        });
    </script>

@endsection

