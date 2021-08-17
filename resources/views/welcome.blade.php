<!DOCTYPE html>
<html class="fixed">
    <head>
        @include('layouts.shared/title-meta')
        @include('layouts.shared/head-css')
        <script>
            (function () {
                window.Laravel = {
                    csrfToken: '{{csrf_token()}}'
                }
            })()
        </script>
    </head>
    <body>
        <div id="app">
            <mainapp></mainapp>
        </div>

        <script src="{{mix('/js/app.js')}}"></script>

        <script src="{{asset('assets/vendor/jquery/jquery.js')}}"></script>
        <script src="{{asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
        <script src="{{asset('assets/vendor/jquery-cookie/jquery.cookie.js')}}"></script>
        <script src="{{asset('assets/master/style-switcher/style.switcher.js')}}"></script>
        <script src="{{asset('assets/vendor/popper/umd/popper.min.js')}}"></script>
        <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/vendor/common/common.js')}}"></script>
        <script src="{{asset('assets/vendor/nanoscroller/nanoscroller.js')}}"></script>
        <script src="{{asset('assets/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
        <script src="{{asset('assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>
        <script src="{{asset('assets/js/theme.js')}}"></script>
        <script src="{{asset('assets/js/custom.js')}}"></script>
        <script src="{{asset('assets/js/theme.init.js')}}"></script>

    </body>
</html>
