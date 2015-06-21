
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos</span></h1>
</div> 

<div class="panel col-xs-8">
	<div class="panel-heading">
		<span class="panel-title">Editar Artigo</span>
	</div>
	<div class="panel-body">
		
		{!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticleController@update', $article->id]]) !!}				
				
			@include('articles.form', ['submitButtonText' => 'Atualizar Artigo'])		

		{!! Form::close() !!}

		@include('errors.list')		
	
	</div>
</div>

@stop
