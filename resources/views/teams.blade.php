@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <h3>Teams<h3>
	<div class="card">
		<div class="card-body">
		@foreach ($teams as $team)
		    <div class="row">
			<a href="/team/{{$team->id}}">Team No. {{$team->id}}</a>
		    </div>
		    <hr/>
		@endforeach
        </div>
    </div>
</div>
@endsection
