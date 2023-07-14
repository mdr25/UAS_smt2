@extends('template.admin')

@section('content')
    <h1>Edit Kategori</h1>
    <form action="{{ route('kategori.update', $kategoriProduk->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $kategoriProduk->nama }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
