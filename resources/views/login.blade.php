<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>TheSaaS — Login</title>

    <!-- Styles -->
    <link href="{{asset('css/page.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

  </head>

  <body class="layout-centered bg-img">

    <!-- Main Content -->
    <main class="main-content">

      <div class="bg-white rounded shadow-7 w-400 mw-100 p-6">
        <h5 class="mb-7">Sign into your account</h5>

        <form id="frm_login" onsubmit="return login()">
          <div id="alert_msg">
            
          </div>
          
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="email">
          </div>

          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>

          <div class="form-group">
            <button class="btn btn-block btn-primary" type="submit">Login</button>
          </div>
        </form>

      </div>

    </main><!-- /.main-content -->


    <!-- Scripts -->
    <script src="{{asset('js/page.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/helper.js')}}"></script>

    <script>
      $(document).ready(function(){
          $("#frm_login").submit(function(e) {
              e.preventDefault();
          });
          
      });

      function login(){
        var dtForm 		= $('#frm_login').serializeArray();

        showLoading();
        // <option value="">Semua</option>
        $.ajax({
            type 	: 'POST',
            url: "{{url('/login_process')}}",
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data 	: dtForm,
            success: function( data ) {
              console.log(data);
              if (data.success) {
                window.location.replace("{{url('/dashboard')}}");
              }
              
              
            },
            error : function(xhr) {
              console.log(xhr);
              var tbl = '';
              
              $("#alert_msg").show();
              tbl += `<div class="alert alert-danger" role="alert">
                      `+xhr.responseJSON.error+`
                     </div>
                     `;
              
              $('#alert_msg').html(tbl);

              setTimeout(function() {
                  $("#alert_msg").hide();
              }, 3000);
            },
            complete : function(xhr,status){
              
            }
        });
      }
    </script>

  </body>
</html>
