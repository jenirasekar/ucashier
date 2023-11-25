<div class="row p-2">
    <div class="col-md-6">
        <div class="card">

            <div class="card-body">
            <h5><b>{{ $title }}</b></h5>

            <hr>

            @isset ($kategori)
                <form action="/kategori/ {{ $kategori->id}} " method="POST">
            @method('PUT')
            @else

            @endisset
                <form action="/kategori" method="POST">
            
            @csrf
            <label for="">Nama Kategori</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Kategori" value="{{ isset($kategori) ? $kategori->name : old('name') }}">
            @error('name') 
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror

            <a href="/kategori" class="btn btn-info mt-2">Kembali</a>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>

                
            </div>
        </div>
    </div>
</div>