<?php

namespace App\Http\Controllers;

use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Monitoring User',
            'user' => User::get(),
            'content' => 'admin.user.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function indexDashboard()
    {
        $data = [
            'content' => 'admin.dashboard.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'content' => 'admin.user.create',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        User::create($data);

        Alert::success('Sukses', 'Data berhasil disimpan!');
        return redirect()->route('admin.user.index')->with('success', 'Data berhasil disimpan!');
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
            'user' => User::find($id),
            'content' => 'admin.user.edit',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'password' => 'nullable',
            're_password' => 'same:password',
        ]);

        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);

        Alert::success('Sukses', 'Data berhasil diubah!');
        return redirect()->route('admin.user.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();

        Alert::success('Sukses', 'Data berhasil dihapus!');
        return redirect()->route('admin.user.index')->with('success', 'Data berhasil dihapus!');
    }
}
