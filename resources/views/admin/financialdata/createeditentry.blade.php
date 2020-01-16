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

    {!! Form::model($financialDataEntry,['method' =>'POST','action' => $formaction] ) !!}

    <div class="container">
      <div class="btn-group leftside_tab" style="padding-bottom:10px;">
        <a href={{URL::to("/admin/financialdata/entries/$groupId")}} class="btn btn-large btn-success btn-space" style="font-size: 14px !important;">Admin</a>
        {{--            <a href={{URL::to("/admin/financialdata/entries/$groupId")}} class="btn btn-large btn-success btn-space active" style="font-size: 14px !important; ">Manage Financial Data</a>--}}
        <a href="#" class="btn btn-large btn-success btn-space active" style="font-size: 14px !important;">Manage Financial Data - Entry</a>
      </div>

      {{--<ul class="breadcrumbs">--}}
        {{--<li><a href={{URL::to("/admin")}}>Admin</a></li>--}}
        {{--<li><a href={{URL::to("/admin/financialdata/entries/$groupId")}}>Manage Financial Data</a></li>--}}
        {{--<li class="current">Edit Entry</li>--}}
      {{--</ul><!-- end breadcrumbs -->--}}
    </div><!-- end container -->
    <div class="container">
      <!-- Tab panes -->
      <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
        <div role="tabpanel" class="tab-pane active" id="registration">
          <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
            {!! Form::hidden('isRatio', $isRatio) !!}
            {!! $errors->first('group_id','<span class="help-block">:message</span>') !!}
            {!! Form::label('group_id','Financial Group Type', ['class' => '']) !!}
            {!! Form::select('group_id',$groupTypeList, $groupId,['id'=>'grouptype', 'class' => 'form-control']) !!}
          </div>
          <div class="form-group {{ $errors->has('entry') ? 'has-error' : '' }}">
            {!! Form::hidden('id',null) !!}
            {{--{!! Form::hidden('group_id',null) !!}--}}
            {!! $errors->first('entry','<span class="help-block">:message</span>') !!}
            {!! Form::label('entry','Entry', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::text('entry',null,['class' => 'form-control']) !!}
            {{--{!! Form::label('entry',$financialDataEntry->entry, ['class' => 'form-control']) !!}--}}
          </div>
          <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            {!! $errors->first('description','<span class="help-block">:message</span>') !!}
            {!! Form::label('description','Description ', ['class' => '']) !!}
            {!! Form::text('description',null,['class' => 'form-control']) !!}
            {{--{!! Form::label('entry',$financialDataEntry->description, ['class' => 'form-control']) !!}--}}                    
          </div>
          <div class="form-group {{ $errors->has('calculation_method') ? 'has-error' : '' }}">
            {!! $errors->first('calculation_method','<span class="help-block">:message</span>') !!}
            {!! Form::label('calculation_method','Calculation Method', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::select('calculation_method', ['' => '', 'Manual' => 'Manual', 'Calculated' => 'Calculated'], null, ['id' => 'calculation_method', 'class' => 'form-control']) !!}
            {{--{!! Form::hidden('calculation_method','Calculated') !!}--}}
            {{--{!! Form::label('calculation_method',$financialDataEntry->calculation_method, ['class' => 'form-control']) !!}--}}
          </div>
          <div class="form-group {{ $errors->has('formula_reference') ? 'has-error' : '' }}">
            {!! $errors->first('formula_reference','<span class="help-block">:message</span>') !!}
            {!! Form::label('formula_reference','Formula Reference', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::text('formula_reference',null,['class' => 'form-control']) !!}
            {{--{!! Form::label('formula_reference',$financialDataEntry->formula_reference, ['class' => 'form-control']) !!}--}}
          </div>
          <div id="divFormula" class="form-group {{ $errors->has('formula') ? 'has-error' : '' }}">
            {!! $errors->first('formula','<span class="help-block">:message</span>') !!}
            {!! Form::label('formula','Formula ', ['class' => '']) !!}
            {!! Form::text('formula',null,['class' => 'form-control']) !!}
          </div>               
          <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
            {!! $errors->first('model','<span class="help-block">:message</span>') !!}
            {!! Form::label('model','Model', ['class' => '']) !!}
            {!! Form::hidden('model', null) !!}
            {!! Form::text('model', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group {{ $errors->has('attribute') ? 'has-error' : '' }}">
            {!! $errors->first('attribute','<span class="help-block">:message</span>') !!}
            {!! Form::label('attribute','Attribute', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::text('attribute',null,['class' => 'form-control']) !!}
            {{--{!! Form::label('attribute',$financialDataEntry->attribute, ['class' => 'form-control']) !!}--}}
          </div>
          @if($isRatio)
          <div class="form-group {{ $errors->has('percentage') ? 'has-error' : '' }}">
           {!! $errors->first('percentage','<span class="help-block">:message</span>') !!}
           {!! Form::label('percentage','Percentage *', ['class' => '']) !!}
           @if($isRatio)
           {!! Form::select('percentage', $attributePercentage, $chosenPercentage, ['id' => 'percentage', 'class' => 'form-control']) !!}
           @else
           {!! Form::label('percentage',$attributePercentage[$financialDataEntry->percentage], ['class' => 'form-control']) !!}
           @endif
         </div>
         <div class="form-group {{ $errors->has('threshold_condition') ? 'has-error' : '' }}">
           {!! $errors->first('threshold_condition','<span class="help-block">:message</span>') !!}
           {!! Form::label('threshold_condition','Threshold Condition *', ['class' => '']) !!}
           @if($isRatio)
           {!! Form::select('threshold_condition', $attributeThresholdCondition, $chosenThresholdCondition, ['id' => 'threshold_condition', 'class' => 'form-control']) !!}
           @else
           {!! Form::label('threshold_condition',$financialDataEntry->threshold_condition, ['class' => 'form-control']) !!}
           @endif
         </div>
         <div class="form-group {{ $errors->has('threshold') ? 'has-error' : '' }}">
           {!! $errors->first('threshold','<span class="help-block">:message</span>') !!}
           {!! Form::label('threshold','Threshold', ['class' => '']) !!}
           {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
           @if($isRatio)
           {!! Form::text('threshold',null,['class' => 'form-control']) !!}
           @else
           {!! Form::label('threshold',$financialDataEntry->threshold, ['class' => 'form-control']) !!}
           @endif
         </div>
         @endif
         <div class="form-group {{ $errors->has('sortorder') ? 'has-error' : '' }}">
          {!! $errors->first('sortorder','<span class="help-block">:message</span>') !!}
          {!! Form::label('sortorder','Sortorder', ['class' => '']) !!}
          {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
          {!! Form::text('sortorder',null,['class' => 'form-control']) !!}
          {{--{!! Form::label('sortorder',$financialDataEntry->sortorder, ['class' => 'form-control']) !!}--}}
        </div>
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
          {!! $errors->first('status','<span class="help-block">:message</span>') !!}
          {!! Form::label('status','Status', ['class' => '']) !!}
          {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
          {!! Form::select('status', $attributeStatus, $chosenStatus, ['id' => 'status', 'class' => 'form-control']) !!}
          {{--{!! Form::label('status',$attributeStatus[$financialDataEntry->status], ['class' => 'form-control']) !!}--}}
        </div>
        
        <div class="row">
          <a href="{{URL::to("/admin/financialdata/entries/$groupId") }}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-reply"></i> Back</a>
          {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
          <a href="{{URL::to("/admin/financialdata/entries/$groupId") }}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa fa-sign-out"></i> Exit</a>
        </div>

        {{--<div class="form-group">--}}
         {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
       {{--</div>--}}
       
       {{--<div class="row">--}}
        
       {{--</div>--}}

       {{--<div class="form-group">--}}
         {{--<a href="{{URL::to("/admin/financialdata/entries/$groupId") }}" class="inputBtn btn">Back</a>--}}
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
  $(document).ready(function () {
    $('#status').select2({
     allowClear: true,
     placeholder: "Select Status"
   });

    $('#percentage').select2({
     allowClear: true,
     placeholder: "Select Percentage"
   });

    $('#threshold_condition').select2({
     allowClear: true,
     placeholder: "Select Threshold Condition"
   });


    $('#grouptype').select2({
     allowClear: true,
     placeholder: "Select Financial Group Type"
   });

    $('#calculation_method').select2({
     allowClear: true,
     placeholder: "Select Calculation Method"
   });

    $('#calculation_method').change(function () {

      if ($(this).val() == 'Calculated') {
        $('#divFormula').show();
      } else {
        $('#divFormula').hide();
      }   
    });

    if ($('#calculation_method option:selected').val() == "Calculated") {
      $('#divFormula').show();
    } else {
      $('#divFormula').hide();
    }
  });

</script>
@endsection