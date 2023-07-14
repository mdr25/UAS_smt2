@extends('template.admin')

@section('content')
    <h1>Products</h1>
    <a href="{{ url('admin/addproduk') }}" class="btn btn-primary mb-3">Add Product</a>
    <table class="table" style="vertical-align: middle">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $number = 1;  @endphp
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $number }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->harga }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->detail }}</td>
                    <td style="display: flex; gap: 5px;">
                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-primary"><i
                                class="bi bi-pencil"></i></a>
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @php  $number++ @endphp
            @endforeach

        </tbody>
    </table>
@endsection
