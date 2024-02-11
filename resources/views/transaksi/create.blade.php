<div class="bs-stepper">
    <div class="bs-stepper-header" role="tablist">
        <!-- your steps here -->
        <div class="step" data-target="#products-part">
            <button type="button" class="step-trigger" role="tab" aria-controls="products-part"
                id="products-part-trigger">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Produk</span>
            </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#payments-part">
            <button type="button" class="step-trigger" role="tab" aria-controls="payments-part"
                id="payments-part-trigger">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Pembayaran</span>
            </button>
        </div>
    </div>
    <div class="bs-stepper-content">
        <!-- your steps content here -->
        <div id="products-part" class="content" role="tabpanel" aria-labelledby="products-part-trigger">
            <div class="row p-2">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mt-1">
                                <div class="col-md-4">
                                    <label for="">Kode Produk</label>
                                </div>
                                <div class="col-md-8">
                                    <form method="GET">
                                        <div class="d-flex">
                                            <select name="produk_id" class="form-control" id="">
                                                <option value="">
                                                    --{{ isset($p_detail) ? $p_detail->name : 'Nama Produk' }}--
                                                </option>
                                                @foreach ($produk as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->id . ' - ' . $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary">Pilih</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <form action="/transaksi/detail/create" method="POST">
                                @csrf

                                <input type="hidden" name="transaksi_id" value="{{ Request::segment(2) }}">
                                <input type="hidden" name="produk_id"
                                    value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                                <input type="hidden" name="produk_name"
                                    value="{{ isset($p_detail) ? $p_detail->name : '' }}">
                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                                <div class="row mt-1">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Nama Produk</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ isset($p_detail) ? $p_detail->name : '' }}"
                                            class="form-control" disabled name="nama_produk">
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-4">
                                        <label for="">Harga Satuan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ isset($p_detail) ? $p_detail->harga : '' }}"
                                            class="form-control" disabled name="harga_satuan">
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-4">
                                        <label for="">QTY</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex">
                                            <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}"
                                                class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                            <input type="number" value="{{ $qty }}" class="form-control"
                                                name="qty">

                                            <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}"
                                                class="btn btn-primary"><i class="fas fa-plus"></i></a>


                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-8">
                                        <h5>Subtotal : Rp. {{ format_rupiah($subtotal) }}</h5>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-8">
                                        <a href="/transaksi" class="btn btn-info">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="tabel-produk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>QTY</th>
                                        <th>Subtotal</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi_detail as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->produk_name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ 'Rp.' . format_rupiah($item->subtotal) }}</td>
                                            <td>
                                                <a href="/transaksi/detail/delete?id={{ $item->id }}"><i
                                                        class="fas fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <form action="{{ route('updatePelanggan', Request::segment(2)) }}" id="form-pembayaran">
                                <div class="row mt-5 mb-3">
                                    <div class="col-md-4">
                                        <label for="pelanggan">Pelanggan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                                            <option value="">
                                                --{{ isset($pelanggan) ? $pelanggan->nama_pelanggan : 'Nama Pelanggan' }}--
                                            </option>
                                            @if ($pelanggan_list)
                                                @foreach ($pelanggan_list as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $transaksi->pelanggan_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->id . ' - ' . $item->nama_pelanggan }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success btn-next"
                                    onclick="updatePelanggan()">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="payments-part" class="content" role="tabpanel" aria-labelledby="payments-part-trigger">
            <div class="row p-2">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('pembayaran', Request::segment(2)) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Total Belanja</label>
                                    <input type="number" value="{{ $transaksi->total }}" name="total"
                                        class="form-control" id="total_transaksi">
                                </div>

                                <div class="form-group">
                                    <label for="">Dibayarkan</label>
                                    <input type="number" name="dibayarkan" value="{{ request('dibayarkan') }}"
                                        class="form-control" id="dibayarkan">
                                </div>

                                <button type="button" class="btn btn-primary" id="btnHitung">Hitung</button>
                                <button type="button" class="btn btn-success" onclick="pembayaran()">Bayar</button>
                                <button type="button" class="btn btn-secondary btn-prev">Lihat detail</button>

                                <hr>

                                <div class="form-group">
                                    <label for="">Uang Kembalian</label>
                                    <input type="number" readonly name="kembalian" class="form-control"
                                        id="kembalian">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var stepper = new Stepper(document.querySelector('.bs-stepper'), {
            linear: false
        });

        document.querySelector('.btn-prev').addEventListener('click', function() {
            stepper.previous();
        });

        document.querySelector('.btn-next').addEventListener('click', function(event) {
            event.preventDefault();

            if (isRow()) {
                updatePelanggan();
            }
        });

        function isRow() {
            const tabel = document.querySelector('#tabel-produk');
            const rows = tabel.querySelectorAll('tbody tr');
            return rows.length > 0;
        }

        function updatePelanggan() {
            $.ajax({
                type: 'GET',
                url: '{{ route('updatePelanggan', Request::segment(2)) }}',
                data: {
                    pelanggan_id: $("#pelanggan_id").val()
                },
                success: function(response) {
                    if (response.success) {
                        stepper.to(2);
                    } else {
                        alert('Transaksi gagal!');
                    }
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        function pembayaran() {
            var dibayarkanValue = $("#dibayarkan").val();
            var kembalianValue = $("#kembalian").val();

            $.ajax({
                type: 'POST',
                url: '{{ route('pembayaran', Request::segment(2)) }}',
                data: {
                    dibayarkan: dibayarkanValue,
                    kembalian: kembalianValue
                },
                success: function(response) {
                    if (response.success) {
                        window.open("{{ route('cetakStruk', Request::segment(2)) }}")
                        window.location = "{{ route('table-transaksi') }}";
                    } else {
                        alert('Pembayaran gagal!');
                    }
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    });

    // hitung pembayaran
    const btnHitung = document.getElementById('btnHitung');

    btnHitung.addEventListener('click', function() {
        const totalTransaksi = parseInt(document.getElementById('total_transaksi').value);
        const dibayarkan = parseInt(document.getElementById('dibayarkan').value);
        const inputKembalian = document.getElementById('kembalian');

        const kembalian = dibayarkan - totalTransaksi;
        inputKembalian.value = kembalian;
    });
</script>
