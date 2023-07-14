@extends('template.admin')

@section('content')
    <h1>Tambah Kategori</h1>
    <form action="{{ route('kategori.add') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
