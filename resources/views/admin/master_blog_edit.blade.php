@extends('layouts.admin')

@section('title')
Edit - {{$blog->title}}
@endsection

@section('content')
<div class="site-content" role="main">
  <section class="bg-primary">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="d-flex align-items-center py-3">
            <h2 class="h3 text-white mb-0 mr-auto">Edit Blog - {{$blog->title}}</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-lg-5">
    <div class="container">
      <form action="{{ url('master/update_blog/'.$blog->id.'')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="row">
        <div class="col-lg-9">
          <div class="form-group pb-1">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{$blog->title}}" required>
          </div>
          <div class="form-group pb-1">
            <label for="title">Slug</label>
            <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug" value="{{$blog->slug}}" required>
          </div>
          <div class="form-group pb-1">
            <label for="description">Short Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="{{$blog->description}}" required>
          </div>
          <div class="form-group pb-1">
            <label for="description">Keywords</label>
            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter keyword" value="{{$blog->keywords}}" required>
          </div>
          <div class="form-group ckeditor ckeditor-lg">
            <textarea name="content" id="editor">
              {{$blog->content}}
            </textarea>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="row row-md mb-3">
            {{-- <div class="col-6">
              <button type="button" class="btn btn-outline btn-block">Preview</button>
            </div> --}}
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Publish...</button>
            </div>
          </div>
          <div class="form-group mb-3">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail">
            <div class="image-area mt-4"><img id="imageResult" src="{{asset($blog->thumbnail)}}" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlSelect1">Kategori</label>
            <select class="form-control" name="kategori" id="kategori">
              <option value="">Semua</option>
              @foreach($kategori as $row)
              <option value="{{$row->id}}" {{$blog->category_id == $row->id  ? 'selected' : ''}}>{{$row->nama_kategori}}</option>
              @endforeach
            </select>
          </div>
          
        </div>
      </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js')
{{-- <script src="{{asset('plugin/ckeditor/ckeditor.js')}}"></script> --}}
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
  $(document).ready(function(){
    // ClassicEditor.create(document.querySelector('#editor'));
    CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height: '450px'
        });
  });

</script>
@endsection