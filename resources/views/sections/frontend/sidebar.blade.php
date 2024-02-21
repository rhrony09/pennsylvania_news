<div class="col-sm-4">
    <!-- ad start -->
    <div class="row DMarginTop10">
        <div class="col-sm-12">
            <img src="{{ asset('uploads/ads/ad-placeholder-360x280.jpg') }}" alt="ad" title="ad" class="img-responsive img100">
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
            <img src="{{ asset('uploads/ads/ad-placeholder-360x280.jpg') }}" alt="ad" title="ad" class="img-responsive img100">
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
