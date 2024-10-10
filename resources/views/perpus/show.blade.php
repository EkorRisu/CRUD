@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Buku</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $perpus->nama }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Kode Barang:</strong> {{ $perpus->kode_barang }}</p>
            <p><strong>Nama Buku:</strong> {{ $perpus->nama }}</p>
            <p><strong>Stok:</strong> {{ $perpus->stok }}</p>
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('perpus.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('perpus.edit', $perpus->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('perpus.destroy', $perpus->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
