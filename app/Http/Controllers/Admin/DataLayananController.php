<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataLayananController extends Controller
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
            'titlePage' => 'Data Layanan'
        ];

        try {
            $datas['dataLayanan'] = ServicesList::where('branch_id', $this->branch_id)->get();
        } catch (\Throwable $th) {
            $datas['dataLayanan'] = [];
        }

        return view('Admin.Pages.data-layanan.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'titlePage' => 'Data Layanan'
        ];

        return view('Admin.Pages.data-layanan.tambah', $datas);
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
                'package_name' => 'required',
                'package_type' => 'required',
                'package_categories' => 'required',
                'package_speed' => 'required',
                'package_price' => 'required'
            ],
            [
                'package_name.required' => 'Field Nama Paket Wajib Diisi',
                'package_type.required' => 'Field Tipe Paket Wajib Diisi',
                'package_categories.required' => 'Field Kategori Paket Wajib Diisi',
                'package_speed.required' => 'Field Kecepatan Paket Wajib Diisi',
                'package_price.required' => 'Field Harga Paket Wajib Diisi'
            ]
        );

        try {
            $newDataLayanan = new ServicesList();
            $newDataLayanan->package_name = $validateRequest['package_name'];
            $newDataLayanan->package_type = $validateRequest['package_type'];
            $newDataLayanan->package_categories = $validateRequest['package_categories'];
            $newDataLayanan->package_speed = $validateRequest['package_speed'];
            $newDataLayanan->package_price = $validateRequest['package_price'];
            $newDataLayanan->retail_package_price = $request->get('retail_package_price');
            $newDataLayanan->government_package_price = $request->get('government_package_price');
            $newDataLayanan->noted_service = $request->get('noted_service');
            $newDataLayanan->branch_id = $this->branch_id;
            $newDataLayanan->save();

            return redirect()->to('data-layanan')->with('successMessage', 'Data layanan berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function show(ServicesList $serviceList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicesList $serviceList, $data_layanan)
    {
        $datas = [
            'titlePage' => 'Data Layanan'
        ];

        try {
            $datas['dataLayanan'] = $serviceList->find($data_layanan);
        } catch (\Throwable $th) {
            $datas['dataLayanan'] = [];
        }

        return view('Admin.Pages.data-layanan.update', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicesList $serviceList, $data_layanan)
    {
        $validateRequest = $request->validate(
            [
                'package_name' => 'required',
                'package_type' => 'required',
                'package_categories' => 'required',
                'package_speed' => 'required',
                'package_price' => 'required'
            ],
            [
                'package_name.required' => 'Field Nama Paket Wajib Diisi',
                'package_type.required' => 'Field Tipe Paket Wajib Diisi',
                'package_categories.required' => 'Field Kategori Paket Wajib Diisi',
                'package_speed.required' => 'Field Kecepatan Paket Wajib Diisi',
                'package_price.required' => 'Field Harga Paket Wajib Diisi'
            ]
        );

        try {
            $updateDataLayanan = $serviceList->find($data_layanan);
            $updateDataLayanan->package_name = $validateRequest['package_name'];
            $updateDataLayanan->package_type = $validateRequest['package_type'];
            $updateDataLayanan->package_categories = $validateRequest['package_categories'];
            $updateDataLayanan->package_speed = $validateRequest['package_speed'];
            $updateDataLayanan->package_price = $validateRequest['package_price'];
            $updateDataLayanan->retail_package_price = $request->get('retail_package_price');
            $updateDataLayanan->government_package_price = $request->get('government_package_price');
            $updateDataLayanan->noted_service = $request->get('noted_service');
            $updateDataLayanan->branch_id = $this->branch_id;
            $updateDataLayanan->save();

            return redirect()->to('data-layanan')->with('successMessage', 'Data layanan berhasil diubah.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('errorMessage', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicesList $serviceList, $data_layanan)
    {
        try {
            $deleteDataLayanan = $serviceList->find($data_layanan);
            $deleteDataLayanan->delete();

            return redirect()->to('data-layanan')->with('successMessage', 'Data layanan berhasil dihapus.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('errorMessage', $th->getMessage());
        }
    }
}
