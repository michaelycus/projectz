@extends('layouts.master')

@section('content')


@if (Auth::user()->hasPermission(\App\Permission::POST_CREATE))
<div class="page-header">	
	<h1><span class="text-light-gray">Posts / </span>
	    {{ with(new App\Post)->getStatusLabels()[Input::get('status')] }}</h1>
	<div class="pull-right col-xs-12 col-sm-auto">
		<a href="{{ url('posts/create') }}" class="btn btn-primary btn-labeled" style="width: 100%;">
			<span class="btn-label icon fa fa-plus"></span>Criar post
		</a>
	</div>
</div>
@endif

<div class="row">
@foreach ($posts as $post)
	<div class="col-md-4">

		<div class="stat-panel">
		    <div class="stat-row">
                <!-- Info background, without padding, horizontally centered text, super large text -->
                <div class="stat-cell no-padding text-center text-normal panel-padding">
                    <div class="panel">
                        <div class="panel-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-post" href="#collapse_{{ $post->id }}">
                                 <img src="{{ $post->user->getAvatar() }}"
                                     alt="{{  $post->user->first_name }}" class="user-tiny pull-left">
                                 {{ $post->title }}
                            </a>
                        </div> <!-- / .panel-heading -->
                        <div id="collapse_{{ $post->id }}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>{{  $post->description }}</p>
                                <p class="text-center"><a href="{{ url('posts/'.$post->id) }}" class="btn btn-info btn-xs">Veja mais</a></p>
                            </div> <!-- / .panel-body -->
                        </div> <!-- / .collapse -->
                    </div>
                </div>
            </div> <!-- /.stat-row -->

            <div class="stat-row">
                <!-- Bordered, without top border, horizontally centered text, large text -->
                <div class="stat-cell bordered no-border-t">
                    <a class="embedly-card" href="{{ $post->source_url }}">{{ $post->source_url }}</a>
                </div>
            </div>
        </div>
	</div>
@endforeach
</div>
<div class="row">
    <div class="text-center">
         {!! $posts->appends(['status' => Input::get('status')])->render() !!}
    </div>
</div>

@endsection

@section('script')

<script>

init.push(function () {
    var setEqHeight = function () {
        $('#content-wrapper .row').each(function () {
            var $p = $(this).find('.stat-panel');
            if (! $p.length) return;
            $p.attr('style', '');
            var h = $p.first().height(), max_h = h;
            $p.each(function () {
                h = $(this).height();
                if (max_h < h) max_h = h;
            });
            $p.css('height', max_h);
        });
    };

    if ($(this).hasClass('disabled')) return;
    $(this).addClass('disabled');
    setEqHeight();
    $(window).on('pa.resize', setEqHeight);
    $(window).resize();

});
</script>

<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
			
@endsection