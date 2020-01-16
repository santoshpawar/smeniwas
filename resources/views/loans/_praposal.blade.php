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
.form-group {
  padding-bottom: 0px;
  margin: 0px 0 0 0;
  width: 100% !important;
}
.form-control{
  /*  height: 9px !important;*/
}
.form-group .form-control {
  margin-bottom: 4px !important;
}
.form-horizontal .form-group {
  margin-right: 175px;
  margin-left: -6px;
}
.table > tbody > tr > td{
  padding: 3px 0px 0px 11px !important;
}
.form-group.is-empty {
  width: 100%;
}
</style>
{{-- {!! isset($companySharePledged) ? "<div class='sharePop text-center'>Please provide information regarding  <strong>".$companySharePledged."</strong> who's share are being pledged</div>":""  !!}
@if(isset($companySharePledged))
{!! Form::hidden('companySharePledged', $companySharePledged) !!}
@endif
@if(isset($bscNscCode))
{!! Form::hidden('bscNscCode', $bscNscCode) !!}
@endif --}}
<div class="container-fluid">
 <div class="row">
   <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">proposal <span class="pull-right"> {{ $userProfileFirm->name_of_firm }}</span></h4>
     </div>
     <hr>
    
     <div class="card-content">
      <div class="col-md-12">
        <div class="tab-content tab-design">
          <div class="tab-pane active" id="CompanyBackground" style="">
            <div class="row" id="divTab_sub1" >
              <table class="table"  border="solid">
                <thead class="thead-dark">
                  <tr>
                    <th colspan="4">Title</th>
                  </tr>
                </thead>
               <tbody>
                 
                <tr>
                  <td colspan="2"> 
                    {!! Form::label('lastAuditedTurnover','Last Audited  Turnover', ['class'=>'form-label']) !!} <span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                    {!! Form::text('lastAuditedTurnover', isset($loanUserProfile->latest_turnover) ? $loanUserProfile->latest_turnover : null, array('class' => 'form-control', 'id'=>'lastAuditedTurnover', 'placeholder'=>'', $setDisable)) !!}
                     {!! Form::label('promoterBackground','Education Background of Promoters', ['class'=>'form-label']) !!}
                 
                     @if(isset($praposalDetails->othr_eduprofdegree))
                    {!! Form::select('othr_eduprofdegree', [''=>'Select Education','1'=>'Doctor/Engineer', '2'=>'CA/MBA/Lawyer','3'=>'Graduate','4'=>'Non-Graduate'], $praposalDetails->othr_eduprofdegree, ['class' => 'form-control','id'=>'othr_eduprofdegree','data-mandatory'=>'M' ,$setDisable])!!}
                    @else
                    {!! Form::select('othr_eduprofdegree', [''=>'Select Education','1'=>'Doctor/Engineer', '2'=>'CA/MBA/Lawyer','3'=>'Graduate','4'=>'Non-Graduate'], null, ['class' => 'form-control','id'=>'othr_eduprofdegree','data-mandatory'=>'M' ,$setDisable])!!}
                    @endif 
                  </td>
                  <td colspan="2">
                   {!! Form::label('vintageBusiness','Vintage of business  (yrs)', ['class'=>'form-label']) !!}
                   {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                   @if(isset($praposalDetails->com_business_type))
                   {!! Form::select('com_business_type', [''=>'Select Years','1'=>'< 3 Years', '2'=>'3-7 Years', '3'=>'7-12 Years', '4'=>'>14 Years'], $praposalDetails->com_business_type, ['class' => 'form-control','id'=>'com_business_type','data-mandatory'=>'M' ,$setDisable])!!}
                   @else
                   {!! Form::select('com_business_type', [''=>'Select Years','1'=>'< 3 Years', '2'=>'3-7 Years', '3'=>'7-12 Years', '4'=>'>14 Years'], null, ['class' => 'form-control','id'=>'com_business_type','data-mandatory'=>'M' ,$setDisable])!!}
                   @endif

                 </td>
               </tr>
               <tr>
                <td colspan="4">
                 {!! Form::label('briefProducts','Brief description of Products/Services/business', ['class'=>'form-label']) !!}
                 {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}

                 {!! Form::textarea('briefProducts',(isset($praposalDetails->briefProducts) && isset($praposalDetails->briefProducts))? $praposalDetails->briefProducts : null,['class'=>'form-control', 'rows' => 8, 'cols' => 40]) !!}
               </td>
             </tr>
             <tr>
               <td colspan="4">
                 {!! Form::label('briefCustomers','Brief description of Customers', ['class'=>'form-label']) !!}
                 {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}

                 {!! Form::textarea('briefCustomers',(isset($praposalDetails->briefCustomers) && isset($praposalDetails->briefCustomers))? $praposalDetails->briefCustomers : null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
                 {!! Form::label('historyEquityInfusion','History of Equity infusion (promoter and VC if any)', ['class'=>'form-label']) !!}
                 {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                 
                 {!! Form::textarea('historyEquityInfusion',(isset($praposalDetails->historyEquityInfusion) && isset($praposalDetails->historyEquityInfusion))? $praposalDetails->historyEquityInfusion : null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
               </td>
             </tr> 
             <tr>
               <td colspan="4">
                {!! Form::label('commentaryProfitability','Commentary on profitability', ['class'=>'form-label']) !!}
                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                
                {!! Form::textarea('commentaryProfitability',(isset($praposalDetails->commentaryProfitability) && isset($praposalDetails->commentaryProfitability))? $praposalDetails->commentaryProfitability : null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}
                {!! Form::label('commentaryLiquidityWC','Commentary on Liquidity/ WC', ['class'=>'form-label']) !!}
                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                
                {!! Form::textarea('commentaryLiquidityWC',(isset($praposalDetails->commentaryLiquidityWC) && isset($praposalDetails->commentaryLiquidityWC))? $praposalDetails->commentaryLiquidityWC : null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}
              </td>
            </tr>
            <tr>
             <td colspan="4">
               {!! Form::label('commentaryBalanceSheet','Commentary on Balance sheet', ['class'=>'form-label']) !!}
               {!! Form::label(null,$removeMandatory, ['style' => '  color: red;'])  !!}

               {!! Form::textarea('commentaryBalanceSheet',(isset($praposalDetails->commentaryBalanceSheet) && isset($praposalDetails->commentaryBalanceSheet))? $praposalDetails->commentaryBalanceSheet : null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}
               {!! Form::label('totalBorrowing6Month','Total Borrowing in last 6 mths (Amt and lenders)', ['class'=>'form-label']) !!} <span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
               {!! Form::label(null,$removeMandatory, ['style' => '  color: red;'])  !!}

               {!! Form::textarea('totalBorrowing6Month',(isset($praposalDetails->totalBorrowing6Month) && isset($praposalDetails->totalBorrowing6Month))? $praposalDetails->totalBorrowing6Month : null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}
             </td>
           </tr>
           <tr>
             <td colspan="4">
               {!! Form::label('amountHighCostGT16Loans','Amount of high cost (> 16%) loans borrowed', ['class'=>'form-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
               {!! Form::label(null,$removeMandatory, ['style' => '  color: red;'])  !!}
               
               {!! Form::textarea('amountHighCostGT16Loans',(isset($praposalDetails->amountHighCostGT16Loans) && isset($praposalDetails->amountHighCostGT16Loans))? $praposalDetails->amountHighCostGT16Loans : null,['class'=>'form-control', 'rows' => 3, 'cols' => 40]) !!}
               {!! Form::label('detailsLoanPurpose','Details regarding purpose of Loan', ['class'=>'form-label']) !!}
               {!! Form::label(null,$removeMandatory, ['style' => '  color: red;'])  !!}

               {!! Form::textarea('detailsLoanPurpose',(isset($praposalDetails->detailsLoanPurpose) && isset($praposalDetails->detailsLoanPurpose))? $praposalDetails->detailsLoanPurpose : null,['class'=>'form-control', 'rows' => 5, 'cols' => 40]) !!}
             </td>
           </tr>
         </tbody>
       </table>
       {!! Form::hidden('id',null) !!}
       <div class="row" id="divTab_sub1" >
        <hr>
      </div>
      <div class="center-align" style="margin:0px 25px;"></div>
      <div class="row">
        <div class="col-md-12" style="margin-left:20px;">
          <div id="currentSection">
            {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
          @if($user->isSME() || $user->isCA() || $user->isAnalyst())
        {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
        @else
        {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;','disabled=disabled' )) !!}
        @endif
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
  })
</script>
