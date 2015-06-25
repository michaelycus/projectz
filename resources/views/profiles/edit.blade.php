
@extends('layouts.master')

@section('content')

<div class="col-md-12">

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['ProfileController@update', $user->id]]) !!}

    {{-- Administration permission --}}

    @if (Auth::user()->hasPermission(PERMISSION_SYSTEM_MANAGER))
    <h2>Administrador</h2>
    <div class="form-group">
        <div class="col-sm-10">
        {!! Form::checkbox(PERMISSION_SYSTEM_MANAGER, PERMISSION_SYSTEM_MANAGER, $user->hasPermission(PERMISSION_SYSTEM_MANAGER)) !!} Pode mudar configurações do sistema
        </div>
    </div>
    @else
        @if ($user->hasPermission(PERMISSION_SYSTEM_MANAGER))
        {!! Form::hidden(PERMISSION_SYSTEM_MANAGER, PERMISSION_SYSTEM_MANAGER) !!}
        @endif
    @endif

    {{-- Video permission --}}

    @if (Auth::user()->hasPermission(PERMISSION_VIDEO_MANAGE) || Auth::user()->hasPermission(PERMISSION_SYSTEM_MANAGER))
    <h2>Vídeos</h2>
    <div class="form-group">
    	<div class="col-sm-10">
    	{!! Form::select(PERMISSION_TYPE_VIDEO,
                    array('' => 'Sem permissão',
                          PERMISSION_VIDEO_EXECUTE => 'Executar',
                          PERMISSION_VIDEO_CREATE  => 'Criar',
                          PERMISSION_VIDEO_MANAGE  => 'Gerenciar'), $user->getPermissionByType(PERMISSION_TYPE_VIDEO)) !!}
    	</div>
    </div>
    @else
        {!! Form::hidden($user->getPermissionByType(PERMISSION_TYPE_VIDEO), $user->getPermissionByType(PERMISSION_TYPE_VIDEO)) !!}
    @endif

    {{-- Article permission --}}

    @if (Auth::user()->hasPermission(PERMISSION_ARTICLE_MANAGE) || Auth::user()->hasPermission(PERMISSION_SYSTEM_MANAGER))
    <h2>Artigos</h2>
    <div class="form-group">
        <div class="col-sm-10">
    {!! Form::select(PERMISSION_TYPE_ARTICLE,
                array('' => 'Sem permissão',
                      PERMISSION_ARTICLE_EXECUTE => 'Executar',
                      PERMISSION_ARTICLE_CREATE  => 'Criar',
                      PERMISSION_ARTICLE_MANAGE  => 'Gerenciar'), $user->getPermissionByType(PERMISSION_TYPE_ARTICLE)) !!}
        </div>
    </div>
    @else
        {!! Form::hidden($user->getPermissionByType(PERMISSION_TYPE_ARTICLE), $user->getPermissionByType(PERMISSION_TYPE_ARTICLE)) !!}
    @endif

    {{-- Post permission --}}

    @if (Auth::user()->hasPermission(PERMISSION_POST_MANAGE) || Auth::user()->hasPermission(PERMISSION_SYSTEM_MANAGER))
    <h2>Publicações</h2>
    <div class="form-group">
        <div class="col-sm-10">
    {!! Form::select(PERMISSION_TYPE_POST,
                    array('' => 'Sem permissão',
                          PERMISSION_POST_EXECUTE => 'Executar',
                          PERMISSION_POST_CREATE  => 'Criar',
                          PERMISSION_POST_MANAGE  => 'Gerenciar'), $user->getPermissionByType(PERMISSION_TYPE_POST)) !!}
        </div>
    </div>
    @else
       {!! Form::hidden($user->getPermissionByType(PERMISSION_TYPE_POST), $user->getPermissionByType(PERMISSION_TYPE_POST)) !!}
    @endif

    {!! Form::submit('Salvar') !!}

    {!! Form::close() !!}

</div>

@endsection