@extends('layout-master/app')
@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Brand {{ $brand->brand_name }} Owner {{ $user->name }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Management Owner</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Daftar Owner</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Detail Brand {{ $brand->brand_name }} Owner {{ $user->name }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    <a href="/admin/brand-pending" class="btn fw-bold btn-primary">Kembali</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!-- start:Informasi Brand -->
                                <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2 style="font-size: 18px;">Informasi Brand {{ $brand->brand_name }}</h2>
                                        </div>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn fw-bold btn-success" onclick="approveBrand({{ $brand->id }})">Approve Brand</button>
                                            {{-- <a href="/admin/edit_New_Brands/{{ $brand->slug }}" class="btn fw-bold btn-success">Approve Brand</a> --}}
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row fv-row">
                                            <h2 style="font-size: 1rem;">Foto / Logo Brand</h2>
                                            <div class="col-md-6">
                                                @if ($brand->brand_image != NULL)
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url('../../../{{ $brand->brand_image_path }}');
                                                        } [data-theme="dark"]
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/master/media/svg/files/blank-image-dark.svg');
                                                        }
                                                    </style>
                                                @else
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/master/media/svg/files/blank-image.svg');
                                                        } [data-theme="dark"]
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/master/media/svg/files/blank-image-dark.svg');
                                                        }
                                                    </style>
                                                @endif
                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                                </div>
                                                <div class="text-muted fs-7" style="color: #31353B!important;">Aktif & Verification</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kategori Brand</label>
                                                    <div class="input-group">
                                                        <input type="text" name="brand_name" class="form-control mb-2" id="brand_name" placeholder="Masukan Nama Brand" value="{{ $categories->brand_category_name }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-10 fv-row">
                                                            <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Brand</label>
                                                            <input type="text" name="brand_name" class="form-control mb-2" id="brand_name" placeholder="Masukan Nama Brand" value="{{ $brand->brand_name }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-10 fv-row">
                                                            <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Slug</label>
                                                            <input type="text" name="slug" class="form-control mb-2" id="slug" style="background-color: #e2e2e2;cursor: not-allowed;" value="{{ $brand->slug }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">No HP Brand</label>
                                                    <input type="text" name="no_hp_brand" class="form-control mb-2" id="no_hp_brand" value="{{ $brand->no_hp }}" disabled/>
                                                </div>
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Facebook Brand</label>
                                                    <input type="text" name="facebook_brand" class="form-control mb-2" id="facebook_brand" value="{{ $brand->facebook }}" disabled/>
                                                </div>
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Youtube Brand</label>
                                                    <input type="text" name="youtube_brand" class="form-control mb-2" id="youtube_brand" value="{{ $brand->youtube }}" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Whatsapp Brand</label>
                                                    <input type="text" name="whatsapp_brand" class="form-control mb-2" id="whatsapp_brand" value="{{ $brand->whatsapp }}" disabled/>
                                                </div>
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Instagram Brand</label>
                                                    <input type="text" name="instagram_brand" class="form-control mb-2" id="instagram_brand" value="{{ $brand->instagram }}" disabled/>
                                                </div>
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Tiktok Brand</label>
                                                    <input type="text" name="tiktok_brand" class="form-control mb-2" id="tiktok_brand" value="{{ $brand->tiktok }}" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-10 fv-row">
                                                <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Website Brand</label>
                                                <input type="text" name="website_brand" class="form-control mb-2" id="website_brand" value="{{ $brand->website }}" disabled/>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Brand Description</label>
                                            <textarea name="brand_description" class="form-control mb-2" rows="4" disabled>{{ $brand->brand_description }}</textarea>
                                            <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan Deskripsi Brand memuat Penjelasan Detail yang Jelas.</div>
                                        </div> <br>
                                    </div>
                                </div>
                                <!-- end:Informasi Brand -->
                            </div>
                        </div>
                    </div>
                    <!-- Modal Approve User -->
                    <div class="modal fade" id="modal_approve">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-title-approve"></h4>
                                </div>
                                <div class="modal-body">
                                    <form action="#" id="form-approve">
                                    @csrf
                                    <input type="hidden" name="id" class="form-control id" id="id" value="{{ $brand->id }}" readonly>
                                    <div class="form-group mb-3">
                                        <label style="color: #31353B!important;font-weight: 600;">Brand Code</label>
                                        <input type="text" class="form-control brand_code form-control-solid" value="{{ $brand->brand_code }}" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label style="color: #31353B!important;font-weight: 600;">Brand Name</label>
                                        <input type="text" class="form-control brand_name form-control-solid" value="{{ $brand->brand_name }}" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                        Batalkan
                                    </button>
                                    <button type="submit" id="approve" class="css-kl2kd9a">Approve</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script>
        function approveBrand(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/get_data_detail_brand_pending',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_approve').modal('show');
                    $('#modal-title-approve').text('Approve Data User');
                    $('#id').val(data.id);
                    $('#brand_code').val(data.brand_code);
                    $('#brand_name').val(data.brand_name);
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        // Action Approve
        $(document).ready(function() {
            $('#form-approve').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_approve').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/approve-brand-pending",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#tableBrandOwner').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });
    </script>

@endsection