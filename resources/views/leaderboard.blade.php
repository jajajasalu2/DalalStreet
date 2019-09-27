@extends('layouts.app')

@section('content')

<br/>
<style>

.table-dark{
  font-size: 100px;
}

</style>

<div class="container">
    <h3>Teams</h3>
	<div class="card">
		<div class="card-body">
	<table class="table table-striped table-dark">
		<thead>
    <tr>
      
      <th scope="col">Teams</th>
      <th scope="col">Balance</th>
     
    </tr>
  </thead>
  </table>
		@foreach ($teams as $team)
		    
			
		<table class="table table-striped table-dark">
  
  <tbody>
    <tr>
      
       <th > Team No. {{$team->id}}</th>
      <th id="id">{{$team->balance}}</th>
      
    </tr>
  
    
  </tbody>
</table>





			
			
			
			<!-- <div class="row">
			<div class="col-md-4">
			<h3>Team No. {{$team->id}}</h3>
			</div>
			<div class="col-md-8">
			<h3>Balance: {{$team->balance}}</h3>
			</div>
		    </div>
		    <hr/> -->
		@endforeach
		</div>
	</div>
</div>
@endsection
