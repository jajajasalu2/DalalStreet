@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="card">
            <div class="col-md-8">
                <div class="card-body">
                @foreach ($companies as $company)
                <h2>{{$company->id}}</h2>
                <p>{{$company->name}}</p>
                <a class="btn btn-default" href="/edit/company/{{$company->id}}">Edit</a>
                <a class="btn btn-danger" href="/delete/company/{{$company->id}}">Delete</a>
                <hr/>
                @endforeach
                </div>
            </div>
            </div>
    </div>
</div>
@endsection