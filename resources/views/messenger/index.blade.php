
@extends('app_header')
@section('head-content')
<?php $user = Auth::user(); ?>
@section('content')
<div class="wrapper">
  @include('home.home_sidebar')
  <div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
      <div class="clearfix_responsive"></div>
      <div class="container-fluid">
        @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
        @endif
        <!-- Main content -->
        <div class="col-md-3 ">
          @include('messenger.master')
      </div>
      <div class="col-md-9 content">
          {{--<a href="#" class="deletebutton btn btn-danger" role="button" title="Delete Message"><span class="glyphicon glyphicon-trash"></span></a>--}}
          <div class="center-align" ></div>


          <div class="table-responsive mailbox-messages" >
             <table class="table table-inbox table-hover">
              <thead>
                <tr>
                  {{--<th>--}}
                      {{--<input id="checkbox-toggle" type="checkbox" />--}}
                  {{--</th>--}}
                  <th></th>
                  <th>From</th>
                  <th>Message</th>
                  <th>Time</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>

            @if($inbox->count() > 0)
            @foreach($inbox as $value)
            <?php $thread = App\Models\Messenger\Thread::where('id','=',$value->thread_id)->get()->first(); ?>
            <?php $sentUsername = \App\Models\User::find($value->from_user_id); ?>
            <?php $isDeletedMessage = explode(",", $value->to_user_delete); ?>
            @if (!in_array(Auth::user()->id, $isDeletedMessage))
            <tr class="unread">
                {{--<td class="inbox-small-cells">--}}
                    {{--<input type="checkbox" class="mail-checkbox" name="all[]">--}}
                {{--</td>--}}
                <td class="inbox-small-cells">@if(isset($value->upload_file) && $value->upload_file != null)<i class="fa fa-paperclip"></i>@endif</td>
                <td class="view-message  dont-show">
                    @if ($sentUsername->isAnalyst() || $sentUsername->isAdmin() || $sentUsername->isExecutive() || $sentUsername->isManagement())
                    {!! $toSmeNiwas !!}
                    @else
                    {!! $sentUsername->username !!}
                    @endif
                </td>
                <td class="view-message"><a href="{{URL::to('messaging/' . $value->id)}}">{!! $thread->subject !!}</a></td>
                <td class="view-message">{!! $value->created_at->diffForHumans() !!}</td>
                <td>
                    <a onclick="return deleteRecords($(this), 'message');") href="{{URL::to('/messaging/delete-message/' . $value->id)}}">Delete</a>
                </td>
            </tr>
            @endif
            @endforeach
            @else
            <tr><td colspan="5" align="center">Sorry, no messages<td></tr>      
                @endif

            </tbody>
        </table>
    </div>
</div>
<!-- /.mail-box-messages -->
</div>  <!-- /.content -->
</div>
@stop
</div>
</div>
</div>

<script>
    $(function () {

      {{--$(".deletebutton").click(function() {                --}}
      {{--var allVals = '';--}}
      {{--if ($('#input:checkbox').is(':checked')) {--}}
      {{--alert('test')--}}
      {{--$('#inbox-table :checked').each(function() {--}}
      {{--allVals = allVals + $(this).val() + ',';--}}
      {{--});--}}
      {{--alert(allVals)--}}
      {{--loadURL("{{ URL::to('backend/destroy/" + allVals + "') }}", $('#inbox-content > .table-wrap'));--}}
      {{--}--}}
      {{--else--}}
      {{--{--}}
      {{--return false;--}}
      {{--}--}}
      {{--});--}}

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

    function deleteRecords(th, type) {
      if (type === undefined) type = 'record';
      doDelete = confirm("Are you sure you want to delete the selected " + type + " ?");
      if (!doDelete) {
    // If cancel is selected, do nothing
    return false;
}
}

</script>
