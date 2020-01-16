@extends('app_header') 
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
        <div class="clearfix_responsive"></div>
        <div class="container-fluid">
         <div class="row">
            @include('errors')
            <div class="card">
             <div class="card-header" data-background-color="green">
                <h4 class="title">Master Questions<span class="pull-right">Admin </span></h4>
                {{--  <p class="category">Apply new loan</p>   --}}
            </div>
    <section class="content_style2">
    </section>
    {!! Form::model($questionData,['method' =>'POST','action' => $formaction] ) !!}
    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
{{--            <a href={{URL::to("/admin/questions/configured-question/$masterQuestionId")}} class="btn btn-large btn-success" style="font-size: 14px !important;">View Configured Questions</a>--}}
            <a href={{URL::to("/admin/questions/configured-question/$masterQuestionId")}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
            <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Questions</a>
        </div>
    </div><!-- end container -->
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active">
                @if(isset($questionData))
                    <div class="form-group {{ $errors->has('conf_master_id') ? 'has-error' : '' }}">
                        {!! Form::hidden('id',null) !!}
                        {!! Form::hidden('conf_master_id',$questionData->conf_master_id) !!}
                        {!! $errors->first('conf_master_id','<span class="help-block">:message</span>') !!}
                        {!! Form::label('conf_master_id','Question', ['class' => '']) !!}
                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                        {!! Form::label('conf_master_id',$chosenQuestion->question_label, ['class' =>'form-control'])
                        !!}
                    </div>
                @else
                <div class="form-group {{ $errors->has('conf_master_id') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! $errors->first('conf_master_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('conf_master_id','Question', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('conf_master_id',$attributeQuestion, $chosenQuestion, ['id' => 'question_label', 'class' => 'form-control']) !!}
                </div>
                @endif
                <div class="form-group {{ $errors->has('loan_type') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! $errors->first('loan_type','<span class="help-block">:message</span>') !!}
                    {!! Form::label('loan_type','Loan Type', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('loan_type',$attributeLoanProductType, $chosenLoanProductType, ['id' => 'loan_type', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! $errors->first('status','<span class="help-block">:message</span>') !!}
                    {!! Form::label('status','Status', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('status', $attributeStatus, $chosenStatus, ['id' => 'status', 'class' => 'form-control']) !!}

                </div>
                <div class="clearfix"></div>
                <div class="center-align" ></div>
                <div class="row">
                    {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
                    <a href="{{URL::to("admin/questions/configured-question/$masterQuestionId")}}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
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
            $('#question_label').select2({
                allowClear: true,
                placeholder: "Select Question"
            });

            $('#status').select2({
                allowClear: true,
                placeholder: "Select Status"
            });
            $('#loan_type').select2({
                allowClear: true,
                placeholder: "Select Loan Type"
            });

        });

    </script>
@endsection