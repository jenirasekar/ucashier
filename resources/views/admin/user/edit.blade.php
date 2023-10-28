<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>Edit Data</b></h4>
                    <div class="form-group">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name" class="col-form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Email"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="col-form-label">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="re_password" class="col-form-label">Konfirmasi Password</label>
                                <input type="password" name="re_password" id="re_password"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Konfirmasi Password" value="{{ old('re_password') }}">
                                @error('re_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <br>
                            <a href="/admin/user" class="btn btn-info">Kembali</a>
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
