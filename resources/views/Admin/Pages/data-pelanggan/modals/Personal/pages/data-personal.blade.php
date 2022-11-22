<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Data Personal</h3>
    </div>
    <div class="card-body text-start">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3 row">
                    <label for="customer_id" class="col-sm-6 col-form-label">No. ID Pelanggan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="customer_id" name="customer_id" rows="3" readonly
                            style="text-align: justify;">{{ $pelanggan->customer_id }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-6 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="name" name="name" rows="3" readonly
                            style="text-align: justify;">{{ $pelanggan->name }}</textarea>
                    </div>
                </div>
                @php
                    $tacount = 1;
                @endphp
                @foreach (json_decode($pelanggan->address) as $item)
                    @if ($tacount == 1)
                        <div class="mb-3 row">
                            <label for="address-{{ $tacount }}" class="col-sm-6 col-form-label">Alamat
                                Pelanggan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control-plaintext" id="address-{{ $tacount }}" name="address[]" rows="3" readonly
                                    style="text-align: justify;">{{ $item }}</textarea>
                            </div>
                        </div>
                    @else
                        <div class="mb-3 row">
                            <label for="address-{{ $tacount }}" class="col-sm-6 col-form-label">Alamat
                                Pelanggan Ke - {{ $tacount }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control-plaintext" id="address-{{ $tacount }}" name="address[]" rows="3" readonly
                                    style="text-align: justify;">{{ $item }}</textarea>
                            </div>
                        </div>
                    @endif

                    @php
                        $tacount++;
                    @endphp
                @endforeach

                @php
                    $geocount = 1;
                @endphp
                @foreach (json_decode($pelanggan->geolocation) as $item)
                    @if ($geocount == 1)
                        <div class="mb-3 row">
                            <label for="geolocation_{{ $geocount }}" class="col-sm-6 col-form-label">Geolokasi
                                Alamat Pelanggan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control-plaintext" id="geolocation_{{ $geocount }}" name="geolocation[]" rows="3"
                                    readonly style="text-align: justify;">{{ json_decode($item)->lat . ',' . json_decode($item)->lng }}</textarea>
                            </div>
                        </div>
                    @else
                        <div class="mb-3 row">
                            <label for="geolocation_{{ $geocount }}" class="col-sm-6 col-form-label">Geolokasi
                                Alamat Pelanggan Ke -
                                {{ $geocount }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control-plaintext" id="geolocation_{{ $geocount }}" name="geolocation[]" rows="3"
                                    readonly style="text-align: justify;">{{ json_decode($item)->lat . ',' . json_decode($item)->lng }}</textarea>
                            </div>
                        </div>
                    @endif
                    @php
                        $geocount++;
                    @endphp
                @endforeach
                <div class="mb-3 row">
                    <label for="email" class="col-sm-6 col-form-label">Email Pelanggan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="email" name="email" rows="3" readonly
                            style="text-align: justify;">{{ $pelanggan->email }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 row">
                    <label for="phone_number" class="col-sm-6 col-form-label">No. HP Pelanggan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="phone_number" name="phone_number" rows="3" readonly
                            style="text-align: justify;">{{ $pelanggan->phone_number }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="identity_type" class="col-sm-6 col-form-label">Tipe Identitas Pelanggan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="identity_type" name="identity_type" rows="3" readonly
                            style="text-align: justify;">{{ $pelanggan->identity_type }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="identity_number" class="col-sm-6 col-form-label">No. Identitas Pelanggan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="identity_number" name="identity_number" rows="3" readonly
                            style="text-align: justify;">{{ $pelanggan->identity_number }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="npwp_number" class="col-sm-6 col-form-label">No. NPWP Pelanggan</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="npwp_number" name="npwp_number" rows="3" readonly
                            style="text-align: justify;">{{ $pelanggan->npwp_number }}</textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
