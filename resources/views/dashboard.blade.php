
@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1><i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-warning panel-dark widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-bg-icon"><i class="fa {{ Helpers::getRandomIcon() }}"></i></div>
                <img src="{{ Auth::user()->getAvatar() }}" alt="" class="widget-profile-avatar">
                <div class="widget-profile-header">
                    <a href="{{ url('users/'.Auth::id()) }}" target="_blank">
                        <span>{{ Auth::user()->full_name }}</span><br>
                    </a>
                </div>
            </div> <!-- / .panel-heading -->
            <div class="list-group">

                <a href="#" class="list-group-item">
                <i class="{{ App\Article::ICON }} list-group-icon"></i>Artigos trabalhados
                <span class="badge badge-warning">{{ Auth::user()->countTeamByMedia('App\Article') }}</span></a>

                <a href="#" class="list-group-item">
                <i class="{{ App\Video::ICON }} list-group-icon"></i>Vídeos trabalhados
                <span class="badge badge-info">{{ Auth::user()->countTeamByMedia('App\Video') }}</span></a>

                <a href="#" class="list-group-item">
                <i class="{{ App\Post::ICON }} list-group-icon"></i>Posts trabalhados
                <span class="badge badge-danger">{{ Auth::user()->countTeamByMedia('App\Post') }}</span></a>

                <a href="#" class="list-group-item"> Coordena: &nbsp; {!! Auth::user()->isAdmin() ? '<i class="text-primary fa fa-users"></i>' : '' !!}
                                                               &nbsp; {!! Auth::user()->isArticleManager() ? '<i class="text-primary '. \App\Article::ICON.'"></i>' : '' !!}
                                                               &nbsp; {!! Auth::user()->isVideoManager() ? '<i class="text-primary '. \App\Video::ICON.'"></i>' : '' !!}
                                                               &nbsp; {!! Auth::user()->isPostManager() ? '<i class="text-primary '. \App\Post::ICON.'"></i>' : '' !!}</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-panel">
            <div class="stat-row">
                <!-- Success darker background -->
                <div class="stat-cell bg-success darker">
                    <!-- Stat panel bg icon -->
                    <i class="fa fa-lightbulb-o bg-icon" style="font-size:60px;line-height:80px;height:80px;"></i>
                    <!-- Big text -->
                    <span class="text-bg">Visão geral</span><br>
                    <!-- Small text -->
                    <span class="text-sm">Estatísticas do sistema</span>
                </div>
            </div> <!-- /.stat-row -->
            <div class="stat-row">
                <!-- Success background, without bottom border, without padding, horizontally centered text -->
                <div class="stat-counters no-bg no-border-b no-padding text-center">
                    <!-- Small padding, without horizontal padding -->
                    <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                        <!-- Big text -->
                        <span class="text-bg"><strong>{{ $c_articles }}</strong></span><br>
                        <!-- Extra small text -->
                        <span class="text-xs">ARTIGOS</span>
                    </div>
                    <!-- Small padding, without horizontal padding -->
                    <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                        <!-- Big text -->
                        <span class="text-bg"><strong>{{ $c_videos }}</strong></span><br>
                        <!-- Extra small text -->
                        <span class="text-xs">VÍDEOS</span>
                    </div>
                    <!-- Small padding, without horizontal padding -->
                    <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                        <!-- Big text -->
                        <span class="text-bg"><strong>{{ $c_posts }}</strong></span><br>
                        <!-- Extra small text -->
                        <span class="text-xs">POSTS</span>
                    </div>
                </div> <!-- /.stat-counters -->
            </div> <!-- /.stat-row -->
            <div class="stat-row">
                <!-- Success background, without bottom border, without padding, horizontally centered text -->
                <div class="stat-counters no-bg no-border-b no-padding text-center">
                    <!-- Small padding, without horizontal padding -->
                    <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                        <!-- Big text -->
                        <span class="text-bg"><strong>{{ $c_users }}</strong></span><br>
                        <!-- Extra small text -->
                        <span class="text-xs">VOLUNTÁRIOS</span>
                    </div>
                    <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                        <!-- Big text -->
                        <span class="text-bg"><strong>{{ $c_reviews }}</strong></span><br>
                        <!-- Extra small text -->
                        <span class="text-xs">REVISÕES</span>
                    </div>
                    <!-- Success background, small padding, without left and right padding, vertically centered text -->
                    <div class="stat-cell col-xs-4 padding-sm no-padding-hr">
                       <!-- Big text -->
                       <span class="text-bg"><strong>{{ $c_comments }}</strong></span><br>
                       <!-- Extra small text -->
                       <span class="text-xs">COMENTÁRIOS</span>
                    </div>
                </div> <!-- /.stat-counters -->
            </div> <!-- /.stat-row -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary panel-dark panel-body-colorful widget-profile widget-profile-centered">
            <div class="panel-heading">
                <img src="{{ URL::asset('images/projectz.png') }}" alt="">
                <div class="widget-profile-header">
                    <span></span><br>
                    <a href="https://github.com/michaelycus/projectz">https://github.com/michaelycus/projectz</a>
                </div>
            </div> <!-- / .panel-heading -->
            <div class="panel-body">
                <div class="widget-profile-text" style="padding: 0;">
                    <strong>ProjectZ</strong> é um gerenciador de conteúdo open source desenvolvido
                    especialmente para gerenciar as atividades e publicações do Movimento Zeitgeist.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel widget-support-tickets panel-dark-gray">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon {{ \App\Article::ICON }}"></i>Artigos</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body">
                @foreach($articles as $article)
                <div class="ticket">
                    @if ($article->status == \App\Article::STATUS_PUBLISHED)
                    <span class="label label-success ticket-label">
                        {{ $article->getStatusLabels($article->status) }}</span>

                    @elseif ($article->status == \App\Article::STATUS_SCHEDULED)
                    <span class="label label-warning ticket-label">
                        {{ $article->getStatusLabels($article->status) }}</span>

                    @elseif ($article->status == \App\Article::STATUS_EDITING ||
                             $article->status == \App\Article::STATUS_PROOFREADING)
                    <span class="label label-info ticket-label">
                        {{ $article->getStatusLabels($article->status) }}</span>

                    @elseif ($article->status == \App\Article::STATUS_ARCHIVED)
                    <span class="label label-danger ticket-label">
                        {{ $article->getStatusLabels($article->status) }}</span>
                    @endif

                    <a href="{{ url('articles/'.$article->id) }}" target="_blank"
                       title="{{ $article->title }}" class="ticket-title">{{ $article->title }}</a>
                    <span class="ticket-info">
                        Modificado em {{ date("d/m/Y", strtotime($article->updated_at)) }}
                    </span>
                </div>
                @endforeach
            </div> <!-- / .panel-body -->
        </div>
	</div>
	<div class="col-md-4">
        <div class="panel widget-support-tickets panel-danger panel-dark">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon {{ \App\Video::ICON }}"></i>Vídeos</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body">
                @foreach($videos as $video)
                <div class="ticket">
                   @if ($video->status == \App\Video::STATUS_PUBLISHED)
                   <span class="label label-success ticket-label">
                       {{ $video->getStatusLabels($video->status) }}</span>

                   @elseif ($video->status == \App\Video::STATUS_SCHEDULED)
                   <span class="label label-warning ticket-label">
                       {{ $video->getStatusLabels($video->status) }}</span>

                   @elseif ($video->status == \App\Video::STATUS_TRANSCRIPTION ||
                            $video->status == \App\Video::STATUS_SYNCHRONIZATION ||
                            $video->status == \App\Video::STATUS_TRANSLATION ||
                            $video->status == \App\Video::STATUS_PROOFREADING)
                   <span class="label label-info ticket-label">
                       {{ $video->getStatusLabels($video->status) }}</span>

                   @elseif ($video->status == \App\Video::STATUS_ARCHIVED)
                   <span class="label label-danger ticket-label">
                       {{ $video->getStatusLabels($video->status) }}</span>
                   @endif

                    <a href="{{ url('videos/'.$video->id) }}" target="_blank"
                       title="{{ $video->title }}" class="ticket-title">{{ $video->title }}</a>
                    <span class="ticket-info">
                        Modificado em {{ date("d/m/Y", strtotime($video->updated_at)) }}
                    </span>
                </div>
                @endforeach
            </div> <!-- / .panel-body -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel widget-support-tickets panel-info panel-dark">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon {{ \App\Post::ICON }}"></i>Posts</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body">
                @foreach($posts as $post)
                <div class="ticket">
                    @if ($post->status == \App\Post::STATUS_PUBLISHED)
                    <span class="label label-success ticket-label">
                        {{ $post->getStatusLabels($post->status) }}</span>

                    @elseif ($post->status == \App\Post::STATUS_SCHEDULED)
                    <span class="label label-warning ticket-label">
                        {{ $post->getStatusLabels($post->status) }}</span>

                    @elseif ($post->status == \App\Post::STATUS_SUGGESTED ||
                             $post->status == \App\Post::STATUS_PROOFREADING)
                    <span class="label label-info ticket-label">
                        {{ $post->getStatusLabels($post->status) }}</span>

                    @elseif ($post->status == \App\Post::STATUS_ARCHIVED)
                    <span class="label label-danger ticket-label">
                        {{ $post->getStatusLabels($post->status) }}</span>
                    @endif

                    <a href="{{ url('posts/'.$post->id) }}" target="_blank"
                       title="{{ $post->title }}" class="ticket-title">{{ $post->title }}</a>
                    <span class="ticket-info">
                        Modificado em {{ date("d/m/Y", strtotime($post->updated_at)) }}
                    </span>
                </div>
                @endforeach
            </div> <!-- / .panel-body -->
        </div>
    </div>
</div>

@stop

@section('script')

@stop
