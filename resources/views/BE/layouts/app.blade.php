<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="_token" content="{{csrf_token()}}" />

    <title>@yield('title') &mdash; Techno Wizard</title>
    @notifyCss

    <!-- General CSS Files -->
    @include('BE.layouts.style')

    @stack('style')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            <span style=" position: absolute;z-index: 1000000;">
                @include('notify::components.notify')
            </span>            <!-- Header -->
            @include('BE.components.header')

            <!-- Sidebar -->
            @include('BE.components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('BE.components.footer')
        </div>
    </div>

    <x-notify::notify />
    @notifyJs
    @include('BE.layouts.script')

    @stack('scripts')
</body>

</html>
