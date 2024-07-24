@extends('layout-master/app')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Notification</h1>
            </div>
        </div>
    </div>
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

        <div class="row d-flex">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h4 class="text-dark fw-bold fs-4">Sent Notifications</h4>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalSendMessage">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                New Message
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="notification-table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">ID</th>
                                    <th class="min-w-100px text-dark">Message</th>
                                    <th class="min-w-100px text-dark">Sent At</th>
                                    <th class="min-w-100px text-dark">Action</th>
                                </tr>
                            </thead>
                            <tbody id="notification-table" class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal New Message -->
        <div class="modal fade" id="modalSendMessage">
            <div class="modal-dialog modal-dialog-centered mw-750px">
                <div class="modal-content" style="border-radius: 8px;">
                    <div class="modal-content">
                        <form id="notification-form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <div class="content-title">
                                    <h4 class="css-lk3jsp">New Messages</h4>
                                </div>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="css-flj2ej">
                                <div class="css-fjkpo0ma">
                                    <div class="css-wj23sk">
                                        <div class="row fv-row">
                                            <h2 style="font-size: 1rem;">Thumbnail</h2>
                                            <div class="col-md-6">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url('../../../assets/master/media/svg/files/blank-image.svg');
                                                    } 
                                                    [data-theme="dark"] .image-input-placeholder {
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
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">Batalkan</button>
                                <button type="submit" class="css-kl2kd9a">Send Notification</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        function formatTimestamp(timestamp) {
            const date = new Date(timestamp * 1000);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        $(document).ready(function() {
            $('#notification-table').DataTable({
                "ajax": {
                    "url": "/admin/setting/getNotifications",
                    "dataSrc": "notifications"
                },
                "columns": [
                    {
                        "data": "id",
                        render: function(data, type, row) {
                            // var imagePath = row.global_image ? row.global_image : "{{ asset('assets/master/media/svg/files/blank-image.svg') }}";
                            var imagePath = '';
                            if (row.adm_big_picture !== null) {
                                var imagePath = row.adm_big_picture;
                            } else if (row.global_image !== null) {
                                var imagePath = row.global_image;
                            } else {
                                var imagePath = "{{ asset('assets/master/media/svg/files/blank-image.svg') }}";
                            }
                            return `<div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label">
                                                <img src="${imagePath}" class="w-100" onerror="this.onerror=null;this.src='{{ asset('assets/master/media/svg/files/blank-image.svg') }}';"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.headings.en}</span>
                                            <span>${row.id}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        "data": "contents.en",
                        render: function(data, type, row) {
                            return data.length > 20 ? data.substr(0, 50) + '...' : data;
                        }
                    },
                    {
                        "data": "send_after",
                        "render": function(data, type, row) {
                            return formatTimestamp(data);
                        }
                    },
                    {
                        "data": "id",
                        "render": function(data, type, row) {
                            // return `<button class="btn btn-info" onclick="deleteNotification('${data}')">Detail</button>`;
                            return `<a href="/admin/setting/notification/${row.id}/detail" class="btn btn-primary">Detail</a>`;
                        }
                    }
                ]
            });
        });

        // Delete
        function deleteNotification(notificationId) {
            $.ajax({
                url: '/admin/setting/deleteNotifications',
                type: 'POST',
                data: {
                    notification_ids: [notificationId],
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    $('#notification-table').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    let errorMessage = 'Error: ' + xhr.responseJSON.error;
                    if (xhr.responseJSON.response && xhr.responseJSON.response.errors) {
                        errorMessage += '\n' + xhr.responseJSON.response.errors.join('\n');
                    }
                    alert(errorMessage);
                }
            });
        }
    </script>

    {{-- Store New Message --}}
    <script>
        $('#notification-form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '/admin/setting/storeNotifications',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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