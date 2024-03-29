@extends('layouts.master')

@section('title')
{{config('app.name')}} - Bingung Cari Kado ? Tenang! Ada {{config('app.name')}}
@endsection

@section('css')
<link rel="canonical" href="{{url('/')}}" />
<!--  Open Graph Tags -->
<meta property="og:title" content="Bingung Cari Kado? Tenang! ada{{' '.config('app.name')}}">
<meta property="og:description" content="Kami akan membantu dan merekomendasikan anda untuk menemukan kado yang cocok untuk orang tersayang anda {{'- '.config('app.name')}}">
<meta property="og:image" content="{{asset('img/default/gift-1.jpg')}}">
<meta property="og:url" content="{{url('/')}}">
<meta property="og:locale" content="id_ID" />
<meta name="twitter:card" content="summary_large_image">

<meta name="description" content="Kami akan membantu dan merekomendasikan anda untuk menemukan kado yang cocok untuk orang tersayang anda {{'- '.config('app.name')}}">
<meta name="keywords" content="kado untuk sahabat, kado untuk ibu, kado untuk ayah, kado untuk anak, kado untuk cowok, kado untuk cewek, kado untuk pernikahan, kado untuk anniversary, kado untuk perpisahan, kado untuk wisuda, kado untuk ulang tahun, kado untuk persalinan">
@endsection

@section('header')
<header id="home" class="header text-white h-fullscreen text-center text-lg-left" style="background: linear-gradient(135deg, #6a75c7 20%,  #764ba2 91% 100%);">
  
  <div class="container">
    <div class="row align-items-center h-100">
      <div class="col-md-8 mx-auto text-center">

        <h1 class="display-41" data-font="Raleway:800">Sedang cari kado?</h1>
        <p class="lead fw-400">Tenang! jangan bingung, kami akan merekomendasikan kado yang cocok untuk orang tersayang anda.</p>

        <form class="rounded p-5 mt-7" style="background-color: rgba(255, 255, 255, 0.2)" id="frm_search">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Kado Untuk</label>
                <select class="form-control form-control-sm" name="kategori">
                  <option value="">Semua</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Gender</label>
                <select class="form-control form-control-sm" name="gender">
                  <option value="">Semua</option>
                  <option value="pria">Pria</option>
                  <option value="wanita">Wanita</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Budget</label>
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

          </div>

          <a href="#rekomendasi_kado">
            <button type="submit" class="btn btn-label btn-primary" style="margin-top:20px; color:white;" id="cari_kado">
              <label><i class="fa fa-gift"></i></label> Cari Kado!
            </button>
          </a>
        </form>

      </div>
    </div>
  </div>
</header><!-- /.header -->
@endsection

@section('content')
<!-- Header -->

      <section class="section bg-gray" id="rekomendasi_kado">
        <div class="container">
          <h2 class="text-center" id="title_detail"></h2>
          <br>
          {{-- <header class="section-header">
            <h2 id="title_detail"></h2>
            <hr>
            <p class="lead">
              Berikut adalah list kado yang kami rekomendasikan untuk orang tersayang anda.
            </p>
          </header> --}}
          <h5 class="nav justify-content-center mb-2">Tentukan Budget Sendiri</h5>
          <div class="input-group">
            <div class="input-group-append">
              <span class="input-group-text">Rp. </span>
            </div>
            <input type="text" id="budget_filter" name="budget" class="form-control form-control-sm" placeholder="Start" autocomplete="off">
            <div class="input-group-append">
              <span class="input-group-text" style="background-color:#c9ccce; color:white; font-weight:700;">~</span>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">Rp. </span>
            </div>
            <input type="text" id="budget_end_filter" name="budget_end" class="form-control form-control-sm" placeholder="To" autocomplete="off">
          </div>
          <br>
          
            <nav class="nav justify-content-end" style="margin-bottom:30px;">
              <div class="form-group" style="margin-right:10px;">
                <h6>Gender : </h6>
                <select class="form-control form-control-sm" style="color:black;" name="gender_filter" id="gender_filter">
                  <option value="">Semua</option>
                  <option value="pria">Pria</option>
                  <option value="wanita">Wanita</option>
                </select>
              </div>
              <div class="form-group" style="margin-right:10px;">
                <h6>Kategori : </h6>
                <select class="form-control form-control-sm" name="kategori_filter" style="color:black;" id="sort_kategori">
                  <option value="">Semua</option>
                </select>
              </div>
              <div class="form-group">
                <h6>Sort by : </h6>
                <select class="form-control form-control-sm" style="color:black;" id="sort_harga">
                  <option value="new">Terbaru</option>
                  <option value="low">Harga terendah</option>
                  <option value="high">Harga tertinggi</option>
                </select>
              </div>
            </nav>
          
            <div class="row gap-y" id="data_box">


            </div>

            <div class="text-center" style="margin-top:100px;">
              <button type="button" class="btn btn-outline-primary" id="view_more">View More..</button>
              <p id="sudah_semua">Sudah semua :)</p>
            </div>
           
        </div>
      </section>
@endsection

