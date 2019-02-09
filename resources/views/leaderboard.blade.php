@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <h3>Teams</h3>
	<div class="card">
		<div class="card-body">
		@foreach ($teams as $team)
		    <div class="row">
			<div class="col-md-4">
			<h3>Team No. {{$team->id}}</h3>
			</div>
			<div class="col-md-8">
			<h3>Balance: {{$team->balance}}</h3>
			</div>
		    </div>
		    <hr/>
		@endforeach
		</div>
	</div>
</div>
@endsection
