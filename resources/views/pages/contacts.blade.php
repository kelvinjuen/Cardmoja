@extends('layouts.app')

@section('content')
@include('inc.navbar')
<div class="site-blocks-cover " data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container-fluid">
        <div class="row justify-content-center my-2">
            <div class="col-12 col-md-4">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="search Card" aria-label="search contact" aria-describedby="search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="search"><i class="icon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row ">
                <div class="col-12 col-sm-12 col-md-4  col-xl-3  text-center">
                    <div class="bg-primary col-12 text-left p-2"><strong>New Cards </strong> <span class="badge badge-light float-right">0</span></div>
                    <div class=" pt-1 request-wrap">
                        <div class=" request"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-6 text-center">
                    <div class="mt-2 " id="contacts">

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

                if(contacts.length){
                    for (let index = 0; index < contacts.length; index++) {
                        $('#contacts').append('<div class="row mt-1 border align-items-center align-self-start bg-white contact-click" data-href="/card?id='+contacts[index].user_id+'">'+
                        '<div class="col-5 col-sm-3 col-md-3 p-1 "><img src="/storage/card_images/'+contacts[index].photo+'" width="40%" class="img-fluid rounded-circle float-left ml-2"></div>'+
                        '<div class="col-7 col-sm-5 col-md-5"><h5 class="text-blue">'+contacts[index].full_name+'</h5><h6>'+contacts[index].position+'</h6></div><div class="col-sm-4 col-md-4"><span class="my-rating" data-rating="'+contacts[index].rating+'"></span><span class="text-muted"> '+contacts[index].total+' reviews</span></div></div>');
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
