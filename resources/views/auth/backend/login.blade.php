@extends('auth.layout.layout')

@section('loginContent')
<div id="login-box" class="login-box visible widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header blue lighter bigger">
				<i class="ace-icon fa fa-coffee green"></i>
				Please Enter Your Information
			</h4>
			<div class="alert-flash">
				@include('flash::message')
				@if (Session::has('notice'))
	            	<div class="alert alert-info">{!! Session::get('notice') !!}</div>
	            @endif
	        </div>
			<div class="space-6"></div>
        	{!! Form::open($form) !!}
            	<input type="hidden" name="type" value="{{ $type }}">
				<fieldset>
					<div class="form-group mb-lg">
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
								<i class="ace-icon fa fa-envelope"></i>
							</span>
						</label>
					</div>
					<div class="form-group{{ Form::hasError('email') }} has-feedback">
		                {!! Form::errorMsg('email') !!}
		            </div>
		            <div class="form-group mb-lg">
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
								<i class="ace-icon fa fa-lock"></i>
							</span>
						</label>
					</div>
					<div class="form-group{{ Form::hasError('password') }} has-feedback">
		                {!! Form::errorMsg('password') !!}
		            </div>

					<div class="space"></div>

					<div class="clearfix">
						<label class="inline">
							<input name="rememberMe" type="checkbox" class="ace" />
							<span class="lbl"> Remember Me</span>
						</label>

						<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
							<i class="ace-icon fa fa-key"></i>
							<span class="bigger-110">Login</span>
						</button>
					</div>

					<div class="space-4"></div>
				</fieldset>
			{!! Form::close() !!}

		</div><!-- /.widget-main -->

		<div class="toolbar clearfix">
			<div>
				<a href="#" data-target="#forgot-box" class="forgot-password-link">
					<i class="ace-icon fa fa-arrow-left"></i>
					I forgot my password
				</a>
			</div>
		</div>
	</div><!-- /.widget-body -->
</div><!-- /.login-box -->
@endsection

@section('scripts')
	<script>
	    $('.alert-flash').delay(3000).fadeOut(350);
	</script>
@endsection