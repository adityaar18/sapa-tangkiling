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
                                <a class="dropdown-item" href="{{ route('surat.create') }}">Tambah Surat</a>
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
                                @if($item->file_docx_path)
                                    <a href="{{ asset('storage/surat/' . $item->file_docx_path) }}" target="_blank" class="btn btn-info btn-sm">Lihat File</a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                                </td>
                                <td>
                                @if($item->persetujuan == 2)
                                    <a href="{{ route('surat.generate', $item->id) }}" class="btn btn-success btn-sm">Generate Surat</a>
                                @endif
                                <a href="{{ route('surat.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('surat.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('surat.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus surat?')">Hapus</button>
                                </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Data surat belum tersedia.</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                        </div>
                        {{-- Pagination --}}
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
            <!-- Footer -->
            <x-footer />
            </div>
        </div>
    </div>
    <x-script />
</body>
</html>
