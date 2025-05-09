<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index() {

        $user = User::find(auth()->user()->id);

        return view('profile', [
            'page' => 'Profile',
            'user' => $user
        ]);

    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email'    => 'required|email|max:100|unique:users,email,' . $id,
            'password' => 'nullable|string|min:4|confirmed',
            'name'     => 'required|string|max:100',
            'phone'    => 'nullable|string|max:15',
            'alamat'   => 'nullable|string',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find($id);

        if (!$user) {
            return back()->with([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ]);
        }

        // Update basic fields
        $user->email  = $validated['email'];
        $user->name   = $validated['name'];
        $user->phone  = $validated['phone'] ?? null;
        $user->alamat = $validated['alamat'] ?? null;

        // Jika password diisi, hash dan simpan
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle upload foto
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = $request->file('foto')->store('foto', 'public');

        }


        $user->save();

        flash('Profil berhasil diperbarui.', 'success');

        return redirect()->route('profile.index');
    }



}
