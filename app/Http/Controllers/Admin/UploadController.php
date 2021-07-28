<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class UploadController extends Controller
{

  public function upload(Request $request)
  {
      if($request->hasFile('upload')) {
          $originName = $request->file('upload')->getClientOriginalName();
          $fileName = pathinfo($originName, PATHINFO_FILENAME);
          $extension = $request->file('upload')->getClientOriginalExtension();
          $fileName = $fileName.'_'.time().'.'.$extension;
       
          $request->file('upload')->move(public_path('img/blog'), $fileName);
  
          $CKEditorFuncNum = $request->input('CKEditorFuncNum');
          $url = asset('img/blog/'.$fileName); 
          $msg = 'Image uploaded successfully'; 
          $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
              
          @header('Content-type: text/html; charset=utf-8'); 
          echo $response;
      }
  }

}
