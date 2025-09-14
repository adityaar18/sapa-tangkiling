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
                <h3 class="font-weight-bold">Edit Surat</h3>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <h4 class="mb-0">Form Edit Surat</h4>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="jenis_surat_id" class="form-label">Jenis Surat</label>
                        <select class="form-control" id="jenis_surat_id" name="jenis_surat_id" required>
                            <option value="">Pilih Jenis Surat</option>
                            @foreach($jenisSurats as $j)
                            <option value="{{ $j->id }}" {{ $surat->jenis_surat_id == $j->id ? 'selected' : '' }} data-nama="{{ $j->nama_jenis }}">{{ $j->nama_jenis }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="mb-3">
                        <label for="penandatangan_id" class="form-label">Penandatangan</label>
                        <select class="form-control" id="penandatangan_id" name="penandatangan_id" required>
                            <option value="">Pilih Penandatangan</option>
                            @foreach($penandatangans as $p)
                            <option value="{{ $p->id }}" {{ $surat->penandatangan_id == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        </div>
                        <hr>
                        <h5>Detail Surat</h5>
                        <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama',  $surat->detailSurat->nama ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik',  $surat->detailSurat->nik ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="no_kk" class="form-label">No KK</label>
                        <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ old('no_kk',  $surat->detailSurat->no_kk ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki" {{ (old('jenis_kelamin',  $surat->detailSurat->jenis_kelamin ?? '') == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ (old('jenis_kelamin',  $surat->detailSurat->jenis_kelamin ?? '') == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        </div>
                        <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir',  $surat->detailSurat->tempat_lahir ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir',  $surat->detailSurat->tanggal_lahir ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama" value="{{ old('agama',  $surat->detailSurat->agama ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan',  $surat->detailSurat->pekerjaan ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat',  $surat->detailSurat->alamat ?? '') }}">
                        </div>
                        <div class="mb-3">
                        <label for="rt" class="form-label">RT</label>
                        <input type="text" class="form-control" id="rt" name="rt" value="{{ old('rt',  $surat->detailSurat->rt ?? '') }}">
                        </div>
                        <div class="mb-3">
                        <label for="rw" class="form-label">RW</label>
                        <input type="text" class="form-control" id="rw" name="rw" value="{{ old('rw',  $surat->detailSurat->rw ?? '') }}">
                        </div>
                        <div class="mb-3">
                        <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                        <select class="form-control" id="status_perkawinan" name="status_perkawinan">
                            <option value="">Pilih Status</option>
                            <option value="belum menikah" {{ (old('status_perkawinan',  $surat->detailSurat->status_perkawinan ?? '') == 'belum menikah') ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="menikah" {{ (old('status_perkawinan',  $surat->detailSurat->status_perkawinan ?? '') == 'menikah') ? 'selected' : '' }}>Menikah</option>
                            <option value="cerai" {{ (old('status_perkawinan',  $surat->detailSurat->status_perkawinan ?? '') == 'cerai') ? 'selected' : '' }}>Cerai</option>
                        </select>
                        </div>

                        {{-- Keterangan Tidak Mampu --}}
                        <div id="form-tidak-mampu" style="display:none;">
                        <hr>
                        <h5>Keterangan Tidak Mampu</h5>
                        <div class="mb-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $surat->detailSurat->ketTidakMampu->nama_ayah ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $surat->detailSurat->ketTidakMampu->nama_ibu ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $surat->detailSurat->ketTidakMampu->pekerjaan_ayah ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $surat->detailSurat->ketTidakMampu->pekerjaan_ibu ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat_tidakmampu" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat_tidakmampu" name="alamat_tidakmampu" value="{{ old('alamat_tidakmampu', $surat->detailSurat->ketTidakMampu->alamat ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $surat->detailSurat->ketTidakMampu->kelurahan ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $surat->detailSurat->ketTidakMampu->kecamatan ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="kabupaten" class="form-label">Kabupaten</label>
                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $surat->detailSurat->ketTidakMampu->kabupaten ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi', $surat->detailSurat->ketTidakMampu->provinsi ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan', $surat->detailSurat->ketTidakMampu->keterangan ?? '') }}</textarea>
                        </div>
                        </div>

                        {{-- Keterangan Ahli Waris --}}
                        <div id="form-ahli-waris" style="display:none;">
                        <hr>
                        <h5>Keterangan Ahli Waris</h5>
                        <div class="mb-3">
                            <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal</label>
                            <input type="date" class="form-control" id="tanggal_meninggal" name="tanggal_meninggal" value="{{ old('tanggal_meninggal', $surat->detailSurat->ahliWaris->tanggal_meninggal ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="tempat_meninggal" class="form-label">Tempat Meninggal</label>
                            <input type="text" class="form-control" id="tempat_meninggal" name="tempat_meninggal" value="{{ old('tempat_meninggal', $surat->detailSurat->ahliWaris->tempat_meninggal ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_ahli_waris" class="form-label">Nama Ahli Waris</label>
                            <input type="text" class="form-control" id="nama_ahli_waris" name="nama_ahli_waris" value="{{ old('nama_ahli_waris', $surat->detailSurat->ahliWaris->nama_ahli_waris ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nik_ahli_waris" class="form-label">NIK Ahli Waris</label>
                            <input type="text" class="form-control" id="nik_ahli_waris" name="nik_ahli_waris" value="{{ old('nik_ahli_waris', $surat->detailSurat->ahliWaris->nik_ahli_waris ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin_ahli_waris" class="form-label">Jenis Kelamin Ahli Waris</label>
                            <select class="form-control" id="jenis_kelamin_ahli_waris" name="jenis_kelamin_ahli_waris">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki" {{ (old('jenis_kelamin_ahli_waris', $surat->detailSurat->ahliWaris->jenis_kelamin ?? '') == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ (old('jenis_kelamin_ahli_waris', $surat->detailSurat->ahliWaris->jenis_kelamin ?? '') == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" class="form-control" id="umur" name="umur" value="{{ old('umur', $surat->detailSurat->ahliWaris->umur ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="hubungan_ahli_waris" class="form-label">Hubungan Ahli Waris</label>
                            <select class="form-control" id="hubungan_ahli_waris" name="hubungan_ahli_waris">
                            <option value="">Pilih Hubungan</option>
                            <option value="suami" {{ (old('hubungan_ahli_waris', $surat->detailSurat->ahliWaris->hubungan_ahli_waris ?? '') == 'suami') ? 'selected' : '' }}>Suami</option>
                            <option value="istri" {{ (old('hubungan_ahli_waris', $surat->detailSurat->ahliWaris->hubungan_ahli_waris ?? '') == 'istri') ? 'selected' : '' }}>Istri</option>
                            <option value="anak" {{ (old('hubungan_ahli_waris', $surat->detailSurat->ahliWaris->hubungan_ahli_waris ?? '') == 'anak') ? 'selected' : '' }}>Anak</option>
                            <option value="orang_tua" {{ (old('hubungan_ahli_waris', $surat->detailSurat->ahliWaris->hubungan_ahli_waris ?? '') == 'orang_tua') ? 'selected' : '' }}>Orang Tua</option>
                            <option value="saudara" {{ (old('hubungan_ahli_waris', $surat->detailSurat->ahliWaris->hubungan_ahli_waris ?? '') == 'saudara') ? 'selected' : '' }}>Saudara</option>
                            <option value="lainnya" {{ (old('hubungan_ahli_waris', $surat->detailSurat->ahliWaris->hubungan_ahli_waris ?? '') == 'lainnya') ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                function toggleForms() {
                var jenisSuratSelect = document.getElementById('jenis_surat_id');
                var selectedOption = jenisSuratSelect.options[jenisSuratSelect.selectedIndex];
                var namaJenis = selectedOption.getAttribute('data-nama');
                var formTidakMampu = document.getElementById('form-tidak-mampu');
                var formAhliWaris = document.getElementById('form-ahli-waris');

                // Hide both by default
                formTidakMampu.style.display = 'none';
                formAhliWaris.style.display = 'none';

                if (namaJenis === 'Keterangan Tidak Mampu') {
                    formTidakMampu.style.display = 'block';
                } else if (namaJenis === 'Keterangan Ahli Waris') {
                    formAhliWaris.style.display = 'block';
                }
                }

                document.getElementById('jenis_surat_id').addEventListener('change', toggleForms);

                // Initial show/hide on page load
                toggleForms();
            });
            </script>
            <!-- Footer -->
            <x-footer />
            </div>
        </div>
    </div>
    <x-script />
</body>
</html>
