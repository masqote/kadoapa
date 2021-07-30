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

        return response()->view('sitemap.index', [
            'blog' => $blog,
            'kado' => $kado,
            'kategori' => $kategori,
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

        $group = DB::table('kado_groups as a')
        ->get();
// dd($qData);
    return response()->view('sitemap.kado', [
        'kado' => $qData,
        'last_kado' => $lastKado,
        'list_group' => $group,
    ])->header('Content-Type', 'text/xml');
    }
}
