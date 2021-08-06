@extends('layouts.master')

@section('title')
{{config('app.name')}} Blog - Rekomendasi Kado, Inspirasi Kado
@endsection

@section('css')
    <link rel="canonical" href="{{url('/blog')}}" />
    <meta property="og:title" content="{{config('app.name')}} Blog - Rekomendasi Kado, Inspirasi Kado">
    <meta property="og:description" content="Dapatkan berbagai rekomendasi kado hanya untuk orang tersayang anda! {{'- '.config('app.name')}}">
    <meta property="og:image" content="{{asset('img/default/gift-1.jpg')}}">
    <meta property="og:url" content="{{url('/blog')}}">
    <meta property="og:locale" content="id_ID" />
    <meta name="twitter:card" content="summary_large_image">

    <meta name="description" content="Dapatkan berbagai rekomendasi kado, hanya untuk orang tersayang anda! {{'- '.config('app.name')}}">
    <meta name="keywords" content="Blog tentang kado, Rekomendasi kado, Inspirasi Kado">
@endsection

@section('header')
<header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #8b98fc 48%,  #764ba2 100%);">
  <div class="container">

    <div class="row">
      <div class="col-md-8 mx-auto">

        @if(!$q)
        <h1>Featured Post</h1>
        @else
        <h1>Hasil pencarian : {{$q}}</h1>
        @endif
        

      </div>
    </div>

  </div>
</header>
@endsection

@section('content')

<div class="section bg-gray" >
  <div class="container" style="margin-top:-60px;">
    <div class="row gap-y">
      <div class="col-md-12">
        <img class="banner_ads" src="{{asset('img/banner/728x90.gif')}}" alt="custom_html_banner1" style="width:100%">
      </div>

      <div class="col-md-8 col-xl-9">
        <div class="row gap-y">

          @if(!$q)
          <div class="col-md-12">
            <div class="card justify-content-center text-center text-white bg-img h-300" style="background-image: url({{asset($last_blog->thumbnail)}});" data-overlay="6">
              <div class="card-body flex-grow-0 px-md-6 px-xl-8">
                {{-- <p><a class="text-uppercase small-4 ls-2 fw-600" href="#">Marketing</a></p> --}}
                <h2 class="fw-200"><a href="{{url('blog'.'/'.$last_blog->id.'/'.$last_blog->slug)}}">{{$last_blog->title}}</a></h2>
                <br>
                <a class="btn btn-outline-light" href="{{url('blog'.'/'.$last_blog->id.'/'.$last_blog->slug)}}">Read Blog</a>
              </div>
            </div>
          </div>
          @endif

          @if($blog->total() > 0)
            @foreach($blog as $key => $row)
            @if($q)
              <div class="col-md-6">
                <div class="card border hover-shadow-6 mb-6 d-block">
                  <a href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}"><img class="card-img-top" src="{{$row->thumbnail}}" alt="{{$row->title}}" style=" max-height: 250px;
                    object-fit: cover;
                    object-position: center;"></a>
                  <div class="p-6 text-center">
                    <h5 class="mb-0"><a class="text-dark" href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}">{{$row->title}}</a></h5>
                  </div>
                  <div class="card-body">
                    <small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($row->created_at)->diffForhumans() }} </small>
                  </div>
                </div>
              </div>
            @else
              @if($row->id != $last_blog->id)
                <div class="col-md-6">
                  <div class="card border hover-shadow-6 mb-6 d-block">
                    <a href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}"><img class="card-img-top" src="{{$row->thumbnail}}" alt="Card image cap" style=" max-height: 250px;
                      object-fit: cover;
                      object-position: center;"></a>
                    <div class="p-6 text-center">
                      <h5 class="mb-0"><a class="text-dark" href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}">{{$row->title}}</a></h5>
                    </div>
                    <div class="card-body">
                      <small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($row->created_at)->diffForhumans() }} </small>
                    </div>
                  </div>
                </div>
              @endif
            @endif
            
            @endforeach
          @else
            <h2>Pencarian tidak ditemukan...</h2>
          @endif

        </div>
        <nav aria-label="Page navigation example">
          {{ $blog->links() }}
        </nav>
      </div>
      



      <div class="col-md-4 col-xl-3">
        <div class="sidebar px-4 py-md-0">

          <h6 class="sidebar-title">Search</h6>
          <form class="input-group" action="{{url('/blog')}}" method="GET" target="#">
            <input type="text" class="form-control" name="q" value="{{ $q }}" placeholder="Search">
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