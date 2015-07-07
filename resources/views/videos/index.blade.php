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

<div class="row">
@foreach ($videos as $video)
	<div class="col-lg-6 col-md-12 col-xs-12">
		<div class="panel colourable">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('videos', $video->id) !!}">{{ $video->title }}</a></span>
				<div class="panel-heading-controls">
				@if (Auth::user()->hasPermission(PERMISSION_VIDEO_CREATE))
                <a class="btn btn-xs  btn-primary btn-outline" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                @endif
                </div>
			</div>
			<div class="panel-body">

			    <div class="row">
                    <div class="col-md-4 text-center text-lg">
                        {!! '<img src="' . $video->thumbnail . '" class="thumbnail_lg_video">' !!}
                    </div>

                    <div class="col-md-4">
                        <ul class="list-group no-margin">
                            <li class="list-group-item no-border padding-xs-hr">
                                {{ gmdate("H:i:s", $video->duration) }} <i class="fa fa-clock-o pull-right"></i>
                            </li>
                            <li class="list-group-item no-border-hr padding-xs-hr">
                                {{ $video->reviews()->count() }} revisões <i class="fa fa-eye pull-right"></i>
                            </li>
                            <li class="list-group-item no-border-hr no-border-b padding-xs-hr">
                                {{ $video->comments()->count() }} comentários <i class="fa fa-comment pull-right"></i>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 text-center">
                        <ul class="list-group no-margin">
                            <li class="list-group-item no-border padding-xs-hr">
                                {{ date("d/m/Y", strtotime($video->created_at)) }} <i class="fa fa-calendar-o pull-right"></i>
                            </li>
                            <li class="list-group-item no-border padding-xs-hr">
                                <a href="{!! URL::to('videos', $video->id) !!}" target="_blank"
                                   class="btn btn-block btn-lg btn-labeled btn-info">Ver</a>
                            </li>
                        </ul>
                    </div>
			    </div>

			    <hr/>

			    <div class="row">
                    <div class="col-md-4 text-center">
                        <strong>Sugerido por:</strong>
                            <img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture"
                                 alt="{!!  $video->user->first_name !!}" class="user-list">
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="{{ $video->source_url }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-danger">Vídeo original</a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="{{ $video->project_url }}" target="_blank" class="btn btn-flat btn-block btn-sm btn-labeled btn-warning">Traduzir</a>
                    </div>
                </div>



			</div>
		</div>
	</div>
 @endforeach
 </div>

@endsection
