@extends('layouts.app')

@section('content')

<div class="site-section">
    <div class="container-fluid">
    <H3 class="text-center">Bussiness Card Design </H3>
        <div class="row m-xl-2 py-2  border">
            <div class="col-xl-5 p-1">
                <form id="design_form" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Card Layout</label>
                        <div class="col-sm-8">
                            <select class="custom-select type-select" id="type-select" name="type-select">
                                <option value="1">Layout 1</option>
                                <option value="2">Layout 2</option>
                                <option value="3">Layout 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">BackGround Theme</label>
                        <div class="col-sm-8">
                            <select class="custom-select option-select" name="option-select" id="option-select">
                                <option value="default" selected>Default Themes</option>
                                <option value="custom">Custom Themes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-md-4" id="default-wrap">
                            <select class="custom-select background-select" name="background-select" id="background-select">
                                <option value="blue.jpg" selected>Blue</option>
                                <option value="red.jpg">Red</option>
                                <option value="green.jpg">Green</option>
                                <option value="purple.jpg">Purple</option>
                            </select>
                        </div>
                        <div class="col-sm-8 offset-md-4" id="custom-wrap">
                            <label class="label btn btn-outline-info btn-sm col-12" data-toggle="tooltip" title="Upload customized Theme">
                                <h6>Upload Custom BackGround theme</h6>
                                <input type="file" class="sr-only" id="input" id="card_phot" name="card_phot" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Text Colour 1</label>
                        <div class="col-sm-8">
                            <input type="color" name="colour_1" class="form-control" value="#ffffff"  id="colour_1"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Text colour 2</label>
                        <div class="col-sm-8">
                            <input type="color" name="colour_2" class="form-control" value="#ff0000"  id="colour_2"/>
                        </div>
                    </div>


                    <div class="form-group row">

                        <div class="col-sm-8 offset-md-4">
                            <input type="hidden" name="imagetodelete" id="imagetodelete" value=""/>
                            <button type="submit"  class="btn btn-outline-success btn-block">Save</button>
                        </div>
                        {{csrf_field()}}
                    </div>
                </form>

            </div>

            <div class="col-xl-7">
                <div class="card-section" >
                    <div class="card-container" id="card-container" style="background-image: url({{ asset('storage/background_images/blue.jpg') }});">
                        <div class="container p-3" id="cardwrapper" >

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Crop the image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="img-container">
                <img id="image" src="" max-height="200px" max-width="200px">
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    var formData;
    let file;
    let obj;
    let colour2;
    $(document).ready(function(){
        document.getElementById("background-select").selectedIndex = -1;
        $.ajax({
            url:"{{route('card.show',auth()->user()->user_id)}}",
            method:'GET',
            async: false,
            contentType:false,
            processData:false,
            success:function(data)
            {
                obj = data.card;
                if(obj.bg_image !== null){
                    var bg = obj['bg_image'].split("_");

                    if(obj.type  == 1){
                        $('#cardwrapper').html('@include("pages.design.1"));
                    }else if(obj.type  == 2){
                        $('#cardwrapper').html('@include("pages.design.2"));
                    }else{
                        $('#cardwrapper').html('@include("pages.design.3"));
                    }
                    document.getElementById("card-container").style.backgroundImage ="url('/storage/background_images/"+obj.bg_image+"')";
                    document.getElementById("cardwrapper").style.color =obj.colour_1;
                    $('#colour_1').attr('value', obj.colour_1 );
                    let elements = document.getElementsByClassName("colour_2");
                    for (let i = 0; i < elements.length; i++) {
                        elements[i].style.color = obj.colour_2;
                    }
                    $('#colour_2').attr('value', obj.colour_2 );
                    $('#type-select').val(obj.type);
                    if(bg[0] != 'custom'){
                        $('#background-select').val(obj.bg_image);
                        $('#custom-wrap').hide();
                    }else{
                        $('#imagetodelete').attr("value" , obj.bg_image);
                        $('#default-wrap').hide();
                        $('#option-select').val('custom');
                    }
                }
                if(obj != null){
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
                                $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram icn-instagram"></span></a>');
                                $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram icn-instagram"></span></a>');
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
                            $('.services-sm').append(' | <small>'+services[index]+'</small>');
                            $('.services').append(' | <li class="ml-1" style="display: inline-block;">'+services[index]+'</li>');
                        }

                    }
                }

            }
        });
    });

    function getdata(){

        let elements = document.getElementsByClassName("colour_2");
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.color = colour2;
        }

        if(obj != null){
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
                                $('.info').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram icn-instagram"></span></a>');
                                $('.info-temp').append(' <a href="'+social_link[1]+'" target="_blank" data-toggle="tooltip" data-placement="top" title="instagram" class="mx-1"><span class="icon-instagram icn-instagram"></span></a>');
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
                    $('.services-sm').append(' | <small>'+services[index]+'</small>');
                    $('.services').append(' | <li class="ml-1" style="display: inline-block;">'+services[index]+'</li>');
                }

            }
        }
    }

    $(document).on('submit', '#design_form', function(event){
            event.preventDefault();

            formData = new FormData(this);
            if(file != null){
                formData.append('upload', file, 'background.jpg');
            }

            $.ajax({
                url:"/savedesign",
                method:'POST',
                async: false,
                data:formData,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.success;
                    let type = '{{auth()->user()->type}}' ;

                    if(type == 'personal'){
                        window.location.href = "/";
                    }else{
                        window.location.href = "/coperate";
                    }

                }
            });


    });

    $(document).on('change','#type-select', function(){
        var selectedType = $(this).children("option:selected").val();
        if(selectedType  == 1){
            $('#cardwrapper').html('@include("pages.design.1"));
        }else if(selectedType  == 2){
            $('#cardwrapper').html('@include("pages.design.2"));
        }else{
            $('#cardwrapper').html('@include("pages.design.3"));
        }
        getdata();
    });

    $(document).on('change','#option-select', function(){
        var selectedBg = $(this).children("option:selected").val();
        $('#custom-wrap').hide();
        $('#default-wrap').hide();
        if(selectedBg == 'default'){
            $('#default-wrap').show();
        }else{
            $('#custom-wrap').show();
        }
    });

    $(document).on('change','#background-select', function(){
        var selectedBg = $(this).children("option:selected").val();
        document.getElementById("card-container").style.backgroundImage ="url('/storage/background_images/"+selectedBg+"')";
        $("#upload").val('');

    });
    $(document).on('change','#colour_1', function(){
        document.getElementById("cardwrapper").style.color =$(this).val();
    });
    $(document).on('input','#colour_2', function(){
        let elements = document.getElementsByClassName("colour_2");
        colour2 = $(this).val();
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.color =$(this).val();
        }

    });

    window.addEventListener('DOMContentLoaded', function () {
        var avatar = document.getElementById('card-container');
        var image = document.getElementById('image');
        var input = document.getElementById('input');
        var $modal = $('#modal');
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        input.addEventListener('change', function (e) {
            var files = e.target.files;
            var done = function (url) {
            input.value = '';
            image.src = url;
            $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                done(reader.result);
                };
                reader.readAsDataURL(file);
            }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                dragMode: 'move',
                aspectRatio: 19 / 9,
                autoCropArea: 0.9,
                restore: false,
                guides: true,
                center: false,
                highlight: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                toggleDragModeOnDblclick: false,
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        document.getElementById('crop').addEventListener('click', function () {
            var initialAvatarURL;
            var canvas;

            $modal.modal('hide');
            document.getElementById("background-select").selectedIndex = -1;

            if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 400,
            });
            initialAvatarURL = avatar.style.backgroundImage;
            avatar.style.backgroundImage = "url('"+canvas.toDataURL()+"')";;
            canvas.toBlob((blob) => {
                        file = new File([blob],'background.jpg', {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });
                }, 'image/jpeg', 0.6);
            }
        });
    });
</script>
@endsection
