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
<meta property="og:title" content="{{$blog->title}} {{'- '.config('app.name')}}">
<meta property="og:description" content="Kado">
<meta property="og:image" content="https://masqote.github.io/medhy/assets/img/thumb/Capture.PNG">
<meta property="og:url" content="{{url('blog'.'/'.request()->id.'/'.request()->slug )}}">
<meta property="og:locale" content="id_ID" />
<meta name="twitter:card" content="summary_large_image">

<meta name="description" content="{{$blog->description}} {{'- '.config('app.name')}}">
<meta name="keywords" content="{{$blog->keywords}}">

@endsection

@section('content')
<div class="section">
  <div class="container">
    
    <img class="banner_ads" src="https://i.imgur.com/ZtdhrUA.jpg" alt="custom_html_banner1" style="width:100%">
    
    <div class="text-center mt-8">
      <h2>{{ $blog->title }}</h2>
      <p>{{ \Carbon\Carbon::parse($blog->created_at)->diffForhumans() }} - Medhy Pradana</p>
    </div>


    <div class="text-center my-8">
      <img class="rounded-md" src="{{asset($blog->thumbnail)}}" alt="...">
    </div>


    {!! $blog->content !!}


  </div>
</div>
@endsection

@section('js')

@endsection

