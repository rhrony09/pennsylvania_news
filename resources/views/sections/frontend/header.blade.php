<header>
    <div class="DHeaderTop">
        <div class="row">
            <div class="col-sm-6 DHeaderDate">
                <p>পেনসিলভানিয়া, {{ bangla_date(time(), 'en') }} | {{ bangla_date(time()) }}</p>
            </div>
            <div class="col-sm-3 DHeaderSearch">
                <form class="navbar-form navbar-right" action="{{ route('archives') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request()->search }}" required>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-3 DSocialLink">
                <ul>
                    @foreach ($social_medias->whereNotNull('link') as $social_media)
                        <li>
                            <a href="{{ $social_media->link }}" target="_blank"><i class="fa-brands {{ $social_media->icon }}"></i></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="DLogo"><a href="{{ route('index') }}"><img src="{{ asset("uploads/logos/$settings->logo_dark") }}" alt="{{ $settings->site_name }}" title="{{ $settings->site_name }}" class="img-responsive"></a></div>
        </div>
    </div>

    <div class="row DHeaderNav">
        <div class="col-sm-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid DPadding0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">প্রচ্ছদ</a></li>
                            @foreach ($news_categories as $category)
                                @if ($loop->iteration <= 8)
                                    <li class="nav-item"><a class="nav-link" href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                                @endif
                            @endforeach
                            @if ($news_categories->count() > 8)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">অন্যান্য <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @foreach ($news_categories as $category)
                                            @if ($loop->iteration > 8)
                                                <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            <li><a href="{{ route('ads') }}">বিজ্ঞাপন</a></li>
                            <li><a href="{{ route('archives') }}">আর্কাইভ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="row DMargin0 DScroll DMarginBottom10">
        <div class="col-sm-1 DPadding0">সর্বশেষ:</div>
        <div class="col-sm-11 DPadding0">
            <marquee direction="left" speed="normal" scrollamount="4" behavior="loop" onmouseover="this.stop();" onmouseout="this.start();">
                @foreach ($latest_news->take(15) as $news)
                    <span><i class="fa fa-square"></i> {{ $news->title }}</span><span>
                @endforeach
            </marquee>
        </div>
    </div>
</header>
