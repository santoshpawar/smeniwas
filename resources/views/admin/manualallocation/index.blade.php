<?php $user = Auth::user(); ?>
@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
       <div class="card">
        @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Manage Manual Bank Allocations<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
        <section class="content_style2">
           
            <section style="margin-left: 50px;margin-right: 50px;">
                <div class="panel-body">
                    <table id="bankMasterDataGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Loan Id</th>
                                <th>Bank Name</th>
                                <th>Allocation Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;?>
                            @foreach($allocatedLoans as $record)
                            <tr>
                                <td><a href="{{URL::to('loans/company-background/'.$record->type.'/'.$record->end_use.'/'.$record->loan_amount.'/'.$record->loan_tenure.'/'. $record->id.'/')}}">{!! $record->id !!}</a></td>
                                <td>{!! $record->bank_name !!}</td>
                                <td>@if($record->allocation_type == 1)
                                    Automated
                                    @else
                                    Manual
                                    @endif
                                </td>
                                <td><a href = "{{URL::to('admin/manualallocation/delete/' . $record->bank_allocation_id)}}">Delete Allocation</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('#bankMasterDataGrid').dataTable({
                    "sDom": "<'navbar navbar-default'<'row'<'col-sm-12'<'col-sm-6'<'col-sm-4'<'#buttonLabel'>><'col-sm-4'T><'col-sm-4'<'#buttonPlaceholder'>>><'col-sm-6'f>>>>" +
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
                var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">Manage Manual Bank Allocations</span>');
                var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/manualallocation/create")}} title="Create" style="margin-top:10px;" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');
                $(".col-sm-4").css(("width"),'initial');
                $(".DTTT_container").css("float","none").css(("margin-top"),10);
                $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);
});
</script>
@endsection
