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
                            <h3 class="font-weight-bold">Daftar Template Surat</h3>
                        </div>
                        <div class="col-12 col-xl-4 d-flex justify-content-end align-items-center">
                            <a href="{{ route('template_surat.create') }}" class="btn btn-primary btn-sm">Tambah Template Surat</a>
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
                                                    <th>Nama</th>
                                                    <th>File</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($template_surat as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">Lihat File</a>
                                                    </td>
                                                    <td>{{ $item->deskripsi ?? '-' }}</td>
                                                    <td>
                                                        <a href="{{ route('template_surat.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ route('template_surat.destroy', $item->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Data template surat belum tersedia.</td>
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
