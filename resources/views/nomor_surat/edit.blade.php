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
                            <h3 class="font-weight-bold">Edit Nomor Surat</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Form Edit Nomor Surat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('nomorsurat.update', $nomorSurat->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="bidang_surat_id" class="form-label">Bidang Surat</label>
                                            <select class="form-control" id="bidang_surat_id" name="bidang_surat_id" required>
                                                <option value="">Pilih Bidang Surat</option>
                                                @foreach($bidangSurat as $bidang)
                                                    <option value="{{ $bidang->id }}" {{ old('bidang_surat_id', $nomorSurat->bidang_surat_id) == $bidang->id ? 'selected' : '' }}>
                                                        {{ $bidang->nama_bidang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $nomorSurat->nomor_surat) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tahun" class="form-label">Tahun</label>
                                            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $nomorSurat->tahun) }}" min="1900" max="2100" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
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
