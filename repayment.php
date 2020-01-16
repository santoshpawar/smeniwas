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
                        
                             {{--  {!! Form::text('cust_name', isset($praposalChecklist->cust_name) ? @$praposalChecklist->cust_name : null, array('class' => 'form-control', 'id'=>'cust_name', 'placeholder'=>'', '')) !!} --}}

                  {!! Form::text('borrower_name', $userProfileFirm->name_of_firm , array('class' => 'form-control', 'id'=>'borrower_name', 'placeholder'=>'')) !!}
                



                                      </div>
                                    </div>
                                </div>
                
                                    <div class="col-md-6">
                                      <div class="form-group required">
                                        {!! Form::label('guarantor_name','Name', ['class'=>'col-md-2 control-label']) !!}
                                        <div class="col-md-12">
                                          
                                          {!! Form::text('guarantor_name', isset($praposalChecklist->guarantor_name) ? @$praposalChecklist->guarantor_name : null, array('class' => 'form-control', 'id'=>'guarantor_name', 'placeholder'=>'', '')) !!}

                                        </div>
                                      </div>
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
                                    <div class="col-md-6">
                                      <div class="form-group required">
                                        {!! Form::label('guarantor_address','Address', ['class'=>'col-md-2 control-label']) !!}
                                        <div class="col-md-12">

                                           {!! Form::text('guarantor_address', isset($praposalChecklist->guarantor_address) ? @$praposalChecklist->guarantor_address : null, array('class' => 'form-control', 'id'=>'guarantor_address', 'placeholder'=>'', '')) !!}

                                        </div>
                                      </div>
                                    </div>
                            
                                  </div>


                          <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group required">
                                       {{--  {!! Form::label('cust_number','Contact Number', ['class'=>'col-md-0 control-label']) !!} --}}
                                          {!! Form::label('cust_number','Contact Number', ['class'=>'col-md-2 control-label']) !!}

                                        <div class="col-md-12">
                                          <div class="col-md-12">
                                     {{--        {!! Form::text('cust_number',null,['class' => 'form-control','placeholder' => 'contact number', 'maxlength' => 10]) !!} --}}

                                            {!! Form::text('cust_number', isset($praposalChecklist->cust_number) ? @$praposalChecklist->cust_number : null, array('class' => 'form-control', 'id'=>'cust_number', 'maxlength' => 10,'placeholder'=>'Customer Number', '')) !!}

                                          </div>
                                        {{--   <div class="col-md-6">
                                            {!! Form::text('contact2',null,['class' => 'form-control','placeholder' => 'No. 2', 'maxlength' => 10]) !!}
                                          </div> --}}
                                        </div>
                                      </div>
                                    </div>

                                   <div class="col-md-6">
                                      <div class="form-group required">
                                       {{--  {!! Form::label('guarantor_number','Contact Number', ['class'=>'col-md-0 control-label']) !!} --}}

                                          {!! Form::label('guarantor_number','Contact Number', ['class'=>'col-md-2 control-label']) !!}

                                        <div class="col-md-12">
                                          <div class="col-md-12">
                                           {{--  {!! Form::text('guarantor_number',null,['class' => 'form-control','placeholder' => 'contact number', 'maxlength' => 10]) !!} --}}

                                               {!! Form::text('guarantor_number', isset($praposalChecklist->guarantor_number) ? @$praposalChecklist->guarantor_number : null, array('class' => 'form-control', 'id'=>'guarantor_number', 'placeholder'=>'Guarantor Number', '')) !!}


                                          </div>
                                      {{--     <div class="col-md-6">
                                            {!! Form::text('contact2',null,['class' => 'form-control','placeholder' => 'No. 2', 'maxlength' => 10]) !!}
                                          </div> --}}
                                        </div>
                                      </div>
                                    </div>                            
                          
                                  </div><br>

                                  <div class="row">
                                      <div class="col-md-6">
                                      <div class="form-group required">
                                      {{--   {!! Form::label('email','Email id ', ['class'=>'col-md-4 control-label']) !!} --}}

                                         {!! Form::label('email','Email id', ['class'=>'col-md-0 control-label']) !!}

                                        <div class="col-md-12">
                                         {{--  {!! Form::text('email',null,['class' => 'form-control']) !!} --}}

                                             {!! Form::text('email', isset($praposalChecklist->email) ? @$praposalChecklist->email : null, array('class' => 'form-control', 'id'=>'email', 'placeholder'=>'Email Id 1', '')) !!}
                                             <br>

                                             {!! Form::text('email2', isset($praposalChecklist->email2) ? @$praposalChecklist->email2 : null, array('class' => 'form-control', 'id'=>'email2', 'placeholder'=>'Email Id 2', '')) !!}


                                        </div>
                                      </div>
                                    </div>

                     {{--     <div class="col-md-6">
                           <div class="form-group required">
                            {!! Form::label('TypeofLoan','Type of Loan', ['class'=>'col-md-0 control-label']) !!}
                              
                              <div class="col-md-12">
                            {!! Form::text('TypeofLoan', isset($praposalChecklist->TypeofLoan) ? @$praposalChecklist->TypeofLoan : null, array('class' => 'form-control', 'id'=>'TypeofLoan', 'placeholder'=>'', '')) !!}
                              </div>
                            </div>
                          </div> --}}

                                     <div class="col-sm-12 col-lg-6">
                                            {!! Form::label(null,'Type Of Loan') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::select('TypeofLoan', array('' => '','Secured Short Term WC/CC/OD/ Loan' =>
                                            'Secured Short Term WC/CC/OD/ Loan', 'Secured Term Loan' => 'Secured Term Loan', 'Loan Against Property' => 'Loan Against Property','Unsecured Business Loan' => 'Unsecured Business Loan','Equipment Finance' => 'Equipment Finance','Vendor Finance/Bill Discounting/Receivable Finance' => 'Vendor Finance/Bill Discounting/Receivable Finance','Corporate Supply Chain Finance' =>'Corporate Supply Chain Finance','Loan Against Share' => 'Loan Against Share'), $praposalChecklist['TypeofLoan'],
                                            ['id' => 'TypeofLoan', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'']) !!}
                                        </div>


                           <div class="col-sm-12 col-lg-6">
                      
                                {!! Form::label(null,'Type Of Repayment') !!}
                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                {!! Form::select('TypeofRepayment', array('' => '','fixed principal installment' => 'fixed principal installment','EMI' => 'EMI'), $praposalChecklist['TypeofRepayment'],
                                 ['id' => 'TypeofRepayment', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'']) !!}
                            
                             </div>



                                  </div>

                        </div>
                      </div>
                    </div>
                  </div>

                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div id="" class="form-group">
                      <div id="topcust" class="panel panel-success">
                        <div class="panel-heading">Loan Repayment Tracker</div>
                        <div class="panel-body">
                          <div class="row" style="padding:5px;">
                            <div class="col-md-4" >
                              {!! Form::label('loanamt','Loan Amount Sanctioned', ['class'=>'form-label']) !!}
                              {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                              {!! Form::text('amount', @$loan['amount'], array('class' => 'form-control', 'id'=>'amount' )) !!}
                            </div>
                            <div class="col-md-4" >
                              {!! Form::label('loanamt','Loan Tranche Disbursed', ['class'=>'form-label']) !!}
                              {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                              {!! Form::text('loanTranche', @$loan['loanTranche'], array('class' => 'form-control', 'id'=>'loanTranche' )) !!}
                            </div>

                            <div class="col-md-4" >
                              {!! Form::label('Tenor','Tenor (months)', ['class'=>'form-label']) !!}
                              {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                              {!! Form::text('tenor', @$loan['tenor'], array('class' => 'form-control', 'id'=>'tenor' )) !!}
                            </div>
                            <div class="col-md-4" >
                              {!! Form::label('rateInterest','Interest Rate', ['class'=>'form-label']) !!}
                              {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                              {!! Form::text('rateInterest', @$loan['rateInterest'], array('class' => 'form-control', 'id'=>'rateInterest' )) !!}
                            </div>

                            <div class="col-md-4" >
                              {!! Form::label('dateOfDisbursment','Date of   Disbursement', ['class'=>'form-label']) !!}
                              {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                              {!! Form::text('dateOfDisbursment', @$loan['dateOfDisbursment'], array('class' => 'form-control', 'id'=>'date' )) !!}
                            </div>

                            <div class="col-md-4" >
                              {!! Form::label('dateOfClosure','Date of Closure', ['class'=>'form-label']) !!}
                              {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                              {!! Form::text('dateOfClosure', @$loan['dateOfClosure'], array('class' => 'form-control', 'id'=>'dateOfClosure' )) !!}
                            </div>

                               <div class="col-md-4" >
                              {!! Form::label('penalty','Penalty', ['class'=>'form-label']) !!}
                              {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                              {!! Form::text('penalty', @$loan['penalty'], array('class' => 'form-control', 'id'=>'penalty' )) !!}
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
                 <table id="repaymentSceduleTable" class="display nowrap" style="width:100%">
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
                      <td>12/31/2018</td>
                      <td>26</td>
                      <td>15000</td>
                      <td>1923</td>
                      <td>61</td>
                      <td>212</td>
                      <td>2121</td>
                      <td>5421</td>
                    
                
                    </tr>
                    <tr>
                      <td>12/31/2018</td>
                      <td>26</td>
                      <td>15000</td>
                      <td>1923</td>
                      <td>61</td>
                      <td>212</td>
                      <td>2121</td>
                      <td>5421</td>
                
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

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
        <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>

        <style type="text/css" media="screen">
        table.ui-datepicker-calendar{
          /*display: none !important;*/
        }
      </style>

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


        $('#saveDetails').click(function (e){
          if(validateForm('#divTab_sub')){
            return true;
          }else{
            e.preventDefault();
          }
        });


      </script>

