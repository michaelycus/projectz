@extends('layouts.master')

@section('content')
<div class="profile-full-name">
    <span class="text-semibold">{{ $user->first_name }}</span> {{ $user->last_name }}
</div>
<div class="profile-row">
    <div class="left-col">
        <div class="profile-block">
            <div class="panel profile-photo">
                <img src="{{ $user->getAvatar() }}" alt="">
            </div><br>
            <a href="#" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Following</a>&nbsp;&nbsp;
            <a href="#" class="btn"><i class="fa fa-comment"></i></a>
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

        <div class="panel panel-transparent">
            <div class="panel-heading">
                <span class="panel-title">Social</span>
            </div>
            <div class="list-group">
                <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-twitter" style="color: #4ab6d5"></i> @dsteiner</a>
                <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-facebook-square" style="color: #1a7ab9"></i> Denise Steiner</a>
                <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-envelope" style="color: #888"></i> dsteiner@example.com</a>
            </div>
        </div>

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
                <div class="tab-pane fade in active" id="profile-tabs-articles">

                    <hr class="no-panel-padding-h panel-wide">

                </div> <!-- / .tab-pane -->
                <div class="widget-support-tickets tab-pane fade" id="profile-tabs-videos">
                    @foreach($videos as $video)
                    <div class="ticket">
                        <span class="label label-success ticket-label">Completed</span>
                        <a href="#" title="" class="ticket-title">Server unavaible<span>[#201798]</span></a>
                        <span class="ticket-info">
                            Criado por <a href="#" title="">Timothy Owens</a> today
                        </span>
                    </div>
                    @endforeach
                </div> <!-- / .tab-pane -->
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