
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos</span></h1>
</div> 

<div class="panel col-xs-8">
	<div class="panel-heading">
		<span class="panel-title">Editar Vídeo</span>
	</div>
	<div class="panel-body">
		
		{!! Form::model($video, ['method' => 'PATCH', 'action' => ['VideoController@update', $video->id]]) !!}				
				
			@include('videos.form', ['submitButtonText' => 'Atualizar Vídeo'])		

		{!! Form::close() !!}

		@include('errors.list')		
	
	</div>
</div>

@stop
