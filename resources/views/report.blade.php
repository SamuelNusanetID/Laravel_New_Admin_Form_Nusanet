<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Request::segment(2) }}_form.pdf</title>

    <style>
        * {
            font-family: "Times New Roman", Times, serif !important;
        }

        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
         **/
        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .title-page {
            position: fixed;
            top: 2.5cm;
            left: 5.5cm;
            right: 0cm;
            height: 3cm;
        }

        .header-pdf {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5em !important;
            padding-bottom: 1em !important;
            border-bottom: 2px solid #dedede;
        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .mb-3 {
            margin-bottom: 1em !important;
        }

        .mt-5 {
            margin-top: 3em !important;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-size: 1rem;
        }

        label {
            margin: 0;
            display: block;
        }

        .form-control {
            box-shadow: none;
            font-size: 1rem;
            color: #343434 !important;
            width: 85%;
            padding: .375rem .75rem;
            line-height: 1.5;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            -webkit-border-radius: .25rem;
            border-radius: .25rem;
        }

        label {
            color: #000;
            font-weight: 600;
            text-transform: camel;
        }

        .form-control {
            color: #000 !important;
        }

        .new-page {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <img src="bin/img/header baru.jpeg" width="100%" height="100%" />
    </header>

    <footer>
        <img src="bin/img/footer baru.jpeg" width="100%" height="100%" />
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <div class="{{ $customer->company_name != null ? 'row' : null }} mt-5 new-page"
            style="border: 1px solid #dedede; padding: 1em; border-radius: 15px;">
            <h2 class="title-page">Formulir Digital Registrasi Internet</h2>
            <p style="font-weight: bold; margin-bottom: 1.5em;">*) Data Personal / Penanggungjawab</p>
            <div class="{{ $customer->company_name != null ? 'column' : null }}"
                style="{{ $customer->company_name != null ? null : 'padding-left: 2.5em;' }}">
                <div class="mb-3">
                    <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                    <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap"
                        value="{{ $customer->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="alamat_lengkap">Alamat Lengkap</label>
                    <textarea class="form-control" name="alamat_lengkap" id="alamat_lengkap" rows="5" readonly style="height: 150px;">{{ json_decode($customer->address)[0] }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="alamat_email">Alamat Email</label>
                    <input class="form-control" type="text" name="alamat_email" id="alamat_email"
                        value="{{ $customer->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="identity_number">No. Identitas KTP</label>
                    <input class="form-control" type="text" name="identity_number" id="identity_number"
                        value="{{ $customer->identity_number }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone_number">Nomor Telepon</label>
                    <input class="form-control" type="text" name="phone_number" id="phone_number"
                        value="{{ $customer->phone_number }}" readonly>
                </div>
            </div>

            @if ($customer->company_name != null)
                <div class="column">
                    <div class="mb-3">
                        <label class="form-label" for="company_name">Nama Perusahaan</label>
                        <input class="form-control" type="text" name="company_name" id="company_name"
                            value="{{ $customer->company_name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="company_address">Alamat Perusahaan</label>
                        <textarea class="form-control" name="company_address" id="company_address" rows="5" readonly
                            style="height: 150px;">{{ $customer->company_address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="company_npwp">No.NPWP Perusahaan</label>
                        <input class="form-control" type="text" name="company_npwp" id="company_npwp"
                            value="{{ $customer->company_npwp }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="company_phone_number">No.Telepon Perusahaan</label>
                        <input class="form-control" type="text" name="company_phone_number" id="company_phone_number"
                            value="{{ $customer->company_phone_number }}" readonly>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-5" style="border: 1px solid #dedede; padding: 1em; border-radius: 15px; margin-bottom: 1.5em;">
            <h2 class="title-page">Formulir Digital Registrasi Internet</h2>
            <p style="font-weight: bold; margin-bottom: 1.5em;">*) Data Pembayaran</p>
            <div class="mb-3">
                <label class="form-label" for="billing_name">Nama Bayar</label>
                <input class="form-control" type="text" name="billing_name" id="billing_name"
                    value="{{ $customer->billing->billing_name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="billing_contact">Kontak Bayar</label>
                <input class="form-control" type="text" name="billing_contact" id="billing_contact"
                    value="{{ $customer->billing->billing_contact }}" readonly>
            </div>
            @php
                $i = 1;
            @endphp
            @foreach (json_decode($customer->billing->billing_email) as $item)
                <div class="mb-3">
                    <label class="form-label" for="alamat_email_{{ $i }}">Alamat Email
                        {{ $i }}</label>
                    <input class="form-control" type="text" name="alamat_email_{{ $i }}"
                        id="alamat_email_{{ $i }}" value="{{ $item }}" readonly>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>

        <div class="new-page" style="border: 1px solid #dedede; padding: 1em; border-radius: 15px;">
            <p style="font-weight: bold; margin-bottom: 1.5em;">*) Data Teknis</p>
            <div class="mb-3">
                <label class="form-label" for="technical_name">Nama Teknis</label>
                <input class="form-control" type="text" name="technical_name" id="technical_name"
                    value="{{ $customer->technical->technical_name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="technical_contact">Kontak Teknis</label>
                <input class="form-control" type="text" name="technical_contact" id="technical_contact"
                    value="{{ $customer->technical->technical_contact }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="technical_email">Alamat Email Teknis</label>
                <input class="form-control" type="text" name="technical_email" id="technical_email"
                    value="{{ $customer->technical->technical_email }}" readonly>
            </div>
        </div>

        <div class="mt-5" style="border: 1px solid #dedede; padding: 1em; border-radius: 15px;">
            <h2 class="title-page">Formulir Digital Registrasi Internet</h2>
            <p style="font-weight: bold; margin-bottom: 1.5em;">*) Data Layanan</p>
            <div class="mb-3">
                <label class="form-label" for="package_name">Nama Paket</label>
                <input class="form-control" type="text" name="package_name" id="package_name"
                    value="{{ json_decode($customer->service->service_package)[0]->{'service_name'} }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="package_top">Jangka Waktu Paket</label>
                <input class="form-control" type="text" name="package_top" id="package_top"
                    value="{{ json_decode($customer->service->service_package)[0]->{'termofpaymentDeals'} }}"
                    readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="package_price">Harga Paket</label>
                <input class="form-control" type="text" name="package_price" id="package_price"
                    value="{{ json_decode($customer->service->service_package)[0]->{'service_price'} }}" readonly>
            </div>
        </div>

        <div class="mt-5" style="border: 1px solid #dedede; padding: 1em; border-radius: 15px;">
            <p style="font-weight: bold; margin-bottom: 1.5em;">*) Catatan Tambahan</p>
            <div class="mb-3">
                <label class="form-label" for="package_name">ID Survey</label>
                <input class="form-control" type="text" name="package_name" id="package_name"
                    value="{{ $customer->survey_id }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="package_top">Catatan</label>
                <textarea class="form-control" name="package_top" id="package_top" style="height: 150px;" readonly>{{ $customer->extend_note }}</textarea>
            </div>
        </div>

        <div style="margin-top: 5em;">
            @foreach (json_decode($customer->service->service_package) as $item)
                @switch(explode(' ', $item->service_name)[0].' '.explode(' ', $item->service_name)[1])
                    @case('Broadband Home')
                        @include('terms.home')
                    @break

                    @case('Broadband Bussiness')
                        @include('terms.bussiness')
                    @break

                    @default
                        @include('terms.dedicated')
                @endswitch
            @endforeach
        </div>
    </main>
</body>

</html>
