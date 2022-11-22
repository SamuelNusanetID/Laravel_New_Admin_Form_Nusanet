<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Lacak Pengajuan</h3>
    </div>
    <div class="card-body text-start">
        <ul>
            @foreach (json_decode($pelanggan->approval->array_approval) as $key => $value)
                @if ($value->isApproved || $value->isRejected)
                    <div class="mb-4">
                        <li class="fw-bold">{{ $key }}</li>
                        <div class="row">
                            <label for="pic_name" class="col-sm-6 col-form-label">Nama PIC</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control-plaintext" id="pic_name" name="pic_name"
                                    value="{{ $value->PIC_Name != null ? $value->PIC_Name : 'Belum Diketahui' }}"
                                    readonly />
                            </div>
                        </div>
                        <div class="row">
                            <label for="approved_status" class="col-sm-6 col-form-label">Status Approve</label>
                            <div class="col-sm-6">
                                @if ($value->isApproved == false && $value->isRejected == false)
                                    <span class="badge text-bg-warning text-white">Menunggu Persetujuan</span>
                                @elseif ($value->isApproved == true && $value->isRejected == false)
                                    <span class="badge text-bg-success text-white">Telah Disetujui</span>
                                @elseif ($value->isApproved == false && $value->isRejected == true)
                                    <span class="badge text-bg-danger text-white">Ditolak</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label for="message" class="col-sm-6 col-form-label">Pesan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control-plaintext" id="message" name="message"
                                    value="{{ $value->message != null ? $value->message : 'Belum Diketahui' }}"
                                    readonly />
                            </div>
                        </div>
                        <div class="row">
                            <label for="sended_at" class="col-sm-6 col-form-label">Dikirim Pada</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control-plaintext" id="sended_at" name="sended_at"
                                    value="{{ $value->sended_at != null ? $value->sended_at : 'Belum Diketahui' }}"
                                    readonly />
                            </div>
                        </div>
                        <div class="row">
                            <label for="replied_at" class="col-sm-6 col-form-label">Dibalas pada</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control-plaintext" id="replied_at" name="replied_at"
                                    value="{{ $value->replied_at != null ? $value->replied_at : 'Belum Diketahui' }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mb-4">
                        <li class="fw-bold">{{ $key }}</li>
                        <h6>Data masih dalam proses review...</h6>
                    </div>
                @endif
            @endforeach
        </ul>
    </div>
</div>
