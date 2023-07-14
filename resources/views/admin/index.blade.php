@extends('template.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="summary-kategori p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="bi bi-list text-black-50 icon-lg"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2 fw-2">Kategori</h3>
                            <h5>{{ $jumlahKategori }} Kategori</h5>
                            <p class="m-0"><a href="kategori.php" class="text-white">Lihat Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="summary-produk p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="bi bi-box-seam-fill text-black-50 icon-lg"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2 fw-2">Produk</h3>
                            <h5>{{ $jumlahProduk }} Produk</h5>
                            <p class="m-0"><a href="/admin/produk" class="text-white">Lihat Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="summary-pesanan p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="bi bi-inbox-fill text-black-50 icon-lg"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2 fw-2">Pesanan</h3>
                            <h5>{{ $jumlahPesanan }} Pesanan</h5>
                            <p class="m-0"><a href="pesanan.php" class="text-white">Lihat Detail</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
