<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Toko Seru - Nusantara</title>

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootsnav.css" >
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.4.0/css/all.min.css">

    </head>
	
	<body>
        <div class="css-login">
            <div class="css-vnm2snk">
                <img class="css-bg-login" src="{{ asset('assets/images/bg_login.png') }}">
                <section class="css-ghj2sja css-cnfm2nsa">
                    <h4 class="css-text-mai">Toko Seru Nusantara</h4>
                    <div class="css-vbaj2ns">
                        <h3 class="css-fhk3js">Masuk</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="css-pogn2ns">
                        <form class="css-cabj2s" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="css-fb2kakd">
                                <label for="" class="css-label">Username atau No HP</label>
                                <input type="text" name="input_type" class="form-control" required>
                            </div>
                            <div class="css-fb2kakd">
                                <label for="" class="css-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="css-btn-masuk">
                                Masuk
                            </button>
                        </form>
                    </div>
                    <span class="css-syarat-bawah">Dengan masuk atau daftar Toko Seru Nusantara, saya menyetujui Syarat & Ketentuan serta Kebijakan Privasi yang berlaku.</span>
                </section>
            </div>
        </div>
    </body>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</html>
</body>