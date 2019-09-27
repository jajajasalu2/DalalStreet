@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{$company->name}}</h1>
        <h3>Type: {{$company->type}}</h3>
        <h3>Rate: {{$company->rate}}</h3>
        <hr />
        @if (Auth::user()->role != 3)
        <div class="row justify-content-center">
                <div class="col-md-8">
                        <div class="card">
                                <div class="card-body">
                                        {!!Form::open(['action'=>'TransactionController@create','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                                        {{Form::hidden('company_id',$company->id)}}
                                        <br />
                                        {{Form::label('team_id','Team ID')}}
                                        {{Form::number('team_id','',['class'=>'form_control','placeholder'=>'Team ID'])}}

                                        <br />

                                        {{Form::label('amount','No of Shares')}}
                                        {{Form::number('amount','',['class'=>'form_control','placeholder'=>'Amount'])}}

                                        <br />
                                        {{Form::label('buy_sell','Option')}}
                                        <select name="buy_sell">
                                                <option value=1>Buy</option>
                                                <option value=2>Sell</option>
                                                <option value=3>Buy back</option>
                                                <option value=4>Short sell</option>
                                        </select>

                                        <br />
                                        {{Form::submit('Commit',['id'=>'commit-button','class'=>'btn btn-primary'])}}
                                        {!!Form::close()!!}
                                </div>
                        </div>
                </div>
        </div>

        @endif
</div>
@endsection