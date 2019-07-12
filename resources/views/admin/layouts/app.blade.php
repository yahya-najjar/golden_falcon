<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>لوحة التحكم - @yield('title')</title>
    @include('admin.layouts.meta')
    <style>
        @font-face {
            font-family: Niramit;
            src: url({{ asset('assets/fonts/Niramit-Regular.ttf') }});

        }

        @font-face {
            font-family: Tajawal;
            src: url({{ asset('assets/fonts/Tajawal-Medium.ttf') }});

        }

        h1,h2,h3,h4,h5,h6,p,div,strong,span,body{
            font-family: Niramit, Tajawal, serif !important;
        }
    </style>
    @yield('style')
</head>

<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">GoldenFalcon</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">

@include('admin.layouts.topbar')
@include('admin.layouts.sidebar')


<!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">@yield('title')</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">الرئيسية</a></li>
                        @yield('bread')
                    </ol>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @include('admin.layouts.alerts')
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

        @yield('content')
        <!-- ============================================================== -->


        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-right"> 2018 Swear Khaddaj ©</footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

@include('admin.layouts.scripts')
@yield('script')
<script>
    // $(document).ready(function () {
    //     setTimeout(function () {
    //         $('body').addClass('mini-sidebar')
    //         $('#textlogo').hide();
    //     },10)
    // })
</script>
</body>

</html>