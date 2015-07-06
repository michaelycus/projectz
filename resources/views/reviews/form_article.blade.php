<!-- Javascript -->
<script>
    init.push(function () {

        $('.ui-wizard-review').pixelWizard({
            onChange: function () {
                console.log('Current step: ' + this.currentStep());
            },
            onFinish: function () {
                // Disable changing step. To enable changing step just call this.unfreeze()
                this.freeze();
                console.log('Wizard is freezed');
                console.log('Finished!');
            }
        });

        $('.wizard-next-step-btn').click(function () {
            $(this).parents('.ui-wizard-review').pixelWizard('nextStep');
        });

        $('.wizard-prev-step-btn').click(function () {
            $(this).parents('.ui-wizard-review').pixelWizard('prevStep');
        });

         $('#form-review').onsubmit(function () {
                return false;
            });

        $('#ui-wizard-modal').on('show.bs.modal', function (e) {
            var $modal = $(this),
                $wizard = $modal.find('.ui-wizard-review'),
                timer = null,
                callback = function() {
                    if (timer) clearTimeout(timer);
                    if ($modal.hasClass('in')) {
                        $wizard.pixelWizard('resizeSteps');
                    } else {
                        timer = setTimeout(callback, 10);
                    }
                };
            callback();
        });
    });
</script>

<!-- Modal -->
<div id="ui-wizard-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="wizard ui-wizard-review">
                <div class="wizard-wrapper">
                    <ul class="wizard-steps">
                        <li data-target="#wizard-review-step21" >
                            <span class="wizard-step-number">1</span>
                            <span class="wizard-step-caption">
                                Iniciar
                                <span class="wizard-step-description"></span>
                            </span>
                        </li>
                        <li data-target="#wizard-review-step22"> <!-- ! Remove space between elements by dropping close angle -->
                            <span class="wizard-step-number">2</span>
                            <span class="wizard-step-caption">
                                Revisão
                                <span class="wizard-step-description">O que está faltando?</span>
                            </span>
                        </li>
                        <li data-target="#wizard-review-step23"> <!-- ! Remove space between elements by dropping close angle -->
                            <span class="wizard-step-number">3</span>
                            <span class="wizard-step-caption">
                                Avaliação
                                <span class="wizard-step-description">Sua avaliação final!</span>
                            </span>
                        </li>
                        <li data-target="#wizard-review-step24"> <!-- ! Remove space between elements by dropping close angle -->
                            <span class="wizard-step-number">4</span>
                            <span class="wizard-step-caption">
                                Finalizar
                            </span>
                        </li>
                    </ul> <!-- / .wizard-steps -->
                </div> <!-- / .wizard-wrapper -->

                <div class="wizard-content">
                {!! Form::open(['url' => 'reviews', 'id' => 'form-review'] ) !!}
                    <div class="wizard-pane" id="wizard-review-step21">
                        Ok... vamos iniciar a revisão desse artigo!<br><br>
                        <a class="btn btn-primary wizard-next-step-btn">Iniciar</a>
                    </div> <!-- / .wizard-pane -->
                    <div class="wizard-pane" id="wizard-review-step22">
                        Todos esses itens foram avaliados?<br><br>
                        <ul>
                            <li>Conteúdo dentro do escopo</li>
                            <li>Ortografia</li>
                            <li>Formatação</li>
                            <li>Imagem Destacada (min 1280x720 16:9)</li>
                            <li>Categorias</li>
                            <li>Open Graph Data</li>
                            <li>Links</li>
                            <li>Tags</li>
                        </ul>
                        <div class="row">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Aponte todos os pontos que precisam revisão:</label>
                                <textarea class="form-control" name="body" rows="10" placeholder="Estão faltando esses detalhes..."></textarea>
                            </div>
                        </div>

                        <label for="body"></label>
                        <a class="btn btn-primary wizard-next-step-btn">Próximo</a>
                    </div> <!-- / .wizard-pane -->
                    <div class="wizard-pane" id="wizard-review-step23">
                        Qual sua avaliação final sobre o artigo?<br><br>

                        <div class="row">
                            <div class="form-group no-margin-hr">
                                <select name="status" id="status">
                                @foreach( unserialize(ARTICLE_REVIEW_STATUS) as $key => $option )
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <a class="btn wizard-prev-step-btn">Anterior</a>
                        <a class="btn btn-primary wizard-next-step-btn">Próximo</a>
                    </div> <!-- / .wizard-pane -->
                    <div class="wizard-pane" id="wizard-review-step24">
                        Certo! Obrigado por sua contribuição.<br><br>

                        <a class="btn wizard-prev-step-btn">Anterior</a>

                        {!! Form::hidden('reviewable_id', $resource_id) !!}
                        {!! Form::hidden('reviewable_type', $model) !!}
                        {!! Form::hidden('user_id', Auth::id()) !!}

                        {!! Form::submit('Finalizar', ['class' => 'btn btn-primary']) !!}
                    </div> <!-- / .wizard-pane -->
                    {!! Form::close() !!}
                </div> <!-- / .wizard-content -->
            </div> <!-- / .wizard -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->
<!-- / Modal -->

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><i class="panel-title-icon fa fa-eye"></i>Revisão</span>
    </div>
    <div class="panel-body">

        <div class="panel-group" id="accordion-review">

            @if (count($reviews) == 0)
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Não existem revisões para esse artigo!
                </div>
            @else
                @foreach($reviews as $review)
                <div class="panel">
                    <div class="panel-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-review" href="#collapse_{{ $review->id }}">
                            <img src="http://graph.facebook.com/{{ $review->user->facebook_user_id }}/picture"
                                 alt="{{  $review->user->first_name }}" class="user-tiny"> <i class="fa fa-caret-right"></i> Revisão de {{  $review->user->first_name }}
                        </a>
                    </div> <!-- / .panel-heading -->
                    <div id="collapse_{{ $review->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>{{  $review->body }}</p>
                            <p>Avaliado como: <strong>{{ unserialize(ARTICLE_REVIEW_STATUS)[$review->status]  }}</strong></p>
                        </div> <!-- / .panel-body -->
                    </div> <!-- / .collapse -->
                </div> <!-- / .panel -->
                @endforeach
            @endif

        </div>

        <div class="panel-body">
            <button class="btn btn-info" data-toggle="modal" data-target="#ui-wizard-modal">Iniciar revisão <i class="fa fa-arrow-circle-right"></i></button>
        </div>

    </div>
</div>

@section('script')
<script>
$(".alert-info").fadeTo(5000, 500).slideUp(1500, function(){
    $(".alert-info").alert('close');
});
</script>
@endsection

