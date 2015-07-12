
<div class="panel widget-article-comments">
    <div class="panel-heading">
        <span class="panel-title"><i class="panel-title-icon {{ \App\Comment::ICON }}"></i>Comentários</span>
    </div> <!-- / .panel-heading -->
    <div class="panel-body">

        <div class="comment">
            <img src="//graph.facebook.com/{{ Auth::user()->facebook_user_id }}/picture" alt="" class="comment-avatar">
            <div class="comment-body">
                {!! Form::open(['url' => 'comments', 'id' => 'leave-comment-form', 'class' => 'comment-text no-padding no-border']) !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '1']) !!}
                    {!! Form::hidden('user_id', Auth::user()->id ) !!}
                    {!! Form::hidden('commentable_id', $media->id ) !!}
                    {!! Form::hidden('commentable_type', get_class($media) ) !!}
                    <div class="expanding-input-hidden" style="margin-top: 10px;">
                        {!! Form::submit('Comentar', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div> <!-- / .comment-body -->
        </div>

        <hr class="no-panel-padding-h panel-wide">

        @foreach ($media->comments as $comment)

            @include('partials.comments.reply', ['comment' => $comment])

        @endforeach

    </div> <!-- / .panel-body -->
</div> <!-- / .panel -->


@section('script')

<script type="text/javascript">

    function replyTo(id)
    {
        $("#reply_"+id).toggle(500);

        $("#reply_body_"+id).focus();

    }
	init.push(function () {

		$("#leave-comment-form").expandingInput({
			target: 'textarea',
			hidden_content: '> div',
			placeholder: 'O que você acha?',
			onAfterExpand: function () {
				$('#leave-comment-form textarea').attr('rows', '3').autosize();
			}
		});

	})

</script>

@endsection