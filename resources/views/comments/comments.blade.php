
<div id="commentModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Comentar artigo</h4>
			</div>

			<div class="modal-body">
				
				<div id="dashboard-comments">
					<div class="panel-heading">						
					</div> <!-- / .panel-heading -->			

					<div class="tab-content tab-content-bordered panel-padding">
						<div class="widget-article-comments tab-pane panel no-padding no-border fade in active" id="profile-tabs-board">

							<div class="comment">
								<img src="{{ Auth::user()->photo() }}" alt="" class="comment-avatar">

								<div class="comment-body">
									<form id="leave-comment-form" class="comment-text no-padding no-border" ng-submit="submitComment()" ng-init="commentData.media_id=1">									
										<textarea class="form-control" rows="1" ng-model="commentData.message"></textarea>
										<div class="expanding-input-hidden" style="margin-top: 10px;">
											<label class="checkbox-inline pull-left">
												<input type="checkbox" class="px">													
											</label>
											<button type="submit" class="btn btn-primary pull-right">Comentar</button>
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
												<a href="#" title="">@{{ comment.user.firstname + ' ' + comment.user.lastname  }}</a><span>@{{ comment.created_at | date:'medium' }} </span>
											</div>
											@{{ comment.message }}
										</div>
										<div class="comment-footer">
											<a href="" ng-click="replyComment($index)" class="text-muted">
											<i class="fa fa-reply"></i> Responder</a>

											<a href="#" ng-show="showComment(comment, {{ Auth::id() }})" ng-click="deleteComment(comment.id)" class="text-muted">
											<i class="fa fa-trash-o"></i> Remover</a>												
										</div>
									</div>

									<div class="comment-body" ng-show="$index == replyTo">										
										<form class="comment-text no-padding no-border" ng-submit="submitReply(comment.id)">
											<textarea class="form-control" rows="1" ng-model="commentData.reply_text"></textarea>
											<div style="margin-top: 10px;">
												<label class="checkbox-inline pull-left">
													<input type="checkbox" class="px">													
												</label>
												<button type="submit" class="btn btn-primary pull-right">Responder</button>
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
												<a href="#" title="">@{{ subcomment.user.firstname + ' ' + subcomment.user.lastname  }}</a><span>@{{ subcomment.created_at | date:'medium' }}</span>
											</div>
											@{{ subcomment.message }}
										</div>
										<div class="comment-footer">										
											<a href="#" ng-show="showComment(subcomment, {{ Auth::id() }})" ng-click="deleteComment(subcomment.id)" class="text-muted"><i class="fa fa-trash-o"></i> Remover</a>
										</div>
									</div> <!-- / .comment-body -->	
								</div>									
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div> <!-- / .modal-content -->
	</div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->