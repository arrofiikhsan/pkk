<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_barang', 'id_member', 'id_admin', 'nama_barang', 'tanggal_pengembalian',
    ];
    public $timestamps = false;
    
}
