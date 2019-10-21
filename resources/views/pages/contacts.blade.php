@extends('layouts.app')

@section('content')
@include('inc.navbar')
<div class="site-blocks-cover" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5  col-xl-3  text-center">
                            <div class="bg-primary col-12 text-left p-2"><strong>New Cards </strong> <span class="badge badge-light float-right request-total">0</span></div>
                            <div class=" pt-1 request-wrap  p-2">
                                <div class=" request"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-6 text-center">
                            <div class="mt-2 " id="contacts">

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript">

    $(document).ready(function(){
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
                $('.request-total').html(request.length);
                if(request.length){
                    for (let index = 0; index < request.length; index++) {
                        $('.request').append('<div class="row mt-1 border align-items-center align-self-start bg-white"><div class="col-10 col-sm-9 col-md-9 contact-click" data-href="/card?id='+request[index].user_id+'">'+
                        '<div class="p-1 "><img src="/storage/card_images/'+request[index].photo+'" width="30%" class="img-fluid rounded-circle float-left"></div>'+
                        '<div class=""><h5 class="text-blue">'+request[index].full_name+'</h5><h6>'+request[index].position+'</h6></div></div>'+
                        '<div class="col-2 col-md-3 col-md-2"><form id="accept-form"><input type="hidden" name="connect_id" value="'+request[index].connect_id+'">'+
                        '<input type="hidden" name="_method" id="_method" value="PUT">{{csrf_field() }}<button type="submit" class="btn btn-success btn-sm"><i class="icon-check"></i></button>'+
                        '<button type="submit" class="btn btn-danger btn-sm"><i class="icon-close"></i></button></form></div></div>');
                    }
                }else{
                    $('.request-wrap').empty();
                }

                if(contacts.length){
                    for (let index = 0; index < contacts.length; index++) {
                        $('#contacts').append('<div class="row mt-1 border align-items-center align-self-start bg-white contact-click" data-href="/card?id='+contacts[index].user_id+'">'+
                        '<div class="col-5 col-sm-3 col-md-3 p-1 "><img src="/storage/card_images/'+contacts[index].photo+'" width="40%" class="img-fluid rounded-circle float-left ml-2"></div>'+
                        '<div class="col-7 col-sm-5 col-md-5"><h5 class="text-blue">'+contacts[index].full_name+'</h5><h6>'+contacts[index].position+'</h6></div>'+
                        '<div class="col-sm-4 col-md-4"><span class="my-rating" data-rating="'+contacts[index].rating+'"></span><span class="text-muted"> '+contacts[index].total+' reviews</span></div></div>');
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
