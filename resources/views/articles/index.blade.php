
@extends('layouts.master')

@section('content')

<!-- Em edição -->

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos /</span> Em edição</h1>

    @if (Auth::user()->hasPermission(PERMISSION_ARTICLE_CREATE))
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="articles/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>Criar artigo
		</a>
	</div>
	@endif

</div> <!-- / .page-header -->


<div class="panel">	
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Criado por</th>
					<th>Links</th>
					<th>Título</th>
					<th style="text-align: right"></th>						
				</tr>
			</thead>
			<tbody>
				@foreach ($articles as $article)
				@if ($article->status == ARTICLE_STATUS_EDITING)
				<tr>					
					<td><img src="http://graph.facebook.com/{!! $article->user->facebook_user_id !!}/picture" alt="{{  $article->user->first_name }}" class="user-list"></td>
					<td>
						@if ($article->project_url != '')
						<a href="{{ $article->project_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
						@if ($article->source_url != '')
						&nbsp;&nbsp;<a href="{{ $article->source_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
					</td>
					<td>
						<a href="{{ URL::to('articles/' . $article->id . '') }}">{{ $article->title }}</a>
					</td>

					<td>
						<span class="pull-right">
							<a href="{{ URL::to('articles/' . $article->id . '') }}">
								<small>{{ count($article->comments) }} <span class="btn-label icon fa fa-comment"></small>
							</a>
							&nbsp;&nbsp;
							@if (Auth::user()->isArticleManager())
							<a class="btn btn-xs btn-primary" href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i></a>
							@endif
						</span>
					</td>
				</tr>
				@endif						
				@endforeach				
			</tbody>
		</table>
	</div>
</div>

<!-- Em revisão -->

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos /</span> Em revisão</h1>
</div> <!-- / .page-header -->


<div class="panel">	
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Criado por</th>
					<th>Links</th>
					<th>Título</th>						
					<!-- <th style="text-align: right">Revisado por</th> -->
					<th style="text-align: right"></th>						
				</tr>
			</thead>
			<tbody>
				@foreach ($articles as $article)
				@if ($article->status == ARTICLE_STATUS_PROOFREADING)
				<tr>					
					<td><img src="http://graph.facebook.com/{!! $article->user->facebook_user_id !!}/picture" alt="{{  $article->user->first_name }}" class="user-list"></td>
					<td>
						@if ($article->project_url != '')
						<a href="{{ $article->project_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
						@if ($article->source_url != '')
						&nbsp;&nbsp;<a href="{{ $article->source_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
					</td>
					<td>
						<a href="{{ URL::to('articles/' . $article->id . '') }}">{{ $article->title }}</a>
					</td>

					<td>
						<span class="pull-right">
							<a href="{{ URL::to('articles/' . $article->id . '') }}">
								<small>{{ count($article->comments) }} <span class="btn-label icon fa fa-comment"></small>
							</a>
							&nbsp;&nbsp;
							@if (Auth::user()->isArticleManager())
                            <a class="btn btn-xs btn-primary" href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                            @endif
						</span>
					</td>
				</tr>
				@endif							
				@endforeach				
			</tbody>
		</table>
	</div>
</div>

<!-- Agendados -->

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos /</span> Agendados</h1>
</div> <!-- / .page-header -->


<div class="panel">	
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Criado por</th>
					<th>Links</th>
					<th>Título</th>						
					<!-- <th style="text-align: right">Revisado por</th> -->
					<th style="text-align: right"></th>						
				</tr>
			</thead>
			<tbody>
				@foreach ($articles as $article)
				@if ($article->status == ARTICLE_STATUS_SCHEDULED)
				<tr>					
					<td><img src="http://graph.facebook.com/{!! $article->user->facebook_user_id !!}/picture" alt="{{  $article->user->first_name }}" class="user-list"></td>
					<td>
						@if ($article->project_url != '')
						<a href="{{ $article->project_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
						@if ($article->source_url != '')
						&nbsp;&nbsp;<a href="{{ $article->source_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
					</td>
					<td>
						<a href="{{ URL::to('articles/' . $article->id . '') }}">{{ $article->title }}</a>
					</td>

					<td>
						<span class="pull-right">
							<a href="{{ URL::to('articles/' . $article->id . '') }}">
								<small>{{ count($article->comments) }} <span class="btn-label icon fa fa-comment"></small>
							</a>
							&nbsp;&nbsp;
							@if (Auth::user()->isArticleManager())
                            <a class="btn btn-xs btn-primary" href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                            @endif
						</span>
					</td>
				</tr>
				@endif							
				@endforeach				
			</tbody>
		</table>
	</div>
</div>

<!-- Publicados -->

<div class="page-header">	
	<h1><span class="text-light-gray">Artigos /</span> Publicados</h1>
</div> <!-- / .page-header -->


<div class="panel">	
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Criado por</th>
					<th>Links</th>
					<th>Título</th>						
					<!-- <th style="text-align: right">Revisado por</th> -->
					<th style="text-align: right"></th>						
				</tr>
			</thead>
			<tbody>
				@foreach ($articles as $article)
				@if ($article->status == ARTICLE_STATUS_PUBLISHED)
				<tr>					
					<td><img src="http://graph.facebook.com/{!! $article->user->facebook_user_id !!}/picture" alt="{{  $article->user->first_name }}" class="user-list"></td>
					<td>
						@if ($article->project_url != '')
						<a href="{{ $article->project_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
						@if ($article->source_url != '')
						&nbsp;&nbsp;<a href="{{ $article->source_url }}" target="_blank"><span class="btn-label icon fa fa-file-text-o"></span></a>
						@endif
					</td>
					<td>
						<a href="{{ URL::to('articles/' . $article->id . '') }}">{{ $article->title }}</a>
					</td>

					<td>
						<span class="pull-right">
							<a href="{{ URL::to('articles/' . $article->id . '') }}">
								<small>{{ count($article->comments) }} <span class="btn-label icon fa fa-comment"></small>
							</a>
							&nbsp;&nbsp;
							@if (Auth::user()->isArticleManager())
                            <a class="btn btn-xs btn-primary" href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                            @endif
						</span>
					</td>
				</tr>							
				@endif
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection
