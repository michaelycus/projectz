<div class="comment">
    <img src="{{ $comment->user->getAvatar() }}" alt="" class="comment-avatar">
    <div class="comment-body">
        <div class="comment-text">
            <div class="comment-heading">
                <a href="#" title="">{{ $comment->user->getName() }}</a> <span>comentou</span>
            </div>
            {{ $comment->body }}
        </div>
        <div class="comment-footer">
            <button class="btn btn-xs btn-none" onclick="replyTo({{ $comment->id }})"><i class="fa fa-mail-reply"></i> Responder</button>
            <span class="pull-right">
            @if(Auth::user()->isOwner($comment->user_id))
                {!! Form::open(array('class' => 'delete', 'method' => 'DELETE', 'route' => array('comments.destroy', $comment->id))) !!}
                {!! Html::decode(Form::button('<i class="fa fa-times"></i>Remover</a>', array('class' => 'btn btn-xs btn-none', 'type' => 'submit'))) !!}
            {!! Form::close() !!}
            </span>
            <span class="pull-right"> {{-- Helpers::time_elapsed_string($comment->created_at) --}}</span>
            @endif
        </div>
    </div> <!-- / .comment-body -->

    <div class="comment" id="reply_{{ $comment->id  }}" style="display:none; margin-bottom: 25px">
        <img src="{{ $comment->user->getAvatar() }}" alt="" class="comment-avatar">
        <div class="comment-body">
            {!! Form::open(['url' => 'comments', 'id' => 'reply_form_'.$comment->id, 'class' => 'comment-text no-padding no-border']) !!}
                {!! Form::textarea('body', null, ['id'=> 'reply_body_'.$comment->id, 'class' => 'form-control', 'rows' => '1']) !!}
                {!! Form::hidden('user_id', Auth::user()->id ) !!}
                {!! Form::hidden('reply_id', $comment->id ) !!}
                {!! Form::hidden('commentable_id', 0 ) !!}
                {!! Form::hidden('commentable_type', '' ) !!}
                {!! Form::submit('Comentar', ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div> <!-- / .reply-body -->

    @foreach($comment->getReplies($comment->id) as $comment_reply)

        @include('partials.comments.reply', ['comment' => $comment_reply])

    @endforeach

</div>