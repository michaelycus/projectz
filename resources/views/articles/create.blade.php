
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos</span></h1>
</div> 

<div class="panel col-xs-8">
	<div class="panel-heading">
		<span class="panel-title">Criar Artigo</span>
	</div>
	<div class="panel-body">		

		{!! Form::open(['url' => 'articles']) !!}				
				
			@include('articles.form', ['submitButtonText' => 'Adicionar Artigo'])			

		{!! Form::close() !!}

		@include('errors.list')
	
	</div>
</div>

@stop
