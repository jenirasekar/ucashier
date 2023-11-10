<div class="container-fluid p-2">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-title m-auto p-2">
                    <h5 style="font-weight: bold">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="id_produk" class="col-form-label">Kode Produk</label>
                        </div>
                        <div class="col-md-8">
                            <select name="id_produk" id="id_produk" class="form-control">
                                <option value="">--Nama Produk--</option>

                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="nama_produk" class="col-form-label">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="harga_satuan" class="col-form-label">Harga satuan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="harga_satuan" id="harga_satuan" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="qty" class="col-form-label">QTY</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <button class="btn btn-primary"><i class="fas fa-minus"></i></button>
                                <input type="number" name="qty" id="qty" class="form-control">
                                <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="harga_satuan" class="col-form-label">Harga satuan</label>
                        </div>
                        <div class="col-md-8">
                            <h5>Subtotal</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
