<form id="gallery-form-modal">
    <div class="modal-header">
        <h5 class="modal-title">Add New Video to the Gallery</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div id="form-errors-modal"></div>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <x-forms.text fieldId="title" fieldLabel="Title" fieldName="title"></x-forms.text>
                <x-forms.text fieldId="video_link" fieldLabel="Video Link" fieldName="video_link" fieldHelp="Supported: Youtube Link Only"></x-forms.text>
                <x-forms.file fieldId="thumbnail" fieldLabel="Upload a Thumbail" fieldName="thumbnail" allowedFileExtensions="jpg jpeg png" fieldHelp="Supported: JPG & PNG."></x-forms.file>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
    $('.dropify').dropify();

    $('#gallery-form-modal').submit(function(e) {
        e.preventDefault();
        $('#form-errors-modal').html('');
        $.ajax({
            type: 'POST',
            url: "{{ route('dashboard.video.gallery.store') }}",
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
