@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar {{ $title }}</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content_container" class="app-container container-xxl">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle" style="margin-right: 9px;color: #0f5132!important;"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-times-circle" style="margin-right: 9px;color: #f1416c!important;"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-body border-0 py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableOrder" class="display">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">No</th>
                                    <th class="min-w-100px text-dark">ID Outlet</th>
                                    <th class="min-w-100px text-dark">No Invoice</th>
                                    <th class="min-w-100px text-dark">Ongkos Kirim</th>
                                    <th class="min-w-100px text-dark">Progress</th>
                                    <th class="min-w-100px text-dark">Total</th>
                                    <th class="min-w-100px text-dark">Tanggal Pemesanan</th>
                                    <th class="min-w-100px text-dark">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            var dataTable = $('#tableOrder').DataTable({
                "processing": true,
                "serverSide": false,
                ajax: {
                    url: "/admin/get_data_report_invoice",
                    dataType: "json",
                },
                columns: [
                    { 
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: "outlet_id" },
                    { data: "invoice_no" },
                    {
                        data: "ongkir",
                        render: function(data, type, full, meta) {
                            if (data) {
                                return formatRupiah(data);
                            } else {
                                return '<span class="badge badge-light-warning">Please Input Ongkir</span>';
                            }
                        }
                    },
                    {
                        data: "progress",
                        render: function(data, type, row) {
                            var status = '';
                            switch (row.progress) {
                                case "0":
                                    status = '<span class="badge badge-light-success">New Order</span>';
                                    break;
                                case "1":
                                    status = '<span class="badge badge-light-warning">Menunggu Pembayaran</span>';
                                    break;
                                case "2":
                                    status = '<span class="badge badge-light-warning">Menunggu Terima Pembayaran</span>';
                                    break;
                                case "3":
                                status = '<span class="badge badge-light-warning">Menunggu Kirim Pesanan</span>';
                                    break;
                                case "4":
                                    status = '<span class="badge badge-light-warning">Menunggu Pesanan Diterima</span>';
                                    break;
                                case "5":
                                    status = '<span class="badge badge-light-success">Pesanan Diterima</span>';
                                    break;
                                case "6":
                                    status = '<span class="badge badge-light-warning">Waiting Payment</span>';
                                    break;
                            }
                            return status;
                        }
                    },
                    { data: "total", 
                        render: function(data, type, full, meta) {
                            return data ? formatRupiah(data) : '<span class="badge badge-light-warning">Please Input Ongkir</span>';
                        }
                    },
                    { 
                        data: "date_created", 
                        render: function(data, type, row) {
                            if(type === 'display' || type === 'filter'){
                                var date = new Date(data);
                                var options = { day: '2-digit', month: 'long', year: 'numeric' };
                                return date.toLocaleDateString('id-ID', options); // 'id-ID' untuk format Indonesia
                            }
                            return data;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return `
                                <a href="/admin/order-detail/${full.invoice_no}" class="btn btn-primary btn-sm" style="background-color: #5aa9e6;">
                                    <i style="color:#181C32;" class="fas fa-eye me-2"></i>
                                    Detail
                                </a>
                            `;
                        }
                    }
                ]
            });
        });

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }
    </script>
@endsection