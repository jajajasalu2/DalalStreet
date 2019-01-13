@extends('layouts.app')

@section('content')
<div class="container">
<h1>{{$company->name}}</h1>
<h3>Type: {{$company->type}}</h3>
<h3>Value: {{$company->value}}</h3>
<h3>Rate: {{$company->rate}}</h3>
<hr/>
</div>
@endsection