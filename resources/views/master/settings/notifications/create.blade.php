@extends('layout-master/app')
@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Create Notification</h1>
            </div>
            <a href="{{ route('admin.admin_notification_index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
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
            <form id="notification-form" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @csrf
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                        <div class="card-body pt-0">
                            <div class="row fv-row">
                                <h2 style="font-size: 1rem;">Avatar / Foto Profil</h2>
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
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" required/>
                                            <input type="hidden" name="avatar_remove" />
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
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Title</label>
                                        <input type="text" name="title" class="form-control mb-2" id="title" required/>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Message</label>
                                        <textarea name="message" id="message" class="form-control mb-2" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="css-kl2kd9a">Send Notification</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $('#notification-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/admin/setting/storeNotifications',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    let errorMessage = 'Error: ' + xhr.responseJSON.error;
                    if (xhr.responseJSON.response && xhr.responseJSON.response.errors) {
                        errorMessage += '\n' + xhr.responseJSON.response.errors.join('\n');
                    }
                    alert(errorMessage);
                }
            });
        });
    </script>
@endsection