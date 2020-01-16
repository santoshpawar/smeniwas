@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title"> Financial Data<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
    <section class="content_style2">
    </section>
    {!! Form::model($financialDataGroup,['method' =>'POST','action' => $formaction] ) !!}

    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
            <a href={{URL::to("admin/financialdata")}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
            {{--<a href={{URL::to("/admin/financialdata")}} class="btn btn-large btn-info" style="font-size: 14px !important;">Manage Financial Data</a>--}}
            <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Manage Financial Data - Groups</a>
        </div>

        {{--<ul class="breadcrumbs">--}}
            {{--<li><a href={{URL::to("/admin")}}>Admin</a></li>--}}
            {{--<li><a href={{URL::to("/admin/financialdata")}}>Manage Financial Data</a></li>--}}
            {{--<li class="current">Edit Group</li>--}}
        {{--</ul><!-- end breadcrumbs -->--}}
    </div><!-- end container -->
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! $errors->first('type','<span class="help-block">:message</span>') !!}
                    {!! Form::label('type','Type', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    @if($isRatio)
                        {!! Form::text('type',null,['class' => 'form-control']) !!}
                    @else
                        {!! Form::label('type',$financialDataGroup->type, ['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                    {!! Form::label('name','Name', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    @if($isRatio)
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    @else
                        {!! Form::label('name',$financialDataGroup->name,['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! $errors->first('description','<span class="help-block">:message</span>') !!}
                    {!! Form::label('description','Description', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    @if($isRatio)
                        {!! Form::text('description',null,['class' => 'form-control']) !!}
                    @else
                        {!! Form::label('description',$financialDataGroup->description,['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group {{ $errors->has('sortorder') ? 'has-error' : '' }}">
                    {!! $errors->first('sortorder','<span class="help-block">:message</span>') !!}
                    {!! Form::label('sortorder','Sortorder', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    @if($isRatio)
                        {!! Form::text('sortorder',null,['class' => 'form-control']) !!}
                    @else
                        {!! Form::label('sortorder',$financialDataGroup->sortorder,['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    {!! $errors->first('status','<span class="help-block">:message</span>') !!}
                    {!! Form::label('status','Status', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    @if($isRatio)
                        {!! Form::select('status', $attributeStatus, $chosenStatus, ['id' => 'status', 'class' => 'form-control']) !!}
                    @else
                        {!! Form::label('status',$attributeStatus[$financialDataGroup->status], ['class' => 'form-control']) !!}
                    @endif
                </div>
                <div class="clearfix"></div>
                <div class="center-align" ></div>
                @if($isRatio)
                    <div class="row">
                        {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
                        <a href="{{URL::to("/admin/financialdata") }}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa fa-sign-out"></i> Exit</a>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
                    {{--</div>--}}
                @else
                    <div class="row">
                        <a href="{{URL::to("/admin/financialdata") }}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-reply"></i> Back</a>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<a href="{{URL::to("/admin/financialdata") }}" class="inputBtn btn">Back</a>--}}
                    {{--</div>--}}
                @endif
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
            $('#status').select2({
                allowClear: true,
                placeholder: "Select Status"
            });
        });

    </script>
@endsection