@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1><i class="{{ App\Post::ICON }} page-header-icon"></i>&nbsp;&nbsp;Posts</h1>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="stat-panel">
            <div class="stat-row">
                <div class="stat-cell bg-success darker">
                    <i class="{{ App\Post::ICON }} bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                    <span class="text-bg">Visão geral</span><br>
                    <span class="text-sm">Estatísticas dos posts</span>
                </div>
            </div>
            <div class="stat-row">
                <div class="stat-counters no-bg no-border-b no-padding text-center">
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('posts?status='.\App\Post::STATUS_SUGGESTED) }}">
                            <span class="text-bg"><strong>{{ $c_suggested }}</strong></span><br>
                            <span class="text-xs">SUGERIDOS</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('posts?status='.\App\Post::STATUS_PROOFREADING) }}">
                            <span class="text-bg"><strong>{{ $c_proofreading }}</strong></span><br>
                            <span class="text-xs">EM REVISÃO</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('posts?status='.\App\Post::STATUS_SCHEDULED) }}">
                            <span class="text-bg"><strong>{{ $c_scheduled }}</strong></span><br>
                            <span class="text-xs">AGENDADOS</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('posts?status='.\App\Post::STATUS_PUBLISHED) }}">
                            <span class="text-bg"><strong>{{ $c_published }}</strong></span><br>
                            <span class="text-xs">PUBLICADOS</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Últimos posts editados</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>
                            <a href="{{ url('users/'.$post->user->id) }}" target="_blank">
                                <img src="{{ $post->user->avatar }}"
                                      alt="{{ $post->user->first_name }}"
                                      class="user-list"/></a></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->reviews()->count() }} <i class="fa fa-eye"></i>
                                {{ $post->comments()->count() }} <i class="fa fa-comment"></i></td>
                            <td><span class="label label-{{$post->getColorByStatus($post->status)}} ticket-label">
                                {{ $post->getStatusLabels($post->status) }}</span></td>

                            <td><a class="btn btn-xs pull-right"
                                   href="{{ url('posts/'.$post->id) }}">Ver</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-panel">
            <div class="stat-row">
                <div class="stat-cell bordered darker text-center">
                    <i class="{{ App\Media::ICON }} bg-icon" style="font-size:60px;line-height:40px;height:40px;"></i>
                    <span class="text-bg text-center">Administradores</span><br>
                </div>
            </div>
            @foreach($admins as $key => $admin)
            <div class="stat-row">
                <div class="stat-cell bg-{{ Helpers::getOrderBackground($key) }} darker
                    widget-profile widget-profile-centered">
                    <a href="{{ url('users/'.$admin->id) }}">
                        <img src="{{ $admin->photo }}" alt="" class="widget-profile-avatar">
                        <div class="widget-profile-header">
                            <span>{{ $admin->full_name }}</span><br>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop