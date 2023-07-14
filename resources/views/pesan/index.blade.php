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
                        <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama }}</li>
                    </ol>
                </nav>
            </div>
            <!--  Modal -->
            <div class="modal fade" id="productView" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content overflow-hidden border-0">
                        <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body p-0">
                            <div class="row align-items-stretch">
                                <div class="col-lg-6 p-lg-0"><a
                                        class="glightbox product-view d-block h-100 bg-cover bg-center"
                                        style="background: url(img/product-5.jpg)" href="img/product-5.jpg"
                                        data-gallery="gallery1" data-glightbox="Red digital smartwatch"></a><a
                                        class="glightbox d-none" href="img/product-5-alt-1.jpg" data-gallery="gallery1"
                                        data-glightbox="Red digital smartwatch"></a><a class="glightbox d-none"
                                        href="img/product-5-alt-2.jpg" data-gallery="gallery1"
                                        data-glightbox="Red digital smartwatch"></a></div>
                                <div class="col-lg-6">
                                    <div class="p-4 my-md-4">
                                        <ul class="list-inline mb-2">
                                            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0 1"><i
                                                    class="fas fa-star small text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0 2"><i
                                                    class="fas fa-star small text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0 3"><i
                                                    class="fas fa-star small text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0 4"><i
                                                    class="fas fa-star small text-warning"></i>
                                            </li>
                                        </ul>
                                        <h2 class="h4">{{ $produk->nama }}</h2>
                                        <p class="text-muted">{{ $produk->harga }}</p>
                                        <p class="text-sm mb-4">{{ $produk->detail }}
                                        </p>
                                        <div class="row align-items-stretch mb-4 gx-0">
                                            <div class="col-sm-7">
                                                <div
                                                    class="border d-flex align-items-center justify-content-between py-1 px-3">
                                                    <span
                                                        class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                                    <div class="quantity">
                                                        <button class="dec-btn p-0"><i
                                                                class="fas fa-caret-left"></i></button>
                                                        <input class="form-control border-0 shadow-0 p-0" type="text"
                                                            value="1">
                                                        <button class="inc-btn p-0"><i
                                                                class="fas fa-caret-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 offset"><a
                                                    class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0"
                                                    href="cart.html">Add to cart</a></div>
                                        </div><a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i
                                                class="far fa-heart me-2"></i>Add to wish list</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section>
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-lg-6">
                            <!-- PRODUCT SLIDER-->
                            <div class="row m-sm-0">
                                <div class="col-sm-12 order-1 order-sm-2">
                                    <div class="swiper product-slider product-slider-thumbs">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide h-auto">
                                                <a class="glightbox product-view" href="img/product-detail-1.jpg"
                                                    data-gallery="gallery2" data-glightbox="Product item 1"><img
                                                        class="img-fluid" src="{{ url('img') }}/{{ $produk->foto }}"
                                                        alt="...">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PRODUCT DETAILS-->
                        <div class="col-lg-6">
                            <ul class="list-inline mb-2 text-sm">
                                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
                            </ul>
                            <h1>{{ $produk->nama }}</h1>
                            <p class="text-muted lead">Rp {{ number_format($produk->harga) }}</p>
                            <p class="text-sm mb-4">{{ $produk->detail }}</p>
                            <form method="post" action="{{ url('pesan') }}/{{ $produk->id }}">
                                <div class="row align-items-stretch mb-4">
                                    <div class="col-sm-5 pr-sm-0">
                                        @csrf
                                        <div
                                            class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                            <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>

                                            <div class="quantity">
                                                <a class="dec-btn p-0"><i class="fas fa-caret-left"></i></a>
                                                <input class="form-control border-0 shadow-0 p-0" name="jumlah_pemesanan"
                                                    type="text" value="1" required>
                                                <a class="inc-btn p-0"><i class="fas fa-caret-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 pl-sm-0">
                                        <button
                                            class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-4"
                                            type="submit">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- DETAILS TABS-->
                    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab"
                                data-bs-toggle="tab" href="#description" role="tab" aria-controls="description"
                                aria-selected="true">Description</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab"
                                href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <div class="p-4 p-lg-5 bg-white">
                                <h6 class="text-uppercase">Product description </h6>
                                <p class="text-muted text-sm mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                    veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                                    aute
                                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                    mollit
                                    anim id est laborum.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="p-4 p-lg-5 bg-white">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="d-flex mb-3">
                                            <div class="flex-shrink-0"><img class="rounded-circle"
                                                    src="img/customer-1.png" alt="" width="50" /></div>
                                            <div class="ms-3 flex-shrink-1">
                                                <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                                                <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                                <ul class="list-inline mb-1 text-xs">
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star-half-alt text-warning"></i></li>
                                                </ul>
                                                <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                                    magna
                                                    aliqua.</p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img class="rounded-circle"
                                                    src="img/customer-2.png" alt="" width="50" /></div>
                                            <div class="ms-3 flex-shrink-1">
                                                <h6 class="mb-0 text-uppercase">Jane Doe</h6>
                                                <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                                <ul class="list-inline mb-1 text-xs">
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0"><i
                                                            class="fas fa-star-half-alt text-warning"></i></li>
                                                </ul>
                                                <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                                    adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                                    magna
                                                    aliqua.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="bg-dark text-white">
                <div class="container py-4">
                    <div class="row py-5">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <h6 class="text-uppercase mb-3">Customer services</h6>
                            <ul class="list-unstyled mb-0">
                                <li><a class="footer-link" href="#!">Help &amp; Contact Us</a></li>
                                <li><a class="footer-link" href="#!">Returns &amp; Refunds</a></li>
                                <li><a class="footer-link" href="#!">Online Stores</a></li>
                                <li><a class="footer-link" href="#!">Terms &amp; Conditions</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <h6 class="text-uppercase mb-3">Company</h6>
                            <ul class="list-unstyled mb-0">
                                <li><a class="footer-link" href="#!">What We Do</a></li>
                                <li><a class="footer-link" href="#!">Available Services</a></li>
                                <li><a class="footer-link" href="#!">Latest Posts</a></li>
                                <li><a class="footer-link" href="#!">FAQs</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-uppercase mb-3">Social media</h6>
                            <ul class="list-unstyled mb-0">
                                <li><a class="footer-link" href="#!">Twitter</a></li>
                                <li><a class="footer-link" href="#!">Instagram</a></li>
                                <li><a class="footer-link" href="#!">Tumblr</a></li>
                                <li><a class="footer-link" href="#!">Pinterest</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-top pt-4" style="border-color: #1d1d1d !important">
                        <div class="row">
                            <div class="col-md-6 text-center text-md-start">
                                <p class="small text-muted mb-0">&copy; 2021 All rights reserved.</p>
                            </div>
                            <div class="col-md-6 text-center text-md-end">
                                <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor"
                                        href="https://bootstrapious.com/p/boutique-bootstrap-e-commerce-template">Bootstrapious</a>
                                </p>
                                <!-- If you want to remove the backlink, please purchase the Attribution-Free License. See details in readme.txt or license.txt. Thanks!-->
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    @endsection
