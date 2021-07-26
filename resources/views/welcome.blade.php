<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="css/theme.css">
</head>
<body>
    <div class="site">
        <header class="site-header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ya ya-bar"></i>
                    </button>
                    <a class="navbar-brand" href="/">Gameforest</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="home-blogs.html">Blogs</a>
                                    <a class="dropdown-item" href="home-magazine.html">Magazine</a>
                                    <a class="dropdown-item" href="index.html">Landing</a>
                                    <a class="dropdown-item" href="home-games.html">Games</a>
                                    <a class="dropdown-item" href="home-streamer.html">Streamer</a>
                                    <a class="dropdown-item" href="home-videos.html">Videos</a>
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
                    <ul class="navbar-nav navbar-right flex-row d-flex align-items-center">
                        <li class="nav-item"><a class="nav-link toggle-search" href="#"><i class="ya ya-search"></i></a></li>
                    </ul>
                    <!-- end .navbar-nav -->
                </div>
            </nav>
        </header>

        <div class="site-content" role="main">
            @yield('content')
        </div>

        <footer class="site-footer bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-md-4 mb-4 mb-md-0 pb-1 pb-md-0">
						<div class="footer-title">About Gameforest</div>
						<p>Gameforest is a Bootstrap Gaming theme what is built on the world's most popular front-end framework. Clean and well coded professional front-end files are included in your downloaded package.</p>
						<a class="btn btn-outline-light mt-2" href="https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730" target="_blank" role="button">Purchase theme</a>
					</div>
					<div class="col-md-4 mb-4 mb-md-0 pb-1 pb-md-0">
						<div class="footer-title">Popular Categories</div>
						<div class="footer-tags">
							<a href="#">Playstation 4</a>
							<a href="#">Xbox One</a>
							<a href="#">God of War</a>
							<a href="#">Bioshock</a>
							<a href="#">Uncharted 4</a>
							<a href="#">Uplay</a>
							<a href="#">Steam</a>
							<a href="#">Wordpress</a>
							<a href="#">Rachet</a>
							<a href="#">Github</a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="footer-title">Subscribe</div>
						<p>Subscribe to our newsletter and get notification when new games are available.</p>
						<form>
							<div class="input-group mt-4">
								<input type="text" class="form-control shadow-none border-0" placeholder="Email">
								<div class="input-group-append">
									<button class="btn btn-primary" type="button">Subscribe</button>
								</div>
							</div>
							<div class="custom-control custom-checkbox mt-3">
								<input type="checkbox" class="custom-control-input" id="subscribe">
								<label class="custom-control-label" for="subscribe">Subscribe me to newsletter</label>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container d-flex flex-column flex-md-row">
					<div class="order-2 order-md-1">
						<div class="footer-links d-none d-md-inline-block">
							<a href="#">About Gameforest</a>
							<a href="#">Terms of Service</a>
							<a href="docs" target="_blank">Documentation</a>
							<a href="changelog.html">Changelog</a>
						</div>
						<p class="footer-copyright">&copy; 2019 <a href="https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730" target="_blank">Gameforest</a>. Designed and built by <a href="https://yakuthemes.com" target="_blank">yakuthemes</a>. All rights reserved.</p>
					</div>
					<div class="footer-social order-1 order-md-2 ml-md-auto text-center text-md-right">
						<span class="d-none d-sm-block mb-2">follow us on social media</span>
						<a href="https://facebook.com/yakuthemes" target="_blank" data-toggle="tooltip" title="facebook"><i class="ya ya-facebook"></i></a>
						<a href="https://twitter.com/yakuthemes" target="_blank" data-toggle="tooltip" title="twitter"><i class="ya ya-twitter"></i></a>
						<a href="#" target="_blank" data-toggle="tooltip" title="instagram"><i class="ya ya-instagram"></i></a>
						<a href="#" target="_blank" data-toggle="tooltip" title="discord"><i class="ya ya-discord"></i></a>
						<a href="#" target="_blank" data-toggle="tooltip" title="youtube"><i class="ya ya-youtube"></i></a>
						<a href="https://github.com/yakuthemes" target="_blank" data-toggle="tooltip" title="github"><i class="ya ya-github"></i></a>
						<a href="#" target="_blank" data-toggle="tooltip" title="twitch"><i class="ya ya-twitch"></i></a>
					</div>
				</div>
			</div>
		</footer>
    </div>

    @yield('footer')

    <script src="{{asset('js/vendor.js')}}"></script>
	<script src="{{asset('js/theme.js')}}"></script>
    @yield('js')
</body>
</html>