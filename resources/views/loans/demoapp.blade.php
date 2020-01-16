<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
  .modal .modal-header {
    border-bottom: none;
    position: relative;
}
.modal .modal-header .btn {
    position: absolute;
    top: 0;
    right: 0;
    margin-top: 50px;
    border-top-left-radius: 0;
    border-bottom-right-radius: 0;
}
.modal .modal-footer {
    border-top: none;
    padding: 0;
}
.modal .modal-footer .btn-group > .btn:first-child {
    border-bottom-left-radius: 0;
}
.modal .modal-footer .btn-group > .btn:last-child {
    border-top-right-radius: 0;
}
span.boldClass{
    background: #c0c1d6;
    font-size: 20px;
    padding: 7px;
}
label.youSelected{
    color: #f44336;
    width: 674px;
}
</style>
<?php
$receivables0InvoiceCounter = 0;
$receivables1InvoiceCounter = 0;
$receivables2InvoiceCounter = 0;
$receivable_count = 0;
$endUseList = Session::get('end_use');
$loanId = Session::get('loanId');
$amount = Session::get('loan_amount');
$loanTenure = Session::get('loan_tenure');
$loanType = Session::get('type');
$pre_fix = "";
if (!App::isLocal()){
    $pre_fix = "smeniwas/public";
}
$link_address = URL::to('/loans/uploaddoc/'.$loanType.'/'.$endUseList.'/'.$amount.'/'.$loanTenure.'/'.$loanId);
//$link_address = URL::to('/loans/uploaddoc/'.$endUseList.'/'.$loanType.'/'.$amount.'/'.$loanTenure.'/'.$companySharePledged.'/'.$bscNscCode.'/'.$loanId);
//loans/uploaddoc/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{afterShare?}/{loanId?}
$message = Session::get('message');
?>
<div class="container-fluid">
 <div class="row">
     <div class="card">
         <div class="card-header" data-background-color="green">
             <h4 class="title">Security Details <span class="pull-right">{{ $userProfile->name_of_firm }}</span></h4>
             {{--  <p class="category">Apply new loan</p>   --}}
         </div>
         <div class="card-content">
            <div id="divTab_sub">
                <div class="tab-content tab-design" style="padding-left:10px;padding-top:20px;padding-right:25px;">
                    <div class="row" style="margin-left:10px">
                        <div class="col-md-12">
                            <div id="yearQue37" class="form-group">
                                <div id="topcust" class="panel panel-success">
                                    <div class="panel-heading">Type Of Security Offered</div>
                                    <div class="panel-body">
                                        <div class="row" style="padding:5px;">
                                            {!! Form::hidden('model_id', isset($model)?$model->id:null) !!}
                                            {!! Form::hidden('loan_id', strcmp($loanId,"''")!=0?$loanId:null) !!}
                                            {!! Form::hidden('id', null ) !!}
                                            {!! Form::hidden('receivables0InvoiceCounter', 0, array('id' => 'receivables0InvoiceCounter')) !!}
                                            {!! Form::hidden('receivables1InvoiceCounter', 0, array('id' => 'receivables1InvoiceCounter')) !!}
                                            {!! Form::hidden('receivables2InvoiceCounter', 0, array('id' => 'receivables2InvoiceCounter')) !!}
                                            {!! Form::hidden('receivable_count', 0, array('id' => 'receivable_count')) !!}
                                            @if(isset($loanType) && ($loanType == 'LAP' || $loanType == 'CC' || $loanType == 'STL'))
                                            <?php
                                            if($loanType=='LAP'){
                                                $loanTypeHeading='Loan against property';
                                            }elseif ($loanType=='CC') {
                                                $loanTypeHeading='Secured Short Term WC/CC/OD loan';
                                            }elseif ($loanType=='STL') {
                                                $loanTypeHeading='Secured short term loan';
                                            }
                                            ?>
                                            <label class="youSelected">You have selected <span style="font-style: italic;"><u>{{ $loanTypeHeading }} </u></span> Collateral Property Needs to be provided</label>
                                            <div class="col-md-6">
                                                {!! Form::label('is_collateral_property','Collateral Property') !!}
                                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes','class'=>'securityColl-input radio']) !!}
                                                {!! Form::label('is_collateral_property', 'Yes') !!}
                                                {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no','disabled' => 'disabled','class'=>'securityColl-input radio']) !!}
                                                {!! Form::label('is_collateral_property', 'No') !!}
                                            </div>
                                            @else
                                            <div class="col-md-6">
                                                {!! Form::label('is_collateral_property','Collateral Property') !!}
                                                {!! Form::label(null, $removeMandatory) !!}
                                                {!! Form::radio('is_collateral_property', '1', false, ['id' => 'security_yes',$setDisable,'class'=>'securityColl-input radio']) !!}
                                                {!! Form::label('is_collateral_property', 'Yes') !!}
                                                {!! Form::radio('is_collateral_property', '0', false, ['id' => 'security_no',$setDisable,'class'=>'securityColl-input radio']) !!}
                                                {!! Form::label('is_collateral_property', 'No') !!}
                                            </div>
                                            @endif
                                            <div class="col-md-6 anyOtherSecurityHead collapse" style="margin-left: auto">
                                                {!! Form::label('othersecurity_type1','Any Other Security') !!}
                                                {!! Form::radio('is_any_other_security', '0', false, ['id' => 'is_any_other_security_yes','class'=>'securityColl-input radio']) !!}
                                                {!! Form::label('is_any_other_security', 'Yes') !!}
                                                {!! Form::radio('is_any_other_security', '1', false, ['id' => 'is_any_other_security_no','class'=>'securityColl-input radio']) !!}
                                                {!! Form::label('is_any_other_security', 'No') !!}
                                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            </div>
                                            <div class="form-group collapse col-md-12" id="anyOtherSecurity" style="margin-left: 20px;padding-top: 40px;">
                                                <?php
                                                $i=0; ?>
                                                @foreach ($otherSecurityTypes as $otherSecurityTypeName=>$otherSecurityTypeValue)
                                                {!! Form::radio('othersecurity_type', $otherSecurityTypeValue,$choosenOtherSecurityType,['id' =>'security_'.$i,'class'=>'securityColl-input radio',$setDisable] ) !!}
                                                {!! Form::label($otherSecurityTypeName, $otherSecurityTypeName,['style'=>'padding-right: 14px;']) !!}
                                                <?php $i++;?>
                                                @endforeach
                                                {{--{!!Form::text('others_value', isset($business_object->others_value) ? $business_object->others_value : null, ['id' => 'others_text','class'=>'form-control', 'placeholder' => 'Please specify...','style' => 'margin-top:10px;',$setDisable] )!!}--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Inventory --}}
                    <div class="row" style="margin-left:10px">
                        <div class="col-md-12">
                            <div id="inventoryHead" class="form-group collapse">
                                <div class="panel panel-success">
                                    <div class="panel-heading">Details Of Inventory</div>
                                    <div class="row" style="padding:10px">
                                        <div class="col-md-5">
                                            {!! Form::label('Nature of Inventory ','Nature of Inventory') !!}
                                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            {!! Form::select('natureOfInventory', $natureOfInventory , null , ['id' => 'natureOfInventory','class'=>'form-control', 'style' => 'width:100%','data-mandatory'=>'M',$setDisable]) !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!! Form::label('Type of Inventory','Type of Inventory') !!}
                                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            {!! Form::select('typeOfInventory', $typeOfInventory , null , ['id' => 'typeOfInventory','class'=>'form-control', 'style' => 'width:100%','data-mandatory'=>'M',$setDisable]) !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!! Form::label('Value of Inventory','Value of Inventory') !!}(<span class="fa fa-inr"></span> in Lacs)
                                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            {!! Form::text('valuOfInventory', isset($security_object->valuOfInventory)? $security_object->valuOfInventory : null, ['class'=>'form-control amount', 'placeholder' => '(Rs In Lacs)','data-mandatory'=>'M' ,$setDisable] )!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Inventory --}}
                    <div class="row" style="margin-left:10px">
                        <div class="col-md-12">
                            <div id="otherSecurityOther" class="form-group collapse">
                                <div class="panel panel-success">
                                    <div class="panel-heading">Other</div>
                                    <div class="row" style="padding:10px">
                                        <div class="col-md-5">
                                            {!! Form::label('Other','Other') !!}
                                            {!! Form::label(null,$removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            {!! Form::text('otherSecurityOther', null, ['class' =>'form-control','placeholder' => 'Please Specify', 'size' => '5x5','data-mandatory'=>'M' ,$setDisable]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- start E1 -->
                    <div class="row" style="margin-left:10px">
                        <div class="col-md-12">
                            <div class="form-group collapse" id="que24">
                                <div class="panel panel-success">
                                    <div class="panel-heading">Details of Colltral Property- Collateral property</div>
                                    <div class="panel-body">
                                        <div class="row" style="padding:10px">
                                            <div class="col-md-3">
                                                {!! Form::label('collateral_type','Type of collateral offered') !!}
                                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                <br>
                                                {!! Form::select('collateral_type',$propertyType,$chosenPropertyType, ['id' => 'type_of_collateral', 'style' => 'width: 100%;','data-mandatory'=>'M' ,$setDisable]) !!}
                                            </div>
                                                {{-- <div class="col-md-3">
                                                    {!! Form::label('area','Area') !!}
                                                    {!! Form::label(null,$removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                    {!! Form::text('area', null, ['class' =>'form-control','placeholder' => 'Area', 'size' => '5x5','data-mandatory'=>'M' ,$setDisable]) !!}
                                                </div> --}}
                                                <div class="col-md-3">
                                                    {!! Form::label('city','City') !!}
                                                    {!! Form::label(null,$removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                    {!! Form::select('city',$cities,null, ['id' => 'city' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M' ,$setDisable]) !!}
                                                    <div class="col-md-12 collapse" id="custom_cityName" style="padding-left: 0px;">
                                                        {!! Form::label('city','City Name') !!}
                                                        {!! Form::label(null,$removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                        {!! Form::text('city_other', null, ['class' =>'form-control','placeholder' => 'Enter City Name', 'size' => '5x5','data-mandatory'=>'M' ,$setDisable]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {!! Form::label('Property Land  is','Property Land  is') !!} <br>
                                                    {!! Form::radio('propertyLand', 'Free  Hold', false, ['checked','id' => 'free_hold','class'=>'securityColl-input radio',$setDisable]) !!}
                                                    {!! Form::label('sourced_type', 'Free Hold') !!}
                                                    {!! Form::radio('propertyLand', 'Lease Hold', false, ['id' => 'lease_hold','class'=>'securityColl-input radio',$setDisable]) !!}
                                                    {!! Form::label('sourced_type', 'Lease Hold') !!}
                                                </div>
                                                <div class="col-md-3 pull-right collapse" id="lessor">
                                                    {!! Form::label('Name of Lessor','Name of Lessor') !!}
                                                    {!! Form::label(null,$removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                    {!! Form::text('nameOfLessor', null, ['class' =>'form-control','placeholder' => 'Name of Lessor','maxlength' => 20, 'size' => '5x5','data-mandatory'=>'M' ,$setDisable]) !!}
                                                </div>
                                           {{--  <div class="col-md-3">
                                                {!! Form::label('','Pin Code') !!}
                                                {!! Form::label(null,$removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                {!! Form::text('pincode', null, ['class' =>'form-control amount','placeholder' => 'Pin code','maxlength' => 6, 'size' => '5x5','data-mandatory'=>'M' ,$setDisable]) !!}
                                            </div> --}}
                                        </div>  
                                        <div class="row" style="padding:10px">
                                            <div class="col-md-3">
                                                {!! Form::label('owner','Owner') !!}
                                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                {!! Form::select('owner', $ownerTypes, $chosenOwner, ['id' => 'owner', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M' ,$setDisable]) !!}
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::label('latest_valuation','Latest Valuation') !!}
                                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                                {!! Form::text('latest_valuation', isset($business_object->latest_valuation)? $business_object->latest_valuation : null, ['class'=>'form-control amount', 'placeholder' => '(Rs In Lacs)','data-mandatory'=>'M' ,$setDisable] )!!}
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::label('propertyIs','Property Is') !!}
                                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                                                <br>
                                                {!! Form::select('propertyIs', $propertyIs, $chooseProperty, ['id' => 'propertyIs', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M' ,$setDisable]) !!}
                                            </div>
                                        </div>
                                        <div class="row" style="padding:10px">
                                            <div class="col-md-12">
                                                <div id="showDocuments"></div>
                                                {{--{!! Form::label('owner','Which of the following documents are available for the--}}
                                                {{--collateral') !!}--}}
                                                {{--{!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}--}}
                                                {{--@foreach ($documentsTypes as $documentTypeName=>$documentTypeValue)--}}
                                                {{--<div style='padding-left:20px' id = "showDocuments">--}}
                                                {{--{!! Form::checkbox('documents[]', $documentTypeValue,(in_array($documentTypeValue,$chosenDocuments) ? true: false)) !!}--}}
                                                {{--{{{$documentTypeName}}}--}}
                                                {{--</div>--}}
                                                {{--@endforeach--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end E1 -->
                <!-- start E3 -->
                <div class="row" style="margin-left:10px">
                    <div class="col-md-12">
                        <div id="equipmentsMainHead" class="form-group collapse">
                            <div class="panel panel-success">
                                <div class="panel-heading">Equipments/Machinery</div>
                                <div class="row" style="padding:10px">
                                    <div class="col-md-5">
                                        {!! Form::label('type_of_equipment ','Type of Equipment ') !!}
                                        {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                        {!! Form::select('equipment_type', $purchasedEquipmentTypes , null , ['id' => 'type_of_equipment','class'=>'form-control', 'style' => 'width:100%','data-mandatory'=>'M',$setDisable]) !!}
                                        <div id="otherEquipmentTypeDiv" class="collapse">
                                            {!!Form::text('equipment_type_others', null, ['class'=>'form-control', 'id' =>'type_of_equipment_others', 'placeholder' => 'Enter Other Equipment Type','data-mandatory'=>'M',$setDisable ] )!!}
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        {!! Form::label('brief_description','Brief Description ') !!}
                                        {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                                        {!!Form::textarea('description', isset($business_object->description) ? $business_object->description : null, ['class'=>'form-control', 'size' => '30x3',$setDisable] )!!}
                                    </div>
                                </div>
                                <div class="row" style="padding:10px">
                                    <div class="col-md-3">
                                        {!! Form::label('Sourced ','Sourced ') !!}
                                        {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                        <br>
                                        {!! Form::radio('sourced_type', 'owned', false, ['id' => 'imported_sourced',$setDisable]) !!}
                                        {!! Form::label('sourced_type', 'Imported') !!}
                                        {!! Form::radio('sourced_type', 'rented', false, ['checked','id' => 'domestically_sourced',$setDisable]) !!}
                                        {!! Form::label('sourced_type', 'Domestically Sourced') !!}
                                    </div>
                                    <div id="mandatory" class="collapse">
                                        <div class="col-md-5">
                                            {!! Form::label('name_of_manufacturer ','Name of Manufacturer ') !!}
                                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            {!!Form::text('manufacturer_name_mandatory', isset($business_object->manufacturer_name_mandatory) ? $business_object->manufacturer_name_mandatory : null, ['class'=>'form-control',$setDisable] )!!}
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('year_of_manufacture','Year of Manufacture') !!}
                                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                                            {!!Form::text('manufacture_year_mandatory',  isset($business_object->manufacture_year_mandatory) ? $business_object->manufacture_year_mandatory : null, ['class'=>'form-control amount','id'=>'datepickerEquipment',$setDisable] )!!}
                                        </div>
                                    </div>
                                    <div id="not_mandatory" class="collapse">
                                        <div class="col-md-5">
                                            {!! Form::label('name_of_manufacturer ','Name of Manufacturer ') !!}
                                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                            {!!Form::text('manufacturer_name', isset($business_object->manufacturer_name) ? $business_object->manufacturer_name : null, ['class'=>'form-control',$setDisable] )!!}
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('year_of_manufacture','Year of Manufacture') !!}
                                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                                            {!!Form::text('manufacture_year',  isset($business_object->manufacture_year) ? $business_object->manufacture_year : null, ['class'=>'form-control amount',$setDisable] )!!}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table class="table collapse" id="equipment_sourced_imported">
                                    <tr>
                                        <th>Invoice CIF Value (<span class="fa fa-inr"></span> in Lacs)<span class="redmarks" style="color: red;"><?php echo $removeMandatory; ?></span></th>
                                        <th>Custom and Other Duty (<span class="fa fa-inr"></span> in Lacs)<span class="redmarks" style="color: red;"><?php echo $removeMandatory; ?></span></th>
                                        <th>Total Landed Cost  (<span class="fa fa-inr"></span> in Lacs)<span class="redmarks" style="color: red;"><?php echo $removeMandatory; ?></span></th>
                                    </tr>
                                    <tr>
                                        <td>{!!Form::text('invoice_cif_in_lacs', isset($business_object->invoice_cif_in_lacs) ? $business_object->invoice_cif_in_lacs : null, ['class'=>'form-control amount',' id="txt1" ',' onkeyup="sum();"',$setDisable] )!!}</td>
                                        <td>{!!Form::text('custom_duty', isset($business_object->custom_duty) ? $business_object->custom_duty : null, ['class'=>'form-control amount',' id="txt2" ',' onkeyup="sum();"',$setDisable] )!!}</td>
                                        <td>{!!Form::text('invoice_cif_in_usd',  isset($business_object->invoice_cif_in_usd) ? $business_object->invoice_cif_in_usd : null, ['class'=>'form-control amount',' id="txt3" ',$setDisable] )!!}</td>
                                    </tr>
                                </table>
                                <table class="table collapse" id="equipment_sourced_domestically_sourced">
                                    <tr>
                                        <th>Invoice Value (<span class="fa fa-inr"></span> in Lacs)<span class="redmarks" style="color: red;"><?php echo $removeMandatory; ?></span></th>
                                    </tr>
                                    <tr>
                                        <td>{!!Form::text('invoice_value', isset($business_object->invoice_value) ? $business_object->invoice_value : null, ['class'=>'form-control amount', 'placeholder' => '(Rs. in Lacs)',$setDisable] )!!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end E3 -->
                <!-- start E4 -->
                {{ $test='' }}
                @if($test=='')
                <div class="row" id="receivableBuyer" style="margin-left:10px">
                    <!-- outer for start -->
                    @for($formIndexRec=0; $formIndexRec < $maxReceivableDiscount; $formIndexRec++)
                    <?php
                    $colorstyle = "";
                    $buyerNameAttrName = 'buyer_name_'.$formIndexRec;
                    $buyerNameAttrValue = null;
                    $avgMonthlySaleAttrName = 'avg_monthly_sale_'.$formIndexRec;
                    $avgMonthlySaleAttrValue = null;
                //$collapsedReceivables = "collapse";
                //$receivablesPanelHeading = "Details of Receivable Discounted";
                    if($formIndexRec == 0)
                    {
                        $collapsedReceivables = "";
                        $receivablesPanelHeading = "Details of Receivable";
                    }
                    else
                    {
                        $collapsedReceivables = "collapse";
                        if(isset($buyerNameAttrValue) && !empty($buyerNameAttrValue))
                        {
                            $receivablesPanelHeading = "Additional Details of Receivable Discounted - " .$formIndexRec;
                        }
                    }
                    if(isset($buyer_details[$formIndexRec]))
                    {
                        $buyerNameAttrValue = $buyer_details[$formIndexRec]['buyer_name'];
                        $avgMonthlySaleAttrValue = $buyer_details[$formIndexRec]['avg_monthly_sale'];
                        $collapsedReceivables = "";
                        $receivable_count = $formIndexRec;
                    }
                    ?>
                    @if($formIndexRec == 0 || $formIndexRec == 2 || $formIndexRec == 4 )
                    <?php $colorstyle = "style='padding:10px; background: cornsilk;'"; ?>
                    @else
                    <?php $colorstyle = "style='padding:10px; background: #adadad;'"; ?>
                    @endif
                    @if($formIndexRec == 0)
                    <div class="col-md-12" style="margin-left: -17px;width: 103%;">
                        @endif
                        <div id="receivable_{{$formIndexRec}}" class="panel panel-success {{$collapsedReceivables}} collapse">
                            <div class="panel-heading">{{$receivablesPanelHeading}}</div>
                            <div class="row" style="padding:10px;">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        {!! Form::label('buyer_name','Name Of Buyer:') !!}
                                        {!! Form::text($buyerNameAttrName, $buyerNameAttrValue, ['class'=>'form-control', 'placeholder' => 'Name Of Buyer',$setDisable] )!!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('avg_monthly_sale','Average Monthly sales details for last 3 months:') !!}
                                        {!!Form::text($avgMonthlySaleAttrName,$avgMonthlySaleAttrValue, ['class'=>'form-control amount', 'placeholder' => '(Rs. in Lacs)',$setDisable] )!!}
                                    </div>
                                </div>
                            </div>
                            <div id="clearfix" style="padding: 5px;">
                                <!-- inner for start -->
                                @for($formIndex=0; $formIndex < $maxPaymentTerms; $formIndex++)
                                <?php
                                $invoiceDateAttrName = 'invoice_date_'.$formIndexRec.'_'.$formIndex;
                                $invoiceDateAttrValue = null;
                                $invoiceAmountAttrName = 'amount_'.$formIndexRec.'_'.$formIndex;
                                $invoiceAmountAttrValue = null;
                                $invoiceTermsAttrName = 'payment_terms_'.$formIndexRec.'_'.$formIndex;
                                $invoiceTermsAttrValue = null;
                            //$collapsedInvoices = "collapse";
                                if($formIndex == 0)
                                {
                                    $collapsedInvoices = "";
                                    $invoicesPanelHeading = "Invoice Details";
                                }
                                else
                                {
                                    $collapsedInvoices = "collapse";
                                    if(isset($avgMonthlySaleAttrValue) && !empty($avgMonthlySaleAttrValue))
                                    {
                                        $invoicesPanelHeading = "Invoice Details - " .$formIndex;
                                    }
                                }
                                if(isset($buyer_details[$formIndexRec]) && $buyer_details[$formIndexRec]['amount_'.($formIndex+1)] > 0)
                                {
                                    $invoiceDateAttrValue = $buyer_details[$formIndexRec]['invoice_date_'.($formIndex+1)];
                                    $invoiceAmountAttrValue = $buyer_details[$formIndexRec]['amount_'.($formIndex+1)];
                                    $invoiceTermsAttrValue = $buyer_details[$formIndexRec]['payment_terms_'.($formIndex+1)];
                                    $collapsedInvoices = "";
                                    if($formIndexRec == 0)
                                    {
                                        $receivables0InvoiceCounter = $formIndex;
                                    }
                                    elseif($formIndexRec == 1)
                                    {
                                        $receivables1InvoiceCounter = $formIndex;
                                    }
                                    elseif($formIndexRec == 2)
                                    {
                                        $receivables2InvoiceCounter = $formIndex;
                                    }
                                }
                                $colorstyle = "";
                                ?>
                                @if($formIndex == 0 || $formIndex == 2 || $formIndex == 4 )
                                <?php $colorstyle = "style='padding:10px; background: cornsilk;'"; ?>
                                @else
                                <?php $colorstyle = "style='padding:10px; background: #adadad;'"; ?>
                                @endif
                                <div class="panel panel-success {{$collapsedInvoices}}" id="by_{{$formIndexRec}}_payment_terms_{{$formIndex}}">
                                    <div class="panel-heading">{{$invoicesPanelHeading}}</div>
                                    <div class="row">
                                        <br>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('date_of_invoice','Date of Invoice', ['class'=>'control-label', 'style' => 'margin-left: 25px;']) !!}
                                                <div class="col-md-12">
                                                    {!! Form::text($invoiceDateAttrName, $invoiceDateAttrValue,['id' => 'datepicker_'.$formIndex,'class' => 'form-control', 'style' => 'margin-left: 10px;',$setDisable]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('invoice_amount','Amount', ['class'=>'control-label', 'style' => '  margin-left: 15px;']) !!}
                                                <div class="col-md-12">
                                                    {!! Form::text($invoiceAmountAttrName,$invoiceAmountAttrValue,['id' => $invoiceAmountAttrName, 'class' => 'form-control amount', 'placeholder' => '(Rs. in Lacs)', $setDisable]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('payment_terms','Payment Terms', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                                <div class="col-md-12">
                                                    {!! Form::select($invoiceTermsAttrName, $paymentTermsType, $invoiceTermsAttrValue, ['' => '', 'id' => $invoiceTermsAttrName, 'class' => 'form-control amount', 'style' => 'width:250px;',$setDisable]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                                <!-- inner for end -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" align="left" style="padding-left: 20px;">
                                            <button class="btn btn-primary add_promo_button" id="add_payment_terms_{{$formIndexRec}}" type="button" onclick="myfunction({{$formIndexRec}})"style="font-weight:bold;  margin-left: 10px;" {{$setDisable}}>
                                                Add Invoice
                                            </button>
                                            <button class="btn btn-warning rem_promo_button" style="font-weight:bold;" id="rem_payment_terms_{{$formIndexRec}}" onclick="myFunctionDelete({{$formIndexRec}})" type="button" {{$setDisable}}>
                                                Remove Invoice
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End of clearfix div -->
                        </div>
                        @endfor
                        <!-- outer for end -->
                        <div class="form-group collapse" id="addBuyer" align="left" style="padding-left: 20px;">
                            <button class="btn btn-primary add_promo_button" id="add_receivable_discount" type="button" style="font-weight:bold;  margin-left: 10px;" {{$setDisable}}>
                                Add Buyer
                            </button>
                            <button class="btn btn-warning rem_promo_button" style="font-weight:bold;" id="rem_receivable_discount" type="button" {{$setDisable}}>
                                Remove Buyer
                            </button>
                        </div>
                    </div>
                    @endif
                    {{--</div>--}}
                    {!! Form::hidden('counter_storage', 0, array('id' => 'counter_storage')) !!}
                    {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers'))!!}
                    {!! Form::hidden('rec_counter_storage', 0, array('id' => 'rec_counter_storage')) !!}
                    {!! Form::hidden('no_of_rec_opened_containers', 1, array('id' => 'no_of_rec_opened_containers'))!!}
                    @if($deletedQuestionHelper->isQuestionValid("E4"))
                </div>
                <div class="center-align" style="margin:0px 25px;"></div>
               
                <div class="row">
                    <div class="col-md-12" style="margin-left:20px;">
                        {{--{!! Form::button('<i class="fa fa-reply"></i> Back', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div4', '$loanType', '$endUseList', $amount, $loanTenure, $loanId); return false;", 'value'=> 'Back', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}--}}
                        {!! Form::button('Save/Next Section <i class="fa fa-share"></i>', ['type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable]) !!}
                        {{--<a data-toggle="modal" href="#myModal" class="btn btn-success btn-cons sme_button" id="nextIn" style="margin-top:20px;margin-left:20px;">Save & Submit <i class="fa fa-floppy-o"></i></a>--}}
                        @if(isset($loan))
                        {!! HTML::linkAction('Pdf\PrintController@getIndex', 'Download PDF', ['id' => $loan->id], ['class' => 'btn btn-success btn-cons sme_button', 'target' => '_blank', 'style' => 'margin-top:20px;margin-left:20px;']) !!}
                        @endif
                        {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    </div>
                </div>
                @else
                <div class="center-align" style="margin:0px 25px;"></div>
                <div class="row">
                    <div class="col-md-12" style="margin-left:20px;">
                        {!! Form::button('Save/Next Section <i class="fa fa-share"></i>', ['type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable]) !!}
                        @if($user->isSME() || $user->isBankUser())
                        {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                        @endif
                        @if(isset($loan))
                        {!! HTML::linkAction('Pdf\PrintController@getIndex', 'Download PDF', ['id' => $loan->id], ['class' => 'btn btn-success btn-cons sme_button', 'target' => '_blank', 'style' => 'margin-top:20px;margin-left:20px;']) !!}
                        @endif
                        {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
        @if (!empty($errors) && isset($message))
        <script>
            $(function() {
                $('#myModal').modal('show');
            });
        </script>
        @endif
        <div id="myModal" class="modal fade in">
            <div class="modal-dialog" style="position: absolute;left: 35%;top: 35%;">
                <div class="modal-content">
                    {{--<div class="modal-header">--}}
                    {{--<a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>--}}
                    {{--<h4 class="modal-title">Modal Heading</h4>--}}
                    {{--</div>--}}
                    <div class="modal-body" style="text-align: center">
                        <h4>Do you want to proceed to upload documents?</h4>
                    </div>
                    <div class="modal-footer" style="text-align: center">
                        <div class="btn-group">
                            <a href="<?php echo $link_address;?>" class="btn btn-primary"><span class="glyphicon glyphicon-check">Yes</span></a>
                            {{--<button class="btn btn-primary" name="proceedNext" value="yes" style="margin-right: 10px;"><span class="glyphicon glyphicon-check"></span> Yes</button>--}}
                            <button class="btn btn-danger" name="proceedNext" data-dismiss="modal" value="no"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->
        {{--<a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch demo modal</a>--}}
        <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
        <link href="{{ asset('/css/datepicker.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style type="text/css" media="screen">
            table.ui-datepicker-calendar{
                display: none !important;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#lease_hold').click(function(event) {
                    $("#lessor").collapse("show");
                });
                $('#free_hold').click(function(event) {
                    $("#lessor").collapse("hide");
                });
                $('#datepicker_0').click(function() {
                    $('.ui-datepicker-calenda').css({
                        'display': 'none !important',
                    });
                });
             // $("#datepickerEquipment .ui-datepicker-calendar").css({ display: 'none' });
             if($("#type_of_equipment option:selected").text() == 'Medical Equipment') {
                $("#mandatory").collapse("show");
                $("#not_mandatory").collapse("hide");
            }
             //            $("#mandatory").show();
             $("#type_of_equipment").change(function () {
                if($(this).val() == 'Medical Equipment' || $(this).val() == 'Construction/Excavation Equipment' || $(this).val() == 'Transportation Vehicles') {
                    $("#not_mandatory").collapse("hide");
                    $("#mandatory").collapse("show");
                } else {
                    $("#not_mandatory").collapse("show");
                    $("#mandatory").collapse("hide");
                }
            });
         });
            $(document).ready(function() {
                var cnt = 1;
                /*---- end toggle function*/
                $("#nextIn").click(function (e){
                    if(validateForm('#divTab_sub')){
                        return true;
                    }else{
                        e.preventDefault();
                    }
                });
                if($("input[name=is_collateral_property]:checked").val() == 1){
                    $("#que24").collapse("show");
                }else{
                    $("#que24").collapse("hide");
                    $("#equipmentsMainHead").collapse("hide");
                }
                if(($("#city").val() == 'Other')){
                    $('#custom_cityName').collapse("show");
                }else{
                    $('#custom_cityName').collapse("hide");
                }
                $("#city").change(function () {
                    if(($(this).val()) == 'Other'){
                        $('#custom_cityName').collapse("show");
                    }else{
                        $('#custom_cityName').collapse("hide");
                    }
                });
                $('#city').select2({
                    allowClear: true,
                    placeholder: "Select City name"
                });
            /*  $('#propertyLand').select2({
            allowClear: true,
            placeholder: "Select Property Land"
        });*/
        if($("#domestically_sourced").is(":checked"))
        {
            $("#equipment_sourced_imported").collapse("hide");
            $("#equipment_sourced_domestically_sourced").collapse("show");
        }
        else
        {
            $("#equipment_sourced_imported").collapse("show");
            $("#equipment_sourced_domestically_sourced").collapse("hide");
        }
    });
            $('#type_of_collateral').select2({
                allowClear: true,
                placeholder: "Select Type of collateral offered"
            });
            $('#owner').select2({
                allowClear: true,
                placeholder: "Select Type of owner"
            });
            $('#propertyIs').select2({
                allowClear: true,
                placeholder: "Select Type of Property"
            });
            $('#type_of_equipment').select2({
                allowClear: true,
                placeholder: "Select Equipment Type"
            });
            $('#natureOfInventory').select2({
                allowClear: true,
                placeholder: "Select Nature of Inventory"
            });
            $('#typeOfInventory').select2({
                allowClear: true,
                placeholder: "Select type of Inventory"
            });
            $(function () {
                $('#datepicker_0').datepicker();
                $('#datepicker_1').datepicker();
                $('#datepicker_2').datepicker();
                $('#datepicker_3').datepicker();
                $('#datepicker_4').datepicker();
            });
            $(document).ready(function () {
                $("#others_text").hide();
                /*---- Auto Population Month and Year -----*/
                var monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
                ];
                var date = new Date();
                var month = date.getMonth();
                var current_month = date.getMonth();
                var year = date.getFullYear();
                var index = 1;
                $(".year_month_sales").each(function () {
                    month--;
                    if (month == -1) {
                        month = 11;
                    }
                    current_month--;
                    if (current_month == -1) {
                        year--;
                    }
                    $(this).val(monthNames[month] + " - " + year);
                    var period = $(this).val(monthNames[month] + " - " + year);
                    var hiddenName = "#period_" + index;
                    $(hiddenName).val(monthNames[month] + " - " + year);
                //            alert($(hiddenName).val());
                index++;
            });
                $(".monthly_sales").each(function () {
                    month--;
                    if (month == -1) {
                        month = 11;
                    }
                    $(this).val(monthNames[month]);
                });
                $(".year_sales").each(function (index, value) {
                    current_month--;
                    if (current_month == -1) {
                        year--;
                    }
                    $(this).val(year);
                });
                /*---- End Auto Population Function ------*/
                /*------ Toggle of Competitor ------*/
                var row_counter = 1;
                $(".remove_competitor").hide();
                $(".add_competitor").click(function () {
                    row_counter++;
                    $("#competitor" + row_counter).collapse("show");
                    if (row_counter > 3) {
                        $(this).hide();
                    }
                    if (row_counter > 1) {
                        $(".remove_competitor").show();
                    }
                });
                $(".remove_competitor").click(function () {
                    $("#competitor" + row_counter).collapse("hide");
                    row_counter--;
                    if (row_counter < 4) {
                        $(".add_competitor").show();
                    }
                    if (row_counter == 1) {
                        $(this).hide();
                    }
                });
                /*-- end toggle function --*/
                /*---- Toggle of State -----*/
                var state_counter = 2;
                $(".remove_state").hide();
                $(".add_state").click(function () {
                    state_counter++;
                    $("#state_name_" + state_counter).collapse("show");
                    if (state_counter == 5) {
                        $(this).hide();
                    }
                    if (state_counter > 2) {
                        $(".remove_state").show
                        ();
                    }
                });
                $(".remove_state").click(function () {
                    $("#state_name_" + state_counter).collapse("hide");
                    state_counter--;
                    if (state_counter == 2) {
                        $(this).hide();
                    }
                    if (state_counter < 5) {
                        $(".add_state").show();
                    }
                });
                /*---- end toggle function*/
                jQuery(document).ready(function ($) {
                    $('#que31_securityoffered').change(function () {
                        var selectedValue = $(this).val();
                        var dataString = 'Name of the ' + selectedValue;
                        $('#namefromselect').text(dataString);
                    });
                });
                $("#security_yes").click(function () {
                    $(".form-control").val("");
                    $(".form-control").select2("val", "");
                    $('input:checkbox').removeAttr('checked');
                    $("#que24").collapse("show");
                    $("#receivable_0").collapse("hide");
                    $("#equipmentsMainHead").collapse("hide");
                    $(".anyOtherSecurityHead").collapse("hide");
                    $("#anyOtherSecurity").collapse("hide");
                    $("#addBuyer").collapse("hide");
                    $("#receivable_1").collapse("hide");
                    $("#otherSecurityOther").collapse("hide");
                    $("#inventoryHead").collapse("hide");
                });
                $("#security_no").click(function () {
                //alert('sasa');
                $(".form-control").val("");
                $("#type_of_collateral").select2("val", "");
                $("#city").select2("val", "");
                // $("#propertyLand").select2("val", "");
                $("#owner").select2("val", "");
                $("#propertyIs").select2("val", "");
                $('input:checkbox').removeAttr('checked');
                $("#que24").collapse("hide");
            });
                /*Everything is hide*/
                $("#security_1").click(function() {
                    $(".form-control").val("");
                    $(".form-control").select2("val", "");
                    $('input:checkbox').removeAttr('checked');
                    $("#receivable_0").collapse("show");
                    $("#addBuyer").collapse("show");
                    $("#security_0").collapse("hide");
                    $("#equipmentsMainHead").collapse("hide");
                    $("#inventoryHead").collapse("hide");
                    $("#otherSecurityOther").collapse("hide");
                    $("#is_any_other_security_no").collapse("hide");
                });
                $("#security_0").click(function() {
                    $(".form-control").val("");
                    $(".form-control").select2("val", "");
                    $('input:checkbox').removeAttr('checked');
                    $("#equipmentsMainHead").collapse("show");
                    $("#receivable_0").collapse("hide");
                    $("#inventoryHead").collapse("hide");
                    $("#security_3").collapse("hide");
                    $("#addBuyer").collapse("hide");
                    $("#otherSecurityOther").collapse("hide");
                });
                $("#is_any_other_security_no").click(function() {
//$("#otherSecurityOther").collapse("show");
});
                $("#security_2").click(function() {
                    $(".form-control").val("");
                    $(".form-control").select2("val", "");
                    $('input:checkbox').removeAttr('checked');
                    $("#receivable_0").collapse("hide");
                    $("#equipmentsMainHead").collapse("hide");
                    $("#security_0").collapse("hide");
                    $("#inventoryHead").collapse("hide");
                    $("#otherSecurityOther").collapse("hide");
                    $("#addBuyer").collapse("hide");
                    $("#is_any_other_security_no").collapse("hide");
                });
                $("#security_3").click(function() {
                    $(".form-control").val("");
                    $(".form-control").select2("val", "");
                    $('input:checkbox').removeAttr('checked');
                    $("#receivable_0").collapse("hide");
                    $("#equipmentsMainHead").collapse("hide");
                    $("#inventoryHead").collapse("hide");
                    $("#otherSecurityOther").collapse("show");
                    $("#addBuyer").collapse("hide");
                    $("#is_any_other_security_no").collapse("hide");
                });
                $("#anyOthersecurity_yes").click(function () {
                    $("#que24").collapse("show");
                });
                $("#anyOthersecurity_no").click(function () {
                    $("#que24").collapse("hide");
                });
                $("#security_no").click(function () {
                    $(".anyOtherSecurityHead").collapse("show");
                });
                $("#is_any_other_security_yes").click(function () {
                    $("#anyOtherSecurity").collapse("show");
                });
                $("#is_any_other_security_no").click(function () {
                    $("#anyOtherSecurity").collapse("hide");
                    $("#receivable_0").collapse("hide");
                    $("#equipmentsMainHead").collapse("hide");
                    $("#inventoryHead").collapse("hide");
                    $("#otherSecurityOther").collapse("hide");
                });
                $("#security_2").click(function () {
                    $("#inventoryHead").collapse("show");
                });
                $("#security_2").click(function () {
                    $("#inventoryHead").collapse("show");
                });
            /* $("#security_3").click(function () {
            $("#otherSecurityOther").collapse("show");
        });*/
            /* $("#security_0").click(function () {
            $("#others_text").hide();
            });
            $("#security_1").click(function () {
            $("#others_text").hide();
            });
            $("#security_2").click(function () {
            $("#others_text").hide();
            });
            $("#security_3").click(function () {
            $("#others_text").hide();
            });
            $("#security_4").click(function () {
            $("#others_text").hide();
            });
            $("#security_5").click(function () {
            $("#others_text").show();
        });*/
            //          Details of Equipment being Purchased
            $("#imported_sourced").click(function () {
                $("#equipment_sourced_imported").collapse("show");
                $("#equipment_sourced_domestically_sourced").collapse("hide");
            });
            $("#domestically_sourced").click(function () {
                $("#equipment_sourced_imported").collapse("hide");
                $("#equipment_sourced_domestically_sourced").collapse("show");
            });
            $("#type_of_equipment").change(function () {
                if($(this).val() == "Others"){
                    $("#type_of_equipment_others").val("");
                    $("#otherEquipmentTypeDiv").collapse("show");
                }else{
                    $("#type_of_equipment_others").val("");
                    $("#otherEquipmentTypeDiv").collapse("hide");
                }
            });
            if($("#type_of_collateral").val() == 'Commercial'){
                var div = document.getElementById('showDocuments');
                div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?> </label>';
                @if(isset($model['avl_doc_name_1']) && $model['avl_doc_name_1'] == 'Last Property Valuation Report' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox "><input name="avl_doc_name_1"  type="checkbox" class="securityCheckbx-input chkbx" value="Last Property Valuation Report" checked {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" type="checkbox" class="securityCheckbx-input chkbx" value="Last Property Valuation Report" {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_2']) && $model['avl_doc_name_2'] == 'Property Title Search Report' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" checked {{$setDisable}}><b>Property Title Search Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" {{$setDisable}}><b>Property Title Search Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_3']) && $model['avl_doc_name_3'] == 'OC' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" class="securityCheckbx-input chkbx" value="OC" checked {{$setDisable}}><b>OC</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" value="OC" {{$setDisable}}><b>OC</b></label>';
                @endif
                @if(isset($model['avl_doc_name_4']) && $model['avl_doc_name_4'] == 'Municipal Plan' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="Municipal Plan" checked {{$setDisable}}><b>Municipal Plan</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="Municipal Plan" {{$setDisable}}><b>Municipal Plan</b></label>';
                @endif
                @if(isset($model['avl_doc_name_5']) && $model['avl_doc_name_5'] == 'Society NOC' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" class="securityCheckbx-input chkbx" value="Society NOC" checked {{$setDisable}}><b>Society NOC</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" value="Society NOC" {{$setDisable}}><b>Society NOC</b></label>';
                @endif
                @if(isset($model['avl_doc_name_6']) && $model['avl_doc_name_6'] == 'Property Tax card' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox" class="securityCheckbx-input chkbx" value="Property Tax card" checked {{$setDisable}}><b>Property Tax card</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox" class="securityCheckbx-input chkbx" value="Property Tax card" {{$setDisable}}><b>Property Tax card</b></label>';
                @endif
                @if(isset($model['avl_doc_name_7']) && $model['avl_doc_name_7'] == 'Sale /Purchase Deed' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase Deed" checked {{$setDisable}}><b>Sale/Purchase Deed</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase Deed" {{$setDisable}}><b>Sale/Purchase Deed</b></label>';
                @endif
                @if(isset($model['avl_doc_name_8']) && $model['avl_doc_name_8'] == 'Electricity Bill' && $model['collateral_type'] == 'Commercial')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox" class="securityCheckbx-input chkbx" value="Electricity Bill" checked {{$setDisable}}><b>Electricity Bill</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox" class="securityCheckbx-input chkbx" value="Electricity Bill" {{$setDisable}}><b>Electricity Bill</b></label>';
                @endif
            }else if($("#type_of_collateral").val() == 'Residential'){
                var div = document.getElementById('showDocuments');
                div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                @if(isset($model['avl_doc_name_1']) && $model['avl_doc_name_1'] == 'Last Property Valuation Report' && $model['collateral_type'] == 'Residential')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report" checked {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report" {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_2']) && $model['avl_doc_name_2'] == 'Property Title Search Report' && $model['collateral_type'] == 'Residential')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" checked {{$setDisable}}><b>Property Title Search Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" {{$setDisable}}><b>Property Title Search Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_3']) && $model['avl_doc_name_3'] == 'OC' && $model['collateral_type'] == 'Residential')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" class="securityCheckbx-input chkbx" value="OC" checked {{$setDisable}}><b>OC</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" class="securityCheckbx-input chkbx" value="OC" {{$setDisable}}><b>OC</b></label>';
                @endif
                @if(isset($model['avl_doc_name_4']) && $model['avl_doc_name_4'] == 'Municipal Plan' && $model['collateral_type'] == 'Residential')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="Municipal Plan" checked {{$setDisable}}><b>Municipal Plan</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="Municipal Plan" {{$setDisable}}><b>Municipal Plan</b></label>';
                @endif
                @if(isset($model['avl_doc_name_5']) && $model['avl_doc_name_5'] == 'Society NOC' && $model['collateral_type'] == 'Residential')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" class="securityCheckbx-input chkbx" value="Society NOC" checked {{$setDisable}}><b>Society NOC</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" class="securityCheckbx-input chkbx" value="Society NOC" {{$setDisable}}><b>Society NOC</b></label>';
                @endif
                @if(isset($model['avl_doc_name_6']) && $model['avl_doc_name_6'] == 'Property Tax card' && $model['collateral_type'] == 'Residential')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox" class="securityCheckbx-input chkbx" value="Property Tax card" checked {{$setDisable}}><b>Property Tax card</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox" class="securityCheckbx-input chkbx" value="Property Tax card" {{$setDisable}}><b>Property Tax card</b></label>';
                @endif
                @if(isset($model['avl_doc_name_7']) && $model['avl_doc_name_7'] == 'Sale /Purchase Deed' && $model['collateral_type'] == 'Residential')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase Deed" checked {{$setDisable}}><b>Sale/Purchase Deed</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase Deed" {{$setDisable}}><b>Sale/Purchase Deed</b></label>';
                @endif
                @if(isset($model['avl_doc_name_8']) && $model['avl_doc_name_8'] == 'Electricity Bill' && $model['collateral_type'] == 'Residential')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox" class="securityCheckbx-input chkbx" value="Electricity Bill" checked {{$setDisable}}><b>Electricity Bill</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox" class="securityCheckbx-input chkbx" value="Electricity Bill" {{$setDisable}}><b>Electricity Bill</b></label>';
                @endif
            }else if($("#type_of_collateral").val() == 'Land Non-Agri'){
                var div = document.getElementById('showDocuments');
                div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                @if(isset($model['avl_doc_name_1']) && $model['avl_doc_name_1'] == 'Last Property Valuation Report' && $model['collateral_type'] == 'Land Non-Agri')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report" checked {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report" {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_2']) && $model['avl_doc_name_2'] == 'Property Title Search Report' && $model['collateral_type'] == 'Land Non-Agri')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" checked {{$setDisable}}><b>Property Title Search Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" {{$setDisable}}><b>Property Title Search Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_3']) && $model['avl_doc_name_3'] == '7/12 extract' && $model['collateral_type'] == 'Land Non-Agri')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" class="securityCheckbx-input chkbx" value="7/12 extract" checked {{$setDisable}}><b>7/12 extract</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" class="securityCheckbx-input chkbx" value="7/12 extract" {{$setDisable}}><b>7/12 extract</b></label>';
                @endif
                @if(isset($model['avl_doc_name_4']) && $model['avl_doc_name_4'] == 'NA certificate' && $model['collateral_type'] == 'Land Non-Agri')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="NA certificate" checked {{$setDisable}}><b>NA certificate</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="NA certificate" {{$setDisable}}><b>NA certificate</b></label>';
                @endif
                @if(isset($model['avl_doc_name_5']) && $model['avl_doc_name_5'] == 'Sale/Purchase deed' && $model['collateral_type'] == 'Land Non-Agri')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase deed" checked {{$setDisable}}><b>Sale/Purchase deed</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase deed" {{$setDisable}}><b>Sale/Purchase deed</b></label>';
                @endif
            }else if($("#type_of_collateral").val() == 'Land Agri'){
                var div = document.getElementById('showDocuments');
                div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                @if(isset($model['avl_doc_name_1']) && $model['avl_doc_name_1'] == 'Last Property Valuation Report' && $model['collateral_type'] == 'Land Agri')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" type="checkbox" class="securityCheckbx-input chkbx" value="Last Property Valuation Report" checked {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" type="checkbox" class="securityCheckbx-input chkbx" value="Last Property Valuation Report" {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_2']) && $model['avl_doc_name_2'] == 'Property Title Search Report' && $model['collateral_type'] == 'Land Agri')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" checked {{$setDisable}}><b>Property Title Search Report</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox" class="securityCheckbx-input chkbx" value="Property Title Search Report" {{$setDisable}}><b>Property Title Search Report</b></label>';
                @endif
                @if(isset($model['avl_doc_name_3']) && $model['avl_doc_name_3'] == '7/12 extract' && $model['collateral_type'] == 'Land Agri')
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" class="securityCheckbx-input chkbx" value="7/12 extract" checked {{$setDisable}}><b>7/12 extract</b></label>';
                @else
                div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox" class="securityCheckbx-input chkbx" value="7/12 extract" {{$setDisable}}><b>7/12 extract</b></label>';
                @endif
                @if(isset($model['avl_doc_name_4']) && $model['avl_doc_name_4'] == 'NA certificate' && $model['collateral_type'] == 'Land Agri')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="NA certificate" checked {{$setDisable}}><b>NA certificate</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox" class="securityCheckbx-input chkbx" value="NA certificate" {{$setDisable}}><b>NA certificate</b></label>';
                @endif
                @if(isset($model['avl_doc_name_5']) && $model['avl_doc_name_5'] == 'Sale/Purchase deed' && $model['collateral_type'] == 'Land Agri')
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase deed" checked {{$setDisable}}><b>Sale/Purchase deed</b></label>';
                @else
                div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox" class="securityCheckbx-input chkbx" value="Sale/Purchase deed" {{$setDisable}}><b>Sale/Purchase deed</b></label>';
                @endif
            }
            $("#type_of_collateral").change(function () {
                if($(this).val() == 'Residential') {
                    var div = document.getElementById('showDocuments');
                    div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" type="checkbox" class="securityCheckbx-input chkbx" value="Last Property Valuation Report"><b>Last Property Valuation Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Title Search Report"><b>Property Title Search Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox"  class="securityCheckbx-input chkbx" value="OC"><b>OC</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox"  class="securityCheckbx-input chkbx" value="Municipal Plan"><b>Municipal Plan</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox"  class="securityCheckbx-input chkbx" value="Society NOC"><b>Society NOC</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Tax card"><b>Property Tax card</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox"  class="securityCheckbx-input chkbx" value="Sale/Purchase Deed"><b>Sale/Purchase Deed</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox"  class="securityCheckbx-input chkbx" value="Electricity Bill"><b>Electricity Bill</b></label>';
                } if($(this).val() == 'Commercial') {
                    var div = document.getElementById('showDocuments');
                    div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" type="checkbox" class="securityCheckbx-input chkbx" value="Last Property Valuation Report"><b>Last Property Valuation Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Title Search Report"><b>Property Title Search Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox"  class="securityCheckbx-input chkbx" value="OC"><b>OC</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox"  class="securityCheckbx-input chkbx" value="Municipal Plan"><b>Municipal Plan</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox"  class="securityCheckbx-input chkbx" value="Society NOC"><b>Society NOC</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Tax card"><b>Property Tax card</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox"  class="securityCheckbx-input chkbx" value="Sale/Purchase Deed"><b>Sale/Purchase Deed</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox"  class="securityCheckbx-input chkbx" value="Electricity Bill"><b>Electricity Bill</b></label>';
                } if($(this).val() == 'Land Non-Agri') {
                    var div = document.getElementById('showDocuments');
                    div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report"><b>Last Property Valuation Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Title Search Report"><b>Property Title Search Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox"  class="securityCheckbx-input chkbx" value="7/12 extract"><b>7/12 extract</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox"  class="securityCheckbx-input chkbx" value="NA certificate"><b>NA certificate</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox"  class="securityCheckbx-input chkbx" value="Sale/Purchase deed"><b>Sale/Purchase deed</b></label>';
                }if($(this).val() == 'Land Agri') {
                    var div = document.getElementById('showDocuments');
                    div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report"><b>Last Property Valuation Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Title Search Report"><b>Property Title Search Report</b></label>';
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox"  class="securityCheckbx-input chkbx" value="7/12 extract"><b>7/12 extract</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox"  class="securityCheckbx-input chkbx" value="NA certificate"><b>NA certificate</b></label>';
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_5" type="checkbox"  class="securityCheckbx-input chkbx" value="Sale/Purchase deed"><b>Sale/Purchase deed</b></label>';
                }if($(this).val() == 'Industrial'){
                    var div = document.getElementById('showDocuments');
                    var div = document.getElementById('showDocuments');
                    div.innerHTML = ' <label for="owner">Which of the following documents are available for the collateral <?php echo $removeMandatory; ?></label>';
                    @if(isset($model['avl_doc_name_1']) && $model['avl_doc_name_1'] == 'Last Property Valuation Report' && $model['collateral_type'] == 'Residential')
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report" checked {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                    @else
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_1" class="securityCheckbx-input chkbx" type="checkbox" value="Last Property Valuation Report" {{$setDisable}}><b>Last Property Valuation Report</b></label>';
                    @endif
                    @if(isset($model['avl_doc_name_2']) && $model['avl_doc_name_2'] == 'Property Title Search Report' && $model['collateral_type'] == 'Residential')
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Title Search Report" checked {{$setDisable}}><b>Property Title Search Report</b></label>';
                    @else
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_2" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Title Search Report" {{$setDisable}}><b>Property Title Search Report</b></label>';
                    @endif
                    @if(isset($model['avl_doc_name_3']) && $model['avl_doc_name_3'] == 'OC' && $model['collateral_type'] == 'Residential')
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox"  class="securityCheckbx-input chkbx" value="OC" checked {{$setDisable}}><b>OC</b></label>';
                    @else
                    div.innerHTML += '<label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_3" type="checkbox"  class="securityCheckbx-input chkbx" value="OC" {{$setDisable}}><b>OC</b></label>';
                    @endif
                    @if(isset($model['avl_doc_name_4']) && $model['avl_doc_name_4'] == 'Municipal Plan' && $model['collateral_type'] == 'Residential')
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox"  class="securityCheckbx-input chkbx" value="Municipal Plan" checked {{$setDisable}}><b>Municipal Plan</b></label>';
                    @else
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_4" type="checkbox"  class="securityCheckbx-input chkbx" value="Municipal Plan" {{$setDisable}}><b>Municipal Plan</b></label>';
                    @endif
                    @if(isset($model['avl_doc_name_6']) && $model['avl_doc_name_6'] == 'PropertypropertyIsTax card' && $model['collateral_type'] == 'Residential')
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Tax card" checked {{$setDisable}}><b>Property Tax card</b></label>';
                    @else
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_6" type="checkbox"  class="securityCheckbx-input chkbx" value="Property Tax card" {{$setDisable}}><b>Property Tax card</b></label>';
                    @endif
                    @if(isset($model['propertyIs']) && $model['avl_doc_name_7'] == 'Sale /Purchase Deed' && $model['collateral_type'] == 'Residential')
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox"  class="securityCheckbx-input chkbx" value="Sale/Purchase Deed" checked {{$setDisable}}><b>Sale/Purchase Deed</b></label>';
                    @else
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_7" type="checkbox"  class="securityCheckbx-input chkbx" value="Sale/Purchase Deed" {{$setDisable}}><b>Sale/Purchase Deed</b></label>';
                    @endif
                    @if(isset($model['avl_doc_name_8']) && $model['avl_doc_name_8'] == 'Electricity Bill' && $model['collateral_type'] == 'Residential')
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox"  class="securityCheckbx-input chkbx" value="Electricity Bill" checked {{$setDisable}}><b>Electricity Bill</b></label>';
                    @else
                    div.innerHTML += ' <label style="padding-left:8px;text-align: left; padding-bottom: 15px;" class="checkbox"><input name="avl_doc_name_8" type="checkbox"  class="securityCheckbx-input chkbx" value="Electricity Bill" {{$setDisable}}><b>Electricity Bill</b></label>';
                    @endif
                }
            });
});
                // Hidden Field Counter Variable
                var counter = 0;       
                 // If any existing Record in database    
                 var existing_records = {{$payment_count}};
                 var add_button = jQuery("#add_payment_terms");
                 var delete_button = jQuery("#rem_payment_terms");
                 var no_of_opened_containers = $("#no_of_opened_containers").val();
                 $("#counter_storage").val(existing_records);
                 if (counter == 0) {
                    $(delete_button).hide();
                }
                        //=========================================
                         // Hidden Field Counter Variable
                         var counter_rec = 0;
                        // If any existing Record in database
                        var existing_records_rec = {{$receivable_count}}; 
                        var add_button_rec = jQuery("#add_receivable_discount");
                        var delete_button_rec = jQuery("#rem_receivable_discount");
                        var no_of_rec_opened_containers = $("#no_of_rec_opened_containers").val();
                        $("#rec_counter_storage").val(existing_records_rec);
                        if (counter_rec == 0) {
                            $(delete_button_rec).hide();
                        }
                        $(add_button_rec).click(function (e) {
                            e.preventDefault();
                            counter_rec++;
                            existing_records_rec++;
                            $("#receivable_" + counter_rec).collapse("show");
                            jQuery("#rem_payment_terms_"+counter_rec).hide();
                            $("#counter_storage").val(existing_records_rec);
                            if (counter_rec == 2) {
                                $(this).hide();
                            }
                            if (counter_rec > 0) {
                                $(delete_button_rec).show();
                            }
                            $("#receivable_count").val(counter_rec);
                        });
                        $(delete_button_rec).click(function (e) {
                            e.preventDefault();
                            $("#receivable_" + counter_rec).collapse("hide");
                            counter_rec--;
                            existing_records_rec--;
                            $("#counter_storage").val(existing_records_rec);
                            if (counter_rec == 0) {
                                $(delete_button_rec).hide();
                                $("#address_" + counter_rec).collapse("hide");
                            }
                            if (counter_rec < 4) {
                                $(add_button_rec).show();
                            }
                            $("#receivable_count").val(counter_rec);
                        });
                        var cnt1 = 0;
                        var cnt2 = 0;
                        var cnt3 = 0;
                        cnt1 = {{$receivables0InvoiceCounter}};
                        cnt2 = {{$receivables1InvoiceCounter}};
                        cnt3 = {{$receivables2InvoiceCounter}};
                        if(cnt1==0){
                            jQuery("#rem_payment_terms_"+cnt1).hide();
                        }
                        $('#payment_terms_'+cnt1+'_'+cnt1).select2({
                            allowClear: true,
                            placeholder: "Select Option"
                        });
                        $('#payment_terms_'+(cnt2+1)+'_'+cnt2).select2({
                            allowClear: true,
                            placeholder: "Select Option"
                        });
                        $('#payment_terms_'+(cnt2+2)+'_'+cnt2).select2({
                            allowClear: true,
                            placeholder: "Select Option"
                        });
                        function myfunction(ws_id){
                            if(cnt1==0){
                                jQuery("#rem_payment_terms_"+ws_id).hide();
                            }
                            if(ws_id==0){
                                cnt1++;
                                $('#payment_terms_'+ws_id+'_'+cnt1).select2({
                                    allowClear: true,
                                    placeholder: "Select Option"
                                });
                                $("#by_"+ws_id+"_payment_terms_"+ cnt1).collapse("show");
                                if(cnt1 > 0){
                                    jQuery("#rem_payment_terms_"+ws_id).show();
                                }
                               // alert(cnt1);
                               if(cnt1==4){
                                jQuery("#add_payment_terms_"+ws_id).hide();
                            }
                            $("#receivables0InvoiceCounter").val(cnt1);
                        }
                        if(ws_id ==1){
                            cnt2++;
                            $('#payment_terms_'+ws_id+'_'+cnt2).select2({
                                allowClear: true,
                                placeholder: "Select Option"
                            });
                            $("#by_"+ws_id+"_payment_terms_"+ cnt2).collapse("show");
                            if(cnt2 > 0){
                                jQuery("#rem_payment_terms_"+ws_id).show();
                            }
                            if(cnt2==4){
                                jQuery("#add_payment_terms_"+ws_id).hide();
                            }
                            // alert(cnt2);
                            $("#receivables1InvoiceCounter").val(cnt2);
                        }
                        if(ws_id ==2){
                            cnt3++;
                            $('#payment_terms_'+ws_id+'_'+cnt3).select2({
                                allowClear: true,
                                placeholder: "Select Option"
                            });
                            $("#by_"+ws_id+"_payment_terms_"+ cnt3).collapse("show");
                            if(cnt3 > 0){
                                jQuery("#rem_payment_terms_"+ws_id).show();
                            }
                            if(cnt3==4){
                                jQuery("#add_payment_terms_"+ws_id).hide();
                            }
                            $("#receivables2InvoiceCounter").val(cnt3);
                        }
                        //            $("#receivables0InvoiceCounter").val(cnt1);
                        //            $("#receivables1InvoiceCounter").val(cnt2);
                        //            $("#receivables2InvoiceCounter").val(cnt3);
                        // console.log($("#receivables0InvoiceCounter").val());
                    }
                    function myFunctionDelete(del_id){
                        if(del_id==0){
                            $("#by_"+del_id+"_payment_terms_"+ cnt1).collapse("hide");
                            cnt1--;
                            if(cnt1 == 0){
                                jQuery("#rem_payment_terms_"+del_id).hide();
                                jQuery("#add_payment_terms_"+del_id).show();
                            }else if(cnt1 > 0){
                                jQuery("#add_payment_terms_"+del_id).show();
                            }
                            $("#receivables0InvoiceCounter").val(cnt1);
                        }
                        if(del_id==1){
                            $("#by_"+del_id+"_payment_terms_"+ cnt2).collapse("hide");
                            cnt2--;
                            if(cnt2 == 0){
                                jQuery("#rem_payment_terms_"+del_id).hide();
                                jQuery("#add_payment_terms_"+del_id).show();
                            }else if(cnt2 > 0){
                                jQuery("#add_payment_terms_"+del_id).show();
                            }
                            $("#receivables1InvoiceCounter").val(cnt2);
                        }
                        if(del_id==2){
                            $("#by_"+del_id+"_payment_terms_"+ cnt3).collapse("hide");
                            cnt3--;
                            if(cnt3 == 0){
                                jQuery("#rem_payment_terms_"+del_id).hide();
                                jQuery("#add_payment_terms_"+del_id).show();
                            }else if(cnt3 > 0){
                                jQuery("#add_payment_terms_"+del_id).show();
                            }
                            $("#receivables2InvoiceCounter").val(cnt3);
                        }
                    }
                    function sum() {
                        var txtFirstNumberValue = document.getElementById('txt1').value;
                        var txtSecondNumberValue = document.getElementById('txt2').value;
                        var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
                        if (!isNaN(result)) {
                            document.getElementById('txt3').value = result;
                        }
                    }
                </script>
                <script>
                    $( function() {
                        $('#datepickerEquipment').datepicker({
                            changeMonth: true,
                            changeYear: true,
                            showButtonPanel: true,
                            dateFormat: 'MM-yy',
                            yearRange: '1980:2016',
                            monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
                            monthNamesShort: ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"],
                            onClose: function(dateText, inst) {
                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                $(this).datepicker('setDate', new Date(year, month, 1));
                            },
                        })
                    } );
                </script>
