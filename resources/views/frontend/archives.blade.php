@extends('layouts.frontend')

@section('content')
    <main class="DMarginBottom20">
        <div class="row">
            <div class="col-sm-8 paddingLeft0">

                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}"><i class="fa fa-home fa-lg Golden" aria-hidden="true"></i></a></li>
                    <li class="active"><a href="{{ route('archives') }}">আর্কাইভস</a></li>
                </ol>

                <div class="row">
                    <div class="col-sm-12 MarginTop20 text-center">
                        <form id="archive-form" action="{{ route('archives') }}" class="form-inline">
                            <div class="form-group">
                                <select name="category" class="form-control cboCatName">
                                    <option value="">সকল খবর</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group DMarginLeft10">
                                <label for="date"> তারিখ:</label>
                                <input type="text" name="date" id="date" class="form-control" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary btnSearch">খুঁজুন</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        @forelse ($all_news as $news)
                            <div class="DCategoryListNews MarginTop20">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a class="btn btn-success btnCatName" href="{{ route('news', $news->category->slug) }}">{{ $news->category->name }}</a>
                                        <a href="{{ route('news', $news->slug) }}"><img src="{{ asset('uploads/news/' . $news->featured_image) . '?v=' . now()->timestamp }}" alt="{{ $news->title }}" title="{{ $news->title }}" class="img-responsive img100"></a>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><a href="{{ route('news', $news->slug) }}"></a></p>
                                        <h3><a href="{{ route('news', $news->slug) }}">{{ $news->title }}</a></h3>
                                        <p>{!! limitString($news->content, 160) !!}</p>
                                        <p class="DDate">{{ convertTimeToBangla($news->created_at->format('h:i A')) }}, {{ bangla_date($news->created_at->timestamp, 'en') }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3>দুঃখিত, কোনো নিউজ পাওয়া যায়নি।</h3>
                        @endforelse
                    </div>
                </div>

                <div class="row MarginTop20">
                    <div class="col-sm-4">
                        {{ $all_news->links() }}
                    </div>
                </div>
            </div>

            <!--RightSide-->
            @include('sections.frontend.sidebar')
        </div>
    </main>
@endsection

@push('script')
    <link rel="stylesheet" href="{{ asset('assets/frontend/jquery-ui/jquery-ui.css') }}">
    <script type="text/javascript" src="{{ asset('assets/frontend/jquery-ui/jquery-ui.js') }}"></script>
    <script type="text/javascript">
        $("#date").datepicker({
            changeMonth: true,
            changeYear: true,
        });
        $("#date").datepicker("option", "dateFormat", "yy-mm-dd");
        $("#date").datepicker("setDate", "{{ request()->date }}");
    </script>
@endpush
