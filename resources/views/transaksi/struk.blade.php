<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Belanja</title>

    <!-- Google Font: Source Sans Pro -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');
    </style>
    <!-- Font Awesome Icons -->
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table td,
        .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .card {
            margin: 15px;
        }

        .card-body {
            padding: 15px;
        }

        .text-center {
            text-align: center;
        }

        .d-flex {
            display: flex;
        }

        .col-2 {
            flex: 2;
        }

        .col-10 {
            flex: 8;
        }

        .row {
            display: flex;
        }

        .gap-1 {
            gap: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Toko Sekar</h3>
                <p class="text-center">Jalan Gajah Mada 2B Beteng, Sidomekar, Semboro <br> Jember 68157</p>
                <table class="table">
                    <tr>
                        <td>
                            <p>ID: #{{ $transaksi->id }}</p>
                        </td>
                        <td>
                            <p>{{ $transaksi->created_at }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Kasir: {{ $transaksi->kasir_name }}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <label for="" class="form-label">Produk</label>
                            </th>
                            <th>
                                <label for="" class="form-label">Harga</label>
                            </th>
                            <th>
                                <label for="" class="form-label">QTY</label>
                            </th>
                            <th>
                                <label for="" class="form-label">Subtotal produk</label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_struk as $item)
                            <tr>
                                <td>
                                    <p>{{ $item->produk_name }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->harga_produk }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->qty }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->subtotal_produk }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>
            <div class="card-body">
                <div class="row">
                    <p><b>Total: </b>{{ $transaksi->total }}</p>
                </div>
                <div class="row">
                    <p><b>Tunai: </b>{{ $transaksi->dibayarkan }}</p>
                </div>
                <div class="row">
                    <p><b>Kembalian: </b>{{ $transaksi->kembalian }}</p>
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
</body>

</html>
