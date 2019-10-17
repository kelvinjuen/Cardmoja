@extends('layouts.app')

@section('content')
@guest
@else
 @include('inc.navbar')
@endguest
@include('inc.share',['url' => 'https://cardmoja.com/card?id='.$_GET['id']])
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-start">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
                <div class="card" id="card">
                    <img class="card-img img-responsive"  id="card-img"  alt="Card image">
                    <div class="card-img-overlay" id="cardwrapper">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-3 text-center">
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
                if(obj.type == 1){
                    $('#cardwrapper').html('@include("pages.template.1"));
                }else if(obj.type == 2){
                    $('#cardwrapper').html('@include("pages.template.2"));
                }else if(obj.type == 3){
                    $('#cardwrapper').html('@include("pages.template.3"));
                }

                if(obj != null){
                    document.getElementById("card").style.color =obj.colour_1;
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
                                $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="facebook" class="mx-2"><span class="icon-facebook-square"></span></a>');
                            }
                            if(social_link[0] === 'twitter'){
                                $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="twitter" class="mx-2"><span class="icon-twitter-square"></span></a>');
                            }
                            if(social_link[0] === 'github'){
                                $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="github" class="mx-2"><span class="icon-github-square"></span></a>');
                            }
                        }
                    }


                    var services = obj['services'].split(",");

                    for (let index = 0; index < services.length; index++) {
                        if(index == 0){
                            $('.services-sm').append('<small>'+services[index]+'</small>');
                            $('.services').append('<li class="" style="display: inline-block;">'+services[index]+' </li>');
                        }else{
                            $('.services-sm').append(', <small>'+services[index]+'</small>');
                            $('.services').append('<li class="ml-1" style="display: inline-block;">'+services[index]+'</li>');
                        }

                    }

                        if(data.user_id != {{$_GET['id']}} && data.user_id != 0){
                            $('#review-div').html('@include("pages.template.ratingdefault"));
                            $('#recomend-div').html('<button type="button" class="btn btn-primary btn-block my-2 btn-sm" data-toggle="modal" data-target="#exampleModalCenter">SHARE THIS CARD</button>');
                        }else{
                            $('#review-div').html('@include("pages.template.ratingdefault"));
                            $('.rate').hide();
                            if(data.user_id != 0){
                                $('.wallet-link').html('<a href="#" class="btn btn-primary btn-block my-2 add-wallet">ADD TO CARD WALLET</a>');
                            }
                        }



                }

                if(objReview != null){
                    for (let i = 0; i < objReview.length; i++) {
                        let name = 'anonymous';
                        if(objReview[i].anonymous == 0){
                            name = objReview[i].full_name;
                        }
                        $('.reviews').append('<span>'+name+'</span><span class="my-rating-1 float-right" data-rating="'+objReview[i].rating+'"></span><br/><small class="text-blue bg-white">'+objReview[i].comment+'</small><hr class="m-1">')


                            if(objReview[i].reviewer == data.user_id){
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

</script>

@endsection

