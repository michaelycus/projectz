<div class="form-group">
	{!! Form::label('source_url', 'URL do vídeo', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('source_url', null, ['class' => 'form-control']) !!}						
	</div>					
</div>

<div class="form-group">
	{!! Form::label('project_url', 'URL do projeto', ['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('project_url', null, ['class' => 'form-control']) !!}						
	</div>					
</div>

<div class="form-group">
	{!! Form::label('user_id', 'Autor', ['class' => 'col-sm-2 control-label']) !!}					
	<div class="col-sm-10">	
		{!! Form::select('user_id', $users , Input::old('user_id'), ['class' => 'form-control form-group-margin']) !!}
	</div>
</div>	

<div class="modal-footer">				
	{!! Html::link('videos', 'Cancelar', array('class' => 'btn btn-default')) !!}	
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>