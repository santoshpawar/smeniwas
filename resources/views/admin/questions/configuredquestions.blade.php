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
            <section style="margin-left: 50px;margin-right: 50px;">
             <?php
             $resultsTemplate = 'admin.questions.grid.configuredquestionresults';
             ?>
             <div class="panel-body">
                <table id="configuredquestionsDataGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Loan Type</th>
                            <th width="300">Status</th>
                            <th width="300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($configuredQuestion as $value)
                        <tr>
                            <td><a href="{{URL::to('/admin/questions/mappings/' . $value->id . '/' . $masterQuestionId)}}">{!! App\Helpers\FormatHelper::formatLoanType($value->loan_type) !!}</a></td>
                            <td width="300">@if($value->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td><a href="{{URL::to('/admin/questions/edit/' . $value->id. '/' . $masterQuestionId)}}">Edit</a>
                                <a onclick="return deleteRecords($(this), 'question');") style="margin-left: 25px;" href="{{URL::to('/admin/questions/delete/' . $value->id)}}">Delete</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    {{--@extends('admin.gridlayout')--}}

    {{--@section('title', 'View Configured Questions')--}}
    {{--@section('datasource',URL::to('/admin/questions/configured-questions-grid/'.$masterQuestionId));--}}

    {{--@section('grid-headers')--}}
    {{--<thead>--}}
        {{--<tr>--}}
            {{--<th class="sortable col-md-4" data-sort="loan_type">Loan Type</th>--}}
            {{--<th class="sortable col-md-1" data-sort="status">Status</th>--}}
        {{--</tr>--}}
    {{--</thead>--}}
    {{--@stop--}}


    <script type="text/javascript">
        $(document).ready(function () {
            $('#configuredquestionsDataGrid').dataTable({
                "sDom": "<'navbar navbar-default'<'col-sm-12'<'col-sm-6'<'col-sm-3'<'#buttonLabel'>><'col-sm-3'<'#buttonBack'>><'col-sm-3'<'#buttonPlaceholder'>><'col-sm-3'T>><'col-sm-6'f>>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12'<'col-sm-4'i><'col-sm-3'l>p>>",
                "oTableTools": {
                    "aButtons": [
                    {
                        "sExtends":    "collection",
                        "sButtonText": "Export <i class='fa fa-download'></i> ",
                        "aButtons":    [ "copy","print","csv", "xls", "pdf" ]

                    }
                    ],
                    "sSwfPath": "{{{URL::asset("/js_new/swf/copy_csv_xls_pdf.swf")}}}"
                },
                "iDisplayLength": 20,
                "oLanguage": {
                    "sLengthMenu": 'Per Page <select class="form-control input-sm">'+
                    '<option value="5">5</option>'+
                    '<option value="10">10</option>'+
                    '<option value="20">20</option>'+
                    '<option value="30">30</option>'+
                    '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '<option value="200">200</option>'+
                    '</select>'
                }
            });
            var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">View Configured Questions</span>');
            var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/questions/create/".$masterQuestionId)}} title="Create" style="margin-top:10px" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');
            var buttonBack = $("#buttonBack").html('<a href={{URL::to("/admin/questions")}} title="Create" style="margin-top:10px" class="btn btn-sm btn-primary">Back</a>');
            $(".col-sm-3").css(("width"),'initial');
            $(".col-sm-4").css(("width"),'initial');
            $(".DTTT_container").css("float","none").css(("margin-top"),10);
            $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);
});

        function deleteRecords(th, type) {
            if (type === undefined) type = 'record';
            doDelete = confirm("Are you sure you want to delete the selected " + type + "s ?");
            if (!doDelete) {
                // If cancel is selected, do nothing
                return false;
            }
        }
    </script>
    @endsection