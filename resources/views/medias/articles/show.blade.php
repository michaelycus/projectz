
@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">		
				<span class="panel-title"><i class="{{ App\Article::ICON }}"></i> {{ $article->title }}</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6">			
						@if ($article->project_url != '')
						<p><a href="{{ $article->project_url }}" target="_blank">
						        <span class="btn-label icon fa fa-share-square-o"></span> Projeto</a></p>
						@endif
						@if ($article->source_url != '')				
						<p><a href="{{ $article->source_url }}" target="_blank">
						        <span class="btn-label icon fa fa-share-square-o"></span> Fonte</a></p>
						@endif
						<p>
                            <span class="btn-label icon fa fa-calendar"></span>
                            Iniciado em: {{ date("d/m/Y", strtotime($article->created_at)) }}
                        </p>
						@if (!empty($article->published_at))
                        <p>
                            <span class="btn-label icon fa fa-rocket"></span>
                            Agendado para: {{ date("d/m/Y", strtotime($article->published_at)) }}
                        </p>
                        @endif
					</div>
					<div class="col-xs-6 text-center">
					    <div class="row">
                            <div class="col-xs-12 text-center text-slim">
                                Sugerido por:
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center padding-sm">
                                <img src="http://graph.facebook.com/{{ $article->user->facebook_user_id }}/picture"
                                      alt="{{  $article->user->first_name }}" class="user-list">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <span class="panel-title">{!! $article->user->name !!}</span>
                            </div>
                        </div>
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
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr
                                    {{$article->status == App\Article::STATUS_EDITING ? 'bg-info' : ''}}">
                                    <span class="text-xs">Edição</span>
                                </div>
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr
                                    {{$article->status == App\Article::STATUS_PROOFREADING ? 'bg-info' : ''}}">
                                    <span class="text-xs">Revisão</span>
                                </div>
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr
                                    {{$article->status == App\Article::STATUS_SCHEDULED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Agendado</span>
                                </div>
                                <div class="stat-cell col-xs-4 padding-sm no-padding-hr
                                    {{$article->status == App\Article::STATUS_PUBLISHED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Publicado</span>
                                </div>
                            </div> <!-- /.stat-counters -->
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
				</div>
				<div class="row text-center text-xlg">


                {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticleController@update', $article->id]]) !!}
                @if ($article->status == App\Article::STATUS_EDITING)

                    {!! Form::hidden('status', App\Article::STATUS_PROOFREADING ) !!}
                    {!! Html::decode(Form::button('Avançar para revisão <i class="fa fa-arrow-right"></i>',
                        array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}

                @elseif ($article->status == App\Article::STATUS_PROOFREADING)

                    @include('partials.scripts.datepaginator')

                    {!! Form::hidden('status', App\Article::STATUS_SCHEDULED ) !!}
                    {!! Form::hidden('published_at',  Carbon\Carbon::now(), ['id' => 'published_at'] ) !!}

                    {!! Html::decode(Form::button('Agendar lançamento <i class="fa fa-arrow-right"></i>',
                                                    array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move',
                                                           'type' => 'submit'))) !!}


                    <div id="bs-datepaginator" class="panel-padding"></div>

                @elseif ($article->status == App\Article::STATUS_SCHEDULED)
                    {!! Form::hidden('status', App\Article::STATUS_PUBLISHED ) !!}
                    {!! Html::decode(Form::button('Marcar como publicado <i class="fa fa-arrow-right"></i>',
                        array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                @endif
                {!! Form::close() !!}

				</div>
			</div>

			<div class="panel-footer">
				@if (Auth::user()->isOwner($article->user_id)  || Auth::user()->isArticleManager())
				<a class="btn btn-xs btn-primary"
				    href="{{ URL::to('articles/' . $article->id . '/edit') }}"><i class="fa fa-edit"></i>Editar</a>


                {!! Form::open(array('class' => 'pull-right delete padding-xs-hr',
                                                     'method' => 'DELETE',
                                                     'route' => array('articles.destroy', $article->id))) !!}
                    {!! Html::decode(Form::button('<i class="fa fa-trash-o"></i> Remover',
                        array('class' => 'btn btn-xs btn-danger', 'type' => 'submit'))) !!}
                {!! Form::close() !!}

				{!! Form::model($article, ['class' => 'pull-right delete padding-xs-hr',
				                           'method' => 'PATCH',
				                           'action' => ['ArticleController@update', $article->id]]) !!}
                   {!! Form::hidden('status', App\Article::STATUS_ARCHIVED ) !!}
                   {!! Html::decode(Form::button('<i class="fa fa-archive"></i> Arquivar',
                                           array('class' => 'btn btn-xs btn-warning', 'type' => 'submit'))) !!}

                {!! Form::close() !!}


		        @endif
			</div>
		</div>
	</div>

	<div class="col-md-6">

	    @include('partials.teams.panel', ['media' => $article])

        @if ($article->status != App\Article::STATUS_EDITING && Auth::user()->isInTeam($article->team))
            @include('partials.reviews.panel', ['media' => $article])
        @endif

        @include('partials.comments.form', ['media' => $article])
    </div>

</div>

@stop

@section('script')

    @include('partials.comments.scripts')

    <script>
    // TODO: remove this
    $(".alert-info").fadeTo(5000, 500).slideUp(5000, function(){
        $(".alert-info").alert('close');
    });
    </script>

@stop

