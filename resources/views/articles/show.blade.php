
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Artigo</span></h1>
</div> 

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">		
				<span class="panel-title"><i class="fa fa-wordpress"></i> {{ $article->title }}</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6">			
						@if ($article->project_url != '')
						<p><a href="{{ $article->project_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Projeto</a></p>
						@endif
						@if ($article->source_url != '')				
						<p><a href="{{ $article->source_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Fonte</a></p>
						@endif
					</div>
					<div class="col-xs-6 text-center">
						<img src="http://graph.facebook.com/{{ $article->user->facebook_user_id }}/picture" alt="{{  $article->user->first_name }}" class="user-list pull-right">
						
						<span class="panel-title">{!! $article->user->name !!}</span>
					</div>
				</div>

				<div class="row">
				    <div class="stat-panel">
                        <div class="stat-row">
                            <div class="stat-counters no-border text-center">
                                <div class="stat-cell col-xs-12 padding-sm no-padding-hr">
                                    Situação atual:
                                </div>
                            </div>
                        </div>
                        <div class="stat-row">
                            <div class="stat-counters bordered text-center">

                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr {{$article->status == ARTICLE_STATUS_EDITING ? 'bg-info' : ''}}">
                                    <span class="text-xs">Edição</span>
                                </div>
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr {{$article->status == ARTICLE_STATUS_PROOFREADING ? 'bg-info' : ''}}">
                                    <span class="text-xs">Revisão</span>
                                </div>
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr {{$article->status == ARTICLE_STATUS_SCHEDULED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Agendado</span>
                                </div>
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr {{$article->status == ARTICLE_STATUS_PUBLISHED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Publicado</span>
                                </div>
                            </div> <!-- /.stat-counters -->
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
				</div>
				<div class="row text-center text-xlg">

                    {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticleController@update', $article->id]]) !!}
                        @if ($article->status == ARTICLE_STATUS_EDITING)
                            {!! Form::hidden('status', 'proofreading' ) !!}
                            {!! Html::decode(Form::button('Revisar <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @elseif ($article->status == ARTICLE_STATUS_PROOFREADING)
                            {!! Form::hidden('status', 'scheduled' ) !!}
                            {!! Html::decode(Form::button('Revisar <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @elseif ($article->status == ARTICLE_STATUS_SCHEDULED)
                            {!! Form::hidden('status', 'published' ) !!}
                            {!! Html::decode(Form::button('Revisar <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @endif
                    {!! Form::close() !!}
				</div>
			</div>

			<div class="panel-footer">
				@if (Auth::user()->isOwner($article->user_id)  || Auth::user()->isArticleManager())
				<a class="btn btn-xs btn-primary" href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i>Editar</a>
                {!! Form::open(array('class' => 'pull-right delete', 'method' => 'DELETE', 'route' => array('articles.destroy', $article->id))) !!}
                    {!! Html::decode(Form::button('<i class="fa fa-trash-o"></i> Remover', array('class' => 'btn btn-xs btn-danger', 'type' => 'submit'))) !!}
                {!! Form::close() !!}
		        @endif
			</div>
		</div>
	</div>

	<div class="col-md-6">

        @include('reviews.panel', ['resource' => $article,
                                   'model' => 'App\Article',
                                   'reviews' => $article->reviews,
                                   'items' => unserialize(ARTICLE_REVIEW_ITEMS)])

        @include('comments.form', ['resource_id' => $article->id, 'model' => 'App\Article', 'comments' => $article->comments])
    </div>

</div>

@stop

@section('script')

    @include('comments.scripts')

    <script>
    $(".alert-info").fadeTo(5000, 500).slideUp(5000, function(){
        $(".alert-info").alert('close');
    });
    </script>

@stop

