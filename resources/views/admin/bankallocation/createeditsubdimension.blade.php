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
    </section><label>{!! $bankDetails->name !!}</label>
    {!! Form::model($subDimensionData,['method' =>'POST','action' => $formaction] ) !!}

    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
            <a href={{URL::to("/admin/bankallocation/sub-dimension/".$dimensionId.'/'.$categoryId.'/'.$bankId)}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
            {{--            <a href={{URL::to("/admin/bankallocation/sub-dimension/".$dimensionId.'/'.$categoryId.'/'.$bankId)}} class="btn btn-large btn-success" style="font-size: 14px !important;">View Manage Bank Allocation Sub-Dimension</a>--}}
            <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Bank Allocation Sub-Dimension</a>
        </div>
    </div><!-- end container -->
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12"
             style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">
                <div class="form-group {{ $errors->has('dimension_id') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! Form::hidden('dimensionId',$dimensionId) !!}
                    {!! Form::hidden('categoryId',$categoryId) !!}
                    {!! Form::hidden('bankId',$bankId) !!}
                    {!! $errors->first('dimension_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('dimension_id','Dimension', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('dimension_id', $attributeDimension, $dimensionId, ['id' => 'dimension_id','class'
                    => 'form-control','disabled' => 'true']) !!}
                </div>
                <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                    {!! $errors->first('value','<span class="help-block">:message</span>') !!}
                    {!! Form::label('value','Value', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('value', $attributeValue, $chosenValue, ['id' => 'valueData','class' =>
                    'form-control']) !!}
                    {{--<select id="valueData" name="value" class="form-control">--}}
                    {{--@if(!isset($subDimensionData))--}}
                    {{--<option value="">Select Value</option>--}}
                    {{--@else--}}
                    {{--<option value="{{$subDimensionData->value}}">@if(isset($subDimensionData->value) && !empty($subDimensionData->value)) {{$subDimensionData->value}} @endif</option>--}}
                    {{--@endif--}}
                    {{--</select>--}}
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! $errors->first('status','<span class="help-block">:message</span>') !!}
                    {!! Form::label('status','Status', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('status', $attributeStatus, $chosenStatus, ['id' => 'status', 'class' =>
                    'form-control']) !!}
                </div>
                <div class="clearfix"></div>
                <div class="center-align"></div>
                <div class="row">
                    {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons
                    sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
                    <a href="{{URL::to("/admin/bankallocation/sub-dimension/".$dimensionId.'/'.$categoryId.'/'.$bankId)}}"
                       class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i
                                class="fa fa-sign-out"></i>Exit</a>
                </div>
                {{--<div class="form-group">--}}
                {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
                {{--</div>--}}
            </div>
        </div>
        <!-- end tab-content -->
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

            $('#dimension_id').select2({
                allowClear: true,
                placeholder: "Select Dimension"
            });

            $('#valueData').select2({
                allowClear: true,
                placeholder: "Select Value"
            });

        });

        {{--$('#dimension_id').change(function () {--}}
        {{--$.ajax({--}}
        {{--url: '/ajax/values',--}}
        {{--type: 'GET',--}}
        {{--data: {dimension_id: $('#dimension_id').val()},--}}
        {{--success: function (data) {--}}
        {{--//                    alert(data)--}}
        {{--//                    console.log(data)--}}
        {{--//                    $('#valueData').select2("val", ""); // clear the current elements in select box--}}
        {{--$('#valueData').empty(); // clear the current elements in select box--}}
        {{--$('#valueData').append("<option value=''>Select Value</option>");--}}
        {{--$.each(data, function (key, element) {--}}
        {{--$('#valueData').append("<option value='" + key + "'>" + element + "</option>");--}}
        {{--});--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}

        {{--@if(isset($subDimensionData))--}}
        {{--var selectedName = $('#valueData').find(":selected").val();--}}
        {{--$.ajax({--}}
        {{--url: '/ajax/values',--}}
        {{--type: 'GET',--}}
        {{--data: {dimension_id: $('#dimension_id').val()},--}}
        {{--success: function (data) {--}}
        {{--//                    alert(data)--}}
        {{--//                    console.log(data)--}}
        {{--$('#valueData').empty(); // clear the current elements in select box--}}
        {{--$('#valueData').append("<option value='"+selectedName+"'>"+selectedName+"</option>");--}}
        {{--$.each(data, function (key, element) {--}}
        {{--$('#valueData').append("<option value='" + key + "'>" + element + "</option>");--}}
        {{--});--}}
        {{--}--}}
        {{--});--}}
        {{--@endif--}}

        {{--@if (count($errors) > 0)--}}
        {{--var selectedName = $('#valueData').find(":selected").val();--}}
        {{--$.ajax({--}}
        {{--url: '/ajax/values',--}}
        {{--type: 'GET',--}}
        {{--data: {dimension_id: $('#dimension_id').val()},--}}
        {{--success: function (data) {--}}
        {{--//                    alert(data)--}}
        {{--//                    console.log(data)--}}
        {{--$('#valueData').empty(); // clear the current elements in select box--}}
        {{--@if(isset($subDimensionData))--}}
        {{--$('#valueData').append("<option value='"+selectedName+"'>"+selectedName+"</option>");--}}
        {{--@else--}}
        {{--$('#valueData').append("<option value=''>Select Value</option>");--}}
        {{--@endif--}}
        {{--$.each(data, function (key, element) {--}}
        {{--$('#valueData').append("<option value='" + key + "'>" + element + "</option>");--}}
        {{--});--}}
        {{--}--}}
        {{--});--}}
        {{--@endif--}}

    </script>
@endsection