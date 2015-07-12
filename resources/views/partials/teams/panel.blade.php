<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><i class="panel-title-icon {{ \App\Team::ICON }}"></i>Voluntários</span>
    </div>
    <div class="panel-body">
        @if ($media->team->isEmpty())
            Nenhum voluntário trabalhando nesse projeto.
        @else
            Quem está ajudando:
            @foreach($media->team as $person)
            <img src="http://graph.facebook.com/{{ $person->user->facebook_user_id }}/picture"
                 alt="{{  $person->user->first_name }}" class="user-tiny">
            @endforeach
        @endif

        <hr/>

        <!-- Start to help -->
        @if (!Auth::user()->isInTeam($media->team))
        {!! Form::open(['url' => 'teams', 'id' => 'form-team']) !!}

            {!! Form::hidden('teamable_id', $media->id) !!}
            {!! Form::hidden('teamable_type', get_class($media)) !!}
            {!! Form::hidden('user_id', Auth::id()) !!}
            {!! Html::decode(Form::button('Ajudar <i class="fa fa-user-plus"></i>',
                                            array('class' => 'btn btn-lg btn-primary btn-labeled',
                                                  'type' => 'submit'))) !!}

        {!! Form::close() !!}
        @else
            @foreach($media->team as $member_team)
                @if ($member_team->user_id == Auth::id())

                {!! Form::open(array('method' => 'DELETE',
                                     'route' => array('teams.destroy', $member_team->id))) !!}
                    {!! Html::decode(Form::button('Sair do grupo <i class="fa fa-user-times"></i>',
                        array('class' => 'btn btn-lg btn-danger', 'type' => 'submit'))) !!}
                {!! Form::close() !!}

                @endif
            @endforeach
        @endif
        <!-- /Start to help -->
    </div>
</div>


