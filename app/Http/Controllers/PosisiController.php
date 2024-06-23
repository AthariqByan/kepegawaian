<?php

namespace App\Http\Controllers;

use App\Models\Posisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PosisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posisi = Posisi::all();
        return view('posisi.index', compact('posisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required'
        ]);

        Posisi::create($request->all());
        // Menambahkan SweetAlert success message
        Alert::success('Success', 'Posisi berhasil ditambahkan.');
        return redirect()->route('admin.posisi.index')
            ->with('success', 'Posisi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posisi = Posisi::findOrFail($id);
        return view('posisi.edit', compact('posisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'posisi' => 'required'
        ]);

        $posisi = Posisi::findOrFail($id);
        $posisi->update($request->all());

        Alert::success('Success', 'Posisi berhasil diubah.');
        return redirect()->route('posisi.index')->with('success', 'Posisi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Posisi::destroy($id);
        return response()->json(['success' => 'Posisi berhasil dihapus']);
    }
}
