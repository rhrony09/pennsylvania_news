@extends('layouts.frontend')

@section('content')
    @php
        $ad_1 = 'ad-placeholder-360x280.jpg';
        $ad_2 = 'ad-placeholder-360x280.jpg';
        $ad_3 = 'ad-placeholder-360x280.jpg';
        if ($square_ads->count() > 0) {
            if ($square_ads->count() >= 1) {
                $ad_1 = $square_ads->first()->image . '?v=' . now()->timestamp;
            }
            if ($square_ads->count() >= 2) {
                $ad_2 = $square_ads->skip(1)->first()->image . '?v=' . now()->timestamp;
            }
            if ($square_ads->count() >= 3) {
                $ad_3 = $square_ads->skip(2)->first()->image . '?v=' . now()->timestamp;
            }
        }
    @endphp
    <main>
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-7 DTopNews">
                        <div class="col-sm-12 thumbnail">
                            @foreach ($latest_news->take(1) as $news)
                                <a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a>
                                <div class="caption">
                                    <h1><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></h1>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-5">
                        @php
                            if ($featured_news->count() > 0) {
                                $random_news = $featured_news;
                            } else {
                                $random_news = $latest_news->skip(7)->take(4);
                            }

                        @endphp
                        @foreach ($random_news as $news)
                            <div class="DTRNewsList">
                                <div class="row">
                                    <div class="col-sm-4"><a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a></div>
                                    <div class="col-sm-8">
                                        <h2><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    @foreach ($latest_news->take(7) as $news)
                        @if ($loop->iteration != 1 && $loop->iteration <= 4)
                            <div class="col-sm-4">
                                <div class="DTopNewsList">
                                    <a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                        <p>{{ $news->title }}</p>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    @foreach ($latest_news->take(7) as $news)
                        @if ($loop->iteration > 4)
                            <div class="col-sm-4">
                                <div class="DTopNewsList">
                                    <a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                        <p>{{ $news->title }}</p>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="DCategoryNews">
                    <div class="border_bottom"><a href="{{ route('category', 'জাতীয়') }}"><span class="DCategoryTitle">জাতীয়</span></a></div>
                    <div class="row">
                        <div class="col-sm-6 DCatMainNews">
                            @foreach ($national->take(1) as $news)
                                <a href="{{ route('news', $news->slug) }}">
                                    <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                    <p>{{ $national->first()->title }}</p>
                                </a>
                                <div class="DCatMainNewsDetails">
                                    <p>{!! limitString($news->content) !!}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-6">
                            @foreach ($national as $news)
                                @if ($loop->iteration != 1)
                                    <div class="row DCategoryNewsList">
                                        <div class="col-sm-4 col-xs-4"><a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a></div>
                                        <div class="col-sm-8 col-xs-8">
                                            <p><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="DCategoryNews">
                    <div class="border_bottom"><a href="{{ route('category', 'পেনসিলভানিয়া') }}"><span class="DCategoryTitle">পেনসিলভানিয়া</span></a></div>
                    <div class="row">
                        <div class="col-sm-6 DCatMainNews">
                            @foreach ($pennsylvania->take(1) as $news)
                                <a href="{{ route('news', $news->slug) }}">
                                    <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                    <p>{{ $pennsylvania->first()->title }}</p>
                                </a>
                                <div class="DCatMainNewsDetails">
                                    <p>{!! limitString($news->content) !!}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-6">
                            @foreach ($pennsylvania as $news)
                                @if ($loop->iteration != 1)
                                    <div class="row DCategoryNewsList">
                                        <div class="col-sm-4 col-xs-4"><a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a></div>
                                        <div class="col-sm-8 col-xs-8">
                                            <p><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="DCategoryNews">
                    <div class="border_bottom"><a href="{{ route('category', 'আমেরিকা') }}"><span class="DCategoryTitle">আমেরিকা</span></a></div>
                    <div class="row">
                        @foreach ($america as $news)
                            <div class="col-sm-4">
                                <a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                    <p>{{ $news->title }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="DCategoryNews">
                            <div class="border_bottom"><a href="{{ route('category', 'রাজনীতি') }}"><span class="DCategoryTitle">রাজনীতি</span></a></div>
                            <div class="DCatMainNews2">
                                @foreach ($politics->take(1) as $news)
                                    <a href="{{ route('news', $news->slug) }}">
                                        <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                        <p>{{ $news->title }}</p>
                                    </a>
                                @endforeach
                            </div>
                            <ul class="DCatNewsList2">
                                @foreach ($politics as $news)
                                    @if ($loop->iteration != 1)
                                        <li><a href="{{ route('news', $news->slug) }}"><i class="fa fa-stop" aria-hidden="true"></i> {{ $news->title }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="DCategoryNews">
                            <div class="border_bottom"><a href="{{ route('category', 'অর্থনীতি') }}"><span class="DCategoryTitle">অর্থনীতি</span></a></div>
                            <div class="DCatMainNews2">
                                @foreach ($economy->take(1) as $news)
                                    <a href="{{ route('news', $news->slug) }}">
                                        <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                        <p>{{ $news->title }}</p>
                                    </a>
                                @endforeach
                            </div>
                            <ul class="DCatNewsList2">
                                @foreach ($economy as $news)
                                    @if ($loop->iteration != 1)
                                        <li><a href="{{ route('news', $news->slug) }}"><i class="fa fa-stop" aria-hidden="true"></i> {{ $news->title }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


            <!--Right Side-->
            <div class="col-sm-3">
                <!-- ad start -->
                <div class="row DMarginTop10">
                    <div class="col-sm-12">
                        <div class="ad-image">
                            <img src="{{ asset('uploads/ads/' . $ad_1) }}" alt="ad" title="ad" class="img-responsive img100">
                        </div>
                    </div>
                </div>
                <!-- ad end -->
                <section>
                    <div class="DLPSTab panel panel-default DMarginTop20">
                        <div class="panel-heading">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#1b" data-toggle="tab">
                                        <p>সর্বশেষ</p>
                                    </a></li>
                                <li><a href="#2b" data-toggle="tab">
                                        <p>জনপ্রিয়</p>
                                    </a></li>
                            </ul>
                        </div>
                        <div class="panel-body latestPanelDefault">
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="1b">
                                    <ul class="LatestNewsList">
                                        @foreach ($latest_news->take(20) as $news)
                                            <li><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane" id="2b">
                                    <ul class="LatestNewsList">
                                        @foreach ($popular_news->take(20) as $news)
                                            <li><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('archives') }}" class="btn btnAllNews"><i class="fa fa-arrow-right"></i> সকল খবর জানতে ক্লিক করুন</a>
                </section>

                <!-- ad start -->
                <div class="row DMarginTop10">
                    <div class="col-sm-12">
                        <div class="ad-image">
                            <img src="{{ asset('uploads/ads/' . $ad_2) }}" alt="ad" title="ad" class="img-responsive img100">
                        </div>
                    </div>
                </div>
                <!-- ad end -->

                <div class="DCategoryNews">
                    <div class="border_bottom"><a href="{{ route('category', 'খেলার-মাঠ') }}"><span class="DCategoryTitle">খেলার মাঠ</span></a></div>
                    <div class="DCatMainNews2">
                        @foreach ($sports->take(1) as $news)
                            <a href="{{ route('news', $news->slug) }}">
                                <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                <p>{{ $news->title }}</p>
                            </a>
                        @endforeach
                    </div>
                    <ul class="DCatNewsList2">
                        @foreach ($sports as $news)
                            @if ($loop->iteration != 1)
                                <li><a href="{{ route('news', $news->slug) }}"><i class="fa fa-stop" aria-hidden="true"></i> {{ $news->title }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="DCategoryNews">
                    <div class="border_bottom"><a href="{{ route('category', 'বহিবিশ্ব') }}"><span class="DCategoryTitle">বহি:বিশ্ব</span></a></div>
                    <div class="DCatMainNews3">
                        @foreach ($international->take(1) as $news)
                            <a href="{{ route('news', $news->slug) }}">
                                <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                <p>{{ $news->title }}</p>
                            </a>
                        @endforeach
                    </div>
                    @foreach ($international as $news)
                        @if ($loop->iteration != 1)
                            <div class="DCatNewsList4">
                                <div class="row">
                                    <div class="col-sm-4"><a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a></div>
                                    <div class="col-sm-8">
                                        <p><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- ad start -->
                <div class="row DMarginTop10">
                    <div class="col-sm-12">
                        <div class="ad-image">
                            <img src="{{ asset('uploads/ads/' . $ad_3) }}" alt="ad" title="ad" class="img-responsive img100">
                        </div>
                    </div>
                </div>
                <!-- ad end -->

                <div class="DCategoryNews">
                    <div class="border_bottom"><a href="{{ route('category', 'বিনোদন') }}"><span class="DCategoryTitle">বিনোদন</span></a></div>
                    <div class="DCatMainNews3">
                        @foreach ($entertainment->take(1) as $news)
                            <a href="{{ route('news', $news->slug) }}">
                                <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                <p>{{ $news->title }}</p>
                            </a>
                        @endforeach
                    </div>
                    @foreach ($entertainment as $news)
                        @if ($loop->iteration != 1)
                            <div class="DCatNewsList4">
                                <div class="row">
                                    <div class="col-sm-4"><a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a></div>
                                    <div class="col-sm-8">
                                        <p><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!--/Right Side-->

        <div class="DCategoryNews">
            <div class="border_bottom"><a href="{{ route('photo.gallery') }}"><span class="DCategoryTitle">ছবি গ্যালারি</span></a></div>
            <div class="row DVideoGallery">
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
            <a href="{{ route('photo.gallery') }}" class="btn btn-primary gallery-btn">সব ছবি দেখুন</a>
        </div>

        <div class="DCategoryNews DMarginBottom20">
            <div class="border_bottom"><a href="{{ route('video.gallery') }}"><span class="DCategoryTitle">ভিডিও গ্যালারি</span></a></div>
            <div class="row DVideoGallery">
                @forelse ($video_gallery as $video)
                    <div class="col-sm-3">
                        <div class="DVideoGalleryList">
                            <a href="{{ route('video.gallery.show', $video->slug) }}">
                                <img src="{{ asset('uploads/video-gallery/' . $video->thumbnail) . '?v=' . now()->timestamp }}" alt="{{ $video->title }}" title="{{ $video->title }}" class="img-responsive img100">
                                <p>{{ $video->title }}</p>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-sm-12">
                        <h3>দুঃখিত, কোনো ভিডিও পাওয়া যায়নি।</h3>
                    </div>
                @endforelse
            </div>
            <a href="{{ route('video.gallery') }}" class="btn btn-primary gallery-btn">সব ভিডিও দেখুন</a>
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
