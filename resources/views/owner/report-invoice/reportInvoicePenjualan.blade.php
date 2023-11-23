@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Report Invoice Penjualan</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle fs-6 gy-5" id="tableInvoicePenjualan" class="display">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px text-dark">Id Outlet</th>
                                        <th class="min-w-100px text-dark">No Invoice</th>
                                        <th class="min-w-125px text-dark">Info Pembeli</th>
                                        <th class="min-w-100px text-dark">QTY</th>
                                        <th class="min-w-100px text-dark">Total</th>
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
            const rupiah = (number) => {
                return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR' 
                }).format(number).replace(/(\.|,)00$/g, '');
            }
            $('#tableInvoicePenjualan').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/owner/get-data-invoice-penjualan",
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
                        data: 'pembeli_id',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.name}</span>
                                            <span>${row.no_hp}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    { 
                        data: 'qty',
                        render: function(data, type, row) {
                            return `<div class="align-items-center ps-2">
                                        <span class="text-gray-800">${row.qty}</span>
                                    </div>`;
                        }
                    },
                    { 
                        data: 'amount',
                        render: function(data, type, row) {
                            return `<div class="align-items-center ps-2">
                                        <span class="text-gray-800">${rupiah(row.amount)}</span>
                                    </div>`;
                        }
                    },
                    { 
                        data: 'detail',
                        render: function(data, type, row) {
                            return `<a href="/owner/detail-invoice-penjualan/${row.invoice_no}" class="text-gray-800 cursor-pointer">
                                        <u>Detail Invoice</u>
                                    </a>`;
                        }
                    },
                ]
            });
        });
    </script>
@endsection