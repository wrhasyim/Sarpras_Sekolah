<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        $users = User::with('kelas')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        // Perubahan di baris ini
        $kelas = Kelas::where('nama_kelas', 'like', 'Kelas%')->get();
        return view('users.create', compact('kelas'));
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,tu,wali_kelas',
            'kelas_id' => 'nullable|required_if:role,wali_kelas|exists:kelas,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'kelas_id' => $request->role == 'wali_kelas' ? $request->kelas_id : null,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit(User $user)
    {
        // Perubahan di baris ini
        $kelas = Kelas::where('nama_kelas', 'like', 'Kelas%')->get();
        return view('users.edit', compact('user', 'kelas'));
    }

    /**
     * Memperbarui data user di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,tu,wali_kelas',
            'kelas_id' => 'nullable|required_if:role,wali_kelas|exists:kelas,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'kelas_id' => $request->role == 'wali_kelas' ? $request->kelas_id : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user)
    {
        // Mencegah admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}