@section('js')
<script>
  $(document).ready(function(){
    // kategori();

    $.ajax({
        type 	: 'POST',
        url: "{{url('/all_kategori')}}",
        headers	: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        dataType: "json",
        success: function( data ) {
          var tbl = '<option value="">Semua</option>';
          kategori = data.kategori;

          $.each(kategori,function(x,y){
            tbl += `
              <option value="`+y.id+`">`+y.nama_kategori+`</option>
            `;
            
          });

          $('#frm_search [name="kategori"]').html(tbl);
          $('[name="kategori_filter"]').html(tbl);

        },
        error : function(xhr) {
          read_error(xhr);
        },
        complete : function(xhr,status){

        }
    });

    $("#frm_search").submit(function(e) {
        e.preventDefault();
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

      var budget = $('#budget').val().replace(/,/g, '');
      var budget_end = $('#budget_end').val().replace(/,/g, '');

      $('#budget_filter').val(budget);
      $('#budget_end_filter').val(budget_end);
      validate_price(page);
    }));

    $('#budget_filter').on('click keyup input paste',(function (event) { // untuk mengubah format number menjadi otomatis 3 digit ,
        $(this).val(function (index, value) {
            return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    }));

    $('#budget_end_filter').on('click keyup input paste',(function (event) { // untuk mengubah format number menjadi otomatis 3 digit ,
        $(this).val(function (index, value) {
            return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    }));

    $('#budget_end_filter, #budget_filter').on('change',(function (event) { // untuk mengubah format number menjadi otomatis 3 digit ,
      page = 1;

      var budget_filter = $('#budget_filter').val().replace(/,/g, '');
      var budget_end_filter = $('#budget_end_filter').val().replace(/,/g, '');
      $('#budget').val(budget_filter);
      $('#budget_end').val(budget_end_filter);

      validate_price(page);
    }));

    $("#sudah_semua").hide(); // untuk hide tulisan sudah semua ketika page terload sampai terakhir

    var page = 1; // untuk mengatur page
    
    
    // searchData(page); // function untuk load data pertama
    $('#rekomendasi_kado').hide();


    $("#view_more").click(function() { // function untuk melakukan klik view more
      page++;
      var more = 1;
      searchData(page,more);
    });

    $("#cari_kado").click(function() { // function untuk melakukan klik cari kado
      page = 1;
      $('#rekomendasi_kado').show();
      searchData(page);
      var kategori_selected = $('#frm_search [name="kategori"]').find(":selected").text();
      var kategori_selected_val = $('#frm_search [name="kategori"]').find(":selected").val();

      var gender = $('#frm_search [name="gender"]').find(":selected").val();
      $('#gender_filter').val(gender);


      if (kategori_selected == 'Semua') {
        $('#title_detail').text(kategori_selected+' Kado');
        $('[name="kategori_filter"]').val(kategori_selected_val);
      }else{
        $('#title_detail').text('Kado '+kategori_selected);
        $('[name="kategori_filter"]').val(kategori_selected_val);
      }
      
    });

    $('#sort_harga').change(function() { // function untuk melakukan filter harga
      page = 1;
      searchData(page);
    });

    $('[name="kategori_filter"]').change(function() { // function untuk melakukan filter harga
      page = 1;
      var kategori_selected = $('[name="kategori_filter"]').find(":selected").text();
      var kategori_selected_val = $('[name="kategori_filter"]').find(":selected").val();

      $('#frm_search [name="kategori"]').val(kategori_selected_val);

      if (kategori_selected == 'Semua') {
        $('#title_detail').text(kategori_selected+' Kado');
        $('[name="kategori_filter"]').val(kategori_selected_val);
      }else{
        $('#title_detail').text('Kado '+kategori_selected);
        $('[name="kategori_filter"]').val(kategori_selected_val);
      }

      searchData(page);
    });

    $('[name="gender_filter"]').change(function() { // function untuk melakukan filter harga
      page = 1;
      var gender = $('[name="gender_filter"]').find(":selected").val();

      $('#frm_search [name="gender"]').val(gender);

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
            searchData(page);
          }
          
  }


  function searchData(page,more){
    
    showLoading();
    var kategori = $('#frm_search [name="kategori"]').val();
    var gender = $('#frm_search [name="gender"]').val();
    var budget = $('#frm_search [name="budget"]').val();
    var budget_end = $('#frm_search [name="budget_end"]').val();
    var sort_harga = $('#sort_harga').val();

    $.ajax({
        type 	: 'POST',
        url: "{{url('/all_kado?page=')}}" + page,
        headers	: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        dataType: "json",
        data: {
          'kategori': kategori,
          'gender': gender,
          'budget': budget,
          'budget_end': budget_end,
          'sort_harga': sort_harga
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
              
              <div class="col-6 col-lg-3">
                <a class="card shadow-1 hover-shadow-6" href="{{url('rekomendasi-kado-`+nama_group+`/`+y.id+`/`+y.slug+`')}}" target="_blank"">
                  <img class="card-img-top" src="{{asset('`+y.foto_thumbnail+`')}}" alt="avatar">
                  <div class="card-body">
                    <h6 class="mb-0" style="line-height:1.5em; min-height:4.5em; max-height:4.5em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">`+y.nama_kado+`</h6>
                    <small class="small-2 ls-1" style="font-weight: 800;">Rp. `+set_currency(y.harga)+`</small>
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