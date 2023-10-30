<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'user' => User::get(),
            'content' => 'admin.user.index',
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
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        User::create($data);

        // return redirect()->route('/admin/user')->with('success', 'Data berhasil disimpan!');
        return redirect('/admin/user');
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
        $user = User::find($id);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            're_password' => 'same:password',
        ]);

        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);

        // return redirect()->route('admin.user.index')->with('success', 'Data berhasil diubah!');
        return view('admin.user.index', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/admin/user')->with('success', 'Data berhasil dihapus!');
    }
}
