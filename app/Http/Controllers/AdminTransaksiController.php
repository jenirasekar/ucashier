<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Monitoring Produk',
            'transaksi' => Transaksi::paginate(10),
            'content' => 'admin.transaksi.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->addTransaksi();
        $id_produk = request('id');
        $p_detail = Produk::find($id_produk);

        // $detail_transaksi = DetailTransaksi::whereTransaksiId($id);

        $act = request('act');
        $qty = request('qty');
        if ($act == 'min') {
            if ($qty <= 1) {
                $qty = 1;
            } else {
                $qty = $qty - 1;
            }
        } else {
            $qty = $qty + 1;
        }

        $subtotal = 0;
        if ($p_detail) {
            $subtotal = $qty * $p_detail->harga;
        }

        $data = [
            'title' => 'Tambah Transaksi',
            'transaksi' => Transaksi::get(),
            'produk' => Produk::get(),
            'p_detail' => $p_detail,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'detail_transaksi' => DetailTransaksi::get(),
            'content' => 'admin.transaksi.create',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    protected function addTransaksi()
    {
        $data = [
            'id_user' => auth()->user()->id,
            'nama_kasir' => auth()->user()->name,
            'total' => 0,
        ];

        Transaksi::create($data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $produk = Produk::get();

        $id_produk = request('id');
        $p_detail = Produk::find($id_produk);

        $detail_transaksi = DetailTransaksi::whereTransaksiId($id)->get();

        $act = request('act');
        $qty = request('qty');
        if ($act == 'min') {
            if ($qty <= 1) {
                $qty = 1;
            } else {
                $qty = $qty - 1;
            }
        } else {
            $qty = $qty + 1;
        }

        $subtotal = 0;
        if ($p_detail) {
            $subtotal = $qty * $p_detail->harga;
        }

        $data = [
            'title' => 'Tambah Transaksi',
            'transaksi' => Transaksi::get(),
            'produk' => Produk::get(),
            'p_detail' => $p_detail,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'detail_transaksi' => $detail_transaksi,
            'content' => 'admin.transaksi.create',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
