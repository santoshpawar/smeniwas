@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Liquidity Model<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
    <section class="content_style2">
    </section>
    {!! Form::model($categoryData,['method' =>'POST','action' => $formaction] ) !!}
    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
            {{--<a href={{URL::to("/admin/liquiditymodel")}} class="btn btn-large btn-success" style="font-size: 14px !important;">View Manage Liquidity Model - Categories</a>--}}
            <a href={{URL::to("/admin/liquiditymodel")}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
            <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Category</a>
        </div>
        {{--<ul class="breadcrumbs">--}}
            {{--<li><a href={{URL::to("/admin")}}>Admin</a></li>--}}
            {{--<li><a href={{URL::to("/admin/liquiditymodel")}}>Manage Liquidity Model</a></li>--}}
            {{--<li class="current">Category</li>--}}
        {{--</ul><!-- end breadcrumbs -->--}}
    </div><!-- end container -->
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">
                <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! $errors->first('label','<span class="help-block">:message</span>') !!}
                    {!! Form::label('label','Category', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('label',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! $errors->first('description','<span class="help-block">:message</span>') !!}
                    {!! Form::label('description','Description ', ['class' => '']) !!}
                    {!! Form::text('description',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                    {!! $errors->first('weight','<span class="help-block">:message</span>') !!}
                    {!! Form::label('weight','Weight', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('weight',null,['class' => 'form-control']) !!}
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
                    <a href="{{URL::to("/admin/liquiditymodel")}}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
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
       jQuery(document).ready(function($){
            $('#status').select2({
                allowClear: true,
                placeholder: "Select Status"
            });
        });

    </script>
@endsection