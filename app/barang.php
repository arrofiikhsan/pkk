<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table="barang";
    protected $fillable=['nama_barang','deskripsi','kategori','jumlah','tanggal_ditemukan','foto'];
    protected $primaryKey="id";
    public $timestamps=false;
}
