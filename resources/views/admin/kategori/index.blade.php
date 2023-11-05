{{-- <h1>hai mas <span style="text-transform: lowercase">{{ auth()->user()->name }}</span> kiw kiw </h1> --}}
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-title m-auto p-2">
                    <h5 style="font-weight: bold">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <a href="/admin/kategori/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>

                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Snack</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/kategori/edit" class="btn btn-sm btn-info"><i
                                                class="fas fa-edit"></i></a>
                                        {{-- <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a> --}}
                                        <form action="" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm ml-1" type="submit"
                                                onclick="return confirm('Apakah Anda yakin?')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
