@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Report Invoice Pembelian</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle fs-6 gy-5" id="tableInvoicePembelian" class="display">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px text-dark">ID Outlet</th>
                                        <th class="min-w-100px text-dark">No Invoice</th>
                                        <th class="min-w-100px text-dark">Status</th>
                                        <th class="min-w-100px text-dark">Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableInvoicePembelian').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/owner/get-data-invoice-pembelian",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    { 
                        data: 'outlet_id',
                        render: function(data, type, row) {
                            return `<div class="align-items-center ps-2">
                                        <span class="text-gray-800">${row.outlet_id}</span>
                                    </div>`;
                        }
                    },
                    { 
                        data: 'invoice_no',
                        render: function(data, type, row) {
                            return `<div class="align-items-center ps-2">
                                        <span class="text-gray-800">${row.invoice_no}</span>
                                    </div>`;
                        }
                    },
                    { 
                        data: 'progress',
                        render: function(data, type, row) {
                            var status = '';
                            switch (row.progress) {
                                case "0":
                                    status = '<span class="badge" style="background:#809bce;">Order Baru</span>';
                                    break;
                                case "1":
                                    status = '<span class="badge" style="background:#fcb75d;">Menunggu Pembayaran</span>';
                                    break;
                                case "2":
                                    status = '<span class="badge" style="background:#7fd8be;">Menunggu Approval</span>';
                                    break;
                                case "3":
                                    status = '<span class="badge" style="background:#957fef;">Approve</span>';
                                    break;
                                case "4":
                                    status = '<span class="badge" style="background:#5aa9e6;">Sedang Dikirim</span>';
                                    break;
                                case "5":
                                    status = '<span class="badge" style="background:#618264;">Diterima</span>';
                                    break;
                                case "6":
                                    status = '<span class="badge badge-light-warning"></span>';
                                    break;
                            }
                            return status;
                        }
                    },
                    { 
                        data: 'detail',
                        render: function(data, type, row) {
                            return `<a href="/owner/detail-invoice-pembelian/${row.invoice_no}" class="text-gray-800 cursor-pointer">
                                        <u>Detail Invoice</u>
                                    </a>`;
                        }
                    },
                ]
            });
        });
    </script>
@endsection