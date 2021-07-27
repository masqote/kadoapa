<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class MasterKategoriController extends Controller
{

   public function index(){
     return view('admin.master_kategori');
   }

   public function searchData(Request $req){

      $search_text = $req->search_text;

      $kategori = DB::table('kategori as a');

      $kategori->where(function($q) use ($search_text) {
        $q->where('a.nama_kategori','LIKE', '%'.$search_text.'%');
                    // ->orWhere('a.KETERANGAN', 'LIKE', '%'.$search_text.'%')
                    // ->orWhere('a.STATUS', 'LIKE', '%'.$search_text.'%')
                    // ->orWhere('a.APPROVE_AT', 'LIKE', '%'.$search_text.'%');
                });
        
      $qData = $kategori->paginate(10);
      $data['result'] = $qData;

      return response()->json($data, http_response_code(200));
   }

   public function editData(Request $req){
     
    $id = $req->id;

     $qData = DB::table('kategori as a')
     ->where('a.id',$id)
     ->first();

     $data['result'] = $qData;

     return response()->json($data, http_response_code(200));

   }

   public function updateData(Request $req){
     $id = $req->id_kategori;
     $nama_kategori = $req->nama_kategori;

     $qData = DB::table('kategori as a')
     ->where('a.id',$id)
     ->update(['nama_kategori' => $nama_kategori]);


     return response()->json('Success', http_response_code(200));
   }

   public function deleteData(Request $req){
     $id = $req->id;
     $qData = DB::table('kategori')
     ->where('id',$id)
     ->delete();

     return response()->json('Success', http_response_code(200));
   }

   public function addData(Request $req){

        $nama_kategori = $req->nama_kategori;

        DB::table('kategori')->insert([
          'nama_kategori' => $nama_kategori,
          'created_at' => \Carbon\Carbon::now(),
        ]);
      
      return response()->json('Success', http_response_code(200));
   }

}
