<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidangSurat;

class BidangSuratController extends Controller
{
    public function index()
    {
        $bidangSurat = BidangSurat::all();
        return view('bidang_surat.index', compact('bidangSurat'));
    }

    public function create()
    {
        return view('bidang_surat.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:bidang_surat,kode',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        BidangSurat::create($request->all());

        return redirect()->route('bidangsurat')->with('success', 'Bidang surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bidangSurat = BidangSurat::findOrFail($id);
        return view('bidang_surat.edit', compact('bidangSurat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:bidang_surat,kode,' . $id,
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $bidangSurat = BidangSurat::findOrFail($id);
        $bidangSurat->update($request->all());

        return redirect()->route('bidangsurat')->with('success', 'Bidang surat berhasil diupdate.');
    }

    public function destroy($id)
    {
        $bidangSurat = BidangSurat::findOrFail($id);
        $bidangSurat->delete();

        return redirect()->route('bidangsurat')->with('success', 'Bidang surat berhasil dihapus.');
    }
}
