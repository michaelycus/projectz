@extends('layouts.master')

@section('content')

<!-- Em transcrição -->

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos / </span>Em transcrição</h1>

	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="videos/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>Criar video
		</a>
	</div>
</div> <!-- / .page-header -->

@foreach ($videos as $video)
@if ($video->status == VIDEO_STATUS_TRANSCRIPTION)

<div class="row" data-panel-id="{{ $video->id }}">
	<div class="col-md-12">
		<div class="panel colourable">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('videos', $video->id) !!}">{{ $video->title }}</a></span>				
			</div>
			<div class="panel-body">
				<div class="col-md-1 text-center valign-middle">					
					<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{!!  $video->user->first_name !!}" class="user-list">
				</div>	

				<div class="col-md-3 text-center text-lg">					
					{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}
				</div>					

				<div class="col-md-3">
					<ul class="list-group no-margin">
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border padding-xs-hr">
							{{ gmdate("H:i:s", $video->duration) }} <i class="fa  fa-clock-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border-hr padding-xs-hr">
							{{ date("d/m/Y", strtotime($video->created_at)) }} <i class="fa  fa-calendar-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, without bottom border, extra small horizontal padding -->
						<li class="list-group-item no-border-hr no-border-b padding-xs-hr">
							{{ $video->comments()->count() }}  comments <i class="fa  fa-comment pull-right"></i>
						</li> <!-- / .list-group-item -->
					</ul>					
				</div>	

				<div class="col-md-4 text-center">					
					<p><a href="{{ $video->original_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger"><span class="btn-label icon fa fa-youtube-play"></span>Vídeo original</a></p>
					<p><a href="{{ $video->working_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning"><span class="btn-label icon fa fa-rocket"></span>Traduzir</a></p>					
				</div>				

				<div class="col-md-1 text-center text-lg">					
					<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
				</div>

			</div>
		</div>
	</div>
</div>
@endif
@endforeach 

<!-- Em sincronização -->

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos / </span>Em sincronização</h1>
</div> 

@foreach ($videos as $video)
@if ($video->status == VIDEO_STATUS_SYNCHRONIZATION)

<div class="row" data-panel-id="{{ $video->id }}">
	<div class="col-md-12">
		<div class="panel colourable">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('videos', $video->id) !!}">{{ $video->title }}</a></span>				
			</div>
			<div class="panel-body">
				<div class="col-md-1 text-center valign-middle">					
					<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{!!  $video->user->first_name !!}" class="user-list">
				</div>	

				<div class="col-md-3 text-center text-lg">					
					{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}
				</div>					

				<div class="col-md-3">
					<ul class="list-group no-margin">
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border padding-xs-hr">
							{{ gmdate("H:i:s", $video->duration) }} <i class="fa  fa-clock-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border-hr padding-xs-hr">
							{{ date("d/m/Y", strtotime($video->created_at)) }} <i class="fa  fa-calendar-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, without bottom border, extra small horizontal padding -->
						<li class="list-group-item no-border-hr no-border-b padding-xs-hr">
							{{ $video->comments()->count() }}  comments <i class="fa  fa-comment pull-right"></i>
						</li> <!-- / .list-group-item -->
					</ul>					
				</div>	

				<div class="col-md-4 text-center">					
					<p><a href="{{ $video->original_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger"><span class="btn-label icon fa fa-youtube-play"></span>Vídeo original</a></p>
					<p><a href="{{ $video->working_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning"><span class="btn-label icon fa fa-rocket"></span>Traduzir</a></p>					
				</div>				

				<div class="col-md-1 text-center text-lg">					
					<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
				</div>

			</div>
		</div>
	</div>
</div>
@endif
@endforeach 

<!-- Em tradução -->

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos / </span>Em tradução</h1>
</div> 

@foreach ($videos as $video)
@if ($video->status == VIDEO_STATUS_TRANSLATION)

<div class="row" data-panel-id="{{ $video->id }}">
	<div class="col-md-12">
		<div class="panel colourable">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('videos', $video->id) !!}">{{ $video->title }}</a></span>				
			</div>
			<div class="panel-body">
				<div class="col-md-1 text-center valign-middle">					
					<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{!!  $video->user->first_name !!}" class="user-list">
				</div>	

				<div class="col-md-3 text-center text-lg">					
					{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}
				</div>					

				<div class="col-md-3">
					<ul class="list-group no-margin">
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border padding-xs-hr">
							{{ gmdate("H:i:s", $video->duration) }} <i class="fa  fa-clock-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border-hr padding-xs-hr">
							{{ date("d/m/Y", strtotime($video->created_at)) }} <i class="fa  fa-calendar-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, without bottom border, extra small horizontal padding -->
						<li class="list-group-item no-border-hr no-border-b padding-xs-hr">
							{{ $video->comments()->count() }}  comments <i class="fa  fa-comment pull-right"></i>
						</li> <!-- / .list-group-item -->
					</ul>					
				</div>	

				<div class="col-md-4 text-center">					
					<p><a href="{{ $video->original_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger"><span class="btn-label icon fa fa-youtube-play"></span>Vídeo original</a></p>
					<p><a href="{{ $video->working_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning"><span class="btn-label icon fa fa-rocket"></span>Traduzir</a></p>					
				</div>				

				<div class="col-md-1 text-center text-lg">					
					<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
				</div>

			</div>
		</div>
	</div>
</div>
@endif
@endforeach 

<!-- Em revisão -->

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos / </span>Em revisão</h1>
</div> 

