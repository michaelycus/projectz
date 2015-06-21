@extends('layouts.auth')

@section('content')

<body class="theme-default page-signup">

	<!-- Page background -->
	<div id="page-signup-bg">
		<!-- Background overlay -->
		<div class="overlay"></div>
		<!-- Replace this with your bg image -->
		<img src="{{ URL::asset('images/background.jpg') }}" alt="">
	</div>
	<!-- / Page background -->

	<!-- Container -->
	<div class="signup-container">
		<!-- Header -->
		<div class="signup-header">
			<a href="{{ url('auth/login') }}" class="logo">
				<img src="{{ URL::asset('images/logo_front.png') }}" alt="" style="margin-top: -5px;">&nbsp;
				ProjectZ
			</a> <!-- / .logo -->
			<div class="slogan">
				Juntos. Nós. Fazemos.
			</div> <!-- / .slogan -->
		</div>
		<!-- / Header -->

		<!-- Form -->
		<div class="signup-form">
		    <form method="POST" action="/auth/register" id="signup-form_id">
		        {!! csrf_field() !!}
				
				<div class="signup-text">
					<span>Criar uma conta</span>
				</div>

				<div class="form-group w-icon">
					<input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
					class="form-control input-lg" placeholder="Primeiro nome">
					<span class="fa fa-info signup-form-icon"></span>
				</div>

				<div class="form-group w-icon">
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                    class="form-control input-lg" placeholder="Sobrenome">
                    <span class="fa fa-info signup-form-icon"></span>
                </div>

				<div class="form-group w-icon">
					<input type="text" name="email" id="email" value="{{ old('email') }}"
					class="form-control input-lg" placeholder="E-mail">
					<span class="fa fa-envelope signup-form-icon"></span>
				</div>

				<div class="form-group w-icon">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
					<span class="fa fa-lock signup-form-icon"></span>
				</div>

				<div class="form-group w-icon">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirmar password">
                    <span class="fa fa-lock signup-form-icon"></span>
                </div>

				<div class="form-actions">
					<input type="submit" value="REGISTRAR" class="signup-btn bg-primary">
				</div>
			</form>
			<!-- / Form -->

			<!-- "Sign In with" block -->
			<div class="signup-with">
				<!-- Facebook -->
				<a href="{!! url('login/facebook') !!}" class="signup-with-btn" style="background:#4f6faa;background:rgba(79, 111, 170, .8);">
				Acessar com <span>Facebook</span></a>
			</div>
			<!-- / "Sign In with" block -->
		</div>
		<!-- Right side -->
	</div>

    <div class="have-account">
		Já possui uma conta? <a href="{{ url('auth/login') }}">Acesse</a>
	</div>


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="{{ URL::asset('javascripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('javascripts/pixel-admin.min.js') }}"></script>

<script type="text/javascript">
   var init = [];

	// Resize BG
	init.push(function () {
		var $ph  = $('#page-signup-bg'),
		    $img = $ph.find('> img');

		$(window).on('resize', function () {
			$img.attr('style', '');
			if ($img.height() < $ph.height()) {
				$img.css({
					height: '100%',
					width: 'auto'
				});
			}
		});

		$("#signup-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

		// Validate name
		$("#first_name").rules("add", {
			required: true,
			minlength: 1
		});

		$("#last_name").rules("add", {
            required: true,
            minlength: 1
        });

		// Validate email
		$("#email").rules("add", {
			required: true,
			email: true
		});

		// Validate password
		$("#password").rules("add", {
			required: true,
			minlength: 6
		});

		$("#password_confirmation").rules("add", {
            required: true,
            minlength: 6,
            equalTo: '#password'
        });
	});

	window.PixelAdmin.start(init);
</script>

</body>

@endsection