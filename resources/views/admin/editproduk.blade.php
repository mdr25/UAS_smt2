@extends('template.admin')

@section('content')
    <div class="container-fluid pb-5">
        <h1>Edit Produk</h1>
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $produk->nama }}">
            </div>
            <div class="form-group">
                <label for="kategori_produk_id">Kategori Produk</label>
                <select name="kategori_produk_id" class="form-control">
                    @foreach ($kategoriProduk as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $produk->kategori_produk_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
                @if ($produk->foto)
                    <img src="{{ asset('img/' . $produk->foto) }}" class="mt-2" alt="Current Foto"
                        style="max-width: 200px">
                @endif
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $produk->harga }}">
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ $produk->stok }}">
            </div>
            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" class="form-control">{{ $produk->detail }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
