@extends('layout-master/app')

@section('content')
    <style>
        .wrap-text {
            white-space: normal !important;
            width: 400px;
        }
    </style>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Artikel</h1>
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
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Artikel" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="{{ route('admin.admin_create_artikel') }}" class="css-kl2kd9a" style="color:#fff!important;line-height: 40px;">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                Tambah Artikel
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px text-dark">Headline</th>
                                    <th class="min-w-125px text-dark">Caption</th>
                                    <th class="min-w-125px text-dark">Created at</th>
                                    <th class="min-w-125px text-dark">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($artikels as $artikel)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <div class="symbol-label">
                                                    <img src="{{ asset('storage/artikel/thumbnail/' . $artikel->thumbnail) }}" class="w-100" />
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1">{{ $artikel->headline }}</span>
                                                <span>{{ $artikel->news_code }}</span>
                                            </div>
                                        </td>
                                        <td class="align-items-center wrap-text">
                                            {{ $artikel->caption }}
                                        </td>
                                        <td class="align-items-center">
                                            {{ \Carbon\Carbon::parse($artikel->created_date)->format('d F Y') }}
                                        </td>
                                        <td class="align-items-center d-flex">
                                            <a href="{{ route('admin.admin_edit_artikel', $artikel->id) }}" class="btn btn-md hover-scale fw-bold btn-warning btn-sm me-2">Edit</a>
                                            <a href="{{ route('admin.admin_show_artikel', $artikel->id) }}" class="btn btn-md hover-scale fw-bold btn-primary btn-sm me-2"">Detail</a>
                                            <button type="button" class="btn btn-danger my-1 me-2 btn-sm" data-artikel-id="{{ $artikel->id }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</button>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="content-header">
                    <div class="content-title">
                        <h4 class="css-lk3jsp">Hapus Produk</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="css-flj2ej">
                    <div class="css-fjkpo0ma">
                        <div class="css-wj23sk">
                            <form action="" method="POST" id="deleteArtikelForm">
                                @csrf
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <input type="hidden" name="artikel_id" id="artikel_id">
                                    <div class="col-md-12 fv-row" >
                                        <span style="font-size: 15px">
                                            Apakah Anda yakin untuk menghapus Artikel Promo ini?
                                        </span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="css-ca2jq0s" style="width: 80px;" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="css-kl2kd9a">
                                        <span class="indicator-label">Ya, saya yakin</span>
                                    </button>
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

    <!-- Modal Hapus Artikel -->
    <script>
        var modalDelete = document.getElementById('modalDelete');
        modalDelete.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var artikelId = button.getAttribute('data-artikel-id');
            var form = document.getElementById('deleteArtikelForm');
            form.action = '/admin/artikel/destroy_artikel/' + artikelId;
        });

        setTimeout(function() {
            document.querySelector('.alert.alert-success').remove();
        }, 3000);

        setTimeout(function() {
            document.querySelector('.alert.alert-danger').remove();
        }, 3000);
    </script>
@endsection