<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\DetailSurat;
use App\Models\JenisSurat;
use App\Models\AhliWaris;
use App\Models\KetTidakMampu;
use App\Models\Penandatangan;

class RtRwController extends Controller
{
    public function index()
    {
        $surat = Surat::with(['jenisSurat', 'penandatangan'])->orderBy('persetujuan', 'asc')->paginate(10);
        return view('rtrw.surat', compact('surat'));
    }

    public function create()
    {
        $jenisSurats = JenisSurat::all();
        $penandatangans = Penandatangan::all();
        return view('rtrw.add', compact('jenisSurats', 'penandatangans'));
    }

    public function show($id)
    {
        $surat = Surat::with(['jenisSurat', 'penandatangan', 'detailSurat'])->findOrFail($id);
        // dd($surat->detailSurat);
        return view('rtrw.detail', compact('surat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_surat' => 'required|date',
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'no_kk' => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'status_perkawinan' => 'nullable|in:belum menikah,menikah,cerai',
            'path_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'path_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Field tambahan untuk ahli waris
            'tanggal_meninggal' => 'nullable|date',
            'tempat_meninggal' => 'nullable|string',
            'nama_ahli_waris' => 'nullable|string',
            'nik_ahli_waris' => 'nullable|string',
            'jenis_kelamin_ahli_waris' => 'nullable|in:laki-laki,perempuan',
            'umur_ahli_waris' => 'nullable|integer',
            'hubungan_ahli_waris' => 'nullable|in:suami,istri,anak,orang_tua,saudara,lainnya',
            // Field tambahan untuk tidak mampu
            'nama_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'pekerjaan_ayah' => 'nullable|string',
            'pekerjaan_ibu' => 'nullable|string',
            'alamat_tidakmampu' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        do {
            $kode_unik = strtoupper(bin2hex(random_bytes(4)));
        } while (Surat::where('kode_unik', $kode_unik)->exists());


        // Inisialisasi pathKtp dan pathKk agar tidak null jika file tidak diupload
        $pathKtp = null;
        $pathKk = null;

        // Handle file uploads for path_ktp
        if ($request->hasFile('path_ktp')) {
            $fileKtp = $request->file('path_ktp');
            $filenameKtp = $validated['nik'] . '.' . $fileKtp->getClientOriginalExtension();
            $pathKtp = $fileKtp->storeAs('uploads/ktp', $filenameKtp, 'public');
            $validated['path_ktp'] = $pathKtp;
        }

        // Handle file uploads for path_kk
        if ($request->hasFile('path_kk')) {
            $fileKk = $request->file('path_kk');
            $filenameKk = $validated['no_kk'] . '_' . $fileKtp->getClientOriginalExtension();
            $pathKk = $fileKk->storeAs('uploads/kk', $filenameKk, 'public');
            $validated['path_kk'] = $pathKk;
        }

        // dd($validated['path_ktp']);
        // dd($validated['path_kk']);
        // Ambil penandatangan dengan jabatan lurah
        $penandatangan = Penandatangan::whereRelation('jabatan', 'singkatan_jabatan', 'lurah')->first();

        // Ambil bidang_surat_id dari JenisSurat
        $jenisSurat = JenisSurat::find($validated['jenis_surat_id']);
        $bidangSuratId = $jenisSurat ? $jenisSurat->bidang_surat_id : null;

        $surat = Surat::create([
            'kode_unik' => $kode_unik,
            'tanggal_surat' => $validated['tanggal_surat'],
            'jenis_surat_id' => $validated['jenis_surat_id'],
            'bidang_surat_id' => $bidangSuratId,
            'penandatangan_id' => $penandatangan ? $penandatangan->id : null,
            'persetujuan' => 1,
        ]);

        $detailSurat = DetailSurat::create([
            'surat_id' => $surat->id,
            'path_ktp' => $validated['path_ktp'],
            'path_kk' => $validated['path_kk'],
            'nama' => $validated['nama'],
            'nik' => $validated['nik'],
            'no_kk' => $validated['no_kk'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'agama' => $validated['agama'],
            'pekerjaan' => $validated['pekerjaan'],
            'alamat' => $validated['alamat'] ?? null,
            'rt' => $validated['rt'] ?? null,
            'rw' => $validated['rw'] ?? null,
            'status_perkawinan' => $validated['status_perkawinan'] ?? null,
        ]);

        // Cek jenis surat
        $jenisSurat = JenisSurat::find($validated['jenis_surat_id']);
        if ($jenisSurat && strtolower($jenisSurat->nama) == 'surat keterangan ahli waris') {
            // Simpan data ahli waris menggunakan model AhliWaris
            AhliWaris::create([
                'tanggal_meninggal' => $validated['tanggal_meninggal'],
                'tempat_meninggal' => $validated['tempat_meninggal'],
                'nama_ahli_waris' => $validated['nama_ahli_waris'],
                'nik_ahli_waris' => $validated['nik_ahli_waris'],
                'jenis_kelamin' => $validated['jenis_kelamin_ahli_waris'],
                'umur' => $validated['umur_ahli_waris'],
                'hubungan_ahli_waris' => $validated['hubungan_ahli_waris'],
                'detail_surat_id' => $detailSurat->id,
            ]);
        } elseif ($jenisSurat && strtolower($jenisSurat->nama) == 'surat keterangan tidak mampu') {
            // Simpan data tidak mampu
            KetTidakMampu::create([
                'nama_ayah' => $validated['nama_ayah'],
                'nama_ibu' => $validated['nama_ibu'],
                'pekerjaan_ayah' => $validated['pekerjaan_ayah'],
                'pekerjaan_ibu' => $validated['pekerjaan_ibu'],
                'alamat' => $validated['alamat_tidakmampu'],
                'kelurahan' => $validated['kelurahan'],
                'kecamatan' => $validated['kecamatan'],
                'kabupaten' => $validated['kabupaten'],
                'provinsi' => $validated['provinsi'],
                'keterangan' => $validated['keterangan'],
                'detail_surat_id' => $detailSurat->id,
            ]);
        }

        return redirect()->route('surat.rtrw')->with('success', 'Surat berhasil disimpan.');
    }
}
