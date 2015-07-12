@extends('layouts.master')

@section('content')

<!-- Em edição -->

<div class="page-header">
    @if (Input::get('status'))
	<h1><span class="text-light-gray">Artigos /</span> {{ with(new App\Article)->getStatusLabels()[Input::get('status')] }}</h1>
	@endif

    @if (Auth::user()->hasPermission(\App\Permission::ARTICLE_CREATE))
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="articles/create" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>Criar artigo
		</a>
	</div>
	@endif

</div> <!-- / .page-header -->

<div class="row">
@foreach ($articles as $article)
	<div class="col-lg-6 col-md-12 col-xs-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span class="panel-title">
				    <a href="{!! URL::to('articles', $article->id) !!}">{{ $article->title }}</a>
                </span>
				<div class="panel-heading-controls">
				@if (Auth::user()->hasPermission(\App\Permission::ARTICLE_CREATE))
                <a class="btn btn-xs  btn-primary btn-outline"
                   href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i></a>
                @endif
                </div>
			</div>
			<div class="panel-body">

			    <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group no-margin">
                            <li class="list-group-item no-border padding-xs-hr">
                                {{ $article->reviews()->count() }} revisões <i class="fa fa-eye pull-right"></i>
                            </li>
                            <li class="list-group-item no-border no-border-b padding-xs-hr">
                                {{ $article->comments()->count() }} comentários <i class="fa fa-comment pull-right"></i>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 text-center">
                        <ul class="list-group no-margin">
                            <li class="list-group-item no-border padding-xs-hr">
                                {{ date("d/m/Y", strtotime($article->created_at)) }}
                                <i class="fa fa-calendar-o pull-right"></i>
                            </li>
                            <li class="list-group-item no-border padding-xs-hr">
                                {{ date("d/m/Y", strtotime($article->created_at)) }}
                                <i class="fa fa-rocket pull-right"></i>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 text-center">
                        <a href="{!! URL::to('articles', $article->id) !!}" target="_blank"
                           class="btn btn-block btn-lg btn-labeled btn-info">Ver</a>
                    </div>
			    </div>

			    <hr/>

			    <div class="row">
                    <div class="col-md-4 text-center">
                        Sugerido por:
                            <img src="http://graph.facebook.com/{!! $article->user->facebook_user_id !!}/picture"
                                 alt="{!! $article->user->first_name !!}" class="user-list">
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="{{ $article->source_url }}" target="_blank"
                           class="btn btn-flat btn-block btn-sm btn-labeled btn-danger">Fonte</a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="{{ $article->project_url }}" target="_blank"
                           class="btn btn-flat btn-block btn-sm btn-labeled btn-warning">Editar</a>
                    </div>
                </div>

			</div>
		</div>
	</div>
 @endforeach
 </div>
 <div class="row">
    <div class="text-center">
         {!! $articles->appends(['status' => Input::get('status')])->render() !!}
     </div>
 </div>

@endsection
