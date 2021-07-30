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
      ->select('a.id','a.nama_kado','a.harga','a.pria','a.wanita','a.umur','a.deskripsi','a.created_at','a.slug','b.nama_group','x.foto as foto_thumbnail')
      ->leftJoin('kado_groups as b', 'a.id_kado_group', '=', 'b.id')
      ->leftJoin('kado_foto as x', 'a.thumbnail', '=', 'x.id')
      ->where('a.fg_aktif',1)
      ->where('x.fg_aktif',1);

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

      $qData = $rsData->orderBy('a.harga', $sort_harga)->paginate(10);

      foreach ($qData as $row) {
        $kategori = DB::table('kado_kategori as a')
        ->select('a.id_kado','b.nama_kategori')
        ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
        ->where('a.id_kado',$row->id)
        ->get();

        $jumlah_foto = DB::table('kado_foto as a')
        ->select('a.*')
        ->where('a.id_kado',$row->id)
        ->where('a.fg_aktif',1)
        ->count();

        $row->kategori = $kategori;
        $row->jumlah_foto = $jumlah_foto;

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

      $foto = DB::table('kado_foto as a')
      ->select('a.*','b.thumbnail','b.nama_kado')
      ->leftJoin('kado as b', 'a.id', '=', 'b.thumbnail')
      ->where('a.id_kado',$id)
      ->where('a.fg_aktif',1)
      ->get();


      $video = DB::table('kado as a')
      ->leftJoin('kado_videos as b', 'a.id', '=', 'b.id_kado')
      ->leftJoin('kado_foto as c', 'a.thumbnail', '=', 'c.id')
      ->where('b.id_kado', $id)
      ->where('b.fg_aktif',1)
      ->first();

      $relatedProduct = DB::table('kado as a')
      ->select('a.*','b.nama_group','c.foto as thumbnail')
      ->leftJoin('kado_groups as b', 'a.id_kado_group', '=', 'b.id')
      ->leftJoin('kado_foto as c', 'a.thumbnail', '=', 'c.id')
      ->where('a.id_kado_group',$kado->id_kado_group)
      ->where('a.id','<>',$id)
      
      ->get();

      $data['foto'] = $foto;
      $data['video'] = $video;
      $data['kado'] = $kado;
      $data['related_product'] = $relatedProduct;


      // dd($data['group']);
      
      return response()->json($data, http_response_code(200));
      
    }

    public function relatedKado($group){
      $groupReplace = str_replace("-", " ", $group);
      
      $qGroup = DB::table('kado_groups as a')
      ->where('a.nama_group',$groupReplace)
      ->first();
      
      $qData = DB::table('kado as a')
      ->select('a.*','x.foto as thumbnail')
      ->leftJoin('kado_foto as x', 'a.thumbnail', '=', 'x.id')
      ->where('a.id_kado_group',$qGroup->id)
      ->where('a.fg_aktif',1)
      ->where('x.fg_aktif',1)
      ->paginate(10);
      // dd($qData);

      foreach ($qData as $row) {
        $kategori = DB::table('kado_kategori as a')
        ->select('a.id_kado','b.nama_kategori')
        ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
        ->where('a.id_kado',$row->id)
        ->get();

        $jumlah_foto = DB::table('kado_foto as a')
        ->select('a.*')
        ->where('a.id_kado',$row->id)
        ->where('a.fg_aktif',1)
        ->count();

        $row->kategori = $kategori;
        $row->jumlah_foto = $jumlah_foto;

      }

      $data['result'] = $qData;
      $data['group'] = $qGroup;
      $data['url_group'] = $group;

      return view('related_kado', $data);
    }

    public function searchRelatedKado(Request $req){
      $budget = $req->budget;
      $budget_end = $req->budget_end;
      $sort_harga = $req->sort_harga;
      $nama_group = $req->nama_group;
      // dd($budget);

      if ($budget) {
        $budget = intval(preg_replace('/[^\d.]/', '', $budget));
      }

      if ($budget_end) {
        $budget_end = intval(preg_replace('/[^\d.]/', '', $budget_end));
      }

      $qGroup = DB::table('kado_groups as a')
      ->where('a.nama_group',$nama_group)
      ->first();

      $rsData = DB::table('kado as a')
      ->select('a.id','a.nama_kado','a.harga','a.pria','a.wanita','a.umur','a.deskripsi','a.created_at','a.slug','b.nama_group','x.foto as foto_thumbnail')
      ->leftJoin('kado_groups as b', 'a.id_kado_group', '=', 'b.id')
      ->leftJoin('kado_foto as x', 'a.thumbnail', '=', 'x.id')
      ->where('a.id_kado_group',$qGroup->id)
      ->where('a.fg_aktif',1)
      ->where('x.fg_aktif',1);


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

      $qData = $rsData->orderBy('a.harga', $sort_harga)->paginate(10);

      foreach ($qData as $row) {
        $kategori = DB::table('kado_kategori as a')
        ->select('a.id_kado','b.nama_kategori')
        ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
        ->where('a.id_kado',$row->id)
        ->get();

        $jumlah_foto = DB::table('kado_foto as a')
        ->select('a.*')
        ->where('a.id_kado',$row->id)
        ->where('a.fg_aktif',1)
        ->count();

        $row->kategori = $kategori;
        $row->jumlah_foto = $jumlah_foto;

      }

      $data['kado'] = $qData;
      
      return response()->json($data, http_response_code(200));
    }

    //
}
