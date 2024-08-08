@extends('layout-master/app')

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Subscribe</h1>
            </div>
            {{-- <button type="button" class="css-kl2kd9a" style="width: 200px;" onclick="addData()">
                <span class="svg-icon svg-icon-2">
                    <i class="fas fa-plus-circle text-white"></i>
                </span>
                Subscribe
            </button> --}}
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableDataSubscribe">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px text-dark">Name</th>
                                <th class="min-w-50px text-dark">Amount</th>
                                <th class="min-w-100px text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($subscribers as $subs)
                            <tr>
                                <td class="align-items-center">{{ $subs->name }}</td>
                                <td class="align-items-center">@rupiah($subs->amount)</td>
                                <td class="align-items-center d-flex">
                                    <button type="button" class="btn btn-md hover-scale fw-bold btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editSubscribe" onclick="editData('{{ $subs->id }}')">Edit</button>
                                    @if ($subs->amount != NULL)
                                        <button type="button" class="btn btn-primary my-1 me-2 btn-sm btn-detail-banner" onclick="detailData('{{ $subs->id }}')">Detail</button>
                                    @endif
                                    <button type="button" class="btn btn-danger my-1 me-2 btn-sm" onclick="deleteData('{{ $subs->id }}')">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Detail Subscriber -->
        <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="modal-title-edit" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="col-xl-12">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-100 py-15 px-10">
                            <div class="mb-7 text-center">
                                <h1 class="text-dark mb-5 fw-bolder" id="nama_subs"></h1>
                                <div class="text-gray-400 fw-semibold mb-5" id="description"></div>
                                <div class="text-center">
                                    <span class="mb-2 text-primary">Rp.</span>
                                    <span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="999" data-kt-plan-price-annual="9999" id="amount"></span>
                                    <span class="fs-7 fw-semibold opacity-50">/
                                    <span data-kt-element="period">Mon</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-edit">Detail Data Subscribe</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Nama :</strong></div>
                            <div class="col-md-8" id="nama_subs"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Price :</strong></div>
                            <div class="col-md-8" id="amount"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Description :</strong></div>
                            <div class="col-md-8" id="description"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Modal Edit Subscribe -->
        <div class="modal fade" id="editSubscribe" tabindex="-1" aria-labelledby="editSubscribeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered css-hfwj9n">
                <div class="modal-content css-hfwj9n">
                    <div class="modal-header" style="border-bottom: 2px solid #dee2e6;">
                        <h3 id="detailProdukModalLabel" style="color: #212121; font-weight: 700; line-height: 26px; font-size: 1.42857rem;">Edit Subscribe</h3>
                    </div>
                    <div class="modal-body pb-1">
                        <!-- Loading spinner -->
                        <div id="loading-spinner" class="text-center" style="display: none;">
                            <div class="spinner-border text-center" role="status">
                                <span class="sr-only text-dark">Loading...</span>
                            </div>
                        </div>
                        <div id="form-container">
                            <form id="update-subscribe-form">
                                <div class="css-con4dhb pb-5">
                                    <div class="css-vcb4djb">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-10 fv-row">
                                                    <input type="hidden" name="id" id="id_update">
                                                    <div class="css-nv9fnkq">
                                                        <label class="form-label css-cnu0jfm">Nama Subscribe</label>
                                                    </div>
                                                    <input type="text" name="subscribe_update" class="form-control form-control-solid mb-2 css-padding" id="subscribe_update" placeholder="Masukkan Nama Subscribe" readonly />
                                                    <span id="subscribe_update_error" style="font-size: .95rem; color: #d90429;"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-10 fv-row">
                                                    <div class="css-nv9fnkq">
                                                        <label class="form-label css-cnu0jfm">Amount</label>
                                                    </div>
                                                    <input type="text" name="amount_update" class="form-control mb-2 css-padding" id="amount_update" placeholder="Masukkan Jumlah Price" oninput="formatPrice(this)" required />
                                                    <span id="amount_update_error" style="font-size: .95rem; color: #d90429;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-10 fv-row">
                                                <div class="css-nv9fnkq">
                                                    <label class="form-label css-cnu0jfm">Description</label>
                                                    <textarea name="description_update" id="description_update" class="form-control mb-2" rows="4" placeholder="Masukkan Deskripsi"></textarea>
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
    {{-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description_update' );
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <!-- Modal Detail Subscribe -->
    <script>
        function detailData(id) {
            $.ajax({
                type: 'GET',
                url: `/admin/setting/subscriber_detail/${id}`,
                success: function(response) {
                    if (response.data) {
                        $('#modal-title-edit').text('Detail Data Subscribe');
                        $('#nama_subs').text(response.data.name);
                        $('#amount').text(formatAngkaValue(response.data.amount));
                        $('#description').html(response.data.description);
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

        function formatAngkaValue(value) {
            var angka = value.toString().replace(/\D/g, '');
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }
    </script>

    <!-- Modal Edit & Update Subscribe -->
    <script>
        function editData(id) {
            document.getElementById('loading-spinner').style.display = 'block';
            document.getElementById('form-container').style.display = 'none';
            
            fetch(`/admin/setting/subscriber_detail/${id}`)
                .then(response => response.json())
                .then(data => {
                    let subscribeData = data.data;
                    document.getElementById('id_update').value = subscribeData.id;
                    document.getElementById('subscribe_update').value = subscribeData.name;
                    if (subscribeData.amount === null) {
                        document.getElementById('amount_update').value = subscribeData.amount;
                    } else {
                        document.getElementById('amount_update').value = formatPriceValue(subscribeData.amount);
                    }
                    document.getElementById('description_update').value = subscribeData.description;
                    // CKEDITOR.instances['description_update'].setData(subscribeData.description);
                    
                    document.getElementById('loading-spinner').style.display = 'none';
                    document.getElementById('form-container').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        document.getElementById('update-subscribe-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Sinkronisasi CKEditor dengan textarea
            // for (instance in CKEDITOR.instances) {
            //     CKEDITOR.instances[instance].updateElement();
            // }

            const formData = new FormData(this);
            const id = document.getElementById('id_update').value;
            
            fetch(`/admin/setting/update_subscribe/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    document.getElementById('subscribe_update_error').textContent = data.errors.subscribe_update || '';
                    document.getElementById('amount_update_error').textContent = data.errors.amount_update || '';
                } else {
                    $('#editSubscribe').modal('hide');
                    document.getElementById('update-subscribe-form').reset();
                    toastr.success(data.message);

                    // Reload table data
                    $('#tableDataSubscribe').load(location.href + " #tableDataSubscribe>*", "");
                }
            })
            .catch(error => {
                console.error('Error updating data:', error);
            });
        });

        function formatPrice(input) {
            var price = input.value.replace(/\D/g, '');
            input.value = price.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        function formatPriceValue(value) {
            var price = value.toString().replace(/\D/g, '');
            return price.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    </script>
@endsection