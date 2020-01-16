@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Parameter Configuration<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
    <section class="content_style2">
    </section>
    {!! Form::model($measureData,['method' =>'POST','action' => $formaction] ) !!}

    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
            <a href="{{URL::to("/admin/industrytype")}}" class="btn btn-large btn-success btn-space" style="font-size: 14px !important;">Admin</a>
            <a href="#" class="btn btn-large btn-success btn-space active" style="font-size: 14px !important;">Manage Industry Type</a>
        </div>
        {{--<ul class="breadcrumbs">--}}
        {{--<li><a href={{URL::to("/admin")}}>Admin</a></li>--}}
        {{--<li class="current">Manage Master Data</li>--}}
        {{--</ul><!-- end breadcrumbs -->--}}
    </div><!-- end container -->

    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">


                <div class="form-group {{ $errors->has('master_data_id') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! $errors->first('master_data_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('master_data_id','Industry Type', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('master_data_id',$industryType, $chosenIndustryType,['class' => 'form-control','id' => 'master_data_id']) !!}
                </div>

                <div class="form-group {{ $errors->has('sector_outlook_measure_id') ? 'has-error' : '' }}">
                    {!! $errors->first('sector_outlook_measure_id','<span class="help-block">:message</span>') !!}
                    {!! Form::label('sector_outlook_measure_id','Dimension Measure', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('sector_outlook_measure_id',$measuresList, $chosenSectorOutlookDimension,['class' => 'form-control','id' => 'sector_outlook_measure_id']) !!}
                </div>

                <div class="clearfix"></div>
                <div class="center-align" ></div>

                <div class="row">
                    {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
                    <a href="{{URL::to("/admin/industrytype") }}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa fa-sign-out"></i> Exit</a>
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
            $('#master_data_id').select2({
                allowClear: true,
                placeholder: "Select Industry Type"
            });

            $('#sector_outlook_measure_id').select2({
                allowClear: true,
                placeholder: "Select Dimension Measure"
            });


        });

    </script>
@endsection