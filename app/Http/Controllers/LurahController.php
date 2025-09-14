<?php

namespace App\Http\Controllers;

use App\Models\BidangSurat;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\JenisSurat;
use App\Models\NomorSurat;

class LurahController extends Controller
{
    public function indexValidasi()
    {
        $surat = Surat::with(['jenisSurat', 'penandatangan'])->orderBy('persetujuan', 'asc')->paginate(10);
        return view('lurah.validasi', compact('surat'));
    }

    public function validasiSurat($id)
    {
        $surat = Surat::findOrFail($id);

        $nomorSurat = NomorSurat::where('bidang_surat_id', $surat->bidang_surat_id ?? null)->first();

        $bidangSurat = BidangSurat::find($surat->bidang_surat_id);

        if ($nomorSurat) {
            $nomorSurat->nomor_surat = $nomorSurat->nomor_surat + 1;
            $nomorSurat->save();
            $nomorSuratValue = $nomorSurat->nomor_surat;
        } else {
            $nomorSuratValue = null;
        }

        // Ambil bulan dan tahun dari tanggal surat
        $tanggalSurat = \Carbon\Carbon::parse($surat->tanggal_surat);
        $bulan = $tanggalSurat->month;
        $tahun = $tanggalSurat->year;

        // Array bulan romawi
        $bulanRomawiArr = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];
        $bulanRomawi = $bulanRomawiArr[$bulan];

        // Format nomor surat
        $nomorSuratFormat = $nomorSuratValue . ' / ' . $bidangSurat->kode . ' / TKL-' . $bulanRomawi . ' / ' . $tahun;
        $nomorSuratValue = $nomorSuratFormat;

        // Update persetujuan dan nomor_surat
        $surat->update([
            'persetujuan' => 2,
            'nomor_surat' => $nomorSuratValue,
        ]);

        return redirect()->route('lurah.validasi')->with('success', 'Surat berhasil divalidasi.');
    }

    public function tolakSurat(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:255',
        ]);

        $surat = Surat::findOrFail($id);
        $surat->update([
            'persetujuan' => 0,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('lurah.validasi')->with('success', 'Surat berhasil ditolak dan catatan telah disimpan.');
    }
}
