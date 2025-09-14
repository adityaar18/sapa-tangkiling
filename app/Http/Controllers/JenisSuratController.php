<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSurat;
use App\Models\TemplateSurat;
use App\Models\BidangSurat;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenisSurat = JenisSurat::with(['templateSurat', 'bidangSurat'])->get();
        return view('jenis_surat.index', compact('jenisSurat'));
    }

    public function create()
    {
        $templatesurat = TemplateSurat::all();
        $bidangsurat = BidangSurat::all();
        return view('jenis_surat.add', compact('templatesurat', 'bidangsurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'bidang_surat_id' => 'required|exists:bidang_surat,id',
            'template_id' => 'required|exists:template_surat,id',
        ]);

        JenisSurat::create($request->all());

        return redirect()->route('jenis_surat')->with('success', 'Jenis Surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $templateSurat = TemplateSurat::all();
        $bidangSurat = BidangSurat::all();
        return view('jenis_surat.edit', compact('jenisSurat', 'templateSurat', 'bidangSurat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'bidang_surat_id' => 'required|exists:bidang_surat,id',
            'template_id' => 'required|exists:template_surat,id',
        ]);

        $jenis_surat = JenisSurat::findOrFail($id);
        $jenis_surat->update($request->all());

        return redirect()->route('jenis_surat')->with('success', 'Jenis Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenis_surat = JenisSurat::findOrFail($id);
        $jenis_surat->delete();

        return redirect()->route('jenis_surat')->with('success', 'Jenis Surat berhasil dihapus.');
    }
}
