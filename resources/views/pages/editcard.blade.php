@extends('layouts.app')

@section('content')
<div class="site-section">
        <div class="container">
            <div class="card-wrap ">
                <h3 class="text-secondary mb-4 text-center">Card Details</h3>
                <form id="editcard_form" method="POST" enctype="multipart/form-data">

                    <h6 class="text-secondary mb-4 border-bottom mb-4">Personal Profile</h6>

                    <div class="row">
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
                            <div class="form-group row">
                                <div class="col-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Position:</span>
                                        </div>
                                        <input type="text" class="form-control" id="position" name="position" placeholder="web designer / CEO" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <label class="label" data-toggle="tooltip" title="Choose your profile photo">
                                    <img class="rounded"  src="" id="profile_photo" alt="Choose Profile Photo" style="height: 14rem;">
                                    <input type="file" class="sr-only" id="input" id="card_phot" name="card_phot" accept="image/*">
                            </label>
                        </div>

                    </div>


                    <h6 class="text-secondary mb-4 border-bottom mb-4">Company/Business Profile</h6>

                    <div class="form-group row">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Company Name:</span>
                                </div>
                                <input type="text" class="form-control" id="company" name="company" placeholder="company/business name" required>
                            </div>

                        </div>
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Company Website</span>
                                </div>
                                <input type="text" class="form-control" id="website" name="website" placeholder="website">
                            </div>
                        </div>
                    </div>

                    <!--Telephone Contacts -->
                    <div class="form-group row">
                        <label for="imputcontact" class="col-sm-2 col-form-label">Business Contacts :</label>
                        <div class="col-md-6" id="text_div_contact">
                            <div class="input-group input_text_contact" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Primary contact</span>
                                </div>
                                <input type="text" class="form-control service" placeholder="contact" id="contact_1" name="contact_1" aria-label="contact" aria-describedby="button-addon4" required>
                                <input type="button" class="btn btn-success add-contact" value="add contact" >
                            </div>
                        </div>
                    </div>

                    <!--Email contacts -->

                    <div class="form-group row">
                        <label for="imputcontact" class="col-md-2 col-form-label">Business Emails :</label>
                        <div class="col-md-6" id="text_div_email">
                            <div class="input-group input_text_email" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Primary Email</span>
                                </div>
                                <input type="text" class="form-control service" placeholder="email" id="email_1" name="email_1" aria-label="contact" aria-describedby="button-addon4" required>
                                <input type="button" class="btn btn-success add-email" value="add Email" >
                            </div>
                        </div>
                    </div>

                    <h6 class="text-secondary mb-4 border-bottom my-4">Company Address</h6>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Physical Address</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="physical_address" name="physical_address" placeholder="1234 Main St">
                            </div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Postal Address</span>
                                </div>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="postal code">
                                <input type="text"  class="form-control" id="postal_address" name="postal_address" placeholder="postal address">
                                <input type="text"  class="form-control" id="city" name="city" placeholder="City/Town">
                            </div>
                        </div>
                    </div>

                    <h6 class="text-secondary mb-4 border-bottom my-4">Social Media Links</h6>

                    <div class="form-group row">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Facebook</span>
                                </div>
                                <input type="text" class="form-control" id="facebook_link" name="facebook_link" placeholder="Facebook">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Twitter</span>
                                </div>
                                <input type="text" class="form-control" id="twitter_link" name="twitter_link" placeholder="Twitter">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Linkedin</span>
                                </div>
                                <input type="text" class="form-control" id="linkedin_link" name="linkedin_link" placeholder="Linkedin">
                            </div>
                        </div>
                    </div>

                    <h6 class="text-secondary mb-4 border-bottom my-4">Company Services/Products<h6>

                    <div class="form-group row">
                        <label for="imputcontact" class="col-sm-2 col-form-label">Business Nature :</label>
                        <div class="col-md-6" id="services_div">
                            <select class="form-control" id="biz_type" name="biz_type">
                                    <option value="services">Services</option>
                                    <option value="product">Products</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="imputcontact" class="col-sm-2 col-form-label">Business Services/Products :</label>
                        <div class="col-md-6" id="text_div_service">
                            <div class="input-group input_text1" >
                                <input type="text" class="form-control service" placeholder="service/product" id="service_1" name="service_1" aria-label="service" aria-describedby="button-addon4">
                                <input type="button" class="btn btn-success add-service" value="add service" >
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="_method" id="_method" value="PUT">
                    <button type="submit" id="submit_card" class="btn btn-primary btn-sm col-12">Save Changes</button>
                    {{csrf_field() }}
                </form>
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

    $(document).on('submit', '#editcard_form', function(event){
            event.preventDefault();
            formData = new FormData(this);
            if(photo != null){
                formData.append('upload', photo, 'avatar.jpg');
            }
            $.ajax({
                url:"{{route('card.update',Auth::user()->user_id)}}",
                method:'POST',
                async: false,
                data:formData,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.errors;
                    $('.photo').html('');
                    if(obj != null){

                    }else{
                        alert ("successfully editted");
                        window.location.href = "/card?id={{auth()->user()->user_id}}";
                    }
                }
            });
    });

    $(document).ready(function(){

        var x = 1;
        let y = 1;
        let z = 1;

        $.ajax({
            url:"{{route('card.show',Auth::user()->user_id)}}",
            method:'GET',
            async: false,
            contentType:false,
            processData:false,
            success:function(data)
            {
                let obj = data.card;

                if(obj != null){
                    var name = obj['full_name'].split(" ");
                    $('#firstName').attr('value',name[0]);
                    $('#secondName').attr('value',name[1]);
                    $('#thirdName').attr('value',name[2]);
                    $('#position').attr('value',obj.position);
                    $('#company').attr('value',obj.company);
                    $('#website').attr('value',obj.website);
                    $('#profile_photo').attr('src','/storage/card_images/'+obj.photo);

                    var phone = obj['phone_no'].split(",");
                    for (let index = 0; index < phone.length; index++) {
                        if(index == 0){
                            $('#contact_1').attr('value',phone[index]);
                        }else{
                            x++;
                            $('#text_div_contact').append('<div class="input-group input_text_contact'+x+'  mt-1" ><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">alternative contact</span>'+
                            '</div><input type="text" class="form-control contact" placeholder="contact" id="contact_'+x+'" name="contact_'+x+'" value="'+phone[index]+'" aria-label="contact" aria-describedby="button-addon4" required>'+
                            '<input type="button" class="btn btn-danger contact-remove" value="remove" ></div>'
                            );
                        }
                    }

                    var email = obj['email'].split(",");
                    for (let index = 0; index < email.length; index++) {
                        if(index == 0){
                            $('#email_1').attr('value',email[index]);
                        }else{
                            y++;
                            $('#text_div_email').append('<div class="input-group input_text_email'+y+'  mt-1" ><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">alternative Email</span>'+
                            '</div><input type="text" class="form-control email" placeholder="email" id="email_'+y+'" name="email_'+y+'" value="'+email[index]+'" aria-label="email" aria-describedby="button-addon4" required>'+
                            '<input type="button" class="btn btn-danger email-remove" value="remove" ></div>'
                            );
                        }
                    }

                    $('#physical_address').attr('value',obj.physical_address);
                    var postal = obj['post_address'].split(",");
                    $('#postal_code').attr('value',postal[0]);
                    $('#postal_address').attr('value',postal[1]);
                    $('#city').attr('value',postal[2]);


                    var services = obj['services'].split(",");

                    for (let index = 0; index < services.length; index++) {
                        if(index == 0){
                            $('#service_1').attr('value',services[index]);
                        }else{
                            z++;
                            $('#text_div_service').append('<div class="input-group input_text_service'+z+'  mt-1" >'+
                            '<input type="text" class="form-control service" placeholder="service/product" id="service_'+z+'" name="service_'+z+'" value="'+services[index]+'" aria-label="service" aria-describedby="button-addon4" required>'+
                            '<input type="button" class="btn btn-danger service-remove" value="remove" ></div>'
                            );
                        }
                    }
                }
            }
        });

        //contact
        $('.add-contact').click(function(e){
            e.preventDefault();
            if(x < 3){
                x++;
                $('#text_div_contact').append('<div class="input-group input_text_contact'+x+'  mt-1" ><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">alternative contact</span>'+
                '</div><input type="text" class="form-control contact" placeholder="contact" id="contact_'+x+'" name="contact_'+x+'" aria-label="contact" aria-describedby="button-addon4" required>'+
                '<input type="button" class="btn btn-danger contact-remove" value="remove" ></div>'
                );
            }
        });

        $('#text_div_contact').on("click",".contact-remove", function(e){
            e.preventDefault();
            if(x > 0){
                $(".input_text_contact"+x+"").remove();
                x--;
            }
        });
        //email

        $('.add-email').click(function(e){
            e.preventDefault();
            if(y < 3){
                y++;
                $('#text_div_email').append('<div class="input-group input_text_email'+y+'  mt-1" ><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">alternative Email</span>'+
                '</div><input type="text" class="form-control email" placeholder="email" id="email_'+y+'" name="email_'+y+'" aria-label="email" aria-describedby="button-addon4" required>'+
                '<input type="button" class="btn btn-danger email-remove" value="remove" ></div>'
                );
            }
        });

        $('#text_div_email').on("click",".email-remove", function(e){
            e.preventDefault();
            if(y > 0){
                $(".input_text_email"+y+"").remove();
                y--;
            }
        });
        //service

        $('.add-service').click(function(e){
            e.preventDefault();
            if(z < 6){
                z++;
                $('#text_div_service').append('<div class="input-group input_text_service'+z+'  mt-1" >'+
                '<input type="text" class="form-control service" placeholder="service/product" id="service_'+z+'" name="service_'+z+'" aria-label="service" aria-describedby="button-addon4" required>'+
                '<input type="button" class="btn btn-danger service-remove" value="remove" ></div>'
                );
            }
        });

        $('#text_div_service').on("click",".service-remove", function(e){
            e.preventDefault();
            if(z > 0){
                $(".input_text_service"+z+"").remove();
                z--;
            }
        });
    });

    function add_field(){
        var total_text = document.getElementsByClassName("service");
        total_text = total_text.length + 1;
        document.getElementById("text_div").innerHTML = document.getElementById("text_div").innerHTML+'';
    }

    function remove_field(id){
        document.getElementById(id).innerHTML="<p></p>";
    }

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
