
@extends('layouts.master')

@section('content')

<div class="page-header">
	<h1><span class="text-light-gray">Usuários cadastrados</span></h1>
</div>

<div class="col-md-12">
    <div class="panel panel-dark panel-light-blue">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Admin</th>
                    <th>Vídeos</th>
                    <th>Artigos</th>
                    <th>Posts</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="valign-middle">

                @foreach( $users as $user )
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <img src="{{ $user->getAvatar() }}" alt="" style="width:26px;height:26px;" class="rounded">
                        &nbsp;&nbsp;<a href="#" title="">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{!! $user->hasPermission(\App\Permission::SYSTEM_MANAGER) ? \App\Permission::PERMISSION_YES : \App\Permission::PERMISSION_NO !!}</td>

                    <td>
                        @if ($user->hasPermission(\App\Permission::VIDEO_MANAGE))
                        Gerenciar
                        @elseif($user->hasPermission(\App\Permission::VIDEO_CREATE))
                        Criar
                        @elseif($user->hasPermission(\App\Permission::VIDEO_EXECUTE))
                        Executar
                        @else
                        Sem permissão
                        @endif
                    </td>
                    <td>
                        @if ($user->hasPermission(\App\Permission::ARTICLE_MANAGE))
                        Gerenciar
                        @elseif($user->hasPermission(\App\Permission::ARTICLE_CREATE))
                        Criar
                        @elseif($user->hasPermission(\App\Permission::ARTICLE_EXECUTE))
                        Executar
                        @else
                        Sem permissão
                        @endif
                    </td>
                    <td>
                        @if ($user->hasPermission(\App\Permission::POST_MANAGE))
                        Gerenciar
                        @elseif($user->hasPermission(\App\Permission::POST_CREATE))
                        Criar
                        @elseif($user->hasPermission(\App\Permission::POST_EXECUTE))
                        Executar
                        @else
                        Sem permissão
                        @endif
                    </td>
                    <th><a href="{{ url('profiles/'.$user->id.'/edit') }}">Editar permissões</a></th>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div> <!-- / .panel -->
</div>

@endsection