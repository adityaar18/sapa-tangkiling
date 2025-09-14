<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NomorSurat;
use App\Models\BidangSurat;

class NomorSuratController extends Controller
{
    public function index()
    {
        $nomorSurats = NomorSurat::with('bidangSurat')->get();
        return view('nomor_surat.index', compact('nomorSurats'));
    }

    public function create()
    {
        $bidangSurats = BidangSurat::all();
        return view('nomor_surat.add', compact('bidangSurats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bidang_surat_id' => 'required|exists:bidang_surat,id',
            'nomor_surat' => 'required|string',
            'tahun' => 'required|digits:4|integer',
        ]);

        NomorSurat::create($request->all());
        return redirect()->route('nomorsurat');
    }

    public function edit($id)
    {
        $nomorSurat = NomorSurat::findOrFail($id);
        $bidangSurat = BidangSurat::all();
        return view('nomor_surat.edit', compact('nomorSurat', 'bidangSurat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bidang_surat_id' => 'required|exists:bidang_surat,id',
            'nomor_surat' => 'required|string',
            'tahun' => 'required|digits:4|integer',
        ]);

        $nomorSurat = NomorSurat::findOrFail($id);
        $nomorSurat->update($request->all());
        return redirect()->route('nomorsurat');
    }

    public function destroy($id)
    {
        $nomorSurat = NomorSurat::findOrFail($id);
        $nomorSurat->delete();
        return redirect()->route('nomorsurat');
    }
}
