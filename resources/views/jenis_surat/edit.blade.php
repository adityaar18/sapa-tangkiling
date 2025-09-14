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
                            <h3 class="font-weight-bold">Edit Jenis Surat</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Form Edit Jenis Surat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('jenis_surat.update', $jenisSurat->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama_jenis" class="form-label">Nama Jenis</label>
                                            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis', $jenisSurat->nama_jenis) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $jenisSurat->deskripsi) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bidang_surat_id" class="form-label">Bidang Surat</label>
                                            <select class="form-control" id="bidang_surat_id" name="bidang_surat_id" required>
                                                <option value="">-- Pilih Bidang Surat --</option>
                                                @foreach($bidangSurat as $bidang)
                                                    <option value="{{ $bidang->id }}" {{ old('bidang_surat_id', $jenisSurat->bidang_surat_id) == $bidang->id ? 'selected' : '' }}>
                                                        {{ $bidang->kode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="template_id" class="form-label">Template Surat</label>
                                            <select class="form-control" id="template_id" name="template_id" required>
                                                <option value="">-- Pilih Template Surat --</option>
                                                @foreach($templateSurat as $template)
                                                    <option value="{{ $template->id }}" {{ old('template_id', $jenisSurat->template_id) == $template->id ? 'selected' : '' }}>
                                                        {{ $template->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
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
