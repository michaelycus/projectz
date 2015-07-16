@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Posts</span></h1>
</div> 

<div class="row">
    <div class="col-md-6">
        <div class="panel colourable">
            <div class="panel-heading">
                <span class="panel-title">Criar Post</span>
            </div>

            {!! Form::open(['url' => 'posts']) !!}

                @include('medias.posts.form', ['submitButtonText' => 'Adicionar Post'])

            {!! Form::close() !!}

            @include('errors.list')
	    </div>
	</div>
</div>

@stop
