<div class="col-md-6">

	<div class="panel widget-comments">
		<div class="panel-heading">
			<span class="panel-title"><i class="panel-title-icon fa fa-comment-o"></i>Comentários</span>
		</div> <!-- / .panel-heading -->
		<div class="panel-body">				

			<div class="comment">
				<img src="//graph.facebook.com/{{ Auth::user()->facebook_user_id }}/picture" alt="" class="comment-avatar">
				<div class="comment-body">
					{!! Form::open(['url' => 'comments', 'id' => 'leave-comment-form', 'class' => 'comment-text no-padding no-border']) !!}
						{!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '1']) !!}
						{!! Form::hidden('user_id', Auth::user()->id ) !!}
						{!! Form::hidden('commentable_id', $resource_id ) !!}
						{!! Form::hidden('commentable_type', $model ) !!}
						<div class="expanding-input-hidden" style="margin-top: 10px;">																
							{!! Form::submit('Comentar', ['class' => 'btn btn-primary pull-right']) !!}
						</div>
					{!! Form::close() !!}
				</div> <!-- / .comment-body -->
			</div>

			<hr class="no-panel-padding-h panel-wide">

			@foreach ($comments as $comment)
			<div class="comment">
				<img src="//graph.facebook.com/{{ $comment->user->facebook_user_id }}/picture" alt="" class="comment-avatar">
				<div class="comment-body">
					<div class="comment-by">
						<a href="#" title="">{{ $comment->user->name }}</a> comentou
					</div>
					<div id="comment_{{ $comment->id }}" class="comment-text">
						{{ $comment->body }}
					</div>
					@if(Auth::user()->isOwner($comment->user_id))
					<div class="comment-actions">
						{!! Form::open(array('class' => 'delete', 'method' => 'DELETE', 'route' => array('comments.destroy', $comment->id))) !!}            
				            {!! Html::decode(Form::button('<i class="fa fa-times"></i>Remover</a>', array('class' => 'btn btn-xs btn-none', 'type' => 'submit'))) !!}
				        {!! Form::close() !!}
						<span class="pull-right"> {{-- Helpers::time_elapsed_string($comment->created_at) --}}</span>
					</div>
					@endif
				</div> <!-- / .comment-body -->
			</div>
			@endforeach

		</div> <!-- / .panel-body -->
	</div> <!-- / .panel -->
</div>

<script>
	function delete_comment(id) {
	    if (confirm('Delete this user?')) {
	        $.ajax({
	            type: "DELETE",
	            url: 'comments/' + id, //resource
	            success: function(affectedRows) {
	                //if something was deleted, we redirect the user to the users page, and automatically the user that he deleted will disappear
	               // if (affectedRows > 0) window.location = 'users';
	               alert('removido');
	            }
	        });
	    }
	}

	function cancel_edit(comment_id)
	{
		var url = '<?php echo URL::to('/'); ?>' + '/comments/' + comment_id + '/edit';
		$.get(url, function(data) {          
           $("#comment_"+comment_id).html(data);
	    });	
	}

</script>