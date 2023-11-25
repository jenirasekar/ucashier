<div class="row p-2">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <h5><b>{{ $title }}</b></h5>

                <a href="/transaksi/create" class="btn btn-primary mb-2">Tambah</a>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>Action</th>

                    </tr>

                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/transaksi/{{ $item->id }}/edit" class="btn btn-info btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <!-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a> -->
                                    <form action="/transaksi/{{ $item->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-1" onclick="confirm('Apakah Anda yakin?')"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <div class="d-flex justify-content-center">
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
