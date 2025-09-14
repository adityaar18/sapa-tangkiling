<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateSurat;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $template_surat = TemplateSurat::all();
        return view('template_surat.index', compact('template_surat'));
    }

    public function create()
    {
        return view('template_surat.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:docx|max:2048',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = $request->nama . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('templatesurat', $filename, 'public');
            $validated['file_path'] = $path;
        }

        TemplateSurat::create($validated);

        return redirect()->route('template_surat')->with('success', 'Template surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $templateSurat = TemplateSurat::findOrFail($id);
        return view('template_surat.edit', compact('templateSurat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:docx|max:2048',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $template = TemplateSurat::findOrFail($id);

        // Handle file upload if a new file is provided
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = $request->nama . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('templatesurat', $filename, 'public');
            $validated['file_path'] = $path;
        } else {
            // Keep the old file_path if no new file is uploaded
            $validated['file_path'] = $template->file_path;
        }

        $template->update($validated);

        return redirect()->route('template_surat')->with('success', 'Template surat berhasil diupdate.');
    }

    public function destroy($id)
    {
        $template = TemplateSurat::findOrFail($id);
        $template->delete();

        return redirect()->route('template_surat')->with('success', 'Template surat berhasil dihapus.');
    }
}
