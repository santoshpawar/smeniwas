<div class="container-fluid">
   <div class="row">
       <div class="card">
           <div class="card-header" data-background-color="green">
               <h4 class="title">Promoter Details <span class="pull-right">{{ $userProfileFirm->name_of_firm }}</span></h4>
               {{--    <p class="category">Apply new loan</p> --}}
           </div>
           <div class="card-content">
            <div class="col-md-12">
                <div class="tab-content tab-design">
                    <div class="btn-group leftside_tab" data-toggle="tab" style="padding-left: 10px;">
                        <a id="lnkLoanDtls1" href="#" class="btn btn-large btn-success btn-space active">KYC Details</a>
                        <a id="lnkLoanDtls2" href="#" class="btn btn-large btn-success btn-space">Other Details</a>
                        <a id="lnkLoanDtls3" href="#" class="btn btn-large btn-success btn-space">Financial Details</a>
                    </div>
                    <div id="divTab_sub1" class="collapse sub-section">
                        <div id="dynamic" class="form-group" style="margin-left: auto;">
                            <br>
                            @for($formIndex=0; $formIndex < $maxPromoters; $formIndex++)
                            <?php $colorstyle = ""; ?>
                            @if($formIndex == 0 || $formIndex == 2 || $formIndex == 4 )
                            <?php $colorstyle = "style='padding:10px; background: cornsilk;'"; ?>
                            @else
                            <?php $colorstyle = "style='padding:10px; background: #adadad;'"; ?>
                            @endif
                            @if($formIndex == 0)                                     {{-- Form index start --}}
                            <div id="promo_{{$formIndex}}" class="panel panel-success">
                                <div class="panel-heading">Main Promoters / Director</div>
                                @else
                                <div id="promo_{{$formIndex}}" class="panel panel-success collapse">
                                    <div class="panel-heading">Additional Promoters / Director - {{($formIndex)}}</div>
                                    @endif  {{-- Form Index end --}}
                                    {!! Form::hidden('promoters['.$formIndex.'][process]', true, ['id'=> 'process'] )!!}
                                    {!! Form::hidden('promoters['.$formIndex.'][id]', null ) !!}
                                    {!! Form::hidden('promoters['.$formIndex.'][loan_id]', $loanId ) !!}
                                    <div class="row">
                                        <br>
                                        <div class="col-lg-12">
                                            @if($deletedQuestionHelper->isQuestionValid("B1.1"))
                                            <div class="col-md-4">
                                                {!! Form::label('promoters.name'.$formIndex,'Name', ['class'=>'control-label']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                @if(isset($temp_array[$formIndex]['kyc_name']))
                                                {!! Form::text('promoters['.$formIndex.'][kyc_name]',$temp_array[$formIndex]['kyc_name'], array('class' =>'form-control', 'id'=>'promoters.name'.$formIndex,'placeholder'=>'Name of Promoters/Directors','data-mandatory'=>'M',$setDisable)) !!}
                                                @elseif($formIndex == 0)
                                                {!! Form::text('promoters['.$formIndex.'][kyc_name]',isset($userProfile->kyc_name) ? $userProfile->kyc_name :null, array('class' => 'form-control','id'=>'promoters.name'.$formIndex, 'placeholder'=>'Name of Promoters/Directors','data-mandatory'=>'M',$setDisable)) !!}
                                                @else
                                                {!! Form::text('promoters['.$formIndex.'][kyc_name]',null, array('class' => 'form-control','id'=>'promoters.name'.$formIndex, 'placeholder'=>'Name of Promoters/Directors','data-mandatory'=>'M' ,$setDisable)) !!}
                                                @endif
                                            </div>
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("B1.3"))
                                            <div class="col-md-4">
                                                {!! Form::label('promoters'.$formIndex,'PAN', ['class'=>'control-label']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                @if(isset($temp_array[$formIndex]['kyc_pan']))
                                                {!! Form::text('promoters['.$formIndex.'][kyc_pan]',$temp_array[$formIndex]['kyc_pan'], ['class' =>'form-control', 'id'=>'promoters.pan'.$formIndex,'placeholder'=>'PAN of Promoter/Director','data-mandatory'=>'M',$setDisable]) !!}
                                                @else
                                                {!! Form::text('promoters['.$formIndex.'][kyc_pan]',null, ['class' => 'form-control','id'=>'promoters.pan'.$formIndex,'placeholder'=>'PAN of Promoter/Director','data-mandatory'=>'M',$setDisable]) !!}
                                                @endif
                                            </div>
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("B1.2"))
                                            @if(isset($owner_entity_type))
                                            @if($owner_entity_type!='')
                                            <div class="col-md-4">
                                                {!! Form::label('promoters.din'.$formIndex,'DIN', ['class'=>'control-label']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                @if(isset($temp_array[$formIndex]['kyc_din']))
                                                {!! Form::text('promoters['.$formIndex.'][kyc_din]',$temp_array[$formIndex]['kyc_din'], ['class' =>'form-control', 'id'=>'promoters.din'.$formIndex,'placeholder'=>'Director Identification Number',$setDisable]) !!}
                                                @else
                                                {!! Form::text('promoters['.$formIndex.'][kyc_din]', null, ['class' => 'form-control',
                                                'id'=>'promoters.din'.$formIndex, 'placeholder'=>'Director identification Number',$setDisable]) !!}
                                                @endif
                                            </div>
                                            @endif
                                            @else
                                           {{--  {!! Form::hidden('counter_storage', 0, array('id' => 'counter_storage')) !!}
                                            {!! Form::hidden('promoters['.$formIndex.'][kyc_din]',null, ['class' => 'form-control','id'=>'promoters.din'.$formIndex, 'placeholder'=>'Director identification Number',$setDisable]) !!}
                                            --}} @endif
                                            @endif
                                            @if($deletedQuestionHelper->isQuestionValid("B1.4"))
                                            <div class="col-md-4">
                                                @if(!isset($temp_array[$formIndex]['kyc_address_proof']))
                                                {!! Form::label('promoters.address_prooftype'.$formIndex,'Address Proof Type', ['class'=>'control-label']) !!}
                                                {!! Form::select('promoters['.$formIndex.'][kyc_address_proof]', ['' =>'','Electricity Bill' => 'Electricity Bill',  'Aadhaar Card' => 'Aadhaar Card', 'RationCard' => 'RationCard', 'Passport' => 'Passport'],'',['id' =>'promoters_address_prooftype_'.$formIndex, 'class'=>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                @else
                                                {!! Form::label('promoters.address_prooftype'.$formIndex,'Address Proof Type', ['class'=>'control-label']) !!}
                                                {!! Form::select('promoters['.$formIndex.'][kyc_address_proof]', ['' =>'','Electricity Bill' => 'Electricity Bill', 'Aadhaar Card' => 'Aadhaar Card', 'RationCard' => 'RationCard', 'Passport' => 'Passport'],$temp_array[$formIndex]['kyc_address_proof'],['id' =>'promoters_address_prooftype_'.$formIndex, 'class'=>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable])!!}
                                                @endif
                                            </div>
                                            @endif
                                            <div class="col-md-4">
                                                @if($deletedQuestionHelper->isQuestionValid("B1.5"))
                                                {!! Form::label('promoters'.$formIndex,'ID No.', ['class'=>'control-label']) !!}
                                                @if(isset($temp_array[$formIndex]['kyc_proof_id']))
                                                {!! Form::text('promoters['.$formIndex.'][kyc_proof_id]',$temp_array[$formIndex]['kyc_proof_id'], ['class' =>
                                                'form-control', 'id'=>'promoters.address_proof_id'.$formIndex,'placeholder'=>'ID of the chosen address proof','data-mandatory'=>'M',$setDisable]) !!}
                                                @else
                                                {!! Form::text('promoters['.$formIndex.'][kyc_proof_id]',
                                                null, ['class' => 'form-control','id'=>'promoters.address_proof_id'.$formIndex,'placeholder'=>'ID of the chosen address proof','data-mandatory'=>'M',$setDisable]) !!}
                                                @endif
                                                @endif
                                            </div>
                                            @if($deletedQuestionHelper->isQuestionValid("B1.6"))
                                            <div class="col-md-4">
                                                {!! Form::label('address', 'Address', ['class'=>'control-label']) !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                @if(isset($temp_array[$formIndex]['kyc_address']))
                                                {!! Form::textarea('promoters['.$formIndex.'][kyc_address]',
                                                    $temp_array[$formIndex]['kyc_address'], ['class' => 'form-control',
                                                    'size' => '10x1', 'id'=>'promoters.address'.$formIndex,
                                                    'placeholder'=>'Address','data-mandatory'=>'M',$setDisable]) !!}
                                                    @else
                                                    {!! Form::textarea('promoters['.$formIndex.'][kyc_address]', null,
                                                        ['class' => 'form-control address_field', 'size' => '10x1',
                                                        'id'=>'promoters.address'.$formIndex, 'placeholder'=>'Address','data-mandatory'=>'M',$setDisable])
                                                        !!}
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @if($deletedQuestionHelper->isQuestionValid("B1.7"))
                                                    <div class="col-md-4">
                                                        @if(!isset($temp_array[$formIndex]['kyc_state']))
                                                        {!! Form::label('state', 'State', ['class'=>'control-label'])!!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                        {!! Form::select('promoters['.$formIndex.'][kyc_state]',$states,null, ['id' => 'states_'.$formIndex,'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}
                                                        @else
                                                        {!! Form::label('state', 'State', ['class'=>'control-label'])!!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                        {!! Form::select('promoters['.$formIndex.'][kyc_state]',$states,
                                                            $temp_array[$formIndex]['kyc_state'], ['id' => 'states_'.$formIndex,'class' =>
                                                            'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if($deletedQuestionHelper->isQuestionValid("B1.8"))
                                                        <div class="col-md-4">
                                                            {!! Form::label('pin', 'Pincode', ['class'=>'control-label'])!!}
                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                            @if(isset($temp_array[$formIndex]['kyc_pin']))
                                                            {!! Form::text('promoters['.$formIndex.'][kyc_pin]',
                                                                $temp_array[$formIndex]['kyc_pin'], ['class' => 'form-control amount',
                                                                'size' => '10x5', 'id'=>'promoters.pincode'.$formIndex,
                                                                'placeholder'=>'Pincode','data-mandatory'=>'M',$setDisable]) !!}
                                                                @else
                                                                {!! Form::text('promoters['.$formIndex.'][kyc_pin]', null,
                                                                    ['class' => 'form-control address_field amount', 'size' => '10x5',
                                                                    'id'=>'promoters.pincode'.$formIndex, 'placeholder'=>'Pincode','data-mandatory'=>'M',$setDisable])
                                                                    !!}
                                                                    @endif
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    @endfor
                                                    {!! Form::hidden('counter_storage', 0, array('id' => 'counter_storage')) !!}
                                                    {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers')) !!}
                                                </div>
                                                <div class="form-group" style="padding-left: 20px;">
                                                    {!! Form::button('Add Promoters / Directors Details', ['class'=>'btn btn-primary add_promo_button', 'id'=>'add_promoter_director', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                                    {!! Form::button('Remove Promoters / Directors Details', ['class'=>'btn btn-warning rem_promo_button', 'id'=>'rem_promoter_director', 'type'=>'button','style'=>'font-weight:bold;',$setDisable])!!}
                                                </div>
                                            </div>

                                            {{-- Additional Deatils start --}}
                                            <div id="divTab_sub2" class="sub-section">
                                                <div id="divTab_sub2">
                                                    <br>
                                                    <div id="promo_{{$formIndex}}" class="panel panel-success">
                                                        <div class="panel-heading">Additional Details</div>
                                                        <div class="row">
                                                            <br>
                                                            {!! Form::hidden('is_funded', $isFunded, ['id'=> 'is_funded'] )!!}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                @if($deletedQuestionHelper->isQuestionValid("B3.1"))
                                                                <div class="col-md-6">
                                                                    {!! Form::label('othr_eduprofdegree', 'Education/professional degree ',['class'=>'control-label']) !!}
                                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                    {!! Form::select('othr_eduprofdegree', $degreeType, null, ['id' =>'education_degree', 'class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                                </div>
                                                                @endif
                                                                @if($deletedQuestionHelper->isQuestionValid("B3.2"))
                                                                <div class="col-md-6">
                                                                    {!! Form::label('othr_promoterare', 'Promoters are ', ['class'=>'control-label']) !!}
                                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                    <br>
                                                                    @foreach ($promotersGenerationType as $promotersGenerationTypeName=>$promotersGenerationTypeValue)
                                                                    <label class="radio-inline">
                                                                        {!! Form::radio('othr_promoterare', $promotersGenerationTypeName,'false',['data-mandatory'=>'M',$setDisable]) !!}
                                                                        {{$promotersGenerationTypeValue}}
                                                                    </label><br>
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                                @if($deletedQuestionHelper->isQuestionValid("B3.3") && $isSME!=1)
                                                                <div class="col-md-6">
                                                                    {!! Form::label('othr_noofindependent', 'Number of independent families involved in business', ['class'=>'control-label']) !!}
                                                                    <br>
                                                                    @foreach ($noOfFamilyTypes as $noOfFamilyTypeName=>$noOfFamilyTypeValue)
                                                                    <label class="radio-inline">
                                                                        {!! Form::radio('othr_noofindependent', $noOfFamilyTypeName,'false',['data-mandatory'=>'M',$setDisable])!!}
                                                                        {{$noOfFamilyTypeValue}}
                                                                    </label><br>
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading">Additional Loan Information</div>
                                                        <div class="panel-body">
                                                            @if($deletedQuestionHelper->isQuestionValid("B3.4"))
                                                            <div class="col-md-6" style="padding:15px 7px">
                                                                {!! Form::label('othr_sourceofincome', 'Does promoter have other sources of income? (Interest, rental, others)') !!}
                                                                <div class="cibilScoreOptions">
                                                                    <label class="radio-inline">
                                                                        {!! Form::radio('othr_income', '1',false , ['id' => 'othr_income_yes','class'=>'cibilscr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        Yes
                                                                    </label>
                                                                    <label class="radio-inline">
                                                                        {!! Form::radio('othr_income', '0', true, ['id' => 'othr_income_no','class'=>'cibilscr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        No
                                                                    </label>
                                                                </div>
                                                                <div id="otherIncomeSources">
                                                                    <br/>
                                                                    <label>Approx Monthly Income (Rs Lacs) <?php if(isset($model->othr_income)) { echo $model->othr_income; } ?></label>
                                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                    {!! Form::text('othr_sourceofincome', null, ['class' => 'form-control', 'id' => 'additionalIncome','data-mandatory'=>'M',$setDisable]) !!}
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if($deletedQuestionHelper->isQuestionValid("B3.5"))
                                                            <div class="col-md-6" style="padding: 15px">
                                                                {!! Form::label('cibilScore', 'Do you know you CIBIL Score?') !!}
                                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                <div class="cibilScoreOptions">
                                                                    <label class="radio-inline">
                                                                        {!! Form::radio('othr_doyouknowcibil', 'Yes', false, ['id' => 'cibilScoreYes','class'=>'cibilscr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        Yes
                                                                    </label>
                                                                    <label class="radio-inline">
                                                                        {!! Form::radio('othr_doyouknowcibil', 'No', true, ['id' => 'cibilScoreNo','class'=>'cibilscr','data-mandatory'=>'M',$setDisable]) !!}
                                                                        No
                                                                    </label>
                                                                </div>
                                                                <div id="cibilScoreContainer">
                                                                    <br/>
                                                                    <label for="cibilScore">Enter CIBIL Score</label>
                                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                    {!! Form::text('othr_cibilscore', null, ['class' => 'form-control amount', 'id' => 'cibilScore','data-mandatory'=>'M',$setDisable]) !!}
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Additional Deatils End --}}


                                            {{-- Financial Deatils Start --}}
                                            <div id="divTab_sub3" class="tab-pane sub-section">
                                                <br>
                                                <div class="col-md-6">
                                                    <div id="promo_{{$formIndex}}" class="panel panel-success">
                                                        <div class="panel-heading">Assets Owned By Promoters ( <span class="fa fa-inr"></span> Lacs )
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="panel-group" id="accordion">
                                                                @if($deletedQuestionHelper->isQuestionValid("B2.1"))
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading accordian">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse">
                                                                            </span>Vehicles Owned</a>
                                                                        </h4>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" id="vehiclesOwned" name="fin" value="none" class='none'  checked="checked">No
                                                                        </div>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="fin" value="" class='all'> Yes 
                                                                        </div>
                                                                    </div>`
                                                                    
                                                    <div id="collapseOne" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" style="margin-left: auto;">
                                                                            {!! Form::label('vehiclesOwned','No of Vehicles Owned') !!}
                                                                            {!! Form::select('fin_vehiclesowned', array('' => 'Select Vehicle','1' => '1', '2' => '2 to 4', '3' =>'Greater than 4') , null , ['id' => 'isvehicleold','class'=>'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                                 </div>
                                                             </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group" style="margin-left: auto; margin-right: auto;">
                                                                                        {!! Form::label('fin_vehiclesowned_marketvalue'.$formIndex,'Market Value ') !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                        {!! Form::text('fin_vehiclesowned_marketvalue', null , ['class' =>'form-control amount', 'id'=>'apprx_market_value_vehicle','placeholder'=>'Market Value of vehicle ( Lacs )','data-mandatory'=>'M',$setDisable]) !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if($deletedQuestionHelper->isQuestionValid("B2.2"))
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading accordian">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse">Properties Owned</a>
                                                                        </h4>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="rproperty" value="none" id='propertyNo'  checked="checked">No
                                                                        </div>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="rproperty" value="" id='propertyYes'> Yes 
                                                                        </div>
                                                                    </div>
                                                                    <div id="collapseTwo" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="row collapse in" id="propertiesDiv">
                                                                                <div class="col-md-6">
                                                                                <div class="form-group" style="margin-left: auto;">
                                                                                    {!! Form::label('fin_propertiesowned','No of Properties Owned') !!}
                                                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                                    {!! Form::select('fin_propertiesowned', array('' => 'Select Properties Owned','1' => '1', '2' => '2', '3' =>'3', '4' => 'Greater than 3'),null,['id' => 'no_of_property','class'=>'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                    <?php $i = 0 ?>
                                                    <div id="propertyDetails" class="collapse">
                                                        @for($formIndex=1; $formIndex <= 3; $formIndex++)
                                                        <div id="propertyDetails_{{$formIndex}}" class="panel panel-default collapse" style="margin-top:10px;">
                                                            <div class="panel-heading" style="color:#000 !important;">Property Details - {{$formIndex}}
                                                            </div>
                                    
                                                            <div class="row">
                                                              <br>
                                                            </div>
                                                              <div class="row" style="margin-left: auto;">
                                                                    <div class="col-sm-8">
                                                                      <div class="form-group" style="margin-left: auto;">
                                                               @if(isset($existingPropertyOwned[$i]['property_type']))
                                                                {!! Form::label('property_type','Type of Property') !!}
                                                               {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                              {!! Form::select('propertyDetails['.$formIndex.'][property_type]', array('' =>'Please select','Land' => 'Land', 'Residential Flat/House' => 'Residential Flat/House', 'Commercial' => 'Commercial'),$existingPropertyOwned[$i]['property_type'],['id' =>
                                                            'propertytype'.$formIndex, 'class'=>'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                              @else
                                                                        {!! Form::label('property_type','Type of Property') !!}
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                        {!! Form::select('propertyDetails['.$formIndex.'][property_type]', array('' =>'Please select','Land' => 'Land', 'Residential Flat/House' => 'Residential Flat/House', 'Commercial' => 'Commercial'),null,['id' =>
                                                                         'propertytype'.$formIndex, 'class'=>'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                @endif
                                                                                            </div>
                                                                                    </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="form-group" style="margin-left: auto;">
                                                                                @if(isset($existingPropertyOwned[$i]['market_value']))
                                                                                {!! Form::label('market_value','Market Value') !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                                {!! Form::text('propertyDetails['.$formIndex.'][market_value]', $existingPropertyOwned[$i]['market_value'],['class' => 'form-control amount','id'=>'apprx_market_value_property_'.$formIndex,'placeholder'=>'Approximate Market Value ( Lacs )','data-mandatory'=>'M',$setDisable]) !!}
                                                                                    @else
                                                                                {!! Form::label('market_value','Market Value') !!}
                                                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                                {!! Form::text('propertyDetails['.$formIndex.'][market_value]', null,['class' => 'form-control amount','id'=>'apprx_market_value_property_'.$formIndex,'placeholder'=>'Approx. Market Value (Lacs)','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                      <div class="row" style="margin-left: auto;">
                          <div class="col-sm-8">
                              <div class="form-group" style="margin-left: auto;">
                                   @if(!isset($existingPropertyOwned[$i]['location_city']))
                                   {!! Form::label('location_city','Location City') !!}
                                   {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                    {!! Form::select('propertyDetails['.$formIndex.'][location_city]',$cities, null, ['id' => 'propertyno'.$formIndex , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}
                            
                                     <div class="form-group collapse" id="custom_cityName_{{$formIndex}}" style="margin-left: 0px;">
                                          {!! Form::label('city_name', 'City Name') !!}
                                          {!! Form::text('other_city_name['.$formIndex.']',null, ['id'=>'custom_cityNamebox','class' => 'form-control', 'placeholder' => 'Enter City','data-mandatory'=>'M','style' => 'width: 95%;',$setDisable])!!}
                                     </div>
                                           @else
                                            {!! Form::label('location_city','Location City') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                            {!! Form::select('propertyDetails['.$formIndex.'][location_city]',$cities, $existingPropertyOwned[$i]['location_city'], ['id' => 'propertyno'.$formIndex , 'class' =>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}
                                      <div class="form-group collapse" id="custom_cityName_{{$formIndex}}" style="margin-left: 0px;">
                                            {!! Form::label('city_name', 'City Name') !!}
                                            {!! Form::text('other_city_name['.$formIndex.']', $existingPropertyOwned[$i]['other_city_name'], ['id'=>'custom_cityNamebox','class' => 'form-control', 'placeholder' => 'Enter City','data-mandatory'=>'M','style' => 'width: 95%;',$setDisable])!!}
                                      </div>                                                                 @endif
                                  </div>
                            </div>
                                       <div class="col-sm-8">
                                        <div class="form-group" style="margin-left: auto;">
                                     {!! Form::label('mortgage_radio','Is it mortgaged?') !!}
                                     {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                             <br>
                                     @if(isset($existingPropertyOwned[$i]['is_mortgage'])&& $existingPropertyOwned[$i]['is_mortgage'] == 'Yes')
                                   <label class="radio-inline">
                                   {!! Form::radio('propertyDetails['.$formIndex.'][is_mortgage]', 'Yes',true,['id' => 'mortgage_radio_radio_option_1','data-mandatory'=>'M',$setDisable]) !!}Yes
                                    </label>
                                   <label class="radio-inline">
                                    {!! Form::radio('propertyDetails['.$formIndex.'][is_mortgage]', 'No',false, ['id' => 'mortgage_radio_radio_option_2','data-mandatory'=>'M',$setDisable]) !!}     No
                                   </label>
                                   @elseif(isset($existingPropertyOwned[$i]['is_mortgage'])&& $existingPropertyOwned[$i]['is_mortgage'] == 'No')
                                 <label class="radio-inline">
                                    {!! Form::radio('propertyDetails['.$formIndex.'][is_mortgage]', 'Yes',false,['id' => 'mortgage_radio_radio_option_1','data-mandatory'=>'M',$setDisable]) !!}  Yes
                                 </label>
                                 <label class="radio-inline">
                                 {!! Form::radio('propertyDetails['.$formIndex.'][is_mortgage]', 'No',true, ['id' => 'mortgage_radio_radio_option_2','data-mandatory'=>'M',$setDisable]) !!}     No
                                    </label>
                                      @else
                                 <label class="radio-inline">
                                {!! Form::radio('propertyDetails['.$formIndex.'][is_mortgage]', 'Yes',false,['id' => 'mortgage_radio_radio_option_1','data-mandatory'=>'M',$setDisable]) !!}
                                           Yes
                                </label>
                             <label class="radio-inline">
                            {!! Form::radio('propertyDetails['.$formIndex.'][is_mortgage]', 'No',true, ['id' => 'mortgage_radio_radio_option_2','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                    No
                                                                                                </label>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?php $i++; ?>
                                                                                @endfor
                                                                                {!! Form::hidden('no_property_owned_count', 0, array('id' => 'no_property_owned_count')) !!}
                                                                            </div>
                                                                            <div id="propertyDetails_4" class="collapse" style="padding-top:10px;">
                                                                                <div id="propertyDetails_4" class="panel panel-default" width="80%">
                                                                                    <div class="panel-heading" style="color:#000 !important;">Other Properties</div>
                                                                                    <div class="row">
                                                                                        <br>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="col-md-6">
                                   @if(isset($existingPropertyOwned[3]['property_type']))
                                   {!! Form::label('property_type','Type of Property') !!}
                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                   {!! Form::select('propertyDetails[4][property_type]', array('' =>'Please select','Land' => 'Land', 'Residential Flat/House' => 'Residential Flat/House', 'Commercial' => 'Commercial'),$existingPropertyOwned[3]['property_type'],['id' =>
                                 'propertytype', 'class'=>'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                    @else
                                {!! Form::label('property_type','Type of Property') !!}
                              {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                              {!! Form::select('propertyDetails[4][property_type]', array('' =>'Please select','Land' => 'Land', 'Residential Flat/House' => 'Residential Flat/House', 'Commercial' => 'Commercial'),null,['id' =>
                           'propertytype', 'class'=>'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                                       @endif
                                                                                        </div>
                                                                  <div class="col-md-6">
                   @if(isset($existingPropertyOwned[3]['market_value']))
                    {!! Form::label('market_value','Market Value') !!}
                  {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                  {!! Form::text('propertyDetails[4][market_value]', $existingPropertyOwned[3]['market_value'],['class' => 'form-control amount','id'=>'apprx_market_value_property_'.$formIndex,
                                                                                                'placeholder'=>'Approximate Market Value ( Lacs )','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                @else
                                                                                                {!! Form::label('market_value','Market Value') !!}
                                                                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                                                {!! Form::text('propertyDetails[4][market_value]', null,['class' => 'form-control amount','id'=>'apprx_market_value_property_'.$formIndex,
                                                                                                'placeholder'=>'Approximate Market Value ( Lacs )','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if($deletedQuestionHelper->isQuestionValid("B2.3"))
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading accordian">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                                            Other Assets Owned </a>
                                                                        </h4>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="otherAssetNo" value="none" id='otherAssetNo'  checked="checked" >No
                                                                        </div>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="otherAssetNo" value="" id='otherAssetYes'> Yes 
                                                                        </div>
                                                                    </div>
                                                                    <div id="collapseThree" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="row collapse in" id="otherAssetsDiv">
                                                                                <div class="row" style="margin-left: auto;">
                                                                                    <div class="col-md-5">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                            {!! Form::label('fixed_deposits','Fixed Deposits', ['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                                            {!! Form::text('fin_fixeddeposit', null, ['class' => 'form-control amount', 'id'=>'fixed_deposits','placeholder'=>'Enter Value','data-mandatory'=>'M',$setDisable]) !!}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-5">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                            {!! Form::label('mutual_funds','Mutual Funds', ['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                                            {!! Form::text('fin_mutualfunds', null, ['class' => 'form-control amount', 'id'=>'mutual_funds',
                                                                                            'placeholder'=>'Enter Value','data-mandatory'=>'M',$setDisable]) !!}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                            {!! Form::label('listed_shares_owned','Listed Shares Owned', ['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;margin-bottom:0px !important;']) !!}
                                                                                            {!! Form::text('fin_listedshares', null, ['class' => 'form-control amount', 'id'=>'listed_shares_owned',
                                                                                            'placeholder'=>'Enter Value','data-mandatory'=>'M',$setDisable]) !!}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="promo_{{$formIndex}}" class="panel panel-success">
                                                        <div class="panel-heading">Liabilities of Promoters ( <span class="fa fa-inr"></span> Lacs )
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="panel-group" id="accordion">
                                                                {{-- Personal Loan/Overdraft Start --}}
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading accordian">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse">Personal Loan/Overdraft </a>
                                                                        </h4>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="personalLoanNo" value="none" id='personalLoanNo'  checked="checked">No
                                                                        </div>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="personalLoanNo" value="" id='personalLoanYes'> Yes 
                                                                        </div>
                                                                    </div>
                                                                    <div id="collapseFive" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            @for($overIndex = 0; $overIndex < $maxoverdrafts; $overIndex++)
                                                                            @if($overIndex == 0)   
                                                                            <div id="promo_over_{{$overIndex}}" class="panel panel-success">
                                                                                @else
                                                                                <div id="promo_over_{{$overIndex}}" class="panel panel-success collapse">
                                                                                    <div class="panel-heading">Add overdraft - {{($overIndex+1)}}</div>
                                                                                    @endif  

                                                                                    <div class="row" style="margin-left: auto;">
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group" style="margin-left: auto;">
                                                                                               {!! Form::label('liab_overdraft_bank','Name of Bank/NBFC', ['class'=>'control-label']) !!}
                                                                                               @if(isset($temp_array_overdr[$overIndex]['overName'])) 
                                                                                               {!! Form::text('overdraft['.$overIndex.'][overName]',$temp_array_overdr[$overIndex]['overName'], array('class' =>'form-control', 'id'=>'overdraft_overName_'.$overIndex,'placeholder'=>'Overdraft Name','data-mandatory'=>'M',$setDisable)) !!}
                                                                                               @else
                                                                                               {!! Form::text('overdraft['.$overIndex.'][overName]',null, array('class' => 'form-control','id'=>'overdraft_overName_'.$overIndex, 'placeholder'=>'Overdraft Name','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                                               @endif
                                                                                           </div>
                                                                                       </div>
                                                                                       <div class="col-md-6">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                                {!! Form::label('liab_credit_card_outstanding','Amt. Outstanding', ['class'=>'control-label']) !!}
                                                                                            @if(isset($temp_array_overdr[$overIndex]['overOutstanding']))
                                                                                            {!! Form::text('overdraft['.$overIndex.'][overOutstanding]',$temp_array_overdr[$overIndex]['overOutstanding'], array('class' =>'form-control', 'id'=>'overdraft_overOutstanding_'.$overIndex,'placeholder'=>'Outstanding','data-mandatory'=>'M',$setDisable)) !!}
                                                                                            @else
                                                                                            {!! Form::text('overdraft['.$overIndex.'][overOutstanding]',null, array('class' => 'form-control','id'=>'overdraft_overOutstanding_'.$overIndex, 'placeholder'=>'Outstanding','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                             {!! Form::label('liab_overdraft_emi','Monthly EMI', ['class'=>'control-label']) !!}
                                                                                            @if(isset($temp_array_overdr[$overIndex]['overMonthlyEmi']))
                                                                                            {!! Form::text('overdraft['.$overIndex.'][overMonthlyEmi]',$temp_array_overdr[$overIndex]['overMonthlyEmi'], array('class' =>'form-control', 'id'=>'overdraft_overMonthlyEmi_'.$overIndex,'placeholder'=>'Monthly EMI','data-mandatory'=>'M',$setDisable)) !!}
                                                                                            @else
                                                                                            {!! Form::text('overdraft['.$overIndex.'][overMonthlyEmi]',null, array('class' => 'form-control','id'=>'overdraft_overMonthlyEmi_'.$overIndex, 'placeholder'=>'Monthly EMI','data-mandatory'=>'M' ,$setDisable)) !!}
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                            </div>
                                                                            @endfor
                                                                              {!! Form::hidden('overdraftLib',$overIndex, ['id'=>'overdraftLib'],$overIndex) !!}
                                                                            {!! Form::hidden('counter_OD_storage', 0, array('id' => 'counter_OD_storage')) !!}
                                                                            {!! Form::hidden('no_of_OD_opened_containers', 1, array('id' => 'no_of_OD_opened_containers')) !!}
                                                                            <div class="form-group" style="padding-left: 20px;">
                                                                                <button class="btn btn-primary add_promo_button" id="add_overdraft_details" type="button" style="font-weight:bold;" =""="">Add overdraft</button>
                                                                                <button class="btn btn-warning rem_promo_button" id="remove_overdraft_details" type="button" style="font-weight: bold; display: none;" =""="">Remove Overdraft</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- Personal Loan/Overdraft Start --}}

                                                                {{-- Mortgage Loan Start --}}
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading accordian">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse">Mortgage Loan</a>
                                                                        </h4>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="mortgageLoanNo" value="none" id='mortgageLoanNo'  checked="checked" >No
                                                                        </div>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="mortgageLoanNo" value="" id='mortgageLoanYes'> Yes 
                                                                        </div>
                                                                    </div>


                                                                    <div id="collapseSeven" class="panel-collapse collapse">
                                                                        <div class="panel-body">

                                                                         @for($mortIndex = 0; $mortIndex < $maxmortgages; $mortIndex++)
                                                                         @if($mortIndex == 0)   

                                                                         <div id="promo_mort_{{$mortIndex}}" class="panel panel-success">
                                                                            @else
                                                                            <div id="promo_mort_{{$mortIndex}}" class="panel panel-success collapse">
                                                                                <div class="panel-heading">Add Mortgage - {{($mortIndex+1)}}</div>
                                                                                @endif  
                                                                                <div class="row" style="margin-left: auto;">
                                                                                   <div class="col-md-5">
                                                                                       <div class="form-group" style="margin-left: auto;">
                                                                                        @if(isset($temp_array_mortgage[$mortIndex]['mortName'])) 
                                                                                        {!! Form::label('liab_mortgage_bank','Name of Bank/NBFC', ['class'=>'control-label']) !!}
                                                                                        {!! Form::text('mortgage['.$mortIndex.'][mortName]', $temp_array_mortgage[$mortIndex]['mortName'], ['class' => 'form-control','id'=>'mortgage_mortName_'.$mortIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                        @else
                                                                                        {!! Form::label('liab_mortgage_bank','Name of Bank/NBFC', ['class'=>'control-label']) !!}
                                                                                        {!! Form::text('mortgage['.$mortIndex.'][mortName]', null, ['class' => 'form-control','id'=>'mortgage_mortName_'.$mortIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                        @endif


                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group" style="margin-left: auto;">
                                                                                        @if(isset($temp_array_mortgage[$mortIndex]['mortOutstanding'])) 
                                                                                        {!! Form::label('liab_credit_card_outstanding','Amt. Outstanding',['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                        {!! Form::text('mortgage['.$mortIndex.'][mortOutstanding]',  $temp_array_mortgage[$mortIndex]['mortOutstanding'], ['class' => 'form-control','id'=>'mortgage_mortOutstanding_'.$mortIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!} 
                                                                                        @else
                                                                                        {!! Form::label('liab_credit_card_outstanding','Amt. Outstanding',['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                        {!! Form::text('mortgage['.$mortIndex.'][mortOutstanding]', null, ['class' => 'form-control','id'=>'mortgage_mortOutstanding_'.$mortIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!} 
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group" style="margin-left: auto;">
                                                                                        {!! Form::label('liab_mortgage_emi','Monthly EMI',['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                        @if(isset($temp_array_mortgage[$mortIndex]['mortMonthlyEmi'])) 
                                                                                        {!! Form::text('mortgage['.$mortIndex.'][mortMonthlyEmi]', $temp_array_mortgage[$mortIndex]['mortMonthlyEmi'], ['class' => 'form-control','id'=>'mortgage_mortOutstanding_'.$mortIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!} 
                                                                                        @else
                                                                                        {!! Form::text('mortgage['.$mortIndex.'][mortMonthlyEmi]',null , ['class' => 'form-control','id'=>'mortgage_mortMonthlyEmi_'.$mortIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                             @endfor
                                                                             

                                                                        {!! Form::hidden('mortgageLib',$mortIndex, ['id'=>'mortgageLib'],$mortIndex) !!}
                                                                        {!! Form::hidden('counter_ML_storage', 0, array('id' => 'counter_ML_storage')) !!}
                                                                        {!! Form::hidden('no_of_ML_opened_containers', 1, array('id' => 'no_of_ML_opened_containers')) !!}

                                                                        <div class="form-group" style="padding-left: 20px;">
                                                                            <button class="btn btn-primary add_promo_button" id="add_mortgage_details" type="button" style="font-weight:bold;" =""="">Add Mortgage Loan</button>
                                                                            <button class="btn btn-warning rem_promo_button" id="remove_mortgage_details" type="button" style="font-weight: bold; display: none;" =""="">Remove Mortgage Loan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Mortgage Loan End--}}



                                                            {{-- Vehicle Loan Start --}}
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading accordian">
                                                                    <h4 class="panel-title">
                                                                        <a>
                                                                        Vehicle Loan</a>
                                                                    </h4>
                                                                    <div style="float:right;margin-top:-15px">
                                                                        <input type="radio" name="vechicleNo" value="none" id='vechicleNo'  checked="checked">No
                                                                    </div>
                                                                    <div style="float:right;margin-top:-15px">
                                                                        <input type="radio" name="vechicleNo" value="" id='vechicleYes'> Yes 
                                                                    </div>
                                                                </div>
                                                                <div id="collapseSix" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        @for($vehicleIndex = 0; $vehicleIndex < $maxvehicles; $vehicleIndex++)
                                                                        @if($vehicleIndex == 0)   
                                                                        <div id="promo_vehicle_{{$vehicleIndex}}" class="panel panel-success">
                                                                            @else
                                                                            <div id="promo_vehicle_{{$vehicleIndex}}" class="panel panel-success collapse">
                                                                                <div class="panel-heading">Add vehicle - {{($vehicleIndex+1)}}</div>
                                                                                @endif  
                                                                                <div class="row" style="margin-left: auto;">
                                                                                    <div class="col-md-5">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                            {!! Form::label('liab_vehicle_bank','Name of Bank/NBFC', ['class'=>'control-label']) !!}
                                                                                            @if(isset($temp_array_vechicle[$vehicleIndex]['vehicleName'])) 
                                                                                            {!! Form::text('vehicle['.$vehicleIndex.'][vehicleName]', $temp_array_vechicle[$vehicleIndex]['vehicleName'], ['class' => 'form-control','id'=>'vehicle_vehicleName_'.$vehicleIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                            @else
                                                                                            {!! Form::text('vehicle['.$vehicleIndex.'][vehicleName]', null, ['class' => 'form-control','id'=>'vehicle_vehicleName_'.$vehicleIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                            {!! Form::label('liab_credit_card_outstanding','Amt. Outstanding',['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>

                                                                                            @if(isset($temp_array_vechicle[$vehicleIndex]['vehicleOutstanding'])) 
                                                                                            {!! Form::text('vehicle['.$vehicleIndex.'][vehicleOutstanding]', $temp_array_vechicle[$vehicleIndex]['vehicleOutstanding'], ['class' => 'form-control','id'=>'vehicle_vehicleOutstanding_'.$vehicleIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                            @else
                                                                                            {!! Form::text('vehicle['.$vehicleIndex.'][vehicleOutstanding]', null, ['class' => 'form-control','id'=>'vehicle_vehicleOutstanding_'.$vehicleIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group" style="margin-left: auto;">
                                                                                            {!! Form::label('liab_vehicle_emi','Monthly EMI',['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                            @if(isset($temp_array_vechicle[$vehicleIndex]['vehicleMonthlyEmi'])) 
                                                                                            {!! Form::text('vehicle['.$vehicleIndex.'][vehicleMonthlyEmi]', $temp_array_vechicle[$vehicleIndex]['vehicleMonthlyEmi'], ['class' => 'form-control','id'=>'vehicle_vehicleMonthlyEmi_'.$vehicleIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                            @else
                                                                                            {!! Form::text('vehicle['.$vehicleIndex.'][vehicleMonthlyEmi]', null, ['class' => 'form-control','id'=>'vehicle_vehicleMonthlyEmi_'.$vehicleIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            @endfor
                                                                            {!! Form::hidden('vehicleLib',$overIndex, ['id'=>'vehicleLib'],$overIndex) !!}

                                                                            {!! Form::hidden('counter_VL_storage', 0, array('id' => 'counter_VL_storage')) !!}
                                                                            {!! Form::hidden('no_of_VL_opened_containers', 1, array('id' => 'no_of_VL_opened_containers')) !!}

                                                                            <div class="form-group" style="padding-left: 20px;">
                                                                                <button class="btn btn-primary add_promo_button" id="add_vehicle_details" type="button" style="font-weight:bold;" =""="">Add vehicle</button>
                                                                                <button class="btn btn-warning rem_promo_button" id="remove_vehicle_details" type="button" style="font-weight: bold; display: none;" =""="">Remove Card</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- Vehicle Loan End --}}



                                                                {{--  Credit Card Details Start --}}
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading accordian">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                                                                            Credit Card Details</a>
                                                                        </h4>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="creditCardDetailsNo" value="none" id='creditCardDetailsNo'  checked="checked">No
                                                                        </div>
                                                                        <div style="float:right;margin-top:-15px">
                                                                            <input type="radio" name="creditCardDetailsNo" value="" id='creditCardDetailsYes'> Yes 
                                                                        </div>
                                                                    </div>
                                                                    <div id="collapseNine" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="row collapse in" id="creditcardLoanDiv">
                                                                                @for($creditIndex = 0; $creditIndex < $maxCreditCards; $creditIndex++)
                                                                                @if($creditIndex == 0)   
                                                                                <div id="promo_cc_{{$creditIndex}}" class="panel panel-success">
                                                                                    @else
                                                                                    <div id="promo_cc_{{$creditIndex}}" class="panel panel-success collapse">
                                                                                        <div class="panel-heading">Add Credit Card - {{($creditIndex)}}</div>
                                                                                        @endif  
                                                                                        <div class="row" style="margin-left: auto;">
                                                                                            <div class="col-md-5">
                                                                                                <div class="form-group" style="margin-left: auto;">
                                                                                                    {!! Form::label('liab_credit_card_issuer','Name of Card Issuer', ['class'=>'control-label']) !!}
                                                                                                    @if(isset($temp_array_creditcard[$creditIndex]['ccName'])) 
                                                                                                    {!! Form::text('creditCard['.$creditIndex.'][ccName]', $temp_array_creditcard[$creditIndex]['ccName'], ['class' => 'form-control','id'=>'creditCard_ccName_'.$creditIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                    @else
                                                                                                    {!! Form::text('creditCard['.$creditIndex.'][ccName]', null, ['class' => 'form-control','id'=>'creditCard_ccName_'.$creditIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                    @endif    
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group" style="margin-left: auto;">
                                                                                                    {!! Form::label('liab_credit_card_outstanding','Amt. Outstanding',['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                                                                    @if(isset($temp_array_creditcard[$creditIndex]['ccOutstanding'])) 
                                                                                                    {!! Form::text('creditCard['.$creditIndex.'][ccOutstanding]', $temp_array_creditcard[$creditIndex]['ccOutstanding'], ['class' => 'form-control','id'=>'creditCard_ccOutstanding_'.$creditIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                    @else
                                                                                                    {!! Form::text('creditCard['.$creditIndex.'][ccOutstanding]', null, ['class' => 'form-control','id'=>'creditCard_ccOutstanding_'.$creditIndex.'', 'placeholder'=>'Enter Name','data-mandatory'=>'M',$setDisable]) !!}
                                                                                                    @endif    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                   
                                                                                    @endfor
                                                                                     {!! Form::hidden('creditCardLib',$creditIndex, ['id'=>'creditCardLib'],$creditIndex) !!}

                                                                                    {!! Form::hidden('counter_CL_storage', 0, array('id' => 'counter_CL_storage')) !!}
                                                                                    {!! Form::hidden('no_of_CL_opened_containers', 1, array('id' => 'no_of_CL_opened_containers')) !!}

                                                                                    <div class="form-group" style="padding-left: 20px;">
                                                                                        <button class="btn btn-primary add_promo_button" id="add_cradit_details" type="button" style="font-weight:bold;" =""="">Add Credit Card</button>
                                                                                        <button class="btn btn-warning rem_promo_button" id="remove_cradit_details" type="button" style="font-weight: bold; display: none;" =""="">Remove Credit Card</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Credit Card Details End--}}

                                                    {{--  Summary Start --}}
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                        <div class="panel panel-success">
                                                            <div class="panel-heading">Summary</div>
                                                            <div class="panel-body">
                                                                <div class="col-md-6">

                                                                    @if($deletedQuestionHelper->isQuestionValid("B2.4"))
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading accordian">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#">Total Assets Owned ( <i class="fa fa-rupee"></i> <span id="totalAssets"></span> Lacs )</a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseFour" class="panel-collapse collapse">
                                                                            <div class="panel-body">
                                                                                <div class="row collapse in" id="otherAssetsDiv">
                                                                                    <div class="row" style="margin-left: auto;">
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group" style="margin-left: auto;">
                                                                                                {!! Form::label('propertieso_owned','Properties Owned', ['class'=>'control-label']) !!}
                                                                                                {!! Form::select('propertytype', [' ' => 'Select Property Type','0' => 'Land','1' => 'Residential Flat/House','2' => 'Commercial'],null,['id' => 'propertytype', 'class'=>'form-control',$setDisable]) !!}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if($deletedQuestionHelper->isQuestionValid("B2.10"))
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading accordian">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#">Total Liabilities ( <i class="fa fa-rupee"></i>
                                                                                    <span id="totalLiabilities" name="total_liablity"></span> Lacs )
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseTen" class="panel-collapse collapse">
                                                                            <div class="panel-body">
                                                                                <div class="row collapse in" id="LiabilitiesDiv">
                                                                                    <div class="row" style="margin-left: auto;">
                                                                                        <div class="col-md-5">
                                                                                            <div class="form-group" style="margin-left: auto;">
                                                                                                {!! Form::label('liab_properties_owned','Properties Owned', ['class'=>'control-label']) !!}
                                                                                                {!! Form::select('liab_properties_owned', [' ' => 'Select Property Type','0' => 'Land', '1' => 'Residential Flat/House','2' => 'Commercial'],null,['id' => 'liab_properties_owned', 'class'=>'form-control',$setDisable]) !!}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-12">
                                                                    @if($deletedQuestionHelper->isQuestionValid("B2.11"))
                                                                    <div class="row">
                                                                        <div class="text-center">
                                                                            <h3><span>Net worth : <span class="fa fa-inr"></span> <span id="networth" name="networth"></span> Lacs </span>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 "><div class="center-align" ></div> </div>
                                                <div class="row">
                                                    <div class="col-md-12" style="margin-left:20px;">
                                                        <div id="currentSection">
                  {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}

                 {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
    
                 {!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
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
<script type="text/javascript">

    var isFunded = {{$isFunded}};
    $(document).ready(function () {
      $("#additionalIncome").keypress(function(e){
        if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57 ) || $(this).val().length == 0 && e.which == 48)
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
      $('#education_degree').select2({
        allowClear: true,
        placeholder: "Select Degree"
    });
      var add_property_count = 1;
      var cnt = 1;
      $('#divTab_sub1').show();
      $('#divTab_sub2').hide();
      $('#divTab_sub3').hide();
      $('#saveDetails').hide();
      $('#raise_query').hide();
      $(lnkLoanDtls1).click(function () {
        $('#divTab_sub1').show();
        $('#currentSection').show();
        cnt = 1;
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
        cnt = 2;
        $('#divTab_sub1').hide();
        $('#divTab_sub3').hide();
        $('#nextIn').show();
        $('#backIn').show();
        $(this).addClass("active").siblings().removeClass("active");
    // $('#saveDetails').hide();
    // $('#raise_query').hide();
    checkIsCompanyVCFunded();
});
      $(lnkLoanDtls3).click(function () {
        $('#divTab_sub3').show();
        cnt = 3;
        $('#divTab_sub1').hide();
        $('#divTab_sub2').hide();
    //$('#currentSection').hide();
    $('#nextIn').hide();
    $('#backIn').show();
    $(this).addClass("active").siblings().removeClass("active");
    $('#saveDetails').show();
    $('#raise_query').show();
});
      /*---- end toggle function*/
      if (cnt == 1) {
        $('#backIn').hide();
    }
    $("#nextIn").click(function () {
    //alert(cnt);
    console.log('cnt -----',cnt);
    if (cnt == 1) {
      if ($('#divTab_sub' + cnt).css('display') == 'block') {
        if (validateForm('#divTab_sub' + cnt)) {
          $('#divTab_sub' + cnt).hide();
          $('#lnkLoanDtls' + cnt).removeClass('active');
          cnt++;
          $('#lnkLoanDtls' + cnt).removeClass('disabled');
          $('#lnkLoanDtls' + cnt).addClass('active');
          $('#divTab_sub' + cnt).show();
          $('#backIn').show();
          /*$('#saveDetails').hide();
          $('#raise_query').hide();*/
          checkIsCompanyVCFunded();
      }
  }
}
else if (cnt == 2) {
  if ($('#divTab_sub' + cnt).css('display') == 'block') {
    if (validateForm('#divTab_sub' + cnt)) {
      $('#divTab_sub' + cnt).hide();
          // $('#currentSection').hide();
          $('#lnkLoanDtls' + cnt).removeClass('active');
          cnt++;
          $('#lnkLoanDtls' + cnt).removeClass('disabled');
          $('#lnkLoanDtls' + cnt).addClass('active');
          $('#divTab_sub' + cnt).show();
          $('#nextIn').hide();
          $('#backIn').show();
          $('#saveDetails').show();
          $('#raise_query').show();
      }
  }
}
else if (cnt == 3) {
  if ($('#divTab_sub' + cnt).css('display') == 'block') {
    if (validateForm('#divTab_sub' + cnt)) {
      $('#divTab_sub' + cnt).hide();
          //$('#currentSection').hide();
          $('#lnkLoanDtls' + cnt).removeClass('active');
          cnt++;
          $('#lnkLoanDtls' + cnt).removeClass('disabled');
          $('#lnkLoanDtls' + cnt).addClass('active');
          $('#divTab_sub' + cnt).show();
          $('#saveDetails').show();
          $('#raise_query').show();
      }
  }
}
}); 
    $("#backIn").click(function () {
        $('#nextIn').show();
        $('#divTab_sub' + cnt).hide();
        $('#lnkLoanDtls' + cnt).removeClass('active');
        cnt--;
        if (cnt == 1) {
          $('#backIn').hide();
      }
      $('#divTab_sub' + cnt).show();
      $('#lnkLoanDtls' + cnt).addClass('active');
      $('#lnkLoanDtls' + cnt).removeClass('disabled');
      $('#saveDetails').hide();
      $('#raise_query').hide();
  });
    $('#saveDetails').click(function (e) {
        if (cnt == 3) {
          if (validateForm('#divTab_sub' + cnt, '#promter')) {
            return true;
        } else {
            e.preventDefault();
        }
    }
});
    $('input[name="othr_promoterare"]').change(function () {
    // if (isFunded) {
    //     if ($('input[name="othr_promoterare"]:checked').val() == "1") {
    //         $('#nextIn').hide();
    //         $('#saveDetails').show();
    //         $('#raise_query').show();
    //         $('#lnkLoanDtls3').addClass('disabled');
    //     } else {
    //         $('#nextIn').show();
    //         $('#saveDetails').hide();
    //         $('#raise_query').hide();
    //         $('#lnkLoanDtls2').addClass('disabled');
    //     }
    // } else {
    //     $('#nextIn').show();
    //     $('#saveDetails').show();
    //     $('#raise_query').show();
    // }
    if ((isFunded) && $('input[name="othr_promoterare"]:checked').val() == "1" || !(isFunded) && $('input[name="othr_promoterare"]:checked').val() == "1") {
      $('#nextIn').hide();
      $('#saveDetails').show();
      $('#raise_query').show();
      $('#lnkLoanDtls3').addClass('disabled');
  } else {
      $('#nextIn').show();
      $('#saveDetails').hide();
      $('#raise_query').hide();
      $('#lnkLoanDtls3').removeClass('disabled');
  }
});
});
@for ($recordNum = 0; $recordNum < 5;
  $recordNum++
  )
$('#promoters_address_prooftype_{{{$recordNum}}}').select2({
  allowClear: true,
  placeholder: "Select Address Proof Type"
});
$('#states_{{{$recordNum}}}').select2({
  allowClear: true,
  placeholder: "Select State"
});
@endfor
$("#apprx_market_value_vehicle").change(function () {
  calculateTotalAssetLiabilities();
});
$("#apprx_market_value_property_1").change(function () {
  calculateTotalAssetLiabilities();
});
$("#apprx_market_value_property_2").change(function () {
  calculateTotalAssetLiabilities();
});
$("#apprx_market_value_property_3").change(function () {
  calculateTotalAssetLiabilities();
});
$("#apprx_market_value_other_property").change(function () {
  calculateTotalAssetLiabilities();
});
$("#fixed_deposits").change(function () {
  calculateTotalAssetLiabilities();
});
$("#mutual_funds").change(function () {
  calculateTotalAssetLiabilities();
});
$("#listed_shares_owned").change(function () {
  calculateTotalAssetLiabilities();
});
$("#liab_personal_total").change(function () {
  calculateTotalAssetLiabilities();
});
$("#liab_vehicle_total").change(function () {
  calculateTotalAssetLiabilities();
});
$("#liab_mortgage_total").change(function () {
  calculateTotalAssetLiabilities();
});
$("#liab_others_total").change(function () {
  calculateTotalAssetLiabilities();
});
$("#liab_credit_card_total").change(function () {
  calculateTotalAssetLiabilities();
});



$("#vehicle_vehicleOutstanding_0,#vehicle_vehicleOutstanding_1,#vehicle_vehicleOutstanding_2").change(function () {
  calculateTotalAssetLiabilities();
    
});
$("#overdraft_overOutstanding_0,#overdraft_overOutstanding_1,#overdraft_overOutstanding_2").change(function () {
  calculateTotalAssetLiabilities();
   
});


$("#mortgage_mortOutstanding_0,#mortgage_mortOutstanding_1,#mortgage_mortOutstanding_2").change(function () {
  calculateTotalAssetLiabilities();
});

$("#creditCard_ccOutstanding_0,#creditCard_ccOutstanding_1,#creditCard_ccOutstanding_2").change(function () {
    
  calculateTotalAssetLiabilities();
});



function calculateTotalAssetLiabilities() {
  var vehiclesValue = 0;
  var propertiesMktValueSum = 0;
  var fixedDeposits = 0;
  var mutualFunds = 0;
  var listedShares = 0;
  var personalTotal = 0;
  var vehicleTotal = 0;
  var mortgageTotal = 0;
  var othersTotal = 0;
  var creditcardTotal = 0;
  var totalAssets = 0;
  var totalLiabilities = 0;
  var overdraftSum = 0;
  var vechicleLibSum = 0;
  var mortgageSum = 0;
  var creditCardSum = 0;
  if ($.isNumeric($('#apprx_market_value_vehicle').val())) {
    vehiclesValue = $('#apprx_market_value_vehicle').val();
}
if ($.isNumeric($('#fixed_deposits').val())) {
    fixedDeposits = $('#fixed_deposits').val();
}
if ($.isNumeric($('#mutual_funds').val())) {
    mutualFunds = $('#mutual_funds').val();
}
if ($.isNumeric($('#listed_shares_owned').val())) {
    listedShares = $('#listed_shares_owned').val();
}

var noOverdraft = $('#overdraftLib').val();
if (noOverdraft <= 4) {
    for (var indexOver = 0; indexOver <= 4; indexOver++) {
      var overdraftVal = $('#overdraft_overOutstanding_' + indexOver).val();
      if ($.isNumeric(overdraftVal)) {
        overdraftSum += Number(overdraftVal);
    }
}

}

var noVehicleLib = $('#vehicleLib').val();
if (noVehicleLib <= 4) {
    for (var indexNoVechi = 0; indexNoVechi <= 4; indexNoVechi++) {
      var vehicleVal = $('#vehicle_vehicleOutstanding_' + indexNoVechi).val();
      if ($.isNumeric(vehicleVal)) {
        vechicleLibSum += Number(vehicleVal);
    }
}

}

var noMortgage = $('#mortgageLib').val();
if (noMortgage <= 4) {
    for (var indexMortgage = 0; indexMortgage <= 4; indexMortgage++) {
      var mortgageVal = $('#mortgage_mortOutstanding_' + indexMortgage).val();
      if ($.isNumeric(mortgageVal)) {
        mortgageSum += Number(mortgageVal);
    }
}

}  

var noCreditCard = $('#creditCardLib').val();

if (noCreditCard <= 4) {
    for (var indexCreditCard = 0; indexCreditCard <= 4; indexCreditCard++) {
      var creditCardVal = $('#creditCard_ccOutstanding_' + indexCreditCard).val();
      if ($.isNumeric(creditCardVal)) {
        creditCardSum += Number(creditCardVal);
    }
}

}

var noOfProperties = $('#no_of_property').val();
if (noOfProperties <= 4) {
    for (var index = 1; index <= 3; index++) {
      var propertyVal = $('#apprx_market_value_property_' + index).val();
      if ($.isNumeric(propertyVal)) {
        propertiesMktValueSum += Number(propertyVal);
    }
}
if (noOfProperties == 4) {
  var propertyVal = $('#apprx_market_value_other_property').val();
  if ($.isNumeric(propertyVal)) {
    propertiesMktValueSum += Number(propertyVal);
}
}
}
  //Calculate total liabilities
  if ($.isNumeric($('#liab_personal_total').val())) {
    personalTotal = $('#liab_personal_total').val();
}
if ($.isNumeric($('#liab_vehicle_total').val())) {
    vehicleTotal = $('#liab_vehicle_total').val();
}
if ($.isNumeric($('#liab_mortgage_total').val())) {
    mortgageTotal = $('#liab_mortgage_total').val();
}
if ($.isNumeric($('#liab_others_total').val())) {
    othersTotal = $('#liab_others_total').val();
}
if ($.isNumeric($('#liab_credit_card_total').val())) {
    creditcardTotal = $('#liab_credit_card_total').val();
}

totalAssets = Number(vehiclesValue) + Number(propertiesMktValueSum) + Number(fixedDeposits) + Number(mutualFunds) + Number(listedShares);
totalLiabilities = Number(personalTotal) + Number(vehicleTotal) + Number(mortgageTotal) + Number(othersTotal) + Number(creditcardTotal)
+Number(overdraftSum)+Number(vechicleLibSum)+Number(mortgageSum)+Number(creditCardSum);
$('#totalAssets').text(totalAssets);
$('#totalLiabilities').text(totalLiabilities);
$('#networth').text(Number(totalAssets) - Number(totalLiabilities));
}
calculateTotalAssetLiabilities();



/**********KYC Promoter Start******/
var counter = 0;            // Hidden Field Counter Variable
var existing_records = {{$existingPromoterKycCount}}; // If any existing Record in database
var add_button = jQuery("#add_promoter_director");
var delete_button = jQuery("#rem_promoter_director");  

//var no_of_opened_containers = $("#no_of_opened_containers").val();
for (var i = 0; i < existing_records; i++) {
  $("#promo_" + i).collapse("show");
  $("#address_" + i).collapse("show");
  counter = i;
  $("#counter_storage").val(i);
  
}
var a = $("#counter_storage").val();
if (a > 0) {
  for (var i = 1; i <= a; i++) {
    $("#promo_" + i).collapse("show");
    $("#address_" + i).collapse("show");
    if (i == 4) {
      $("#add_promoter_director").hide();
  }
  counter = i;
}
}
if (counter == 0) {
  $(delete_button).hide();
}
$(add_button).click(function (e) {
  e.preventDefault();
  counter++;  //1
  $("#counter_storage").val(counter);  //
  existing_records++;  
  $("#promo_" + counter).collapse("show");
  //$("#counter_storage").val(existing_records);
  if (counter >= 1) {
    $("#address_0").collapse("show");
    $("#address_" + counter).collapse("show");
}
if (counter == 4) {
    $(this).hide();
}
if (counter > 0) {
    $(delete_button).show();
}
});
$(delete_button).click(function (e) {
  e.preventDefault();
  $("#promo_" + counter).collapse("hide");
  counter--;
  $("#counter_storage").val(counter);
  existing_records--;
  //$("#counter_storage").val(existing_records);
  if (counter == 0) {
    $(delete_button).hide();
    $("#address_" + counter).collapse("hide");
}
if (counter < 4) {
    $(add_button).show();
}
console.log(counter);
});
/**********KYC Promoter End******/


/*****Loan Overdraft Start******/
var overdraftCounter = 0;    
var existing_overdraft_records = {{$existingLoanOverdraftCount}};  
var add_overdraft_button = jQuery("#add_overdraft_details");
var delete_overdraft_button = jQuery("#remove_overdraft_details");
/*var no_of_opened_containers = $("#no_of_OD_opened_containers").val();*/

for (var i = 0; i < existing_overdraft_records; i++) {
  $("#promo_over_" + i).collapse("show");
  
  overdraftCounter = i;
  $("#counter_OD_storage").val(i);
}
var a = $("#counter_OD_storage").val();
if (a > 0) {
  for (var i = 1; i <= a; i++) {
    $("#promo_over_" + i).collapse("show");
    
    if (i == 3) {
      $("#add_cradit_details").hide();
  }
  overdraftCounter = i;

}
}
if (overdraftCounter == 0) {
  $(delete_overdraft_button).hide();
}

$(add_overdraft_button).click(function (e) {
  e.preventDefault();
  
  overdraftCounter++;  //1
  $("#counter_OD_storage").val(overdraftCounter);  //
  existing_overdraft_records++;  
  $("#promo_over_" + overdraftCounter).collapse("show");
  
  
  if (overdraftCounter == 3) {
    $(this).hide();
}
if (overdraftCounter > 0) {
    $(delete_overdraft_button).show();
}
});
//Remove overdraft Card
$(delete_overdraft_button).click(function (e) {
  e.preventDefault();
  $("#promo_over_" + overdraftCounter).collapse("hide");
  overdraftCounter--;
  $("#counter_OD_storage").val(overdraftCounter);
  existing_records--;
  //$("#counter_storage").val(existing_records);
  if (overdraftCounter == 0) {
    $(delete_overdraft_button).hide();
    $("#address_" + overdraftCounter).collapse("hide");
}
if (overdraftCounter < 3) {
    $(add_overdraft_button).show();
}
});
/*****Loan Overdraft End******/

//*****Properties Owned Start******//
$(document).ready(function () {
  $('#add_property').click(function () {
    add_property_count = add_property_count + 1;
    $('#property_' + add_property_count).show();
    if (add_property_count == 3) {
      $('#add_property').hide();
  }
  else {
      $('#add_property').show();
  }
  if (add_property_count == 1) {
      $('#rem_property').hide();
  }
  else {
      $('#rem_property').show();
  }
});
  $('#rem_property').click(function () {
    $('#property_' + add_property_count).hide();
    add_property_count = add_property_count - 1;
    if (add_property_count == 3) {
      $('#add_property').hide();
  }
  else {
      $('#add_property').show();
  }
  if (add_property_count == 1) {
      $('#rem_property').hide();
  }
  else {
      $('#rem_property').show();
  }
});
  //==========================================//
  var choosen_no_property = 0;
  choosen_no_property = $("#no_of_property").val();
  choosen_no_property = $('#no_property_owned_count').val(choosen_no_property).val();
  if (choosen_no_property > 0) {
    $("#propertyDetails").collapse("show");
    for (var index = 1; index <= choosen_no_property; index++) {
      $("#propertyDetails_" + index).collapse("show");
      $('#propertytype' + index).select2({
        allowClear: true,
        placeholder: "Select Option",
        width: '100%'
    });
      $('#propertyno' + index).select2({
        allowClear: true,
        placeholder: "Select Option",
        width: '100%'
    });
  }
}
$("#no_of_property").change(function () {
    var propertyCount = $(this).val();
    if (propertyCount == 0) {
      $("#propertyDetails").collapse("hide");
      for (var index = 4; index >= 1; index--) {
        $("#propertyDetails_" + index).collapse("hide");
    }
} else {
  if (propertyCount == 4) {
    $("#propertyDetails_4").collapse("show");
    propertyCount = 3;
}
$("#propertyDetails").collapse("show");
for (var index = 1; index <= propertyCount; index++) {
    $("#propertyDetails_" + index).collapse("show");
    $('#propertytype' + index).select2({
      allowClear: true,
      placeholder: "Select Option",
      width: '100%'
  });
    $('#propertyno' + index).select2({
      allowClear: true,
      placeholder: "Select Option",
      width: '100%'
  });
}
for (var index = 4; index > propertyCount; index--) {
    $("#propertyDetails_" + index).collapse("hide");
}
}
if ($(this).val() === ' ') {
  $("#propertyDetails").collapse("hide");
} else if ($(this).val() == 'None') {
  $("#propertyDetails").collapse("hide");
}
else {
  $("#propertyDetails").collapse("show");
}
    //alert(propertyCount);
});
$("#propertyno1").change(function () {
    if (($("#propertyno1").val() == 'Other')) {
      $('#custom_cityName_1').collapse("show");
  } else {
      $('#custom_cityName_1').collapse("hide");
  }
});
$("#propertyno2").change(function () {
    if (($("#propertyno2").val() == 'Other')) {
      $('#custom_cityName_2').collapse("show");
  } else {
      $('#custom_cityName_2').collapse("hide");
  }
});
$("#propertyno3").change(function () {
    if (($("#propertyno3").val() == 'Other')) {
      $('#custom_cityName_3').collapse("show");
  } else {
      $('#custom_cityName_3').collapse("hide");
  }
});
if (($("#propertyno1").val() == 'Other')) {
    $('#custom_cityName_1').collapse("show");
} else {
    $('#custom_cityName_1').collapse("hide");
}
if (($("#propertyno2").val() == 'Other')) {
    $('#custom_cityName_2').collapse("show");
} else {
    $('#custom_cityName_2').collapse("hide");
}
if (($("#propertyno3").val() == 'Other')) {
    $('#custom_cityName_3').collapse("show");
} else {
    $('#custom_cityName_3').collapse("hide");
}
/********** Properties Owned End*****/



/****Credit Card Add  Start****/
var creditCounter = 0;    
var add_credit_button = jQuery("#add_cradit_details");
var delete_credit_button = jQuery("#remove_cradit_details");
var no_of_opened_containers = $("#no_of_opened_containers").val();
  var existing_credit_records = {{$existingCreditCardCount}}; // If any existing Record in database
  for (var i = 0; i < existing_credit_records; i++) {
    $("#promo_cc_" + i).collapse("show");
    
    creditCounter = i;
    $("#counter_CL_storage").val(i);
}
var a = $("#counter_CL_storage").val();
if (a > 0) {
    for (var i = 1; i <= a; i++) {
      $("#promo_cc_" + i).collapse("show");
      
      if (i == 4) {
        $("#add_cradit_details").hide();
    }
    creditCounter = i;
}
}
if (creditCounter == 0) {
    $(delete_credit_button).hide();
}

$(add_credit_button).click(function (e) {
    e.preventDefault();
    e.preventDefault();
    creditCounter++;  //1
    $("#counter_CL_storage").val(creditCounter);  //
    existing_credit_records++;  
    $("#promo_cc_" + creditCounter).collapse("show");
    
    
    if (creditCounter == 4) {
      $(this).hide();
  }
  if (creditCounter > 0) {
      $(delete_credit_button).show();
  }
});
  //Remove Credit Card
  $(delete_credit_button).click(function (e) {
    e.preventDefault();
    $("#promo_cc_" + creditCounter).collapse("hide");
    creditCounter--;
    $("#counter_CL_storage").val(creditCounter);
    existing_records--;
    //$("#counter_storage").val(existing_records);
    if (creditCounter == 0) {
      $(delete_credit_button).hide();
    
  }
  if (creditCounter < 4) {
      $(add_credit_button).show();
  }
});
  /****Credit Card Add  End****/
  
  
  
  
  
  
  
  
  /****Mortgage Loan Add  ****/
  var mortgageCounter = 0;    
  var existing_mortgage_records = {{$existingLoansMortgageCount}}; // If any existing Record in database
  var add_mortgage_button = jQuery("#add_mortgage_details");
  var delete_mortgage_button = jQuery("#remove_mortgage_details");
  /*var no_of_opened_containers = $("#no_of_opened_containers").val();*/
  
  for (var i = 0; i < existing_mortgage_records; i++) {
    $("#promo_mort_" + i).collapse("show");
    
    mortgageCounter = i;
    $("#counter_ML_storage").val(i);
}
var a = $("#counter_ML_storage").val();
if (a > 0) {
    for (var i = 1; i <= a; i++) {
      $("#promo_mort_" + i).collapse("show");
      
      if (i == 4) {
        $("#add_cradit_details").hide();
    }
    mortgageCounter = i;
}
}
if (mortgageCounter == 0) {
    $(delete_mortgage_button).hide();
}

$(add_mortgage_button).click(function (e) {
    e.preventDefault();
    e.preventDefault();
    mortgageCounter++;  //1
    $("#counter_ML_storage").val(mortgageCounter);  //
    existing_mortgage_records++;  
    $("#promo_mort_" + mortgageCounter).collapse("show");
    
    
    if (mortgageCounter == 4) {
      $(this).hide();
  }
  if (mortgageCounter > 0) {
      $(delete_mortgage_button).show();
  }
});
  //Remove mortgage Card
  $(delete_mortgage_button).click(function (e) {
    e.preventDefault();
    $("#promo_mort_" + mortgageCounter).collapse("hide");
    mortgageCounter--;
    $("#counter_ML_storage").val(mortgageCounter);
    existing_records--;
    //$("#counter_storage").val(existing_records);
    if (mortgageCounter == 0) {
      $(delete_mortgage_button).hide();
      //$("#address_" + mortgageCounter).collapse("hide");
  }
  if (mortgageCounter < 4) {
      $(add_mortgage_button).show();
  }
});
  /****Mortgage Loan End  ****/
  
  
  
  /*****Vehicle Loan Start******/
  
  var vehicleCounter = 0;    
  var add_vehicle_button = jQuery("#add_vehicle_details");
  var delete_vehicle_button = jQuery("#remove_vehicle_details");
  var no_of_opened_containers = $("#no_of_opened_containers").val();
  var existing_vehicle_records = {{$existingLoanVechicleCount}}; // If any existing Record in database
  for (var i = 0; i < existing_vehicle_records; i++) {
    $("#promo_vehicle_" + i).collapse("show");
    
    vehicleCounter = i;
    $("#counter_VL_storage").val(i);
}
var a = $("#counter_VL_storage").val();
if (a > 0) {
    for (var i = 1; i <= a; i++) {
      $("#promo_vehicle_" + i).collapse("show");
      
      if (i == 4) {
        $("#add_vehicle_details").hide();
    }
    vehicleCounter = i;
}
}
if (vehicleCounter == 0) {
    $(delete_vehicle_button).hide();
}

$(add_vehicle_button).click(function (e) {
    e.preventDefault();
    
    vehicleCounter++;  //1
    $("#counter_VL_storage").val(vehicleCounter);  //
    existing_vehicle_records++;  
    $("#promo_vehicle_" + vehicleCounter).collapse("show");
    
    
    if (vehicleCounter == 4) {
      $(this).hide();
  }
  if (vehicleCounter > 0) {
      $(delete_vehicle_button).show();
  }
});
  //Remove vehicle Card
  $(delete_vehicle_button).click(function (e) {
    e.preventDefault();
    $("#promo_vehicle_" + vehicleCounter).collapse("hide");
    vehicleCounter--;
    $("#counter_VL_storage").val(vehicleCounter);
    existing_records--;
    //$("#counter_storage").val(existing_records);
    if (vehicleCounter == 0) {
      $(delete_vehicle_button).hide();
      $("#address_" + vehicleCounter).collapse("hide");
  }
  if (vehicleCounter < 4) {
      $(add_vehicle_button).show();
  }
});
  /*****Vehicle Loan End******/
  
  $("#cibilScoreContainer").hide();
  $("#cibilScoreYes").click(function () {
    $("#cibilScoreContainer").show();
});
  $("#cibilScoreNo").click(function () {
    $("#cibilScoreContainer").hide();
});
  var cibilScr = '{{$model['othr_doyouknowcibil']}}';
  
  if (cibilScr == 'Yes') {
    $("#cibilScoreContainer").show();
}
var jArray = <?php echo json_encode($temp_array); ?>;
if (jArray.length > 0) {
    $('#lnkLoanDtls1').removeClass('disabled');
}
if ($('#education_degree').val() != '') {
    $('#lnkLoanDtls3').removeClass('disabled');
} else {
    $('#lnkLoanDtls3').addClass('disabled');
}
  //alert($('#no_of_property').val());
  if ($('#no_of_property').val() != '') {
    $('#lnkLoanDtls2').removeClass('disabled');
} else {
    $('#lnkLoanDtls2').addClass('disabled');
}
}
);
$('#isvehicleold').select2({
  allowClear: true,
  placeholder: "Select Option",
  width: '100%'
});
$('#no_of_property').select2({
  allowClear: true,
  placeholder: "Select Option",
  width: '100%'
});
$('#propertytype').select2({
  allowClear: true,
  placeholder: "Select Option", width: '100%'
});

//Collaspe Other Assets Owned
collapseAsset=$('#fixed_deposits').val();
if(collapseAsset!=''){
  $("#collapseThree").collapse("show");
  $("#otherAssetYes").attr('checked', 'checked');
}

vehiclesValue = $('#apprx_market_value_vehicle').val();
if(vehiclesValue!=''){
  $("#collapseOne").collapse("show");
  $(".all").attr('checked', 'checked');
}
$(".all").click(function() {
  $("#collapseOne").collapse("show");
});
collapseTwovar=$('#no_of_property').val();
if(collapseTwovar!=''){
  $("#collapseTwo").collapse("show");
  $("#propertyYes").attr('checked', 'checked');
}

/*Collapse Libilities*/
//Personal Loan/Overdraft
collapseOD=$('#overdraft_overOutstanding_0').val();
if(collapseOD!=''){
  $("#collapseFive").collapse("show");
  $("#personalLoanYes").attr('checked', 'checked');
}
//Vehicle Loan
collapseVechileLoan=$('#vehicle_vehicleOutstanding_0').val();
if(collapseVechileLoan!=''){
  $("#collapseSix").collapse("show");
  $("#vechicleYes").attr('checked', 'checked');
}
//Vehicle Loan
collapseMortgageLoan=$('#mortgage_mortOutstanding_0').val();
if(collapseMortgageLoan!=''){
  $("#collapseSeven").collapse("show");
  $("#mortgageLoanYes").attr('checked', 'checked');
}

//Credit Card Details
collapseCreitCardLoan=$('#creditCard_ccOutstanding_0').val();
if(collapseCreitCardLoan!=''){
  $("#collapseNine").collapse("show");
  $("#creditCardDetailsYes").attr('checked', 'checked');
}

/*//Credit Card Details
collapseCreitCardLoan=$('#vehicle_vehicleOutstanding_0').val();
if(collapseCreitCardLoan!=''){
$("#collapseNine").collapse("show");
$("#creditCardDetailsYes").attr('checked', 'checked');
}*/


/*collapseTwovar=$('#no_of_property').val();
if(collapseTwovar!=''){
$("#collapseTwo").collapse("show");
$("#propertyYes").attr('checked', 'checked');
}*/

$(".none").click(function() {
  $("#collapseOne").collapse("hide");
  $("input[name=fin_vehiclesowned_marketvalue]").val("0");
  $("#overdraft_overOutstanding_0,#overdraft_overOutstanding_1,#overdraft_overOutstanding_0").val("0");
  calculateTotalAssetLiabilities();
  $("#isvehicleold").select2("val", "");
}); 

$("#propertyNo").click(function() {
  $("#collapseTwo").collapse("hide");
  $("#no_of_property").select2("val","");
}); 
$("#propertyYes").click(function() {
  $("#collapseTwo").collapse("show");
});
$("#otherAssetNo").click(function() {
  $("#collapseThree").collapse("hide");
  $("input[name=fin_fixeddeposit],input[name=fin_mutualfunds],input[name=fin_listedshares]").val("0");
  calculateTotalAssetLiabilities();
  //$("input[name=fin_fixeddeposit],input[name=fin_mutualfunds],input[name=fin_listedshares]").val("0");
}); 
$("#otherAssetYes").click(function() {
  $("#collapseThree").collapse("show");
});
$("#personalLoanNo").click(function() {
  $("#collapseFive").collapse("hide");
  $("input[name=pl_bankname],input[name=pl_amtoutstanding],input[name=pl_monthlyemi]").val("");
  $("input[name=pl_amtoutstanding],input[name=pl_monthlyemi]").val("0");
}); 
liab_personal_bank=$('#liab_personal_bank').val();
if(liab_personal_bank!=''){
  // $("#collapseSix").collapse("show");
}
$("#personalLoanYes").click(function() {
  $("#collapseFive").collapse("show");
});
$("#vechicleNo").click(function() {
  $("input[name=vloan_bankname],input[name=vloan_amtoutstanding],input[name=vloan_totalliability]").val("");
  calculateTotalAssetLiabilities();
  $("#collapseSix").collapse("hide");
}); 
$("#vechicleYes").click(function() {
  $("#collapseSix").collapse("show");
}); 
$("#mortgageLoanNo").click(function() {
  $("input[name=mortloan_bankname],input[name=mortloan_amtoutstanding],input[name=mortloan_monthlyemi]").val("");
  calculateTotalAssetLiabilities();
  $("#collapseSeven").collapse("hide");
}); 
$("#mortgageLoanYes").click(function() {
  $("#collapseSeven").collapse("show");
});
$("#OtherBorrowingsLoanNo").click(function() {
  $("#collapseEight").collapse("hide");
}); 
$("#OtherBorrowingsLoanYes").click(function() {
  $("#collapseEight").collapse("show");
});
liab_credit_card_issuer=$('#liab_credit_card_issuer').val();
if(liab_credit_card_issuer!=''){
  // $("#collapseNine").collapse("show");
  //  $("#creditCardDetailsYes").attr('checked', 'checked');
}
$("#creditCardDetailsNo").click(function() {
  $("input[name=cc_bankname]").val(""); 
  $("input[name=cc_amtoutstanding]").val("0"); 
  calculateTotalAssetLiabilities();
  //$("input[name=cc_bankname]").val(""); 
  $("#collapseNine").collapse("hide");
}); 
$("#creditCardDetailsYes").click(function() {
  $("#collapseNine").collapse("show");
});
@if(isset($model->othr_sourceofincome) && $model->othr_sourceofincome != NULL)
document.getElementById('othr_income_yes').checked = true;
$("#otherIncomeSources").show()
@else
document.getElementById('othr_income_no').checked = true;
$("#otherIncomeSources").hide()
@endif
$('input:radio[name="othr_income"]').change(
  function(){
    if ($(this).val() == '1') {
      $("#otherIncomeSources").show()
  } else{
      $("#otherIncomeSources").hide()
  }
}
);
function checkIsCompanyVCFunded() {
  console.log('called');
  if ((isFunded) && $('input[name="othr_promoterare"]:checked').val() == "1" || !(isFunded) && $('input[name="othr_promoterare"]:checked').val() == "1") {
    $('#nextIn').hide();
    $('#saveDetails').show();
    $('#raise_query').show();
    $('#lnkLoanDtls3').addClass('disabled');
} else {
    $('#nextIn').show();
    $('#saveDetails').hide();
    $('#raise_query').hide();
    $('#lnkLoanDtls3').removeClass('disabled');
}
}


</script>
