@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Bank Allocations<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
    <section class="content_style2">
    </section>
    {!! Form::model($bankDimensionData,['method' =>'POST','action' => $formaction] ) !!}

    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
            <a href={{URL::to("/admin/bankallocation/dimension/".$categoryId.'/'.$bankId)}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
{{--            <a href={{URL::to("/admin/bankallocation/dimension/".$categoryId.'/'.$bankId)}} class="btn btn-large btn-success" style="font-size: 14px !important;">View Manage Bank Allocation Dimension</a>--}}
            <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Bank Allocation Dimension</a>
            <br>
            @if(isset($bankDimensionData) && $bankDimensionData->operand == 'IN' || isset($bankDimensionData) && $bankDimensionData->operand == 'NOTIN')
                {!! Form::label('operand','Note: The sub dimensions can be changed from clicking on dimensions.', ['class' => '']) !!}
            @endif
        </div>

    </div><!-- end container -->
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">
                <div class="form-group {{ $errors->has('categoryName') ? 'has-error' : '' }}">
                    {!! $errors->first('categoryName','<span class="help-block">:message</span>') !!}
                    {!! Form::label('categoryName','Category Name ', ['class' => '']) !!}
                    {!! Form::text('categoryName',$categoryName,['class' => 'form-control',$setDisable]) !!}
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! Form::hidden('category_id',$categoryId) !!}
                    {!! Form::hidden('bankId',$bankId) !!}
                    {!! $errors->first('type','<span class="help-block">:message</span>') !!}
                    {!! Form::label('type','Type ', ['class' => '']) !!}
                    @if (isset($bankDimensionData))
                        {!! Form::text('type',null,['class' => 'form-control',$setDisable]) !!}
                    @else
                        {!! Form::text('type',null,['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
                    {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                    {!! Form::label('name','Name ', ['class' => '']) !!}
                    @if (isset($bankDimensionData))
                        {!! Form::text('name',null,['class' => 'form-control',$setDisable]) !!}
                    @else
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    @endif
                    
                </div>
                <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                    {!! $errors->first('model','<span class="help-block">:message</span>') !!}
                    {!! Form::label('model','Model ', ['class' => '']) !!}
                    @if (isset($bankDimensionData))
                        {!! Form::text('model',null,['class' => 'form-control',$setDisable]) !!}
                    @else
                        {!! Form::text('model',null,['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group {{ $errors->has('attribute') ? 'has-error' : '' }}">
                    {!! $errors->first('attribute','<span class="help-block">:message</span>') !!}
                    {!! Form::label('attribute','Attribute ', ['class' => '']) !!}
                    @if (isset($bankDimensionData))
                        {!! Form::text('attribute',null,['class' => 'form-control',$setDisable]) !!}
                    @else
                        {!! Form::text('attribute',null,['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! $errors->first('description','<span class="help-block">:message</span>') !!}
                    {!! Form::label('description','Description', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::text('description',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('operand') ? 'has-error' : '' }}">
                    {!! $errors->first('operand','<span class="help-block">:message</span>') !!}
                    {!! Form::label('operand','Operand', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('operand',$attributeOperand, $chosenOperand, ['id' => 'operand', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group collapse" id="SingleValue">
                    <div class="form-group {{ $errors->has('single_value') ? 'has-error' : '' }}">
                        {!! $errors->first('single_value','<span class="help-block">:message</span>') !!}
                        {!! Form::label('single_value','Single value', ['class' => '']) !!}
                        {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                        {!! Form::text('single_value', null, ['id' => 'single_value', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group collapse" id="RangeValue">
                    <div class="form-group {{ $errors->has('begin_range') ? 'has-error' : '' }}">
                        {!! $errors->first('begin_range','<span class="help-block">:message</span>') !!}
                        {!! Form::label('begin_range','Begin Range', ['class' => '']) !!}
                        {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                        {!! Form::text('begin_range', null, ['id' => 'begin_range', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group {{ $errors->has('end_range') ? 'has-error' : '' }}">
                        {!! $errors->first('end_range','<span class="help-block">:message</span>') !!}
                        {!! Form::label('end_range','End Range', ['class' => '']) !!}
                        {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                        {!! Form::text('end_range', null, ['id' => 'end_range', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('sortorder') ? 'has-error' : '' }}">
                    {!! $errors->first('sortorder','<span class="help-block">:message</span>') !!}
                    {!! Form::label('sortorder','Sort Order', ['class' => '']) !!}
                    {!! Form::text('sortorder',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! $errors->first('status','<span class="help-block">:message</span>') !!}
                    {!! Form::label('status','Status', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('status', $attributeStatus, $chosenStatus, ['id' => 'status', 'class' => 'form-control']) !!}
                </div>

                <div class="clearfix"></div>
                <div class="center-align" ></div>

                <div class="row">
                    {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
                    <a href="{{URL::to("/admin/bankallocation/dimension/".$categoryId.'/'.$bankId)}}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
                </div>

                {{--<div class="form-group">--}}
                    {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
                {{--</div>--}}
            </div>
        </div><!-- end tab-content -->

    </div><!-- end container -->

    {!! Form::close() !!}
 
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#status').select2({
                allowClear: true,
                placeholder: "Select Status"
            });

            $('#operand').select2({
                allowClear: true,
                placeholder: "Select Operand"
            });
        });

        $('#operand').change(function () {
            if ($('#operand').val() == 'IN' || $('#operand').val() == 'NOTIN') {
                $("#SingleValue").collapse("hide");
                $("#RangeValue").collapse("hide");
            }
            else if ($('#operand').val() == 'between') {
                $("#RangeValue").collapse("show");
                $("#SingleValue").collapse("hide");
            }
            else {
                $("#SingleValue").collapse("show");
                $("#RangeValue").collapse("hide");
            }
        });
        @if (isset($bankDimensionData) && $bankDimensionData->operand == 'IN' || isset($bankDimensionData) && $bankDimensionData->operand == 'NOTIN'){
            $("#RangeValue").collapse("hide");
            $("#SingleValue").collapse("hide");
        }
        @elseif (isset($bankDimensionData) && $bankDimensionData->operand == 'between')
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