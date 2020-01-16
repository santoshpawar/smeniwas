<style type="text/css" media="screen">
textarea,
input,
select {
  outline: none;
  -webkit-appearance: none;
  border: 0px;
  outline: 0px;
}
thead{display: table-header-group !importnat ;}
tfoot {display: table-row-group !importnat; }
tr {page-break-inside: avoid !importnat; }
</style>
<!doctype html>
<!--[if IE 7 ]>
  <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>
  <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>
  <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!-->
  <html lang="en-US">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />
    <title>SME Niwas</title>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{{URL::asset( "/css/bootstrap.css")}}} type="text/css" media="all" />
    <link rel="stylesheet" href={{{URL::asset( "/css/bootstrap-theme.css")}}} type="text/css" media="all" />
    <link rel="stylesheet" href={{{URL::asset( "/css/font-awesome.css")}}} type="text/css" media="all" />
  <link rel="stylesheet" href={{{URL::asset( "/css/sme.css")}}} type="text/css" media="all" /> 
  <link rel="stylesheet" href='{{{URL::asset("/css/dataTables.tableTools.css")}}}' type="text/css" media="all" /> 

  <link rel="stylesheet" href={{{URL::asset( "/css/dataTables.bootstrap.css")}}} type="text/css" media="all" />
  <script type='text/javascript' src={{{URL::asset( '/js/jquery-1.11.2.min.js')}}}></script>
  
  <style type="text/css">
    --
    }
    }
      {
        {
        --.content {
          --
        }
      }
        {
          {
          --overflow: hidden;
          --
        }
      }
        {
          {
          --page-break-inside: avoid;
          --
        }
      }
        {
          {
          --page-break-after: avoid;
          --
        }
      }
        {
          {
          --
        }
        --
      }
    }
      {
        {
        --
      </style>
    </head>
    <body>
      <!--header:start-->
      <!--header:end-->
      <div class="row">
       
    {{--
      <p>&nbsp;</p>--}}
    </div>
    <div class="col-md-12">
    {{--
      <div class="tab-content " style="padding:10px;">--}}
        <center>

         <img style="background-color: white;width:219px;float: right;" src="http://ec2-34-216-228-243.us-west-2.compute.amazonaws.com/images/smeLogo.png">
          <p class="user_name">Credit Appraisal Memo -     {!!  @$name_of_firm !!}</p>
       </center>
        
       <div id="CompanyBackground">
       
        <div class="col-md-12">
          <div class="panel panel-success" style="width: 100%;border-color: #333;">
            <div class="panel-heading">User Details</div>
            {{--
              <div style="padding-left: 5px;padding-top: 10px;">--}}
                <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                  <table class="table table-bordered">
                    <tr>
                      <td>
                         <div style=" width: 200px;">
                          {!! Form::label('name_of_firm','Name of Firm: ') !!}<br>
                          {!!  @$name_of_firm !!}
                        </div>
                      </td>
                      <td>
                        <div>
                          {!! Form::label('firm_pan','PAN No of Firm: ') !!}<br>
                          {{  @$firm_pan }}

                        </div>
                      </td>
                      <td>
                        <div>
                          {!! Form::label('entity_type','Type of Legal Entity: ') !!}<br>
                          {!! Form::text('owner_entity_type',@$chosenEntity, ['id' => 'owner_entity_type'])
                          !!}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div style=" width: 10px;">
                         {!! Form::label('sector','Sector (Manufacturing/Services)') !!}<br>
                         {!! Form::select('com_industry_segment', $industryTypes, null, [ 'id' => 'industry_segment'])!!}
                       </div>
                     </td>  

                     <td>
                      <div>
                        {!! Form::label('gst','Customers (B2B, B2C)') !!}<br>
                        @if(isset($praposalBackground->com_business_type))
                        {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], $praposalBackground->com_business_type, ['id'=>'com_business_type' ,$setDisable])!!}
                        @else
                        {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], null, ['id'=>'com_business_type' ,'disabled' => true])!!}
                        @endif
                      </div>
                    </td>
                     <td>
                     <div style=" width: 200px;" >
                       {!! Form::label('gst','Business Address') !!}<br>
                       {{  @$userProfileFirm->address }}
                     </div>
                   </td>
                  </tr>
               
                  <tr class="borrowerExistingLoan">
                    <td colspan="3" > <center><b>Exposure Details</b> </center>
                    </td>
                  </tr>
                  <tr class="borrowerExistingLoan">
                   
                  
                   <td colspan="2">
                    <div>
                     {!! Form::label('Loan Amount','Loan Amount') !!}<label><span class="small"> ( <i class="fa fa-rupee"></i> Lacs )</span></label><br>
                     <label>Existing Amount : </label>             {{ (isset($praposalBackground->amount) && isset($praposalBackground->amount))? @$praposalBackground->amount : null }} <br>
                     <label>Proposal Amount :</label>            {{ (isset($praposalBackground->praposedAmount) && isset($praposalBackground->praposedAmount))? @$praposalBackground->praposedAmount : null }} <br>
                     <label>Total  Amount :</label>{{ (isset($praposalBackground->finalAmount) && isset($praposalBackground->finalAmount))? @$praposalBackground->finalAmount : null }}
                   </div>
                 </td>
                 <td>
                   <div>
                    {!! Form::label('gst','Tenor') !!}<br>
                    <label>Existing Tenor :</label> {{  (isset($praposalBackground->existingTenor) && isset($praposalBackground->existingTenor))? @$praposalBackground->existingTenor : null }}   <br>
                    <label> Proposal Tenor :</label> {{ (isset($praposalBackground->praposedTenor) && isset($praposalBackground->praposedTenor))? @$praposalBackground->praposedTenor : null }}  <br>
                    {{--   <label>Total Tenor : </label> {!! Form::text('totalTenor', (isset($praposalBackground->totalTenor) && isset($praposalBackground->totalTenor))? @$praposalBackground->totalTenor : null, array( 'id'=>'totalTenor', 'placeholder'=>'Total', $setDisable)) !!}</label>  --}}
                  </div>
                </td>
              </tr>
              <tr class="borrowerExistingLoan">
                <td>
                  <div>
                    {!! Form::label('Interest Rate','Interest Rate') !!}<br>
                    Existing Interest Rate :      {!! (isset($praposalBackground->existingInterestRate) && isset($praposalBackground->existingInterestRate))? @$praposalBackground->existingInterestRate : null  !!}<br>
                    Proposal Interest Rate :    {!! (isset($praposalBackground->praposedInterestRate) && isset($praposalBackground->praposedInterestRate))? @$praposalBackground->praposedInterestRate : null !!}<br>
                    {{-- <label>Total Interest Rate :   {!! Form::text('totalInterestRate', (isset($praposalBackground->totalInterestRate) && isset($praposalBackground->totalInterestRate))? @$praposalBackground->totalInterestRate : null, array( 'id'=>'totalInterestRate', 'placeholder'=>'Total', $setDisable)) !!}</label> --}}
                  </div>
                </td>
                <td>
                  <div>
                   {!! Form::label('Any delays in servicing in last 6 mths','Any delays in servicing in last 6 mths') !!}<br>           
                   @if(@$praposalBackground->dealy == '1')
                   {{ 'Yes' }}
                   @else
                   {{ 'No' }}
                   @endif
                 </label>
               </div>
             </td>
             <td>
              <div>
               {!! Form::label('Date of  disbursement', 'Date of  disbursement') !!}<br>
               {!! Form::text('disbursement_date', (isset($praposalBackground->disbursement_date) && isset($praposalBackground->disbursement_date))? @$praposalBackground->disbursement_date : null, array('class' => 'readonly-text', 'id'=>'date', 'placeholder'=>'', $setDisable)) !!}
             </div>
           </td>
         </tr>
       </span>
      
         <tr>
           <td colspan="3">
             {!! Form::label('Security','Security') !!}<br>
             {{  @$praposalBackground->security }}
           </td>
         </tr>
         <tr>
           <td colspan="3">
            <div>
              {!! Form::label('Purpose of Loan','Purpose of Loan') !!}<br>
              {{ @$praposalBackground->loan_purpose }}
            </div>
          </td>
        </tr>  
      </tbody>
    </table>
  </div>
