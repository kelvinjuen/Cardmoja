@if(!auth::guest())
        @if(auth()->user()->id == $card->user_id)
            <div class="row my-2 ">
                <div class="col-6 col-sm-6 col-md-6">
                    <a href="/card/{{auth()->user()->id}}/edit" class="btn btn-success w-100 ">Edit details</a>
                </div>
                <div class="col-6 col-sm-6 col-md-6">
                    <a href="/design/{{$card->card_id}}/edit?id={{$card->card_id}}" class="btn btn-success w-100">Edit Design</a>
                </div>
            </div>
        @else
            <div class="row my-2 ">
                <div class="col-6 col-sm-6 col-md-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#MessageModal">
                        Message
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-light">
                                    <h6 class="modal-title" id="exampleModalCenterTitle">Compose Message</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="message_form" method="POST">

                                        <div class="form-group">
                                            <input type="hidden" name="sender_id" id="sender_id" value="{{auth()->user()->id}}">
                                            <input type="hidden" name="receiver_id" id="receiver_id" value="{{$card->user_id}}">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                        {{csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6">
                    <a href="#" class="btn btn-success w-100">Recomend</a>
                </div>
            </div>
        @endif
