<div class="row p-2">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <h5><b>{{ $title }}</b></h5>

                <a href="{{ auth()->user()->role == 'petugas' ? '/kategori/create' : '/admin/kategori/create' }}"
                    class="btn btn-primary mb-2">Tambah</a>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>

                    </tr>

                    @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ auth()->user()->role == 'petugas' ? '/kategori/' . $item->id . '/edit' : '/admin/kategori/' . $item->id . '/edit' }}"
                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form
                                        action="{{ auth()->user()->role == 'petugas' ? '/kategori/' . $item->id : '/admin/kategori/' . $item->id }}"
                                        method="POST">
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
                    {{ $kategori->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
