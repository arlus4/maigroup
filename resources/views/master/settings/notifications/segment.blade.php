@extends('layout-master/app')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Segments Notification</h1>
            </div>
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

            <div class="row d-flex">
                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h4 class="text-dark fw-bold fs-4">List Segments Notification</h4>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalSendMessage">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fas fa-plus-circle text-white"></i>
                                    </span>
                                    New Segments
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="segment-table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px text-dark">Name</th>
                                        <th class="min-w-100px text-dark">Status</th>
                                        <th class="min-w-100px text-dark">Created</th>
                                        <th class="min-w-100px text-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="segment-table" class="text-gray-600 fw-semibold"></tbody>
                            </table>
                        </div>
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
        $(document).ready(function() {
            $('#segment-table').DataTable({
                "ajax": {
                    "url": "/admin/setting/getSegments",
                    "dataSrc": "segments"
                },
                "columns": [
                    { "data": "name" },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            if (row.is_active) {
                                return `<span class="badge badge-success">Active</span>`;
                            } else {
                                return `<span class="badge badge-danger">Inactive</span>`;
                            }
                        }
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                let date = new Date(data);
                                let day = String(date.getDate()).padStart(2, '0');
                                let month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero based
                                let year = date.getFullYear();
                                return `${day}-${month}-${year}`;
                            }
                            return data;
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return `<a href="/admin/setting/segments/${row.id}/edit" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <button class="btn btn-sm btn-primary" onclick="deleteSegment(${row.id})">Detail</button>`;
                        }
                    }
                ],
            });
        });
    </script>
@endsection