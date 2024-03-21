<form id="ad-form-modal">
    <div class="modal-header">
        <h5 class="modal-title">Edit Ad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div id="form-errors-modal"></div>
        @csrf
        <input type="hidden" name="id" value="{{ $ad->id }}">
        <div class="row">
            <div class="col-md-12">
                <x-forms.file fieldId="image" fieldLabel="Upload a Image" fieldName="image" allowedFileExtensions="jpg jpeg png gif" fieldHelp="Supported: JPG, PNG & GIF." fieldValue="{{ asset('uploads/ads/' . $ad->image) }}"></x-forms.file>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
    $('.select-picker').select2({
        placeholder: 'Select an Option',
        width: '100%',
        dropdownParent: $('#rhModal')
    });

    $('.dropify').dropify();

    $('#ad-form-modal').submit(function(e) {
        e.preventDefault();
        $('#form-errors-modal').html('');
        $.ajax({
            type: 'POST',
            url: "{{ route('dashboard.ads.update') }}",
            disableButton: true,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload(true);
                }
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                let errorsHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul class="m-0">';
                if (errors) {
                    $.each(errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                } else {
                    errorsHtml += '<li>' + response.responseJSON.message + '</li>';
                }
                errorsHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                $('#form-errors-modal').html(errorsHtml);
            }
        });
    });
</script>
