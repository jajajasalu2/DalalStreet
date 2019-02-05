@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                {!!Form::open(['action'=>'CompanyController@update','method'=>'POST','enctype'=>'multipart/form-data'])!!}
                {{Form::hidden('company_id',$company->id)}}
                <br/>Name: {{Form::text('name',$company->name,['class'=>'form_control'])}}
                
                <br/>Value: {{Form::number('value',$company->value,['class'=>'form_control'])}}
                
                <br/>Rate: {{Form::number('rate',$company->rate,['class'=>'form_control'])}}
                
                <br/>No. of shares: {{Form::number('no_of_shares',$company->no_of_shares,['class'=>'form_control','placeholder'=>'Amount'])}}
                
                <br/>Type: {{Form::text('type',$company->type,['class'=>'form_control'])}}
                
                <br/>Profit/loss:

                <select name="profit_or_loss">
                    <option value=1>Profit</option>
                    <option value=0>Loss</option>
                </select>
                @if ($company_dividend)
                <br/>Dividend Exists: {{Form::number('dividend_exists',1,['class'=>'form_control'])}}
                <br/>Dividend: {{Form::number('dividend',$company_dividend->dividend,['class'=>'form_control'])}}
                <br/>Shares per Dividend: {{Form::number('shares_per_dividend',$company_dividend->shares_per_dividend,['class'=>'form_control'])}}
                @else
                <br/>Dividend Exists: {{Form::number('dividend_exists',0,['class'=>'form_control'])}}
                <br/>Dividend: {{Form::number('dividend',0,['class'=>'form_control'])}}
                <br/>Shares per Dividend: {{Form::number('shares_per_dividend',0,['class'=>'form_control'])}}
                @endif

                @if($company_bonus)
                <br/>Bonus Exists: {{Form::number('bonus_exists',1,['class'=>'form_control'])}}
                <br/>Bonus: {{Form::number('bonus',$company_bonus->bonus,['class'=>'form_control'])}}
                <br/>Shares per Bonus: {{Form::number('shares_per_bonus',$company_bonus->shares_per_bonus,['class'=>'form_control'])}}
                @else
                <br/>Bonus Exists: {{Form::number('bonus_exists',0,['class'=>'form_control'])}}
                <br/>Bonus: {{Form::number('bonus',0,['class'=>'form_control'])}}
                <br/>Shares per Bonus: {{Form::number('shares_per_bonus',0,['class'=>'form_control'])}}
                @endif

                <br/>{{Form::submit('Commit',['class'=>'btn btn-primary'])}}
                {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection