<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kategori' => Kategori::paginate(10),
            'title'     => 'Manajemen Kategori',
            'content'   => 'kategori/index'
        ];
        return view('layouts.wrapper', $data);
    }

    public function indexAdmin()
    {
        $data = [
            'kategori' => Kategori::paginate(10),
            'title'     => 'Manajemen Kategori',
            'content'   => 'admin/kategori/index'
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
            'title'     => 'Tambah Kategori',
            'content'   => 'kategori/create'
        ];
        return view('layouts.wrapper', $data);
    }

    public function createAdmin()
    {
        //
        $data = [
            'title'     => 'Tambah Kategori',
            'content'   => 'admin/kategori/create'
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
            'name'  => 'required|unique:kategoris'
        ]);
        Kategori::create($data);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');

        if (auth()->user()->role == 'petugas') {
            return redirect('/kategori');
        } else {
            return redirect('/admin/kategori');
        }
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
            'title'     => 'Edit Kategori',
            'kategori' => Kategori::find($id),
            'content'   => 'kategori/create'
        ];
        return view('layouts.wrapper', $data);
    }
    public function editAdmin($id)
    {
        //
        $data = [
            'title'     => 'Edit Kategori',
            'kategori' => Kategori::find($id),
            'content'   => 'admin/kategori/create'
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
        $kategori = Kategori::find($id);
        $data = $request->validate([
            'name'  => 'required|unique:kategoris,name,' . $kategori->id
        ]);
        $kategori->update($data);
        Alert::success('Sukses', 'Data Berhasil Diedit');

        if (auth()->user()->role == 'petugas') {
            return redirect('/kategori');
        } else {
            return redirect('/admin/kategori');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');

        if (auth()->user()->role == 'petugas') {
            return redirect('/kategori');
        } else {
            return redirect('/admin/kategori');
        }
    }
}
