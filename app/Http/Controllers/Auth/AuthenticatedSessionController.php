<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Karu at the very top, followed by Katim 1, Katim 2, and Perawat
        $nurses = User::orderByRaw("
            CASE 
                WHEN role = 'Kepala Ruangan' THEN 0 
                WHEN role LIKE 'Kepala Tim 1%' THEN 1 
                WHEN role LIKE 'Kepala Tim 2%' THEN 2 
                ELSE 3 
            END, name ASC
        ")->get();

        return view('auth.login', compact('nurses'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        if ($user && $user->role === 'Kepala Ruangan') {
            return redirect()->intended(route('admin.rekap', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
