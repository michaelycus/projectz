<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><i class="panel-title-icon {{ \App\Review::ICON }}"></i>Revisão</span>
    </div>
    <div class="panel-body">

        <div class="panel-group" id="accordion-review">

            @if ($media->reviews->isEmpty())
                Não existem revisões para esse item!
            @else
                @foreach($media->reviews as $review)
                <div class="panel panel-{{ $review->status == REVIEW_DANGER ? 'danger' : ($review->status == REVIEW_WARNING ? 'warning' : 'success') }}">
                    <div class="panel-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-review" href="#collapse_{{ $review->id }}">
                             <img src="http://graph.facebook.com/{{ $review->user->facebook_user_id }}/picture"
                                 alt="{{  $review->user->first_name }}" class="user-tiny"> <i class="fa fa-caret-right"></i> Revisão de {{  $review->user->first_name }}
                        </a>
                    </div> <!-- / .panel-heading -->
                    <div id="collapse_{{ $review->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h3>Avaliação do revisor:</h3>
                            <p>{{  $review->body }}</p>
                            <p>Avaliado como: <strong>{{ unserialize(REVIEW_STATUS)[$review->status] }}</strong></p>

                            <h3>Resposta do editor:</h3>
                            <p>{{  $review->reply }}</p>
                        </div> <!-- / .panel-body -->

                        @if (Auth::id() == $media->user_id)
                        <hr/>
                        <div class="panel-footer">
                            {!! Form::model($review, ['method' => 'PATCH', 'action' => ['ReviewController@update', $review->id]]) !!}

                                <div class="form-group no-margin-hr">
                                    {!! Form::label('reply', 'Resposta:', ['class' => 'control-control']) !!}
                                    {!! Form::textarea('reply', null, ['class' => 'form-control', 'size' => '30x5']) !!}
                                </div>
                                <div class="padding-sm pull-right">
                                    {!! Form::submit('Responder', ['class' => 'btn btn-xs btn-primary pull-right']) !!}
                                </div>

                            {!! Form::close() !!}
                        </div>
                        @endif
                    </div> <!-- / .collapse -->
                </div> <!-- / .panel -->
                @endforeach
            @endif
        </div>

        <!-- Create review -->
        @if (!Auth::user()->hasReview($media->reviews) && Auth::id() != $media->user_id)

        <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="reviewModalLabel">Revisar</h4>
                    </div>

                    {!! Form::open(['url' => 'reviews', 'id' => 'form-review'] ) !!}

                        @include('reviews.form', ['media' => $media])
                    {!! Form::close() !!}

                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div> <!-- /.modal -->
        <!-- / Modal -->

        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reviewModal">Revisar <i class="fa fa-check"></i></button>

        @endif
        <!-- /Create review -->

        <!-- Edit review -->
        @foreach($media->reviews as $review)
            @if ($review->user_id == Auth::id())

            <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="reviewModalLabel">Revisar</h4>
                        </div>

                        {!! Form::model($review, ['method' => 'PATCH', 'action' => ['ReviewController@update', $review->id]]) !!}

                            @include('reviews.form', ['media' => $media])

                        {!! Form::close() !!}

                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div> <!-- /.modal -->
            <!-- / Modal -->


            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reviewModal">Editar revisão <i class="fa fa-check"></i></button>

            @endif
        @endforeach
        <!-- /Edit review -->


    </div>
</div>


