<div id="Que21" class="form-group">
    <div class="form-group" style="margin-left: auto;">
        {!! Form::label('office_premise_type','A) Is your Office Premise') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::radio('office_premise_type', 'owned', false, ['id' => 'office_premise_owned']) !!}
        {!! Form::label('office_premise_type', 'Owned') !!}
        {!! Form::radio('office_premise_type', 'rented', false, ['id' => 'office_premise_rented']) !!}
        {!! Form::label('office_premise_type', 'Rented') !!}
    </div>
    <div class="form-group collapse" id="que21_approxvalue">
        {!! Form::label('approx_value','Approx value ( ') !!}
        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
        {!! Form::label(null,' In Lacs )') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::text('approx_value', isset($business_object->approx_value) ? $business_object->approx_value : null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group collapse" id="que21_monthlyrent">
        {!! Form::label('monthly_rent','Monthly Rent Paid ( ') !!}
        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
        {!! Form::label(null,' In Lacs )') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::text('monthly_rent', isset($business_object->monthly_rent) ? $business_object->monthly_rent : null, array('class' => 'form-control')) !!}
    </div>
</div>
<div id="Que22" class="form-group" style="margin-left: auto;">
    <div class="form-group">
        {!! Form::label('manufacturing_premise','B) Is your Manufacturing premise on') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::radio('manufacturing_premise_type', 'owned', false, ['id' => 'manufacturing_premise_owned']) !!}
        {!! Form::label('manufacturing_premise_type', 'Owned') !!}
        {!! Form::radio('manufacturing_premise_type', 'leased', false, ['id' => 'manufacturing_premise_leased']) !!}
        {!! Form::label('manufacturing_premise_type', 'Leased') !!}
    </div>
    <div class="form-group collapse" id="que22_apprxlandvalue">
        {!! Form::label('owner','Approx Value of Land ( ') !!}
        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
        {!! Form::label(null,' In Lacs )') !!}
        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
        {!! Form::text('approx_value_of_land', isset($business_object->approx_value_of_land) ? $business_object->approx_value_of_land : null, array('class' => 'form-control' )) !!}
    </div>
</div>

<div id="yearQue37" class="form-group">
    <div id="topcust" class="panel panel-info">
        <div class="panel-heading">Top 3 customers Basis Annual Sales
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        </div>

        <div style="padding-left: 10px;">
            <table class="table table-bordered">
                <tr>
                    <td>
                        {!! Form::label('owner','Customer Name') !!}
                    </td>
                    <td>
                        {!! Form::label('owner','Annual Sales Amount ( ') !!}
                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                        {!! Form::label(null,' In Lacs )') !!}
                    </td>
                    <td>
                        {!! Form::label('owner','Relationship Since ( Year )') !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('customer_name_1', isset($business_object->customer_name_1) ? $business_object->customer_name_1 : null, array('class' => 'form-control')) !!}
                    </td>
                    <td>
                        {!! Form::text('customer_sale_amount_1', isset($business_object->customer_sale_amount_1) ? $business_object->customer_sale_amount_1 : null, array('class' => 'form-control')) !!}
                    </td>
                    <td>
                        {!! Form::select('relationship_since', ['one_year' => '1 year', 'two_to_four' => '2 - 4 years', 'four_to_eight' => '4 - 8 years', 'greater_eight' => '> 8 years'], null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('customer_name_2', isset($business_object->customer_name_2) ? $business_object->customer_name_2 : null, array('class' => 'form-control')) !!}
                    </td>
                    <td>
                        {!! Form::text('customer_sale_amount_2', isset($business_object->customer_sale_amount_2) ? $business_object->customer_sale_amount_2 : null, array('class' => 'form-control')) !!}
                    </td>
                    <td>
                        {!! Form::select('relationship_since', ['one_year' => '1 year', 'two_to_four' => '2 - 4 years', 'four_to_eight' => '4 - 8 years', 'greater_eight' => '> 8 years'], null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('customer_name_3', isset($business_object->customer_name_3) ? $business_object->customer_name_3 : null, array('class' => 'form-control')) !!}
                    </td>
                    <td>
                        {!! Form::text('customer_sale_amount_3', isset($business_object->customer_sale_amount_3) ? $business_object->customer_sale_amount_3 : null, array('class' => 'form-control')) !!}
                    </td>
                    <td>
                        {!! Form::select('relationship_since', ['one_year' => '1 year', 'two_to_four' => '2 - 4 years', 'four_to_eight' => '4 - 8 years', 'greater_eight' => '> 8 years'], null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
            </table>
            <hr>
        </div>
    </div>
</div>

<div id="Que24" class="form-group" style="margin-left: auto;">
    <div class="form-group">
        {!! Form::label('owner','C) Do you have any long term contracts with any customers') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::select('long_term_contracts', array('' => 'Please select', '1' => 'Yes', '0' => 'No'), isset($business_object->long_term_contracts) ? $business_object->long_term_contracts : '0' , ['id' => 'que22_longtcontract']) !!}
    </div>

    <div id="yearQue37" class="form-group">
        <div class="form-group collapse" id="que24">
            <div id="compdetails" class="panel panel-info" style="  margin-left: 28px; margin-right: 28px;">
                <div style="padding-left: 30px;">
                    <div class="form-group" style ="width: 99%;">
                        {!! Form::label('owner','Name of Customers') !!}
                        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                        {!! Form::text('long_term_contract_customer_name', isset($business_object->long_term_contract_customer_name) ? $business_object->long_term_contract_customer_name : null, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group" style ="width: 99%;">
                        {!! Form::label('owner','Number of years of contracts') !!}
                        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                        {!! Form::select('no_of_years_of_contracts', array('1' => '1 year', '2' => '2 - 4 years', '3' => '> 4 years'), isset($business_object->long_term_contracts) ? $business_object->long_term_contracts : '0' , ['id' => 'que22_longtcontract']) !!}
                    </div>
                    <div class="form-group" style ="width: 99%;">
                        {!! Form::label('owner','Annual Value of Contracts ( ') !!}
                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                        {!! Form::label(null,' In Lacs )') !!}
                        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
                        {!! Form::text('annual_value_of_contracts', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group" style ="width: 99%;">
                        {!! Form::label('Field5', 'Details of numbers of years of customer sale relationship') !!}
                        {!! Form::text('customer_sale_relationship', isset($business_object->customer_sale_relationship) ? $business_object->customer_sale_relationship : null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <div class="form-group collapse" id="que24">
        <div class="form-group">
            {!! Form::label('owner','Name of Customers') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::text('long_term_contract_customer_name', isset($business_object->long_term_contract_customer_name) ? $business_object->long_term_contract_customer_name : null, array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('owner','Number of years of contracts') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::select('no_of_years_of_contracts', array('1' => '1 year', '2' => '2 - 4 years', '3' => '> 4 years'), isset($business_object->long_term_contracts) ? $business_object->long_term_contracts : '0' , ['id' => 'que22_longtcontract']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('owner','Annual Value of Contracts ( ') !!}
            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
            {!! Form::label(null,' In Lacs )') !!}
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
            {!! Form::text('annual_value_of_contracts', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Field5', 'details of nos of years of customer sale relationship') !!}
            {!! Form::text('customer_sale_relationship', isset($business_object->customer_sale_relationship) ? $business_object->customer_sale_relationship : null, array('class' => 'form-control')) !!}
        </div>
    </div>
</div>

<div id="yearQue37" class="form-group">
    <div id="topdeb" class="panel panel-info">
        <div class="panel-heading">Top 3 debtors
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        </div>

        <div style="padding-left: 10px;">
            <table class="table table-bordered">
                <tr>
                    <th colspan="3">As on Date</th>
                </tr>
                <tr>
                    <th>Name of Debtor</th>
                    <th>Amount Outstanding ( <span class="fa fa-inr"></span> in lacs)</th>
                    <th>Period Outstanding</th>
                </tr>
                <tr>
                    <td>{!! Form::text('debtor_name_1', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::text('outstanding_amount_1', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('period_outstanding_1', ['1' => '< 30 days', '2' => '30 - 90 days', '3' => '90 - 180 days', '4' => '> 180 days'], null , ['id' => 'period_outstanding_1', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::text('debtor_name_2', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::text('outstanding_amount_2', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('period_outstanding_2', ['1' => '< 30 days', '2' => '30 - 90 days', '3' => '90 - 180 days', '4' => '> 180 days'], null , ['id' => 'period_outstanding_2', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::text('debtor_name_3', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::text('outstanding_amount_3', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('period_outstanding_3', ['1' => '< 30 days', '2' => '30 - 90 days', '3' => '90 - 180 days', '4' => '> 180 days'], null , ['id' => 'period_outstanding_3', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr>
                    <th colspan="3">As on Last Audited Balance Sheet</th>
                </tr>
                <tr>
                    <th>Name of Debtor</th>
                    <th>Amount Outstanding ( <span class="fa fa-inr"></span> in lacs)</th>
                    <th>Period Outstanding</th>
                </tr>
                <tr>
                    <td>{!! Form::text('debtor_audited_name_1', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::text('outstanding_audited_amount_1', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('period_audited_outstanding_1', ['1' => '< 30 days', '2' => '30 - 90 days', '3' => '90 - 180 days', '4' => '> 180 days'], null , ['id' => 'period_audited_outstanding_1', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::text('debtor_audited_name_2', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::text('outstanding_audited_amount_2', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('period_audited_outstanding_2', ['1' => '< 30 days', '2' => '30 - 90 days', '3' => '90 - 180 days', '4' => '> 180 days'], null , ['id' => 'period_audited_outstanding_2', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::text('debtor_audited_name_3', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::text('outstanding_audited_amount_3', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('period_audited_outstanding_3', ['1' => '< 30 days', '2' => '30 - 90 days', '3' => '90 - 180 days', '4' => '> 180 days'], null , ['id' => 'period_audited_outstanding_3', 'class'=> 'form-control']) !!}</td>
                </tr>
            </table>
            <hr>
        </div>
    </div>
</div>

<div id="yearQue37" class="form-group">
    <div id="topsup" class="panel panel-info">
        <div class="panel-heading">Top 3 suppliers
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        </div>

        <div style="padding-left: 10px;">
            <table class="table table-bordered">
                <tr>
                    <th>
                        {!! Form::label('owner','Suppliers Name') !!}
                    </th>
                    <th>
                        {!! Form::label('owner','Annual Amount') !!}
                    </th>
                    <th>
                        {!! Form::label('owner','Relation Since') !!}
                    </th>
                    <th colspan="2">
                        {!! Form::label('owner','Reference Name / Contact') !!}
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Name</th>
                    <th>Contact</th>
                </tr>
                <tr>
                    <td>{!! Form::text('supplier_name_1', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::text('supplier_amount_1', isset($business_object->supplier_amount_1) ? $business_object->supplier_amount_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::select('supplier_relation_1', ['1' => '1 year', '2' => '2 - 4 years', '3' => '4 - 8 years', '4' => '> 8 years'], null , ['id' => 'supplier_relation_1', 'class'=> 'form-control']) !!}</td>
                    <td>{!! Form::text('supplier_ref_name_1', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::text('supplier_ref_contact_1', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::text('supplier_name_2', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::text('supplier_amount_2', isset($business_object->supplier_amount_1) ? $business_object->supplier_amount_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::select('supplier_relation_2', ['1' => '1 year', '2' => '2 - 4 years', '3' => '4 - 8 years', '4' => '> 8 years'], null , ['id' => 'supplier_relation_1', 'class'=> 'form-control']) !!}</td>
                    <td>{!! Form::text('supplier_ref_name_2', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::text('supplier_ref_contact_2', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::text('supplier_name_3', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::text('supplier_amount_3', isset($business_object->supplier_amount_1) ? $business_object->supplier_amount_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::select('supplier_relation_3', ['1' => '1 year', '2' => '2 - 4 years', '3' => '4 - 8 years', '4' => '> 8 years'], null , ['id' => 'supplier_relation_1', 'class'=> 'form-control']) !!}</td>
                    <td>{!! Form::text('supplier_ref_name_3', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                    <td>{!! Form::text('supplier_ref_contact_3', isset($business_object->supplier_name_1) ? $business_object->supplier_name_1 : null, array('class' => 'form-control')) !!}</td>
                </tr>
            </table>
            <hr>
        </div>
    </div>
</div>

<div id="yearQue37" class="form-group">
    <div id="compdetails" class="panel panel-info">
        <div class="panel-heading">Details of competitors
            {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        </div>

        <div style="padding-left: 10px;">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Type of Competitors</th>
                </tr>
                <tr>
                    <td>{!! Form::text('name_of_competitors_1', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('type_of_competitors_1', ['1' => 'Local Player', '2' => 'Regional Player', '3' => 'National Player'], null , ['id' => 'type_of_competitors_1', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr id="competitor2" class="collapse">
                    <td>{!! Form::text('name_of_competitors_2', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('type_of_competitors_2', ['1' => 'Local Player', '2' => 'Regional Player', '3' => 'National Player'], null , ['id' => 'type_of_competitors_2', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr id="competitor3" class="collapse">
                    <td>{!! Form::text('name_of_competitors_3', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('type_of_competitors_3', ['1' => 'Local Player', '2' => 'Regional Player', '3' => 'National Player'], null , ['id' => 'type_of_competitors_3', 'class'=> 'form-control']) !!}</td>
                </tr>
                <tr id="competitor4" class="collapse">
                    <td>{!! Form::text('name_of_competitors_4', null, ['class' => 'form-control']) !!}</td>
                    <td>{!! Form::select('type_of_competitors_4', ['1' => 'Local Player', '2' => 'Regional Player', '3' => 'National Player'], null , ['id' => 'type_of_competitors_4', 'class'=> 'form-control']) !!}</td>
                </tr>
            </table>
            {!! Form::button('Add Competitor', ['class' => 'btn btn-primary add_competitor'])!!}
            {!! Form::button('Remove Competitor', ['class' => 'btn btn-danger remove_competitor'])!!}
            <hr>
        </div>
    </div>
</div>

<div id="Que29" class="form-group">
    {{--<div class="form-group">--}}
        {{--{!! Form::label('owner','Which of the following positions are present in your company') !!}--}}
        {{--{!! Form::label('notice', '*', ['class' => 'redmarks']) !!}--}}
        {{--{!! Form::select('position_in_company', array(' ' => 'Please select a position','0' => 'CFO', '1' => 'HR Head', '2' => 'Marketing Head', '3' => 'Operations Head'), isset($business_object->position_in_company) ? $business_object->position_in_company : null, ['id' => 'que29_designation']) !!}--}}
    {{--</div>--}}
    <div class="form-group" style="margin-left: auto;">
        {!! Form::label('owner','D) Which of the following positions are present in your company ( Select one or more as applicable )') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
    </div>
    <div class="form-group" style = "margin-left : 10px;">
        @foreach ($companyPositionTypes as $companyPositionTypeName=>$companyPositionTypeValue)
            {!! Form::checkbox('positions[]', $companyPositionTypeValue,(in_array($companyPositionTypeValue,$chosenCompanyPositionTypes) ? true: false)) !!}
            {!! Form::label('positions',$companyPositionTypeName) !!}
        @endforeach
    </div>
    <div class="form-group" style="margin-left: auto;">
        {!! Form::label('owner','E) Which of the above are held by professional other than promoters ( Select one or more as applicable )') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
    </div>
    <div class="form-group" style = "margin-left : 10px;">
        @foreach ($companyPositionTypes as $companyPositionTypeName=>$companyPositionTypeValue)
            {!! Form::checkbox('positions[]', $companyPositionTypeValue,(in_array($companyPositionTypeValue,$chosenCompanyPositionTypes) ? true: false)) !!}
            {!! Form::label('positions',$companyPositionTypeName) !!}
        @endforeach
    </div>

{{--@if(isset($helper) && $helper->isQuestionValid(31))--}}
    <div class="form-group" style="margin-left: auto;">
        {!! Form::label('owner','F) What is your geographical area of Operation / Sales') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::select('geographical_area', array('3' => 'Please select','0' => 'City', '1' => 'Multiple City Single State', '2' => 'Multi State'), isset($business_object->geographical_area) ? $business_object->geographical_area : null , ['id' => 'que30_geographical_area']) !!}
    </div>
    <div class="form-group collapse" id="one_city">
        {!! Form::label('city_name', 'City Name') !!}
        {!! Form::text('city_name', isset($business_object->city_name) ? $business_object->city_name : null, ['class' => 'form-control'])!!}
    </div>
    <div class="panel panel-info collapse" id="multiple_cities">
        <div class="panel-heading">Enter City Names</div>
        <div class="panel-body">
            {!! Form::label('city_name_1', 'City Name 1') !!}
            {!! Form::text('city_name_1', isset($business_object->city_name_1) ? $business_object->city_name_1 : null, ['class' => 'form-control'])!!}<br/>
            {!! Form::label('city_name_2', 'City Name 2') !!}
            {!! Form::text('city_name_2', isset($business_object->city_name_2) ? $business_object->city_name_2 : null, ['class' => 'form-control'])!!}
        </div>
    </div>
    <div class="panel panel-info collapse" id="multiple_states">
        <div class="panel-heading">Enter State Names</div>
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('state_name_1', 'State Name 1') !!}
                {!! Form::text('state_name_1', isset($business_object->state_name_1) ? $business_object->state_name_1 : null, ['class' => 'form-control'])!!}
            </div>
            <div class="form-group">
                {!! Form::label('state_name_2', 'State Name 2') !!}
                {!! Form::text('state_name_2', isset($business_object->state_name_2) ? $business_object->state_name_2 : null, ['class' => 'form-control'])!!}
            </div>
            <div class="form-group collapse" id="state_name_3">
                {!! Form::label('state_name_3', 'State Name 3') !!}
                {!! Form::text('state_name_3', isset($business_object->state_name_3) ? $business_object->state_name_3 : null, ['class' => 'form-control'])!!}
            </div>
            <div class="form-group collapse" id="state_name_4">
                {!! Form::label('state_name_4', 'State Name 4') !!}
                {!! Form::text('state_name_4', isset($business_object->state_name_3) ? $business_object->state_name_3 : null, ['class' => 'form-control'])!!}
            </div>
            <div class="form-group collapse" id="state_name_5">
                {!! Form::label('state_name_5', 'State Name 5') !!}
                {!! Form::text('state_name_5', isset($business_object->state_name_3) ? $business_object->state_name_3 : null, ['class' => 'form-control'])!!}
            </div>
            {!! Form::button('Add State', ['class' => 'btn btn-primary add_state'])!!}
            {!! Form::button('Remove State', ['class' => 'btn btn-danger remove_state'])!!}
        </div>
    </div>
</div>
{{--@endif--}}
<div id="Que31" class="form-group">
    <div class="form-group" style="margin-left: auto;">
        {!! Form::label('owner','G) Are You any of the following ') !!}
        {!! Form::label('notice', '*', ['class' => 'redmarks']) !!}
        {!! Form::select('security_offered', ['None of the above' => 'None of the above','Vendor for a ecommerce company' => 'Vendor for a ecommerce company','Vendor to a large Retail Chain' => 'Vendor to a large Retail Chain', 'Vendor to a large OEM / Manufacturing company' => 'Vendor to a large OEM / Manufacturing company', 'Vendor to a large service company' => 'Vendor to a large service company', 'Distributor of a large manufacturing company' => 'Distributor of a large manufacturing company'],isset($business_object->security_offered) ? $business_object->security_offered : null, ['id' => 'que31_securityoffered']) !!}
    </div>
</div>

<div id="yearQue37" class="form-group">
    <div class="panel panel-info collapse" id="name">
        <div class="panel-heading">Customer Details</div>
        <div class="row">
            <br>
        </div>

        <div class="row">
            <div class="col-sm-6 col-lg-6">

                <div class="form-group required">
                    <span id = "namefromselect" class="col-md-8 control-label"></span>
                    <div class="col-md-4">
                        {!! Form::text('namefromselect', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="form-group required">
                    {!! Form::label('cin_no','Relationship Since', ['class'=>'col-md-4 control-label']) !!}
                    <div class="col-xs-6">
                        {!! Form::select('relation_since', ['0' => '1 Year','1' => '2-4 Years','2' => '4-8 Years', '3' => '> 8 Years'],isset($business_object->relation_since) ? $business_object->relation_since : null, ['id' => 'que31_relation_since', 'class'=>'form-control']) !!}
                    </div>
                </div>
             </div>
        </div>
    </div><br>
    <div id="monthlysales" class="panel panel-info collapse">
        <div class="panel-heading">Monthly sales details for last 6 months</div>

        <div style="padding-left: 10px;">
            <table class="table table-bordered">
                <tr>
                    <th>
                        {!! Form::label('owner','Month') !!}
                    </th>
                    <th>
                        {!! Form::label('owner','Year') !!}
                    </th>
                    <th>
                        {!! Form::label('owner','Sale Amount ( ') !!}
                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                        {!! Form::label(null,' In Lacs )') !!}
                    </th>
                    <th>Products Sold (Remarks)</th>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('monthly_sales_month_1', isset($business_object->monthly_sales_month_year_1) ? $business_object->monthly_sales_month_year_1 : null, array('class' => 'form-control monthly_sales' , 'id'=>'monthly_sales_month_1')) !!}
                    </td>
                    <td>
                        {!! Form::text('year_1', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control year_sales' )) !!}
                    </td>
                    <td>
                        {!! Form::text('monthly_sales_amount_1', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                    <td>
                        {!! Form::text('products_sold_remarks_1', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('monthly_sales_month_2', isset($business_object->monthly_sales_month_year_1) ? $business_object->monthly_sales_month_year_1 : null, array('class' => 'form-control monthly_sales' , 'id'=>'monthly_sales_month_2')) !!}
                    </td>
                    <td>
                        {!! Form::text('year_2', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control year_sales' )) !!}
                    </td>
                    <td>
                        {!! Form::text('monthly_sales_amount_2', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                    <td>
                        {!! Form::text('products_sold_remarks_2', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('monthly_sales_month_3', isset($business_object->monthly_sales_month_year_1) ? $business_object->monthly_sales_month_year_1 : null, array('class' => 'form-control monthly_sales' , 'id'=>'monthly_sales_month_3')) !!}
                    </td>
                    <td>
                        {!! Form::text('year_3', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control year_sales' )) !!}
                    </td>
                    <td>
                        {!! Form::text('monthly_sales_amount_3', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                    <td>
                        {!! Form::text('products_sold_remarks_3', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('monthly_sales_month_4', isset($business_object->monthly_sales_month_year_1) ? $business_object->monthly_sales_month_year_1 : null, array('class' => 'form-control monthly_sales' , 'id'=>'monthly_sales_month_4')) !!}
                    </td>
                    <td>
                        {!! Form::text('year_4', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control year_sales' )) !!}
                    </td>
                    <td>
                        {!! Form::text('monthly_sales_amount_4', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                    <td>
                        {!! Form::text('products_sold_remarks_4', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('monthly_sales_month_5', isset($business_object->monthly_sales_month_year_1) ? $business_object->monthly_sales_month_year_1 : null, array('class' => 'form-control monthly_sales' , 'id'=>'monthly_sales_month_5')) !!}
                    </td>
                    <td>
                        {!! Form::text('year_5', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control year_sales' )) !!}
                    </td>
                    <td>
                        {!! Form::text('monthly_sales_amount_5', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                    <td>
                        {!! Form::text('products_sold_remarks_5', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::text('monthly_sales_month_6', isset($business_object->monthly_sales_month_year_1) ? $business_object->monthly_sales_month_year_1 : null, array('class' => 'form-control monthly_sales' , 'id'=>'monthly_sales_month_6')) !!}
                    </td>
                    <td>
                        {!! Form::text('year_6', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control year_sales' )) !!}
                    </td>
                    <td>
                        {!! Form::text('monthly_sales_amount_6', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                    <td>
                        {!! Form::text('products_sold_remarks_6', isset($business_object->monthly_sales_amount_1) ?$business_object->monthly_sales_amount_1 : null, array('class' => 'form-control' )) !!}
                    </td>
                </tr>
            </table>
            <hr>
        </div>
    </div>
</div>

{{--<div id="Que34" class="form-group">
    {!! Form::label('question_no_34', 'Current Outstanding Receivable /Payable and nos of days due since supply date (invoice wise)') !!}
    <hr/>
    @for($formIndex=0; $formIndex < $maxCustomers;$formIndex++)
        @if($formIndex == 0)
            <div class="panel panel-info" id="customer_container_number_{{ $formIndex }}">
                @else
                    <div class="panel panel-info collapse" id="customer_container_number_{{ $formIndex }}">
                        @endif
                        <div class="panel-heading">Customer Buyer Details {{ ($formIndex + 1) }}{!! Form::label('', '*', ['class'=>'redmarks']) !!}</div>
                        <div class="panel-body">
                            {!! Form::label('name_of_customer', 'Name of customer') !!}
                            {!! Form::label('', '*', ['class'=>'redmarks']) !!}
                            {!! Form::text('outstanding_payable['.$formIndex.'][name_of_customer]', null, ['class'=>'form-control']) !!}<br/>
                            {!! Form::label('no_of_years_association', 'No of Years of Association') !!}
                            {!! Form::label('', '*', ['class'=>'redmarks']) !!}
                            {!! Form::text('outstanding_payable['.$formIndex.'][no_of_years_association]', null, ['class'=>'form-control']) !!}<br/>
                            {!! Form::label('annual_sales_customer', 'Annual Sales to Customer ( ') !!}
                            <span class="fa fa-inr"></span>
                            {!! Form::label('', '  in Lacs )' ) !!}
                            {!! Form::label('', '*', ['class'=>'redmarks']) !!}
                            {!! Form::text('outstanding_payable['.$formIndex.'][annual_sales_customer]', null, ['class'=>'form-control']) !!}<br/>
                            @for($childIndex = 0; $childIndex < 5; $childIndex++)
                                @if($childIndex == 0)
                                    <div class="panel panel-success" id="invoice_container_number_{{$formIndex}}_{{$childIndex}}">
                                        @else
                                            <div class="panel panel-success collapse" id="invoice_container_number_{{$formIndex}}_{{$childIndex}}">
                                                @endif
                                                <div class="panel-heading">Invoice Details {{ ($childIndex + 1) }}{!! Form::label('', '*', ['class'=>'redmarks']) !!}</div>
                                                <div class="panel-body invoice">
                                                    <div class="form-group">
                                                        {!! Form::label('invoice_value', 'Invoice Value ( ') !!}
                                                        <span class="fa fa-inr"></span>
                                                        {!! Form::label('', '  in Lacs )' ) !!}
                                                        {!! Form::label('', '*', ['class'=>'redmarks']) !!}
                                                        {!! Form::text('outstanding_payable['.$formIndex.']['.$childIndex.'][invoice_value]', null, ['class'=>'form-control'])!!}<br/>
                                                        {!! Form::label('date_of_supply', 'Date of Supply' ) !!}
                                                        {!! Form::label('', '*', ['class'=>'redmarks']) !!}
                                                        {!! Form::text('outstanding_payable['.$formIndex.']['.$childIndex.'][date_of_supply]', null, ['class'=>'form-control'])!!}<br/>
                                                        {!! Form::label('due_date', 'Due Date' ) !!}
                                                        {!! Form::label('', '*', ['class'=>'redmarks']) !!}
                                                        {!! Form::text('outstanding_payable['.$formIndex.']['.$childIndex.'][due_date]', null, ['class'=>'form-control'])!!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endfor
                                            <input type="button" class="btn btn-primary add_invoice_{{ $formIndex }}" value="Add Invoice">
                                            <input type="button" class="btn btn-danger remove_invoice_{{ $formIndex }}" value="Remove Invoice">
                                    </div>
                        </div>
                        @endfor
                    </div>
                    {!! Form::button('Add Customer Buyer Details', ['class' => 'btn btn-primary add_customer'])!!}
                    {!! Form::button('Remove Customer Buyer Details', ['class' => 'btn btn-danger remove_customer'])!!}
                    {!! Form::hidden('customer_buyer_counter', 0 , ['id' => 'customer_buyer_counter'])!!}--}}

<div id="Que35" class="form-group">
    {{--{!! Form::label('Field15', 'Details of Equipment being Purchased') !!}--}}
    <div class="panel panel-info">
        <div class="panel-heading">Details of Equipment being Purchased</div>
        <table class="table">
            <tr>
                <th>Type of Equipment <span class="redmarks">*</span></th>
                <th>Brief Description <span class="redmarks">*</span></th>
            </tr>
            <tr>
                <td>
                    {!! Form::select('type_of_equipment', $purchasedEquipmentTypes , null , ['id' => 'type_of_equipment','class'=>'form-control']) !!}
                    <div id="otherEquipmentTypeDiv" class="collapse">
                    {!!Form::text('type_of_equipment_others', null, ['class'=>'form-control', 'id' =>'type_of_equipment_others', 'placeholder' => 'Enter Other Equipment Type' ] )!!}
                    </div>
                </td>
                <td>{!!Form::textarea('equipment_discription', isset($business_object->equipment_discription) ? $business_object->equipment_discription : null, ['class'=>'form-control', 'size' => '30x3'] )!!}</td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th>Sourced <span class="redmarks">*</span></th>
                <th>Name of Manufacturer <span class="redmarks">*</span></th>
                <th>Year of Manufacture <span class="redmarks">*</span></th>
            </tr>
            <tr>
                <td>{!! Form::radio('sourced', 'owned', false, ['id' => 'sourced']) !!}
                {!! Form::label('sourced', 'Imported') !!}
                {!! Form::radio('sourced', 'rented', false, ['id' => 'sourced']) !!}
                {!! Form::label('sourced', 'Domestically Sourced') !!}</td>
                {{--<td>{!! Form::select('sourced', array('' => 'Please Select Sourced','0' => 'Imported','1'=>'Domestically Sourced'), isset($business_object->sourced) ? $business_object->sourced : null , ['id' => 'sourced','class'=>'form-control']) !!}</td>--}}
                <td>{!!Form::text('name_of_manufacturer', isset($business_object->name_of_manufacturer) ? $business_object->name_of_manufacturer : null, ['class'=>'form-control'] )!!}</td>
                <td>{!!Form::text('date_manufacturer',  isset($business_object->date_manufacturer) ? $business_object->date_manufacturer : null, ['class'=>'form-control'] )!!}</td>
            </tr>

        </table>
        <table class="table collapse" id="equipment_sourced_imported">
            <tr>
                <th>Invoice CIF Value (<span class="fa fa-inr"></span> in Lacs)<span class="redmarks">*</span></th>
                <th>Custom and Other Duty (<span class="fa fa-inr"></span> in Lacs)<span class="redmarks">*</span></th>
                <th>Invoice CIF Value (USD in thousands)<span class="redmarks">*</span></th>
            </tr>
            <tr>
                <td>{!!Form::text('invoice_cif_in_lacs', isset($business_object->invoice_cif_in_lacs) ? $business_object->invoice_cif_in_lacs : null, ['class'=>'form-control'] )!!}</td>
                <td>{!!Form::text('custom_duty', isset($business_object->custom_duty) ? $business_object->custom_duty : null, ['class'=>'form-control'] )!!}</td>
                <td>{!!Form::text('invoice_cif_in_usd',  isset($business_object->invoice_cif_in_usd) ? $business_object->invoice_cif_in_usd : null, ['class'=>'form-control'] )!!}</td>
            </tr>

        </table>
        <table class="table collapse" id="equipment_sourced_domestically_sourced">
            <tr>
                <th>Invoice Value (<span class="fa fa-inr"></span> in Lacs)<span class="redmarks">*</span></th>
            </tr>
            <tr>
                {!! Form::hidden('loan_id', $loanId ) !!}
                <td>{!!Form::text('invoice_value', isset($business_object->invoice_value) ? $business_object->invoice_value : null, ['class'=>'form-control'] )!!}</td>

            </tr>

        </table>
    </div>

</div>

{{--<div id="Que36" class="form-group">
    {!! Form::label('Field16', 'Details of Contract being Executed') !!}
    {!! Form::text('contract_executed', isset($business_object->contract_executed) ? $business_object->contract_executed : null , array('class' => 'form-control')) !!}
</div>--}}


<div class="form-group" align="center">
    {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div3',$loanId); return false;", 'value'=> 'Back' )) !!}
    {{--{!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}--}}
    {!! Form::button('Next', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div5',$loanId); return false;", 'value'=> 'Next' )) !!}
    {!! Form::button('Exit', array('class' => 'inputBtn btn', 'onclick' => "showTab('Home',$loanId); return false;", 'value'=> 'Exit' )) !!}
</div>
@section('footer')
<script type="text/javascript">

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


    $(document).ready(function (){
        
        /*---- Auto Population Month and Year -----*/
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        var date = new Date();
        var month = date.getMonth();
        var current_month = date.getMonth();
        var year = date.getFullYear();
        $(".monthly_sales").each(function () {
            month--;
            if(month == -1){
                month = 11;
            }
            $(this).val(monthNames[month]);
        });
        $(".year_sales").each(function (index, value) {
            current_month--;
            if(current_month == -1) {
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
            $("#competitor"+row_counter).collapse("show");
            if(row_counter > 3) {
                $(this).hide();
            }
            if(row_counter > 1) {
                $(".remove_competitor").show();
            }
        });
        $(".remove_competitor").click(function () {
            $("#competitor"+row_counter).collapse("hide");
            row_counter--;
            if(row_counter < 4) {
                $(".add_competitor").show();
            }
            if(row_counter == 1) {
                $(this).hide();
            }
        });
        /*-- end toggle function --*/

        /*---- Toggle of State -----*/
        var state_counter = 2;
        $(".remove_state").hide();
        $(".add_state").click(function () {
            state_counter++;
            $("#state_name_"+state_counter).collapse("show");
            if(state_counter == 5) {
                $(this).hide();
            }
            if(state_counter > 2) {
                $(".remove_state").show
                ();
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
        /*---- end toggle function*/

        $("#office_premise_owned").click(function () {
            $("#que21_approxvalue").collapse("show");
            $("#que21_monthlyrent").collapse("hide");
        });

        $("#office_premise_rented").click(function () {
            $("#que21_monthlyrent").collapse("show");
            $("#que21_approxvalue").collapse("hide");
        });

        $("#manufacturing_premise_owned").click(function () {
            $("#que22_apprxlandvalue").collapse("show");
        });

        $("#manufacturing_premise_leased").click(function () {
            $("#que22_apprxlandvalue").collapse("hide");
        });

        if($("#sourced option:selected").val() == '0') {
            $("#equipment_sourced_imported").collapse("show");
            $("#equipment_sourced_domestically_sourced").collapse("hide");
        } else if($("#sourced option:selected").val() == '1') {
            $("#equipment_sourced_domestically_sourced").collapse("show");
            $("#equipment_sourced_imported").collapse("hide");
        } else if($("#sourced option:selected").val() == '') {
            $("#equipment_sourced_domestically_sourced").collapse("hide");
            $("#equipment_sourced_imported").collapse("hide");
        }

        $("#sourced").change(function () {
            if($(this).val() == '0') {
                $("#equipment_sourced_imported").collapse("show");
                $("#equipment_sourced_domestically_sourced").collapse("hide");
            } else if($(this).val() == '1') {
                $("#equipment_sourced_domestically_sourced").collapse("show");
                $("#equipment_sourced_imported").collapse("hide");
            } else if($(this).val() == '') {
                $("#equipment_sourced_domestically_sourced").collapse("hide");
                $("#equipment_sourced_imported").collapse("hide");
            }
        });

        $("#que31_securityoffered").change(function () {
            if($(this).val() == 'None of the above') {
                $("#monthlysales").collapse("hide");
                $("#name").collapse("hide");
            } else if($(this).val() == 'Vendor for a ecommerce company') {
                $("#monthlysales").collapse("show");
                $("#name").collapse("show");
            } else if($(this).val() == 'Vendor to a large Retail Chain') {
                $("#monthlysales").collapse("show");
                $("#name").collapse("show");
            }else if($(this).val() == 'Vendor to a large OEM / Manufacturing company') {
                $("#monthlysales").collapse("show");
                $("#name").collapse("show");
            }else if($(this).val() == 'Vendor to a large service company') {
                $("#monthlysales").collapse("show");
                $("#name").collapse("show");
            }else if($(this).val() == 'Distributor of a large manufacturing company') {
                $("#monthlysales").collapse("show");
                $("#name").collapse("show");
            }
        });

        jQuery(document).ready(function($){
            $('#que31_securityoffered').change(function(){
                var selectedValue=$(this).val();
                var dataString = 'Name of the '+ selectedValue;
                $('#namefromselect').text(dataString);
            });


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

        if($("#que21_office_premise_type").children(":selected").val() == "0") {
            $("#que21_approxvalue").collapse("show");
        } else if($("#que21_office_premise_type").children(":selected").val() == "1") {
            $("#que21_monthlyrent").collapse("show");
        }

        if($("#que22_mfgpremisetype").children(":selected").val() == "0") {
            $("#que22_apprxlandvalue").collapse("show");
        }

        if($("#que22_longtcontract").children(":selected").val() == "1") {
            $("#que24").collapse("show");
        }

        $("#que21_office_premise_type").change(function (){
            if($(this).val() == '') {
                $("#que21_approxvalue").collapse("hide");
                $("#que21_monthlyrent").collapse("hide");
            } else if($(this).val() == 0) {
                $("#que21_approxvalue").collapse("show");
                $("#que21_monthlyrent").collapse("hide");
            } else if($(this).val() == 1) {
                $("#que21_monthlyrent").collapse("show");
                $("#que21_approxvalue").collapse("hide");
            }
        });

        $("#que22_mfgpremisetype").change(function (){
            if($(this).val() == '') {
                $("#que22_apprxlandvalue").collapse("hide");
            } else if($(this).val() == 0) {
                $("#que22_apprxlandvalue").collapse("show");
            } else if($(this).val() == 1) {
                $("#que22_apprxlandvalue").collapse("hide");
            }
        });

        $("#que22_longtcontract").change(function(){
            if($(this).val() == '') {
                $("#que24").collapse("hide");
            } else if($(this).val() == 0) {
                $("#que24").collapse("hide");
            } else if($(this).val() == 1) {
                $("#que24").collapse("show");
            }
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
    });
</script>
@endsection