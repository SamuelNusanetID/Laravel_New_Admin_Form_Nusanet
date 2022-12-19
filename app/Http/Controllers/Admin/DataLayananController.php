<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
            if (auth()->user()->utype != "AuthMaster") {
                try {
                    $response = Http::withHeaders([
                        'X-Api-Key' => env('API_KEY_IS'),
                    ])->get(env('API_URL_IS') . 'service?branchId=' . $this->branch_id);

                    $datas['dataLayanan'] = json_decode($response->body());
                } catch (\Throwable $th) {
                    $datas['dataLayanan'] = [];
                }
            } else {
                try {
                    $response = Http::withHeaders([
                        'X-Api-Key' => env('API_KEY_IS'),
                    ])->get(env('API_URL_IS') . 'service');

                    $datas['dataLayanan'] = json_decode($response->body());
                } catch (\Throwable $th) {
                    $datas['dataLayanan'] = [];
                }
            }
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicesList $serviceList, $data_layanan)
    {
    }
}
