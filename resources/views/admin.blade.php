@extends('layouts.app')

@section('content')
<div class="container">
    <div class="column">
    <a class="btn btn-default" href="/create/company">Create Company</a>
            
            <div class="col-sm-4">
                <div class="card-body">
                @foreach ($companies as $company)
                <h3>{{$company->id}}</h3>
                <p>{{$company->name}}</p>
                <a class="btn btn-default" href="/edit/company/{{$company->id}}">Edit</a>
                <hr/>
                @endforeach
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
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                {!!Form::open(['action'=>'TransactionController@end_game','method'=>'GET','enctype'=>'multipart/form-data'])!!}
                {{Form::submit('End Game',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
