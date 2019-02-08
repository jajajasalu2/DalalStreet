@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <h3>Companies<h3>
	<div class="card">
		<div class="card-body">
		@foreach ($companies as $company)
		    <div class="row">
			<a href="/company/{{$company->id}}">{{$company->name}}</a>
		    </div>
		    <hr/>
		@endforeach
        </div>
    </div>
</div>
@endsection
