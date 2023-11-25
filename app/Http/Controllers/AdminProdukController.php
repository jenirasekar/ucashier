<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
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
        $data = $request->validate([
            'name'  => 'required',
            'kategori_id'  => 'required',
            'harga'  => 'required|numeric',
            'stok'  => 'required|numeric',
            'gambar' => 'nullable'
        ]);

        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            $file_name = time()."_".$gambar->getClientOriginalName();

            $storage = 'uploads/image/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        }else {
            $data['gambar'] = null;
        }



        // dd($data);
        Produk::create($data);
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
        $data = $request->validate([
            'name'  => 'required',
            'kategori_id'  => 'required',
            'harga'  => 'required|numeric',
            'stok'  => 'required|numeric',
        ]);

        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            $file_name = time()."_".$gambar->getClientOriginalName();

            $storage = 'uploads/image/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        }else {
            $data['gambar'] = $produk->gambar;
        }

        $produk->update($data);
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
