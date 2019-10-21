<form id="rate-form">'+
    '<textarea class="form-control" id="comments" name="comments" rows="2" maxlength="100" placeholder="comments"></textarea>'+
    '<div class="row mt-1 text-right">'+
        '<span class="col-9 my-rating"></span><span class="col-3 live-rating"></span>'+
        '<input type="hidden" name="rating" id="rating" value="0">'+
    '</div>'+
    '<div class="form-group form-check text-right">'+
        '<input type="checkbox" class="form-check-input" id="anonymous" name="anonymous" value="1">'+
        '<label class="form-check-label" for="exampleCheck1">Anonymous</label>'+
    '</div>'+
    '<input type="hidden" name="card-id" id="card-id" value="{{$_GET['id']}}">'+
    '<button class="btn btn-primary float-right ml-2  mb-3 btn-sm cancel" type="button">Cancel</button>'+
    '<button class="btn btn-primary float-right  mb-3 btn-sm" type="submit">Rate</button>'+

    '{{csrf_field() }}'+
'</form>'