@foreach ($videos as $video)
@if ($video->status == VIDEO_STATUS_PROOFREADING)

<div class="row" data-panel-id="{{ $video->id }}">
	<div class="col-md-12">
		<div class="panel colourable">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('videos', $video->id) !!}">{{ $video->title }}</a></span>				
			</div>
			<div class="panel-body">
				<div class="col-md-1 text-center valign-middle">					
					<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{!!  $video->user->first_name !!}" class="user-list">
				</div>	

				<div class="col-md-3 text-center text-lg">					
					{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}
				</div>					

				<div class="col-md-3">
					<ul class="list-group no-margin">
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border padding-xs-hr">
							{{ gmdate("H:i:s", $video->duration) }} <i class="fa  fa-clock-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border-hr padding-xs-hr">
							{{ date("d/m/Y", strtotime($video->created_at)) }} <i class="fa  fa-calendar-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, without bottom border, extra small horizontal padding -->
						<li class="list-group-item no-border-hr no-border-b padding-xs-hr">
							{{ $video->comments()->count() }}  comments <i class="fa  fa-comment pull-right"></i>
						</li> <!-- / .list-group-item -->
					</ul>					
				</div>	

				<div class="col-md-4 text-center">					
					<p><a href="{{ $video->original_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger"><span class="btn-label icon fa fa-youtube-play"></span>Vídeo original</a></p>
					<p><a href="{{ $video->working_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning"><span class="btn-label icon fa fa-rocket"></span>Traduzir</a></p>					
				</div>				

				<div class="col-md-1 text-center text-lg">					
					<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
				</div>

			</div>
		</div>
	</div>
</div>
@endif
@endforeach 

<!-- Agendados	 -->

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos / </span>Agendados</h1>
</div> 

@foreach ($videos as $video)
@if ($video->status == VIDEO_STATUS_SCHEDULED)

<div class="row" data-panel-id="{{ $video->id }}">
	<div class="col-md-12">
		<div class="panel colourable">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('videos', $video->id) !!}">{{ $video->title }}</a></span>				
			</div>
			<div class="panel-body">
				<div class="col-md-1 text-center valign-middle">					
					<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{!!  $video->user->first_name !!}" class="user-list">
				</div>	

				<div class="col-md-3 text-center text-lg">					
					{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}
				</div>					

				<div class="col-md-3">
					<ul class="list-group no-margin">
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border padding-xs-hr">
							{{ gmdate("H:i:s", $video->duration) }} <i class="fa  fa-clock-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border-hr padding-xs-hr">
							{{ date("d/m/Y", strtotime($video->created_at)) }} <i class="fa  fa-calendar-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, without bottom border, extra small horizontal padding -->
						<li class="list-group-item no-border-hr no-border-b padding-xs-hr">
							{{ $video->comments()->count() }}  comments <i class="fa  fa-comment pull-right"></i>
						</li> <!-- / .list-group-item -->
					</ul>					
				</div>	

				<div class="col-md-4 text-center">					
					<p><a href="{{ $video->original_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger"><span class="btn-label icon fa fa-youtube-play"></span>Vídeo original</a></p>
					<p><a href="{{ $video->working_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning"><span class="btn-label icon fa fa-rocket"></span>Traduzir</a></p>					
				</div>				

				<div class="col-md-1 text-center text-lg">					
					<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
				</div>

			</div>
		</div>
	</div>
</div>
@endif
@endforeach 

<!-- Publicados -->

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos / </span>Publicados</h1>
</div> 

@foreach ($videos as $video)
@if ($video->status == VIDEO_STATUS_PUBLISHED)

<div class="row" data-panel-id="{{ $video->id }}">
	<div class="col-md-12">
		<div class="panel colourable">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('videos', $video->id) !!}">{{ $video->title }}</a></span>				
			</div>
			<div class="panel-body">
				<div class="col-md-1 text-center valign-middle">					
					<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{!!  $video->user->first_name !!}" class="user-list">
				</div>	

				<div class="col-md-3 text-center text-lg">					
					{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}
				</div>					

				<div class="col-md-3">
					<ul class="list-group no-margin">
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border padding-xs-hr">
							{{ gmdate("H:i:s", $video->duration) }} <i class="fa  fa-clock-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, extra small horizontal padding -->
						<li class="list-group-item no-border-hr padding-xs-hr">
							{{ date("d/m/Y", strtotime($video->created_at)) }} <i class="fa  fa-calendar-o pull-right"></i>
						</li> <!-- / .list-group-item -->
						<!-- Without left and right borders, without bottom border, extra small horizontal padding -->
						<li class="list-group-item no-border-hr no-border-b padding-xs-hr">
							{{ $video->comments()->count() }}  comments <i class="fa  fa-comment pull-right"></i>
						</li> <!-- / .list-group-item -->
					</ul>					
				</div>	

				<div class="col-md-4 text-center">					
					<p><a href="{{ $video->original_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger"><span class="btn-label icon fa fa-youtube-play"></span>Vídeo original</a></p>
					<p><a href="{{ $video->working_link }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning"><span class="btn-label icon fa fa-rocket"></span>Traduzir</a></p>					
				</div>				

				<div class="col-md-1 text-center text-lg">					
					<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
				</div>

			</div>
		</div>
	</div>
</div>
@endif
@endforeach 




@stop

@section('script')

<script type="text/javascript">	

	window.PixelAdmin.start(init);

</script>
			
@stop