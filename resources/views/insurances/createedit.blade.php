<?php
$user = Auth::user();
?>
@extends('app_header')
@section('head-content')

    
@endsection

@section('firm')
    @if (isset($loanUserProfile))
        <div class="firm-name-background">
            <div class="firm-name-wrap"> 
                {{$loanUserProfile->name_of_firm}}
            </div>       
        </div>
    @endif
@endsection


@section('content')

    @if($subViewType=='insurances._choose_insurance')
        {!! Form::model($insurance,['method' =>'POST','id'=>'chooseInsurance','action' => $formaction, 'role'=> 'form'] ) !!}
    @endif
        @include('insurances._form_master',array('sub_view_type' => $subViewType));

    {!! Form::close() !!}

@endsection