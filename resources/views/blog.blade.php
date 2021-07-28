@extends('layouts.master')

@section('title')
{{config('app.name')}} Blog - Rekomendasi Kado, Inspirasi Kado
@endsection

@section('header')
<header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
  <div class="container">

    <div class="row">
      <div class="col-md-8 mx-auto">

        <h1>Featured Post</h1>

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
        <img class="mySlides" src="https://i.imgur.com/ZtdhrUA.jpg" alt="custom_html_banner1" style="width:100%">
      </div>

      <div class="col-md-8 col-xl-9">
        <div class="row gap-y">

          <div class="col-md-12">
            <div class="card justify-content-center text-center text-white bg-img h-300" style="background-image: url({{asset($last_blog->thumbnail)}});" data-overlay="6">
              <div class="card-body flex-grow-0 px-md-6 px-xl-8">
                {{-- <p><a class="text-uppercase small-4 ls-2 fw-600" href="#">Marketing</a></p> --}}
                <h2 class="fw-200"><a href="{{url('blog'.'/'.$last_blog->id.'/'.$last_blog->slug)}}">Top 5 brilliant content marketing strategies</a></h2>
                <br>
                <a class="btn btn-outline-light" href="{{url('blog'.'/'.$last_blog->id.'/'.$last_blog->slug)}}">Read more</a>
              </div>
            </div>
          </div>

          @foreach($blog as $row)
            <div class="col-md-6">
              <div class="card border hover-shadow-6 mb-6 d-block">
                <a href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}"><img class="card-img-top" src="{{$row->thumbnail}}" alt="Card image cap" ></a>
                <div class="p-6 text-center">
                  <h5 class="mb-0"><a class="text-dark" href="{{url('blog'.'/'.$row->id.'/'.$row->slug)}}">{{$row->title}}</a></h5>
                </div>
                <div class="card-body">
                  <small><i class="fa fa-clock-o" aria-hidden="true"></i> {{ \Carbon\Carbon::parse($row->created_at)->diffForhumans() }} </small>
                </div>
              </div>
            </div>
          @endforeach

        </div>
        <nav aria-label="Page navigation example">
          {{ $blog->links() }}
        </nav>
      </div>
      



      <div class="col-md-4 col-xl-3">
        <div class="sidebar px-4 py-md-0">

          <h6 class="sidebar-title">Search</h6>
          <form class="input-group" target="#" method="GET">
            <input type="text" class="form-control" name="s" placeholder="Search">
            <div class="input-group-addon">
              <span class="input-group-text"><i class="ti-search"></i></span>
            </div>
          </form>

          <hr>

          <h6 class="sidebar-title">Top posts</h6>
          <a class="media text-default align-items-center mb-5" href="blog-single.html">
            <img class="rounded w-65px mr-4" src="img/thumb/4.jpg">
            <p class="media-body small-2 lh-4 mb-0">Thank to Maryam for joining our team</p>
          </a>

          <a class="media text-default align-items-center mb-5" href="blog-single.html">
            <img class="rounded w-65px mr-4" src="img/thumb/3.jpg">
            <p class="media-body small-2 lh-4 mb-0">Best practices for minimalist design</p>
          </a>

          <a class="media text-default align-items-center mb-5" href="blog-single.html">
            <img class="rounded w-65px mr-4" src="img/thumb/5.jpg">
            <p class="media-body small-2 lh-4 mb-0">New published books for product designers</p>
          </a>

          <a class="media text-default align-items-center mb-5" href="blog-single.html">
            <img class="rounded w-65px mr-4" src="img/thumb/2.jpg">
            <p class="media-body small-2 lh-4 mb-0">Top 5 brilliant content marketing strategies</p>
          </a>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection