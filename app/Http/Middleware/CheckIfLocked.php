<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfLocked
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_locked) {
            return redirect()->route('lock');
        }

        return $next($request);
    }
}
