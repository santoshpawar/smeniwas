<?php $user = Auth::user(); ?>
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Liquidity Model<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
        <section class="content_style2">
        </section>

        <section style="margin-left: 50px;margin-right: 50px;">
            <?php
            $resultsTemplate = 'admin.liquiditymodel.categoriesresults';
            ?>

            <div class="panel-body">
                <table id="liquiditymodelGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Weight</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $value)
                        <tr>
                            <td><a href="{{URL::to('/admin/liquiditymodel/dimensions/' . $value->id)}}">{!! $value->label !!}</a></td>
                            <td>{!! $value->description !!}</td>
                            <td>{!! $value->weight !!}</td>
                            <td>@if($value->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td><a href="{{URL::to('/admin/liquiditymodel/edit-category/' . $value->id)}}">Edit</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @stop

    {{--@extends('admin.gridlayout')--}}

    {{--@section('title', 'Manage Liquidity Model - Categories')--}}
    {{--@section('datasource',URL::to('/admin/liquiditymodel/categories-grid'));--}}

    {{--@section('extra-actions-post-grid-download')--}}
    {{--<li class="primary">--}}
        {{--<a href={{URL::to("/admin/liquiditymodel/create-category")}} data-toggle="tooltip" data-original-title="Create">--}}
            {{--<i class="fa fa-plus"></i> <span class="visible-xs-inline">Create</span>--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--@stop--}}

    {{--@section('grid-headers')--}}
    {{--<thead>--}}
        {{--<tr>--}}
            {{--<th class="sortable col-md-1" data-sort="label">Category</th>--}}
            {{--<th class="sortable col-md-2" data-sort="description">Description</th>--}}
            {{--<th class="sortable col-md-2" data-sort="weight">Weight</th>--}}
            {{--<th class="sortable col-md-1" data-sort="status">Status</th>--}}
            {{--<th class="sortable col-md-1">Edit</th>--}}
        {{--</tr>--}}
    {{--</thead>--}}
    {{--@stop--}}

    <script type="text/javascript">
     jQuery(document).ready(function($){
        $('#liquiditymodelGrid').dataTable({
            "sDom": "<'navbar navbar-default'<'tableHeader'<'row'<'col-sm-12'<'col-sm-6'<'col-sm-4'<'#buttonLabel'>><'col-sm-4'<'#buttonPlaceholder'>><'col-sm-4'T>><'col-sm-6'f>>>>>" +
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
        var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">ManageLiquidity Model - Categories</span>');
        var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/liquiditymodel/create-category")}} style="margin-top:10px" title="Create New User" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');

        $(".col-sm-4").css(("width"),'initial');
        $(".DTTT_container").css("float","none").css(("margin-top"),10);
        $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);

});
</script>
@endsection