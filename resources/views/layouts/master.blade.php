<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link href="{{asset('css/page.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">

    @yield('css')
</head>
<body class="demo-section">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm bg-white rounded" style="top:0;" data-navbar="smart">
          <div class="container">

            <div class="navbar-left">
              <button class="navbar-toggler" type="button"><span class="navbar-toggler-icon"></span></button>
              <a class="navbar-brand" href="{{url('/')}}">
                <img class="logo-dark" src="{{asset('img/logo-dark.png')}}" alt="logo">
                <img class="logo-light" src="{{asset('img/logo-light.png')}}" alt="logo">
              </a>
            </div>

            <section class="navbar-mobile">
              <span class="navbar-divider d-mobile-none"></span>

              <ul class="nav nav-navbar">
                <li class="nav-item">
                  <a class="nav-link" href="#">Demos <span class="arrow"></span></a>
                  <ul class="nav">

                    <li class="nav-item">
                      <a class="nav-link" href="#">SaaS <span class="arrow"></span></a>
                      <nav class="nav">
                        <a class="nav-link" href="../demo/saas-1.html">SaaS 1</a>
                        <a class="nav-link" href="../demo/saas-2.html">SaaS 2</a>
                        <a class="nav-link" href="../demo/saas-3.html">SaaS 3</a>
                        <a class="nav-link" href="../demo/saas-4.html">SaaS 4</a>
                      </nav>
                    </li>
                  </ul>
                </li>

              </ul>
            </section>

            <a class="btn btn-xs btn-round btn-success" href="https://themeforest.net/item/thesaas-responsive-bootstrap-saas-software-webapp-template/19778599?license=regular&open_purchase_for_item_id=19778599&purchasable=source&ref=thethemeio">Buy Now</a>

          </div>
        </nav><!-- /.navbar -->
        
        <div class="loading">Loading&#8230;</div>
        <div class="notif-msg" style="display:none;">
        </div>
        

        <main class="main-content">
          

          @yield('content')

          <button class="btn btn-circle btn-primary scroll-top" style="width:55px; height:55px; bottom:20px;"><i class="fa fa-angle-up" style="font-size:24px;"></i></button>
          
          <footer class="footer text-white bg-dark py-7">
            <div class="container">
              <div class="row align-items-center">
    
                <div class="col-md-6">
                  <div class="nav nav-bold nav-uppercase justify-content-center justify-content-md-end">
                    <a class="nav-link" href="#">About</a>
                    <a class="nav-link" href="#">Blog</a>
                    <a class="nav-link" href="#">Contact</a>
                  </div>
                </div>
    
                <div class="col-md-6 text-center text-md-left mt-5 mt-md-0">
                  <div class="social social-bg-dark">
                    <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="social-twitter" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="social-instagram" href="#"><i class="fa fa-instagram"></i></a>
                    <a class="social-youtube" href="#"><i class="fa fa-youtube"></i></a>
                    <a class="social-dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                  </div>
                </div>
    
                <div class="col-12 text-center">
                  <br>
                  <small>© TheThemeio 2020, All rights reserved.</small>
                </div>
    
              </div>
            </div>
          </footer>
        </main>

        <div class="col-md-4 col-xl-4" style="display: none;">
          <button class="btn btn-lg btn-block btn-outline-secondary" id="alert_msg" type="button" data-toggle="popup" data-target="#alert-msg">Subscribe 1</button>
        </div>
        

        <div class="popup-alert">
          
        </div>
        

        


        
    <script src="{{asset('js/helper.js')}}"></script>
    <script src="{{asset('js/page.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>

    <script>
      $(document).ready(function(){
        closeLoading();
      });

    </script>

    @yield('js')
</body>
</html>