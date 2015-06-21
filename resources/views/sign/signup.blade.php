
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
	<link href="{{ URL::asset('assets/stylesheets/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/pixel-admin.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/pages.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/rtl.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/themes.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('assets/stylesheets/custom.css') }}" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

</head>

<!-- 1. $BODY ======================================================================================
	
	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'     - Sets text direction to right-to-left
-->
<body class="theme-default page-signup-alt">
<!-- Demo script --> <script src="{{ URL::asset('assets/demo/demo.js') }}"></script> <!-- / Demo script -->

	<div class="signup-header">
		<a href="{{ URL::route('home') }}" class="logo">
			<div class="demo-logo bg-primary"><img src="assets/demo/logo-big.png" alt="" style="margin-top: -4px;"></div>&nbsp;
			<img src="{{ URL::asset('assets/images/logo.png') }}" alt="" class="official_logo">
			<!-- <strong>We</strong>Translate -->
		</a> <!-- / .logo -->
		<a href="{{ URL::route('home') }}" class="btn btn-primary">Sign In</a>
	</div> <!-- / .header -->

	<h1 class="form-header">Create your Account</h1>

	<!-- Form -->	
	<form action="{{ URL::route('account-sign-up-post') }}" method="post" class="panel" id="signup-form_id">	
		<div class="form-group">
			<input type="text" name="firstname" class="form-control input-lg" placeholder="First name" {{ Input::old('firstname') ? ' value="'. e(Input::old('firstname'))  .'"' : '' }}>
			@if($errors->has('firstname'))
				<p class="help-block">{{ $errors->first('firstname') }}</p>
			@endif
		</div>

		<div class="form-group">
			<input type="text" name="lastname" class="form-control input-lg" placeholder="Last name" {{ Input::old('lastname') ? ' value="'. e(Input::old('lastname'))  .'"' : '' }}>
			@if($errors->has('lastname'))
				<p class="help-block">{{ $errors->first('lastname') }}</p>
			@endif
		</div>

		<div class="form-group">
			<input type="text" name="email" id="email_id" class="form-control input-lg" placeholder="E-mail" {{ Input::old('email') ? ' value="'. e(Input::old('email'))  .'"' : '' }}>
			@if($errors->has('email'))
				<p class="help-block">{{ $errors->first('email') }}</p>
			@endif
		</div>

		<div class="form-group">
			<input type="password" name="password" class="form-control input-lg" placeholder="Password">
			@if($errors->has('password'))
				<p class="help-block">{{ $errors->first('password') }}</p>
			@endif
		</div>

		<div class="form-group">
			<input type="password" name="password_again" class="form-control input-lg" placeholder="Password again">
			@if($errors->has('password_again'))
				<p class="help-block">{{ $errors->first('password_again') }}</p>
			@endif
		</div>

		<div class="form-actions">
			<input type="submit" value="Create an account" class="btn btn-primary btn-lg btn-block">
		</div>

		{{ Form::token() }}
	</form>
	<!-- / Form -->

	<div class="signup-with">
		<div class="header">or sign up with</div>
		<a href="{{ URL::route('login-facebook') }}" class="btn btn-lg btn-facebook rounded"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;		
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
			$("#signup-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

			// Validate name
			$("#name_id").rules("add", {
				required: true,
				minlength: 1
			});

			// Validate email
			$("#email_id").rules("add", {
				required: true,
				email: true
			});
			
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

			// Validate confirm checkbox
			$("#confirm_id").rules("add", {
				required: true
			});
		}
	]);
</script>

</body>
</html>
