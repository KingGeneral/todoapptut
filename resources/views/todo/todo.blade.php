@extends('layouts.app');
@section('title',title_case($todo->todo))
@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="paenl panel-primary">
				<div class="panel-heading">
					<h3>{{ title_case($todo->todo) }}<a href="{{ url('todo/'.$todo->id).'/edit' }}" class="btn btn-warning btn-group-sm pull-right">Edit</a></h3>
				</div>
				{{-- category --}}
				<div class="panel-footer"><strong>Category</strong> {{ $todo->category }}</div>
			</div>
		</div>
	</div>
@endsection