<!DOCTYPE html>
<html lang="zxx">
	<head>
		<title>{{ Config('app.name')}} | @yield('title')</title>
		<!-- Meta tag Keywords -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Website Waratime" />
		<meta name="author" content="Waratime">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--// Meta tag Keywords -->
		<!-- css files -->
		@include('frontend.layout.partials.header')
		<!-- //online-fonts -->
		@yield('css')
	</head>
<body>
<!-- banner -->
<div class="main_section_agile" id="home">
	<div class="agileits_w3layouts_banner_nav">
		<nav class="navbar navbar-default">
			<div class="navbar-header navbar-left">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<h1>
				<a class="navbar-brand" href="index.html">
					<img src="{{ asset($pathp.'assets/frontend/images/logo.png') }}" alt="logo" width="150" height="35">
					<!-- <i class="full-right" aria-hidden="true"></i> {{ config('app.name')}} -->
				</a>
			</h1>

			</div>
			<!-- <div class="w3layouts_header_right">
			    <form action="#" method="post">
					<input name="Search here" type="search" placeholder="Search" required="">
					<input type="submit" value="">
				</form>
			</div> -->
			<ul class="agile_forms">
				<li><a class="active" href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a> </li>
				<!-- <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sign Up</a> </li> -->
			</ul>
			
			<!-- Collect the nav links, forms, and other content for toggling -->
			@include('frontend.layout.partials.menunav')
		</nav>	
		<div class="clearfix"> </div> 
	</div>
</div>

@yield('content')

<div id="map"></div>

@include('frontend.layout.partials.footer')

<!-- js-scripts -->			
<!-- js-files -->
<script type="text/javascript" src="{{ asset($pathp.'assets/frontend/js/jquery-2.1.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset($pathp.'assets/frontend/js/bootstrap.js') }}"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
<!-- //js-files -->
<!-- Baneer-js -->

<!-- Map-JavaScript -->
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>        
			<script type="text/javascript">
				google.maps.event.addDomListener(window, 'load', init);
				function init() {
					var mapOptions = {
						zoom: 11,
						center: new google.maps.LatLng(40.6700, -73.9400),
						styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
					};
					var mapElement = document.getElementById('map');
					var map = new google.maps.Map(mapElement, mapOptions);
					var marker = new google.maps.Marker({
						position: new google.maps.LatLng(40.6700, -73.9400),
						map: map,
					});
				}
			</script>
		<!-- //Map-JavaScript -->

<!-- smooth scrolling -->
<script src="{{ asset($pathp.'assets/frontend/js/SmoothScroll.min.js') }}"></script>
<!-- //smooth scrolling -->
<!-- stats -->
<script type="text/javascript" src="{{ asset($pathp.'assets/frontend/js/numscroller-1.0.js') }}"></script>
<!-- //stats -->
<!-- moving-top scrolling -->
<script type="text/javascript" src="{{ asset($pathp.'assets/frontend/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset($pathp.'assets/frontend/js/easing.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //moving-top scrolling -->
<!-- gallery popup -->
<script src="{{ asset($pathp.'assets/frontend/js/jquery.swipebox.min.js') }}"></script> 
<script type="text/javascript">
jQuery(function($) {
	$(".swipebox").swipebox();
});
</script>
<!-- //gallery popup -->
<!--/script-->
	<script src="{{ asset($pathp.'assets/frontend/js/simplePlayer.js') }}"></script>
			<script>
				$("document").ready(function() {
					$("#video").simplePlayer();
				});
			</script>
<!-- //Baneer-js -->
<!-- Calendar -->
<script src="{{ asset($pathp.'assets/frontend/js/jquery-ui.js') }}"></script>
	<script>
	  $(function() {
		$( "#datepicker" ).datepicker();
	 });
	</script>
<!-- //Calendar -->	

<!-- //js-scripts -->
@yield('scripts')
</body>
</html>