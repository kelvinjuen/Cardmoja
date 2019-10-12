@extends('layouts.app')

@section('content')
@include('inc.navbar')
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-start">
            <div class="col-9">
            <div class="card" id="card">
                <img class="card-img" src="" height="100%" id="card-bg"  alt="Card image">
                <div class="card-img-overlay" id="cardwrapper">
                </div>
            </div>
            </div>
            <div class="col-3">
                <label for="input-1" class="control-label">Give a Rating to name</label>
                <div class="my-rating"></div>

            </div>
        </div>
    </div>
</div>

<script>
    if(!$.fn.starRating){
        alert('not loaded');
    }
    $(".my-rating").starRating({
            initialRating: 4.0,
            starSize: 25,
            callback: function(currentRating, $el){
                alert('rated ', currentRating);
                console.log('DOM element ', $el);
            }
        });
    $(function(){

    });


    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $.ajax({
            url:"{{route('card.show',$_GET['id'])}}",
            method:'GET',
            contentType:false,
            processData:false,
            success:function(data)
            {
                let obj = data.card;
                if(obj.type == 1){
                    $('#cardwrapper').html('@include("pages.template.1"));
                }else if(obj.type == 2){
                    $('#cardwrapper').html('@include("pages.template.2"));
                }else if(obj.type == 3){
                    $('#cardwrapper').html('@include("pages.template.3"));
                }

                if(obj != null){
                    document.getElementById("card").style.color =obj.colour_1;
                    let elements = document.getElementsByClassName("card-subtitle");
                    for (let i = 0; i < elements.length; i++) {
                        elements[i].style.color = obj.colour_2;
                    }
                    $('.card-img').attr('src','/storage/background_images/'+obj.bg_image);
                    $('.img-fluid').attr('src','/storage/card_images/'+obj.photo);
                    $('.company').html(obj.company);
                    $('.name').html(obj.designation+' '+obj.full_name);
                    $('.position').html(obj.position);

                    if(obj.phone_no != null){
                        $('.info').append(' <li >&#9742;'+obj.phone_no+'</li>');
                        $('.info-inline').append(' <li class="mx-1" style="display: inline-block;"><strong>&#9742;'+obj.phone_no+'</strong></li>');
                    }
                    if(obj.email != null){
                        $('.info').append(' <li >&#9742;'+obj.email+'</li>');
                        $('.info-inline').append(' <li class="mx-1" style="display: inline-block;"><strong>&#9742;'+obj.email+'</strong></li>');
                    }
                    if(obj.physical_address != null){
                        $('.info').append(' <li >&#9742;'+obj.physical_address+'</li>');
                        $('.info-inline').append(' <li class="mx-1" style="display: inline-block;"><strong>&#9742;'+obj.physical_address+'</strong></li>');
                    }
                    if(obj.post_address != null){
                        $('.info').append(' <li >&#9742;'+obj.post_address+'</li>');
                        $('.info-inline').append(' <li class="mx-1" style="display: inline-block;"><strong>&#9742;'+obj.post_address+'</strong></li>');
                    }
                    let social = obj['social_media'].split(",");
                    for (let index = 0; index < social.length; index++) {

                        let social_link = social[index].split("->")
                        if(social_link[0] === 'facebook'){
                            $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="facebook" class="mx-2"><span class="icon-facebook"></span></a>');
                        }
                        if(social_link[0] === 'twitter'){
                            $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="twitter" class="mx-2"><span class="icon-twitter"></span></a>');
                        }
                        if(social_link[0] === 'github'){
                            $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="github" class="mx-2"><span class="icon-github"></span></a>');
                        }
                    }

                    var services = obj['services'].split(",");

                    for (let index = 0; index < services.length; index++) {
                        if(index == 0){
                            $('.services').append('<li class="mx-1" style="display: inline-block;"><span class="border-left pl-xl-2"></span><strong>'+services[index]+'</strong></li>');
                        }else{
                            $('.services').append('<li class="mx-1" style="display: inline-block;"><strong>'+services[index]+'</strong></li>');
                        }


                    }

                    if( {{auth()->user()->user_id}} == obj.user_id ){
                        $('.extra').html('<div class="col-12 col-sm-12 col-md-12"><a href="/card/{{auth()->user()->user_id}}/edit" class="btn btn-primary w-100 ">Edit Card</a></div>');
                    }else{
                        $('.extra').html('');
                    }
                }
            }
        });
    });

    $(document).on('submit', '#message_form', function(event){
            event.preventDefault();
            var success = false;

            $.ajax({
                url:"",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;

                    if(obj != null){

                    }else{

                        var obj = data.lastId;
                        //window.location.href = "/design/create?id=" + obj;
                    }


                }
            });
    });
</script>
@endsection

