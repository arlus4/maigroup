@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Produk</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Kategori Produk" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="{{ route('tambahProduk') }}" class="css-kl2kd9a" style="color:#fff!important;line-height: 40px;">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                Tambah Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px text-dark">SKU</th>
                                <th class="min-w-125px text-dark">Nama Produk</th>
                                <th class="min-w-125px text-dark">Kategori</th>
                                <th class="min-w-125px text-dark">Deskripsi</th>
                                <th class="min-w-125px text-dark">Thumbnail</th>
                                <th class="min-w-125px text-dark">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($dataProduk as $produk)
                            <tr>
                                <td class="align-items-center">{{ $produk->sku }}</td>
                                <td class="align-items-center">{{ $produk->nama_product }}</td>
                                <td class="align-items-center">
                                    <span class="css-fnak2bsk">Es Teh</span>
                                </td>
                                <td class="align-items-center">{{ $produk->deskripsi }}</td>
                                <td class="align-items-center">
                                    <div class="symbol symbol-circle">
                                        <div class="symbol-label" style="background: transparent;">
                                            <img class="w-100" src="{{ asset('storage/produk/thumbnail/'.$produk->thumbnail) }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="d-flex">
                                    <button class="border-0 bg-white p-0" style="margin-right: 4px;">
                                        <span class="badge badge-warning css-height-30">
                                            <i class="fas fa-edit text-white"></i>&nbsp;
                                            Edit
                                        </span>
                                    </button>
                                    <button class="border-0 bg-white p-0">
                                        <span class="badge badge-danger css-height-30">
                                            <i class="fas fa-trash text-white"></i>&nbsp;
                                            Hapus
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <td class="align-items-center">SKU002-0002-HTM-002</td>
                                <td class="align-items-center">Chizu Red Velvet</td>
                                <td class="align-items-center">
                                    <span class="css-fnak2bsk">Es Teh</span>
                                </td>
                                <td class="align-items-center">Ini sebuah Chizu Red Velvet dengan kategori Es Teh</td>
                                <td class="align-items-center">
                                    <div class="symbol symbol-circle">
                                        <div class="symbol-label" style="background: transparent;">
                                            <img class="w-100" src="{{ asset('assets/images/teh_8.png') }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="d-flex">
                                    <button class="border-0 bg-white p-0" style="margin-right: 4px;">
                                        <span class="badge badge-warning css-height-30">
                                            <i class="fas fa-edit text-white"></i>&nbsp;
                                            Edit
                                        </span>
                                    </button>
                                    <button class="border-0 bg-white p-0">
                                        <span class="badge badge-danger css-height-30">
                                            <i class="fas fa-trash text-white"></i>&nbsp;
                                            Hapus
                                        </span>
                                    </button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection