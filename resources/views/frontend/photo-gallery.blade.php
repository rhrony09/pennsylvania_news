@extends('layouts.frontend')

@section('content')
    <main>
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}"><i class="fa fa-home fa-lg" aria-hidden="true"></i> প্রচ্ছদ</a></li>
                    <li class="active"><a href="{{ route('photo.gallery') }}">ছবি গ্যালারি</a></li>
                </ol>
            </div>
        </div>
        <div class="row DMarginBottom20 DVideoGallery">
            @forelse ($gallery as $image)
                <div class="col-sm-3">
                    <a href="{{ asset('uploads/photo-gallery/' . $image->image) }}" data-toggle="lightbox" data-gallery="ছবি গ্যালারি" data-title="ছবি গ্যালারি">
                        <img src="{{ asset('uploads/photo-gallery/' . $image->image) . '?v=' . now()->timestamp }}" class="img-thumbnail">
                    </a>
                </div>
            @empty
                <div class="col-sm-12">
                    <h3>দুঃখিত, কোনো ছবি পাওয়া যায়নি।</h3>
                </div>
            @endforelse
        </div>
        <div class="row MarginTop20">

            <div class="col-sm-4">
                {{ $gallery->links() }}
            </div>
        </div>
    </main>
@endsection

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/ekko-lightbox/ekko-lightbox.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('assets/frontend/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endpush
