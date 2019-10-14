<form id="rate-form">'+
    '<label for="input-1" class="control-label">Rate</label>'+
    '<textarea class="form-control" id="comments" name="comments" rows="2" maxlength="100" placeholder="comments"></textarea>'+
    '<div class="row mt-1 text-right">'+
        '<span class="col-9 my-rating"></span><span class="col-3 live-rating"></span>'+
        '<input type="hidden" name="rating" id="rating" value="0">'+
    '</div>'+
    '<div class="form-group form-check">'+
        '<input type="checkbox" class="form-check-input" id="anonymous" name="anonymous" value="1">'+
        '<label class="form-check-label" for="exampleCheck1">Anonymous</label>'+
    '</div>'+
    '<input type="hidden" name="card-id" id="card-id" value="{{$_GET['id']}}">'+
    '<button class="btn btn-primary float-right btn-sm" type="submit">RATE</button>'+
    '{{csrf_field() }}'+
'</form>'
