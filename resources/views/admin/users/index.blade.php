<?php $user = Auth::user(); ?>
 
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
       <div class="card">
        @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Manage Users<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
        <div class="content">
            <section class="content_style2">
            </section>
            <section style="margin-left: 50px;margin-right: 50px;">
                <div class="panel-body">
                    <table id="userGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Firm Name</th>
                                <th>Email</th>
                                <th class="select-filter">Role</th>
                                <th  class="select-filter">Channel</th>
                                <th>Created At</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td><a href="{{URL::to('admin/users/edit/' . $user->id)}}">{!! $user->username !!}</a></td>
                                <td> 
                                    @if(count($user->getRefereedUserDetail)>0)
                                    @foreach($user->getRefereedUserDetail as $v)                          
                                    <?php print_r($v->name_of_firm); ?>
                                    @endforeach
                                    @else
                                    not mention 
                                    @endif   
                                </td>
                                <td>{!! $user->email !!}</td>
                                <td>
                                    @foreach($user->roles as $m)                          
                                    {!! $m->name !!}
                                    @endforeach
                                </td>
                                <td>                            
                                    @if(count($user->MobileAppDataDetail)>0)
                                    Mobile
                                    @else
                                    Web
                                    @endif                    
                                </td> 
                                <td>{!! date("M d,Y", strtotime($user->created_at))!!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    {{--@extends('admin.gridlayout')--}}
    {{--@section('title', 'Manage Users')--}}
    {{--@section('datasource',URL::to('/admin/users/grid'));--}}
    {{--@section('extra-actions-pre-grid-download')--}}
    {{--<li class="danger disabled">--}}
        {{--<a data-grid-bulk-action="delete" data-toggle="tooltip" data-target="modal-confirm" data-original-title="{{{ trans('action.bulk.delete') }}}">--}}
            {{--<i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{{ trans('action.bulk.delete') }}}</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--@stop--}}
    {{--@section('extra-actions-post-grid-download')--}}
    {{--<li class="primary">--}}
        {{--<a href={{URL::to("/admin/users/create")}} data-toggle="tooltip" data-original-title="Create">--}}
            {{--<i class="fa fa-plus"></i> <span class="visible-xs-inline">Create</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--@stop--}}
    {{--@section('grid-headers')--}}
    {{--<thead>--}}
        {{--<tr>--}}
            {{--<th><input data-grid-checkbox="all" type="checkbox"></th>--}}
            {{--<th class="sortable" data-sort="username">Name</th>--}}
            {{--<th class="sortable" data-sort="email">Email</th>--}}
            {{--<th class="sortable hidden-xs" data-sort="created_at">Created At</th>--}}
        {{--</tr>--}}
    {{--</thead>--}}
    {{--@stop--}}
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('#userGrid').dataTable({
                initComplete: function () {
                    this.api().columns('.select-filter').every(function () {
                        var column = this; 
                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                        .appendTo($("#userGrid_filter"))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                                );
                            column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                        });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                },
                "sDom": "<'navbar navbar-default'<'tableHeader'<'row'<'col-sm-12'<'col-sm-6'<'col-sm-4'<'#buttonLabel'>><'col-sm-4'T><'col-sm-4'<'#buttonPlaceholder'>>><'col-sm-6'f>>>>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12'<'col-sm-4'i><'col-sm-3'l>p>>",
                "oTableTools": {
                    "aButtons": [
                    {
                        "sExtends": "collection",
                        "sButtonText": "Export <i class='fa fa-download'></i> ",
                        "aButtons": ["copy", "print", "csv", "xls", "pdf"]
                    }
                    ],
                    "sSwfPath": "{{{URL::asset(" / js_new / swf / copy_csv_xls_pdf.swf")}}}"
                },
                "iDisplayLength": 10,
                "oLanguage": {
                    "sLengthMenu": 'Per Page <select class="form-control input-sm">' +
                    '<option value="5">5</option>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    '</select>'
                }
            });
            var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">Manage Users</span>');
            var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/users/create")}} style="margin-top:10px" title="Create New User" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');
            $(".col-sm-4").css(("width"), 'initial');
            $(".DTTT_container").css("float", "none").css(("margin-top"), 10);
            $(".dataTables_filter").css(("margin-top"), 10);
//            $(".dataTables_length").css(("margin-top"),5);
});
</script>
@endsection
