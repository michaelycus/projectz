
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Posts</span></h1>
</div> 

<div class="panel col-xs-8">
	<div class="panel-heading">
		<span class="panel-title">Editar Post</span>
	</div>
	<div class="panel-body">		

        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostController@update', $post->id]]) !!}
				
			@include('medias.posts.form', ['submitButtonText' => 'Editar Post'])

		{!! Form::close() !!}

		@include('errors.list')
	
	</div>
</div>

@stop