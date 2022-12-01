<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PromoList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $branch_id;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->branch_id = Auth::user()->branch_id;
            return $next($request);
        });
    }

    public function index()
    {
        $datas = [
            'titlePage' => 'Dashboard'
        ];

        $datas['dataPelanggan'] = [];
        if (auth()->user()->utype == "AuthMaster") {
            $datas['jumlahseluruhDataPelanggan'] = Customer::count();
            $datas['dataPelanggan'] = Customer::all();

            $datas['jumlahPelangganBaru'] = 0;
            $datas['dataPelangganBaru'] = Customer::all();
            foreach ($datas['dataPelangganBaru'] as $key => $value) {
                if (!$value->approval->isSendedtoIS) {
                    $datas['jumlahPelangganBaru'] += 1;
                } else {
                    unset($datas['dataPelangganBaru'][$key]);
                }
            }

            $datas['jumlahPelangganApproved'] = 0;
            $datas['dataPelangganApproved'] = Customer::all();
            foreach ($datas['dataPelangganApproved'] as $key => $value) {
                if ($value->approval->isSendedtoIS) {
                    $datas['jumlahPelangganApproved'] += 1;
                } else {
                    unset($datas['dataPelangganApproved'][$key]);
                }
            }

            $datas['dataPromo'] = [];
            $datas['dataPromo'] = PromoList::all();
            foreach ($datas['dataPromo'] as $key => $value) {
                if (!((Carbon::now() >= $value->activate_date) && (Carbon::now() <= $value->expired_date))) {
                    unset($datas['dataPromo'][$key]);
                }
            }
        }


        return view('Admin.Pages.dashboard', $datas);
    }
}
