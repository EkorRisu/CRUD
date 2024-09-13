<?php

namespace App\Http\Controllers;

use App\Models\Perpus;
use Illuminate\Http\Request;

class PerpusController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $perpuses = Perpus::orderBy('stok', 'ASC')->get();
        return view('perpus.index', compact('perpuses'));
    }

    // Menampilkan form untuk menambahkan buku baru
    public function create()
    {
        return view('perpus.create');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|unique:perpuses,kode_barang',
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
        ]);

        // Menyimpan buku ke database
        Perpus::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('perpus.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    // Menampilkan form untuk mengedit buku
    public function edit($id)
    {
        $perpus = Perpus::findOrFail($id);
        return view('perpus.edit', compact('perpus'));
    }

    // Memperbarui buku
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|unique:perpuses,kode_barang,' . $id,
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
        ]);

        // Mencari buku
        $perpus = Perpus::findOrFail($id);

        // Memperbarui data buku
        $perpus->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('perpus.index')->with('success', 'Barang berhasil diperbarui');
    }

    // Menghapus buku
    public function delete($id)
    {
        // Mencari buku
        $perpus = Perpus::findOrFail($id);

        // Menghapus buku
        $perpus->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('perpus.index')->with('success', 'Barang berhasil dihapus');
    }
}
