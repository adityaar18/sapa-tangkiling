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
                            <h3 class="font-weight-bold">Edit Bidang Surat</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Form Edit Bidang Surat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('bidangsurat.update', $bidangSurat->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama_bidang" class="form-label">Nama Bidang</label>
                                            <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="{{ old('nama_bidang', $bidangSurat->nama_bidang) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode" class="form-label">Kode</label>
                                            <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', $bidangSurat->kode) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $bidangSurat->deskripsi) }}">
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
