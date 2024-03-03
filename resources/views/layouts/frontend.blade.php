<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ isset($page_title) ? $page_title . ' | ' . $settings->site_name : $settings->site_name . ' | ' . $settings->site_tagline }}</title>

    <meta name="author" content="{{ $settings->site_name }}">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="googlebot-news" content="index, follow">

    <meta property="og:site_name" content="{{ $settings->site_name }}">
    <meta property="og:title" content="{{ isset($page_title) ? $page_title . ' | ' . $settings->site_name : $settings->site_name . ' | ' . $settings->site_tagline }}">
    <meta property="og:description" content="{{ Route::currentRouteName() == 'news' ? strip_tags(html_entity_decode(limitString($news->content, 160))) : $settings->site_tagline }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{ Route::currentRouteName() == 'news' ? asset('uploads/news/' . $news->featured_image) : asset('uploads/news/default.jpg') . '?v=' . now()->timestamp }}">
    <meta property="og:locale" content="bn_BD">

    <style>
        :root {
            --rh-primary-color: {{ $settings->site_primary_color }};
            --rh-primary-accent-color: {{ $settings->site_accent_color }};
            --rh-secondary-color: {{ $settings->site_secondary_color }};
            --rh-secondary-accent-color: {{ $settings->site_secondary_accent_color }};
        }
    </style>

    <link rel="canonical" href="{{ url()->current() }}">
    <link type="image/x-icon" rel="shortcut icon" href="{{ asset("uploads/logos/$settings->favicon") . '?v=' . now()->timestamp }}">
    <link type="image/x-icon" rel="icon" href="{{ asset("uploads/logos/$settings->favicon") . '?v=' . now()->timestamp }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/bootstrap/3.3.7/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/vendor/font-awsome-6.5.1-pro/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css?v=' . $settings->version) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/SolaimanLipi.css') }}">
    @stack('style')
</head>

<body>
    <div class="container">
        @include('sections.frontend.header')

        @yield('content')

        @include('sections.frontend.footer')

    </div>


    <div class="Back-up-top">
        <a id="back-to-top" href="#" class="btn btn-danger back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
    </div>

    <script type="text/javascript" src="{{ asset('assets/frontend/jquery/2.2.4/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/frontend/js/script.js') }}"></script>
    @stack('script')
</body>

</html>
