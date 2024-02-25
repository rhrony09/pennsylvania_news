@extends('layouts.frontend')

@section('content')
    <main class="DMarginBottom20">
        <section>
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-8">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('index') }}"><i class="fa fa-home fa-lg" aria-hidden="true"></i> হোম</a></li>
                                <li class="active"><a href="{{ route('category', $news->category->slug) }}">{{ $news->category->name }}</a></li>
                            </ol>
                        </div>
                        <div class="col-sm-4">
                            <p class="text-right"><i class="fa fa-eye"></i> {{ $news->view_count }}</p>
                        </div>
                    </div>

                    <div class="row DDetailsNews">
                        <div class="col-sm-12">
                            <h1>{{ $news->title }}</h1>

                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="pWriter">নিউজ ডেস্ক</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-7 DDateDetails">
                                    <p>
                                        প্রকাশিত: {{ convertTimeToBangla($news->created_at->format('h:i A')) }}, {{ bangla_date($news->created_at->timestamp, 'en') }}
                                    </p>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <button id="btnDecrease">A-</button>
                                    <button id="btnOriginal">A</button>
                                    <button id="btnIncrease">A+</button>
                                </div>
                            </div>

                            <div class="DAdditionalInfo"></div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{ asset('uploads/news/' . $news->featured_image) }}" alt="" title="{{ $news->title }}" class="img-responsive img100">
                                </div>
                            </div>
                            <div class="row DMarginTop20">
                                <div class="col-sm-12 DDetailsBody" id="DDetailsBody">
                                    {!! $news->content !!}
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 DSocialBottom">
                            <!-- AddToAny Share Buttons -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_linkedin"></a>
                                <a class="a2a_button_pinterest"></a>
                            </div>
                        </div>
                    </div>

                    <div class="row DMarginT30">
                        <div class="col-sm-12">
                            <h3>মন্তব্যঃ</h3>
                            @forelse ($news->comments as $comment)
                                <div class="comment">
                                    <p><strong>{{ $comment->user_id ? $comment->user->name : $comment->name }}</strong> বলেছেন, <small>{{ convertTimeToBangla($comment->created_at->format('h:i A')) }}, {{ bangla_date($comment->created_at->timestamp, 'en') }}</small></p>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            @empty
                                <p>দুঃখিত, কোন মন্তব্য পাওয়া যায়নি!</p>
                            @endforelse
                        </div>
                        <div class="col-sm-12 DMarginT30">
                            <div class="card">
                                <h4>নতুন মন্তব্য করুন:</h4>
                                <div id="form-response"></div>
                                <form id="comment-form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $news->id }}">
                                    @if (!auth()->check())
                                        <div class="form-group">
                                            <label for="name">আপনার নাম:</label>
                                            <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                                        </div>
                                    @endif
                                    <div class="form-group DMargin0">
                                        <label for="name">মন্তব্য লিখুন:</label>
                                        <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">সাবমিট</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--RightSide-->
                @include('sections.frontend.sidebar')
            </div>
        </section>
    </main>
@endsection

@push('script')
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <script type="text/javascript">
        $('#comment-form').submit(function(e) {
            $('#form-errors').html('');
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('comment') }}",
                data: $(this).serialize(),
                success: function(response) {
                    let html = `<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>` + response.message + `</div>`;
                    $('#form-response').html(html);
                    $('#comment-form').trigger("reset");
                    if (response.status == 'Approved') {
                        window.location.reload();
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    let errorsHtml = `<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul>`;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                    } else {
                        errorsHtml += '<li>' + response.responseJSON.message + '</li>';
                    }
                    errorsHtml += '</ul></div>';

                    $('#form-response').html(errorsHtml);
                }
            });
        });

        $("#btnIncrease").click(function() {
            $(".DDetailsBody").children().each(function() {
                var size = parseInt($(this).css("font-size"));
                size = size + 1 + "px";
                $(this).css({
                    'font-size': size
                });
            });
        });

        $("#btnOriginal").click(function() {
            $(".DDetailsBody").children().each(function() {
                $(this).css({
                    'font-size': '18px'
                });
            });
        });

        $("#btnDecrease").click(function() {
            $(".DDetailsBody").children().each(function() {
                var size = parseInt($(this).css("font-size"));
                size = size - 1 + "px";
                $(this).css({
                    'font-size': size
                });
            });
        });
    </script>
@endpush
