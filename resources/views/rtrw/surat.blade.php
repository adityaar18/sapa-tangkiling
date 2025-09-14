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
                    <h3 class="font-weight-bold">Daftar Surat</h3>
                </div>
                <div class="col-12 col-xl-4 d-flex justify-content-end align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownTambahSurat" data-bs-toggle="dropdown" aria-expanded="false">
                            Tambah Surat
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownTambahSurat">
                            <li>
                                <a class="dropdown-item" href="{{ route('surat.rtrw.create') }}">Tambah Surat</a>
                            </li>
                        </ul>
                    </div>
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
                                <th>File</th>
                                <th>Catatan</th>
                                <th>Persetujuan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($surat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_unik }}</td>
                                <td>{{ $item->nomor_surat ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                                <td>{{ $item->jenisSurat ? $item->jenisSurat->nama_jenis : '-' }}</td>
                                <td>{{ $item->penandatangan ? $item->penandatangan->nama : '-' }}</td>
                                <td>
                                @if($item->file_docx_path)
                                    <a href="{{ asset('storage/surat/' . $item->file_docx_path) }}" target="_blank" class="btn btn-info btn-sm">Lihat File</a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                                </td>
                                <td>
                                    {{ $item->catatan ?? '-' }}
                                </td>
                                <td>
                                    @if($item->persetujuan == 2)
                                        <span class="badge bg-success">Tervalidasi</span>
                                    @elseif($item->persetujuan == 1)
                                        <span class="badge bg-warning text-dark">Belum Tervalidasi</span>
                                    @elseif($item->persetujuan == 0)
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Status Tidak Diketahui</span>
                                    @endif
                                </td>
                                <td>
                                <a href="{{ route('surat.rtrw.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Data surat belum tersedia.</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
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
