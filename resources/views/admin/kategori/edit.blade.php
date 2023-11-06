{{-- <h1>hai mas <span style="text-transform: lowercase">{{ auth()->user()->name }}</span> kiw kiw </h1> --}}
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-title m-auto p-2">
                    <h5 style="font-weight: bold">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div>
                            <label for="nama_kategori" class="col-form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Nama Kategori"
                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                            @error('nama_kategori')
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