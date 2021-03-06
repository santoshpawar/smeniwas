@extends('app_header')
@section('head-content')
@include('admin.sidebarMenu')
<div class="main-panel">
    @include('loans.dashboardNavbar')
    <div class="content">
     <div class="card">
                @include('errors')
        <div class="card-header" data-background-color="green">
            <h4 class="title">Bank Allocations<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
    <section class="content_style2">
    </section>
    <section style="margin-left: 50px;margin-right: 50px;">
        <div class="panel-body"><label>{!! $bankDetails->name !!}</label>
            <table id="dimensionDataGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dimensions as $value)
                    <?php $subDimensionsCount = App\Models\Loan\Bankallocation\BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();?>
                    <tr>
                        <td>
                            {{--@if(count($subDimensionsCount) > 0)--}}
                            @if($value->status == 1)
                                <a href="{{URL::to('admin/bankallocation/sub-dimension/' . $value->id . '/' . $categoryId . '/' . $bankId)}}">{!! $value->name !!}</a>
                                @else
                                {!! $value->name !!}
                            @endif
                        </td>
                        <td>{!! $value->description !!}</td>
                        <td>@if($value->status == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td><a href="{{URL::to('admin/bankallocation/edit-dimension/' . $value->id . '/' . $categoryId . '/' . $bankId)}}">Edit</a>
                            {{--<a onclick="return deleteRecords($(this), 'industry type');") style="margin-left: 25px;" href="{{URL::to('/admin/parameterdata/delete-industry-type/' . $value->id)}}">Delete</a>--}}
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
            $('#dimensionDataGrid').dataTable({
                "sDom": "<'navbar navbar-default'<'row'<'col-sm-12'<'col-sm-7'<'col-sm-3'<'#buttonLabel'>><'col-sm-3'T><'col-sm-3'<'#buttonPlaceholder'>><'col-sm-3'<'#buttonBack'>>><'col-sm-5'f>>>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12'<'col-sm-4'i><'col-sm-2'l>p>>",
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
            var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">Manage Bank Allocation Dimension</span>');
            var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/bankallocation/create-dimension/".$categoryId.'/'.$bankId)}} title="Create" style="margin-top:10px;" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');
            var buttonBack = $("#buttonBack").html('<a href={{URL::to("/admin/bankallocation/category/".$bankId)}} title="Create" style="margin-top:10px" class="btn btn-sm btn-primary">Back</a>');
            $(".col-sm-3").css(("width"),'initial');
            $(".DTTT_container").css("float","none").css(("margin-top"),10);
            $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);
        });
    </script>
@endsection
