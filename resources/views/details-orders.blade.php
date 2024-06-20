@extends('layouts.master')

@section('title', 'Orders')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <div class="modal-button mt-2">
                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                data-bs-toggle="modal" data-bs-target=".add-new-order">
                                <i class="mdi mdi-plus me-1"></i> Add New Order
                            </button>
                        </div>
                    </div>
                    <div id="table-ecommerce-orders"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- Extra Large modal example -->
    <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Add New Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" id="order-date" style="display: none;">

                                    <label class="form-label" for="AddOrder-Product">Pilih Paket</label>
                                    <select class="form-select" name="package">
                                        <option selected disabled> Pilih Paket </option>
                                        <option value="paket-1">Paket 1 - Rp. 10.000/kg</option>
                                        <option value="paket-2">Paket 2 - Rp. 20.000/kg</option>
                                        <option value="paket-3">Paket 3 - Rp. 30.000/kg</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Nama Pemesan</label>
                                    <input type="text" class="form-control" placeholder="Masukan Nama Pemesan"
                                        id="AddOrder-Billing-Name" name="billing_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-TotalKilos">Total Berat</label>
                                    <input type="number" class="form-control" placeholder="6.86 kg"
                                        id="AddOrder-TotalKilos" name="total_kilos">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Payment-Method">Metode Pembayaran</label>
                                    <select class="form-select" name="payment_method">
                                        <option selected disabled> Pilih Metode Pembayaran </option>
                                        <option value="cash">Cash</option>
                                        <option value="qris">QRIS</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Process-Method">Metode Proses</label>
                                    <select class="form-select" name="process_method">
                                        <option selected disabled> Pilih Metode Proses </option>
                                        <option value="express">Express</option>
                                        <option value="normal">Normal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" id="btn-save-event"><i
                                        class="bx bx-check me-1"></i> Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Modal Detail Order from Table -->
    <div class="modal fade orderdetailsModalTable" id="orderdetailsModalTable" tabindex="-1" role="dialog"
        aria-labelledby="orderdetailsModalLabelTable" aria-hidden="true">
        <!-- Isi modal detail order dari tabel di sini -->
    </div>
    <!-- end modal -->

    <!-- Modal Detail Order from showOrderDetails Function -->
    <div class="modal fade orderdetailsModal" id="orderdetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
        <!-- Isi modal detail order dari fungsi showOrderDetails di sini -->
    </div>
    <!-- end modal -->
@endsection

@section('scripts')

    <!-- gridjs js -->
    <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

    <script>
        function formatCreatedAt(created_at) {
            const date = new Date(created_at);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return date.toLocaleDateString('id-ID', options); // Sesuaikan dengan locale yang sesuai
        }

        function formatPackage(packageName) {
            // Pisahkan string berdasarkan tanda dash "-"
            const parts = packageName.split('-');

            // Ubah bagian pertama menjadi huruf kapital dan tambahkan spasi
            parts[0] = parts[0].charAt(0).toUpperCase() + parts[0].slice(1) + ' -';

            // Gabungkan kembali dengan tanda hubung "-"
            const formattedPackage = parts.join(' ');

            return formattedPackage;
        }

        function showOrderDetails(orderId) {
            fetch(`/orders/${orderId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        return;
                    }

                    const modalBody = document.getElementById('orderdetailsModal');

                    // Format created_at menggunakan fungsi formatCreatedAt
                    const formattedCreatedAt = formatCreatedAt(data.created_at);
                    const formattedDeadline = formatCreatedAt(data.dead_line);
                    const formattedPackage = formatPackage(data.package);

                    modalBody.innerHTML = `
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Order #${data.id}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <ol class="list-group list-group-numbered">
                                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Pemesan</div>
                                                                ${data.billing_name}
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Tanggal Pemesanan</div>
                                                                ${formattedCreatedAt}
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Jenis Laundry</div>
                                                                ${data.process_method}
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Jenis Pembayaran</div>
                                                                ${data.payment_method}
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Status</div>
                                                                ${data.status}
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                                            <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Tanggal proses terakhir</div>
                                                                ${formattedDeadline}
                                                            </div>
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="list-group">
                                                        <div class="list-group-item active fw-bold" aria-current="true">
                                                            ${formattedPackage}
                                                        </div>
                                                        <div class="list-group-item ">A second item</div>
                                                        <div class="list-group-item ">A third div item</div>
                                                        <div class="list-group-item ">A fourth div item</div>
                                                        <div class="list-group-item ">A disabled div item</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    `;

                    var orderDetailsModal = new bootstrap.Modal(document.getElementById('orderdetailsModal'));
                    orderDetailsModal.show();
                })
                .catch(error => {
                    console.error('Error fetching order details:', error);
                    alert('Error fetching order details. Please try again later.');
                });
        }


        document.addEventListener("DOMContentLoaded", function() {
            new gridjs.Grid({
                columns: [
                    "No. Order",
                    "Status",
                    "Pemesan",
                    {
                        name: "Actions",
                        width: "6.25rem",
                        formatter: (cell) => gridjs.html(
                            `<button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="showOrderDetails(${cell})">
                                Order Details
                            </button>`
                        )
                    }
                ],
                server: {
                    url: '/all-orders',
                    then: data => data.map(order => [
                        '#' + order.id,
                        order.status,
                        order.billing_name,
                        order.id // Untuk mengirimkan ID order ke fungsi showOrderDetails
                    ])
                },
                pagination: {
                    limit: 25,
                },
                sort: true,
                search: true,
            }).render(document.getElementById("table-ecommerce-orders"));
        });
    </script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
