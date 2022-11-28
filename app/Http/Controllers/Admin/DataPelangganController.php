<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PromoList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class DataPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = [
            'titlePage' => 'Data Pelanggan'
        ];

        $uType = auth()->user()->utype;
        $fetchDataPelanggan = Customer::all();

        // Cek Customer IS atau Bukan
        foreach ($fetchDataPelanggan as $key => $value) {
            $value->isCustomerIS = false;

            try {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc',
                ])->get('https://legacy.is5.nusa.net.id/customers/' . $value->customer_id);

                if (isset(json_decode($response->body())->statusCode)) {
                    $value->isCustomerIS = false;
                } else {
                    $value->isCustomerIS = true;
                }
            } catch (\Throwable $th) {
                $value->isCustomerIS = false;
            }
        }

        foreach ($fetchDataPelanggan as $key => $value) {
            if ($value->reference_id != null) {
                try {
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                    ])->get('https://legacy.is5.nusa.net.id/employees/' . $value->reference_id);

                    if ($response->successful()) {
                        $value->sales_id = json_decode($response->body())->id;
                        $value->sales_name = json_decode($response->body())->name;
                        $value->sales_email = json_decode($response->body())->email;
                    } else {
                        $value->sales_id = null;
                        $value->sales_name = null;
                        $value->sales_email = null;
                    }
                } catch (\Throwable $th) {
                    $value->sales_id = null;
                    $value->sales_name = null;
                    $value->sales_email = null;
                }
            }
        }

        switch ($uType) {
            case 'AuthMaster':
                $datas['dataPelanggan'] = $this->indexAuthMaster($fetchDataPelanggan);
                break;
            case 'AuthCRO':
                $datas['dataPelanggan'] = $this->indexAuthCRO($fetchDataPelanggan);
                break;
            case 'AuthSalesManager':
                $datas['dataPelanggan'] = $this->indexAuthSalesManager($fetchDataPelanggan);
                break;
            case 'AuthSales':
                $datas['dataPelanggan'] = $this->indexAuthSales($fetchDataPelanggan);
                break;
            default:
                $datas['dataPelanggan'] = $this->indexAuthMaster($fetchDataPelanggan);
                break;
        }

        return view('Admin.Pages.data-pelanggan.index', $datas);
    }

    public function indexAuthMaster($dataPelangganCollection)
    {
        return $dataPelangganCollection;
    }

    public function indexAuthCRO($dataPelangganCollection)
    {
        return $dataPelangganCollection;
    }

    public function indexAuthSalesManager($dataPelangganCollection)
    {
        $userIDKaryawan = auth()->user()->employee_id;
        $teamGetArray = User::where('under_employee_id', $userIDKaryawan)->get();

        foreach ($dataPelangganCollection as $a => $b) {
            foreach ($teamGetArray as $c => $d) {
                if ($b->reference_id !== $d->employee_id) {
                    unset($dataPelangganCollection[$a]);
                }
            }
        }

        return $dataPelangganCollection;
    }

    public function indexAuthSales($dataPelangganCollection)
    {
        $userIDKaryawan = auth()->user()->employee_id;

        foreach ($dataPelangganCollection as $a => $b) {
            if ($b->reference_id !== $userIDKaryawan) {
                unset($dataPelangganCollection[$a]);
            }
        }

        return $dataPelangganCollection;
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, $data_pelanggan)
    {
        $customerFind = $customer->find($data_pelanggan);

        $strPhoneNumber = str_split((string) $customerFind->phone_number);
        unset($strPhoneNumber[0]);

        $customerFind->phone_number = join($strPhoneNumber);
        $customerFind->isCustomerIS = false;
        try {
            $response = Http::withHeaders([
                'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc',
            ])->get('https://legacy.is5.nusa.net.id/customers/' . $customerFind->customer_id);

            if (isset(json_decode($response->body())->statusCode)) {
                $customerFind->isCustomerIS = false;
            } else {
                $customerFind->isCustomerIS = true;
            }
        } catch (\Throwable $th) {
            $customerFind->isCustomerIS = false;
        }

        if ($customerFind->reference_id != null) {
            try {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                ])->get('https://legacy.is5.nusa.net.id/employees/' . $customerFind->reference_id);

                if ($response->successful()) {
                    $customerFind->sales_id = json_decode($response->body())->id;
                    $customerFind->sales_name = json_decode($response->body())->name;
                    $customerFind->sales_email = json_decode($response->body())->email;
                } else {
                    $customerFind->sales_id = null;
                    $customerFind->sales_name = null;
                    $customerFind->sales_email = null;
                }
            } catch (\Throwable $th) {
                $customerFind->sales_id = null;
                $customerFind->sales_name = null;
                $customerFind->sales_email = null;
            }
        }

        $datas = [
            'titlePage' => 'Data Pelanggan',
            'dataPelanggan' => $customerFind,
            'dataPromo' => PromoList::all()
        ];

        return view('Admin.Pages.data-pelanggan.edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer, $data_pelanggan)
    {
        $customerFind = $customer->find($data_pelanggan);

        if ($customerFind->reference_id == null) {
            $resJSON = [];
            $validateRequest = $request->validate(
                [
                    'reference_id' => 'required'
                ],
                [
                    'reference_id.required' => 'ID Sales Wajib Diisi'
                ]
            );

            try {
                $response = Http::withHeaders([
                    'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                ])->get('https://legacy.is5.nusa.net.id/employees/' . $validateRequest['reference_id']);
                $resultJSON = json_decode($response->body());

                $resJSON = $resultJSON;
            } catch (\Throwable $th) {
                $resJSON = [];
            }

            try {
                Mail::raw('Data pelanggan telah diassign ke ' . $resJSON->name . ' oleh ' . auth()->user()->name, function ($message) use ($resJSON) {
                    $message->to($resJSON->email)
                        ->subject("Informasi Assignment Data");
                });
            } catch (\Throwable $th) {
                return back()->with('errorMessage', json_encode($th->getMessage()));
            }

            $customerFind->reference_id = $validateRequest['reference_id'];
            $customerFind->push();
            return redirect()->to('data-pelanggan')->with('successMessage', 'Berhasil update data pelanggan.');
        }

        if ($customerFind->class == "Personal") {
            $validateRequest = $request->validate([
                'pic_name' => 'required',
                'pic_email_address' => 'required',
                'pic_phone_number' => 'required|min:11|max:11',
                'pic_address.*' => 'required',
                'option_pic_identity_number' => 'required',
                'pic_identity_number' => 'required|min:16|max:16',
                'billing_name' => 'required',
                'billing_contact' => 'required',
                'billing_email.0' => 'required',
                'technical_name' => 'required',
                'technical_contact' => 'required',
                'technical_email' => 'required',
                'survey_id' => 'required',
                'extend_note' => 'required'
            ]);

            if ($request->file('upload_foto_identitas') != null) {
                // Hapus Foto Identitas Lama
                $oldPath = $customerFind->service->id_photo_url;
                $deleteFun = $this->deletefileHTTPServer($oldPath);

                if ($deleteFun) {
                    $image = $request->file('upload_foto_identitas');
                    $res = Http::attach('attachment', file_get_contents($image), $image->getFilename() . '.' . $image->getClientOriginalExtension())
                        ->post(env('URL_SERVER_2') . '/api/uploadImg', [
                            'class' => $customerFind->class,
                            'file_type' => 'Identity'
                        ]);

                    $customerFind->service->id_photo_url = json_decode($res->body())->message;
                }
            }

            if ($request->file('upload_foto_npwp') != null) {
                // Hapus Foto NPWP Lama
                $oldPath = $customerFind->npwp_files;
                $deleteFun = $this->deletefileHTTPServer($oldPath);

                if ($deleteFun) {
                    $image = $request->file('upload_foto_npwp');
                    $res = Http::attach('attachment', file_get_contents($image), $image->getFilename() . '.' . $image->getClientOriginalExtension())
                        ->post(env('URL_SERVER_2') . '/api/uploadImg', [
                            'class' => $customerFind->class,
                            'file_type' => 'NPWP'
                        ]);

                    $customerFind->npwp_files = json_decode($res->body())->message;
                }
            }

            $customerFind->name = $validateRequest['pic_name'];
            $customerFind->email = $validateRequest['pic_email_address'];
            $customerFind->phone_number = "0" . $validateRequest['pic_phone_number'];
            $customerFind->address = json_encode($validateRequest['pic_address']);
            $customerFind->identity_type = $validateRequest['option_pic_identity_number'];
            $customerFind->identity_number = $validateRequest['pic_identity_number'];
            $customerFind->npwp_number = $request->get('npwp_number');
            $customerFind->billing->billing_name = $validateRequest['billing_name'];
            $customerFind->billing->billing_contact = $validateRequest['billing_contact'];
            $customerFind->billing->billing_email = json_encode($validateRequest['billing_email']);
            $customerFind->technical->technical_name = $validateRequest['technical_name'];
            $customerFind->technical->technical_contact = $validateRequest['technical_contact'];
            $customerFind->technical->technical_email = $validateRequest['technical_email'];
            $customerFind->survey_id = $validateRequest['survey_id'];
            $customerFind->extend_note = $validateRequest['extend_note'];

            $customerFind->push();
        } else if ($customerFind->class == "Bussiness") {
            $validateRequest = $request->validate([
                'pic_name' => 'required',
                'pic_email_address' => 'required',
                'pic_phone_number' => 'required|min:11|max:11',
                'pic_address.*' => 'required',
                'option_pic_identity_number' => 'required',
                'pic_identity_number' => 'required|min:16|max:16',
                'company_name' => 'required',
                'company_address' => 'required',
                'company_npwp_sppkp' => 'required',
                'company_phone_number' => 'required',
                'billing_name' => 'required',
                'billing_contact' => 'required',
                'billing_email.0' => 'required',
                'technical_name' => 'required',
                'technical_contact' => 'required',
                'technical_email' => 'required',
                'survey_id' => 'required',
                'extend_note' => 'required'
            ]);

            if ($request->file('upload_foto_identitas') != null) {
                // Hapus Foto Identitas Lama
                $oldPath = $customerFind->service->id_photo_url;
                $deleteFun = $this->deletefileHTTPServer($oldPath);

                if ($deleteFun) {
                    $image = $request->file('upload_foto_identitas');
                    $res = Http::attach('attachment', file_get_contents($image), $image->getFilename() . '.' . $image->getClientOriginalExtension())
                        ->post(env('URL_SERVER_2') . '/api/uploadImg', [
                            'class' => $customerFind->class,
                            'file_type' => 'Identity'
                        ]);

                    $customerFind->service->id_photo_url = json_decode($res->body())->message;
                }
            }

            if ($request->file('upload_foto_npwp_sppkp') != null) {
                // Hapus Foto NPWP Lama
                $oldPath = $customerFind->company_npwp_files;
                $deleteFun = $this->deletefileHTTPServer($oldPath);

                if ($deleteFun) {
                    $image = $request->file('upload_foto_npwp_sppkp');
                    $res = Http::attach('attachment', file_get_contents($image), $image->getFilename() . '.' . $image->getClientOriginalExtension())
                        ->post(env('URL_SERVER_2') . '/api/uploadImg', [
                            'class' => $customerFind->class,
                            'file_type' => 'NPWP'
                        ]);

                    $customerFind->company_npwp_files = json_decode($res->body())->message;
                }
            }

            $customerFind->name = $validateRequest['pic_name'];
            $customerFind->email = $validateRequest['pic_email_address'];
            $customerFind->phone_number = "0" . $validateRequest['pic_phone_number'];
            $customerFind->address = json_encode($validateRequest['pic_address']);
            $customerFind->identity_type = $validateRequest['option_pic_identity_number'];
            $customerFind->identity_number = $validateRequest['pic_identity_number'];
            $customerFind->company_name = $validateRequest['company_name'];
            $customerFind->company_address = $validateRequest['company_address'];
            $customerFind->company_npwp_sppkp = $validateRequest['company_npwp_sppkp'];
            $customerFind->company_phone_number = $validateRequest['company_phone_number'];
            $customerFind->billing->billing_name = $validateRequest['billing_name'];
            $customerFind->billing->billing_contact = $validateRequest['billing_contact'];
            $customerFind->billing->billing_email = json_encode($validateRequest['billing_email']);
            $customerFind->technical->technical_name = $validateRequest['technical_name'];
            $customerFind->technical->technical_contact = $validateRequest['technical_contact'];
            $customerFind->technical->technical_email = $validateRequest['technical_email'];
            $customerFind->survey_id = $validateRequest['survey_id'];
            $customerFind->extend_note = $validateRequest['extend_note'];

            $customerFind->push();
        }

        return redirect()->to('data-pelanggan')->with('successMessage', 'Berhasil update data pelanggan.');
    }

    public function deletefileHTTPServer($path)
    {
        $oldPathArr = explode('/', $path);
        foreach ($oldPathArr as $key => $value) {
            unset($oldPathArr[0]);
            unset($oldPathArr[1]);
            unset($oldPathArr[2]);
        }
        $oldPathSecure = join('/', $oldPathArr);

        try {
            $response = Http::delete(env('URL_SERVER_2') . '/api/deleteImg', [
                'q' => $oldPathSecure
            ]);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function approvalMessage(Request $request, $id_pelanggan)
    {
        $utype = auth()->user()->utype;
        $dataCustomer = Customer::find($id_pelanggan);

        switch ($utype) {
            case 'AuthSales':
                $underIDKaryawan = auth()->user()->under_employee_id;
                $PIC_Name = "";
                $resJSON = json_decode(json_encode([]));

                try {
                    $response = Http::withHeaders([
                        'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                    ])->get('https://legacy.is5.nusa.net.id/employees/' . $underIDKaryawan);
                    $resultJSON = json_decode($response->body());

                    $resJSON = $resultJSON;
                    $PIC_Name = $resultJSON->name;
                } catch (\Throwable $th) {
                    $resJSON = [];
                    $PIC_Name = null;
                }

                try {
                    $email_params = [
                        'notif_receiever' => $resJSON->name,
                        'customer_name' => $dataCustomer->name,
                        'status' => 'disetujui',
                        'notif_sender' => auth()->user()->name,
                        'message_body' => $request->get('message_body_notification'),
                        'send_to' => $resJSON->email,
                        'subject_email' => 'Pemberitahuan progress data pelanggan'
                    ];
                    Mail::send('Email.notification', $email_params, function ($message) use ($email_params) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->to($email_params['send_to'])->subject($email_params['subject_email']);
                    });
                } catch (\Throwable $th) {
                    return back()->with('errorMessage', json_encode($th->getMessage()));
                }

                $oldData = $dataCustomer->approval->array_approval;
                $oldDataJSON = json_decode($oldData);
                $oldDataJSON->{$utype}->PIC_Name = auth()->user()->name;

                $oldDataJSON->{$utype}->isApproved = true;
                $oldDataJSON->{$utype}->isRejected = false;

                $oldDataJSON->AuthSalesManager->isApproved = false;
                $oldDataJSON->AuthSalesManager->isRejected = false;

                $oldDataJSON->AuthCRO->isApproved = false;
                $oldDataJSON->AuthCRO->isRejected = false;

                // Ambil Message dari Modal
                $oldDataJSON->{$utype}->message = $request->get('message_body_notification');

                $oldDataJSON->{$utype}->sended_at = Carbon::now();
                $oldDataJSON->{$utype}->replied_at = Carbon::now();

                $dataCustomer->approval->current_staging_area = "AuthSalesManager";
                $dataCustomer->approval->next_staging_area = "AuthCRO";
                $dataCustomer->approval->array_approval = json_encode($oldDataJSON);
                break;
            case 'AuthSalesManager':
                $resJSON = [];
                foreach (User::all() as $key => $value) {
                    if ($value->utype == "AuthCRO") {
                        try {
                            $response = Http::withHeaders([
                                'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                            ])->get('https://legacy.is5.nusa.net.id/employees/' . $value->employee_id);
                            $resultJSON = json_decode($response->body());

                            $resJSON = $resultJSON;
                        } catch (\Throwable $th) {
                            $resJSON = [];
                        }

                        try {
                            $email_params = [
                                'notif_receiever' => $resJSON->name,
                                'customer_name' => $dataCustomer->name,
                                'status' => 'disetujui',
                                'notif_sender' => auth()->user()->name,
                                'message_body' => $request->get('message_body_notification'),
                                'send_to' => $resJSON->email,
                                'subject_email' => 'Pemberitahuan progress data pelanggan'
                            ];
                            Mail::send('Email.notification', $email_params, function ($message) use ($email_params) {
                                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                                $message->to($email_params['send_to'])->subject($email_params['subject_email']);
                            });
                        } catch (\Throwable $th) {
                            return back()->with('errorMessage', json_encode($th->getMessage()));
                            break;
                        }
                    }
                }

                $oldData = $dataCustomer->approval->array_approval;
                $oldDataJSON = json_decode($oldData);
                $oldDataJSON->{$utype}->PIC_Name = auth()->user()->name;

                $oldDataJSON->{$utype}->isApproved = true;
                $oldDataJSON->{$utype}->isRejected = false;

                $oldDataJSON->AuthCRO->isApproved = false;
                $oldDataJSON->AuthCRO->isRejected = false;

                // Ambil Message dari Modal
                $oldDataJSON->{$utype}->message = $request->get('message_body_notification');

                $oldDataJSON->{$utype}->sended_at = Carbon::now();
                $oldDataJSON->{$utype}->replied_at = Carbon::now();

                $dataCustomer->approval->current_staging_area = "AuthCRO";
                $dataCustomer->approval->next_staging_area = "AuthSales";
                $dataCustomer->approval->array_approval = json_encode($oldDataJSON);
                break;
            case 'AuthCRO':
                $oldData = $dataCustomer->approval->array_approval;
                $oldDataJSON = json_decode($oldData);
                $oldDataJSON->{$utype}->PIC_Name = auth()->user()->name;
                $oldDataJSON->{$utype}->isApproved = true;
                $oldDataJSON->{$utype}->isRejected = false;

                // Ambil Message dari Modal
                $oldDataJSON->{$utype}->message = $request->get('message_body_notification');

                $oldDataJSON->{$utype}->sended_at = Carbon::now();
                $oldDataJSON->{$utype}->replied_at = Carbon::now();

                $dataCustomer->approval->current_staging_area = "AuthCRO";
                $dataCustomer->approval->next_staging_area =    "AuthCRO";
                $dataCustomer->approval->array_approval = json_encode($oldDataJSON);
                break;
            default:
                # code...
                break;
        }

        $dataCustomer->push();

        return back()->with('successMessage', 'Berhasil mengupdate timeline.');
    }

    public function rejectedMessage(Request $request, $id_pelanggan)
    {
        $utype = auth()->user()->utype;
        $dataCustomer = Customer::find($id_pelanggan);

        switch ($utype) {
            case 'AuthSalesManager':
                $resJSON = [];
                foreach (User::all() as $key => $value) {
                    if ($value->utype == "AuthSales" && $value->under_employee_id == auth()->user()->employee_id) {
                        try {
                            $response = Http::withHeaders([
                                'X-Api-Key' => 'lfHvJBMHkoqp93YR:4d059474ecb431eefb25c23383ea65fc'
                            ])->get('https://legacy.is5.nusa.net.id/employees/' . $value->employee_id);
                            $resultJSON = json_decode($response->body());

                            $resJSON = $resultJSON;
                        } catch (\Throwable $th) {
                            $resJSON = [];
                        }

                        try {
                            $email_params = [
                                'notif_receiever' => $resJSON->name,
                                'customer_name' => $dataCustomer->name,
                                'status' => 'ditolak',
                                'notif_sender' => auth()->user()->name,
                                'message_body' => $request->get('message_body_notification'),
                                'send_to' => $resJSON->email,
                                'subject_email' => 'Pemberitahuan progress data pelanggan'
                            ];
                            Mail::send('Email.notification', $email_params, function ($message) use ($email_params) {
                                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                                $message->to($email_params['send_to'])->subject($email_params['subject_email']);
                            });
                        } catch (\Throwable $th) {
                            return back()->with('errorMessage', json_encode($th->getMessage()));
                            break;
                        }
                    }
                }

                $oldData = $dataCustomer->approval->array_approval;
                $oldDataJSON = json_decode($oldData);
                $oldDataJSON->{$utype}->PIC_Name = auth()->user()->name;

                $oldDataJSON->{$utype}->isApproved = false;
                $oldDataJSON->{$utype}->isRejected = true;

                $oldDataJSON->AuthSales->isApproved = false;
                $oldDataJSON->AuthSales->isRejected = false;

                // Ambil dari Modal
                $oldDataJSON->{$utype}->message = $request->get('message_body_notification');

                $oldDataJSON->{$utype}->sended_at = Carbon::now();
                $oldDataJSON->{$utype}->replied_at = Carbon::now();

                $dataCustomer->approval->current_staging_area = "AuthSales";
                $dataCustomer->approval->next_staging_area = "AuthSalesManager";
                $dataCustomer->approval->array_approval = json_encode($oldDataJSON);
                break;
            case 'AuthCRO':
                $oldData = $dataCustomer->approval->array_approval;
                $oldDataJSON = json_decode($oldData);
                $oldDataJSON->{$utype}->PIC_Name = auth()->user()->name;

                $oldDataJSON->{$utype}->isApproved = false;
                $oldDataJSON->{$utype}->isRejected = true;

                $oldDataJSON->AuthSalesManager->isApproved = false;
                $oldDataJSON->AuthSalesManager->isRejected = false;

                $oldDataJSON->AuthSales->isApproved = false;
                $oldDataJSON->AuthSales->isRejected = false;

                // Ambil Dari Modal
                $oldDataJSON->{$utype}->message = $request->get('message_body_notification');

                $oldDataJSON->{$utype}->sended_at = Carbon::now();
                $oldDataJSON->{$utype}->replied_at = Carbon::now();

                $dataCustomer->approval->current_staging_area = "AuthSales";
                $dataCustomer->approval->next_staging_area = "AuthSalesManager";
                $dataCustomer->approval->array_approval = json_encode($oldDataJSON);
                break;
            default:
                # code...
                break;
        }

        $dataCustomer->push();

        return back()->with('successMessage', 'Berhasil mengupdate timeline.');
    }

    public function downloadPDFCustomer($id_pelanggan)
    {
        dd($id_pelanggan);
    }
}
