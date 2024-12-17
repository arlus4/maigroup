@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Ringkasan Statistik</h1>
                    <span class="css-ekw89dna">Rutin pantau perkembangan outlet para owner.</span>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="d-flex align-items-center" style="gap: 15px!important">
                    <div class="css-kjd89dh8">
                        <div class="css-djwi9ens">
                            <div class="css-joe8dnja title">
                                <p class="css-oiwdnidx">Brands Verified</p>
                            </div>
                        </div>
                        <h3 class="css-fnk83snj">{{ $totalBrands->where('is_verified', 1)->count() }}</h3>
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="css-jf947dns">{{ $totalBrands->where('is_verified', 0)->count() }} Pending</span>
                                <span class="css-jf947dns">{{ $totalBrands->count() > 0 ? round(($totalBrands->where('is_verified', 1)->count() / $totalBrands->count()) * 100) . '%' : '0%' }}</span>
                            </div>
                            <div class="h-5px mx-3 w-100 rounded css-njd79eb">
                                <div class="rounded h-5px css-eehid7s" role="progressbar" style="width: {{ $totalBrands->count() > 0 ? round(($totalBrands->where('is_verified', 1)->count() / $totalBrands->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalBrands->count() > 0 ? round(($totalBrands->where('is_verified', 1)->count() / $totalBrands->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="css-kjd89dh9">
                        <div class="css-djwi9ens">
                            <div class="css-joe8dnja title">
                                <p class="css-oiwdnidx">Outlets Verified</p>
                            </div>
                        </div>
                        <h3 class="css-fnk83snj">{{ $totalOutlet->where('is_verified', 1)->count() }}</h3>
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="css-jf947dns">{{ $totalOutlet->where('is_verified', 0)->count() }} Pending</span>
                                <span class="css-jf947dns">{{ $totalOutlet->count() > 0 ? round(($totalOutlet->where('is_verified', 1)->count() / $totalOutlet->count()) * 100) . '%' : '0%' }}</span>
                            </div>
                            <div class="h-5px mx-3 w-100 rounded css-njd79eb">
                                <div class="rounded h-5px css-eehid7s" role="progressbar" style="width: {{ $totalOutlet->count() > 0 ? round(($totalOutlet->where('is_verified', 1)->count() / $totalOutlet->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalOutlet->count() > 0 ? round(($totalOutlet->where('is_verified', 1)->count() / $totalOutlet->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="css-kjd89dh10">
                        <div class="css-djwi9ens">
                            <div class="css-joe8dnja title">
                                <p class="css-oiwdnidx">Owners Active</p>
                            </div>
                        </div>
                        <h3 class="css-fnk83snj">{{ $totalUsers->where('is_active', 1)->count() }}</h3>
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="css-jf947dns">{{ $totalUsers->where('is_active', 0)->count() }} Non-Active</span>
                                <span class="css-jf947dns">{{ $totalUsers->count() > 0 ? round(($totalUsers->where('is_active', 1)->count() / $totalUsers->count()) * 100) . '%' : '0%' }}</span>
                            </div>
                            <div class="h-5px mx-3 w-100 rounded css-njd79eb">
                                <div class="rounded h-5px css-eehid7s" role="progressbar" style="width: {{ $totalUsers->count() > 0 ? round(($totalUsers->where('is_active', 1)->count() / $totalUsers->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalUsers->count() > 0 ? round(($totalUsers->where('is_active', 1)->count() / $totalUsers->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="css-kjd89dh11">
                        <div class="css-djwi9ens">
                            <div class="css-joe8dnja title">
                                <p class="css-oiwdnidx">Pelanggan Active</p>
                            </div>
                        </div>
                        <h3 class="css-fnk83snj">{{ $totalPembeli->where('is_active', 1)->count() }}</h3>
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="css-jf947dns">{{ $totalPembeli->where('is_active', 0)->count() }} Non-Active</span>
                                <span class="css-jf947dns">{{ $totalPembeli->count() > 0 ? round(($totalPembeli->where('is_active', 1)->count() / $totalPembeli->count()) * 100) . '%' : '0%' }}</span>
                            </div>
                            <div class="h-5px mx-3 w-100 rounded css-njd79eb">
                                <div class="rounded h-5px css-eehid7s" role="progressbar" style="width: {{ $totalPembeli->count() > 0 ? round(($totalPembeli->where('is_active', 1)->count() / $totalPembeli->count()) * 100) . '%' : '0%' }};" aria-valuenow="{{ $totalPembeli->count() > 0 ? round(($totalPembeli->where('is_active', 1)->count() / $totalPembeli->count()) * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
