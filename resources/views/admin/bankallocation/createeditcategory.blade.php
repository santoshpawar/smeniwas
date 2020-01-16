@extends('app_header')

@section('content')
    <section class="content_style2">
    </section>
    {!! Form::model($bankCategoryData,['method' =>'POST','action' => $formaction] ) !!}

    <div class="container">
        <div class="btn-group leftside_tab" style="padding-bottom:10px;">
            <a href={{URL::to("/admin/bankallocation/category/".$bankId)}} class="btn btn-large btn-success" style="font-size: 14px !important;">Admin</a>
{{--            <a href={{URL::to("/admin/bankallocation/category/".$bankId)}} class="btn btn-large btn-success" style="font-size: 14px !important;">View Manage Bank Profile Category </a>--}}
            <a href="#" class="btn btn-large btn-success active" style="font-size: 14px !important;">Bank Allocation Category</a>
        </div>

    </div><!-- end container -->
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">
                <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
                    {!! Form::hidden('id',null) !!}
                    {!! Form::hidden('bankId',$bankId) !!}
                    {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                    {!! Form::label('name','Category Name', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::text('name',null,['class' => 'form-control',$setDisable]) !!}
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! $errors->first('description','<span class="help-block">:message</span>') !!}
                    {!! Form::label('description','Description', ['class' => '']) !!}
                    {!! Form::text('description',null,['class' => 'form-control']) !!}
                </div>
                <div class="form-group {{ $errors->has('sortorder') ? 'has-error' : '' }}">
                    {!! $errors->first('sortorder','<span class="help-block">:message</span>') !!}
                    {!! Form::label('sortorder','Sort Order', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
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
                    <a href="{{URL::to("/admin/bankallocation/category/".$bankId)}}" class="btn btn-success btn-cons sme_button" style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
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
        $(document).ready(function () {
            $('#status').select2({
                allowClear: true,
                placeholder: "Select Status"
            });
        });

    </script>
@endsection