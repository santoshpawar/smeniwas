@extends('app_header')

@section('content')
    <section class="content_style2">
    </section>
    <!-- Main content -->
    <div class="container-fluid" style="margin-left:20px;margin-right: 20px; ">
        <div class="col-md-3 sidebar">
            @include('messenger.master')
        </div>
        <div class="col-md-9 content">
            <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12"
                 style="padding:20px;margin-bottom: 20px;">
                <div role="tabpanel" class="tab-pane active" id="registration">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background: #ccc;"><label>Reply To Query</label></div>
                            <br>
                            <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                {!! Form::open(['route' => ['messaging.update', $msg->id], 'method' => 'PUT','class' => 'form-horizontal','files'=>true,'enctype'=>'multipart/form-data']) !!}
                                <div class="box-body">
                                    <div class="form-group">
                                        {!! $errors->first('recipients','<span class="help-block">:message</span>') !!}
                                        <label class="col-sm-1 control-label">To</label>

                                        <div class="col-sm-10">
                                            {!! Form::hidden('recipients[]',$msg->from_user_id) !!}
                                            {{--{!! Form::select('recipients[]', $users,$msg->from_user_id,['id' =>'recipients','class' => 'form-control','disabled' => 'true']) !!}--}}
                                            {{--@if ($toUser->isAnalyst() || $toUser->isAdmin() || $toUser->isExecutive() || $toUser->isManagement())--}}
                                                {{--{!! Form::label('recipients',$toSmeNiwas, ['class'=>'form-control']) !!}--}}
                                            {{--@else--}}
                                                {!! Form::label('recipients',$toUserEmail, ['class'=>'form-control']) !!}
                                            {{--@endif--}}
                                        </div>
                                    </div>
                                    @if(isset($thread->loan_id))
                                        <div class="form-group">
                                            {!! $errors->first('loanId','<span class="help-block">:message</span>') !!}
                                            <label class="col-sm-1 control-label">Loan ID</label>

                                            <div class="col-sm-10">
                                                {!! Form::label('loanId',$thread->loan_id, ['class'=>'form-control'])
                                                !!}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {!! $errors->first('subject','<span class="help-block">:message</span>') !!}
                                        <label class="col-sm-1 control-label">Subject</label>

                                        <div class="col-sm-10">
                                            {!! Form::text('subject', $thread->subject, ['class' =>
                                            'form-control','required' => 'true','readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! $errors->first('message','<span class="help-block">:message</span>') !!}
                                        <label class="col-sm-1 control-label">Message</label>

                                        <div class="col-sm-10">
                                            {!! Form::textarea('message', $msg->body, ['class' => 'form-control','style'
                                            => 'height:
                                            300px','required' => 'true']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-1 control-label">Attachment</label>
                                        <div class="col-lg-4">
                                            {!! Form::file('upload_file', ['class' => 'form-control upload_file',
                                            'id'=>'upload_file','style'=>'padding-bottom:40px;']) !!}
                                        </div>
                                        <div class="col-sm-7 text-right">
                                            <button type="submit" class=" btn btn-success btn-cons sme_button" ><i class="fa fa-forwrd"></i>
                                                Send
                                            </button>
                                        </div>
                                    </div>
                                    {{--<div class="form-group">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-sm-12 text-right" style="padding-right: 130px;">--}}
                                                {{--<button type="submit" class=" btn btn-success btn-cons sme_button" ><i class="fa fa-forwrd"></i>--}}
                                                    {{--Send--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                            </div>
                            <!-- /.box-footer -->
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--{!! Form::submit('Send', ['class' => 'inputBtn btn']) !!}--}}

@stop

@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#recipients').select2({
                allowClear: true,
                placeholder: "To:"
            });
        });
    </script>
@endsection