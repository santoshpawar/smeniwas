<style>
  
 table:first-of-type tr:nth-of-type(1)   {
  background: #5EB562;
} 

table:first-of-type tr:nth-of-type(12)   {
  background: #2bd033;
}

 input#utotal_11 {
      font-weight: 800;
 }
 input#oPeriod_11 {
    font-weight: 800;
}
</style>
<div class="card">
  <div class="card-header" data-background-color="green">
    <h4 class="title">Liquidity Test Model <span class="pull-right">{{ $loanUserProfile->name_of_firm }}</span></h4>
  </div>
  <div class="card-content">
    <div class="col-md-12 input">
      <div class="tab-content tab-design" style="padding-top:20px;padding-right: 5px;padding-left: 5px;">
        <div class="row" style="margin-left: auto;">
          <?php
  
          $speriods=$cashflowInitial->no_of_period;
           $forMonth = date($cashflowInitial->startingTime).'<br>'; 
           //echo $newdate = date('Y-m', strtotime('+1 months', strtotime($cashflowInitial->startingTime))); 
          $startingTime =date('Y-m', strtotime('-3 months', strtotime($cashflowInitial->startingTime))); 
          $foryear = date($cashflowInitial->startingTime); 
          $intYear=intval($foryear)-1;

          
         ?>
         <table class="table table-bordered">
          <tr>
            <td>
              {!! Form::label('src_of_funds','Sources of Funds', ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php
          //  if($cashflowInitial->period_name=='monthly'  || $cashflowInitial->period_name=='quarterly'){
            if( $cashflowInitial->period_name=='quarterly'){
              $repeat = strtotime("+3 month",strtotime($startingTime));
              $startingTime = date('M, Y',$repeat);
            }else{
                 
                  $startingTime=$intYear+$i;
            }
            ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::label('category_weight',$startingTime, ['class'=>'control-label']) !!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('advance_from_customer',$srcOfFunds[0], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $advance_from_customer="speriod_$i" ; ?>
            <td>  
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('1_speriod_'.$i,isset($srcFunds[1][0]-> $advance_from_customer)? $srcFunds[1][0]-> $advance_from_customer : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'1','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Fresh cash sales ( net of TDS)',$srcOfFunds[1], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $freshCash="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('2_speriod_'.$i, isset($srcFunds[2][0]-> $freshCash)? $srcFunds[2][0]-> $freshCash : null , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'2','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Past receipts ( reduction in debtors)',$srcOfFunds[2], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $pastReceipts="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('3_speriod_'.$i, isset($srcFunds[3][0]-> $pastReceipts)? $srcFunds[3][0]-> $pastReceipts : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'3','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr> 
          <tr>
            <td>
              {!! Form::label('Stage wise payment in case of contract execution',$srcOfFunds[3], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $stageWise="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('4_speriod_'.$i, isset($srcFunds[4][0]-> $stageWise)? $srcFunds[4][0]-> $stageWise : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'4','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('Fresh Borrowings from BANK/ NBFC',$srcOfFunds[4], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $freshBorrow="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('5_speriod_'.$i, isset($srcFunds[5][0]-> $freshBorrow)? $srcFunds[5][0]-> $freshBorrow : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'5','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('niwas_loan',$srcOfFunds[5], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $niwasLoan="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('6_speriod_'.$i, isset($srcFunds[6][0]-> $niwasLoan)? $srcFunds[6][0]-> $niwasLoan : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'6','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('Tax refund',$srcOfFunds[6], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $taxRefund="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('7_speriod_'.$i,  isset($srcFunds[7][0]-> $taxRefund)? $srcFunds[7][0]-> $taxRefund : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'7','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('Int on deposits/dividends on investments',$srcOfFunds[7], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $intDeposits="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('8_speriod_'.$i, isset($srcFunds[8][0]-> $intDeposits)? $srcFunds[8][0]-> $intDeposits : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'8','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('Proceeds from sale of assets/investments',$srcOfFunds[8], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $proceedsFrom="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('9_speriod_'.$i, isset($srcFunds[9][0]-> $proceedsFrom)? $srcFunds[9][0]-> $proceedsFrom : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'9','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('REFUND OF DEPOISTS/MARGIN MONEY',$srcOfFunds[9], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $refundsDeposists="speriod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('10_speriod_'.$i,isset($srcFunds[10][0]-> $refundsDeposists)? $srcFunds[10][0]-> $refundsDeposists : null  , ['class'=>'form-control row'.$i.'','id'=>'speriod_'.$i.'10','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('total_sources','Total Sources', ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $stperiod="stPeriod_$i" ; ?>  
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('stPeriod_'.$i, isset($SrcTotal->$stperiod)? $SrcTotal->$stperiod : null , ['class'=>'form-control amount','id'=>'stotal_'.$i.'1','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
        </table>
        {{-- Uses Of Funds --}}
        <table class="table table-bordered">
          <tr style="  background: #5EB562;">
            <td colspan="{{ $speriods+1 }}" class="text-center">
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::label('category_weight','Uses of Funds', ['class'=>'control-label']) !!}
              </div>
            </td>
          </tr>
          <tr>
            <td>
              {!! Form::label('Cash Payment to suppliers',$useOfFund[0], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $cashPayment="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('1_uperiod_'.$i, isset($dataFunds[1][0]-> $cashPayment)? $dataFunds[1][0]-> $cashPayment : null  , ['class'=>'form-control urow'.$i.'','onclick' => "calSurplus();",'id'=>'uperiod_'.$i.'1','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Payment for past supplies (reduction in creditors)',$useOfFund[1], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $pastPayment="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('2_uperiod_'.$i, isset($dataFunds[2][0]-> $pastPayment)? $dataFunds[2][0]-> $pastPayment : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'2','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('LC payments',$useOfFund[2], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $lcPayment="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('3_uperiod_'.$i, isset($dataFunds[3][0]-> $lcPayment)? $dataFunds[3][0]-> $lcPayment : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'3','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr> 
          <tr>
            <td>
              {!! Form::label('Advance tax',$useOfFund[3], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $advanceTax="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('4_uperiod_'.$i, isset( $dataFunds[4][0]-> $advanceTax)?  $dataFunds[4][0]-> $advanceTax : null , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'4','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('TDS',$useOfFund[4], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $tds="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('5_uperiod_'.$i, isset($dataFunds[5][0]-> $tds) ? $dataFunds[5][0]-> $tds : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'5','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  
          <tr>
            <td>
              {!! Form::label('GST Custom duties Statutory payments ',$useOfFund[5], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $gstCustom="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('6_uperiod_'.$i, isset($dataFunds[6][0]-> $gstCustom)? $dataFunds[6][0]-> $gstCustom : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'6','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('Property Tax', $useOfFund[6] , ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $propertyTax="uperiod_$i"; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('7_uperiod_'.$i,  isset($dataFunds[7][0]-> $propertyTax) ? $dataFunds[7][0]-> $propertyTax : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'7','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('Salaries - H0',$useOfFund[7], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $salaries="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('8_uperiod_'.$i,  isset($dataFunds[8][0]-> $salaries)? $dataFunds[8][0]-> $salaries : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'8','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  <tr>
            <td>
              {!! Form::label('Salaries - Branch/Factory',$useOfFund[8], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $salBranch="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('9_uperiod_'.$i,  isset($dataFunds[9][0]-> $salBranch)? $dataFunds[9][0]-> $salBranch : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'9','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>  
          <tr>
            <td>
              {!! Form::label('Rent payment',$useOfFund[9], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $rentPayment="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('10_uperiod_'.$i,  isset($dataFunds[10][0]-> $rentPayment)? $dataFunds[10][0]-> $rentPayment : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'10','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Routine office expenditure (tel,utility ,etc)',$useOfFund[10], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $routineOffice="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('11_uperiod_'.$i,  isset($dataFunds[11][0]-> $routineOffice)? $dataFunds[11][0]-> $routineOffice : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'11','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Routine factory/branch expenditure (tel, fuel, etc)',$useOfFund[11], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $routineFactory="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('12_uperiod_'.$i,  isset($dataFunds[12][0]-> $routineFactory)? $dataFunds[12][0]-> $routineFactory : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'12','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Admin & other operating expenses',$useOfFund[12], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $adminOther="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('13_uperiod_'.$i,  isset($dataFunds[13][0]-> $adminOther)? $dataFunds[13][0]-> $adminOther : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'13','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Niwas Loan EMI/principal/Int',$useOfFund[13], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $niwasLoanEmi="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('14_uperiod_'.$i,  isset($dataFunds[14][0]-> $niwasLoanEmi)? $dataFunds[14][0]-> $niwasLoanEmi : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'14','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Existing Loans EMI/principal/Int',$useOfFund[14], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $existingLoan="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('15_uperiod_'.$i,  isset($dataFunds[15][0]-> $existingLoan)? $dataFunds[15][0]-> $existingLoan : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'15','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Other proposed Loans EMI/principal/Int', @$useOfFund[15], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $otherProposed="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('16_uperiod_'.$i,  @isset($dataFunds[16][0]-> $otherProposed)? $dataFunds[16][0]-> $otherProposed : null   , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'16','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Payments for Capex',$useOfFund[16], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $paymentCapx="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('17_uperiod_'.$i,  isset($dataFunds[17][0]-> $paymentCapx)? $dataFunds[17][0]-> $paymentCapx : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'17','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Fresh security deposits',$useOfFund[17], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $freshDeposits="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('18_uperiod_'.$i,  isset($dataFunds[18][0]-> $freshDeposits)? $dataFunds[18][0]-> $freshDeposits : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'18','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr>
            <td>
              {!! Form::label('Investments in property/bank ',$useOfFund[18], ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $investmentsProp="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('19_uperiod_'.$i,  isset($dataFunds[19][0]-> $investmentsProp)? $dataFunds[19][0]-> $investmentsProp : null  , ['class'=>'form-control urow'.$i.'','id'=>'uperiod_'.$i.'19','data-mandatory'=>'M' ,$setDisable] )!!}
              </div>
            </td>
            @endfor
          </tr>
          {{-- Total Sources --}}
          <tr style="background: #2bd033">
            <td>
              {!! Form::label('total_funds','Total Funds', ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $utperiod="utPeriod_$i" ; ?>    
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('utPeriod_'.$i, isset($usesTotal->$utperiod)? $usesTotal->$utperiod : null, ['class'=>'form-control amount','id'=>'utotal_'.$i.'1','data-mandatory'=>'M' ,$setDisable,'style'=>'font-weight: 800;color: #fff !important;'])!!}
              </div>
            </td>
            @endfor
          </tr> 
          <tr style="background: #2bd033">
            <td>
              {!! Form::label('opening','Opening', ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $operiod="oPeriod_$i" ; ?>    
            <?php    $salBranch="uperiod_$i" ; ?>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                @if ($i==1)
                {!! Form::text('oPeriod_'.$i, $cashflowInitial->opening_cash_balance, ['class'=>'form-control amount','id'=>'oPeriod_'.$i.'1','data-mandatory'=>'M' ,$setDisable,'style'=>'font-weight: 800; color: #fff !important;'] )!!}
                @else
                {!! Form::text('oPeriod_'.$i, isset($openingSrcUse->$operiod)? $openingSrcUse->$operiod : null, ['class'=>'form-control amount','id'=>'oPeriod_'.$i.'1','data-mandatory'=>'M' ,$setDisable,'style'=>'font-weight: 800; color: #fff !important;'] )!!}
                @endif
              </div>
            </td>
            @endfor
          </tr>
          <tr style="background: #2bd033">
            <td>
              {!! Form::label('surplus','Surplus/(deficit) for the period', ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $salBranch="uperiod_$i" ; ?>
            <?php    $surPeriod="surPeriod_$i" ; ?>    
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('surPeriod_'.$i, isset($surplusSrcUses->$surPeriod)? $surplusSrcUses->$surPeriod : null, ['class'=>'form-control amount','id'=>'surplusTotal_'.$i.'1','data-mandatory'=>'M' ,$setDisable,'style'=>'font-weight: 800; color: #fff !important;'] )!!}
              </div>
            </td>
            @endfor
          </tr>
          <tr style="background: #2bd033">
            <td>
              {!! Form::label('closing','Closing cash balance', ['class'=>'control-label']) !!}
            </td>
            @for ($i = 1; $i <= $speriods; $i++)
            <?php    $cPeriod="cPeriod_$i" ; ?>    
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::text('cPeriod_'.$i, isset($closingSrcUses->$cPeriod)? $closingSrcUses->$cPeriod : null, ['class'=>'form-control amount','id'=>'ctotal_'.$i.'1','data-mandatory'=>'M' ,$setDisable,'style'=>'font-weight: 800; color: #fff !important;'] )!!}
              </div>
            </td>
            @endfor
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="margin-left:20px;">
      @if($user->isSME() || $user->isBankUser())
      {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
      @endif
      {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
      @if(Auth::user()->isAnalyst())
      {!! Form::button('Calculate Cash Flow', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "calSurplus();",'value'=> '', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
      {!! Form::submit('Save & Continue', array('class' => 'btn btn-success btn-cons sme_button', 'value'=>'Next', 'style' => 'margin-top:20px;margin-left:20px;')) !!}
      @endif
    </div>
  </div>
</div>
</div>
<script>
  $(document).on("change", ".row1,.row2,.row3,.row4,.row5,.row6,.row7", function() {
    var sum1= 0;   var sum2= 0;  var sum3= 0;
    var sum4= 0;   var sum5= 0;  var sum6= 0; var sum7= 0;
    $(".row1").each(function(){ sum1 += +$(this).val(); });
    $(".row2").each(function(){ sum2 += +$(this).val(); });
    $(".row3").each(function(){ sum3 += +$(this).val(); });
    $(".row4").each(function(){ sum4 += +$(this).val(); });
    $(".row5").each(function(){ sum5 += +$(this).val(); });
    $(".row6").each(function(){ sum6 += +$(this).val(); });
    $(".row7").each(function(){ sum7 += +$(this).val(); });
    $("#stotal_11").val(sum1);  $("#stotal_21").val(sum2);  $("#stotal_31").val(sum3);  $("#stotal_41").val(sum4);
    $("#stotal_51").val(sum5);  $("#stotal_61").val(sum6);  $("#stotal_71").val(sum7); 
  });
  $(document).on("change", ".urow1,.urow2,.urow3,.urow4,.urow5,.urow6,.urow7", function() {
    var usum1= 0;   var usum2= 0;  var usum3= 0;
    var usum4= 0;   var usum5= 0;  var usum6= 0; var usum7= 0;
    $(".urow1").each(function(){ usum1 += +$(this).val(); });
    $(".urow2").each(function(){ usum2 += +$(this).val(); });
    $(".urow3").each(function(){ usum3 += +$(this).val(); });
    $(".urow4").each(function(){ usum4 += +$(this).val(); });
    $(".urow5").each(function(){ usum5 += +$(this).val(); });
    $(".urow6").each(function(){ usum6 += +$(this).val(); });
    $(".urow7").each(function(){ usum7 += +$(this).val(); });
 //var usum1  += sum1;
 var test= $("#utotal_11").val(usum1);     
 $("#utotal_21").val(usum2);  $("#utotal_31").val(usum3);  $("#utotal_41").val(usum4);
 $("#utotal_51").val(usum5);  $("#utotal_61").val(usum6);  $("#utotal_71").val(usum7); 
   //$( "#uperiod_119" ).keyup(function() {
   // $("#surplusTotal_11").val(usum1); 
   //alert('hi');
   //});
 });
  function calSurplus(){
    var stotal_11= $("#stotal_11").val();    var stotal_21= $("#stotal_21").val();    var stotal_31= $("#stotal_31").val();  
    var stotal_41= $("#stotal_41").val();      var stotal_51= $("#stotal_51").val();  var stotal_61= $("#stotal_61").val();  
    var stotal_71= $("#stotal_71").val();  var utotal_11=$("#utotal_11").val();   var utotal_21=$("#utotal_21").val(); 
    var utotal_31=$("#utotal_31").val();  var utotal_41=$("#utotal_41").val();    var utotal_51=$("#utotal_51").val(); 
    var utotal_61=$("#utotal_61").val();    var utotal_71=$("#utotal_71").val(); 
    var surperiod1=parseInt(stotal_11)- parseInt(utotal_11);
    //var closingBal=parseInt(stotal_11)+parseInt(utotal_11);
     
    var surperiod2=parseInt(stotal_21) - parseInt(utotal_21);
 
    var surperiod3=parseInt(stotal_31) - parseInt(utotal_31);
    var surperiod4=parseInt(stotal_41) - parseInt(utotal_41);
    var surperiod5=parseInt(stotal_51) - parseInt(utotal_51);
    var surperiod6=parseInt(stotal_61) - parseInt(utotal_61);
    var surperiod7=parseInt(stotal_71) - parseInt(utotal_71);
    $("#surplusTotal_11").val(surperiod1);
    $("#surplusTotal_21").val(surperiod2);
    $("#surplusTotal_31").val(surperiod3);
    $("#surplusTotal_41").val(surperiod4);
    $("#surplusTotal_51").val(surperiod5);
    $("#surplusTotal_61").val(surperiod6);
    $("#surplusTotal_71").val(surperiod7);
 /*   var closingCash2=parseInt($("#surplusTotal_21").val()) + parseInt($("#oPeriod_21").val())
    var closingCash3=parseInt($("#surplusTotal_31").val()) + parseInt($("#oPeriod_31").val())
    var closingCash4=parseInt($("#surplusTotal_41").val()) + parseInt($("#oPeriod_41").val())
    var closingCash5=parseInt($("#surplusTotal_51").val()) + parseInt($("#oPeriod_51").val())
    var closingCash6=parseInt($("#surplusTotal_61").val()) + parseInt($("#oPeriod_61").val())
    var closingCash7=parseInt($("#surplusTotal_71").val()) + parseInt($("#oPeriod_71").val())*/
 /*   $("#oPeriod_21").val(closingCash1);   //Closing Cash Blanace ctotal_11
    $("#oPeriod_31").val(closingCash2);
    $("#oPeriod_41").val(surperiod3);
    $("#oPeriod_51").val(surperiod4);
    $("#oPeriod_61").val(surperiod5);
    $("#oPeriod_71").val(surperiod6);
    $("#oPeriod_81").val(surperiod7);*/
/*   
    var ctotal_51=parseInt($("#oPeriod_51").val()) + parseInt($("#surplusTotal_51").val())
    var ctotal_61=parseInt($("#oPeriod_61").val()) + parseInt($("#surplusTotal_61").val())
    var ctotal_71=parseInt($("#oPeriod_71").val()) + parseInt($("#surplusTotal_71").val())*/

    $("#ctotal_11").val(parseInt($("#oPeriod_11").val()) + parseInt($("#surplusTotal_11").val())  );   //go to oPeriod_21
    $("#oPeriod_21").val(parseInt($("#ctotal_11").val())); 
    var ctotal_21=parseInt($("#oPeriod_21").val()) + parseInt($("#surplusTotal_21").val())
    $("#ctotal_21").val(ctotal_21);  

    $("#ctotal_21").val( parseInt($("#oPeriod_21").val()) + parseInt($("#surplusTotal_21").val()));   //go to oPeriod_31
    $("#oPeriod_31").val(parseInt($("#ctotal_21").val())); 
    var ctotal_31= parseInt($("#surplusTotal_31").val() + parseInt($("#oPeriod_31").val()))
    $("#ctotal_31").val(ctotal_31);   

   $("#ctotal_31").val(parseInt($("#oPeriod_31").val()) + parseInt($("#surplusTotal_31").val()));   //go to oPeriod_41
   $("#oPeriod_41").val(parseInt($("#ctotal_31").val())); 
   var ctotal_41=parseInt($("#oPeriod_41").val()) + parseInt($("#surplusTotal_41").val())
   $("#ctotal_41").val(ctotal_41);  

    $("#ctotal_41").val( parseInt($("#oPeriod_41").val()) + parseInt($("#surplusTotal_41").val()));   //go to oPeriod_41
    $("#oPeriod_51").val(parseInt($("#ctotal_41").val())); 
    var ctotal_51=parseInt($("#surplusTotal_51").val()) +parseInt($("#oPeriod_51").val())
    $("#ctotal_51").val(ctotal_51); 

    $("#ctotal_51").val(parseInt($("#oPeriod_51").val()) + parseInt($("#surplusTotal_51").val()));   //go to oPeriod_41
    $("#oPeriod_61").val(parseInt($("#ctotal_51").val())); 
    var ctotal_61=  parseInt($("#surplusTotal_61").val()) +parseInt($("#oPeriod_61").val())
    $("#ctotal_61").val(ctotal_61);   

    $("#ctotal_61").val(parseInt($("#oPeriod_61").val()) + parseInt($("#surplusTotal_61").val()));  
/*      $("#ctotal_31").val(closingCash3);
       var ctotal_41=parseInt($("#oPeriod_41").val()) + parseInt($("#surplusTotal_41").val())
       $("#ctotal_41").val(ctotal_41);   //Opening +Surplus  oPeriod_21+surplusTotal_21*/
   /*  $("#ctotal_31").val(ctotal_31);
     $("#ctotal_41").val(ctotal_41);
     $("#ctotal_51").val(ctotal_51);
     $("#ctotal_61").val(ctotal_61);
     $("#ctotal_71").val(ctotal_71);*/
   }
   {{-- expr --}}
/*  alert($('#utotal_11').val());
  $("#stotal_11,#utotal_11,#utotal_21,#stotal_21,#utotal_31,#stotal_31").on("change", function() {
    $("#surplusTotal_11").val("");
    var stotal_11 = $("#stotal_11").val();
    var utotal_11 = $("#utotal_11").val(); 
    var closingCash= parseInt(stotal_11)+parseInt(utotal_11);
    $("#surplusTotal_11").val(function() {
      return this.value + closingCash;
    })
    $("#surplusTotal_21").val("");
    var stotal_21 = $("#stotal_21").val();
    var utotal_21 = $("#utotal_21").val();
    var closingCash21= parseInt(stotal_21)+parseInt(utotal_21);
    $("#surplusTotal_21").val(function() {
      return this.value + closingCash21;
    })
    $("#surplusTotal_31").val("");
    var stotal_31 = $("#stotal_31").val();
    var utotal_31 = $("#utotal_31").val();
    var closingCash31= parseInt(stotal_31)+parseInt(utotal_31);
    $("#surplusTotal_31").val(function() {
      return this.value + closingCash31;
    })
  })*/
</script>
