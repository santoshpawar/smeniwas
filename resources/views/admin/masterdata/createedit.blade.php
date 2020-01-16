 <?php $user = Auth::user(); ?>
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
                    <h4 class="title">Security Details <span class="pull-right">Admin </span></h4>
                    {{--  <p class="category">Apply new loan</p>   --}}
                </div>
                <div class="card-content">
                    <div id="divTab_sub">

                            <div class="panel-body">

                                {!! Form::model($masterData,['method' =>'POST','action' => $formaction] ) !!}

                             
                                    <div class="btn-group leftside_tab" style="padding-bottom:10px;">
                                        <a href="{{URL::to("/admin/masterdata")}}" class="btn btn-large btn-success btn-space" style="font-size: 14px !important;">Admin</a>
                                        <a href="#" class="btn btn-large btn-success btn-space active" style="font-size: 14px !important;">Manage Master Data</a>
                                    </div>
                                    {{--<ul class="breadcrumbs">--}}
                                        {{--<li><a href={{URL::to("/admin")}}>Admin</a></li>--}}
                                        {{--<li class="current">Manage Master Data</li>--}}
                                    {{--</ul><!-- end breadcrumbs -->--}}
                                
 
                                    <!-- Tab panes -->
                                    <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
                                        <div role="tabpanel" class="tab-pane active" id="registration">
                                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                {!! Form::hidden('id',null) !!}
                                                {!! $errors->first('type','<span class="help-block">:message</span>') !!}
                                                {!! Form::label('type','Type ', ['class' => '']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                {!! Form::text('type',null,['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                                                {!! Form::label('name','Name', ['class' => '']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                {!! Form::text('name',null,['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                                {!! $errors->first('value','<span class="help-block">:message</span>') !!}
                                                {!! Form::label('value','Value *', ['class' => '']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                {!! Form::text('value',null,['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group {{ $errors->has('sortorder') ? 'has-error' : '' }}">
                                                {!! $errors->first('sortorder','<span class="help-block">:message</span>') !!}
                                                {!! Form::label('sortorder','Sort Order', ['class' => '']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                {!! Form::text('sortorder',null,['class' => 'form-control']) !!}
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
                                                <a href="{{URL::to("/admin/masterdata")}}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
                                            </div>

                                            {{--<div class="form-group">--}}
                                                {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
                                            {{--</div>--}}
                                     
                                    </div><!-- end tab-content -->

                            

                                {!! Form::close() !!}
                                @endsection


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
