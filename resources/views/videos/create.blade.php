
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeos</span></h1>
</div> 

<div class="panel col-xs-8">
	<div class="panel-heading">
		<span class="panel-title">Criar Vídeo</span>
	</div>
	<div class="panel-body">		

		{!! Form::open(['url' => 'videos']) !!}				
				
			@include('videos.form', ['submitButtonText' => 'Adicionar Vídeo'])			

		{!! Form::close() !!}

		@include('errors.list')
	
	</div>
</div>

<div class="col-md-4">
	<div class="panel colourable">
		<div class="panel-heading">
			<span class="panel-title"><i class="panel-title-icon fa fa-warning"></i>Serviços Suportados</span>
		</div>
		<div class="panel-body">
			Por hora, apenas vídeos do <a href="http://www.youtube.com" target="_blank">YouTube</a> e <a href="http://www.vimeo.com" target="_blank">Vimeo</a> são suportados.
		</div>
		<div class="panel-footer">
			<a href="http://www.youtube.com" target="_blank"><img src="{{ URL::asset('images/youtube.png') }}" class="logo_videos"></a>
			<a href="http://www.vimeo.com" target="_blank"><img src="{{ URL::asset('images/vimeo.png') }}" class="logo_videos"></a>
		</div>
	</div>
</div>

@stop
