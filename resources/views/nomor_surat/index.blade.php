<!DOCTYPE html>
<html lang="en">
<head>
    <x-meta />
</head>
<body>
    <div class="container-scroller">
        <x-navbar />

        <div class="container-fluid page-body-wrapper">
            <x-sidebar />

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row mb-4">
                        <div class="col-12 col-xl-8">
                            <h3 class="font-weight-bold">Daftar Nomor Surat</h3>
                        </div>
                        <div class="col-12 col-xl-4 d-flex justify-content-end align-items-center">
                            <a href="{{ route('nomorsurat.create') }}" class="btn btn-primary btn-sm">Tambah Nomor Surat</a>
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
                                                    <th>Bidang Surat</th>
                                                    <th>Nomor Surat</th>
                                                    <th>Tahun</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($nomorSurats as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->bidangSurat->kode ?? '-' }}</td>
                                                    <td>{{ $item->nomor_surat }}</td>
                                                    <td>{{ $item->tahun }}</td>
                                                    <td>
                                                        <a href="{{ route('nomorsurat.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ route('nomorsurat.destroy', $item->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Data nomor surat belum tersedia.</td>
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
                <x-footer />
            </div>
        </div>
    </div>
    <x-script />
</body>
</html>
