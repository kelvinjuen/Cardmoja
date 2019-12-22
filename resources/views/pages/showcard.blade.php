@extends('layouts.app')

@section('content')
@guest
@else
 @include('inc.navbar')
@endguest
@include('inc.recomend')
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-start">
            <div class="col-12 col-sm-12 col-md-12 px-lg-5 col-lg-12 px-xl-5 col-xl-7">
                    <div class="card-section" >
                        <div class="card-container" id="card-container" >
                            <div class="container p-3" id="cardwrapper" >

                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-lg-5 px-xl-5 col-xl-5 text-center">
                <div id="recomend-div"></div>
                <div id="wallet-link"></div>
                <div id="review-div">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.star-rating-svg.js') }}" type="text/javascript"></script>
<script>

    $(document).ready(function(){
        setCard();
    });

    $(document).on('submit', '#rate-form', function(event){
            event.preventDefault();
            let rating = $('#rating').val();
            if(rating != 0){
                $.ajax({
                    url:"{{route('review.store')}}",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        $('#review-div').html('@include("pages.template.ratingdefault"));
                        setCard();
                    }
                });
            }
    });

    $(document).on('click', '.rate', function(event){
        event.preventDefault();
        $('#review-div').html('@include("pages.template.ratingform"));
        $(".my-rating").starRating({
            starSize: 20,
            disableAfterRate: false,
            strokeWidth: 0,
            useGradient: false,
            minRating: 1,
            onHover: function(currentIndex, currentRating, $el){
            $('.live-rating').text(currentIndex);
            },
            onLeave: function(currentIndex, currentRating, $el){
            $('.live-rating').text(currentRating);
            $('#rating').attr('value', currentRating);
            },
        });
    });

    $(document).on('submit', '#add-contact', function(event){
            event.preventDefault();
            var success = false;
            $('.suggestion').empty();
            $('.request').empty();
            $('#contacts').empty();
            $.ajax({
                url:"{{route('connect.store')}}",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    setCard();
                },
                error: function(XMLHttpRequest, textstatus, errorThrown){
                    if(errorThrown == 'Unauthorized'){
                        window.location.href = "/login";
                    }
                }
            });
    });

    function setCard(){
        $('[data-toggle="tooltip"]').tooltip();
        $.ajax({
            url:"{{route('card.show',$_GET['id'])}}",
            method:'GET',
            contentType:false,
            processData:false,
            success:function(data)
            {
                let obj = data.card;
                let objReview = data.review;
                let contacts = data.contacts;
                let setting = data.setting;
                let saved = false;
                let pedding = false;
                let connect = false;

                if(obj.type == 1){
                    $('#cardwrapper').html('@include("pages.template.1"));
                }else if(obj.type == 2){
                    $('#cardwrapper').html('@include("pages.template.2"));
                }else if(obj.type == 3){
                    $('#cardwrapper').html('@include("pages.template.3"));
                }

                if(obj != null){
                    document.getElementById("card-container").style.backgroundImage ="url('/storage/background_images/"+obj.bg_image+"')";
                    document.getElementById("cardwrapper").style.color =obj.colour_1;
                    let elements = document.getElementsByClassName("colour_2");
                    for (let i = 0; i < elements.length; i++) {
                        elements[i].style.color = obj.colour_2;
                    }
                    $('.card-img').attr('src','/storage/background_images/'+obj.bg_image);
                    $('#profile-photo').attr('src','/storage/card_images/'+obj.photo);
                    $('#profile-photo-round').attr('src','/storage/card_images/'+obj.photo);
                    $('.company').html(obj.company);
                    $('.name').html(obj.full_name);
                    $('.card-name').html(obj.full_name);
                    $('.position').html(obj.position);

                    if(data.user_id != {{$_GET['id']}} && data.user_id != 0){

                        for (let i = 0; i < contacts.length; i++) {
                            if(parseInt(contacts[i].user_id)  === {{$_GET['id']}}){
                                saved = true;
                                if(parseInt(contacts[i].status) != 1){
                                    pedding = true;
                                }

                                if(parseInt(contacts[i].status) === 1){
                                    connect = true;
                                }
                            }
                        }
                        if(saved){
                            if(pedding){
                                $('#review-div').html('@include("pages.template.ratingdefault"));
                                $('.rate').hide();
                            }else{
                                $('#review-div').html('<button type="button" class="btn btn-primary btn-block my-2 btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Recomend This Card</button>@include("pages.template.ratingdefault"));
                            }
                        }else{
                            $('#review-div').html('<form id="add-contact"><input type="hidden" name="user_1" value="'+data.user_id+'"> '+
                                                    '<input type="hidden" name="user_2" value="{{$_GET['id']}}">{{csrf_field() }}'+
                                                    '<button type="submit" class="btn btn-primary btn-block btn-sm">Add To Wallet</button></form>@include("pages.template.ratingdefault"));
                                                    $('.rate').hide();
                        }
                    }else{
                        if(!data.user_id != 0){
                            $('#wallet-link').html('<a href="/login" class="btn btn-primary btn-block my-2 add-wallet">ADD TO WALLET</a>');
                        }else{
                            window.location.href = "/home";
                        }
                    }

                    if(obj.phone_no != null){
                        if(setting.phone == 0){
                            let phone = obj['phone_no'].split("/");
                            for (let index = 0; index < phone.length; index++) {
                                $('.info').append(' <li ><a class="text-decoration-none text-reset" href="tel:'+phone[index]+'"><span class ="icon-phone"> </span>'+phone[index]+'</a></li>');
                                $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><a class="text-decoration-none text-reset" href="tel:'+phone[index]+'"><small><span class ="icon-phone"> </span>'+phone[index]+'</small></a></li>');
                            }
                        }else{
                            if(connect){
                                let phone = obj['phone_no'].split("/");
                                for (let index = 0; index < phone.length; index++) {
                                    $('.info').append(' <li ><a class="text-decoration-none text-reset" href="tel:'+phone[index]+'"><span class ="icon-phone"> </span>'+phone[index]+'</a></li>');
                                    $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><a class="text-decoration-none text-reset" href="tel:'+phone[index]+'"><small><span class ="icon-phone"> </span>'+phone[index]+'</small></a></li>');
                                }
                            }
                        }
                    }
                    if(obj.email != null){
                        if(setting.email === 0){
                            let email = obj['email'].split("/");
                            for (let index = 0; index < email.length; index++) {
                                $('.info').append(' <li ><a class="text-decoration-none text-reset" href="mailto:'+email[index]+'"><span class ="icon-mail_outline"> </span>'+email[index]+'</a></li>');
                                $('.info-inline').append('<li class="mr-1" style="display: inline-block;"><a class="text-decoration-none text-reset" href="mailto:'+email[index]+'"><small><span class ="icon-mail_outline"> </span>'+email[index]+'</small></a></li>');
                            }
                        }else{
                            if(connect){
                                let email = obj['email'].split("/");
                                for (let index = 0; index < email.length; index++) {
                                    $('.info').append(' <li ><a class="text-decoration-none text-reset" href="mailto:'+email[index]+'"><span class ="icon-mail_outline"> </span>'+email[index]+'</a></li>');
                                    $('.info-inline').append('<li class="mr-1" style="display: inline-block;"><a class="text-decoration-none text-reset" href="mailto:'+email[index]+'"><small><span class ="icon-mail_outline"> </span>'+email[index]+'</small></a></li>');
                                }
                            }
                        }
                    }
                    if(obj.physical_address != null){
                        if(setting.physical == 0){
                            $('.info').append(' <li ><span class ="icon-location_city"> </span>'+obj.physical_address+'</li>');
                            $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-location_city"> </span>'+obj.physical_address+'</small></li>');
                        }else{
                            if(connect){
                                $('.info').append(' <li ><span class ="icon-location_city"> </span>'+obj.physical_address+'</li>');
                                $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-location_city"> </span>'+obj.physical_address+'</small></li>');
                            }
                        }
                    }
                    if(obj.post_address != null){
                        if(setting.post === 0){
                            $('.info').append(' <li ><span class ="icon-markunread_mailbox"> </span>'+obj.post_address+'</li>');
                            $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-markunread_mailbox"> </span>'+obj.post_address+'</small></li>');
                        }else{
                            if(connect){
                                $('.info').append(' <li ><span class ="icon-markunread_mailbox"> </span>'+obj.post_address+'</li>');
                                $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-markunread_mailbox"> </span>'+obj.post_address+'</small></li>');
                            }
                        }

                    }
                    if(obj['social_media'] != null){
                        let social = obj['social_media'].split(",");
                        if(setting.social_links === 0){
                            for (let index = 0; index < social.length; index++) {

                                let social_link = social[index].split("->")
                                if(social_link[0] === 'facebook'){
                                    $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="facebook" class="mx-1"><span class="icon-facebook-square"></span></a>');
                                    $('.info-temp').append('<a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="facebook" class="mx-2"><span class="icon-facebook-square"></span></a>');
                                }
                                if(social_link[0] === 'twitter'){
                                    $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="twitter" class="mx-1"><span class="icon-twitter-square"></span></a>');
                                    $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="twitter" class="mx-1"><span class="icon-twitter-square"></span></a>');
                                }
                                if(social_link[0] === 'github'){
                                    $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="github" class="mx-1"><span class="icon-github-square"></span></a>');
                                    $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="github" class="mx-1"><span class="icon-github-square"></span></a>');

                                }
                                if(social_link[0] === 'youtube'){
                                    $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="youtube" class="mx-1"><span class="icon-youtube-square"></span></a>');
                                    $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="youtube" class="mx-1"><span class="icon-youtube-square"></span></a>');
                                }
                                if(social_link[0] === 'instagram'){
                                    $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram"></span></a>');
                                    $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram"></span></a>');
                                }
                                if(social_link[0] === 'linkedin'){
                                    $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="linkedin" class="mx-1"><span class="icon-linkedin-square"></span></a>');
                                    $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="linkedin" class="mx-1"><span class="icon-linkedin-square"></span></a>');
                                }
                            }
                        }else{
                            if(connect){
                                for (let index = 0; index < social.length; index++) {
                                    let social_link = social[index].split("->")
                                    if(social_link[0] === 'facebook'){
                                        $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="facebook" class="mx-1"><span class="icon-facebook-square"></span></a>');
                                        $('.info-temp').append('<a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="facebook" class="mx-2"><span class="icon-facebook-square"></span></a>');
                                    }
                                    if(social_link[0] === 'twitter'){
                                        $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="twitter" class="mx-1"><span class="icon-twitter-square"></span></a>');
                                        $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="twitter" class="mx-1"><span class="icon-twitter-square"></span></a>');
                                    }
                                    if(social_link[0] === 'github'){
                                        $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="github" class="mx-1"><span class="icon-github-square"></span></a>');
                                        $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="github" class="mx-1"><span class="icon-github-square"></span></a>');

                                    }
                                    if(social_link[0] === 'youtube'){
                                        $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="youtube" class="mx-1"><span class="icon-youtube-square"></span></a>');
                                        $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="youtube" class="mx-1"><span class="icon-youtube-square"></span></a>');
                                    }
                                    if(social_link[0] === 'instagram'){
                                        $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram"></span></a>');
                                        $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram"></span></a>');
                                    }
                                    if(social_link[0] === 'linkedin'){
                                        $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="linkedin" class="mx-1"><span class="icon-linkedin-square"></span></a>');
                                        $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="linkedin" class="mx-1"><span class="icon-linkedin-square"></span></a>');
                                    }
                                }
                            }
                        }

                    }


                    var services = obj['services'].split(",");

                    for (let index = 0; index < services.length; index++) {
                        if(index == 0){
                            $('.services-sm').append('<small>'+services[index]+'</small>');
                            $('.services').append('<li class="" style="display: inline-block;">'+services[index]+' </li>');
                        }else{
                            $('.services-sm').append(' | <small>'+services[index]+'</small>');
                            $('.services').append(' | <li class="ml-1" style="display: inline-block;">'+services[index]+'</li>');
                        }

                    }

                }

                if(objReview != null){
                    for (let i = 0; i < objReview.length; i++) {
                        let name = 'anonymous';
                        if(parseInt(objReview[i].anonymous) == 0){
                            name = objReview[i].full_name;
                        }
                        $('.reviews').append('<span>'+name+'</span><span class="my-rating-1 float-right" data-rating="'+objReview[i].rating+'"></span><br/><small class="text-blue bg-white">'+objReview[i].comment+'</small><hr class="m-1">')


                            if(parseInt(objReview[i].reviewer) == data.user_id){
                                $('.btn-rate').html('Rate Again');
                            }


                    }
                    $(".my-rating-1").starRating({
                        strokeColor: '#894A00',
                        strokeWidth: 10,
                        starSize: 15,
                        readOnly: true
                    });

                }

                if(contacts.length){
                    for (let index = 0; index < contacts.length; index++) {
                        if(parseInt(contacts[index].user_id) != {{$_GET['id']}}){
                            $('#contacts').append('<div class="row mt-1 border align-items-center align-self-start bg-white contact-click" data-href="#">'+
                            '<div class="col-5 col-sm-4 p-1 "><img src="/storage/card_images/'+contacts[index].photo+'" width="40%" class="img-fluid rounded-circle float-left ml-2"></div>'+
                            '<div class="col-7 col-sm-8 "><h5 class="text-blue">'+contacts[index].full_name+'</h5><h6>'+contacts[index].position+'</h6></div></div>');
                        }

                    }
                }else{
                    $('#contacts').html('<h6>you have no contact to recommed to</h6>');
                }
            }
        });
    }

    $(document).on('click','.contact-click',function(event){
        alert('recomended');
    });
    $(document).on('click','.cancel',function(event){

        setCard();
    });

</script>

@endsection

