<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // die('masuk');
        $data = [
            'produk' => Produk::paginate(10),
            'title'     => 'Manajemen Produk',
            'content'   => 'produk/index'
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
        //
        $data = [
            'title'     => 'Tambah Produk',
            'kategori'  => Kategori::get(),
            'content'   => 'produk/create'
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
        //
        $request->validate([
            'name'  => 'required',
            'kategori_id'  => 'required',
            'harga'  => 'required|numeric',
            'stok'  => 'required|numeric',
            'tgl_produksi'  => 'required',
            'tgl_kadaluwarsa'  => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif,jfif,webp',
        ]);

        $image = $request->file('gambar');
        $image->storeAs('public/produk/', $image->hashName());

        // dd($data);
        Produk::create([
            'name'  => $request->name,
            'kategori_id'  => $request->kategori_id,
            'harga'  => $request->harga,
            'stok'  => $request->stok,
            'tgl_produksi'  => $request->tgl_produksi,
            'tgl_kadaluwarsa'  => $request->tgl_kadaluwarsa,
            'gambar' => $image->hashName(),
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');

        return redirect('/produk');
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
    public function edit($id)
    {
        //
        $data = [
            'title'     => 'Tambah Produk',
            'produk' => Produk::find($id),
            'kategori' => Kategori::get(),
            'content'   => 'produk/create'
        ];
        return view('layouts.wrapper', $data);
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
        $produk = Produk::find($id);
        $request->validate([
            'name'  => 'required',
            'kategori_id'  => 'required',
            'harga'  => 'required|numeric',
            'stok'  => 'required|numeric',
            'tgl_produksi'  => 'required',
            'tgl_kadaluwarsa'  => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $image->storeAs('public/produk', $image->hashName());

            if (Storage::exists('public/produk/' . $produk->gambar)) {
                Storage::delete('public/produk/' . $produk->gambar);
            }

            $produk->update([
                'gambar' => $image->hashName(),
                'name'  => $request->name,
                'kategori_id'  => $request->kategori_id,
                'harga'  => $request->harga,
                'stok'  => $request->stok,
                'tgl_produksi'  => $request->tgl_produksi,
                'tgl_kadaluwarsa'  => $request->tgl_kadaluwarsa,
            ]);
        } else {
            $produk->update([
                'name'  => $request->name,
                'kategori_id'  => $request->kategori_id,
                'harga'  => $request->harga,
                'stok'  => $request->stok,
                'tgl_produksi'  => $request->tgl_produksi,
                'tgl_kadaluwarsa'  => $request->tgl_kadaluwarsa,
            ]);
        }

        Alert::success('Sukses', 'Data Berhasil Diedit');

        return redirect('/produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $kategori = Kategori::find($id);
        $produk = Produk::find($id);
        // if ($produk->gambar != null) {
        //     unlink($produk->gambar);

        // }
        $produk->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/produk');
    }
}
