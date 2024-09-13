@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Barang</h2>
    <a href="{{ route('perpus.create') }}" class="btn btn-primary">Tambah Barang</a>
    {{--<a href="{{ route('perpus.dashboard') }}" class="btn btn-primary">Home</a>--}}
    {{--<a href="{{ route('singout') }}" class="btn btn-primary">Keluar</a>--}}

    <table class="table">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perpuses as $perpus)
            <tr>
                <td>{{ $perpus->kode_barang }}</td>
                <td>{{ $perpus->nama }}</td>
                <td>{{ $perpus->stok }}</td>
                <td>
                    <a href="{{ route('perpus.edit', $perpus->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('perpus.destroy', $perpus->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
