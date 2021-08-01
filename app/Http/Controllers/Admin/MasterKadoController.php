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
      'slug' => $slug,
      'created_at' => \Carbon\Carbon::now(),
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

  public function deleteData(Request $req){
    $id = $req->id;

    DB::table('kado')
        ->where('id', $id)
        ->update([
          'fg_aktif' => 0,
          'updated_at' => \Carbon\Carbon::now(),
        ]);

    return response()->json('Success', http_response_code(200));
  }

  public function aktifkanData(Request $req){
    $id = $req->id;
    
    DB::table('kado')
        ->where('id', $id)
        ->update([
          'fg_aktif' => 1,
          'updated_at' => \Carbon\Carbon::now(),
        ]);

    return response()->json('Success', http_response_code(200));
  }

  public function editData(Request $req, $id){

    $qData = DB::table('kado as a')
    ->select('a.*','b.foto as thumbnail')
    ->where('a.id',$id)
    ->leftJoin('kado_foto as b', 'a.thumbnail', '=', 'b.id')
    ->first();

    if (!$qData) {
      return redirect()->back();
    }

    $group = DB::table('kado_groups as a')
    ->get();

    $kategori = DB::table('kategori as a')
    ->get();

    $kategori_kado = DB::table('kado_kategori as a')
        ->select('a.id','a.id_kado','b.nama_kategori')
        ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
        ->where('a.id_kado',$id)
        ->get();

    $foto = DB::table('kado_foto as a')
    ->select('a.*','b.thumbnail')
    ->leftJoin('kado as b', 'a.id', '=', 'b.thumbnail')
    ->where('a.id_kado',$id)
    ->get();
    // dd($foto);
    $video = DB::table('kado as a')
      ->select('b.video')
      ->leftJoin('kado_videos as b', 'a.id', '=', 'b.id_kado')
      ->where('b.id_kado', $id)
      ->first();
    
    $lokasi = DB::table('kado_lokasi as a')
      ->select('a.*')
      ->where('a.id_kado',$id)
      ->get();
        
    $qData->kategori_kado = $kategori_kado;
    $qData->foto = $foto;
    $qData->video = $video;
    $qData->lokasi = $lokasi;

    $data['result'] = $qData;
    $data['group'] = $group;
    $data['kategori'] = $kategori;
    // dd($data);

    return view('admin.master_kado_edit',$data);

  }

  public function updateDetailKado(Request $req,$id){
    // dd($req->all());
   
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
      'id_kategori' => $id_kategori,
      'created_at' => \Carbon\Carbon::now(),
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

  public function addLokasiKado(Request $req){
    $id_kado = $req->id_kado;
    $nama_lokasi = $req->nama_lokasi;
    $lokasi = $req->lokasi;
    $background = $req->background;
    $color = $req->color;

    $qData = DB::table('kado_lokasi')->insert([
      'id_kado' => $id_kado,
      'lokasi' => $lokasi,
      'nama_lokasi' => $nama_lokasi,
      'color' => $color,
      'background' => $background,
      'created_at' => \Carbon\Carbon::now(),
    ]);

    return response()->json('Success add lokasi', http_response_code(200));
  }

  public function deleteLokasiKado(Request $req){
    $id = $req->id;
    $qData = DB::table('kado_lokasi')
    ->where('id',$id)
    ->delete();

    return response()->json('Success', http_response_code(200));
  }

  public function addFotoKado(Request $req,$id){

      $file_foto = $req->file('foto');
      $file_video = $req->file('video');

      if ($file_foto) {
        foreach ($file_foto as $item) {
          $foto = 'img/kado/'.time()."_".$item->getClientOriginalName();
          // isi dengan nama folder tempat kemana file diupload
          $tujuan_upload = 'img/kado';
          $item->move($tujuan_upload,$foto);

          DB::table('kado_foto')->insert([
            'id_kado' => $id,
            'foto' => $foto,
            'fg_aktif' => 1,
            'created_at' => \Carbon\Carbon::now(),
          ]);

        }

      }

      if ($file_video) {
        $video = 'video/kado/'.time()."_".$file_video->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'video/kado';
        $file_video->move($tujuan_upload,$video);

        DB::table('kado_videos')->insert([
          'id_kado' => $id,
          'video' => $video,
          'fg_aktif' => 1,
          'created_at' => \Carbon\Carbon::now(),
        ]);
      }

      return redirect()->back();
  }

  public function setThumbnail(Request $req){
    $id = $req->id;
    $id_kado = $req->id_kado;

    DB::table('kado')
              ->where('id', $id_kado)
              ->update([
                'thumbnail' => $id,
                'updated_at' => \Carbon\Carbon::now(),
              ]);

    return response()->json('Success update thumbnail', http_response_code(200));
  }

  public function setFgAktif(Request $req){
    $id = $req->id;
    $status = $req->status;

    $check = DB::table('kado')
    ->where('thumbnail',$id)
    ->first();

    if ($check) {
      http_response_code(500);
      exit(json_encode(['message' => 'Thumbnail tidak bisa dinonaktifkan!']));
    }

    if ($status == 'aktif') {
      DB::table('kado_foto')
        ->where('id', $id)
        ->update([
          'fg_aktif' => 1,
          'updated_at' => \Carbon\Carbon::now(),
        ]);
    }else{
      DB::table('kado_foto')
        ->where('id', $id)
        ->update([
          'fg_aktif' => 0,
          'updated_at' => \Carbon\Carbon::now(),
        ]);
    }


    return response()->json('Success update thumbnail', http_response_code(200));
  }
 

}
