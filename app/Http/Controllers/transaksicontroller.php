<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi;
use App\barang;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class transaksicontroller extends Controller
{
    public function tambah(Request $req){
            $validator=Validator::make($req->all(),
        [
            'id_barang'=>'required',
            'id_member'=>'required',
            'id_admin'=>'required',
            'nama_barang' => 'required',
            'tanggal_pengembalian'=>'required',
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $date=date("y-m-d H:i:s");
    $simpan= transaksi::create([
            'id_barang'=>$req->id_barang,
            'id_member'=>$req->id_member,
            'id_admin'=>$req->id_admin,
            'nama_barang'=>$req->nama_barang,
            'tanggal_pengembalian'=>$date,
        
    ]);
       
    if($simpan){
        return response ()->json(['status'=>'berhasil']);
    }
    else{
        return response ()->json(['status'=>'gagal']);
    }
    }

    
    public function update($id,Request $req){
        $validator=Validator::make($req->all(),
        [
            'id_barang'=>'required',
            'id_member'=>'required',
            'id_admin'=>'required',
            'nama_barang' => 'required',
            'tanggal_pengembalian'=>'required',
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $ubah=rtransaksi::where('id',$id)->update([
            'id_barang'=>$req->id_barang,
            'id_member'=>$req->id_member,
            'id_admin'=>$req->id_admin,
            'nama_barang'=>$req->nama_barang,
            'tanggal_pengembalian'=>$req->tanggal_pengembalian,
    ]);
    if($ubah){
        return Response()->json(['status'=>'berhasil update data']);
    }
    else{
     return Response()->json(['status'=>'gagal deh :(']);
    }
    
    }

    public function destroy($id){
        $hapus=transaksi::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'berhasil']);
        }
        else{
            return Response()->json(['status'=>'gagal']);
        }
    }

    public function show($id){
        $transaksi = DB::table('transaksi')->join('barang','transaksi.id_barang','=','barang.id')
        ->join('member','transaksi.id_member','=','member.id')
        ->join('admin','transaksi.id_admin','=','admin.id')
        ->where('transaksi.id','=',$id)
        ->first();
        
        $data_transaksi[] = array(
            'id_transaksi'=>$transaksi->id,
            'Nama Barang' => $transaksi->nama_barang,
            'Tanggal' => $transaksi->tanggal_ditemukan,
            'Kategori' => $transaksi->kategori,
            'tanggal ditemukan'=> $transaksi->tanggal_ditemukan,
            'tanggal_pengembalain' => $transaksi->tanggal_pengembalian,
        );
    
return response()->json(compact('data_transaksi'));
}
    public function konfirmasi_transaksi($id){
        $hapus=barang ::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'pengembalian berhasil terkonfirmasi']);
        }
        else{
            return Response()->json(['status'=>'gagal']);
        }
    }
}