</div>
{{-- <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p>
  --}}
 

<div class="row"  style="page-break-after: always;  margin-top: 150px; ">
 <div class="col-md-12">
  <div class="panel panel-success" style="width: 100%;border-color: #333;">
    <div class="panel-heading">Comments on Proposal</div>
            {{--
              <div style="padding-left: 5px;padding-top: 10px;">--}}
               <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                 <table class="table table-bordered">
                   <tr>
                    <td>
                      <div>
                        {!! Form::label('promoterBackground', 'Background of promoters') !!}<br>
                        @if(isset($praposalDetails->othr_eduprofdegree))
                        {!! Form::select('othr_eduprofdegree', [''=>'Select Education','1'=>'Doctor/Engineer', '2'=>'CA/MBA/Lawyer','3'=>'Graduate','4'=>'Non-Graduate'], $praposalDetails->othr_eduprofdegree, ['class' => 'readonly-text','id'=>'othr_eduprofdegree','data-mandatory'=>'M' ,$setDisable])!!}
                        @else
                        {!! Form::select('othr_eduprofdegree', [''=>'Select Education','1'=>'Doctor/Engineer', '2'=>'CA/MBA/Lawyer','3'=>'Graduate','4'=>'Non-Graduate'], null, ['id'=>'othr_eduprofdegree','data-mandatory'=>'M' ,$setDisable])!!}
                        @endif 
                      </div>
                    </td>
                    <td> 
                      <div>
                        {!! Form::label('lastAuditedTurnover','Last Audited  Turnover') !!} <label><span class="small"> ( <i class="fa fa-rupee"></i> Lacs )</span></label><br>
                        {!! Form::text('lastAuditedTurnover', isset($loanUserProfile->latest_turnover) ? $loanUserProfile->latest_turnover : null, array('class' => 'readonly-text', 'id'=>'lastAuditedTurnover', 'placeholder'=>'', $setDisable)) !!}
                      </div>
                    </td>
                     <td>
                    <div style="width: 200">
                     {!! Form::label('gst','Business Address') !!}<br>
                     <span style="font-size:15px">{!! @$userProfileFirm->address !!}</span>
                   </div>
                 </td>
                   
                 </tr>
                  <tr>
                    <td width="200px">
                      {!! Form::label('promoterBackground','Background of promoters (education, family , experience etc)') !!}<br>
                      @if(isset($praposalDetails->othr_eduprofdegree))
                      {!! Form::select('othr_eduprofdegree', [''=>'Select Education','1'=>'Doctor/Engineer', '2'=>'CA/MBA/Lawyer','3'=>'Graduate','4'=>'Non-Graduate'], $praposalDetails->othr_eduprofdegree, ['class' => 'readonly-text','id'=>'othr_eduprofdegree','data-mandatory'=>'M' ,'disabled' => true])!!}
                      @else
                      {!! Form::select('othr_eduprofdegree', [''=>'Select Education','1'=>'Doctor/Engineer', '2'=>'CA/MBA/Lawyer','3'=>'Graduate','4'=>'Non-Graduate'], null, ['id'=>'othr_eduprofdegree','data-mandatory'=>'M' ,'disabled' => true])!!}
                      @endif 
                    </td>
                    <td> 
                      {!! Form::label('lastAuditedTurnover','Last Audited  Turnover') !!} <label><span class="small"> ( <i class="fa fa-rupee"></i> Lacs )</span></label><br>
                      {!!  isset($loanUserProfile->latest_turnover) ? $loanUserProfile->latest_turnover : null !!}
                    </td>
                    <td> 
                     {!! Form::label('vintageBusiness','Vintage of business  (yrs)') !!}<br>
                   
                     @if($praposalDetails->com_business_type=='4') {{ '> 12 yrs' }}
                        @elseif($praposalDetails->com_business_type=='3') {{ '7-12 yrs' }}
                        @elseif($praposalDetails->com_business_type=='2') {{ '3-7 yrs' }}
                        @elseif($praposalDetails->com_business_type=='1') {{ '< 3 yrs' }}
                        @endif
                   </td>
                 </tr>
                 <tr>
                   <td colspan="">
                    {!! Form::label('totalBorrowing6Month','Total Borrowing in last 6 mths (Amt and lenders)') !!}<label><span class="small"> ( <i class="fa fa-rupee"></i> Lacs )</span></label><br>
                    @if(isset($praposalDetails->totalBorrowing6Month))
                    {{ $praposalDetails->totalBorrowing6Month }}  
                    @endif
                  </td>
                  <td>
                    {!! Form::label('amountHighCostGT16Loans','Amount of high cost (> 16%) loans borrowed') !!}<label><span class="small"> ( <i class="fa fa-rupee"></i> Lacs )</span></label><br>
                    @if(isset($praposalDetails->amountHighCostGT16Loans))
                    {{ $praposalDetails->amountHighCostGT16Loans }}  
                    @endif
                  </td>
                   <td>
                  <div>
                    {!! Form::label('gst','Niwas Branch and dealing officer') !!}<br>
                    {!! Form::text('niwas_branch_officer', $praposalBackground->niwas_branch_officer, array('class' => 'readonly-text', 'id'=>'niwas_branch_officer', 'placeholder'=>'', $setDisable)) !!}
                  </div>
                </td>
                </tr>
                <tr>
                  <td colspan="3" style="word-wrap: break-word"> 
                    {!! Form::label('briefProducts','Brief description of Products/Services/business') !!}<br>
                    @if(isset($praposalDetails->briefProducts))
                    {{ $praposalDetails->briefProducts }} 
                    @endif
                  </td>
                </tr>
                <tr>
                 <td colspan="3"  style="word-wrap: break-word"> 
                   {!! Form::label('briefCustomers','Brief description of Customers') !!}<br>
                   {!! (isset($praposalDetails->briefCustomers) && isset($praposalDetails->briefCustomers))? $praposalDetails->briefCustomers : null !!}
                 </td>
               </tr>
               <tr>
                 <td colspan="3" > 
                   {!! Form::label('historyEquityInfusion','History of Equity infusion  (promoter and VC if any)') !!}<br>
                   {!! (isset($praposalDetails->historyEquityInfusion) && isset($praposalDetails->historyEquityInfusion))? $praposalDetails->historyEquityInfusion : null !!}
                 </td>
               </tr>
               <tr>
                 <td colspan="3"  style="word-wrap: break-word">
                   {!! Form::label('commentaryProfitability','Commentary on profitability') !!}<br>
                   {!! (isset($praposalDetails->commentaryProfitability) && isset($praposalDetails->commentaryProfitability))? $praposalDetails->commentaryProfitability : null !!}
                 </td>  
               </tr>
               <tr>
                 <td colspan="3" >
                  {!! Form::label('commentaryLiquidityWC','Commentary on Liquidity/ WC') !!}<br>
                  {!! (isset($praposalDetails->commentaryLiquidityWC) && isset($praposalDetails->commentaryLiquidityWC))? $praposalDetails->commentaryLiquidityWC : null  !!}
                </td>
              </tr>
              <tr>
                <td colspan="3" >
                 {!! Form::label('commentaryBalanceSheet','Commentary on Balance sheet') !!}<br>
                 {!!  (isset($praposalDetails->commentaryBalanceSheet) && isset($praposalDetails->commentaryBalanceSheet))? $praposalDetails->commentaryBalanceSheet : null  !!}
               </td>
             </tr>
           </table>
         </div>
       </div>
       <div class="row"  style="page-break-after: always;  margin-top: 700px; ">
         <div class="col-md-12">
          <div class="panel panel-success" style="width: 100%;border-color: #333;">
            <div class="panel-heading">Financial Summery</div>
            {{--
              <div style="padding-left: 5px;padding-top: 10px;">--}}
               <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                 <table class="table table-bordered">
                  <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                   <?php
                   $counter = 0;
                   $isAnyThresholdBreached = false;
                   $isAnyExpressionInvalid = false;
                   unset($bl_year['FY 2014-15']);
                 //dd($blyear);
                   ?>
                   <table class="table table-bordered">
                    <tr><td colspan="3"></td></tr>
                    <tr>
                      @foreach($bl_year as $blyear)
                      <td style="width: 33%" align="center">
                        {!! Form::label($blyear, $blyear) !!}
                        <table>
                          <tr>
                            <td>
                              <table class="table table-bordered">
                                <tr>
                                  <td>Net Revenue/Sales</td>
                                  <td>
                                    <?php  
                                    if($blyear == 'FY 2017-18(Prov)'){
                                      echo $financialProfitLoss[0]->net_sales ;  
                                    }elseif($blyear == 'FY 2016-17'){
                                      echo   $financialProfitLoss[1]->net_sales ;
                                    }else{
                                     echo  $financialProfitLoss[2]->net_sales ;
                                   }
                                   ?>
                                 </td>
                               </tr>
                               <tr>
                                <td>
                                  EBITDA
                                </td>
                                <td>
                                 <?php  
                                 if($blyear == 'FY 2017-18(Prov)'){
                                  echo $financialProfitLoss[0]->ebitda ;  
                                }elseif($blyear == 'FY 2016-17'){
                                  echo   $financialProfitLoss[1]->ebitda ;
                                }else{
                                  echo   $financialProfitLoss[2]->ebitda ;
                                }
                                ?>
                              </td>
                            </tr><tr>
                              <td>PAT</td>
                              <td>  <?php  
                              if($blyear == 'FY 2017-18(Prov)'){
                                echo $financialProfitLoss[0]->pat ;  
                              }elseif($blyear == 'FY 2016-17'){
                                echo   $financialProfitLoss[1]->pat ;
                              }else{
                                echo   $financialProfitLoss[2]->pat ;
                              }
                              ?>
                            </td>
                          </tr><tr>
                            <td>Total Term Debt</td>
                            <td>
                              <?php  
                              if(@$blyear == 'FY 2017-18'){   
                                        print_r(@$financialDataRecords[0]->curr_long_term_debt + @$financialDataRecords[0]->long_term_borrowings);  ////5+30 = 35 
                                      }elseif($blyear == 'FY 2016-17'){
                                       print_r(@$financialDataRecords[1]->curr_long_term_debt + @$financialDataRecords[1]->long_term_borrowings); // 3+30=33
                                     }else{
                                    print_r(@$financialDataRecords[2]->curr_long_term_debt + @$financialDataRecords[2]->long_term_borrowings);  //  10+1=11
                                  }
                                  ?> 
                                </td>
                              </tr><tr>
                                <td>Total short term Borrowing</td>
                                <td> 
                                  <?php  
                                  if(@$blyear == 'FY 2017-18'){
                                    print_r(@$financialDataRecords[0]->short_term_loans );
                                  }elseif(@$blyear == 'FY 2016-17'){
                                   print_r(@$financialDataRecords[1]->short_term_loans );
                                 }else{
                                  print_r(@$financialDataRecords[2]->short_term_loans ); 
                                }
                                ?>
                              </td>
                            </tr><tr>
                              <td>Total Debt</td>
                              <td> 
                                <?php  
                                if(@$blyear == 'FY 2017-18'){
                                        print_r(@$financialDataRecords[0]->curr_long_term_debt + @$financialDataRecords[0]->long_term_borrowings + @$financialDataRecords[0]->short_term_loans  ); //////5+30+ = 35 
                                      }elseif(@$blyear == 'FY 2016-17'){
                                       print_r(@$finsancialDataRecords[1]->curr_long_term_debt + @$financialDataRecords[1]->long_term_borrowings + @$financialDataRecords[1]->short_term_loans );
                                     }else{
                                      print_r(@$financialDataRecords[2]->curr_long_term_debt + @$financialDataRecords[2]->long_term_borrowings + @$financialDataRecords[2]->short_term_loans ); 
                                    }
                                    ?>
                                  </td>
                                </tr><tr>
                                  <td>Total Networth/Equity</td>
                                  <td>
                                    <?php
                                    if($blyear == 'FY 2017-18'){
                                      print_r(@$financialDataRecords[0]->net_worth );
                                    }elseif($blyear == 'FY 2016-17'){
                                     print_r(@$financialDataRecords[1]->net_worth );
                                   }else{
                                    print_r(@$financialDataRecords[2]->net_worth ); 
                                  }
                                  ?>
                                </td>
                              </tr><tr>
                                <td>Net Cashflow From Operations</td>
                                <td>
                                 <?php 
                                 if($blyear == 'FY 2017-18'){
                                   print_r(@$fromCashflowTable['FY 2017-18'][79]->value);  
                                 }elseif($blyear == 'FY 2016-17'){
                                   print_r(@$fromCashflowTable['FY 2016-17'][79]->value);
                                 }else{
                                  if(isset($fromCashflowTable['FY 2015-16'][79]->value)){
                                   print_r(@$fromCashflowTable['FY 2015-16'][79]->value);
                                 }else{
                                  echo "";
                                }
                              }
                              ?>
                            </td>
                          </tr><tr>
                            <td>Current Ratio</td>
                            <td> 
                              <?php    
                              if($blyear == 'FY 2017-18'){
                                @$fullValue=(@$financialDataRecords[0]->total_current_assets / @$financialDataRecords[0]->total_current_liabilities);
                                print_r(round($fullValue, 2));
                              }elseif(@$blyear == 'FY 2016-17'){
                               @$fullValue1=(@$financialDataRecords[1]->total_current_assets / @$financialDataRecords[1]->total_current_liabilities);
                               print_r(round(@$fullValue1, 2));
                             }else{
                               @$fullValue2=(@$financialDataRecords[2]->total_current_assets / @$financialDataRecords[2]->total_current_liabilities);
                               print_r(round(@$fullValue2, 2));
                             }
                             ?>
                           </td>
                         </tr>
                         <tr>
                          <td>Receivable Days</td>
                          <td>
                            <?php    
                            if($blyear == 'FY 2017-18'){
                             foreach ($ratios as  $value) {
                               if($value['name']=='receivable_days' && $value['period']=='FY 2017-18'){
                                 echo $value['value'];
                               }
                             }
                           }elseif($blyear == 'FY 2016-17'){
                             foreach ($ratios as  $value) {
                               if($value['name']=='receivable_days' && $value['period']=='FY 2016-17'){
                                 echo $value['value'];
                               }
                             }
                           }else{
                             foreach ($ratios as  $value) {
                               if($value['name']=='receivable_days' && $value['period']=='FY 2015-16'){
                                 echo $value['value'];
                               }
                             }
                           }
                           ?> </td>
                         </tr><tr>
                          <td>Inventory Days</td>
                          <td> 
                            <?php    


                            if($blyear == 'FY 2017-18'){
                             foreach ($ratios as  $value) {
                               if($value['name']=='inventory_days' && $value['period']=='FY 2017-18'){
                                 echo $value['value'];
                               }
                             }

                           }elseif($blyear == 'FY 2016-17'){
                             foreach ($ratios as  $value) {
                               if($value['name']=='inventory_days' && $value['period']=='FY 2016-17'){
                                 echo $value['value'];
                               }
                             }
                           }else{
                             foreach ($ratios as  $value) {
                               if($value['name']=='inventory_days' && $value['period']=='FY 2015-16'){
                                 echo $value['value'];
                               }
                             }
                           }


                           ?> </td>
                         </tr><tr>
                          <td>TOL/TNW ratio</td>
                          <td>
                            <?php    
                            if($blyear == 'FY 2017-18'){
                             foreach ($ratios as  $value) {
                               if($value['name']=='tol_total_shareholders_funds' && $value['period']=='FY 2017-18'){
                                 echo $value['value'];
                               }
                             }
                           }elseif($blyear == 'FY 2016-17'){
                             foreach ($ratios as  $value) {
                               if($value['name']=='tol_total_shareholders_funds' && $value['period']=='FY 2016-17'){
                                 echo $value['value'];
                               }
                             }
                           }else{
                             foreach ($ratios as  $value) {
                               if($value['name']=='tol_total_shareholders_funds' && $value['period']=='FY 2015-16'){
                                 echo $value['value'];
                               }
                             }
                           }
                           ?>
                         </td>
                       </tr><tr>
                        <td>Net Revenue/Total Assets</td>
                        <td>
                         <?php    
                         if($blyear == 'FY 2017-18'){
                           foreach ($ratios as  $value) {
                             if($value['name']=='net_revenue_total_assets' && $value['period']=='FY 2017-18'){
                               echo $value['value'];
                             }
                           }
                         }elseif($blyear == 'FY 2016-17'){
                           foreach ($ratios as  $value) {
                             if($value['name']=='net_revenue_total_assets' && $value['period']=='FY 2016-17'){
                               echo $value['value'];
                             }
                           }
                         }else{
                           foreach ($ratios as  $value) {
                             if($value['name']=='net_revenue_total_assets' && $value['period']=='FY 2015-16'){
                               echo $value['value'];
                             }
                           }
                         }

                         ?>
                       </td>
                     </tr><tr>
                      <td>Interest Coverage Ratio</td>
                      <td> 
                        <?php    
                        if($blyear == 'FY 2017-18'){
                          foreach ($ratios as  $value) {
                           if($value['name']=='interest_coverage_ratio' && $value['period']=='FY 2017-18'){
                             echo $value['value'];
                           }
                         }
                //echo @$ratios[14]->value ;  
                       }elseif($blyear == 'FY 2016-17'){
                        foreach ($ratios as  $value) {
                         if($value['name']=='interest_coverage_ratio' && $value['period']=='FY 2016-17'){
                           echo $value['value'];
                         }
                       }
                     }else{
                      foreach ($ratios as  $value) {
                       if($value['name']=='interest_coverage_ratio' && $value['period']=='FY 2015-16'){
                         echo $value['value'];
                       }
                     }
                   }  
                   ?>
                 </td>
               </tr><tr>
                <td>EBITDA Margin(%)</td>
                <td><?php  
                if($blyear == 'FY 2017-18'){
                 foreach ($ratios as  $value) {
                   if($value['name']=='ebitda_netrevenue' && $value['period']=='FY 2017-18'){
                     echo $value['value'];
                   }
                 }
               }elseif($blyear == 'FY 2016-17'){
                 foreach ($ratios as  $value) {
                   if($value['name']=='ebitda_netrevenue' && $value['period']=='FY 2016-17'){
                     echo $value['value'];
                   }
                 }
               }else{
                 foreach ($ratios as  $value) {
                   if($value['name']=='ebitda_netrevenue' && $value['period']=='FY 2015-16'){
                     echo $value['value'];
                   }
                 }
               } 

               ?> </td>
             </tr>
           </table>
         </td>
       </tr>
     </table>
   </td>
   @endforeach
 </tr>
