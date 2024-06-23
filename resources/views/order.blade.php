@extends('layouts.master')
@section('title')
    Order Detail
@endsection
@section('css')
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('page-title')
    Order Detail
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="mt-3 mt-xl-3 ps-xl-5">

                                    <h4 class="font-size-20 mb-3">
                                        <a href="{{ route('orders.index') }}"> &#9665; Back</a><br><br>
                                        {{ $order->customer }} - {{ $paketLaundry->nama_paket }}
                                    </h4>

                                    <h2 class="text-primary mt-4 py-2 mb-0">
                                        IDR
                                        {{ number_format($order->total_berat * $paketLaundry->harga_per_kg) }}
                                    </h2>


                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Specification :</h5>
                                                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                <i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                {{ $order->total_berat }} Kg
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                <i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                IDR {{ number_format($paketLaundry->harga_per_kg) }}/kg
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                <i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                @if ($paketLaundry->lipat_rapi == 1)
                                                                    Lipat dengan Rapi
                                                                @else
                                                                    Tidak dilipat
                                                                @endif
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p class="text-muted mb-1 text-truncate">
                                                                <i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                @if ($paketLaundry->setrika == 1)
                                                                    Disetrika
                                                                @else
                                                                    Tidak Disetrika
                                                                @endif
                                                            </p>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Tanggal Pemesanan :</h5>
                                                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                                                        <li>
                                                            <p class="text-primary fw-bold mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-primary me-1"></i>
                                                                {{ $order->created_at->format('Y-m-d') }} </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="font-size-14">Tanggal Pengembalian :</h5>
                                                    <ul class="list-unstyled ps-0 mb-0 mt-3">
                                                        <li>
                                                            <p class="fw-bold text-danger mb-1 text-truncate"><i
                                                                    class="mdi mdi-circle-medium align-middle text-danger me-1"></i>
                                                                {{ $order->dead_line}} </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6 col-sm-8">
                                                <form action="{{ route('orders.finished', $order->id) }}">
                                                    <div class="row text-center mt-4 pt-1">
                                                        <div class="col-sm-6">
                                                            <div class="d-grid">
                                                                @if ($order->status == 'Selesai')

                                                                @else
                                                                <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light mt-2 me-1">
                                                                    Order Completed
                                                                </button>
                                                                @endif
                                                                <a href="{{ route('invoices.details', $order->id) }}" class="btn btn-primary" target="_blank">Invoice</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>


            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- swiper js -->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/ecommerce-Order-detail.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
