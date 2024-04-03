@extends('layouts.frontend')

@section('content')
    <main class="DMarginBottom20">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('index') }}"><i class="fa fa-home fa-lg" aria-hidden="true"></i> প্রচ্ছদ</a></li>
                            <li class="active"><a href="{{ route('category', $category->name) }}">{{ $category->name }}</a></li>
                        </ol>
                    </div>
                </div>

                <section>
                    @forelse ($all_news as $news)
                        @if ($loop->iteration == 1)
                            <div class="row DCategoryTopNews">
                                <div class="col-sm-12">
                                    <a href="{{ route('news', $news->slug) }}">
                                        <h1>{{ $news->title }}</h1>
                                    </a>
                                </div>
                                <div class="col-sm-5">
                                    <a href="{{ route('news', $news->slug) }}">
                                        <p>{!! explode('<img', limitString($news->content, 280))[0] !!}</p>
                                    </a>
                                </div>
                                <div class="col-sm-7">
                                    <a href="{{ route('news', $news->slug) }}">
                                        <img src="{{ asset('uploads/news/' . $news->featured_image) . '?v=' . now()->timestamp }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                    </a>
                                </div>
                            </div>
                            <div class="row DMarginTop20">
                            </div>
                        @else
                            <div class="DCategoryListNews">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="{{ route('news', $news->slug) }}">
                                            <img src="{{ asset('uploads/news/' . $news->featured_image) . '?v=' . now()->timestamp }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100">
                                        </a>
                                    </div>
                                    <div class="col-sm-8">
                                        <a href="{{ route('news', $news->slug) }}">
                                            <h3 class="H3Head">{{ $news->title }}</h3>
                                        </a>
                                        <p>{!! explode('<img', limitString($news->content, 160))[0] !!}</p>
                                        <p class="DDate">{{ convertTimeToBangla($news->created_at->format('h:i A')) }}, {{ bangla_date($news->created_at->timestamp, 'en') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <h3>দুঃখিত, কোনো নিউজ পাওয়া যায়নি।</h3>
                    @endforelse
                </section>

                <div class="row MarginTop20">

                    <div class="col-sm-12">
                        {{ $all_news->links() }}
                    </div>
                </div>
            </div>

            <!--RightSide-->
            @include('sections.frontend.sidebar')
        </div>
    </main>
@endsection
