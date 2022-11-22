<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Catatan Tambahan</h3>
    </div>
    <div class="card-body text-start">
        <div class="row">
            @if ($pelanggan->reference_id)
                <div class="mb-3 row">
                    <label for="sales_id" class="col-sm-6 col-form-label">ID Account Manager</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control-plaintext" id="sales_id" name="sales_id"
                            value="{{ $pelanggan->sales_id }}" readonly />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sales_name" class="col-sm-6 col-form-label">Nama Account Manager</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control-plaintext" id="sales_name" name="sales_name"
                            value="{{ $pelanggan->sales_name }}" readonly />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sales_email" class="col-sm-6 col-form-label">Email Account Manager</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control-plaintext" id="sales_email" name="sales_email"
                            value="{{ $pelanggan->sales_email }}" readonly />
                    </div>
                </div>
            @endif

            <div class="mb-3 row">
                <label for="survey_id" class="col-sm-6 col-form-label">ID Survey</label>
                <div class="col-sm-6">
                    <textarea class="form-control-plaintext" id="survey_id" name="survey_id" rows="3" readonly
                        style="text-align: justify;">{{ $pelanggan->survey_id }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="extend_note" class="col-sm-6 col-form-label">Catatan</label>
                <div class="col-sm-6">
                    <textarea class="form-control-plaintext" id="extend_note" name="extend_note" rows="3" readonly
                        style="text-align: justify;">{{ $pelanggan->extend_note }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
