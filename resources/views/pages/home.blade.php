@extends('layouts.app')

@section('content')
@include('inc.navbar')
@include('inc.share',['url' => 'https://cardmoja.com/card?id='.auth()->user()->user_id])
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-start">
            <div class="col-12 col-sm-12 col-md-12 px-lg-5 col-lg-12 px-xl-5 col-xl-7">
                <div class="card-section" >
                    <div class="card-container" id="card-container"  style="background-image: url({{ asset('storage/background_images/blue.jpg') }});">
                        <div class="container p-3" id="cardwrapper" >

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-lg-5 px-xl-5 col-xl-5 text-center">
                <button type="button" class="btn btn-primary btn-block my-2" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="icon-share2"></i>SHARE MY CARD
                </button>
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
    function setCard(){
        $('[data-toggle="tooltip"]').tooltip();
        $.ajax({
            url:"{{route('card.show',auth()->user()->user_id)}}",
            method:'GET',
            contentType:false,
            processData:false,
            success:function(data)
            {
                let obj = data.card;
                let objReview = data.review;
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
                    $('.name').html(obj.designation+' '+obj.full_name);
                    $('.position').html(obj.position);

                    if(obj.phone_no != null){
                        $('.info').append(' <li ><span class ="icon-phone"> </span>'+obj.phone_no+'</li>');
                        $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-phone"> </span>'+obj.phone_no+'</small></li>');
                    }
                    if(obj.email != null){
                        let email = obj['email'].split("/");
                        for (let index = 0; index < email.length; index++) {
                            $('.info').append(' <li ><span class ="icon-mail_outline"> </span>'+email[index]+'</li>');
                            $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-mail_outline"> </span>'+email[index]+'</small></li>');
                        }
                    }
                    if(obj.physical_address != null){
                        $('.info').append(' <li ><span class ="icon-location_city"> </span>'+obj.physical_address+'</li>');
                        $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-location_city"> </span>'+obj.physical_address+'</small></li>');
                    }
                    if(obj.post_address != null){
                        $('.info').append(' <li ><span class ="icon-markunread_mailbox"> </span>'+obj.post_address+'</li>');
                        $('.info-inline').append(' <li class="mr-1" style="display: inline-block;"><small><span class ="icon-markunread_mailbox"> </span>'+obj.post_address+'</small></li>');
                    }
                    if(obj['social_media'] != null){
                        let social = obj['social_media'].split(",");
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


                    var services = obj['services'].split(",");

                    for (let index = 0; index < services.length; index++) {
                        if(index == 0){
                            $('.services-sm').append('<small>'+services[index]+'</small>');
                            $('.services').append('<li class="" style="display: inline-block;">'+services[index]+' </li>');
                        }else{
                            $('.services-sm').append('| <small>'+services[index]+'</small>');
                            $('.services').append(' | <li class="ml-1" style="display: inline-block;">'+services[index]+'</li>');
                        }

                    }

                    if( {{auth()->user()->user_id}} == obj.user_id ){
                        $('#review-div').html('@include("pages.template.ratingdefault"));
                        $('.rate').hide();
                    }else{
                        $('#review-div').html('@include("pages.template.ratingdefault"));
                    }
                }

                if(objReview != null){
                    for (let i = 0; i < objReview.length; i++) {
                        let name = 'anonymous';
                        if(objReview[i].anonymous == 0){
                            name = objReview[i].full_name;
                        }
                        $('.reviews').append('<span>'+name+'</span><span class="my-rating-1 float-right" data-rating="'+objReview[i].rating+'"></span><br/><small class="text-blue bg-white">'+objReview[i].comment+'</small><hr class="m-1">')

                        if(objReview[i].reviewer == {{auth()->user()->user_id}}){
                            $('.btn-rate').html('you have already Rated');
                        }

                    }
                    $(".my-rating-1").starRating({
                        strokeColor: '#894A00',
                        strokeWidth: 10,
                        starSize: 15,
                        readOnly: true
                    });

                }
            }
        });
    }
    let popupsize = {
        width: 780,
        height: 550
    }
    $(document).on('click', '.modal-body > a', function(e){
        let verticalPos = Math.floor(($(window).width() - popupsize.width)/2),
            horizontalPos = Math.floor(($(window).height() - popupsize.height)/2);

        let popup = window.open($(this).prop('href'), 'social',
            'width='+popupsize.width+',height='+popupsize.height+
            ',left='+verticalPos+',top'+horizontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if(popup) {
            popup.focus();
            e.preventDefault();
        }
    });
</script>

@endsection

