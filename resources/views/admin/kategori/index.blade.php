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

                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2"><i class="fas fa-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($kategori as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/admin/kategori/{{ $item->id }}/edit"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.kategori.destroy', $item->id) }}"
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
                        {{ $kategori->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
