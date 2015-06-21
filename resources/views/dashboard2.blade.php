@extends('layouts.default')

@section('content')

<script>
	//var media_id = 0;	
</script>

<div id="content-wrapper">
	<div class="page-header">
		
		<div class="row">
			<!-- Page header, center on small screens -->
			<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;Dashboard</h1>

			<div class="col-xs-12 col-sm-8">
				<div class="row">
					<hr class="visible-xs no-grid-gutter-h">
					<!-- "Create project" button, width=auto on desktops -->					
					<div class="pull-right col-xs-12 col-sm-auto"><a href="#" onclick="openSuggestionPanel()" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Suggest Video</a></div>

					<!-- Margin -->
					<div class="visible-xs clearfix form-group-margin"></div>
					
				</div>
			</div>
		</div>
	</div> <!-- / .page-header -->


	<div class="row" id="suggestionPanel"  style="display: none;">
		<div class="col-md-6">				
		   <div id="suggestion-form" class="panel form-horizontal"> 
				<div class="panel-heading">
					<span class="panel-title">Inform the url of the video</span>
				</div>

				<div class="panel-body">
					<div class="row form-group">
						<label class="col-sm-4 control-label">Video url:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="original_link" name="original_link" placeholder="http://...">
								@if ($errors->has('original_link'))
									<p class="help-block">{{ $errors->first('original_link') }}</p>
								@endif
						</div>
					</div>
					<div id="processing"></div>
				</div>

				<div class="panel-footer text-right">
					<button onclick="suggestVideo()" class="btn btn-primary">Suggest</button>
				</div>
			</div>			

			<!-- 	{{ Form::token() }}						
				
			</form> -->
		</div>

		<div class="col-md-6">
			<div class="panel colourable">
				<div class="panel-heading">
					<span class="panel-title"><i class="panel-title-icon fa fa-warning"></i>Supported services</span>
				</div>
				<div class="panel-body">
					Right now, only videos from <a href="http://www.youtube.com" target="_blank">YouTube</a> and <a href="http://www.vimeo.com" target="_blank">Vimeo</a> are supported.
				</div>
				<div class="panel-footer">
					<a href="http://www.youtube.com" target="_blank"><img src="{{ URL::asset('assets/images/youtube.png') }}" class="logo_videos"></a>
					<a href="http://www.vimeo.com" target="_blank"><img src="{{ URL::asset('assets/images/vimeo.png') }}" class="logo_videos"></a>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-8">
			<div class="stat-panel">

				<div class="stat-cell col-sm-6 padding-sm-hr bordered no-border-r valign-top">
					<h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-film text-primary"></i>&nbsp;&nbsp;Videos</h4>
					<ul class="list-group no-margin">
						<li class="list-group-item no-border-hr padding-xs-hr no-bg no-border-radius">
							Translation <span class="label label-danger pull-right">{{ $count_videos_trans }}</span>
						</li>
						<li class="list-group-item no-border-hr padding-xs-hr no-bg">
							Synchronizing <span class="label label-warning pull-right">{{ $count_videos_synch }}</span>
						</li>
						<li class="list-group-item no-border-hr padding-xs-hr no-bg">
							Proofreading <span class="label label-pa-purple pull-right">{{ $count_videos_proof }}</span>
						</li>
						<li class="list-group-item no-border-hr no-border-b padding-xs-hr no-bg">
							Completed <span class="label label-success pull-right">{{ $count_videos_finish }}</span>
						</li>
					</ul>
				</div>
					
				<div class="stat-cell col-sm-6 no-padding bordered valign-middle">
					
					<div class="stat-rows">
						<div class="stat-row" style="height:125px"> 
							<div class="stat-cell bg-warning valign-middle">
								<i class="fa fa-youtube-play bg-icon"></i>
								<span class="text-xlg"><strong>{{ ($count_videos_trans + $count_videos_synch + $count_videos_proof + $count_videos_finish) }}</strong></span><br>
								<span class="text-bg">Total videos</span><br>
								<span class="text-sm">Added to the system</span>
							</div>
						</div>

						<div class="stat-row" style="height:125px"> 
							<div class="stat-cell bg-warning darker valign-middle">
								<i class="fa fa-users bg-icon"></i>
								<span class="text-xlg"><strong>{{ $count_users }}</strong></span><br>
								<span class="text-bg">Users</span><br>
								<span class="text-sm">Working with translations</span>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>	

		<div class="col-md-4">
			<div class="row">

				<div class="stat-panel">
					<div class="stat-row">
						<!-- Danger background, vertically centered text -->
						<div class="stat-cell bg-success valign-middle">
							<!-- Stat panel bg icon -->
							<i class="fa fa-trophy bg-icon"></i>
							<!-- Extra large text -->
							<span class="text-xlg"><span class="text-lg text-slim"></span><strong>{{ $count_user_score }}</strong></span><br>
							<!-- Big text -->
							<span class="text-bg">Points in translation</span><br>
							<!-- Small text -->
							<span class="text-sm"><a href="#">from {{ $count_user_worked }} different videos</a></span>
						</div> <!-- /.stat-cell -->
					</div> <!-- /.stat-cell -->
					<div class="stat-row">
						<!-- Bordered, without top border, horizontally centered text -->
						<div class="stat-counters bordered no-border-t text-center">
							<!-- Small padding, without horizontal padding -->
							<div class="stat-cell col-xs-4 padding-sm no-padding-hr">
								<!-- Big text -->
								<span class="text-bg"><strong>{{ $count_user_trans }}</strong></span><br>
								<!-- Extra small text -->
								<span class="text-xs text-muted">TRANSLATIONS</span>
							</div>
							<!-- Small padding, without horizontal padding -->
							<div class="stat-cell col-xs-4 padding-sm no-padding-hr">
								<!-- Big text -->
								<span class="text-bg"><strong>{{ $count_user_synch }}</strong></span><br>
								<!-- Extra small text -->
								<span class="text-xs text-muted">SYNCHRONIZATIONS</span>
							</div>
							<!-- Small padding, without horizontal padding -->
							<div class="stat-cell col-xs-4 padding-sm no-padding-hr">
								<!-- Big text -->
								<span class="text-bg"><strong>{{ $count_user_proof }}</strong></span><br>
								<!-- Extra small text -->
								<span class="text-xs text-muted">PROOFREADINGS</span>
							</div>
						</div> <!-- /.stat-counters -->
					</div>
				</div>
			</div>	
		</div>
	</div>

	<!-- Page wide horizontal line -->
	
	<hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

	<!-- Javascript -->
	<script>
		init.push(function () {
			$('#dashboard-recent .panel-body > div').slimScroll({ height: 300, alwaysVisible: true, color: '#888',allowPageScroll: true });
		})
	</script>
	<!-- / Javascript -->

	<div class="row">
		<div class="col-md-4">	
			<div class="panel" id="dashboard-recent">
				<div class="panel-heading">
					<span class="panel-title"><i class="panel-title-icon fa fa-star text-danger"></i>Last suggested videos</span>						
				</div> <!-- / .panel-heading -->
				<div class="tab-content">

					<!-- Without padding -->
					<div class="widget-threads panel-body tab-pane no-padding  fade active in">
						<div class="panel-padding no-padding-vr">

							<!-- foreach ($last_videos as $video)								
							<div class="thread">									
								{x{ '<img src="' . '$video->thumbnail' . '"  alt="" class="thread-avatar">' }x}
								<div class="thread-body">
									<span class="thread-time">[[ Helpers::time_elapsed_string($video->created_at) ]]</span>
									<a href="{x{ URL::route('videos-details', $video->id) }x}" class="thread-title">{x{ '$video->title' }x}</a>
									<div class="thread-info">suggested by <a href="{x{ URL::route('users-profile', $video->suggestedBy()['id']) }x}" title="">{x{ '$video->suggestedBy()['firstname']' }x}</a></div>
								</div>
							</div>
							endforeach -->

						</div>
					</div> <!-- / .panel-body -->
				</div>
			</div> <!-- / .widget-threads -->
		</div>

		<div class="col-md-4">				
			<div class="panel" id="dashboard-recent">
				<div class="panel-heading">
					<span class="panel-title"><i class="panel-title-icon fa fa-tasks text-danger"></i>Last activities</span>						
				</div> <!-- / .panel-heading -->
				<div class="tab-content">

					<!-- Without padding -->
					<div class="widget-threads panel-body tab-pane no-padding  fade active in">
						<div class="panel-padding no-padding-vr">							

							<?php //$tasks_label = unserialize(TASKS_TYPE_LABEL_DASHBOARD); ?>
							//foreach ($last_tasks as $task)
							<div class="thread">
								<img src="{x{ $task->user->photo() }x}" alt="" class="thread-avatar">
								<div class="thread-body">
									<span class="thread-time">[[ Helpers::time_elapsed_string($task->created_at) ]]</span>
									<a href="{x{ URL::route('users-profile', $task->user->id )}x}" title="">{x{ '$task->user->firstname'}x}</a> {x{ '$tasks_label[$task->type'] }}										
									<div class="thread-info">the video <a href="{x{ URL::route('videos-details', $task->media_id) }x}" title="">{x{ '$task->video->title' }x}</a></div>
								</div>
							</div>
							//endforeach							

						</div>
					</div> <!-- / .panel-body -->
				</div>
			</div> <!-- / .widget-threads -->
		</div>

		<div class="col-md-4">				
			<div class="panel" id="dashboard-comments">
				<div class="panel-heading">
					<span class="panel-title"><i class="panel-title-icon fa fa-bullhorn text-danger"></i>Tell what you have in mind</span>
				</div> <!-- / .panel-heading -->			

				<div class="tab-content tab-content-bordered panel-padding">
					<div class="widget-article-comments tab-pane panel no-padding no-border fade in active" id="profile-tabs-board">
						
						<div ng-app="commentApp" ng-controller="commentController">

							<div class="comment">
								<img src="{{ Auth::user()->photo() }}" alt="" class="comment-avatar">
								<div class="comment-body">
									<form id="leave-comment-form" class="comment-text no-padding no-border" ng-submit="submitComment()" ng-init="commentData.media_id=0">
										<textarea class="form-control" rows="1" ng-model="commentData.message"></textarea>
										<div class="expanding-input-hidden" style="margin-top: 10px;">
											<label class="checkbox-inline pull-left">
												<input type="checkbox" class="px">			@{{media_id}}										
											</label>
											<button type="submit" class="btn btn-primary pull-right">Leave Message</button>
										</div>
									</form>
								</div> <!-- / .comment-body -->
							</div>

							<hr class="no-panel-padding-h panel-wide">

							<!-- LOADING ICON =============================================== -->
							<!-- show loading icon if the loading variable is set to true -->

							<div class="text-center" ng-show="loading"><span class="fa fa-refresh fa-5x fa-spin"></span></div>

							<div class="comment" ng-hide="loading" ng-repeat="comment in comments | limitTo: -10 | orderBy: 'id':true">
								
								<div ng-show="comment.reply_to == 0">
									<img ng-src="@{{ comment.user.photo }}" alt="" class="comment-avatar">
									<div class="comment-body">
										<div class="comment-text">
											<div class="comment-heading">
												<a href="#" title="">@{{ comment.user.firstname + ' ' + comment.user.lastname  }}</a><span>@{{ comment.created_at | date:'medium' }} @{{'id = ' + comment.id}}</span>
											</div>
											@{{ comment.message }}
										</div>
										<div class="comment-footer">
											<a href="" ng-click="replyComment($index)" class="text-muted">
											<i class="fa fa-reply"></i> Reply</a>

											<a href="#" ng-show="showComment(comment, {{ Auth::id() }})" ng-click="deleteComment(comment.id)" class="text-muted">
											<i class="fa fa-trash-o"></i> Remove</a>												
										</div>
									</div>

									<div class="comment-body" ng-show="$index == replyTo">
										<form class="comment-text no-padding no-border" ng-submit="submitReply(comment.id)" ng-init="commentData.media_id=0">
											<textarea class="form-control" rows="1" ng-model="commentData.reply_text"></textarea>
											<div style="margin-top: 10px;">
												<label class="checkbox-inline pull-left">
													<input type="checkbox" class="px">													
												</label>
												<button type="submit" class="btn btn-primary pull-right">Reply</button>
											</div>
										</form>
										<br><br>
									</div> 

								</div>
								
								<div class="comment" ng-repeat="subcomment in comments | limitTo: 100 | orderBy: 'id':false" ng-show="subcomment.reply_to == comment.id">
									
									<img ng-src="@{{ subcomment.user.photo }}" alt="" class="comment-avatar">
									<div class="comment-body">
										<div class="comment-text">
											<div class="comment-heading">
												<a href="#" title="">@{{ subcomment.user.firstname + ' ' + subcomment.user.lastname  }}</a><span>@{{ subcomment.created_at | date:'medium' }}  @{{ subcomment.reply_to + ' - ' + comment.id }}</span>
											</div>
											@{{ subcomment.message }}
										</div>
										<div class="comment-footer">										
											<a href="#" ng-show="showComment(subcomment, {{ Auth::id() }})" ng-click="deleteComment(subcomment.id)" class="text-muted"><i class="fa fa-trash-o"></i> Remove</a>
										</div>
									</div> <!-- / .comment-body -->	
								</div>
								
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>

	</div>
