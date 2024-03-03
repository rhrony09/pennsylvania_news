@extends('layouts.frontend')

@section('content')
    <main class="DMarginBottom20">
        <section>
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('index') }}"><i class="fa fa-home fa-lg" aria-hidden="true"></i> হোম</a></li>
                                <li class="active"><a href="{{ route('video.gallery') }}">ভিডিও গ্যালারি</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="row DDetailsNews">
                        <div class="col-sm-12">
                            <h1>{{ $video->title }}</h1>

                            <div class="row">
                                <div class="col-sm-7 DDateDetails">
                                    <p>
                                        প্রকাশিত: {{ convertTimeToBangla($video->created_at->format('h:i A')) }}, {{ bangla_date($video->created_at->timestamp, 'en') }}
                                    </p>
                                </div>
                            </div>

                            <div class="row DPaddingTop20">
                                <div class="col-sm-12 ">
                                    <div class="embed-responsive embed-responsive-16by9 DMarginBottom20">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->video_link }}" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
                                    </div>
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