</table>
</div>
</div>
<div class="row"  style="page-break-after: always;  margin-top: 700px; ">
 <div class="col-md-12">
  <div class="panel panel-success" style="width: 100%;border-color: #333;">
    <div class="panel-heading">Financial Checklist</div>
            {{--
              <div style="padding-left: 5px;padding-top: 10px;">--}}
               <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                 <table class="table table-bordered">
                  <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                    <tr>
                      <td>
                        {!! Form::label('typeofEntity', 'Type of Entity') !!}
                      </td>
                      <td>   
                        @if(isset($praposalChecklist))
                        {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], $praposalChecklist->com_business_type, ['class' => 'form-control','class' => 'readonly-text','id'=>'com_business_type','data-mandatory'=>'M'  ])!!}
                        @else
                        {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], null, ['class' => 'form-control','id'=>'com_business_type','class' => 'readonly-text','data-mandatory'=>'M'  ])!!}
                        @endif
                      </td> 
                      <td>   
                        {!! Form::label('businessAddress','Business Address') !!}
                      </td>
                      <td>
                         <div style="width: 200">
                             {!! @$userProfileFirm->address  !!}
                        </div>
                         
                      </td>
                    </tr>
                    <tr>
                      <td>
                        {!! Form::label('vintage','Vintage of business  (yrs)') !!}
                      </td>
                      <td>
                        @if($praposalChecklist->com_co_business_old=='4') {{ '> 12 yrs' }}
                        @elseif($praposalChecklist->com_co_business_old=='3') {{ '7-12 yrs' }}
                        @elseif($praposalChecklist->com_co_business_old=='2') {{ '3-7 yrs' }}
                        @elseif($praposalChecklist->com_co_business_old=='1') {{ '< 3 yrs' }}
                        @endif
                      </td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>
                        {!! Form::label('latestTurnover','Latest Turnover (Rs lacs)') !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                      </td>
                      <td>
                       {!!  isset($loanUserProfile->latest_turnover) ? $loanUserProfile->latest_turnover : null !!}
                     </td>
                     <td>
                       {!! Form::label('cibil','CIBIL Score of Promoter') !!}
                     </td>
                     <td>
                      {!!  isset($praposalChecklist->othr_cibilscore) ? $praposalChecklist->othr_cibilscore : null  !!}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {!! Form::label('3yearsFinancials','3 year financials available (yes / no)') !!}
                    </td>
                    <td>
                      <b style="text-transform: capitalize;">
                       {{ isset($praposalChecklist->threeYearsFinancials) ? $praposalChecklist->threeYearsFinancials : null }} </b>
                     </td>
                     <td>
                      {!! Form::label('profitableLast2Years','Profitable in last 2 yrs (yes/no)') !!}
                    </td>
                    <td>
                     <b style="text-transform: capitalize;"> {{ isset($praposalChecklist->profitableLast2Years) ? $praposalChecklist->profitableLast2Years : 'No' }}</b>
                   </td>
                 </tr>
                 <tr>
                  <td>
                    <label>Any ratios breaching threshold. <br> If yes which one with value and brief reason </label>
                  </td>
                  <td>    
                   <b style="text-transform: capitalize;"> 
                    {{ isset($praposalChecklist->ratioBreaches) ? $praposalChecklist->ratioBreaches : 'No' }} 
                  </b><br>
                  @if($praposalChecklist->ratioBreaches=='yes') 
                  {{ $praposalChecklist->ratioBreachesDescrip }}
                  @endif
                </td>
              </tr>
              <tr>
                <td>
                  {!! Form::label('gst','Promoter KYC done (yes/no)') !!}
                  {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
                </td>
                <td>
                  {!! Form::radio('KYC', 'yes', $praposalChecklist->KYC == 'yes' ? 'checked' : '', ['id' => 'kycy']) !!}
                  <b style="text-transform: capitalize;"> 
                    {{ isset($praposalChecklist->KYC) ? $praposalChecklist->KYC : 'No' }} 
                  </b><br>
                </td>
                <td>
                  {!! Form::label('customerVisit','Customer Visit done  If yes by whom') !!}
                  {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
                </td>
                <td>
                  <b style="text-transform: capitalize;"> 
                    {{ isset($praposalChecklist->customerVisit) ? $praposalChecklist->customerVisit : 'No' }} 
                  </b><br>
                  @if($praposalChecklist->customerVisit=='yes') 
                  {{ $praposalChecklist->customerVisitDescription }}
                  @endif
                </td>
              </tr>
              <tr>
                <td>
                  {!! Form::label('creditCell','Credit call Done. If yes by whom ') !!}
                  {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
                </td>
                <td>
                 <b style="text-transform: capitalize;"> 
                  {{ isset($praposalChecklist->creditCell) ? $praposalChecklist->creditCell : 'No' }} 
                </b><br>
                @if($praposalChecklist->creditCell=='yes') 
                {{ $praposalChecklist->creditCellDescription }}
                @endif
              </td>
              <td>
                {!! Form::label('refrenceCheck','Reference check done. If yes by whom ') !!}
                {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
              </td>
              <td>
                <b style="text-transform: capitalize;"> 
                  {{ isset($praposalChecklist->refrenceCheck) ? $praposalChecklist->refrenceCheck : 'No' }} 
                </b><br>
                @if($praposalChecklist->refrenceCheck=='yes') 
                {{ $praposalChecklist->refreanceCheckDescrip }}
                @endif
              </td>
            </tr>
            <tr>
              <td>
                <label>Bank statements available (yes/no). <br> If yes indicate no  <br> of cheque bounces in 12 months'</label>
                {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
              </td>
              <td>
                <b style="text-transform: capitalize;"> 
                  {{ isset($praposalChecklist->bankStatment) ? $praposalChecklist->bankStatment : 'No' }} 
                </b><br>
                @if($praposalChecklist->bankStatment=='yes') 
                {{ $praposalChecklist->bankStatmentDescrip }}
                @endif
              </td>
              <td>
               {!! Form::label('latestTotalBorrowing','Latest  Total  Borrowings of Firm (Rs Lacs)') !!}
             </td>
             <td>
              <b style="text-transform: capitalize;"> 
                {{ isset($praposalChecklist->latestTotalBorrowing) ? $praposalChecklist->latestTotalBorrowing : 'No' }} 
              </b>
            </td>
          </tr>
          <tr>
            <td>     
             {!! Form::label('anyDefaultLenders','Any delay / default with other lenders') !!}
           </td>
           <td> 
             <b style="text-transform: capitalize;"> 
              {{ isset($praposalChecklist->anyDefaultLenders) ? $praposalChecklist->anyDefaultLenders : 'no' }} 
            </b>
          </td>
          <td>
           {!! Form::label('securityProvided','Security being provided') !!}
         </td>
         <td>
           <b style="text-transform: capitalize;"> {{ isset($praposalChecklist->securityProvided) ? $praposalChecklist->securityProvided : 'No' }} 
             <hr></b> 
             @if($praposalChecklist->securityProvided=='yes') 
             {{ $praposalChecklist->securityProvidedDescrip }}
             @endif
           </td>
         </tr>
         <tr>
          <td>
           <label>Has Liquidity Model been completed. <br> If yes provide score </label>
           {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
         </td>
         <td>
           <b style="text-transform: capitalize;"> {{ isset($praposalChecklist->liquidityModel) ? $praposalChecklist->liquidityModel : 'No' }} 
             <hr> </b>
             @if($praposalChecklist->liquidityModel=='yes') 
             {{ $praposalChecklist->liquidityModelDescrip }}
             @endif
           </div>
         </td>
         <td>
          <label>Any deviations in Loan Matrix. <br> If yes mention deviation') </label>
          {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
        </td>
        <td>
          {!! Form::radio('daviationLoanMatrix', 'yes',$praposalChecklist->daviationLoanMatrix == 'yes' ? 'checked' : '', ['id' => 'daviationLoanMatrix_yes','data-mandatory'=>'M']) !!}
          <b style="text-transform: capitalize;"> {{ isset($praposalChecklist->daviationLoanMatrix) ? $praposalChecklist->daviationLoanMatrix : 'No' }} 
           <hr> </b>
           @if($praposalChecklist->daviationLoanMatrix=='yes') 
           {{ $praposalChecklist->daviationLoanMatrixDescrip }}
           @endif
         </td>
       </tr>
       <tr>
        <td>
          {!! Form::label('latestDEratio','Latest audited D:E ratio') !!}
          {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
        </td>
        <td>
          <b style="text-transform: capitalize;"> {{ isset($praposalChecklist->latestDEratio) ? $praposalChecklist->latestDEratio : 'No' }} 
          </b>
        </td>
        <td> </td>
        <td> </td>
      </tr>
      <tr>
        <td>
          {!! Form::label('companyKYC','Company KYC done (yes/no)') !!}
          {!! Form::label(null,'', ['style' => '  color: red;'])  !!}
          <br>
        </td>
        <td>
         <b style="text-transform: capitalize;"> {{ isset($praposalChecklist->daviationLoanMatrix) ? $praposalChecklist->daviationLoanMatrix : 'No' }} 
         </b>
       </td>
       <td> </td>
       <td> </td>
     </tr>
     {{-- <tr>
      <td colspan="4">
        {!! Form::label('Recommendation of Analyst ','', ['style' => '  color: red;'])  !!}
        <textarea name="recomndation"  rows="5" cols="95">{{ isset($praposalChecklist->recomndation) ? $praposalChecklist->recomndation : null }}</textarea>
      </td>
    </tr>    --}}  
  </div>
</table>
</div>
</div>
{{-- <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p> --}}
<div class="row"  style="page-break-after: always;  margin-top: 700px; ">
  <div class="col-md-12">
    <div class="panel panel-success">
      <div class="panel-heading">Key Loan Term</div>
            {{--
              <div style="padding-left: 5px;padding-top: 10px;">--}}
                <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                  <table class="table table-bordered">
                    <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                      <table class="table table-bordered">
                        <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                          <tr>
                            <td>
                              {!! Form::label('typeofEntity', 'Lender') !!}
                            </td>
                            <td>   
                              <span>Bifco Leasing and Finance Private Limited</span>
                            </td> 
                            <td>   
                              {!! Form::label('Name of Borrower','Name of Borrower') !!}
                            </td>
                            <td>
                              <small>{!! $userProfileFirm->name_of_firm  !!}</small>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              {!! Form::label('Guarantors', 'Guarantors') !!}
                            </td>
                            <td>   
                             {!! $keyloanterm->guarantors  !!}
                           </td> 
                           <td>   
                            {!! Form::label('Amount','Amount') !!}
                          </td>
                          <td>
                            {!! $keyloanterm->amount  !!}
                          </td>
                        </tr>
                        <tr>
                          <td >
                            {!! Form::label('purpose', 'Purpose') !!}
                            <td colspan="3" rowspan="" headers=""> 
                              {!! $keyloanterm->purpose  !!}
                            </td> 
                          </tr>
                          <tr>

                            <td>   
                              {!! Form::label('Facility','Facility') !!}
                            </td>
                            <td>
                              {!! $keyloanterm->facility  !!}
                            </td>
                          </tr>
                          <tr>
                            <td>
                              {!! Form::label('Tenor', 'Tenor (Months)') !!}
                            </td>
                            <td>   
                              {!! $keyloanterm->tenor  !!}
                            </td> 
                            <td>   
                              {!! Form::label('Interest Rate','Interest Rate %') !!}
                            </td>
                            <td>
                              {!! $keyloanterm->interest_rate  !!}
                            </td>
                          </tr>
                          <tr>
                            <td>
                              {!! Form::label('Processing Fee', 'Processing Fee %') !!}
                            </td>
                            <td>   
                              {!! $keyloanterm->processing_fee  !!}
                            </td> 
                            <td>   
                              {!! Form::label('legal_fee Fee', 'Legal Fee') !!}
                            </td>
                            <td>
                              {!! $keyloanterm->legal_fee  !!}
                            </td>
                          </tr>
                          <tr>
                            <td>   
                              {!! Form::label('Repayment Schedule','Repayment Schedule (Months)') !!}
                            </td>
                            <td>
                              {!! $keyloanterm->repayment_schedule  !!}
                            </td>
                          </tr>
                          <tr>
                            <td>
                              {!! Form::label('prepayment Fee', 'Prepayment Penalty') !!}
                            </td>
                            <td colspan="3">   
                              {!! $keyloanterm->prepayment_penalty  !!}
                            </td> 
                          </tr>
                          <tr>
                            <td>
                              {!! Form::label('security', 'Security') !!}
                            </td>
                            <td colspan="3">   
                              {!! $keyloanterm->security  !!}
                            </td> 
                          </tr>
                          <tr>
                            <td>   {!! Form::label('Pre Disbursement Conditions','Pre Disbursement Conditions') !!}</td>
                            <td colspan="3">
                              {!! $keyloanterm->pre_disbursement_conditions  !!}
                            </td>
                          </tr>

                          <tr><td colspan="3" ><center><b>Financial Covenants</b></center></td></tr>
                          <tr>
                           <td>   
                            {!! Form::label('Debt/EBITDA','Debt/EBITDA') !!}
                          </td>
                          <td>
                            {!! $keyloanterm->fin_conv_debt_ebitda  !!}
                          </td>
                          <td>
                            {!! Form::label('Debt/Equity', 'Debt/Equity') !!}
                          </td>
                          <td>   
                            {!! $keyloanterm->fin_conv_debt_equity_ratio  !!}
                          </td> 
                        </tr>
                        <tr>

                          <td>   
                            {!! Form::label('Current Ratio','Current Ratio') !!}
                          </td>
                          <td>
                            {!! $keyloanterm->fin_conv_current_ratio  !!}
                          </td>
                          <td>   
                            {!! Form::label('Interest Coverage ratio','Interest Coverage ratio') !!}
                          </td>
                          <td>
                            {!! $keyloanterm->fin_conv_interest_cov_ratio  !!}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            {!! Form::label('Other', 'Other') !!}
                          </td>
                          <td>   
                            {!! $keyloanterm->praposalSourceOthers  !!}
                          </td> 

                        </tr>

                        <tr><td colspan="3" ><center><b>Other Covenants</b></center></td></tr>
                        <tr>
                          <td>
                            {!! Form::label('Standard', 'Other ') !!}
                          </td>
                          <td colspan="3">   
                            {!! $keyloanterm->other_convenants_standerds  !!}
                          </td> 

                        </tr>
                        <tr>
                          <td>{!! Form::label('Standard with Additions','', ['style' => '  color: red;'])  !!}</td>
                          <td colspan="3" rowspan="" headers="">
                           {!! $keyloanterm->other_convenants_standerds_withaddiotion  !!}
                         </td>
                       </tr>
                       <tr>
                        <td>{!! Form::label('Recommendation of Analyst ','', ['style' => '  color: red;'])  !!}</td>
                        <td colspan="3" rowspan="" headers="">
                         {{ isset($keyloanterm->recomndation) ? $keyloanterm->recomndation : null }} 
                       </td>
                     </tr>
                   </div>
                 </table>
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
<script type="text/javascript">
  $(document).ready(function() {

    @if(isset($praposalBackground->existingLoan) && @$praposalBackground->existingLoan =='yes')
 
 // document.getElementById('existingLoan_yes').checked = true;
  $(".borrowerExistingLoan").show()
  @else
  $(".borrowerExistingLoan").hide()
 
 // document.getElementById('existingLoan_no').checked = true;
 
  @endif
  
    @if(isset($praposalChecklist->ratioBreaches) && $praposalChecklist->ratioBreaches=='yes')
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
    @if(isset($praposalChecklist->customerVisit) && $praposalChecklist->customerVisit=='yes')
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
    @if(isset($praposalChecklist->creditCell) && $praposalChecklist->creditCell=='yes')
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
    @if(isset($praposalChecklist->refrenceCheck) && $praposalChecklist->refrenceCheck=='yes')
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
    @if(isset($praposalChecklist->bankStatment) && $praposalChecklist->bankStatment=='yes')
    document.getElementById('bankStatment_yes').checked = true;
    $("#bankStatmentDescrip").show()
    @else
    document.getElementById('bankStatment_no').checked = true;
    $("#bankStatmentDescrip").hide()
    @endif
    $('input:radio[name="bankStatment"]').change(
      function(){
        if ($(this).val() == 'yes') {
          $("#bankStatmentDescrip").show()
        } else{
          $("#bankStatmentDescrip").hide()
        }
      }
      );
    @if(isset($praposalChecklist->securityProvided) && $praposalChecklist->securityProvided=='yes')
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
    @if(isset($praposalChecklist->liquidityModel) && $praposalChecklist->liquidityModel=='yes')
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
    @if(isset($praposalChecklist->daviationLoanMatrix) && $praposalChecklist->daviationLoanMatrix=='yes')
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
    @if(isset($praposalChecklist->creditCell) && $praposalChecklist->creditCell=='yes')
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
</body>
</html>