</div>	

@stop


@section('script')

<script type="text/javascript">
	function openSuggestionPanel(){
		$('#suggestionPanel').toggle(200);
	}

	function suggestVideo(){
		var url = '<?php echo URL::to('/'); ?>' + '/videos/suggestion';		
		var video_url = $('#original_link').val();

		$('#processing').append('Processing... <i class="fa fa-refresh fa-spin"></i>');
		$.post( url, { original_link: video_url})
			.done(function(data){				
				window.location.reload(true);
			});
	}


	init.push(function () {
		$('#profile-tabs').tabdrop();

		$("#leave-comment-form").expandingInput({
			target: 'textarea',
			hidden_content: '> div',
			placeholder: 'Write message',
			onAfterExpand: function () {
				$('#leave-comment-form textarea').attr('rows', '3').autosize();
			}
		});

		var regYoutube = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var regVimeo = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;

		$.validator.addMethod(
			"valid_video_url",
			function(value, element) {
				return regYoutube.test(value) || regVimeo.test(value);
			},
			"The url informed is not valid."
		);

		// Setup validation
		$("#suggestion-form").validate({
			ignore: '.ignore, .select2-input',
			focusInvalid: false,
			rules: {
				'original_link': {
					required: true,
					url: true,
					valid_video_url: true
				}
			}
		});

	})
	
	window.PixelAdmin.start(init);

</script>
			
@stop
