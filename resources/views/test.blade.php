@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                {!!Form::open(['action'=>'TransactionController@create','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                
                {{Form::text('company_id','',['class'=>'form_control','placeholder'=>'Company ID'])}}
                {{Form::text('team_id','',['class'=>'form_control','placeholder'=>'Team ID'])}}
                {{Form::text('amount','',['class'=>'form_control','placeholder'=>'Amount'])}}
                {{Form::text('buy_sell','',['class'=>'form_control','placeholder'=>'Buy Sell'])}}
                {{Form::submit('Commit',['class'=>'btn btn-primary'])}}

                {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
