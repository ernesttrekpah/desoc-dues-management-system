<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('dashboard.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'nullable|email|unique:users,email,' . $user->id,
            'bio'    => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:2048', // 2MB
        ]);

        $data = $request->only(['name', 'email', 'bio']);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }
            $path           = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match our records.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password updated successfully.');
    }
}
