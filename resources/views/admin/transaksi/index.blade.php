<div class="container-fluid p-2">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-title m-auto p-2">
                    <h5 style="font-weight: bold">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <a href="/admin/transaksi/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>

                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2"><i class="fas fa-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                {{-- <th>Nama transaksi</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td>{{ $item->nama }}</td>
                                    <td>{{ $item->id_kategori }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->stok }}</td> --}}
                                    <td>
                                        <div class="d-flex">
                                            <a href="/admin/transaksi/{{ $item->id }}/edit"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.transaksi.destroy', $item->id) }}"
                                                method="post">
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

                    <div class="d-flex justify-content-center">
                        {{-- {{ $kategori->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
