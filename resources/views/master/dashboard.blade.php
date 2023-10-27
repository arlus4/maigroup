@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dasbor</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush h-md-50 mb-5 mb-xl-10" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-header pt-2">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800" style="font-size: 1.1rem;">Total Kategori Produk</span>
                                    <span class="text-gray-400 mt-1 fw-semibold" style="font-size: 1rem;">76 Kategori</span>
                                </h3>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush h-md-50 mb-5 mb-xl-10" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-md-5 mb-xl-10">
                        <div class="card card-flush h-md-50 mb-5 mb-xl-10" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                            <div class="card-body d-flex flex-column justify-content-end pe-0">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection