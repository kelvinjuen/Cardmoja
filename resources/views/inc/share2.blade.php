<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Share on</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode($url)}}" target="_blank"><i class="icon-facebook-official"> facebook</i></a><br>
                <a href="https://twitter.com/intent/tweet?url=check out this bisiness card link {{urlencode($url)}}" target="_blank"><i class="icon-twitter-square"> twitter</i></a><br>

                <a href="whatsapp://send?text=check out this bisiness card link {{urlencode($url)}}" class="d-xl-none" data-action="share/whatsapp/share"><i class="icon-whatsapp">Whatsapp</i></a>
            </div>
        </div>
    </div>
</div>
