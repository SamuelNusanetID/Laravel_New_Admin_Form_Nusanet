<div class="card shadow rounded">
    <div class="card-header text-start bg-success">
        <h3 class="card-title fw-bold text-white">Riwayat Revisi</h3>
    </div>
    <div class="card-body text-start">
        @if (count($pelanggan->revision_log) > 1)
            <table class="table table-bordered" style="width: 100%;">
                <thead class="bg-success text-white">
                    <tr>
                        <th class="align-middle text-center">Tanggal & Jam</th>
                        <th class="align-middle text-center">Deskripsi Pesan</th>
                        <th class="align-middle text-center">Status Pesan</th>
                        <th class="align-middle text-center">Person In Charge</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan->revision_log as $item)
                        <tr>
                            <td class="align-middle text-center">
                                {{ date('d M Y - H:i:s', strtotime($item['created_at'])) }}</td>
                            <td class="align-middle text-center">{{ $item['revision_message'] }}</td>
                            <td class="align-middle text-center">{{ $item['status_message'] }}</td>
                            <td class="align-middle text-center">{{ $item['pic'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Belum Ada Revisi</p>
        @endif

    </div>
</div>
