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

/*key laon term file*/
</style>
<div class="container-fluid">
 <div class="row">
   <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">Key Loan Term<span class="pull-right"> {{ $userProfileFirm->name_of_firm }}</span></h4>
     </div>
     <hr>
     <div class="card-content">
      <div class="col-md-12">
        <div class="tab-content tab-design">
          <div class="tab-pane active" id="CompanyBackground" style="">
            {!! Form::hidden('id',null) !!}
            <div class="row" id="divTab_sub1" >
              <table class="table"  border="solid">
                <thead class="thead-dark">
                </thead>
                




              </tbody>
            </table>
          </div>
        </div> 
        <div class="center-align" style="margin:0px 25px;"></div>
        <div class="card-content">
          <div class="panel panel-success">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-4">
                 {!! Form::label('borrower_name','Name of Borrower', ['class'=>'form-label']) !!} 
                 {!! Form::text('borrower_name', $userProfileFirm->name_of_firm , array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}
                 
               </div>

               <div class="col-md-4">
              {!! Form::label('borrower_name','Lender', ['class'=>'form-label']) !!} 
                 {!! Form::text('borrower_name', 'Bifco Leasing and Finance Private Limited', array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}

              </div>

              <div class="col-md-4">
               {!! Form::label('guarantors', 'Guarantors') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}
               {!! Form::text('guarantors', @$keyloanterm->guarantors, array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}

             </div>
             <div class="col-md-4">
              {!! Form::label('amount', 'Amount') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!} <span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
              {!! Form::text('amount', @$keyloanterm->amount, array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}
            </div>  
            <div class="col-md-4">
             {!! Form::label('purpose', 'Purpose') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}
             {!! Form::text('purpose', @$keyloanterm->purpose, array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}
           </div>  
           <div class="col-md-4">
             {!! Form::label('facility', 'Facility') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}       
             {!! Form::text('facility', @$keyloanterm->facility, array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}   
           </div>  
           <div class="col-md-4">
             {!! Form::label('tenor', 'Tenor (Months)') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}
             {!! Form::text('tenor', @$keyloanterm->tenor, array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}
           </div>
           <div class="col-md-4">
            {!! Form::label('interest_rate', 'Interest Rate') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}<span class="small">( % )</span>
            {!! Form::text('interest_rate', @$keyloanterm->interest_rate, array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}
          </div>
          <div class="col-md-4">
            {!! Form::label('processing_fee', 'Processing Fee') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}<span class="small">( % )</span>
            {!! Form::text('processing_fee', @$keyloanterm->processing_fee, array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}
          </div>
          <div class="col-md-4">
           {!! Form::label('legal_fee', 'Legal Fee') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}<span class="small">( <i class="fa fa-rupee"></i>  )</span>
           {!! Form::text('legal_fee', @$keyloanterm->legal_fee, array('class' => 'form-control', 'id'=>'legal_fee', 'placeholder'=>'', $setDisable)) !!}
         </div>
         <div class="col-md-4">
           {!! Form::label('repayment_schedule', 'Repayment Schedule') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}
           {!! Form::text('repayment_schedule', @$keyloanterm->repayment_schedule, array('class' => 'form-control', 'id'=>'repayment_schedule', 'placeholder'=>'', $setDisable)) !!}
         </div>
         <div class="col-md-4">
          {!! Form::label('prepayment_penalty', 'Prepayment Penalty') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}<span class="small">( <i class="fa fa-rupee"></i> % )</span>
          {!! Form::text('prepayment_penalty', @$keyloanterm->prepayment_penalty, array('class' => 'form-control', 'id'=>'prepayment_penalty', 'placeholder'=>'', $setDisable)) !!}
        </div>
        <div class="col-md-12">
          {!! Form::label('pre_disbursement_conditions', 'Pre Disbursement Conditions') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}
          {!! Form::textarea('pre_disbursement_conditions',(isset($keyloanterm->pre_disbursement_conditions) && isset($keyloanterm->pre_disbursement_conditions))? $keyloanterm->pre_disbursement_conditions : null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
        </div>
        <div class="col-md-12">
          {!! Form::label('security', 'Security') !!}{!! Form::label(null,'', ['style' => '  color: red;']) !!}
          {!! Form::textarea('security',(isset($keyloanterm->security) && isset($keyloanterm->security))? $keyloanterm->security : null,['class'=>'form-control', 'rows' => 4, 'cols' => 50]) !!}
        </div>
      </div>
      <span> <h5 class="text-left bold"><b>Financial Covenants</b></h5></span>
      <div class="row">
        <div class="col-md-4">
          {!! Form::label('Debt/EBITDA','Debt/EBITDA', ['class'=>'form-label']) !!}
          {!! Form::text('fin_conv_debt_ebitda', @$keyloanterm->fin_conv_debt_ebitda, array('class' => 'form-control', 'id'=>'fin_conv_debt_ebitda', 'placeholder'=>'', '')) !!}
        </div>
        <div class="col-md-4">
         {!! Form::label('Debt/Equity','Debt/Equity',['class'=>'form-label'])  !!}
         {!! Form::text('fin_conv_debt_equity_ratio', @$keyloanterm->fin_conv_debt_equity_ratio, array('class' => 'form-control', 'id'=>'fin_conv_debt_equity_ratio', 'placeholder'=>'', '')) !!}
       </div>
       <div class="col-md-4">
         {!! Form::label('CurrentRatio','Current Ratio',['class'=>'form-label'])  !!}
         {!! Form::text('fin_conv_current_ratio', @$keyloanterm->fin_conv_current_ratio, array('class' => 'form-control', 'id'=>'fin_conv_current_ratio', 'placeholder'=>'', '')) !!}
       </div>
       <div class="col-md-4">
         {!! Form::label('Debt/Equity','Debt/Equity',['class'=>'form-label'])  !!}
         {!! Form::text('fin_conv_debt_equity_ratio', @$keyloanterm->fin_conv_debt_equity_ratio, array('class' => 'form-control', 'id'=>'praposalSourceOthers', 'placeholder'=>'', '')) !!}
       </div>
       <div class="col-md-4">
         {!! Form::label('InterestCoverageratio','Interest Coverage ratio',['class'=>'form-label'])  !!}
         {!! Form::text('fin_conv_interest_cov_ratio', @$keyloanterm->fin_conv_interest_cov_ratio, array('class' => 'form-control', 'id'=>'fin_conv_interest_cov_ratio', 'placeholder'=>'', '')) !!}
       </div>
       <div class="col-md-4">
         {!! Form::label('Others','Others',['class'=>'form-label'])  !!}
         {!! Form::text('fin_conv_other', @$keyloanterm->fin_conv_other, array('class' => 'form-control', 'id'=>'fin_conv_other', 'placeholder'=>'', '')) !!}
       </div>
     </div>
     <span> <h5 class="text-left bold"><b>Other Covenants</b></h3></span>
      <div class="row">
        <div class="col-md-12">
         {!! Form::label('Standard','Standard',['class'=>'form-label'])  !!}
         {!! Form::text('other_convenants_standerds', @$praposalBackground->other_convenants_standerds, array('class' => 'form-control', 'id'=>'other_convenants_standerds', 'placeholder'=>'', '')) !!}
       </div>
       <div class="col-md-12">
         {!! Form::label('Others','Standard with Additions',['class'=>'form-label'])  !!}
         {!! Form::textarea('other_convenants_standerds_withaddiotion',(isset($keyloanterm->other_convenants_standerds_withaddiotion) && isset($keyloanterm->other_convenants_standerds_withaddiotion))? $keyloanterm->pre_disbursement_conditions : null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
       </div>
     </div>
   </div>
 </div>
 <div class="center-align" style="margin:0px 25px;"></div>
 <center>{!! Form::label('Risk & Mitigants','', ['style' => '  color: red;'])  !!}</center>
 <textarea name="lastRowriskMitigants"  rows="7" cols="100" style="    width: 100%;">{{ isset($keyloanterm->lastRowriskMitigants) ? @$keyloanterm->lastRowriskMitigants : null }}</textarea>
 <div class="center-align" style="margin:0px 25px;"></div>
 <center>{!! Form::label('Recommendation of Analyst ','', ['style' => '  color: red;'])  !!}</center>
 <textarea name="recomndation"  rows="7" cols="100" style="    width: 100%;">{{ isset($keyloanterm->recomndation) ? @$keyloanterm->recomndation : null }}</textarea>
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
<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
<script>
        /*$(document).ready(function() {
          @if(isset($praposalChecklist->creditCell) && @$praposalChecklist->creditCell=='yes')
          document.getElementById('creditCell_yes').checked = true;
          $("#creditCellDescription").show()
          @else
          document.getElementById('creditCell_no').checked = true;
          $("#creditCellDescription").hide()
          @endif
          $('input:radio[name="creditCell"]').change(
            function(){
              if ($(this).val() == 'yes') {
                $("#creditCellDescription").show()
              } else{
                $("#creditCellDescription").hide()
              }
            }
            );
          })*/
        </script>
