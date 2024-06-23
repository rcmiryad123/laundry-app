@extends('layouts.master')
@section('title')
    Orders
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Orders
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            + Add Order
                        </button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="table-gridjs"></div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <!--  Add Order -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> + Add Order </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('orders.add') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="customer" class="form-label">Nama Pemesanan</label>
                                    <input type="text" class="form-control" id="customer" name="customer" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="total_berat" class="form-label">Total Berat (Kg)</label>
                                    <input type="number" class="form-control" id="total_berat" step="any"
                                        name="total_berat" required>
                                </div>
                                <div class="col-12">
                                    <label for="paket" class="form-label">Paket</label>
                                    <select id="paket" class="form-select" name="paket" required>
                                        <option selected>Pilih Paket</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Regular++">Regular++</option>
                                        <option value="Express 1">Express 1</option>
                                        <option value="Express 2">Express 2</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="jenis_proses" class="form-label">Jenis Proses</label>
                                    <select id="jenis_proses" class="form-select" name="jenis_proses" required>
                                        <option value="-" selected> - </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="pembayaran" class="form-label">Pembayaran</label>
                                    <select id="pembayaran" class="form-select" name="pembayaran" required>
                                        <option selected>Pilih Pembayaran</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Qris">Qris</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <!-- gridjs js -->
        <script>
            new gridjs.Grid({
                columns: [
                    "#",
                    "Customer",
                    "Paket",
                    "Status",
                    "Order Created",
                    "Deadline",
                    {
                        name: "Action",
                        formatter: (cell, row) => gridjs.html(cell)
                    }
                ],
                pagination: {
                    limit: 25
                },
                search: true,
                server: {
                    url: '{{ route('orders.json') }}',
                    then: data => {
                        if (data && Array.isArray(data.orders)) {
                            return data.orders.map(order => {

                                let now = new Date();

                                let createdDate = new Intl.DateTimeFormat('id-ID', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }).format(new Date(order.created_at));

                                let deadlineDate = new Intl.DateTimeFormat('id-ID', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }).format(new Date(order.dead_line));

                                let nowDate = new Intl.DateTimeFormat('id-ID', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }).format(new Date());

                                let tomorrow = new Date(now);
                                tomorrow.setDate(tomorrow.getDate() + 1);  // Add 1 day

                                let tomorrowDate = new Intl.DateTimeFormat('id-ID', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }).format(new Date(tomorrow));

                                let status;
                                if (order.status == "Belum Selesai") {
                                    status = gridjs.html(`<div class="badge p-2 rounded bg-danger fw-bold text-center text-white">${order.status}</div>`);
                                } else {
                                    status = gridjs.html(`<div class="badge p-2 rounded bg-success fw-bold text-center text-white">${order.status}</div>`);
                                }

                                let deadLine;
                                if (deadlineDate <= nowDate && order.status == "Belum Selesai") {
                                    deadLine = gridjs.html(`<div class="badge p-2 rounded bg-danger fw-bold text-center text-white">${deadlineDate}</div>`);
                                }
                                else if (deadlineDate == tomorrowDate && order.status == "Belum Selesai")
                                {
                                    deadLine = gridjs.html(`<div class="badge p-2 rounded bg-warning fw-bold text-center text-white">${deadlineDate}</div>`);
                                }
                                else {
                                    deadLine = gridjs.html(`<div class="badge p-2 rounded bg-success fw-bold text-center text-white">${deadlineDate}</div>`);
                                }


                                return [
                                    '#' + order.id,
                                    order.customer,
                                    order.jenis_layanan,
                                    status,
                                    createdDate,
                                    deadLine,
                                    `<a href="/order/${order.id}" class="btn btn-primary">Details</a>`
                                ];
                            });
                        } else {
                            console.error("Data format is incorrect or 'orders' is not an array.");
                            return [];
                        }
                    },
                    handle: (res) => {
                        if (!res.ok) {
                            console.error("Server error:", res);
                        }
                        return res.json();
                    }
                }
            }).render(document.getElementById("table-gridjs"));
        </script>

        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/ecommerce-orders.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
