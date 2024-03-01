<div class="row p-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="font-family: Arial, sans-serif;">
                <h2 style="text-align: center; margin-bottom: 15px;"><b>{{ $title }}</b></h2>
                <a href="/cetaklaporan" class="btn btn-primary mb-2" style="margin-bottom: 15px;">Cetak
                    laporan</a>
                <table border="1" class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 8px; text-align: left;">No</th>
                            <th style="padding: 8px; text-align: left;">ID Transaksi</th>
                            <th style="padding: 8px; text-align: left;">Total</th>
                            <th style="padding: 8px; text-align: left;">Tanggal & Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr>
                                <td style="padding: 8px;">{{ $loop->iteration }}</td>
                                <td style="padding: 8px;">{{ $item->id }}</td>
                                <td style="padding: 8px;">{{ $item->total }}</td>
                                <td style="padding: 8px;">{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
