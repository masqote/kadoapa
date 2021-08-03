@extends('layouts.master')

@section('title')
Kado Untuk {{$kategori->nama_kategori}} {{'- '.config('app.name')}}
@endsection

@section('css')
    <link rel="canonical" href="{{url('/kado-untuk-'.$url_kategori.'')}}" />
    <meta property="og:title" content="Kado Untuk {{$kategori->nama_kategori}} {{'- '.config('app.name')}}">
    <meta property="og:description" content="Lagi cari kado untuk apa ? Pernikahan, Anniversary, Persalinan, Wisuda, Orang Tua Ataupun Untuk Anak, Temukan Inspirasi Kado di {{''.config('app.name')}}">
    <meta property="og:image" content="{{asset('img/default/gift-1.jpg')}}">
    <meta property="og:url" content="{{url('/kado-untuk-'.$url_kategori.'')}}">
    <meta property="og:locale" content="id_ID" />
    <meta name="twitter:card" content="summary_large_image">

    <meta name="description" content="Lagi cari kado untuk apa ? Pernikahan, Anniversary, Persalinan, Wisuda, Orang Tua Ataupun Untuk Anak, Temukan Inspirasi Kado di {{''.config('app.name')}}">
    <meta name="keywords" content="kado untuk {{$kategori->nama_kategori}}, Kado {{$kategori->nama_kategori}} yang berkesan, Kado {{$kategori->nama_kategori}} yang unik, Kado {{$kategori->nama_kategori}} terbaik, kado {{$kategori->nama_kategori}} yang bermanfaat">
@endsection

@section('header')
<header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #8b98fc 48%,  #764ba2 100%);">
  <div class="container">

    <div class="row">
      <div class="col-md-8 mx-auto">

       <h1>Kado Untuk <span id="nama_kategori">{{$kategori->nama_kategori}}</span></h1>
        

      </div>
    </div>

  </div>
</header>
@endsection

@section('content')

<div class="section bg-gray" >
  <div class="container" style="margin-top:-60px;">

      <div class="col-md-12 mb-2">
        <img class="banner_ads" src="{{asset('img/banner/728x90.gif')}}" alt="custom_html_banner1" style="width:100%">
      </div>

      <div class="col-12" > 
        <div class="form-group">
          <h5 class="nav justify-content-center mb-2">Tentukan Budget Sendiri</h5>
          <div class="input-group">
            <div class="input-group-append">
              <span class="input-group-text">Rp. </span>
            </div>
            <input type="text" id="budget" name="budget" class="form-control form-control-sm" placeholder="Start" autocomplete="off">
            <div class="input-group-append">
              <span class="input-group-text" style="background-color:#c9ccce; color:white; font-weight:700;">~</span>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">Rp. </span>
            </div>
            <input type="text" id="budget_end" name="budget_end" class="form-control form-control-sm" placeholder="To" autocomplete="off">
          </div>
        </div>
      </div>

      <div class="col-12 mb-4" >
        <h5 class="nav justify-content-center mb-2">Filter</h5> 
        <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="nav justify-content-center mb-2">Kategori</label>
                <select name="group" class="form-control" id="group">
                  <option value="">Semua</option>
                  @foreach($group as $row)
                    <option value="{{$row->id}}">{{$row->nama_group}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label class="nav justify-content-center mb-2">Harga</label>
                <select class="form-control form-control-sm" style="color:black;" id="sort_harga">
                  <option value="low">Harga terendah</option>
                  <option value="high">Harga tertinggi</option>
                </select>
              </div>
            </div>
        </div>
      </div>

      <div class="row gap-y gap-2" id="data_box">
        @foreach($result as $row)
          @php
            $url_kategori = str_replace(" ", "-", $row->nama_group);
            $url_kategori = strtolower($url_kategori);
          @endphp
          <div class="col-12 col-lg-4 col-md-6" > 
            <input type="hidden" id="nama_group" value="{{$url_kategori}}">
            <a href="{{url('rekomendasi-kado-'.$url_kategori.'/'.$row->id.'/'.$row->slug)}}">
              <div class="card d-block shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-img-top">
                  <img src="{{asset($row->thumbnail)}}"  alt="Card image cap">
                  <div class="badges">
                    @foreach($row->kategori as $kategori)
                      <span class="badge badge-glass badge-info" style="margin-right:5px;">{{$kategori->nama_kategori}}</span>
                    @endforeach
                  </div>
                </div>

                <div class="card-body">
                  <h6 class="mb-0" style="font-weight:700;">{{$row->nama_kado}}</h6>
                  <span class="lead-1 text-primary" style="font-weight:500;">Rp. {{number_format($row->harga)}}</span>
                  <br>
                  <small style="color:grey; float:right; "><i class="fa fa-picture-o" aria-hidden="true"></i> {{$row->jumlah_foto}} Images</small>
                  <small style="float:left; ">
                    @if($row->pria == 1)
                      <span class="badge badge-glass badge-dark" ><i class="fa fa-male" aria-hidden="true"></i> Pria</span>
                    @endif
                    @if($row->wanita == 1)
                    <span class="badge badge-glass " style="margin-left:5px; color:white; background:pink;"><i class="fa fa-female" aria-hidden="true"></i> Wanita</span>
                    @endif
                  </small>
                  <br>
                </div>
              </div>
            </a>
          </div>
        
        @endforeach
      </div>

      <div class="text-center" style="margin-top:100px;">
        @if($result->total() > $result->perPage())
        <button type="button" class="btn btn-outline-primary" id="view_more">View More..</button>
        @else
        <p >Sudah semua :)</p>
        @endif
        <p id="sudah_semua">Sudah semua :)</p>
        
      </div>

    </div>
  
