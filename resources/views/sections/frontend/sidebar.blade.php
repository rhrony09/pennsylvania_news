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

<div class="col-sm-4">
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
                            @foreach ($popular_news as $news)
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
    <div class="row DMarginTop20">
        <div class="col-sm-12">
            <div class="ad-image">
                <img src="{{ asset('uploads/ads/' . $ad_2) }}" alt="ad" title="ad" class="img-responsive img100">
            </div>
        </div>
    </div>
    <!-- ad end -->

    <section>
        <div class="row DMarginTop20">
            <div class="col-sm-12 DMoreNewsImg">
                <div class="DHeadTop border_bottom">এই বিভাগের জনপ্রিয়</div>
                @forelse ($related_popular_news as $news)
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a>
                        </div>
                        <div class="col-sm-8"><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></div>
                    </div>
                @empty
                    <p>দুঃখিত, কোনো নিউজ পাওয়া যায়নি।</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
