@extends('layouts.dashboard')

@section('top-btn')
    <button class="btn btn-primary btn-sm" id="addGallery"><i class="fa fa-plus"></i> Add New Image</button>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse ($galleries as $gallery)
                    <div class="col-md-3">
                        <div class="gallery-image shadow">
                            <img src="{{ asset('uploads/photo-gallery/' . $gallery->image) . '?v=' . now()->timestamp }}">
                            <button type="button" class="btn btn-danger delete-gallery" data-id="{{ $gallery->id }}"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            No photo in the galley.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#addGallery').click(function() {
            $('#rhModal').modal('show');
            let url = "{{ route('dashboard.photo.gallery.create') }}";
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    $('#rhModal .modal-content').html(response);
                }
            });
        });

        $('.delete-gallery').click(function() {
            let id = $(this).data('id');
            let url = "{{ route('dashboard.photo.gallery.delete', ':id') }}";
            url = url.replace(':id', id);
            delete_warning(url);
        });
    </script>
@endpush
