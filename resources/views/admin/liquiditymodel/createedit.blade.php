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
  {!! Form::model($dimensionData,['method' =>'POST','action' => $formaction] ) !!}
  <div class="container">
    <div class="btn-group leftside_tab" style="padding-bottom:10px;">
      <a href={{URL::to("/admin/liquiditymodel/dimensions/$categoryId")}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
      {{--            <a href={{URL::to("/admin/liquiditymodel/dimensions/$categoryId")}} class="btn btn-large btn-info" style="font-size: 14px !important;">View Manage Liquidity Model - Dimensions</a>--}}
      <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Dimensions</a>
    </div>
    {{--<ul class="breadcrumbs">--}}
    {{--<li><a href={{URL::to("/admin")}}>Admin</a></li>--}}
    {{--<li><a href={{URL::to("/admin/liquiditymodel/dimensions/$categoryId")}}>Manage Liquidity Model</a></li>--}}
    {{--<li class="current">Dimensions</li>--}}
    {{--</ul><!-- end breadcrumbs -->--}}
  </div><!-- end container -->
  <div class="container">
    <!-- Tab panes -->
    <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
      <div role="tabpanel" class="tab-pane active" id="registration">
        <div class="form-group {{ $errors->has('parent_dimension_id') ? 'has-error' : '' }}">
          {!! $errors->first('label','<span class="help-block">:message</span>') !!}
          {!! Form::label('parent_dimension_id','Parent Dimension', ['class' => '']) !!}
          {!! Form::select('parent_dimension_id',$parentDimensionsList, NULL,['id'=>'parentDimension', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('ratio_id') ? 'has-error' : '' }}">
          {!! $errors->first('ratio_id','<span class="help-block">:message</span>') !!}
          {!! Form::label('ratio_id','Ratio', ['class' => '']) !!}
          {!! Form::select('ratio_id',$ratioList, NULL,['id'=>'ratio_id', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('dimension_type') ? 'has-error' : '' }}">
          {!! $errors->first('dimension_type','<span class="help-block">:message</span>') !!}
          {!! Form::label('dimension_type','Dimension Type', ['class' => '']) !!}
          {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
          {!! Form::select('dimension_type',$dimensionType, NULL,['id'=>'dimension_type', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
          {!! Form::hidden('id',null) !!}
          {!! Form::hidden('category_id',$categoryId) !!}
          {!! $errors->first('label','<span class="help-block">:message</span>') !!}
          {!! Form::label('label','Label', ['class' => '']) !!}
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
        <div class="form-group {{ $errors->has('is_applicable') ? 'has-error' : '' }}">
          {!! $errors->first('is_applicable','<span class="help-block">:message</span>') !!}
          {!! Form::label('is_applicable','Is Applicable', ['class' => '']) !!}
          {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
          {!! Form::select('is_applicable', $attributeIsApplicable, $chosenIsApplicable, ['id' => 'is_applicable', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('is_trend') ? 'has-error' : '' }}">
          {!! $errors->first('is_trend','<span class="help-block">:message</span>') !!}
          {!! Form::label('is_trend','Is Trend', ['class' => '']) !!}
          {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
          {!! Form::select('is_trend', $attributeIsApplicable, null, ['id' => 'is_trend', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
          {!! $errors->first('model','<span class="help-block">:message</span>') !!}
          {!! Form::label('model','Model', ['class' => '']) !!}
          {!! Form::select('model', $modelsList, null, ['id' => 'model', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('attribute') ? 'has-error' : '' }}">
          {!! $errors->first('attribute','<span class="help-block">:message</span>') !!}
          {!! Form::label('attribute','Attribute', ['class' => '']) !!}
          {!! Form::text('attribute',null,['class' => 'form-control']) !!}
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
          <a href="{{URL::to("/admin/liquiditymodel/dimensions/$categoryId")}}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
        </div>
        {{--<div class="form-group">--}}
        {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
        {{--</div>--}}
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
    $('#parentDimension').select2({
      allowClear: true,
      placeholder: "Select Parent Dimension"
    });
    $('#is_applicable').select2({
      allowClear: true,
      placeholder: "Please Select"
    });
    $('#is_trend').select2({
      allowClear: true,
      placeholder: "Please Select"
    });
    $('#model').select2({
      allowClear: true,
      placeholder: "Please Select Model"
    });
    $('#ratio_id').select2({
      allowClear: true,
      placeholder: "Select Ratio"
    });
    $('#dimension_type').select2({
      allowClear: true,
      placeholder: "Select Dimension"
    });
  });
</script>
@endsection
