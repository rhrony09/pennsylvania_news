<div class="modal-header">
    <h5 class="modal-title">Show Ad</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <img class="img-fluid" src="{{ asset('uploads/ads/' . $ad->image) }}" alt="ad">
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
