<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'index_number' => 'required|string|unique:users,index_number',
            'email'        => 'nullable|email|unique:users,email',
            'password'     => 'required|string|min:6|confirmed',
            'role'         => 'required|in:student,admin,superadmin',
            'active'       => 'required|boolean',
            'is_locked'    => 'required|boolean',
            'avatar'       => 'nullable|image|max:2048',
            'bio'          => 'nullable|string',
        ]);

        $data             = $request->only(['name', 'index_number', 'email', 'role', 'active', 'is_locked', 'bio']);
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'index_number' => 'required|string|unique:users,index_number,' . $user->id,
            'email'        => 'nullable|email|unique:users,email,' . $user->id,
            'password'     => 'nullable|string|min:6|confirmed',
            'role'         => 'required|in:student,admin,superadmin',
            'active'       => 'required|boolean',
            'is_locked'    => 'required|boolean',
            'avatar'       => 'nullable|image|max:2048',
            'bio'          => 'nullable|string',
        ]);

        $data = $request->only(['name', 'index_number', 'email', 'role', 'active', 'is_locked', 'bio']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function exportPdf()
    {
        $users = User::all();
        $pdf   = Pdf::loadView('dashboard.users.pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
}
