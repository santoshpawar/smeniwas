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
<div class="container-fluid">
 <div class="row">
   <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">Check List<span class="pull-right"> {{ $userProfileFirm->name_of_firm }}</span></h4>
     </div>
     <hr>
  
     <div class="card-content">
      <div class="col-md-12">
        <div class="tab-content tab-design">
          <div class="tab-pane active" id="CompanyBackground" style="">
            {!! Form::hidden('id',null) !!}
            <table class="table"  border="solid">
              <thead class="thead-dark">
                <tr>
                  <th>Name</th>
                  <th>Data</th>
                  <th>Name</th>
                  <th>Data</th>
                </tr>
              </thead>
              <tbody>
               <tr>
                <td>
                  {!! Form::label('typeofEntity', 'Type of Entity') !!}
                  {!! Form::label(null,'', ['style' => '  color: red;']) !!}
                </td>
                <td>   
                  @if(isset($businessType))
                  {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], $businessType, ['class' => 'form-control','id'=>'com_business_type','data-mandatory'=>'M' ,$setDisable])!!}
                  @else
                  {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], null, ['class' => 'form-control','id'=>'com_business_type','data-mandatory'=>'M' ,$setDisable])!!}
                  @endif
                </td> 
                <td>   
                  {!! Form::label('businessAddress','Business Address', ['class'=>'form-label']) !!}
                  {!! Form::label(null,'', ['style' => '  color: red;']) !!}
                </td>
                <td>
                 {!! Form::text('business_address',  $userProfileFirm->address, array('class' => 'form-control', 'id'=>'business_address', 'placeholder'=>'', $setDisable)) !!}
               </td>
             </tr>
             <tr>
              <td>
                {!! Form::label('vintage','Vintage of business  (yrs)', ['class'=>'form-label']) !!}
                {!! Form::label(null,'', ['style' => '  color: red;']) !!}
              </td>
              <td>
               {!! Form::select('com_co_business_old', $businessVintage,null,['class' => 'form-control','id'=>'business_old','data-mandatory'=>'M' ,$setDisable]) !!}
             </td>
           </tr>
           <tr>
            <td>
              {!! Form::label('latestTurnover','Latest Turnover', ['class'=>'form-label']) !!} <span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
              {!! Form::label(null,'', ['style' => '  color: red;']) !!}
            </td>
            <td>
             {!! Form::text('lastAuditedTurnover', isset($loanUserProfile->latest_turnover) ? $loanUserProfile->latest_turnover : null, array('class' => 'form-control', 'id'=>'lastAuditedTurnover', 'placeholder'=>'', $setDisable)) !!}
           </td>
           <td>
             {!! Form::label('cibil','CIBIL Score of Promoter', ['class'=>'form-label']) !!}
             {!! Form::label(null,'', ['style' => '  color: red;']) !!}
           </td>
           
           <td>
            {!! Form::text('othr_cibilscore', isset($praposalChecklist->othr_cibilscore) ? $praposalChecklist->othr_cibilscore : null, ['class' => 'form-control amount', 'id' => 'cibilScore','data-mandatory'=>'M',$setDisable]) !!}
          </td>
        </tr>
        <tr>
          <td>
            {!! Form::label('3yearsFinancials','3 year financials available (yes / no)', ['class'=>'form-label']) !!}
          </td>
          <td>
            <label class="radio-inline">
              {!! Form::radio('threeYearsFinancials','yes'  ,@$praposalChecklist->threeYearsFinancials == 'yes' ? 'checked' : '' ,  ['id' => 'threeYearsFinancials_yes']) !!}
              Yes
            </label>
            <label class="radio-inline">
             {!! Form::radio('threeYearsFinancials','no' ,@$praposalChecklist->threeYearsFinancials == 'no' ? 'checked' : '' ,  ['id' => 'threeYearsFinancials_no']) !!}
             No
           </label>
         </td>
         <td>
          {!! Form::label('profitableLast2Years','Profitable in last 2 yrs (yes/no)', ['class'=>'form-label']) !!}
        </td>
        <td>
         <label class="radio-inline">
          {!! Form::radio('profitableLast2Years','yes', @$praposalChecklist->profitableLast2Years == 'yes' ? 'checked' : '',  ['id' => 'profitableLast2Years_yes']) !!}
          Yes
        </label>
        <label class="radio-inline">
          {!! Form::radio('profitableLast2Years','no',@$praposalChecklist->profitableLast2Years == 'no' ? 'checked' : '',  ['id' => 'profitableLast2Years_no']) !!}
          No
        </label>
      </td>
    </tr>
    <tr>
      <td>
       {!! Form::label('ratioBreaches','Any ratios breaching threshold. If yes which one with value and brief reason', ['class'=>'form-label']) !!}
     </td>
     <td>    
      <label class="radio-inline">

       {!! Form::radio('ratioBreaches','yes'  ,@$praposalChecklist->ratioBreaches == 'yes' ? 'checked' : '' ,  ['id' => 'ratioBreaches_yes']) !!}

       Yes
     </label>
     <label class="radio-inline">
       {!! Form::radio('ratioBreaches','no'  ,@$praposalChecklist->ratioBreaches == 'no' ? 'checked' : '' ,  ['id' => 'ratioBreaches_no']) !!}
       No
     </label>
     <div id="anyOtherRatioBreaches">              
      {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
      {!! Form::text('ratioBreachesDescrip', isset($praposalChecklist->ratioBreachesDescrip) ? @$praposalChecklist->ratioBreachesDescrip : null, array('class' => 'form-control', 'id'=>'ratioBreachesDescrip', 'placeholder'=>'', '')) !!}
    </div>
  </td>
  <td>
  </td>
  <td>
  </td>
</tr>
<tr>
  <td>
    {!! Form::label('gst','Promoter KYC done (yes/no)', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
  <td>


    <label class="radio-inline">
      {!! Form::radio('KYC', 'yes', @$praposalChecklist->KYC == 'yes' ? 'checked' : '', ['id' => 'kycy']) !!}
      Yes
    </label>
    <label class="radio-inline">
       
        {!! Form::radio('KYC', 'no', @$praposalChecklist->KYC == 'no' ? 'checked' : '',  ['id' => 'dealy_no']) !!}
      No
    </label>
  </td>
  <td>
    {!! Form::label('customerVisit','Customer Visit done. If yes by whom', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
  <td>
    <label class="radio-inline">
      {!! Form::radio('customerVisit', 'yes',@$praposalChecklist->customerVisit == 'yes' ? 'checked' : '' , ['id' => 'customerVisit_yes','data-mandatory'=>'M']) !!}
      Yes
    </label>
    <label class="radio-inline">
      {!! Form::radio('customerVisit', 'no', @$praposalChecklist->customerVisit == 'no' ? 'checked' : '', ['id' => 'customerVisit_no','data-mandatory'=>'M']) !!}
      No
    </label>
    <div id="customerVisitDescription">              
      {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
      {!! Form::text('customerVisitDescription', isset($praposalChecklist->customerVisitDescription) ? @$praposalChecklist->customerVisitDescription : null, array('class' => 'form-control', 'id'=>'custVisitByWhom', 'placeholder'=>'', '')) !!}
    </div>
  </td>

</tr>
<tr>
  <td>
    {!! Form::label('creditCell','Credit Call Completed. If yes by whom', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
  <td>
    <label class="radio-inline">
      {!! Form::radio('creditCell','yes', @$praposalChecklist->creditCell == 'yes' ? 'checked' : '' , ['id' => 'creditCell_yes','data-mandatory'=>'M']) !!}
     
      Yes
    </label>
    <label class="radio-inline">
      {!! Form::radio('creditCell', 'no',@$praposalChecklist->creditCell == 'no' ? 'checked' : '', ['id' => 'creditCell_no','data-mandatory'=>'M']) !!}
      No
    </label>
    <div id="creditCellDescription">              
      {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
      {!! Form::text('creditCellDescription', isset($praposalChecklist->creditCellDescription) ? @$praposalChecklist->creditCellDescription : null, array('class' => 'form-control', 'id'=>'creditCell', 'placeholder'=>'', '')) !!}
    </div>
  </td>
  <td>
    {!! Form::label('refrenceCheck','Reference check done. If yes by whom', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
  <td>
   <label class="radio-inline">
    {!! Form::radio('refrenceCheck','yes', @$praposalChecklist->refrenceCheck == 'yes' ? 'checked' : '' , ['id' => 'refrenceCheck_yes','data-mandatory'=>'M']) !!}
    Yes
  </label>
  <label class="radio-inline">
    {!! Form::radio('refrenceCheck','no', @$praposalChecklist->refrenceCheck == 'no' ? 'checked' : '', ['id' => 'refrenceCheck_no','data-mandatory'=>'M']) !!}
    No
  </label>
  <div id="refreanceCheckDescription">        
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
    {!! Form::text('refreanceCheckDescription', isset($praposalChecklist->refreanceCheckDescription) ? @$praposalChecklist->refreanceCheckDescription : null, array('class' => 'form-control', 'id'=>'refrenceCheck', 'placeholder'=>'', '')) !!}
  </div>
</td>
</tr>
<tr>
  <td>
    {!! Form::label('bankStatment','Bank statements available (yes/no).If yes indicate no of cheque bounces in 12 months', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
  <td>
   <label class="radio-inline">
    {!! Form::radio('bankStatment',  'yes',@$praposalChecklist->bankStatment == 'yes' ? 'checked' : '' , ['id' => 'bankStatment_yes','data-mandatory'=>'M']) !!}
    Yes
  </label>
  <label class="radio-inline">
    {!! Form::radio('bankStatment', 'no',@$praposalChecklist->bankStatment == 'no' ? 'checked' : '', ['id' => 'bankStatment_no','data-mandatory'=>'M']) !!}
    No
  </label>
  <div id="bankStatmentDescrip">              
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
    {!! Form::text('bankStatmentDescrip',isset($praposalChecklist->bankStatmentDescrip) ? @$praposalChecklist->bankStatmentDescrip : null, array('class' => 'form-control', 'id'=>'bankStatment', 'placeholder'=>'', '')) !!}
  </div>
</td>
<td>
 {!! Form::label('latestTotalBorrowing','Latest  Total  Borrowings of Firm', ['class'=>'form-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
 {!! Form::label(null,'', ['style' => '  color: red;']) !!}
</td>
<td>
  {!! Form::text('latestTotalBorrowing', isset($praposalChecklist->latestTotalBorrowing) ? @$praposalChecklist->latestTotalBorrowing : null, array('class' => 'form-control', 'id'=>'latestTotalBorrowing', 'placeholder'=>'', '')) !!}
</td>
</tr>
<tr>
  <td>     
   {!! Form::label('anyDefaultLenders','Any delay / default with other lenders.', ['class'=>'form-label']) !!}
   {!! Form::label(null,'', ['style' => '  color: red;']) !!}
 </td>
 <td> 
   {!! Form::text('anyDefaultLenders', isset($praposalChecklist->anyDefaultLenders) ? @$praposalChecklist->anyDefaultLenders : null, array('class' => 'form-control', 'id'=>'anyDefaultLenders', 'placeholder'=>'', '')) !!}
 </td>
 <td>
   {!! Form::label('securityProvided','Security being provided', ['class'=>'form-label']) !!}
   {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
 </td>
 <td>
   <label class="radio-inline">
    {!! Form::radio('securityProvided', 'yes',@$praposalChecklist->securityProvided == 'yes' ? 'checked' : '' , ['id' => 'securityProvided_yes','data-mandatory'=>'M']) !!}
    Yes
  </label>
  <label class="radio-inline">
    {!! Form::radio('securityProvided','no', @$praposalChecklist->securityProvided == 'yes' ? 'checked' : '', ['id' => 'securityProvided_no','data-mandatory'=>'M']) !!}
    No
  </label>
  <div id="securityProvidedDescrip">              
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
    {!! Form::text('securityProvidedDescrip',  isset($praposalChecklist->securityProvidedDescrip) ? @$praposalChecklist->securityProvidedDescrip : null, array('class' => 'form-control', 'id'=>'securityProvided', 'placeholder'=>'', '')) !!}
  </div>
</td>
</tr>
<tr>
  <td>
    {!! Form::label('liquidityModel','Has Liquidity Model been completed. If yes provide score', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
  <td>
    <label class="radio-inline">
      {!! Form::radio('liquidityModel','yes', @$praposalChecklist->liquidityModel == 'yes' ? 'checked' : '' , ['id' => 'liquidityModel_yes','data-mandatory'=>'M']) !!}
      Yes
    </label>
    <label class="radio-inline">
      {!! Form::radio('liquidityModel', 'no',@$praposalChecklist->liquidityModel == 'yes' ? 'checked' : '', ['id' => 'liquidityModel_no','data-mandatory'=>'M']) !!}
      No
    </label>
    <div id="liquidityModelDescrip">              
      {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
      {!! Form::text('liquidityModelDescrip', isset($praposalChecklist->liquidityModelDescrip) ? @$praposalChecklist->liquidityModelDescrip : null, array('class' => 'form-control', 'id'=>'liquidityModel', 'placeholder'=>'', '')) !!}
    </div>
  </td>
  <td>
 
    {!! Form::label('latestDEratio','Latest audited D:E ratio', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
  <td>
   {!! Form::text('latestDEratio', isset($praposalChecklist->latestDEratio) ? @$praposalChecklist->latestDEratio : null, array('class' => 'form-control', 'id'=>'latestDEratio', 'placeholder'=>'', '')) !!}
 </td>
 
</tr>
<tr>
  <td>
    {!! Form::label('daviationLoanMatrix','Any deviations in Loan Matrix. If yes mention deviation', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
  </td>
<td colspan="4">
   <label class="radio-inline">
      {!! Form::radio('daviationLoanMatrix', 'yes',@$praposalChecklist->daviationLoanMatrix == 'yes' ? 'checked' : '', ['id' => 'daviationLoanMatrix_yes','data-mandatory'=>'M']) !!}
      Yes
    </label>
    <label class="radio-inline">
      {!! Form::radio('daviationLoanMatrix','no',@$praposalChecklist->daviationLoanMatrix == 'yes' ? 'checked' : '', ['id' => 'daviationLoanMatrix_no','data-mandatory'=>'M']) !!}
      No
    </label>
    <div id="daviationLoanMatrixDescrip">              
      {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
      {!! Form::textarea('daviationLoanMatrixDescrip', isset($praposalChecklist->daviationLoanMatrixDescrip) ? @$praposalChecklist->daviationLoanMatrixDescrip : null, array('class' => 'form-control', 'rows' => 3, 'cols' => 40,'id'=>'daviationLoanMatrix', 'placeholder'=>'', '')) !!}
    </div>
</td>
 
</tr>
<tr>
  <td>
    {!! Form::label('companyKYC','Company KYC done (yes/no)', ['class'=>'form-label']) !!}
    {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
    <br>
  </td>
  <td>
    <label class="radio-inline">
      {!! Form::radio('companyKYC','yes', @$praposalChecklist->companyKYC == 'yes' ? 'checked' : '', ['id' => 'companycompanyKYC1']) !!}
      Yes
    </label>
    <label class="radio-inline">
      {!! Form::radio('companyKYC', 'no', @$praposalChecklist->companyKYC == 'no' ? 'checked' : '', ['id' => 'companycompanyKYC2']) !!}
      No
    </label>
  </td>
  <td> </td>
  <td> </td>
</tr>
{{-- <tr>
  <td colspan="4">
    <center>{!! Form::label('Recommendation of Analyst ','', ['style' => '  color: red;'])  !!}</center>
    <textarea name="recomndation"  rows="7" cols="100" style="    width: 100%;">{{ isset($praposalChecklist->recomndation) ? @$praposalChecklist->recomndation : null }}</textarea>
  </td>
</tr> --}}
</tbody>
</table>
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

    @if(isset($praposalChecklist->ratioBreaches) && @$praposalChecklist->ratioBreaches=='yes')
    document.getElementById('ratioBreaches_yes').checked = true;
    $("#anyOtherRatioBreaches").show()
    @else
    document.getElementById('ratioBreaches_no').checked = true;
    $("#anyOtherRatioBreaches").hide()
    @endif
    $('input:radio[name="ratioBreaches"]').change(
      function(){
        if ($(this).val() == 'yes') {
          $("#anyOtherRatioBreaches").show()
        } else{
         $('#ratioBreachesDescrip').val("");
         $("#anyOtherRatioBreaches").hide()
       }
     }
     ); 


    @if(isset($praposalChecklist->customerVisit) && @$praposalChecklist->customerVisit=='yes')
    document.getElementById('customerVisit_yes').checked = true;
    $("#customerVisitDescription").show()
    @else
    document.getElementById('customerVisit_no').checked = true;
    $("#customerVisitDescription").hide()
    @endif
    $('input:radio[name="customerVisit"]').change(
      function(){
        if ($(this).val() == 'yes') {
          $("#customerVisitDescription").show()
        } else{
          $("#customerVisitDescription").hide()
        }
      }
      ); 

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

       @if(isset($praposalChecklist->refrenceCheck) && @$praposalChecklist->refrenceCheck=='yes')
    document.getElementById('refrenceCheck_yes').checked = true;
    $("#refreanceCheckDescription").show()
    @else
    document.getElementById('refrenceCheck_no').checked = true;
    $("#refreanceCheckDescription").hide()
    @endif
    $('input:radio[name="refrenceCheck"]').change(
      function(){
        if ($(this).val() == 'yes') {
          $("#refreanceCheckDescription").show()
        } else{
          $("#refreanceCheckDescription").hide()
        }
      }
      ); 

    
    @if(isset($praposalChecklist->bankStatment) && @$praposalChecklist->bankStatment=='yes')
    document.getElementById('bankStatment_yes').checked = true;
    $("#bankStatmentDescrip").show()
    @else
    document.getElementById('bankStatment_no').checked = true;
    $("#bankStatmentDescrip").hide()
    @endif
    $('input:radio[name="bankStatment"]').change(
      function(){
        if ($('#bankStatment_yes').val() == 'yes') {
          $("#bankStatmentDescrip").show()
        } else{
          $("#bankStatmentDescrip").hide()
        }
      }
      );


    @if(isset($praposalChecklist->securityProvided) && @$praposalChecklist->securityProvided=='yes')
    document.getElementById('securityProvided_yes').checked = true;
    $("#securityProvidedDescrip").show()
    @else
    document.getElementById('securityProvided_no').checked = true;
    $("#securityProvidedDescrip").hide()
    @endif
    $('input:radio[name="securityProvided"]').change(
      function(){
        if ($(this).val() == 'yes') {
          $("#securityProvidedDescrip").show()
        } else{
          $("#securityProvidedDescrip").hide()
        }
      }
      );
     @if(isset($praposalChecklist->liquidityModel) && @$praposalChecklist->liquidityModel=='yes')
    document.getElementById('liquidityModel_yes').checked = true;
    $("#liquidityModelDescrip").show()
    @else
    document.getElementById('liquidityModel_no').checked = true;
    $("#liquidityModelDescrip").hide()
    @endif
    $('input:radio[name="liquidityModel"]').change(
      function(){
        if ($(this).val() == 'yes') {
          $("#liquidityModelDescrip").show()
        } else{
          $("#liquidityModelDescrip").hide()
        }
      }
      );
 @if(isset($praposalChecklist->daviationLoanMatrix) && @$praposalChecklist->daviationLoanMatrix=='yes')
    document.getElementById('daviationLoanMatrix_yes').checked = true;
    $("#daviationLoanMatrixDescrip").show()
    @else
    document.getElementById('daviationLoanMatrix_no').checked = true;
    $("#daviationLoanMatrixDescrip").hide()
    @endif
    $('input:radio[name="daviationLoanMatrix"]').change(
      function(){
        if ($(this).val() == 'yes') {
          $("#daviationLoanMatrixDescrip").show()
        } else{
          $("#daviationLoanMatrixDescrip").hide()
        }
      }
      );
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
  })

 
</script>
