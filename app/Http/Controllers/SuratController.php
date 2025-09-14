<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\JenisSurat;
use App\Models\Penandatangan;
use App\Models\DetailSurat;
use App\Models\NomorSurat;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\AhliWaris;
use App\Models\KetTidakMampu;
use App\Services\SelectedDateStore;

class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::with(['jenisSurat', 'penandatangan'])->paginate(10);
        return view('surat.index', compact('surat'));
    }

    public function show($id)
    {
        $surat = Surat::with(['jenisSurat', 'penandatangan', 'detailSurat'])->findOrFail($id);
        return view('surat.detail', compact('surat'));
    }

    public function create()
    {
        $jenisSurats = JenisSurat::all();
        $penandatangans = Penandatangan::all();
        return view('surat.add', compact('jenisSurats', 'penandatangans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_surat' => 'required|date',
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'penandatangan_id' => 'required|exists:penandatangan,id',
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

        $templateSurat = JenisSurat::with('templateSurat')
            ->where('id', $validated['jenis_surat_id'])
            ->first();

        $nomorSurat = NomorSurat::where('bidang_surat_id', $templateSurat->templateSurat->bidang_surat_id ?? null)->first();

        if ($nomorSurat) {
            $nomorSurat->nomor_surat = $nomorSurat->nomor_surat + 1;
            $nomorSurat->save();
            $nomorSuratValue = $nomorSurat->nomor_surat;
        }

        $surat = Surat::create([
            'kode_unik' => $kode_unik,
            'nomor_surat' => $nomorSuratValue,
            'tanggal_surat' => $validated['tanggal_surat'],
            'jenis_surat_id' => $validated['jenis_surat_id'],
            'penandatangan_id' => $validated['penandatangan_id'],
            'persetujuan' => 1
        ]);

        $detailSurat = DetailSurat::create([
            'surat_id' => $surat->id,
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

        return redirect()->route('surat')->with('success', 'Surat berhasil disimpan.');
    }

    public function edit($id)
    {
        $surat = Surat::with('detailSurat')->findOrFail($id);
        $jenisSurats = JenisSurat::all();
        $penandatangans = Penandatangan::all();
        return view('surat.edit', compact('surat', 'jenisSurats', 'penandatangans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_surat' => 'required|date',
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'penandatangan_id' => 'required|exists:penandatangan,id',
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
            'status_perkawinan' => 'nullable|string|in:belum menikah,menikah,cerai',
        ]);

        $surat = Surat::with('detailSurat')->findOrFail($id);
        $surat->update([
            'tanggal_surat' => $validated['tanggal_surat'],
            'jenis_surat_id' => $validated['jenis_surat_id'],
            'penandatangan_id' => $validated['penandatangan_id'],
        ]);

        $surat->detailSurat->update([
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

        return redirect()->route('surat')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();
        return redirect()->route('surat')->with('success', 'Surat berhasil dihapus.');
    }

    public function generateSurat($id)
    {
        $surat = Surat::with(['jenisSurat.templateSurat', 'penandatangan', 'detailSurat'])->findOrFail($id);
        $templatePath = public_path('storage/' . $surat->jenisSurat->templateSurat->file_path);
        $phpWord = new TemplateProcessor($templatePath);
        // // Ambil bulan dan tahun dari tanggal surat
        // $tanggalSurat = \Carbon\Carbon::parse($surat->tanggal_surat);
        // $bulan = $tanggalSurat->month;
        // $tahun = $tanggalSurat->year;

        // // Array bulan romawi
        // $bulanRomawiArr = [
        //     1 => 'I',
        //     2 => 'II',
        //     3 => 'III',
        //     4 => 'IV',
        //     5 => 'V',
        //     6 => 'VI',
        //     7 => 'VII',
        //     8 => 'VIII',
        //     9 => 'IX',
        //     10 => 'X',
        //     11 => 'XI',
        //     12 => 'XII'
        // ];
        // $bulanRomawi = $bulanRomawiArr[$bulan];

        // // Format nomor surat
        // $nomorSuratFormat = $surat->nomor_surat . ' / Sekret / TKL-' . $bulanRomawi . ' / ' . $tahun;

        $phpWord->setValue('nomor_surat', $surat->nomor_surat);
        // Format tanggal surat dalam bahasa Indonesia
        $bulanIndo = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $tanggalSuratObj = \Carbon\Carbon::parse($surat->tanggal_surat);
        $tanggalSuratIndo = $tanggalSuratObj->format('d') . ' ' . $bulanIndo[$tanggalSuratObj->month] . ' ' . $tanggalSuratObj->year;
        $phpWord->setValue('tanggal_surat', $tanggalSuratIndo);

        // Hitung tanggal masa berlaku maksimal (3 bulan dari tanggal surat), format Indonesia
        $masaBerlakuObj = $tanggalSuratObj->copy()->addMonths(3);
        $masaBerlakuIndo = $masaBerlakuObj->format('d') . ' ' . $bulanIndo[$masaBerlakuObj->month] . ' ' . $masaBerlakuObj->year;
        $phpWord->setValue('masa_berlaku', $masaBerlakuIndo);
        $phpWord->setValue('nama', $surat->detailSurat->nama);
        $phpWord->setValue('nik', $surat->detailSurat->nik);
        $phpWord->setValue('no_kk', $surat->detailSurat->no_kk);
        $phpWord->setValue('jenis_kelamin', $surat->detailSurat->jenis_kelamin);
        $phpWord->setValue('tempat_lahir', $surat->detailSurat->tempat_lahir);
        $phpWord->setValue('tanggal_lahir', \Carbon\Carbon::parse($surat->detailSurat->tanggal_lahir)->format('d-m-Y'));
        $phpWord->setValue('agama', $surat->detailSurat->agama);
        $phpWord->setValue('pekerjaan', $surat->detailSurat->pekerjaan);
        $phpWord->setValue('alamat', $surat->detailSurat->alamat);
        $phpWord->setValue('rt', $surat->detailSurat->rt);
        $phpWord->setValue('rw', $surat->detailSurat->rw);
        $phpWord->setValue('status_perkawinan', $surat->detailSurat->status_perkawinan);
        $phpWord->setValue('penandatangan', $surat->penandatangan->nama);
        $phpWord->setValue('nip_penandatangan', $surat->penandatangan->nip);

        $outputFile = 'surat_' . $surat->detailSurat->nik . '_' . $surat->tanggal_surat . '.docx';
        $phpWord->saveAs(public_path('storage/surat/' . $outputFile));
        $surat->update(['file_docx_path' => $outputFile]);

        // $docxPath = public_path('storage/surat/' . $outputFile);
        // $pdfOutputFile = pathinfo($outputFile, PATHINFO_FILENAME) . '.pdf';
        // $pdfPath = public_path('storage/suratpdf/' . $pdfOutputFile);

        // // Pastikan direktori tujuan ada
        // if (!file_exists(dirname($pdfPath))) {
        //     mkdir(dirname($pdfPath), 0777, true);
        // }

        // // Pilih OS: 'windows' atau 'linux'
        // $os = env('LIBREOFFICE_OS', 'windows'); // default windows, bisa diatur di .env

        // if ($os === 'windows') {
        //     // Contoh path LibreOffice di Windows, sesuaikan jika perlu
        //     $libreOfficePath = env('LIBREOFFICE_PATH', 'C:\Program Files\LibreOffice\program\soffice.exe');
        //     $command = '"' . $libreOfficePath . '" --headless --convert-to pdf --outdir ' . escapeshellarg(dirname($pdfPath)) . ' ' . escapeshellarg($docxPath);
        // } else {
        //     // Linux
        //     $libreOfficePath = '/usr/bin/libreoffice';
        //     $command = "HOME=/tmp $libreOfficePath --headless --convert-to pdf --outdir " . escapeshellarg(dirname($pdfPath)) . " " . escapeshellarg($docxPath);
        // }

        // exec($command);

        // // Simpan path PDF ke database jika perlu
        // $surat->update(['file_pdf_path' => $pdfOutputFile]);

        return redirect()->route('surat')->with('success', 'Surat berhasil digenerate ulang.');
    }
}
