@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Manage Manual Bank Allocations<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
    <section class="content_style2">
    <section class="content_style2">
    </section>
    {!! Form::model(null,['method' =>'POST','action' => $formaction] ) !!}

    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
            <a href="{{URL::to("/admin/manualallocation")}}" class="btn btn-large btn-success btn-space" style="font-size: 14px !important;">Admin</a>
            <a href="#" class="btn btn-large btn-success btn-space active" style="font-size: 14px !important;">Manage Manual Bank Allocations</a>
        </div>

    </div><!-- end container -->

    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">

                <div class="form-group {{ $errors->has('loan_id') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! Form::hidden('allocation_type',2) !!}
                    {!! $errors->first('loan_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('loan_id','Loan Id', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('loan_id', $loansList, null, ['id' => 'loan_id', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
                    {!! $errors->first('bank_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('bank_id','Bank', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('bank_id', $banksList, null, ['id' => 'bank_id', 'class' => 'form-control']) !!}
                </div>

                <div class="clearfix"></div>
                {!! Form::label('bank_id','Note: Allocation Type will be set to Manual', ['class' => '']) !!}
                <div class="center-align" ></div>

                <div class="row">
                    {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
                    <a href="{{URL::to("/admin/manualallocation") }}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa fa-sign-out"></i> Exit</a>
                </div>

            </div>
        </div><!-- end tab-content -->

    </div><!-- end container -->

    {!! Form::close() !!}
@endsection

@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#loan_id').select2({
                allowClear: true,
                placeholder: "Select Loan"
            });

            $('#bank_id').select2({
                allowClear: true,
                placeholder: "Select Bank"
            });
        });

    </script>
@endsection