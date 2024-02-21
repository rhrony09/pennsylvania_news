<form id="category-form-modal">
    <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div id="form-errors-modal"></div>
        @csrf
        <input type="hidden" name="id" value="{{ $category->id }}">
        <x-forms.text fieldId="name-modal" fieldLabel="Category Name" fieldName="name" fieldValue="{{ $category->name }}" :fieldRequired="true"></x-forms.text>
        <x-forms.text fieldId="slug-modal" fieldLabel="Slug" fieldName="slug" :fieldRequired="true" fieldValue="{{ $category->slug }}"></x-forms.text>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
    $("#name-modal").keyup(function() {
        let value = $(this).val();
        $('#slug-modal').val(convertToSlug(value));
    });

    $('#category-form-modal').submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "{{ route('dashboard.category.update') }}",
            data: $(this).serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    location.reload();
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
