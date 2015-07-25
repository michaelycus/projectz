@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1><i class="{{ App\Video::ICON }} page-header-icon"></i>&nbsp;&nbsp;Vídeos</h1>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="stat-panel">
            <div class="stat-row">
                <div class="stat-cell bg-success darker">
                    <i class="{{ App\Video::ICON }} bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                    <span class="text-bg">Visão geral</span><br>
                    <span class="text-sm">Estatísticas dos vídeos</span>
                </div>
            </div>
            <div class="stat-row">
                <div class="stat-counters no-bg no-border-b no-padding text-center">
                    <div class="stat-cell col-xs-2 padding-sm no-padding-hr">
                        <a href="{{ url('videos?status='.\App\Video::STATUS_TRANSCRIPTION) }}">
                            <span class="text-bg"><strong>{{ $c_transcription }}</strong></span><br>
                            <span class="text-xs">EM TRANSCRIÇÃO</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-2 padding-sm no-padding-hr">
                        <a href="{{ url('videos?status='.\App\Video::STATUS_SYNCHRONIZATION) }}">
                            <span class="text-bg"><strong>{{ $c_synchronization }}</strong></span><br>
                            <span class="text-xs">EM SINCRONIZAÇÃO</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-2 padding-sm no-padding-hr">
                        <a href="{{ url('videos?status='.\App\Video::STATUS_TRANSLATION) }}">
                            <span class="text-bg"><strong>{{ $c_translation }}</strong></span><br>
                            <span class="text-xs">EM TRADUÇÃO</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-2 padding-sm no-padding-hr">
                        <a href="{{ url('videos?status='.\App\Video::STATUS_PROOFREADING) }}">
                            <span class="text-bg"><strong>{{ $c_proofreading }}</strong></span><br>
                            <span class="text-xs">EM REVISÃO</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-2 padding-sm no-padding-hr">
                        <a href="{{ url('videos?status='.\App\Video::STATUS_SCHEDULED) }}">
                            <span class="text-bg"><strong>{{ $c_scheduled }}</strong></span><br>
                            <span class="text-xs">AGENDADOS</span>
                        </a>
                    </div>
                    <div class="stat-cell col-xs-2 padding-sm no-padding-hr">
                        <a href="{{ url('videos?status='.\App\Video::STATUS_PUBLISHED) }}">
                            <span class="text-bg"><strong>{{ $c_published }}</strong></span><br>
                            <span class="text-xs">PUBLICADOS</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Últimos vídeos editados</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        @foreach($videos as $video)
                        <tr>
                            <td>
                            <a href="{{ url('users/'.$video->user->id) }}" target="_blank">
                                <img src="{{ $video->user->avatar }}"
                                      alt="{{ $video->user->first_name }}"
                                      class="user-list"/></a></td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->reviews()->count() }} <i class="fa fa-eye"></i>
                                {{ $video->comments()->count() }} <i class="fa fa-comment"></i></td>
                            <td><span class="label label-{{$video->getColorByStatus($video->status)}} ticket-label">
                                {{ $video->getStatusLabels($video->status) }}</span></td>

                            <td><a class="btn btn-xs pull-right"
                                   href="{{ url('videos/'.$video->id) }}">Ver</a></td>
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