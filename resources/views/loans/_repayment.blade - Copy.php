sasa<style>
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

                 <div class="col-md-4" >

          {{--           {!! Form::label('noOfDays','No of Days', ['class'=>'form-label']) !!}
                    {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                    {!! Form::text('n',isset($praposalChecklist->n) ? @$praposalChecklist->n : null,array('class' => 'form-control', 'id'=>'n', 'min(1)' , 'max(30)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => 'No. of Days')) !!} --}}



                    {{-- <p>No of Days: <input id="n" type="number" min="1" max="30" value="1" step="1" onchange="computeLoan()"></p> --}}
                  </div>


                  <div class="col-md-4" >

                   {!! Form::label('tenor','Tenor', ['class'=>'form-label']) !!}
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('t',isset($praposalChecklist->t) ? @$praposalChecklist->t : null, array('class' => 'form-control', 'id'=>'t', 'min(1)' , 'max(72)' , 'value' => '1' , 'step' => '1', 'onchange' => 'computeLoan()' , 'placeholder' => 'No. of Tenor' )) !!}

                   {{--     <p>Tenor: <input id="t" type="number" min="1" max="72" value="1" step="1" onchange="computeLoan()"></p> --}}

                 </div>



                 <div class="col-md-4" >

                   {!! Form::label('loansanction','Loan Sanction', ['class'=>'form-label']) !!}

                   <br>
                   {!! Form::label(null,null, ['style' => '  color: red;']) !!}
                   {!! Form::text('loansanction',isset($praposalChecklist->loansanction) ? @$praposalChecklist->loansanction : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}


                   {{--      <input class='ls' type="date" onchange="showDays()" value="" /> --}}

                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                   {{--     <p>Tenor: <input id="t" type="number" min="1" max="72" value="1" step="1" onchange="computeLoan()"></p> --}}

                 </div>


                 <div class="col-md-4" >

                   <input type='button'  class ="btn btn-info" onClick='javascript:showTable();' value='Calculate'>
       {{--      <input type='button'  class ="btn btn-primary" onClick='javascript:hideTable();' value='hide'>
       --}}

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
    <body onload="javascript:hideTable()">
     <table id="repaymentSceduleTable" class="display nowrap" style="width:100%" onload="javascript:hideTable()" >
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
      <tbody onload="javascript:hideTable()">

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

        <tr>
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

      <tr>
        <td>
          {{-- <input class='threedate' type="date" onchange="showDays()" value="2019-06-30" /> --}}

          {!! Form::text('date3',isset($praposalChecklist->date3) ? @$praposalChecklist->date3 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

        </td>
        <td><h6 id="days2"></h6></td>
        <td>{{-- <h6 id="os"></h6> --}}
          {!! Form::text('os3', isset($praposalChecklist->os3) ? @$praposalChecklist->os3 : null, array('class' => 'form-control', 'id'=>'os3')) !!}
        </td>
        <td>{{-- <h6 id="interestdue"></h6> --}}
          {!! Form::text('interestdue3', isset($praposalChecklist->interestdue3) ? @$praposalChecklist->interestdue3 : null, array('class' => 'form-control', 'id'=>'interestdue3')) !!}
        </td>
        <td>{{-- <h6 id="pd"></h6> --}}
          {!! Form::text('pd3', isset($praposalChecklist->pd3) ? @$praposalChecklist->pd3 : null, array('class' => 'form-control', 'id'=>'pd3')) !!}
        </td>
        <td>{{-- <h6 id="tds"></h6> --}}
          {!! Form::text('tds3', isset($praposalChecklist->tds3) ? @$praposalChecklist->tds3 : null, array('class' => 'form-control', 'id'=>'tds3')) !!}
        </td>
        <td>{{-- <h6 id="netinterest"></h6> --}}
          {!! Form::text('netinterest3', isset($praposalChecklist->netinterest3) ? @$praposalChecklist->netinterest3 : null, array('class' => 'form-control', 'id'=>'netinterest3')) !!}
        </td>
        <td>{{-- <h6 id="netamtdue"></h6> --}}
          {!! Form::text('netamtdue3', isset($praposalChecklist->netamtdue3) ? @$praposalChecklist->netamtdue3 : null, array('class' => 'form-control', 'id'=>'netamtdue3')) !!}
        </td>
      </tr>

      <tr>
        <td>
         {{--  <input class='fourdate' type="date" onchange="showDays()" value="2019-07-31" /> --}}

         {!! Form::text('date4',isset($praposalChecklist->date4) ? @$praposalChecklist->date4 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}


       </td>
       <td><h6 id="days3"></h6></td>
       <td>{{-- <h6 id="os"></h6> --}}
        {!! Form::text('os4', isset($praposalChecklist->os4) ? @$praposalChecklist->os4 : null, array('class' => 'form-control', 'id'=>'os4')) !!}
      </td>
      <td>{{-- <h6 id="interestdue"></h6> --}}
        {!! Form::text('interestdue4', isset($praposalChecklist->interestdue4) ? @$praposalChecklist->interestdue4 : null, array('class' => 'form-control', 'id'=>'interestdue4')) !!}
      </td>
      <td>{{-- <h6 id="pd"></h6> --}}
        {!! Form::text('pd4', isset($praposalChecklist->pd4) ? @$praposalChecklist->pd4 : null, array('class' => 'form-control', 'id'=>'pd4')) !!}
      </td>
      <td>{{-- <h6 id="tds"></h6> --}}
        {!! Form::text('tds4', isset($praposalChecklist->tds4) ? @$praposalChecklist->tds4 : null, array('class' => 'form-control', 'id'=>'tds4')) !!}
      </td>
      <td>{{-- <h6 id="netinterest"></h6> --}}
        {!! Form::text('netinterest4', isset($praposalChecklist->netinterest4) ? @$praposalChecklist->netinterest4 : null, array('class' => 'form-control', 'id'=>'netinterest4')) !!}
      </td>
      <td>{{-- <h6 id="netamtdue"></h6> --}}
        {!! Form::text('netamtdue4', isset($praposalChecklist->netamtdue4) ? @$praposalChecklist->netamtdue4 : null, array('class' => 'form-control', 'id'=>'netamtdue4')) !!}
      </td>
    </tr>

    <tr>
      <td>
        {{--     <input class='fivedate' type="date" onchange="showDays()" value="2019-08-31" /> --}}
        {!! Form::text('date5',isset($praposalChecklist->date5) ? @$praposalChecklist->date5 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

      </td>
      <td><h6 id="days4"></h6></td>
      <td>{{-- <h6 id="os"></h6> --}}
        {!! Form::text('os5', isset($praposalChecklist->os5) ? @$praposalChecklist->os5 : null, array('class' => 'form-control', 'id'=>'os5')) !!}
      </td>
      <td>{{-- <h6 id="interestdue"></h6> --}}
        {!! Form::text('interestdue5', isset($praposalChecklist->interestdue5) ? @$praposalChecklist->interestdue5 : null, array('class' => 'form-control', 'id'=>'interestdue5')) !!}
      </td>
      <td>{{-- <h6 id="pd"></h6> --}}
        {!! Form::text('pd5', isset($praposalChecklist->pd5) ? @$praposalChecklist->pd5 : null, array('class' => 'form-control', 'id'=>'pd5')) !!}
      </td>
      <td>{{-- <h6 id="tds"></h6> --}}
        {!! Form::text('tds5', isset($praposalChecklist->tds5) ? @$praposalChecklist->tds5 : null, array('class' => 'form-control', 'id'=>'tds5')) !!}
      </td>
      <td>{{-- <h6 id="netinterest"></h6> --}}
        {!! Form::text('netinterest5', isset($praposalChecklist->netinterest5) ? @$praposalChecklist->netinterest5 : null, array('class' => 'form-control', 'id'=>'netinterest5')) !!}
      </td>
      <td>{{-- <h6 id="netamtdue"></h6> --}}
        {!! Form::text('netamtdue5', isset($praposalChecklist->netamtdue5) ? @$praposalChecklist->netamtdue5 : null, array('class' => 'form-control', 'id'=>'netamtdue5')) !!}
      </td>
    </tr>

    <tr>
      <td>
       {{--    <input class='sixdate' type="date" onchange="showDays()" value="2019-09-30" /> --}}
       {!! Form::text('date6',isset($praposalChecklist->date6) ? @$praposalChecklist->date6 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

     </td>
     <td><h6 id="days5"></h6></td>
     <td>{{-- <h6 id="os"></h6> --}}
      {!! Form::text('os6', isset($praposalChecklist->os6) ? @$praposalChecklist->os6 : null, array('class' => 'form-control', 'id'=>'os6')) !!}
    </td>
    <td>{{-- <h6 id="interestdue"></h6> --}}
      {!! Form::text('interestdue6', isset($praposalChecklist->interestdue6) ? @$praposalChecklist->interestdue6 : null, array('class' => 'form-control', 'id'=>'interestdue6')) !!}
    </td>
    <td>{{-- <h6 id="pd"></h6> --}}
      {!! Form::text('pd6', isset($praposalChecklist->pd6) ? @$praposalChecklist->pd6 : null, array('class' => 'form-control', 'id'=>'pd6')) !!}
    </td>
    <td>{{-- <h6 id="tds"></h6> --}}
      {!! Form::text('tds6', isset($praposalChecklist->tds6) ? @$praposalChecklist->tds6 : null, array('class' => 'form-control', 'id'=>'tds6')) !!}
    </td>
    <td>{{-- <h6 id="netinterest"></h6> --}}
      {!! Form::text('netinterest6', isset($praposalChecklist->netinterest6) ? @$praposalChecklist->netinterest6 : null, array('class' => 'form-control', 'id'=>'netinterest6')) !!}
    </td>
    <td>{{-- <h6 id="netamtdue"></h6> --}}
      {!! Form::text('netamtdue6', isset($praposalChecklist->netamtdue6) ? @$praposalChecklist->netamtdue6 : null, array('class' => 'form-control', 'id'=>'netamtdue6')) !!}
    </td>
  </tr>

  <tr>
    <td>
      {{--   <input class='sevendate' type="date" onchange="showDays()" value="2019-10-31" /> --}}

      {!! Form::text('date7',isset($praposalChecklist->date7) ? @$praposalChecklist->date7 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

    </td>
    <td><h6 id="days6"></h6></td>
    <td>{{-- <h6 id="os"></h6> --}}
      {!! Form::text('os7', isset($praposalChecklist->os7) ? @$praposalChecklist->os7 : null, array('class' => 'form-control', 'id'=>'os7')) !!}
    </td>
    <td>{{-- <h6 id="interestdue"></h6> --}}
      {!! Form::text('interestdue7', isset($praposalChecklist->interestdue7) ? @$praposalChecklist->interestdue7 : null, array('class' => 'form-control', 'id'=>'interestdue7')) !!}
    </td>
    <td>{{-- <h6 id="pd"></h6> --}}
      {!! Form::text('pd7', isset($praposalChecklist->pd7) ? @$praposalChecklist->pd7 : null, array('class' => 'form-control', 'id'=>'pd7')) !!}
    </td>
    <td>{{-- <h6 id="tds"></h6> --}}
      {!! Form::text('tds7', isset($praposalChecklist->tds7) ? @$praposalChecklist->tds7 : null, array('class' => 'form-control', 'id'=>'tds7')) !!}
    </td>
    <td>{{-- <h6 id="netinterest"></h6> --}}
      {!! Form::text('netinterest7', isset($praposalChecklist->netinterest7) ? @$praposalChecklist->netinterest7 : null, array('class' => 'form-control', 'id'=>'netinterest7')) !!}
    </td>
    <td>{{-- <h6 id="netamtdue"></h6> --}}
      {!! Form::text('netamtdue7', isset($praposalChecklist->netamtdue7) ? @$praposalChecklist->netamtdue7 : null, array('class' => 'form-control', 'id'=>'netamtdue7')) !!}
    </td>
  </tr>

  <tr>
    <td>
     {{--  <input class='eightdate' type="date" onchange="showDays()" value="2019-11-30" /> --}}
     {!! Form::text('date8',isset($praposalChecklist->date8) ? @$praposalChecklist->date8 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

   </td>
   <td><h6 id="days7"></h6></td>
   <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os8', isset($praposalChecklist->os8) ? @$praposalChecklist->os8 : null, array('class' => 'form-control', 'id'=>'os8')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue8', isset($praposalChecklist->interestdue8) ? @$praposalChecklist->interestdue8 : null, array('class' => 'form-control', 'id'=>'interestdue8')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd8', isset($praposalChecklist->pd8) ? @$praposalChecklist->pd8 : null, array('class' => 'form-control', 'id'=>'pd8')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds8', isset($praposalChecklist->tds8) ? @$praposalChecklist->tds8 : null, array('class' => 'form-control', 'id'=>'tds8')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest8', isset($praposalChecklist->netinterest8) ? @$praposalChecklist->netinterest8 : null, array('class' => 'form-control', 'id'=>'netinterest8')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue8', isset($praposalChecklist->netamtdue8) ? @$praposalChecklist->netamtdue8 : null, array('class' => 'form-control', 'id'=>'netamtdue8')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--          <input class='ninedate' type="date" onchange="showDays()" value="2019-12-31" /> --}}
   {!! Form::text('date9',isset($praposalChecklist->date9) ? @$praposalChecklist->date9 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days8"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os9', isset($praposalChecklist->os9) ? @$praposalChecklist->os9 : null, array('class' => 'form-control', 'id'=>'os9')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue9', isset($praposalChecklist->interestdue9) ? @$praposalChecklist->interestdue9 : null, array('class' => 'form-control', 'id'=>'interestdue9')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd9', isset($praposalChecklist->pd9) ? @$praposalChecklist->pd9 : null, array('class' => 'form-control', 'id'=>'pd9')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds9', isset($praposalChecklist->tds9) ? @$praposalChecklist->tds9 : null, array('class' => 'form-control', 'id'=>'tds9')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest9', isset($praposalChecklist->netinterest9) ? @$praposalChecklist->netinterest9 : null, array('class' => 'form-control', 'id'=>'netinterest9')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue9', isset($praposalChecklist->netamtdue9) ? @$praposalChecklist->netamtdue9 : null, array('class' => 'form-control', 'id'=>'netamtdue9')) !!}
</td>
</tr>

<tr>
  <td>
   {{--        <input class='tendate' type="date" onchange="showDays()" value="2020-01-31" /> --}}
   {!! Form::text('date10',isset($praposalChecklist->date10) ? @$praposalChecklist->date10 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days9"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os10', isset($praposalChecklist->os10) ? @$praposalChecklist->os10 : null, array('class' => 'form-control', 'id'=>'os10')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue10', isset($praposalChecklist->interestdue10) ? @$praposalChecklist->interestdue10 : null, array('class' => 'form-control', 'id'=>'interestdue10')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd10', isset($praposalChecklist->pd10) ? @$praposalChecklist->pd10 : null, array('class' => 'form-control', 'id'=>'pd10')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds10', isset($praposalChecklist->tds10) ? @$praposalChecklist->tds10 : null, array('class' => 'form-control', 'id'=>'tds10')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest10', isset($praposalChecklist->netinterest10) ? @$praposalChecklist->netinterest10 : null, array('class' => 'form-control', 'id'=>'netinterest10')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue10', isset($praposalChecklist->netamtdue10) ? @$praposalChecklist->netamtdue10 : null, array('class' => 'form-control', 'id'=>'netamtdue10')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='elevendate' type="date" onchange="showDays()" value="2020-02-29" /> --}}
    {!! Form::text('date11',isset($praposalChecklist->date11) ? @$praposalChecklist->date11 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days10"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os11', isset($praposalChecklist->os11) ? @$praposalChecklist->os11 : null, array('class' => 'form-control', 'id'=>'os11')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue11', isset($praposalChecklist->interestdue11) ? @$praposalChecklist->interestdue11 : null, array('class' => 'form-control', 'id'=>'interestdue11')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd11', isset($praposalChecklist->pd11) ? @$praposalChecklist->pd11 : null, array('class' => 'form-control', 'id'=>'pd11')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds11', isset($praposalChecklist->tds11) ? @$praposalChecklist->tds11 : null, array('class' => 'form-control', 'id'=>'tds11')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest11', isset($praposalChecklist->netinterest11) ? @$praposalChecklist->netinterest11 : null, array('class' => 'form-control', 'id'=>'netinterest11')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue11', isset($praposalChecklist->netamtdue11) ? @$praposalChecklist->netamtdue11 : null, array('class' => 'form-control', 'id'=>'netamtdue11')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--    <input class='twelvedate' type="date" onchange="showDays()" value="2020-03-31" /> --}}
   {!! Form::text('date12',isset($praposalChecklist->date12) ? @$praposalChecklist->date12 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days11"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os12', isset($praposalChecklist->os12) ? @$praposalChecklist->os12 : null, array('class' => 'form-control', 'id'=>'os12')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue12', isset($praposalChecklist->interestdue12) ? @$praposalChecklist->interestdue12 : null, array('class' => 'form-control', 'id'=>'interestdue12')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd12', isset($praposalChecklist->pd12) ? @$praposalChecklist->pd12 : null, array('class' => 'form-control', 'id'=>'pd12')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds12', isset($praposalChecklist->tds12) ? @$praposalChecklist->tds12 : null, array('class' => 'form-control', 'id'=>'tds12')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest12', isset($praposalChecklist->netinterest12) ? @$praposalChecklist->netinterest12 : null, array('class' => 'form-control', 'id'=>'netinterest12')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue12', isset($praposalChecklist->netamtdue12) ? @$praposalChecklist->netamtdue12 : null, array('class' => 'form-control', 'id'=>'netamtdue12')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='thirteendate' type="date" onchange="showDays()" value="2020-04-30" /> --}}

    {!! Form::text('date13',isset($praposalChecklist->date13) ? @$praposalChecklist->date13 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days12"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os13', isset($praposalChecklist->os13) ? @$praposalChecklist->os13 : null, array('class' => 'form-control', 'id'=>'os13')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue13', isset($praposalChecklist->interestdue13) ? @$praposalChecklist->interestdue13 : null, array('class' => 'form-control', 'id'=>'interestdue13')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd13', isset($praposalChecklist->pd13) ? @$praposalChecklist->pd13 : null, array('class' => 'form-control', 'id'=>'pd13')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds13', isset($praposalChecklist->tds13) ? @$praposalChecklist->tds13 : null, array('class' => 'form-control', 'id'=>'tds13')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest13', isset($praposalChecklist->netinterest13) ? @$praposalChecklist->netinterest13 : null, array('class' => 'form-control', 'id'=>'netinterest13')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue13', isset($praposalChecklist->netamtdue13) ? @$praposalChecklist->netamtdue13 : null, array('class' => 'form-control', 'id'=>'netamtdue13')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='fourteendate' type="date" onchange="showDays()" value="2020-05-31" /> --}}
    {!! Form::text('date14',isset($praposalChecklist->date14) ? @$praposalChecklist->date14 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days13"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os14', isset($praposalChecklist->os14) ? @$praposalChecklist->os14 : null, array('class' => 'form-control', 'id'=>'os14')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue14', isset($praposalChecklist->interestdue14) ? @$praposalChecklist->interestdue14 : null, array('class' => 'form-control', 'id'=>'interestdue14')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd14', isset($praposalChecklist->pd14) ? @$praposalChecklist->pd14 : null, array('class' => 'form-control', 'id'=>'pd14')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds14', isset($praposalChecklist->tds14) ? @$praposalChecklist->tds14 : null, array('class' => 'form-control', 'id'=>'tds14')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest14', isset($praposalChecklist->netinterest14) ? @$praposalChecklist->netinterest14 : null, array('class' => 'form-control', 'id'=>'netinterest14')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue14', isset($praposalChecklist->netamtdue14) ? @$praposalChecklist->netamtdue14 : null, array('class' => 'form-control', 'id'=>'netamtdue14')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--  <input class='fifteendate' type="date" onchange="showDays()" value="2020-06-30" /> --}}
   {!! Form::text('date15',isset($praposalChecklist->date15) ? @$praposalChecklist->date15 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days14"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os15', isset($praposalChecklist->os15) ? @$praposalChecklist->os15 : null, array('class' => 'form-control', 'id'=>'os15')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue15', isset($praposalChecklist->interestdue15) ? @$praposalChecklist->interestdue15 : null, array('class' => 'form-control', 'id'=>'interestdue15')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd15', isset($praposalChecklist->pd15) ? @$praposalChecklist->pd15 : null, array('class' => 'form-control', 'id'=>'pd15')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds15', isset($praposalChecklist->tds15) ? @$praposalChecklist->tds15 : null, array('class' => 'form-control', 'id'=>'tds15')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest15', isset($praposalChecklist->netinterest15) ? @$praposalChecklist->netinterest15 : null, array('class' => 'form-control', 'id'=>'netinterest15')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue15', isset($praposalChecklist->netamtdue15) ? @$praposalChecklist->netamtdue15 : null, array('class' => 'form-control', 'id'=>'netamtdue15')) !!}
</td>
</tr>

<tr>
  <td>
   {{--  <input class='sixteendate' type="date" onchange="showDays()" value="2020-07-31" /> --}}
   {!! Form::text('date16',isset($praposalChecklist->date16) ? @$praposalChecklist->date16 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days15"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os16', isset($praposalChecklist->os16) ? @$praposalChecklist->os16 : null, array('class' => 'form-control', 'id'=>'os16')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue16', isset($praposalChecklist->interestdue16) ? @$praposalChecklist->interestdue16 : null, array('class' => 'form-control', 'id'=>'interestdue16')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd16', isset($praposalChecklist->pd16) ? @$praposalChecklist->pd16 : null, array('class' => 'form-control', 'id'=>'pd16')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds16', isset($praposalChecklist->tds16) ? @$praposalChecklist->tds16 : null, array('class' => 'form-control', 'id'=>'tds16')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest16', isset($praposalChecklist->netinterest16) ? @$praposalChecklist->netinterest16 : null, array('class' => 'form-control', 'id'=>'netinterest16')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue16', isset($praposalChecklist->netamtdue16) ? @$praposalChecklist->netamtdue16 : null, array('class' => 'form-control', 'id'=>'netamtdue16')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='seventeendate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date17',isset($praposalChecklist->date17) ? @$praposalChecklist->date17 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days16"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os17', isset($praposalChecklist->os17) ? @$praposalChecklist->os17 : null, array('class' => 'form-control', 'id'=>'os17')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue17', isset($praposalChecklist->interestdue17) ? @$praposalChecklist->interestdue17 : null, array('class' => 'form-control', 'id'=>'interestdue17')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd17', isset($praposalChecklist->pd17) ? @$praposalChecklist->pd17 : null, array('class' => 'form-control', 'id'=>'pd17')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds17', isset($praposalChecklist->tds17) ? @$praposalChecklist->tds17 : null, array('class' => 'form-control', 'id'=>'tds17')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest17', isset($praposalChecklist->netinterest17) ? @$praposalChecklist->netinterest17 : null, array('class' => 'form-control', 'id'=>'netinterest17')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue17', isset($praposalChecklist->netamtdue17) ? @$praposalChecklist->netamtdue17 : null, array('class' => 'form-control', 'id'=>'netamtdue17')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='eighteendate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date18',isset($praposalChecklist->date18) ? @$praposalChecklist->date18 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days17"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os18', isset($praposalChecklist->os18) ? @$praposalChecklist->os18 : null, array('class' => 'form-control', 'id'=>'os18')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue18', isset($praposalChecklist->interestdue18) ? @$praposalChecklist->interestdue18 : null, array('class' => 'form-control', 'id'=>'interestdue18')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd18', isset($praposalChecklist->pd18) ? @$praposalChecklist->pd18 : null, array('class' => 'form-control', 'id'=>'pd18')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds18', isset($praposalChecklist->tds18) ? @$praposalChecklist->tds18 : null, array('class' => 'form-control', 'id'=>'tds18')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest18', isset($praposalChecklist->netinterest18) ? @$praposalChecklist->netinterest18 : null, array('class' => 'form-control', 'id'=>'netinterest18')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue18', isset($praposalChecklist->netamtdue18) ? @$praposalChecklist->netamtdue18 : null, array('class' => 'form-control', 'id'=>'netamtdue18')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--  <input class='nineteendate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date19',isset($praposalChecklist->date19) ? @$praposalChecklist->date19 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days18"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os19', isset($praposalChecklist->os19) ? @$praposalChecklist->os19 : null, array('class' => 'form-control', 'id'=>'os19')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue19', isset($praposalChecklist->interestdue19) ? @$praposalChecklist->interestdue19 : null, array('class' => 'form-control', 'id'=>'interestdue19')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd19', isset($praposalChecklist->pd19) ? @$praposalChecklist->pd19 : null, array('class' => 'form-control', 'id'=>'pd19')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds19', isset($praposalChecklist->tds19) ? @$praposalChecklist->tds19 : null, array('class' => 'form-control', 'id'=>'tds19')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest19', isset($praposalChecklist->netinterest19) ? @$praposalChecklist->netinterest19 : null, array('class' => 'form-control', 'id'=>'netinterest19')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue19', isset($praposalChecklist->netamtdue19) ? @$praposalChecklist->netamtdue19 : null, array('class' => 'form-control', 'id'=>'netamtdue19')) !!}
</td>
</tr>

<tr>
  <td>
   {{--  <input class='twentydate' type="date" onchange="showDays()" value="" /> --}}

   {!! Form::text('date20',isset($praposalChecklist->date20) ? @$praposalChecklist->date20 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}


 </td>
 <td><h6 id="days19"></h6></td>
 <td>{{-- <h6 id="os20"></h6> --}}
  {!! Form::text('os20', isset($praposalChecklist->os20) ? @$praposalChecklist->os20 : null, array('class' => 'form-control', 'id'=>'os20')) !!}
</td>
<td>{{-- <h6 id="interestdue20"></h6> --}}
  {!! Form::text('interestdue20', isset($praposalChecklist->interestdue20) ? @$praposalChecklist->interestdue20 : null, array('class' => 'form-control', 'id'=>'interestdue20')) !!}
</td>
<td>{{-- <h6 id="pd20"></h6> --}}
  {!! Form::text('pd20', isset($praposalChecklist->pd20) ? @$praposalChecklist->pd20 : null, array('class' => 'form-control', 'id'=>'pd20')) !!}
</td>
<td>{{-- <h6 id="tds20"></h6> --}}
  {!! Form::text('tds20', isset($praposalChecklist->tds20) ? @$praposalChecklist->tds20 : null, array('class' => 'form-control', 'id'=>'tds20')) !!}
</td>
<td>{{-- <h6 id="netinterest20"></h6> --}}
  {!! Form::text('netinterest20', isset($praposalChecklist->netinterest20) ? @$praposalChecklist->netinterest20 : null, array('class' => 'form-control', 'id'=>'netinterest20')) !!}
</td>
<td>{{-- <h6 id="netamtdue20"></h6> --}}
  {!! Form::text('netamtdue20', isset($praposalChecklist->netamtdue20) ? @$praposalChecklist->netamtdue20 : null, array('class' => 'form-control', 'id'=>'netamtdue20')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='twentyonedate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date21',isset($praposalChecklist->date21) ? @$praposalChecklist->date21 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days20"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os21', isset($praposalChecklist->os21) ? @$praposalChecklist->os21 : null, array('class' => 'form-control', 'id'=>'os21')) !!}
  </td>
  <td>{{-- <h6 id="interestdue21"></h6> --}}
    {!! Form::text('interestdue21', isset($praposalChecklist->interestdue21) ? @$praposalChecklist->interestdue21 : null, array('class' => 'form-control', 'id'=>'interestdue21')) !!}
  </td>
  <td>{{-- <h6 id="pd21"></h6> --}}
    {!! Form::text('pd21', isset($praposalChecklist->pd21) ? @$praposalChecklist->pd21 : null, array('class' => 'form-control', 'id'=>'pd21')) !!}
  </td>
  <td>{{-- <h6 id="tds21"></h6> --}}
    {!! Form::text('tds21', isset($praposalChecklist->tds21) ? @$praposalChecklist->tds21 : null, array('class' => 'form-control', 'id'=>'tds21')) !!}
  </td>
  <td>{{-- <h6 id="netinterest21"></h6> --}}
    {!! Form::text('netinterest21', isset($praposalChecklist->netinterest21) ? @$praposalChecklist->netinterest21 : null, array('class' => 'form-control', 'id'=>'netinterest21')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue21"></h6> --}}
    {!! Form::text('netamtdue21', isset($praposalChecklist->netamtdue21) ? @$praposalChecklist->netamtdue21 : null, array('class' => 'form-control', 'id'=>'netamtdue21')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--     <input class='twentytwodate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date22',isset($praposalChecklist->date22) ? @$praposalChecklist->date22 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days21"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os22', isset($praposalChecklist->os22) ? @$praposalChecklist->os22 : null, array('class' => 'form-control', 'id'=>'os22')) !!}
  </td>
  <td>{{-- <h6 id="interestdue22"></h6> --}}
    {!! Form::text('interestdue22', isset($praposalChecklist->interestdue22) ? @$praposalChecklist->interestdue22 : null, array('class' => 'form-control', 'id'=>'interestdue22')) !!}
  </td>
  <td>{{-- <h6 id="pd22"></h6> --}}
    {!! Form::text('pd22', isset($praposalChecklist->pd22) ? @$praposalChecklist->pd22 : null, array('class' => 'form-control', 'id'=>'pd22')) !!}
  </td>
  <td>{{-- <h6 id="tds22"></h6> --}}
    {!! Form::text('tds22', isset($praposalChecklist->tds22) ? @$praposalChecklist->tds22 : null, array('class' => 'form-control', 'id'=>'tds22')) !!}
  </td>
  <td>{{-- <h6 id="netinterest22"></h6> --}}
    {!! Form::text('netinterest22', isset($praposalChecklist->netinterest22) ? @$praposalChecklist->netinterest22 : null, array('class' => 'form-control', 'id'=>'netinterest22')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue22"></h6> --}}
    {!! Form::text('netamtdue22', isset($praposalChecklist->netamtdue22) ? @$praposalChecklist->netamtdue22 : null, array('class' => 'form-control', 'id'=>'netamtdue22')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--           <input class='twentythreedate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date23',isset($praposalChecklist->date23) ? @$praposalChecklist->date23 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days22"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os23', isset($praposalChecklist->os23) ? @$praposalChecklist->os23 : null, array('class' => 'form-control', 'id'=>'os23')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue23', isset($praposalChecklist->interestdue23) ? @$praposalChecklist->interestdue23 : null, array('class' => 'form-control', 'id'=>'interestdue23')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd23', isset($praposalChecklist->pd23) ? @$praposalChecklist->pd23 : null, array('class' => 'form-control', 'id'=>'pd23')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds23', isset($praposalChecklist->tds23) ? @$praposalChecklist->tds23 : null, array('class' => 'form-control', 'id'=>'tds23')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest23', isset($praposalChecklist->netinterest23) ? @$praposalChecklist->netinterest23 : null, array('class' => 'form-control', 'id'=>'netinterest23')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue23', isset($praposalChecklist->netamtdue23) ? @$praposalChecklist->netamtdue23 : null, array('class' => 'form-control', 'id'=>'netamtdue23')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--    <input class='twentyfourdate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date24',isset($praposalChecklist->date24) ? @$praposalChecklist->date24 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days23"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os24', isset($praposalChecklist->os24) ? @$praposalChecklist->os24 : null, array('class' => 'form-control', 'id'=>'os24')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue24', isset($praposalChecklist->interestdue24) ? @$praposalChecklist->interestdue24 : null, array('class' => 'form-control', 'id'=>'interestdue24')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd24', isset($praposalChecklist->pd24) ? @$praposalChecklist->pd24 : null, array('class' => 'form-control', 'id'=>'pd24')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds24', isset($praposalChecklist->tds24) ? @$praposalChecklist->tds24 : null, array('class' => 'form-control', 'id'=>'tds24')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest24', isset($praposalChecklist->netinterest24) ? @$praposalChecklist->netinterest24 : null, array('class' => 'form-control', 'id'=>'netinterest24')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue24', isset($praposalChecklist->netamtdue24) ? @$praposalChecklist->netamtdue24 : null, array('class' => 'form-control', 'id'=>'netamtdue24')) !!}
</td>
</tr>

<tr>
  <td>
   {{--    <input class='twentyfivedate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date25',isset($praposalChecklist->date25) ? @$praposalChecklist->date25 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days24"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os25', isset($praposalChecklist->os25) ? @$praposalChecklist->os25 : null, array('class' => 'form-control', 'id'=>'os25')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue25', isset($praposalChecklist->interestdue25) ? @$praposalChecklist->interestdue25 : null, array('class' => 'form-control', 'id'=>'interestdue25')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd25', isset($praposalChecklist->pd25) ? @$praposalChecklist->pd25 : null, array('class' => 'form-control', 'id'=>'pd25')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds25', isset($praposalChecklist->tds25) ? @$praposalChecklist->tds25 : null, array('class' => 'form-control', 'id'=>'tds25')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest25', isset($praposalChecklist->netinterest25) ? @$praposalChecklist->netinterest25 : null, array('class' => 'form-control', 'id'=>'netinterest25')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue25', isset($praposalChecklist->netamtdue25) ? @$praposalChecklist->netamtdue25 : null, array('class' => 'form-control', 'id'=>'netamtdue25')) !!}
</td>
</tr>


<tr>
  <td>
   {{--    <input class='twentysixdate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date26',isset($praposalChecklist->date26) ? @$praposalChecklist->date26 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days25"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os26', isset($praposalChecklist->os26) ? @$praposalChecklist->os26 : null, array('class' => 'form-control', 'id'=>'os26')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue26', isset($praposalChecklist->interestdue26) ? @$praposalChecklist->interestdue26 : null, array('class' => 'form-control', 'id'=>'interestdue26')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd26', isset($praposalChecklist->pd26) ? @$praposalChecklist->pd26 : null, array('class' => 'form-control', 'id'=>'pd26')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds26', isset($praposalChecklist->tds26) ? @$praposalChecklist->tds26 : null, array('class' => 'form-control', 'id'=>'tds26')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest26', isset($praposalChecklist->netinterest26) ? @$praposalChecklist->netinterest26 : null, array('class' => 'form-control', 'id'=>'netinterest26')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue26', isset($praposalChecklist->netamtdue26) ? @$praposalChecklist->netamtdue26 : null, array('class' => 'form-control', 'id'=>'netamtdue26')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='twentysevendate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date27',isset($praposalChecklist->date27) ? @$praposalChecklist->date27 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days26"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os27', isset($praposalChecklist->os27) ? @$praposalChecklist->os27 : null, array('class' => 'form-control', 'id'=>'os27')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue27', isset($praposalChecklist->interestdue27) ? @$praposalChecklist->interestdue27 : null, array('class' => 'form-control', 'id'=>'interestdue27')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd27', isset($praposalChecklist->pd27) ? @$praposalChecklist->pd27 : null, array('class' => 'form-control', 'id'=>'pd27')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds27', isset($praposalChecklist->tds27) ? @$praposalChecklist->tds27 : null, array('class' => 'form-control', 'id'=>'tds27')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest27', isset($praposalChecklist->netinterest27) ? @$praposalChecklist->netinterest27 : null, array('class' => 'form-control', 'id'=>'netinterest27')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue27', isset($praposalChecklist->netamtdue27) ? @$praposalChecklist->netamtdue27 : null, array('class' => 'form-control', 'id'=>'netamtdue27')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='twentyeightdate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date28',isset($praposalChecklist->date28) ? @$praposalChecklist->date28 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days27"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os28', isset($praposalChecklist->os28) ? @$praposalChecklist->os28 : null, array('class' => 'form-control', 'id'=>'os28')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue28', isset($praposalChecklist->interestdue28) ? @$praposalChecklist->interestdue28 : null, array('class' => 'form-control', 'id'=>'interestdue28')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd28', isset($praposalChecklist->pd28) ? @$praposalChecklist->pd28 : null, array('class' => 'form-control', 'id'=>'pd28')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds28', isset($praposalChecklist->tds28) ? @$praposalChecklist->tds28 : null, array('class' => 'form-control', 'id'=>'tds28')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest28', isset($praposalChecklist->netinterest28) ? @$praposalChecklist->netinterest28 : null, array('class' => 'form-control', 'id'=>'netinterest28')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue28', isset($praposalChecklist->netamtdue28) ? @$praposalChecklist->netamtdue28 : null, array('class' => 'form-control', 'id'=>'netamtdue28')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--     <input class='twentyninedate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date29',isset($praposalChecklist->date29) ? @$praposalChecklist->date29 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days28"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os29', isset($praposalChecklist->os29) ? @$praposalChecklist->os29 : null, array('class' => 'form-control', 'id'=>'os29')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue29', isset($praposalChecklist->interestdue29) ? @$praposalChecklist->interestdue29 : null, array('class' => 'form-control', 'id'=>'interestdue29')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd29', isset($praposalChecklist->pd29) ? @$praposalChecklist->pd29 : null, array('class' => 'form-control', 'id'=>'pd29')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds29', isset($praposalChecklist->tds29) ? @$praposalChecklist->tds29 : null, array('class' => 'form-control', 'id'=>'tds29')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest29', isset($praposalChecklist->netinterest29) ? @$praposalChecklist->netinterest29 : null, array('class' => 'form-control', 'id'=>'netinterest29')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue29', isset($praposalChecklist->netamtdue29) ? @$praposalChecklist->netamtdue29 : null, array('class' => 'form-control', 'id'=>'netamtdue29')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='thirtydate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date30',isset($praposalChecklist->date30) ? @$praposalChecklist->date30 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days29"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os30', isset($praposalChecklist->os30) ? @$praposalChecklist->os30 : null, array('class' => 'form-control', 'id'=>'os30')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue30', isset($praposalChecklist->interestdue30) ? @$praposalChecklist->interestdue30 : null, array('class' => 'form-control', 'id'=>'interestdue30')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd30', isset($praposalChecklist->pd3030) ? @$praposalChecklist->pd30 : null, array('class' => 'form-control', 'id'=>'pd30')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds30', isset($praposalChecklist->tds30) ? @$praposalChecklist->tds30 : null, array('class' => 'form-control', 'id'=>'tds30')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest30', isset($praposalChecklist->netinterest30) ? @$praposalChecklist->netinterest30 : null, array('class' => 'form-control', 'id'=>'netinterest30')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue30', isset($praposalChecklist->netamtdue30) ? @$praposalChecklist->netamtdue30 : null, array('class' => 'form-control', 'id'=>'netamtdue30')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='thirtyonedate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date31',isset($praposalChecklist->date31) ? @$praposalChecklist->date31 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days30"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os31', isset($praposalChecklist->os31) ? @$praposalChecklist->os31 : null, array('class' => 'form-control', 'id'=>'os31')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue31', isset($praposalChecklist->interestdue31) ? @$praposalChecklist->interestdue31 : null, array('class' => 'form-control', 'id'=>'interestdue31')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd31', isset($praposalChecklist->pd31) ? @$praposalChecklist->pd31 : null, array('class' => 'form-control', 'id'=>'pd31')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds31', isset($praposalChecklist->tds31) ? @$praposalChecklist->tds31 : null, array('class' => 'form-control', 'id'=>'tds31')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest31', isset($praposalChecklist->netinterest31) ? @$praposalChecklist->netinterest31 : null, array('class' => 'form-control', 'id'=>'netinterest31')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue31', isset($praposalChecklist->netamtdue31) ? @$praposalChecklist->netamtdue31 : null, array('class' => 'form-control', 'id'=>'netamtdue31')) !!}
  </td>
</tr>

<tr>
  <td>
    {{-- <input class='thirtytwodate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date32',isset($praposalChecklist->date32) ? @$praposalChecklist->date32 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days31"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os32', isset($praposalChecklist->os32) ? @$praposalChecklist->os32 : null, array('class' => 'form-control', 'id'=>'os32')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue32', isset($praposalChecklist->interestdue32) ? @$praposalChecklist->interestdue32 : null, array('class' => 'form-control', 'id'=>'interestdue32')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd32', isset($praposalChecklist->pd32) ? @$praposalChecklist->pd32 : null, array('class' => 'form-control', 'id'=>'pd32')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds32', isset($praposalChecklist->tds32) ? @$praposalChecklist->tds32 : null, array('class' => 'form-control', 'id'=>'tds32')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest32', isset($praposalChecklist->netinterest32) ? @$praposalChecklist->netinterest32 : null, array('class' => 'form-control', 'id'=>'netinterest32')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue32', isset($praposalChecklist->netamtdue32) ? @$praposalChecklist->netamtdue32 : null, array('class' => 'form-control', 'id'=>'netamtdue32')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='thirtythreedate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date33',isset($praposalChecklist->date33) ? @$praposalChecklist->date33 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days32"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os33', isset($praposalChecklist->os33) ? @$praposalChecklist->os33 : null, array('class' => 'form-control', 'id'=>'os33')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue33', isset($praposalChecklist->interestdue33) ? @$praposalChecklist->interestdue33 : null, array('class' => 'form-control', 'id'=>'interestdue33')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd33', isset($praposalChecklist->pd33) ? @$praposalChecklist->pd33 : null, array('class' => 'form-control', 'id'=>'pd33')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds33', isset($praposalChecklist->tds33) ? @$praposalChecklist->tds33 : null, array('class' => 'form-control', 'id'=>'tds33')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest33', isset($praposalChecklist->netinterest33) ? @$praposalChecklist->netinterest33 : null, array('class' => 'form-control', 'id'=>'netinterest33')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue33', isset($praposalChecklist->netamtdue33) ? @$praposalChecklist->netamtdue33 : null, array('class' => 'form-control', 'id'=>'netamtdue33')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--  <input class='thirtyfourdate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date34',isset($praposalChecklist->date34) ? @$praposalChecklist->date34 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days33"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os34', isset($praposalChecklist->os34) ? @$praposalChecklist->os34 : null, array('class' => 'form-control', 'id'=>'os34')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue34', isset($praposalChecklist->interestdue34) ? @$praposalChecklist->interestdue34 : null, array('class' => 'form-control', 'id'=>'interestdue34')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd34', isset($praposalChecklist->pd34) ? @$praposalChecklist->pd34 : null, array('class' => 'form-control', 'id'=>'pd34')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds34', isset($praposalChecklist->tds34) ? @$praposalChecklist->tds34 : null, array('class' => 'form-control', 'id'=>'tds34')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest34', isset($praposalChecklist->netinterest34) ? @$praposalChecklist->netinterest34 : null, array('class' => 'form-control', 'id'=>'netinterest34')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue34', isset($praposalChecklist->netamtdue34) ? @$praposalChecklist->netamtdue34 : null, array('class' => 'form-control', 'id'=>'netamtdue34')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='thirtyfivedate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date35',isset($praposalChecklist->date35) ? @$praposalChecklist->date35 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days34"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os35', isset($praposalChecklist->os35) ? @$praposalChecklist->os35 : null, array('class' => 'form-control', 'id'=>'os35')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue35', isset($praposalChecklist->interestdue35) ? @$praposalChecklist->interestdue35 : null, array('class' => 'form-control', 'id'=>'interestdue35')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd35', isset($praposalChecklist->pd35) ? @$praposalChecklist->pd35 : null, array('class' => 'form-control', 'id'=>'pd35')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds35', isset($praposalChecklist->tds35) ? @$praposalChecklist->tds35 : null, array('class' => 'form-control', 'id'=>'tds35')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest35', isset($praposalChecklist->netinterest35) ? @$praposalChecklist->netinterest35 : null, array('class' => 'form-control', 'id'=>'netinterest35')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue35', isset($praposalChecklist->netamtdue35) ? @$praposalChecklist->netamtdue35 : null, array('class' => 'form-control', 'id'=>'netamtdue35')) !!}
  </td>
</tr>



<tr>
  <td>
   {{--  <input class='thirtysixdate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date36',isset($praposalChecklist->date36) ? @$praposalChecklist->date36 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days35"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os36', isset($praposalChecklist->os36) ? @$praposalChecklist->os36 : null, array('class' => 'form-control', 'id'=>'os36')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue36', isset($praposalChecklist->interestdue36) ? @$praposalChecklist->interestdue36 : null, array('class' => 'form-control', 'id'=>'interestdue36')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd36', isset($praposalChecklist->pd36) ? @$praposalChecklist->pd36 : null, array('class' => 'form-control', 'id'=>'pd36')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds36', isset($praposalChecklist->tds36) ? @$praposalChecklist->tds36 : null, array('class' => 'form-control', 'id'=>'tds36')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest36', isset($praposalChecklist->netinterest36) ? @$praposalChecklist->netinterest36 : null, array('class' => 'form-control', 'id'=>'netinterest36')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue36', isset($praposalChecklist->netamtdue36) ? @$praposalChecklist->netamtdue36 : null, array('class' => 'form-control', 'id'=>'netamtdue36')) !!}
</td>
</tr>

<tr>
  <td>
    {{-- <input class='thirtysevendate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date37',isset($praposalChecklist->date37) ? @$praposalChecklist->date37 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days36"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os37', isset($praposalChecklist->os37) ? @$praposalChecklist->os37 : null, array('class' => 'form-control', 'id'=>'os37')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue37', isset($praposalChecklist->interestdue37) ? @$praposalChecklist->interestdue37 : null, array('class' => 'form-control', 'id'=>'interestdue37')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd37', isset($praposalChecklist->pd37) ? @$praposalChecklist->pd37 : null, array('class' => 'form-control', 'id'=>'pd37')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds37', isset($praposalChecklist->tds37) ? @$praposalChecklist->tds37 : null, array('class' => 'form-control', 'id'=>'tds37')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest37', isset($praposalChecklist->netinterest37) ? @$praposalChecklist->netinterest37 : null, array('class' => 'form-control', 'id'=>'netinterest37')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue37', isset($praposalChecklist->netamtdue37) ? @$praposalChecklist->netamtdue37 : null, array('class' => 'form-control', 'id'=>'netamtdue37')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='thirtyeightdate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date38',isset($praposalChecklist->date38) ? @$praposalChecklist->date38 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days37"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os38', isset($praposalChecklist->os38) ? @$praposalChecklist->os38 : null, array('class' => 'form-control', 'id'=>'os38')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue38', isset($praposalChecklist->interestdue38) ? @$praposalChecklist->interestdue38 : null, array('class' => 'form-control', 'id'=>'interestdue38')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd38', isset($praposalChecklist->pd38) ? @$praposalChecklist->pd38 : null, array('class' => 'form-control', 'id'=>'pd38')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds38', isset($praposalChecklist->tds38) ? @$praposalChecklist->tds38 : null, array('class' => 'form-control', 'id'=>'tds38')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest38', isset($praposalChecklist->netinterest38) ? @$praposalChecklist->netinterest38 : null, array('class' => 'form-control', 'id'=>'netinterest38')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue38', isset($praposalChecklist->netamtdue38) ? @$praposalChecklist->netamtdue38 : null, array('class' => 'form-control', 'id'=>'netamtdue38')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--  <input class='thirtyninedate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date39',isset($praposalChecklist->date39) ? @$praposalChecklist->date39 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days38"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os39', isset($praposalChecklist->os39) ? @$praposalChecklist->os39 : null, array('class' => 'form-control', 'id'=>'os39')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue39', isset($praposalChecklist->interestdue39) ? @$praposalChecklist->interestdue39 : null, array('class' => 'form-control', 'id'=>'interestdue39')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd39', isset($praposalChecklist->pd39) ? @$praposalChecklist->pd39 : null, array('class' => 'form-control', 'id'=>'pd39')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds39', isset($praposalChecklist->tds39) ? @$praposalChecklist->tds39 : null, array('class' => 'form-control', 'id'=>'tds39')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest39', isset($praposalChecklist->netinterest39) ? @$praposalChecklist->netinterest39 : null, array('class' => 'form-control', 'id'=>'netinterest39')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue39', isset($praposalChecklist->netamtdue39) ? @$praposalChecklist->netamtdue39 : null, array('class' => 'form-control', 'id'=>'netamtdue39')) !!}
</td>
</tr>

<tr>
  <td>
   {{--    <input class='fourtydate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date40',isset($praposalChecklist->date40) ? @$praposalChecklist->date40 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days39"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os40', isset($praposalChecklist->os40) ? @$praposalChecklist->os40 : null, array('class' => 'form-control', 'id'=>'os40')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue40', isset($praposalChecklist->interestdue40) ? @$praposalChecklist->interestdue40 : null, array('class' => 'form-control', 'id'=>'interestdue40')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd40', isset($praposalChecklist->pd40) ? @$praposalChecklist->pd40 : null, array('class' => 'form-control', 'id'=>'pd40')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds40', isset($praposalChecklist->tds40) ? @$praposalChecklist->tds40 : null, array('class' => 'form-control', 'id'=>'tds40')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest40', isset($praposalChecklist->netinterest40) ? @$praposalChecklist->netinterest40 : null, array('class' => 'form-control', 'id'=>'netinterest40')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue40', isset($praposalChecklist->netamtdue40) ? @$praposalChecklist->netamtdue40 : null, array('class' => 'form-control', 'id'=>'netamtdue40')) !!}
</td>
</tr>

<tr>
  <td>
   {{--  <input class='fourtyonedate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date41',isset($praposalChecklist->date41) ? @$praposalChecklist->date41 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days40"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os41', isset($praposalChecklist->os41) ? @$praposalChecklist->os41 : null, array('class' => 'form-control', 'id'=>'os41')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue41', isset($praposalChecklist->interestdue41) ? @$praposalChecklist->interestdue41 : null, array('class' => 'form-control', 'id'=>'interestdue41')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd41', isset($praposalChecklist->pd41) ? @$praposalChecklist->pd41 : null, array('class' => 'form-control', 'id'=>'pd41')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds41', isset($praposalChecklist->tds41) ? @$praposalChecklist->tds41 : null, array('class' => 'form-control', 'id'=>'tds41')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest41', isset($praposalChecklist->netinterest41) ? @$praposalChecklist->netinterest41 : null, array('class' => 'form-control', 'id'=>'netinterest41')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue41', isset($praposalChecklist->netamtdue41) ? @$praposalChecklist->netamtdue41 : null, array('class' => 'form-control', 'id'=>'netamtdue41')) !!}
</td>
</tr>

<tr>
  <td>
   {{--  <input class='fourtytwodate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date42',isset($praposalChecklist->date42) ? @$praposalChecklist->date42 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days41"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os42', isset($praposalChecklist->os42) ? @$praposalChecklist->os42 : null, array('class' => 'form-control', 'id'=>'os42')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue42', isset($praposalChecklist->interestdue42) ? @$praposalChecklist->interestdue42 : null, array('class' => 'form-control', 'id'=>'interestdue42')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd42', isset($praposalChecklist->pd42) ? @$praposalChecklist->pd42 : null, array('class' => 'form-control', 'id'=>'pd42')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds42', isset($praposalChecklist->tds42) ? @$praposalChecklist->tds42 : null, array('class' => 'form-control', 'id'=>'tds42')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest42', isset($praposalChecklist->netinterest42) ? @$praposalChecklist->netinterest42 : null, array('class' => 'form-control', 'id'=>'netinterest42')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue42', isset($praposalChecklist->netamtdue42) ? @$praposalChecklist->netamtdue42 : null, array('class' => 'form-control', 'id'=>'netamtdue42')) !!}
</td>
</tr>

<tr>
  <td>
   {{--  <input class='fourtythreedate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date43',isset($praposalChecklist->date43) ? @$praposalChecklist->date43 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days42"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os43', isset($praposalChecklist->os43) ? @$praposalChecklist->os43 : null, array('class' => 'form-control', 'id'=>'os43')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue43', isset($praposalChecklist->interestdue43) ? @$praposalChecklist->interestdue43 : null, array('class' => 'form-control', 'id'=>'interestdue43')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd43', isset($praposalChecklist->pd43) ? @$praposalChecklist->pd43 : null, array('class' => 'form-control', 'id'=>'pd43')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds43', isset($praposalChecklist->tds43) ? @$praposalChecklist->tds43 : null, array('class' => 'form-control', 'id'=>'tds43')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest43', isset($praposalChecklist->netinterest43) ? @$praposalChecklist->netinterest43 : null, array('class' => 'form-control', 'id'=>'netinterest43')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue43', isset($praposalChecklist->netamtdue43) ? @$praposalChecklist->netamtdue43 : null, array('class' => 'form-control', 'id'=>'netamtdue43')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='fourtyfourdate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date44',isset($praposalChecklist->date44) ? @$praposalChecklist->date44 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days43"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os44', isset($praposalChecklist->os44) ? @$praposalChecklist->os44 : null, array('class' => 'form-control', 'id'=>'os44')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue44', isset($praposalChecklist->interestdue44) ? @$praposalChecklist->interestdue44 : null, array('class' => 'form-control', 'id'=>'interestdue44')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd44', isset($praposalChecklist->pd44) ? @$praposalChecklist->pd44 : null, array('class' => 'form-control', 'id'=>'pd44')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds44', isset($praposalChecklist->tds44) ? @$praposalChecklist->tds44 : null, array('class' => 'form-control', 'id'=>'tds44')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest44', isset($praposalChecklist->netinterest44) ? @$praposalChecklist->netinterest44 : null, array('class' => 'form-control', 'id'=>'netinterest44')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue44', isset($praposalChecklist->netamtdue44) ? @$praposalChecklist->netamtdue44 : null, array('class' => 'form-control', 'id'=>'netamtdue44')) !!}
  </td>
</tr>

<tr>
  <td>
   {{--    <input class='fourtyfivedate' type="date" onchange="showDays()" value="" /> --}}
   {!! Form::text('date45',isset($praposalChecklist->date45) ? @$praposalChecklist->date45 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

 </td>
 <td><h6 id="days44"></h6></td>
 <td>{{-- <h6 id="os"></h6> --}}
  {!! Form::text('os45', isset($praposalChecklist->os45) ? @$praposalChecklist->os45 : null, array('class' => 'form-control', 'id'=>'os45')) !!}
</td>
<td>{{-- <h6 id="interestdue"></h6> --}}
  {!! Form::text('interestdue45', isset($praposalChecklist->interestdue45) ? @$praposalChecklist->interestdue45 : null, array('class' => 'form-control', 'id'=>'interestdue45')) !!}
</td>
<td>{{-- <h6 id="pd"></h6> --}}
  {!! Form::text('pd45', isset($praposalChecklist->pd45) ? @$praposalChecklist->pd45 : null, array('class' => 'form-control', 'id'=>'pd45')) !!}
</td>
<td>{{-- <h6 id="tds"></h6> --}}
  {!! Form::text('tds45', isset($praposalChecklist->tds45) ? @$praposalChecklist->tds45 : null, array('class' => 'form-control', 'id'=>'tds45')) !!}
</td>
<td>{{-- <h6 id="netinterest"></h6> --}}
  {!! Form::text('netinterest45', isset($praposalChecklist->netinterest45) ? @$praposalChecklist->netinterest45 : null, array('class' => 'form-control', 'id'=>'netinterest45')) !!}
</td>
<td>{{-- <h6 id="netamtdue"></h6> --}}
  {!! Form::text('netamtdue45', isset($praposalChecklist->netamtdue45) ? @$praposalChecklist->netamtdue45 : null, array('class' => 'form-control', 'id'=>'netamtdue45')) !!}
</td>
</tr>

<tr>
  <td>
    {{--   <input class='fourtysixdate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date46',isset($praposalChecklist->date46) ? @$praposalChecklist->date46 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days45"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os46', isset($praposalChecklist->os46) ? @$praposalChecklist->os46 : null, array('class' => 'form-control', 'id'=>'os46')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue46', isset($praposalChecklist->interestdue46) ? @$praposalChecklist->interestdue46 : null, array('class' => 'form-control', 'id'=>'interestdue46')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd46', isset($praposalChecklist->pd46) ? @$praposalChecklist->pd46 : null, array('class' => 'form-control', 'id'=>'pd46')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds46', isset($praposalChecklist->tds46) ? @$praposalChecklist->tds46 : null, array('class' => 'form-control', 'id'=>'tds46')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest46', isset($praposalChecklist->netinterest46) ? @$praposalChecklist->netinterest46 : null, array('class' => 'form-control', 'id'=>'netinterest46')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue46', isset($praposalChecklist->netamtdue46) ? @$praposalChecklist->netamtdue46 : null, array('class' => 'form-control', 'id'=>'netamtdue46')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='fourtysevendate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date47',isset($praposalChecklist->date47) ? @$praposalChecklist->date47 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days46"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os47', isset($praposalChecklist->os47) ? @$praposalChecklist->os47 : null, array('class' => 'form-control', 'id'=>'os47')) !!}
  </td>
  <td>{{-- <h6 id="interestdue"></h6> --}}
    {!! Form::text('interestdue47', isset($praposalChecklist->interestdue47) ? @$praposalChecklist->interestdue47 : null, array('class' => 'form-control', 'id'=>'interestdue47')) !!}
  </td>
  <td>{{-- <h6 id="pd"></h6> --}}
    {!! Form::text('pd47', isset($praposalChecklist->pd47) ? @$praposalChecklist->pd47 : null, array('class' => 'form-control', 'id'=>'pd47')) !!}
  </td>
  <td>{{-- <h6 id="tds"></h6> --}}
    {!! Form::text('tds47', isset($praposalChecklist->tds47) ? @$praposalChecklist->tds47 : null, array('class' => 'form-control', 'id'=>'tds47')) !!}
  </td>
  <td>{{-- <h6 id="netinterest"></h6> --}}
    {!! Form::text('netinterest47', isset($praposalChecklist->netinterest47) ? @$praposalChecklist->netinterest47 : null, array('class' => 'form-control', 'id'=>'netinterest47')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue"></h6> --}}
    {!! Form::text('netamtdue47', isset($praposalChecklist->netamtdue47) ? @$praposalChecklist->netamtdue47 : null, array('class' => 'form-control', 'id'=>'netamtdue47')) !!}
  </td>
</tr>

<tr>
  <td>
    {{--   <input class='fourtyeightdate' type="date" onchange="showDays()" value="" /> --}}
    {!! Form::text('date48',isset($praposalChecklist->date48) ? @$praposalChecklist->date48 : null, array('class' => 'form-control', 'id'=>'date', 'onchange' => 'computeLoan()')) !!}

  </td>
  <td><h6 id="days47"></h6></td>
  <td>{{-- <h6 id="os"></h6> --}}
    {!! Form::text('os48', isset($praposalChecklist->os48) ? @$praposalChecklist->os48 : null, array('class' => 'form-control', 'id'=>'os48')) !!}
  </td>
  <td>{{-- <h6 id="interestdue48"></h6> --}}
    {!! Form::text('interestdue48', isset($praposalChecklist->interestdue48) ? @$praposalChecklist->interestdue48 : null, array('class' => 'form-control', 'id'=>'interestdue48')) !!}
  </td>
  <td>{{-- <h6 id="pd48"></h6> --}}
    {!! Form::text('pd48', isset($praposalChecklist->pd48) ? @$praposalChecklist->pd48 : null, array('class' => 'form-control', 'id'=>'pd48')) !!}
  </td>
  <td>{{-- <h6 id="tds48"></h6> --}}
    {!! Form::text('tds48', isset($praposalChecklist->tds48) ? @$praposalChecklist->tds48 : null, array('class' => 'form-control', 'id'=>'tds48')) !!}
  </td>
  <td>{{-- <h6 id="netinterest48"></h6> --}}
    {!! Form::text('netinterest48', isset($praposalChecklist->netinterest48) ? @$praposalChecklist->netinterest48 : null, array('class' => 'form-control', 'id'=>'netinterest48')) !!}
  </td>
  <td>{{-- <h6 id="netamtdue48"></h6> --}}
    {!! Form::text('netamtdue48', isset($praposalChecklist->netamtdue48) ? @$praposalChecklist->netamtdue48 : null, array('class' => 'form-control', 'id'=>'netamtdue48')) !!}
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
<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>

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


    function showTable(){
      document.getElementById('repaymentSceduleTable').style.visibility = "visible";
    }
    function hideTable(){
      document.getElementById('repaymentSceduleTable').style.visibility = "hidden";
    }




  </script>

  <script>

// This script is explained line by line in depth in the following video:
// http://www.developphp.com/view.php?tid=1389

function computeLoan(){
  var p = document.getElementById('p').value;
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

  ///3rd row

  os3 = document.getElementById("os3");
  os3.innerHTML =((p)-(p/t))-62500*2;

  interestdue3 = document.getElementById("interestdue3");
  interestdue3.innerHTML =12945;

  pd3 = document.getElementById("pd3");
  pd3.innerHTML =(p/t);  

  tds3 = document.getElementById("tds3");
  tds3.innerHTML =1295;

  netinterest3 = document.getElementById("netinterest3");
  netinterest3.innerHTML =11651;

  netamtdue3 = document.getElementById("netamtdue3");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue3);
  netamtdue3.innerHTML = 74151;

  //4th row

  os4 = document.getElementById("os4");
  os4.innerHTML =((p)-(p/t))-62500*3;

  interestdue4 = document.getElementById("interestdue4");
  interestdue4.innerHTML =12421;

  pd4 = document.getElementById("pd4");
  pd4.innerHTML =(p/t);  

  tds4 = document.getElementById("tds4");
  tds4.innerHTML =1242;

  netinterest4 = document.getElementById("netinterest4");
  netinterest4.innerHTML =11179;

  netamtdue4 = document.getElementById("netamtdue4");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue4);
  netamtdue4.innerHTML = 73679;

  //5th row
  os5 = document.getElementById("os5");
  os5.innerHTML =((p)-(p/t))-62500*4;

  interestdue5 = document.getElementById("interestdue5");
  interestdue5.innerHTML =11466;

  pd5 = document.getElementById("pd5");
  pd5.innerHTML =(p/t);  

  tds5 = document.getElementById("tds5");
  tds5.innerHTML =1147;

  netinterest5 = document.getElementById("netinterest5");
  netinterest5.innerHTML =10319;

  netamtdue5 = document.getElementById("netamtdue5");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue5);
  netamtdue5.innerHTML = 72819;


  //6th row

  os6 = document.getElementById("os6");
  os6.innerHTML =((p)-(p/t))-62500*5;

  interestdue6 = document.getElementById("interestdue6");
  interestdue6.innerHTML =10171;

  pd6 = document.getElementById("pd6");
  pd6.innerHTML =(p/t);  

  tds6 = document.getElementById("tds6");
  tds6.innerHTML =1017;

  netinterest6 = document.getElementById("netinterest6");
  netinterest6.innerHTML =9154;

  netamtdue6 = document.getElementById("netamtdue6");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue6);
  netamtdue6.innerHTML = 71654;


  //7th row
  os7 = document.getElementById("os7");
  os7.innerHTML =((p)-(p/t))-62500*6;

  interestdue7 = document.getElementById("interestdue7");
  interestdue7.innerHTML =9555;

  pd7 = document.getElementById("pd7");
  pd7.innerHTML =(p/t);  

  tds7 = document.getElementById("tds7");
  tds7.innerHTML =955;

  netinterest7 = document.getElementById("netinterest7");
  netinterest7.innerHTML =8599;

  netamtdue7 = document.getElementById("netamtdue7");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue7);
  netamtdue7.innerHTML = 71099;

  //8th row
  os8 = document.getElementById("os8");
  os8.innerHTML =((p)-(p/t))-62500*7;

  interestdue8 = document.getElementById("interestdue8");
  interestdue8.innerHTML =8322;

  pd8 = document.getElementById("pd8");
  pd8.innerHTML =(p/t);  

  tds8 = document.getElementById("tds8");
  tds8.innerHTML =832;

  netinterest8 = document.getElementById("netinterest8");
  netinterest8.innerHTML =7490;

  netamtdue8 = document.getElementById("netamtdue8");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue8);
  netamtdue8.innerHTML = 69990;

  //9th row
  os9 = document.getElementById("os9");
  os9.innerHTML =((p)-(p/t))-62500*8;

  interestdue9 = document.getElementById("interestdue9");
  interestdue9.innerHTML =7644;

  pd9 = document.getElementById("pd9");
  pd9.innerHTML =(p/t);  

  tds9 = document.getElementById("tds9");
  tds9.innerHTML =764;

  netinterest9 = document.getElementById("netinterest9");
  netinterest9.innerHTML =6879;

  netamtdue9 = document.getElementById("netamtdue9");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue9);
  netamtdue9.innerHTML = 69379;

  //10th row

  os10 = document.getElementById("os10");
  os10.innerHTML =((p)-(p/t))-62500*9;

  interestdue10 = document.getElementById("interestdue10");
  interestdue10.innerHTML =6688;

  pd10 = document.getElementById("pd10");
  pd10.innerHTML =(p/t);  

  tds10 = document.getElementById("tds10");
  tds10.innerHTML =669;

  netinterest10 = document.getElementById("netinterest10");
  netinterest10.innerHTML =6020;

  netamtdue10 = document.getElementById("netamtdue10");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue2);
  netamtdue10.innerHTML = 68520;

  //11th row
  os11 = document.getElementById("os11");
  os11.innerHTML =((p)-(p/t))-62500*10;

  interestdue11 = document.getElementById("interestdue11");
  interestdue11.innerHTML =5363;

  pd11 = document.getElementById("pd11");
  pd11.innerHTML =(p/t);  

  tds11 = document.getElementById("tds11");
  tds11.innerHTML =536;

  netinterest11 = document.getElementById("netinterest11");
  netinterest11.innerHTML =4827;

  netamtdue11 = document.getElementById("netamtdue11");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue11);
  netamtdue11.innerHTML = 67327;

  //12th row
  os12 = document.getElementById("os12");
  os12.innerHTML =((p)-(p/t))-62500*11;

  interestdue12 = document.getElementById("interestdue12");
  interestdue12.innerHTML =4777;

  pd12 = document.getElementById("pd12");
  pd12.innerHTML =(p/t);  

  tds12 = document.getElementById("tds12");
  tds12.innerHTML =478;

  netinterest12 = document.getElementById("netinterest12");
  netinterest12.innerHTML =4300;

  netamtdue12 = document.getElementById("netamtdue12");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue12);
  netamtdue12.innerHTML = 66800;


  //13th row
  os13 = document.getElementById("os13");
  os13.innerHTML =((p)-(p/t))-62500*12;

  interestdue13 = document.getElementById("interestdue13");
  interestdue13.innerHTML =3699;

  pd13 = document.getElementById("pd13");
  pd13.innerHTML =(p/t);  

  tds13 = document.getElementById("tds13");
  tds13.innerHTML =370;

  netinterest13 = document.getElementById("netinterest13");
  netinterest13.innerHTML =3329;

  netamtdue13 = document.getElementById("netamtdue13");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue13);
  netamtdue13.innerHTML = 65829;


  //14th row
  os14 = document.getElementById("os14");
  os14.innerHTML =((p)-(p/t))-62500*13;

  interestdue14 = document.getElementById("interestdue14");
  interestdue14.innerHTML =2866;

  pd14 = document.getElementById("pd14");
  pd14.innerHTML =(p/t);  

  tds14 = document.getElementById("tds14");
  tds14.innerHTML =287;

  netinterest14 = document.getElementById("netinterest14");
  netinterest14.innerHTML =2580;

  netamtdue14 = document.getElementById("netamtdue14");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue14);
  netamtdue14.innerHTML = 65080;


  //15th row
  os15 = document.getElementById("os15");
  os15.innerHTML =((p)-(p/t))-62500*14;

  interestdue15 = document.getElementById("interestdue15");
  interestdue15.innerHTML =1849;

  pd15 = document.getElementById("pd15");
  pd15.innerHTML =(p/t);  

  tds15 = document.getElementById("tds15");
  tds15.innerHTML =185;

  netinterest15 = document.getElementById("netinterest15");
  netinterest15.innerHTML =1664;

  netamtdue15 = document.getElementById("netamtdue15");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue15);
  netamtdue15.innerHTML = 64164;


  //16th row
  os16 = document.getElementById("os16");
  os16.innerHTML =((p)-(p/t))-62500*15;

  interestdue16 = document.getElementById("interestdue16");
  interestdue16.innerHTML =955;

  pd16 = document.getElementById("pd16");
  pd16.innerHTML =(p/t);  

  tds16 = document.getElementById("tds16");
  tds16.innerHTML =96;

  netinterest16 = document.getElementById("netinterest16");
  netinterest16.innerHTML =860;

  netamtdue16 = document.getElementById("netamtdue16");
  // netamtdue.innerHTML = ((Math.round(p*r*n/365)/100)+(Math.round(p/t))-(Math.round(p*r*n/365)/100*0.1));

  var round =Math.round(netamtdue16);
  netamtdue16.innerHTML = 63360;


}


<script>
function showTable(){
  document.getElementById('table').style.visibility = "visible";
}
function hideTable(){
  document.getElementById('table').style.visibility = "hidden";
}
</script>



</script>

<script>
  function showDays(){

   var startminus = $('.ls').val();
   var start = $('.onedate').val();
   var end2 = $('.twodate').val();
   var end3 = $('.threedate').val();
   var end4 = $('.fourdate').val();
   var end5 = $('.fivedate').val();

   var end6 = $('.sixdate').val();
   var end7 = $('.sevendate').val();
   var end8 = $('.eightdate').val();
   var end9 = $('.ninedate').val();
   var end10 = $('.tendate').val();

   var end11 = $('.elevendate').val();
   var end12 = $('.twelvedate').val();
   var end13 = $('.thirteendate').val();
   var end14 = $('.fourteendate').val();
   var end15 = $('.fifteendate').val();

   var end16 = $('.sixteendate').val();
   var end17 = $('.seventeendate').val();
   var end18 = $('.eighteendate').val();
   var end19 = $('.nineteendate').val();
   var end20 = $('.twentydate').val();

   var end21 = $('.twentyonedate').val();
   var end22 = $('.twentytwodate').val();
   var end23 = $('.twentythreedate').val();
   var end24 = $('.twentyfourdate').val();
   var end25 = $('.twentyfivedate').val();



   var fisrtDay = new Date(startminus);
   var startDay = new Date(start);
   var endDay2 = new Date(end2);
   var endDay3 = new Date(end3)
   var endDay4 = new Date(end4)
   var endDay5 = new Date(end5)

   var endDay6 = new Date(end6);
   var endDay7 = new Date(end7);
   var endDay8 = new Date(end8)
   var endDay9 = new Date(end9)
   var endDay10 = new Date(end10)


   var endDay11 = new Date(end11);
   var endDay12 = new Date(end12);
   var endDay13 = new Date(end13)
   var endDay14 = new Date(end14)
   var endDay15 = new Date(end15)

   var endDay16 = new Date(end16);
   var endDay17 = new Date(end17);
   var endDay18 = new Date(end18);
   var endDay19 = new Date(end19);
   var endDay20 = new Date(end20);

   var endDay21 = new Date(end21);
   var endDay22 = new Date(end22);
   var endDay23 = new Date(end23);
   var endDay24 = new Date(end24);
   var endDay25 = new Date(end25);


   var millisecondsPerDay = 1000 * 60 * 60 * 24;


   var millisBetweenls = startDay.getTime() - fisrtDay.getTime();
   var ls = millisBetweenls / millisecondsPerDay;

   var millisBetween = endDay2.getTime() - startDay.getTime();
   var days = millisBetween / millisecondsPerDay;

   var millisBetween2 = endDay3.getTime() - endDay2.getTime();
   var days2 = millisBetween2 / millisecondsPerDay;

   var millisBetween3 = endDay4.getTime() - endDay3.getTime();
   var days3 = millisBetween3 / millisecondsPerDay;

   var millisBetween4 = endDay5.getTime() - endDay4.getTime();
   var days4 = millisBetween4 / millisecondsPerDay;


     /////////////////////////////////////////////////////////////////////////////
     var millisBetween5 = endDay6.getTime() - endDay5.getTime();
     var days5 = millisBetween5 / millisecondsPerDay;

     var millisBetween6 = endDay7.getTime() - endDay6.getTime();
     var days6 = millisBetween6 / millisecondsPerDay;

     var millisBetween7 = endDay8.getTime() - endDay7.getTime();
     var days7 = millisBetween7 / millisecondsPerDay;

     var millisBetween8 = endDay9.getTime() - endDay8.getTime();
     var days8 = millisBetween8 / millisecondsPerDay;


     ///////////////////////////////////////////////////////////////////////////////
     var millisBetween9 = endDay10.getTime() - endDay9.getTime();
     var days9 = millisBetween9 / millisecondsPerDay;

     var millisBetween10 = endDay11.getTime() - endDay10.getTime();
     var days10 = millisBetween10 / millisecondsPerDay;

     var millisBetween11 = endDay12.getTime() - endDay11.getTime();
     var days11 = millisBetween11 / millisecondsPerDay;

     var millisBetween12 = endDay13.getTime() - endDay12.getTime();
     var days12 = millisBetween12 / millisecondsPerDay;


     ///////////////////////////////////////////////////////////////////////////////
     var millisBetween13 = endDay14.getTime() - endDay13.getTime();
     var days13 = millisBetween13 / millisecondsPerDay;

     var millisBetween14 = endDay15.getTime() - endDay14.getTime();
     var days14 = millisBetween14 / millisecondsPerDay;

     var millisBetween15 = endDay16.getTime() - endDay15.getTime();
     var days15 = millisBetween15 / millisecondsPerDay;

     var millisBetween16 = endDay17.getTime() - endDay16.getTime();
     var days16 = millisBetween16 / millisecondsPerDay;

     ///////////////////////////////////////////////////////////////////////////////
     var millisBetween17 = endDay18.getTime() - endDay17.getTime();
     var days17 = millisBetween17 / millisecondsPerDay;

     var millisBetween18 = endDay19.getTime() - endDay18.getTime();
     var days18 = millisBetween18 / millisecondsPerDay;

     var millisBetween19 = endDay20.getTime() - endDay19.getTime();
     var days19 = millisBetween19 / millisecondsPerDay;

     /////////////////////////////////////////////////////////////////////////////////

     var millisBetween20 = endDay21.getTime() - endDay20.getTime();
     var days20 = millisBetween20 / millisecondsPerDay;

     var millisBetween21 = endDay22.getTime() - endDay21.getTime();
     var days21 = millisBetween21 / millisecondsPerDay;

     var millisBetween22 = endDay23.getTime() - endDay22.getTime();
     var days22 = millisBetween22 / millisecondsPerDay;

     var millisBetween23 = endDay24.getTime() - endDay23.getTime();
     var days23 = millisBetween23 / millisecondsPerDay;





      // Round down.
       // alert( Math.floor(days));

       ls = document.getElementById("ls");
       ls.innerHTML =millisBetweenls / millisecondsPerDay;    

       days = document.getElementById("days");
       days.innerHTML =millisBetween / millisecondsPerDay;

       days2 = document.getElementById("days2");
       days2.innerHTML = millisBetween2 / millisecondsPerDay;

       days3 = document.getElementById("days3");
       days3.innerHTML = millisBetween3 / millisecondsPerDay;

       days4 = document.getElementById("days4");
       days4.innerHTML = millisBetween4 / millisecondsPerDay;

    ///////////////////////////////////////////////////////////////////////////////////////

    days5 = document.getElementById("days5");
    days5.innerHTML =millisBetween5 / millisecondsPerDay;

    days6 = document.getElementById("days6");
    days6.innerHTML = millisBetween6 / millisecondsPerDay;

    days7 = document.getElementById("days7");
    days7.innerHTML = millisBetween7 / millisecondsPerDay;

    days8 = document.getElementById("days8");
    days8.innerHTML = millisBetween8 / millisecondsPerDay;


    ///////////////////////////////////////////////////////////////////////////////////////

    days9 = document.getElementById("days9");
    days9.innerHTML =millisBetween9 / millisecondsPerDay;

    days10 = document.getElementById("days10");
    days10.innerHTML = millisBetween10 / millisecondsPerDay;

    days11 = document.getElementById("days11");
    days11.innerHTML = millisBetween11 / millisecondsPerDay;

    days12 = document.getElementById("days12");
    days12.innerHTML = millisBetween12 / millisecondsPerDay;


    ////////////////////////////////////////////////////////////////////////////////////////

    days13 = document.getElementById("days13");
    days13.innerHTML =millisBetween13 / millisecondsPerDay;

    days14 = document.getElementById("days14");
    days14.innerHTML = millisBetween14 / millisecondsPerDay;

    days15 = document.getElementById("days15");
    days15.innerHTML = millisBetween15 / millisecondsPerDay;

    days16 = document.getElementById("days16");
    days16.innerHTML = millisBetween16 / millisecondsPerDay;


    ////////////////////////////////////////////////////////////////////////////////////////
    days17 = document.getElementById("days17");
    days17.innerHTML =millisBetween17 / millisecondsPerDay;

    days18 = document.getElementById("days18");
    days18.innerHTML = millisBetween18 / millisecondsPerDay;

    days19 = document.getElementById("days19");
    days19.innerHTML = millisBetween19 / millisecondsPerDay;

    days20 = document.getElementById("days20");
    days20.innerHTML = millisBetween20 / millisecondsPerDay;


    //////////////////////////////////////////////////////

    days21 = document.getElementById("days21");
    days21.innerHTML =millisBetween21 / millisecondsPerDay;

    days22 = document.getElementById("days22");
    days22.innerHTML = millisBetween22 / millisecondsPerDay;

    days23 = document.getElementById("days23");
    days23.innerHTML = millisBetween23 / millisecondsPerDay;

    days24 = document.getElementById("days24");
    days24.innerHTML = millisBetween24 / millisecondsPerDay;


  }
</script>





