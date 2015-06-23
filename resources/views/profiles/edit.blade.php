
@extends('layouts.master')

@section('content')

<div class="col-md-12">

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['ProfileController@update', $user->id]]) !!}

    <h2>Vídeos</h2>
    <ul>
        <li>{!! Form::checkbox(PERMISSION_VIDEO_EXECUTE, PERMISSION_VIDEO_EXECUTE, $user->hasPermission(PERMISSION_VIDEO_EXECUTE)) !!} Pode executar vídeos</li>
        <li>{!! Form::checkbox(PERMISSION_VIDEO_CREATE, PERMISSION_VIDEO_CREATE, $user->hasPermission(PERMISSION_VIDEO_CREATE)) !!} Pode criar vídeos</li>
        <li>{!! Form::checkbox(PERMISSION_VIDEO_MANAGE, PERMISSION_VIDEO_MANAGE, $user->hasPermission(PERMISSION_VIDEO_MANAGE)) !!} Pode gerenciar vídeos</li>
    </ul>

    <h2>Artigos</h2>

    <ul>
        <li>{!! Form::checkbox(PERMISSION_ARTICLE_EXECUTE, PERMISSION_ARTICLE_EXECUTE, $user->hasPermission(PERMISSION_ARTICLE_EXECUTE)) !!} Pode executar artigos</li>
        <li>{!! Form::checkbox(PERMISSION_ARTICLE_CREATE, PERMISSION_ARTICLE_CREATE, $user->hasPermission(PERMISSION_ARTICLE_CREATE)) !!} Pode criar artigos</li>
        <li>{!! Form::checkbox(PERMISSION_ARTICLE_MANAGE, PERMISSION_ARTICLE_MANAGE, $user->hasPermission(PERMISSION_ARTICLE_MANAGE)) !!} Pode gerenciar artigos</li>
    </ul>

    <h2>Publicações</h2>

        <ul>
            <li>{!! Form::checkbox(PERMISSION_POST_EXECUTE, PERMISSION_POST_EXECUTE, $user->hasPermission(PERMISSION_POST_EXECUTE)) !!} Pode executar publicações</li>
            <li>{!! Form::checkbox(PERMISSION_POST_CREATE, PERMISSION_POST_CREATE, $user->hasPermission(PERMISSION_POST_CREATE)) !!} Pode criar publicações</li>
            <li>{!! Form::checkbox(PERMISSION_POST_MANAGE, PERMISSION_POST_MANAGE, $user->hasPermission(PERMISSION_POST_MANAGE)) !!} Pode gerenciar publicações</li>
        </ul>

    {!! Form::submit('Salvar') !!}

    {!! Form::close() !!}

</div>

@endsection