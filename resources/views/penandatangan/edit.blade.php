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
                            <h3 class="font-weight-bold">Edit Penandatangan</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Form Edit Penandatangan</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('penandatangan.update', $penandatangan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $penandatangan->nama) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $penandatangan->nip) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jabatan_id" class="form-label">Jabatan</label>
                                            <select class="form-control" id="jabatan_id" name="jabatan_id">
                                                <option value="">Pilih Jabatan</option>
                                                @foreach($jabatan as $jabatan)
                                                    <option value="{{ $jabatan->id }}" {{ old('jabatan_id', $penandatangan->jabatan_id) == $jabatan->id ? 'selected' : '' }}>
                                                        {{ $jabatan->nama_jabatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pangkat" class="form-label">Pangkat</label>
                                            <input type="text" class="form-control" id="pangkat" name="pangkat" value="{{ old('pangkat', $penandatangan->pangkat) }}" required>
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
