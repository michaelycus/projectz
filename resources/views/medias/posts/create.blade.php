
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Posts</span></h1>
</div> 

<div class="panel col-xs-8">
	<div class="panel-heading">
		<span class="panel-title">Criar Post</span>
	</div>
	<div class="panel-body">		

		{!! Form::open(['url' => 'posts']) !!}
				
			@include('medias.posts.form', ['submitButtonText' => 'Adicionar Post'])

		{!! Form::close() !!}

		@include('errors.list')
	
	</div>
</div>

@stop
