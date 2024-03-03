@extends('layouts.dashboard')

@section('top-btn')
    <button class="btn btn-primary btn-sm" id="addGallery"><i class="fa fa-plus"></i> Add New Video</button>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse ($galleries as $gallery)
                    <div class="col-md-3">
                        <div class="gallery-video shadow">
                            <div class="thumb">
                                <img src="{{ asset('uploads/video-gallery/' . $gallery->thumbnail) }}">
                                <a href="{{ url('https://www.youtube.com/watch?v=' . $gallery->video_link) . '?v=' . now()->timestamp }}" class="btn btn-danger" target="_blank"><i class="fa-solid fa-play"></i></a>
                            </div>
                            <p class="my-2">{{ $gallery->title }}</p>
                            <button type="button" class="btn btn-danger btn-sm delete-gallery" data-id="{{ $gallery->id }}"><i class="fas fa-trash"></i> Delete</button>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            No video in the galley.
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
            let url = "{{ route('dashboard.video.gallery.create') }}";
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
            let url = "{{ route('dashboard.video.gallery.delete', ':id') }}";
            url = url.replace(':id', id);
            delete_warning(url);
        });
    </script>
@endpush
