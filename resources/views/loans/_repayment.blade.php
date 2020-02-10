<p>asjhsajh</p>

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
/*.main-panel{
  width: 100% !important;
}
.sidebar{
  display: none;
  }*/
</style>
<?php
/*echo "<pre>";
print_r($praposalChecklist);
echo "</pre>"*/;
?>
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
       <h4 class="title">Repayment Schedule<span class="pull-right"> {{ $userProfileFirm->name_of_firm }}</span></h4>
     </div>
     <hr>
     <div class="card-content">
      <div class="col-md-12">
        <div class="tab-content tab-design">
          <div class="tab-pane active" id="CompanyBackground" style="">
            <div class="row" id="divTab_sub1" >
              <div class="tab-pane active" id="" style="padding-left: 20px;padding-right: 20px;">
                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group">
                      <div id="topcust" class="panel panel-success">
                        <div class="panel-heading">Details</div>
                        <div class="panel-body">
                         <div class="row">
                           <div class="col-md-6">
                            <div class="form-group required">
                              {!! Form::label('cust_name','Name', ['class'=>'col-md-2 control-label']) !!}
                              <div class="col-md-12">
                                {!! Form::text('borrower_name', $userProfileFirm->name_of_firm , array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'')) !!}
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12 col-lg-6">
                           {!! Form::label(null,'Type Of Loan') !!}
                           {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                           {{--  {!! Form::select('loan_product',$loan_product, $chosenLoanProduct, ['id' => 'loan_product', 'class' => 'form-control', 'style' => 'width:100%']) !!} --}}
                           {!! Form::select('TypeofLoan', array('' => '','CC' =>
                            'Secured Short Term WC/CC/OD/ Loan', 'STL' => 'Secured Term Loan', 'LAP' => 'Loan Against Property','UBL' => 'Unsecured Business Loan','EFL' => 'Equipment Finance','VF' => 'Vendor Finance/Bill Discounting/Receivable Finance','CSCF' =>'Corporate Supply Chain Finance','LAS' => 'Loan Against Share'), $praposalChecklist['TypeofLoan'],
                            ['id' => 'TypeofLoan', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'']) !!}
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group required">
                             {!! Form::label('cust_address','Address', ['class'=>'col-md-2 control-label']) !!}
                             <div class="col-md-12">
                              {!! Form::text('cust_address', isset($userProfileFirm->address) ? @$userProfileFirm->address : null, array('class' => 'form-control', 'id'=>'cust_address', 'placeholder'=>'', '')) !!}
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                          {!! Form::label(null,'Type Of Repayment') !!}
                          {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                          {!! Form::select('TypeofRepayment', array('' => '','fixed principal installment' => 'fixed principal installment','EMI' => 'EMI'), $praposalChecklist['TypeofRepayment'],
                          ['id' => 'TypeofRepayment', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'']) !!}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                         {!! Form::label('email','Email Id', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                         <div class="col-md-12">
                          <div class="col-md-6" style="padding-left: 0px;width: 50%;">
                            {!! Form::text('email', isset($user->email) ? @$user->email : null, array('class' => 'form-control', 'id'=>'email', 'placeholder'=>'Email Id 1' )) !!}
                          </div>
                          <div class="col-md-6" style="padding-right: 10px;width: 50%;">
                            {!! Form::text('email2', isset($user->email2) ? @$user->email2 : null, array('class' => 'form-control', 'id'=>'email2', 'placeholder'=>'Email Id 2', '')) !!}
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                       <div class="form-group required">
                        {!! Form::label('cust_number','Contact Number', ['class'=>'col-md-2 control-label']) !!}
                        <div class="col-md-12">
                         <div class="col-md-12">
                           {!! Form::text('cust_number', isset($userProfileFirm->contact1) ? @$userProfileFirm->contact1 : null, array('class' => 'form-control', 'id'=>'cust_number', 'maxlength' => 10,'placeholder'=>'Customer Number', '')) !!}
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           {{-- Loan Repayment --}}
           <div class="row">
            <div class="col-md-12">
              <div id="" class="form-group">
                <div id="topcust" class="panel panel-success">
                  <div class="panel-heading">Loan Repayment</div>
                  <div class="panel-body">
                    <div class="row" style="padding:5px;">
                      <div class="col-md-4" >
                        {!! Form::label('loanamt','Loan Amount Sanctioned ' , ['class'=>'form-label']) !!}<span>&nbsp;( <span class="fa fa-inr">&nbsp; </span>)</span>
                        {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                        {!! Form::text('principal', isset($repaymentMaster->principal) ? @$repaymentMaster->principal : null, array('class' => 'form-control', 'id'=>'p', 'onchange' => 'computeLoan()' , 'min(1)' , 'max(10000000000)' )) !!} 
                        {{--  <p>Loan Amount: $<input id="p" type="number" min="1" max="1000000" onchange="computeLoan()"></p> --}}
                      </div>
                      <div class="col-md-4" >
                       {!! Form::label('rateInterest','Interest Rate', ['class'=>'form-label']) !!} <span>&nbsp;( % p.a. )</span>
                       {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                       {!! Form::text('interest',isset($repaymentMaster->interest) ? @$repaymentMaster->interest : null, array('class' => 'form-control', 'id'=>'r', 'min(0)' , 'max(100)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => '%' )) !!}
                       {{--  <p>Interest Rate: <input id="r" type="number" min="0" max="100" value="1" step="1" onchange="computeLoan()">%</p> --}}
                     </div>
                {{--  <div class="col-md-4" >
                    {!! Form::label('noOfDays','No of Days', ['class'=>'form-label']) !!}
                    {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                    {!! Form::text('n',isset($repaymentMaster->n) ? @$repaymentMaster->n : null,array('class' => 'form-control', 'id'=>'n', 'min(1)' , 'max(30)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => 'No. of Days')) !!}
                   <p>No of Days: <input id="n" type="number" min="1" max="30" value="1" step="1" onchange="computeLoan()"></p> 
                 </div> --}}
                 <div class="col-md-4" >
                   {!! Form::label('tenor','Tenor', ['class'=>'form-label']) !!}<span>&nbsp;(Months)</span>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('tenor',isset($repaymentMaster->tenor) ? @$repaymentMaster->tenor : null, array('class' => 'form-control', 'id'=>'t', 'min(1)' , 'max(72)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => 'No. of Tenor' )) !!}
                   {{--     <p>Tenor: <input id="t" type="number" min="1" max="72" value="1" step="1" onchange="computeLoan()"></p> --}}
                 </div>
                 <div class="col-md-4" >
                   {!! Form::label('Moratorium','Moratorium', ['class'=>'form-label']) !!}<span>&nbsp;(Months)</span>
                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('moratorium',isset($repaymentMaster->moratorium) ? @$repaymentMaster->moratorium : null, array('class' => 'form-control', 'id'=>'moratorium','onchange' => 'computeLoan()')) !!}
                 </div>
                 <div class="col-md-4" >
                   {!! Form::label('loanDisDate','Loan Disbursement Date', ['class'=>'form-label']) !!}
                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('loanDisDate',isset($repaymentMaster->loanDisDate) ? @$repaymentMaster->loanDisDate : null, array('class' => 'form-control', 'id'=>'loanDisDate', 'onchange' => 'computeLoan()')) !!}
                 </div>
                 <div class="col-md-4" > {{-- If Disbmnt Date is less than 20th each month EMI Start date is same month of end date --}}
                   {!! Form::label('Emi Start Date','EMI Start Date', ['class'=>'form-label']) !!}
                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('emiStartDate',isset($repaymentMaster->emiStartDate) ? @$repaymentMaster->emiStartDate : null, array('class' => 'form-control', 'id'=>'emiStartDate', 'onchange' => 'computeLoan()')) !!}
                 </div> 
                 <div class="col-md-4" > {{-- If Disbmnt Date is less than 20th each month EMI Start date is same month of end date --}}
                   {!! Form::label('Penal Rate','Penal Rate', ['class'=>'form-label']) !!}<span>&nbsp;( % p.a. )</span>
                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('penalRate',isset($repaymentMaster->penalRate) ? @$repaymentMaster->penalRate : null, array('class' => 'form-control', 'id'=>'emiStartDate', 'onchange' => 'computeLoan()')) !!}
                 </div>

                 <div class="card">
                 </div>
                 @if(!isset($repaymentMaster))
                 <div class="col-md-12" style="margin-left:20px;">
                  <div id="currentSection">
                    <button type="submit" class="btn btn-alert btn-cons sme_button" value="Save" id="saveDetails" >Submit Repayment Details</button>

                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Add Entries --}}
    <div class="row">
      <div class="col-md-12">
        <div id="" class="form-group">
          <div id="topcust" class="panel panel-success">
            <div class="panel-heading">Add Monthly Entries</div>
            <div class="panel-body">
             <div class="row">
              <div class="col-md-6">
                <div class="form-group required">
                  {!! Form::label('dateEntries','Payment Date', ['class'=>'control-label']) !!}
                  {!! Form::text('date','', array('class' => 'form-control', 'id'=>'dateEntries', 'onchange' => '')) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group required">
                  {!! Form::label(null,'Cheque No/UTR No') !!}
                  {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                  {!! Form::text('chequeNo','', array('class' => 'form-control', 'id'=>'dateEntries', 'onchange' => '')) !!}

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group required">
                  {!! Form::label(null,'Receipt / Amount') !!}
                  {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                  {!! Form::text('receipt','', array('class' => 'form-control', 'id'=>'noOfDays', 'onchange' => '')) !!}
                </div>
              </div>
              <div class="col-md-6" > {{-- If Disbmnt Date is less than 20th each month EMI Start date is same month of end date --}}
               {!! Form::label('TDS','TDS', ['class'=>'form-label']) !!}<span>&nbsp;( % )</span>
               {!! Form::label(null,null, ['style' => '  color: red;']) !!}
               {!! Form::text('tds',isset($repaymentMaster->tds) ? @$repaymentMaster->tds : null, array('class' => 'form-control', 'id'=>'emiStartDate', 'onchange' => 'computeLoan()')) !!}
             </div> 


             <div class="col-md-12" style="margin-left:20px;">
              <div id="currentSection">
                <button type="submit" class="btn btn-alert btn-cons sme_button" value="Save" id="saveDetails" >Save Monthly Data</button>

              </div>
            </div>


          </div> 
        </div>
      </div>
    </div>
  </div>
  <?php 
/*foreach ($repaymentDetails as $value) {
echo "<pre>";
print_r($value->date);
echo "</pre>";
}
 */

?>
<div class="row">
  <div class="col-md-12" style="margin-left:20px;">
    <body>
     <table id="repaymentSceduleTable"  style="width:100%">
      <thead>    
       <tr>
        <th>Date</th>
        <th>Nos of days</th>
        <th>Cheque No/UTR No</th>
        <th>Loan Outstanding</th>
        <th>Interest Due</th>
        <th>Principal Due</th>
        <th>TDS</th>
        <th>Net Interest</th>                   
        <th>Net Amount Due</th>                   
        <th>Total Due</th>                   
        <th>Receipt</th>                   
        <th>Arrears</th>                   
        <th>Penal Interest </th>                   
        <th>Cumulative Interest earned</th>                   
      </tr>
    </thead>
    <tbody>

      @foreach($repaymentDetails as $value)
      <tr>
        <td>  {{ $value->date }}        </td>
        <td>  {{ $value->noOfDays }}        </td>
        <td>  {{ $value->chequeNo }}        </td>
        <td>  {{ $value->loanOutstanding }}        </td>
        <td>  {{ $value->intersetDue }}        </td>
        <td>  {{ $value->principalDue }}        </td>
        <td>  {{ $value->tds }}        </td>
        <td>  {{ $value->netInterest }}        </td>
        <td>  {{ $value->netAmountDue }}        </td>
        <td>  {{ $value->totalDue }}        </td>
        <td>  {{ $value->receipt }}        </td>
        <td>  {{ $value->arrears }}        </td>
        <td>  {{ $value->penalInterest }}        </td>
        <td>  {{ $value->cumIntEarned }}        </td>


      </tr>
      
      @endforeach

    </tbody>
  </table>
</body>
</div>
</div>
<br>
<div class="row">
 <div class="col-md-12" style="margin-left:20px;">
  {{--{!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}--}}
  <div id="currentSection">
    {!! Form::button('Proceed to Submission<i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
    {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
  </div>
</div>
</div>
</div>
</div>
{{-- <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  {{--       <meta name="viewport" content="width=device-width">
  <script src="https://code.jquery.com/jquery.min.js"></script> --}}
{{--         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
--}}
{{--       <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
  <script>
    $(document).ready(function() {
      $('#repaymentSceduleTable').DataTable( {
        "scrollX": true
      } );
    } );
/*jQuery(document).ready(function ($) {
    $( "#datepicker" ).datepicker();
  } );*/
  jQuery(document).ready(function ($) {
    $('#loanDisDate').datepicker({
     changeMonth: true,
     changeYear: true,
     showButtonPanel: true,
     dateFormat: 'yy-mm-dd',
     yearRange: '2019:2020',
   })
    $('#emiStartDate').datepicker({
     changeMonth: true,
     changeYear: true,
     showButtonPanel: true,
     dateFormat: 'yy-mm-dd',
     yearRange: '2019:2020',
   })
    $('#dateEntries').datepicker({
     changeMonth: true,
     changeYear: true,
     showButtonPanel: true,
     dateFormat: 'yy-mm-dd',
     yearRange: '2019:2020',
   })
  });
  $('#saveDetails').click(function (e){
    if(validateForm('#divTab_sub')){
      return true;
    }else{
      e.preventDefault();
    }
  });
 /*   function showTable(){
      document.getElementById('repaymentSceduleTable').style.visibility = "visible";
    }
    function hideTable(){
      document.getElementById('repaymentSceduleTable').style.visibility = "hidden";
    }*/
// This script is explained line by line in depth in the following video:
// http://www.developphp.com/view.php?tid=1389
function computeLoan(){
 //alert("os2");
  var p = document.getElementById('p').value;  //Loan Amount Sanctioned 
  var r = document.getElementById('r').value;  //Interest Ra te 
   //var n = document.getElementById('n').value;  // 
 var t = document.getElementById('t').value;  //Tenor
  var moratorium = document.getElementById('moratorium').value;  //moratorium
/*  $("#emiStartDate").change(function(){
   $("#date").val($(this).val());
 }); 
  $("#emiStartDate").change(function(){
   $("#date2").val($(this).val());
 });*/
  //var a =  $("date").val();
  var pd = document.getElementById('date').value;
  /*var b= $("#emiStartDate").val($(this).val());
  var c=a.diff(b,'days');*/
  //alert(pd);
  //var os = document.getElementById('os').value;
/*  var interestdue = document.getElementById('interestdue').value;
  var pd = document.getElementById('pd').value;
  var tds = document.getElementById('tds').value;
  var netinterest = document.getElementById('netinterest').value;
  var netamtdue = document.getElementById('netamtdue').value;
  nod = document.getElementById("nod");
  nod.innerHTML =(n);
  os = document.getElementById("os");
  os.innerHTML =((p)-(p/t));
  interestdue = document.getElementById("interestdue");
  interestdue.innerHTML =Math.round(p*r*n/365)/100;
  pd = document.getElementById("pd");
  pd.innerHTML =(p/t);  
  tds = document.getElementById("tds");
  tds.innerHTML =Math.round(p*r*n/365)/100*0.1;
  netinterest = document.getElementById("netinterest");
  netinterest.innerHTML =((Math.round(p*r*n/365)/100)-(Math.round(p*r*n/365)/100*0.1));
  netamtdue = document.getElementById("netamtdue");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));
  var round =Math.round(netamtdue);
  netamtdue.innerHTML = Math.round((p*r*n/365)/100+(p/t)-(p*r*n/365)/100*0.1);
  //second row
  os2 = document.getElementById("os2");
  os2.innerHTML =((p)-(p/t));
  alert(os2);
  interestdue2 = document.getElementById("interestdue2");
  interestdue2.innerHTML =Math.round(p*r*n/365)/100;
  pd2 = document.getElementById("pd2");
  pd2.innerHTML =(p/t);  
  tds2 = document.getElementById("tds2");
  tds2.innerHTML =1433;
  netinterest2 = document.getElementById("netinterest2");
  netinterest2.innerHTML =12899;
  netamtdue2 = document.getElementById("netamtdue2");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));
  var round =Math.round(netamtdue2);
  netamtdue2.innerHTML = 75399;*/
}
function showDays(){
  alert("hi");
/*  var a = moment(document.getElementById('emiStartDate').value);
  var b =moment(document.getElementById('loanDisDate').value);
  var c = a.diff(b,'days');*/
    //$("#date2").val($(c).val());
    alert(c);
 //alert("days");
  /*   var a = document.getElementById('date').value;
  var b=  $("emiStartDate").val();
  var c = a.diff(b,'days');
 alert(c);
 alert("days");*/
 /*  var startminus = $('.ls').val();
   var start = $('.onedate').val();
   var end2 = $('.twodate').val();
   var end3 = $('.threedate').val();
   var fisrtDay = new Date(startminus);
   var startDay = new Date(start);
   var endDay2 = new Date(end2);*/
//   var endDay6 = new Date(end6);
/*var millisecondsPerDay = 1000 * 60 * 60 * 24;
var millisBetweenls = startDay.getTime() - fisrtDay.getTime();
var ls = millisBetweenls / millisecondsPerDay;
var millisBetween = endDay2.getTime() - startDay.getTime();
var days = millisBetween / millisecondsPerDay;
var millisBetween2 = endDay3.getTime() - endDay2.getTime();
var days2 = millisBetween2 / millisecondsPerDay;*/
/*
ls = document.getElementById("ls");
ls.innerHTML =millisBetweenls / millisecondsPerDay;    
days = document.getElementById("days");
days.innerHTML =millisBetween / millisecondsPerDay;
days2 = document.getElementById("days2");
days2.innerHTML = millisBetween2 / millisecondsPerDay;*/
}
</script>
--}}