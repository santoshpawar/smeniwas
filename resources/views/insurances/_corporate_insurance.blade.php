<?php 
    $setDisable = '';
    $comYourSalestype = '';
    $existingCompanyDeailsCount = '';
    $maxCompanyDetails = '';
    $removeMandatory = '';
?>
<div class="col-md-10">
    <div class="tab-content tab-design">
        <div class="tab-pane active" id="IndustrialInsurance" style="">
            <div id="radioBtnGroup">
                <div class="row">    
                    <div class="col-lg-12" style="padding-top: 15px;">
                        <div class="col-md-3">
                            <label class="radio-inline">
                                {!! Form::radio('ci_radio_btn', '1',false , ['id' => 'radioOffice','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Office</strong>
                            </label>
                        </div>
                        <div class="col-md-3">
                            <label class="radio-inline">
                                {!! Form::radio('ci_radio_btn', '2',false , ['id' => 'radioGroup','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                <strong>Group Mediclaim/Accident</strong>
                            </label>                    
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- start of engEquipment -->
            <div id="office">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="dynamic" class="form-group" style="margin-left: auto;">
                            <br>
                            <div id="officeOptn" class="panel panel-success">
                                <div class="panel-heading">Office Address</div>
                                <div class="row">
                                    <br>
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ci_address_1','Address 1') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::text('ci_address_1', null, array('class' => 'form-control', 'id'=>'address1', 'placeholder'=> 'Address 1','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ci_address_2','Address 2') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::text('ci_address_2', null, array('class' => 'form-control', 'id'=>'address2', 'placeholder'=> 'Address 2','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ci_address_3','Address 3') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::text('ci_address_3', null, array('class' => 'form-control', 'id'=>'address3', 'placeholder'=> 'Address 3','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ci_city','City') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::select('ci_city', $cities, null, array('class' => 'form-control', 'id'=>'city', 'placeholder'=> 'City','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ci_state','State') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::select('ci_state', $cities, null, array('class' => 'form-control', 'id'=>'state', 'placeholder'=> 'State','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ci_pincode','Pincode') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::text('ci_pincode', null, array('class' => 'form-control', 'id'=>'pincode', 'placeholder'=> 'Pincode','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                     </div>    
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <br>
                            <div id="ownershipOptn" class="panel panel-success">
                                <div class="panel-heading">Ownership</div>
                                <div class="row">
                                    <br>
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="padding-bottom:20px">
                                            {!! Form::label('ci_ownership','Ownership') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::select('ci_ownership', ['' => '', 'Own' => 'Own', 'Rented' => 'Rented'], null, array('class' => 'form-control', 'id'=>'ownership', 'placeholder'=> 'Address 1','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>    
                                    </div>        
                                </div>
                                <div>
                                    <!-- Table -->
                                    <table cellpadding="4" cellspacing="4" class="table borderless" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="padding: 5px;">
                                                <table class="table borderless" style="margin-bottom: 0px;">
                                                    <tr>
                                                        <td>
                                                            <table class="table borderless">
                                                                <tr>
                                                                    <td class="col-md-6" style="border-bottom:1px dashed #666666;">Type of Insurance</td>
                                                                    <td style="border-bottom:1px dashed #666666;">Amount <span>&nbsp;( <span class="fa fa-inr">&nbsp; </span>in Lacs )</span> of insurance Required</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('ci_chkboxbuildingContent', 'buildingContent',false , ['id' => 'chkboxbuildingContent','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('ci_chkboxbuildingContent', 'Building & Contents(Fire, Lightining riot, Flood)', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtbuildingContent', null, array('class' => 'form-control', 'id'=>'txtbuildingContent', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('ci_chkboxBurglary', 'burglary',false , ['id' => 'chkboxBurglary','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('ci_chkboxBurglary', 'Burglary', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtBurglary', null, array('class' => 'form-control', 'id'=>'txtBurglary', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('ci_chkboxCodr', 'codr',false , ['id' => 'chkboxCodr','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('ci_chkboxCodr', 'Cost of Data Reinstatement', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtCodr', null, array('class' => 'form-control', 'id'=>'txtCodr', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('ci_chkboxCis', 'cis',false , ['id' => 'chkboxCis','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('ci_chkboxCis', 'Cash-in-Safe', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtCis', null, array('class' => 'form-control', 'id'=>'txtCis', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('ci_chkboxCit', 'cit',false , ['id' => 'chkboxCit','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('ci_chkboxCit', 'Cash-in-Transit', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtCit', null, array('class' => 'form-control', 'id'=>'txtCit', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-6">
                                                                        {!! Form::checkbox('ci_chkboxFidelity', 'fidelity',false , ['id' => 'chkboxFidelity','class'=>'damagescr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        {!! Form::label('ci_chkboxFidelity', 'Fidelity', ['style' => 'margin-left:5px;']) !!}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::text('txtFidelity', null, array('class' => 'form-control', 'id'=>'txtFidelity', 'placeholder'=>'Insurance Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <!-- end of engEquipment -->

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
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('#city').select2({
            allowClear: true,
            placeholder: "Select City"
        });

        $('#state').select2({
            allowClear: true,
            placeholder: "Select State"
        });

        $('#ownership').select2({
            allowClear: true,
            placeholder: "Select Ownership"
        });

        $('#office').hide();

        $('#radioOffice').change(function(){
            $('#office').show();
        });

        $('#radioGroup').change(function(){
            $('#office').hide();
        });
    });        
</script>
@stop