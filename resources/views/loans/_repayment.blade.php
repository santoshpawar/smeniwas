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
                           {!! Form::select('TypeofLoan', array('' => '','Secured Short Term WC/CC/OD/ Loan' =>
                            'Secured Short Term WC/CC/OD/ Loan', 'Secured Term Loan' => 'Secured Term Loan', 'Loan Against Property' => 'Loan Against Property','Unsecured Business Loan' => 'Unsecured Business Loan','Equipment Finance' => 'Equipment Finance','Vendor Finance/Bill Discounting/Receivable Finance' => 'Vendor Finance/Bill Discounting/Receivable Finance','Corporate Supply Chain Finance' =>'Corporate Supply Chain Finance','Loan Against Share' => 'Loan Against Share'), $praposalChecklist['TypeofLoan'],
                            ['id' => 'TypeofLoan', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'']) !!}
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group required">
                             {!! Form::label('cust_address','Address', ['class'=>'col-md-2 control-label']) !!}
                             <div class="col-md-12">
                              {!! Form::text('cust_address', isset($praposalChecklist->cust_address) ? @$praposalChecklist->cust_address : null, array('class' => 'form-control', 'id'=>'cust_address', 'placeholder'=>'', '')) !!}
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
                            {!! Form::text('email', isset($praposalChecklist->email) ? @$praposalChecklist->email : null, array('class' => 'form-control', 'id'=>'email', 'placeholder'=>'Email Id 1' )) !!}
                          </div>
                          <div class="col-md-6" style="padding-right: 10px;width: 50%;">
                            {!! Form::text('email2', isset($praposalChecklist->email2) ? @$praposalChecklist->email2 : null, array('class' => 'form-control', 'id'=>'email2', 'placeholder'=>'Email Id 2', '')) !!}
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
                           {!! Form::text('cust_number', isset($praposalChecklist->cust_number) ? @$praposalChecklist->cust_number : null, array('class' => 'form-control', 'id'=>'cust_number', 'maxlength' => 10,'placeholder'=>'Customer Number', '')) !!}
                         </div>
                       </div>
                     </div>
                   </div>
                 </div><br>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="row">
        <div class="col-md-12">
          <div id="" class="form-group">
            <div id="topcust" class="panel panel-success">
              <div class="panel-heading">Loan Repayment</div>
              <div class="panel-body">
                <div class="row" style="padding:5px;">
                  <div class="col-md-4" >
                    {!! Form::label('loanamt','Loan Amount Sanctioned', ['class'=>'form-label']) !!}
                    {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                    {!! Form::text('p', isset($praposalChecklist->p) ? @$praposalChecklist->p : null, array('class' => 'form-control', 'id'=>'p', 'onchange' => 'computeLoan()' , 'min(1)' , 'max(10000000000)' )) !!} 
                    {{--  <p>Loan Amount: $<input id="p" type="number" min="1" max="1000000" onchange="computeLoan()"></p> --}}
                  </div>
                  <div class="col-md-4" >
                   {!! Form::label('rateInterest','Interest Rate', ['class'=>'form-label']) !!}
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('r',isset($praposalChecklist->r) ? @$praposalChecklist->r : null, array('class' => 'form-control', 'id'=>'r', 'min(0)' , 'max(100)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => '%' )) !!}
                   {{--  <p>Interest Rate: <input id="r" type="number" min="0" max="100" value="1" step="1" onchange="computeLoan()">%</p> --}}
                 </div>
                {{--  <div class="col-md-4" >
                    {!! Form::label('noOfDays','No of Days', ['class'=>'form-label']) !!}
                    {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                    {!! Form::text('n',isset($praposalChecklist->n) ? @$praposalChecklist->n : null,array('class' => 'form-control', 'id'=>'n', 'min(1)' , 'max(30)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => 'No. of Days')) !!}
                   <p>No of Days: <input id="n" type="number" min="1" max="30" value="1" step="1" onchange="computeLoan()"></p> 
                 </div> --}}
                 <div class="col-md-4" >
                   {!! Form::label('tenor','Tenor', ['class'=>'form-label']) !!}
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('t',isset($praposalChecklist->t) ? @$praposalChecklist->t : null, array('class' => 'form-control', 'id'=>'t', 'min(1)' , 'max(72)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => 'No. of Tenor' )) !!}
                   {{--     <p>Tenor: <input id="t" type="number" min="1" max="72" value="1" step="1" onchange="computeLoan()"></p> --}}
                 </div>
                 <div class="col-md-4" >
                   {!! Form::label('loansanction','Moratorium', ['class'=>'form-label']) !!}
                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('loansanction','', array('class' => 'form-control', 'onchange' => 'computeLoan()')) !!}
                 </div>
                 <div class="col-md-4" >
                   {!! Form::label('loansanction','Loan Disbursement Date', ['class'=>'form-label']) !!}
                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('loansanction',isset($praposalChecklist->loansanction) ? @$praposalChecklist->loansanction : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}
                 </div>
                 
                 <div class="col-md-4" > {{-- If Disbmnt Date is less than 20th each month EMI Start date is same month of end date --}}
                   {!! Form::label('loansanction','EMI Start Date', ['class'=>'form-label']) !!}
                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('loansanction',isset($praposalChecklist->loansanction) ? @$praposalChecklist->loansanction : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}
                 </div>
                 <div class="col-md-4" >
                   <input type='button'  class ="btn btn-info"  value='Calculate' onclick="showDays()">
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="row">
    <div class="col-md-12" style="margin-left:20px;">
      <body>
       <table id="repaymentSceduleTable"  style="width:100%">
        <thead>
          <tr>
            <th>Date</th>
            <th>Nos of days</th>
            <th>Loan Outstanding</th>
            <th>Interest Due</th>
            <th>Principal Due</th>
            <th>TDS</th>
            <th>Net Interest</th>
            <th>Net Amount Due</th>                   
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              {{--     <input class='onedate' type="date" onchange="showDays()" value="2019-04-30" /> --}}
              {!! Form::text('date1',isset($praposalChecklist->date1) ? @$praposalChecklist->date1 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}
            </td>
            <td><h6 id="ls"></h6></td>
            <td>{{-- <h6 id="os"></h6> --}}
             {!! Form::text('os1', isset($praposalChecklist->os1) ? @$praposalChecklist->os1 : null, array('class' => 'form-control', 'id'=>'os1')) !!}
           </td>
           <td>{{-- <h6 id="interestdue"></h6> --}}
            {!! Form::text('interestdue1', isset($praposalChecklist->interestdue1) ? @$praposalChecklist->interestdue1 : null, array('class' => 'form-control', 'id'=>'interestdue1')) !!}
          </td>
          <td>{{-- <h6 id="pd"></h6> --}}
           {!! Form::text('pd1', isset($praposalChecklist->pd1) ? @$praposalChecklist->pd1 : null, array('class' => 'form-control', 'id'=>'pd1')) !!}
         </td>
         <td>{{-- <h6 id="tds"></h6> --}}
          {!! Form::text('tds1', isset($praposalChecklist->tds1) ? @$praposalChecklist->tds1 : null, array('class' => 'form-control', 'id'=>'tds1')) !!}
        </td>
        <td>{{-- <h6 id="netinterest"></h6> --}}
          {!! Form::text('netinterest1', isset($praposalChecklist->netinterest1) ? @$praposalChecklist->netinterest1 : null, array('class' => 'form-control', 'id'=>'netinterest1')) !!}
        </td>
        <td>{{-- <h6 id="netamtdue"></h6> --}}
          {!! Form::text('netamtdue1', isset($praposalChecklist->netamtdue1) ? @$praposalChecklist->netamtdue1 : null, array('class' => 'form-control', 'id'=>'netamtdue1')) !!}
        </td>
      </tr>
      <tr>  {{-- 2nd row --}}
       <td>
         {{--  <input class='twodate' type="date" onchange="showDays()" value="2019-05-31" /> --}}
         {!! Form::text('date2',isset($praposalChecklist->date2) ? @$praposalChecklist->date2 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}
       </td>
       <td><h6 id="days"></h6></td>
       <td>{{-- <h6 id="os"></h6> --}}
        {!! Form::text('os2', isset($praposalChecklist->os2) ? @$praposalChecklist->os2 : null, array('class' => 'form-control', 'id'=>'os2')) !!}
      </td>
      <td>{{-- <h6 id="interestdue"></h6> --}}
        {!! Form::text('interestdue2', isset($praposalChecklist->interestdue2) ? @$praposalChecklist->interestdue2 : null, array('class' => 'form-control', 'id'=>'interestdue2')) !!}
      </td>
      <td>{{-- <h6 id="pd"></h6> --}}
        {!! Form::text('pd2', isset($praposalChecklist->pd2) ? @$praposalChecklist->pd2 : null, array('class' => 'form-control', 'id'=>'pd2')) !!}
      </td>
      <td>{{-- <h6 id="tds"></h6> --}}
        {!! Form::text('tds2', isset($praposalChecklist->tds2) ? @$praposalChecklist->tds2 : null, array('class' => 'form-control', 'id'=>'tds2')) !!}
      </td>
      <td>{{-- <h6 id="netinterest"></h6> --}}
        {!! Form::text('netinterest2', isset($praposalChecklist->netinterest2) ? @$praposalChecklist->netinterest2 : null, array('class' => 'form-control', 'id'=>'netinterest2')) !!}
      </td>
      <td>{{-- <h6 id="netamtdue"></h6> --}}
        {!! Form::text('netamtdue2', isset($praposalChecklist->netamtdue2) ? @$praposalChecklist->netamtdue2 : null, array('class' => 'form-control', 'id'=>'netamtdue2')) !!}
      </td>
    </tr>
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
<script src="https://momentjs.com/downloads/moment-with-locales.min.js" type="text/javascript"></script>

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

    
    jQuery(document).ready(function ($) {
      $('#date').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '2017:2025',
        monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
        monthNamesShort: ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"],
        onClose: function(dateText, inst) {
          var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
          var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
          $(this).datepicker('setDate', new Date(year, month, date));
        },
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
  // alert("os2");
  var p = document.getElementById('p').value;
  //  alert(p);
  var r = document.getElementById('r').value;
  var n = document.getElementById('n').value;
  var t = document.getElementById('t').value;
  var os = document.getElementById('os').value;

  var interestdue = document.getElementById('interestdue').value;
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
  netamtdue2.innerHTML = 75399;
}



function showDays(){
   // alert("days");
   var startminus = $('.ls').val();
   var start = $('.onedate').val();
   var end2 = $('.twodate').val();
   var end3 = $('.threedate').val();
   
   var fisrtDay = new Date(startminus);
   var startDay = new Date(start);
   var endDay2 = new Date(end2);
//   var endDay6 = new Date(end6);
var millisecondsPerDay = 1000 * 60 * 60 * 24;
var millisBetweenls = startDay.getTime() - fisrtDay.getTime();
var ls = millisBetweenls / millisecondsPerDay;
var millisBetween = endDay2.getTime() - startDay.getTime();
var days = millisBetween / millisecondsPerDay;
var millisBetween2 = endDay3.getTime() - endDay2.getTime();
var days2 = millisBetween2 / millisecondsPerDay;

ls = document.getElementById("ls");
ls.innerHTML =millisBetweenls / millisecondsPerDay;    
days = document.getElementById("days");
days.innerHTML =millisBetween / millisecondsPerDay;
days2 = document.getElementById("days2");
days2.innerHTML = millisBetween2 / millisecondsPerDay;

}
</script>
