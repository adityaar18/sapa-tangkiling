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
                 <div class="mb-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>
                <h3 class="font-weight-bold">Detail Surat</h3>
            </div>
            </div>

            <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">
                <h4 class="mb-0">Detail Surat</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Kode Unik</th>
                            <td>{{ $surat->kode_unik }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Surat</th>
                            <td>{{ $surat->nomor_surat }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Surat</th>
                            <td>{{ $surat->tanggal_surat }}</td>
                        </tr>
                        <tr>
                            <th>File Surat</th>
                            <td>
                                @if($surat->file_docx_path)
                                    <a href="{{ asset('storage/surat/' . $surat->file_docx_path) }}" target="_blank">Download</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Surat</th>
                            <td>{{ $surat->jenisSurat->nama_jenis }}</td>
                        </tr>
                        <tr>
                            <th>Penandatangan</th>
                            <td>{{ $surat->penandatangan->nama }}</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
            </div>

            <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">
                    <h5>Detail Orang yang Mengajukan Surat</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $surat->detailSurat->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $surat->detailSurat->nik }}</td>
                        </tr>
                        <tr>
                            <th>No KK</th>
                            <td>{{ $surat->detailSurat->no_kk }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $surat->detailSurat->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $surat->detailSurat->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $surat->detailSurat->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $surat->detailSurat->agama }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $surat->detailSurat->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $surat->detailSurat->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>RT/RW</th>
                            <td>{{ $surat->detailSurat->rt ?? '-' }}/{{ $surat->detailSurat->rw ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status Perkawinan</th>
                            <td>{{ $surat->detailSurat->status_perkawinan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
            </div>

            @if($surat->jenisSurat->nama_jenis == 'Keterangan Ahli Waris')
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Detail Ahli Waris</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Tanggal Meninggal</th>
                                    <td>{{ $ahliWaris->tanggal_meninggal ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Meninggal</th>
                                    <td>{{ $ahliWaris->tempat_meninggal ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Ahli Waris</th>
                                    <td>{{ $ahliWaris->nama_ahli_waris ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>NIK Ahli Waris</th>
                                    <td>{{ $ahliWaris->nik_ahli_waris ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $ahliWaris->jenis_kelamin ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Umur</th>
                                    <td>{{ $ahliWaris->umur ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Hubungan Ahli Waris</th>
                                    <td>{{ $ahliWaris->hubungan_ahli_waris ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($surat->jenisSurat->nama_jenis == 'Keterangan Tidak Mampu')
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Detail Keterangan Tidak Mampu</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Ayah</th>
                                    <td>{{ $ketTidakMampu->nama_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Ibu</th>
                                    <td>{{ $ketTidakMampu->nama_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ayah</th>
                                    <td>{{ $ketTidakMampu->pekerjaan_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ibu</th>
                                    <td>{{ $ketTidakMampu->pekerjaan_ibu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $ketTidakMampu->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>{{ $ketTidakMampu->kelurahan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>{{ $ketTidakMampu->kecamatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten</th>
                                    <td>{{ $ketTidakMampu->kabupaten ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $ketTidakMampu->provinsi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $ketTidakMampu->keterangan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Footer -->
            <x-footer />
            </div>
        </div>
    </div>
    <x-script />
</body>
</html>
