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
            <h4 class="title">Bank Allocations<span class="pull-right">Admin </span></h4>
            {{--  <p class="category">Apply new loan</p>   --}}
        </div>
         
        <section style="margin-left: 50px;margin-right: 50px;">
            <div class="panel-body">
                <table id="bankProfileDataGrid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bankProfileData as $value)
                        <tr>
                            <td><a href="{{URL::to('admin/bankallocation/category/' . $value->id)}}">{!! $value->name !!}</a></td>
                            <td>{!! $value->description !!}</td>
                            <td>@if($value->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td><a href="{{URL::to('admin/bankallocation/edit/' . $value->id)}}" style="margin-right: 10px;">Edit</a>
                                <a href="#" titile="Copy Bank Profile" data-toggle="modal" data-target="#myModal" id='temp'>Copy Bank Profile</a>
                                {{--<a onclick="return deleteRecords($(this), 'industry type');") style="margin-left: 25px;" href="{{URL::to('/admin/parameterdata/delete-industry-type/' . $value->id)}}">Delete</a>--}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4>Copy Bank Profile</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::model(null,['method' =>'POST','action' => $formaction] ) !!}
                        <div class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
                            {!! Form::hidden('id',null) !!}
                            {!! $errors->first('bank_id','<span class="help-block">:message</span>') !!}
                            {!! Form::label('bank_id','Bank', ['class' => '']) !!}
                            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                            {!! Form::select('bank_id', $attributeBank, null, ['id' => 'bank_id', 'class' => 'form-control', 'style' => 'width: 50%' ]) !!}
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                            {!! Form::label('name','Bank Profile Name', ['class' => '']) !!}
                            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                            {!! Form::text('name',null,['class' => 'form-control','required' => 'true']) !!}
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            {!! $errors->first('description','<span class="help-block">:message</span>') !!}
                            {!! Form::label('description','Description', ['class' => '']) !!}
                            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
                            {!! Form::text('description',null,['class' => 'form-control','required' => 'true']) !!}
                        </div>
                        <div class="row">
                            {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
                            <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-top:20px;margin-left:20px;">Close</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
 


    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#bank_id').select2({
                allowClear: true,
                placeholder: "Select Bank"
            });
        });

    </script>
    <script type="text/javascript">
//        $(document).ready(function () {


    $('#bankProfileDataGrid').dataTable({
        "sDom": "<'navbar navbar-default'<'row'<'col-sm-12'<'col-sm-6'<'col-sm-4'<'#buttonLabel'>><'col-sm-4'T>><'col-sm-6'f>>>>" +
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
    var buttonLabel = $("#buttonLabel").html('<span class="navbar-brand">Manage Bank Profile Data</span>');
    {{--var buttonPlaceholder = $("#buttonPlaceholder").html('<a href={{URL::to("/admin/bankallocation/create")}} title="Create" style="margin-top:10px;" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>');--}}
    $(".col-sm-4").css(("width"),'initial');
    $(".DTTT_container").css("float","none").css(("margin-top"),10);
    $(".dataTables_filter").css(("margin-top"),10);
//            $(".dataTables_length").css(("margin-top"),5);
//        });
</script>
@endsection
