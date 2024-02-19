<div class="card">
    <div class="card-body">
        <form action="{{ route('detailtransaksi.store') }}" method="post" id="form_detail_transaksi">
            @csrf
            <input type="hidden" name="produk_name" id="nama_produk"
                value="{{ isset($detail_produk) ? $detail_produk->name : '' }}">
            <input type="hidden" name="transaksi_id" value="{{ isset($transaksi) ? $transaksi->id : '' }}">
            <input type="hidden" name="subtotal" id="subtotal">
            <div class="form-group row">
                <div class="col-2">
                    <label for="id_pelanggan">Pelanggan</label>
                </div>
                <div class="col-10">
                    <select name="pelanggan_id" id="id_pelanggan" class="form-control">
                        <option value="">Nama Pelanggan</option>
                        @foreach ($pelanggan_list as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-2">
                    <label for="id_produk">Kode produk</label>
                </div>
                <div class="col-10">
                    <select name="produk_id" id="id_produk" class="form-control">
                        <option value="">Pilih produk</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->id }}" data-harga="{{ $item->harga }}">{{ $item->name }} -
                                ({{ $item->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-2">
                    <label for="harga">Harga</label>
                </div>
                <div class="col-10">
                    <input type="number" name="harga" id="harga" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-2">
                    <label for="qty">QTY</label>
                </div>
                <div class="col-10">
                    <input type="number" name="qty" id="qty" class="form-control">
                </div>
            </div>
            <div class="btn-tambah mt-2">
                <button type="submit" class="btn btn-info" id="btn-tambah">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="card mt-1">
    <div class="card-body">
        <table class="table" id="table_produk">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>QTY</th>
                    <th>Subtotal</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody id="tbody_produk">
                @foreach ($detail_transaksi as $item)
                    <tr>
                        <td>{{ $item->produk_name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->subtotal }}</td>
                        <td>
                            <a href="/transaksi/detail/delete?id={{ $item->id }}" class="fas fa-times"
                                data-id="{{ $item->id }}"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-group row mt-5">
            <div class="col-1">
                <label for="subtotal">Total</label>
            </div>
            <div class="col-3">
                <input type="number" name="" id="total" class="form-control" readonly>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let total = 0;
        // mengisi harga, nama produk, dan qty based on selected id_produk
        $('#id_produk').on('change', function() {
            let harga_terpilih = $('#id_produk option:selected').data('harga');
            let nama_produk = $('#id_produk option:selected').text();
            $('#harga').val(harga_terpilih);
            $('#nama_produk').val(nama_produk);
        });

        $('#qty').on('input', function() {
            updateSubtotal();
        });

        function updateSubtotal() {
            let qty = $('#qty').val();
            let harga = $('#harga').val();

            if (qty && harga) {
                let subtotal = parseInt(qty) * parseInt(harga);
                $('#subtotal').val(parseInt(subtotal));
            } else {
                $('#subtotal').val('');
            }
        }

        $('#form_detail_transaksi').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Add your logic to send the form data to the server using AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    // Assuming the server responds with the new detail_transaksi item
                    let newRow = `<tr>
                        <td>${response.produk_name}</td>
                        <td>${response.qty}</td>
                        <td>${response.subtotal}</td>
                        <td>
                            <a href="/transaksi/detail/delete?id=${response.id}" class="fas fa-times"></a>
                        </td>
                    </tr>`;

                    $('#tbody_produk').append(newRow);

                    // Update the total
                    total += parseInt(response.subtotal);
                    $('#total').val(total);

                    // Reset the form
                    $('#form_detail_transaksi')[0].reset();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });
</script>
