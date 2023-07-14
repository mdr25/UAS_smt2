@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-12">
                {{-- <a href="{{ url('home') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Kembali</a> --}}
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Order History
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table" style="vertical-align: middle">
                            <thead>
                                <tr>
                                    @php
                                        $i = 1;
                                    @endphp
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanans as $pesanan)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pesanan->tanggal }}</td>
                                        <td>
                                            @if ($pesanan->status == 1)
                                                Belum dibayar
                                            @else
                                                Sudah dibayar
                                            @endif
                                        </td>
                                        <td>{{ number_format($pesanan->jumlah_harga) }}</td>
                                        <td>
                                            <a href="{{ url('invoice', $pesanan->id) }}"
                                                class="btn btn-secondary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
