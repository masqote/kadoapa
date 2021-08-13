@extends('layouts.admin')

@section('title')
Master Kategori
@endsection

@section('content')
<div class="site-content" role="main">
  <section class="bg-primary">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="d-flex align-items-center py-3">
            <h2 class="h3 text-white mb-0 mr-auto">Create Blog</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-lg-5">
    <div class="container">
      <form action="{{ url('master/add_blog') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="row">
        <div class="col-lg-9">
          <div class="form-group pb-1">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" onchange="generate_slug();" name="title" required>
          </div>
          <div class="form-group pb-1">
            <label for="title">Slug</label>
            <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug" required>
          </div>
          <div class="form-group pb-1">
            <label for="description">Short Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" required>
          </div>
          <div class="form-group pb-1">
            <label for="description">Keywords</label>
            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter keyword" required>
          </div>
          <div class="form-group ckeditor ckeditor-lg">
            <textarea name="content" id="editor"></textarea>
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
            <input type="file" name="thumbnail" required>
            <div class="image-area mt-4"><img id="imageResult" src="" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
          </div>
          <div class="form-group mb-3">
            <label for="exampleFormControlSelect1">Kategori</label>
            <select class="form-control" name="kategori" id="kategori">
              <option value="">Semua</option>
              @foreach($kategori as $row)
              <option value="{{$row->id}}">{{$row->nama_kategori}}</option>
              @endforeach
            </select>
          </div>
          <hr>
          <div class="form-group mb-3">
            <input type="text" name="search_blog" id="search_blog" onkeyup="searchData()" class="form-control" placeholder="Search Blog">
          </div>

          <div class="form-group mb-3" id="list_blog_seo">
            
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

    $('form input').on('keypress', function(e) {
        return e.which !== 13;
    });
    // ClassicEditor.create(document.querySelector('#editor'));
    CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height: '450px'
        });
  });

  function generate_slug(){
    var title = $('#title').val();
    title = title.replace(/\s+/g, '-').toLowerCase();

    $('#slug').val(title);
    
  }

  function searchData(){
       var search_blog = $('#search_blog').val();
       
        $.ajax({
            type 	: 'POST',
            url: "{{url('/master/search_seo_blog')}}",
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: {
              'search_blog': search_blog,
            },
            success: function( data ) {
              var result = data.result;
              var tbl = '';

              $.each(result,function(x,y){
                  tbl += `
                  <ul>
                    <li class="link">
                      <a href="{{url('/blog/`+y.id+`/`+y.slug+`')}}" target="_blank">`+y.title+` <i class="ya ya-share" aria-hidden="true"></i></a>
                      <button type="button" class="btn btn-primary copy_text" id="copy_text" href="{{url('/blog/`+y.id+`/`+y.slug+`')}}">Copy link</button>
                    </li>
                  </ul>
                  `;
                });


              $('#list_blog_seo').html(tbl);

              $('.copy_text').click(function (e) {
                e.preventDefault();
                var copyText = $(this).attr("href");

                document.addEventListener('copy', function(e) {
                    e.clipboardData.setData('text/plain', copyText);
                    e.preventDefault();
                }, true);

                document.execCommand('copy');  
                console.log('copied text : ', copyText);
                alert('copied text: ' + copyText); 
              });
              
            },
            error : function(xhr) {
            //  closeLoading();
            },
            complete : function(xhr,status){
              // closeLoading();
            }
        });
  }

  

</script>
@endsection