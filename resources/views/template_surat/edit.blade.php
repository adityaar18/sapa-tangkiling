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
                            <h3 class="font-weight-bold">Edit Template Surat</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Form Edit Template Surat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('template_surat.update', $templateSurat->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Template</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $templateSurat->nama) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_path" class="form-label">File Surat</label>
                                            <input type="file" class="form-control" id="file_path" name="file_path">
                                            @if($templateSurat->file_path)
                                                <small>File saat ini: {{ $templateSurat->file_path }}</small>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $templateSurat->deskripsi) }}">
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
