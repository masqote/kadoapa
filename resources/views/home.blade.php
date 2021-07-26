@extends('layouts.master')

@section('title')
Cari Kado
@endsection

@section('content')
<!-- Header -->
<header id="home" class="header text-white h-fullscreen text-center text-lg-left" 
style="background-image: linear-gradient(135deg, #e4d71d 0%, #764ba2 100%);">
  
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
            <button type="submit" class="btn btn-label btn-success" style="margin-top:20px;" id="cari_kado">
              <label><i class="fa fa-gift"></i></label> Cari Kado!
            </button>
          </a>
        </form>

      </div>
    </div>
  </div>
</header><!-- /.header -->

      <section class="section overflow-hidden" id="rekomendasi_kado">
        <div class="container">
          <header class="section-header">
            <h2> Rekomendasi Kado</h2>
            <hr>
            <p class="lead">
              Berikut adalah list kado yang kami rekomendasikan untuk orang tersayang anda.
            </p>
          </header>
          
            <nav class="nav justify-content-end" style="margin-bottom:30px;">
              <div class="form-group">
                <h5>Sort by : </h5>
                <select class="form-control form-control-sm" style="color:black;" id="sort_harga">
                  <option value="low">Harga terendah</option>
                  <option value="high">Harga tertinggi</option>
                </select>
              </div>
            </nav>
          
            <div class="row gap-y gap-2" id="data_box">


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
    kategori();

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
        validate_price();
    }));

    $("#sudah_semua").hide(); // untuk hide tulisan sudah semua ketika page terload sampai terakhir

    var page = 1; // untuk mengatur page
    
    searchData(page); // function untuk load data pertama

    $("#view_more").click(function() { // function untuk melakukan klik view more
      page++;
      var more = 1;
      searchData(page,more);
    });

    $("#cari_kado").click(function() { // function untuk melakukan klik view more
      page = 1;
      searchData(page);
    });

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
          
          }
          
  }



  function kategori(){
    showLoading();
    // <option value="">Semua</option>
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

              if (y.thumbnail == null) {
                y.thumbnail = thumbnail;
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
                    <div class="card d-block shadow-lg p-3 mb-5 bg-white rounded hover-move-up" style="margin-top:-20px;">
                      <div class="card-img-top">
                        <img src="{{asset('`+y.thumbnail+`')}}" alt="Card image cap">
                        <div class="badges">
                          `+kategori+`
                        </div>
                      </div>

                      <div class="card-body">
                        <h6 class="mb-0" style="font-weight:700;">`+y.nama_kado+`</h6>
                        <span class="lead-1 text-success" style="font-weight:500;">Rp. `+set_currency(y.harga)+`</span>
                        <br>
                        <small style="color:grey; float:right; "><i class="fa fa-comment" aria-hidden="true"></i> 43 Comment</small>
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