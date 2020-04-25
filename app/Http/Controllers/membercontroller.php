<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class membercontroller extends Controller
{
    public function tambah(Request $req){
            $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'email'=>'required',
            'kelas'=>'required',
            'telepon'=>'required',
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $simpan= member::create([
            'nama'=>$req->nama,
            'email'=>$req->email,
            'kelas'=>$req->kelas,
            'telepon'=>$req->telepon,

        
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
            'nama'=>'required',
            'email'=>'required',
            'kelas'=>'required',
            'telepon'=>'required',
        ]
    );
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $ubah=member::where('id',$id)->update([
        'nama'=>$req->nama,
        'email'=>$req->email,
        'kelas'=>$req->kelas,
        'telepon'=>$req->telepon,

        
    ]);
    if($ubah){
        return Response()->json(['status'=>'berhasil update data']);
    }
    else{
     return Response()->json(['status'=>'gagal deh :(']);
    }
    
    }
    public function destroy($id){
        $hapus=member::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'berhasil']);
        }
        else{
            return Response()->json(['status'=>'gogol']);
        }
    }
    public function show(){
        $data_member = member::get();
        $arr_data = array();
        foreach($data_member as $req) {
            $arr_data[] = array(
                'member ke '=>$req->id,
                'nama'=>$req->nama,
                'email'=>$req->email,
                'kelas'=>$req->kelas,
                'telepon'=>$req->telepon,
            );
        
        }
    
        return Response()->json($arr_data);
    }
}

