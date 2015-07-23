<div class="modal-body">
    <strong>Todos</strong> estes itens foram avaliados?<br><br>

         @foreach($media->getReviewOptions() as $option)
         <div class="checkbox" style="margin: 0;">
             <label>
         {!! Form::checkbox($option->id, $option->id, null, ['class' => 'px']) !!}<span class="lbl">{{ $option->title }}</span>
            </label>
         </div>
         @endforeach

    <div class="form-group no-margin-hr">
        <label class="control-label">Aponte todos os pontos que precisam de revisão:</label>
        {!! Form::textarea('body', null, ['class' => 'form-control',
                                          'size' => '30x5',
                                          'placeholder' => 'Estão faltando esses detalhes...']) !!}
    </div>

    <p>Qual sua avaliação final?</p>
    <div class="form-group no-margin-hr">
        {!! Form::select('status',
                          \App\Review::getReviewStatus(),
                          Input::old('status'), ['class' => 'form-control form-group-margin']) !!}
    </div>

    {!! Form::hidden('reviewable_id', $media->id) !!}
    {!! Form::hidden('reviewable_type', get_class($media)) !!}
    {!! Form::hidden('user_id', Auth::id()) !!}

</div> <!-- / .modal-body -->
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    {!! Form::submit('Finalizar', ['class' => 'btn btn-primary']) !!}
</div>