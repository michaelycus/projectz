
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Artigo</span></h1>
</div> 

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">		
				<span class="panel-title">{{ $article->title }}</span>		
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6">			
						@if ($article->project_url != '')
						<p><a href="{{ $article->project_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Projeto</a></p>
						@endif
						@if ($article->source_url != '')				
						<p><a href="{{ $article->source_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Fonte</a></p>
						@endif
					</div>
					<div class="col-xs-6 text-center">
						<img src="http://graph.facebook.com/{{ $article->user->facebook_user_id }}/picture" alt="{{  $article->user->first_name }}" class="user-list pull-right">
						
						<span class="panel-title">{!! $article->user->name !!}</span>
					</div>
				</div>
				<hr>
				<div class="row">
					<?php
					// it can be improved
					if ($article->status == ARTICLE_STATUS_EDITING)
					{
						$back = '';
						$status = 'Em Edição';
						$forward = 'Revisar <i class="fa fa-arrow-right"></i>';
					}
					elseif ($article->status == ARTICLE_STATUS_PROOFREADING)
					{
						$back = '<i class="fa fa-arrow-left"></i> Editar';
						$status = 'Em Revisão';
						$forward = 'Agendar <i class="fa fa-arrow-right"></i>';
					}
					elseif ($article->status == ARTICLE_STATUS_SCHEDULED)
					{
						$back = '<i class="fa fa-arrow-left"></i> Revisar';
						$status = 'Agendado';
						$forward = 'Publicar <i class="fa fa-arrow-right"></i>';
					}
					elseif ($article->status == ARTICLE_STATUS_PUBLISHED)
					{
						$back = '<i class="fa fa-arrow-left"></i> Agendar';
						$status = 'Publicado';
						$forward = '';
					}
					?>

					<div class="col-xs-4">
						@if ($back != '')
						{!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticleController@update', $article->id]]) !!}				
							
								{!! Form::hidden('status', $article->status - 1 ) !!}
								
								{!! Html::decode(Form::button($back, array('class' => 'btn btn-sm btn-default btn-labeled btn-block confirm-move', 'type' => 'submit'))) !!}							

						{!! Form::close() !!}						
						@endif
					</div>
					<div class="col-xs-4 text-center">
						<a href="#" class="label label-info">{!! $status !!}</a>
					</div>
					<div class="col-xs-4">
						@if ($forward != '')
						{!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticleController@update', $article->id]]) !!}				
							
								{!! Form::hidden('status', $article->status + 1 ) !!}
								
								{!! Html::decode(Form::button($forward, array('class' => 'btn btn-sm btn-default btn-labeled btn-block confirm-move', 'type' => 'submit'))) !!}							

						{!! Form::close() !!}						
						@endif
					</div>
				</div>	
			</div>

			<div class="panel-footer">
				<a class="btn btn-xs btn-primary" href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i>Editar</a>
				{!! Form::open(array('class' => 'pull-right delete', 'method' => 'DELETE', 'route' => array('articles.destroy', $article->id))) !!}            
		            {!! Html::decode(Form::button('<i class="fa fa-trash-o"></i> Remover', array('class' => 'btn btn-xs btn-danger', 'type' => 'submit'))) !!}
		        {!! Form::close() !!}
			</div>
		</div>
	</div>

	@include('comments.form', ['resource_id' => $article->id, 'model' => 'App\Article', 'comments' => $article->comments])

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

