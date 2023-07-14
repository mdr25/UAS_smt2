<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\KategoriProduk;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Toko extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index($id)
    {
        $produk = Produk::where('id', $id)->first();
        return view('pesan.index', compact('produk'));
    }

    public function pesan(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->first();
        $tanggal = Carbon::now();

        // Validasi stok
        if ($request->jumlah_pemesanan > $produk->stok) {
            return redirect('pesan/' . $id);
        }

        // Cek Pesanan
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($cek_pesanan)) {
            // Menyimpan pesanan ke Database
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }

        // Menyimpan detail pesanan ke Database
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // Cek Detail Pesanan
        $cek_detail_pesanan = DetailPesanan::where('produk_id', $produk->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if (empty($cek_detail_pesanan)) {
            $detail_pesanan = new DetailPesanan;
            $detail_pesanan->produk_id = $produk->id;
            $detail_pesanan->pesanan_id = $pesanan_baru->id;
            $detail_pesanan->jumlah = $request->jumlah_pemesanan;
            $detail_pesanan->jumlah_harga = $produk->harga * $request->jumlah_pemesanan;
            $detail_pesanan->save();
        } else {
            $detail_pesanan = DetailPesanan::where('produk_id', $produk->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $detail_pesanan->jumlah = $request->jumlah_pemesanan;

            // Jumlah Harga Setelah di Update
            $harga_detail_pesanan_baru = $produk->harga * $request->jumlah_pemesanan;
            $detail_pesanan->jumlah_harga = $detail_pesanan->jumlah_harga + $harga_detail_pesanan_baru;
            $detail_pesanan->update();
        }

        // Total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $produk->harga * $request->jumlah_pemesanan;
        $pesanan->update();

        Alert::success('Success', 'Pesanan berhasil ditambahkan');
        return redirect('home');
    }

    public function checkout()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $detail_pesanans = [];
        if (!empty($pesanan)) {
            $detail_pesanans = DetailPesanan::where('pesanan_id', $pesanan->id)->get();
        }
        return view('pesan.checkout', compact('pesanan', 'detail_pesanans'));
    }

    public function delete($id)
    {
        $detail_pesanan = DetailPesanan::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $detail_pesanan->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $detail_pesanan->jumlah_harga;
        $pesanan->update();

        $detail_pesanan->delete();
        Alert::success('Success', 'Pesanan berhasil dihapus');
        return redirect('checkout');
    }

    public function confirm()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (empty($user->alamat || $user->no_hp)) {
            Alert::error('Error', 'Harap Lengkapi Indentitas Terlebih Dahulu');
            return redirect('profile');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $detail_pesanans = DetailPesanan::where('pesanan_id', $pesanan_id)->get();
        foreach ($detail_pesanans as $detail_pesanan) {
            $produk = Produk::where('id', $detail_pesanan->produk_id)->first();
            $produk->stok = $produk->stok - $detail_pesanan->jumlah;
            $produk->update();
        }

        Alert::success('Success', 'Pesanan berhasil di Check Out');
        return redirect('invoice/' . $pesanan_id);
    }


    // Halaman Dashboard Admin
    public function admin()
    {
        $jumlahKategori = KategoriProduk::count();
        $jumlahProduk = Produk::count();
        $jumlahPesanan = Pesanan::count();

        return view('admin.index', compact('jumlahKategori', 'jumlahProduk', 'jumlahPesanan'));
    }

    // Produk
    public function produkAdmin()
    {
        $produks = Produk::all();
        return view('admin/produk', compact('produks'));
    }
    public function newProduk()
    {
        $kategoriProduk = KategoriProduk::all();
        return view('admin/addproduk', compact('kategoriProduk'));
    }
    public function addProduk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_produk_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,gif|max:2048',
            'harga' => 'required',
            'stok' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $foto = $request->file('foto');
        $extension = $foto->getClientOriginalExtension();
        $randomString = Str::random(20); // Generate random string with length 20
        $namaFoto = $randomString . '.' . $extension;
        $lokasiPenyimpanan = public_path('img');

        // Simpan file foto ke lokasi penyimpanan
        $foto->move($lokasiPenyimpanan, $namaFoto);

        $data = [
            'nama' => $request->input('nama'),
            'kategori_produk_id' => $request->input('kategori_produk_id'),
            'foto' => $namaFoto,
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'detail' => $request->input('detail')
        ];

        Produk::create($data);

        Alert::success('Success', 'Product created successfully');
        return redirect('admin/produk');
    }
    public function editProduk($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoriProduk = KategoriProduk::all();
        return view('admin.editproduk', compact('produk', 'kategoriProduk'));
    }
    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_produk_id' => 'required',
            'foto' => 'image|mimes:jpeg,png,gif|max:2048',
            'harga' => 'required',
            'stok' => 'required',
            'detail' => 'required'
        ]);

        // Dapatkan objek produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Perbarui atribut-atribut produk dengan data dari form
        $produk->nama = $request->input('nama');
        $produk->kategori_produk_id = $request->input('kategori_produk_id');
        $produk->harga = $request->input('harga');
        $produk->stok = $request->input('stok');
        $produk->detail = $request->input('detail');

        // Proses pengunggahan foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $randomString = Str::random(20); // Generate random string with length 20
            $namaFoto = $randomString . '.' . $extension;
            $lokasiPenyimpanan = public_path('img');

            // Simpan file foto ke lokasi penyimpanan
            $foto->move($lokasiPenyimpanan, $namaFoto);

            // Hapus foto lama jika ada
            if ($produk->foto) {
                $fotoLama = $produk->foto;
                $lokasiFotoLama = $lokasiPenyimpanan . '/' . $fotoLama;
                if (file_exists($lokasiFotoLama)) {
                    unlink($lokasiFotoLama);
                }
            }

            // Perbarui atribut foto dengan nama foto yang baru
            $produk->foto = $namaFoto;
        }

        // Simpan perubahan pada produk
        $produk->save();

        Alert::success('Success', 'Product updated successfully');
        return redirect('admin/produk');
    }
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus foto terkait jika ada
        if ($produk->foto) {
            $lokasiPenyimpanan = public_path('img');
            $foto = $produk->foto;
            $lokasiFoto = $lokasiPenyimpanan . '/' . $foto;

            if (file_exists($lokasiFoto)) {
                unlink($lokasiFoto);
            }
        }

        $produk->delete();

        Alert::success('Success', 'Produk berhasil dihapus');
        return redirect('admin/produk');
    }
    public function kategoriAdmin()
    {
        $kategori_produks = KategoriProduk::all();
        return view('admin/kategori', compact('kategori_produks'));
    }
    public function newKategori()
    {
        return view('admin/addkategori');
    }
    public function addKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        KategoriProduk::create($request->all());
        Alert::success('Success', 'Product Category created successfully');
        return redirect('admin/kategori');
    }
    public function editKategori($id)
    {
        $kategoriProduk = KategoriProduk::where('id', $id)->first();
        return view('admin.editkategori', compact('kategoriProduk'));
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $kategoriProduk = KategoriProduk::findOrFail($id);
        $kategoriProduk->update($request->all());

        Alert::success('Success', 'Category updated successfully');
        return redirect('admin/kategori');
    }
    public function destroyKategori($id)
    {
        $kategoriProduk = KategoriProduk::where('id', $id)->first();
        $kategoriProduk->delete();
        Alert::success('Success', 'Kategori berhasil dihapus');
        return redirect('admin/kategori');
    }
}
