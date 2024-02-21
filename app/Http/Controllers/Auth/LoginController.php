<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(LoginRequest $loginRequest)
    {
        $loginRequest->validated();
        try {
            $user = User::where('username', $loginRequest->username)->first();
            if ($user && Auth::attempt(['username' => $loginRequest->username, 'password' => $loginRequest->password])) {
                switch (Auth::user()->role) {
                    case 'admin':
                        return redirect()->route('dashboard.admin');
                        break;

                    case 'petugas':
                        return redirect()->route('transaksi.dashboard');
                        break;

                    case 'pelanggan':
                        return redirect()->route('dashboard.pelanggan');
                        break;
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal login');
        }
        return redirect()->back()->with('error', 'Akun tidak di temukan');
    }
}
