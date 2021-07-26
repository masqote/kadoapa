@extends('layouts.master')

@section('title')
Rekomendasi kado {{ request()->group }}
@endsection

@section('css')
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
    <hr>
    <div class="row">

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
            <div class="gallery gallery-4-type2" data-provide="photoswipe" id="foto_kado_1">
              

            </div>
          </div>

          <div class="tab-pane fade" id="video">

            
          </div>
        </div>
        <hr>

       
      </div>


      <div class="col-md-4">
        <h2 id="nama_kado"> </h2>
        <p style="font-size:20px;">
          <span class="badge badge-glass badge-success" >Rp. <span id="harga_kado"></span></span>
        </p>

        <p id="deskripsi_kado">Built-in GPS. Water resistance to 50 meters.1 A lightning-fast dual‑core processor. And a display that’s two times brighter than before. Full of features that help you stay active.</p>
        
        <h3 class="divider mt-7">Lokasi Beli</h3>
        <div class="text-center" id="lokasi_kado">
          
        </div>
      </div>
    </div>
    <hr>

    

    <div class="row">
      <div class="col-md-12 mr-auto mb-7 mb-md-0">
        <h3>Kado <span id="related"></span> Lainnya</h3>
          <div class="owl-carousel owl-theme" id="related_product">

            

          </div>
        
      </div>
    </div>

  </div>
</section>

@endsection

@section('js')

<script>
  var url_group = '{!! request()->group !!}'; 
  var url_id = '{!! request()->id !!}';
  var url_slug = '{!! request()->slug !!}';

  $(document).ready(function(){
    detail_kado();
    
  });

  function detail_kado(){
    showLoading();
    // <option value="">Semua</option>
    $.ajax({
        type 	: 'POST',
        url: "{{url('/detail_kado')}}"+'/'+url_id+'/'+url_slug,
        headers	: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        dataType: "json",
        data:{
          'id': url_id,
          'group': url_group,
          'slug': url_slug
        },
        success: function( data ) {
          var kategori = '';
          var gender = '';
          var foto_kado_1 = '';
          var foto_kado_2 = '';
          var video_kado = '';
          var lokasi_kado = '';
          var related = '';

          kado = data.kado;
          foto = data.foto;
          video = data.video;
          related_product = data.related_product;
          

          $('#judul_kado').html(kado.nama_kado);

          if (kado.pria == 1) {
            gender +=  `<span class="badge badge-glass badge-dark" ><i class="fa fa-male" aria-hidden="true"></i> Pria</span>`;
          }

          if (kado.wanita == 1) {
            gender +=  `<span class="badge badge-glass " style="margin-left:5px; color:white; background:pink;"><i class="fa fa-female" aria-hidden="true"></i> Wanita</span>`;
          }

          $.each(kado.kategori,function(x,y){
            kategori += `
              <span class="badge badge-glass badge-primary">`+y.nama_kategori+`</span>
            `;
          });

          if (foto.length > 0) {
            
              $.each(foto,function(a,b){
                
                  foto_kado_1 += `
                  <a class="gallery-item" href="`+b.foto+`">
                    <img src="`+b.foto+`" alt="`+b.nama_kado+`" style="max-height:300px;">
                  </a>
                  `;

              });
              
          }else{
            foto_kado_1 += `<div class="alert alert-warning" role="alert">
                Foto tidak tersedia.
              </div>`
          }
          
          if (video) {
            video_kado += `
            <div class="col-md-8 mx-auto">
              <div class="video-btn-wrapper aos-init aos-animate" data-aos="fade-up">
                <img class="shadow-2 rounded-lg" src="`+video.thumbnail+`" alt="watch a video">
                <a class="btn btn-circle btn-xl btn-info" href="`+video.video+`" data-provide="lightbox"><i class="fa fa-play"></i></a>
              </div>

              </div>
            `;
          }else{
            video_kado += `<div class="alert alert-warning" role="alert">
                Video tidak tersedia.
              </div>`
          }
          
          if (kado.lokasi.length > 0) {
            $.each(kado.lokasi,function(x,y){
              lokasi_kado += `
              <a class="btn btn-lg btn-glass btn-round btn-info" href="`+y.lokasi+`" style="margin-bottom:10px; background:`+y.background+`; color:`+y.color+`;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> `+y.nama_lokasi+`</a>
              `;
            });
          }

          if (related_product.length > 0) {

            $.each(related_product,function(x,y){
              nama_group = y.nama_group.replace(/\s+/g, '-').toLowerCase();
              related += `
                <a href="{{url('rekomendasi-kado-`+nama_group+`/`+y.id+`/`+y.slug+`')}}">
                  <div class="card shadow p-3 mb-5 bg-white" >
                    <div class="card-img-top">
                      <img class="product-card-img initial loaded" src="{{asset('`+y.thumbnail+`')}}" data-src="`+y.thumbnail+`" alt="`+y.nama_kado+` height="200" width="200" data-was-processed="true">
                    </div>
                    <div class="card-body">
                      <h5 class="h5 mb-0">
                        `+y.nama_kado+`
                      </h5>
                      <div class="product-price">Rp. `+set_currency(y.harga)+`</div>
                    </div>
                  </div>
                </a>
              `;
            });

            related += `
            <button type="button" class="btn btn-outline-primary" style="margin-top:50%; margin-left:30px;">
               Lihat semua >>
            </button>
            `;

          }
          
         
          $('#nama_kategori').html(kategori);
          $('#gender').html(gender);
          // $('#foto_kado_2').append(foto_kado_2);
          $('#foto_kado_1').append(foto_kado_1);
          $('#video').html(video_kado);

          $('[data-provide="photoswipe"]').photoSwipe();

          $('#nama_kado').text(kado.nama_kado);
          $('#harga_kado').text(set_currency(kado.harga));
          $('#deskripsi_kado').html(kado.deskripsi);
          $('#lokasi_kado').html(lokasi_kado);
          $('#related').text(kado.nama_group);
          $('#related_product').html(related);

          $('.owl-carousel').owlCarousel({
              autoWidth:true,
              margin:10,
              responsiveClass:true,
              navigation : false,
              dots: false,
              items: 1,
              
          })
          
        },
        error : function(xhr) {
          read_error(xhr);
          closeLoading();
        },
        complete : function(xhr,status){
          closeLoading();
        }
    });
  }

</script>

@endsection