@extends('layouts.app')

@section('content')
@include('inc.navbar')
<div class="site-blocks-cover " data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container-fluid">
        <div class="row p-1">
                <div class=" col-md-4 col-lg-4 col-xl-3 d-none d-md-block text-center pt-2">
                    <div class=" pt-1 request-wrap">
                        <h5 class="muted">connection request</h5>
                        <div class=" request"></div>
                    </div>
                    <div class=" pt-1 mt-1 suggestion-wrap mb-4">
                        <h5 class="muted">connection you may know</h5>
                        <div class="mt-1 suggestion p-3"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-6 text-center">
                    <div class="row justify-content-end p-1">
                        <div class="col-12 col-md-6">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="search Contact" aria-label="search contact" aria-describedby="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="search">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-2 " id="contacts">

                    </div>
                </div>
                <div class="col-xl-3  d-none d-xl-block text-center pt-2">
                    <h5 class="muted">Reviews</h5>
                    <hr >
                    <div class="mt-2 bg-white px-1" id="reviews">

                    </div>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript">

    $(document).ready(function(){
        $.ajax({
            url:"{{route('card.show',Auth::user()->user_id)}}",
            method:'GET',
            async: true,
            contentType:false,
            processData:false,
            success:function(data)
            {
                let objReview = data.review;
                if(objReview != null){
                    for (let i = 0; i < objReview.length; i++) {
                        let name = 'anonymous';
                        if(objReview[i].anonymous == 0){
                            name = objReview[i].full_name;
                        }
                        $('#reviews').append('<span class="text-blue float-left">'+name+'</span><span class="my-rating float-right" data-rating="'+objReview[i].rating+'"></span><br/><small>'+objReview[i].comment+'</small><hr class="m-1">')
                    }

                }

            }
        });

        getInfo();

    });

    $(document).on('click','.contact-click',function(event){
        window.location = $(this).data("href");
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
                    getInfo();
                }
            });
    });

    $(document).on('submit', '#accept-form', function(event){
            event.preventDefault();
            var success = false;
            $('.suggestion').empty();
            $('.request').empty();
            $('#contacts').empty();

            $.ajax({
                url:"{{route('connect.update',auth()->user()->user_id)}}",
                method:'POST',
                async: true,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    getInfo();
                }
            });
    });

    function getInfo(){
        $.ajax({
            url:"getConnectinfo",
            method:'GET',
            contentType:false,
            processData:false,
            success:function(data)
            {
                let contacts = data.contacts;
                let suggestion = data.suggestion;
                let request = data.request;

                if(request.length){
                    for (let index = 0; index < request.length; index++) {
                        $('.request').append('<div class="row mt-1 border align-items-center bg-white"><div class="col-md-3"><img src="/storage/card_images/'+request[index].photo+'" width="80%" class="img-fluid rounded-circle"></div>'+
                        '<div class="col-md-6"><div class="text-suggestion">'+request[index].full_name+'</div><div class="">'+request[index].position+'</div>'+
                        '</div><div class="col-md-3"><form id="accept-form"><input type="hidden" name="connect_id" value="'+request[index].connect_id+'">'+
                        '<input type="hidden" name="_method" id="_method" value="PUT">{{csrf_field() }}<button type="submit" class="btn btn-primary btn-sm">accept</button></form></div></div>');
                    }
                }else{
                    $('.request-wrap').empty();
                }

                if(suggestion.length){
                    for (let index = 0; index < suggestion.length; index++) {
                        $('.suggestion').append('<div class="row mt-1 border align-items-center bg-white contact-click" data-href="/card?id='+suggestion[index].user_id+'"><div class="col-md-3"><img src="/storage/card_images/'+suggestion[index].photo+'" width="70%" class="img-fluid rounded-circle"></div>'+
                        '<div class="col-md-7"><div class="text-suggestion">'+suggestion[index].full_name+'</div><div class="">'+suggestion[index].position+'</div>'+
                        '</div><div class="col-md-2"><form id="add-contact"><input type="hidden" name="user_1" value="{{auth()->user()->user_id}}"> '+
                        '<input type="hidden" name="user_2" value="'+suggestion[index].user_id+'">{{csrf_field() }}<button type="submit" class="btn btn-outline-secondary btn-sm">+</button></form></div></div>');
                    }
                }else{
                    $('.suggestion-wrap').empty();
                }

                if(contacts.length){
                    for (let index = 0; index < contacts.length; index++) {
                        $('#contacts').append('<div class="row mt-1 border align-items-center align-self-start bg-white contact-click" data-href="/card?id='+contacts[index].user_id+'">'+
                        '<div class="col-3 col-sm-3 col-md-3 p-1 "><img src="/storage/card_images/'+contacts[index].photo+'" width="40%" class="img-fluid rounded-circle float-left ml-2"></div>'+
                        '<div class="col-9 col-sm-5 col-md-5"><h5 class="text-blue">'+contacts[index].full_name+'</h5><h6>'+contacts[index].position+'</h6></div><div class="col-sm-4 col-md-4"><span class="my-rating" data-rating="'+contacts[index].rating+'"></span><h6 class="text-muted">based on '+contacts[index].total+' reviews</h6></div></div>');
                    }
                }else{
                    $('#contacts').html('<div class="row"><h4 class="col-md-12">you have no contacts at the moment</h4></div>');
                }
                $(".my-rating").starRating({
                        strokeColor: '#894A00',
                        strokeWidth: 10,
                        starSize: 15,
                        readOnly: true
                    });


            }
        });
    }


</script>

@endsection
