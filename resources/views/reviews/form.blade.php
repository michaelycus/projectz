<div class="modal-body">
    <strong>Todos</strong> esses itens foram avaliados?<br><br>
    <ul>
        @foreach($items as $item)
        <li>{{ $item }}</li>
        @endforeach
    </ul>

    <div class="form-group no-margin-hr">
        <label class="control-label">Aponte todos os pontos que precisam revisão:</label>
        {!! Form::textarea('body', null, ['class' => 'form-control', 'size' => '30x5', 'placeholder' => 'Estão faltando esses detalhes...']) !!}
    </div>

    <p>Qual sua avaliação final?</p>
    <div class="form-group no-margin-hr">
        {!! Form::select('status', unserialize(REVIEW_STATUS), Input::old('status'), ['class' => 'form-control form-group-margin']) !!}
    </div>

    {!! Form::hidden('reviewable_id', $resource->id) !!}
    {!! Form::hidden('reviewable_type', $model) !!}
    {!! Form::hidden('user_id', Auth::id()) !!}

</div> <!-- / .modal-body -->
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    {!! Form::submit('Finalizar', ['class' => 'btn btn-primary']) !!}
</div>