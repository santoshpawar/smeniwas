@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Parameter Configuration<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
    <section class="content_style2">
    </section>
    <section style="margin-left: 50px;margin-right: 50px;">
        <div class="panel-body">
            <table id="industryTypeDataGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Industry Type</th>
                    <th>Dimension Measure</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($industryTypeData as $value)
                    <?php
                        $masterDataValue = App\Models\Common\ConfIndustryTypeSectorOutlookMapping::getMasterDataId($value->master_data_id);
                    $measureDataValue = App\Models\Common\ConfIndustryTypeSectorOutlookMapping::getMeasureId($value->sector_outlook_measure_id);
                    ?>
                    <tr>
                        <td>{!! $masterDataValue !!}</td>
                        <td>{!!$measureDataValue !!}</td>
                        <td><a href="{{URL::to('admin/parameterdata/edit-industry-type/' . $value->id)}}">Edit</a>
                            <a onclick="return deleteRecords($(this), 'industry type');") style="margin-left: 25px;" href="{{URL::to('/admin/parameterdata/delete-industry-type/' . $value->id)}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </section>
@stop

 
    <script type="text/javascript">
        $(document).ready(function () {
            $('#industryTypeDataGrid').dataTable({
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
            var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">Manage Industry Type Configuration</span>');
            var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/parameters/create-industry-type")}} style="margin-top:10px" title="Create" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');
            $(".col-sm-4").css(("width"),'initial');
            $(".DTTT_container").css("float","none").css(("margin-top"),10);
            $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);
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
