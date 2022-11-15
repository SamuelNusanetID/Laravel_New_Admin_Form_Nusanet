<div class="modal fade" id="pelanggan{{ $pelanggan->id }}Modal" tabindex="-1"
    aria-labelledby="pelanggan{{ $pelanggan->id }}ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5" id="pelanggan{{ $pelanggan->id }}ModalLabel">
                    Detail Data Customer
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-start fw-bold">Data Pelanggan</h4>
                <hr>
                <div class="row">
                    <div class="@if ($pelanggan->class == 'Bussiness') col-sm-6 @else col-sm-12 @endif text-start pe-5">
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-sm-6 col-form-label">
                                ID Pelanggan
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="customer_id"
                                    value="{{ $pelanggan->customer_id }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-6 col-form-label">
                                Nama Pelanggan
                            </label>
                            <div class="col-sm-6">
                                <textarea class="form-control-plaintext" id="name" readonly style="text-align: justify;">{{ $pelanggan->name }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-6 col-form-label">
                                Alamat Pelanggan
                            </label>
                            <div class="col-sm-6">
                                @php
                                    $a = 1;
                                @endphp
                                @foreach (json_decode($pelanggan->address) as $item)
                                    <textarea class="form-control-plaintext" id="address" readonly style="text-align: justify;">{{ $a . ') ' . $item }}</textarea>
                                    @php
                                        $a++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="geolocation" class="col-sm-6 col-form-label">
                                Geolocation
                            </label>
                            <div class="col-sm-6">
                                @php
                                    $b = 1;
                                @endphp
                                @foreach (json_decode($pelanggan->geolocation) as $item)
                                    <textarea class="form-control-plaintext" id="address" readonly style="text-align: justify;">{{ $b . ') Latitude : ' . json_decode($item)->lat . ' & Langitude : ' . json_decode($item)->lng }}</textarea>
                                    @php
                                        $b++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-6 col-form-label">
                                Email Pelanggan
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="email"
                                    value="{{ $pelanggan->email }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="identity_type" class="col-sm-6 col-form-label">
                                Tipe Identitas
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="identity_type"
                                    value="{{ $pelanggan->identity_type }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="identity_number" class="col-sm-6 col-form-label">
                                Nomor Identitas
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="identity_number"
                                    value="{{ $pelanggan->identity_number }}">
                            </div>
                        </div>
                        @if ($pelanggan->class == 'Personal')
                            <div class="mb-3 row">
                                <label for="npwp_number" class="col-sm-6 col-form-label">
                                    Nomor NPWP
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="npwp_number"
                                        value="{{ $pelanggan->npwp_number }}">
                                </div>
                            </div>
                        @endif
                        <div class="mb-3 row">
                            <label for="phone_number" class="col-sm-6 col-form-label">
                                No. Telp Pelanggan
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="phone_number"
                                    value="{{ $pelanggan->phone_number }}">
                            </div>
                        </div>
                    </div>
                    @if ($pelanggan->class == 'Bussiness')
                        <div class="col-sm-6 text-start">
                            <div class="mb-3 row">
                                <label for="company_name" class="col-sm-6 col-form-label">
                                    Nama Perusahaan
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="company_name"
                                        value="{{ $pelanggan->company_name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="company_address" class="col-sm-6 col-form-label">
                                    Alamat Perusahaan
                                </label>
                                <div class="col-sm-6">
                                    <textarea class="form-control-plaintext" id="company_address" readonly style="text-align: justify;">{{ $pelanggan->company_address }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="company_npwp" class="col-sm-6 col-form-label">
                                    No. NPWP Perusahaan
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="company_npwp"
                                        value="{{ $pelanggan->company_npwp }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="company_sppkp" class="col-sm-6 col-form-label">
                                    No. SPPKP Perusahaan
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="company_sppkp"
                                        value="{{ $pelanggan->company_sppkp }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="company_phone_number" class="col-sm-6 col-form-label">
                                    No. Telp Perusahaan
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext"
                                        id="company_phone_number" value="{{ $pelanggan->company_phone_number }}">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
                <h4 class="text-start fw-bold">Data Pembayaran & Data Teknikal</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-6 text-start" style="border-right: 2px solid #808080">
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-sm-6 col-form-label">
                                Nama Pembayaran
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="customer_id"
                                    value="{{ $pelanggan->billing->billing_name }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-sm-6 col-form-label">
                                Kontak Pembayaran
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="customer_id"
                                    value="{{ $pelanggan->billing->billing_contact }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-sm-6 col-form-label">
                                Email Pembayaran
                            </label>
                            <div class="col-sm-6">
                                @foreach (json_decode($pelanggan->billing->billing_email) as $item)
                                    <input type="text" readonly class="form-control-plaintext" id="customer_id"
                                        value="{{ $item }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 text-start ps-5">
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-sm-6 col-form-label">
                                Nama Teknikal
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="customer_id"
                                    value="{{ $pelanggan->technical->technical_name }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-sm-6 col-form-label">
                                Kontak Teknikal
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="customer_id"
                                    value="{{ $pelanggan->technical->technical_contact }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-sm-6 col-form-label">
                                Email Teknikal
                            </label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="customer_id"
                                    value="{{ $pelanggan->technical->technical_email }}">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h4 class="text-start fw-bold">Data Layanan</h4>
                <hr>
                <div class="row">
                    @foreach (json_decode($pelanggan->service->service_package) as $layanan)
                        <ul>
                            <li>
                                <div class="col-sm-12 text-start">
                                    <div class="mb-3 row">
                                        <label for="customer_id" class="col-sm-6 col-form-label">
                                            Nama Paket
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="customer_id" value="{{ $layanan->service_name }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="customer_id" class="col-sm-6 col-form-label">
                                            Harga Paket
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="customer_id" value="{{ $layanan->service_price }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="customer_id" class="col-sm-6 col-form-label">
                                            Jangka Waktu Pembayaran
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="customer_id" value="{{ $layanan->termofpaymentDeals }}">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
                <hr>
                <h4 class="text-start fw-bold">Dokumen Pendukung</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-6 @if ($pelanggan->class == 'Personal') col-sm-12 @endif text-start">
                        <div class="mb-5">
                            <label for="fotoktp">Foto Identitas KTP</label>
                            </br>
                            <img class="img-fluid mb-2" src="{{ $pelanggan->service->id_photo_url }}" alt=""
                                width="50%" height="25%" id="fotoktp">
                            </br>
                            <a href="{{ $pelanggan->service->id_photo_url }}" class="btn btn-success" download>
                                Download
                                Gambar </a>
                        </div>
                        @if ($pelanggan->class == 'Personal')
                            <div class="mb-5">
                                <label for="fotonpwp">Foto Identitas NPWP</label>
                                </br>
                                <img class="img-fluid mb-2" src="{{ $pelanggan->npwp_files }}" alt=""
                                    width="50%" height="25%" id="fotonpwp">
                                </br>
                                <a href="{{ $pelanggan->npwp_files }}" class="btn btn-success" download> Download
                                    Gambar </a>
                            </div>
                        @endif
                    </div>
                    @if ($pelanggan->class == 'Bussiness')
                        <div class="col-sm-6 text-start">
                            <div class="mb-3">
                                <label for="customer_id" class="col-sm-6 col-form-label">
                                    Foto NPWP Perusahaan
                                </label>
                                </br>
                                <img class="img-fluid" src="{{ $pelanggan->company_npwp_files }}" alt=""
                                    width="50%" height="25%">
                                </br>
                                <a href="{{ $pelanggan->company_npwp_files }}" class="btn btn-success" download>
                                    Download
                                    Gambar </a>
                            </div>
                            <div class="mb-3">
                                <label for="customer_id" class="col-sm-6 col-form-label">
                                    Foto SPPKP Perusahaan
                                </label>
                                </br>
                                <img class="img-fluid" src="{{ $pelanggan->company_sppkp_files }}" alt=""
                                    width="50%" height="25%">
                                </br>
                                <a href="{{ $pelanggan->company_sppkp_files }}" class="btn btn-success" download>
                                    Download
                                    Gambar </a>
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
