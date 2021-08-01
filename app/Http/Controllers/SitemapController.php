<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SitemapController extends Controller
{
    public function index()
    {
        $blog = DB::table('blog_post')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $kado = DB::table('kado')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $kategori = DB::table('kado')
        ->orderBy('created_at', 'DESC')
        ->first();

        $group = DB::table('kado_groups')
        ->orderBy('created_at', 'DESC')
        ->first();

        return response()->view('sitemap.index', [
            'blog' => $blog,
            'kado' => $kado,
            'kategori' => $kategori,
            'kado_group' => $group,
        ])->header('Content-Type', 'text/xml');
    }

    public function blog()
    {
    $blog = DB::table('blog_post')
    ->get();

    return response()->view('sitemap.blog', [
        'blog' => $blog,
    ])->header('Content-Type', 'text/xml');
    }


    public function kado()
    {
        $lastKado = DB::table('kado')
        ->orderBy('updated_at', 'DESC')
        ->first();

        $qData = DB::table('kado as a')
        ->select('a.*','b.nama_group')
        ->leftJoin('kado_groups as b', 'a.id_kado_group', '=', 'b.id')
        ->where('a.fg_aktif',1)
        ->get();
        // dd($qData);
  
        foreach ($qData as $row) {
          $kategori = DB::table('kado_kategori as a')
          ->select('a.id_kado','b.nama_kategori')
          ->leftJoin('kategori as b', 'a.id_kategori', '=', 'b.id')
          ->where('a.id_kado',$row->id)
          ->get();
  
  
          $row->kategori = $kategori;
  
        }

        return response()->view('sitemap.kado', [
            'kado' => $qData,
            'last_kado' => $lastKado,
        ])->header('Content-Type', 'text/xml');
    }

    public function kadoGroup(){
        $group = DB::table('kado_groups as a')
        ->get();

        return response()->view('sitemap.kado_group', [
            'list_group' => $group,
        ])->header('Content-Type', 'text/xml');
    }

    public function kadoKategori(){
        $kategori = DB::table('kategori as a')
        ->get();
        
        return response()->view('sitemap.kado_kategori', [
            'kategori' => $kategori,
        ])->header('Content-Type', 'text/xml');
    }
}
