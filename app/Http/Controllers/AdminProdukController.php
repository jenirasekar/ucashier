<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'kategori' => Kategori::get(),
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
            'nama' => 'required|unique:produk',
            'id_kategori' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png,svg,jfif'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . "_" . $gambar->getClientOriginalName();

            $storage = 'uploads/images/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        } else {
            $data['gambar'] = null;
        }

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
