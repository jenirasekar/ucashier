<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Monitoring Produk',
            'produk' => Produk::paginate(10),
            'content' => 'admin.produk.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'content' => 'admin.produk.create',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|unique:kategori',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,png,svg',
        ]);

        Produk::create($data);


        Alert::success('Sukses', 'Data berhasil disimpan!');
        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil disimpan!');
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
        $data = [
            'produk' => Produk::find($id),
            'title' => 'Tambah Produk',
            'content' => 'admin.produk.edit',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $produk = Produk::find($id);
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategori',
        ]);

        $produk->update($data);


        Alert::success('Sukses', 'Data berhasil diubah!');
        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        Alert::success('Sukses', 'Data berhasil dihapus!');
        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil dihapus!');
    }
}
