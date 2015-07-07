@extends('layouts.master')

@section('content')

<div class="page-header">
    @if (Input::get('status'))
	<h1><span class="text-light-gray">Vídeos / </span>{{ unserialize(VIDEO_STATUS_LABELS)[Input::get('status')] }}</h1>
    @endif

    @if (Auth::user()->hasPermission(PERMISSION_VIDEO_CREATE))
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="videos/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>Criar video
		</a>
	</div>
	@endif
</div>

@foreach ($videos as $video)
<div class="row">
	<div class="col-lg-6 col-md-12 col-xs-12">
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

				<div class="col-md-4">
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
						    <a href="{!! URL::to('videos', $video->id) !!}">
						        {{ $video->comments()->count() }}  comentários <i class="fa  fa-comment pull-right"></i>
                            </a>
						</li> <!-- / .list-group-item -->
					</ul>					
				</div>	

				<div class="col-md-3 text-center">
					<p><a href="{{ $video->source_url }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger"><span class="btn-label icon fa fa-youtube-play"></span>Vídeo</a></p>
					<p><a href="{{ $video->project_url }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning"><span class="btn-label icon fa fa-rocket"></span>Traduzir</a></p>
				</div>				

				<div class="col-md-1 text-center text-lg">
				    @if (Auth::user()->hasPermission(PERMISSION_VIDEO_CREATE))
					<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
					@endif
				</div>

			</div>
		</div>
	</div>
 </div>
 @endforeach

@stop
