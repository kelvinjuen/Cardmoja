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
                            <div class="bg-primary col-12 text-left p-1"><strong>New Cards </strong> <span class="badge badge-light float-right request-total">0</span></div>
                            <div class="request "></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-6 text-center">
                            <div class="mt-2" id="contacts">

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

    $(document).on('click', '#status', function(event){
        $('#status_val').attr('value' , $(this).val());
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


                if(contacts.length){
                    let pedding =0;
                    for (let index = 0; index < contacts.length; index++) {
                        if(parseInt(contacts[index].status) == 1){
                            $('#contacts').append('<div class="row mt-1 border-left-info align-items-center align-self-start bg-white contact-click" data-href="/card?id='+contacts[index].user_id+'">'+
                            '<div class="col-3 col-sm-2 col-md-2 p-1 "><img src="/storage/card_images/'+contacts[index].photo+'" width="65%" class="img-fluid rounded-circle float-left ml-2"></div>'+
                            '<div class="col-6 col-sm-7 col-md-5"><h5 class="text-blue">'+contacts[index].full_name+'</h5><h6>'+contacts[index].position+'</h6></div>'+
                            '<div class="col-3 col-sm-3 col-md-4"><span class="my-rating" data-rating="'+contacts[index].rating+'"></span><p class="text-muted"> '+contacts[index].total+' reviews</p></div></div>');
                        }else if(parseInt(contacts[index].status) == 0){
                            pedding++;

                            if(parseInt(contacts[index].action_user) !=  {{auth()->user()->user_id}}){
                                $('.request').append('<div class="row mt-1 border-left-success align-items-center align-self-start bg-white"><div class="col-8 contact-click" data-href="/card?id='+contacts[index].user_id+'">'+
                                '<div class="row"><div class="p-1 col-4 col-sm-3 col-md-3"><img src="/storage/card_images/'+contacts[index].photo+'" width="70%" class="img-fluid rounded-circle float-left"></div>'+
                                '<div class="col-8 col-sm-9 col-md-9"><h6 class="text-blue">'+contacts[index].full_name+'</h6><h6>'+contacts[index].position+'</h6></div></div></div>'+
                                '<div class="col-4"><form id="accept-form"><div class="input-group"><input type="hidden" name="connect_id" value="'+contacts[index].connect_id+'"><input type="hidden" id="status_val" name="status" value="">'+
                                '<input type="hidden" name="_method" id="_method" value="PUT"><div class="input-group-append" id="button-addon4"><button id="status" type="submit" value="1" class="btn btn-success btn-sm"><i class="icon-check"></i></button>'+
                                '<button id="status" type="submit"  value="2" class="btn btn-danger btn-sm"><i class="icon-remove"></i></button>{{csrf_field() }}</div></div></form></div></div>');
                            }else{
                                $('.request').append('<div class="row mt-1 border-left-warning align-items-center align-self-start bg-white"><div class="col-8 col-xl-9 contact-click" data-href="/card?id='+contacts[index].user_id+'">'+
                                '<div class="row"><div class="p-1 col-4 col-sm-3 col-md-3"><img src="/storage/card_images/'+contacts[index].photo+'" width="70%" class="img-fluid rounded-circle float-left"></div>'+
                                '<div class="col-8 col-sm-9 col-md-9"><h6 class="text-blue">'+contacts[index].full_name+'</h6><h6>'+contacts[index].position+'</h6></div></div></div>'+
                                '<div class="col-4 col-xl-3"><i class="icon-hourglass-start"></i></div></div>');
                            }
                        }
                        $('.request-total').html(pedding);

                    }
                }
                $(".my-rating").starRating({
                        strokeColor: '#894A00',
                        strokeWidth: 10,
                        starSize: 11,
                        readOnly: true
                    });


            }
        });
    }


</script>

@endsection
