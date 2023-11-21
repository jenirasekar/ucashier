<div class="container-fluid p-2">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-title m-auto p-2">
                    <h5 style="font-weight: bold">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="id" class="col-form-label">Kode Produk</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <select name="id" id="id" class="form-control">
                                        <option value="">--
                                            {{ isset($p_detail) ? $p_detail->nama : 'Nama Produk' }} --</option>
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->id }}">{{ $item->id . ' - ' . $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('detailtransaksi.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="id_transaksi" value="1">
                        <input type="hidden" name="id_produk" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                        <input type="hidden" name="nama_produk" value="{{ isset($p_detail) ? $p_detail->nama : '' }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="nama_produk" class="col-form-label">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                                    value="{{ isset($p_detail) ? $p_detail->nama : '' }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="harga_satuan" class="col-form-label">Harga satuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="harga_satuan" id="harga_satuan" class="form-control"
                                    value="{{ isset($p_detail) ? $p_detail->harga : '' }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="qty" class="col-form-label">QTY</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="/admin/transaksi/create?id={{ request('id') }}&act=min&qty={{ $qty }}"
                                        class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                    <input type="number" name="qty" id="qty" class="form-control"
                                        value="{{ $qty }}">
                                    <a href="/admin/transaksi/create?id={{ request('id') }}&act=plus&qty={{ $qty }}"
                                        class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <h5>Subtotal: Rp. {{ $subtotal }}</h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <a href="/admin/transaksi" class="btn btn-info">Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>QTY</th>
                                    <th>Subtotal</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->subtotal }}</td>
                                    <td><a href=""><i class="fas fa-times"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-8">
                            <a href="" class="btn btn-success">Pending</a>
                            <a href="" class="btn btn-primary">Selesai</a>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="total_belanja" class="form-label">Total Belanja</label>
                            <input type="number" name="total_belanja" id="total_belanja" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dibayarkan" class="form-label">Dibayarkan</label>
                            <input type="number" name="dibayarkan" id="dibayarkan" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Hitung</button>
                        </div>
                        <div class="form-group">
                            <label for="kembalian" class="form-label">Uang Kembalian</label>
                            <input type="number" name="kembalian" id="kembalian" class="form-control" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
