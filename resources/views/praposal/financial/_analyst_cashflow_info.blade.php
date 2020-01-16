 <div class="card">
   <div class="card-header" data-background-color="green">
     <h4 class="title">Cashflow <span class="pull-right">{{ $userProfileFirm->name_of_firm }}</span></h4>
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
                                        <tr class="cf-group-header">
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

                                        @foreach($group->financialEntries as $entry)
                                        @if(isset($financialDataRecord))
                                        {!! Form::hidden('financial['.$counter.'][id]',
                                        $financialDataRecord->id)!!}
                                        {!! Form::hidden('financial['.$counter.'][loan_id]',
                                        $financialDataRecord->loan_id)!!}
                                        {!! Form::hidden('financial['.$counter.'][period]',
                                        $financialDataRecord->period)!!}
                                        @else
                                        {!! Form::hidden('financial['.$counter.'][loan_id]', $loanId)!!}
                                        {!! Form::hidden('financial['.$counter.'][period]', str_replace('(Provisional)', '', $blyear))!!}
                                        @endif

                                        <?php 
                                        $highlight_class = '';
                                        if($entry->entry == 'Net Cashflow from Operations' || $entry->entry == 'Net Cashflow after Investing Activities' || $entry->entry == 'Net Cashflow after Financing Activity'){
                                            $highlight_class = 'cashflow-highlight-col';
                                        }

                                        if($entry->entry == 'Opening Cash and Cash Equivalents' || $entry->entry == 'Surplus (Deficit) during the year' || $entry->entry == 'Closing Cash and Cash Equivalent'){
                                            $highlight_class = 'cf-bottom-result';
                                        }
                                        ?>

                                        <tr class="{{$highlight_class}}">
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
                                            <td style="padding:5px;">

                                                {!! Form::label($entry->attribute, $expressionValue,array('id'=>'financial_'.$counter.'_'.$entry->attribute.'_label')) !!}
                                                {!! Form::hidden('financial['.$counter.']['.$entry->attribute.']',$expressionValue, ['id' =>'financial_'.$counter.'_'.$entry->attribute.''])!!}
                                                
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
                    {!! Form::submit('Calculated Ratios', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div9','$loanType','$endUseList', $amount, $loanTenure, '$loanId'); return false;", 'value'=>'Next', 'style' => 'margin-top:20px;margin-left:20px;')) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>




    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

    <script>
        $('a').tooltip();
    </script>



    