<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">
    @include('layouts.head')
<body>
    <div id="app">
        <common-header></common-header>
        <router-view></router-view>
        <notifications group="foo" />
        <common-footer></common-footer>
    </div>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/vendor/jquery/jquery.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/vendor/php-email-form/validate.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/vendor/aos/aos.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/vendor/jquery-sticky/jquery.sticky.js"></script>

    <!-- Template Main JS File -->
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/js/main.js"></script>

    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}public/front/js/common.js"></script>

    <script src="{{ url('public/js/app.js')}}"></script>
</body>
</html>
