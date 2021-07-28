<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class MasterBlogController extends Controller
{

   public function index(){
     $kategori = DB::table('kategori')
     ->get();

     $data['kategori'] = $kategori;

     return view('admin.master_blog',$data);
   }

   public function addBlog(Request $req){
    $title = $req->title;
    $description = $req->description;
    $slug = $req->slug;
    $kategori = $req->kategori;
    $content = $req->content;
    $keyword = $req->keyword;
    $thumbnail = $req->file('thumbnail');

      $foto = 'img/blog/'.time()."_".$thumbnail->getClientOriginalName();
      // isi dengan nama folder tempat kemana file diupload
      $tujuan_upload = 'img/blog';
      $thumbnail->move($tujuan_upload,$foto);

      DB::table('blog_post')->insert([
        'title' => $title,
        'description' => $description,
        'slug' => $slug,
        'content' => $content,
        'user_id' => Auth::id(),
        'thumbnail' => $foto,
        'category_id' => $kategori,
        'fg_aktif' => 1,
        'keywords' => $keyword,
        'created_at' => \Carbon\Carbon::now(),
      ]);
    
    return redirect()->route('list_blog');
   }

   public function listBlog(){
     return view('admin.master_blog_list');
   }

   public function searchListBlog(Request $req){
      $search_text = $req->search_text;

      $kategori = DB::table('blog_post as a');

      $kategori->where(function($q) use ($search_text) {
        $q->where('a.title','LIKE', '%'.$search_text.'%');
                    // ->orWhere('a.KETERANGAN', 'LIKE', '%'.$search_text.'%')
                    // ->orWhere('a.STATUS', 'LIKE', '%'.$search_text.'%')
                    // ->orWhere('a.APPROVE_AT', 'LIKE', '%'.$search_text.'%');
                });
        
      $qData = $kategori->orderBy('a.id','desc')->paginate(10);
      $data['result'] = $qData;

      return response()->json($data, http_response_code(200));
   }

   public function editBlog(Request $req,$id){

    $blog = DB::table('blog_post as a')
    ->where('a.id',$id)
    ->first();

    $kategori = DB::table('kategori')
     ->get();

     $data['kategori'] = $kategori;
     $data['blog'] = $blog;

     return view('admin.master_blog_edit',$data);
   }

   public function updateBlog(Request $req,$id){
      $title = $req->title;
      $description = $req->description;
      $slug = $req->slug;
      $kategori = $req->kategori;
      $content = $req->content;
      $keyword = $req->keyword;
      $thumbnail = $req->file('thumbnail');

      if ($thumbnail) {
        $foto = 'img/blog/'.time()."_".$thumbnail->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'img/blog';
        $thumbnail->move($tujuan_upload,$foto);

        DB::table('blog_post')
              ->where('id', $id)
              ->update([
                'title' => $title,
                'description' => $description,
                'slug' => $slug,
                'content' => $content,
                'user_id' => Auth::id(),
                'thumbnail' => $foto,
                'category_id' => $kategori,
                'fg_aktif' => 1,
                'keywords' => $keyword,
                'updated_at' => \Carbon\Carbon::now(),
              ]);
      }{
        DB::table('blog_post')
              ->where('id', $id)
              ->update([
                'title' => $title,
                'description' => $description,
                'slug' => $slug,
                'content' => $content,
                'user_id' => Auth::id(),
                'category_id' => $kategori,
                'fg_aktif' => 1,
                'keywords' => $keyword,
                'updated_at' => \Carbon\Carbon::now(),
              ]);
      }

      return redirect()->back();

      

   }

}
