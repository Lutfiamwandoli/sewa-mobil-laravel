<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilManagerController extends Controller
{
    public function edit()
    {
        $manager = Auth::user();
        return view('manager.profile', compact('manager'));
    }

    public function update(Request $request)
    {
        $manager = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:data_user,email,' . $manager->id_user . ',id_user',
            'no_telepon' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:Pria,Wanita',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            if ($manager->foto && file_exists(public_path($manager->foto))) {
                unlink(public_path($manager->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar/profil_manager'), $filename);
            $manager->foto = 'gambar/profil_manager/' . $filename;
        }

        $manager->nama = $request->nama;
        $manager->email = $request->email;
        $manager->no_telepon = $request->no_telepon;
        $manager->jenis_kelamin = $request->jenis_kelamin;

        $manager->save();

        return redirect()->route('manager.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
