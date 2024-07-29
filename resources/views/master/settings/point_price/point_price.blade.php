@extends('layout-master/app')

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Point Price</h1>
            </div>
            <button type="button" class="css-kl2kd9a" style="width: 200px;" onclick="addData()">
                <span class="svg-icon svg-icon-2">
                    <i class="fas fa-plus-circle text-white"></i>
                </span>
                Point Price
            </button>
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableDataPoint">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px text-dark">Point</th>
                                <th class="min-w-100px text-dark">Price</th>
                                <th class="min-w-100px text-dark">User Create</th>
                                <th class="min-w-100px text-dark">User Update</th>
                                <th class="min-w-100px text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($pointPrices as $point)
                            <tr>
                                <td class="align-items-center">{{ $point->point }}</td>
                                <td class="align-items-center">@rupiah($point->price)</td>
                                <td class="align-items-center">{{ $point->users_create }}</td>
                                <td class="align-items-center">{{ $point->users_update }}</td>
                                <td class="align-items-center d-flex">
                                    <button type="button" class="btn btn-md hover-scale fw-bold btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editPoint" onclick="editData('{{ $point->id }}')">Edit</button>
                                    <button type="button" class="btn btn-primary my-1 me-2 btn-sm btn-detail-banner" onclick="detailData('{{ $point->id }}')">Detail</button>
                                    <button type="button" class="btn btn-danger my-1 me-2 btn-sm" onclick="deleteData('{{ $point->id }}')">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Add Point -->
        <div class="modal fade" id="modal_add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form-save">
                        @csrf
                        <div class="form-group mb-3">
                            <label style="color: #31353B!important;font-weight: 600;">Point</label>
                            <input type="text" name="point" class="form-control point" id="point" placeholder="Input Point" oninput="formatAngka(this)" required>
                        </div>
                        <div class="form-group mb-3">
                            <label style="color: #31353B!important;font-weight: 600;">Price</label>
                            <input type="text" name="price" class="form-control price" id="price" placeholder="Input Price" oninput="formatPrice(this)" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                            Batalkan
                        </button>
                        <button type="submit" id="save" class="css-kl2kd9a">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Point -->
        <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="modal-title-edit" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-edit">Detail Data Request Point</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Point :</strong></div>
                            <div class="col-md-8" id="point_detail"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Price :</strong></div>
                            <div class="col-md-8" id="price_detail"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Created :</strong></div>
                            <div class="col-md-8" id="created_at"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Updated :</strong></div>
                            <div class="col-md-8" id="updated_at"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>User Created :</strong></div>
                            <div class="col-md-8" id="users_create"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>User Updated :</strong></div>
                            <div class="col-md-8" id="users_update"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Point -->
        <div class="modal fade" id="editPoint" tabindex="-1" aria-labelledby="editPointLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered css-hfwj9n">
                <div class="modal-content css-hfwj9n">
                    <div class="modal-header" style="border-bottom: 2px solid #dee2e6;">
                        <h3 id="detailProdukModalLabel" style="color: #212121; font-weight: 700; line-height: 26px; font-size: 1.42857rem;">Atur Point Transaksi Outlet Anda</h3>
                    </div>
                    <div class="modal-body pb-1">
                        <!-- Loading spinner -->
                        <div id="loading-spinner" class="text-center" style="display: none;">
                            <div class="spinner-border text-center" role="status">
                                <span class="sr-only text-dark">Loading...</span>
                            </div>
                        </div>
                        <div id="form-container">
                            <form id="update-point-form">
                                <div class="css-con4dhb pb-5">
                                    <div class="css-vcb4djb">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-10 fv-row">
                                                    <input type="hidden" name="id" id="id_update">
                                                    <div class="css-nv9fnkq">
                                                        <label class="form-label css-cnu0jfm">Point</label>
                                                    </div>
                                                    <input type="text" name="point_update" class="form-control mb-2 css-padding" id="point_update" placeholder="Masukkan Jumlah Point" oninput="formatAngka(this)" required />
                                                    <span id="point_update_error" style="font-size: .95rem; color: #d90429;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-10 fv-row">
                                                    <div class="css-nv9fnkq">
                                                        <label class="form-label css-cnu0jfm">Amount</label>
                                                    </div>
                                                    <input type="text" name="price_update" class="form-control mb-2 css-padding" id="price_update" placeholder="Masukkan Jumlah Price" oninput="formatPrice(this)" required />
                                                    <span class="badge badge-light-primary" style="font-size: .95rem">Lorem ipsum dolor sit amet.</span>
                                                    <span id="price_update_error" style="font-size: .95rem; color: #d90429;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger my-1 me-2" data-bs-dismiss="modal">
                                                <span>Tidak Jadi</span>
                                            </button>
                                            <button type="submit" class="btn btn-success my-1 me-2">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <!-- Modal Tambah Point -->
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function addData(){
            $('#idPoint').val('');
            $('#modal_add').modal('show');
            $('#modal-title').text('Tambah Point Price');
            $('#point').val('');
            $('#price').val('');
            $('#save').text('Simpan');
        }

        function formatAngka(input) {
            let value = input.value.replace(/,/g, '');
            if (!isNaN(value)) {
                input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            } else {
                input.value = input.value.slice(0, -1);
            }
        }

        function formatPrice(input) {
            let value = input.value.replace(/,/g, '');
            if (!isNaN(value)) {
                input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            } else {
                input.value = input.value.slice(0, -1);
            }
        }

        $(document).ready(function() {
            $('#form-save').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_add').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/setting/store_point_price",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr[response.status](response.message);
                        $('#tableDataPoint').load(' #tableDataPoint');
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });
    </script>

    <!-- Modal Detail Point -->
    <script>
        function detailData(id) {
            $.ajax({
                type: 'GET',
                url: `/admin/setting/detail_point_price/${id}`,
                success: function(response) {
                    if (response.data) {
                        $('#modal-title-edit').text('Detail Data Point Price');
                        $('#point_detail').text(response.data.point);
                        $('#price_detail').text(formatRupiah(response.data.price));
                        $('#created_at').text(formatDate(response.data.created_at));
                        $('#updated_at').text(formatDate(response.data.updated_at));
                        $('#users_create').text(response.data.users_create);
                        $('#users_update').text(response.data.users_update);
                        $('#modal_detail').modal('show');
                    } else {
                        toastr.error("Data tidak ditemukan.");
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            });
        }

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }
    </script>

    <!-- Modal Edit & Update Point -->
    <script>
        function editData(id) {
            document.getElementById('loading-spinner').style.display = 'block';
            document.getElementById('form-container').style.display = 'none';
            
            fetch(`/admin/setting/detail_point_price/${id}`)
                .then(response => response.json())
                .then(data => {
                    let pointData = data.data;
                    document.getElementById('id_update').value = pointData.id;
                    document.getElementById('point_update').value = formatAngkaValue(pointData.point);
                    document.getElementById('price_update').value = formatPriceValue(pointData.price);
                    
                    document.getElementById('loading-spinner').style.display = 'none';
                    document.getElementById('form-container').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    
        document.getElementById('update-point-form').addEventListener('submit', function(event) {
            event.preventDefault();
    
            const formData = new FormData(this);
            
            fetch('/admin/setting/update_point_price', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    document.getElementById('id_update_error').textContent = data.errors.id || '';
                    document.getElementById('point_update_error').textContent = data.errors.point_update || '';
                    document.getElementById('price_update_error').textContent = data.errors.price_update || '';
                } else {
                    $('#editPoint').modal('hide');
                    document.getElementById('update-point-form').reset();
                    toastr.success(data.message);

                    // Reload table data
                    $('#tableDataPoint').load(location.href + " #tableDataPoint>*", "");
                }
            })
            .catch(error => {
                console.error('Error updating data:', error);
            });
        });
    
        function formatAngka(input) {
            var angka = input.value.replace(/\D/g, '');
            input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    
        function formatPrice(input) {
            var price = input.value.replace(/\D/g, '');
            input.value = price.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    
        function formatAngkaValue(value) {
            var angka = value.toString().replace(/\D/g, '');
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    
        function formatPriceValue(value) {
            var price = value.toString().replace(/\D/g, '');
            return price.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    </script>

    <!-- Modal Hapus Point -->
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function deleteData(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda ingin hapus data point ini ?",
                icon: 'warning',
                cancelButtonText: "Batal",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Ya, saya yakin!`
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/setting/delete_point_price',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id : id
                    },
                    success: function(response) {
                        toastr[response.status](response.message);
                        $('#tableDataPoint').load(' #tableDataPoint');
                    },
                    error: function (xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
                }
            })
        }
    </script>

@endsection