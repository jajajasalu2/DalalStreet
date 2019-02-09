@extends('layouts.app')

@section('content')
<div class="container">
<h1>Team no. {{$team->id}}</h1>
<h3>Balance: {{$team->balance}}</h3>
<hr/>
<h3>Shares: </h3>
@foreach($shares as $share)
<p>{{$share->company_name()}}: {{$share->amount}}</p>
@endforeach
<hr/>
<h3>Shortsold Shares: </h3>
@foreach($shortsold_shares as $shortsold_share)
<p>{{$shortsold_share->company_name()}}: {{$shortsold_share->amount}}, Rate: {{$shortsold_share->rate}}</p>
@endforeach
<a href="/transactions/{{$team->id}}">Transactions</a>
</div>
@endsection
