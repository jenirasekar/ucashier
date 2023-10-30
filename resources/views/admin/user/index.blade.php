<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/admin/user/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>

                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2"><i class="fas fa-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- user table --}}
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/admin/user/{{ $item->id }}/edit"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            {{-- <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a> --}}
                                            <form action="/admin/user/{{ $item->id }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm ml-1" type="submit"
                                                    onclick="return confirm('Apakah Anda yakin?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
