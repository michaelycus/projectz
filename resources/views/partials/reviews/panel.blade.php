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
                <div class="panel panel-{{ $review->status == \App\Review::REVIEW_DANGER ? 'danger' :
                                          ($review->status == \App\Review::REVIEW_WARNING ? 'warning' : 'success') }}">
                    <div class="panel-heading">
                        <a class="accordion-toggle collapsed"
                            data-toggle="collapse" data-parent="#accordion-review"
                            href="#collapse_{{ $review->id }}">
                            <span class="panel-title">
                                <img src="{{ $review->user->getAvatar() }}"
                                     alt="{{ $review->user->first_name }}" class="user-tiny">
                                <i class="fa fa-caret-right"></i> Revisão de {{ $review->user->first_name }}
                            </span>
                            <div class="panel-heading-controls" style="width: 30%">
                                <div class="progress progress-striped active" style="width: 100%">
                                    <div class="progress-bar progress-bar-{{ $review->score == 100 ? 'success' : ($review->score > 60 ? 'warning' : 'danger') }}"
                                         style="width: {{ $review->score }}%;"></div>
                                </div>
                            </div>
                        </a>
                    </div> <!-- / .panel-heading -->
                    <div id="collapse_{{ $review->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            @foreach($review->items as $item)
                            <div class="checkbox" style="margin: 0;">
                                <label>
                                    <input type="checkbox" class="px" disabled="disabled" {{ $item->checked ? 'checked="checked"' : '' }} /><span class="lbl">{{ $item->title }}</span>
                                </label>
                             </div>
                            @endforeach

                            <h4>Avaliação do revisor:</h4>
                            <div class="note note-warning">
                            {{ $review->body }}
                            </div>
                            <p>Avaliado como: <strong>{{ \App\Review::getReviewStatus()[$review->status] }}</strong></p>

                            @if ($review->reply)
                            <h4>Resposta do editor:</h4>
                            <div class="note note-success">
                            {{  $review->reply }}
                            </div>
                            @endif
                        </div> <!-- / .panel-body -->

                        @if (Auth::id() == $media->user_id)
                        <hr/>
                        <div class="panel-footer">
                            {!! Form::model($review, ['method' => 'PATCH',
                                                      'action' => ['ReviewController@update', $review->id]]) !!}

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

                        @include('partials.reviews.form', ['media' => $media])
                    {!! Form::close() !!}

                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div> <!-- /.modal -->
        <!-- / Modal -->

        <button class="btn btn-primary btn-lg"
                data-toggle="modal"
                data-target="#reviewModal">Revisar <i class="fa fa-check"></i></button>

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

                        {!! Form::model($review, ['method' => 'PATCH',
                                                  'action' => ['ReviewController@update', $review->id]]) !!}

                            @include('partials.reviews.form', ['media' => $media])

                        {!! Form::close() !!}

                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div> <!-- /.modal -->
            <!-- / Modal -->

            <button class="btn btn-primary btn-lg"
                data-toggle="modal" data-target="#reviewModal">
                Editar revisão <i class="fa fa-check"></i>
            </button>

            @endif
        @endforeach
        <!-- /Edit review -->

    </div>
</div>


