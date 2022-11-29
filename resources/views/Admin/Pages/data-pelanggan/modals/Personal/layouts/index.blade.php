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
                @include('Admin.Pages.data-pelanggan.modals.' . $cls . '.pages.data-personal')
                @include('Admin.Pages.data-pelanggan.modals.' . $cls . '.pages.data-pembayaran')
                @include('Admin.Pages.data-pelanggan.modals.' . $cls . '.pages.data-teknis')
                @include('Admin.Pages.data-pelanggan.modals.' . $cls . '.pages.data-layanan')
                @if (!$pelanggan->isCustomerIS)
                    @include('Admin.Pages.data-pelanggan.modals.' . $cls . '.pages.dokumenpendukung')
                @endif
                @include('Admin.Pages.data-pelanggan.modals.' . $cls . '.pages.catatantambahan')
                @include('Admin.Pages.data-pelanggan.modals.' . $cls . '.pages.timeline')

                @if (auth()->user()->utype === $pelanggan->approval->current_staging_area)
                    @switch(auth()->user()->utype)
                        @case('AuthCRO')
                            @if ($pelanggan->reference_id)
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-success" data-bs-target="#approved{{ $pelanggan->id }}Modal"
                                            data-bs-toggle="modal" style="width: 100%;">
                                            Setujui Permintaan
                                            <i class="fas fa-check-circle ms-1"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-danger" data-bs-target="#rejected{{ $pelanggan->id }}Modal"
                                            data-bs-toggle="modal" style="width: 100%;">
                                            Tolak Permintaan
                                            <i class="fas fa-ban ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @break

                        @case('AuthSalesManager')
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-success" data-bs-target="#approved{{ $pelanggan->id }}Modal"
                                        data-bs-toggle="modal" style="width: 100%;">
                                        Setujui Permintaan
                                        <i class="fas fa-check-circle ms-1"></i>
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-danger" data-bs-target="#rejected{{ $pelanggan->id }}Modal"
                                        data-bs-toggle="modal" style="width: 100%;">
                                        Tolak Permintaan
                                        <i class="fas fa-ban ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        @break

                        @case('AuthSales')
                            @if ($pelanggan->survey_id && $pelanggan->extend_note)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" data-bs-target="#approved{{ $pelanggan->id }}Modal"
                                            data-bs-toggle="modal" style="width: 100%;">
                                            Setujui Permintaan
                                            <i class="fas fa-check-circle ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @break

                        @default
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-success" data-bs-target="#approved{{ $pelanggan->id }}Modal"
                                        data-bs-toggle="modal" style="width: 100%;">
                                        Setujui Permintaan
                                        <i class="fas fa-check-circle ms-1"></i>
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-danger" data-bs-target="#rejected{{ $pelanggan->id }}Modal"
                                        data-bs-toggle="modal" style="width: 100%;">
                                        Tolak Permintaan
                                        <i class="fas fa-ban ms-1"></i>
                                    </button>
                                </div>
                            </div>
                    @endswitch
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .form-control.error {
        border-color: #dc3545;
        padding-right: calc(1.5em + .75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .error {
        font-size: .875em;
        color: #dc3545;
    }
</style>
<!-- Modal Approve -->
<div class="modal fade" id="approved{{ $pelanggan->id }}Modal" aria-hidden="true"
    aria-labelledby="approved{{ $pelanggan->id }}ModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="approved{{ $pelanggan->id }}ModalLabel">
                    Kotak dialog pesan
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/approved') }}" method="POST"
                id="approvalRequestForm-{{ $pelanggan->id }}">
                @csrf
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="message_body_notification" class="form-label">Deskripsi pesan</label>
                        <textarea class="form-control" id="message_body_notification" name="message_body_notification" rows="10"
                            placeholder="Ketikkan pesan anda disini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-success">
                    <button type="button" class="btn btn-light" style="width: 100%;"
                        id="submittedBtnApproval-{{ $pelanggan->id }}">
                        Kirim Pesan
                        <i class="fas fa-paper-plane ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Rejected -->
<div class="modal fade" id="rejected{{ $pelanggan->id }}Modal" aria-hidden="true"
    aria-labelledby="rejected{{ $pelanggan->id }}ModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="rejected{{ $pelanggan->id }}ModalLabel">
                    Kotak dialog pesan
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/rejected') }}" method="POST"
                id="rejectedRequestForm-{{ $pelanggan->id }}">
                @csrf
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="message_body_notification" class="form-label">Deskripsi pesan</label>
                        <textarea class="form-control" id="message_body_notification" name="message_body_notification" rows="10"
                            placeholder="Ketikkan pesan anda disini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-success">
                    <button type="button" class="btn btn-light" style="width: 100%;"
                        id="submittedBtnRejected-{{ $pelanggan->id }}">
                        Kirim Pesan
                        <i class="fas fa-paper-plane ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
