@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="f-22 m-0">Category List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped align-middle datatable" width="100%">
                        <thead>
                            <tr>
                                <th width="30px">S/N</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <x-dropdown>
                                            <x-dropdown-button class="category-edit" icon="pen-to-square" data-id="{{ $category->id }}">Edit</x-dropdown-button>
                                            <x-dropdown-button class="category-delete" icon="trash-can" data-id="{{ $category->id }}">Delete</x-dropdown-button>
                                        </x-dropdown>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="f-22 m-0">Category List</h4>
                </div>
                <div class="card-body">
                    <div id="form-errors"></div>
                    <form id="category-form">
                        @csrf
                        <x-forms.text fieldId="name" fieldLabel="Category Name" fieldName="name" :fieldRequired="true"></x-forms.text>
                        <x-forms.text fieldId="slug" fieldLabel="Slug" fieldName="slug" :fieldRequired="true"></x-forms.text>
                        <x-button icon="plus" type="submit">Add</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $("#name").keyup(function() {
            let value = $(this).val();
            $('#slug').val(convertToSlug(value));
        });

        $('#category-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('dashboard.category.store') }}",
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

                    $('#form-errors').html(errorsHtml);
                }
            });
        });

        $('.category-edit').click(function() {
            $('#rhModal').modal('show');
            let id = $(this).data('id');
            let url = "{{ route('dashboard.category.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    $('#rhModal .modal-content').html(response);
                }
            });
        });

        $('.category-delete').click(function() {
            let id = $(this).data('id');
            let url = "{{ route('dashboard.category.delete', ':id') }}";
            url = url.replace(':id', id);
            delete_warning(url);
        });

        function convertToSlug(text) {
            return text.toLowerCase().replace(text, text).replace(/^-+|-+$/g, '')
                .replace(/\s/g, '-').replace(/\-\-+/g, '-');
        }
    </script>
@endpush
