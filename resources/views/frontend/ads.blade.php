@extends('layouts.frontend')

@section('content')
    <main>
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}"><i class="fa fa-home fa-lg" aria-hidden="true"></i> প্রচ্ছদ</a></li>
                    <li class="active"><a href="{{ route('ads') }}">বিজ্ঞাপন</a></li>
                </ol>
            </div>
        </div>
        <div class="row DMarginBottom20">
            @forelse ($square_ads as $image)
                <a href="{{ asset('uploads/ads/' . $image->image) . '?v=' . now()->timestamp }}" data-toggle="lightbox" data-gallery="বিজ্ঞাপন" data-title="বিজ্ঞাপন" class="col-sm-4">
                    <div class="ad-image">
                        <img src="{{ asset('uploads/ads/' . $image->image) . '?v=' . now()->timestamp }}" alt="ad" title="ad" class="img-thumbnail">
                    </div>
                </a>
            @empty
                <h3 class="DMarginBottom30">দুঃখিত, কোনো বিজ্ঞাপন পাওয়া যায়নি।</h3>
            @endforelse
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
