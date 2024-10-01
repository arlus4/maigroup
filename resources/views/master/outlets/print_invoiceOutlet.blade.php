<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="css-nkf9dja">
        <div class="css-dbam4njs">
            <div>
                <img src="{{ asset('assets/img/bg_tokoseru.png') }}" width="180">
            </div>
            <div>
                <h4>Invoice</h4>
                <span>#{{ $dataInvoice->invoice_no }}</span>
            </div>
        </div>

        <div class="css-fnk8sjn">
            <div class="css-ndak7dn">
                <div class="css-xgh78dn">
                    <div class="css-hd3shka">DITERBTIKAN ATAS NAMA</div>
                    <div class="css-fn3dkn">
                        <span class="css-dnk9dna">Nama Outlet</span>
                        <p class="css-ndk5bdj mb-0">&nbsp;&nbsp;{{ $dataOutlet->outlet_name }}</p>
                    </div>
                    <div class="css-fn3dkn">
                        <span class="css-dnk9dna">Kode Outlet</span>
                        <p class="css-ndk5bdj mb-0">&nbsp;&nbsp;{{ $dataOutlet->outlet_code }}</p>
                    </div>
                    <div class="css-fn3dkn">
                        <span class="css-dnk9dna">Alamat Outlet</span>
                        <p class="css-ndk5bdj mb-0">&nbsp;&nbsp;{{ $dataOutlet->alamat_detail }}, {{ $dataOutlet->alamat }}, {{ $dataOutlet->kode_pos }}</p>
                    </div>
                </div>
                <div class="css-xgh78dn">
                    <div class="css-hd3shka">INFO PEMESANAN</div>
                    <div class="css-fn3dkn">
                        <span class="css-dnk9dna" style="width: 132px">Tanggal Pemesanan</span>
                        <p class="css-ndk5bdj mb-0" id="tanggalPemesanan">&nbsp;&nbsp;{{ $dataInvoice->date_created }}</p>
                    </div>
                    <div class="css-fn3dkn">
                        <span class="css-dnk9dna" style="width: 132px">Pembeli</span>
                        <p class="css-ndk5bdj mb-0">&nbsp;&nbsp;{{ $dataInvoice->nama_pembeli ?? 'Pembeli Belum Terdaftar' }}</p>
                    </div>
                    <div class="css-fn3dkn">
                        <span class="css-dnk9dna" style="width: 132px">Kasir</span>
                        <p class="css-ndk5bdj mb-0">&nbsp;&nbsp;{{ $dataInvoice->nama_pegawai }}</p>
                    </div>
                </div>
            </div>
            <div class="css-nc35nks">
                <!-- Product Table -->
                <div class="d-flex justify-content-between flex-column">
                    <div class="table-responsive mb-9">
                        <table class="w-100">
                            <thead class="css-xs4nkdsc">
                                <tr class="fs-6 fw-bold text-muted">
                                    <th class="min-w-175px text-white" style="padding: 16px 18px">Produk</th>
                                    <th class="min-w-100px text-white" style="padding: 16px 18px; text-align: right">Kategori</th>
                                    <th class="min-w-70px text-white" style="padding: 16px 18px; text-align: right">Harga</th>
                                    <th class="min-w-80px text-white" style="padding: 16px 18px; text-align: right">Jumlah</th>
                                    <th class="min-w-100px text-white" style="padding: 16px 18px; text-align: right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600">
                                @foreach($detailInvoice as $item)
                                    <tr>
                                        <td style="padding: 14px 16px;">{{ $item->product_name }}</td>
                                        <td style="padding: 14px 16px; text-align: right">{{ $item->category_name }}</td>
                                        <td style="padding: 14px 16px; text-align: right" class="rupiahPemesanan">{{$item->price}}</td>
                                        <td style="padding: 14px 16px; text-align: right">{{ $item->qty }}</td>
                                        <td style="padding: 14px 16px; text-align: right" class="rupiahPemesanan">{{ $item->amount}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-end text-dark fw-bold" colspan="4">Total</th>
                                    <td style="padding: 14px 16px; text-align: right" class="rupiahPemesanan text-dark fw-bold">{{ $dataInvoice->amount }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <hr>

                        <!-- Signature Section -->
                        <div class="css-cvnaw9dn">
                            <p>Hormat Kami,</p><br>
                            <p>{{ $dataInvoice->nama_pemilik }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="css-nfw8fkn">
            <p class="css-dwj7dna">©Powered by Toko Seru</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to format currency
        function formatRupiah(angka) {
            // Menghapus karakter non-digit
            angka = angka.replace(/[^\d]/g, '');
            
            // Mengkonversi string ke integer
            angka = parseInt(angka);
            
            // Cek apakah angka adalah NaN
            if (isNaN(angka)) {
                return 'Rp. 0'; // Return default if conversion fails
            }

            // Format angka ke format Rupiah
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp. ' + ribuan;
        }
    
        // Function to format date
        function formatTanggal(tanggal) {
            var date = new Date(tanggal);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
        }
    
        // Apply date formatting after the page has loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Format the date
            var tanggalElement = document.getElementById('tanggalPemesanan');
            if (tanggalElement) {
                var originalTanggal = tanggalElement.innerText;
                tanggalElement.innerText = formatTanggal(originalTanggal);
            }

            // Format all elements with the class 'rupiahPemesanan'
            var rupiahElements = document.querySelectorAll('.rupiahPemesanan');
            rupiahElements.forEach(function(element) {
                var originalRupiah = element.innerText.trim(); // Menghapus spasi yang tidak diperlukan
                element.innerText = formatRupiah(originalRupiah);
            });
        });
    
        // Trigger print
        window.print();
    </script>
</body>
</html>