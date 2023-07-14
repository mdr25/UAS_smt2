@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-12">
                {{-- <a href="{{ url('home') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Kembali</a> --}}
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('history') }}">Order History</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Invoice {{ $pesanan->id }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                @if (!empty($pesanan))
                    <h6 class="text-end"><strong>Tanggal Pemesanan {{ $pesanan->tanggal }}</h6>
                    <div class="card">
                        <div class="card-body">
                            <h3>Invoice and Payment Details</h3>
                            <table class="table" style="vertical-align: middle">
                                <thead>
                                    <tr>
                                        @php
                                            $i = 1;
                                        @endphp
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail_pesanans as $detail_pesanan)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $detail_pesanan->produk->nama }}</td>
                                            <td>{{ $detail_pesanan->jumlah }}</td>
                                            <td>Rp {{ number_format($detail_pesanan->produk->harga) }}</td>
                                            <td>Rp {{ number_format($detail_pesanan->jumlah_harga) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="table-active text-end">
                                            <strong>
                                                Total Bayar :
                                            </strong>
                                        </td>
                                        <td class="table-active">
                                            <strong>
                                                Rp {{ number_format($pesanan->jumlah_harga) }}
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <a href="{{ url('invoice', $pesanan->id) }}" class="btn btn-success">Bayar Sekarang</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
