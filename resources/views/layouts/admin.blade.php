<!DOCTYPE html>
<html lang="en">
<head>
	<!-- meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
	<!-- css: theme -->
	<link rel="stylesheet" href="{{asset('css/theme.css')}}">
  <link href="{{asset('css/loading.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
@yield('css')
</head>
<body class="fixed-navbar">
	<div class="site">
		<header class="site-header">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="ya ya-bar"></i>
					</button>
					<a class="navbar-brand" href="{{url('dashboard')}}">Gameforest</a>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Master</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{url('master/kategori')}}">Kategori</a>
									<a class="dropdown-item" href="{{url('master/group')}}">Group Kado</a>
									<a class="dropdown-item" href="{{url('master/kado')}}">Kado</a>
								</div>
							</li>
						</ul>




						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
								<div class="dropdown-menu">
									<a class="dropdown-item">{{Auth::user()->name}}</a>
                	<a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
								</div>
							</li>
						</ul>
					</div>
					<!-- end .navbar-collapse -->
					<form class="navbar-search" action="search.html" method="post">
						<div class="container">
							<input class="form-control mr-sm-2" type="search" placeholder="Search for games, posts..." aria-label="Search">
							<i class="ya ya-times search-close"></i>
						</div>
					</form>
					<!-- end .navbar-search -->
					
				</div>
			</nav>
		</header>
		<!-- end .site-header -->
    <div class="loading">Loading&#8230;</div>
		<div class="site-content" role="main">
      
      @yield('content')
		</div>
		<!-- end .site-content -->
		
		<!-- end .site-footer -->

    <div class="col-md-4 col-xl-4" style="display: none;">
      <button class="btn btn-lg btn-block btn-outline-secondary" id="alert_msg" type="button" data-toggle="popup" data-target="#alert-msg">Subscribe 1</button>
    </div>
    

    <div class="popup-alert">
      
    </div>
	</div>
	<!-- end .site -->
	<!-- js: vendor -->
	<script src="{{asset('js/vendor.js')}}"></script>
	<script src="{{asset('js/theme.js')}}"></script>
  <script src="{{asset('js/helper.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
	<!-- theme settings -->
  <script>
    $(document).ready(function(){
      closeLoading();
    });

  </script>

  @yield('js')
</body>
</html>