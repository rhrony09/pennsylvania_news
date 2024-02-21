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
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    </div>

                    <div class="row DMarginT30">
                        <div class="col-sm-12">
                            <div class="fb-comments fb_iframe_widget fb_iframe_widget_fluid_desktop" data-href="https://www.ajkalusa.com/সুখবর-দিলেন-মেহজাবিন/26060" data-numposts="3" fb-xfbml-state="rendered"
                                fb-iframe-plugin-query="app_id=1782035548574884&amp;container_width=750&amp;height=100&amp;href=https%3A%2F%2Fwww.ajkalusa.com%2F%25E0%25A6%25B8%25E0%25A7%2581%25E0%25A6%2596%25E0%25A6%25AC%25E0%25A6%25B0-%25E0%25A6%25A6%25E0%25A6%25BF%25E0%25A6%25B2%25E0%25A7%2587%25E0%25A6%25A8-%25E0%25A6%25AE%25E0%25A7%2587%25E0%25A6%25B9%25E0%25A6%259C%25E0%25A6%25BE%25E0%25A6%25AC%25E0%25A6%25BF%25E0%25A6%25A8%2F26060&amp;locale=en_US&amp;numposts=3&amp;sdk=joey&amp;version=v3.0&amp;width=550">
                                <span style="vertical-align: bottom; width: 550px; height: 215px;"><iframe name="f4e6b23d3f5a4f904" width="550px" height="100px" data-testid="fb:comments Facebook Social Plugin" title="fb:comments Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media"
                                        src="https://www.facebook.com/v3.0/plugins/comments.php?app_id=1782035548574884&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df83195053c6e85016%26domain%3Dwww.ajkalusa.com%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fwww.ajkalusa.com%252Ff1c75f45408f9a567%26relation%3Dparent.parent&amp;container_width=750&amp;height=100&amp;href=https%3A%2F%2Fwww.ajkalusa.com%2F%25E0%25A6%25B8%25E0%25A7%2581%25E0%25A6%2596%25E0%25A6%25AC%25E0%25A6%25B0-%25E0%25A6%25A6%25E0%25A6%25BF%25E0%25A6%25B2%25E0%25A7%2587%25E0%25A6%25A8-%25E0%25A6%25AE%25E0%25A7%2587%25E0%25A6%25B9%25E0%25A6%259C%25E0%25A6%25BE%25E0%25A6%25AC%25E0%25A6%25BF%25E0%25A6%25A8%2F26060&amp;locale=en_US&amp;numposts=3&amp;sdk=joey&amp;version=v3.0&amp;width=550"
                                        style="border: none; visibility: visible; width: 550px; height: 215px;" class=""></iframe></span>
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
    <script type="text/javascript">
        $(function() {
            $("#btnIncrease").click(function() {
                $(".DDetailsBody").children().each(function() {
                    var size = parseInt($(this).css("font-size"));
                    size = size + 1 + "px";
                    $(this).css({
                        'font-size': size
                    });
                });
            });
        });
        $(function() {
            $("#btnOriginal").click(function() {
                $(".DDetailsBody").children().each(function() {
                    $(this).css({
                        'font-size': '18px'
                    });
                });
            });
        });
        $(function() {
            $("#btnDecrease").click(function() {
                $(".DDetailsBody").children().each(function() {
                    var size = parseInt($(this).css("font-size"));
                    size = size - 1 + "px";
                    $(this).css({
                        'font-size': size
                    });
                });
            });
        });
    </script>
@endpush
