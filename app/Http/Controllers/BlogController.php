<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Carbon;

class BlogController extends Controller
{

    public function index(Request $req){
      $q = $req->q;
      // dd($q);
      $blog = DB::table('blog_post as a')
      ->where('a.title','like',"%$q%")
      ->orWhere('a.description', 'LIKE', "%$q%")
      ->orWhere('a.content', 'LIKE', "%$q%")
      ->orderBy('a.id','desc')
      ->paginate(10);
      

      $lastBlog = DB::table('blog_post as a')
      ->orderBy('a.id','desc')
      ->first();

      $randomPost = DB::table('blog_post as a')
      ->inRandomOrder()->limit(5)->get();

      $data['blog'] = $blog;
      $data['last_blog'] = $lastBlog;
      $data['randomPost'] = $randomPost;
      $data['q'] = $q;
      // dd($data['blog']);

      return view('blog',$data);
    }

    public function detailBlog(Request $req,$id,$slug){

      $blog = DB::table('blog_post as a')
      ->select('a.*','b.name')
      ->leftJoin('users as b', 'a.user_id', '=', 'b.id')
      ->where('a.id',$id)
      ->where('a.slug',$slug)
      ->first();
      // dd($blog);

      $randomPost = DB::table('blog_post as a')
      ->inRandomOrder()->limit(5)->get();

      $latestBlog = DB::table('blog_post as a')
      ->select('a.*','b.nama_kategori')
      ->leftJoin('kategori as b', 'a.category_id', '=', 'b.id')
      ->where('a.id','<>',$id)
      ->orderBy('a.id','desc')
      ->limit(4)
      ->get();

      $data['blog'] = $blog;
      $data['randomPost'] = $randomPost;
      $data['latestBlog'] = $latestBlog;
      return view('detail_blog',$data);
    }

}