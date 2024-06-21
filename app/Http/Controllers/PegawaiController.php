<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawais,email|max:255',
            'umur' => 'required|integer|min:0',
            'posisi' => 'required|string|max:255',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            $validatedData['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        Pegawai::create($validatedData);

        // Menambahkan SweetAlert success message
        Alert::success('Success', 'Pegawai berhasil ditambahkan.');
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
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

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawais,email,' . $pegawai->id . '|max:255',
            'umur' => 'required|integer|min:0',
            'posisi' => 'required|string|max:255',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            if ($pegawai->cv) {
                Storage::disk('public')->delete($pegawai->cv);
            }
            $validatedData['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        if ($request->hasFile('image')) {
            if ($pegawai->image) {
                Storage::disk('public')->delete($pegawai->image);
            }
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        $pegawai->update($validatedData);

        Alert::success('Success', 'Pegawai berhasil diubah.');
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->cv) {
            Storage::disk('public')->delete($pegawai->cv);
        }
        if ($pegawai->image) {
            Storage::disk('public')->delete($pegawai->image);
        }
        $pegawai->delete();

        $title = 'Hapus Data';
        $text = "Apakah kamu yakin untuk menghapus??";
        confirmDelete($title, $text);
        return view('pegawai.index', compact('pegawai'));
        // return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
