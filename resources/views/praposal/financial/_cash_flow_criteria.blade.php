<div class="card">
  <div class="card-header" data-background-color="green">
    <h4 class="title">Liquidity Test Score <span class="pull-right">{{ $loanUserProfile->name_of_firm }}</span></h4>
  </div>
  <div class="card-content">
    <div class="col-md-12 input">
      <div class="tab-content tab-design" style="padding-top:20px;padding-right: 5px;padding-left: 5px;">
        <div class="row" style="margin-left: auto;">
          <?php
          $per='cPeriod_' . $cashflowInitial->no_of_period;
          $ttsr=$cashflowInitial->no_of_period+1;
            for ($i=1; $i < 7 ; $i++) { 
                $santosh='cPeriod_' . $i;
                $tt[]=$closingSrcUses->$santosh;
            }
          
          
                $minTT=min(array_filter($tt));
         
            $closingCashBalance=$closingSrcUses->$per; //total last no 
            $startingCashBalance=$closingSrcUses->cPeriod_1; //total last no 
            $sp='stPeriod_';
            $srcTotalValue=0;
            for ($i=1; $i <  $ttsr ; $i++) { 
              $sp='stPeriod_'.$i;
              $srcTotalValue+= $SrcTotal->$sp ;
            }
            $lastCashBalance=($closingCashBalance / $srcTotalValue) * 100;  
            $selScore=round($lastCashBalance);
            if($selScore > 20){
                $getSel ='100';
            }elseif ( $selScore >0 && $selScore  < 21) {
                $getSel ='75';
            }elseif ( $selScore < 0 && $selScore   > -15) {
               $getSel ='50';
           }else{
               $getSel ='0';
           }
           $capitalInvestedInput=$cashflowInitial->capital_Invested;
           $selScoreClosingCash= round(($closingCashBalance / $capitalInvestedInput) * 100) ;
            ///$getSelClosingCash ='100';
            // $selScoreClosingCash= '-20' ;
            if($selScoreClosingCash > 20){
                $getSelClosingCash ='100';
            }elseif ( $selScoreClosingCash > 0 && $selScoreClosingCash  < 20.01) {
                $getSelClosingCash ='75';
            }elseif ( $selScoreClosingCash  < 0 && $selScoreClosingCash  > -15) {

               $getSelClosingCash ='50';
           }else{
               $getSelClosingCash ='0';
           }

           $lowestCB=round(($minTT / $capitalInvestedInput) * 100  ) ;
             //$capitalInvestedInput;
           //echo $lowestCB;
            // min($tt);
            if($lowestCB > 0){
                $getLowestCB ='100';
            }elseif ( $lowestCB > -10  && $lowestCB  < 0) {
                $getLowestCB ='75';
            }elseif ( $lowestCB > -10  && $lowestCB  < -25) {
               $getLowestCB ='50';
           }else{
               $getLowestCB ='0';
           }
           $speriods=$cashflowInitial->no_of_period;
           if($cashflowInitial->period_name=='monthly'){
            $period='Period';
          }else{
            $period='Quarter';
          }
          $capitalInvestedInput=$cashflowInitial->capital_Invested;
          $lowstClosingBalance= ($startingCashBalance / $capitalInvestedInput) * 100;  


         // echo round(($closingCashBalance / $capitalInvestedInput) * 100)
          ?>
          <table class="table table-bordered">
            <tr>
              <td>
                {!! Form::label('Weightage',null, ['class'=>'control-label']) !!}
              </td>
              <td>
                <div class="col-border col-md-12 col-sm-12 col-xs-12">
                  {!! Form::label('Name',null, ['class'=>'control-label']) !!}
                </div>
              </td>
              <td colspan="2" class="text-center">
                <div class="col-border col-md-12 col-sm-12 col-xs-12">
                  {!! Form::label('Score',null, ['class'=>'control-label']) !!}
                </div>
              </td> 
              <td>
                <div class="col-border col-md-12 col-sm-12 col-xs-12">
                  {!! Form::label('Criteria Value (%)',null, ['class'=>'control-label']) !!}
                </div>
              </td>
              <td>
                <div class="col-border col-md-12 col-sm-12 col-xs-12">
                  {!! Form::label('Effective Score',null, ['class'=>'control-label']) !!}
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="col-border col-md-12 col-sm-12 col-xs-12">
                 {!! Form::label('20%',null, ['class'=>'control-label','id'=>'calWeight1']) !!}
               </div>
             </td>
             <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                {!! Form::label('Closing Cash Balance At End Of Period as a % of Total Inflows during the period',null, ['class'=>'control-label']) !!}
              </div>
            </td>
            <td>
              <div class="col-border col-md-12 col-sm-12 col-xs-12">
               {!! Form::text('calculatedScore1', isset($cashCriteria->calculatedScore1)? $cashCriteria->calculatedScore1 : null  , ['class'=>'form-control','id'=>'calculatedScore1','data-mandatory'=>'M' ,$setDisable] )!!}
             </div>
           </td>
           <td>  
            <div class="col-border col-md-12 col-sm-12 col-xs-12">
             @if(isset($cashCriteria->selectSources1))
             {!! Form::select('selectSources1', array('' => 'Select Source','100' => '>20% of Total Sources', '75' => '0% - 20% of Sources)','50' => '0% - -15% of sources','0' => '<-15% of sources'), $cashCriteria->selectSources1,['id' => 'selectSources1', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
             @else
             {!! Form::select('selectSources1', array('' => 'Select Source','100' => '>20% of Total Sources', '75' => '0% - 20% of Sources)','50' => '0% - -15% of sources','0' => '<-15% of sources'),$getSel,['id' => 'selectSources1', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
             @endif
           </div>
         </td>
         <td>  
          <div class="col-border col-md-12 col-sm-12 col-xs-12">
            {!! Form::text('lastCashBalance',isset($cashCriteria->lastCashBalance)? $cashCriteria->lastCashBalance : round($lastCashBalance)  , ['class'=>'form-control','id'=>'lastCashBalance','data-mandatory'=>'M' ,$setDisable] )!!}
          </div>
        </td>
        <td>  
          <div class="col-border col-md-12 col-sm-12 col-xs-12">
            {!! Form::text('effectivScore1',isset($cashCriteria->effectivScore1)? $cashCriteria->effectivScore1 : null  , ['class'=>'form-control','id'=>'effectivScore1','data-mandatory'=>'M' ,$setDisable] )!!}
          </div>
        </td>
      </tr>
      {{-- 2nd row --}}
      <tr>
        <td>
          <div class="col-border col-md-12 col-sm-12 col-xs-12">
           {!! Form::label('20%',null, ['class'=>'control-label','id'=>'calWeight2']) !!}
         </div>
       </td>
       <td>
        <div class="col-border col-md-12 col-sm-12 col-xs-12">
          {!! Form::label('Closing Cash Balance at end of period as a % of Capital Invested',null, ['class'=>'control-label']) !!}
        </div>
      </td>
      <td>
        <div class="col-border col-md-12 col-sm-12 col-xs-12">
         {!! Form::text('calculatedScore2',isset($cashCriteria->calculatedScore2)? $cashCriteria->calculatedScore2 : null  , ['class'=>'form-control','id'=>'calculatedScore2','data-mandatory'=>'M' ,$setDisable] )!!}
       </div>
     </td>
     <td>  
      <div class="col-border col-md-12 col-sm-12 col-xs-12">
       @if(isset($cashCriteria->selectSources2))
       {!! Form::select('selectSources2', array('' => 'Select Source','100' => '>20% of promoter capital', '75' => '0% - 20% of promoter capital)','50' => '0% - -15% of promoter capital','0' => '<-15% of promoter capital'), $cashCriteria->selectSources2,['id' => 'selectSources2', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
       @else
       {!! Form::select('selectSources2', array('' => 'Select Source','100' => '>20% of promoter capital', '75' => '0% - 20% of promoter capital)','50' => '0% - -15% of promoter capital','0' => '<-15% of promoter capital'),$getSelClosingCash,['id' => 'selectSources2', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
       @endif
     </div>
   </td>
   <td>  
    <div class="col-border col-md-12 col-sm-12 col-xs-12">
     {!! Form::text('cashVSinvest',isset($cashCriteria->cashVSinvest)? $cashCriteria->cashVSinvest : null  , ['class'=>'form-control','id'=>'cashVSinvest','data-mandatory'=>'M' ,$setDisable] )!!}
   </div>
 </td>
 <td>  
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
    {!! Form::text('effectivScore2',isset($cashCriteria->effectivScore2)? $cashCriteria->effectivScore2 : null  , ['class'=>'form-control','id'=>'effectivScore2','data-mandatory'=>'M' ,$setDisable] )!!}
  </div>
</td>
</tr>
<tr> 
  {{-- row 3 --}}
  <tr>
    <td>
      <div class="col-border col-md-12 col-sm-12 col-xs-12">
       {!! Form::label('30%',null, ['class'=>'control-label','id'=>'calWeight3']) !!}
     </div>
   </td>
   <td>
    <div class="col-border col-md-12 col-sm-12 col-xs-12">
      {!! Form::label('Lowest Closing Balance as a % Of Capital Invested',null, ['class'=>'control-label']) !!}
    </div>
  </td>
  <td>
    <div class="col-border col-md-12 col-sm-12 col-xs-12">
     {!! Form::text('calculatedScore3',isset($cashCriteria->calculatedScore3)? $cashCriteria->calculatedScore3 : null  , ['class'=>'form-control','id'=>'calculatedScore3','data-mandatory'=>'M' ,$setDisable] )!!}
   </div>
 </td>
 <td>  
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
   @if(isset($cashCriteria->selectSources3))
   {!! Form::select('selectSources3', array('' => 'Select Source','100' => 'Positive', '75' => '>- 10% - <0 %of capital invested','50' => '-10% - -25% of capital invested','0' => '< -25% of capital invested'),$cashCriteria->selectSources3,['id' =>'selectSources3', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
   @else
   {!! Form::select('selectSources3', array('' => 'Select Source','100' => 'Positive', '75' => '>- 10% - <0% of capital invested','50' => '-10% - -25% of capital invested','0' => '< -25% of capital invested'),$getLowestCB,['id' => 'selectSources3', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
   @endif
 </div>
</td>
<td>  
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
   {!! Form::text('lowstClosingBalance',isset($cashCriteria->lowstClosingBalance)? $cashCriteria->lowstClosingBalance : null  , ['class'=>'form-control','id'=>'lowstClosingBalance','data-mandatory'=>'M' ,$setDisable] )!!}
 </div>
</td>
<td>  
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
    {!! Form::text('effectivScore3',isset($cashCriteria->effectivScore3)? $cashCriteria->effectivScore3 : null   , ['class'=>'form-control','id'=>'effectivScore3','data-mandatory'=>'M' ,$setDisable] )!!}
  </div>
</td>
</tr>  
{{-- row 4 --}}
<tr>
  <td>
    <div class="col-border col-md-12 col-sm-12 col-xs-12">
     {!! Form::label('30%',null, ['class'=>'control-label','id'=>'calWeight4']) !!}
   </div>
 </td>
 <td>
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
    {!! Form::label('Trend of closing balance',null, ['class'=>'control-label']) !!}
  </div>
</td>
<td>
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
    {!! Form::text('calculatedScore4',isset($cashCriteria->calculatedScore4)? $cashCriteria->calculatedScore4 : null  , ['class'=>'form-control','id'=>'calculatedScore4','data-mandatory'=>'M' ,$setDisable] )!!}
  </div>
</td>
<td>  
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
   @if(isset($cashCriteria->selectSources4))
   {!! Form::select('selectSources4', array('' => 'Select Source','100' => 'Always +ve', '75' => '+ve Majority of time','50' => '-ve Majority of time','0' => 'Always -ve'),$cashCriteria->selectSources4,['id' => 'selectSources4', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
   @else
   {!! Form::select('selectSources4', array('' => 'Select Source','100' => 'Always +ve', '75' => '+ve Majority of time','50' => '-ve Majority of time','0' => 'Always -ve'),null,['id' => 'selectSources4', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
   @endif
 </div>
</td>
<td>  
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
    {!! Form::text('trendClosingBalance',isset($cashCriteria->trendClosingBalance)? $cashCriteria->trendClosingBalance : null    , ['class'=>'form-control','id'=>'trendClosingBalance','data-mandatory'=>'M' ,$setDisable] )!!}
  </div>
</td>
<td>  
  <div class="col-border col-md-12 col-sm-12 col-xs-12">
    {!! Form::text('effectivScore4',isset($cashCriteria->effectivScore4)? $cashCriteria->effectivScore4 : null    , ['class'=>'form-control','id'=>'effectivScore4','data-mandatory'=>'M' ,$setDisable] )!!}
  </div>
</td>
</tr>
<tr>
  <td colspan="5" class="text-center">
    {!! Form::label('Cash Flow Score','Cash Flow Score', ['class'=>'control-label']) !!}
  </td>
  <td>  
    <div class="col-border col-md-12 col-sm-12 col-xs-12">
      {!! Form::text('cashFlowScore', isset($cashCriteria->cashFlowScore)? $cashCriteria->cashFlowScore : null   , ['class'=>'form-control','id'=>'cashFlowScore','data-mandatory'=>'M' ,$setDisable] )!!}
    </div>
  </td>
</tr>
<tr>
  <td colspan="3" class="text-center">
    {!! Form::label('Final Remark','Cash Flow Score', ['class'=>'control-label']) !!}
  </td>
  <td colspan="3" class="text-center">  
    <div class="col-border col-md-12 col-sm-12 col-xs-12">
      {!! Form::text('liquidityRemark', isset($cashCriteria->liquidityRemark)? $cashCriteria->liquidityRemark : null   , ['class'=>'form-control','id'=>'liquidityRemark','data-mandatory'=>'M' ,$setDisable] )!!}
    </div>
  </td>
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
    {!! Form::button('Calculate Score', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "calSurplus();",'value'=> '', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
    {!! Form::submit('Save & Continue', array('class' => 'btn btn-success btn-cons sme_button', 'value'=>'Next', 'style' => 'margin-top:20px;margin-left:20px;')) !!}
    @endif
  </div>
</div>
</div>
</div>
<script>
  jQuery(document).ready(function ($) {
     var selsrc1=$( "#selectSources1").val() ;
     $("#calculatedScore1").val(selsrc1);   
     var firstCons1=0.2;
     var effScore1 =selsrc1 * firstCons1;
     $("#lastCashBalance").val(<?php echo round($lastCashBalance) ?>);    
     $("#effectivScore1").val(effScore1);   
       var selsrc2=$( "#selectSources2").val() ;
       $("#calculatedScore2").val(selsrc2);   
       var firstCons2=0.2;
       var effScore2 =selsrc2 * firstCons2;
       $("#effectivScore2").val(effScore2);
       $("#cashVSinvest").val(<?php echo round(($closingCashBalance / $capitalInvestedInput) * 100)  ?>);       
       var selsrc3=$( "#selectSources3").val() ;
       $("#calculatedScore3").val(selsrc3);   
       var firstCons3=0.3;
       var effScore3 =selsrc3 * firstCons3;
       $("#effectivScore3").val(effScore3);   
       $("#lowstClosingBalance").val(<?php echo round(($minTT / $capitalInvestedInput) * 100  )  ?>);      

     $( "#selectSources4" ).change(function() {
       var selsrc4=$( "#selectSources4").val() ;
       $("#calculatedScore4").val(selsrc4);   
       var firstCons4=0.3;
       var effScore4 =selsrc4 * firstCons4;
       $("#effectivScore4").val(effScore4);   
     } );
   } );
  function calSurplus(){
  //  var ctotal_61=parseInt(effScore1) + parseInt(effScore2) + parseInt(effScore3) + parseInt(effScore4)
   var ctotal_61=parseInt($( "#selectSources1").val() * 0.2) + parseInt($( "#selectSources2").val() *0.2) + parseInt($( "#selectSources3").val()*0.3) + parseInt($( "#selectSources4").val()*0.3)
     //  alert('hiiiiiiiiiiii');
       //alert(ctotal_61);
     //$("#cashFlowScore").val(ctotal_61);   
   $("#cashFlowScore").val(ctotal_61);   
   if(ctotal_61 > 75){
    $("#liquidityRemark").val('High Liquidity')
  } else if(ctotal_61 < 75 && ctotal_61 > 50){
    $("#liquidityRemark").val('Moderate Liquidity')    
  } else if(ctotal_61 < 50 && ctotal_61 > 30){
    $("#liquidityRemark").val('Low Liquidity')
  } else {
    $("#liquidityRemark").val('Poor Liquidity')
  }
}
</script>
