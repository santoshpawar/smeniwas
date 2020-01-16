 <style>
 .sharePop {
    background: #083b82;
    font-size: 16px;
    padding: 5px;
    color: white;
    animation: blinker 7s linear infinite;
}
@keyframes blinker {
  50% { opacity: 0; }
}
</style>
{!! isset($companySharePledged) ? "<div class='sharePop text-center'>Please provide information regarding  <strong>".$companySharePledged."</strong> who's share are being pledged</div>":""  !!}
@if(isset($companySharePledged))
{!! Form::hidden('companySharePledged', $companySharePledged) !!}
@endif
@if(isset($bscNscCode))
{!! Form::hidden('bscNscCode', $bscNscCode) !!}
@endif
<div class="container-fluid">
   <div class="row">
       <div class="card">
           <div class="card-header" data-background-color="green">
               <h4 class="title">Background Details <span class="pull-right"> {{ @$userProfileFirm->name_of_firm }}</span></h4>
           </div>
           <div class="card-content">
            <div class="col-md-12">
                <div class="tab-content tab-design">
                    <div class="btn-group leftside_tab" data-toggle="tab" style="margin-left:10px;">
                        <a id="lnkLoanDtls1" href="#" class="btn btn-large btn-success btn-space active">KYC Details</a>
                        <a id="lnkLoanDtls2" href="#" class="btn btn-large btn-success btn-space disabled">Business Background</a>
                        {{--
                        <a id="lnkLoanDtls3" href="#" class="btn btn-large btn-success btn-space disabled">Customer/Sales Details</a>
                        --}}
                    </div>
                    <div class="tab-pane active" id="CompanyBackground" style="">
                        @if($deletedQuestionHelper->isQuestionValid("A1"))
                        {!! Form::hidden('id',null) !!}
                        <div class="row" id="divTab_sub1" >
                            <div class="col-lg-12" style="padding-top: 15px; ">
                             @if($deletedQuestionHelper->isQuestionValid("A1.1"))
                             <div class="col-md-6">
                                {!! Form::label('com_business_type', 'Select Business Type') !!}
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                @if(isset($businessType))
                                {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], $businessType, ['class' => 'form-control','id'=>'businessType','data-mandatory'=>'M' ,$setDisable])!!}
                                @else
                                {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], null, ['class' => 'form-control','id'=>'businessType','data-mandatory'=>'M' ,$setDisable])!!}
                                @endif
                            </div>
                            @endif
                            <div class="col-md-6" >
                                {!! Form::label('gst','GST', ['class'=>'form-label']) !!}
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                {!! Form::text('gst', $loan['gst'], array('class' => 'form-control', 'id'=>'gst', 'placeholder'=>'GST Registration Number', $setDisable)) !!}
                            </div>
                            {{-- @if($deletedQuestionHelper->isQuestionValid("A1.2"))
                            <div class="col-md-6" >
                                {!! Form::label('com_vat','VAT', ['class'=>'form-label']) !!}
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                  {!! Form::text('com_vat', null, array('class' => 'form-control', 'id'=>'vat_no1', 'placeholder'=>'VAT Registration Number',$setDisable)) !!}
                                {!! Form::text('com_vat_1', $loan['com_vat'], array('class' => 'form-control', 'id'=>'vat_no2', 'placeholder'=>'VAT Registration Number', $setDisable)) !!}
                            </div>
                            @endif --}}
                            @if(isset($userProfile) && $userProfile->owner_entity_type == 'Pvt Ltd Company')
                            @if($deletedQuestionHelper->isQuestionValid("A1.3"))
                            <div class="col-md-6" style="">
                                {!! Form::label('com_cin_no','CIN', ['class'=>'control-label']) !!}
                                @if(isset($mobileFirmRegNo))
                                @if(isset($userProfile) && $userProfile->owner_entity_type == 'Pvt Ltd Company')
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                {!! Form::text('com_cin_no', $mobileFirmRegNo, array('class' => 'form-control', 'id'=>'cin_no', 'placeholder'=>'Certificate of Incorporation Number','data-mandatory'=>'M' ,$setDisable)) !!}
                                @else
                                {!! Form::text('com_cin_no', $mobileFirmRegNo, array('class' => 'form-control', 'id'=>'cin_no', 'placeholder'=>'Certificate of Incorporation Number', $setDisable)) !!}
                                @endif
                                @else
                                @if(isset($userProfile) && $userProfile->owner_entity_type == 'Pvt Ltd Company')
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                {!! Form::text('com_cin_no', null, array('class' => 'form-control', 'id'=>'cin_no', 'placeholder'=>'Certificate of Incorporation Number','data-mandatory'=>'M' ,$setDisable)) !!}
                                @else
                                {!! Form::text('com_cin_no', null, array('class' => 'form-control', 'id'=>'cin_no', 'placeholder'=>'Certificate of Incorporation Number', $setDisable)) !!}
                                @endif
                                @endif
                            </div>
                            @endif
                            @endif
                            @if($deletedQuestionHelper->isQuestionValid("A1.4"))
                           {{--  <div class="col-md-6" style="">
                                {!! Form::label('com_service_tax_no','Service Tax', ['class'=>'control-label']) !!}
                                {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                {!! Form::text('com_service_tax_no', null, array('class' => 'form-control', 'id'=>'service_tax_no', 'placeholder'=>'Service Tax Registration Number' ,$setDisable)) !!}
                            </div> --}}
                            @endif
                                          {{--  @if(isset($userProfile))
                                            <div class="col-md-6" style="">
                                                {!! Form::label('name_of_firm','Company Name', ['class'=>'control-label']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                                {!! Form::text('name_of_firm',  isset($userProfile->name_of_firm)? $userProfile->name_of_firm:null, array('class' => 'form-control', 'id'=>'name_of_firm', 'placeholder'=>'Company Name','data-mandatory'=>'M' ,$setDisable)) !!}
                                            </div>
                                            @endif --}}
                                        </div>
                                    </div>
                                    @endif
                                    
                                    {{--======Start DivSub 2=============================================================================--}}
                                    @if($deletedQuestionHelper->isQuestionValid("A2"))
                                    <div class="row" id="divTab_sub2">
                                        <div class="col-lg-12" style="padding-top: 15px; ">
                                            @if($deletedQuestionHelper->isQuestionValid("A2.1"))
                                            <div class="col-xs-6 col-sm-4 col-md-6" style="">
                                                {!! Form::label('com_industry_segment', 'Select Industry Segment') !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                {!! Form::select('com_industry_segment', $industryTypes, null, ['class' => 'form-control', 'id' => 'industry_segment','data-mandatory'=>'M' ,$setDisable])!!}
                                            </div>
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("A2.2"))
                                            <div class="col-xs-6 col-sm-4 col-md-6" style="padding-bottom: 27px;" id="manufacturing_location">
                                                {!! Form::label('com_number_mfglocations', 'Number of Manufacturing locations of your business',['class'=>'control-label',$setDisable]) !!}
                                                <br>
                                                <label class="radio-inline">
                                                    {!! Form::radio('com_number_mfglocations', 'option_1', true, ['id' => 'mfgradio_option_1']) !!}
                                                    1
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('com_number_mfglocations', 'option_2', false, ['id' => 'mfgradio_option_2']) !!}
                                                    2 - 4
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('com_number_mfglocations', 'option_3', false, ['id' => 'mfgradio_option_3']) !!}
                                                    > 4
                                                </label>
                                            </div>
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("A2.3") && $isSME!=1)
                                            <div class="col-xs-6 col-sm-4 col-md-6" style="padding-bottom: 20px;">
                                                {!! Form::label('com_number_officebranch','Number of Office Branches', ['class'=>'control-label']) !!}
                                                {!! Form::text('com_number_officebranch', null, array('class' => 'form-control amount', 'id'=>'no_ofc_branch', 'placeholder'=>'Number of Office Branches',$setDisable)) !!}
                                            </div>
                                            @else
                                            {!! Form::hidden('com_number_officebranch',null) !!}
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("A2.4"))
                                            <div class="col-xs-6 col-sm-4 col-md-6" style="padding-bottom: 22px">
                                                {!! Form::label('com_co_business_old', 'How many years old is the business/company?') !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                                {!! Form::select('com_co_business_old', $businessVintage,null,['class' => 'form-control','id'=>'business_old','data-mandatory'=>'M' ,$setDisable]) !!}
                                            </div>
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("A2.5") && $isSME!=1)
                                            <div class="col-xs-6 col-sm-4 col-md-6" style="padding-bottom: 6px;">
                                                <div class="form-group col-md-12">
                                                    {!! Form::label('sales_area_type', 'What is your geographical area of Operation / Sales') !!}
                                                    {!! Form::select('sales_area_type', array(''=>'','3' => 'Please select','0' => 'City', '1' => 'Multiple City Single State', '2' => 'Multi State'), isset($salesAreaDetails->sales_area_type) ? $salesAreaDetails->sales_area_type : null , ['id' => 'que30_geographical_area', 'style' => '','class'=>'col-md-12',$setDisable]) !!}
                                                </div>
                                                <div class="col-md-12" style="padding-left: 0px !important">
                                                    <div class="row collapse" id="one_city">
                                                        <div class="col-md-8" style="padding-left: 31px;">
                                                            <div class="form-group">
                                                                {!! Form::label('city_name', 'City Name') !!}
                                                                {{--{!! Form::text('city_name', isset($salesAreaDetails->city_name) ? $salesAreaDetails->city_name : null, ['class' => 'form-control', 'placeholder' => 'Enter City'])!!}--}}
                                                                {!! Form::select('city_name',$cities,isset($salesAreaDetails->city_name) ? $salesAreaDetails->city_name : null, ['id' => 'city_name' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}
                                                            </div>
                                                            <div class="form-group collapse" id="custom_cityName">
                                                                {!! Form::label('city_name', 'City Name') !!}
                                                                {!! Form::text('city_name_other', isset($salesAreaDetails->city_name_other) ? $salesAreaDetails->city_name_other : null, ['id'=>'custom_cityNamebox','class' => 'form-control', 'placeholder' => 'Enter City','data-mandatory'=>'M',$setDisable])!!}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                    </div>
                                                    <div class="panel panel-success collapse" id="multiple_cities">
                                                        <div class="panel-heading">Enter City Names</div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {!! Form::label('city_name_1', 'City Name 1') !!}
                                                                    {!! Form::select('city_name_1',$cities, isset($salesAreaDetails->city_name_1) ? $salesAreaDetails->city_name_1 : null, ['id' => 'city_name_1' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}<br/>
                                                                    <div class="col-md-12 collapse" id="custom_cityName_1" style="padding-left: 0px;">
                                                                        {!! Form::label('city_name', 'City Name') !!}
                                                                        {!! Form::text('city_name_other_1', isset($salesAreaDetails->city_name_other_1) ? $salesAreaDetails->city_name_other_1 : null, ['id'=>'custom_cityNamebox_1','style' => 'width: 100%;','class' => 'form-control','data-mandatory'=>'M', 'placeholder' => 'Enter City',$setDisable])!!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {!! Form::label('city_name_2', 'City Name 2') !!}
                                                                    {!! Form::select('city_name_2',$cities, isset($salesAreaDetails->city_name_2) ? $salesAreaDetails->city_name_2 : null, ['id' => 'city_name_2' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                                    <div class="col-md-12 collapse" id="custom_cityName_2" style="padding-left: 0px;">
                                                                        {!! Form::label('city_name', 'City Name') !!}
                                                                        {!! Form::text('city_name_other_2', isset($salesAreaDetails->city_name_other_2) ? $salesAreaDetails->city_name_other_2 : null, ['id'=>'custom_cityNamebox_2','style' => 'width: 100%;','class' => 'form-control', 'placeholder' => 'Enter City','data-mandatory'=>'M',$setDisable])!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-success collapse" id="multiple_states">
                                                        <div class="panel-heading">Enter State Names</div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {!! Form::label('multi_state_1', 'State Name 1') !!}
                                                                    {!! Form::select('multi_state_1',$states, isset($salesAreaDetails->multi_state_1) ? $salesAreaDetails->multi_state_1 : null, ['id' => 'state_name_1' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {!! Form::label('multi_state_2', 'State Name 2') !!}
                                                                    {!! Form::select('multi_state_2',$states, isset($salesAreaDetails->multi_state_2) ? $salesAreaDetails->multi_state_2 : null, ['id' => 'state_name_2' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 collapse" id="state_name_3">
                                                                    {!! Form::label('multi_state_3', 'State Name 3') !!}
                                                                    {!! Form::select('multi_state_3',$states, isset($salesAreaDetails->multi_state_3) ? $salesAreaDetails->multi_state_3 : null, ['id' => 'state_name_3' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                                </div>
                                                                <div class="col-md-6 collapse" id="state_name_4">
                                                                    {!! Form::label('multi_state_4', 'State Name 4') !!}
                                                                    {!! Form::select('multi_state_4',$states, isset($salesAreaDetails->multi_state_4) ? $salesAreaDetails->multi_state_4 : null, ['id' => 'state_name_4' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 collapse" id="state_name_5">
                                                                    {!! Form::label('multi_state_5', 'State Name 5') !!}
                                                                    {!! Form::select('multi_state_5',$states,  isset($salesAreaDetails->multi_state_5) ? $salesAreaDetails->multi_state_5 : null, ['id' => 'state_name_5' , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-top:10px">
                                                                <div class="col-md-12">
                                                                    {!! Form::button('Add State', ['class' => 'btn btn-primary add_state',$setDisable])!!}
                                                                    {!! Form::button('Remove State', ['class' => 'btn btn-danger remove_state',$setDisable])!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            {!! Form::hidden('sales_area_type',null) !!}
                                            {!! Form::hidden('city_name',null) !!}
                                            {!! Form::hidden('city_name_1',null) !!}
                                            {!! Form::hidden('city_name_2',null) !!}
                                            {!! Form::hidden('multi_state_1',null) !!}
                                            {!! Form::hidden('multi_state_2',null) !!}
                                            {!! Form::hidden('multi_state_3',null) !!}
                                            {!! Form::hidden('multi_state_4',null) !!}
                                            {!! Form::hidden('multi_state_5',null) !!}
                                            @endif
                                            @if($companySharePledged=='')
                                            <div class="col-xs-6 col-sm-4 col-md-6" id="venture_fund">
                                                <div class="form-group col-md-12" style="padding-bottom:9px;">
                                                    {!! Form::label('com_venture_capital_funded', 'Is the company Venture Capital funded?',['class'=>'control-label',$setDisable]) !!}
                                                    <br>
                                                    <label class="radio-inline">
                                                        {!! Form::radio('com_venture_capital_funded', '1', false, ['id' => 'vcf_yes',$setDisable]) !!}
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        {!! Form::radio('com_venture_capital_funded', '0', true, ['id' => 'vcf_no',$setDisable]) !!}
                                                        No
                                                    </label>
                                                </div>
                                                <div class="col-md-12" style="padding-left: 0px !important">
                                                    <div class="row collapse" id="vc_fund_name">
                                                        <div class="col-md-12" style="padding-left: 31px;">
                                                            <div class="form-group">
                                                                {!! Form::label('com_name_of_vc_fund', 'Name of VC/PE Fund') !!}
                                                                {!! Form::text('com_name_of_vc_fund', null, ['class' => 'form-control','data-mandatory'=>'M', 'placeholder' => 'Enter VC/PE Fund Name'])!!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            {{-- Added by ManojK --}}
                                            @if($deletedQuestionHelper->isQuestionValid("A3.1") && $isSME!=1)
                                            <div class="col-md-6" style="padding-bottom: 22px;">
                                                {!! Form::label(null,'Are your Sales?') !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                <br>
                                                <label class="radio-inline">
                                                    {!! Form::radio('com_your_salestype', 'Domestic', true, ['id' => 'areyoursales_radio_option_1',$setDisable]) !!}
                                                    Domestic
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('com_your_salestype', 'Export', false, ['id' => 'areyoursales_radio_option_2',$setDisable]) !!}
                                                    Export
                                                </label>
                                                <label class="radio-inline">
                                                    {!! Form::radio('com_your_salestype', 'Both', false, ['id' => 'areyoursales_radio_option_3',$setDisable]) !!}
                                                    Both
                                                </label>
                                                @if(isset($comYourSalestype)&& $comYourSalestype == 'Export' || $comYourSalestype == 'Both')
                                                <div id="AnnualValueExport" class="collapse" style="  padding-top: 18px;">
                                                    <div class="panel panel-success" >
                                                        <div class="panel-heading">Annual Value of Exports</div>
                                                        <div class="panel-body">
                                                            <div>
                                                                {!! Form::label('com_annual_value_exports','Annual Value of Exports (') !!}
                                                                {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
                                                                {!! Form::label('export_amount',' In Lacs )') !!}
                                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                {!! Form::text('com_annual_value_exports', isset($comAnnualValueExport)? $comAnnualValueExport:null, array('class' => 'form-control',$setDisable)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div id="AnnualValueExport" class="collapse" style="  padding-top: 18px;">
                                                    <div class="panel panel-success" >
                                                        <div class="panel-heading">Annual Value of Exports</div>
                                                        <div class="panel-body">
                                                            <div>
                                                                {!! Form::label('com_annual_value_exports','Annual Value of Exports (') !!}
                                                                {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
                                                                {!! Form::label('export_amount',' In Lacs )') !!}
                                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                {!! Form::text('com_annual_value_exports', isset($comAnnualValueExport)? $comAnnualValueExport:null, array('class' => 'form-control',$setDisable)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            @else
                                            {!! Form::hidden('com_your_salestype',null) !!}
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("A3.2"))
                                            <div class="col-md-6 radio" style="padding-bottom: 15px; ">
                                                {!! Form::label('com_your_salestoa','Are Your Sales to a?', ['style'=>'padding-bottom:10px;margin-left:-30px;color:rgb(94, 76, 192)','class'=>'control-label']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                <br>
                                                @foreach ($userType as $Name=>$Value)
                                                <?php $val='Small & Medium Business';
                                                if($val==$Value){
                                                    $choosenSales=true;
                                                }else{
                                                 $choosenSales=NULL;
                                             }
                                             ?>
                                             <label class="radio-inline" style="margin-left: 5px;">
                                                {!! Form::radio('com_your_salestoa', $Value,$choosenSales,[$setDisable] ) !!}
                                                {{--     {!! Form::radio('com_venture_capital_funded', '0', true, ['id' => 'vcf_no']) !!} --}}
                                                {{{$Value}}}
                                            </label>
                                            @endforeach
                                        </div>
                                        @endif
                                        <!-- start D3.3 -->
                                        @if($deletedQuestionHelper->isQuestionValid("D3.3"))
                                        <div class="row" style="margin-left:10px">
                                            <div class="col-md-12">
                                               @if($choosenSales=="Large Company")
                                               <div id="yearQue37" class="form-group" style="margin-right: -5px;">
                                                @else
                                                <div id="yearQue37" class="form-group" style="display:none;margin-right: -5px;" >
                                                    @endif
                                                    <div id="topcust" class="panel panel-success">
                                                        <div class="panel-heading"><b><span id = "nameforlabel"></span></b>Customer Sales Details
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                        </div>
                                                        <div class="table-responsive" style="padding: 10px 10px 0px 10px;">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            {!! Form::label('owner','Customer Name') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        </th>
                                                                        <th>
                                                                            {!! Form::label('owner','Annual Sales Amount ( ') !!}
                                                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                                            {!! Form::label(null,' In Lacs )') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        </th>
                                                                        <th>
                                                                            {!! Form::label('owner','Relationship Since ( Year )') !!}
                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            {!! Form::text('top3_custname_1', (isset($model) && isset($model->top3_custname_1))? $model->top3_custname_1 : null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('top3_annsales_1', (isset($model) && isset($model->top3_annsales_1))? $model->top3_annsales_1 : null, array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::select('top3_relationsince_1', ['' => '','1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'],  (isset($model) && isset($model->top3_relationsince_1))? $model->top3_relationsince_1 : null, ['id' =>'relationship_since_1', 'style' => 'width: 100%;', 'class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {!! Form::text('top3_custname_2', (isset($model) && isset($model->top3_custname_2))? $model->top3_custname_2 : null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::text('top3_annsales_2', (isset($model) && isset($model->top3_annsales_2))? $model->top3_annsales_2 : null, array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}
                                                                        </td>
                                                                        <td>
                                                                            {!! Form::select('top3_relationsince_2', ['' => '','1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'], (isset($model) && isset($model->top3_relationsince_2))? $model->top3_relationsince_2 : null, ['id' =>'relationship_since_2', 'style' => 'width: 100%;', 'class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div >
                                        @endif
                                        @if($deletedQuestionHelper->isQuestionValid("A3.4"))
                                        <div class="col-md-12" style="padding-bottom: 15px; ">
                                            {!! Form::label('com_key_productservice_offered','Key Products/Services Offered (give brief description)') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            @if(isset($mobileKeyProduct))
                                            {!! Form::textarea('com_key_productservice_offered', isset($mobileKeyProduct)? $mobileKeyProduct:null, array('class' => 'form-control','id'=>'key_productservice_offered', 'placeholder' => 'Give brief description', 'size' => '10x3','data-mandatory'=>'M' ,$setDisable)) !!}
                                            @else
                                            {!! Form::textarea('com_key_productservice_offered', isset($key_products_manufactured)? $key_products_manufactured:null, array('class' => 'form-control','id'=>'key_productservice_offered', 'placeholder' => 'Give brief description', 'size' => '10x3','data-mandatory'=>'M' ,$setDisable)) !!}
                                            @endif
                                        </div>
                                        @endif
                                        <!-- end D3.3 -->
                                        {{-- Added by ManojK --}}
                                    </div>
                                </div>
                                @endif
                                {{--======Start DivSub 3=============================================================================--}}
                                @if(!$deletedQuestionHelper->isQuestionValid("A3"))
                                <div class="row" id="divTab_sub3">
                                    <div class="col-lg-12" style="padding-top: 15px; ">
                                    </div>
                                </div>
                                @endif
                                <div class="center-align" style="margin:0px 25px;"></div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-left:20px;">
                                        <div id="currentSection">
                                            {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                                            {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                                            {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
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
                </div>
            </div>
        </div>
    </div>
</div>
<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        var cnt = 1;
        $('#divTab_sub1').show();
        $('#divTab_sub2').hide();
        $('#divTab_sub3').hide();
        $('#saveDetails').hide();
        $('#raise_query').hide();
        $(lnkLoanDtls1).click(function () {
            $('#divTab_sub1').show();
            $('#currentSection').show();
            cnt=1;
            $('#divTab_sub2').hide();
            $('#divTab_sub3').hide();
            $('#backIn').hide();
            $('#nextIn').show();
            $(this).addClass("active").siblings().removeClass("active");
            $('#saveDetails').hide();
            $('#raise_query').hide();
        });
        $(lnkLoanDtls2).click(function () {
            $('#divTab_sub2').show();
            $('#currentSection').show();
            cnt=2;
            $('#divTab_sub1').hide();
            $('#divTab_sub3').hide();
            $('#nextIn').show();
            $('#backIn').show();
            $(this).addClass("active").siblings().removeClass("active");
            $('#saveDetails').hide();
            $('#raise_query').hide();
        });
            {{--
            $(lnkLoanDtls3).click(function () {
                $('#divTab_sub3').show();
                cnt=3;
                $('#divTab_sub1').hide();
                $('#divTab_sub2').hide();
                $('#nextIn').hide();
                $('#backIn').show();
                $(this).addClass("active").siblings().removeClass("active");
                $('#saveDetails').show();
                $('#raise_query').show();
            });
            --}}
            /*---- end toggle function*/
            if(cnt==1){
                $('#backIn').hide();
            }
            $("#nextIn").click(function (){
                if(cnt==1){
                    if($('#divTab_sub'+cnt).css('display') == 'block'){
                        if(validateForm('#divTab_sub'+cnt)){
                            $('#divTab_sub'+cnt).hide();
                            $('#lnkLoanDtls'+cnt).removeClass('active');
                            cnt++;
                            $('#lnkLoanDtls'+cnt).removeClass('disabled');
                            $('#lnkLoanDtls'+cnt).addClass('active');
                            $('#divTab_sub'+cnt).show();
                            $('#currentSection').show();
                            $('#backIn').show();
                            $('#nextIn').hide();
                            $('#saveDetails').show();
                            $('#raise_query').show();
                        }
                    }
                }
                else if(cnt==2){
                    if($('#divTab_sub'+cnt).css('display') == 'block'){
                        if(validateForm('#divTab_sub'+cnt)){
                            $('#divTab_sub'+cnt).hide();
                            $('#nextIn').hide();
                            $('#lnkLoanDtls'+cnt).removeClass('active');
                            cnt++;
                            $('#lnkLoanDtls'+cnt).removeClass('disabled');
                            $('#lnkLoanDtls'+cnt).addClass('active');
                            $('#divTab_sub'+cnt).show();
                            $('#backIn').show();
                            $('#saveDetails').show();
                            $('#raise_query').show();
                        }
                    }
                }
                else if(cnt==3){
                    if($('#divTab_sub'+cnt).css('display') == 'block'){
                        if(validateForm('#divTab_sub'+cnt)){
                            $('#divTab_sub'+cnt).hide();
                            $('#currentSection').hide();
                            $('#lnkLoanDtls'+cnt).removeClass('active');
                            cnt++;
                            $('#lnkLoanDtls'+cnt).removeClass('disabled');
                            $('#lnkLoanDtls'+cnt).addClass('active');
                            $('#divTab_sub'+cnt).show();
                            $('#saveDetails').show();
                            $('#raise_query').show();
                        }
                    }
                }
            });
            $("#backIn").click(function (){
                $('#nextIn').show();
                $('#divTab_sub'+cnt).hide();
                $('#lnkLoanDtls'+cnt).removeClass('active');
                cnt--;
                // alert(cnt);
                if(cnt==1){
                    $('#backIn').hide();
                }
                $('#divTab_sub'+cnt).show();
                $('#lnkLoanDtls'+cnt).addClass('active');
                $('#lnkLoanDtls'+cnt).removeClass('disabled');
                $('#saveDetails').hide();
                $('#raise_query').hide();
            });
            $('#saveDetails').click(function (e){
                if(cnt==2){
                    if(validateForm('#divTab_sub'+cnt,'#promter')){
                        return true;
                    }else{
                        e.preventDefault();
                    }
                }
            });
            if($("#businessType option:selected" ).val().length == 0){
                $('#manufacturing_location').hide();
                $('#distributor').hide();
            }
            $('input[type=radio][name=com_your_salestoa]').change(function() {
                var valueM = $(this).val();
                if(valueM=='Large Company'){
                    $('#yearQue37').show();
                }else{
                    $('#yearQue37').hide();
                }
            });
            $( "#businessType" ).change(function () {
                if($("#businessType option:selected" ).val() == 'Manufacturing'){
                    $('#manufacturing_location').show();
                    $('#distributor').hide();
                }else{
                    $('#manufacturing_location').hide();
                    $('#distributor').show();
                }
            });
            if($("#businessType option:selected" ).val()== 'Manufacturing'){
                $('#manufacturing_location').show();
            }
            if($("#businessType option:selected" ).val()== 'B2B'){
                $('#distributor').show();
                $('#manufacturing_location').hide();
            }
            $('#city_name').select2({
                allowClear: true,
                placeholder: "Select city name"
            });
            $('#city_name_1').select2({
                allowClear: true,
                placeholder: "Select city name"
            });
            $('#city_name_2').select2({
                allowClear: true,
                placeholder: "Select city name"
            });
            $('#businessType').select2({
                allowClear: true,
                placeholder: "Select Business Type",
                dropdownAutoWidth : true,
                width: '441',
            });
            //$('#que30_geographical_area')
            if($("#que30_geographical_area option:selected" ).val()=='0'){
                $("#one_city").collapse("show");
            }else if($("#que30_geographical_area option:selected" ).val()=='1'){
                $("#multiple_cities").collapse("show");
            }else if($("#que30_geographical_area option:selected" ).val()=='2'){
                $("#multiple_states").collapse("show");
            }
            if(($("#city_name").val() == 'Other')){
                $('#custom_cityName').collapse("show");
            }else{
                $('#custom_cityName').collapse("hide");
            }
            if(($("#city_name_1").val() == 'Other')){
                $('#custom_cityName_1').collapse("show");
            }else{
                $('#custom_cityName_1').collapse("hide");
            }
            if(($("#city_name_2").val() == 'Other')){
                $('#custom_cityName_2').collapse("show");
            }else{
                $('#custom_cityName_2').collapse("hide");
            }
            //$('#custom_cityName').collapse("hide");
            $("#city_name").change(function () {
             if(($(this).val()) == 'Other'){
                 $('#custom_cityName').collapse("show");
             }else{
                 $('#custom_cityName').collapse("hide");
             }
         });
            $("#city_name_1").change(function () {
                if(($(this).val()) == 'Other'){
                    $('#custom_cityName_1').collapse("show");
                }else{
                    $('#custom_cityName_1').collapse("hide");
                }
            });
            $("#city_name_2").change(function () {
                if(($(this).val()) == 'Other'){
                    $('#custom_cityName_2').collapse("show");
                }else{
                    $('#custom_cityName_2').collapse("hide");
                }
            });
            $("#gst").change(function () { 
                var inputvalues = $(this).val();
                var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
                if (gstinformat.test(inputvalues)) {
                   return true;
               } else {
                alert('GST Identification Number is not valid. It should be in this "11AAAAA1111Z1A1" format');
                $("#gst").val('');
                $("#gst").focus();
            }
        });
            $("#que30_geographical_area").change(function () {
                if($(this).val() == '0') {
                    $("#one_city").collapse("show");
                    $("#multiple_cities").collapse("hide");
                    $("#multiple_states").collapse("hide");
                } else if($(this).val() == '1') {
                    $("#one_city").collapse("hide");
                    $("#multiple_cities").collapse("show");
                    $("#multiple_states").collapse("hide");
                } else if($(this).val() == '2') {
                    $("#one_city").collapse("hide");
                    $("#multiple_cities").collapse("hide");
                    $("#multiple_states").collapse("show");
                }else if($(this).val() == '3') {
                    $("#one_city").collapse("hide");
                    $("#multiple_cities").collapse("hide");
                    $("#multiple_states").collapse("hide");
                }
            });
            /*---- Toggle of State -----*/
            var state_counter = 2;
            $(".remove_state").hide();
            for(i=3;i<=5;i++){
                if($('#state_name_'+i+' option:selected').val() != ''){
                    $("#state_name_"+i).collapse("show");
                    if(i >2) {
                        $(".remove_state").show();
                    }
                    state_counter=i;
                }
            }
            $(".add_state").click(function () {
                state_counter++;
                $("#state_name_"+state_counter).collapse("show");
                if(state_counter == 5) {
                    $(this).hide();
                }
                if(state_counter > 2) {
                    $(".remove_state").show();
                }
            });
            $(".remove_state").click(function () {
                $("#state_name_"+state_counter).collapse("hide");
                state_counter--;
                if(state_counter == 2) {
                    $(this).hide();
                }
                if(state_counter < 5) {
                    $(".add_state").show();
                }
            });
            var State1 = '{{isset($salesAreaDetails->multi_state_1) ? $salesAreaDetails->multi_state_1 : null}}';
            var State2 = '{{isset($salesAreaDetails->multi_state_2) ? $salesAreaDetails->multi_state_2 : null}}';
            var State3 = '{{isset($salesAreaDetails->multi_state_3) ? $salesAreaDetails->multi_state_3 : null}}';
            var State4 = '{{isset($salesAreaDetails->multi_state_4) ? $salesAreaDetails->multi_state_4 : null}}';
            var State5 = '{{isset($salesAreaDetails->multi_state_4) ? $salesAreaDetails->multi_state_5 : null}}';
            if(State1 == ''){
                $('#state_name_1 option:selected').html('Select state name');
            }
            if(State2 == ''){
                $('#state_name_2 option:selected').html('Select state name');
            }
            if(State3 == ''){
                $('#state_name_3 option:selected').html('Select state name');
            }
            if(State4 == ''){
                $('#state_name_4 option:selected').html('Select state name');
            }
            if(State5 == ''){
                $('#state_name_5 option:selected').html('Select state name');
            }
            /***** Venture capital fund handel *****/
            $('#vcf_yes').change(function () {
                $('#vc_fund_name').show();
            });
            $('#vcf_no').change(function () {
                $('#vc_fund_name').hide();
                $('#com_name_of_vc_fund').val('');
            });
            if ($('input[name="com_venture_capital_funded"]:checked').val() == "1") {
             $('#vc_fund_name').show();
         } else {
            $('#vc_fund_name').hide();
        }
        var current_comYourSalestype = "{{ $comYourSalestype }}";
        if(current_comYourSalestype == 'Export' || current_comYourSalestype == 'Both') {
            $("#AnnualValueExport").collapse("show");
        }
        else {
            $("#AnnualValueExport").collapse("hide");
        }
        var add_button_1_count = 1;
        $("#areyoursales_radio_option_1").click(function () {
            $("#AnnualValueExport").collapse("hide");
        });
        $("#areyoursales_radio_option_2").click(function () {
            $("#AnnualValueExport").collapse("show");
        });
        $("#areyoursales_radio_option_3").click(function () {
            $("#AnnualValueExport").collapse("show");
        });
        $("#areyoudist_radio_option_1").click(function () {
            $("#diststockiest_from").collapse("show");
        });
        $("#areyoudist_radio_option_2").click(function () {
            $("#diststockiest_from").collapse("hide");
        });
            //==========================================//
            $('#add_button_1').click(function() {
                add_button_1_count = add_button_1_count + 1;
                $('#detailsForm'+add_button_1_count).show();
                if(add_button_1_count == 5) {
                    $('#add_button_1').hide();
                }
                else {
                    $('#add_button_1').show();
                }
                if(add_button_1_count == 1) {
                    $('#delete_button').hide();
                }
                else {
                    $('#delete_button').show();
                }
            });
            $('#delete_button').click(function() {
                $('#detailsForm'+add_button_1_count).hide();
                add_button_1_count = add_button_1_count - 1;
                if(add_button_1_count == 5) {
                    $('#add_button_1').hide();
                }
                else {
                    $('#add_button_1').show();
                }
                if(add_button_1_count == 1) {
                    $('#delete_button').hide();
                }
                else {
                    $('#delete_button').show();
                }
            });
            //==========================================//
            $('#issales').on("change",function() {
                if($("#issales option:selected").val() >= 1) {
                    $('#Que6').show();
                }
                else {
                    $('#Que6').hide();
                }
            });
            if($( "#distributor option:selected" ).val() == 1){
                $('#firstButton').show();
            }else{
                $('#firstButton').hide();
            }
            $('#product_type').select2({
                allowClear: true,
                placeholder: "Select Product/Services Type"
            });
            $('#distributor').on("change",function() {
                if($( "#distributor option:selected" ).val() == 1){
                    $('#firstButton').show();
                    $('#existing_from').slideToggle();
                }else{
                    $('#firstButton').hide();
                    $('#existing_from').slideToggle();
                    $('#new_form').slideToggle();
                }
            });
            var add_button      = $(".add_field_button"); //Add button ID
            var delete_button      = $(".delete_field_button"); //Delete button ID
            var existingRecords = {{$existingCompanyDeailsCount}};
            var totalAllowedRecords = {{$maxCompanyDetails}};
            var currentRecord = {{$existingCompanyDeailsCount}};
            for(var index = 0; index < currentRecord; index++){
                $('#detailsForm'+index).collapse('show');
            }
            for(var index = currentRecord; index < totalAllowedRecords; index++){
                var processField = $('#process'+index);
                if(processField.val() == 1){
                    $('#detailsForm'+currentRecord).collapse('show');
                    currentRecord++;
                }
            }
            if(currentRecord==totalAllowedRecords){ //On load, if maxrecords are shown, hide the add button
                add_button.hide();
            }
            if(currentRecord==existingRecords){ //On load, if only saved records are shown, hide the delete button
                delete_button.hide();
            }
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if(currentRecord == totalAllowedRecords){
                    alert("Only "+ totalAllowedRecords + " Lender Detail records can be added. Cannot add more records.");
                    $(this).hide();
                }else {
                    $('#process' + currentRecord).val(1);
                    //$('#detailsForm' + currentRecord).show().removeClass('hidden');
                    $('#detailsForm' + currentRecord).collapse('show');
                    if(currentRecord==existingRecords){ //If delete button was hidden, then show it
                        delete_button.show();
                    }
                    currentRecord++;
                    console.log(currentRecord);
                    if(currentRecord == totalAllowedRecords){
                        $(this).hide();
                    }
                }
            });
            $(delete_button).click(function(e) { //on add input button click
                e.preventDefault();
                if(currentRecord == existingRecords){
                    alert("Only new Lender Detail records can be deleted using this button. Deleted previously saved records individually.");
                    $(this).hide();
                }else {
                    if(currentRecord == totalAllowedRecords){//If add button was hidden on max records, then show it
                        add_button.show();
                    }
                    currentRecord--;
                    $('#process' + currentRecord).val("");
                    $('#detailsForm' + currentRecord).collapse('hide');
                    if(currentRecord == existingRecords){
                        $(this).hide();
                    }
                }
            });
            @for ($formIndex = 0; $formIndex < $existingCompanyDeailsCount; $formIndex++)
            var delete_existing{{$formIndex}} = $("#delete_existing{{$formIndex}}"); //Delete button ID
            $(delete_existing{{$formIndex}}).click(function(e) { //on add input button click
                e.preventDefault();
                alert("Record will be removed after you press save and continue");
                $('#isDeleted{{$formIndex}}').val(1);
                $('#detailsForm{{$formIndex}}').collapse('hide');
            });
            @endfor
            if($('#vat_no').val()!=''){
               // $('#lnkLoanDtls1').removeClass('disabled');
           }else{
               // $('#lnkLoanDtls1').addClass('disabled');
           }
           if($('#business_old').val()!=''){
            $('#lnkLoanDtls2').removeClass('disabled');
        }else{
            $('#lnkLoanDtls2').addClass('disabled');
        }
        if($('#key_productservice_offered').val() != ''){
            $('#lnkLoanDtls3').removeClass('disabled');
        }else{
            $('#lnkLoanDtls3').addClass('disabled');
        }
    });
 $('#industry_segment').select2({
    allowClear: true,
    placeholder: "Select option"
});
 $('#business_old').select2({
    allowClear: true,
    placeholder: "Select option"
}); $('#business_old').select2({
    allowClear: true,
    placeholder: "Select option"
});
$('#que30_geographical_area').select2({
    allowClear: true,
    placeholder: "Select Option"
});
$('#vat_no1').hide();
$('#vat_no2').show();
$("#businessType").change(function () {
    if(($(this).val() == 'Manufacturing') || ($(this).val()== 'Trading')){
        $('#vat_no1').show();
        $('#vat_no2').hide();
    }else{
        $('#vat_no1').hide();
        $('#vat_no2').show();
    }
});
</script>
