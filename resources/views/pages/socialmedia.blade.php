@extends('layouts.app')

@section('content')
<div class="site-section">
        <div class="container">
            <div class="card-wrap ">
                <h3 class="text-secondary mb-4 text-center">Internet Links</h3>
                <form id="social_form" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-12 col-lg-5" id="services_div">
                            <select class="custom-select" id="weblinks">
                                <option selected>Select link</option>
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter</option>
                                <option value="instagram">Instagram</option>
                                <option value="linkedin">Linkedin</option>
                                <option value="youtube">Youtube</option>
                                <option value="github">Github</option>
                            </select>
                        </div>
                    </div>
                    <div id="div-links" style="min-height: 50vh;"></div>
                    {{csrf_field() }}
                    <button type="submit" id="submit_card" class="btn btn-primary btn-sm col-12">Next</button>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript" language="javascript">
    let linkArray =[];
    let count =0;
    $(document).on('submit', '#social_form', function(event){
            event.preventDefault();
            $.ajax({
                url:"/savelinks",
                method:'POST',
                async: false,
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    var obj = data.success;
                    window.location.href = "/design";

                }
            });

    });

    $(document).ready(function(){
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
                    let links = obj['social_media'].split(",");
                    for (let index = 0; index < links.length; index++) {
                        let link = links[index].split('->');
                        if(!link[0].match(/(^|\W)check($|\W)/)){
                            $('#div-links').append('<div class="row my-4 border-bottom link-'+link[0]+'"><div class="form-group my-0 col-lg-5"><div class="input-group input-group">'+
                                '<div class="input-group-prepend"><span class="input-group-text icon-'+link[0]+'"></span></div>'+
                                '<input type="text" class="form-control" id="'+link[0]+'"  name="'+link[0]+'"  placeholder="https://'+link[0]+'.com/profile" value="'+link[1]+'" required>'+
                                '<div class="input-group-append"><button type="button" class="btn btn-outline-danger contact-remove" id="'+link[0]+'"><span class="icon-remove"></span></button></div></div>'+
                                '<small id="'+link[0]+'" class="form-text text-muted mx-1">login to '+link[0]+', click on your profile and copy the url</small></div></div>'
                            );
                            linkArray[count] = link[0];
                            count++;


                        }else{
                            $('#'+link[0]).prop('checked',true);
                        }
                        console.log(linkArray);


                    }
                }
            }
        });
    });

    $(document).on('change', '#weblinks', function(event){
        event.preventDefault();
        let selectedlink = $(this).children("option:selected").val();
        for (let i = 0; i < linkArray.length; i++) {
            if(linkArray[i] == selectedlink){
                    return null;
            }
        }
        linkArray[count] = selectedlink;
        count++;

        $('#div-links').append('<div class="row my-4 border-bottom link-'+selectedlink+'"><div class="form-group my-0 col-lg-5"><div class="input-group input-group">'+
            '<div class="input-group-prepend"><span class="input-group-text icon-'+selectedlink+'"></span></div>'+
            '<input type="text" class="form-control" id="'+selectedlink+'"  name="'+selectedlink+'"  placeholder="https://'+selectedlink+'.com/profile" required>'+
            '<div class="input-group-append"><button type="button" class="btn btn-outline-danger contact-remove" id="'+selectedlink+'"><span class="icon-remove"></span></button></div></div>'+
            '<small id="'+selectedlink+'" class="form-text text-muted mx-1">login to '+selectedlink+', click on your profile and copy the url</small></div></div>'
        );
    });

    $('#div-links').on("click",".contact-remove", function(e){
        e.preventDefault();
        linkArray = linkArray.filter((value)=>value != this.id);
        $(".link-"+this.id).remove();
    });


</script>

@endsection