</div>

@endsection

@section('js')
<script>

$(document).ready(function(){
  $("#sudah_semua").hide();
    var page = 1;

    $("#view_more").click(function() { // function untuk melakukan klik view more
      page++;
      var more = 1;
      searchData(page,more);
    });
    

  $('#budget').on('click keyup input paste',(function (event) { // untuk mengubah format number menjadi otomatis 3 digit ,
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
  }));

  $('#budget_end').on('click keyup input paste',(function (event) { // untuk mengubah format number menjadi otomatis 3 digit ,
    $(this).val(function (index, value) {
        return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
  }));

  $('#budget_end, #budget').on('change',(function (event) { // untuk mengubah format number menjadi otomatis 3 digit ,
    page = 1;
    validate_price(page);
  }));

  $('#sort_harga').change(function() { // function untuk melakukan filter harga
      page = 1;
      searchData(page);
    });
  
  $('#group').change(function() { // function untuk melakukan filter harga
      page = 1;
      searchData(page);
    });

});

function validate_price(page){
        var from = $('#budget').val().replace(/,/g, '');
        var to =  $('#budget_end').val().replace(/,/g, '');
          if(parseInt(from) > parseInt(to)){
            $('#budget_end').val('');
            alert_msg('Error','Harga akhir harus lebih kecil dari harga awal!',405);
            
          }else{
            searchData(page)
          }
          
          
}

function searchData(page,more){
  
  showLoading();
  var budget = $('[name="budget"]').val();
  var budget_end = $('[name="budget_end"]').val();
  var sort_harga = $('#sort_harga').val();
  var nama_group = $('#nama_group').val();
  var nama_kategori = $('#nama_kategori').text();
  var id_group = $('#group').val();

  $.ajax({
      type 	: 'POST',
      url: "{{url('/search_kado_untuk?page=')}}" + page,
      headers	: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
      dataType: "json",
      data: {
        'nama_group': nama_group,
        'nama_kategori': nama_kategori,
        'budget': budget,
        'budget_end': budget_end,
        'sort_harga': sort_harga,
        'id_group': id_group,
      },
      success: function( data ) {
        
        var tbl = '';
        var kado = data.kado.data;
       
        var thumbnail = "{{asset('img/default/gift-1.jpg')}}";
      
        if(kado.length > 0){

          if (page == data.kado.last_page) {
            $("#view_more").hide();
            $("#sudah_semua").show();
          }else{
            $("#view_more").show();
            $("#sudah_semua").hide();
          }

          
          $.each(kado,function(x,y){
            var kategori = '';
            var gender = '';

            if (y.foto_thumbnail == null) {
              y.foto_thumbnail = thumbnail;
            }

            if (y.kategori.length > 0) {
              $.each(y.kategori,function(a,b){
                kategori += `<span class="badge badge-glass badge-info" style="margin-right:5px;">`+b.nama_kategori+`</span>`;
              });
            }

            if (y.pria == 1) {
              gender +=  `<span class="badge badge-glass badge-dark" ><i class="fa fa-male" aria-hidden="true"></i> Pria</span>`;
            }

            if (y.wanita == 1) {
              gender +=  `<span class="badge badge-glass " style="margin-left:5px; color:white; background:pink;"><i class="fa fa-female" aria-hidden="true"></i> Wanita</span>`;
            }
            
            nama_group = y.nama_group.replace(/\s+/g, '-').toLowerCase();

            tbl += `
            
              <div class="col-12 col-lg-4 col-md-6" >
                
                <a href="{{url('rekomendasi-kado-`+nama_group+`/`+y.id+`/`+y.slug+`')}}" target="_blank">
                  <div class="card d-block shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-img-top">
                      <img src="{{asset('`+y.foto_thumbnail+`')}}"  alt="Card image cap">
                      <div class="badges">
                        `+kategori+`
                      </div>
                    </div>

                    <div class="card-body">
                      <h6 class="mb-0" style="font-weight:700;">`+y.nama_kado+`</h6>
                      <span class="lead-1 text-primary" style="font-weight:500;">Rp. `+set_currency(y.harga)+`</span>
                      <br>
                      <small style="color:grey; float:right; "><i class="fa fa-picture-o" aria-hidden="true"></i> `+y.jumlah_foto+` Images</small>
                      <small style="float:left; ">
                        `+gender+`
                      </small>
                      <br>
                    </div>
                  </div>
                </a>
              </div>
            
            `;
          });

          if (more == 1) {
            $('#data_box').append(tbl);
          }else{
            $('#data_box').html(tbl);
          }

        }else{
            tbl += ` 
              <div class="alert alert-danger" role="alert">
                Mohon maaf, kado tidak dapat ditemukan.
                Harap cari kembali dengan filter yang lain.
              </div>
            ` ;

              $('#data_box').html(tbl);

              $("#view_more").hide();
              $("#sudah_semua").hide();
        }

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