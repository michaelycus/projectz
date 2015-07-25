@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1><i class="{{ App\Article::ICON }} page-header-icon"></i>&nbsp;&nbsp;Artigos</h1>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="stat-panel">
            <div class="stat-row">
                <div class="stat-cell bg-success darker">
                    <i class="{{ App\Article::ICON }} bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                    <span class="text-bg">Visão geral</span><br>
                    <span class="text-sm">Estatísticas dos artigos</span>
                </div>
            </div>
            <div class="stat-row">
                <div class="stat-counters no-bg no-border-b no-padding text-center">
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('articles?status='.\App\Article::STATUS_EDITING) }}">
                            <span class="text-bg"><strong>{{ $c_editing }}</strong></span><br>
                            <span class="text-xs">EM EDIÇÃO</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('articles?status='.\App\Article::STATUS_PROOFREADING) }}">
                            <span class="text-bg"><strong>{{ $c_proofreading }}</strong></span><br>
                            <span class="text-xs">EM REVISÃO</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('articles?status='.\App\Article::STATUS_SCHEDULED) }}">
                            <span class="text-bg"><strong>{{ $c_scheduled }}</strong></span><br>
                            <span class="text-xs">AGENDADOS</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-3 padding-sm no-padding-hr">
                        <a href="{{ url('articles?status='.\App\Article::STATUS_PUBLISHED) }}">
                            <span class="text-bg"><strong>{{ $c_published }}</strong></span><br>
                            <span class="text-xs">PUBLICADOS</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Últimos artigos editados</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td>
                            <a href="{{ url('users/'.$article->user->id) }}" target="_blank">
                                <img src="{{ $article->user->avatar }}"
                                      alt="{{ $article->user->first_name }}"
                                      class="user-list"/></a></td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->reviews()->count() }} <i class="fa fa-eye"></i>
                                {{ $article->comments()->count() }} <i class="fa fa-comment"></i></td>
                            <td><span class="label label-{{$article->getColorByStatus($article->status)}} ticket-label">
                                {{ $article->getStatusLabels($article->status) }}</span></td>

                            <td><a class="btn btn-xs pull-right"
                                   href="{{ url('articles/'.$article->id) }}">Ver</a></td>
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