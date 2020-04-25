<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\barang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class barangcontroller extends Controller
{
    public function tambah(Request $req){
        $validator=Validator::make($req->all(),
    [
        'nama_barang'=>'required',
        'tanggal_ditemukan'=>'required',
        'kategori'=>'required',
        'jumlah'=>'required',
        'deskripsi'=>'required',
    ]
);
if($validator->fails()){
    return Response()->json($validator->errors());
}   $date=date("y-m-d H:i:s");
$simpan=barang::create([
        'nama_barang'=>$req->nama_barang,
        'tanggal_ditemukan'=>$date,
        'jumlah'=>$req->jumlah,
        'kategori'=>$req->kategori,
        'deskripsi'=>$req->deskripsi,

    
]);
if($simpan){
    return response ()->json(['status'=>'berhasil tambah data']);
}
else{
    return response ()->json(['status'=>'gagal']);
}
}
   

public function update($id,Request $req){
    $validator=Validator::make($req->all(),
    [
        'nama_barang'=>'required',
        'tanggal_ditemukan'=>'required',
        'kategori'=>'required',
        'jumlah'=>'required',
        'deskripsi'=>'required',
    ]
);
if($validator->fails()){
    return Response()->json($validator->errors());
}
$ubah=barang::where('id',$id)->update([
    'nama_barang'=>$req->nama_barang,
    'jumlah'=>$req->jumlah,
    'kategori'=>$req->kategori,
    'deskripsi'=>$req->deskripsi,
]);
if($ubah){
    return Response()->json(['status'=>'berhasil update data']);
}
else{
 return Response()->json(['status'=>'gagal deh :(']);
}

}
public function destroy($id){
    $hapus=barang::where('id',$id)->delete();
    if($hapus){
        return Response()->json(['status'=>'berhasil']);
    }
    else{
        return Response()->json(['status'=>'gogol']);
    }
}
public function show($id){
    $data_barang = barang::get();
    $arr_data = array();
    foreach($data_barang as $req) {
        $arr_data[] = array(
            'nama_barang'=>$req->nama_barang,
            'tanggal_ditemukan'=>$req->tanggal_ditemukan,
            'jumlah'=>$req->jumlah,
            'kategori'=>$req->kategori,
            'deskripsi'=>$req->deskripsi,
        );
    
    }

    return Response()->json($arr_data);
}
}
