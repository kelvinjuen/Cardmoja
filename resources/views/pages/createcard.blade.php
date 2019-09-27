@extends('layouts.app')

@section('content')
<div class="site-section">

        <div class="container">
            <div class="card-wrap ">
                <h3 class="text-secondary mb-4 text-center">Card Details</h3>
                <form id="card_form" method="POST" enctype="multipart/form-data">

                    <h6 class="text-secondary mb-4 border-bottom mb-4">Personal Profile</h6>
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

                    <div class="form-group row">
                        <div class="col-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Logo/Profile photo</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <input type="file" class="form-control-file" id="card_photo" name="card_photo">
                        </div>
                        <div class="col">
                            <span class="photo"></span>
                        </div>
                    </div>

                    <button type="submit" id="submit_card" class="btn btn-primary btn-sm col-12">Create Card</button>
                    {{csrf_field() }}
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript" language="javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#card_form', function(event){
        event.preventDefault();
        var success = false;

        $.ajax({
            url:"{{route('card.store')}}",
            method:'POST',
            async: false,
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                var obj = data.errors;
                $('.photo').html('');
                if(obj != null){
                    $('#firstName').attr('placeholder',obj['firstName']);
                    $('#secondName').attr('placeholder',obj['secondName']);
                    $('#position').attr('placeholder',obj['position']);
                    $('#company').attr('placeholder',obj['company']);
                    $('#mobile').attr('placeholder',obj['mobile']);
                    $('.photo').html(obj['card_photo']);
                }else{
                    var lastid = data.lastid;
                    window.location.href = "/design;
                }
            }
        });
    });

    $(document).ready(function(){

        var x = 1;
        let y = 1;
        let z = 1;

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
</script>

@endsection
