<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataUserController extends Controller
{
    public function index()
    {
        $users = DataUser::all();
        return view('admin.datauser.index', compact('users'));
    }

    public function create()
    {
        return view('admin.datauser.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:data_user,username',
            'email' => 'required|email|unique:data_user,email',
            'password' => 'required|string|min:6',
            'no_telepon' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'role' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $id_user = Str::uuid()->toString();

        $data = $request->all();
        $data['id_user'] = $id_user;
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('foto')) {
            $namaFile = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('gambar/profil'), $namaFile);
            $data['foto'] = 'gambar/profil/' . $namaFile;
        }

        DataUser::create($data);

        return redirect()->route('datauser.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id_user)
    {
        $user = DataUser::findOrFail($id_user);
        return view('admin.datauser.edit', compact('user'));
    }

    public function update(Request $request, $id_user)
    {
        $user = DataUser::findOrFail($id_user);

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:data_user,username,' . $user->id_user . ',id_user',
            'email' => 'required|email|unique:data_user,email,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:6',
            'no_telepon' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'role' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($user->foto && file_exists(public_path($user->foto))) {
                unlink(public_path($user->foto));
            }

            $namaFile = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('gambar/profil'), $namaFile);
            $data['foto'] = 'gambar/profil/' . $namaFile;
        }

        $user->update($data);

        return redirect()->route('datauser.index')->with('success', 'User berhasil diperbarui!');
    }

    // app/Http/Controllers/Admin/DataUserController.php
public function destroy($id)
{
    $user = DataUser::findOrFail($id);
    
    // hapus foto kalau ada
    if ($user->foto && file_exists(public_path($user->foto))) {
        unlink(public_path($user->foto));
    }

    $user->delete();

    return redirect()->route('datauser.index')->with('success', 'Data berhasil dihapus!');
}

}
