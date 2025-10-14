<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:data_user,email,' . $admin->id_user . ',id_user',
            'no_telepon' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:Pria,Wanita',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            if ($admin->foto && file_exists(public_path($admin->foto))) {
                unlink(public_path($admin->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar/profil_admin'), $filename);
            $admin->foto = 'gambar/profil_admin/' . $filename;
        }

        $admin->nama = $request->nama;
        $admin->email = $request->email;
        $admin->no_telepon = $request->no_telepon;
        $admin->jenis_kelamin = $request->jenis_kelamin;

        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
