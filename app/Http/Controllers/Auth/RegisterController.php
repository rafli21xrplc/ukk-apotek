<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\pelanggan;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string  ', 'max:255', 'unique:pelanggan', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'alamat' => ['required', 'string', 'min:5'],
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        pelanggan::create([
            'id_pelanggan' => Str::uuid(),
            'nama_pelanggan' => $data['nama_pelanggan'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat']
        ]);

        $pelanggan = pelanggan::where('username', $data['username'])->first();

        return User::create(
            [
                'id_user' => Str::uuid(),
                'nama_user' => $data['nama_pelanggan'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role' => 'pelanggan',
                'alamat' => $data['alamat'],
                'id_pelanggan' => $pelanggan->id_pelanggan
            ]
        );
    }
}
