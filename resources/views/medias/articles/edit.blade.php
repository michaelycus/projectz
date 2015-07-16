@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1><span class="text-light-gray">Artigos</span></h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel colourable">

            <div class="panel-heading">
                <span class="panel-title">Editar Artigo</span>
            </div>

            {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticleController@update', $article->id]]) !!}

                @include('medias.articles.form', ['submitButtonText' => 'Atualizar Artigo'])

            {!! Form::close() !!}

            @include('errors.list')

        </div>
    </div>
</div>

@stop
