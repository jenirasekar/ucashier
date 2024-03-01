<div class="row p-2">
    <div class="col-md-6">
        <div class="card">

            <div class="card-body">
                <h5><b>{{ $title }}</b></h5>

                <hr>

                @isset($produk)
                    <form
                        action="{{ auth()->user()->role == 'petugas' ? '/produk/' . $produk->id : '/admin/produk/' . $produk->id }}"
                        method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                    @endisset
                    <form action="{{ auth()->user()->role == 'petugas' ? '/produk' : '/admin/produk/' }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="" class="form-label">Nama Produk</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Nama Produk"
                                value="{{ isset($produk) ? $produk->name : old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label">Nama Kategori</label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror"
                                id="">
                                <option value="">--Kategori--</option>

                                @foreach ($kategori as $item)
                                    <option value=" {{ $item->id }} "
                                        {{ isset($produk) ? ($item->id == $produk->kategori_id ? 'selected' : '') : '' }}>
                                        {{ $item->name }} </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label"> Harga </label>
                            <input type="number" name="harga"
                                class="form-control @error('harga') is-invalid @enderror" placeholder=" Harga "
                                value="{{ isset($produk) ? $produk->harga : old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label"> Stok</label>
                            <input type="number" name="stok"
                                class="form-control @error('stok') is-invalid @enderror" placeholder="Stok"
                                value="{{ isset($produk) ? $produk->stok : old('stok') }}">
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="col-form-label"> Gambar</label>
                            <input type="file" name="gambar"
                                class="form-control-file @error('gambar') is-invalid @enderror" placeholder="Gambar"
                                value="{{ isset($produk) ? $produk->gambar : old('gambar') }}">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @isset($produk)
                            <img src="/ {{ $produk->gambar }} " width="100px" alt="">
                        @endisset
                        <br>

                        <a href="/produk" class="btn btn-info mt-2">Kembali</a>
                        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    </form>


            </div>
        </div>
    </div>
</div>
