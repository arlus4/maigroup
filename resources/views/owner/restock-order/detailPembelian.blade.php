@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Pembelian, {{ $data->invoice_no }}</h1>
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
                                    <img alt="Logo" src="{{ asset('assets/images/ic_maitea.png') }}" class="h-80px" />
                                </a>
                                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                                    <div>Alamat MaiGroup</div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-12">
                            <div class="d-flex flex-column gap-7 gap-md-10">
                                <div class="fw-bold fs-2">Dear, {{ $data->nama_outlet }}
                                    <br />
                                    <span class="text-muted fs-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, earum!</span>
                                </div>
                                <div class="separator"></div>
                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Tanggal</span>
                                        <span class="fs-5">{{ \Carbon\Carbon::parse($data->date_created_invoice)->format('d F Y') }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Invoice ID</span>
                                        <span class="fs-5">{{ $data->invoice_no }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Alamat Outlet</span>
                                        <span class="fs-6">{{ $data->alamat_detail }}, {{ $data->nama_kelurahan }},
                                            <br />{{ $data->nama_kecamatan }}, {{ $data->nama_kotakab }},
                                            <br />{{ $data->nama_provinsi }}, {{ $data->kodepos }}
                                        </span>
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
                                                                @if ($detail->sku_id == "PA1")
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">Paket Startup</div>
                                                                    </div>
                                                                @elseif ($detail->sku_id == "PA2")
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">Paket Advanced</div>
                                                                    </div>
                                                                @elseif ($detail->sku_id == "PA3")
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">Paket Custom</div>
                                                                    </div>
                                                                @else
                                                                    <a href="javascript:;" class="symbol symbol-50px">
                                                                        <span class="symbol-label" style="background-image:url(../../../{{ $detail->path_thumbnail }});"></span>
                                                                    </a>
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">{{ $detail->nama_produk }}</div>
                                                                        <div class="fs-7 text-muted">{{ $detail->project_name }}</div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        @if ($detail->sku_id == "PA1")
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @elseif ($detail->sku_id == "PA2")
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @elseif ($detail->sku_id == "PA3")
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @else
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @endif
                                                        <td class="text-end">{{ $detail->qty }}</td>
                                                        @if ($detail->total_amount == null)
                                                            <td class="text-end">Menunggu Konfirmasi Admin</td>
                                                        @else
                                                            <td class="text-end">@rupiah($detail->total_amount)</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-end">Subtotal</td>
                                                    @php
                                                        $isConfirmationNeeded = false;
                                                        foreach ($details as $detail) {
                                                            if ($detail->total_amount == null) {
                                                                $isConfirmationNeeded = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp

                                                    @if ($isConfirmationNeeded)
                                                        <td class="text-end">Menunggu Konfirmasi Admin</td>
                                                    @else
                                                        <td class="text-end">@rupiah($data->amount)</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end">Ongkos Kirim</td>
                                                    @if ($data->ongkir == null)
                                                        <td class="text-end">Menunggu Konfirmasi Admin</td>
                                                    @else
                                                        <td class="text-end">@rupiah($data->ongkir)</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end">Kode Unik</td>
                                                    @if ($data->kode_unik == null)
                                                        <td class="text-end">Menunggu Konfirmasi Admin</td>
                                                    @else
                                                        <td class="text-end">@rupiah($data->kode_unik)</td> 
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-dark fw-bold text-end">Total</td>
                                                    @if ($data->total == null)
                                                        <td class="text-end">Menunggu Konfirmasi Admin</td>
                                                    @else
                                                        <td class="text-dark fs-3 fw-bolder text-end">@rupiah($data->total)</td>
                                                    @endif
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
                            @if ($data->total != null)
                                <button type="button" onclick="window.location.href='/owner/download-invoice/{{ $data->invoice_no }}'" class="btn btn-success my-1 me-12">Download</button>
                            @endif
                            <!-- end::Action-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection