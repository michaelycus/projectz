
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeo</span></h1>
</div> 

<div class="row">
    <div class="col-md-6">
        <div class="panel colourable">
            <div class="panel-heading">
                <span class="panel-title">Editar Vídeo</span>
            </div>

            {!! Form::model($video, ['method' => 'PATCH', 'action' => ['VideoController@update', $video->id]]) !!}

                @include('medias.videos.form', ['submitButtonText' => 'Atualizar Vídeo'])

            {!! Form::close() !!}

            @include('errors.list')

        </div>
    </div>
</div>

@stop
