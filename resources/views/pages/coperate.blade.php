@extends('layouts.app')

@section('content')
<div class="site-blocks-cover " data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container-fluid">
        <div class="row p-4">
                <div class=" col-md-4 col-lg-4 col-xl-3 d-none d-md-block text-center ">
                    <div class="border p-1 my-1 bg-white">
                        <h2><span class="user_company">COPERATE ADMIN</span></h2>

                    </div>
                    <button type="button" id="" class="btn btn-success btn-block btn-user" data-toggle="modal" data-target=".add-modal" data-whatever="'+data+'">Add Staff</button>
                    <button type="button" class="btn btn-success btn-block">Edit Card Info</button>
                    <button type="button" class="btn btn-success btn-block">Edit Card Design</button>
                    <button type="button" class="btn btn-success btn-block">Log Out</button>
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row  p-1 my-1 justify-content-end">
                        <div class="col-12 col-md-6">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="search staff" aria-label="search contact" aria-describedby="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="search">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h5><span class="border-bottom">Staff With cards</span></h5>
                    <div class="mt-2 " id="staff">


                    </div>
                </div>
                <div class="col-xl-3  d-none d-xl-block text-center">
                    <div class="border p-1 my-1">
                        <h3><span class="user_company">Account Details</span></h3>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- add modal -->
<div class="modal fade add-modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel"><span class="names">Add New Staff Cards</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addStaff" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" id="email" value="" placeholder="staff email">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="position" value="" placeholder="staff position">
                                </div>
                                <input type="button" class="btn btn-success add-list mr-2" value="+" >
                                <input type="button" class="btn btn-danger remove" value="-" >

                            </div>
                            <div class="row text-center mt-3">
                                <h6 class="col-12">new card staff List</h6>
                            </div>
                            <input type="hidden" name="total" id="total" value="">
                            <input type="hidden" name="details-id" id="details-id" value="">
                            <table class="table table-sm mt-2">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Postion</th>

                                </tr>
                                </thead>
                                <tbody id="list-wrapper">
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                                {{csrf_field() }}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Book List</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of add model -->

<script type="text/javascript" language="javascript">
    var x = 0;
    let detailsId = null;
    $(document).ready(function(){
        let add_button = $(".add-list");
        let wrapper = $("#list-wrapper");


        $.ajax({
            url:"/getdetailid",
            method:'GET',
            async: false,
            contentType:false,
            processData:false,
            success:function(data)
            {
                let obj = data.id;
                detailsId = obj.details_id;
                $('#details-id').attr('value',detailsId);
            }
        });

        getInfo();

        $(add_button).click(function(e){
            e.preventDefault();
            let email = $('#email').val();
            let position = $('#position').val();

            if(!!email && !!position){
                x++;
                $('input[id=email]').val('');
                $('input[id=position]').val('');

                $(wrapper).append('<tr  id="tr-wrap-'+x+'">'+
                '<td>'+x+'</td>'+
                '<td>'+email+'</td><input type="hidden" name="email-'+x+'" id="email-'+x+'" value="'+email+'">'+
                '<td>'+position+'</td><input type="hidden" name="position-'+x+'" id="position-'+x+'" value="'+position+'">'+
                '</tr>');

            }else{
                alert('Warning!!! : fill all the values');
            }


        });
    });

    $(document).on('submit', '#addStaff', function(event){
        event.preventDefault();
        if(x > 0){
            $('#total').attr('value',x);
            $.ajax({
                url:"/savestaff",
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
                        //$('.password').html(obj['password']);
                    }else{
                        $("#list-wrapper").empty();
                        $('#addModal').modal('hide').data('bs.modal', null);
                        $('.modal-backdrop').hide();
                        x= 0;
                    }
                }
            });
        }else{
            alert('Warning!!! : list is empty')
        }


    });

    function getInfo(){
        $.ajax({
            url:"/coperate/"+detailsId,
            method:'GET',
            async: false,
            contentType:false,
            processData:false,
            success:function(data)
            {
                let staff = data.staff;


                if(staff.length){
                    for (let index = 0; index < staff.length; index++) {
                        $('#staff').append('<div class="row mt-1 border align-items-center align-self-start bg-white contact-click" data-href="#">'+
                        '<div class="col-3 col-md-3 p-1 ">active</div>'+
                        '<div class="col-9 col-md-6"><h5>'+staff[index].email+'</h5><h6>'+staff[index].position+'</h6></div><div class="col-md-3">(3 Reviews) </div></div>');
                    }
                }else{
                    $('#staff').html('<div class="row"><h4 class="col-md-12">Add new Staff</h4></div>');
                }
            }
        });
    }




</script>

@endsection
