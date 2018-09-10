<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Waratime Admin">
		<meta name="author" content="Asep Obor">
		<meta name="keyword" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Waratime - Login Page</title>

		<!-- start: Css -->
		<link rel="stylesheet" type="text/css" href="{{ asset($pathp.'assets/backend/css/bootstrap.min.css') }}">

		<!-- plugins -->
		<link rel="stylesheet" type="text/css" href="{{ asset($pathp.'assets/backend/css/plugins/font-awesome.min.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset($pathp.'assets/backend/css/plugins/simple-line-icons.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset($pathp.'assets/backend/css/plugins/animate.min.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset($pathp.'assets/backend/css/plugins/icheck/skins/flat/aero.css') }}"/>
		<link href="{{ asset($pathp.'assets/backend/css/style.css') }}" rel="stylesheet">
		<!-- end: Css -->

		<link rel="shortcut icon" href="{{ asset($pathp.'assets/backend/img/logomi.png') }}">
	</head>
	<body id="mimin" class="dashboard form-signin-wrapper">
		<div class="container">
			{!! Form::open($form) !!}
				<div class="panel periodic-login">
					<div class="panel-body text-center">
						<h1 class="atomic-symbol">WT</h1>
						<!-- <p class="atomic-mass">14.072110</p> -->
						<h2 class="element-name">Waratime</h2>
						<div class="alert-flash">
							@include('flash::message')
							@if (Session::has('notice'))
								<div class="alert alert-info">{!! Session::get('notice') !!}</div>
							@endif
						</div>
						<input type="hidden" name="type" value="{{ $type }}">
						<!-- <i class="icons icon-arrow-down"></i> -->
						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<input type="text" name="email" class="form-text" required>
							<span class="bar"></span>
							<label>Email</label>
						</div>
						<div class="form-group{{ Form::hasError('email') }} has-feedback">
							{!! Form::errorMsg('email') !!}
						</div>
						<div class="form-group form-animate-text" style="margin-top:40px !important;">
							<input type="password" name="password" class="form-text" required>
							<span class="bar"></span>
							<label>Password</label>
						</div>
						<div class="form-group{{ Form::hasError('password') }} has-feedback">
							{!! Form::errorMsg('password') !!}
						</div>
						<label class="pull-left">
						<!-- <input type="checkbox" class="icheck pull-left" name="checkbox1"/> Remember me -->
						</label>
						<input type="submit" class="btn col-md-12" value="Sign In"/>
					</div>
					<!-- <div class="text-center" style="padding:5px;">
						<a href="forgotpass.html">Forgot Password </a>
						<a href="reg.html">| Signup</a>
					</div> -->
				</div>
			{!! Form::close() !!}
		</div>
		<!-- end: Content -->
		<!-- start: Javascript -->
		<script src="{{ asset($pathp.'assets/backend/js/jquery.min.js') }}"></script>
		<script src="{{ asset($pathp.'assets/backend/js/jquery.ui.min.js') }}"></script>
		<script src="{{ asset($pathp.'assets/backend/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset($pathp.'assets/backend/js/plugins/moment.min.js') }}"></script>
		<script src="{{ asset($pathp.'assets/backend/js/plugins/icheck.min.js') }}"></script>

		<!-- custom -->
		<script src="{{ asset($pathp.'assets/backend/js/main.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('input').iCheck({
				checkboxClass: 'icheckbox_flat-aero',
				radioClass: 'iradio_flat-aero'
				});
			});
		</script>
		<!-- end: Javascript -->
	</body>
</html>