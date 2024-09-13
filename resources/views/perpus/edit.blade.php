@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Barang</h2>
    <form action="{{ route('perpus.update', $perpus->id) }}" method="POST">
        @csrf        
        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang', $perpus->kode_barang) }}">
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $perpus->nama) }}">
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="text" name="stok" class="form-control" value="{{ old('stok', $perpus->stok) }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
