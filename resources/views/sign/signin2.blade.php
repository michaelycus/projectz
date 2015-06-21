
<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>WeTranslate</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/pixel-admin.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/pages.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/rtl.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/themes.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

</head>


{{--
 1. $BODY ======================================================================================
	
	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'     - Sets text direction to right-to-left

--}}
<body class="theme-default page-signin-alt">
<!-- Demo script --> <script src="{{ URL::asset('assets/demo/demo.js') }}"></script> <!-- / Demo script -->



<!-- 2. $MAIN_NAVIGATION ===========================================================================

	Main navigation
-->
	<div class="signin-header">
		<a href="index.html" class="logo">
			<div class="demo-logo bg-primary"><img src="{{ URL::asset('demo/logo-big.png') }}" alt="" style="margin-top: -4px;"></div>&nbsp;			
			<img src="{{ URL::asset('images/logo.png') }}" alt="" class="official_logo">
			<!-- <strong>We</strong>Translate -->
		</a> <!-- / .logo -->
		<a href="{{ URL::route('account-sign-up') }}" class="btn btn-primary">Sign Up</a>
	</div> <!-- / .header -->

	@if (Session::has('account-actived'))
    	<div class="alert alert-success alert-dark">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{ Session::get('account-actived') }}
		</div>
    @endif

	<h1 class="form-header">Sign in to your Account</h1>


	<!-- Form -->
	<form action="{{ URL::route('account-sign-in-post') }}" id="signin-form_id" class="panel" method="post">

		@if (Session::has('global'))
			<p class="help-block">{{ Session::get('global') }}</p>	        
	    @endif

	    @if (Session::has('account-created'))
	    	<div class="alert alert-info alert-dark">
				<button type="button" class="close" data-dismiss="alert">×</button>
				{{ Session::get('account-created') }}
			</div>
	    @endif

		<div class="form-group">
			<input type="text" name="email" class="form-control input-lg" placeholder="Email" {{ Input::old('email') ? ' value="'. e(Input::old('email'))  .'"' : '' }}>
			@if ($errors->has('email'))
				<p class="help-block">{{ $errors->first('email') }}</p>
			@endif
		</div> <!-- / Username -->

		<div class="form-group signin-password">
			<input type="password" name="password" class="form-control input-lg" placeholder="Password">
			<a href="#" class="forgot">Forgot?</a>
			@if ($errors->has('password'))
				<p class="help-block">{{ $errors->first('password') }}</p>
			@endif
		</div> <!-- / Password -->

		<div class="form-actions">
			<input type="submit" value="Sign In" class="btn btn-primary btn-block btn-lg">
		</div> <!-- / .form-actions -->
		{{ Form::token() }}
	</form>
	<!-- / Form -->

	<div class="signin-with">
		<div class="header">or sign in with</div>
		<a href="{{ URL::route('login-facebook') }}" class="btn btn-lg btn-facebook rounded"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;
		{{--<a href="index.html" class="btn btn-lg btn-info rounded"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;--}}
		<a href="{{ URL::route('login-google') }}" class="btn btn-lg btn-danger rounded"><i class="fa fa-google-plus"></i></a>
	</div>


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="{{ URL::asset('assets/javascripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/javascripts/pixel-admin.min.js') }}"></script>

<script type="text/javascript">
	window.PixelAdmin.start([
		function () {
			$("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });
			
			// Validate username
			$("#username_id").rules("add", {
				required: true,
				minlength: 3
			});

			// Validate password
			$("#password_id").rules("add", {
				required: true,
				minlength: 6
			});
		}
	]);
</script>

</body>
</html>
