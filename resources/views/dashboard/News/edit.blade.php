@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="form-errors"></div>
            <form id="news-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $news->id }}">
                <div class="row">
                    <div class="col-md-9">
                        <x-forms.text fieldId="title" fieldLabel="News Title" fieldName="title" :fieldRequired="true" fieldValue="{{ $news->title }}"></x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.select fieldId="category_id" fieldLabel="Category" fieldName="category_id" :fieldRequired="true">
                            <option value="">--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-12">
                        <x-forms.textarea-quill fieldId="content" fieldLabel="News Content" fieldName="content" :fieldRequired="true" fieldValue="{!! $news->content !!}"></x-forms.textarea-quill>
                    </div>
                    <div class="col-md-12">
                        <x-forms.file fieldId="featured_image" fieldLabel="Upload a Featured Image" fieldName="featured_image" allowedFileExtensions="jpg jpeg png" fieldHelp="Supported: JPG & PNG. Recommended Size: 1000x560px" fieldValue="{{ $news->featured_image ? asset('uploads/news/' . $news->featured_image) : '' }}"></x-forms.file>
                    </div>
                    <div class="col-md-12">
                        <x-button icon="paper-plane" type="submit">Update</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#news-form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: "{{ route('dashboard.news.update') }}",
                disableButton: true,
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
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
    </script>
@endpush
