@extends('layouts.master')

@section('title')
Kado {{ ucwords(str_replace("-", " ", request()->slug)) }} {{'- '.config('app.name')}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">

<link rel="canonical" href="{{url('rekomendasi-kado-'.request()->group.'/'.request()->id.'/'.request()->slug)}}" />


<!--  Open Graph Tags -->
<meta property="og:title" content="Kado {{ ucwords(str_replace("-", " ", request()->slug)) }} {{'- '.config('app.name')}}">
<meta property="og:description" content="Kado {{ ucwords(str_replace("-", " ", request()->slug))}} adalah kado yang cocok untuk @foreach($kado->kategori as $row){{$row->nama_kategori.',' }}@endforeach dan menjadi rekomendasi {{''.config('app.name')}}">
<meta property="og:image" content="{{asset($foto[0]->foto)}}">
<meta property="og:url" content="{{url('rekomendasi-kado-'.request()->group.'/'.request()->id.'/'.request()->slug)}}">
<meta property="og:locale" content="id_ID" />
<meta name="twitter:card" content="summary_large_image">

<meta name="description" content="Kado {{ ucwords(str_replace("-", " ", request()->slug))}} adalah kado yang cocok untuk @foreach($kado->kategori as $row){{$row->nama_kategori.',' }}@endforeach dan menjadi rekomendasi {{''.config('app.name')}}">
<meta name="keywords" content="Kado {{ ucwords(str_replace("-", " ", request()->slug)) }}, Kado {{ ucwords(str_replace("-", " ", request()->group)) }}, @foreach($kado->kategori as $row) {{'Rekomendasi kado '.$row->nama_kategori.','}}@endforeach {{''.config('app.name')}}">


<style>
  .product-price{
    font-weight: bold;
  }
  .owl-carousel .card{
    width: 180px; 
    height:100%;
  }
</style>
@endsection

@section('content')

{{-- <header class="header text-white" style="background-color: #b9a0c9;">
  <div class="container">
    <div class="row">
      <div class="col-md-8">

        <h1 class="display-4" id="judul_kado"></h1>
        <p>Cocok untuk kado orang tersayang anda.</p>
        <div>
          Kategori : 
          <span id="nama_kategori">

          </span>
        </div>
        <div style="margin-top:5px;">
          Gender : 
          <span id="gender">

          </span>
        </div>
        
      </div>
    </div>
  </div>
</header> --}}


<section class="section">
  <div class="container">
    <div class="row" style="margin-bottom:30px;">
      <div class="col-md-8">

        <h1 class="display-4" id="judul_kado">{{$kado->nama_kado}}</h1>
        <p>Cocok untuk kado orang tersayang anda.</p>
        <div>
          Kategori : 
          <span id="nama_kategori">
            @foreach($kado->kategori as $row)
            <span class="badge badge-glass badge-info">{{$row->nama_kategori}}</span>
            @endforeach
          </span>
        </div>
        <div style="margin-top:5px;">
          Gender : 
          <span id="gender">
            @if($kado->pria == 1)
              <span class="badge badge-glass badge-dark" ><i class="fa fa-male" aria-hidden="true"></i> Pria</span>
            @endif
            @if($kado->wanita == 1)
              <span class="badge badge-glass " style="margin-left:5px; color:white; background:pink;"><i class="fa fa-female" aria-hidden="true"></i> Wanita</span>
            @endif
          </span>
        </div>
        
      </div>
    </div>
    <hr>
    <div class="row">

      <div class="col-md-12">
        <img class="banner_ads mb-6" src="{{asset('img/banner/728x90.gif')}}" alt="custom_html_banner1" style="width:100%">
      </div>

      <div class="col-md-7 mr-auto  mb-md-0">

        <ul class="nav nav-tabs-outline nav-separated" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#foto">Foto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#video">Video</a>
          </li>
        </ul>
        
        

        <div class="tab-content p-4">
          <div class="tab-pane fade show active" id="foto">
            <div class="gallery gallery-4-type4" data-provide="photoswipe">
              <a class="gallery-item" href="{{asset($foto[0]->foto)}}">
                <img src="{{asset($foto[0]->foto)}}" alt="Kado {{$kado->nama_kado}}">
              </a>
              <div class="gallery-item-group">
                @foreach($foto as $key => $row)
                  @if($key > 0)
                    @if($key < 4)
                      <a class="gallery-item" href="{{asset($row->foto)}}">
                        @if($key == 3 && count($foto) > 4)
                        <div class="gallery-item-overlay">+{{ count($foto) - 4 }}</div>
                        @endif
                        <img src="{{asset($row->foto)}}" alt="Kado {{$kado->nama_kado}}">
                      </a>
                    @endif
                  @endif
                @endforeach
              </div>
              <div class="gallery-extra-items">
                @foreach($foto as $key => $row)
                  @if($key > 3)
                  <a class="gallery-item" href="{{asset($row->foto)}}">
                    <img src="{{asset($row->foto)}}" alt="Kado {{$kado->nama_kado}}">
                  </a>
                  @endif
                @endforeach
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="video">
            @if($video)
            <div class="video-wrapper rounded-lg">
              <div class="poster" style="background-image: url({{asset($foto[0]->foto)}})"></div>
              <button class="btn btn-circle btn-lg btn-danger"><i class="fa fa-play"></i></button>
              <video src="{{asset($video->video)}}" poster="{{asset($foto[0]->foto)}}" controls></video>
            </div>
            @else
            <div class="alert alert-warning" role="alert">
              Video tidak tersedia.
            </div>
            @endif
          </div>
        </div>
        <hr>

       
      </div>


      <div class="col-md-4">
        <h2 id="nama_kado">{{$kado->nama_kado}}</h2>
        <p style="font-size:20px;">
          <span class="badge badge-glass badge-info" >Rp. <span id="harga_kado">{{number_format($kado->harga)}}</span></span>
        </p>

        <p id="deskripsi_kado">
          {!! $kado->deskripsi !!}
        </p>
        
        <h3 class="divider mt-7">Lokasi Beli</h3>
        <div class="text-center" id="lokasi_kado">
            @foreach($kado->lokasi as $row)
            <a class="btn btn-lg btn-glass btn-round btn-info" href="{{$row->lokasi}}"  rel="nofollow" style="margin-bottom:10px; background:{{$row->background}}; color:{{$row->color}};"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  {{$row->nama_lokasi}}</a>
            @endforeach
        </div>
        <hr>
      </div>
    </div>
    

    

    <div class="row">
      <div class="col-md-12 mr-auto mb-7 mb-md-0">
        <h3>Kado <span id="related">{{$kado->nama_group}}</span> Lainnya</h3>
        @if(count($related_product) > 0)
          <div class="owl-carousel owl-theme" id="related_product">
            
            @foreach($related_product as $row)
              @php
                $group_url = str_replace(" ", "-", $row->nama_group);
                $group_url = strtolower($group_url);
              @endphp
            <a href="{{url('rekomendasi-kado-'.$group_url.'/'.$row->id.'/'.$row->slug.'')}}">
               <div class="card shadow p-1 mb-5 bg-white" style="width:200px;">
                 <div class="card-img-top">
                   <img class="product-card-img initial loaded" src="{{asset($row->thumbnail)}}" data-src="{{$row->thumbnail}}" alt="{{$row->nama_kado}}" height="200" width="200" data-was-processed="true">
                 </div>
                 <div class="card-body">
                   <h6 class="h6 mb-0">
                     {{$row->nama_kado}}
                   </h6>
                   <div class="product-price">Rp. {{number_format($row->harga)}}</div>
                 </div>
               </div>
            </a>
            @endforeach
            @php
              $url_group = str_replace(" ", "-", $kado->nama_group);
              $url_group = strtolower($url_group);
            @endphp
            <a href="{{url('inspirasi-kado-'.$url_group.'')}}" class="btn btn-outline-primary" style="margin-top:50%; margin-left:30px;">
              Lihat semua >>
            </a>
          </div>
        @else
        <div class="alert alert-warning" role="alert">
          Mohon maaf tidak ada yang lain.
        </div>
        @endif
      </div>
    </div>

  </div>
</section>

@endsection

@section('js')
<script src="{{asset('js/owl.carousel.min.js')}}"></script>

<script>

  $(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        autoWidth:true,
        margin:10,
        responsiveClass:true,
        navigation : false,
        dots: false,
        items: 1,
    })
  });


</script>

@endsection