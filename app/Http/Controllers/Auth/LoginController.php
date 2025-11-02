<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cari user berdasarkan email
        $user = User::with(['roleUsers' => function($q) {
            $q->where('status', 1);
        }])->where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan atau akun tidak aktif.'])
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        // Ambil role aktif pertama
        $roleUser = $user->roleUsers->first();
        $namaRole = $roleUser ? Role::find($roleUser->idrole) : null;

        // Login
        Auth::login($user);

        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $roleUser->idrole ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $roleUser->status ?? 'active'
        ]);

        $userRole = $user->roleUsers[0]->idrole ?? null;

        switch ($userRole) {
        case '1':
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        case '2':
            return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
        case '3':
            return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
        case '4':
            return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
        default:
            return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
        }

    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}