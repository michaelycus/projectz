@extends('layouts.master')

@section('content')
<div class="profile-full-name">
    <span class="text-semibold">{{ $user->first_name }}</span> {{ $user->last_name }}
</div>
<div class="profile-row">
    <div class="left-col">
        <div class="profile-block">
            <div class="panel profile-photo">
                <img src="{{ $user->photo }}" alt="">
            </div><br>
        </div>

        @if ($user->description)
        <div class="panel panel-transparent">
            <div class="panel-heading">
                <span class="panel-title">Sobre mim</span>
            </div>
            <div class="panel-body">
                {{ $user->description }}
            </div>
        </div>
        @endif

        <div class="panel panel-transparent">
            <div class="panel-heading">
                <span class="panel-title">Ajudou em</span>
            </div>
            <div class="list-group">
                <a href="#" class="list-group-item"><strong>{{ $user->countTeamByMedia('App\Article') }}</strong> Artigos</a>
                <a href="#" class="list-group-item"><strong>{{ $user->countTeamByMedia('App\Video') }}</strong> Vídeos</a>
                <a href="#" class="list-group-item"><strong>{{ $user->countTeamByMedia('App\Post') }}</strong> Posts</a>
            </div>
        </div>

        @if ($user->isManager())
        <div class="panel panel-transparent profile-skills">
            <div class="panel-heading">
                <span class="panel-title">Coordena</span>
            </div>
            <div class="panel-body">
                @if ($user->isArticleManager())
                <span class="label label-primary"><i class="{{ App\Article::ICON }}"></i></span>
                @endif
                @if ($user->isVideoManager())
                <span class="label label-primary"><i class="{{ App\Video::ICON }}"></i></span>
                @endif
                @if ($user->isPostManager())
                <span class="label label-primary"><i class="{{ App\Post::ICON }}"></i></span>
                @endif
                @if ($user->isAdmin())
                <span class="label label-primary"><i class="{{ App\Media::ICON }}"></i></span>
                @endif
            </div>
        </div>
        @endif

    </div>
    <div class="right-col">

        <hr class="profile-content-hr no-grid-gutter-h">

        <div class="profile-content">

            <ul id="profile-tabs" class="nav nav-tabs">
                <li class="active">
                    <a href="#profile-tabs-articles" data-toggle="tab">Artigos</a>
                </li>
                <li>
                    <a href="#profile-tabs-videos" data-toggle="tab">Vídeos</a>
                </li>
                <li>
                    <a href="#profile-tabs-posts" data-toggle="tab">Posts</a>
                </li>
            </ul>

            <div class="tab-content tab-content-bordered panel-padding">
                <div class="widget-support-tickets tab-pane fade in active" id="profile-tabs-articles">

                @foreach($user->articles as $article)
                	<div class="ticket">
                		<span class="label label-{{ $article->getColorByStatus($article->status) }} ticket-label">
                			{{ $article->getStatusLabels($article->status) }}</span>

                		<a href="{{ url('articles/'.$article->id) }}" target="_blank"
                		   title="{{ $article->title }}" class="ticket-title">{{ $article->title }}</a>
                		<span class="ticket-info">
                			Criado em {{ date("d/m/Y", strtotime($article->created_at)) }}
                		</span>
                	</div>
                @endforeach

                </div> <!-- / .tab-pane -->
                <div class="widget-support-tickets tab-pane fade" id="profile-tabs-videos">

                    @foreach($user->videos as $video)
                        <div class="ticket">
                            <span class="label label-{{ $video->getColorByStatus($video->status) }} ticket-label">
                                {{ $video->getStatusLabels($video->status) }}</span>

                            <a href="{{ url('videos/'.$video->id) }}" target="_blank"
                               title="{{ $video->title }}" class="ticket-title">{{ $video->title }}</a>
                            <span class="ticket-info">
                                Criado em {{ date("d/m/Y", strtotime($video->created_at)) }}
                            </span>
                        </div>
                    @endforeach

                </div> <!-- / .tab-pane -->
                <div class="widget-support-tickets tab-pane fade" id="profile-tabs-posts">

                    @foreach($user->posts as $post)
                        <div class="ticket">
                            <span class="label label-{{ $post->getColorByStatus($post->status) }} ticket-label">
                                {{ $post->getStatusLabels($post->status) }}</span>

                            <a href="{{ url('posts/'.$post->id) }}" target="_blank"
                               title="{{ $post->title }}" class="ticket-title">{{ $post->title }}</a>
                            <span class="ticket-info">
                                Criado em {{ date("d/m/Y", strtotime($post->created_at)) }}
                            </span>
                        </div>
                    @endforeach

                </div>
            </div> <!-- / .tab-content -->
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('body').addClass('page-profile');
</script>

@endsection