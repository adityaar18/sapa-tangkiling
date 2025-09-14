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
                            <h3 class="font-weight-bold">Tambah Surat</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Form Tambah Surat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('surat.rtrw.store') }}" method="POST" enctype="multipart/form-data" id="formSurat">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                            <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_surat_id" class="form-label">Jenis Surat</label>
                                            <select class="form-control" id="jenis_surat_id" name="jenis_surat_id" required>
                                                <option value="">Pilih Jenis Surat</option>
                                                @foreach($jenisSurats as $j)
                                                    <option value="{{ $j->id }}" data-nama="{{ strtolower($j->nama_jenis) }}">{{ $j->nama_jenis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <hr>
                                        <h5>Detail Surat</h5>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_kk" class="form-label">No KK</label>
                                            <input type="text" class="form-control" id="no_kk" name="no_kk" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="agama" class="form-label">Agama</label>
                                            <select class="form-control" id="agama" name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                            <select class="form-control" id="pekerjaan" name="pekerjaan" required>
                                                <option value="">Pilih Pekerjaan</option>
                                                <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                                <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                                <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                <option value="Wiraswasta">Wiraswasta</option>
                                                <option value="Petani/Pekebun">Petani/Pekebun</option>
                                                <option value="Buruh">Buruh</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Nelayan">Nelayan</option>
                                                <option value="Pensiunan">Pensiunan</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat">
                                        </div>
                                        <div class="mb-3">
                                            <label for="rt" class="form-label">RT</label>
                                            <select class="form-control" id="rt" name="rt">
                                                <option value="">Pilih RT</option>
                                                @for($i = 1; $i <= 14; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rw" class="form-label">RW</label>
                                            <select class="form-control" id="rw" name="rw">
                                                <option value="">Pilih RW</option>
                                                @for($i = 1; $i <= 3; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                            <select class="form-control" id="status_perkawinan" name="status_perkawinan">
                                                <option value="">Pilih Status</option>
                                                <option value="belum menikah">Belum Menikah</option>
                                                <option value="menikah">Menikah</option>
                                                <option value="cerai">Cerai</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="path_ktp" class="form-label">Upload KTP</label>
                                            <input type="file" class="form-control" id="path_ktp" name="path_ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="path_kk" class="form-label">Upload KK</label>
                                            <input type="file" class="form-control" id="path_kk" name="path_kk" accept=".jpg,.jpeg,.png,.pdf" required>
                                        </div>

                                        <!-- Keterangan Tidak Mampu -->
                                        <div id="formTidakMampu" style="display:none;">
                                            <hr>
                                            <h5>Keterangan Tidak Mampu</h5>
                                            <div class="mb-3">
                                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                                            </div>
                                            <div class="mb-3">
                                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah">
                                            </div>
                                            <div class="mb-3">
                                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat_tidakmampu" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="alamat_tidakmampu" name="alamat_tidakmampu">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                                <input type="text" class="form-control" id="kelurahan" name="kelurahan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                                <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                                <input type="text" class="form-control" id="kabupaten" name="kabupaten">
                                            </div>
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <input type="text" class="form-control" id="provinsi" name="provinsi">
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                            </div>
                                        </div>

                                        <!-- Keterangan Ahli Waris -->
                                        <div id="formAhliWaris" style="display:none;">
                                            <hr>
                                            <h5>Keterangan Ahli Waris</h5>
                                            <div class="mb-3">
                                                <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal</label>
                                                <input type="date" class="form-control" id="tanggal_meninggal" name="tanggal_meninggal">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tempat_meninggal" class="form-label">Tempat Meninggal</label>
                                                <input type="text" class="form-control" id="tempat_meninggal" name="tempat_meninggal">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_ahli_waris" class="form-label">Nama Ahli Waris</label>
                                                <input type="text" class="form-control" id="nama_ahli_waris" name="nama_ahli_waris">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nik_ahli_waris" class="form-label">NIK Ahli Waris</label>
                                                <input type="text" class="form-control" id="nik_ahli_waris" name="nik_ahli_waris">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_kelamin_ahli_waris" class="form-label">Jenis Kelamin Ahli Waris</label>
                                                <select class="form-control" id="jenis_kelamin_ahli_waris" name="jenis_kelamin_ahli_waris">
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="laki-laki">Laki-laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="umur" class="form-label">Umur</label>
                                                <input type="number" class="form-control" id="umur" name="umur">
                                            </div>
                                            <div class="mb-3">
                                                <label for="hubungan_ahli_waris" class="form-label">Hubungan Ahli Waris</label>
                                                <select class="form-control" id="hubungan_ahli_waris" name="hubungan_ahli_waris">
                                                    <option value="">Pilih Hubungan</option>
                                                    <option value="suami">Suami</option>
                                                    <option value="istri">Istri</option>
                                                    <option value="anak">Anak</option>
                                                    <option value="orang_tua">Orang Tua</option>
                                                    <option value="saudara">Saudara</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const jenisSuratSelect = document.getElementById('jenis_surat_id');
                        const formTidakMampu = document.getElementById('formTidakMampu');
                        const formAhliWaris = document.getElementById('formAhliWaris');

                        jenisSuratSelect.addEventListener('change', function() {
                            const selectedOption = jenisSuratSelect.options[jenisSuratSelect.selectedIndex];
                            const namaJenis = selectedOption.getAttribute('data-nama');
                            formTidakMampu.style.display = (namaJenis === 'keterangan tidak mampu') ? 'block' : 'none';
                            formAhliWaris.style.display = (namaJenis === 'keterangan ahli waris') ? 'block' : 'none';
                        });
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
