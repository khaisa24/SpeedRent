<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();
        
        $editUser = null;
        if ($request->has('edit')) {
            $editUser = User::find($request->edit);
        }

        return view('admin.users', compact('users', 'editUser'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user'
        ]);

        User::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id, 'id_user')
            ],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,user'
        ]);

        $user = User::findOrFail($id);
        
        $updateData = [
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'role' => $request->role
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Cek jika user mencoba menghapus diri sendiri
        if ($user->id_user == auth()->id()) {
            return redirect()->route('admin.users')
                ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil dihapus!');
    }
}