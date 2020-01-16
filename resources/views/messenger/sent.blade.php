@extends('app_header')
@section('content')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
    <section class="content_style2">
    </section>
    <!-- Main content -->
    <div class="container-fluid" style="margin-left:20px;margin-right: 20px; ">
        <div class="col-md-3 sidebar">
            @include('messenger.master')
        </div>
                <div class="col-md-9">
                    {{--<a href="#" class="btn btn-danger" role="button" title="Delete Message"><span class="glyphicon glyphicon-trash"></span></a>--}}
                    <div class="center-align" ></div>
                    <div class="table-responsive mailbox-messages" >
                        <table class="table table-inbox table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>To</th>
                                <th>Message</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($sent->count() > 0)
                                @foreach($sent as $value)
                                    <?php $thread = App\Models\Messenger\Thread::where('id','=',$value->thread_id)->get()->first(); ?>
                                    <tr class="unread">
                                        <td class="inbox-small-cells">@if(isset($value->upload_file) && $value->upload_file != null)<i class="fa fa-paperclip"></i>@endif</td>
                                        <td class="view-message dont-show">
                                            @if(Auth::user()->isSME() ||Auth::user()->isCA())
                                                {!! $toSmeNiwas !!}
                                            @else
                                                <?php if($value->user_id != -1){
                                                        $sentUsername = \App\Models\User::find($value->user_id);
                                                ?>
                                                    {!! $sentUsername->username !!}
                                                <?php } else { ?>
                                                    {!! $toSmeNiwas !!}
                                                <?php } ?>
                                            @endif
                                        </td>
                                        <td class="view-message"><a href="{{URL::to('messaging/' . $value->id)}}">{!! $thread->subject !!}</a></td>
                                        <td class="view-message">{!! $value->created_at->diffForHumans() !!}</td>
                                        <td>
                                            <a onclick="return deleteRecords($(this), 'message');") href="{{URL::to('/messaging/delete-message/' . $value->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5" align="center">Sorry, no messages<td></tr>
                            @endif

                            </tbody>
                        </table><!-- /.table -->
                    </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
        <!-- /.mail-box-messages -->
        <!-- /.content -->
    </div>
    </div>
@stop

@section('footer')

    <script>
        $(function () {

            $(function () {
                $('#checkbox-toggle').click(function(event) {  //on click
                    if(this.checked) { // check select status
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = true;  //select all checkboxes with class "checkbox1"
                        });
                    }else{
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"
                        });
                    }
                });
            });

        });

        function deleteRecords(th, type) {
            if (type === undefined) type = 'record';
            doDelete = confirm("Are you sure you want to delete the selected " + type + " ?");
            if (!doDelete) {
                // If cancel is selected, do nothing
                return false;
            }
        }
    </script>
@endsection


