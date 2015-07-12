@extends('layouts.master')

@section('content')


@if (Auth::user()->hasPermission(\App\Permission::POST_CREATE))
<div class="page-header">	
	<h1><span class="text-light-gray">Posts / </span>
	    {{ with(new App\Post)->getStatusLabels()[Input::get('status')] }}</h1>
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="posts/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>Criar post
		</a>
	</div>
</div>
@endif

<div class="row">
@foreach ($posts as $post)
	<div class="col-md-4">
		<div class="panel colourable" style="height: 500px">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('posts', $post->id) !!}">{{ $post->title }}</a></span>
				<div class="panel-heading-controls">
                    @if (Auth::user()->hasPermission(\App\Permission::POST_CREATE))
                    <a class="btn btn-xs  btn-primary btn-outline"
                       href="{{ URL::to('articles/' . $post->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                    @endif
                </div>
			</div>

			<div class="panel-body">

			    <div class="panel">
                    <div class="panel-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-review" href="#collapse_{{ $post->id }}">
                             <img src="http://graph.facebook.com/{{ $post->user->facebook_user_id }}/picture"
                                 alt="{{  $post->user->first_name }}" class="user-tiny">
                             <i class="fa fa-caret-right"></i> Sugestão de {{ $post->user->first_name }}
                        </a>
                    </div> <!-- / .panel-heading -->
                    <div id="collapse_{{ $post->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>{{  $post->description }}</p>
                        </div> <!-- / .panel-body -->
                    </div> <!-- / .collapse -->
                </div>

                <a class="embedly-card" href="{{ $post->source_url }}">{{ $post->source_url }}</a>
                <p>{{ $post->description }}</p>
			</div>
		</div>
	</div>
@endforeach
</div>
<div class="row">
    <div class="text-center">
         {!! $posts->appends(['status' => Input::get('status')])->render() !!}
    </div>
</div>

@endsection

@section('script')

<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
			
@endsection