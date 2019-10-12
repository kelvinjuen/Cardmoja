@extends('layouts.app')

@section('content')

<div class="site-section">
    <div class="container">
    <H3 class="text-center">Bussiness Card Design </H3>
        <div class="row my-4 p-3  border">
            <div class="col-md-7 p-1">
                <form id="design_form" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Types</label>
                        <div class="col-sm-7">
                            <select class="custom-select type-select" id="type-select" name="type-select">
                                <option value="1">type 1</option>
                                <option value="2">type 2</option>
                                <option value="3">type 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Card Background</label>
                        <div class="col-sm-7">
                            <select class="custom-select background-select" name="background-select" id="background-select">
                                <option value="bg_1.jpg" selected>Default</option>
                                <option value="bg_2.jpg">sleek</option>
                                <option value="bg_3.jpg">normal</option>
                                <option value="bg_4.jpg">blue</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Primary Colour</label>
                        <div class="col-sm-7">
                            <input type="color" name="colour_1" class="form-control" value="#ffffff"  id="colour_1"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Secondary Colour </label>
                        <div class="col-sm-7">
                            <input type="color" name="colour_2" class="form-control" value="#ff0000"  id="colour_2"/>
                        </div>
                    </div>
                    <div class="form-group row">

                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 offset-md-4 text-center">
                            <label class="label btn btn-primary" data-toggle="tooltip" title="Choose your profile photo">
                                    <h6>Upload Custom BackGround</h6>
                                    <input type="file" class="sr-only" id="input" id="card_phot" name="card_phot" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                        <label class="form-check-label" for="defaultCheck1">
                          Profile photo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">
                          company logo
                    </label>
                      </div>
                    <div class="form-group row">

                        <div class="col-sm-10">
                            <input type="hidden" name="imagetodelete" id="imagetodelete" value=""/>
                            <button type="submit"  class="btn btn-primary col-12">Save Card</button>
                        </div>
                        {{csrf_field()}}
                    </div>
                </form>

            </div>

            <div class="col-md-5 py-3" id="card-wrapper">
                <div class="card" id="card_1" style="height: 14rem;">
                    <img class="card-img" src="storage/background_images/bg_1.jpg" id="card-bg" style="height: 16rem;" alt="Card image">
                    <div class="card-img-overlay" id="cardwrapper">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-fluid float-left d-block img-thumbnail" height="400vh"   width="100vh"  src="/images/uploads/big/stock_people_big-128x128.png" alt="photo">
                            </div>
                            <div class="col-md-8 pl-auto">
                                <ul class="list-unstyled float-right">
                                    <li ><small>&#9742; 071234322</small></li>
                                    <li ><small>test@gmail.com</small></li>
                                    <li ><small>physical location</small></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <h3 class="card-title">Full name</h3>
                                <h6 class="card-subtitle colour_2">title</h6>
                            </div>

                            <div class="col-md-7 text-right">
                                <h3 class="card-title ">Company name</h3>
                                <h6 class="card-subtitle colour_2">slogan</h6>
                            </div>
                        </div>
                        <div class="row border-top my-2">
                            <h6 class="col-md-3 p-1">Services:</h6>
                            <div class="col-md-9">
                                <ul class="float-right ">
                                    <li class="mx-1" style="display: inline-block;"><span class="border-left pl-xl-4"></span><small>service 1</small></li>
                                    <li class="mx-1" style="display: inline-block;"><small>service 2</small></li>
                                    <li class="mx-1" style="display: inline-block;"><small>service 3</small></li>
                                </ul>
                            </div>
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
                var obj = data.card;
                if(obj.bg_image !== null){
                    var bg = obj['bg_image'].split("_");
                    if(obj.type  == 1){
                        $('#cardwrapper').html('@include("pages.design.1"));
                    }else if(obj.type  == 2){
                        $('#cardwrapper').html('@include("pages.design.2"));
                    }else{
                        $('#cardwrapper').html('@include("pages.design.3"));
                    }
                    $('.card-img').attr("src", "/storage/background_images/"+obj.bg_image);
                    $('#type-select').val(obj.type);
                    if(bg[0] === 'bg'){
                        $('#background-select').val(obj.bg_image);
                    }else{
                        $('#imagetodelete').attr("value" , obj.bg_image);
                    }
                }

            }
        });

    });

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
                        alert('success');
                        window.location.href = "/card?id={{auth()->user()->user_id}}";
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

    });

    $(document).on('change','#background-select', function(){
        var selectedBg = $(this).children("option:selected").val();
        $('.card-img').attr("src", "/storage/background_images/"+selectedBg);
        $("#upload").val('');

    });
    $(document).on('change','#colour_1', function(){
        document.getElementsByClassName("card")[0].style.color =$(this).val();
    });
    $(document).on('input','#colour_2', function(){
        let elements = document.getElementsByClassName("card-subtitle");
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.color =$(this).val();
        }

    });

    window.addEventListener('DOMContentLoaded', function () {
        var avatar = document.getElementById('card-bg');
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
                width: 844,
                height: 400,
            });
            initialAvatarURL = avatar.src;
            avatar.src = canvas.toDataURL();
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
