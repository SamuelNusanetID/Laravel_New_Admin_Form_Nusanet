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
        <img src="assets/images/header baru.jpeg" width="100%" height="100%" />
    </header>

    <footer>
        <img src="assets/images/footer baru.jpeg" width="100%" height="100%" />
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

        <div class="mt-5">
            <div class="mt-5" style="text-align: center">
                <h5 style="text-decoration: underline; font-weight: bold;">
                    SYARAT DAN KETENTUAN PENDAFTARAN & PASANG BARU
                </h5>
                <p style="padding: 0; margin: 0;">Mohon untuk membaca secara seksama sebelum menyetujui syarat dan
                    ketentuan ini</p>
            </div>
            <p style="text-align: justify;">
                Dengan ini Pelanggan menyatakan setuju terhadap segala ketentuan yang ada di Formulir pendaftaran dan
                pasang
                baru dibawah ini :
            </p>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p>Pasal 1</p>
                    <p>RUANG LINGKUP</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>NUSANET</strong> akan menyediakan Jasa Akses Internet kepada
                            <strong>PELANGGAN</strong>
                            termasuk
                            pemasangan dan pengaktifan yang dibutuhkan oleh <strong>PELANGGAN</strong> sesuai dengan
                            Jasa
                            Akses
                            Internet
                            yang dipilih pada Formulir Pendaftaran dan Pasang Baru ini.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Syarat dan ketentuan ini berlaku selama berlangganan Jasa Akses Internet ini memiliki
                            kontrak
                            minimal 1
                            ( satu ) tahun dan otomatis diperpanjang jika setelah
                            ada konfirmasi dari <strong>PELANGGAN</strong>.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Jasa Akses Internet yang dipilih oleh <strong>PELANGGAN</strong> wajib digunakan untuk
                            kepentingan
                            sendiri / perusahaan
                            <strong>PELANGGAN</strong>, dan dilarang untuk disewakan, dijual atau dipindahtangankan
                            dengan
                            cara
                            apapun kepada pihak
                            ketiga tanpa persetujuan tertulis dari <strong>NUSANET</strong>.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0" style="padding: 0; margin: 0;">Pasal 2</p>
                    <p class="p-0 m-0">HAK DAN KEWAJIBAN PELANGGAN</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Berhak mendapatkan layanan jasa akses selama 24 ( dua puluh empat ) jam sehari, 7 ( tujuh )
                            hari
                            seminggu
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Memperoleh perbaikan atas kerusakan atau, gangguan yang bukan disebabkan oleh kesalahan
                            <strong>PELANGGAN</strong>
                            setelah pemberitahuan kepada <strong>NUSANET</strong>
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Apabila perangkat Nusanet yang ditempatkan di lokasi <strong>PELANGGAN</strong> hilang,
                            rusak,
                            atau
                            musnah karena sebab
                            apapun kecuali Force Majeure, maka Pelanggan wajib mengganti perangkat dalam bentuk
                            perangkat
                            baru atau
                            penggantian sesuai dengan harga perangkat saat terjadi kerusakan/kehilangan/musnah, selambat
                            -
                            lambatnya
                            30 hari dari kejadian tersebut
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>PELANGGAN</strong> wajib menjamin bahwa jasa akses internet yang digunakan tidak
                            akan
                            dipergunakan untuk
                            tindakan-tindakan yang melanggar hukum dan/atau tindakan-tindakan penyerangan di Internet
                            seperti DDoS,
                            Spamming, Pishing, Scanning, Botnet, Carding, Doorway, Cracking, dan lain-lain
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>PELANGGAN</strong> wajib menjamin bahwa segala data yang diberikan dalam seluruh
                            dokumen
                            tertulis maupun
                            keterangan yang diberikan <strong>PELANGGAN</strong> atau kuasa <strong>PELANGGAN</strong>
                            kepada
                            <strong>NUSANET</strong> adalah benar, sehingga hal yang
                            timbul sehubungan dengan pemberian data-data tersebut menjadi tanggung jawab penuh dari
                            <strong>PELANGGAN</strong>.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 3</p>
                    <p class="p-0 m-0">HAK DAN KEWAJIBAN NUSANET</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>NUSANET</strong> berhak setiap saat memeriksa dan melakukan perubahan layanan
                            berdasarkan
                            Perjanjian ini dengan
                            persetujuan <strong>PELANGGAN</strong>.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>NUSANET</strong> wajib menjamin dan menjaga kelancaran akses internet di tempat
                            <strong>PELANGGAN</strong> sesuai
                            Pasal 1 Ayat 1
                            dengan dukungan pelayanan dari Helpdesk online 24 jam ( Telp. 061 - 4558100/ 061 - 30018200,
                            atau
                            Whatsapp/SMS 08198-54321 ). Bila diperlukan kunjungan engineer ke lokasi, dapat dilakukan
                            setiap
                            hari
                            jam 08.30 s/d 22.00 sesuai jadwal kunjungan yang sudah disepakati <strong>PELANGGAN</strong>
                            dengan
                            Helpdesk.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 4</p>
                    <p class="p-0 m-0">PEMBAYARAN</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Pembayaran biaya jasa instalasi baru & jasa langganan akses internet wajib dilakukan
                            <strong>PELANGGAN</strong> maksimum
                            7 ( tujuh ) hari setelah instalasi selesai. Pembayaran perpanjangan akses internet
                            bulanan/tahunan
                            dibayar maksimum tanggal 20 ( dua puluh ) pada bulan tersebut & ditransfer ke rekening yang
                            tertera
                            diinvoice. Untuk pembayaran ditujukan ke :
                            </br>
                        <table class="ms-5">
                            <tbody class="fw-bold">
                                <tr>
                                    <td>No Rekening</td>
                                    <td>:</td>
                                    <td>106.002.2288.222</td>
                                </tr>
                                <tr>
                                    <td>Nama Bank</td>
                                    <td>:</td>
                                    <td>PT Bank Mandiri</td>
                                </tr>
                                <tr>
                                    <td>Nama pengirim</td>
                                    <td>:</td>
                                    <td>PT Media Antar Nusa</td>
                                </tr>
                            </tbody>
                        </table>
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Bukti pembayaran biaya wajib dikirim oleh <strong>PELANGGAN</strong> kepada
                            <strong>NUSANET</strong>
                            melalui email billing ke
                            <a href="#" class="text-primary"
                                style="text-decoration: underline;">billing@mdn.nusa.net.id</a>
                            <strong>atau whatsapp ke 0895 3739 54321</strong>
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Apabila <strong>PELANGGAN</strong> melalaikan kewajibannya membayar biaya langganan jasa
                            akses
                            internet
                            melewati tanggal
                            akhir pembayaran tersebut seperti dimaksud pada pasal 4 ( empat ) ayat 1 ( satu ), maka
                            Pelanggan
                            dikenakan denda keterlambatan yang akan dihitung berdasarkan :
                            </br>
                            <span>
                                1 ( satu ) sampai dengan 2 ( dua ) hari keterlambatan didenda sebesar 1% ( satu persen )
                                dari total
                                tagihan. Apabila lebih dari 2 ( dua ) hari, maka koneksi akan terblokir oleh system.
                                Apabila
                                tagihan
                                masih tetap belum dibayarkan, Pelanggan akan dikenakan denda keterlambatan sebesar 3% (
                                tiga
                                persen
                                )
                                setiap bulan dari total tagihan.
                            </span>
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Penyambungan kembali jasa akses internet sebagai akibat dari pasal ini ayat 3 akan dilakukan
                            Oleh
                            <strong>NUSANET</strong> setelah <strong>PELANGGAN</strong> melunasi seluruh tunggakan
                            beserta
                            dendanya.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Untuk langganan jasa akses internet Fiber Optic, <strong>PELANGGAN</strong> dibebankan biaya
                            penyewaan
                            link Fiber Optic
                            selama masa blok yang diajukan/ keinginan <strong>PELANGGAN</strong> sebesar Rp. 300,000.-/
                            bulan (
                            selama masa blok ).
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 5</p>
                    <p class="p-0 m-0">SERVICE LEVEL AGREEMENT</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>NUSANET</strong> memberikan jaminan Service Level Agreement sesuai paket yang
                            diambil
                            <strong>PELANGGAN</strong> yakni Broadband
                            Business dengan SLA 98% dan Broadband Home dengan SLA ( 95 % ), Dedicated Kontrak Kerjasama
                            terpisah.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>PELANGGAN</strong> mendapatkan Restitusi atas terjadinya gangguan/kerusakan internet
                            yang
                            dikarenakan kesalahan
                            <strong>NUSANET</strong> yang menyebabkan Service Level Agreement berada dibawah standar
                            yang
                            dijamin
                            <strong>NUSANET</strong> dalam pasal
                            ini dengan pengajuan tertulis kepada <strong>NUSANET</strong>.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 6</p>
                    <p class="p-0 m-0">ASURANSI & KERUSAKAN DI LOKASI KERJA</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>NUSANET</strong> berusaha memperhatikan, menghindari timbulnya kerugian, dan
                            bertanggung
                            jawab,
                            bila terjadi
                            kerusakan/ kerugian benda milik <strong>PELANGGAN</strong> yang terbukti dan disebabkan oleh
                            kelalaian
                            pelaksanaan tugas
                            Nusanet dengan nilai maksimal penggantian sebagaimana disebutkan dalam Pasal ini ayat 2 (
                            dua )
                            perjanjian sewa ini & melepaskan <strong>PELANGGAN</strong> dari tuntutan yang timbul
                            karenanya.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Nusanet memberikan jaminan Asuransi General Public Liability yang menjamin secara terbatas
                            penggantian
                            atas kerusakan, yang terbukti berdasarkan hukum, secara sengaja maupun tidak sengaja
                            dilakukan
                            oleh
                            tenaga kerja Nusanet atau akibat kelalaian, ketidaktahuan, dan ketidakterampilan, setelah
                            dilakukan
                            investigasi oleh Para Pihak dan tidak tertutup kemungkinan juga melibatkan pihak lain yang
                            dianggap
                            ahli/ berwenang, yang dapat dikategorikan sebagai suatu kecelakaan kerja dengan jumlah
                            penggantian tidak
                            lebih dari Rp. 10,000,000,- ( sepuluh juta rupiah ).
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Apabila terjadi pencurian/tindakan kriminal yang terbukti dilakukan oleh karyawan
                            <strong>NUSANET</strong> di lingkungan
                            <strong>PELANGGAN</strong>, maka <strong>NUSANET</strong> akan bertanggung jawab untuk
                            memproses
                            secara
                            hukum tindak kriminal tersebut
                            bekerja sama dengan <strong>PELANGGAN</strong>. Segala akibat yang timbul karena perbuatan
                            kriminal
                            tersebut adalah tetap
                            merupakan tanggung jawab dari individual karyawan yang bersangkutan.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 7</p>
                    <p class="p-0 m-0">FORCE MAJEURE</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Force Majeure berarti setiap tindakan yang berada diluar kekuasaan yang wajar dari Kedua
                            Pihak.
                            Yang
                            dimaksud dengan Force Majeure adalah tindakan alam ( act of god ), seperti bencana alam (
                            banjir, gempa
                            bumi ), epidemik, kerusuhan, pernyataan perang, perang. Peraturan dan atau larangan
                            pemerintah,
                            Embargo,
                            Interfensi frekuensi wireless, Serangan Worm, Virus, DDoS, Spamming, Phishing, Scanning,
                            Botnet,
                            Carding, Doorway, Cracking, dan lain-lain.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>NUSANET</strong> dibebaskan dari kerugian yang dialami oleh
                            <strong>PELANGGAN</strong>
                            dikarenakan Force Majeure,
                            baik secara
                            langsung maupun tidak langsung.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 8</p>
                    <p class="p-0 m-0">PEMUTUSAN BERLANGGANAN</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>PELANGGAN & NUSANET</strong> dapat mengakhiri belangganan ini dengan menyampaikan
                            pemberitahuan
                            lebih dulu secara
                            tertulis selambat-lambatnya 1 ( satu ) bulan sebelum tanggal pemutusan yang diinginkan.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            <strong>Pelanggan</strong> dapat mengakhiri berlangganan ini yang sebelumnya sudah diberi
                            teguran
                            sebanyak 3 ( tiga )
                            kali secara tertulis dengan alasan yang jelas sbb :
                            </br>
                            <span>
                                a. Mutu dan pelaksanaan jasa-jasa yang dilaksanakan tidak sesuai dengan syarat dan
                                ketentuan.
                            </span>
                            </br>
                            <span>
                                b. Tidak terlihat/belum terlihat adanya keinginan dan usaha untuk memperbaiki kinerjanya
                                sebagai
                                hasil
                                evaluasi <strong>Pelanggan</strong>
                            </span>
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Sesuai pasal 2 ( dua ) ayat 5 ( lima ) maka, <strong>Nusanet</strong> berhak memutuskan/
                            membatalkan
                            secara sepihak jasa
                            langganan internet setiap saat dan <strong>Pelanggan</strong> sepakat untuk melepaskan
                            segala
                            hak untuk
                            menuntut terhadap
                            segala akibat putusnya/batalnya penyedia jasa dimaksud.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Apabila terjadi pemutusan berlangganan secara sepihak dari <strong>Pelanggan</strong> pada
                            saat
                            proses
                            instalasi/setelah
                            instalasi jasa internet selesai ditahun pertama masa kontrak, maka
                            <strong>Pelanggan</strong>
                            wajib
                            membayar biaya
                            instalasi sesuai syarat & ketentuan ini serta dikenakan biaya terminasi 50% ( lima puluh
                            persen
                            ) dari
                            harga paket per bulan dikalikan sisa masa kontrak dan untuk 10% PPN tidak dikembalikan,
                            kecuali
                            jika
                            <strong>Nusanet</strong> gagal memenuhi kesepakatan yang telah dibuat.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 9</p>
                    <p class="p-0 m-0">RELOKASI</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Apabila <strong>Pelanggan</strong> mempunyai keinginan untuk memindahkan titik asal / titik
                            akhir
                            sambungan karena
                            perpindahan lokasi, maka <strong>Nusanet</strong> akan membantu memindahkan jasa akses
                            internet
                            ke
                            lokasi yang baru,
                            sepanjang tersedianya jaringan di lokasi yang baru & dikarenakan biaya instalasi pemasangan
                            baru.
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 10</p>
                    <p class="p-0 m-0">PENYELESAIAN PERSELISIHAN</p>
                </div>
                <ol>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Apabila terjadi pebedaan pendapat/ perselisihan dalam pelaksanaan dan atau penafsiran
                            pelaksanaan
                            formulir ini,sejauh mungkin <strong>Pelanggan & Nusanet</strong> akan menyelesaikannya
                            melalui
                            musyawarah.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Jika perselisihan, kontroversi, atau perbedaan tidak dapat diselesaikan secara musyawarah
                            untuk
                            mufakat,
                            maka <strong>Nusanet & Pelanggan</strong> sepakat untuk menyelesaikan perselisihan.,
                            kontroversi, atau
                            perbedaan tersebut
                            melalui Pengadilan negeri Medan.
                        </p>
                    </li>
                    <li class="ps-2">
                        <p class="p-0 m-0" style="text-align: justify;">
                            Segala biaya yang timbul sebagai pelaksanaan perjanjian ini menjadi tanggung jawab
                            masing-masing
                        </p>
                    </li>
                </ol>
            </div>
            <div>
                <div style="padding: 0; margin: 0; text-align: center;">
                    <p class="p-0 m-0">Pasal 11</p>
                    <p class="p-0 m-0">Ketentuan Khusus</p>
                </div>
                <p class="px-4">
                    Pelanggan sepenuhnya memahami, menerima, dan tunduk pada syarat dan Ketentuan Pendaftaran & Pasang
                    Baru
                    ini.
                </p>
            </div>
            <div style="width: 100vw; float: right;">
                <p style="margin-top: 100px !important;">Yang bertanda tangan dibawah ini,</p>
                <h1 style="text-align:center;">{{ explode(' ', $customer->name)[0] }}</h1>
                <h4>{{ $customer->name }}</h4>
            </div>
        </div>

    </main>
</body>

</html>
