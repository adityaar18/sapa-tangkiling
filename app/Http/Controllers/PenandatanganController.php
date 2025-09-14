<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penandatangan;
use App\Models\Jabatan;

class PenandatanganController extends Controller
{
    public function index()
    {
        $penandatangan = Penandatangan::with('jabatan')->get();
        return view('penandatangan.index', compact('penandatangan'));
    }

    public function create()
    {
        $jabatan = Jabatan::all();
        return view('penandatangan.add', compact('jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'pangkat' => 'required|string|max:255',
        ]);

        Penandatangan::create($request->all());
        return redirect()->route('penandatangan')->with('success', 'Penandatangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penandatangan = Penandatangan::findOrFail($id);
        $jabatan = Jabatan::all();
        return view('penandatangan.edit', compact('penandatangan', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'pangkat' => 'required|string|max:255',
        ]);

        $penandatangan = Penandatangan::findOrFail($id);
        $penandatangan->update($request->all());
        return redirect()->route('penandatangan')->with('success', 'Penandatangan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penandatangan = Penandatangan::findOrFail($id);
        $penandatangan->delete();
        return redirect()->route('penandatangan')->with('success', 'Penandatangan berhasil dihapus.');
    }
}
