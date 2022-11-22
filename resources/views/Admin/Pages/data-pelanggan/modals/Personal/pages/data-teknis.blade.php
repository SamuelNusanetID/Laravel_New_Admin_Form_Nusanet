<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Data Teknis</h3>
    </div>
    <div class="card-body text-start">
        <div class="mb-3 row">
            <label for="technical_name" class="col-sm-6 col-form-label">Nama Lengkap Teknis</label>
            <div class="col-sm-6">
                <textarea class="form-control-plaintext" id="technical_name" name="technical_name" rows="3" readonly
                    style="text-align: justify;">{{ $pelanggan->technical->technical_name }}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="technical_contact" class="col-sm-6 col-form-label">Kontak Teknis</label>
            <div class="col-sm-6">
                <textarea class="form-control-plaintext" id="technical_contact" name="technical_contact" rows="3" readonly
                    style="text-align: justify;">{{ $pelanggan->technical->technical_contact }}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="technical_email" class="col-sm-6 col-form-label">Email Teknis</label>
            <div class="col-sm-6">
                <textarea class="form-control-plaintext" id="technical_email" name="technical_email" rows="3" readonly
                    style="text-align: justify;">{{ $pelanggan->technical->technical_email }}</textarea>
            </div>
        </div>
    </div>
</div>
