@extends('layouts.master')

@section('content')


@if (Auth::user()->hasPermission(\App\Permission::POST_CREATE))
<div class="page-header">	
	<h1><span class="text-light-gray">Posts / </span>[EM BREVE]</h1>

	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="posts/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>Criar post
		</a>
	</div>
</div>
@endif

<!-- Em transcrição -->

<div class="row">
@foreach ($posts as $post)
	<div class="col-md-4">
		<div class="panel colourable" style="height: 500px">
			<div class="panel-heading">
				<span class="panel-title"><a href="{!! URL::to('posts', $post->id) !!}">{{ $post->title }}</a></span>
			</div>
			<div class="panel-body">
                <a class="embedly-card" href="{{ $post->source_url }}">{{ $post->source_url }}</a>
                <p>{{ $post->description }}</p>
			</div>
		</div>
	</div>
@endforeach
</div>

@endsection

@section('script')

<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
			
@endsection