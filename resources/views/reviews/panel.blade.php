<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><i class="panel-title-icon fa fa-eye"></i>Revisão</span>
    </div>
    <div class="panel-body">

        <div class="panel-group" id="accordion-review">

            @if (count($reviews) == 0)
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Não existem revisões para esse item!
                </div>
            @else
                @foreach($reviews as $review)
                <div class="panel panel-{{ $review->status == REVIEW_DANGER ? 'danger' : ($review->status == REVIEW_WARNING ? 'warning' : 'success') }}">
                    <div class="panel-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-review" href="#collapse_{{ $review->id }}">
                             <img src="http://graph.facebook.com/{{ $review->user->facebook_user_id }}/picture"
                                 alt="{{  $review->user->first_name }}" class="user-tiny"> <i class="fa fa-caret-right"></i> Revisão de {{  $review->user->first_name }}
                        </a>
                    </div> <!-- / .panel-heading -->
                    <div id="collapse_{{ $review->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>{{  $review->body }}</p>
                            <p>Avaliado como: <strong>{{ unserialize(REVIEW_STATUS)[$review->status] }}</strong></p>
                        </div> <!-- / .panel-body -->
                    </div> <!-- / .collapse -->
                </div> <!-- / .panel -->
                @endforeach
            @endif
        </div>

        <!-- Create review -->
        @if (!Auth::user()->hasReview($reviews))

        <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="reviewModalLabel">Revisar</h4>
                    </div>

                    {!! Form::open(['url' => 'reviews', 'id' => 'form-review'] ) !!}

                        @include('reviews.form', ['resource_id' => $resource_id,
                                                  'model' => $model,
                                                  'items' => unserialize(ARTICLE_REVIEW_ITEMS)])
                    {!! Form::close() !!}

                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div> <!-- /.modal -->
        <!-- / Modal -->

        <div class="panel-body">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reviewModal">Iniciar revisão <i class="fa fa-check"></i></button>
        </div>
        @endif

        <!-- Edit review -->
        @foreach($reviews as $review)
            @if ($review->user_id == Auth::id() )

            <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="reviewModalLabel">Revisar</h4>
                        </div>

                        {!! Form::model($review, ['method' => 'PATCH', 'action' => ['ReviewController@update', $review->id]]) !!}

                            @include('reviews.form', ['resource_id' => $resource_id,
                                                      'model' => $model,
                                                      'items' => unserialize(ARTICLE_REVIEW_ITEMS)])

                        {!! Form::close() !!}

                    </div> <!-- / .modal-content -->
                </div> <!-- / .modal-dialog -->
            </div> <!-- /.modal -->
            <!-- / Modal -->

            <div class="panel-body">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reviewModal">Editar revisão <i class="fa fa-check"></i></button>
            </div>
            @endif
        @endforeach


    </div>
</div>


