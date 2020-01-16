 <div class="card">
   <div class="card-header" data-background-color="green">
     <h4 class="title">Financial Summary<span class="pull-right">{{ $userProfileFirm->name_of_firm }}</span></h4>
     {{--    <p class="category">Apply new loan</p> --}}
 </div>
 <div class="card-content">
    <div class="col-md-12 input">
        <div class="tab-content tab-design" style="padding-top:20px;padding-left: 5px;">
            <?php
            $counter = 0;
            $isAnyThresholdBreached = false;
            $isAnyExpressionInvalid = false;
                    /*echo "<pre>";
                    print_r($ratios);
                    echo "</pre>";*/
                  /*  foreach ($bl_year as $blyear) {
                        echo $blyear;
                    }*/
                   // dd($financialProfitLoss);
                  /*  echo "<pre>";
                    print_r($ratios);
                    echo "</pre>";*/
                            //current Ratio  => Total Current Assets / Total Current Liabilities  wrong need to calulated  27 / 21
                    ?>
                    <table width="99%" style="margin-left: 5px;">
                        <tr><td colspan="3"></td></tr>
                        <tr>
                            @foreach($bl_year as $blyear)
                            <td style="width: 33%" align="center">
                                {!! Form::label($blyear, $blyear) !!}
                                <table class="table table-condensed table-bordered">
                                    <tr>
                                        <td>
                                            <table class="table table-condensed table-bordered">
                                                <tr>
                                                    <td>Net Revenue/Sales</td>
                                                    <td>
                                                        <?php  
                                                        if(@$blyear == 'FY 2018-19'){
                                                          echo @$financialProfitLoss[0]->net_sales ;  
                                                      }elseif($blyear == 'FY 2017-18'){
                                                          echo   @$financialProfitLoss[1]->net_sales ;
                                                      }else{
                                                         echo   @$financialProfitLoss[2]->net_sales ;
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
                                                 if(@$blyear == 'FY 2018-19'){
                                                    echo @$financialProfitLoss[0]->ebitda ;  
                                                }elseif($blyear == 'FY 2017-18'){
                                                    echo   @$financialProfitLoss[1]->ebitda ;
                                                }else{
                                                    echo   @$financialProfitLoss[2]->ebitda ;
                                                }
                                                ?>
                                            </td>
                                        </tr><tr>
                                            <td>PAT</td>
                                            <td>  <?php  
                                            if(@$blyear == 'FY 2018-19'){
                                                echo @$financialProfitLoss[0]->pat ;  
                                            }elseif(@$blyear == 'FY 2017-18'){
                                                echo @$financialProfitLoss[1]->pat ;
                                            }else{
                                                echo   @$financialProfitLoss[2]->pat ;
                                            }
                                            ?>
                                        </td>
                                    </tr><tr>
                                        <td>Total Term Debt</td>
                                        <td><?php  
                                        if(@$blyear == 'FY 2018-19'){   
                                        print_r(@$financialDataRecords[0]->curr_long_term_debt + @$financialDataRecords[0]->long_term_borrowings);  ////5+30 = 35 
                                    }elseif($blyear == 'FY 2017-18'){
                                       print_r(@$financialDataRecords[1]->curr_long_term_debt + @$financialDataRecords[1]->long_term_borrowings); // 3+30=33
                                   }else{
                                    print_r(@$financialDataRecords[2]->curr_long_term_debt + @$financialDataRecords[2]->long_term_borrowings);  //  10+1=11
                                }
                                ?> </td>
                            </tr><tr>
                                <td>Total short term Borrowing</td>
                                <td> 
                                    <?php  
                                    if(@$blyear == 'FY 2018-19'){
                                        print_r(@$financialDataRecords[0]->short_term_loans );
                                    }elseif(@$blyear == 'FY 2017-18'){
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
                               if(@$blyear == 'FY 2018-19'){
                                        print_r(@$financialDataRecords[0]->curr_long_term_debt + @$financialDataRecords[0]->long_term_borrowings + @$financialDataRecords[0]->short_term_loans  ); //////5+30+ = 35 
                                    }elseif(@$blyear == 'FY 2017-18'){
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
                               if($blyear == 'FY 2018-19'){
                                print_r(@$financialDataRecords[0]->net_worth );
                            }elseif($blyear == 'FY 2017-18'){
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
                        if($blyear == 'FY 2018-19'){
                         print_r(@$fromCashflowTable['FY 2018-19'][79]->value);  
                     }elseif($blyear == 'FY 2017-18'){
                       print_r(@$fromCashflowTable['FY 2017-18'][79]->value);
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
        <td> <?php    
        if($blyear == 'FY 2018-19'){
            @$fullValue=(@$financialDataRecords[0]->total_current_assets / @$financialDataRecords[0]->total_current_liabilities);
                  
                   //die();
              /*$fullValue=($anaModBalSheet->total_current_assets - $anaModBalSheet->receivables_from_related_party - $anaModBalSheet->related_party_advances - $anaModBalSheet->capital_advances ) / 
     $anaModBalSheet->total_current_liabilities;*/
            print_r(round(@$fullValue, 2));
        }elseif(@$blyear == 'FY 2017-18'){
         @$fullValue1=(@$financialDataRecords[1]->total_current_assets / @$financialDataRecords[1]->total_current_liabilities);
          print_r(round(@$fullValue1, 2));
     }else{
         @$fullValue2=(@$financialDataRecords[2]->total_current_assets / @$financialDataRecords[2]->total_current_liabilities);
           print_r(round(@$fullValue2, 2));
    }
    ?></td>
</tr>
<tr>
    <td>Receivable Days</td>
    <td>
        <?php    
         if($blyear == 'FY 2018-19'){
                 foreach ($ratios as  $value) {
                         if($value['name']=='receivable_days' && $value['period']=='FY 2018-19'){
                             echo $value['value'];
                         }
                }
            }elseif($blyear == 'FY 2017-18'){
               foreach ($ratios as  $value) {
                         if($value['name']=='receivable_days' && $value['period']=='FY 2017-18'){
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
           if($blyear == 'FY 2018-19'){
                 foreach ($ratios as  $value) {
                         if($value['name']=='inventory_days' && $value['period']=='FY 2018-19'){
                             echo $value['value'];
                         }
                }
            }elseif($blyear == 'FY 2017-18'){
               foreach ($ratios as  $value) {
                         if($value['name']=='inventory_days' && $value['period']=='FY 2017-18'){
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
            <td>TOL/TNW ratio</td> {{-- TOL / Total Shareholders Funds --}}
            <td>   <?php    
            if($blyear == 'FY 2018-19'){
                 foreach ($ratios as  $value) {
                         if($value['name']=='tol_total_shareholders_funds' && $value['period']=='FY 2018-19'){
                             echo $value['value'];
                         }
                }
            }elseif($blyear == 'FY 2017-18'){
               foreach ($ratios as  $value) {
                         if($value['name']=='tol_total_shareholders_funds' && $value['period']=='FY 2017-18'){
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
            ?></td>
        </tr><tr>
            <td>Net Revenue/Total Assets</td>
            <td>
             <?php    
             if($blyear == 'FY 2018-19'){
                 foreach ($ratios as  $value) {
                         if($value['name']=='net_revenue_total_assets' && $value['period']=='FY 2018-19'){
                             echo $value['value'];
                         }
                }
            }elseif($blyear == 'FY 2017-18'){
               foreach ($ratios as  $value) {
                         if($value['name']=='net_revenue_total_assets' && $value['period']=='FY 2017-18'){
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
            if($blyear == 'FY 2018-19'){
                foreach ($ratios as  $value) {
                         if($value['name']=='interest_coverage_ratio' && $value['period']=='FY 2018-19'){
                             echo $value['value'];
                         }
                }
                //echo @$ratios[14]->value ;  
            }elseif($blyear == 'FY 2017-18'){
                foreach ($ratios as  $value) {
                         if($value['name']=='interest_coverage_ratio' && $value['period']=='FY 2017-18'){
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
       if($blyear == 'FY 2018-19'){
                 foreach ($ratios as  $value) {
                         if($value['name']=='ebitda_netrevenue' && $value['period']=='FY 2018-19'){
                             echo $value['value'];
                         }
                }
            }elseif($blyear == 'FY 2017-18'){
               foreach ($ratios as  $value) {
                         if($value['name']=='ebitda_netrevenue' && $value['period']=='FY 2017-18'){
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
                             // dd($financialProfitLoss);
        ?> </td>
    </tr>
</table>
</td>
</tr>
</table>
</td>
@endforeach
</tr></table>
<br/>
<br>
<div class="row">
    <div class="col-md-12" style="margin-left:20px;">
      <div id="currentSection">
        {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
       @if($user->isSME() || $user->isCA() || $user->isAnalyst())
        {!! Form::button('Save & Next Section <i class="fa fa-share"></i>', array('type' => 'submit','class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails','value'=> 'Next', 'style' => 'margin-top:20px;margin-left:20px;')) !!}
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
@section('footer')
<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
<script>
    $('a').tooltip();
</script>
@endsection