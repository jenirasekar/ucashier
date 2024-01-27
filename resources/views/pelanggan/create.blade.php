<div class="row p-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5><b>{{ $title }}</b></h5>
                <hr>
                @isset($pelanggan)
                    <form action="/pelanggan/ {{ $pelanggan->id }} " method="POST">
                        @method('PUT')
                    @else
                        <form action="/pelanggan" method="POST">
                        @endisset
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan"
                                class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                placeholder="Nama pelanggan"
                                value="{{ isset($pelanggan) ? $pelanggan->nama_pelanggan : old('nama_pelanggan') }}">
                            @error('nama_pelanggan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mt-2">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control">{{ isset($pelanggan) ? $pelanggan->alamat : old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group mt-2">
                                    <label for="">No Telepon</label>
                                    <input type="text" name="no_tlp"
                                        class="form-control @error('no_tlp') is-invalid @enderror"
                                        placeholder="Nama pelanggan"
                                        value="{{ isset($pelanggan) ? $pelanggan->no_tlp : old('no_tlp') }}">
                                    @error('no_tlp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <a href="/pelanggan" class="btn btn-info mt-2">Kembali</a>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    </form>
            </div>
        </div>
    </div>
</div>
