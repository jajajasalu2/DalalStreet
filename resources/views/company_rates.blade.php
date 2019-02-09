@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <h3>Companies<h3>
	<div class="card">
		<div class="card-body">
		@foreach ($companies as $company)
		    <div class="row">
			<div class="col-md-4">
			<a href="/company/{{$company->id}}">{{$company->name}}</a>
			</div>
			<div class="col-md-8">
			@if($company->type == 'COMPANY')
			<h4>COMPANY</h4>	
			@else
			<h4>FOREX</h4>	
			@endif
			<div class="col-md-12">
			<h4>$company->rate</h4>
			</div>
		    </div>
		    <hr/>
		@endforeach

        </div>
    </div>
</div>
@endsection
