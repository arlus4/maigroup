@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Invoice Pembelian {{ $data->invoice_no }}</h1>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body py-20">
                    <div class="mw-lg-950px mx-auto w-100">
                        <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                            <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>
                            <div class="text-sm-end">
                                <a href="javascript:;" class="d-block mw-150px ms-sm-auto">
                                    <img alt="Logo" src="{{ asset('assets/images/logo_ts.png') }}" class="h-80px" />
                                </a>
                                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                                    <div>Alamat MaiGroup</div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-12">
                            <div class="d-flex flex-column gap-7 gap-md-10">
                                <div class="fw-bold fs-2">
                                @if ($data->name != null)    
                                {{ $data->name }}
                                @else
                                Pengguna Belum Terdaftar
                                @endif
                                    <br />
                                    <span class="text-muted fs-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, earum!</span>
                                </div>
                                <div class="separator"></div>
                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Invoice ID</span>
                                        <span class="fs-5">{{ $data->invoice_no }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Nomor Telfon</span>
                                        <span class="fs-5">{{ $data->nomor_telfon }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Tanggal</span>
                                        <span class="fs-5">{{ \Carbon\Carbon::parse($data->date_created_invoice)->format('d F Y') }}</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between flex-column">
                                    <div class="table-responsive border-bottom mb-9">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead>
                                                <tr class="border-bottom fs-6 fw-bold text-muted">
                                                    <th class="min-w-175px pb-2">Products</th>
                                                    <th class="min-w-70px text-end pb-2">SKU</th>
                                                    <th class="min-w-80px text-end pb-2">QTY</th>
                                                    <th class="min-w-100px text-end pb-2">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach ($details as $detail)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:;" class="symbol symbol-50px">
                                                                    <span class="symbol-label" style="background-image:url(../../../{{ $detail->path_thumbnail }});"></span>
                                                                </a>
                                                                <div class="ms-5">
                                                                    <div class="fw-bold">{{ $detail->nama_produk }}</div>
                                                                    <div class="fs-7 text-muted">{{ $detail->project_name }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end">{{ $detail->sku_id }}</td>
                                                        <td class="text-end">{{ $detail->qty }}</td>
                                                        @if ($detail->amount == null)
                                                            <td class="text-end">Menunggu Konfirmasi Admin</td>
                                                        @else
                                                            <td class="text-end">@rupiah($detail->amount)</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-dark fw-bold text-end">Total</td>
                                                    <td class="text-dark fs-3 fw-bolder text-end">@rupiah($data->amount)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                            <!-- begin::Actions-->
                            <div class="my-1 me-5">
                            </div>
                            <!-- end::Actions-->
                            <!-- begin::Action-->
                            <!-- @if ($data->total != null)
                                <button type="button" onclick="window.location.href='/owner/download-invoice/{{ $data->invoice_no }}'" class="btn btn-success my-1 me-12">Download</button>
                            @endif -->
                            <!-- end::Action-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection