@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <a class="btn btn-default" href="/create/company">Create Company</a>
            <div class="card">
            <div class="col-md-8">
                <div class="card-body">
                @foreach ($companies as $company)
                <h2>{{$company->id}}</h2>
                <p>{{$company->name}}</p>
                <a class="btn btn-default" href="/edit/company/{{$company->id}}">Edit</a>
                {!!Form::open(['action'=>'CompanyController@delete','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                {{Form::hidden('company_id',$company->id)}}
                {{Form::hidden('delete_company',1)}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
                <hr/>
                @endforeach
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
