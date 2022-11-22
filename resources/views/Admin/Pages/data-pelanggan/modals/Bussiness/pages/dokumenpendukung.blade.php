<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Dokumen Pendukung</h3>
    </div>
    <div class="card-body text-start">
        <div class="row">
            <div class="col-sm-6">
                <label for="id_photo_url">Foto Kartu Identitas</label>
                <div class="mb-3" style="width: 100%; height: 30em;">
                    <img class="img-fluid" src="{{ URL::to($pelanggan->service->id_photo_url) }}"
                        style="max-height: 100%;">
                </div>
                <a href="{{ URL::to($pelanggan->service->id_photo_url) }}" class="btn btn-success"
                    download="IDPhoto_{{ $pelanggan->customer_id }}">Download File</a>
            </div>
            @if ($pelanggan->npwp_files)
                <div class="col-sm-6">
                    <label for="npwp_files">Foto NPWP</label>
                    <div class="mb-3" style="width: 100%; height: 30em;">
                        <img class="img-fluid" src="{{ URL::to($pelanggan->npwp_files) }}" style="max-height: 100%;">
                    </div>
                    <a href="{{ URL::to($pelanggan->npwp_files) }}" class="btn btn-success"
                        download="NPWPPhoto_{{ $pelanggan->customer_id }}">Download
                        File</a>
                </div>
            @endif
        </div>
    </div>
</div>
