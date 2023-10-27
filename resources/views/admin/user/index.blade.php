<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/admin/user/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>

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
                                    <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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