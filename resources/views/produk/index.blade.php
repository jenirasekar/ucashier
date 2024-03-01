<div class="row p-2">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <h5><b>{{ $title }}</b></h5>

                <a href="{{ auth()->user()->role == 'petugas' ? '/produk/create' : '/admin/produk/create' }}"
                    class="btn btn-primary mb-2">Tambah</a>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>

                    @foreach ($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->stok }}</td>
                            <td><img src="{{ Storage::url('public/produk/' . $item->gambar) }}" alt="gambar produk"
                                    style="width: 100px;"></td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ auth()->user()->role == 'petugas' ? '/produk/' . $item->id . '/edit' : '/admin/produk/' . $item->id . '/edit' }}"
                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form
                                        action="{{ auth()->user()->role == 'petugas' ? '/produk/' . $item->id : '/admin/produk/' . $item->id }}"
                                        method="POST" enctype="multipart/form-data">

                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-1"
                                            onclick="confirm('Apakah Anda yakin?')"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>

                <div class="d-flex justify-content-center">
                    {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
