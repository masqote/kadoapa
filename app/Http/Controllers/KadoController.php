<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class KadoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    var $parameter = 'medhy_pradana_putra';
    
    public function __construct()
    {
        //
    }

    public function kategori(){
      
      $data['kategori'] = DB::table('kategori as a')->orderBy('a.nama_kategori')->get();

      return response()->json($data, http_response_code(200));
    }

    public function index(Request $req){

      $kategori = $req->kategori;
      $gender = $req->gender;
      $budget = $req->budget;
      $budget_end = $req->budget_end;
      $sort_harga = $req->sort_harga;

      if ($budget) {
        $budget = intval(preg_replace('/[^\d.]/', '', $budget));
      }

      if ($budget_end) {
        $budget_end = intval(preg_replace('/[^\d.]/', '', $budget_end));
      }

      $rsData = DB::table('kado as a')
      ->select('a.id','a.nama_kado','a.harga','a.pria','a.wanita','a.umur','a.deskripsi','a.created_at','a.thumbnail','a.slug','b.nama_group')
      ->leftJoin('kado_groups as b', 'a.id_kado_group', '=', 'b.id')
      ->where('a.fg_aktif',1);

      if ($kategori) {
        $rsData->leftJoin('kado_kategori as c', 'a.id', '=', 'c.id_kado')
        ->leftJoin('kategori as d', 'c.id_kategori', '=', 'd.id')
        ->where('c.id_kategori',$kategori);
      }

      if ($gender == 'pria') {
        $rsData->where('a.pria',1);
      }

      if ($gender == 'wanita') {
        $rsData->where('a.wanita',1);
      }


      if ($budget && $budget_end) {
        $rsData->whereBetween('a.harga', [$budget, $budget_end]);
      }else{
        if ($budget) {
          $rsData->where('a.harga', '>=', $budget);
        }
  
        if ($budget_end) {
          $rsData->where('a.harga', '<=', $budget_end);
        }
      }
      
      
      if ($sort_harga == 'low') {
        $sort_harga = 'asc';
      }else{
        $sort_harga = 'desc';
      }

      // dd($sort_harga);

      $qData = $rsData->orderBy('a.harga', $sort_harga)->paginate(15);

      foreach ($qData as $row) {
        $kategori = DB::table('kado_kategori as a')
        ->select('a.id_kado','b.nama_kategori')
        ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
        ->where('a.id_kado',$row->id)
        ->get();

        $row->kategori = $kategori;

      }

      $data['kado'] = $qData;
      
      return response()->json($data, http_response_code(200));
    }

    public function detailKado(Request $req){


      $id = $req->id;
      $group = $req->group;
      $slug = $req->slug;

      $kado = DB::table('kado as a')
      ->select('a.*','b.nama_group')
      ->leftJoin('kado_groups as b', 'a.id_kado_group', '=', 'b.id')
      ->where('a.id',$id)
      ->where('a.slug', $slug)
      ->first();

      if (!$kado) {
        http_response_code(404);
        exit(json_encode(['message' => 'Kado tidak dapat ditemukan!']));
      }

      $kategori = DB::table('kado_kategori as a')
        ->select('a.id_kado','b.nama_kategori')
        ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
        ->where('a.id_kado',$id)
        ->get();
      
      $lokasi = DB::table('kado_lokasi as a')
      ->select('a.*')
      ->leftJoin('kado as b', 'a.id_kado', '=', 'b.id')
      ->where('a.id_kado',$id)
      ->get();

      $kado->lokasi = $lokasi;
      $kado->kategori = $kategori;

      $foto = DB::table('kado as a')
      ->leftJoin('kado_foto as b', 'a.id', '=', 'b.id_kado')
      ->where('b.id_kado', $id)
      ->get();

      $video = DB::table('kado as a')
      ->leftJoin('kado_videos as b', 'a.id', '=', 'b.id_kado')
      ->where('b.id_kado', $id)
      ->first();

      $relatedProduct = DB::table('kado as a')
      ->select('a.*','b.nama_group')
      ->leftJoin('kado_groups as b', 'a.id_kado_group', '=', 'b.id')
      ->where('a.id_kado_group',$kado->id_kado_group)
      ->where('a.id','<>',$id)
      ->get();


      $data['foto'] = $foto;
      $data['video'] = $video;
      $data['kado'] = $kado;
      $data['related_product'] = $relatedProduct;

        

      return response()->json($data, http_response_code(200));
      
    }

    //
}
