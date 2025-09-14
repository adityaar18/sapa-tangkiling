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
                            <h3 class="font-weight-bold">Edit Jabatan</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Form Edit Jabatan</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="singkatan_jabatan" class="form-label">Singkatan Jabatan</label>
                                            <input type="text" class="form-control" id="singkatan_jabatan" name="singkatan_jabatan" value="{{ old('singkatan_jabatan', $jabatan->singkatan_jabatan) }}" required>
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
