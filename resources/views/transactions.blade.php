@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <h3>Team no. {{$team_id}}<h3>
	<div class="card">
		<div class="card-body">
        @foreach ($transactions as $transaction)
            <div class="row">
            <div class="col-md-4">
            <h3>{{$transaction->company()}}</h3>
            <br/>
            </div>
            <div class="col-md-4">
            <h5>{{$transaction->created_at}}</h5>
            <br/>
            </div>
            <h5>
            @if ($transaction->buy_sell == 1)
            BOUGHT {{$transaction->amount}}
            @elseif($transaction->buy_sell == 2)
            SOLD {{$transaction->amount}}
            @elseif($transaction->buy_sell == 3)
            BOUGHT BACK {{$transaction->amount}}
            @else
            SHORT SOLD {{$transaction->amount}}
            @endif
            </h5>
            </div>
            <hr/>
        @endforeach
        </div>
    </div>
</div>
@endsection
