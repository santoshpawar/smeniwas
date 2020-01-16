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
.form-control {

    padding: 7px 15px !important;
    
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
               <h4 class="title">Business Financials <span class="pull-right">{{ $userProfile->name_of_firm }}</span></h4>
               {{--    <p class="category">Apply new loan</p> --}}
           </div>
           <div class="card-content">
            <div class="tab-content tab-design" style="padding-top:20px;">
                <div class="btn-group leftside_tab" data-toggle="tab" style="margin-left:10px;">
                    <a id="lnkLoanDtls1" class="btn btn-large btn-success btn-space active" href="#" role="button">Balance Sheet Details</a>
                    <a id="lnkLoanDtls2" class="btn btn-large btn-success btn-space disabled" href="#" role="button">Profit and Loss Details</a>
                    <a id="lnkLoanDtls3" class="btn btn-large btn-success btn-space disabled" href="#" role="button">Other Details</a>
                </div>




                <div id="divTab_sub1" class="collapse">
                    <div>
                        <br>
                        <?php
                        $counter = 0;
                        ?>

                        @foreach($bl_year as $blyear)
                        <?php 
                        $financialBLDataRecord = null;
                        $key_blyear = str_replace('(Provisional)', '', $blyear);

                        if ($financialBLDataMap->offsetExists($key_blyear)) {
                            $financialBLDataRecord = $financialBLDataMap->offsetGet($key_blyear);
                        }
                        ?>
                        <div class="col-lg-4">
                            <div class="panel panel-success">
                                <!-- Default panel contents -->
                                <div class="panel-heading" name={{$blyear}}>{{$blyear}}<span>&nbsp;( <span class="fa fa-inr">&nbsp; </span>Lacs )</span></div>
                                @if(isset($financialBLDataRecord))
                                {!! Form::hidden('financial['.$counter.'][id]',
                                $financialBLDataRecord->id)!!}
                                {!! Form::hidden('financial['.$counter.'][loan_id]',
                                $financialBLDataRecord->loan_id)!!}
                                {!! Form::hidden('financial['.$counter.'][finyear]',
                                $financialBLDataRecord->finyear)!!}
                                @else
                                {!! Form::hidden('financial['.$counter.'][loan_id]', $loanId)!!}
                                {!! Form::hidden('financial['.$counter.'][finyear]', str_replace('(Provisional)', '', $blyear))!!}
                                @endif
                                <div class="panel-body" style="padding:0px;">
                                    <!-- Table -->
                                    <table cellpadding="4" cellspacing="4" class="table borderless" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="padding: 5px;">
                                                <table class="table borderless" style="margin-bottom: 0px;">
                                                    <tr>
                                                        <td>
                                                            <table class="table borderless">
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('Networth', 'Networth') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialBLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][networth]', $financialBLDataRecord->networth , array('class' => 'form-control','onkeypress'=>'return isNumberKey(event)',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][networth]', null , array('class' => 'form-control','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Net Worth','data-mandatory'=>'M', $setDisable)) !!}    
                                                                        @endif
                                                                        {{-- {!! Form::text('financial['.$counter.'][networth]', null , array('class' => 'form-control',$setDisable, 'keypress' => 'validate(event)' )) !!}--}}

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('TotalDebt', 'Short Term Loan') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialBLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][total_debt]', $financialBLDataRecord->total_debt , array('class' => 'form-control stl','placeholder'=>'Short Term Loan','onkeypress'=>'return isNumberKey(event)',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][total_debt]', null , array('class' => 'form-control stl','placeholder'=>'Short Term Loan','data-mandatory'=>'M', 'onkeypress'=>'return isNumberKey(event)',$setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('TermDebt', 'Long Term Loan') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialBLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][term_debt]', $financialBLDataRecord->term_debt , array('class' => 'form-control   ltl','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Long Term Loan',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][term_debt]', null , array('class' => 'form-control   ltl','data-mandatory'=>'M','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Long Term Loan', $setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('Debtors', 'Total Loan') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialBLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][debtors]', $financialBLDataRecord->debtors , array('class' => 'form-control   tl','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Total Loan',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][debtors]', null , array('class' => 'form-control   tl','data-mandatory'=>'M', 'onkeypress'=>'return isNumberKey(event)','placeholder'=>'Total Loan',$setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('Inventory', 'Inventory') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialBLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][inventory]', $financialBLDataRecord->inventory , array('class' => 'form-control','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Inventory',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][inventory]', null , array('class' => 'form-control','data-mandatory'=>'M','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Inventory', $setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('Creditors', 'Creditors') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialBLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][creditors]', $financialBLDataRecord->creditors , array('class' => 'form-control','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Creditors',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][creditors]', null , array('class' => 'form-control','data-mandatory'=>'M', 'onkeypress'=>'return isNumberKey(event)','placeholder'=>'Creditors',$setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('NetFixedAssets', 'Net Fixed Assets') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialBLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][net_fixed_assets]', $financialBLDataRecord->net_fixed_assets , array('class' => 'form-control','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Net Fixed Asset',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][net_fixed_assets]', null , array('class' => 'form-control','data-mandatory'=>'M','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Net Fixed Asset', $setDisable)) !!}    
                                                                        @endif
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
                        <?php $counter++; ?>
                        @endforeach
                    </div>
                </div>

                {{--========Start DivSub 2==========================================================================--}}
                <div id="divTab_sub2" class="collapse">
                    <br>
                    {{--{!! Form::label('KYCDetails', 'Profit and Loss Details') !!}--}}
                    <div>
                        <?php $counter = 0; ?>
                        @foreach($bl_year as $blyear)
                        <?php 
                        $financialPLDataRecord = null;
                        $key_blyear = str_replace('(Provisional)', '', $blyear);

                        if ($financialPLDataMap->offsetExists($key_blyear)) {
                            $financialPLDataRecord = $financialPLDataMap->offsetGet($key_blyear);
                        }
                        ?>
                        <div class="col-lg-4">
                            <div class="panel panel-success">
                                <!-- Default panel contents -->
                                <div class="panel-heading" name={{$blyear}}>{{$blyear}}<span>&nbsp;( <span class="fa fa-inr">&nbsp; </span>Lacs )</span></div>
                                @if(isset($financialPLDataRecord))
                                {!! Form::hidden('financial['.$counter.'][id]',
                                $financialPLDataRecord->id)!!}
                                {!! Form::hidden('financial['.$counter.'][loan_id]',
                                $financialPLDataRecord->loan_id)!!}
                                {!! Form::hidden('financial['.$counter.'][finyearpl]',
                                $financialPLDataRecord->finyear)!!}
                                @else
                                {!! Form::hidden('financial['.$counter.'][loan_id]', $loanId)!!}
                                {!! Form::hidden('financial['.$counter.'][finyearpl]', str_replace('(Provisional)', '', $blyear))!!}
                                @endif
                                <div class="panel-body" style="padding:0px;">
                                    <table width="100%" cellpadding="4" cellspacing="4" class="table" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="padding: 5px;">
                                                <table class="table" style="margin-bottom: 0px;">
                                                    <tr>
                                                        <td valign="top">
                                                            <table class="table" style="margin-bottom: 0px;">
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('Revenue', 'Revenue') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialPLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][revenue]', $financialPLDataRecord->revenue , array('class' => 'form-control rev','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Revenue',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][revenue]', null , array('class' => 'form-control rev','data-mandatory'=>'M','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Revenue', $setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('OperatingProfit', 'EBITDA/Operating Profit') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialPLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][ebitda_profit]', $financialPLDataRecord->ebitda_profit , array('class' => 'form-control eb','onkeypress'=>'return isNumberKey(event)','placeholder'=>'EBITDA/Operating Profit',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][ebitda_profit]', null , array('class' => 'form-control eb','data-mandatory'=>'M','onkeypress'=>'return isNumberKey(event)','placeholder'=>'EBITDA/Operating Profit', $setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('InterestExpense', 'Interest Expense') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialPLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][interest_expense]', $financialPLDataRecord->interest_expense , array('class' => 'form-control ','placeholder'=>'Interest Expense',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][interest_expense]', null , array('class' => 'form-control ','data-mandatory'=>'M', 'placeholder'=>'Interest Expense',$setDisable)) !!}    
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        {!! Form::label('PAT', 'PAT') !!}
                                                                        @if($counter <= 1)
                                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 3px;">
                                                                        @if(isset($financialPLDataRecord))
                                                                        {!! Form::text('financial['.$counter.'][pat]', $financialPLDataRecord->pat , array('class' => 'form-control  pat','placeholder'=>'PAT',$setDisable)) !!}    
                                                                        @else
                                                                        {!! Form::text('financial['.$counter.'][pat]', null , array('class' => 'form-control  pat','data-mandatory'=>'M','placeholder'=>'PAT', $setDisable)) !!}    
                                                                        @endif
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
                                <!-- Table -->
                            </div>
                        </div>
                        <?php $counter++; ?>
                        @endforeach
                    </div>
                </div>
                {{--========Start DivSub 3==========================================================================--}}
                <div id="divTab_sub3" class="collapse">
                    <div class="row">
                        <br>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">Fixed Asset Details (As per last Audited)</div>
                            <div class="panel-body" style="padding:0px;">
                                <div class="row" style="margin-left: auto;">
                                    <div class="col-md-5">
                                        <div class="form-group" style="margin-left: auto;">
                                            {!! Form::label('AssetsFA', 'Total Gross Fixed Assets',['class'=>'control-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                            {!! Form::text('fin_grossfixedassets', null, array('class' => 'form-control ','id'=>'gross_fixed_asset','placeholder'=>'Total Gross Fixed Assets','data-mandatory'=>'M' ,$setDisable)) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-left: auto;">
                                            {!! Form::label('AssetsFA', 'Gross Value of Plant & Machinery (before depreciation)',['class'=>'control-label'] ) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                            {!! Form::text('fin_grossvalueofplant', null, array('class' => 'form-control ','placeholder'=>'Gross Value of Plant & Machinery','data-mandatory'=>'M' ,$setDisable )) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <br>
                        </div>

                        <div class="panel panel-success">
                            <div class="panel-heading">Existing Loan Details</div>
                            <div class="panel-body" style="padding:0px;">
                                <div class="row collapse in" id="existingLoanDiv">

                                    <div class="row" style="margin-left: auto;">
                                        <div class="col-md-5">
                                            <div class="form-group" style="margin-left: 15px;">
                                                {!! Form::label('no_of_existingloan','Number of Existing Loan', ['class'=>'control-label']) !!}
                                                {!! Form::select('fin_numofexistingloan', array('' => 'Select No.of Existing Loan','0' => 'None', '1' => '1', '2' => '2', '3' => '3', '4' => 'Greater than 3'),null,['id' => 'no_of_existingloan', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                @for($formIndex=1; $formIndex <= 3; $formIndex++)

                                <div id="existingLoanDetails_{{$formIndex}}" class="panel panel-success collapse" width="80%">
                                    <div class="panel-heading">Loan Details - {{$formIndex}}</div>
                                    <div class="row">
                                        <br>
                                    </div>
                                    <div class="row" style="padding: 2px;">
                                        <div class="col-lg-12">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    {!! Form::label('bankname','Name',['class'=>'col-md-1 form-label']) !!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    <div class="col-md-8 col-lg-12">
                                                        @if(isset($existingloan_details[$formIndex-1]))
                                                        {!! Form::text('bankname['.$formIndex.']', $existingloan_details[$formIndex-1]['name'], array('class' => 'form-control','placeholder'=>'Name of Bank/NBFC','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        @else
                                                        {!! Form::text('bankname['.$formIndex.']', null, array('class' => 'form-control','placeholder'=>'Name of Bank/NBFC','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        {!! Form::label('typeofloan','Type of Loan', ['class'=>'form-label' , 'id' => 'label_typeofloan']) !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    </div>
                                                    <div class="col-lg-12">
                                                        @if(isset($existingloan_details[$formIndex-1]))
                                                        {!! Form::select('loantype['.$formIndex.']', array('' => 'Please select loan type','0' => 'Unsecured Loan', '1' => 'Secured Term Loan ', '2' => 'CC / OD', '3' => 'Loan against Property', '4' => 'Other'), $existingloan_details[$formIndex-1]['loan_type'], ['id' => 'loantype'.$formIndex, 'class' => 'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
                                                        @else

                                                        {!! Form::select('loantype['.$formIndex.']', array('' => 'Please select loan type','0' => 'Unsecured Loan', '1' => 'Secured Term Loan ', '2' => 'CC / OD', '3' => 'Loan against Property', '4' => 'Other'), null, ['id' => 'loantype'.$formIndex, 'class' => 'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 2px;">
                                        <div class="col-lg-12">
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        {!! Form::label('', 'Outstanding Amount',['class'=>'form-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    </div>
                                                    <div class="col-lg-12">
                                                        @if(isset($existingloan_details[$formIndex-1]))
                                                        {!! Form::text('outstanding_amount['.$formIndex.']', $existingloan_details[$formIndex-1]['amount_outstanding'], array('class' => 'form-control ','onkeypress'=>'return isNumberKey(event)','placeholder'=>'Outstanding Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        @else
                                                        {!! Form::text('outstanding_amount['.$formIndex.']', null, array('class' => 'form-control ','onkeypress'=>'return isNumberKey(event)' ,'placeholder'=>'Outstanding Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="form-group" id="monthlyemi_amount">
                                                    <div class="col-md-6">
                                                        {!! Form::label('', 'Monthly EMI Amount',['class'=>'form-label'] ) !!}
                                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    </div>
                                                    <div class="col-md-12 col-lg-12">
                                                        @if(isset($existingloan_details[$formIndex-1]))
                                                        {!! Form::text('monthlyemi_amount['.$formIndex.']', $existingloan_details[$formIndex-1]['amount_monthlyemi'], array('class' => 'form-control ','placeholder'=>'Monthly EMI Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        @else
                                                        {!! Form::text('monthlyemi_amount['.$formIndex.']', null, array('class' => 'form-control ','placeholder'=>'Monthly EMI Amount','data-mandatory'=>'M' ,$setDisable)) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group" id="balance_tenure">
                                                    {!! Form::label('', 'Balance Tenure',['class'=>'col-md-5 form-label']) !!}
                                                    <div class="col-lg-12">
                                                        @if(isset($existingloan_details[$formIndex-1]))
                                                        {!! Form::text('balance_tenure['.$formIndex.']', $existingloan_details[$formIndex-1]['balance_tenure'], array('class' => 'form-control ','placeholder'=>'Balance Tenure (months)',$setDisable)) !!}
                                                        @else
                                                        {!! Form::text('balance_tenure['.$formIndex.']', null, array('class' => 'form-control ','placeholder'=>'Balance Tenure (months)',$setDisable)) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-6">
                                                <div class="form-group" id="securityprovided">
                                                    {!! Form::label('securityprovided','Security Provided', ['id' => 'label_securityprovided','class'=>'col-md-5 form-label']) !!}
                                                    <div class="col-md-7 col-lg-12">
                                                        @if(isset($existingloan_details[$formIndex-1]))
                                                        {!! Form::select('securityprovided['.$formIndex.']', array(' ' => 'Please select security provided','0' => 'None', '1' => 'Only Current Assets', '2' => 'Only Fixed Assets', '3' => 'Collateral Property', '4' => 'Specific Equipments', '5' => 'Collateral Property + Other Assets'), $existingloan_details[$formIndex-1]['security_provided'], ['id' => 'securityprovided'.$formIndex, 'class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                        @else
                                                        {!! Form::select('securityprovided['.$formIndex.']', array(' ' => 'Please select security provided','0' => 'None', '1' => 'Only Current Assets', '2' => 'Only Fixed Assets', '3' => 'Collateral Property', '4' => 'Specific Equipments', '5' => 'Collateral Property + Other Assets'), null, ['id' => 'securityprovided'.$formIndex, 'class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                                <div id="existingLoanDetails_4" class="panel panel-success collapse">
                                    <div class="panel-heading">Other Loan Details</div>
                                    <div class="row">
                                        <br>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-sm-8 col-lg-6">
                                                <div class="form-group">
                                                    {!! Form::label('','Outstanding Amount', ['class'=>'col-md-6 form-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                                                    <div class="col-lg-12">
                                                        {!! Form::text('other_outstandingamount', null, ['class' => 'form-control ', 'id'=>'other_outstandingamount', 'placeholder'=>'Outstanding Amount ( Lacs )',$setDisable]) !!}
                                                    </div>Lacs

                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-lg-6"> 
                                                <div class="form-group">
                                                    {!! Form::label('','Total Monthly EMI', ['class'=>'form-label', 'style' => '  margin-left: 15px;']) !!}
                                                    <div class="col-lg-12">
                                                        {!! Form::text('other_totalmonthlyemi', null, ['class' => 'form-control', 'id'=>'other_totalmonthlyemi', 'placeholder'=>'Total Monthly EMI ( Lacs )',$setDisable]) !!}
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
                <div class="clearfix"></div>
                <div class="col-md-12 "><div class="center-align" ></div> </div>

                <div class="row">
                    <div class="col-md-12" style="margin-left:20px;">
                        <div id="currentSection">
                            {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            {!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails', 'value'=> 'Save', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
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




<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

<script>

    $(document).ready(function() {
       var shareIfExist=$('#companySharePledged').val();


       $( ".stl" ).change(function() {
        var l = Number($(this).parent().parent().parent().find('.ltl').val());
        var s = Number($(this).val());
        t = l + s;
        $(this).parent().parent().parent().find('.tl').val(t);
    });

       $( ".ltl" ).change(function() {
        var s = Number($(this).parent().parent().parent().find('.stl').val());
        var l = Number($(this).val());
        t = l + s;
        $(this).parent().parent().parent().find('.tl').val(t);
    });

       $( ".pat" ).change(function() {
        var v1 = Number($(this).val());
        var v2 = Number($(this).parent().parent().parent().find('.eb').val());
        if(v1>v2){
            $(this).val('');
        }
    });

       $( ".eb" ).change(function() {
        var v1 = Number($(this).val());
        var v2 = Number($(this).parent().parent().parent().find('.rev').val());
        if(v1>v2){
            $(this).val('');
        }
    });

       var cnt = 1;


       $('#divTab_sub1').show();
       $('#divTab_sub2').hide();
       $('#divTab_sub3').hide();
       $('#saveDetails').hide();
       $('#raise_query').hide();

       $(lnkLoanDtls1).click(function()
       {
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

       $(lnkLoanDtls2).click(function()
       {
        $('#divTab_sub2').show();
        $('#currentSection').show();
        cnt=2;
        $('#divTab_sub1').hide();
        $('#divTab_sub3').hide();
        $('#backIn').show();
        $('#nextIn').show();
        $(this).addClass("active").siblings().removeClass("active");
        if(shareIfExist!=undefined){
            $('#saveDetails').show();
            $('#raise_query').show();
        }else{
         $('#saveDetails').hide();
         $('#raise_query').hide();
     }


 });

       $(lnkLoanDtls3).click(function()
       {
        $('#divTab_sub3').show();
        cnt=3;
        $('#divTab_sub1').hide();
        $('#divTab_sub2').hide();
                    //$('#currentSection').hide();
                    $('#nextIn').hide();
                    $('#backIn').show();
                    $(this).addClass("active").siblings().removeClass("active");
                    $('#saveDetails').show();
                    $('#raise_query').show();
                });


       if(cnt==1){
        $('#backIn').hide();
    }

    /*---- end toggle function*/
    $("#nextIn").click(function (){

        if(cnt==1){
            if($('#divTab_sub'+cnt).css('display') == 'block'){
                if(validateForm('#divTab_sub'+cnt,'#promter')){
                    $('#divTab_sub'+cnt).hide();
                    $('#lnkLoanDtls'+cnt).removeClass('active');
                    cnt++;

                    $('#lnkLoanDtls'+cnt).removeClass('disabled');
                    $('#lnkLoanDtls'+cnt).addClass('active');
                    $('#divTab_sub'+cnt).show();
                    $('#currentSection').show();
                    $('#backIn').show();
                    if(shareIfExist!=undefined){
                        $('#saveDetails').show();
                        $('#raise_query').show();
                        $('#nextIn').hide();
                        $('#lnkLoanDtls3').addClass('disabled');
                    }else{
                     $('#saveDetails').hide();
                     $('#raise_query').hide();
                 }

             }

         }
     }
     else if(cnt==2){
        if($('#divTab_sub'+cnt).css('display') == 'block'){
            if(validateForm('#divTab_sub'+cnt,'#promter')){
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
            if(validateForm('#divTab_sub'+cnt,'#promter')){
                $('#divTab_sub'+cnt).hide();
                                //$('#currentSection').hide();
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
        if(cnt==3){
            if(validateForm('#divTab_sub'+cnt)){
                return true;
            }else{
                e.preventDefault();
            }
        }
    });

    var loanCount = $("#no_of_existingloan").val();
    if(loanCount == 0){
        $("#existingLoanDetails_").collapse("hide");
        for(var index = 4; index >= 1; index--){
            $("#existingLoanDetails_"+index).collapse("hide");
        }
    }else{
        if(loanCount == 4) {
            $("#existingLoanDetails_4").collapse("show");
            loanCount = 3;
        }


        $("#existingLoanDetails_").collapse("show");
        for(var index = 1; index <= loanCount; index++){
            $("#existingLoanDetails_"+index).collapse("show");
            $('#loantype'+index).select2({
                allowClear: true,
                placeholder: "Select Option",
                width :'100%'
            });
            $('#securityprovided'+index).select2({
                allowClear: true,
                placeholder: "Select Option",
                width :'100%'
            });
        }

        for(var index = 4; index > loanCount; index--){
            $("#existingLoanDetails_"+index).collapse("hide");
        }
    }

    if($("#no_of_existingloan").val() === ' ')
    {
        $("#existingLoanDetails").collapse("hide");
    }
    else
    {

        $("#existingLoanDetails").collapse("show");
    }
});

            //==============================================================//
            $('#no_of_existingloan').select2({
                allowClear: true,
                placeholder: "Select Option",
                width :'100%'
            });

            $(document).ready(function () {

                $("#no_of_existingloan").change(function() {
                    var loanCount = $(this).val();
                //alert(loanCount);
                if(loanCount == 0){
                    $("#existingLoanDetails_").collapse("hide");
                    for(var index = 4; index >= 1; index--){
                        $("#existingLoanDetails_"+index).collapse("hide");
                    }
                }else{
                    if(loanCount == 4) {
                        $("#existingLoanDetails_4").collapse("show");
                        loanCount = 3;
                    }

                    $("#existingLoanDetails_").collapse("show");
                    for(var index = 1; index <= loanCount; index++){
                        $("#existingLoanDetails_"+index).collapse("show");
                        $('#loantype'+index).select2({
                            allowClear: true,
                            placeholder: "Select Option",
                            width :'100%'
                        });
                        $('#securityprovided'+index).select2({
                            allowClear: true,
                            placeholder: "Select Option",
                            width :'100%'
                        });
                    }

                    for(var index = 4; index > loanCount; index--){
                        $("#existingLoanDetails_"+index).collapse("hide");
                    }
                }

                if($(this).val() === ' ')
                {
                    $("#existingLoanDetails").collapse("hide");
                }
                else
                {
                    $("#existingLoanDetails").collapse("show");
                }

                if(shareIfExist!=undefined){

                    $('#lnkLoanDtls3').addClass('disabled');
                } 

            });

                //* scripts for cibil yes/no *//*
                $("#cibilScoreContainer").hide();
                $("#cibilScoreYes").click(function () {
                    $("#cibilScoreContainer").show();
                });
                $("#cibilScoreNo").click(function () {
                    $("#cibilScoreContainer").hide();
                });
                

                var cibilScr = '{{$loan['fin_doyouknowcibil']}}';
                //console.log(cibilScr);
                if(cibilScr == 'Yes'){
                    $("#cibilScoreContainer").show();
                }


                function IsNumeric(e) {
                    alert('ss');
                    var keyCode = e.which ? e.which : e.keyCode
                    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
                    //document.getElementById("error").style.display = ret ? "none" : "inline";
                    return ret;
                }
                //alert($('#revenue').val());
                if($('#revenue').val() != ''){
                    $('#lnkLoanDtls2').removeClass('disabled');
                }else{
                    $('#lnkLoanDtls2').addClass('disabled');
                }
                if($('#gross_fixed_asset').val() != ''){
                    $('#lnkLoanDtls3').removeClass('disabled');
                }else{
                    $('#lnkLoanDtls3').addClass('disabled');
                }
            });

            function isNumberKey(evt)
            {
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (
                    (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
                    (charCode != 43 || $(element).val().indexOf('+') != -1) &&      // “+” CHECK PLUS, AND ONLY ONE.
                    (charCode != 42 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                    (charCode != 46 || $(element).val().indexOf('*') != -1) &&      // “*” CHECK DOT, AND ONLY ONE.
                    (charCode != 47 || $(element).val().indexOf('/') != -1) &&      // “/” CHECK DOT, AND ONLY ONE.
                    (charCode != 40 || $(element).val().indexOf("(") != -1) &&      // “(” CHECK (, AND ONLY ONE.
                    (charCode != 41 || $(element).val().indexOf(")") != -1) &&      // “)” CHECK ), AND ONLY ONE.
                    (charCode < 48 || charCode > 57))
                return false;

            return true;
        }



    </script>
