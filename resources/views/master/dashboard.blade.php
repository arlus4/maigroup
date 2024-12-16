@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #679436">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalBrands->where('is_verified', 1)->count() }}</span>
                                <span class="text-white opacity-50 pt-1 fw-semibold fs-6">Brands Verified</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span>{{ $totalBrands->where('is_verified', 0)->count() }} Pending</span>
                                    <span>{{ $totalBrands->count() > 0 ? round(($totalBrands->where('is_verified', 1)->count() / $totalBrands->count()) * 100) . '%' : '0%' }}</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                    <div class="bg-danger rounded h-8px" role="progressbar" style="width: {{ $totalBrands->count() > 0 ? round(($totalBrands->where('is_verified', 1)->count() / $totalBrands->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalBrands->count() > 0 ? round(($totalBrands->where('is_verified', 1)->count() / $totalBrands->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #4e148c">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalOutlet->where('is_verified', 1)->count() }}</span>
                                <span class="text-white opacity-50 pt-1 fw-semibold fs-6">Outlets Verified</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span>{{ $totalOutlet->where('is_verified', 0)->count() }} Pending</span>
                                    <span>{{ $totalOutlet->count() > 0 ? round(($totalOutlet->where('is_verified', 1)->count() / $totalOutlet->count()) * 100) . '%' : '0%' }}</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                    <div class="bg-danger rounded h-8px" role="progressbar" style="width: {{ $totalOutlet->count() > 0 ? round(($totalOutlet->where('is_verified', 1)->count() / $totalOutlet->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalOutlet->count() > 0 ? round(($totalOutlet->where('is_verified', 1)->count() / $totalOutlet->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #023047">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalUsers->where('is_active', 1)->count() }}</span>
                                <span class="text-white opacity-50 pt-1 fw-semibold fs-6">Owners Active</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span>{{ $totalUsers->where('is_active', 0)->count() }} Non-Active</span>
                                    <span>{{ $totalUsers->count() > 0 ? round(($totalUsers->where('is_active', 1)->count() / $totalUsers->count()) * 100) . '%' : '0%' }}</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                    <div class="bg-danger rounded h-8px" role="progressbar" style="width: {{ $totalUsers->count() > 0 ? round(($totalUsers->where('is_active', 1)->count() / $totalUsers->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalUsers->count() > 0 ? round(($totalUsers->where('is_active', 1)->count() / $totalUsers->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #f39237">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalPembeli->where('is_active', 1)->count() }}</span>
                                <span class="text-white opacity-50 pt-1 fw-semibold fs-6">Pelanggan Active</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span>{{ $totalPembeli->where('is_active', 0)->count() }} Non-Active</span>
                                    <span>{{ $totalPembeli->count() > 0 ? round(($totalPembeli->where('is_active', 1)->count() / $totalPembeli->count()) * 100) . '%' : '0%' }}</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                    <div class="bg-danger rounded h-8px" role="progressbar" style="width: {{ $totalPembeli->count() > 0 ? round(($totalPembeli->where('is_active', 1)->count() / $totalPembeli->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalPembeli->count() > 0 ? round(($totalPembeli->where('is_active', 1)->count() / $totalPembeli->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5 g-xl-10 mb-xl-10">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3">
                        <div class="card card-flush h-md-75" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-header pt-2">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="css-fcjak2js">Total Kategori Produk</span>
                                    <span class="css-cna2lks9">kategori</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3">
                        <div class="card card-flush h-md-75" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-header pt-2">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="css-fcjak2js">Total Produk</span>
                                    <span class="css-cna2lks9">16 produk</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3">
                        <div class="card card-flush h-md-75" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-7 mb-3">
                            <span class="css-fcjak2js">Total Kategori Produk</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
