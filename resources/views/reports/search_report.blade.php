@extends('app_header')
@section('content')
    <section class="content_style2">
    </section>

    <div class="container">
        <!-- Tab panes -->

        <div class="tab-content tab-design responsive col-xs-12 col-md-12 col-lg-12" style="margin-bottom: 10px;">
            <div role="tabpanel" class="tab-pane active">
                <div style="padding: 10px;">
                {!! Form::model(null,['method' =>'POST','action' => $formaction] ) !!}
                <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                    {!! $errors->first('user','<span class="help-block">:message</span>') !!}
                    {!! Form::label('user','Select SME', ['class' => '']) !!}
                    {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                    {!! Form::select('user[]', $users, null,['id' => 'user','class' => 'form-control','placeholder' => 'Select SME','required' => 'true','multiple' => 'multiple']) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-cons sme_button"><i class="fa fa-download"></i> Generate Report
                    </button>
                </div>
                {!! Form::close() !!}
                <!-- /.box-footer -->
            </div>
            </div>
        </div>
    </div><!-- end container -->
@endsection

@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#user').select2({
                allowClear: false,
                placeholder: "Select SME User"
            });
        });

    </script>
@endsection