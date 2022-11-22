<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Data Pembayaran</h3>
    </div>
    <div class="card-body text-start">
        <div class="mb-3 row">
            <label for="billing_name" class="col-sm-6 col-form-label">Nama Lengkap Pembayaran</label>
            <div class="col-sm-6">
                <textarea class="form-control-plaintext" id="billing_name" name="billing_name" rows="3" readonly
                    style="text-align: justify;">{{ $pelanggan->billing->billing_name }}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="billing_contact" class="col-sm-6 col-form-label">Kontak Pembayaran</label>
            <div class="col-sm-6">
                <textarea class="form-control-plaintext" id="billing_contact" name="billing_contact" rows="3" readonly
                    style="text-align: justify;">{{ $pelanggan->billing->billing_contact }}</textarea>
            </div>
        </div>
        @php
            $emailcount = 1;
        @endphp
        @foreach (json_decode($pelanggan->billing->billing_email) as $item)
            @if ($emailcount == 1)
                <div class="mb-3 row">
                    <label for="billing_email_{{ $emailcount }}" class="col-sm-6 col-form-label">Email
                        Pembayaran</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="billing_email_{{ $emailcount }}" name="billing_email[]" rows="3"
                            readonly style="text-align: justify;">{{ $item }}</textarea>
                    </div>
                </div>
            @else
                <div class="mb-3 row">
                    <label for="billing_email_{{ $emailcount }}" class="col-sm-6 col-form-label">Email Pembayaran Ke -
                        {{ $emailcount }}</label>
                    <div class="col-sm-6">
                        <textarea class="form-control-plaintext" id="billing_email_{{ $emailcount }}" name="billing_email[]" rows="3"
                            readonly style="text-align: justify;">{{ $item }}</textarea>
                    </div>
                </div>
            @endif
            @php
                $emailcount++;
            @endphp
        @endforeach
    </div>
</div>
