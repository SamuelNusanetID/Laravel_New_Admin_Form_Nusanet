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

                @if (auth()->user()->utype == $pelanggan->approval->current_staging_area)
                    @switch(auth()->user()->utype)
                        @case('AuthCRO')
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/approved') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success" style="width: 100%;">
                                            Setujui Permintaan
                                            <i class="fas fa-check-circle ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/rejected') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" style="width: 100%;">
                                            Tolak Permintaan
                                            <i class="fas fa-ban ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @break

                        @case('AuthSalesManager')
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/approved') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success" style="width: 100%;">
                                            Setujui Permintaan
                                            <i class="fas fa-check-circle ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/rejected') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" style="width: 100%;">
                                            Tolak Permintaan
                                            <i class="fas fa-ban ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @break

                        @case('AuthSales')
                            @if ($pelanggan->survey_id && $pelanggan->extend_note)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/approved') }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success" style="width: 100%;">
                                                Setujui Permintaan
                                                <i class="fas fa-check-circle ms-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @break

                        @default
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/approved') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success" style="width: 100%;">
                                            Setujui Permintaan
                                            <i class="fas fa-check-circle ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form action="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/rejected') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" style="width: 100%;">
                                            Tolak Permintaan
                                            <i class="fas fa-ban ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                    @endswitch
                @endif
            </div>
        </div>
    </div>
</div>
