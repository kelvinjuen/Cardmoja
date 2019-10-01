@extends('layouts.app')

@section('content')
<div class="site-blocks-cover"  data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10 ">
                <h3 class="text-secondary text-center">Card Details</h3>
                <form id="card_form" method="POST" enctype="multipart/form-data">

                    <h6 class="text-secondary mb-4 border-bottom mb-4">Personal Profile</h6>
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group rounded">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Desigination:</span>
                                        </div>
                                        <select class="select-group" id="designation" name="designation">
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Dr">Dr</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group rounded">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Names:</span>
                                        </div>
                                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="FirstName" required>
                                        <input type="text" class="form-control" name="secondName" id="secondName" placeholder="SecondName" required>
                                        <input type="text" class="form-control" name ="thirdName" id="thirdName" placeholder="ThirdName" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <label class="label" data-toggle="tooltip" title="Choose your profile photo">
                                    <img class="rounded"  src="/storage/card_images/male-avator.png" id="profile_photo" alt="Choose Profile Photo" style="height: 14rem;">
                                    <input type="file" class="sr-only" id="input" id="card_phot" name="card_phot" accept="image/*">
                            </label>
                        </div>

                    </div>

                    <h6 class="text-secondary mb-4 border-bottom mb-4">Create a new password</h6>
                    <div class="form-group row">
                        <div class="input-group rounded col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">New password</span>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                        <div class="input-group rounded col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Confirm Password</span>
                            </div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <span class="feedback text-danger">
                        <strong></strong>
                    </span>

                    <button type="submit" id="submit_card" class="btn btn-primary btn-sm col-12">Create Card</button>
                    {{csrf_field() }}
                </form>
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
<script type="text/javascript" language="javascript">
    let photo;

    $(document).on('submit', '#card_form', function(event){
        event.preventDefault();

        formData = new FormData(this);
        if(photo != null){
            formData.append('card_photo', photo, 'avatar.jpg');
        }

        $.ajax({
            url:"/updatecoperateuser",
            method:'POST',
            async: false,
            data:formData,
            contentType:false,
            processData:false,
            success:function(data)
            {
                var obj = data.errors;
                if(obj != null){
                    $('.feedback').html(obj.password);
                }else{
                    window.location.href = "/home";
                }
            }
        });
    });

    $(document).ready(function(){


    });

    window.addEventListener('DOMContentLoaded', function () {
        var avatar = document.getElementById('profile_photo');
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
                aspectRatio: 1/1,
                autoCropArea: 0.95,
                restore: false,
                guides: false,
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

            if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 665,
                height: 665,
            });
            initialAvatarURL = avatar.src;
            avatar.src = canvas.toDataURL();
            canvas.toBlob(function (blob) {
                photo = blob;
            });
            }
        });
    });


</script>

@endsection
