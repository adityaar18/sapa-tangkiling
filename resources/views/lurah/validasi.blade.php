<!DOCTYPE html>
<html lang="en">
<head>
    <x-meta />
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <x-navbar />

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <x-sidebar />

            <div class="main-panel">
            <div class="content-wrapper">
            <div class="row mb-4">
            <div class="col-12 col-xl-8">
                <h3 class="font-weight-bold">Validasi Surat</h3>
            </div>
            </div>

            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Kode Unik</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Jenis Surat</th>
                    <th>Penandatangan</th>
                    <th>Status Validasi</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($surat as $item)
                    <tr>
                    <td>{{ ($surat->currentPage() - 1) * $surat->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->kode_unik }}</td>
                    <td>{{ $item->nomor_surat }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                    <td>{{ $item->jenisSurat ? $item->jenisSurat->nama_jenis : '-' }}</td>
                    <td>{{ $item->penandatangan ? $item->penandatangan->nama : '-' }}</td>
                    <td>
                        @if($item->persetujuan == 2)
                            <span class="badge bg-success">Tervalidasi</span>
                        @elseif($item->persetujuan == 1)
                            <span class="badge bg-warning text-dark">Belum Validasi</span>
                        @elseif($item->persetujuan == 0)
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        {{ $item->catatan ?? '-' }}
                    </td>
                    <td>
                        @if($item->persetujuan == 1)
                            <form action="{{ route('lurah.validasiSurat', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" name="aksi" value="validasi" class="btn btn-primary btn-sm" onclick="return confirm('Validasi surat ini?')">Validasi</button>
                            </form>
                            <!-- Tombol Tolak membuka modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolakModal{{ $item->id }}">
                                Tolak
                            </button>
                            <!-- Modal Tolak -->
                            <div class="modal fade" id="tolakModal{{ $item->id }}" tabindex="-1" aria-labelledby="tolakModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('lurah.tolakSurat', $item->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tolakModalLabel{{ $item->id }}">Catatan Penolakan Surat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="catatan{{ $item->id }}" class="form-label">Catatan</label>
                                                    <textarea name="catatan" id="catatan{{ $item->id }}" class="form-control" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Tolak Surat</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <a href="{{ route('surat.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="8" class="text-center">Data surat belum tersedia.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $surat->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
                <style>
                    .pagination {
                        flex-wrap: wrap;
                        font-size: 0.95rem;
                    }
                    .pagination .page-link {
                        padding: 0.25rem 0.6rem;
                    }
                </style>
                </div>
                </div>
                </div>
            </div>
            </div>
            </div>
            <!-- Footer -->
            <x-footer />
            </div>
        </div>
    </div>
    <x-script />
</body>
</html>
