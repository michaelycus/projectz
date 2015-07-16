@extends('layouts.master')

@section('content')
<div class="row">
@foreach($users as $user)

    <div class="col-md-4">
        <div class="panel panel-success panel-dark widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-bg-icon"><i class="fa fa-flask"></i></div>
                <img src="{{ $user->getAvatar() }}" alt="" class="widget-profile-avatar">
                <div class="widget-profile-header">
                    <span>{{ $user->getName() }}</span><br>
                </div>
            </div> <!-- / .panel-heading -->
            <div class="list-group">
                <a href="#" class="list-group-item">
                <i class="fa fa-envelope-o list-group-icon"></i>Inbox messages
                <span class="badge badge-info">14</span></a>

                <a href="#" class="list-group-item">
                <i class="fa fa-tasks list-group-icon"></i>Uncompleted tasks
                <span class="badge badge-warning">7</span></a>

                <a href="#" class="list-group-item">
                <i class="fa fa-bell-o list-group-icon"></i>New notifications
                <span class="badge badge-danger">11</span></a>

                <a href="#" class="list-group-item">Account settings</a>
            </div>
        </div>
    </div>

@endforeach

</div>

@endsection