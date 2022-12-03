<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class DataPenggunaController extends Controller
{
    protected $branch_id;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->branch_id = Auth::user()->branch_id;
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = [
            'titlePage' => 'Data Pengguna'
        ];

        try {
            $fetchDataPengguna = User::where('branch_id', $this->branch_id)->get();
        } catch (\Throwable $th) {
            $fetchDataPengguna = [];
        }

        foreach ($fetchDataPengguna as $key => $value) {
            try {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                ])->get('https://legacy.is5.nusa.net.id/employees/' . $value->under_employee_id);
                $resultJSON = json_decode($response->body());

                $fetchDataPengguna[$key]->pic_name = $resultJSON->name;
            } catch (\Throwable $th) {
                $fetchDataPengguna[$key]->pic_name = "-";
            }
        }

        $datas['dataPengguna'] = $fetchDataPengguna;

        return view('Admin.Pages.data-pengguna.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'titlePage' => 'Data Pengguna'
        ];

        return view('Admin.Pages.data-pengguna.tambah', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateRequest = $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8',
                'employee_id' => 'required|unique:users,employee_id',
                'name' => 'required',
                'utype' => 'required',
                'branch_id' => 'required'
            ],
            [
                'email.required' => 'Field Email Wajib Diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Field Password Wajib Diisi',
                'password.confirmed' => 'Password tidak sama',
                'password.min' => 'Password harus berjumlah min. 8 karakter',
                'employee_id.required' => 'Field ID Karyawan Wajib Diisi',
                'employee_id.unique' => 'ID Karyawan sudah terdaftar',
                'name.required' => 'Field Nama Karyawan Wajib Diisi',
                'utype.required' => 'Field Aturan Pengguna Wajib Diisi',
                'branch_id.required' => 'Field Regional Wajib Diisi'
            ]
        );

        $isEmployeeExist = false;
        if ($request->get('under_employee_id')) {
            try {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                ])->get('https://legacy.is5.nusa.net.id/employees/' . $request->get('under_employee_id'));
                $resultJSON = json_decode($response->body());

                if (isset($resultJSON->name)) {
                    $isEmployeeExist = true;
                } else {
                    $isEmployeeExist = false;
                }
            } catch (\Throwable $th) {
                $isEmployeeExist = false;
            }
        }

        if ($isEmployeeExist) {
            try {
                $newUser = new User();
                $newUser->email = $validateRequest['email'];
                $newUser->password = Hash::make($validateRequest['password']);
                $newUser->employee_id = $validateRequest['employee_id'];
                $newUser->name = $validateRequest['name'];
                $newUser->under_employee_id = $request->get('under_employee_id');
                $newUser->utype = $validateRequest['utype'];
                $newUser->branch_id = $validateRequest['branch_id'];
                $newUser->isApprovedByAdmin = true;
                $newUser->branch_id = $this->branch_id;
                $newUser->save();

                return redirect()->to('data-pengguna')->with('successMessage', 'Data pengguna berhasil ditambahkan.');
            } catch (\Throwable $th) {
                return back()->withInput()->with('errorMessage', $th->getMessage());
            }
        } else {
            try {
                $newUser = new User();
                $newUser->email = $validateRequest['email'];
                $newUser->password = Hash::make($validateRequest['password']);
                $newUser->employee_id = $validateRequest['employee_id'];
                $newUser->name = $validateRequest['name'];
                $newUser->under_employee_id = null;
                $newUser->utype = $validateRequest['utype'];
                $newUser->branch_id = $validateRequest['branch_id'];
                $newUser->isApprovedByAdmin = true;
                $newUser->branch_id = $this->branch_id;
                $newUser->save();

                return redirect()->to('data-pengguna')->with('successMessage', 'Data pengguna berhasil ditambahkan.');
            } catch (\Throwable $th) {
                return back()->withInput()->with('errorMessage', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $data_pengguna)
    {
        $datas = [
            'titlePage' => 'Data Pengguna'
        ];

        try {
            $datas['dataPengguna'] = $user->find($data_pengguna);
        } catch (\Throwable $th) {
            $datas['dataPengguna'] = [];
        }

        return view('Admin.Pages.data-pengguna.update', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $data_pengguna)
    {
        $validateRequest = $request->validate(
            [
                'email' => 'required|email|unique:users,email,' . $data_pengguna,
                'employee_id' => 'required|unique:users,employee_id,' . $data_pengguna,
                'name' => 'required',
                'utype' => 'required',
                'branch_id' => 'required'
            ],
            [
                'email.required' => 'Field Email Wajib Diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'employee_id.required' => 'Field ID Karyawan Wajib Diisi',
                'employee_id.unique' => 'ID Karyawan sudah terdaftar',
                'name.required' => 'Field Nama Karyawan Wajib Diisi',
                'utype.required' => 'Field Aturan Pengguna Wajib Diisi',
                'branch_id.required' => 'Field Regional Wajib Diisi'
            ]
        );

        $isEmployeeExist = false;

        if ($request->get('under_employee_id')) {
            try {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                ])->get('https://legacy.is5.nusa.net.id/employees/' . $request->get('under_employee_id'));
                $resultJSON = json_decode($response->body());
                if (isset($resultJSON->name)) {
                    $isEmployeeExist = true;
                } else {
                    $isEmployeeExist = false;
                }
            } catch (\Throwable $th) {
                $isEmployeeExist = false;
            }
        }

        if ($isEmployeeExist) {
            try {
                $updateUser = $user->find($data_pengguna);
                $updateUser->email = $validateRequest['email'];
                $updateUser->employee_id = $validateRequest['employee_id'];
                $updateUser->name = $validateRequest['name'];
                $updateUser->under_employee_id = $request->get('under_employee_id');
                $updateUser->utype = $validateRequest['utype'];
                $updateUser->branch_id = $validateRequest['branch_id'];
                $updateUser->isApprovedByAdmin = true;
                $updateUser->branch_id = $this->branch_id;
                $updateUser->save();

                return redirect()->to('data-pengguna')->with('successMessage', 'Data pengguna berhasil diubah.');
            } catch (\Throwable $th) {
                return back()->withInput()->with('errorMessage', $th->getMessage());
            }
        } else {
            try {
                $updateUser = $user->find($data_pengguna);
                $updateUser->email = $validateRequest['email'];
                $updateUser->employee_id = $validateRequest['employee_id'];
                $updateUser->name = $validateRequest['name'];
                $updateUser->under_employee_id = null;
                $updateUser->utype = $validateRequest['utype'];
                $updateUser->branch_id = $validateRequest['branch_id'];
                $updateUser->isApprovedByAdmin = true;
                $updateUser->branch_id = $this->branch_id;
                $updateUser->save();

                return redirect()->to('data-pengguna')->with('successMessage', 'Data pengguna berhasil diubah.');
            } catch (\Throwable $th) {
                return back()->withInput()->with('errorMessage', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $data_pengguna)
    {
        try {
            $newUser = $user->find($data_pengguna);
            $newUser->delete();

            return redirect()->to('data-pengguna')->with('successMessage', 'Data pengguna berhasil dihapus.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('errorMessage', $th->getMessage());
        }
    }
}
