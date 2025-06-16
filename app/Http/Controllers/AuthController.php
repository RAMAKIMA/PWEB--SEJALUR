<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('Auth/Register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:accounts',
            'email' => 'required|email|unique:accounts',
            'no_telepon' => 'required',
            'role' => 'required|in:petugas,masyarakat', // Batasi hanya petugas & masyarakat
            'password' => 'required|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Account::create($validated); // Ganti User::create

        return redirect()->route('Login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLogin()
    {
        return view('Auth/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Dashboard sesuai role
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'Admin') {
                return redirect()->route('Dashboard.admin');
            } elseif ($user->role === 'Petugas') {
                return redirect()->route('Dashboard.petugas');
            } elseif ($user->role === 'Masyarakat') {
                return redirect()->route('Dashboard.masyarakat');
            } else {
                Auth::logout();
                return redirect()->route('Login')->withErrors(['email' => 'Role tidak valid.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Landing.page');
    }

    public function editProfil()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('Login')->withErrors(['message' => 'Silakan login terlebih dahulu.']);
        }

        switch ($user->role) {
            case 'Admin':
                return view('Profil/Profil(Admin)', compact('user'));
            case 'Masyarakat':
                return view('Profil/Profil(Masyarakat)', compact('user'));
            case 'Petugas':
                return view('Profil/Profil(Petugas)', compact('user'));
            default:
                return redirect()->route('Login')->withErrors(['message' => 'Role tidak dikenali.']);
        }
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:accounts,username,' . $user->id,
            'no_telepon' => 'required|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->no_telepon = $request->no_telepon;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
