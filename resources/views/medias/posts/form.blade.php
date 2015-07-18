<div class="panel-body">
    <div class="form-group">
        {!! Form::label('source_url', 'URL do post', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('source_url', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('title', 'Título', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Descrição', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('user_id', 'Autor', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('user_id', $users , Input::old('user_id'), ['class' => 'form-control form-group-margin']) !!}
        </div>
    </div>
</div>

<div class="panel-footer text-right">
	{!! Html::link(URL::previous(), 'Cancelar', array('class' => 'btn btn-default')) !!}
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>