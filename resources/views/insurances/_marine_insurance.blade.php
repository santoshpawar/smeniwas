<?php 
    $setDisable = '';
    $comYourSalestype = '';
    $existingCompanyDeailsCount = '';
    $maxCompanyDetails = '';
    $removeMandatory = '';
?>
<div class="col-md-10">
    <div class="tab-content tab-design">
        <div class="tab-pane active" id="CompanyBackground" style="">
            <div class="col-lg-12" style="padding-top: 15px;">
                <div class="col-md-4">
                    <label class="radio-inline" style="padding-bottom: 15px;">
                        {!! Form::radio('transit_type', '1',false , ['id' => 'inland','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                        <strong>Inland Transit</strong>
                    </label>
                </div>
                <div class="col-md-4">
                    <label class="radio-inline" style="padding-bottom: 15px;">
                        {!! Form::radio('transit_type', '2',false , ['id' => 'importExport','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                        <strong>Export/Import Transit</strong>
                    </label>
                </div>
                <div class="col-md-4">
                    <label class="radio-inline" style="padding-bottom: 15px;">
                        {!! Form::radio('transit_type', '3k',false , ['id' => 'shipVessel','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                        <strong>Ship or Vessel Insurance</strong>
                    </label>    
                </div>
            </div>
            
            <div id="inlandTransit">
                 <div class="col-md-6" style="padding-bottom: 15px;">
                    {!! Form::label('inland_conveyance','Mode of Inland Conveyance') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('inland_conveyance', $inlandTypes, null, array('class' => 'form-control', 'id'=>'inlandConveyance', 'placeholder'=>'Net Book Value of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                 </div>
                 <div class="col-md-6" style="padding-bottom: 15px;">
                    {!! Form::label('type_of_cargo','Type of Cargo') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('ie_type_of_cargo', $cargoTypes, null, array('class' => 'form-control', 'id'=>'cargoType', 'placeholder'=>'Net Book Value of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                 </div>
                 <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('expected_time','Expected Transit Time in Days') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('ie_expected_time', null, array('class' => 'form-control', 'id'=>'expectedTime', 'placeholder'=>'Expected Transit Time in Days','data-mandatory'=>'M' ,$setDisable)) !!}   
                 </div>
                 <div class="col-md-4">
                    {!! Form::label('value_of_cargo','Value of Cargo ( ') !!}
                    {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                    {!! Form::label(null,' In Lacs )') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('ie_value_of_cargo', null, array('class' => 'form-control', 'id'=>'cargoVal', 'placeholder'=>'Value of Cargo','data-mandatory'=>'M' ,$setDisable)) !!}
                </div>
                <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('type_of_risk_cover','Type of Risk Cover') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('ie_type_of_risk_cover', $riskTypes, null, array('class' => 'form-control', 'id'=>'riskType', 'placeholder'=>'Net Book Value of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                 </div>                    
            </div>
            
            <div id="importExportTansit">
                 <div class="col-md-6" style="padding-bottom: 15px;">
                    {!! Form::label('ie_type_of_cargo','Type of Cargo') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('ie_type_of_cargo', $cargoTypes, null, array('class' => 'form-control', 'id'=>'ieCargoType', 'placeholder'=>'Net Book Value of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                 </div>
                 <div class="clearfix"></div>
                 <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('ie_expected_time','Expected Transit Time in Days') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('ie_expected_time', null, array('class' => 'form-control', 'id'=>'ieExpectedTime', 'placeholder'=>'Expected Transit Time in Days','data-mandatory'=>'M' ,$setDisable)) !!}   
                 </div>
                 <div class="col-md-4">
                    {!! Form::label('ie_value_of_cargo','Value of Cargo per shipment ( ') !!}
                    {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                    {!! Form::label(null,' In Lacs )') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('ie_value_of_cargo', null, array('class' => 'form-control', 'id'=>'ieCargoVal', 'placeholder'=>'Value of Cargo','data-mandatory'=>'M' ,$setDisable)) !!}
                </div>
                <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('ie_type_of_risk_cover','Type of Risk Cover') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('ie_type_of_risk_cover', $riskTypes, null, array('class' => 'form-control', 'id'=>'ieRiskType', 'placeholder'=>'Net Book Value of Plant','data-mandatory'=>'M' ,$setDisable)) !!}
                 </div>                    
            </div>
            
            <div id="shipVesselTansit">
                 <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('date_of_manf','Date of Manufacture') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    <div class='input-group date' id='datetimepicker8'>
                        {!! Form::text('date_of_manf', null, array('class' => 'form-control input-group date', 'id'=>'dateOfManufacture', 'placeholder'=>'Date of Manufacture','data-mandatory'=>'M' ,$setDisable)) !!}
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                        </span>
                    </div>
                 </div>
                 <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('tonnage','Tonnage') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('tonnage', null, array('class' => 'form-control', 'id'=>'tonnage', 'placeholder'=>'Tonnage','data-mandatory'=>'M' ,$setDisable)) !!}   
                 </div>
                 <div class="col-md-4">
                    {!! Form::label('type_of_cargo_handled','Type of Cargo Handled') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('type_of_cargo_handled', null, array('class' => 'form-control', 'id'=>'cargoTypeHandled', 'placeholder'=>'Type of Cargo Handled','data-mandatory'=>'M' ,$setDisable)) !!}
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('market_value','Market Value') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('market_value', null, array('class' => 'form-control', 'id'=>'marketValue', 'placeholder'=>'Market Value','data-mandatory'=>'M' ,$setDisable)) !!}
                 </div>
                 <div class="col-md-4" style="padding-bottom: 15px;">
                    {!! Form::label('type_of_insurance','Type of Insurance') !!}
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::select('type_of_insurance', ['' => '', 'HM' => 'Hull and Machinery', 'FI' => 'Freight Insurance', 'LHP' => 'Loss of Hire/Profit', 'ALL' => 'All Risk'], null, array('class' => 'form-control', 'id'=>'svInsuranceType', 'placeholder'=>'Type of Insurance','data-mandatory'=>'M' ,$setDisable)) !!}
                 </div>                    
            </div>



            <div class="center-align" style="margin:0px 25px;"></div>
            <div class="row">
                <div class="col-md-12" style="margin-left:20px;">
                    <div id="currentSection">
                        {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                        {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-success btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                        {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-success btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
                        @if($user->isSME() || $user->isBankUser())
                            {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                        @endif
                        {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer')

<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js_new/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {

        $('#inlandConveyance').select2({
            allowClear: true,
            placeholder: "Select Inland Conveyance"
        });

        $('#cargoType').select2({
            allowClear: true,
            placeholder: "Select Cargo Type"
        });

        $('#riskType').select2({
            allowClear: true,
            placeholder: "Select Risk Cover"
        });

        $('#ieCargoType').select2({
            allowClear: true,
            placeholder: "Select Cargo Type"
        });

        $('#ieRiskType').select2({
            allowClear: true,
            placeholder: "Select Risk Cover"
        });

        $('#svInsuranceType').select2({
            allowClear: true,
            placeholder: "Select Insurance Type"
        });

        //hide asset to be insured select
        $('#inlandTransit').hide();
        $('#importExportTansit').hide();
        $('#shipVesselTansit').hide();

        $('#inland').change(function(){
            $('#inlandTransit').show();
            $('#importExportTansit').hide();
            $('#shipVesselTansit').hide();
        });

        $('#importExport').change(function(){
            $('#importExportTansit').show();
            $('#inlandTransit').hide();
            $('#shipVesselTansit').hide();
        });

        $('#shipVessel').change(function(){
            $('#shipVesselTansit').show();
            $('#inlandTransit').hide();
            $('#importExportTansit').hide();
        });

        $('#datetimepicker8').datepicker({
            todayBtn: "linked",
            autoclose: true,
            toggleActive: true,
            orientation: "bottom auto",
        });
    });
</script>
@stop