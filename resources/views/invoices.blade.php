@extends('layouts.master')
@section('title')
    Invoice Detail
@endsection
@section('page-title')
    Invoice Detail
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Invoice #{{ $order->id }} <span
                                    class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                            <div class="mb-4">
                                <img src="{{ URL::asset('build/images/logo-dark-sm.png') }}" alt="logo" height="34" />
                            </div>
                            <div class="text-muted">
                                <p class="mb-1"> Universitas Buana Perjuangan Karawang </p>
                                <p class="mb-1"> Kelompok 19 </p>
                                <p> Teknik Informatika </p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                    <h5 class="font-size-15 mb-2">{{ $order->customer }}</h5>
                                    <p>001-234-5678</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p> #{{ $order->id }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p>{{ $order->created_at->format('Y-m-d') }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Order No:</h5>
                                        <p>#{{ $order->id }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold" style="width: 70px;">No.</th>
                                            <th class="fw-bold">Item</th>
                                            <th class="fw-bold">Price</th>
                                            <th class="fw-bold">Quantity</th>
                                            <th class="text-end fw-bold" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1">{{ $order->jenis_layanan }}</h5>
                                                    <p class="text-muted mb-0">
                                                        Setrika : {{ $paketLaundry->setrika }} <br>
                                                        Waktu Proses : {{ $paketLaundry->lama_pelayanan }} Jam
                                                    </p>
                                                </div>
                                            </td>
                                            <td>IDR {{ number_format($paketLaundry->harga_per_kg) }}/Kg</td>
                                            <td>{{ $order->total_berat }}Kg</td>
                                            <td class="text-end">IDR {{ number_format($order->total_berat * $paketLaundry->harga_per_kg) }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        {{--  <tr>
                                            <th scope="row" colspan="4" class="text-end fw-bold">Sub Total</th>
                                            <td class="text-end">$732.50</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end fw-bold">
                                                Discount :</th>
                                            <td class="border-0 text-end">- $25.50</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end fw-bold">
                                                Shipping Charge :</th>
                                            <td class="border-0 text-end">$20.00</td>
                                        </tr>
                                        <!-- end tr -->  --}}
                                        {{--  <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end fw-bold">
                                                Tax</th>
                                            <td class="border-0 text-end">$12.00</td>
                                        </tr>
                                        <!-- end tr -->  --}}
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end fw-bold">Total</th>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0 fw-semibold">IDR {{ number_format($order->total_berat * $paketLaundry->harga_per_kg) }}</h4>
                                            </td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                            class="fa fa-print"></i></a>
                                    <a href="#" class="btn btn-primary w-md">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
