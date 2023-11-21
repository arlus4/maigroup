@extends('owner/layout-sidebar/app')

@section('content')
    <style>
        .card .card-body{
            padding: 1rem 0rem 1rem 2.25rem;
        }
    </style>
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dasbor</h1>
                </div>
            </div>
        </div>
        <div class="app-content flex-column-fluid">
            <div class="app-container container-fluid">
                <div class="row g-5 g-xl-10">
                    <div class="col-md-4 mb-5">
                        <div class="card card-flush h-xl-100" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-header" style="border-top: 4px solid #039344">
                                <h3 class="card-title align-items-start flex-column pt-2">
                                    <span class="card-label fw-bold text-gray-800">Penjualan Hari Ini</span>
                                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Akumulasi Per 1 Hari</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex justify-content-between">
                                <div class="d-flex align-items-center me-5">
                                    <div class="symbol symbol-30px symbol-circle me-1">
                                        <img src="{{ asset('assets/images/cup.png') }}">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-800 fs-2">100<sup style="margin-left: 4px;font-size: 11px;">Cup</sup></span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center me-5">
                                    <div class="symbol symbol-30px symbol-circle me-1">
                                        <img src="{{ asset('assets/images/rp.png') }}">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-800 fs-2"><sup style="margin-right: 4px;font-size: 11px;">Rp</sup>100.000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="padding: 10px 14px 15px;">
                                <button type="button" class="css-kl2kd9a" onclick="getPerhari()" style="width: 120px; height: 30px;">
                                    <i class="fas fa-info-circle text-white"></i>
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card card-flush h-xl-100" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-header" style="border-top: 4px solid rgb(107, 122, 216)">
                                <h3 class="card-title align-items-start flex-column pt-2">
                                    <span class="card-label fw-bold text-gray-800">Penjualan Bulan Ini</span>
                                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Akumulasi Per 1 Bulan</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex justify-content-between">
                                <div class="d-flex align-items-center me-5">
                                    <div class="symbol symbol-30px symbol-circle me-1">
                                        <img src="{{ asset('assets/images/cup.png') }}">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-800 fs-3">100<sup style="margin-left: 4px;font-size: 10px;">Cup</sup></span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center me-5">
                                    <div class="symbol symbol-30px symbol-circle me-1">
                                        <img src="{{ asset('assets/images/rp.png') }}">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-800 fs-2"><sup style="margin-right: 4px;font-size: 11px;">Rp</sup>100.000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="padding: 10px 14px 15px;">
                                <button class="css-kl2kd9a" style="width: 120px; height: 30px;">
                                    <i class="fas fa-info-circle text-white"></i>
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card card-flush h-xl-100" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-header" style="border-top: 4px solid #8de2ff">
                                <h3 class="card-title align-items-start flex-column pt-2">
                                    <span class="card-label fw-bold text-gray-800">Penjualan Rata-rata Per hari</span>
                                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Akumulasi Rata-rata</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex justify-content-between">
                                <div class="d-flex align-items-center me-5">
                                    <div class="symbol symbol-30px symbol-circle me-1">
                                        <img src="{{ asset('assets/images/cup.png') }}">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-800 fs-2">100<sup style="margin-left: 4px;font-size: 11px;">Cup</sup></span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center me-5">
                                    <div class="symbol symbol-30px symbol-circle me-1">
                                        <img src="{{ asset('assets/images/rp.png') }}">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-bold text-gray-800 fs-2"><sup style="margin-right: 4px;font-size: 11px;">Rp</sup>100.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-title d-flex flex-column justify-content-center mt-5">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0 mb-5">Report Stock</h1>
                    <div class="card p-3" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableStockReport">
                                    <thead>
                                        <tr class="text-start gs-0">
                                            <th class="min-w-100px fw-bold text-gray-800">Informasi Varian</th>
                                            <th class="min-w-100px fw-bold text-gray-800">Kategori</th>
                                            <th class="min-w-100px fw-bold text-gray-800">Jumlah</th>
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
    </div>
    
    <!-- Modal Detail Per Hari -->
    <div class="modal fade" id="detailPerHari">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="css-dtu37sh">
                    <div class="css-cfn3ksa">
                        <h5 class="css-fnm3aj">Penjualan Hari ini</h5>
                    </div>
                    <button type="button" class="btn-close css-fhk9sna" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="css-cnm6w2a">
                    <div class="css-bnm3js">
                        <div class="css-vbdw2js">
                            <div class="css-kdfh3a p-0">
                                <div class="css-hk23nab" style="padding: 15px 0px; border-bottom:0px;">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="fw-bold">No</th>
                                                    <th class="fw-bold">Kategori</th>
                                                    <th class="fw-bold text-center min-w-150px">Produk</th>
                                                    <th class="fw-bold min-w-100px">Jumlah Cup
                                                    </th>
                                                    <th class="fw-bold min-w-100px text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="p-3">1</td>
                                                    <td class="p-3">
                                                        <span class="badge badge-secondary">MaiTea</span>
                                                    </td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <div class="symbol-label">
                                                                <img src="http://localhost:8000/storage/produk/thumbnail/jh4vv0fRQW_teh_8.png" class="w-100">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-gray-800 mb-1">Chizu Red Velvet</span>
                                                        </div>
                                                    </td>
                                                    <td class="p-3">25</td>
                                                    <td class="text-end p-3">Rp 25.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="p-3">2</td>
                                                    <td class="p-3">
                                                        <span class="badge badge-secondary">MaiTea</span>
                                                    </td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <div class="symbol-label">
                                                                <img src="http://localhost:8000/storage/produk/thumbnail/jh4vv0fRQW_teh_8.png" class="w-100">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-gray-800 mb-1">Chizu Red Velvet</span>
                                                        </div>
                                                    </td>
                                                    <td class="p-3">25</td>
                                                    <td class="text-end p-3">Rp 25.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="p-3">3</td>
                                                    <td class="p-3">
                                                        <span class="badge badge-secondary">MaiTea</span>
                                                    </td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <div class="symbol-label">
                                                                <img src="http://localhost:8000/storage/produk/thumbnail/jh4vv0fRQW_teh_8.png" class="w-100">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-gray-800 mb-1">Chizu Red Velvet</span>
                                                        </div>
                                                    </td>
                                                    <td class="p-3">25</td>
                                                    <td class="text-end p-3">Rp 25.000</td>
                                                </tr>
                                                <tr>
                                                    <td class="p-3">4</td>
                                                    <td class="p-3">
                                                        <span class="badge badge-secondary">MaiTea</span>
                                                    </td>
                                                    <td class="d-flex align-items-center">
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <div class="symbol-label">
                                                                <img src="http://localhost:8000/storage/produk/thumbnail/jh4vv0fRQW_teh_8.png" class="w-100">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-gray-800 mb-1">Chizu Red Velvet</span>
                                                        </div>
                                                    </td>
                                                    <td class="p-3">25</td>
                                                    <td class="text-end p-3">Rp 25.000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="css-jisq1js css-nqkns1n">
                                        <p class="fw-bold mb-0" style="color: #212121; font-size: 16px;">Total Pendapatan</p>
                                        <div>
                                            <p class="fw-bold mb-0" style="font-size: 18px; color: #212121;" id="total_akhirGagal">Rp&nbsp;100.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            $('#tableStockReport').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/owner/get_data_stock_report",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    { 
                        data: 'name',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label">
                                                <img src="{{ asset('${row.path_thumbnail}') }}" class="w-100"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.nama_produk}</span>
                                            <span>${row.sku}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'kategori',
                        render: function(data, type, row) {
                            return `<span class="badge badge-secondary">${row.project_name}</span>`;
                        }
                    },
                    {
                        data: 'jumlah',
                        render: function(data, type, row) {
                            return `${row.jumlah}`;
                        }
                    }
                ]
            });
        });

        function getPerhari(){
            $('#detailPerHari').modal('show');
        }
    </script>
@endsection