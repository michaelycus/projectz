@extends('layouts.master')

@section('content')
<div class="row">
@foreach($users as $key => $user)

    <div class="col-md-4">
        <div class="panel panel-{{ Helpers::getOrderBackground($key) }} panel-dark widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-bg-icon"><i class="fa {{ Helpers::getRandomIcon() }}"></i></div>
                <img src="{{ $user->photo }}" alt="" class="widget-profile-avatar">
                <div class="widget-profile-header">
                    <a href="{{ url('users/'.$user->id) }}" target="_blank">
                        <span>{{ $user->full_name }}</span><br>
                    </a>
                </div>
            </div> <!-- / .panel-heading -->
            <div class="list-group">

                <a href="#" class="list-group-item">
                <i class="{{ App\Article::ICON }} list-group-icon"></i>Artigos trabalhados
                <span class="badge badge-warning">{{ $user->countTeamByMedia('App\Article') }}</span></a>

                <a href="#" class="list-group-item">
                <i class="{{ App\Video::ICON }} list-group-icon"></i>Vídeos trabalhados
                <span class="badge badge-info">{{ $user->countTeamByMedia('App\Video') }}</span></a>

                <a href="#" class="list-group-item">
                <i class="{{ App\Post::ICON }} list-group-icon"></i>Posts trabalhados
                <span class="badge badge-danger">{{ $user->countTeamByMedia('App\Post') }}</span></a>

                <a href="#" class="list-group-item"> Coordena: &nbsp; {!! $user->isAdmin() ? '<i class="text-primary fa fa-users"></i>' : '' !!}
                                                               &nbsp; {!! $user->isArticleManager() ? '<i class="text-primary '. \App\Article::ICON.'"></i>' : '' !!}
                                                               &nbsp; {!! $user->isVideoManager() ? '<i class="text-primary '. \App\Video::ICON.'"></i>' : '' !!}
                                                               &nbsp; {!! $user->isPostManager() ? '<i class="text-primary '. \App\Post::ICON.'"></i>' : '' !!}</a>
            </div>
        </div>
    </div>

@endforeach

</div>
 <div class="row">
    <div class="text-center">
         {!! $users->render() !!}
     </div>
 </div>

@endsection