<?php

namespace App\Http\Controllers;

use App\Models\Perpus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerpusController extends Controller
{
    // Constructor untuk menambahkan middleware auth
    public function __construct()
    {
        $this->middleware('auth')->except(['index']); // Semua method kecuali index membutuhkan autentikasi
    }

    // Menampilkan daftar buku
    public function index()
    {
        // Ambil data perpustakaan yang diurutkan berdasarkan stok
        $perpuses = Perpus::orderBy('stok', 'ASC')->get();

        // Tampilkan view daftar buku
        return view('perpus.index', compact('perpuses'));
    }

    public function show(Perpus $perpus)
    {
        return view('perpus.show', compact('perpus'));
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
        $validatedData = $request->validate([
            'kode_barang' => 'required|unique:perpuses,kode_barang|max:100',
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
        ]);

        // Menyimpan buku ke database
        Perpus::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('perpus.index')->with('success', 'Data buku berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit buku
    public function edit($id)
    {
        // Cari buku berdasarkan ID
        $perpus = Perpus::findOrFail($id);

        // Tampilkan form edit
        return view('perpus.edit', compact('perpus'));
    }

    // Memperbarui buku
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'kode_barang' => 'required|unique:perpuses,kode_barang,' . $id . '|max:100',
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
        ]);

        // Cari buku berdasarkan ID
        $perpus = Perpus::findOrFail($id);

        // Update buku dengan data baru
        $perpus->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('perpus.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function delete($id)
    {
        // Cari buku berdasarkan ID
        $perpus = Perpus::findOrFail($id);

        // Hapus buku
        $perpus->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('perpus.index')->with('success', 'Data buku berhasil dihapus.');
    }
}
