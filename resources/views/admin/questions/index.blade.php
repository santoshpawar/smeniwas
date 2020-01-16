<?php $user = Auth::user(); ?>
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
                <h4 class="title">Master Questions<span class="pull-right">Admin </span></h4>
                {{--  <p class="category">Apply new loan</p>   --}}
            </div>
            <section class="content_style2">
            </section>
            <section style="margin-left: 50px;margin-right: 50px;">
                <?php
                $resultsTemplate = 'admin.questions.grid.masterquestionresults';
                ?>
                <div class="panel-body">
                    <table id="questionsDataGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Question #</th>
                                <th>Question</th>
                                <th>Category</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($masterQuestions as $value)
                            <tr>
                                <td>{!! $value->questionnumber !!}</td>
                                <td><a href="{{URL::to('/admin/questions/configured-question/' . $value->id)}}">{!! $value->question_label !!}</a></td>
                                <td>{!! $value->category_label !!}</td>
                                <td>@if($value->status == 1)
                                    Active
                                    @else
                                    Inactive
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @stop
        {{--@extends('admin.gridlayout')--}}
        {{--@section('title', 'View Master Questions')--}}
        {{--@section('datasource',URL::to('/admin/questions/master-questions-grid'));--}}
        {{--@section('grid-headers')--}}
        {{--<thead>--}}
            {{--<tr>--}}
                {{--<th class="sortable col-md-1" data-sort="questionnumber">Question #</th>--}}
                {{--<th class="sortable col-md-4" data-sort="question_label">Question</th>--}}
                {{--<th class="sortable col-md-3" data-sort="category_label">Category</th>--}}
                {{--<th class="sortable col-md-1" data-sort="status">Status</th>--}}
            {{--</tr>--}}
        {{--</thead>--}}
        {{--@stop--}}
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#questionsDataGrid').dataTable({
                    "sDom": "<'navbar navbar-default'<'col-sm-12'<'col-sm-6'<'col-sm-8'<'#buttonLabel'>><'col-sm-4'T>><'col-sm-6'f>>>" +
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
                    "iDisplayLength": 10,
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
                var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">View Master Questions</span>');
                {{--var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/questions/master-questions-grid")}} title="Create" style="margin-top:10px" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');--}}
                $(".col-sm-8").css(("width"),'initial');
                $(".col-sm-4").css(("width"),'initial');
                $(".DTTT_container").css("float","none").css(("margin-top"),10);
                $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);
});
</script>
@endsection

