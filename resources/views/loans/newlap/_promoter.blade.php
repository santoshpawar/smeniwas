<div role="tabpanel_sub">
    <ul class="nav nav-pills responsive" role="tablist" id="procedures">
        <li id="li_sub1" class="active"><a id="lnkLoanDtls1" href="#"><span class="text">KYC Details</span></a></li>
        <li id="li_sub2"><a id="lnkLoanDtls2" href="#"><span class="text">Financial Details</span></a></li>
        <li id="li_sub3"><a id="lnkLoanDtls3" href="#"><span class="text">Other Details</span></a></li>
    </ul>
</div>


{{--========Start DivSub 1==========================================================================--}}
<div id="divTab_sub1" class="collapse">
    <div id="dynamic" class="form-group">
            <br>
        @for($formIndex=0; $formIndex < $maxPromoters; $formIndex++)

            <?php $colorstyle = ""; ?>
            @if($formIndex == 0 || $formIndex == 2 || $formIndex == 4 )

                <?php $colorstyle =  "style='padding:10px; background: cornsilk;'"; ?>
            @else
                    <?php $colorstyle =  "style='padding:10px; background: #adadad;'"; ?>
            @endif

            @if($formIndex == 0)
                <div id="promo_{{$formIndex}}" class="panel panel-info">
                    <div class="panel-heading">Main Promoters / Director</div>
            @else
                <div id="promo_{{$formIndex}}" class="panel panel-info collapse">
                    <div class="panel-heading">Additional Promoters / Director - {{($formIndex)}}</div>
            @endif
                    {!! Form::hidden('promoters['.$formIndex.'][process]', true, ['id'=> 'process'] ) !!}
                    {!! Form::hidden('promoters['.$formIndex.'][id]', null ) !!}
                    {!! Form::hidden('promoters['.$formIndex.'][loan_id]', $loanId ) !!}
                   <div class="row">
                    <br>
                   </div>
                   <div class="row">
                       <div class="col-sm-6 col-lg-4">
                            <div class="form-group required">
                                {!! Form::label('promoters.name'.$formIndex,'Name', ['class'=>'col-md-2 control-label']) !!}

                                <div class="col-md-8">
                                    @if(isset($temp_array[$formIndex]['name_of_promoter']))
                                        {!! Form::text('promoters['.$formIndex.'][name_of_promoter]', $temp_array[$formIndex]['name_of_promoter'], array('class' => 'form-control', 'id'=>'promoters.name'.$formIndex, 'placeholder'=>'Name of Promoters/Directors')) !!}
                                    @elseif($formIndex == 0)
                                        {!! Form::text('promoters['.$formIndex.'][name_of_promoter]', isset($userProfile->owner_name) ? $userProfile->owner_name : null, array('class' => 'form-control', 'id'=>'promoters.name'.$formIndex, 'placeholder'=>'Name of Promoters/Directors')) !!}
                                    @else
                                        {!! Form::text('promoters['.$formIndex.'][name_of_promoter]', null, array('class' => 'form-control', 'id'=>'promoters.name'.$formIndex, 'placeholder'=>'Name of Promoters/Directors')) !!}
                                    @endif
                                </div>
                            </div>
                       </div>
                       <div class="col-sm-6 col-lg-4">
                            <div class="form-group required">
                                {!! Form::label('promoters.din'.$formIndex,'DIN', ['class'=>'col-md-2 control-label']) !!}
                                <div class="col-md-8">
                                    @if(isset($temp_array[$formIndex]['din_of_promoter']))
                                        {!! Form::text('promoters['.$formIndex.'][din_of_promoter]', $temp_array[$formIndex]['din_of_promoter'], ['class' => 'form-control', 'id'=>'promoters.din'.$formIndex, 'placeholder'=>'Director Identification Number']) !!}
                                    @else
                                        {!! Form::text('promoters['.$formIndex.'][din_of_promoter]', null, ['class' => 'form-control', 'id'=>'promoters.din'.$formIndex, 'placeholder'=>'Director Identification Number']) !!}
                                    @endif
                                </div>
                            </div>
                       </div>
                   </div>

                    <div class="row">
                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group required">
                                {!! Form::label('promoters'.$formIndex,'PAN', ['class'=>'col-md-2 control-label']) !!}
                                <div class="col-md-8">
                                    @if(isset($temp_array[$formIndex]['pan_of_promoter']))
                                        {!! Form::text('promoters['.$formIndex.'][pan_of_promoter]', $temp_array[$formIndex]['pan_of_promoter'], ['class' => 'form-control', 'id'=>'promoters.pan'.$formIndex, 'placeholder'=>'PAN of Promoter/Director']) !!}
                                    @else
                                        {!! Form::text('promoters['.$formIndex.'][pan_of_promoter]', null, ['class' => 'form-control', 'id'=>'promoters.pan'.$formIndex, 'placeholder'=>'PAN of Promoter/Director']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-lg-4">
                            <div class="form-group required">
                                {!! Form::label('promoters_address_prooftype_'.$formIndex,'Address Proof Type', ['class'=>'col-xs-6 control-label']) !!}
                                <div class="col-xs-6">
                                {!! Form::select('promoters_address_prooftype_'.$formIndex, ['' => '','0' => 'Electricity Bill', '1' => 'Aadhaar Card', '2' => 'Ration Card', '3' => 'Passport'],'',['id' => 'promoters_address_prooftype_'.$formIndex, 'class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-10 col-lg-4">
                            <div class="form-group required">
                                {!! Form::label('promoters'.$formIndex,'Id', ['class'=>'col-md-2 control-label']) !!}
                                <div class="col-md-8">
                                    @if(isset($temp_array[$formIndex]['address_proof_id']))
                                        {!! Form::text('promoters['.$formIndex.'][address_proof_id]', $temp_array[$formIndex]['pan_of_promoter'], ['class' => 'form-control', 'id'=>'promoters.address_proof_id'.$formIndex, 'placeholder'=>'ID of the chosen address proof']) !!}
                                    @else
                                        {!! Form::text('promoters['.$formIndex.'][address_proof_id]', null, ['class' => 'form-control', 'id'=>'promoters.address_proof_id'.$formIndex, 'placeholder'=>'ID of the chosen address proof']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <div class="form-group required">
                                {!! Form::label('address', 'Address', ['class'=>'col-md-2 control-label']) !!}
                                <div class="col-md-8">
                                    @if(isset($temp_array[$formIndex]['address']))
                                        {!! Form::text('promoters['.$formIndex.'][address]', $temp_array[$formIndex]['address'], ['class' => 'form-control', 'size' => '10x5', 'id'=>'promoters.address'.$formIndex, 'placeholder'=>'Address']) !!}
                                    @else
                                        {!! Form::text('promoters['.$formIndex.'][address]', null, ['class' => 'form-control address_field', 'size' => '10x5', 'id'=>'promoters.address'.$formIndex, 'placeholder'=>'Address']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4">
                            <div class="form-group" id="state_{{$formIndex}}" >
                                {!! Form::label('state', 'State', ['class'=>'col-md-2 control-label']) !!}
                                <div class="col-xs-10">
                                    {!! Form::select('promoters['.$formIndex.'][state]',$states, $chosenState, ['id' => 'states_'.$formIndex,'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-4">
                            <div class="form-group" id="pin{{$formIndex}}" >
                                {!! Form::label('pin', 'Pincode', ['class'=>'col-md-2 control-label']) !!}
                                <div class="col-md-8">
                                    @if(isset($temp_array[$formIndex]['address']))
                                        {!! Form::text('promoters['.$formIndex.'][pincode]', $temp_array[$formIndex]['address'], ['class' => 'form-control', 'size' => '10x5', 'id'=>'promoters.pincode'.$formIndex, 'placeholder'=>'Pincode']) !!}
                                    @else
                                        {!! Form::text('promoters['.$formIndex.'][pincode]', null, ['class' => 'form-control address_field', 'size' => '10x5', 'id'=>'promoters.pincode'.$formIndex, 'placeholder'=>'Pincode']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    @endfor
    {!! Form::hidden('counter_storage', 0, array('id' => 'counter_storage')) !!}
    {!! Form::hidden('no_of_opened_containers', 1, array('id' => 'no_of_opened_containers')) !!}
    </div>
    <div class="form-group"align = "center">
        <button class="btn btn-primary add_promo_button" id="add_promoter_director" type="button">Add Promoters / Directors Details</button>
        <button class="btn btn-warning rem_promo_button" id="rem_promoter_director" type="button">Remove Promoters / Directors Details</button>
    </div>
</div>

{{--========Start DivSub 2==========================================================================--}}
<div id="divTab_sub2" class="collapse">
    <br>
    <div id="promo_{{$formIndex}}" class="panel panel-info">
      <div class="panel-heading">Assets Owned By Promoters ( <span class="fa fa-inr"></span> In Lacs )</div>
        <div class="row">
            <br>
        </div>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse" data-target="#vehiclesDiv">1.Vehicles Owned ( <span class="fa fa-inr"></span> In Lacs )</a>
            </legend>

            <div class="row collapse in" id="vehiclesDiv">
                <div class="col-sm-8 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('vehiclesOwned','Vehicles Owned', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-6">
                            {!! Form::select('vehiclesOwned', array(' ' => 'Select Vehicle','0' => 'None', '1' => '1', '2' => '2 to 4', '3' => 'Greater than 4'),null,['id' => 'isvehicleold', 'class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-8">
                    <div class="form-group">
                        {!! Form::label('apprx_market_value_vehicle'.$formIndex,'Market Value', ['class'=>'col-md-4 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::text('apprx_market_value_vehicle', null, ['class' => 'form-control', 'id'=>'apprx_market_value_vehicle', 'placeholder'=>'Approximate Market Value of all vehicle ( In Lacs )']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse" data-target="#propertiesDiv">2.Properties Owned ( <span class="fa fa-inr"></span> In Lacs )</a>
            </legend>

            <div class="row collapse in" id="propertiesDiv">
                <div class="col-sm-8 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('propertiesOwned','Properties Owned', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-4">
                            {!! Form::select('propertiesOwned', array(' ' => 'Select Properties Owned','0' => 'None', '1' => '1', '2' => '2', '3' => '3', '4' => 'Greater than 3'),null,['id' => 'no_of_property', 'class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div id="propertyDetails" class="collapse">
                @for($formIndex=1; $formIndex <= 3; $formIndex++)
                    <div id="propertyDetails_{{$formIndex}}" class="panel panel-info collapse" width="80%">
                        <div class="panel-heading">Property Details - {{$formIndex}}</div>
                        <div class="row">
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('propertytype','Type of Property', ['class'=>'col-md-6 control-label']) !!}

                                    <div class="col-xs-6">
                                        {!! Form::select('propertytype', array(' ' => 'Please select','0' => 'Land', '1' => 'Residential Flat/House', '2' => 'Commercial'),null,['id' => 'propertytype', 'class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8 col-lg-8">
                                <div class="form-group">
                                    {!! Form::label('apprx_market_value_property','Market Value', ['class'=>'col-md-4 control-label']) !!}

                                    <div class="col-md-6">
                                        {!! Form::text('apprx_market_value_property', null, ['class' => 'form-control', 'id'=>'apprx_market_value_property_'.$formIndex, 'placeholder'=>'Approximate Market Value ( In Lacs )']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('propertyno','Location City', ['class'=>'col-md-6 control-label']) !!}

                                    <div class="col-xs-6">
                                        {!! Form::select('propertyno', [' ' => 'Please select','0' => '1', '1' => '2 to 4', '2' => 'greater than 4'],null,['id' => 'propertyno', 'class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8 col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('propertyno','Is it mortgaged?', ['class'=>'col-md-6 control-label']) !!}

                                    <div class="col-md-4">
                                        {!! Form::radio('mortgage_radio', 'option_1', false, ['id' => 'mortgage_radio_radio_option_1']) !!}
                                        {!! Form::label('mortgage_radio', 'Yes') !!}
                                        {!! Form::radio('mortgage_radio', 'option_2', false, ['id' => 'mortgage_radio_radio_option_2']) !!}
                                        {!! Form::label('mortgage_radio', 'No') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <div id="propertyDetails_4" class="panel panel-info collapse" width="80%">
                <div class="panel-heading">Other Properties</div>
                <div class="row">
                    <br>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('propertytype','Type of Property', ['class'=>'col-md-6 control-label']) !!}

                            <div class="col-xs-6">
                                {!! Form::select('propertytype', [' ' => 'Select Property Type','0' => 'Land', '1' => 'Residential Flat/House', '2' => 'Commercial'],null,['id' => 'propertytype', 'class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('apprx_market_value_property','Market Value', ['class'=>'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('apprx_market_value_property', null, ['class' => 'form-control', 'id'=>'apprx_market_value_other_property', 'placeholder'=>'Approximate Market Value ( In Lacs )']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </fieldset>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse" data-target="#otherAssetsDiv">3.Other Assets Owned ( <span class="fa fa-inr"></span> In Lacs )</a>
            </legend>

            <div class="row collapse in" id="otherAssetsDiv">
                <div class="row">
                    <div class="col-sm-4 col-lg-4">
                        <div class="form-group">
                            {!! Form::label('fixed_deposits','Fixed Deposits', ['class'=>'col-md-6 control-label']) !!}

                            <div class="col-xs-4">
                            {!! Form::text('fixed_deposits', null, ['class' => 'form-control', 'id'=>'fixed_deposits', 'placeholder'=>'Enter Value']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4">
                        <div class="form-group">
                            {!! Form::label('mutual_funds','Mutual Funds', ['class'=>'col-md-4 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('mutual_funds', null, ['class' => 'form-control', 'id'=>'mutual_funds', 'placeholder'=>'Enter Value']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4">
                        <div class="form-group">
                            {!! Form::label('listed_shares_owned','Listed Shares Owned', ['class'=>'col-md-6 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('listed_shares_owned', null, ['class' => 'form-control', 'id'=>'listed_shares_owned', 'placeholder'=>'Enter Value']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse">4. Total Assets Owned - <span class="fa fa-inr"></span> <span id = "totalAssets"></span> Lacs </a>
            </legend>
        </fieldset>
      </div>

    <div id="promo_{{$formIndex}}" class="panel panel-info">
        <div class="panel-heading">Liabilities of Promoters ( <span class="fa fa-inr"></span> In Lacs )</div>
            <div class="row">
                <br>
            </div>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse" data-target="#personalLoanDiv">1.Personal Loan/Overdraft ( <span class="fa fa-inr"></span> In Lacs )</a>
            </legend>

            <div class="row collapse in" id="personalLoanDiv">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('liab_personal_bank','Name of Bank', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-4">
                            {!! Form::text('liab_personal_bank', null, ['class' => 'form-control', 'id'=>'liab_personal_bank', 'placeholder'=>'Enter Bank Name']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('liab_personal_outstanding','Amount Outstanding', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-6">
                            {!! Form::text('liab_personal_outstanding', null, ['class' => 'form-control', 'id'=>'liab_personal_outstanding', 'placeholder'=>'Outstanding Value']) !!}
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('liab_personal_emi','Monthly EMI', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-4">
                            {!! Form::text('liab_personal_emi', null, ['class' => 'form-control', 'id'=>'liab_personal_emi', 'placeholder'=>'Outstanding Value']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('liab_personal_total','Total Liability', ['class'=>'col-md-4 control-label']) !!}

                        <div class="col-xs-4">
                            {!! Form::text('liab_personal_total', null, ['class' => 'form-control', 'id'=>'liab_personal_total', 'placeholder'=>'Total Liability']) !!}
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </fieldset>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse" data-target="#vehicleLoanDiv">2. Vehicle Loan ( <span class="fa fa-inr"></span> In Lacs )</a>
            </legend>

            <div class="row collapse in" id="vehicleLoanDiv">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('liab_vehicle_bank','Name of Bank', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-4">
                            {!! Form::text('liab_vehicle_bank', null, ['class' => 'form-control', 'id'=>'liab_vehicle_bank', 'placeholder'=>'Enter Bank Name']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('liab_vehicle_outstanding','Amount Outstanding', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-6">
                            {!! Form::text('liab_vehicle_outstanding', null, ['class' => 'form-control', 'id'=>'liab_vehicle_outstanding', 'placeholder'=>'Outstanding Value']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('liab_vehicle_emi','Monthly EMI', ['class'=>'col-md-6 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('liab_vehicle_emi', null, ['class' => 'form-control', 'id'=>'liab_vehicle_emi', 'placeholder'=>'Outstanding Value']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('liab_vehicle_total','Total Liability', ['class'=>'col-md-4 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('liab_vehicle_total', null, ['class' => 'form-control', 'id'=>'liab_vehicle_total', 'placeholder'=>'Total Liability']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse" data-target="#mortgageLoanDiv">3. Mortgage Loan ( <span class="fa fa-inr"></span> In Lacs )</a>
            </legend>

            <div class="row collapse in" id="mortgageLoanDiv">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('liab_mortgage_bank','Name of Bank', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-4">
                            {!! Form::text('liab_mortgage_bank', null, ['class' => 'form-control', 'id'=>'liab_mortgage_bank', 'placeholder'=>'Enter Bank Name']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('liab_mortgage_outstanding','Amount Outstanding', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-6">
                            {!! Form::text('liab_mortgage_outstanding', null, ['class' => 'form-control', 'id'=>'liab_mortgage_outstanding', 'placeholder'=>'Outstanding Value']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('liab_mortgage_emi','Monthly EMI', ['class'=>'col-md-6 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('liab_mortgage_emi', null, ['class' => 'form-control', 'id'=>'liab_mortgage_emi', 'placeholder'=>'Outstanding Value']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('liab_mortgage_total','Total Liability', ['class'=>'col-md-4 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('liab_mortgage_total', null, ['class' => 'form-control', 'id'=>'liab_mortgage_total', 'placeholder'=>'Total Liability']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse" data-target="#mortgageLoanDiv">4. Other Market Borrowings Loan ( <span class="fa fa-inr"></span> In Lacs )</a>
            </legend>

            <div class="row collapse in" id="mortgageLoanDiv">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('liab_others_bank','Name of Bank', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-4">
                            {!! Form::text('liab_others_bank', null, ['class' => 'form-control', 'id'=>'liab_others_bank', 'placeholder'=>'Enter Bank Name']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-4">
                    <div class="form-group">
                        {!! Form::label('liab_others_outstanding','Amount Outstanding', ['class'=>'col-md-6 control-label']) !!}

                        <div class="col-xs-6">
                            {!! Form::text('liab_others_outstanding', null, ['class' => 'form-control', 'id'=>'liab_others_outstanding', 'placeholder'=>'Outstanding Value']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('liab_others_emi','Monthly EMI', ['class'=>'col-md-6 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('liab_others_emi', null, ['class' => 'form-control', 'id'=>'liab_others_emi', 'placeholder'=>'Outstanding Value']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            {!! Form::label('liab_others_total','Total Liability', ['class'=>'col-md-4 control-label']) !!}

                            <div class="col-xs-4">
                                {!! Form::text('liab_others_total', null, ['class' => 'form-control', 'id'=>'liab_others_total', 'placeholder'=>'Total Liability']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="fsStyle">
            <legend class="legendStyle">
                <a data-toggle="collapse">5. Total Liabilities - <span class="fa fa-inr"></span> <span id = "totalLiabilities"></span> Lacs </a>
            </legend>
        </fieldset>

        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="col-md-10 control-label">
                    <h3><span>Net worth - <span class="fa fa-inr"></span> <span id = "networth"></span> Lacs </span></h3>
                </div>
            </div>
        </div>
    </div>

    </div>


</div>


{{--======Start DivSub 3=============================================================================--}}
<div id="divTab_sub3">
    <div id="divTab_sub3">
        <br>
        <div id="promo_{{$formIndex}}" class="panel panel-info">
            <div class="panel-heading">Additional Details</div>

            <div class="row">
                <div class="col-sm-10 col-lg-10">
                    <div class="form-group">
                        {!! Form::label('promoter_generation', 'Promoters are ', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-8">
                            @foreach ($promotersGenerationType as $promotersGenerationTypeName=>$promotersGenerationTypeValue)
                                {!! Form::radio('promoter_generation_type', $promotersGenerationTypeValue, $choosenPromoterGenerationtype) !!}
                                {!! Form::label('promoter_generation_type',$promotersGenerationTypeName) !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-10">
                    <div class="form-group">
                        {!! Form::label('no_of_families', 'Number of independent families involved in business', ['class'=>'col-md-8 control-label']) !!}
                        <div class="col-md-4">
                            @foreach ($noOfFamilyTypes as $noOfFamilyTypeName=>$noOfFamilyTypeValue)
                                {!! Form::radio('no_of_families', $noOfFamilyTypeValue,$choosenFamilyType) !!}
                                {!! Form::label('no_of_families',$noOfFamilyTypeName) !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr/>

<div class="form-group" align = "center">
    {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div1',$loanId); return false;", 'value'=> 'Back' )) !!}
    {{--{!! Form::submit('Save', ['class' => 'btn inputBtn', 'name' => 'submit_promoter']) !!}--}}
    {!! Form::button('Next', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div3',$loanId); return false;", 'value'=> 'Next' )) !!}
    {!! Form::button('Exit', array('class' => 'inputBtn btn', 'onclick' => "showTab('Home',$loanId); return false;", 'value'=> 'Exit' )) !!}

</div>

    @section('footer')
        <script type="text/javascript">

            @for($recordNum = 0; $recordNum < 5; $recordNum++)
                $('#promoters_address_prooftype1_{{{$recordNum}}}').select2({
                    allowClear: true,
                    placeholder: "Select Address Proof"
                });

                $('#states1_{{{$recordNum}}}').select2({
                    allowClear: true,
                    placeholder: "Select State"
                });
            @endfor

            $("#apprx_market_value_vehicle").change(function() {calculateTotalAssetLiabilities();});
            $("#apprx_market_value_property_1").change(function() {calculateTotalAssetLiabilities();});
            $("#apprx_market_value_property_2").change(function() {calculateTotalAssetLiabilities();});
            $("#apprx_market_value_property_3").change(function() {calculateTotalAssetLiabilities();});
            $("#apprx_market_value_other_property").change(function() {calculateTotalAssetLiabilities();});
            $("#fixed_deposits").change(function() {calculateTotalAssetLiabilities();});
            $("#mutual_funds").change(function() {calculateTotalAssetLiabilities();});
            $("#listed_shares_owned").change(function() {calculateTotalAssetLiabilities();});

            $("#liab_personal_total").change(function() {calculateTotalAssetLiabilities();});
            $("#liab_vehicle_total").change(function() {calculateTotalAssetLiabilities();});
            $("#liab_mortgage_total").change(function() {calculateTotalAssetLiabilities();});
            $("#liab_others_total").change(function() {calculateTotalAssetLiabilities();});

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

                var totalAssets = 0;
                var totalLiabilities = 0;

                if($.isNumeric($('#apprx_market_value_vehicle').val())){
                    vehiclesValue = $('#apprx_market_value_vehicle').val();
                }

                if($.isNumeric($('#fixed_deposits').val())){
                    fixedDeposits = $('#fixed_deposits').val();
                }

                if($.isNumeric($('#mutual_funds').val())){
                    mutualFunds = $('#mutual_funds').val();
                }

                if($.isNumeric($('#listed_shares_owned').val())){
                    listedShares = $('#listed_shares_owned').val();
                }

                var noOfProperties = $('#no_of_property').val();

                if(noOfProperties <= 4){
                    for(var index = 1; index <= 3; index++) {
                        var propertyVal = $('#apprx_market_value_property_'+index).val();
                        if($.isNumeric(propertyVal)){
                            propertiesMktValueSum += Number(propertyVal);
                        }
                    }

                    if(noOfProperties == 4){
                        var propertyVal = $('#apprx_market_value_other_property').val();
                        if($.isNumeric(propertyVal)){
                            propertiesMktValueSum += Number(propertyVal);
                        }
                    }
                }

                //Calculate total liabilities
                if($.isNumeric($('#liab_personal_total').val())){
                    personalTotal = $('#liab_personal_total').val();
                }

                if($.isNumeric($('#liab_vehicle_total').val())){
                    vehicleTotal = $('#liab_vehicle_total').val();
                }

                if($.isNumeric($('#liab_mortgage_total').val())){
                    mortgageTotal = $('#liab_mortgage_total').val();
            }

                if($.isNumeric($('#liab_others_total').val())){
                    othersTotal = $('#liab_others_total').val();
                }

                totalAssets = Number(vehiclesValue)+Number(propertiesMktValueSum)+Number(fixedDeposits)+Number(mutualFunds)+Number(listedShares);
                totalLiabilities = Number(personalTotal)+Number(vehicleTotal)+Number(mortgageTotal)+Number(othersTotal);
                $('#totalAssets').text(totalAssets);
                $('#totalLiabilities').text(totalLiabilities);
                $('#networth').text(  Number(totalAssets) - Number(totalLiabilities));
            }

            calculateTotalAssetLiabilities();

            function showTab(tabid,loanid)
            {
                if(tabid == "Div1")
                {
                    document.location = "{{URL::to('/loans/newlap/index/'.$loanId)}}";
                }
                else if(tabid == "Div2") {
                    document.location = "{{URL::to('/loans/newlap/promoter/'.$loanId)}}";
                }
                else if(tabid == "Div3")
                {
                    document.location = "{{URL::to('/loans/newlap/financial/'.$loanId)}}";
                }
                else if(tabid == "Div4")
                {
                    document.location = "{{URL::to('/loans/newlap/business/'.$loanId)}}";
                }
                else if(tabid == "Div5")
                {
                    document.location = "{{URL::to('/loans/newlap/uploaddoc/'.$loanId)}}";
                }
                else
                {
                    document.location = "{{URL::to('/home#')}}";
                }
            }

            $(document).ready(function()
            {
                var add_property_count = 1;

                $('#divTab_sub1').show();
                $('#divTab_sub2').hide();
                $('#divTab_sub3').hide();

                $(lnkLoanDtls1).click(function()
                {
                    $('#li_sub1').removeClass("active");
                    $('#li_sub2').removeClass("active");
                    $('#li_sub3').removeClass("active");

                    $('#divTab_sub1').show();
                    $('#divTab_sub2').hide();
                    $('#divTab_sub3').hide();
                    $('#li_sub1').addClass("active");
                });

                $(lnkLoanDtls2).click(function()
                {
                    $('#li_sub1').removeClass("active");
                    $('#li_sub2').removeClass("active");
                    $('#li_sub3').removeClass("active");

                    $('#divTab_sub2').show();
                    $('#divTab_sub1').hide();
                    $('#divTab_sub3').hide();
                    $('#li_sub2').addClass("active");
                });

                $(lnkLoanDtls3).click(function()
                {
                    $('#li_sub1').removeClass("active");
                    $('#li_sub2').removeClass("active");
                    $('#li_sub3').removeClass("active");

                    $('#divTab_sub3').show();
                    $('#divTab_sub1').hide();
                    $('#divTab_sub2').hide();
                    $('#li_sub3').addClass("active");
                });


                //==========================================//
                $('#add_property').click(function() {
                    add_property_count = add_property_count + 1;
                    $('#property_'+add_property_count).show();
                    if(add_property_count == 3)
                    {
                        $('#add_property').hide();
                    }
                    else
                    {
                        $('#add_property').show();
                    }

                    if(add_property_count == 1)
                    {
                        $('#rem_property').hide();
                    }
                    else
                    {
                        $('#rem_property').show();
                    }
                });

                $('#rem_property').click(function() {

                    $('#property_'+add_property_count).hide();
                    add_property_count = add_property_count - 1;
                    if(add_property_count == 3)
                    {
                        $('#add_property').hide();
                    }
                    else
                    {
                        $('#add_property').show();
                    }

                    if(add_property_count == 1)
                    {
                        $('#rem_property').hide();
                    }
                    else
                    {
                        $('#rem_property').show();
                    }
                });

                //==========================================//

                $("#no_of_property").change(function() {
                    var propertyCount = $(this).val();

                    if(propertyCount == 0){
                        $("#propertyDetails").collapse("hide");
                        for(var index = 4; index >= 1; index--){
                            $("#propertyDetails_"+index).collapse("hide");
                        }
                    }else{
                        if(propertyCount == 4) {
                            $("#propertyDetails_4").collapse("show");
                            propertyCount = 3;
                        }


                        $("#propertyDetails").collapse("show");
                        for(var index = 1; index <= propertyCount; index++){
                            $("#propertyDetails_"+index).collapse("show");
                        }

                        for(var index = 4; index > propertyCount; index--){
                            $("#propertyDetails_"+index).collapse("hide");
                        }
                    }

                    if($(this).val() === ' ')
                    {
                        $("#propertyDetails").collapse("hide");
                    }
                    else
                    {
                        $("#propertyDetails").collapse("show");
                    }
                });


                var counter = 0; // Hidden Field Counter Variable
                var existing_records = {{$promoter_count}}; // If any existing Record in database
                var add_button = jQuery("#add_promoter_director");
                var delete_button = jQuery("#rem_promoter_director");
                var no_of_opened_containers = $("#no_of_opened_containers").val();

                for(var i = 0; i < existing_records; i++) {
                    $("#promo_"+i).collapse("show");
                    $("#address_"+i).collapse("show");
                    counter = i;
                }
                if(existing_records == 1) {
                    $("#address_0").val('');
                    $("#address_0").collapse("hide");
                }

                $("#counter_storage").val(existing_records);

                if(counter == 0) {
                    $(delete_button).hide();
                }

                $(add_button).click(function(e) {
                    e.preventDefault();
                    counter++;
                    existing_records++;
                    $("#promo_"+counter).collapse("show");
                    $("#counter_storage").val(existing_records);
                    if(counter >= 1) {
                        $("#address_0").collapse("show");
                        $("#address_"+counter).collapse("show");
                    }
                    if(counter == 4) {
                        $(this).hide();
                    }
                    if(counter > 0){
                        $(delete_button).show();
                    }
                });

                $(delete_button).click(function (e) {
                    e.preventDefault();
                    $("#promo_"+counter).collapse("hide");
                    counter--;
                    existing_records--;
                    $("#counter_storage").val(existing_records);
                    if(counter == 0){
                        $(delete_button).hide();
                        $("#address_"+counter).collapse("hide");
                    }
                    if(counter < 4) {
                        $(add_button).show();
                    }
                });
            });
        </script>
@stop
