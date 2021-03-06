<!DOCTYPE html>

<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>ProjectZ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<!-- <meta http-equiv="pragma" content="no-cache" /> -->

	<link rel="icon" href="{!! URL::asset('images/favicon.png') !!}" />

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
	
	<!-- Font Awesome-->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<!-- Pixel Admin's stylesheets -->	
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/pixel-admin.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/widgets.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/pages.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/rtl.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/themes.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->
</head>
<body class="theme-default mmc main-menu-animated {{ $theme or '' }}">

	<script>var init = [];</script>

	<div id="main-wrapper">

		<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
			<!-- Main menu toggle -->
			<button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i>
			    <span class="hide-menu-text">HIDE MENU</span></button>
			
			<div class="navbar-inner">
				<!-- Main navbar header -->
				<div class="navbar-header">

					<!-- Logo -->
					<a href="{{ url('dashboard') }}" class="navbar-brand">
						<img src="{{ URL::asset('images/logo.png') }}" alt="">
					</a>

					<!-- Main navbar toggle -->
					<button type="button" class="navbar-toggle collapsed"
					        data-toggle="collapse" data-target="#main-navbar-collapse">
					        <i class="navbar-icon fa fa-bars"></i></button>

				</div> <!-- / .navbar-header -->
				<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
					<div>
					    <ul class="nav navbar-nav">
					        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="navbar-icon {{ App\Article::ICON }}"></i> Artigos</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ URL::to('articles?status='.App\Article::STATUS_EDITING) }}"><i class="fa fa-chevron-right"></i> Em edição</a></li>
                                    <li><a href="{{ URL::to('articles?status='.App\Article::STATUS_EDITING) }}"><i class="fa fa-chevron-right"></i> Em revisão</a></li>
                                    <li><a href="{{ URL::to('articles?status='.App\Article::STATUS_EDITING) }}"><i class="fa fa-chevron-right"></i> Agendados</a></li>
                                    <li><a href="{{ URL::to('articles?status='.App\Article::STATUS_EDITING) }}"><i class="fa fa-chevron-right"></i> Publicados</a></li>
                                    <li><a href="{{ URL::to('articles?status='.App\Article::STATUS_EDITING) }}"><i class="fa fa-archive"></i> Arquivados</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-bar-chart"></i> Visão Geral</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ url('articles/create') }}"><i class="fa fa-plus"></i> Novo</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="navbar-icon {{ App\Video::ICON }}"></i> Vídeos</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ URL::to('videos?status='.App\Video::STATUS_TRANSCRIPTION) }}"><i class="fa fa-chevron-right"></i> Em transcrição</a></li>
                                    <li><a href="{{ URL::to('videos?status='.App\Video::STATUS_SYNCHRONIZATION) }}"><i class="fa fa-chevron-right"></i> Em sincronização</a></li>
                                    <li><a href="{{ URL::to('videos?status='.App\Video::STATUS_TRANSLATION) }}"><i class="fa fa-chevron-right"></i> Em tradução</a></li>
                                    <li><a href="{{ URL::to('videos?status='.App\Video::STATUS_PROOFREADING) }}"><i class="fa fa-chevron-right"></i> Em revisão</a></li>
                                    <li><a href="{{ URL::to('videos?status='.App\Video::STATUS_SCHEDULED) }}"><i class="fa fa-chevron-right"></i> Agendados</a></li>
                                    <li><a href="{{ URL::to('videos?status='.App\Video::STATUS_PUBLISHED) }}"><i class="fa fa-chevron-right"></i> Publicados</a></li>
                                    <li><a href="{{ URL::to('videos?status='.App\Video::STATUS_ARCHIVED) }}"><i class="fa fa-archive"></i> Arquivados</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-bar-chart"></i> Visão Geral</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ url('videos/create') }}"><i class="fa fa-plus"></i> Novo</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="navbar-icon {{ App\Post::ICON }}"></i> Posts</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ URL::to('posts?status='.App\Post::STATUS_SUGGESTED) }}"><i class="fa fa-chevron-right"></i> Sugeridos</a></li>
                                    <li><a href="{{ URL::to('posts?status='.App\Post::STATUS_PROOFREADING) }}"><i class="fa fa-chevron-right"></i> Em revisão</a></li>
                                    <li><a href="{{ URL::to('posts?status='.App\Post::STATUS_SCHEDULED) }}"><i class="fa fa-chevron-right"></i> Agendados</a></li>
                                    <li><a href="{{ URL::to('posts?status='.App\Post::STATUS_PUBLISHED) }}"><i class="fa fa-chevron-right"></i> Publicados</a></li>
                                    <li><a href="{{ URL::to('posts?status='.App\Post::STATUS_ARCHIVED) }}"><i class="fa fa-archive"></i> Arquivados</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-bar-chart"></i> Visão Geral</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ url('posts/create') }}"><i class="fa fa-plus"></i> Novo</a></li>
                                </ul>
                            </li>
                        </ul>

						<div class="right clearfix">
							<ul class="nav navbar-nav pull-right right-navbar-nav">
								<!-- /3. $END_NAVBAR_ICON_BUTTONS -->

								<li class="dropdown">
									<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
										<img src="{{ Auth::user()->avatar }}">
										<span>{{ Auth::user()->first_name }}</span>
									</a>
									<ul class="dropdown-menu">
									    @if (Auth::user()->isManager())
										<li><a href="{{ url('permissions') }}"><i class="dropdown-icon fa fa-users"></i>&nbsp;&nbsp;Gerenciar usuários</a></li>
										<li class="divider"></li>
										@endif
										<li><a href="logout"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
									</ul>
								</li>
							</ul> <!-- / .navbar-nav -->
						</div> <!-- / .right -->
					</div>
				</div> <!-- / #main-navbar-collapse -->
			</div> <!-- / .navbar-inner -->
		</div> <!-- / #main-navbar -->
	<!-- /2. $END_MAIN_NAVIGATION -->

	<div id="main-menu" role="navigation">
			<div id="main-menu-inner">
				<div class="menu-content top colapse" id="menu-content-demo">
					<!-- Menu custom content demo
						 CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
						 Javascript: html/assets/demo/demo.js
					 -->
					<div>
						
						<div class="text-bg"><span class="text-slim">Olá,</span> <span class="text-semibold">{{ Auth::user()->first_name }}</span></div>

						<img src="{{ Auth::user()->avatar }}">
						<div class="btn-group">						
							<a href="{{ url('users/'. Auth::id() ) }}" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
							<!-- <a rhef="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a> -->
							<a href="{{ url('logout') }}" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
						</div>
						<a href="#" class="close">&times;</a>
					</div>
				</div>
				<ul class="navigation">
				    <li>
                        <a href="{{ URL::to('articles') }}">
                            <i class="menu-icon {{ App\Article::ICON }}"></i><span class="mm-text">Artigos</span></a>
                    </li>
					<li>
						<a href="{{ URL::to('videos') }}">
						    <i class="menu-icon {{ App\Video::ICON }}"></i><span class="mm-text">Vídeos</span></a>
					</li>
					<li>
                        <a href="{{ URL::to('posts') }}">
                            <i class="menu-icon {{ App\Post::ICON }}"></i><span class="mm-text">Posts</span></a>
                    </li>
				</ul> <!-- / .navigation -->

			</div> <!-- / #main-menu-inner -->
		</div> <!-- / #main-menu -->

				
<!-- /4. $MAIN_MENU -->

		<div id="content-wrapper">
			@include('flash::message')			

			@yield('content')

		</div> <!-- / #content-wrapper -->
		<div id="main-menu-bg"></div>
	</div> <!-- / #main-wrapper -->


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
	<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->

    <script src="http://cdn.embed.ly/jquery.embedly-3.1.1.min.js" type="text/javascript"></script>

<!-- Pixel Admin's javascripts -->
<script src="{{ URL::asset('javascripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('javascripts/pixel-admin.min.js') }}"></script>
<script src="{{ URL::asset('javascripts/custom.js') }}"></script>


@yield('script')

<script>
	// $('#flash-overlay-modal').modal();
	 $('div.alert').not('.alert-important').delay(5000).slideUp(500);
	 window.PixelAdmin.start(init);
</script>

</body>
</html>