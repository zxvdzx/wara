<!DOCTYPE html>
<html lang="zxx">
<head>
<title>{{ Config('app.name')}}</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Website Waratime" />
<meta name="author" content="Waratime">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--// Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/bootstrap.css') !!}"> <!-- Bootstrap-Core-CSS -->
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/style.css') !!}" type="text/css" media="all" />
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/font-awesome.css') !!}"> <!-- Font-Awesome-Icons-CSS -->
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/swipebox.css') !!}">
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/css/jquery-ui.css') !!}" />
<!-- //css files -->
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Exo+2:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=cyrillic,latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->
<style>
	.error{
		color:red;
	}
	.center-align{
		text-align:center;
	}
</style>
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
				<a class="navbar-brand" href="{{ url('/') }}">
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
                @if(Sentinel::check())
				    <li><a class="active" href="{{ route('member.logout') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign Out</a> </li>
				@else
                    <li><a class="active" href="{{ route('member.login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a> </li>
                @endif
            </ul>
			
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
				<nav class="link-effect-2" id="link-effect-2">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/') }}" class="effect-3">Home</a></li>
						<li class="active"><a href="{{ route('crew') }}" class="effect-3">Crew</a></li>
					</ul>
				</nav>

			</div>
		</nav>	
		<div class="clearfix"> </div> 
	</div>
</div>

@yield('content')

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog">
   	 	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 style="text-align:center; font-size:25px" id="headerModal"></h4>
			</div>
			<div class="modal-body" id="getContentModal">
				<p id="message" style="color:red; text-align:center; font-size:20px"></p>
			</div>
		</div>
    </div>
</div>
<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="wthree_footer_grid_left">
			<div class="col-md-6 col-xs-6 wthree_footer_grid_left1">
				<h4>About Us</h4>
				<p>Donec viverra nunc eu neque porta, quis laoreet nisl gravida. Proin gravida, 
					diam ut consectetur porttitor.</p>
			</div>
			<!-- <div class="col-md-3 col-xs-3 wthree_footer_grid_left1">
				
			</div> -->
			<div class="col-md-3 col-xs-3 wthree_footer_grid_left1 w3l-3">
				<!-- <h4>Others</h4>
				<ul>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#">Media</a></li>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#">Mobile Apps</a></li>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#">Privacy Policy</a></li>
				</ul> -->
				<h4>Navigation</h4>
				<ul>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="index.html">Home</a></li>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#about" class="scroll">About Us</a></li>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#services" class="scroll">Services</a></li>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#team" class="scroll">Team</a></li>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#gallery" class="scroll">Gallery</a></li>
					<li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#mail" class="scroll">Mail Us</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-xs-3 wthree_footer_grid_left1 wthree_footer_grid_right1">
				<h4>Contact Us</h4>
				<ul>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i>+(000) 123 311</li>
					<li><i class="fa fa-fax" aria-hidden="true"></i>+123 421</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="w3layouts_copy_right">
	<div class="container">
		<p>© {{ date('Y') }} {{ config('app.name')}}. All rights reserved</p>
	</div>
</div>
<!-- //footer -->

<!-- js-scripts -->			
<!-- js-files -->
<script type="text/javascript" src="{{ asset($pathp.'assets/frontend/js/jquery-2.1.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset($pathp.'assets/frontend/js/bootstrap.js') }}"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
<!-- //js-files -->
<!-- Baneer-js -->

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
	var code 	 	= $("[name='code']").val();
	var messages 	= $("[name='messages']").val();
	var headeModal 	= $("[name='headerm']").val();
	
	if(code=="ALERT"){
		$("#myModal2").modal("show");
		$("#message").html(messages);
		$("#headerModal").html(headeModal);
	}else if(code=="RESULT"){
		$("#myModal3").modal("show");
	}
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
	<script type="text/javascript">
		// setTimeout(function(){ $('.alert-info').hide(); }, 10000);
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