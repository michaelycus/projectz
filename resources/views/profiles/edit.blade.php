
@extends('layouts.master')

@section('content')

<div class="col-md-12">

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['ProfileController@update', $user->id]]) !!}

    {{-- Administration permission --}}

    @if (Auth::user()->hasPermission(\App\Permission::SYSTEM_MANAGER))
    <h2>Administrador</h2>
    <div class="form-group">
        <div class="col-sm-10">
        {!! Form::checkbox(\App\Permission::SYSTEM_MANAGER, \App\Permission::SYSTEM_MANAGER, $user->hasPermission(\App\Permission::SYSTEM_MANAGER)) !!} Pode mudar configurações do sistema
        </div>
    </div>
    @else
        @if ($user->hasPermission(\App\Permission::SYSTEM_MANAGER))
        {!! Form::hidden(\App\Permission::SYSTEM_MANAGER, \App\Permission::SYSTEM_MANAGER) !!}
        @endif
    @endif

    {{-- Video permission --}}

    @if (Auth::user()->hasPermission(\App\Permission::VIDEO_MANAGE) || Auth::user()->hasPermission(\App\Permission::SYSTEM_MANAGER))
    <h2>Vídeos</h2>
    <div class="form-group">
    	<div class="col-sm-10">
    	{!! Form::select(\App\Permission::TYPE_VIDEO,
                    array('' => 'Sem permissão',
                          \App\Permission::VIDEO_EXECUTE => 'Executar',
                          \App\Permission::VIDEO_CREATE  => 'Criar',
                          \App\Permission::VIDEO_MANAGE  => 'Gerenciar'), $user->getPermissionByType(\App\Permission::TYPE_VIDEO)) !!}
    	</div>
    </div>
    @else
        {!! Form::hidden($user->getPermissionByType(\App\Permission::TYPE_VIDEO), $user->getPermissionByType(\App\Permission::TYPE_VIDEO)) !!}
    @endif

    {{-- Article permission --}}

    @if (Auth::user()->hasPermission(\App\Permission::ARTICLE_MANAGE) || Auth::user()->hasPermission(\App\Permission::SYSTEM_MANAGER))
    <h2>Artigos</h2>
    <div class="form-group">
        <div class="col-sm-10">
    {!! Form::select(\App\Permission::TYPE_ARTICLE,
                array('' => 'Sem permissão',
                      \App\Permission::ARTICLE_EXECUTE => 'Executar',
                      \App\Permission::ARTICLE_CREATE  => 'Criar',
                      \App\Permission::ARTICLE_MANAGE  => 'Gerenciar'), $user->getPermissionByType(\App\Permission::TYPE_ARTICLE)) !!}
        </div>
    </div>
    @else
        {!! Form::hidden($user->getPermissionByType(\App\Permission::TYPE_ARTICLE), $user->getPermissionByType(\App\Permission::TYPE_ARTICLE)) !!}
    @endif

    {{-- Post permission --}}

    @if (Auth::user()->hasPermission(\App\Permission::POST_MANAGE) || Auth::user()->hasPermission(\App\Permission::SYSTEM_MANAGER))
    <h2>Publicações</h2>
    <div class="form-group">
        <div class="col-sm-10">
    {!! Form::select(\App\Permission::TYPE_POST,
                    array('' => 'Sem permissão',
                          \App\Permission::POST_EXECUTE => 'Executar',
                          \App\Permission::POST_CREATE  => 'Criar',
                          \App\Permission::POST_MANAGE  => 'Gerenciar'), $user->getPermissionByType(\App\Permission::TYPE_POST)) !!}
        </div>
    </div>
    @else
       {!! Form::hidden($user->getPermissionByType(\App\Permission::TYPE_POST), $user->getPermissionByType(\App\Permission::TYPE_POST)) !!}
    @endif

    {!! Form::submit('Salvar') !!}

    {!! Form::close() !!}

</div>

@endsection