@extends('layouts.frontend')

@section('content')
    <main>
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}"><i class="fa fa-home fa-lg" aria-hidden="true"></i> প্রচ্ছদ</a></li>
                    <li class="active"><a href="{{ route('video.gallery') }}">ভিডিও গ্যালারি</a></li>
                </ol>
            </div>
        </div>
        <div class="row DMarginBottom20">
            @forelse ($gallery as $video)
                <div class="col-sm-3">
                    <div class="DVideoGalleryList">
                        <a href="{{ route('video.gallery.show', $video->slug) }}">
                            <img src="{{ asset('uploads/video-gallery/' . $video->thumbnail) }}" alt="{{ $video->title }}" title="{{ $video->title }}" class="img-responsive img100">
                            <p>{{ $video->title }}</p>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-sm-12">
                    <h3 class="DMarginBottom30">দুঃখিত, কোনো ভিডিও পাওয়া যায়নি।</h3>
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
