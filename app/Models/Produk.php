<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    public function kategori_produk()
    {
        return $this->belongsTo('App\Models\KategoriProduk', 'kategori_produk_id', 'id');
    }

    public function detail_pesanan()
    {
        return $this->hasMany('App\Models\DetailPesanan', 'produk_id', 'id');
    }

    protected $fillable = ['nama', 'kategori_produk_id', 'foto', 'harga', 'stok', 'detail'];
}
