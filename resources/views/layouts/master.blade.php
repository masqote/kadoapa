<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZQJ8QENLXR"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-ZQJ8QENLXR');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link rel="icon" href="{{asset('img/logo/favicon.png')}}" sizes="32x32" />
    <link href="{{asset('css/page.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    

    @yield('css')
</head>
<body class="body-scrolled navbar-scrolled header-scrolled">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm bg-white rounded" style="top:0;" data-navbar="fixed">
          <div class="container">

            <div class="navbar-left">
              <button class="navbar-toggler" type="button"><span class="navbar-toggler-icon"></span></button>
              <a class="navbar-brand" href="{{url('/')}}">
                <img class="logo-dark" width="130" height="130" src="{{asset('img/logo/zonakado1.png')}}" alt="logo">
              </a>
            </div>

            <section class="navbar-mobile">
              <span class="navbar-divider d-mobile-none"></span>

              <ul class="nav nav-navbar">
                <a class="nav-link" href="{{url('/')}}">Home</a>
                <li class="nav-item">
                  <a class="nav-link" href="#">Kategori Kado <span class="arrow"></span></a>
                  <ul class="nav">
                    <li class="nav-item">
                      {{-- <a class="nav-link" href="#">SaaS <span class="arrow"></span></a>
                      <nav class="nav"> --}}
                        @foreach($layout_kategori as $row)
                        @php
                          $url_kategori = str_replace(" ", "-", $row->nama_kategori);
                          $url_kategori = strtolower($url_kategori);
                        @endphp
                        <a class="nav-link" href="{{url('kado-'.$url_kategori.'')}}">{{$row->nama_kategori}}</a>
                        @endforeach
                      {{-- </nav> --}}
                    </li>
                  </ul>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="#">Inspirasi Kado <span class="arrow"></span></a>
                  <ul class="nav">
                    <li class="nav-item">
                      {{-- <a class="nav-link" href="#">SaaS <span class="arrow"></span></a>
                      <nav class="nav"> --}}
                        @foreach($layout_group as $row)
                        @php
                          $url_group = str_replace(" ", "-", $row->nama_group);
                          $url_group = strtolower($url_group);
                        @endphp
                        <a class="nav-link" href="{{url('inspirasi-kado-'.$url_group.'')}}">{{$row->nama_group}}</a>
                        @endforeach
                      {{-- </nav> --}}
                    </li>
                  </ul>
                </li>

                <a class="nav-link" href="{{url('/blog')}}">Blog</a>
                <a class="nav-link" href="{{url('/about')}}">About</a>
                <a class="nav-link" href="{{url('/contact')}}">Contact</a>
                

              </ul>
            </section>

            <a class="btn btn-xs btn-round btn-info" href="{{url('/')}}">Cari Kado <i class="fa fa-search" aria-hidden="true"></i> </a>

          </div>
        </nav><!-- /.navbar -->
        
        <div class="loading">Loading&#8230;</div>
        <div class="notif-msg" style="display:none;">
        </div>
        
        @yield('header')

        <main class="main-content">
          

          @yield('content')

          <button class="btn btn-circle btn-primary scroll-top" style="width:55px; height:55px; bottom:20px;"><i class="fa fa-angle-up" style="font-size:24px;"></i></button>
          
          <footer class="footer text-white bg-dark py-7">
            <div class="container">
              <div class="row align-items-center">
    
                <div class="col-md-6">
                  <div class="nav nav-bold nav-uppercase justify-content-center justify-content-md-end">
                    <a class="nav-link" href="{{url('/blog')}}">Blog</a>
                    <a class="nav-link" href="{{url('/about')}}">About</a>
                    <a class="nav-link" href="{{url('/contact')}}">Contact</a>
                  </div>
                </div>
    
                {{-- <div class="col-md-6 text-center text-md-left mt-5 mt-md-0">
                  <div class="social social-bg-dark">
                    <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="social-instagram" href="#"><i class="fa fa-instagram"></i></a>
                    <a class="social-youtube" href="#"><i class="fa fa-youtube"></i></a>
                  </div>
                </div> --}}
    
                <div class="col-12 text-center">
                  <br>
                  <small>© {{config('app.name')}} {{date("Y")}}, All rights reserved.</small>
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
    @yield('js')

    <script>
      $(document).ready(function(){
        closeLoading();
      });

    </script>

   
</body>
</html>