@extends('layouts.master')

@section('title') {{ l('Options - Create') }} @parent @stop


@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3" style="margin-top: 50px">
		<div class="panel panel-info">
			<div class="panel-heading"><h3 class="panel-title"><strong>{{ $optiongroup->name }}</strong> :: {{ l('New Option') }}</h3></div>
			<div class="panel-body">

				@include('errors.list')

				{!! Form::open(array('route' => array('optiongroups.options.store', $optiongroup->id))) !!}
				<!-- input type="hidden" value="{{$optiongroup->id}}" name="option_group_id" -->

					@include('options._form')

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@stop