<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi request
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email|max:255',
            'umur' => 'required|integer|min:0',
            'position' => 'required|string|max:255',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Menyimpan file CV jika ada
        if ($request->hasFile('cv')) {
            $validatedData['cv'] = $request->file('cv')->store('cv');
        }

        // Membuat pegawai baru menggunakan pengisian massal yang aman
        Pegawai::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('pegawai.index')->with('success', 'Pegawai Berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pegawai,email,' . $pegawai->id,
            'age' => 'required|integer',
            'position' => 'required',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('cv')) {
            if ($pegawai->cv) {
                Storage::disk('public')->delete($pegawai->cv);
            }
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        $pegawai->update($data);

        Pegawai::where('id', $pegawai->id)->update($data);
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->cv) {
            Storage::disk('public')->delete($pegawai->cv);
        }
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }
}
