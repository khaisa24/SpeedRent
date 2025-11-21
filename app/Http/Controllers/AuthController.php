<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show Register Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Process Login
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        
        // Debug: Log login attempt
        Log::info('Login attempt', ['email' => $request->email, 'ip' => $request->ip()]);
        
        // Cek credentials manual untuk debug
        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            Log::info('User found', ['user_id' => $user->id_user, 'role' => $user->role]); // ✅ id_user
            
            // Cek password manually
            if (Hash::check($request->password, $user->password)) {
                Log::info('Password correct');
            } else {
                Log::warning('Password incorrect');
            }
        } else {
            Log::warning('User not found');
        }
        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Debug: Log successful login
            Log::info('Login successful', [
                'id_user' => Auth::id(), // ✅ Auth::id() mengembalikan id_user
                'role' => Auth::user()->role,
                'session_id' => session()->getId()
            ]);
            
            // Redirect berdasarkan role
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                Log::info('Redirecting to admin dashboard');
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Admin!');
            }
            
            Log::info('Redirecting to user dashboard');
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }
        
        // Jika login gagal
        Log::warning('Login failed', ['email' => $request->email]);
        
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    // Process Register
    public function register(RegisterRequest $request) 
    {
        $validated = $request->validated();

        // Debug: Log registration attempt
        Log::info('Registration attempt', ['email' => $validated['email']]);

        $user = User::create([
            'nama_user' => $validated['nama_user'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Debug: Log user creation
        Log::info('User created', ['user_id' => $user->id_user, 'role' => $user->role]); // ✅ id_user

        Auth::login($user);

        // Debug: Log successful registration
        Log::info('Registration successful', ['user_id' => $user->id_user]); // ✅ id_user

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Registrasi berhasil!');
        }

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }

    // Logout
    public function logout(Request $request)
    {
        // Debug: Log logout
        Log::info('Logout', ['user_id' => Auth::id()]); // ✅ Auth::id()

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    // Additional method untuk debug session
    public function checkSession(Request $request)
    {
        return response()->json([
            'authenticated' => Auth::check(),
            'user' => Auth::check() ? [
                'id_user' => Auth::id(), // ✅ Auth::id() bukan Auth::id_user()
                'nama_user' => Auth::user()->nama_user,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role
            ] : null,
            'session_id' => session()->getId(),
            'session_data' => session()->all()
        ]);
    }
}