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

        <div class="tab-content tab-design responsive col-xs-12 col-md-8 col-lg-12" style="padding:20px;margin-bottom: 20px;">
            <div role="tabpanel" class="tab-pane active" id="registration">

                <div class="mailbox-read-info">
                    <h3 style="margin-top: 0px;">{!! $thread->subject !!}</h3>
                    <h5>From:
                        @foreach($users as $user)
                            @if ($user->isAnalyst() || $user->isAdmin() || $user->isExecutive() || $user->isManagement())
                                {!! $toSmeNiwas !!}
                            @else
                                {!! $user->email !!}
                            @endif
                        @endforeach
                        <span class="mailbox-read-time pull-right">{!!date($msg->created_at)!!}</span></h5>
                    <hr>
                </div><!-- /.mailbox-read-info -->
                <div class="mailbox-read-message">
                    {!! Form::textarea('message', $msg->body, ['class' => 'form-control','style'=> 'height:300px;cursor:default','disabled' => 'true']) !!}
                </div><!-- /.mailbox-read-message -->

            </div><!-- /.box-body -->
            <hr>
            <div class="box-footer">
                @if(isset($fileDownloadUrl))
                        <a href='{{ $fileDownloadUrl }}' download="{{$msg->upload_file}}" class="btn btn-sm btn-default"><strong>Download File</strong></a>
                            {!! Form::label('', $msg->upload_file) !!}

                @endif
                    <div class="pull-right">
                        <a href="{{URL::to('messaging/reply/' . $msg->id)}}" class="btn btn-success btn-cons sme_button"><i class="fa fa-share"></i> Reply</a>
                    </div>
                {{--<button class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>--}}
            </div><!-- /.box-footer -->
        </div><!-- /. box -->
        </div>
    </div><!-- /.col -->
    </div><!-- /.row -->
@stop
