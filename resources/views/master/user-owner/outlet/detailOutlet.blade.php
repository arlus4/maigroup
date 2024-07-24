@extends('layout-master/app')

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">View Project</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="../../index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Projects</li>
                    </ul>
                </div>
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="/admin/outlet-active" class="btn btn-lg fw-bold btn-primary">Kembali</a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="row g-6 g-xl-9">
                    <div class="col-lg-7">
                        <div class="card mb-6 mb-xl-9">
                            <div class="card-body pt-9 pb-0">
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                    <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                        <img class="mw-50px mw-lg-75px" src="{{ asset($outlet->path) }}" alt="image" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-1">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $outlet->outlet_name }}</a>
                                                </div>
                                                <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-400">{{ $outlet->outlet_code }}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 pe-8">
                                            <div class="d-flex">
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold"> {{ \Carbon\Carbon::parse($outlet->created_at)->format('d F Y') }}</div>
                                                    </div>
                                                    <div class="fw-semibold fs-6 text-gray-400">Register</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!--begin::Owner-->
                        <div class="card card-flush flex-row-fluid">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="d-flex flex-column mt-3">
                                            <div class="d-flex align-items-center mb-1">
                                                <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $owner->name }}</a>
                                            </div>
                                            <div class="d-flex flex-wrap fw-semibold mb-1 fs-5 text-gray-400">Owner</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                                <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        Email
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href="javascript:;" class="text-gray-600 text-hover-primary">{{ $owner->email }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        Phone
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $owner->no_hp }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end::Owner-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Row-->
                <div class="row g-6 g-xl-9">
                    <!--begin::Pegawai-->
                    <div class="col-lg-4">
                        <div class="card card-flush h-lg-100">
                            <div class="card-header mt-6">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold mb-1">Pegawai</h3>
                                    <div class="fs-6 text-gray-400">Total {{ $pegawai->total() }} Pegawai</div>
                                </div>
                                @if ($pegawai->total() >= 5)
                                    <div class="card-toolbar">
                                        <a href="javascript:;" class="btn btn-bg-light btn-active-color-primary btn-sm" onclick="listPegawai()">View All</a>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                                @if ($pegawai->isEmpty())
                                    <span class="badge badge-light-info fw-bold px-4 py-3">Belum Memiliki Pegawai</span>
                                @else
                                    @foreach ($pegawai as $p)
                                        <div class="d-flex align-items-center mb-5">
                                            <div class="fw-semibold">
                                                <a href="javascript:;" class="fs-5 fw-bold text-gray-900 text-hover-primary">{{ $p->name }}</a>
                                                <div class="text-gray-400">{{ $p->email }}</div>
                                            </div>
                                            @if ($p->is_active == 1)
                                                <div class="badge badge-success ms-auto">Active</div>
                                            @else
                                                <div class="badge badge-danger ms-auto">Non-Active</div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--end::Pegawai-->
                    
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Tasks-->
                        <div class="card card-flush h-lg-100">
                            <!--begin::Card header-->
                            <div class="card-header mt-6">
                                <!--begin::Card title-->
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold mb-1">History Transaction [Masih Template]</h3>
                                    <div class="fs-6 text-gray-400">Total 25 tasks in backlog</div>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View All</a>
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column mb-9 p-9 pt-3">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center position-relative mb-7">
                                    <!--begin::Label-->
                                    <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                    <!--end::Label-->
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                        <input class="form-check-input" type="checkbox" value="" />
                                    </div>
                                    <!--end::Checkbox-->
                                    <!--begin::Details-->
                                    <div class="fw-semibold">
                                        <a href="#" class="fs-6 fw-bold text-gray-900 text-hover-primary">Create FureStibe outleting logo</a>
                                        <!--begin::Info-->
                                        <div class="text-gray-400">Due in 1 day
                                            <a href="#">Karina Clark</a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Tasks-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Table Product-->
                <div class="card card-flush mt-6 mt-xl-9">
                    <div class="card-header mt-5">
                        <div class="card-title flex-column">
                            <h3 class="fw-bold mb-1">Product {{ $outlet->outlet_name }}</h3>
                        </div>
                        <div class="card-toolbar my-1">
                            <!--begin::Select-->
                            <div class="me-6 my-1">
                                <select id="kt_filter_year" name="year" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                    <option value="All" selected="selected">All time</option>
                                    <option value="thisyear">This year</option>
                                    <option value="thismonth">This month</option>
                                    <option value="lastmonth">Last month</option>
                                    <option value="last90days">Last 90 days</option>
                                </select>
                            </div>
                            <!--end::Select-->
                            <!--begin::Select-->
                            <div class="me-4 my-1">
                                <select id="kt_filter_orders" name="orders" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                    <option value="All" selected="selected">All Orders</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Declined">Declined</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="In Transit">In Transit</option>
                                </select>
                            </div>
                            <!--end::Select-->
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-3 position-absolute ms-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" id="kt_filter_search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Order" />
                            </div>
                            <!--end::Search-->
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table id="product_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                <thead class="fs-7 text-gray-800 text-uppercase">
                                    <tr>
                                        <th class="min-w-250px">Product</th>
                                        <th class="min-w-150px">Category</th>
                                        <th class="min-w-90px">Price</th>
                                        <th class="min-w-90px">Stock</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-6"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Table Product-->

                <!--Modal::Detail List Pegawai-->
                <div class="modal fade" id="modal_list">
                    <div class="modal-dialog modal-dialog-centered mw-1000px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableListPegawai">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-100px text-dark">Nama</th>
                                                <th class="min-w-100px text-dark">Email</th>
                                                <th class="min-w-100px text-dark">Nomor HP</th>
                                                <th class="min-w-100px text-dark">Register</th>
                                                <th class="min-w-100px text-dark">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                    Close
                                </button>
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
    <script>
        // Datatable List Pegawai
        $(document).ready(function() {
           $('#tableListPegawai').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataPegawaiOutlet/{{ $outlet->slug }}",
                    dataType: "JSON"
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'no_hp' },
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
                        data: "Status",
                        render: function(data, type, row) {
                            if (row.is_active == 1) {
                                return '<span class="badge badge-light-success fw-bold px-4 py-3">Active</span>';
                            } else {
                                return '<span class="badge badge-light-danger fw-bold px-4 py-3">Non-Active</span>';
                            }
                        }
                    },
                ],
           });
        });

        function listPegawai() {
            $('#modal_list').modal('show');
            $('#modal-title').text('List Pegawai');
        }

        // Datatable Product Outlet
        $(document).ready(function() {
            $('#product_table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataProductOutlet/{{ $outlet->slug }}",
                    dataType: "JSON"
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: "Product",
                        render: function(data, type, row) {

                            var imagePath;
                            // Check for null or empty image path
                            if (!row.image || row.image.trim() === '') {
                                imagePath = '<span class="symbol-label bg-light-danger text-danger fw-semibold">P</span>';
                            } else {
                                imagePath = '{{ asset("' + row.image + '") }}';
                            }

                            return `<div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-5">
                                            <div class="symbol-label">
                                                ${imagePath}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.product_name}</span>
                                            <span class="text-gray-500" >${row.slug}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    { data: 'category_name' },
                    {
                        data: 'price',
                        render: function (data, type, row) {
                            // Convert price to number
                            const price = parseFloat(data) || 0;

                            // Format price as Rupiah (without ".00")
                            const formattedPrice = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0, // Set minimum fraction digits to 0
                                maximumFractionDigits: 0 // Set maximum fraction digits to 0
                            }).format(price);

                            return formattedPrice;
                        }
                    },
                    { data: 'stock' },
                ],
            });
        });
    </script>

@endsection