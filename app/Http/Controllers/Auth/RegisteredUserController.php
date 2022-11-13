<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $datas = [
            'titlePage' => 'Register',
            'headerCard' => 'Register'
        ];

        return view('auth.register', $datas);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'employee_id' => ['required'],
                'employee_name' => ['required'],
                'account_type' => ['required']
            ],
            [
                'email.required' => 'Field Email Wajib Diisi',
                'email.string' => 'Email harus berupa karakter',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email harus memiliki max. 255 karakter',
                'email.unique' => 'Email telah terdaftar',
                'password.required' => 'Field Password Wajib Diisi',
                'password.confirmed' => 'Password tidak sama',
                'employee_id.required' => 'Field ID Karyawan Wajib Diisi',
                'employee_name.required' => 'Field Nama Karyawan Wajib Diisi',
                'account_type.required' => 'Field Jenis Akun Wajib Diisi'
            ]
        );

        $isRegisteredinCom = false;
        $responseFetch = null;

        // Cek User di IS
        try {
            $response = Http::withHeaders([
                'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
            ])->get('https://legacy.is5.nusa.net.id/employees/' . $request->get('employee_id'));

            if ($response->body() == "{}") {
                $isRegisteredinCom = false;
            } else {
                $isRegisteredinCom = true;
                $responseFetch = json_decode($response->body());
            }
        } catch (\Throwable $th) {
            return back()->with('errorMessage', json_encode($th->getMessage()));
        }

        if (!$isRegisteredinCom) {
            return back()->with('errorMessage', 'Maaf, anda tidak terdaftar sebagai karyawan di PT. Media Antar Nusa.');
        } else {
            $IDKaryawanIS = $responseFetch->id;
            $NamaKaryawanIS = $responseFetch->name;
            $EmailKaryawanIS = $responseFetch->email;

            if ($NamaKaryawanIS == $request->get('employee_name') && $EmailKaryawanIS == $request->get('email')) {
                $user = User::create([
                    'name' => $request->get('employee_name'),
                    'employee_id' => $request->get('employee_id'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'utype' => $request->get('account_type')
                ]);

                event(new Registered($user));

                return redirect()->to('login')->with('successMessage', 'Berhasil membuat akun. Silahkan login dengan akun baru anda.');
            } else {
                return back()->with('errorMessage', 'Maaf, data anda tidak sama dengan yang ada di database sistem.');
            }
        }
    }
}
