@extends('template.admin')

@section('content')
    <div class="container-fluid pb-5">
        <h1>Tambah Produk</h1>
        <form action="{{ route('produk.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Kategori Produk</label>
                <select name="kategori_produk_id" class="form-control">
                    @foreach ($kategoriProduk as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control">
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" name="stok" id="stok" class="form-control" value="0">
            </div>
            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea type="text" name="detail" id="detail" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
