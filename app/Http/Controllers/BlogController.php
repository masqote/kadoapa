<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class BlogController extends Controller
{

    public function index(){
      $blog = DB::table('blog_post as a')
      ->paginate(1);

      $lastBlog = DB::table('blog_post as a')
      ->orderBy('a.id','desc')
      ->first();

      $data['blog'] = $blog;
      $data['last_blog'] = $lastBlog;
      // dd($data['blog']);

      return view('blog',$data);
    }

    public function detailBlog(Request $req,$id,$slug){
      $blog = DB::table('blog_post as a')
      ->where('id',$id)
      ->where('slug',$slug)
      ->first();

      $data['blog'] = $blog;

      return view('detail_blog',$data);
    }

}