<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoList;
use App\Models\ServicesList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DataPromoController extends Controller
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
            'titlePage' => 'Data Promo'
        ];

        try {
            if (auth()->user()->utype != 'AuthMaster') {
                try {
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc',
                    ])->get('https://legacy.is5.nusa.net.id/promo?branchId=' . $this->branch_id . '&to=' . Date('Y-m-d') . '&active=1');

                    $datas['dataPromo'] = json_decode($response->body());
                    foreach ($datas['dataPromo'] as $key => $value) {
                        $responseKaryawan = Http::withHeaders([
                            'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                        ])->get('https://legacy.is5.nusa.net.id/employees/' . $value->insertby);

                        $datas['dataPromo'][$key]->insertby = json_decode($responseKaryawan->body())->name;
                    }
                } catch (\Throwable $th) {
                    $datas['dataPromo'] = [];
                }
            } else {
                try {
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc',
                    ])->get('https://legacy.is5.nusa.net.id/promo');

                    $datas['dataPromo'] = json_decode($response->body());
                    foreach ($datas['dataPromo'] as $key => $value) {
                        $responseKaryawan = Http::withHeaders([
                            'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                        ])->get('https://legacy.is5.nusa.net.id/employees/' . $value->insertby);

                        $datas['dataPromo'][$key]->insertby = json_decode($responseKaryawan->body())->name;
                    }
                } catch (\Throwable $th) {
                    $datas['dataPromo'] = [];
                }
            }
        } catch (\Throwable $th) {
            $datas['dataPromo'] = [];
        }

        return view('Admin.Pages.data-promo.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'titlePage' => 'Data Promo'
        ];

        try {
            if (auth()->user()->utype != 'AuthMaster') {
                $datas['packageList'] = ServicesList::where('branch_id', $this->branch_id)->get();
            } else {
                $datas['packageList'] = ServicesList::all();
            }

            $arrayDataList = array_count_values(
                array_column($datas['packageList']->toArray(), 'package_name')
            );
            $newDataPackageList = [];
            foreach ($arrayDataList as $key => $value) {
                array_push($newDataPackageList, $key);
            }
            $datas['packageList'] = $newDataPackageList;
        } catch (\Throwable $th) {
            $datas['packageList'] = [];
        }

        return view('Admin.Pages.data-promo.tambah', $datas);
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
                'promo_name' => 'required',
                'branch_id' => 'required',
                'package_name' => 'required',
                'package_top' => 'required',
                'promo_desc' => 'required',
                'promo_status' => 'required',
                'activate_date' => 'required',
                'expired_date' => 'required'
            ],
            [
                'promo_name.required' => 'Field Nama Promo Wajib Diisi',
                'branch_id.required' => 'Field Nama Cabang Wajib Diisi',
                'package_name.required' => 'Field Nama Paket Wajib Diisi',
                'package_top.required' => 'Field Jangka Waktu Pembayaran Wajib Diisi',
                'promo_desc.required' => 'Field Deskripsi Promo Wajib Diisi',
                'promo_status.required' => 'Field Status Promo Wajib Diisi',
                'activate_date.required' => 'Field Tanggal Aktif Promo Wajib Diisi',
                'expired_date.required' => 'Field Tanggal Berakhir Promo Wajib Diisi',
            ]
        );

        try {
            $newPromo = new PromoList();
            $newPromo->promo_code = $this->generateVoucherCode(8);
            $newPromo->promo_name = $validateRequest['promo_name'];
            $newPromo->branch_id = $validateRequest['branch_id'];
            $newPromo->package_name = $validateRequest['package_name'];
            $newPromo->package_top = $validateRequest['package_top'];
            $newPromo->discount_cut = $request->get('discount_cut');
            $newPromo->monthly_cut = $request->get('monthly_cut');
            $newPromo->monthly_cut_status = $request->get('monthly_cut_status');
            $newPromo->promo_desc = $validateRequest['promo_desc'];
            $newPromo->promo_status = $validateRequest['promo_status'];
            $newPromo->activate_date = $validateRequest['activate_date'];
            $newPromo->expired_date = $validateRequest['expired_date'];
            $newPromo->save();

            return redirect()->to('data-promo')->with('successMessage', 'Data promo berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromoList  $promoList
     * @return \Illuminate\Http\Response
     */
    public function show(PromoList $promoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromoList  $promoList
     * @return \Illuminate\Http\Response
     */
    public function edit(PromoList $promoList, $data_promo)
    {
        $datas = [
            'titlePage' => 'Data Promo'
        ];

        try {
            if (auth()->user()->utype != 'AuthMaster') {
                $datas['packageList'] = ServicesList::where('branch_id', $this->branch_id)->get();
            } else {
                $datas['packageList'] = ServicesList::all();
            }

            $arrayDataList = array_count_values(
                array_column($datas['packageList']->toArray(), 'package_name')
            );
            $newDataPackageList = [];
            foreach ($arrayDataList as $key => $value) {
                array_push($newDataPackageList, $key);
            }
            $datas['packageList'] = $newDataPackageList;
        } catch (\Throwable $th) {
            $datas['packageList'] = [];
        }

        try {
            $datas['dataPromo'] = $promoList->find($data_promo);
        } catch (\Throwable $th) {
            $datas['dataPromo'] = [];
        }

        return view('Admin.Pages.data-promo.update', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromoList  $promoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromoList $promoList, $data_promo)
    {
        $validateRequest = $request->validate(
            [
                'promo_name' => 'required',
                'branch_id' => 'required',
                'package_name' => 'required',
                'package_top' => 'required',
                'promo_desc' => 'required',
                'promo_status' => 'required',
                'activate_date' => 'required',
                'expired_date' => 'required'
            ],
            [
                'promo_name.required' => 'Field Nama Promo Wajib Diisi',
                'branch_id.required' => 'Field Nama Cabang Wajib Diisi',
                'package_name.required' => 'Field Nama Paket Wajib Diisi',
                'package_top.required' => 'Field Jangka Waktu Pembayaran Wajib Diisi',
                'promo_desc.required' => 'Field Deskripsi Promo Wajib Diisi',
                'promo_status.required' => 'Field Status Promo Wajib Diisi',
                'activate_date.required' => 'Field Tanggal Aktif Promo Wajib Diisi',
                'expired_date.required' => 'Field Tanggal Berakhir Promo Wajib Diisi',
            ]
        );

        try {
            $updatePromo = $promoList->find($data_promo);
            $updatePromo->promo_code = $this->generateVoucherCode(8);
            $updatePromo->promo_name = $validateRequest['promo_name'];
            $updatePromo->branch_id = $validateRequest['branch_id'];
            $updatePromo->package_name = $validateRequest['package_name'];
            $updatePromo->package_top = $validateRequest['package_top'];
            $updatePromo->discount_cut = $request->get('discount_cut');
            $updatePromo->monthly_cut = $request->get('monthly_cut');
            $updatePromo->monthly_cut_status = $request->get('monthly_cut_status');
            $updatePromo->promo_desc = $validateRequest['promo_desc'];
            $updatePromo->promo_status = $validateRequest['promo_status'];
            $updatePromo->activate_date = $validateRequest['activate_date'];
            $updatePromo->expired_date = $validateRequest['expired_date'];
            $updatePromo->save();

            return redirect()->to('data-promo')->with('successMessage', 'Data promo berhasil diubah.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromoList  $promoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoList $promoList, $data_promo)
    {
        try {
            $deletePromo = $promoList->find($data_promo);
            $deletePromo->delete();
            return redirect()->to('data-promo')->with('successMessage', 'Data promo berhasil dihapus.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('errorMessage', $th->getMessage());
        }
    }

    public function generateVoucherCode($length = 20)
    {
        // Generate Code Promo
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= strtoupper($characters[rand(0, $charactersLength - 1)]);
        }

        // Check to database
        $promoFinderCount = PromoList::where('promo_code', $randomString)->count();

        if ($promoFinderCount >= 1) {
            $this->generateVoucherCode($length);
        }

        return $randomString;
    }
}
