<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Member extends Model
{
    protected $table="member";
    protected $fillable=['nama','email','telepon','kelas','kontak','foto'];
    protected $primaryKey="id";
    public $timestamps=false;
    
}
