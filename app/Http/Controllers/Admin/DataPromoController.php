<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoList;
use App\Models\ServicesList;
use Illuminate\Http\Request;

class DataPromoController extends Controller
{
    public function __construct()
    {
        $this->branch_id = auth()->user()->branch_id;
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
            $datas['dataPromo'] = PromoList::all();
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
            $datas['packageList'] = ServicesList::all();
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
                'promo_code' => 'required|unique:promo_list,promo_code',
                'package_name' => 'required',
                'package_top' => 'required',
                'activate_date' => 'required',
                'expired_date' => 'required'
            ],
            [
                'promo_code.required' => 'Field Kode Promo Wajib Diisi',
                'promo_code.unique' => 'Kode Promo sudah ada',
                'package_name.required' => 'Field Nama Paket Wajib Diisi',
                'package_top.required' => 'Field Jangka Waktu Pembayaran Wajib Diisi',
                'activate_date.required' => 'Field Tanggal Aktif Promo Wajib Diisi',
                'expired_date.required' => 'Field Tanggal Berakhir Promo Wajib Diisi',
            ]
        );

        try {
            $newPromo = new PromoList();
            $newPromo->promo_code = $validateRequest['promo_code'];
            $newPromo->package_name = $validateRequest['package_name'];
            $newPromo->package_top = $validateRequest['package_top'];
            $newPromo->discount_cut = $request->get('discount_cut');
            $newPromo->monthly_cut = $request->get('monthly_cut');
            $newPromo->monthly_cut_status = $request->get('monthly_cut_status');
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
            $datas['packageList'] = ServicesList::all();
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
                'promo_code' => 'required|unique:promo_list,promo_code,' . $data_promo,
                'package_name' => 'required',
                'package_top' => 'required',
                'activate_date' => 'required',
                'expired_date' => 'required'
            ],
            [
                'promo_code.required' => 'Field Kode Promo Wajib Diisi',
                'promo_code.unique' => 'Kode Promo sudah ada',
                'package_name.required' => 'Field Nama Paket Wajib Diisi',
                'package_top.required' => 'Field Jangka Waktu Pembayaran Wajib Diisi',
                'activate_date.required' => 'Field Tanggal Aktif Promo Wajib Diisi',
                'expired_date.required' => 'Field Tanggal Berakhir Promo Wajib Diisi',
            ]
        );

        try {
            $updatePromo = $promoList->find($data_promo);
            $updatePromo->promo_code = $validateRequest['promo_code'];
            $updatePromo->package_name = $validateRequest['package_name'];
            $updatePromo->package_top = $validateRequest['package_top'];
            $updatePromo->discount_cut = $request->get('discount_cut');
            $updatePromo->monthly_cut = $request->get('monthly_cut');
            $updatePromo->monthly_cut_status = $request->get('monthly_cut_status');
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
}
