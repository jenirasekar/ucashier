<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Belanja</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/vendor/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/admin/dist/css/adminlte.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center fw-bold">Toko Sekar</h3>
                <p class="text-center">Jalan Gajah Mada 2B Beteng, Sidomekar, Semboro <br> Jember 68157</p>
                <div class="row">
                    <div class="col-6 d-flex gap-1">
                        <p>ID: #{{ $data_struk->id }}</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $data_struk->created_at }}</p>
                    </div>
                </div>
                <p>Kasir: {{ $data_struk->kasir_name }}</p>
            </div>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <label for="" class="form-label">Produk</label>
                    </div>
                    <div class="col-3">
                        <label for="" class="form-label">Harga</label>
                    </div>
                    <div class="col-3">
                        <label for="" class="form-label">QTY</label>
                    </div>
                    <div class="col-3">
                        <label for="" class="form-label">Total</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p>{{ $data_struk->produk_name }}</p>
                    </div>
                    <div class="col-3">
                        <p>{{ $data_struk->harga }}</p>
                    </div>
                    <div class="col-3">
                        <p>{{ $data_struk->qty }}</p>
                    </div>
                    <div class="col-3">
                        <p>{{ $data_struk->harga }}</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label for="" class="form-label">Subtotal</label>
                    </div>
                    <div class="col-10">
                        <p>{{ $data_struk->subtotal }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="" class="form-label">Total</label>
                    </div>
                    <div class="col-10">
                        <p>{{ $data_struk->total }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="" class="form-label">Tunai</label>
                    </div>
                    <div class="col-10">
                        <p>{{ $data_struk->dibayarkan }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label for="" class="form-label">Kembalian</label>
                    </div>
                    <div class="col-10">
                        <p>{{ $data_struk->kembalian }}</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body text-center">
                <p>Terima kasih telah berbelanja di toko kami</p>
                <p>Barang yang telah dibeli tidak dapat dikembalikan</p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/vendor/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/vendor/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/vendor/admin/dist/js/adminlte.min.js"></script>
</body>

</html>
