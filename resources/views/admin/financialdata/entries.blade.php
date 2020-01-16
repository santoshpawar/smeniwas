<?php
$resultsTemplate = 'admin.financialdata.entriesresults';
?>

@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
       <div class="card">
        @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title"> Financial Data<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
        {{--@extends('admin.gridlayout')--}}

        {{--@section('title', 'Manage Financial Data Model - Entries')--}}
        {{--@section('datasource',URL::to('/admin/financialdata/entries-grid/'.$groupId));--}}

        {{--@section('extra-actions-post-grid-download')--}}
        {{--<li class="primary">--}}
            {{--<a href={{URL::to("/admin/financialdata/create-entry/$groupId")}} data-toggle="tooltip" data-original-title="Create">--}}
                {{--<i class="fa fa-plus"></i> <span class="visible-xs-inline">Create</span>--}}
            {{--</a>--}}
        {{--</li>--}}
        {{--@stop--}}

        {{--@section('grid-headers')--}}
        {{--<thead>--}}
            {{--<tr>--}}
                {{--<th class="sortable col-md-1" data-sort="label">Entry</th>--}}
                {{--<th class="sortable col-md-2" data-sort="description">Description</th>--}}
                {{--<th class="sortable col-md-2" data-sort="weight">Calculation Method</th>--}}
                {{--<th class="sortable col-md-1" data-sort="label">Model</th>--}}
                {{--<th class="sortable col-md-2" data-sort="description">Attribute</th>--}}
                {{--<th class="sortable col-md-1" data-sort="label">Sortorder</th>--}}
                {{--<th class="sortable col-md-1" data-sort="status">Status</th>--}}
            {{--</tr>--}}
        {{--</thead>--}}
        {{--@stop--}}

        
        <section class="content_style2">
        </section>
        <section style="margin-left: 50px;margin-right: 50px;">
            <div class="panel-body">
                <table id="financialEntryDataGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Entry</th>
                            <th>Description</th>
                            <th>Calculation Method</th>
                            <th>Formula Reference</th>
                            <th>Model</th>
                            <th>Attribute</th>
                            <th>Sortorder</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $value)
                        <tr>
                            <td><a href="{{URL::to('/admin/financialdata/edit-entry/' . $value->id)}}">{!! $value->entry !!}</a></td>
                            <td>{!! $value->description !!}</td>
                            <td>{!! $value->calculation_method !!}</td>
                            <td>{!! $value->formula_reference !!}</td>
                            <td>{!! $value->model !!}</td>
                            <td>{!! $value->attribute !!}</td>
                            <td>{!! $value->sortorder !!}</td>
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
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#financialEntryDataGrid').dataTable({
                "sDom": "<'navbar navbar-default'<'col-sm-12'<'col-sm-6'<'col-sm-4'<'#buttonLabel'>><'col-sm-4'T><'col-sm-4'<'#buttonPlaceholder'>>><'col-sm-6'f>>>" +
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
                "iDisplayLength": 5,
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
            var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">Manage Financial Data Model - Entries</span>');
            var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/financialdata/create-entry/$groupId")}} title="Create" style="margin-top:10px;" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');
            $(".col-sm-4").css(("width"),'initial');
            $(".DTTT_container").css("float","none").css(("margin-top"),10);
            $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);
});
</script>
@endsection