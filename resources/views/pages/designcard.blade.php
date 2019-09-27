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
                                <option value="1" selected>type 1</option>
                                <option value="2">type 2</option>
                                <option value="3">type 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Background Colour</label>
                        <div class="col-sm-7">
                            <select class="custom-select background-select" name="background-select" id="background-select">
                                <option value="/bg_1.jpg" selected>Default</option>
                                <option value="/bg_2.jpg">sleek</option>
                                <option value="/bg_3.jpg">normal</option>
                                <option value="/bg_4.jpg">blue</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Primary Colour</label>
                        <div class="col-sm-7">
                            <select class="custom-select foreground-select1" name="colour-1" id="colour-1">

                                <option value="text-light" selected>White</option>
                                <option value="text-dark">dark</option>
                                <option value="text-success">Green</option>
                                <option value="text-danger">red</option>
                                <option value="text-primary">blue</option>
                                <option value="text-warning">yellow</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Secondary Colour </label>
                        <div class="col-sm-7">
                            <select class="custom-select foreground-select2" name="colour-2" id="colour-2">

                                <option value="text-light" selected>White</option>
                                <option value="text-dark">dark</option>
                                <option value="text-success">Green</option>
                                <option value="text-danger">red</option>
                                <option value="text-primary">blue</option>
                                <option value="text-warning">yellow</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3" for="exampleFormControlFile1">Background Image</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control-file" name="upload" id="upload">
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

                        <button type="submit"  class="btn btn-success col-12">Update</button>
                        </div>
                        {{csrf_field()}}
                    </div>
                </form>

            </div>

            <div class="col-md-5 py-3" id="card-wrapper">
                <div class="card text-light" id="card_1" style="height: 14rem;">
                    <img class="card-img" src="storage/background_images/bg_1.jpg" id="card-bg" style="height: 14rem;" alt="Card image">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-fluid float-left d-block img-thumbnail" height="400vh"   width="100vh"  src="/images/person_2.jpg" alt="photo">
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
                <div class="card text-light" id="card_2" style="height: 14rem;">
                    <img class="card-img" src="storage/background_images/bg_1.jpg" id="card-bg" style="height: 14rem;" alt="Card image">
                    <div class="card-img-overlay">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <h3 class="card-title ">Company name</h3>
                                <h6 class="card-subtitle colour_2">slogan</h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <img class="img-fluid  ml-auto d-block img-thumbnail"  width="70vh"  src="/images/person_2.jpg" alt="photo"/>

                                <h5 class="card-title">Full name</h5>
                                <h6 class="card-subtitle Colour_2">title</h6>


                            </div>
                        </div>
                        <div class="row ">
                            <h6 class="col-md-4 py-1 text-right">Services:</h6>
                            <div class="col-md-8">
                                    <ul class="float-right ">
                                            <li class="mx-1" style="display: inline-block;"><small>service 1</small></li>
                                            <li class="mx-1" style="display: inline-block;"><span class="border-left"></span><small>service 2</small></li>
                                            <li class="mx-1" style="display: inline-block;"><span class="border-left"></span><small>service 3</small></li>
                                        </ul>
                            </div>
                        </div>
                        <div class="row my-1">
                                <ul class="float-right">
                                    <li class="mx-1" style="display: inline-block;"></span><small>&#9742; 0725123654</small></li>
                                    <li class="mx-1" style="display: inline-block;"></span><small>test@gmail.com</small></li>
                                    <li class="mx-1" style="display: inline-block;"></span><small>room 101, rehema house</small></li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="card text-light" id="card_3" style="max-height: 14rem;" >
                    <img class="card-img" src="storage/background_images/bg_1.jpg" id="card-bg" style="height: 14rem;" alt="Card image">
                    <div class="card-img-overlay">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Full name</h3>
                                <h6 class="card-subtitle colour_2">title</h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="card-title ">Company name</h3>
                                <h6 class="card-subtitle colour_2">slogan</h6>
                            </div>
                        </div>
                        <div class="row border-top">
                            <div class="col-md-9">
                                <div class="row">
                                <ul class="list-unstyled float-left ml-3">
                                    <li ><small>&#9742; 071234322</small></li>
                                    <li ><small>test@gmail.com</small></li>
                                    <li ><small>physical location</small></li>
                                </ul>
                                </div>
                                <div class="row">
                                        <div class="col-md-4"><h6 class="py-1">Services:</h6></div>
                                        <div class="col-md-8">
                                            <ul class="float-right">
                                                <li  style="display: inline-block;"><small>service 1</small></li>
                                                <li  style="display: inline-block;"><small>service 2</small></li>
                                            </ul>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-3 py-4">
                                <img class="img-fluid  ml-auto   d-block img-thumbnail"  width="120vh"  src="/images/person_2.jpg" alt="photo"/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('#card_2').hide();
        $('#card_3').hide();

        $.ajax({
            url:"{{route('card.show',auth()->user()->user_id)}}",
            method:'GET',
            async: false,
            contentType:false,
            processData:false,
            success:function(data)
            {
                var obj = data.success;
            }
        });

    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#design_form', function(event){
            event.preventDefault();
            var success = false;
            $.ajax({
                url:"/savedesign",
                method:'POST',
                async: false,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.success;
                    let type = '{{auth()->user()->type}}' ;

                    if(type == 'personal'){
                        window.location.href = "/card?id={{auth()->user()->user_id}}";
                    }else{
                        window.location.href = "/coperate";
                    }

                }
            });


    });
    function hide_all(){
        $('#card_1').hide();
        $('#card_2').hide();
        $('#card_3').hide();
    }
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('.card-img').attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change','#type-select', function(){
        var selectedType = $(this).children("option:selected").val();
        hide_all();
        if(selectedType  == 1){
            $('#card_1').show();
        }else if(selectedType  == 2){
            $('#card_2').show();
        }else{
            $('#card_3').show();
        }

    });

    $(document).on('change','#background-select', function(){
        var selectedBg = $(this).children("option:selected").val();
        $('.card-img').attr("src", "/storage/background_images/"+selectedBg);
        $("#upload").val('');

    });
    $(document).on('change','.foreground-select1', function(){
        var selectedfg = $(this).children("option:selected").val();
        var presentClassName = $('.card').attr('class');
        var classChange = "card "+selectedfg;
        $('.card').removeClass(presentClassName).addClass(classChange);
    });
    $(document).on('change','.foreground-select2', function(){
        var selectedfg = $(this).children("option:selected").val();
        var presentClassName = $('.card-subtitle').attr('class');
        var classChange = "card-subtitle "+selectedfg;
        $('.card-subtitle').removeClass(presentClassName).addClass(classChange);
    });
    $(document).on('change','#upload', function(){
        readURL(this);
    });
</script>
@endsection
