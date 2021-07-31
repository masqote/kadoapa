@extends('layouts.master')

@section('title')
{{ $blog->title }} {{'- '.config('app.name')}}
@endsection

@section('css')

<style>
  img {
    max-width: 100%;
    height: auto !important;
  }

  .banner_ads{
    max-width: 100%;
    height: auto !important;
  }
</style>

<!--  Open Graph Tags -->
<link rel="canonical" href="{{url('blog'.'/'.request()->id.'/'.request()->slug )}}" />
<meta property="og:title" content="{{$blog->title}} {{'- '.config('app.name')}}">
<meta property="og:description" content="{{$blog->description}} {{'- '.config('app.name')}}">
<meta property="og:image" content="{{asset($blog->thumbnail)}}">
<meta property="og:url" content="{{url('blog'.'/'.request()->id.'/'.request()->slug )}}">
<meta property="og:locale" content="id_ID" />
<meta name="twitter:card" content="summary_large_image">

<meta name="description" content="{{$blog->description}} {{'- '.config('app.name')}}">
<meta name="keywords" content="{{$blog->keywords}}">

@endsection

@section('content')
<div class="section">
  <div class="container">
    
    <img class="banner_ads " src="{{asset('img/banner/728x90.gif')}}" alt="custom_html_banner1" style="width:100%">
    
    <div class="text-center mt-4">
      <h2>{{ $blog->title }}</h2>

      <p>{{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }} - {{$blog->name}}</p>
    </div>

      <div class="text-center my-4">
        <img class="rounded-md" src="{{asset($blog->thumbnail)}}" alt="...">
      </div>
      <hr>
    
      <div class="row gap-y">

        <div class="col-md-8 col-xl-9">
          <img class="banner_ads mb-4" src="{{asset('img/banner/728x90.gif')}}" alt="custom_html_banner1" style="width:100%">
          {!! $blog->content !!}
          
          <hr>
          <img class="banner_ads mb-4" src="{{asset('img/banner/728x90.gif')}}" alt="custom_html_banner1" style="width:100%">
          {{-- latest blog/ --}}
          <h3><span>Latest Blog</span></h3>
          
          <div class="row gap-y py-4">
            @foreach($latestBlog as $key => $row)
            <div class="col-xl-6">
              <div class="card text-center text-white bg-img" style="background-image: url({{asset($row->thumbnail)}});">
                <div class="overlay opacity-80" style="background-color: #764ba2"></div>
                <div class="card-body px-6 py-7">
                  <p><a class="text-uppercase small-4 ls-2 fw-600" href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}">
                    @if($row->category_id)
                    Blog {{$row->nama_kategori}}
                    @else
                    Blog
                    @endif
                  </a></p>
                  <h4><a href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}">{{$row->title}}</a></h4>
                  <br>
                  <a class="btn btn-outline-light" href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}">Read Blog</a>
                </div>
              </div>
            </div>
         
            @endforeach
          </div>
         
        </div>

        {{-- //sidebar --}}
        <div class="col-md-4 col-xl-3">
          <div class="sidebar px-4 py-md-0">

            <h6 class="sidebar-title">Search</h6>
            <form class="input-group" action="{{url('/blog')}}" method="GET" target="#">
              <input type="text" class="form-control" name="q"  placeholder="Search">
              <div class="input-group-addon">
                <span class="input-group-text"><i class="ti-search"></i></span>
              </div>
            </form>

            <hr>

            <h6 class="sidebar-title">Baca Juga!</h6>
            @foreach($randomPost as $row)
              <a class="media text-default align-items-center mb-5" href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}">
                <img class="rounded w-65px mr-4" src="{{asset($row->thumbnail)}}" alt="{{$row->title}}">
                <p class="media-body small-2 lh-4 mb-0">{{$row->title}}</p>
              </a>
            @endforeach

          </div>
        </div>

      </div>


  </div>
</div>
@endsection

@section('js')

@endsection

