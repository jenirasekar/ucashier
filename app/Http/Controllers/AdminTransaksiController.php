<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\transaksiDetail;

class AdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'     => 'Riwayat transaksi',
            'transaksi' => Transaksi::orderBy('created_at', 'DESC')->paginate(10),
            'content'   => 'transaksi/index'
        ];
        return view('layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaksi_id =  request('id');
        $transaksi = Transaksi::find($transaksi_id);
        $detail_transaksi = TransaksiDetail::where('transaksi_id', $transaksi_id)->get();
        $pelanggan_id = request('id');
        $pelanggan = Pelanggan::find($pelanggan_id);
        $pelanggan_list = Pelanggan::all();
        $produk = Produk::where('stok', '>', 0)->get();
        $produk_id = request('produk_id');
        $detail_produk = Produk::find($produk_id);

        $data = [
            'content' => 'transaksi/create',
            'transaksi' => $transaksi,
            'title'     => 'Tambah transaksi',
            'produk'    => $produk,
            'detail_produk'  => $detail_produk,
            'detail_transaksi'  => $detail_transaksi,
            'pelanggan' => $pelanggan,
            'pelanggan_list' => $pelanggan_list,
        ];
        return view('layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi_id =  request('transaksi_id');
        $transaksi = Transaksi::find($transaksi_id);

        $data = [
            'total'     => $request->total,
            'dibayarkan' => $request->dibayarkan,
            'kembalian' => $request->kembalian,
            'status' => 'selesai',
        ];
        $transaksi->update($data);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
