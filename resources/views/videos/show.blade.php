
@extends('layouts.master')

@section('content')

<div class="page-header">	
	<h1><span class="text-light-gray">Vídeo</span></h1>
</div> 

<div class="row">
	<div class="col-md-6">

		<div class="panel">
			<div class="panel-heading">		
				<span class="panel-title">{{ $video->title }}</span>		
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6">		

						<div class="row">
							<div class="col-xs-12">													
								{!! '<img src="' . $video->thumbnail . '" class="thumbnail_video">' !!}								
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">	
								<hr>
								<p><a href="{{ $video->video_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Url do vídeo</a></p>						
						
								<p><a href="{{ $video->project_url }}" target="_blank"><span class="btn-label icon fa fa-share-square-o"></span> Url do projeto</a></p>
							</div>
						</div>					
						
					</div>
					<div class="col-xs-6 center valign-middle">

						<div class="row">
							<div class="col-xs-12 text-center text-slim">													
								Sugerido por:							
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 text-center padding-sm">													
								<img src="http://graph.facebook.com/{!! $video->user->facebook_user_id !!}/picture" alt="{{  $video->user->firstname }}" class="user-list">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 text-center">													
								<span class="panel-title">{{ $video->user->name }}</span> 							
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
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr {{$video->status == VIDEO_STATUS_TRANSCRIPTION ? 'bg-info' : ''}}">
                                    <span class="text-xs">Transcrição</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr {{$video->status == VIDEO_STATUS_SYNCHRONIZATION ? 'bg-info' : ''}}">
                                    <span class="text-xs">Sincronização</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr {{$video->status == VIDEO_STATUS_TRANSLATION ? 'bg-info' : ''}}">
                                    <span class="text-xs">Tradução</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr {{$video->status == VIDEO_STATUS_PROOFREADING ? 'bg-info' : ''}}">
                                    <span class="text-xs">Revisão</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr {{$video->status == VIDEO_STATUS_SCHEDULED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Agendado</span>
                                </div>
                                <div class="stat-cell col-xs-2 padding-sm no-padding-hr {{$video->status == VIDEO_STATUS_PUBLISHED ? 'bg-info' : ''}}">
                                    <span class="text-xs">Publicado</span>
                                </div>
                            </div> <!-- /.stat-counters -->
                        </div> <!-- /.stat-row -->
                    </div> <!-- /.stat-panel -->
                </div>

                <div class="row text-center text-xlg">
                    {!! Form::model($video, ['method' => 'PATCH', 'action' => ['VideoController@update', $video->id]]) !!}
                        @if ($video->status == VIDEO_STATUS_TRANSCRIPTION)
                            {!! Form::hidden('status', VIDEO_STATUS_SYNCHRONIZATION ) !!}
                            {!! Html::decode(Form::button('Avançar para sincronização <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @elseif ($video->status == VIDEO_STATUS_SYNCHRONIZATION)
                            {!! Form::hidden('status', VIDEO_STATUS_TRANSLATION ) !!}
                            {!! Html::decode(Form::button('Avançar para tradução <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @elseif ($video->status == VIDEO_STATUS_TRANSLATION)
                            {!! Form::hidden('status', VIDEO_STATUS_PROOFREADING ) !!}
                            {!! Html::decode(Form::button('Avançar para revisão <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @elseif ($video->status == VIDEO_STATUS_PROOFREADING)
                            {!! Form::hidden('status', VIDEO_STATUS_SCHEDULED ) !!}
                            {!! Html::decode(Form::button('Agendar publicação <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @elseif ($video->status == VIDEO_STATUS_SCHEDULED)
                            {!! Form::hidden('status', VIDEO_STATUS_PUBLISHED ) !!}
                            {!! Html::decode(Form::button('Marcar como publicado <i class="fa fa-arrow-right"></i>', array('class' => 'btn btn-lg btn-success btn-labeled  confirm-move', 'type' => 'submit'))) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

			</div>

			<div class="panel-footer">
				@if (Auth::user()->isOwner($video->user_id)  || Auth::user()->isVideoManager())
				<a class="btn btn-xs btn-primary" href="{{ URL::to('videos/' . $video->id . '/edit') }}"><i class="fa fa-edit"></i>Editar</a>
                {!! Form::open(array('class' => 'pull-right delete', 'method' => 'DELETE', 'route' => array('videos.destroy', $video->id))) !!}
                    {!! Html::decode(Form::button('<i class="fa fa-trash-o"></i> Remover', array('class' => 'btn btn-xs btn-danger', 'type' => 'submit'))) !!}
                {!! Form::close() !!}
		        @endif
			</div>
		</div>
	</div>

	<div class="col-md-6">

	    @if ($video->status != VIDEO_STATUS_TRANSCRIPTION &&
	         $video->status != VIDEO_STATUS_SYNCHRONIZATION &&
	         $video->status != VIDEO_STATUS_TRANSLATION)
            @include('reviews.panel', ['resource' => $video,
                                       'model' => 'App\Video',
                                       'reviews' => $video->reviews,
                                       'items' => unserialize(VIDEO_REVIEW_ITEMS)])
        @endif

        @include('comments.form', ['resource_id' => $video->id, 'model' => 'App\Video', 'comments' => $video->comments])
	</div>

</div>

@stop

@section('script')

    @include('comments.scripts')

@stop

