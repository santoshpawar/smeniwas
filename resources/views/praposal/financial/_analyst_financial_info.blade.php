 <style type="text/css">

 .form-horizontal .form-group {
  margin-right: 0px;
  margin-left: 0px;
}
.form-group {
  padding-bottom: 0px !important;
  margin: 5px 0 0 0;
}

</style>

<?php
 if($financialGroups[0]->type=='Balance Sheet'){ ?>
 <style>
 table:first-of-type tr:nth-of-type(11)   {
  background: #5EB562;
} 

table:first-of-type tr:nth-of-type(14)   {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(18)   {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(38)   {
  background: #5EB562;
}table:first-of-type tr:nth-of-type(39)   {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(40)  {
  background: #21ff2b;
}
 
/*table:first-of-type tr:nth-of-type(42)  {
  background: #5EB562;
}*/

table:first-of-type tr:nth-of-type(46)  {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(51)  {
  background: #5EB562;
}table:first-of-type tr:nth-of-type(59)  {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(66)  {
  background: #5EB562;
}table:first-of-type tr:nth-of-type(67)  {
  background: #21ff2b;
}
/*table:first-of-type tr:nth-of-type(67)  {
  background: #21ff2b;
}table:first-of-type tr:nth-of-type(11)  {
  background: #5EB562;
}*/
   
 </style>
<?php } ?>

<?php
 if($financialGroups[0]->type !== 'Balance Sheet'){ ?>

  <style>
 table:first-of-type tr:nth-of-type(4)   {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(7)   {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(16)   {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(21)  {
  background: #5EB562;
}
table:first-of-type tr:nth-of-type(26)  {
  background: #5EB562;
}

 
   
 </style>
 <?php } ?>
 
 
 

<div class="card">
 <div class="card-header" data-background-color="green">
   <h4 class="title">Input Balance Sheet<span class="pull-right">{{ $userProfileFirm->name_of_firm }}</span></h4>
   {{--    <p class="category">Apply new loan</p> --}}
 </div>
 <div class="card-content">
  <div class="col-md-12 input">
    <div class="tab-content tab-design" style="padding-top:20px;padding-right: 5px;padding-left: 5px;">
      <?php $counter = 0; ?>
      <table>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          @foreach($bl_year as $blyear)
          <?php
          $financialDataExpression = null;
          $key_blyear = str_replace('(Provisional)', '', $blyear);

          if ($financialDataExpressionsMap->offsetExists($key_blyear)) {
            $financialDataExpression = $financialDataExpressionsMap->offsetGet($key_blyear);
          }

          $financialDataRecord = null;

          if ($financialDataMap->offsetExists($key_blyear)) {
            $financialDataRecord = $financialDataMap->offsetGet($key_blyear);
          }

          $showTextFieldsForFormula = false;

          if (isset($showFormulaText) && $showFormulaText) {
            $showTextFieldsForFormula = true;
          }
          ?>
          <td align="center">&nbsp;</td>
          <td align="center">

            {!! Form::label($blyear, $blyear) !!}

            <table border="0">
              <tr>
                <td valign="top" colspan="2">
                  <table class="table table-condensed table-bordered table-hover">
                    @foreach($financialGroups as $group)
                    <tr>
                      @if(!$group->header)
                      <td style="padding:5px;">
                        <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                      </td>
                      <td style="padding:5px;"><b>Amount ( <span class="fa fa-inr">&nbsp; </span>Lacs ) </b></td>
                      @else
                      <td colspan="2" align="center">
                        <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                      </td>
                      @endif
                    </tr>
                    <?php 

                    ?>
                    @foreach($group->financialEntries as $entry)
                    @if(isset($financialDataRecord))
                    {!! Form::hidden('financial['.$counter.'][id]',$financialDataRecord->id)!!}
                    {!! Form::hidden('financial['.$counter.'][loan_id]',$financialDataRecord->loan_id)!!}
                    {!! Form::hidden('financial['.$counter.'][period]',$financialDataRecord->period)!!}
                    @else
                    {!! Form::hidden('financial['.$counter.'][loan_id]', $loanId)!!}
                    {!! Form::hidden('financial['.$counter.'][period]', str_replace('(Provisional)', '', $blyear))!!}
                    @endif
                    <tr>
                      <?php
                      $expressionValue = " ";
                      $tooltipText = "";
                      if ($entry->hasFormula()) {
                        $tooltipText = "Formula: " . $entry->formula_reference . " = " . $entry->formula;
                      } else {
                        $tooltipText = "Field: " . $entry->formula_reference;
                      }
                      if (isset($financialDataExpression) && $financialDataExpression->offsetExists($entry->formula_reference)) {
                        $storedValue = $financialDataExpression->offsetGet($entry->formula_reference);
                        $expressionValue = $storedValue->getValue();
                      }

                      if (!isset($expressionValue) || $expressionValue == "") {
                        $expressionValue = " ";
                      }


                      ?>
                      <td width="50%" style="padding:5px;">
                        {!! Form::label($entry->attribute, $entry->entry) !!}
                        <!-- <sup><a href="#" data-toggle="tooltip" data-placement="top" title="{{$tooltipText}}">?</a></sup> -->
                      </td>
                      <td>
                        @if(!$entry->hasFormula() || $showTextFieldsForFormula)
                        {!! Form::text('financial['.$counter.']['.$entry->attribute.']',$expressionValue,array('id'=>'financial_'.$counter.'_'.$entry->attribute.'','class' =>'form-control','onkeypress'=>'return isNumberKey(event)',$setDisable)) !!}
                        {{--'onKeyDown'=>'numericValidation(this.value)')--}}
                        @else
                        {!! Form::label($entry->attribute, $expressionValue,array('id'=>'financial_'.$counter.'_'.$entry->attribute.'_label')) !!}
                        {!! Form::hidden('financial['.$counter.']['.$entry->attribute.']',$expressionValue, ['id' =>'financial_'.$counter.'_'.$entry->attribute.''])!!}
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    @endforeach
                  </table>
                </td>
              </tr>
            </table>
          </td>
          <?php $counter++; ?>
          @endforeach
        </tr>
      </table>
      <div class="row">
        <div class="col-md-12" style="margin-left:20px;">
          <?php
          $backDiv = 'Div6';
          if ($isPL) {
            $backDiv = 'Div7';
          }
          ?>
          {!! Form::button('<i class="fa fa-reply"></i> Back', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('$backDiv','$loanType','$endUseList', $amount, $loanTenure,'$loanId'); return false;", 'value'=> 'Back', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
          @if($user->isSME() || $user->isBankUser())
          {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
          @endif
          {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
          @if(Auth::user()->isAnalyst())
          {!! Form::submit('Save & Continue', array('class' => 'btn btn-success btn-cons sme_button', 'value'=>
          'Next', 'style' => 'margin-top:20px;margin-left:20px;')) !!}

          @endif
        </div>
      </div>
    </div>
  </div>


  <div id="dialog" title="Error" style="position: relative">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  {{--<button id="opener">Open Dialog</button>--}}


  <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

  <script>
//        $(document).ready(function(){
//            $("#dialog").dialog({
//                title: "dialog",
//                width: 360,
//                height: 365,
//                modal: false,
//                resizable: false,
//                open: function (event, ui) {
//                    $(this).animate({
//                        scrollTop: $(this).scrollTop() + $(this).height()
//                    });
//                }
//            });
//        });
$(function() {
  $( "#dialog" ).dialog({
    autoOpen: false,
    modal:true,
    width: 800,
    resizable: true,
    buttons: {
      OK: function() {
        $( this ).dialog( "close" );
      }
    },
    show: {
      effect: "blind",
      duration: 100
    },
    hide: {
      effect: "explode",
      duration: 1000
    }

  }).prev(".ui-dialog-titlebar").css("background","#9cbd31").prev(".ui-dialog-buttonset").css("text-align","center");
});

@if (count($errors) > 0)
$(window).scrollTop($(this).scrollTop() + $(this).height());
$(function() {
  $( "#dialog" ).dialog( "open" );
});
@endif

$('a').tooltip();
</script>

<script type="text/javascript">
  function limitText(limitField)
  {
//            if (limitField.value.indexOf('.') != -1) {
//                    var lastdigits = limitField.value.substring(limitField.value.indexOf(".") + 1, limitField.value.length);
//                    if (lastdigits.length >= 2) {
//                        limitField.value = limitField.value.substring(0, limitField.value.indexOf(".") + 2);
//                    }
//            }

return true;
}

function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (
                    (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
                    (charCode != 43 || $(element).val().indexOf('+') != -1) &&      // “+” CHECK PLUS, AND ONLY ONE.
                    (charCode != 42 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                    (charCode != 46 || $(element).val().indexOf('*') != -1) &&      // “*” CHECK DOT, AND ONLY ONE.
                    (charCode != 47 || $(element).val().indexOf('/') != -1) &&      // “/” CHECK DOT, AND ONLY ONE.
                    (charCode != 40 || $(element).val().indexOf("(") != -1) &&      // “(” CHECK (, AND ONLY ONE.
                    (charCode != 41 || $(element).val().indexOf(")") != -1) &&      // “)” CHECK ), AND ONLY ONE.
                    (charCode < 48 || charCode > 57))
    return false;

  return true;
}

function numericValidation(txtvalue) {
            // Allow two numbers after decimal
            var points = 0;
            points = txtvalue.indexOf(".", points);

            if (txtvalue.indexOf('.') != -1) {
              var lastdigits = txtvalue.substring(txtvalue.indexOf(".") + 1, txtvalue.length);
              if (lastdigits.length >= 2 ) {
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 17 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
                        // let it happen, don't do anything
                      }
                      else {
                        txtvalue.value = txtvalue.value.substring(0, 2);
//                        event.preventDefault();
}
}
}
else {
                // let it happen, don't do anything
              }
            }

            for (var index = 0; index <= 2; index++) {

              $("#financial_" + index + "_land_and_building").change(function () {
                calculateTotal();
              });

              $("#financial_" + index + "_plant_and_machinery").change(function () {
                calculateTotal();
              });

              $("#financial_" + index + "_capital_work_in_progress").change(function () {
                calculateTotal();
              });

              $("#financial_" + index + "_nca_others").change(function () {
                calculateTotal();
              });

            // $("#financial_" + index + "_tangible_assets").change(function () {
            //     calculateTotal();
            // });

            $("#financial_" + index + "_depreciation").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_intangible_assets").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_long_term_investments").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_short_term_investments").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_advances_to_nonrealated_party").change(function () {
              calculateTotal();
            });

              $("#financial_" + index + "_long_term_receivables").change(function () {
              calculateTotal();
            });

              $("#financial_" + index + "_advances_to_realated_party").change(function () {
              calculateTotal();
            });

            // $("#financial_" + index + "_investments").change(function () {
            //     calculateTotal();
            // });

            $("#financial_" + index + "_cash_balance").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_receivables_less_180_related").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_receivables_more_180_related").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_receivables_less_180_unrelated").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_receivables_more_180_unrelated").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_related_party_advances").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_third_party_advances").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_finished_goods").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_wip").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_raw_materials").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_capital_advances").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_advances_to_suppliers").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_mat_credit").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_advance_tax").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_ca_others").change(function () {
              calculateTotal();
            });
            // $("#financial_" + index + "_other_current_assets").change(function () {
            //     calculateTotal();
            // });
            // $("#financial_" + index + "_mat_credit").change(function () {
            //     calculateTotal();
            // });

            //Liabilities
            $("#financial_" + index + "_equity_share_capital").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_pref_share_capital_comp_conv").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_pref_share_capital_redeemable").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_share_premium").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_other_reserves").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_share_application_money").change(function () {
              calculateTotal();
            });
            // $("#financial_" + index + "_share_capital").change(function () {
            //     calculateTotal();
            // });
            // $("#financial_" + index + "_reserves").change(function () {
            //     calculateTotal();
            // });
            $("#financial_" + index + "_loans").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_long_term_borrowings").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_long_term_liabilities").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_long_term_provisions").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_deffered_tax_liability").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_short_term_loans").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_trade_payables").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_curr_long_term_debt").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_short_term_provisions").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_other_current_liabilities").change(function () {
              calculateTotal();
            });

            //Input P & L
            $("#financial_" + index + "_net_sales").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_oth_op_income").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_raw_materials_cost").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_salary_cost").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_power_fuel").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_freight_transportation").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_manuf_cost").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_advertising_cost").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_repairs").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_legal_charges").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_admin_costs").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_power_fuel").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_freight_transportation").change(function () {
              calculateTotal();
            });

            $("#financial_" + index + "_other_income").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_depreciation_cost").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_finance_cost").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_current_tax").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_deffered_tax").change(function () {
              calculateTotal();
            });
            $("#financial_" + index + "_tax").change(function () {
              calculateTotal();
            });


          }


          function calculateTotal() {

            for (var index = 0; index <= 2; index++) {

              var land_and_building = 0;
              var plant_and_machinery = 0;
              var capital_work_in_progress = 0;
              var nca_others = 0;
                //var tangible_assets = 0;
                var depreciation = 0;
                var intangible_assets = 0;
                var long_term_investments = 0;
                var short_term_investments = 0;
                var advances_to_nonrealated_party = 0;
                var long_term_receivables = 0;
                var advances_to_realated_party = 0;
               // var short_term_investments = 0;
                //var investments = 0;
                var cash_balance = 0;
                var receivables_less_180_related = 0;
                var receivables_more_180_related = 0;
                var receivables_less_180_unrelated = 0;
                var receivables_more_180_unrelated = 0;
                var related_party_advances = 0;
                var third_party_advances = 0;
                var finished_goods = 0;
                var wip = 0;
                var raw_materials = 0;
                var capital_advances = 0;
                var advances_to_suppliers = 0;
                var mat_credit = 0;
                var advance_tax = 0;
                var ca_others = 0;
                var other_current_assets = 0;
                var mat_credit = 0;

                var totalReceivablesFromRelated = 0;
                var totalReceivablesFromUnRelated = 0;
                var totalAdvances = 0;
                var totalInventories = 0;
                var totalTangibleAssets = 0;
                var totalNetFixedAssets = 0;
                var totalFixedAssets = 0;
                var totalInvestments = 0;
                var totalOtherCurrentAssets = 0;
                var totalCurrentAssets = 0;
                var totalAssets = 0;

                //Liabilities
                var equity_share_capital = 0;
                var pref_share_capital_comp_conv = 0;
                var pref_share_capital_redeemable = 0;
                var share_premium = 0;
                var other_reserves = 0;
                var share_application_money = 0;
                var share_capital = 0;
                var reserves = 0;
                var loans = 0;
                var long_term_borrowings = 0;
                var long_term_liabilities = 0;
                var long_term_provisions = 0;
                var deffered_tax_liability = 0;
                var short_term_loans = 0;
                var trade_payables = 0;
                var curr_long_term_debt = 0;
                var short_term_provisions = 0;
                var other_current_liabilities = 0;

                var totalShareCapital = 0;
                var totalReserves = 0;
                var totalNetWorth = 0;
                var totalShareholderFunds = 0;
                var totalLongTermLiabilities = 0;
                var totalCurrentLiabilities = 0;
                var totalLiabilities = 0;

                //Input P & L
                var net_sales = 0;
                var oth_op_income = 0;
                var raw_materials_cost = 0;
                var salary_cost = 0;
                var power_fuel = 0;
                var freight_transportation = 0;
                var manuf_cost = 0;
                var advertising_cost = 0;
                var repairs = 0;
                var legal_charges = 0;
                var admin_costs = 0;
                var other_income = 0;
                var depreciation_cost = 0;
                var finance_cost = 0;
                var current_tax = 0;
                var deffered_tax = 0;
                var tax = 0;

                var totalIncome = 0;
                var totalGrossProfit = 0;
                var totalEBITDA = 0;
                var totalTemp = 0;
                var totalTemp1 = 0;
                var totalPBT = 0;
                var totalTAX = 0;
                var totalPAT = 0;


                if ($.isNumeric($("#financial_" + index + "_land_and_building").val())) {
                  land_and_building = $("#financial_" + index + "_land_and_building").val();
                }
                else{
                  if($("#financial_" + index + "_land_and_building").val() == '' || $("#financial_" + index + "_land_and_building").val() == ' ') {

                    land_and_building = 0;
                  }
                  else {
                    land_and_building = eval($("#financial_" + index + "_land_and_building").val());
                    if ((document.getElementById("financial_" + index + "_land_and_building")) != null) {

                      document.getElementById("financial_" + index + "_land_and_building").value = land_and_building;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_plant_and_machinery").val())) {
                  plant_and_machinery = $("#financial_" + index + "_plant_and_machinery").val();
                }
                else{
                  if($("#financial_" + index + "_plant_and_machinery").val() == '' || $("#financial_" + index + "_plant_and_machinery").val() == ' ') {

                    plant_and_machinery = 0;
                  }
                  else {
                    plant_and_machinery = eval($("#financial_" + index + "_plant_and_machinery").val());
                    if ((document.getElementById("financial_" + index + "_plant_and_machinery")) != null) {

                      document.getElementById("financial_" + index + "_plant_and_machinery").value = plant_and_machinery;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_capital_work_in_progress").val())) {
                  capital_work_in_progress = $("#financial_" + index + "_capital_work_in_progress").val();
                }
                else{
                  if($("#financial_" + index + "_capital_work_in_progress").val() == '' || $("#financial_" + index + "_capital_work_in_progress").val() == ' ') {

                    capital_work_in_progress = 0;
                  }
                  else {
                    capital_work_in_progress = eval($("#financial_" + index + "_capital_work_in_progress").val());
                    if ((document.getElementById("financial_" + index + "_capital_work_in_progress")) != null) {

                      document.getElementById("financial_" + index + "_capital_work_in_progress").value = capital_work_in_progress;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_nca_others").val())) {
                  nca_others = $("#financial_" + index + "_nca_others").val();
                }
                else{
                  if($("#financial_" + index + "_nca_others").val() == '' || $("#financial_" + index + "_nca_others").val() == ' ') {

                    nca_others = 0;
                  }
                  else {
                    nca_others = eval($("#financial_" + index + "_nca_others").val());
                    if ((document.getElementById("financial_" + index + "_nca_others")) != null) {

                      document.getElementById("financial_" + index + "_nca_others").value = nca_others;
                    }
                  }
                }

                // if ($.isNumeric($("#financial_" + index + "_tangible_assets").val())) {
                //     tangible_assets = $("#financial_" + index + "_tangible_assets").val();
                // }
                // else{
                //     if($("#financial_" + index + "_tangible_assets").val() == '' || $("#financial_" + index + "_tangible_assets").val() == ' ') {

                //         tangible_assets = 0;
                //     }
                //     else {
                //         tangible_assets = eval($("#financial_" + index + "_tangible_assets").val());
                //         if ((document.getElementById("financial_" + index + "_tangible_assets")) != null) {

                //             document.getElementById("financial_" + index + "_tangible_assets").value = tangible_assets;
                //         }
                //     }
                // }

                if ($.isNumeric($("#financial_" + index + "_depreciation").val())) {
                  depreciation = $("#financial_" + index + "_depreciation").val();
                }
                else{
                  if($("#financial_" + index + "_depreciation").val() == '' || $("#financial_" + index + "_depreciation").val() == ' ') {
                    depreciation = 0;
                  }
                  else {
                    depreciation = eval($("#financial_" + index + "_depreciation").val());
                    if ((document.getElementById("financial_" + index + "_depreciation")) != null) {
                      document.getElementById("financial_" + index + "_depreciation").value = depreciation;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_intangible_assets").val())) {
                  intangible_assets = $("#financial_" + index + "_intangible_assets").val();
                }
                else{
                  if($("#financial_" + index + "_intangible_assets").val() == '' || $("#financial_" + index + "_intangible_assets").val() == ' ') {
                    intangible_assets = 0;
                  }
                  else {
                    intangible_assets = eval($("#financial_" + index + "_intangible_assets").val());
                    if ((document.getElementById("financial_" + index + "_intangible_assets")) != null) {
                      document.getElementById("financial_" + index + "_intangible_assets").value = intangible_assets;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_long_term_investments").val())) {
                  long_term_investments = $("#financial_" + index + "_long_term_investments").val();
                }
                else{
                  if($("#financial_" + index + "_long_term_investments").val() == '' || $("#financial_" + index + "_long_term_investments").val() == ' ') {
                    long_term_investments = 0;
                  }
                  else {
                    long_term_investments =  eval($("#financial_" + index + "_long_term_investments").val());
                    if ((document.getElementById("financial_" + index + "_long_term_investments")) != null) {
                      document.getElementById("financial_" + index + "_long_term_investments").value = long_term_investments;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_short_term_investments").val())) {
                  short_term_investments = $("#financial_" + index + "_short_term_investments").val();
                }
                else{
                  if($("#financial_" + index + "_short_term_investments").val() == '' || $("#financial_" + index + "_short_term_investments").val() == ' ') {
                    short_term_investments = 0;
                  }
                  else {
                    short_term_investments =  eval($("#financial_" + index + "_short_term_investments").val());
                    if ((document.getElementById("financial_" + index + "_short_term_investments")) != null) {
                      document.getElementById("financial_" + index + "_short_term_investments").value = short_term_investments;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_advances_to_nonrealated_party").val())) {
                  advances_to_nonrealated_party = $("#financial_" + index + "_advances_to_nonrealated_party").val();
                }
                else{
                  if($("#financial_" + index + "_advances_to_nonrealated_party").val() == '' || $("#financial_" + index + "_advances_to_nonrealated_party").val() == ' ') {
                    advances_to_nonrealated_party = 0;
                  }
                  else {
                    advances_to_nonrealated_party =  eval($("#financial_" + index + "_advances_to_nonrealated_party").val());
                    if ((document.getElementById("financial_" + index + "_advances_to_nonrealated_party")) != null) {
                      document.getElementById("financial_" + index + "_advances_to_nonrealated_party").value = advances_to_nonrealated_party;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_long_term_receivables").val())) {
                  long_term_receivables = $("#financial_" + index + "_long_term_receivables").val();
                }
                else{
                  if($("#financial_" + index + "_long_term_receivables").val() == '' || $("#financial_" + index + "_long_term_receivables").val() == ' ') {
                    long_term_receivables = 0;
                  }
                  else {
                    long_term_receivables =  eval($("#financial_" + index + "_long_term_receivables").val());
                    if ((document.getElementById("financial_" + index + "_long_term_receivables")) != null) {
                      document.getElementById("financial_" + index + "_long_term_receivables").value = long_term_receivables;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_advances_to_realated_party").val())) {
                  advances_to_realated_party = $("#financial_" + index + "_advances_to_realated_party").val();
                }
                else{
                  if($("#financial_" + index + "_advances_to_realated_party").val() == '' || $("#financial_" + index + "_advances_to_realated_party").val() == ' ') {
                    advances_to_realated_party = 0;
                  }
                  else {
                    advances_to_realated_party =  eval($("#financial_" + index + "_advances_to_realated_party").val());
                    if ((document.getElementById("financial_" + index + "_advances_to_realated_party")) != null) {
                      document.getElementById("financial_" + index + "_advances_to_realated_party").value = advances_to_realated_party;
                    }
                  }
                }

                // if ($.isNumeric($("#financial_" + index + "_investments").val())) {
                //     investments = $("#financial_" + index + "_investments").val();
                // }
                // else{
                //     if($("#financial_" + index + "_investments").val() == '' || $("#financial_" + index + "_investments").val() == ' ') {
                //         investments = 0;
                //     }
                //     else {
                //         investments =  eval($("#financial_" + index + "_investments").val());
                //         if ((document.getElementById("financial_" + index + "_investments")) != null) {
                //             document.getElementById("financial_" + index + "_investments").value = investments;
                //         }
                //     }
                // }

                if ($.isNumeric($("#financial_" + index + "_cash_balance").val())) {
                  cash_balance = $("#financial_" + index + "_cash_balance").val();
                }else{
                  if($("#financial_" + index + "_cash_balance").val() == '' || $("#financial_" + index + "_cash_balance").val() == ' ') {
                    cash_balance = 0;
                  }
                  else {
                    cash_balance = eval($("#financial_" + index + "_cash_balance").val());
                    if ((document.getElementById("financial_" + index + "_cash_balance")) != null) {
                      document.getElementById("financial_" + index + "_cash_balance").value = cash_balance;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_receivables_less_180_related").val())) {
                  receivables_less_180_related = $("#financial_" + index + "_receivables_less_180_related").val();
                }
                else{
                  if($("#financial_" + index + "_receivables_less_180_related").val() == '' || $("#financial_" + index + "_receivables_less_180_related").val() == ' ') {
                    receivables_less_180_related = 0;
                  }
                  else {
                    receivables_less_180_related = eval($("#financial_" + index + "_receivables_less_180_related").val());
                    if ((document.getElementById("financial_" + index + "_receivables_less_180_related")) != null) {
                      document.getElementById("financial_" + index + "_receivables_less_180_related").value = receivables_less_180_related;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_receivables_more_180_related").val())) {
                  receivables_more_180_related = $("#financial_" + index + "_receivables_more_180_related").val();
                }
                else{
                  if($("#financial_" + index + "_receivables_more_180_related").val() == '' || $("#financial_" + index + "_receivables_more_180_related").val() == ' ') {
                    receivables_more_180_related = 0;
                  }
                  else {
                    receivables_more_180_related = eval($("#financial_" + index + "_receivables_more_180_related").val());
                    if ((document.getElementById("financial_" + index + "_receivables_more_180_related")) != null) {
                      document.getElementById("financial_" + index + "_receivables_more_180_related").value = receivables_more_180_related;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_receivables_less_180_unrelated").val())) {
                  receivables_less_180_unrelated = $("#financial_" + index + "_receivables_less_180_unrelated").val();
                }
                else{
                  if($("#financial_" + index + "_receivables_less_180_unrelated").val() == '' || $("#financial_" + index + "_receivables_less_180_unrelated").val() == ' ') {
                    receivables_less_180_unrelated = 0;
                  }
                  else {
                    receivables_less_180_unrelated = eval($("#financial_" + index + "_receivables_less_180_unrelated").val());
                    if ((document.getElementById("financial_" + index + "_receivables_less_180_unrelated")) != null) {
                      document.getElementById("financial_" + index + "_receivables_less_180_unrelated").value = receivables_less_180_unrelated;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_receivables_more_180_unrelated").val())) {
                  receivables_more_180_unrelated = $("#financial_" + index + "_receivables_more_180_unrelated").val();
                }
                else{
                  if($("#financial_" + index + "_receivables_more_180_unrelated").val() == '' || $("#financial_" + index + "_receivables_more_180_unrelated").val() == ' ') {
                    receivables_more_180_unrelated = 0;
                  }
                  else {
                    receivables_more_180_unrelated = eval($("#financial_" + index + "_receivables_more_180_unrelated").val());
                    if ((document.getElementById("financial_" + index + "_receivables_more_180_unrelated")) != null) {
                      document.getElementById("financial_" + index + "_receivables_more_180_unrelated").value = receivables_more_180_unrelated;
                    }
                  }
                }

                // if ($.isNumeric($("#financial_" + index + "_receivables_less_180").val())) {
                //     receivables_less_180 = $("#financial_" + index + "_receivables_less_180").val();
                // }
                // else{
                //     if($("#financial_" + index + "_receivables_less_180").val() == '' || $("#financial_" + index + "_receivables_less_180").val() == ' ') {
                //         receivables_less_180 = 0;
                //     }
                //     else {
                //         receivables_less_180 = eval($("#financial_" + index + "_receivables_less_180").val());
                //         if ((document.getElementById("financial_" + index + "_receivables_less_180")) != null) {
                //             document.getElementById("financial_" + index + "_receivables_less_180").value = receivables_less_180;
                //         }
                //     }
                // }

                // if ($.isNumeric($("#financial_" + index + "_receivables_more_180").val())) {
                //     receivables_more_180 = $("#financial_" + index + "_receivables_more_180").val();
                // }
                // else{
                //     if($("#financial_" + index + "_receivables_more_180").val() == '' || $("#financial_" + index + "_receivables_more_180").val() == ' ') {
                //         receivables_more_180 = 0;
                //     }
                //     else {
                //         receivables_more_180 = eval($("#financial_" + index + "_receivables_more_180").val());
                //         if ((document.getElementById("financial_" + index + "_receivables_more_180")) != null) {
                //             document.getElementById("financial_" + index + "_receivables_more_180").value = receivables_more_180;
                //         }
                //     }
                // }

                if ($.isNumeric($("#financial_" + index + "_related_party_advances").val())) {
                  related_party_advances = $("#financial_" + index + "_related_party_advances").val();
                }
                else{
                  if($("#financial_" + index + "_related_party_advances").val() == '' || $("#financial_" + index + "_related_party_advances").val() == ' ') {
                    related_party_advances = 0;
                  }
                  else {
                    related_party_advances = eval($("#financial_" + index + "_related_party_advances").val());
                    if ((document.getElementById("financial_" + index + "_related_party_advances")) != null) {
                      document.getElementById("financial_" + index + "_related_party_advances").value = related_party_advances;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_third_party_advances").val())) {
                  third_party_advances = $("#financial_" + index + "_third_party_advances").val();
                }
                else{
                  if($("#financial_" + index + "_third_party_advances").val() == '' || $("#financial_" + index + "_third_party_advances").val() == ' ') {
                    third_party_advances = 0;
                  }
                  else {
                    third_party_advances = eval($("#financial_" + index + "_third_party_advances").val());
                    if ((document.getElementById("financial_" + index + "_third_party_advances")) != null) {
                      document.getElementById("financial_" + index + "_third_party_advances").value = third_party_advances;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_finished_goods").val())) {
                  finished_goods = $("#financial_" + index + "_finished_goods").val();
                }
                else{
                  if($("#financial_" + index + "_finished_goods").val() == '' || $("#financial_" + index + "_finished_goods").val() == ' ') {
                    finished_goods = 0;
                  }
                  else {
                    finished_goods = eval($("#financial_" + index + "_finished_goods").val());
                    if ((document.getElementById("financial_" + index + "_finished_goods")) != null) {
                      document.getElementById("financial_" + index + "_finished_goods").value = finished_goods;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_wip").val())) {
                  wip = $("#financial_" + index + "_wip").val();
                }
                else{
                  if($("#financial_" + index + "_wip").val() == '' || $("#financial_" + index + "_wip").val() == ' ') {
                    wip = 0;
                  }
                  else {
                    wip = eval($("#financial_" + index + "_wip").val());
                    if ((document.getElementById("financial_" + index + "_wip")) != null) {
                      document.getElementById("financial_" + index + "_wip").value = wip;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_raw_materials").val())) {
                  raw_materials = $("#financial_" + index + "_raw_materials").val();
                }
                else{
                  if($("#financial_" + index + "_raw_materials").val() == '' || $("#financial_" + index + "_raw_materials").val() == ' ') {
                    raw_materials = 0;
                  }
                  else {
                    raw_materials = eval($("#financial_" + index + "_raw_materials").val());
                    if ((document.getElementById("financial_" + index + "_raw_materials")) != null) {
                      document.getElementById("financial_" + index + "_raw_materials").value = raw_materials;
                    }
                  }
                }

                // if ($.isNumeric($("#financial_" + index + "_inventories").val())) {
                //     inventories = $("#financial_" + index + "_inventories").val();
                // }
                // else{
                //     if($("#financial_" + index + "_inventories").val() == '' || $("#financial_" + index + "_inventories").val() == ' ') {
                //         inventories = 0;
                //     }
                //     else {
                //         inventories = eval($("#financial_" + index + "_inventories").val());
                //         if ((document.getElementById("financial_" + index + "_inventories")) != null) {
                //             document.getElementById("financial_" + index + "_inventories").value = inventories;
                //         }
                //     }
                // }

                if ($.isNumeric($("#financial_" + index + "_capital_advances").val())) {
                  capital_advances = $("#financial_" + index + "_capital_advances").val();
                }
                else{
                  if($("#financial_" + index + "_capital_advances").val() == '' || $("#financial_" + index + "_capital_advances").val() == ' ') {
                    capital_advances = 0;
                  }
                  else {
                    capital_advances = eval($("#financial_" + index + "_capital_advances").val());
                    if ((document.getElementById("financial_" + index + "_capital_advances")) != null) {
                      document.getElementById("financial_" + index + "_capital_advances").value = capital_advances;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_advances_to_suppliers").val())) {
                  advances_to_suppliers = $("#financial_" + index + "_advances_to_suppliers").val();
                }
                else{
                  if($("#financial_" + index + "_advances_to_suppliers").val() == '' || $("#financial_" + index + "_advances_to_suppliers").val() == ' ') {
                    advances_to_suppliers = 0;
                  }
                  else {
                    advances_to_suppliers = eval($("#financial_" + index + "_advances_to_suppliers").val());
                    if ((document.getElementById("financial_" + index + "_advances_to_suppliers")) != null) {
                      document.getElementById("financial_" + index + "_advances_to_suppliers").value = advances_to_suppliers;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_mat_credit").val())) {
                  mat_credit = $("#financial_" + index + "_mat_credit").val();
                }
                else{
                  if($("#financial_" + index + "_mat_credit").val() == '' || $("#financial_" + index + "_mat_credit").val() == ' ') {
                    mat_credit = 0;
                  }
                  else {
                    mat_credit = eval($("#financial_" + index + "_mat_credit").val());
                    if ((document.getElementById("financial_" + index + "_mat_credit")) != null) {
                      document.getElementById("financial_" + index + "_mat_credit").value = mat_credit;
                    }
                  }
                }
                if ($.isNumeric($("#financial_" + index + "_advance_tax").val())) {
                  advance_tax = $("#financial_" + index + "_advance_tax").val();
                }
                else{
                  if($("#financial_" + index + "_advance_tax").val() == '' || $("#financial_" + index + "_advance_tax").val() == ' ') {
                    advance_tax = 0;
                  }
                  else {
                    advance_tax = eval($("#financial_" + index + "_advance_tax").val());
                    if ((document.getElementById("financial_" + index + "_advance_tax")) != null) {
                      document.getElementById("financial_" + index + "_advance_tax").value = advance_tax;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_ca_others").val())) {
                  ca_others = $("#financial_" + index + "_ca_others").val();
                }
                else{
                  if($("#financial_" + index + "_ca_others").val() == '' || $("#financial_" + index + "_ca_others").val() == ' ') {
                    ca_others = 0;
                  }
                  else {
                    ca_others = eval($("#financial_" + index + "_ca_others").val());
                    if ((document.getElementById("financial_" + index + "_ca_others")) != null) {
                      document.getElementById("financial_" + index + "_ca_others").value = ca_others;
                    }
                  }
                }

                // if ($.isNumeric($("#financial_" + index + "_other_current_assets").val())) {
                //     other_current_assets = $("#financial_" + index + "_other_current_assets").val();
                // }
                // else{
                //     if($("#financial_" + index + "_other_current_assets").val() == '' || $("#financial_" + index + "_other_current_assets").val() == ' ') {
                //         other_current_assets = 0;
                //     }
                //     else {
                //         other_current_assets = eval($("#financial_" + index + "_other_current_assets").val());
                //         if ((document.getElementById("financial_" + index + "_other_current_assets")) != null) {
                //             document.getElementById("financial_" + index + "_other_current_assets").value = other_current_assets;
                //         }
                //     }
                // }

                // if ($.isNumeric($("#financial_" + index + "_mat_credit").val())) {
                //     mat_credit = $("#financial_" + index + "_mat_credit").val();
                // }
                // else{
                //     if($("#financial_" + index + "_mat_credit").val() == '' || $("#financial_" + index + "_mat_credit").val() == ' ') {
                //         mat_credit = 0;
                //     }
                //     else {
                //         mat_credit = eval($("#financial_" + index + "_mat_credit").val());
                //         if ((document.getElementById("financial_" + index + "_mat_credit")) != null) {
                //             document.getElementById("financial_" + index + "_mat_credit").value = mat_credit;
                //         }
                //     }
                // }

                //Liabilities

                if ($.isNumeric($("#financial_" + index + "_equity_share_capital").val())) {
                  equity_share_capital = $("#financial_" + index + "_equity_share_capital").val();
                }
                else{
                  if($("#financial_" + index + "_equity_share_capital").val() == '' || $("#financial_" + index + "_equity_share_capital").val() == ' ') {
                    equity_share_capital = 0;
                  }
                  else {
                    equity_share_capital = eval($("#financial_" + index + "_equity_share_capital").val());
                    if ((document.getElementById("financial_" + index + "_equity_share_capital")) != null) {
                      document.getElementById("financial_" + index + "_equity_share_capital").value = equity_share_capital;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_pref_share_capital_comp_conv").val())) {
                  pref_share_capital_comp_conv = $("#financial_" + index + "_pref_share_capital_comp_conv").val();
                }
                else{
                  if($("#financial_" + index + "_pref_share_capital_comp_conv").val() == '' || $("#financial_" + index + "_pref_share_capital_comp_conv").val() == ' ') {
                    pref_share_capital_comp_conv = 0;
                  }
                  else {
                    pref_share_capital_comp_conv = eval($("#financial_" + index + "_pref_share_capital_comp_conv").val());
                    if ((document.getElementById("financial_" + index + "_pref_share_capital_comp_conv")) != null) {
                      document.getElementById("financial_" + index + "_pref_share_capital_comp_conv").value = pref_share_capital_comp_conv;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_pref_share_capital_redeemable").val())) {
                  pref_share_capital_redeemable = $("#financial_" + index + "_pref_share_capital_redeemable").val();
                }
                else{
                  if($("#financial_" + index + "_pref_share_capital_redeemable").val() == '' || $("#financial_" + index + "_pref_share_capital_redeemable").val() == ' ') {
                    pref_share_capital_redeemable = 0;
                  }
                  else {
                    pref_share_capital_redeemable = eval($("#financial_" + index + "_pref_share_capital_redeemable").val());
                    if ((document.getElementById("financial_" + index + "_pref_share_capital_redeemable")) != null) {
                      document.getElementById("financial_" + index + "_pref_share_capital_redeemable").value = pref_share_capital_redeemable;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_share_premium").val())) {
                  share_premium = $("#financial_" + index + "_share_premium").val();
                }
                else{
                  if($("#financial_" + index + "_share_premium").val() == '' || $("#financial_" + index + "_share_premium").val() == ' ') {
                    share_premium = 0;
                  }
                  else {
                    share_premium = eval($("#financial_" + index + "_share_premium").val());
                    if ((document.getElementById("financial_" + index + "_share_premium")) != null) {
                      document.getElementById("financial_" + index + "_share_premium").value = share_premium;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_other_reserves").val())) {
                  other_reserves = $("#financial_" + index + "_other_reserves").val();
                }
                else{
                  if($("#financial_" + index + "_other_reserves").val() == '' || $("#financial_" + index + "_other_reserves").val() == ' ') {
                    other_reserves = 0;
                  }
                  else {
                    other_reserves = eval($("#financial_" + index + "_other_reserves").val());
                    if ((document.getElementById("financial_" + index + "_other_reserves")) != null) {
                      document.getElementById("financial_" + index + "_other_reserves").value = other_reserves;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_share_application_money").val())) {
                  share_application_money = $("#financial_" + index + "_share_application_money").val();
                }
                else{
                  if($("#financial_" + index + "_share_application_money").val() == '' || $("#financial_" + index + "_share_application_money").val() == ' ') {
                    share_application_money = 0;
                  }
                  else {
                    share_application_money = eval($("#financial_" + index + "_share_application_money").val());
                    if ((document.getElementById("financial_" + index + "_share_application_money")) != null) {
                      document.getElementById("financial_" + index + "_share_application_money").value = share_application_money;
                    }
                  }
                }

                // if ($.isNumeric($("#financial_" + index + "_share_capital").val())) {
                //     share_capital = $("#financial_" + index + "_share_capital").val();
                // }
                // else{
                //     if($("#financial_" + index + "_share_capital").val() == '' || $("#financial_" + index + "_share_capital").val() == ' ') {
                //         share_capital = 0;
                //     }
                //     else {
                //         share_capital = eval($("#financial_" + index + "_share_capital").val());
                //         if ((document.getElementById("financial_" + index + "_share_capital")) != null) {
                //             document.getElementById("financial_" + index + "_share_capital").value = share_capital;
                //         }
                //     }
                // }

                // if ($.isNumeric($("#financial_" + index + "_reserves").val())) {
                //     reserves = $("#financial_" + index + "_reserves").val();
                // }
                // else{
                //     if($("#financial_" + index + "_reserves").val() == '' || $("#financial_" + index + "_reserves").val() == ' ') {
                //         reserves = 0;
                //     }
                //     else {
                //         reserves = eval($("#financial_" + index + "_reserves").val());
                //         if ((document.getElementById("financial_" + index + "_reserves")) != null) {
                //             document.getElementById("financial_" + index + "_reserves").value = reserves;
                //         }
                //     }
                // }

                if ($.isNumeric($("#financial_" + index + "_loans").val())) {
                  loans = $("#financial_" + index + "_loans").val();
                }
                else{
                  if($("#financial_" + index + "_loans").val() == '' || $("#financial_" + index + "_loans").val() == ' ') {
                    loans = 0;
                  }
                  else {
                    loans = eval($("#financial_" + index + "_loans").val());
                    if ((document.getElementById("financial_" + index + "_loans")) != null) {
                      document.getElementById("financial_" + index + "_loans").value = loans;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_long_term_borrowings").val())) {
                  long_term_borrowings = $("#financial_" + index + "_long_term_borrowings").val();
                }
                else{
                  if($("#financial_" + index + "_long_term_borrowings").val() == '' || $("#financial_" + index + "_long_term_borrowings").val() == ' ') {
                    long_term_borrowings = 0;
                  }
                  else {
                    long_term_borrowings = eval($("#financial_" + index + "_long_term_borrowings").val());
                    if ((document.getElementById("financial_" + index + "_long_term_borrowings")) != null) {
                      document.getElementById("financial_" + index + "_long_term_borrowings").value = long_term_borrowings;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_long_term_liabilities").val())) {
                  long_term_liabilities = $("#financial_" + index + "_long_term_liabilities").val();
                }
                else{
                  if($("#financial_" + index + "_long_term_liabilities").val() == '' || $("#financial_" + index + "_long_term_liabilities").val() == ' ') {
                    long_term_liabilities = 0;
                  }
                  else {
                    long_term_liabilities = eval($("#financial_" + index + "_long_term_liabilities").val());
                    if ((document.getElementById("financial_" + index + "_long_term_liabilities")) != null) {
                      document.getElementById("financial_" + index + "_long_term_liabilities").value = long_term_liabilities;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_long_term_provisions").val())) {
                  long_term_provisions = $("#financial_" + index + "_long_term_provisions").val();
                }
                else{
                  if($("#financial_" + index + "_long_term_provisions").val() == '' || $("#financial_" + index + "_long_term_provisions").val() == ' ') {
                    long_term_provisions = 0;
                  }
                  else {
                    long_term_provisions = eval($("#financial_" + index + "_long_term_provisions").val());
                    if ((document.getElementById("financial_" + index + "_long_term_provisions")) != null) {
                      document.getElementById("financial_" + index + "_long_term_provisions").value = long_term_provisions;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_deffered_tax_liability").val())) {
                  deffered_tax_liability = $("#financial_" + index + "_deffered_tax_liability").val();
                }
                else{
                  if($("#financial_" + index + "_deffered_tax_liability").val() == '' || $("#financial_" + index + "_deffered_tax_liability").val() == ' ') {
                    deffered_tax_liability = 0;
                  }
                  else {
                    deffered_tax_liability = eval($("#financial_" + index + "_deffered_tax_liability").val());
                    if ((document.getElementById("financial_" + index + "_deffered_tax_liability")) != null) {
                      document.getElementById("financial_" + index + "_deffered_tax_liability").value = deffered_tax_liability;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_short_term_loans").val())) {
                  short_term_loans = $("#financial_" + index + "_short_term_loans").val();
                }
                else{
                  if($("#financial_" + index + "_short_term_loans").val() == '' || $("#financial_" + index + "_short_term_loans").val() == ' ') {
                    short_term_loans = 0;
                  }
                  else {
                    short_term_loans = eval($("#financial_" + index + "_short_term_loans").val());
                    if ((document.getElementById("financial_" + index + "_short_term_loans")) != null) {
                      document.getElementById("financial_" + index + "_short_term_loans").value = short_term_loans;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_trade_payables").val())) {
                  trade_payables = $("#financial_" + index + "_trade_payables").val();
                }
                else{
                  if($("#financial_" + index + "_trade_payables").val() == '' || $("#financial_" + index + "_trade_payables").val() == ' ') {
                    trade_payables = 0;
                  }
                  else {
                    trade_payables = eval($("#financial_" + index + "_trade_payables").val());
                    if ((document.getElementById("financial_" + index + "_trade_payables")) != null) {
                      document.getElementById("financial_" + index + "_trade_payables").value = trade_payables;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_curr_long_term_debt").val())) {
                  curr_long_term_debt = $("#financial_" + index + "_curr_long_term_debt").val();
                }
                else{
                  if($("#financial_" + index + "_curr_long_term_debt").val() == '' || $("#financial_" + index + "_curr_long_term_debt").val() == ' ') {
                    curr_long_term_debt = 0;
                  }
                  else {
                    curr_long_term_debt = eval($("#financial_" + index + "_curr_long_term_debt").val());
                    if ((document.getElementById("financial_" + index + "_curr_long_term_debt")) != null) {
                      document.getElementById("financial_" + index + "_curr_long_term_debt").value = curr_long_term_debt;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_short_term_provisions").val())) {
                  short_term_provisions = $("#financial_" + index + "_short_term_provisions").val();
                }
                else{
                  if($("#financial_" + index + "_short_term_provisions").val() == '' || $("#financial_" + index + "_short_term_provisions").val() == ' ') {
                    short_term_provisions = 0;
                  }
                  else {
                    short_term_provisions = eval($("#financial_" + index + "_short_term_provisions").val());
                    if ((document.getElementById("financial_" + index + "_short_term_provisions")) != null) {
                      document.getElementById("financial_" + index + "_short_term_provisions").value = short_term_provisions;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_other_current_liabilities").val())) {
                  other_current_liabilities = $("#financial_" + index + "_other_current_liabilities").val();
                }
                else{
                  if($("#financial_" + index + "_other_current_liabilities").val() == '' || $("#financial_" + index + "_other_current_liabilities").val() == ' ') {
                    other_current_liabilities = 0;
                  }
                  else {
                    other_current_liabilities = eval($("#financial_" + index + "_other_current_liabilities").val());
                    if ((document.getElementById("financial_" + index + "_other_current_liabilities")) != null) {
                      document.getElementById("financial_" + index + "_other_current_liabilities").value = other_current_liabilities;
                    }
                  }
                }

                //Input P & L
                if ($.isNumeric($("#financial_" + index + "_net_sales").val())) {
                  net_sales = $("#financial_" + index + "_net_sales").val();
                }
                else{
                  if($("#financial_" + index + "_net_sales").val() == '' || $("#financial_" + index + "_net_sales").val() == ' ') {
                    net_sales = 0;
                  }
                  else {
                    net_sales = eval($("#financial_" + index + "_net_sales").val());
                    if ((document.getElementById("financial_" + index + "_net_sales")) != null) {
                      document.getElementById("financial_" + index + "_net_sales").value = net_sales;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_oth_op_income").val())) {
                  oth_op_income = $("#financial_" + index + "_oth_op_income").val();
                }
                else{
                  if($("#financial_" + index + "_oth_op_income").val() == '' || $("#financial_" + index + "_oth_op_income").val() == ' ') {
                    oth_op_income = 0;
                  }
                  else {
                    oth_op_income = eval($("#financial_" + index + "_oth_op_income").val());
                    if ((document.getElementById("financial_" + index + "_oth_op_income")) != null) {
                      document.getElementById("financial_" + index + "_oth_op_income").value = oth_op_income;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_raw_materials_cost").val())) {
                  raw_materials_cost = $("#financial_" + index + "_raw_materials_cost").val();
                }
                else{
                  if($("#financial_" + index + "_raw_materials_cost").val() == '' || $("#financial_" + index + "_raw_materials_cost").val() == ' ') {
                    raw_materials_cost = 0;
                  }
                  else {
                    raw_materials_cost = eval($("#financial_" + index + "_raw_materials_cost").val());
                    if ((document.getElementById("financial_" + index + "_raw_materials_cost")) != null) {
                      document.getElementById("financial_" + index + "_raw_materials_cost").value = raw_materials_cost;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_salary_cost").val())) {
                  salary_cost = $("#financial_" + index + "_salary_cost").val();
                }
                else{
                  if($("#financial_" + index + "_salary_cost").val() == '' || $("#financial_" + index + "_salary_cost").val() == ' ') {
                    salary_cost = 0;
                  }
                  else {
                    salary_cost = eval($("#financial_" + index + "_salary_cost").val());
                    if ((document.getElementById("financial_" + index + "_salary_cost")) != null) {
                      document.getElementById("financial_" + index + "_salary_cost").value = salary_cost;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_manuf_cost").val())) {
                  manuf_cost = $("#financial_" + index + "_manuf_cost").val();
                }
                else{
                  if($("#financial_" + index + "_manuf_cost").val() == '' || $("#financial_" + index + "_manuf_cost").val() == ' ') {
                    manuf_cost = 0;
                  }
                  else {
                    manuf_cost = eval($("#financial_" + index + "_manuf_cost").val());
                    if ((document.getElementById("financial_" + index + "_manuf_cost")) != null) {
                      document.getElementById("financial_" + index + "_manuf_cost").value = manuf_cost;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_advertising_cost").val())) {
                  advertising_cost = $("#financial_" + index + "_advertising_cost").val();
                }
                else{
                  if($("#financial_" + index + "_advertising_cost").val() == '' || $("#financial_" + index + "_advertising_cost").val() == ' ') {
                    advertising_cost = 0;
                  }
                  else {
                    advertising_cost = eval($("#financial_" + index + "_advertising_cost").val());
                    if ((document.getElementById("financial_" + index + "_advertising_cost")) != null) {
                      document.getElementById("financial_" + index + "_advertising_cost").value = advertising_cost;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_repairs").val())) {
                  repairs = $("#financial_" + index + "_repairs").val();
                }
                else{
                  if($("#financial_" + index + "_repairs").val() == '' || $("#financial_" + index + "_repairs").val() == ' ') {
                    repairs = 0;
                  }
                  else {
                    repairs = eval($("#financial_" + index + "_repairs").val());
                    if ((document.getElementById("financial_" + index + "_repairs")) != null) {
                      document.getElementById("financial_" + index + "_repairs").value = repairs;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_legal_charges").val())) {
                  legal_charges = $("#financial_" + index + "_legal_charges").val();
                }
                else{
                  if($("#financial_" + index + "_legal_charges").val() == '' || $("#financial_" + index + "_legal_charges").val() == ' ') {
                    legal_charges = 0;
                  }
                  else {
                    legal_charges = eval($("#financial_" + index + "_legal_charges").val());
                    if ((document.getElementById("financial_" + index + "_legal_charges")) != null) {
                      document.getElementById("financial_" + index + "_legal_charges").value = legal_charges;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_admin_costs").val())) {
                  admin_costs = $("#financial_" + index + "_admin_costs").val();
                }
                else{
                  if($("#financial_" + index + "_admin_costs").val() == '' || $("#financial_" + index + "_admin_costs").val() == ' ') {
                    admin_costs = 0;
                  }
                  else {
                    admin_costs = eval($("#financial_" + index + "_admin_costs").val());
                    if ((document.getElementById("financial_" + index + "_admin_costs")) != null) {
                      document.getElementById("financial_" + index + "_admin_costs").value = admin_costs;
                    }
                  }
                } 

                if ($.isNumeric($("#financial_" + index + "_power_fuel").val())) {
                  power_fuel = $("#financial_" + index + "_power_fuel").val();
                }
                else{
                  if($("#financial_" + index + "_power_fuel").val() == '' || $("#financial_" + index + "_power_fuel").val() == ' ') {
                    power_fuel = 0;
                  }
                  else {
                    power_fuel = eval($("#financial_" + index + "_power_fuel").val());
                    if ((document.getElementById("financial_" + index + "_power_fuel")) != null) {
                      document.getElementById("financial_" + index + "_power_fuel").value = power_fuel;
                    }
                  }
                } 

                if ($.isNumeric($("#financial_" + index + "_freight_transportation").val())) {
                  freight_transportation = $("#financial_" + index + "_freight_transportation").val();
                }
                else{
                  if($("#financial_" + index + "_freight_transportation").val() == '' || $("#financial_" + index + "_freight_transportation").val() == ' ') {
                    freight_transportation = 0;
                  }
                  else {
                    freight_transportation = eval($("#financial_" + index + "_freight_transportation").val());
                    if ((document.getElementById("financial_" + index + "_freight_transportation")) != null) {
                      document.getElementById("financial_" + index + "_freight_transportation").value = freight_transportation;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_other_income").val())) {
                  other_income = $("#financial_" + index + "_other_income").val();
                }
                else{
                  if($("#financial_" + index + "_other_income").val() == '' || $("#financial_" + index + "_other_income").val() == ' ') {
                    other_income = 0;
                  }
                  else {
                    other_income = eval($("#financial_" + index + "_other_income").val());
                    if ((document.getElementById("financial_" + index + "_other_income")) != null) {
                      document.getElementById("financial_" + index + "_other_income").value = other_income;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_depreciation_cost").val())) {
                  depreciation_cost = $("#financial_" + index + "_depreciation_cost").val();
                }
                else{
                  if($("#financial_" + index + "_depreciation_cost").val() == '' || $("#financial_" + index + "_depreciation_cost").val() == ' ') {
                    depreciation_cost = 0;
                  }
                  else {
                    depreciation_cost = eval($("#financial_" + index + "_depreciation_cost").val());
                    if ((document.getElementById("financial_" + index + "_depreciation_cost")) != null) {
                      document.getElementById("financial_" + index + "_depreciation_cost").value = depreciation_cost;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_finance_cost").val())) {
                  finance_cost = $("#financial_" + index + "_finance_cost").val();
                }
                else{
                  if($("#financial_" + index + "_finance_cost").val() == '' || $("#financial_" + index + "_finance_cost").val() == ' ') {
                    finance_cost = 0;
                  }
                  else {
                    finance_cost = eval($("#financial_" + index + "_finance_cost").val());
                    if ((document.getElementById("financial_" + index + "_finance_cost")) != null) {
                      document.getElementById("financial_" + index + "_finance_cost").value = finance_cost;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_current_tax").val())) {
                  current_tax = $("#financial_" + index + "_current_tax").val();
                }
                else{
                  if($("#financial_" + index + "_current_tax").val() == '' || $("#financial_" + index + "_current_tax").val() == ' ') {
                    current_tax = 0;
                  }
                  else {
                    current_tax = eval($("#financial_" + index + "_current_tax").val());
                    if ((document.getElementById("financial_" + index + "_current_tax")) != null) {
                      document.getElementById("financial_" + index + "_current_tax").value = current_tax;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_deffered_tax").val())) {
                  deffered_tax = $("#financial_" + index + "_deffered_tax").val();
                }
                else{
                  if($("#financial_" + index + "_deffered_tax").val() == '' || $("#financial_" + index + "_deffered_tax").val() == ' ') {
                    deffered_tax = 0;
                  }
                  else {
                    deffered_tax = eval($("#financial_" + index + "_deffered_tax").val());
                    if ((document.getElementById("financial_" + index + "_deffered_tax")) != null) {
                      document.getElementById("financial_" + index + "_deffered_tax").value = deffered_tax;
                    }
                  }
                }

                if ($.isNumeric($("#financial_" + index + "_tax").val())) {
                  tax = $("#financial_" + index + "_tax").val();
                }
                else{
                  if($("#financial_" + index + "_tax").val() == '' || $("#financial_" + index + "_tax").val() == ' ') {
                    tax = 0;
                  }
                  else {
                    tax = eval($("#financial_" + index + "_tax").val());
                    if ((document.getElementById("financial_" + index + "_tax")) != null) {
                      document.getElementById("financial_" + index + "_tax").value = tax;
                    }
                  }
                }

                totalTangibleAssets = Number(land_and_building) + Number(plant_and_machinery) + Number(intangible_assets) + Number(nca_others);
                setFieldValue('#financial_' + index + '_tangible_assets', Number(totalTangibleAssets.toFixed(1)));

//                if ($("#financial_" + index + "_depreciation").val() != ' ' && $("#financial_" + index + "_tangible_assets").val() != ' ') {

  totalNetFixedAssets = Number(totalTangibleAssets) - Number(depreciation);
//                    $('#financial_' + index + '_net_fixed_assets').text(Number(totalNetFixedAssets.toFixed(1)));
setFieldValue('#financial_' + index + '_net_fixed_assets', Number(totalNetFixedAssets.toFixed(1)));
//                }
//                else {
//                    $('#financial_' + index + '_net_fixed_assets').text(Number(0));
////                    setFieldValue('#financial_' + index + '_net_salest_fixed_assets', Number(0));
//                }

//                if ($("#financial_" + index + "_depreciation").val() != ' ' && $("#financial_" + index + "_tangible_assets").val() != ' ' && $("#financial_" + index + "_intangible_assets").val() != ' ') {
                    totalFixedAssets = totalNetFixedAssets + Number(capital_work_in_progress);
                    //$('#financial_' + index + '_total_fixed_assets').text(Number(totalFixedAssets.toFixed(1)));
                    setFieldValue('#financial_' + index + '_total_fixed_assets', Number(totalFixedAssets.toFixed(1)));

                    totalInvestments = Number(long_term_investments) + Number(short_term_investments);
                    setFieldValue('#financial_' + index + '_investments', Number(totalInvestments.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_total_fixed_assets').text(Number(0));
//                    setFieldValue('#financial_' + index + '_total_fixed_assets', Number(0));
//                }

totalReceivablesFromRelated = Number(receivables_less_180_related) + Number(receivables_more_180_related);
setFieldValue('#financial_' + index + '_receivables_from_related_party', Number(totalReceivablesFromRelated.toFixed(1)));



totalReceivablesFromUnRelated = Number(receivables_less_180_unrelated) + Number(receivables_more_180_unrelated);
setFieldValue('#financial_' + index + '_receivables_from_unrelated_party', Number(totalReceivablesFromUnRelated.toFixed(1)));

totalInventories = Number(finished_goods) + Number(wip) + Number(raw_materials);
setFieldValue('#financial_' + index + '_inventories', Number(totalInventories.toFixed(1)));

totalOtherCurrentAssets = Number(capital_advances) + Number(advances_to_suppliers) + Number(mat_credit) + Number(advance_tax) + Number(ca_others);
setFieldValue('#financial_' + index + '_other_current_assets', Number(totalOtherCurrentAssets.toFixed(1)));

long_term_advances = Number(advances_to_nonrealated_party) + Number(long_term_receivables)+ Number(advances_to_realated_party);
setFieldValue('#financial_' + index + '_long_term_advances', Number(long_term_advances.toFixed(1)));


//                if ($("#financial_" + index + "_cash_balance").val() != ' ' && $("#financial_" + index + "_receivables_less_180").val() != ' ' && $("#financial_" + index + "_receivables_less_180").val() != ' ' &&
//                        $("#financial_" + index + "_related_party_advances").val() != ' ' && $("#financial_" + index + "_third_party_advances").val() != ' ' && $("#financial_" + index + "_inventories").val() != ' ' && $("#financial_" + index + "_other_current_assets").val() != ' ') {
  totalCurrentAssets = Number(cash_balance) + Number(totalReceivablesFromRelated) + Number(totalReceivablesFromUnRelated) + Number(related_party_advances) + Number(third_party_advances) + Number(totalInventories) + Number(totalOtherCurrentAssets);
                    //$('#financial_' + index + '_total_current_assets').text(Number(totalCurrentAssets.toFixed(1)));
                    setFieldValue('#financial_' + index + '_total_current_assets', Number(totalCurrentAssets.toFixed(1)));

//                }
//                else {
//                    //$('#financial_' + index + '_total_current_assets').text(Number(0));
//                    setFieldValue('#financial_' + index + '_total_current_assets', Number(0));
//                }

//                if ($("#financial_" + index + "_depreciation").val() != ' ' && $("#financial_" + index + "_tangible_assets").val() != ' ' && $("#financial_" + index + "_intangible_assets").val() != ' ' && $("#financial_" + index + "_investments").val() != ' ' &&
//                        $("#financial_" + index + "_cash_balance").val() != ' ' && $("#financial_" + index + "_receivables_less_180").val() != ' ' && $("#financial_" + index + "_receivables_less_180").val() != ' ' &&
//                        $("#financial_" + index + "_related_party_advances").val() != ' ' && $("#financial_" + index + "_third_party_advances").val() != ' ' && $("#financial_" + index + "_inventories").val() != ' ' && $("#financial_" + index + "_other_current_assets").val() != ' ') {

    totalAssets = totalFixedAssets + totalInvestments + totalCurrentAssets + long_term_advances;
   // totalAssets = totalFixedAssets + totalInvestments + totalCurrentAssets ;
                    //$('#financial_' + index + '_total_assets').text(Number(totalAssets.toFixed(1)));
                    setFieldValue('#financial_' + index + '_total_assets', Number(totalAssets.toFixed(1)));
//                }
//                else {
//                   // $('#financial_' + index + '_total_assets').text(Number(0));
//                    setFieldValue('#financial_' + index + '_total_assets', Number(0));
//                }

                //Liabilities
                    //console.log(equity_share_capital, pref_share_capital_comp_conv, pref_share_capital_redeemable);
                    totalShareCapital = Number(equity_share_capital) + Number(pref_share_capital_comp_conv) + Number(pref_share_capital_redeemable);
                    setFieldValue('#financial_' + index + '_total_share_capital', Number(totalShareCapital.toFixed(1)));

                    totalReserves = Number(share_premium) + Number(other_reserves) + Number(share_application_money);
                    setFieldValue('#financial_' + index + '_total_reserves', Number(totalReserves.toFixed(1)));
//                if ($("#financial_" + index + "_share_capital").val() != ' ' && $("#financial_" + index + "_reserves").val() != ' ') {
  totalNetWorth = Number(totalShareCapital) + Number(totalReserves);
                    //$('#financial_' + index + '_net_worth').text(Number(totalNetWorth.toFixed(1)));
                    setFieldValue('#financial_' + index + '_net_worth', Number(totalNetWorth.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_net_worth').text(Number(0));
//                    setFieldValue('#financial_' + index + '_net_worth', Number(0));
//                }

//                if ($("#financial_" + index + "_share_capital").val() != ' ' && $("#financial_" + index + "_reserves").val() != ' ' && $("#financial_" + index + "_loans").val() != ' ') {
  totalShareholderFunds = totalNetWorth + Number(loans);
                    //$('#financial_' + index + '_total_shareholders_funds').text(Number(totalShareholderFunds.toFixed(1)));
                    setFieldValue('#financial_' + index + '_total_shareholders_funds', Number(totalShareholderFunds.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_total_shareholders_funds').text(Number(0));
//                    setFieldValue('#financial_' + index + '_total_shareholders_funds', Number(0));
//                }

//                if ($("#financial_" + index + "_long_term_borrowings").val() != ' ' && $("#financial_" + index + "_long_term_liabilities").val() != ' ' && $("#financial_" + index + "_long_term_provisions").val() != ' ') {
  totalLongTermLiabilities = Number(long_term_borrowings) + Number(long_term_liabilities) + Number(long_term_provisions) + Number(deffered_tax_liability);
                    //$('#financial_' + index + '_total_long_term_liabilities').text(Number(totalLongTermLiabilities.toFixed(1)));
                    setFieldValue('#financial_' + index + '_total_long_term_liabilities', Number(totalLongTermLiabilities.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_total_long_term_liabilities').text(Number(0));
//                    setFieldValue('#financial_' + index + '_total_long_term_liabilities', Number(0));
//                }

//                if ($("#financial_" + index + "_short_term_loans").val() != ' ' && $("#financial_" + index + "_trade_payables").val() != ' ' && $("#financial_" + index + "_curr_long_term_debt").val() != ' ' && $("#financial_" + index + "_other_current_liabilities").val() != ' ') {
  totalCurrentLiabilities = Number(short_term_loans) + Number(trade_payables) + Number(curr_long_term_debt) + Number(short_term_provisions) + Number(other_current_liabilities);
                    //$('#financial_' + index + '_total_current_liabilities').text(Number(totalCurrentLiabilities.toFixed(1)));
                    setFieldValue('#financial_' + index + '_total_current_liabilities', Number(totalCurrentLiabilities.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_total_current_liabilities').text(Number(0));
//                    setFieldValue('#financial_' + index + '_total_current_liabilities', Number(0));
//                }

//                if ($("#financial_" + index + "_share_capital").val() != ' ' && $("#financial_" + index + "_reserves").val() != ' ' && $("#financial_" + index + "_loans").val() != ' ' &&
//                        $("#financial_" + index + "_long_term_borrowings").val() != ' ' && $("#financial_" + index + "_long_term_liabilities").val() != ' ' && $("#financial_" + index + "_long_term_provisions").val() != ' ' &&
//                        $("#financial_" + index + "_short_term_loans").val() != ' ' && $("#financial_" + index + "_trade_payables").val() != ' ' && $("#financial_" + index + "_curr_long_term_debt").val() != ' ' && $("#financial_" + index + "_other_current_liabilities").val() != ' ') {
  totalLiabilities = totalShareholderFunds + totalLongTermLiabilities + totalCurrentLiabilities;
                    //$('#financial_' + index + '_total_liabilities').text(Number(totalLiabilities.toFixed(1)));
                    setFieldValue('#financial_' + index + '_total_liabilities', Number(totalLiabilities.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_total_liabilities').text(Number(0));
//                    setFieldValue('#financial_' + index + '_total_liabilities', Number(0));
//                }

                //Input P & L
//                if ($("#financial_" + index + "_net_sales").val() != ' ' && $("#financial_" + index + "_oth_op_income").val() != ' ') {
  totalIncome = Number(net_sales) + Number(oth_op_income);
                    //$('#financial_' + index + '_net_revenue').text(Number(totalIncome.toFixed(1)));
                    setFieldValue('#financial_' + index + '_net_revenue', Number(totalIncome.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_net_revenue').text(Number(0));
//                    setFieldValue('#financial_' + index + '_net_revenue', Number(0));
//                }

//                if ($("#financial_" + index + "_net_sales").val() != ' ' && $("#financial_" + index + "_oth_op_income").val() != ' ' && $("#financial_" + index + "_raw_materials").val() != ' ') {
  totalGrossProfit = totalIncome - Number(raw_materials_cost);
                    //$('#financial_' + index + '_gross_profit').text(Number(totalGrossProfit.toFixed(1)));
                    setFieldValue('#financial_' + index + '_gross_profit', Number(totalGrossProfit.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_gross_profit').text(Number(0));
//                    setFieldValue('#financial_' + index + '_gross_profit', Number(0));
//                }

totalTemp = Number(salary_cost) + Number(manuf_cost) + Number(advertising_cost) + Number(repairs) + Number(legal_charges) + Number(admin_costs) + Number(power_fuel)+ Number(freight_transportation);
//                if ($("#financial_" + index + "_net_sales").val() != ' ' && $("#financial_" + index + "_oth_op_income").val() != ' ' && $("#financial_" + index + "_raw_materials").val() != ' ' &&
//                        $("#financial_" + index + "_salary_cost").val() != ' ' && $("#financial_" + index + "_manuf_cost").val() != ' ' && $("#financial_" + index + "_advertising_cost").val() != ' ' && $("#financial_" + index + "_admin_costs").val() != ' ') {

  totalEBITDA = totalGrossProfit - totalTemp;
                    //$('#financial_' + index + '_ebitda').text(Number(totalEBITDA.toFixed(1)));
                    setFieldValue('#financial_' + index + '_ebitda', Number(totalEBITDA.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_ebitda').text(Number(0));
//                    setFieldValue('#financial_' + index + '_ebitda', Number(0));
//                }


//                if ($("#financial_" + index + "_net_sales").val() != ' ' && $("#financial_" + index + "_oth_op_income").val() != ' ' && $("#financial_" + index + "_raw_materials").val() != ' ' &&
//                        $("#financial_" + index + "_salary_cost").val() != ' ' && $("#financial_" + index + "_manuf_cost").val() != ' ' && $("#financial_" + index + "_advertising_cost").val() != ' ' && $("#financial_" + index + "_admin_costs").val() != ' ' &&
//                        $("#financial_" + index + "_other_income").val() != ' ' && $("#financial_" + index + "_depreciation1").val() != ' ' && $("#financial_" + index + "_finance_cost").val() != ' ') {
  totalPBT = Number(totalEBITDA) + Number(other_income) - Number(depreciation_cost) - Number(finance_cost);
                    //$('#financial_' + index + '_pbt').text(Number(totalPBT.toFixed(1)));
                    setFieldValue('#financial_' + index + '_pbt', Number(totalPBT.toFixed(1)));
//                }
//                else {
//                    //$('#financial_' + index + '_pbt').text(Number(0));
//                    setFieldValue('#financial_' + index + '_pbt', Number(0));
//                }

totalTAX = Number(current_tax) + Number(deffered_tax);
setFieldValue('#financial_' + index + '_tax', Number(totalTAX.toFixed(1)));

            //                if ($("#financial_" + index + "_net_sales").val() != ' ' && $("#financial_" + index + "_oth_op_income").val() != ' ' && $("#financial_" + index + "_raw_materials").val() != ' ' &&
            //                        $("#financial_" + index + "_salary_cost").val() != ' ' && $("#financial_" + index + "_manuf_cost").val() != ' ' && $("#financial_" + index + "_advertising_cost").val() != ' ' && $("#financial_" + index + "_admin_costs").val() != ' ' &&
            //                        $("#financial_" + index + "_other_income").val() != ' ' && $("#financial_" + index + "_depreciation1").val() != ' ' && $("#financial_" + index + "_finance_cost").val() != ' ' && $("#financial_" + index + "_tax").val() != ' ') {
              totalPAT = totalPBT - Number(totalTAX);
                    //$('#financial_' + index + '_pat').text(Number(totalPAT.toFixed(1)));
                    setFieldValue('#financial_' + index + '_pat', Number(totalPAT.toFixed(1)));
          //                }
          //                else {
          //                    //$('#financial_' + index + '_pat').text(Number(0));
          //                    setFieldValue('#financial_' + index + '_pat', Number(0));
          //                }
        }
      }

      function setFieldValue(fieldName, value){
        if($(fieldName).length){
          $(fieldName).val(value);
        }

        if($(fieldName+"_label").length){
          $(fieldName+"_label").text(value);
        }
      }
      calculateTotal();
    </script>
