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

  .product-price{
    font-weight: bold;
  }
  .owl-carousel .card{
    width: 180px; 
    height:100%;
  }
  
  .share_button{
    position: fixed;
    width: 55px;
    height: 55px;
    bottom: 80px;
    right: 30px;
    background-color:#F33;
    color:#FFF;
    border-radius:50px;
    text-align:center;
    /* box-shadow: 2px 2px 3px #999; */
    z-index:1000;
    /* animation: bot-to-top 2s ease-out; */
  }


  .btn-share-1{
    position:fixed;
    right:30px;
    padding-bottom:20px;
    bottom:100px;
    z-index:100;
  }

  .btn-share-2{
    list-style:none;
    margin-bottom:10px;
  }

  .btn-share-1 .btn-share-2 a{
    background-color:#F33;
    color:#FFF;
    border-radius:50px;
    text-align:center;
    /* box-shadow: 2px 2px 3px #999; */
    width:55px;
    height:55px;
    display:block;
  }

  .btn-share-1:hover{
    visibility:visible!important;
    opacity:1!important;
  }


  .my-float{
    font-size:24px;
    margin-top:15px;
  }

  a#menu-share + ul{
    visibility: hidden;
  }

  a#menu-share:hover + ul{
    visibility: visible;
    animation: scale-in 0.5s;
  }

  a#menu-share i{
    animation: rotate-in 0.5s;
  }

  a#menu-share:hover > i{
    animation: rotate-out 0.5s;
  }

  @keyframes bot-to-top {
      0%   {bottom:-40px}
      50%  {bottom:40px}
  }

  @keyframes scale-in {
      from {transform: scale(0);opacity: 0;}
      to {transform: scale(1);opacity: 1;}
  }

  @keyframes rotate-in {
      from {transform: rotate(0deg);}
      to {transform: rotate(360deg);}
  }

  @keyframes rotate-out {
      from {transform: rotate(360deg);}
      to {transform: rotate(0deg);}
  }

  @media (max-width: 991.98px) {
    .share_button{
      right: 15px;
    }

    .btn-share-1{
      right: 15px;
    }
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
<a href="#" class="share_button" id="menu-share" data-toggle="tooltip" data-placement="left" title="Thanks for share :)">
  <i class="fa fa-share-alt my-float"></i>
  </a>
  <ul class="btn-share-1">
  <li class="btn-share-2"><a href="https://api.whatsapp.com/send?text=Kado {{$blog->title}} {{Request::url()}}">
  <i class="fa fa-whatsapp my-float"></i>
  </a></li>
  <li class="btn-share-2"><a href="https://www.facebook.com/sharer.php?u={{Request::url()}}">
  <i class="fa fa-facebook my-float"></i>
  </a></li>
  <li class="btn-share-2"><a href="https://twitter.com/share?url={{Request::url()}}&text={{$blog->title}}">
  <i class="fa fa-twitter my-float"></i>
  </a></li>
  </ul>

<div class="section">
  <div class="container">
    
    <img class="banner_ads " src="{{asset('img/banner/728x90.gif')}}" alt="custom_html_banner1" style="width:100%">
    
    <div class="text-center mt-4">
      <h2>{{ $blog->title }}</h2>

      <p>{{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }} - {{$blog->name}}</p>
    </div>

      <div class="text-center my-4">
        <img class="rounded-md" src="{{asset($blog->thumbnail)}}" alt="...">
        <span class="header"></span>
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

