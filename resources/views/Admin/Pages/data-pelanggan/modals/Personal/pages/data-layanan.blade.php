<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Data Layanan</h3>
    </div>
    <div class="card-body text-start">
        @foreach (json_decode($pelanggan->service->service_package) as $item)
            @foreach ($item as $key => $value)
                @if ($key == 'service_name')
                    <div class="mb-3 row">
                        <label for="{{ $key }}" class="col-sm-6 col-form-label">Nama Paket</label>
                        <div class="col-sm-6">
                            <textarea class="form-control-plaintext" id="{{ $key }}" name="{{ $key }}" rows="3" readonly
                                style="text-align: justify;">{{ $value }}</textarea>
                        </div>
                    </div>
                @elseif ($key == 'service_price')
                    <div class="mb-3 row">
                        <label for="{{ $key }}" class="col-sm-6 col-form-label">Harga Paket</label>
                        <div class="col-sm-6">
                            <textarea class="form-control-plaintext" id="{{ $key }}" name="{{ $key }}" rows="3" readonly
                                style="text-align: justify;">Rp. {{ $value }} ,-</textarea>
                        </div>
                    </div>
                @elseif ($key == 'termofpaymentDeals')
                    <div class="mb-3 row">
                        <label for="{{ $key }}" class="col-sm-6 col-form-label">Jangka Waktu Pembayaran</label>
                        <div class="col-sm-6">
                            <textarea class="form-control-plaintext" id="{{ $key }}" name="{{ $key }}" rows="3" readonly
                                style="text-align: justify;">{{ $value }}</textarea>
                        </div>
                    </div>
                @elseif ($key == 'package_promo')
                    <div class="mb-3 row">
                        <label for="{{ $key }}" class="col-sm-6 col-form-label">Kode Promo</label>
                        <div class="col-sm-6">
                            <textarea class="form-control-plaintext" id="{{ $key }}" name="{{ $key }}" rows="3" readonly
                                style="text-align: justify;">{{ $value }}</textarea>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
