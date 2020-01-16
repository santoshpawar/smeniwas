@extends('app_header')
@section('content')

<?php
    $formaction = 'Register\CAUserProfileController@postSmeClient';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="container-fluid main-container">
                <div class="col-md-12 col-lg-12">
                    <div class="tab-pane active" id="CompanyBackground" >
                        <div class="row">
                            {!! Form::model($userProfile,['method' =>'POST','action' => $formaction] ) !!}
                            {!! Form::hidden('id',null) !!}
                            {!! Form::hidden('password','ada1212@#$') !!}

                            <div class="col-md-9 col-lg-9" style="width: 100%;">
                                <div class="container collapse in" id="ownertab" style="max-width: 100%;   margin-bottom: -25px;">
                                    <div role="tabpanel">
                                        <div id="divTC-Div1">
                                            <div class="row" style="margin-top: 5%;">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading" style="background-color: #ccc;">
                                                        <label>Registration Wizard - SME Client / Owner</label></div><br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('name_of_firm','Name of Firm', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    @if(isset($userProfile))
                                                                        {!! Form::text('name_of_firm',null,['class' => 'form-control']) !!}
                                                                    @else
                                                                        {!! Form::text('name_of_firm',null,['class' => 'form-control']) !!}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('owner_entity_type','Type of Legal Entity', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::select('owner_entity_type',$entityTypes,$chosenEntity, ['id' => 'owner_entity_type','class' => 'form-control', 'style' => ' width: 100%;']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('owner_name','Name of Owner/Director', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('owner_name',null,['class' => 'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('firm_pan','PAN  No of Firm', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('firm_pan',null,['class' => 'form-control', 'maxlength' => 10]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('owner_email','Promoters Email id ', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('owner_email',null,['class' => 'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('address','Address', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::textarea('address',isset($address)? $address:null,array('class' => 'form-control','placeholder' => 'Address', 'size' => '40x2')) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                {!! Form::label('contact_numbers','Contact Numbers', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    <div class="col-md-6">
                                                                        {!! Form::text('contact1',null,['class' => 'form-control amount','placeholder' => 'No. 1', 'style' => 'margin-left: -15px;width: 130%;', 'maxlength' => 10]) !!}
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        {!! Form::text('contact2',null,['class' => 'form-control amount','placeholder' => 'No. 2', 'style' => 'width: 130%;', 'maxlength' => 10]) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                {!! Form::label('owner_city','City', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::select('owner_city',$cities,$chosenCity,['id' => 'owner_city', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group collapse" id="custom_cityName">
                                                                {!! Form::label('city_other', 'City Name', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                {!! Form::text('city_other', null, ['id'=>'custom_cityNamebox','class' => 'form-control', 'placeholder' => 'Enter City'])!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                {!! Form::label('owner_state','State', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::select('owner_state',$states,$chosenState,['id' => 'owner_state', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                {!! Form::label('pincode','Pincode', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('pincode',null,['class' => 'form-control amount', 'maxlength' => 6]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('latest_turnover','Latest Audited Turnover', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('latest_turnover',null,['class' => 'form-control amount', 'placeholder' => '(Rs In Lacs)']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('purpose_of_loan','Purpose Of Loan', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::select('owner_purpose_of_loan',$purpose_of_loan, $chosenPurposeOfLoan, ['id' => 'owner_purpose_of_loan', 'class' => 'form-control', 'style' => 'width:100%;']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                {!! Form::label('required_amount','Required Amount ', ['class'=>'col-md-12 control-label']) !!}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('required_amount',null,['class' => 'form-control amount', 'placeholder' => '(Rs In Lacs)']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="row" style="margin-bottom: -5px;">
                                                        <div class="col-md-12" style="margin-left:20px;   margin-bottom: 15px; margin-top: 5px;">
                                                            {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'btn btn-success btn-cons sme_button','onclick' => 'location.href="../../home"')) !!}
                                                            <input data-toggle="modal" class="btn btn-success btn-cons sme_button" name="proceedNext" type="submit" value="Save" id="Save" style="margin-right: 10px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sme.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>


    <script type="text/javascript">

        $('#owner_entity_type').select2({
            allowClear: true,
            placeholder: "Select Entity Type"
        });
        $('#owner_city').select2({
            allowClear: true,
            placeholder: "Select City"
        });
        $('#owner_state').select2({
            allowClear: true,
            placeholder: "Select State"
        });
        $('#owner_entity_type_sme').select2({
            allowClear: true,
            placeholder: "Select Entity Type"
        });
        $('#owner_state_sme').select2({
            allowClear: true,
            placeholder: "Select State"
        });
        $('#owner_purpose_of_loan').select2({
            allowClear: true,
            placeholder: "Select Purpose Of Loan"
        });
        $('#owner_purpose_of_loan_sme').select2({
            allowClear: true,
            placeholder: "Select Purpose Of Loan"
        });
        $('#sme_client').select2({
            allowClear: true,
            placeholder: "Select Option"
        });
        $('#end_use').select2({
            allowClear: true,
            placeholder: "Select End Use"
        });

        $("#owner_city").change(function () {
        if(($("#owner_city").val() == 'Other')){
            $('#custom_cityName').collapse("show");
        }else{
            $('#custom_cityName').collapse("hide");
        }
        });

        @if (count($errors) > 0)
                if(($("#owner_city").val() == 'Other')) {
                    $('#custom_cityName').collapse("show");
                }
        @endif


        $(document).ready(function(){
            //called when key is pressed in textbox
            $(".amount").keypress(function(e){
                if ((e.which != 8 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57))
                {
                    //display error message
                    $(this).css("border", "1px solid red");
                    return false;
                }
                else
                {
                    $(this).css("border", "");
                    var points = 0;
                    var ws_text = $(this).val().split('.');
                    points = ws_text[1];
                    points = points.length;
                    if (points >= 1)
                    {
                        $(this).css("border", "1px solid red");
                        alert("One decimal places only allowed");
                        $(this).css("border", "");
                        return false;
                    }
                    $(this).css("border", "");
                }
            });
        });

    </script>
@endsection