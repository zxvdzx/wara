<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Waratime - Under Constraction and Coming Soon</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{!! asset($pathp.'assets/under/css/animate.css') !!}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{!! asset($pathp.'assets/under/css/icomoon.css') !!}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{!! asset($pathp.'assets/under/css/bootstrap.css') !!}">
	<!-- Theme style  -->
	<link rel="stylesheet" href="{!! asset($pathp.'assets/under/css/style.css') !!}">

	<!-- Modernizr JS -->
	<script src="{!! asset($pathp.'assets/under/js/modernizr-2.6.2.min.js') !!}"></script>
	<!-- FOR IE9 below -->

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<div id="fh5co-logo"><img src="{{ asset($pathp.'assets/frontend/images/logo.png') }}" alt="logo" width="200" height="50"></div>
				</div>
			</div>
		</div>
	</nav>

	<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({!! asset($pathp.'assets/under/images/img_bg_1.jpg') !!});" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<!-- <img src="{{ asset($pathp.'assets/frontend/images/logo.png') }}" alt="logo" width="150" height="35"> -->
							<h1>Our website is under construction.</h1>
							<h2>We'll be here soon with our new awesome site.</h2>
							<div class="simply-countdown simply-countdown-one"></div>
							<div class="row">
								<!-- <h2>Notify me when it's ready</h2>
								<form class="form-inline" id="fh5co-header-subscribe">
									<div class="col-md-12 col-md-offset-0">
										<div class="form-group">
											<input type="text" class="form-control" id="email" placeholder="Get notify by email">
											<button type="submit" class="btn btn-primary">Send</button>
										</div>
									</div>
								</form> -->
								<ul class="fh5co-social-icons">
									<!-- <li><a href="#"><i class="icon-twitter-with-circle"></i></a></li> -->
									<!-- <li><a href="#"><i class="icon-facebook-with-circle"></i></a></li> -->
									<!-- <li><a href="#"><i class="icon-instagram-with-circle"></i></a></li> -->
									<!-- <li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
									<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li> -->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="{!! asset($pathp.'assets/under/js/jquery.min.js') !!}"></script>
	<!-- jQuery Easing -->
	<script src="{!! asset($pathp.'assets/under/js/jquery.easing.1.3.js') !!}"></script>
	<!-- Bootstrap -->
	<script src="{!! asset($pathp.'assets/under/js/bootstrap.min.js') !!}"></script>
	<!-- Waypoints -->
	<script src="{!! asset($pathp.'assets/under/js/jquery.waypoints.min.js') !!}"></script>

	<!-- Stellar -->
	<script src="{!! asset($pathp.'assets/under/js/jquery.stellar.min.js') !!}"></script>

	<!-- Count Down -->
	<script src="{!! asset($pathp.'assets/under/js/simplyCountdown.js') !!}"></script>
	<!-- Main -->
	<script src="{!! asset($pathp.'assets/under/js/main.js') !!}"></script>

	<script>
    var d = new Date(new Date().getTime() + 215 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
</script>

	</body>
</html>