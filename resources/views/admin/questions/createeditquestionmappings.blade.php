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
    {!! Form::model($questionMappingData,['method' =>'POST','action' => $formaction] ) !!}
    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
{{--            <a href={{URL::to("/admin/questions/mappings/$confQuestionId/$masterQuestionId")}} class="btn btn-large btn-success" style="font-size: 14px !important;">View Question Mappings List</a>--}}
            <a href={{URL::to("/admin/questions/mappings/$confQuestionId/$masterQuestionId")}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
            <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Question Mapping</a>
        </div>
    </div><!-- end container -->
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active">
                {!! Form::hidden('id',null) !!}
                {!! Form::hidden('conf_question_id',$confQuestionId) !!}
                {!! Form::hidden('masterQuestionId',$masterQuestionId) !!}
                    {{--<div class="form-group {{ $errors->has('conf_master_id') ? 'has-error' : '' }}">                        --}}
                        {{--{!! $errors->first('conf_question_id','<span class="help-block">:message</span>') !!}--}}
                        {{--{!! Form::label('conf_question_id','Question *', ['class' => '']) !!}--}}
                        {{--{!! Form::label('conf_question_id',$chosenQuestion->question_label, ['class' =>'form-control'])--}}
                        {{--!!}--}}
                    {{--</div>--}}
                <div class="form-group {{ $errors->has('conf_field_id') ? 'has-error' : '' }}">
                    {!! $errors->first('conf_field_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('conf_field_id','Field Type', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('conf_field_id',$attributeConfField, $chosenConfField, ['id' => 'conf_field_id', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('conf_condition_id') ? 'has-error' : '' }}">
                    {!! $errors->first('conf_condition_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('conf_condition_id','Condition', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('conf_condition_id',$attributeConfCondition, $chosenConfCondition, ['id' => 'conf_condition_id', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('operand') ? 'has-error' : '' }}">
                    {!! $errors->first('operand','<span class="help-block">:message</span>') !!}
                    {!! Form::label('operand','Operand', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('operand',$attributeOperand, $chosenOperand, ['id' => 'operand', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group collapse" id="SingleValue">
                    <div class="form-group {{ $errors->has('single_value') ? 'has-error' : '' }}">
                        {!! $errors->first('single_value','<span class="help-block">:message</span>') !!}
                        {!! Form::label('single_value','Single value', ['class' => '']) !!}
                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                        {!! Form::text('single_value', null, ['id' => 'single_value', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group collapse" id="RangeValue">
                    <div class="form-group {{ $errors->has('begin_range') ? 'has-error' : '' }}">
                        {!! $errors->first('begin_range','<span class="help-block">:message</span>') !!}
                        {!! Form::label('begin_range','Begin Range', ['class' => '']) !!}
                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                        {!! Form::text('begin_range', null, ['id' => 'begin_range', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{ $errors->has('end_range') ? 'has-error' : '' }}">
                        {!! $errors->first('end_range','<span class="help-block">:message</span>') !!}
                        {!! Form::label('end_range','End Range', ['class' => '']) !!}
                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                        {!! Form::text('end_range', null, ['id' => 'end_range', 'class' => 'form-control']) !!}
                    </div>
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
                    <a href="{{URL::to("/admin/questions/mappings/$confQuestionId/$masterQuestionId")}}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
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
            $('#conf_field_id').select2({
                allowClear: true,
                placeholder: "Select Field"
            });

            $('#status').select2({
                allowClear: true,
                placeholder: "Select Status"
            });
            $('#conf_condition_id').select2({
                allowClear: true,
                placeholder: "Select Condition"
            });
            $('#operand').select2({
                allowClear: true,
                placeholder: "Select Operand"
            });
        });

        $('#operand').change(function () {
            if ($('#operand').val() == 'between') {
                $("#RangeValue").collapse("show");
                $("#SingleValue").collapse("hide");
            }
            else {
                $("#SingleValue").collapse("show");
                $("#RangeValue").collapse("hide");
            }
        });

        @if (isset($questionMappingData) && $questionMappingData->operand == 'between')
            $("#RangeValue").collapse("show");
        @else
            $("#SingleValue").collapse("show");
        @endif

        @if (count($errors) > 0)
        if ($('#operand').val() == 'between') {
            $("#RangeValue").collapse("show");
        }
        else {
            $("#SingleValue").collapse("show");
        }

        @endif

    </script>
@endsection