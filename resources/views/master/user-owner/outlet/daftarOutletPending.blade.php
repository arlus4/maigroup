@extends('layout-master/app')

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Outlet Pending</h1>
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
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableOutletPending">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px text-dark">Info Outlet</th>
                                <th class="min-w-100px text-dark">Owner</th>
                                <th class="min-w-100px text-dark">Brand</th>
                                <th class="min-w-100px text-dark">Register</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold"></tbody>
                    </table>
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
            $('#tableOutletPending').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataoutletPending",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: 'outlet_name',
                        render: function(data, type, row) {
                            var imagePath = row.brand_image ? row.brand_image : '/avatar.png';
                            return `<div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label">
                                                <img src="{{ asset('storage/outlet/avatar/${imagePath}') }}" class="w-100"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.outlet_name}</span>
                                            <span>${row.outlet_code}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.name}</span>
                                            <span>${row.email}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'brand_name',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.brand_name} || ${row.brand_code}</span>
                                            <span>${row.brand_category_name}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            // Ubah format tanggal dari YYYY-MM-DDTHH:mm:ss.sssZ menjadi dd-MM-YYYY
                            var date = new Date(data);
                            var day = date.getDate().toString().padStart(2, '0');
                            var month = (date.getMonth() + 1).toString().padStart(2, '0');
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year;
                        }
                    },
                    {
                        data: 'atur',
                        render: function(data, type, row) {
                            return `<div class="dropdown">
                                        <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Atur
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.id}">
                                            <li>
                                                <button onclick="window.location.href = 'detail-outlet/${row.slug}'" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-eye me-2"></i>
                                                    Detail
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="window.location.href = 'edit-outlet/${row.slug}'" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                    Edit
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    }
                ],
            });
        });
    </script>
@endsection