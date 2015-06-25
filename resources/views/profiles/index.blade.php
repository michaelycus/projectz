
@extends('layouts.master')

@section('content')

<div class="col-md-12">
    <div class="panel panel-dark panel-light-blue">
        <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-user"></i>Membros registrados </span>
        </div> <!-- / .panel-heading -->
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
                    <td>{!! $user->hasPermission(PERMISSION_SYSTEM_MANAGER) ? PERMISSION_YES : PERMISSION_NO !!}</td>

                    <td>
                        @if ($user->hasPermission(PERMISSION_VIDEO_MANAGE))
                        Gerenciar
                        @elseif($user->hasPermission(PERMISSION_VIDEO_CREATE))
                        Criar
                        @elseif($user->hasPermission(PERMISSION_VIDEO_EXECUTE))
                        Executar
                        @else
                        Sem permissão
                        @endif
                    </td>
                    <td>
                        @if ($user->hasPermission(PERMISSION_ARTICLE_MANAGE))
                        Gerenciar
                        @elseif($user->hasPermission(PERMISSION_ARTICLE_CREATE))
                        Criar
                        @elseif($user->hasPermission(PERMISSION_ARTICLE_EXECUTE))
                        Executar
                        @else
                        Sem permissão
                        @endif
                    </td>
                    <td>
                        @if ($user->hasPermission(PERMISSION_POST_MANAGE))
                        Gerenciar
                        @elseif($user->hasPermission(PERMISSION_POST_CREATE))
                        Criar
                        @elseif($user->hasPermission(PERMISSION_POST_EXECUTE))
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