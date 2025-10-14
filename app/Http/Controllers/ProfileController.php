<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\DataUser;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username'      => 'required|string|max:50|unique:data_user,username,' . $user->id_user . ',id_user',
            'nama'          => 'required|string|max:100',
            'NIK'           => 'nullable|string|max:20|unique:data_user,NIK,' . $user->id_user . ',id_user',
            'email'         => 'required|email|unique:data_user,email,' . $user->id_user . ',id_user',
            'no_telepon'    => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'username',
            'nama',
            'NIK',
            'email',
            'no_telepon',
            'jenis_kelamin',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar/profil'), $namaFile);
            $data['foto'] = 'gambar/profil/' . $namaFile;
        }

        $user->update($data);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
     public function editPassword()
    {
        $user = Auth::user(); // ambil user login
        return view('user.profile.password', compact('user')); // kirim $user ke view
    }

    // Proses update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/',      // angka
                'confirmed'           // cocok dengan konfirmasi
            ],
        ]);

        $user = Auth::user();

        // cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        // update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui!');
    }

}
