<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class MasterGroupController extends Controller
{

   public function index(){
     return view('admin.master_group');
   }

   public function searchData(Request $req){

    $search_text = $req->search_text;

    $group = DB::table('kado_groups as a');

    $group->where(function($q) use ($search_text) {
      $q->where('a.nama_group','LIKE', '%'.$search_text.'%');
                  // ->orWhere('a.KETERANGAN', 'LIKE', '%'.$search_text.'%')
                  // ->orWhere('a.STATUS', 'LIKE', '%'.$search_text.'%')
                  // ->orWhere('a.APPROVE_AT', 'LIKE', '%'.$search_text.'%');
              });
      
    $qData = $group->paginate(10);
    $data['result'] = $qData;

    return response()->json($data, http_response_code(200));
  }
 
  public function addData(Request $req){

    $nama_group = $req->nama_group;

    DB::table('kado_groups')->insert([
      'nama_group' => $nama_group
    ]);

    return response()->json('Success', http_response_code(200));
  }

  public function editData(Request $req){
      
    $id = $req->id;

    $qData = DB::table('kado_groups as a')
    ->where('a.id',$id)
    ->first();

    $data['result'] = $qData;

    return response()->json($data, http_response_code(200));

  }

  public function updateData(Request $req){
    $id = $req->id_group;
    $nama_group = $req->nama_group;

    $qData = DB::table('kado_groups as a')
    ->where('a.id',$id)
    ->update(['nama_group' => $nama_group]);


    return response()->json('Success', http_response_code(200));
  }

  public function deleteData(Request $req){
    $id = $req->id;
    $qData = DB::table('kado_groups')
    ->where('id',$id)
    ->delete();

    return response()->json('Success', http_response_code(200));
  }

}
