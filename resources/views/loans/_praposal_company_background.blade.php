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
}
.form-control{
  /*  height: 9px !important;*/
}
.form-group .form-control {
  margin-bottom: 4px !important
  ;
}
.form-horizontal .form-group {
  margin-right: 175px;
  margin-left: -6px;
}
.table > tbody > tr > td{
  padding: 3px 0px 0px 11px !important;
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
       <h4 class="title">Background <span class="pull-right"> {{ $userProfileFirm->name_of_firm }}</span></h4>
     </div>
     <div class="card-content">
      <div class="col-md-12">
        <div class="tab-content tab-design">
          <div class="tab-pane active" id="CompanyBackground" style="">
            {!! Form::hidden('id',null) !!}
            <div class="row" id="divTab_sub1" >
              <table class="table"  border="solid">
                <thead class="thead-dark">
                </thead>
                <tbody>
                 <tr>
                  <td>      {!! Form::label('borrower_name','Name of Borrower', ['class'=>'form-label']) !!}</td>
                  <td>     {!! Form::text('borrower_name', $userProfileFirm->name_of_firm , array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'', $setDisable)) !!}</td>
                </tr>
                <tr>
                  <td>      {!! Form::label('promoter_name','Name of Promoter', ['class'=>'form-label']) !!}</td>
                  <td>     {!! Form::text('promoter_name',$existingPromoterKycDetails[0]->kyc_name, array('class' => 'form-control', 'id'=>'promoter_name', 'placeholder'=>'', $setDisable)) !!}</td>
                </tr>
                <tr>
                  <td>      {!! Form::label('praposal_source','Source of Proposal', ['class'=>'form-label']) !!}</td>
                  <td>     
                   @if(isset($praposalBackground->praposal_source))
                   {!! Form::select('praposal_source', [''=>'Source of Proposal','niwasPortal'=>'Niwas Portal', 'DSA'=>'DSA', 'niwasSalesTeam'=>'Niwas Sales Team', 'refBy'=>'Ref by ','Others'=>'Others'], $praposalBackground->praposal_source, ['class' => 'form-control','id'=>'praposal_source','data-mandatory'=>'M' ,$setDisable])!!}
                   @else
                   {!! Form::select('praposal_source', [''=>'Source of Proposal','niwasPortal'=>'Niwas Portal', 'DSA'=>'DSA', 'niwasSalesTeam'=>'Niwas Sales Team', 'refBy'=>'Ref by ','Others'=>'Others'], null, ['class' => 'form-control','id'=>'praposal_source','data-mandatory'=>'M' ,$setDisable])!!}
                   @endif
                   <div id="customerVisitDescription">              
                    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
                    {!! Form::text('praposalSourceOthers', @$praposalBackground->praposalSourceOthers, array('class' => 'form-control', 'id'=>'praposalSourceOthers', 'placeholder'=>'', '')) !!}
                  </div>
                </td>
              </tr>
              <tr>
                <td>      {!! Form::label('legal_entity_type','Type of Legal Entity', ['class'=>'form-label']) !!}</td>
                <td>     
                 @if(isset($mobileEntityType))
                 {!! Form::select('legal_entity_type', @$entityTypes, @$mobileEntityType, ['id' => 'legal_entity_type','class' => 'form-control', 'style' => ' width: 260px;','data-mandatory'=>'M']) !!}
                 @else
                 {!! Form::select('legal_entity_type', @$entityTypes, @$chosenEntity, ['id' => 'legal_entity_type','class' => 'form-control', 'style' => ' width: 260px;','data-mandatory'=>'M']) !!}
                 @endif
               </td>
             </tr>
             <tr>
              <td>  {!! Form::label('sector','Sector (Manufacturing/Services)', ['class'=>'form-label']) !!}</td>
              <td> 
               {!! Form::select('com_industry_segment', $industryTypes, null, ['class' => 'form-control', 'id' => 'industry_segment','data-mandatory'=>'M' ,$setDisable])!!}
             </td>
           </tr>
           <tr>
            <td> {!! Form::label('gst','Customers (B2B, B2C)', ['class'=>'form-label']) !!}</td>
            <td>
             @if(isset($businessType))
             {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], $businessType, ['class' => 'form-control','id'=>'com_business_type','data-mandatory'=>'M' ,$setDisable])!!}
             @else
             {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], null, ['class' => 'form-control','id'=>'com_business_type','data-mandatory'=>'M' ,$setDisable])!!}
             @endif
           </td>
         </tr>
         <tr>
          <td>       {!! Form::label('gst','Business Address', ['class'=>'form-label']) !!}</td>
          <td>   {!! Form::text('business_address', $userProfileFirm->address, array('class' => 'form-control', 'id'=>'business_address', 'placeholder'=>'', $setDisable)) !!}</td>
        </tr> 
        <tr>
          <td>  {!! Form::label('gst','Niwas Branch and dealing officer', ['class'=>'form-label']) !!}</td>
          <td>  {!! Form::text('niwas_branch_officer', @$praposalBackground->niwas_branch_officer, array('class' => 'form-control', 'id'=>'niwas_branch_officer', 'placeholder'=>'', $setDisable)) !!}</td>
        </tr>
        <tr>
          <td>  {!! Form::label('Security','Security', ['class'=>'form-label']) !!}</td>
          <td>{!! Form::text('security', @$praposalBackground->security, array('class' => 'form-control', 'data-mandatory'=>'M','id'=>'security', 'placeholder'=>'', $setDisable)) !!}
          </tr>
          <tr>

  <td> {!! Form::label('Purpose of Loan','Purpose of Loan', ['class'=>'form-label']) !!}</td>

  <td>{!! Form::textarea('loan_purpose',@$praposalBackground->loan_purpose,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}</td>
</tr>

        </tbody>
      </table>

    </div>
  </div>
  <div class="card">


  </div>
  <table>

    <tbody>
      <tr>
        <th scope="row" colspan="3" >Exposure Details  </th>
      </tr>
      
      <tr>
        <td scope="row" colspan="3" >Does borrower have existing Loan  (Yes No)
         <label class="radio-inline"> 
          {!! Form::radio('existingLoan','yes'  , @$praposalBackground->existingLoan == 'yes' ? 'checked' : '' ,  ['id' => 'existingLoan_yes','data-mandatory'=>'M']) !!}
          Yes
        </label>
        <label class="radio-inline">
          {!! Form::radio('existingLoan', 'no', @$praposalBackground->existingLoan == 'no' ? 'checked' : '',  ['id' => 'existingLoan_no','data-mandatory'=>'M']) !!}
          No 
        </td>
      </tr>

    </tbody>
  </table>
</div>
</div>
<div class="card">


</div>


<div id="borrowerExistingLoan">
  <table class="table"  border="solid">
    <thead class="thead-dark">
    </thead>
    <tbody>
      <tr>
        <td>    {!! Form::label('Loan Amount','Loan Amount', ['class'=>'form-label']) !!}</td>
        <td colspan="3">
         <span style="margin-right: 69px;">Existing Amount</span> <span style="margin-right: 69px;">Proposed Amount</span> <span style="margin-right: 62px;">Total Amount</span> <br>
         {!! Form::text('amount',  @$praposalBackground->amount, array( 'id'=>'amount', 'placeholder'=>'Existing', $setDisable)) !!} 
         {!! Form::text('praposedAmount',  @$praposalBackground->praposedAmount , array( 'id'=>'praposedAmount', 'placeholder'=>'Proposed', $setDisable)) !!}
         {!! Form::text('finalAmount',  @$praposalBackground->finalAmount , array( 'id'=>'finalAmount', 'placeholder'=>'Total', $setDisable)) !!}</td>
       </tr>
       
       <tr>
        <td>   {!! Form::label('Tenor','Tenor', ['class'=>'form-label']) !!}</td>
        <td colspan="3">
         <span style="margin-right: 69px;">Existing Tenor</span> <span style="margin-right: 69px;">Proposed Tenor</span> <br>
         {!! Form::text('existingTenor', @$praposalBackground->existingTenor, array('id'=>'existingTenor', 'placeholder'=>'Existing', $setDisable)) !!}
         {!! Form::text('praposedTenor',  @$praposalBackground->praposedTenor, array( 'id'=>'praposedTenor', 'placeholder'=>'Proposed', $setDisable)) !!}
         {!! Form::hidden('totalTenor',  @$praposalBackground->totalTenor, array( 'id'=>'totalTenor', 'placeholder'=>'Total', $setDisable)) !!}</td>
       </td>
     </tr>
     <tr>
      <td>  {!! Form::label('Interest Rate','Interest Rate', ['class'=>'form-label']) !!}</td>
      <td colspan="3">
        <span style="margin-right: 75px;">Existing Rate</span> <span style="margin-left: 10px;">Praposed Rate</span><br>
        {!! Form::text('existingInterestRate', @$praposalBackground->existingInterestRate , array('id'=>'existingInterestRate', 'placeholder'=>'Existing', $setDisable)) !!}
        {!! Form::text('praposedInterestRate', @$praposalBackground->praposedInterestRate , array( 'id'=>'praposedInterestRate', 'placeholder'=>'Proposed', $setDisable)) !!}
        {!! Form::hidden('totalInterestRate',  @$praposalBackground->totalInterestRate , array( 'id'=>'totalInterestRate', 'placeholder'=>'Total', $setDisable)) !!}</td>
      </td>
    </tr>  
    <tr>
      <td>  {!! Form::label('Any delays in servicing in last 6 mths','Any delays in servicing in last 6 mths', ['class'=>'form-label']) !!}</td>
      <td>
        <label class="radio-inline">
          {!! Form::radio('dealy','1'  ,@$praposalBackground->dealy == '1' ? 'checked' : '' ,  ['id' => 'dealy_yes']) !!}
          Yes
        </label>
        <label class="radio-inline">
          {!! Form::radio('dealy', '0', @$praposalBackground->dealy == '0' ? 'checked' : 'checked',  ['id' => 'dealy_no']) !!}
          No 
        </td>
      </tr> 
      <tr>
        <td> {!! Form::label('Date of  disbursement','Date of  disbursement', ['class'=>'form-label']) !!}</td>
        <td>{!! Form::text('disbursement_date',@$praposalBackground->disbursement_date, array('class' => 'form-control', 'id'=>'date', 'placeholder'=>'', $setDisable)) !!}</td>
      </tr>
    </tbody>
  </table>
</div>
</div>
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

<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
<style type="text/css" media="screen">
table.ui-datepicker-calendar{
  /*display: none !important;*/
}
</style>
<script>
  $(document).ready(function() {
    $('#amount, #praposedAmount').change(function(){
      var a =parseInt($('#amount').val()) || 0;
      var b=parseInt($('#praposedAmount').val()) || 0;
      $('#finalAmount').val(a+b); 
    })
    $('#existingTenor, #praposedTenor').change(function(){
      var a =parseInt($('#existingTenor').val()) || 0;
      var b=parseInt($('#praposedTenor').val()) || 0;
      $('#totalTenor').val(a+b); 
    })  
    $('#existingInterestRate, #praposedInterestRate').change(function(){
      var a =parseInt($('#existingInterestRate').val()) || 0;
      var b=parseInt($('#praposedInterestRate').val()) || 0;
      $('#totalInterestRate').val(a+b); 
    })
  });


  @if(isset($praposalBackground->existingLoan) && @$praposalBackground->existingLoan =='yes')
  document.getElementById('existingLoan_yes').checked = true;
  $("#borrowerExistingLoan").show()
  @else
  document.getElementById('existingLoan_no').checked = true;
  $("#borrowerExistingLoan").hide()
  @endif
  $('input:radio[name="existingLoan"]').change(
    function(){
      if ($(this).val() == 'yes') {

      $("#borrowerExistingLoan").show()
    } else{
    
      $("#borrowerExistingLoan").hide()
      $("#amount").val('');
      $("#praposedAmount").val('');
      $("#finalAmount").val('');
      $("#existingTenor").val('');
      $("#praposedTenor").val('');
      $("#totalTenor").val('');
      $("#existingInterestRate").val('');
      $("#praposedInterestRate").val('');
      $("#existingInterestRate").val('');
      $("#totalInterestRate").val('');
      $("#date").val('');
      $("#dealy_no input[type='radio']:checked").val();

    }
  }
  );


  $('#customerVisitDescription').hide();
  $('#praposal_source').change(function(){
    if(($(this).val() == 'Others')){
      $('#customerVisitDescription').show();
    }else{
     $('#customerVisitDescription').hide();
   }
 });




  jQuery(document).ready(function ($) {
    $('#date').datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      dateFormat: 'yy-mm-dd',
      yearRange: '2017:2018',
      monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
      monthNamesShort: ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"],
      onClose: function(dateText, inst) {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(year, month, 1));
      },
    })
  });
</script>
