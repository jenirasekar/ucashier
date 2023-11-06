<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Monitoring Kategori',
            'kategori' => Kategori::paginate(10),
            'content' => 'admin.kategori.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
            'content' => 'admin.kategori.create',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategori',
        ]);

        Kategori::create($data);


        Alert::success('Sukses', 'Data berhasil disimpan!');
        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil disimpan!');
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
            'kategori' => Kategori::find($id),
            'title' => 'Tambah Kategori',
            'content' => 'admin.kategori.edit',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $kategori = Kategori::find($id);
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategori',
        ]);

        $kategori->update($data);


        Alert::success('Sukses', 'Data berhasil diubah!');
        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        Alert::success('Sukses', 'Data berhasil dihapus!');
        return redirect()->route('admin.kategori.index')->with('success', 'Data berhasil dihapus!');
    }
}
