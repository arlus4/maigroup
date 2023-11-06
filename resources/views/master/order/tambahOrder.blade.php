@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Tambah Order</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form action="{{ route('admin.admin_store_product') }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
						<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
							<div class="card-header">
								<div class="card-title">
									<h2 style="font-size: 16px;">Informasi Outlet</h2>
								</div>
							</div>
							<div class="card-body pt-0">
                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Pilihan Outlet</label>
                                <select class="form-select mb-2" data-control="select2" data-placeholder="Pilih Outlet" data-allow-clear="true" name="outlet_id" required>
                                    <option></option>
                                    @foreach($getOutlet as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->nama_outlet }} - {{ $outlet->outlet_id }}</option>
                                    @endforeach
                                </select>
                                <div class="text-muted fs-7 mb-5" style="color: #31353B!important;">Pilih outlet dengan benar, ya.</div> 
							</div>
						</div>
					</div>
					<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
								<div class="d-flex flex-column gap-7 gap-lg-10">
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 16px;">Pengelolaan Produk</h2>
											</div>
										</div>
										<div class="card-body pt-0">
                                            <div id="kt_docs_repeater_advanced">
                                                <div class="form-group">
                                                    <div data-repeater-list="kt_docs_repeater_advanced">
                                                        <div data-repeater-item>
                                                            <div class="css-dabj72">
                                                                <div class="form-group mb-4">
                                                                    <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Pilihan Produk</label>
                                                                    <select class="form-select mb-2" data-kt-repeater="select2" data-placeholder="Pilih Produk" id="produk_id" data-allow-clear="true" name="project_id" required>
                                                                        <option></option>
                                                                        @foreach($getProduk as $produk)
                                                                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }} - {{ $produk->sku }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-4">
                                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Harga Satuan</label>
                                                                    <input type="text" name="harga_satuan" id="harga-satuan" class="form-control mb-2" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="Rp 0" readonly>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col-md-5">
                                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">QTY</label>
                                                                        <input type="number" name="qty" id="qty" class="form-control mb-2" placeholder="Contoh : 5" required/>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Total Harga</label>
                                                                        <input type="text" name="amount" id="amount" class="form-control mb-2" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="Rp 0" readonly>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <a href="javascript:;" data-repeater-delete>
                                                                            <i class="fas fa-trash text-danger" style="font-size: 18px;margin-top: 35px;"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Catatan</label>
                                                                    <input type="text" name="noted" id="noted" class="form-control mb-2" placeholder="Contoh : Bakso & soto, Jajanan, Minuman"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-5">
                                                    <a href="javascript:;" data-repeater-create class="css-kl2kd9a" style="color: #fff!important;width: 100px;padding:7px 16px;">
                                                        <i class="fas fa-plus-circle text-white"></i>&nbsp;
                                                        Tambah
                                                    </a>
                                                </div>
                                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a id="kt_ecommerce_add_product_cancel" class="css-ca2jq0s">Batalkan</a>
							<button type="submit" class="css-kl2kd9a">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#kt_docs_repeater_advanced').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2"]').select2();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function(){
                    $('[data-kt-repeater="select2"]').select2();
                }
            });

            $(document).on('change', 'select.form-select', function() {
                kontrolUbahSelect($(this));
            });

            $(document).on('click', '[data-repeater-create]', function() {
                var newItem = $(this).closest('[data-repeater-group]').find('[data-repeater-item]:last');

                newItem.find('#harga-satuan, #amount').val(''); // Reset nilai

                newItem.find('input[id="qty"], input[id="harga-satuan"]').on('input', function() {
                    hitungTotalAmount(newItem);
                });

                newItem.find('#project_id').change(function() {
                    var productId = $(this).val();
                    $.ajax({
                        url: 'get-harga-order/' + productId,
                        type: 'GET',
                        success: function(response) {
                            var harga = response.harga.replace(/\D/g, '');
                            newItem.find('#harga-satuan').val(formatRupiah(parseFloat(harga)));
                            hitungTotalAmount(newItem);
                        },
                        error: function(error) {
                            console.error('Failed to fetch price:', error);
                        }
                    });
                });
            });

            $(document).on('change', 'input[id="qty"], input[id="harga-satuan"]', function() {
                hitungTotalAmount($(this).closest('[data-repeater-item]'));
            });
        });

        function formatRupiah(angka) {
            var number_string   = angka.toString();
            var split           = number_string.split('.');
            var sisa            = split[0].length % 3;
            var rupiah          = split[0].substr(0, sisa);
            var ribuan          = split[0].substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }

        function kontrolUbahSelect(element) {
            var productId  = element.val();
            var hargaInput = element.closest('.css-dabj72').find('input[id="harga-satuan"]');

            $.ajax({
                url: 'get-harga-order/' + productId,
                type: 'GET',
                success: function(response) {
                    var harga = response.harga.replace(/\D/g, '');
                    hargaInput.val(formatRupiah(parseFloat(harga)));
                },
                error: function(error) {
                    console.error('Gagal memuat harga:', error);
                }
            });
        }

        function hitungTotalAmount(item) {
            var qty = parseFloat(item.find('input[id="qty"]').val().replace(',', '.'));
            var hargaSatuanString = item.find('input[id="harga-satuan"]').val();
            var numbersFromString = hargaSatuanString.match(/\d+/g);
            var hargaSatuanCleaned = numbersFromString ? numbersFromString.join('') : '';
            var hargaSatuan = parseFloat(hargaSatuanCleaned);

            if (!isNaN(qty) && !isNaN(hargaSatuan)) {
                var totalAmount = hargaSatuan * qty;
                item.find('#amount').val(formatRupiah(totalAmount));
            } else {
                item.find('#amount').val('');
            }
        }
    </script>

@endsection