@extends('layouts.master')

@section('title', 'On Going Order')

@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('page-title', 'On Going Order')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="table-gridjs"></div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
@endsection

@section('scripts')
    <!-- gridjs js -->
    <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

    <script>
        function finishOrder(orderId) {
            // Kirim AJAX request untuk menandai order sebagai selesai
            fetch(`/order/finish/${orderId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan token CSRF disertakan
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Refresh halaman atau perbarui data grid jika berhasil
                        window.location
                    .reload(); // Anda bisa menggunakan cara lain untuk memperbarui data grid tanpa perlu reload halaman
                    } else {
                        throw new Error('Failed to finish order.');
                    }
                })
                .catch(error => {
                    console.error('Error finishing order:', error);
                    // Tampilkan pesan error kepada pengguna jika diperlukan
                });
        }

        function confirmFinishOrder(orderId) {
            // Tampilkan alert konfirmasi sebelum menyelesaikan order
            if (confirm('Apakah Anda yakin ingin menyelesaikan order ini?')) {
                finishOrder(orderId);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {

            new gridjs.Grid({
                columns: ['ID', 'Customer', 'Service Type', 'Status', 'Deadline', 'Process Type',
                    'Total Weight', {
                        name: 'Action',
                        formatter: (cell, row) => gridjs.html(
                            `<button class="btn btn-success" onclick="confirmFinishOrder(${row.cells[0].data})">Finish</button>`
                            )
                    }
                ],
                server: {
                    url: '/orders',
                    then: data => data.map(order => [
                        order.id,
                        order.billing_name,
                        order.package,
                        order.status,
                        order.dead_line,
                        order.process_method,
                        order.total_kilos
                    ])
                },
                pagination: true,
                search: true,
                sort: true,
                language: {
                    'search': {
                        'placeholder': 'Search Orders...'
                    }
                }
            }).render(document.getElementById('table-gridjs'));

        });
    </script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
