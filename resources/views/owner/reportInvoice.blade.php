@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Report Invoice</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle fs-6 gy-5" id="tableStatusRestock" class="display">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px text-dark">No</th>
                                        <th class="min-w-100px text-dark">ID Outlet</th>
                                        <th class="min-w-100px text-dark">No Invoice</th>
                                        <th class="min-w-100px text-dark">Status</th>
                                        <th class="min-w-100px text-dark">Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach($getInvoice as $invoice)
                                        <tr>
                                            <td class="align-items-center ps-2">{{ $loop->iteration }}</td>
                                            <td class="align-items-center ps-2">{{ $invoice->outlet_id }}</td>
                                            <td class="align-items-center ps-2">{{ $invoice->invoice_no }}</td>
                                            <td class="align-items-center ps-2">
                                                @if($invoice->progress == 0)
                                                    <span class="badge" style="background:#809bce;">Order Baru</span>
                                                @elseif($invoice->progress == 1)
                                                    <span class="badge" style="background:#fcb75d;">Menunggu Pembayaran</span>
                                                @elseif($invoice->progress == 2)
                                                    <span class="badge" style="background:#7fd8be;">Menunggu Approval</span>
                                                @elseif($invoice->progress == 3)
                                                    <span class="badge" style="background:#957fef;">Approve</span>
                                                @elseif($invoice->progress == 4)
                                                    <span class="badge" style="background:#5aa9e6;">Sedang Dikirim</span>
                                                @elseif($invoice->progress == 5)
                                                    <span class="badge" style="background:#618264;">Diterima</span>
                                                @else
                                                    <span class="badge badge-danger">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td class="align-items-center">
                                                <a style="color: #525867;" href="detail-order/{{ $invoice->invoice_no }}"><u>Detail Invoice</u></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection