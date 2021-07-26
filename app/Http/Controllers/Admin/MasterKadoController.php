<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class MasterKadoController extends Controller
{

   public function index(){
     return view('admin.master_kado');
   }

   public function addData(Request $req){

    $nama_kado = $req->nama_kado;
    $slug = $req->slug;

    DB::table('kado')->insert([
      'nama_kado' => $nama_kado,
      'slug' => $slug
    ]);

    return response()->json('Success', http_response_code(200));
  }

   public function searchData(Request $req){

    $search_text = $req->search_text;

    $group = DB::table('kado as a');

    $group->where(function($q) use ($search_text) {
      $q->where('a.nama_kado','LIKE', '%'.$search_text.'%');
                  // ->orWhere('a.KETERANGAN', 'LIKE', '%'.$search_text.'%')
                  // ->orWhere('a.STATUS', 'LIKE', '%'.$search_text.'%')
                  // ->orWhere('a.APPROVE_AT', 'LIKE', '%'.$search_text.'%');
              });
      
            
    $qData = $group->orderBy('a.id','desc')->paginate(10);

    foreach ($qData as $row) {
      if ($row->updated_at) {
        $row->updated_human = \Carbon\Carbon::parse($row->updated_at)->diffForHumans();
      }else{
        $row->updated_human = '<span style="color:red;">BELUM UPDATED!!</span>';
      }
      
    }

    
    $data['result'] = $qData;

    return response()->json($data, http_response_code(200));
  }

  public function editData(Request $req, $id){

    $qData = DB::table('kado as a')
    ->where('a.id',$id)
    ->first();

    $group = DB::table('kado_groups as a')
    ->get();

    $kategori = DB::table('kategori as a')
    ->get();

    $kategori_kado = DB::table('kado_kategori as a')
        ->select('a.id','a.id_kado','b.nama_kategori')
        ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
        ->where('a.id_kado',$id)
        ->get();

    $foto = DB::table('kado as a')
      ->select('b.foto')
      ->leftJoin('kado_foto as b', 'a.id', '=', 'b.id_kado')
      ->where('b.id_kado', $id)
      ->get();
    
    $video = DB::table('kado as a')
      ->select('b.video')
      ->leftJoin('kado_videos as b', 'a.id', '=', 'b.id_kado')
      ->where('b.id_kado', $id)
      ->first();
        
    $qData->kategori_kado = $kategori_kado;
    $qData->foto = $foto;
    $qData->video = $video;

    $data['result'] = $qData;
    $data['group'] = $group;
    $data['kategori'] = $kategori;

    return view('admin.master_kado_edit',$data);

  }

  public function updateDetailKado(Request $req,$id){
    // dd($req->all());
    $link_thumbnail = $req->link_thumbnail;
    $thumbnail = $req->thumbnail;
    $pria = NULL;
    $wanita = NULL;
    $nama_kado = $req->nama_kado;
    $slug = $req->slug;
    $kado_group = $req->kado_group;
    $harga = $req->harga;
    $umur = $req->umur;
    $deskripsi = $req->content;

    if ($req->pria == 'on') {
      $pria = 1;
    }

    if ($req->wanita == 'on') {
      $wanita = 1;
    }

    if ($thumbnail) {
      $file = $req->file('thumbnail');
      $thumbnail = 'img/kado/'.time()."_".$file->getClientOriginalName();
      // isi dengan nama folder tempat kemana file diupload
      $tujuan_upload = 'img/kado';
      $file->move($tujuan_upload,$thumbnail);
    }else{
      $thumbnail = $link_thumbnail;
    }
	
    DB::table('kado')
              ->where('id', $id)
              ->update([
                'id_kado_group' => $kado_group,
                'nama_kado' => $nama_kado,
                'slug' => $slug,
                'pria' => $pria,
                'wanita' => $wanita,
                'harga' => $harga,
                'umur' => $umur,
                'deskripsi' => $deskripsi,
                'thumbnail' => $thumbnail,
                'fg_aktif' => 1,
                'updated_at' => \Carbon\Carbon::now(),
              ]);

		return redirect()->back();
  }

  public function addKategoriKado(Request $req){
    $id_kategori = $req->id_kategori;
    $id_kado = $req->id_kado;

    $check = DB::table('kado_kategori as a')
    ->where('a.id_kado',$id_kado)
    ->where('a.id_kategori',$id_kategori)
    ->first();

    if ($check) {
      http_response_code(500);
      exit(json_encode(['message' => 'Kategori sudah ada!']));
    }

    $qData = DB::table('kado_kategori')->insert([
      'id_kado' => $id_kado,
      'id_kategori' => $id_kategori
    ]);

    return response()->json('Success add kategori', http_response_code(200));

  }

  public function deleteKategoriKado(Request $req){
    $id = $req->id;
    $qData = DB::table('kado_kategori')
    ->where('id',$id)
    ->delete();

    return response()->json('Success', http_response_code(200));
  }
 

}
