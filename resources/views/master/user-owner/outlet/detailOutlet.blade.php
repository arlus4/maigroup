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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">View Project</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Projects</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="/admin/outlet-pending" class="btn btn-lg fw-bold btn-primary">Kembali</a>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Navbar-->
                <div class="row g-6 g-xl-9">
                    <div class="col-lg-7">
                        <div class="card mb-6 mb-xl-9">
                            <div class="card-body pt-9 pb-0">
                                <!--begin::Details-->
                                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                    <!--begin::Image-->
                                    <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                        <img class="mw-50px mw-lg-75px" src="{{ asset($outlet->path) }}" alt="image" />
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Wrapper-->
                                    <div class="flex-grow-1">
                                        <!--begin::Head-->
                                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <!--begin::Details-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Status-->
                                                <div class="d-flex align-items-center mb-1">
                                                    <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $outlet->outlet_name }}</a>
                                                </div>
                                                <!--end::Status-->
                                                <!--begin::Description-->
                                                <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-400">{{ $outlet->outlet_code }}</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Head-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap justify-content-start">
                                            <!--begin::Stats-->
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold"> {{ \Carbon\Carbon::parse($outlet->created_at)->format('d F Y') }}</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-semibold fs-6 text-gray-400">Register</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Details-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!--begin::Customer details-->
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
                        <!--end::Customer details-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Row-->
                <div class="row g-6 g-xl-9">
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <!--begin::Card-->
                        <div class="card card-flush h-lg-100">
                            <!--begin::Card header-->
                            <div class="card-header mt-6">
                                <!--begin::Card title-->
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold mb-1">Pegawai</h3>
                                    <div class="fs-6 text-gray-400">From total 482 Participants</div>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View All</a>
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card toolbar-->
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Avatar-->
                                    <div class="me-5 position-relative">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="../../assets/media/avatars/300-6.jpg" />
                                        </div>
                                        <!--end::Image-->
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="fw-semibold">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">Emma Smith</a>
                                        <div class="text-gray-400">8 Pending & 97 Completed Tasks</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <!--begin::Tasks-->
                        <div class="card card-flush h-lg-100">
                            <!--begin::Card header-->
                            <div class="card-header mt-6">
                                <!--begin::Card title-->
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold mb-1">History Transaction</h3>
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
                <!--begin::Table-->
                <div class="card card-flush mt-6 mt-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header mt-5">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h3 class="fw-bold mb-1">Project Spendings</h3>
                            <div class="fs-6 text-gray-400">Total $260,300 sepnt so far</div>
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
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
                        <!--begin::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                <!--begin::Head-->
                                <thead class="fs-7 text-gray-400 text-uppercase">
                                    <tr>
                                        <th class="min-w-250px">Manager</th>
                                        <th class="min-w-150px">Date</th>
                                        <th class="min-w-90px">Amount</th>
                                        <th class="min-w-90px">Status</th>
                                        <th class="min-w-50px text-end">Details</th>
                                    </tr>
                                </thead>
                                <!--end::Head-->
                                <!--begin::Body-->
                                <tbody class="fs-6">
                                    <tr>
                                        <td>
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Wrapper-->
                                                <div class="me-5 position-relative">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="../../assets/media/avatars/300-6.jpg" />
                                                    </div>
                                                    <!--end::Avatar-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="#" class="fs-6 text-gray-800 text-hover-primary">Emma Smith</a>
                                                    <div class="fw-semibold text-gray-400">smith@kpmg.com</div>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                        </td>
                                        <td>Apr 15, 2022</td>
                                        <td>$476.00</td>
                                        <td>
                                            <span class="badge badge-light-info fw-bold px-4 py-3">In progress</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Wrapper-->
                                                <div class="me-5 position-relative">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Online-->
                                                    <div class="bg-success position-absolute h-8px w-8px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                                    <!--end::Online-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="#" class="fs-6 text-gray-800 text-hover-primary">Melody Macy</a>
                                                    <div class="fw-semibold text-gray-400">melody@altbox.com</div>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                        </td>
                                        <td>Mar 10, 2022</td>
                                        <td>$747.00</td>
                                        <td>
                                            <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Wrapper-->
                                                <div class="me-5 position-relative">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="../../assets/media/avatars/300-1.jpg" />
                                                    </div>
                                                    <!--end::Avatar-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="#" class="fs-6 text-gray-800 text-hover-primary">Max Smith</a>
                                                    <div class="fw-semibold text-gray-400">max@kt.com</div>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                        </td>
                                        <td>Sep 22, 2022</td>
                                        <td>$504.00</td>
                                        <td>
                                            <span class="badge badge-light-info fw-bold px-4 py-3">In progress</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Wrapper-->
                                                <div class="me-5 position-relative">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="../../assets/media/avatars/300-5.jpg" />
                                                    </div>
                                                    <!--end::Avatar-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="#" class="fs-6 text-gray-800 text-hover-primary">Sean Bean</a>
                                                    <div class="fw-semibold text-gray-400">sean@dellito.com</div>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                        </td>
                                        <td>Apr 15, 2022</td>
                                        <td>$470.00</td>
                                        <td>
                                            <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Wrapper-->
                                                <div class="me-5 position-relative">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="../../assets/media/avatars/300-25.jpg" />
                                                    </div>
                                                    <!--end::Avatar-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="#" class="fs-6 text-gray-800 text-hover-primary">Brian Cox</a>
                                                    <div class="fw-semibold text-gray-400">brian@exchange.com</div>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                        </td>
                                        <td>Apr 15, 2022</td>
                                        <td>$409.00</td>
                                        <td>
                                            <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Wrapper-->
                                                <div class="me-5 position-relative">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <span class="symbol-label bg-light-warning text-warning fw-semibold">C</span>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Online-->
                                                    <div class="bg-success position-absolute h-8px w-8px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                                    <!--end::Online-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="#" class="fs-6 text-gray-800 text-hover-primary">Mikaela Collins</a>
                                                    <div class="fw-semibold text-gray-400">mik@pex.com</div>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                        </td>
                                        <td>Mar 10, 2022</td>
                                        <td>$633.00</td>
                                        <td>
                                            <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-sm">View</a>
                                        </td>
                                    </tr>
                                </tbody>
                                <!--end::Body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Table-->
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
                                <input type="hidden" name="id" class="form-control id" id="id" value="{{ $outlet->id }}" readonly>
                                <div class="form-group mb-3">
                                    <label style="color: #31353B!important;font-weight: 600;">Outlet Code</label>
                                    <input type="text" class="form-control outlet_code form-control-solid" value="{{ $outlet->outlet_code }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label style="color: #31353B!important;font-weight: 600;">Outlet Name</label>
                                    <input type="text" class="form-control outlet_name form-control-solid" value="{{ $outlet->outlet_name }}" readonly>
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
    <!--end::Content wrapper-->

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

@endsection