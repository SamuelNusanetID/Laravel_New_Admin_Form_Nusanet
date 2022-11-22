<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoList;
use Illuminate\Http\Request;

class DataPromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = [
            'titlePage' => 'Data Promo',
            'dataPromo' => PromoList::all()
        ];

        return view('Admin.Pages.data-promo.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(PromoList $promoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromoList  $promoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromoList $promoList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromoList  $promoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoList $promoList)
    {
        //
    }
}
