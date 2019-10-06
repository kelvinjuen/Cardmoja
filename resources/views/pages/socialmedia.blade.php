@extends('layouts.app')

@section('content')
<div class="site-section">
        <div class="container">
            <div class="card-wrap ">
                <h3 class="text-secondary mb-4 text-center">Card Details</h3>
                <form id="social_form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-secondary mb-4 my-4">Social Media Links</h6>
                            <div class="form-group row">
                                <div class="input-group input-group mb-3 col-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text icon-facebook"></span>
                                    </div>
                                    <input type="text" class="form-control" id="facebook"  placeholder="https://web.facebook.com/yourprofile">
                                    <a href="/auth/facebook" class="btn btn-outline-primary col-2" ><span class=" icon-facebook"></span></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input-lg" type="checkbox" id="facebook" name="facebook" checked>
                                    <label class="form-check-label-lg" for="gridCheck">
                                        Visible To All
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group input-group mb-3 col-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text icon-twitter"></span>
                                    </div>
                                    <input type="text" class="form-control" id="twitter" placeholder="https://twitter.com/kelvin_njue">
                                    <a href="/auth/twitter" class="btn btn-outline-primary col-2" ><span class=" icon-twitter"></span></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input-lg" type="checkbox" id="twitter" name="twitter" checked>
                                    <label class="form-check-label-lg" for="gridCheck">
                                        Visible To All
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group input-group mb-3 col-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text icon-instagram"></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="instagram">
                                    <a href="#" class="btn btn-outline-primary col-2" ><span class=" icon-instagram"></span></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input-lg" type="checkbox" id="instagram" name="instagram" checked>
                                    <label class="form-check-label-lg" for="gridCheck">
                                        Visible To All
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group input-group mb-3 col-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text icon-linkedin"></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="https://linkedin.com/linkedin-username">
                                    <a href="#" class="btn btn-outline-primary col-2" ><span class=" icon-linkedin"></span></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input-lg" type="checkbox" id="linkedin" name="linkedin" checked>
                                    <label class="form-check-label-lg" for="gridCheck">
                                        Visible To All
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group input-group mb-3 col-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text icon-youtube"></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="youtube channel">
                                    <a href="#" class="btn btn-outline-primary col-2" ><span class=" icon-youtube"></span></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input-lg" type="checkbox" id="youtube" name="youtube" checked>
                                    <label class="form-check-label-lg" for="gridCheck">
                                        Visible To All
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group input-group mb-3 col-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text icon-skype"></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="skype">
                                    <a href="#" class="btn btn-outline-primary col-2" ><span class=" icon-skype"></span></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input-lg" type="checkbox" id="skype" name="skype" checked>
                                    <label class="form-check-label-lg" for="gridCheck">
                                        Visible To All
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-group input-group mb-3 col-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text icon-github"></span>
                                    </div>
                                    <input type="text" class="form-control" id="github" placeholder="https://github.com/github-username">
                                    <a href="/auth/github" class="btn btn-outline-primary col-2" ><span class="icon-github"></span></a>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input-lg" type="checkbox" id="github" name="github" checked>
                                    <label class="form-check-label-lg" for="gridCheck">
                                        Visible To All
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div id="map" class="">
                                <input id="pac-input" class="form-control controls" placeholder="insert the location" ame="location" type="text">
                                <div id="map-canvas"> </div>
                                <input name="lat" class="lat" type="hidden">
                                <input name="lon" class="lon" type="hidden">
                           </div>
                        </div>
                    </div>
                    <button type="submit" id="submit_card" class="btn btn-primary btn-sm col-12">Next</button>
                    {{csrf_field() }}
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript" language="javascript">
    $(document).on('submit', '#social_form', function(event){
            event.preventDefault();
            formData = new FormData(this);
            if(file != null){
                formData.append('card_photo', file, 'avatar.jpg');
            }
            $.ajax({
                url:"{{route('card.update',Auth::user()->user_id)}}",
                method:'POST',
                async: false,
                data:formData,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;
                    $('.photo').html('');
                    if(obj != null){

                    }else{
                        alert ("successfully editted");
                        window.location.href = "/card?id={{auth()->user()->user_id}}";
                    }
                }
            });
    });

    $(document).ready(function(){
        $.ajax({
            url:"{{route('card.show',Auth::user()->user_id)}}",
            method:'GET',
            async: false,
            contentType:false,
            processData:false,
            success:function(data)
            {
                let obj = data.card;

                if(obj != null){
                    var links = obj['social_media'].split(",");
                    for (let index = 0; index < links.length; index++) {
                        let link = links[index].split('->');
                        if(link[0] === 'github'){
                            $('#github').attr('value',link[1]);
                        }else if(link[0] === 'facebook'){
                            $('#facebook').attr('value',link[1]);
                        }else if(link[0] === 'twitter'){
                            $('#twitter').attr('value',link[1]);
                        }else if(link[0] === 'youtube'){
                            $('#youtube').attr('value',link[1]);
                        }else if(link[0] === 'linkedin'){
                            $('#linkedin').attr('value',link[1]);
                        }else if(link[0] === 'instagram'){
                            $('#instagram').attr('value',link[1]);
                        }else if(link[0] === 'skype'){
                            $('#skype').attr('value',link[1]);
                        }
                    }
                }
            }
        });
    });

</script>

@endsection
