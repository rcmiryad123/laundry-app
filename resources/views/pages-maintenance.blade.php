@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Dashboard
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex flex-column min-vh-100">
                            <div class="my-auto py-5">
                                <div class="text-center mb-4 pb-1">
                                    <a href="index" class="d-block auth-logo">
                                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="36"
                                            class="auth-logo-dark">
                                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="36"
                                            class="auth-logo-light">
                                    </a>
                                </div>
                                <div class="row align-items-center justify-content-center">
                                    <!-- end col -->
                                    <div class="col-md-5">
                                        <div class="mt-4">
                                            <img src="{{ URL::asset('build/images/maintenance.png') }}" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="text-center text-muted my-5">
                                    <h4>Site is Under Maintenance</h4>
                                    <p>Please check back in sometime.</p>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-primary">01.</h5>
                                                <h5 class="font-size-16 text-uppercase mt-3">Why is the Site Down?</h5>
                                                <p class="text-muted mb-0">There are many variations of passages of
                                                    Lorem Ipsum available, but the majority have suffered alteration.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-primary">02.</h5>
                                                <h5 class="font-size-16 text-uppercase mt-3">
                                                    What is the Downtime?</h5>
                                                <p class="text-muted mb-0">Contrary to popular belief, Lorem Ipsum is not
                                                    simply random text. It has roots in a piece of classical.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-primary">03.</h5>
                                                <h5 class="font-size-16 text-uppercase mt-3">
                                                    Do you need Support?</h5>
                                                <p class="text-muted mb-0">If you are going to use a passage of Lorem
                                                    Ipsum, you need to be sure there isn't anything embar..
                                                    <a href="mailto:no-reply@domain.com"
                                                        class="text-decoration-underline">no-reply@domain.com</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end authentication section -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Vector map-->
        <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
