@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                {!!Form::open(['action'=>'TransactionController@create','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                <select name="company_id">
                    @foreach ($companies as $company)
                        <option value={{$company->id}}>{{$company->name}}</option>
                    @endforeach
                </select>
                {{Form::number('team_id','',['class'=>'form_control','placeholder'=>'Team ID'])}}
                {{Form::number('amount','',['class'=>'form_control','placeholder'=>'Amount'])}}
                <select name="buy_sell">
                    <option value=1>Buy</option>
                    <option value=2>Sell</option>
                    <option value=3>Buy back</option>
                    <option value=4>Short sell</option>
                </select>
                {{Form::submit('Commit',['class'=>'btn btn-primary'])}}
                {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                {!!Form::open(['action'=>'TransactionController@session_end','method'=>'GET','enctype'=>'multipart/form-data'])!!}
                {{Form::submit('End Session',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
