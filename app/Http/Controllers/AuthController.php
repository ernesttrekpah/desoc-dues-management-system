<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login form submission
    public function login(Request $request)
    {
        $request->validate([
            'index_number' => 'required|string',
            'password'     => 'required|string',
        ]);

        $credentials = $request->only('index_number', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'index_number' => 'Invalid index number or password.',
        ])->onlyInput('index_number');
    }

    // Lock action
    public function lock(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->update(['is_locked' => true]);
            // dd('Locked updated for user: ' . $user->id);

            return redirect()->route('lock');
        }

        return redirect()->route('login');
    }

    // Unlock action
    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login')->withErrors(['auth' => 'You must log in again.']);
        }

        if (Hash::check($request->password, $user->password)) {
            $user->update(['is_locked' => false]);
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'password' => 'Incorrect password.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
