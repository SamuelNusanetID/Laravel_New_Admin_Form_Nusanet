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
                        'X-Api-Key' => env('API_KEY_IS'),
                    ])->get(env('API_URL_IS') . 'promo?branchId=' . $this->branch_id . '&to=' . Date('Y-m-d') . '&active=1');

                    $datas['dataPromo'] = json_decode($response->body());
                    foreach ($datas['dataPromo'] as $key => $value) {
                        $responseKaryawan = Http::withHeaders([
                            'X-Api-Key' => env('API_KEY_IS')
                        ])->get(env('API_URL_IS') . 'employees/' . $value->insertby);

                        $datas['dataPromo'][$key]->insertby = json_decode($responseKaryawan->body())->name;
                    }
                } catch (\Throwable $th) {
                    $datas['dataPromo'] = [];
                }
            } else {
                try {
                    $response = Http::withHeaders([
                        'X-Api-Key' => env('API_KEY_IS'),
                    ])->get(env('API_URL_IS') . 'promo?to=' . Date('Y-m-d') . '&active=1');

                    $datas['dataPromo'] = json_decode($response->body());
                    foreach ($datas['dataPromo'] as $key => $value) {
                        $responseKaryawan = Http::withHeaders([
                            'X-Api-Key' => env('API_KEY_IS')
                        ])->get(env('API_URL_IS') . 'employees/' . $value->insertby);

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromoList  $promoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoList $promoList, $data_promo)
    {
    }
}
