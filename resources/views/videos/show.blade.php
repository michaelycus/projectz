
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeo</span></h1>
</div> 

<div class="row">
	<div class="col-md-6">

		<div class="panel">
			<div class="panel-heading">		
				<span class="panel-title">{{ $video->title }}</span>		
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6">		

						<div class="row">
							<div class="col-xs-12">													
								{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}								
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">	
								<hr>
								<p><a href="{{ $video->video_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Url do vídeo</a></p>						
						
								<p><a href="{{ $video->project_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Url do projeto</a></p>
							</div>
						</div>					
						
					</div>
					<div class="col-xs-6 center valign-middle">

						<div class="row">
							<div class="col-xs-12 text-center text-slim">													
								Sugerido por:							
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 text-center padding-sm">													
								<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{{  $video->user->firstname }}" class="user-list">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 text-center">													
								<span class="panel-title">{{ $video->user->name }}</span> 							
							</div>
						</div>
		
					</div>
				</div>
				<hr>
				<div class="row">
					<?php
					// it can be improved
					if ($video->status == VIDEO_STATUS_TRANSCRIPTION)
					{
						$back = '';
						$status = 'Em transcrição';
						$forward = 'Sincronizar <i class="fa fa-arrow-right"></i>';
					}
					elseif ($video->status == VIDEO_STATUS_SYNCHRONIZATION)
					{
						$back = '<i class="fa fa-arrow-left"></i> Transcrever';
						$status = 'Sincronizando';
						$forward = 'Traduzir <i class="fa fa-arrow-right"></i>';
					}
					elseif ($video->status == VIDEO_STATUS_TRANSLATION)
					{
						$back = '<i class="fa fa-arrow-left"></i> Sincronizar';
						$status = 'Traduzindo';
						$forward = 'Revisar <i class="fa fa-arrow-right"></i>';
					}
					elseif ($video->status == VIDEO_STATUS_PROOFREADING)
					{
						$back = '<i class="fa fa-arrow-left"></i> Traduzir';
						$status = 'Revisando';
						$forward = 'Agendar <i class="fa fa-arrow-right"></i>';
					}
					elseif ($video->status == VIDEO_STATUS_SCHEDULED)
					{
						$back = '<i class="fa fa-arrow-left"></i> Revisar';
						$status = 'Agendado';
						$forward = 'Publicar <i class="fa fa-arrow-right"></i>';
					}
					elseif ($video->status == VIDEO_STATUS_PUBLISHED)
					{
						$back = '<i class="fa fa-arrow-left"></i> Agendar';
						$status = 'Publicado';
						$forward = '';
					}
					?>

					<div class="col-xs-4">
						@if ($back != '')
						{!! Form::model($video, ['method' => 'PATCH', 'action' => ['VideoController@update', $video->id]]) !!}				
							
								{!! Form::hidden('status', $video->status - 1 ) !!}
								
								{!! Html::decode(Form::button($back, array('class' => 'btn btn-sm btn-default btn-labeled btn-block confirm-move', 'type' => 'submit'))) !!}							

						{!! Form::close() !!}						
						@endif
					</div>
					<div class="col-xs-4 text-center">
						<a href="#" class="label label-info">{!! $status !!}</a>
					</div>
					<div class="col-xs-4">
						@if ($forward != '')
						{!! Form::model($video, ['method' => 'PATCH', 'action' => ['VideoController@update', $video->id]]) !!}				
							
								{!! Form::hidden('status', $video->status + 1 ) !!}
								
								{!! Html::decode(Form::button($forward, array('class' => 'btn btn-sm btn-default btn-labeled btn-block confirm-move', 'type' => 'submit'))) !!}							

						{!! Form::close() !!}						
						@endif
					</div>
				</div>	
			</div>

			<div class="panel-footer">
				<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i>Editar</a>
				{!! Form::open(array('class' => 'pull-right delete', 'method' => 'DELETE', 'route' => array('videos.destroy', $video->id))) !!}            
		            {!! Html::decode(Form::button('<i class="fa fa-trash-o"></i> Remover', array('class' => 'btn btn-xs btn-danger', 'type' => 'submit'))) !!}            
		        {!! Form::close() !!}
			</div>
		</div>
	</div>

	@include('comments.form', ['resource_id' => $video->id, 'model' => 'App\Video', 'comments' => $video->comments])

</div>


@stop


@section('script')

<script type="text/javascript">
	init.push(function () {
		$('#profile-tabs').tabdrop();

		$("#leave-comment-form").expandingInput({
			target: 'textarea',
			hidden_content: '> div',
			placeholder: 'O que você acha?',
			onAfterExpand: function () {
				$('#leave-comment-form textarea').attr('rows', '3').autosize();
			}
		});
	})
	window.PixelAdmin.start(init);
</script>


@stop

