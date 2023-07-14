@extends('template.admin')

@section('content')
    <h1>Kategori Produk</h1>
    <a href="{{ url('admin/addkategori') }}" class="btn btn-primary mb-3">Add Category</a>
    <table class="table" style="vertical-align: middle">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $number = 1;  @endphp
            @foreach ($kategori_produks as $kategori)
                <tr>
                    <td>{{ $number }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td style="display: flex; gap: 5px;">
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-primary"><i
                                class="bi bi-pencil"></i></a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                            style="display: inline">
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
