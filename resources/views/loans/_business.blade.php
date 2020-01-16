{!! Form::hidden('model_id', isset($model)?$model->id:null) !!}
{!! Form::hidden('loan_id', strcmp($loanId,"''")!=0?$loanId:null) !!}

<div id="divTab_sub">
    <div class="col-md-10">
        <div class="tab-content tab-design" style="padding-left:10px;padding-top:20px;padding-right:25px;">
            @if($deletedQuestionHelper->isQuestionValid("D3.1"))
                <div class="row" style="width: 106%;">
                    <div class="col-md-12">
                        <div class="col-md-6"  style="margin-left: -5px;margin-right: -15px;">
                            <div class="panel panel-success">
                                <div class="panel-heading">Office Premise Detail</div>
                                <br>
                                <!-- start D3.1 -->
                                @if($deletedQuestionHelper->isQuestionValid("D3.1"))
                                    <div class="col-md-12">
                                        <div class="form-group" style="  margin-left: 5px;">
                                            {!! Form::label('officepremise_type',' Is your Office Premise') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::radio('officepremise_type', '1', false, ['id' => 'office_premise_owned','data-mandatory'=>'M', $setDisable]) !!}
                                            {!! Form::label('officepremise_type', 'Owned') !!}
                                            {!! Form::radio('officepremise_type', '2', false, ['id' => 'office_premise_rented','data-mandatory'=>'M',$setDisable]) !!}
                                            {!! Form::label('officepremise_type', 'Rented') !!}
                                        </div>
                                    </div>
                                @endif
                                <!-- end D3.1 -->
                                <div class="row" style="margin-left:7px">
                                    <div class="col-md-12">
                                        <div class="form-group collapse" id="que21_approxvalue" style="margin-left:10px;">
                                            {!! Form::label('approx_value','Approx value ( ') !!}
                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                            {!! Form::label(null,' In Lacs )') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::text('approx_value', null, ['class' => 'form-control amount','placeholder' => 'Approx Owned Value','style' => 'width: 40%;','data-mandatory'=>'M',$setDisable]) !!}
                                        </div>
                                        <div class="form-group collapse" id="que21_monthlyrent" style="margin-left:10px;">
                                            {!! Form::label('monthly_rent','Monthly Rent Paid ( ') !!}
                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                            {!! Form::label(null,' In Lacs )') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::text('monthly_rentpaid',null, ['id' => 'monthly_rentpaid', 'class' => 'form-control amount','style' => 'width: 40%;','placeholder' => 'Monthly Rent','data-mandatory'=>'M',$setDisable]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-success" >
                                <div class="panel-heading">Manufacturing Premise Detail</div>
                                <br>
                                <!-- start D3.2 -->
                                @if($deletedQuestionHelper->isQuestionValid("D3.2"))
                                    <div class="col-md-12">
                                        <div class="form-group" style="  margin-left: 5px;">
                                            {!! Form::label('mfgpremise_type',' Is your Manufacturing premise on') !!}
                                            {!! Form::radio('mfgpremise_type', 'owned', false, ['id' => 'manufacturing_premise_owned',$setDisable]) !!}
                                            {!! Form::label('mfgpremise_type', 'Owned') !!}
                                            {!! Form::radio('mfgpremise_type', 'leased', false, ['id' => 'manufacturing_premise_leased',$setDisable]) !!}
                                            {!! Form::label('mfgpremise_type_label', 'Leased') !!}
                                        </div>
                                    </div>
                                @endif
                                <!-- end D3.2 -->
                                <div class="row" style="margin-left:7px">
                                    <div class="col-md-12">
                                        <div class="form-group collapse" id="que22_apprxlandvalue" style="margin-left:10px;">
                                            {!! Form::label('owner','Approx Value of Land ( ') !!}
                                            {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                            {!! Form::label(null,' In Lacs )') !!}
                                            {{--{!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}--}}
                                            {!! Form::text('approx_land_value', null, ['id'=> 'approx_land_value', 'class' => 'form-control amount','style' => 'width: 40%;','placeholder' => 'Approx Owned Value',$setDisable]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- start D3.10 -->
            @if($deletedQuestionHelper->isQuestionValid("D3.10"))
                <div class="row" style="margin-left:10px">
                    <div class="panel panel-success">
                        <div class="panel-heading">&nbsp;&nbsp;&nbsp;</div>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group"  style="  margin-left: 20px;">
                                {!! Form::label('owner',' Are You any of the following ') !!}
                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                                {!! Form::select('relationship_type', ['' => '', 'None of the above' => 'None of the above','Ecommerce company' => 'Vendor for a ecommerce company','Large Retail Chain' => 'Vendor to a large Retail Chain', 'Large OEM / Manufacturing company' => 'Vendor to a large OEM / Manufacturing company', 'Large service company' => 'Vendor to a large service company', 'Large manufacturing company' => 'Distributor of a large manufacturing company'],null, ['id' => 'que31_securityoffered', 'style' => 'width: 350px;','data-mandatory'=>'M',$setDisable]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-left:10px">
                            <div class="col-md-12" style="margin-top: -30px;">
                                <div id="yearQue37" class="form-group" style="margin-right: 8px;">
                                    <div class="panel panel-success collapse" id="name">
                                        <div class="panel-heading">Customer Details {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}</div>
                                        <div class="row" style="margin:10px 10px 10px 10px">
                                            <div class="col-sm-6 col-lg-6">
                                                <b><span id = "namefromselect"></span></b>
                                                {!! Form::text('vendor_service_name', null, array('class' => 'form-control', 'style' => 'margin-top: 6px;','data-mandatory'=>'M',$setDisable)) !!}
                                            </div>
                                            <div class="col-sm-6 col-lg-6">
                                                {!! Form::label('cin_no','Relationship Since') !!}
                                                {!! Form::select('vendor_relation_since', ['' => '', '1 Year' => '1 Year','2-4 Years' => '2-4 Years','4-8 Years' => '4-8 Years', '> 8 Years' => '> 8 Years'],null, ['id' => 'que31_relation_since', 'class'=>'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div id="monthlysales" class="panel panel-success collapse">
                                        <div class="panel-heading">Monthly sales details for last 6 months {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}</div>

                                        <div class="table-responsive" style="padding: 10px 10px 0px 10px;">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>
                                                        {!! Form::label('owner','Period') !!}
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
                                                        {!! Form::text('monthly_sales_month_1', (isset($model) && isset($model->vendor_period_1))? $model->vendor_period_1 : null, array('class' => 'form-control year_month_sales' , 'id'=>'monthly_sales_month_1', 'disabled')) !!}
                                                        {!! Form::hidden('vendor_period_1', null, ['id' => 'period_1']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_saleamount_1', null, array('class' => 'form-control amount' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_products_sold_1', null, array('class' => 'form-control' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {!! Form::text('monthly_sales_month_2', (isset($model) && isset($model->vendor_period_2))? $model->vendor_period_2 : null, array('class' => 'form-control year_month_sales' , 'id'=>'monthly_sales_month_2', 'disabled')) !!}
                                                        {!! Form::hidden('vendor_period_2', null, ['id' => 'period_2']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_saleamount_2', null, array('class' => 'form-control amount' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_products_sold_2', null, array('class' => 'form-control' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {!! Form::text('monthly_sales_month_3', (isset($model) && isset($model->vendor_period_3))? $model->vendor_period_3 : null, array('class' => 'form-control year_month_sales' , 'id'=>'monthly_sales_month_3', 'disabled')) !!}
                                                        {!! Form::hidden('vendor_period_3', null, ['id' => 'period_3']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_saleamount_3', null, array('class' => 'form-control amount' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_products_sold_3', null, array('class' => 'form-control' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {!! Form::text('monthly_sales_month_4', (isset($model) && isset($model->vendor_period_4))? $model->vendor_period_4 : null, array('class' => 'form-control year_month_sales' , 'id'=>'monthly_sales_month_4', 'disabled')) !!}
                                                        {!! Form::hidden('vendor_period_4', null, ['id' => 'period_4']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_saleamount_4', null, array('class' => 'form-control amount' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_products_sold_4', null, array('class' => 'form-control' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {!! Form::text('monthly_sales_month_5', (isset($model) && isset($model->vendor_period_5))? $model->vendor_period_5 : null, array('class' => 'form-control year_month_sales' , 'id'=>'monthly_sales_month_5', 'disabled')) !!}
                                                        {!! Form::hidden('vendor_period_5', null, ['id' => 'period_5']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_saleamount_5', null, array('class' => 'form-control amount' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_products_sold_5', null, array('class' => 'form-control' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        {!! Form::text('monthly_sales_month_6', (isset($model) && isset($model->vendor_period_6))? $model->vendor_period_6 : null, array('class' => 'form-control year_month_sales' , 'id'=>'monthly_sales_month_6', 'disabled')) !!}
                                                        {!! Form::hidden('vendor_period_6', null, ['id' => 'period_6']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_saleamount_6', null, array('class' => 'form-control amount' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('vendor_products_sold_6', null, array('class' => 'form-control' ,'data-mandatory'=>'M',$setDisable)) !!}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            <!-- start D3.3 -->
            @if($deletedQuestionHelper->isQuestionValid("D3.3"))
                <div class="row" style="margin-left:10px">
                    <div class="col-md-12">
                        <div id="yearQue37" class="form-group">
                            <div id="topcust" class="panel panel-success">
                                <div class="panel-heading"><b><span id = "nameforlabel"></span></b>
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
                                                {!! Form::text('top3_custname_1', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('top3_annsales_1', null, array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('top3_relationsince_1', ['' => '','1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'], null, ['id' =>'relationship_since_1', 'style' => 'width: 100%;', 'class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!! Form::text('top3_custname_2', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('top3_annsales_2', null, array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('top3_relationsince_2', ['' => '','1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'], null, ['id' =>'relationship_since_2', 'style' => 'width: 100%;', 'class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!! Form::text('top3_custname_3', null, array('class' => 'form-control',$setDisable)) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('top3_annsales_3', null, array('class' => 'form-control amount',$setDisable)) !!}
                                            </td>
                                            <td>
                                                {!! Form::select('top3_relationsince_3', ['' => '', '1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'], null, ['id' =>'relationship_since_3', 'style' => 'width: 100%;', 'class' => 'form-control',$setDisable]) !!}
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
            <!-- end D3.3 -->
            <!-- start D3.4 -->
            @if($deletedQuestionHelper->isQuestionValid("D3.4"))
                <div class="row" style="margin-left: -5px;margin-right: -30px;">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">Contract Details</div>
                            <br>
                            <div class="form-group" style="  margin-left: 20px;">
                                {!! Form::label('owner',' Do you have any long term contracts with any customers') !!}
                                {!! Form::radio('longterm_contracts_type', '1', false, ['id' => 'que22_longtcontract_yes','data-mandatory'=>'M', $setDisable]) !!}
                                {!! Form::label('longterm_contracts_type', 'Yes') !!}
                                {!! Form::radio('longterm_contracts_type', '0', true, ['id' => 'que22_longtcontract_no','data-mandatory'=>'M',$setDisable]) !!}
                                {!! Form::label('longterm_contracts_type', 'No') !!}
                            </div>
                            <br>

                            <div class="row" style="margin-left:10px; margin-right: 10px;margin-top: -30px;">
                                <div class="col-md-12">
                                    <div class="form-group collapse" id="que24">
                                        <div id="compdetails" class="panel panel-success">
                                            <div class="panel-heading">
                                                Customer Long Term Contract Details
                                            </div>
                                            <div class="row" style="margin-left:10px; margin-top:10px">
                                                <div class="col-lg-12 form-group">
                                                    <div class="col-md-6">
                                                        {!! Form::label('owner','Names') !!}
                                                        {!! Form::text('longterm_name', null, ['id' => 'longterm_name', 'class' => 'form-control', 'placeholder' => 'Names of Customers', 'size' => '4x4','data-mandatory'=>'M',$setDisable]) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! Form::label('owner','Number of years of contracts') !!}
                                                        {!! Form::select('longterm_years', array('' => '','1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '> 4 years' => '> 4 years'), null , ['id' => 'no_of_years_of_contracts', 'style' => 'width: 100px;','data-mandatory'=>'M',$setDisable]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-left:10px; margin-top:10px">
                                                <div class="col-lg-12 form-group">
                                                    <div class="col-md-6">
                                                        {!! Form::label('owner','Annual Value of Contracts ( ') !!}
                                                        {!! Form::label(null, '', ['class' => 'fa fa-inr'] ) !!}
                                                        {!! Form::label(null,' In Lacs )') !!}
                                                        {!! Form::text('longterm_ann_contract_value', null, ['id' => 'longterm_ann_contract_value', 'class' => 'form-control amount', 'placeholder' => 'Annual Value of Contracts','data-mandatory'=>'M',$setDisable]) !!}
                                                    </div>

                                                    <div class="col-md-6">
                                                        {!! Form::label('Field5', 'Numbers of years of customer sale relationship details') !!}
                                                        {!! Form::text('longterm_numofyear', null, ['id'=>'longterm_numofyear', 'class' => 'form-control amount', 'placeholder' => 'Numbers of years of customer sale relationship details','data-mandatory'=>'M',$setDisable]) !!}
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
            @endif
            <!-- end D3.4 -->
            <div class="row" style="margin-left:10px">
                <div class="col-md-12">
                    <div id="yearQue37" class="form-group">
                        <div id="topdeb" class="panel panel-success">
                            <div class="panel-heading">Debtor details

                            </div>

                            <div style="padding-left: 10px;padding-top: 10px;">
                                <div class="table-responsive" style="padding: 10px 10px 0px 10px;">
                                    <!-- start D3.5.1 -->
                                    @if($deletedQuestionHelper->isQuestionValid("D3.5.1"))
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th colspan="3">As on Date <i class="redmarks"> <?php echo $removeMandatory ?> </i> </th>
                                            </tr>
                                            <tr>
                                                <th>Name of Debtor <i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                                <th>Amount Outstanding ( <span class="fa fa-inr"></span> in lacs)<i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                                <th>Period Outstanding <i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! Form::text('ao_name_of_debtor_1', null, ['class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::text('ao_amount_outstanding_1', null, ['class' => 'form-control amount','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::select('ao_period_outstanding_1', ['' => '', '< 30 days' => '< 30 days', '30 - 90 days' => '30 - 90 days', '90 - 180 days' => '90 - 180 days', '> 180 days' => '> 180 days'], null , ['id' => 'period_outstanding_1', 'class'=> 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>{!! Form::text('ao_name_of_debtor_2', null, ['class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::text('ao_amount_outstanding_2', null, ['class' => 'form-control amount','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::select('ao_period_outstanding_2', ['' => '', '< 30 days' => '< 30 days', '30 - 90 days' => '30 - 90 days', '90 - 180 days' => '90 - 180 days', '> 180 days' => '> 180 days'], null , ['id' => 'period_outstanding_2', 'class'=> 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>{!! Form::text('ao_name_of_debtor_3', null, ['class' => 'form-control',$setDisable]) !!}</td>
                                                <td>{!! Form::text('ao_amount_outstanding_3', null, ['class' => 'form-control amount',$setDisable]) !!}</td>
                                                <td>{!! Form::select('ao_period_outstanding_3', ['' => '', '< 30 days' => '< 30 days', '30 - 90 days' => '30 - 90 days', '90 - 180 days' => '90 - 180 days', '> 180 days' => '> 180 days'], null , ['id' => 'period_outstanding_3', 'class'=> 'form-control' ,'style' => 'width: 100%;',$setDisable]) !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    <!-- end D3.5.1 -->
                                    <!-- start D3.5.2 -->
                                    @if($deletedQuestionHelper->isQuestionValid("D3.5.2"))
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th colspan="3">As on Last Audited Balance Sheet <i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                            </tr>
                                            <tr>
                                                <th>Name of Debtor <i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                                <th>Amount Outstanding ( <span class="fa fa-inr"></span> in lacs)<i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                                <th>Period Outstanding<i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! Form::text('aud_name_of_debtor_1', null, ['class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::text('aud_amount_outstanding_1', null, ['class' => 'form-control amount','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::select('aud_period_outstanding_1', ['' => '', '< 30 days' => '< 30 days', '30 - 90 days' => '30 - 90 days', '90 - 180 days' => '90 - 180 days', '> 180 days' => '> 180 days'], null , ['id' => 'period_audited_outstanding_1', 'class'=> 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>{!! Form::text('aud_name_of_debtor_2', null, ['class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::text('aud_amount_outstanding_2', null, ['class' => 'form-control amount','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::select('aud_period_outstanding_2', ['' => '', '< 30 days' => '< 30 days', '30 - 90 days' => '30 - 90 days', '90 - 180 days' => '90 - 180 days', '> 180 days' => '> 180 days'], null , ['id' => 'period_audited_outstanding_2', 'class'=> 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>{!! Form::text('aud_name_of_debtor_3', null, ['class' => 'form-control',$setDisable]) !!}</td>
                                                <td>{!! Form::text('aud_amount_outstanding_3', null, ['class' => 'form-control amount',$setDisable]) !!}</td>
                                                <td>{!! Form::select('aud_period_outstanding_3', ['' => '', '< 30 days' => '< 30 days', '30 - 90 days' => '30 - 90 days', '90 - 180 days3' => '90 - 180 days', '> 180 days' => '> 180 days'], null , ['id' => 'period_audited_outstanding_3', 'class'=> 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    <!-- end D3.5.2 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start D3.6 -->
            @if($deletedQuestionHelper->isQuestionValid("D3.6"))
                <div class="row" style="margin-left:10px">
                    <div class="col-md-12">
                        <div id="yearQue37" class="form-group">
                            <div id="topsup" class="panel panel-success">
                                <div class="panel-heading">Suppliers Details

                                </div>

                                <div style="padding-left: 10px;">
                                    <div class="table-responsive" style="padding: 10px 10px 0px 10px;">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th rowspan="2" data-align="center">
                                                    {!! Form::label('owner','Suppliers Name') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                </th>
                                                <th rowspan="2" data-align="center">
                                                    {!! Form::label('owner','Annual Amount') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                </th>
                                                <th rowspan="2" data-align="center">
                                                    {!! Form::label('owner','Relation Since') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                </th>
                                                <th colspan="2" data-align="center" data-halign="center" align = "center">
                                                    {!! Form::label('owner','Reference Name / Contact') !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th data-halign="center" align = "center">Name<i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                                <th data-halign="center">Contact<i class="redmarks"> <?php echo $removeMandatory ?> </i></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{!! Form::text('supplier_name_1', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}</td>
                                                <td>{!! Form::text('supplier_amount_1', null, array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}</td>
                                                <td>{!! Form::select('supplier_relation_1', ['' => '', '1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'], null , ['id' => 'supplier_relation_1', 'class'=> 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::text('supplier_ref_name_1', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}</td>
                                                <td>{!! Form::text('supplier_ref_contact_1', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>{!! Form::text('supplier_name_2', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}</td>
                                                <td>{!! Form::text('supplier_amount_2', null, array('class' => 'form-control amount','data-mandatory'=>'M',$setDisable)) !!}</td>
                                                <td>{!! Form::select('supplier_relation_2', ['' => '', '1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'], null , ['id' => 'supplier_relation_2', 'class'=> 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M',$setDisable]) !!}</td>
                                                <td>{!! Form::text('supplier_ref_name_2', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}</td>
                                                <td>{!! Form::text('supplier_ref_contact_2', null, array('class' => 'form-control','data-mandatory'=>'M',$setDisable)) !!}</td>
                                            </tr>
                                            <tr>
                                                <td>{!! Form::text('supplier_name_3', null, array('class' => 'form-control',$setDisable)) !!}</td>
                                                <td>{!! Form::text('supplier_amount_3', null, array('class' => 'form-control amount',$setDisable)) !!}</td>
                                                <td>{!! Form::select('supplier_relation_3', ['' => '', '1 year' => '1 year', '2 - 4 years' => '2 - 4 years', '4 - 8 years' => '4 - 8 years', '> 8 years' => '> 8 years'], null , ['id' => 'supplier_relation_3', 'class'=> 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}</td>
                                                <td>{!! Form::text('supplier_ref_name_3', null, array('class' => 'form-control',$setDisable)) !!}</td>
                                                <td>{!! Form::text('supplier_ref_contact_3', null, array('class' => 'form-control',$setDisable)) !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- end D3.6 -->
            <!-- start D3.7 -->
            @if($deletedQuestionHelper->isQuestionValid("D3.7"))
                <div class="row" style="margin-left:10px">
                    <div class="col-md-12">
                        <div id="yearQue37" class="form-group">
                            <div id="compdetails" class="panel panel-success">
                                <div class="panel-heading">Details of competitors
                                    {{--{!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}--}}
                                </div>
                                <div class="table-responsive" style="padding: 10px 10px 0px 10px;">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>Type of Competitors</th>
                                        </tr>
                                        <tr>
                                            <td>{!! Form::text('competitor_name_1', null, ['id' => 'competitor_name_1', 'class' => 'form-control',$setDisable]) !!}</td>
                                            <td>{!! Form::select('competitor_type_1', ['' => '', 'Local Player' => 'Local Player', 'Regional Player' => 'Regional Player', 'National Player' => 'National Player'], null, ['id' => 'type_of_competitors_1', 'class'=> 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}</td>
                                        </tr>
                                        <tr id="competitor2" class="collapse">
                                            <td>{!! Form::text('competitor_name_2', null, ['id' => 'competitor_name_2', 'class' => 'form-control',$setDisable]) !!}</td>
                                            <td>{!! Form::select('competitor_type_2', ['' => '', 'Local Player' => 'Local Player', 'Regional Player' => 'Regional Player', 'National Player' => 'National Player'], null , ['id' => 'type_of_competitors_2', 'class'=> 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}</td>
                                        </tr>
                                        <tr id="competitor3" class="collapse">
                                            <td>{!! Form::text('competitor_name_3', null, ['id' => 'competitor_name_3', 'class' => 'form-control',$setDisable]) !!}</td>
                                            <td>{!! Form::select('competitor_type_3', ['' => '', 'Local Player' => 'Local Player', 'Regional Player' => 'Regional Player', 'National Player' => 'National Player'], null , ['id' => 'type_of_competitors_3', 'class'=> 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}</td>
                                        </tr>
                                        <tr id="competitor4" class="collapse">
                                            <td>{!! Form::text('competitor_name_4', null, ['id' => 'competitor_name_4', 'class' => 'form-control',$setDisable]) !!}</td>
                                            <td>{!! Form::select('competitor_type_4', ['' => '', 'Local Player' => 'Local Player', 'Regional Player' => 'Regional Player', 'National Player' => 'National Player'], null , ['id' => 'type_of_competitors_4', 'class'=> 'form-control', 'style' => 'width: 100%;',$setDisable]) !!}</td>
                                        </tr>
                                    </table>
                                </div>
                                <span align="center">
                                    {!! Form::button('Add Competitor', ['class' => 'btn btn-default add_competitor',$setDisable])!!}
                                    {!! Form::button('Remove Competitor', ['class' => 'btn btn-danger remove_competitor',$setDisable])!!}
                                </span>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- end D3.7 -->
            <!-- start D3.8 -->
            @if($deletedQuestionHelper->isQuestionValid("D3.8"))
                <div class="row" style="margin-left:10px">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-left: 10px;">
                            {!! Form::label('owner',' Which of the following positions are present in your company ( Select one or more as applicable )') !!}
                            {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}

                            <?php
                            $recordNum = 1;
                            ?>
                            @foreach ($companyPositionTypes as $companyPositionTypeName=>$companyPositionTypeValue)

                                <label class="checkbox-inline">
                                    {{--{!! Form::checkbox('fin_positions_'.$recordNum, $companyPositionTypeValue,null,[$setDisable]) !!}--}}
                                    {!! Form::checkbox('fin_positions_'.$recordNum, $companyPositionTypeValue,null,[$setDisable]) !!}
                                    {{{$companyPositionTypeName}}}
                                </label>
                                <?php
                                $recordNum++;
                                ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <!-- end D3.8 -->
            <!-- start D3.9 -->
            @if($deletedQuestionHelper->isQuestionValid("D3.9"))
                <?php
                $recordNum = 1;
                ?>
                <div class="row" style="margin-left: -5px;margin-right: -30px;">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">Management details</div>
                            <br>
                            <div class="form-group" style="margin-left: 20px;">
                                {!! Form::label('owner',' Which of the above are held by professional other than promoters ( Select one or more as applicable )') !!}
                                {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                                @foreach ($companyPositionTypes as $companyPositionTypeName=>$companyPositionTypeValue)
                                    <label class="checkbox-inline">
                                        {!! Form::checkbox('fin_profession_'.$recordNum, $companyPositionTypeValue,null,[$setDisable]) !!}
                                        {{{$companyPositionTypeName}}}
                                    </label>
                                    <?php
                                    $recordNum++;
                                    ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- end D3.9 -->

            <div class="center-align" style="margin:0px 25px;"></div>
            <div class="row">
                <div class="col-md-12" style="margin-left:20px;">
                    {{--{!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;']) !!}--}}
                    {!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button','id'=>'saveDetails', 'value'=> 'Save', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
                    @if($user->isSME() || $user->isBankUser())
                        {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    @endif
                    {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    {{--@if (!empty($setDisable))
                        {!! Form::button('Next Section<i class="fa fa-share"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div5','$loanType','$endUseList', $amount, $loanTenure, $loanId); return false;",'id'=>'nextIn', 'value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    @else
                        {!! Form::button('Save & Continue <i class="fa fa-share"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;']) !!}
                    @endif--}}
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            var cnt = 1;
            /*---- end toggle function*/
//            $("#nextIn").click(function (){
//                if(validateForm('#divTab_sub')){
//                    return true;
//                }else{
//                    e.preventDefault();
//                }
//            });
            $('#saveDetails').click(function (e){
                if(validateForm('#divTab_sub','#promter')){
                    return true;
                }else{
                    e.preventDefault();

                }
            });

        });

        $(document).ready(function(){
            //called when key is pressed in textbox
            $(".amount").keypress(function(e){
                if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57))
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
                }
            });
        });

        $('#relationship_since_1').select2({
            allowClear: true,
            placeholder: "Select Year"
        });
        $('#relationship_since_2').select2({
            allowClear: true,
            placeholder: "Select Year"
        });
        $('#relationship_since_3').select2({
            allowClear: true,
            placeholder: "Select Year"
        });

        $('#no_of_years_of_contracts').select2({
            allowClear: true,
            placeholder: "Select Year",
            width:'100%'
        });
        $('#period_outstanding_1').select2({
            allowClear: true,
            placeholder: "Select Days"
        });
        $('#period_outstanding_2').select2({
            allowClear: true,
            placeholder: "Select Days"
        });
        $('#period_outstanding_3').select2({
            allowClear: true,
            placeholder: "Select Days"
        });
        $('#period_audited_outstanding_1').select2({
            allowClear: true,
            placeholder: "Select Days"
        });
        $('#period_audited_outstanding_2').select2({
            allowClear: true,
            placeholder: "Select Days"
        });
        $('#period_audited_outstanding_3').select2({
            allowClear: true,
            placeholder: "Select Days"
        });
        $('#supplier_relation_1').select2({
            allowClear: true,
            placeholder: "Select Year"
        });
        $('#supplier_relation_2').select2({
            allowClear: true,
            placeholder: "Select Year"
        });
        $('#supplier_relation_3').select2({
            allowClear: true,
            placeholder: "Select Year"
        });
        $('#type_of_competitors_1').select2({
            allowClear: true,
            placeholder: "Select Competitors Type"
        });
        $('#type_of_competitors_2').select2({
            allowClear: true,
            placeholder: "Select Competitors Type"
        });
        $('#type_of_competitors_3').select2({
            allowClear: true,
            placeholder: "Select Competitors Type"
        });
        $('#type_of_competitors_4').select2({
            allowClear: true,
            placeholder: "Select Competitors Type"
        });
        $('#que31_securityoffered').select2({
            allowClear: true,
            placeholder: "Select Option"
        });
        $('#que30_geographical_area').select2({
            allowClear: true,
            placeholder: "Select Option"
        });
        $('#que31_relation_since').select2({
            allowClear: true,
            placeholder: "Select Option"
        });$('#type_of_equipment').select2({
            allowClear: true,
            placeholder: "Select Equipment Type"
        });


        $(document).ready(function (){

            /*---- Auto Population Month and Year -----*/
            var monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            var date = new Date();
            var month = date.getMonth();
            var current_month = date.getMonth();

            if($("#monthly_sales_month_1").val() != ""){
                var existingDate = $("#monthly_sales_month_1").val();
                existingDate = "01 " + existingDate.substr(0, existingDate.indexOf("-") -1) + existingDate.substr(existingDate.indexOf("-") +1);
                date = new Date(existingDate);
                month = date.getMonth() + 1;
                current_month = date.getMonth() + 1;
            }

            var year = date.getFullYear();
            var index = 1;

            $(".year_month_sales").each(function () {
                month--;
                if(month == -1){
                    month = 11;
                }
                current_month--;
                if(current_month == -1) {
                    year--;
                }
                $(this).val(monthNames[month]+" - "+year);
                var period = $(this).val(monthNames[month]+" - "+year);
                var hiddenName = "#period_" + index;
                $(hiddenName).val(monthNames[month]+" - "+year);
//            alert($(hiddenName).val());
                index++;
            });
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
            <?php
            $competitorRows = 1;
            if(isset($model) && isset($model->competitor_name_1)){
                $competitorRows++;
            }
            if(isset($model) && isset($model->competitor_name_2)){
                $competitorRows++;
            }
            if(isset($model) && isset($model->competitor_name_3)){
                $competitorRows++;
            }
            if(isset($model) && isset($model->competitor_name_4)){
                $competitorRows++;
            }
            ?>
            var row_counter = {{$competitorRows}};

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
                row_counter--;

                $("#competitor"+row_counter).collapse("hide");
                $("#competitor_name_"+row_counter).val("");
                $("#type_of_competitors_"+row_counter).select2("val", "");

                if(row_counter <= 4) {
                    $(".add_competitor").show();
                }
                if(row_counter == 1) {
                    $(this).hide();
                }
            });
            /*-- end toggle function --*/

            $("#office_premise_owned").click(function () {
                $("#que21_approxvalue").collapse("show");
                $("#monthly_rentpaid").val("");
                $("#que21_monthlyrent").collapse("hide");
            });

            $("#office_premise_rented").click(function () {
                $("#approx_value").val("");
                $("#que21_monthlyrent").collapse("show");
                $("#que21_approxvalue").collapse("hide");
            });

            $("#manufacturing_premise_owned").click(function () {
                $("#que22_apprxlandvalue").collapse("show");
            });

            $("#manufacturing_premise_leased").click(function () {
                $("#approx_land_value").val("");
                $("#que22_apprxlandvalue").collapse("hide");
            });

            $("#imported_sourced").click(function () {
                $("#equipment_sourced_imported").collapse("show");
                $("#equipment_sourced_domestically_sourced").collapse("hide");
            });

            $("#domestically_sourced").click(function () {
                $("#equipment_sourced_imported").collapse("hide");
                $("#equipment_sourced_domestically_sourced").collapse("show");
            });

            $("#que31_securityoffered").change(function () {
                if($(this).val() == 'None of the above' || $(this).val() == '') {
                    $("#monthlysales").collapse("hide");
                    $("#name").collapse("hide");
                } else if($(this).val() == 'Ecommerce company') {
                    $("#monthlysales").collapse("show");
                    $("#name").collapse("show");
                } else if($(this).val() == 'Large Retail Chain') {
                    $("#monthlysales").collapse("show");
                    $("#name").collapse("show");
                }else if($(this).val() == 'Large OEM / Manufacturing company') {
                    $("#monthlysales").collapse("show");
                    $("#name").collapse("show");
                }else if($(this).val() == 'Large service company') {
                    $("#monthlysales").collapse("show");
                    $("#name").collapse("show");
                }else if($(this).val() == 'Large manufacturing company') {
                    $("#monthlysales").collapse("show");
                    $("#name").collapse("show");
                }
            });

            jQuery(document).ready(function($){
                $('#que31_securityoffered').change(function(){
                    var selectedValue=$(this).val();
                    var dataString = 'Name of the '+ selectedValue;
                    $('#namefromselect').text(dataString);
                    if(selectedValue == 'None of the above' || selectedValue == ''){
                        $('#nameforlabel').text("Customer Sales Details");
                    }else{
                        $('#nameforlabel').text("Another customer sales details");
                    }

                });
            });
//            for showing label by default
            $("#nameforlabel").text("Customer Sales Details");

            if($("#que21_office_premise_type").children(":selected").val() == "0") {
                $("#que21_approxvalue").collapse("show");
            } else if($("#que21_office_premise_type").children(":selected").val() == "1") {
                $("#que21_monthlyrent").collapse("show");
            }

            if($("#que22_mfgpremisetype").children(":selected").val() == "0") {
                $("#que22_apprxlandvalue").collapse("show");
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

            $("#que22_longtcontract_yes").click(function () {
                $("#que24").collapse("show");
            });

            $("#que22_longtcontract_no").click(function () {
                $("#que24").collapse("hide");
            });

            initialise(Number(row_counter));

            if($("#que31_securityoffered").val() == "None of the above" || $("#que31_securityoffered").val() == "" )
            {
                $("#monthlysales").collapse("hide");
                $("#name").collapse("hide");
            }
            else
            {
                $("#monthlysales").collapse("show");
                $("#name").collapse("show");
            }

        });

        function initialise(competitorRowCounter){
            if($("#office_premise_owned").is(":checked")){
                $("#monthly_rentpaid").val("");
                $("#que21_approxvalue").collapse("show");
                $("#que21_monthlyrent").collapse("hide");
            }

            if($("#office_premise_rented").is(":checked")){
                $("#approx_value").val("");
                $("#que21_monthlyrent").collapse("show");
                $("#que21_approxvalue").collapse("hide");
            }

            if($("#manufacturing_premise_owned").is(":checked")){
                $("#que22_apprxlandvalue").collapse("show");
            }

            $("#manufacturing_premise_owned").click(function () {
                $("#que22_apprxlandvalue").collapse("show");
            });

            if($("#que31_securityoffered").val() == "None of the above") {
                $("#monthlysales").collapse("hide");
                $("#name").collapse("hide");
            }else{
                var selectedValue=$("#que31_securityoffered").val();
                var dataString = 'Name of the '+ selectedValue;
                $('#namefromselect').text(dataString);

                // $("#monthlysales").collapse("show");
                // $("#name").collapse("show");
            }

            if(competitorRowCounter==1){
                $(".remove_competitor").hide();
            }else{
                $(".remove_competitor").show();
            }

            if(competitorRowCounter>3){
                $(".add_competitor").hide();
            }

            if($("#competitor_name_2").val() != ""){
                $("#competitor2").collapse("show");
            }

            if($("#competitor_name_3").val() != ""){
                $("#competitor3").collapse("show");
            }

            if($("#competitor_name_4").val() != ""){
                $("#competitor4").collapse("show");
            }
        }
    </script>
@endsection