
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Post</span></h1>
</div> 

<div class="row">
	<div class="col-md-6">

		<div class="panel">
			<div class="panel-heading">		
				<span class="panel-title">{{ $post->title }}</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6">		

						<a class="embedly-card" href="{{ $post->source_url }}">{{ $post->source_url }}</a>
						
					</div>
					<div class="col-xs-6 center valign-middle">

						<div class="row">
							<div class="col-xs-12 text-center text-slim">													
								Sugerido por:							
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 text-center padding-sm">													
								<img src="{{ $post->user->getAvatar() }}"
								     alt="{{ $post->user->firstname }}" class="user-list">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 text-center">													
								<span class="panel-title">{{ $post->user>getName() }}</span>
							</div>
						</div>
		
					</div>
				</div>

				<hr>

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
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr
                                    {{$post->status == App\Post::STATUS_SUGGESTED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Sugerido</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr
                                    {{$post->status == App\Post::STATUS_PROOFREADING ? 'bg-info' : ''}}">
                                    <span class="text-xs">Revisão</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr
                                    {{$post->status == App\Post::STATUS_SCHEDULED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Agendado</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr
                                    {{$post->status == App\Post::STATUS_PUBLISHED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Publicado</span>
                                </div>
                            </div> <!-- /.stat-counters -->
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
                </div>

                <div class="row text-center text-xlg">
                    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostController@update', $post->id]]) !!}
                        @if ($post->status == App\Post::STATUS_SUGGESTED)
                            {!! Form::hidden('status', App\Post::STATUS_PROOFREADING ) !!}
                            {!! Html::decode(Form::button('Avançar para revisão <i class="fa fa-arrow-right"></i>',
                                array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @elseif ($post->status == App\Post::STATUS_PROOFREADING)
                            {!! Form::hidden('status', App\Post::STATUS_SCHEDULED ) !!}

                            @include('partials.scripts.datepaginator')

                            {!! Form::hidden('status', App\Post::STATUS_SCHEDULED ) !!}
                            {!! Form::hidden('published_at',  Carbon\Carbon::now(), ['id' => 'published_at'] ) !!}

                            {!! Html::decode(Form::button('Agendar lançamento <i class="fa fa-arrow-right"></i>',
                                                            array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move',
                                                                   'type' => 'submit'))) !!}

                            <div id="bs-datepaginator" class="panel-padding"></div>

                        @elseif ($post->$post == App\Post::STATUS_SCHEDULED)
                            {!! Form::hidden('status', App\Post::STATUS_PUBLISHED ) !!}
                            {!! Html::decode(Form::button('Marcar como publicado <i class="fa fa-arrow-right"></i>',
                                array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

			</div>

			<div class="panel-footer">
				@if (Auth::user()->isOwner($post->user_id)  || Auth::user()->isPostManager())
				<a class="btn btn-xs btn-primary"
				    href="{{ URL::to('posts/' . $post->id . '/edit') }}"><i class="fa fa-edit"></i>Editar</a>

                {!! Form::open(array('class' => 'pull-right delete',
                                     'method' => 'DELETE', 'route' => array('posts.destroy', $post->id))) !!}
                    {!! Html::decode(Form::button('<i class="fa fa-trash-o"></i> Remover',
                        array('class' => 'btn btn-xs btn-danger', 'type' => 'submit'))) !!}
                {!! Form::close() !!}

                {!! Form::model($post, ['class' => 'pull-right delete padding-xs-hr',
                				                   'method' => 'PATCH',
                				                   'action' => ['PostController@update', $post->id]]) !!}
                   {!! Form::hidden('status', App\Post::STATUS_ARCHIVED ) !!}
                   {!! Html::decode(Form::button('<i class="fa fa-archive"></i> Arquivar',
                                           array('class' => 'btn btn-xs btn-warning', 'type' => 'submit'))) !!}

                {!! Form::close() !!}
		        @endif
			</div>
		</div>
	</div>

	<div class="col-md-6">

	    @include('partials.teams.panel', ['media' => $post])

	    @if ($post->status != App\Post::STATUS_SUGGESTED && Auth::user()->isInTeam($post->team))
            @include('partials.reviews.panel', ['media' => $post])
        @endif

        @include('partials.comments.form', ['media' => $post])
	</div>

</div>

@stop

@section('script')

    @include('partials.comments.scripts')

@stop

