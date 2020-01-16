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
                            <div class="panel-heading" style="background: #ccc;"><label>Compose New Query</label></div>
                            <br>
                            <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                {!! Form::open(['route' => 'messages.store','class' =>
                                'form-horizontal','files'=>true,'enctype'=>'multipart/form-data']) !!}
                                <div class="form-group {{ $errors->has('recipients') ? 'has-error' : '' }}">
                                    {!! $errors->first('recipients','<span class="help-block">:message</span>') !!}
                                    <label class="col-lg-1 control-label">To</label>
                                    @if(Auth::user()->isBankUser())
                                        {!! Form::hidden('recipients[]',null) !!}
                                        <div class="col-lg-10">
                                            {!! Form::select('loanId', $users, null,['id' => 'recipients','class'=> 'form-control','required' => 'true']) !!}
                                        </div>
                                    @elseif(Auth::user()->isSME() ||Auth::user()->isCA())
                                        {!! Form::hidden('recipients[]',null) !!}
                                        <div class="col-lg-10">
                                            {!! Form::label('recipients', $toSmeNiwas , ['class' => 'form-control']) !!}
                                        </div>
                                    @else
                                        <div class="col-lg-10">
                                            <select id="recipients" name="recipients[]" class="form-control" multiple="true">
                                                <option value=""></option>
                                                @if(isset($users) && count($users) > 0)
                                                    @foreach($users as $value)
                                                        <option value="{{$value['id']}}">{{$value['email']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            {{--{!! Form::select('recipients[]', $users, null,['id' => 'recipients','class'--}}
                                            {{--=> 'form-control','required' => 'true','multiple' => 'multiple']) !!}--}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! $errors->first('subject','<span class="help-block">:message</span>') !!}
                                    <label class="col-lg-1 control-label">Subject</label>

                                    <div class="col-lg-10">
                                        {!! Form::text('subject', null, ['class' => 'form-control','required' =>
                                        'true']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! $errors->first('message','<span class="help-block">:message</span>') !!}
                                    <label class="col-lg-1 control-label">Message</label>

                                    <div class="col-lg-10">
                                        {!! Form::textarea('message', null, ['class' => 'form-control','style'
                                        =>'height:200px;','required' => 'true']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-1 control-label">Attachment</label>

                                    <div class="col-lg-4">
                                        {!! Form::file('upload_file', ['class' => 'form-control upload_file',
                                        'id'=>'upload_file','style'=>'padding-bottom:40px;']) !!}
                                    </div>

                                    <div class="col-sm-7 text-right">
                                        <button type="submit" class=" btn btn-success btn-cons sme_button"><i
                                                    class="fa fa-forwrd"></i>
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
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
                placeholder: "Select Recipient"
            });
        });
    </script>
@endsection