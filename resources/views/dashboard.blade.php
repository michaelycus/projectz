
@extends('layouts.master')

@section('content')

<div class="page-header">
    <h1><i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;Dashboard</h1>
</div>


<div class="row">
    <div class="col-md-6">

        <div class="stat-panel">
            <div class="stat-row">
                <!-- Small horizontal padding, bordered, without right border, top aligned text -->
                <div class="stat-cell col-sm-6 padding-sm-hr bordered no-border-r valign-top">
                    <!-- Small padding, without top padding, extra small horizontal padding -->
                    <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-user text-primary"></i>&nbsp;&nbsp;Meus trabalhos</h4>
                    <!-- Without margin -->
                    <ul class="list-group no-margin">
                        <!-- Without left and right borders, extra small horizontal padding, without background, no border radius -->
                        <li class="list-group-item no-border-hr padding-xs-hr no-bg no-border-radius">
                            Artigos <span class="label label-pa-purple pull-right">34</span>
                        </li> <!-- / .list-group-item -->
                        <!-- Without left and right borders, extra small horizontal padding, without background -->
                        <li class="list-group-item no-border-hr padding-xs-hr no-bg">
                            Vídeos <span class="label label-danger pull-right">128</span>
                        </li> <!-- / .list-group-item -->
                        <!-- Without left and right borders, without bottom border, extra small horizontal padding, without background -->
                        <li class="list-group-item no-border-hr no-border-b padding-xs-hr no-bg">
                            Posts <span class="label label-success pull-right">12</span>
                        </li> <!-- / .list-group-item -->
                    </ul>
                </div> <!-- /.stat-cell -->

                <div class="stat-cell col-sm-6 padding-sm-hr bordered no-border-l valign-top">
                    <!-- Small padding, without top padding, extra small horizontal padding -->
                    <h4 class="padding-sm no-padding-t padding-xs-hr"><i class="fa fa-group text-primary"></i>&nbsp;&nbsp;Equipe</h4>
                    <!-- Without margin -->
                    <ul class="list-group no-margin">
                        <!-- Without left and right borders, extra small horizontal padding, without background, no border radius -->
                        <li class="list-group-item no-border-hr padding-xs-hr no-bg no-border-radius">
                            Artigos <span class="label label-pa-purple pull-right">34</span>
                        </li> <!-- / .list-group-item -->
                        <!-- Without left and right borders, extra small horizontal padding, without background -->
                        <li class="list-group-item no-border-hr padding-xs-hr no-bg">
                            Vídeos <span class="label label-danger pull-right">128</span>
                        </li> <!-- / .list-group-item -->
                        <!-- Without left and right borders, without bottom border, extra small horizontal padding, without background -->
                        <li class="list-group-item no-border-hr no-border-b padding-xs-hr no-bg">
                            Posts <span class="label label-success pull-right">12</span>
                        </li> <!-- / .list-group-item -->
                    </ul>
                </div> <!-- /.stat-cell -->


            </div>
        </div>

    </div>
</div>

</div>


<div id="content-wrapper">
	
	<div class="col-md-4">
	</div>
	<div class="col-md-4">

		<div class="panel panel-success panel-dark panel-body-colorful widget-profile widget-profile-centered">
			<div class="panel-heading">						
				<img src="//graph.facebook.com/10206432895324665/picture" alt="" class="widget-profile-avatar">
				<div class="widget-profile-header">
					<span>Olá!</span><br>							
				</div>
			</div>
			<div class="panel-body">
				<div class="widget-profile-text" style="padding: 0;">
					O sistema ainda está bastante simples, mas é o suficiente para iniciarmos as atividades. 
					Em breve teremos mais recursos que vão nos ajudar a organizar melhor todos os diferentes tipos de recursos que possuímos.
				</div>
			</div>
		</div> 
	</div>	

	<div class="col-md-4">
	</div>

</div>	

@stop

@section('script')

			
@stop
