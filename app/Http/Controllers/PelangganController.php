<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pelanggan' => Pelanggan::paginate(10),
            'title'     => 'Manajemen Pelanggan',
            'content'   => 'pelanggan/index'
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
        $data = [
            'title'     => 'Tambah Pelanggan',
            'content'   => 'pelanggan/create'
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
        $data = $request->validate([
            'nama_pelanggan'  => 'required',
            'alamat'          => 'required',
            'no_tlp'          => 'required'
        ]);
        Pelanggan::create($data);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');

        return redirect('/pelanggan');
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
        $data = [
            'title'     => 'Edit Pelanggan',
            'pelanggan' => Pelanggan::find($id),
            'content'   => 'pelanggan/create'
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
        $pelanggan = Pelanggan::find($id);
        $data = $request->validate([
            'nama_pelanggan'  => 'required',
            'alamat'          => 'required',
            'no_tlp'          => 'required',
        ]);
        $pelanggan->update($data);
        Alert::success('Sukses', 'Data Berhasil Diedit');

        return redirect('/pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/pelanggan');
    }
}
