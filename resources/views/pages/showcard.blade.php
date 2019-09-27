@extends('layouts.app')

@section('content')
@include('inc.navbar')
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="card" id="card_1"  >
                <img class="card-img" src="/storage/background_images/bg_1.jpg" id="card-bg"  alt="Card image">
                <div class="card-img-overlay" id="cardwrapper">
                </div>
            </div>
            <div class="row col-10  mx-auto   extra"></div>
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $.ajax({
            url:"{{route('card.show',$_GET['id'])}}",
            method:'GET',
            async: false,
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

                    var services = obj['services'].split(",");

                    for (let index = 0; index < services.length; index++) {
                        $('.services').append('<li class="mx-1" style="display: inline-block;"><strong>'+services[index]+'</strong></li>');

                    }

                    if( {{auth()->user()->user_id}} == obj.user_id ){
                        $('.extra').html('<div class="col-6 col-sm-6 col-md-6"><a href="/card/{{auth()->user()->user_id}}/edit" class="btn btn-success w-100 ">Edit details</a></div>'+
                        '<div class="col-6 col-sm-6 col-md-6"><a href="/design" class="btn btn-success w-100">Edit Design</a></div>');
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
                async: false,
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

