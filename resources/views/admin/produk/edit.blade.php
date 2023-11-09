<div class="container-fluid p-2">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-title m-auto p-2">
                    <h5 style="font-weight: bold">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.produk.update', $produk->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div>
                            <label for="nama" class="col-form-label">Nama Produk</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Produk"
                                value="{{ old('nama', $produk->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="nama" class="col-form-label">Nama Kategori</label>
                            <select name="id_kategori" id="id_kategori"
                                class="form-control @error('id_kategori') is-invalid @enderror">
                                <option value="">--Kategori--</option>
                                {{-- @if ($kategori->id == $produk->id_kategori) --}}
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" selected>{{ $item->nama_kategori }}</option>
                                @endforeach
                                {{-- @endif --}}
                            </select>
                        </div>
                        <div>
                            <label for="harga" class="col-form-label">Harga</label>
                            <input type="number" name="harga" id="harga"
                                class="form-control @error('harga') is-invalid @enderror" placeholder="Harga"
                                value="{{ old('harga', $produk->harga) }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="col-form-label">Stok</label>
                            <input type="number" name="stok" id="stok"
                                class="form-control @error('stok') is-invalid @enderror" placeholder="Stok"
                                value="{{ old('stok', $produk->stok) }}">
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($produk->gambar == null)
                            <img src="/{{ $produk->gambar }}" alt="" style="display:none;">
                        @else
                            <img src="/{{ $produk->gambar }}" alt="" style="width: 100%;">
                        @endif
                        <div>
                            <label for="gambar" class="col-form-label">Gambar</label>
                            <input type="file" name="gambar" id="gambar"
                                class="form-control-file @error('gambar') is-invalid @enderror" placeholder="Gambar"
                                value="{{ old('gambar') }}">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <br>
                        <a href="/admin/user" class="btn btn-info">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
