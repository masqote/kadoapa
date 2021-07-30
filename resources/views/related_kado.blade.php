@extends('layouts.master')

@section('title')
Inspirasi Kado {{$group->nama_group}} {{'- '.config('app.name')}}
@endsection

@section('css')
    <meta property="og:title" content="Inspirasi Kado {{$group->nama_group}} {{'- '.config('app.name')}}">
    <meta property="og:description" content="Dapatkan berbagai inspirasi kado pernikahan, anniversary, wisuda atau kado untuk sahabat, suami,istri, ayah, ibu, atau apapun itu hanya di {{' '.config('app.name')}}">
    <meta property="og:image" content="{{asset('img/logo/favicon.png')}}">
    <meta property="og:url" content="{{url('/inspirasi-kado-'.request()->group.'')}}">
    <meta property="og:locale" content="id_ID" />
    <meta name="twitter:card" content="summary_large_image">

    <meta name="description" content="Dapatkan berbagai inspirasi kado pernikahan, anniversary, wisuda atau kado untuk sahabat, suami,istri, ayah, ibu, atau apapun itu hanya di {{' '.config('app.name')}}">
    <meta name="keywords" content="inspirasi kado pernikahan, kado {{$group->nama_group}}, inspirasi kado untuk sahabat, inspirasi kado anniversary, inspirasi kado untuk cowok, inspirasi kado untuk guru, inspirasi kado untuk anak">
@endsection

@section('header')
<header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #8b98fc 48%,  #764ba2 100%);">
  <div class="container">

    <div class="row">
      <div class="col-md-8 mx-auto">

       <h1>Inspirasi Kado <span id="nama_group">{{$group->nama_group}}</span></h1>
        

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
        <nav class="nav justify-content-end mb-6">
          <div class="form-group">
            <h5>Sort by : </h5>
            <select class="form-control form-control-sm" style="color:black;" id="sort_harga">
              <option value="low">Harga terendah</option>
              <option value="high">Harga tertinggi</option>
            </select>
          </div>
        </nav>
      </div>

      <div class="row gap-y gap-2" id="data_box">
        @foreach($result as $row)
        
          <div class="col-12 col-lg-4 col-md-6" > 
            
            <a href="{{url('rekomendasi-kado-'.$url_group.'/'.$row->id.'/'.$row->slug)}}">
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
        <p id="sudah_semua">Sudah semua :)</p>
        @endif
        
      </div>

    </div>
  
</div>

@endsection

@section('js')
<script>

$(document).ready(function(){

  page = 1;
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
    validate_price();
  }));

  $('#sort_harga').change(function() { // function untuk melakukan filter harga
      page = 1;
      searchData(page);
    });

});

function validate_price(){
        var from = $('#budget').val().replace(/,/g, '');
        var to =  $('#budget_end').val().replace(/,/g, '');
          if(parseInt(from) > parseInt(to)){
            $('#budget_end').val('');
            alert_msg('Error','Harga akhir harus lebih kecil dari harga awal!',405);
            
          }else{
            page = 1; // untuk mengatur page
            searchData(page)
          }
          
          
  }

function searchData(page,more){
  console.log(page);
showLoading();
var budget = $('[name="budget"]').val();
var budget_end = $('[name="budget_end"]').val();
var sort_harga = $('#sort_harga').val();
var nama_group = $('#nama_group').text();

$.ajax({
    type 	: 'POST',
    url: "{{url('/search_inspirasi_kado?page=')}}" + page,
    headers	: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
    dataType: "json",
    data: {
      'nama_group': nama_group,
      'budget': budget,
      'budget_end': budget_end,
      'sort_harga': sort_harga
    },
    success: function( data ) {
      console.log(data);
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