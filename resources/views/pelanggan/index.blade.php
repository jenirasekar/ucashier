<div class="row p-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5><b>{{ $title }}</b></h5>
                <a href="/pelanggan/create" class="btn btn-primary mb-2">Tambah</a>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($pelanggan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_tlp }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/pelanggan/{{ $item->id }}/edit" class="btn btn-info btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="/pelanggan/{{ $item->id }}" method="POST">
                                        @method('DELETE')
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
                    {{ $pelanggan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
