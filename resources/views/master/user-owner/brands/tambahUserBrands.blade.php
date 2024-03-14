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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create New Brand for {{ $user->name }}</h1>
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
                        <li class="breadcrumb-item text-muted">Create New Brand for {{ $user->name }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    <a href="/admin/detail-user-owner/{{ $user->username }}" class="btn fw-bold btn-primary">Kembali</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle" style="margin-right: 9px;color: #0f5132!important;"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle" style="margin-right: 9px;color: #f1416c!important;"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('admin.admin_store_new_brands') }}" method="POST" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!-- start:Informasi Brand -->
                                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2 style="font-size: 18px;">Informasi Brand</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row fv-row">
                                                <h2 style="font-size: 1rem;">Foto / Logo Brand</h2>
                                                <div class="col-md-6">
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/master/media/svg/files/blank-image.svg');
                                                        } [data-theme="dark"]
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/master/media/svg/files/blank-image-dark.svg');
                                                        }
                                                    </style>
                                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                        <div class="image-input-wrapper w-150px h-150px"></div>
                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                                            <i class="fas fa-pencil fs-7"></i>
                                                            <input type="file" name="logo_brand" accept=".png, .jpg, .jpeg" required/>
                                                            <input type="hidden" name="logo_brand_remove" />
                                                        </label>
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal Gambar">
                                                            <i class="fas fa-close fs-2"></i>
                                                        </span>
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                                            <i class="fas fa-close fs-2"></i>
                                                        </span>
                                                    </div>
                                                    <div class="text-muted fs-7" style="color: #31353B!important;">Format gambar <strong style="font-size: 11px;">Wajib .jpg .jpeg .png</strong></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="username" class="form-control mb-2" id="username" value="{{ $user->username }}" required>
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kategori Brand</label>
                                                        <div class="input-group">
                                                            <select class="form-select mb-2" data-control="select2" data-placeholder="Pilih Kategori" data-allow-clear="true" name="brand_category_code" required>
                                                                <option></option>
                                                                @foreach($getBrands as $kategori)
                                                                    <option value="{{ $kategori->brand_category_code }}">{{ $kategori->brand_category_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Brand</label>
                                                                <input type="text" name="brand_name" class="form-control mb-2" id="brand_name" placeholder="Masukan Nama Brand" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Slug</label>
                                                                <input type="text" name="slug" class="form-control mb-2" id="slug" style="background-color: #e2e2e2;cursor: not-allowed;" readonly>
                                                                <div class="text-muted fs-7" style="color: #31353B!important;">Slug akan otomatis sesuai dengan inputan <strong>Nama Brand.</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">No HP Brand</label>
                                                        <input type="text" name="no_hp_brand" class="form-control mb-2" id="no_hp_brand" placeholder="Contoh : 081xxxxx" required/>
                                                        <div id="textAlert_brand" class="text-muted fs-7" style="color: #31353B!important;">No HP <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                        <div id="noHpUsedMsg_brand" class="text-muted fs-7" style="color: #d90429!important; display: none;">No HP Sudah digunakan</div>
                                                    </div>
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Facebook Brand</label>
                                                        <input type="text" name="facebook_brand" class="form-control mb-2" id="facebook_brand"/>
                                                    </div>
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Youtube Brand</label>
                                                        <input type="text" name="youtube_brand" class="form-control mb-2" id="youtube_brand"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Whatsapp Brand</label>
                                                        <input type="text" name="whatsapp_brand" class="form-control mb-2" id="whatsapp_brand" placeholder="Contoh : 081xxxxx" required/>
                                                        <div class="text-muted fs-7" style="color: #31353B!important;">Whatsapp <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                    </div>
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Instagram Brand</label>
                                                        <input type="text" name="instagram_brand" class="form-control mb-2" id="instagram_brand"/>
                                                    </div>
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Tiktok Brand</label>
                                                        <input type="text" name="tiktok_brand" class="form-control mb-2" id="tiktok_brand"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Website Brand</label>
                                                    <input type="text" name="website_brand" class="form-control mb-2" id="website_brand"/>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Brand Description</label>
                                                <textarea name="brand_description" class="form-control mb-2" rows="4" required></textarea>
                                                <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan Deskripsi Brand memuat Penjelasan Detail yang Jelas.</div>
                                            </div> <br>
                                        </div>
                                    </div>
                                    <!-- end:Informasi Brand -->
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.admin_user_owner') }}" class="css-ca2jq0s">Batalkan</a>
                            <button type="submit" class="css-kl2kd9a">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
	<!-- slug Brand -->
    <script type="text/javascript">
        const brand_name  = document.querySelector('#brand_name');
        const slug        = document.querySelector('#slug');

        brand_name.addEventListener('change', function(){
            fetch('/admin/brandSlug?brand_name=' + brand_name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#no_hp_brand").keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }

                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            var handleSearchNoHp_brand = _.debounce(function() {
                var noHP_brand         = $('#no_hp_brand').val();
                var noHpUsedMsg_brand  = $('#noHpUsedMsg_brand');
                var textAlert_brand    = $('#textAlert_brand');

                if (noHP_brand.length >= 3) {
                    $.ajax({
                        url: "/admin/validateNoHp_brand",
                        type: "GET",
                        data: { 'no_hp': noHP_brand },
                        success: function(data) {
                            let isUsed = data && data.isUsed;

                            if (isUsed) {
                                noHpUsedMsg_brand.css('display', 'block');
                                textAlert_brand.css('display', 'none');
                            } else {
                                noHpUsedMsg_brand.css('display', 'none');
                                textAlert_brand.css('display', 'block');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error saat pencarian:", error);
                        }
                    });
                } else {
                    noHpUsedMsg_brand.css('display', 'none');
                    textAlert_brand.css('display', 'block');
                }
            }, 300);

            $('#no_hp_brand').on('input', handleSearchNoHp_brand);

            $("#whatsapp_brand").keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }

                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection