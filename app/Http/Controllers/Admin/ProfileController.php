<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->branch_id = auth()->user()->branch_id;
    }

    public function index()
    {
        $datas = [
            'titlePage' => 'Profil Saya',
            'dataProfile' => auth()->user()
        ];

        return view('Admin.Pages.Profile.index', $datas);
    }

    public function updateProfile(Request $request)
    {
        $id_user = auth()->user()->id;

        $validateRequest = $request->validate(
            [
                'profile_pic' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'profile_pic.required' => 'Field Foto Profil Wajib Diisi.',
                'profile_pic.image' => 'Foto Profil harus berupa gambar.',
                'profile_pic.mimes' => 'Foto Profil harus berformat jpg, jpeg, atau png.',
                'profile_pic.max' => 'Batas maksimum file foto profil adalah 2 MB'
            ]
        );

        $userUpdateProfile = User::find($id_user);

        if ($userUpdateProfile->profile_pic != null) {
            $realURl = str_replace(env('APP_URL'), '', $userUpdateProfile->profile_pic);
            unlink(public_path($realURl));
        }

        try {
            $file = $validateRequest['profile_pic'];
            $tujuanUpload = public_path() . '/bin/img/Profile_Picture';
            $file->move($tujuanUpload, $file->getClientOriginalName());
            $urlSavedNPWP = url('/bin/img/Profile_Picture/' . $file->getClientOriginalName());

            $userUpdateProfile->profile_pic = $urlSavedNPWP;
            $userUpdateProfile->save();
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Gagal mengupload gambar');
        }

        return back()->with('successMessage', 'Berhasil mengupload gambar');
    }

    public function indexChangePassword()
    {
        $datas = [
            'titlePage' => 'Ubah Password',
            'dataProfile' => auth()->user()
        ];

        return view('Admin.Pages.Profile.ubahpassword', $datas);
    }

    public function updatePassword(Request $request)
    {
        $id_user = auth()->user()->id;
        $userFind = User::find($id_user);

        $validateRequest = $request->validate(
            [
                'old_password' => 'required',
                'password' => 'required|confirmed|max:100'
            ],
            [
                'old_password.required' => 'Field Password Lama Wajib Diisi',
                'password.required' => 'Field Password Baru Wajib Diisi',
                'password.confirmed' => 'Password tidak sama',
                'password.max' => 'Maksimal karakter untuk password adalah 100 karakter.'
            ]
        );

        if (!Hash::check($validateRequest['old_password'], $userFind->password)) {
            return back()->with('errorMessage', 'Password lama tidak sama');
        }

        $userFind->password = Hash::make($validateRequest['password']);
        $userFind->save();
        return back()->with('successMessage', 'Berhasil mengganti password');
    }
}
