@extends('owner/layout-sidebar/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Tambah Restock Order</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form action="{{ route('owner.owner_store_restock_order') }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
						<div class="tab-content">
                            <input type="hidden" name="outlet_id" value="{{ Auth::user()->outlet_id }}">
							<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
								<div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                                        <div class="css-cuod2sp">
                                            <div class="css-cop8db2b">
                                                <div class="css-hj3ska">
                                                    <span>Tambah Paket</span>
                                                </div>
                                                <div class="css-kolp9jd">
                                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis totam veritatis, voluptas voluptatibus ex blanditiis hic ipsum ipsa atque eum.<br><br>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero autem, facere sunt ea ad iste?
                                                </div>
                                            </div>
                                            <div class="css-n9gj4ms">
                                                <div>
                                                    <div class="input-group text-center"
                                                        data-kt-dialer="true"
                                                        data-kt-dialer-currency="true"
                                                        data-kt-dialer-min="0"
                                                        data-kt-dialer-max="50">
                                                        <button class="btn btn-icon btn-outline btn-active-color-primary" type="button" data-kt-dialer-control="decrease">
                                                            <i class="fas fa-minus fs-2"></i>
                                                        </button>
                                                        <input type="text" name="qtyPaket" class="form-control" readonly data-kt-dialer-control="input"/>
                                                        <button class="btn btn-icon btn-outline btn-active-color-primary" type="button" data-kt-dialer-control="increase">
                                                            <i class="fas fa-plus fs-2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 16px;">Pengelolaan Varian</h2>
											</div>
										</div>
										<div class="card-body pt-0">
                                            <div id="data_restock_order">
                                                <div class="form-group">
                                                    <div data-repeater-list="data_restock_order">
                                                        <div data-repeater-item>
                                                            <div class="css-dabj72">
                                                                <div class="form-group mb-4">
                                                                    <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Pilihan Varian</label>
                                                                    <select class="form-select mb-2 produkId" data-kt-repeater="select2" data-placeholder="Pilih Varian" id="produk_id" data-allow-clear="true" name="id_produk" required>
                                                                        <option></option>
                                                                        @foreach($getProduk as $produk)
                                                                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">SKU Code</label>
                                                                        <input type="text" name="sku_id" id="sku_code" class="form-control mb-2 sku_code" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="####" readonly>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Project</label>
                                                                        <input type="text" name="project_name" id="project_name" class="form-control mb-2 project_name" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="####" readonly>
                                                                        <input type="hidden" name="id_project" id="id_project" class="form-control mb-2 id_project" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="####" readonly>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Harga Satuan</label>
                                                                        <input type="text" name="harga_satuan" id="harga-satuan" class="form-control mb-2 harga-satuan" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="Rp 0" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col-md-5">
                                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">QTY</label>
                                                                        <select class="form-select qtyid" data-kt-repeater="select2" id="qty" name="qty" data-placeholder="Pilih QTY">
                                                                            <option></option>
                                                                            @for ($i = 5; $i <= 100; $i += 5)
                                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Total Harga</label>
                                                                        <button type="button" class="border-0 bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Total Harga = Harga Satuan * Jumlah QTY">
                                                                            <i class="fas fa-info-circle" style="color: #212121;"></i>
                                                                        </button>
                                                                        <input type="text" name="amount" id="amount" class="form-control mb-2 amount" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="Rp 0" readonly>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <a href="javascript:;" data-repeater-delete>
                                                                            <i class="fas fa-trash text-danger" style="font-size: 18px;margin-top: 35px;"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Catatan</label>
                                                        <input type="text" name="noted" id="noted" class="form-control mb-2" placeholder="Contoh : Bakso & soto, Jajanan, Minuman"/>
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
            $('#data_restock_order').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2"]').select2();
                    $(this).find('.qtyid').select2();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function(){
                    $('[data-kt-repeater="select2"]').select2();
                }
            });

            $(document).on('change', '.form-select', function() {
                updateProductDetails($(this).closest('[data-repeater-item]'));
            });

            $(document).on('click', '[data-repeater-create]', function() {
                var newItem = $(this).closest('[data-repeater-group]').find('[data-repeater-item]:last');
                resetFields(newItem);
                newItem.find('.select2').select2();
            });

            $(document).on('change', '.produkId, .qtyid', function() {
                var item = $(this).closest('[data-repeater-item]');
                hitungTotalAmount(item);
            });
        });

        function resetFields(item) {
            item.find('.harga-satuan, .amount, .sku_code, .id_project, .project_name').val('').trigger('change');
        }

        function updateProductDetails(item) {
            var productId = item.find('.produkId').val();
            var qty       = item.find('.qtyid').val();

            $.ajax({
                url: 'get-harga-order-penjual/' + productId,
                type: 'GET',
                success: function(response) {
                    var hargaSatuan = parseFloat(response.harga.replace(/\D/g, ''));
                    if (!isNaN(qty) && !isNaN(hargaSatuan)) {
                        var totalAmount = hargaSatuan * qty;
                        item.find('.amount').val(formatRupiah(totalAmount)).trigger('change');
                    } else {
                        item.find('.amount').val('');
                    }
                    
                    item.find('.sku_code').val(response.sku);
                    item.find('.project_name').val(response.project_name);
                    item.find('.id_project').val(response.id_project);
                    item.find('.harga-satuan').val(formatRupiah(response.harga));
                },
                error: function(error) {
                    console.error('Gagal memuat harga:', error);
                    item.find('.amount').val('');
                }
            });
        }

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

        function hitungTotalAmount(item) {
            var qty                 = parseFloat(item.find('.qty').val());
            var hargaSatuanString   = item.find('.harga-satuan').val();
            var numbersFromString   = hargaSatuanString.match(/\d+/g);
            var hargaSatuanCleaned  = numbersFromString ? numbersFromString.join('') : '';
            var hargaSatuan         = parseFloat(hargaSatuanCleaned);

            if (!isNaN(qty) && !isNaN(hargaSatuan)) {
                var totalAmount = hargaSatuan * qty;
                item.find('.amount').val(formatRupiah(totalAmount));
            } else {
                item.find('.amount').val('');
            }
        }
    </script>
@endsection