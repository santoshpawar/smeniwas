 <div class="card">
     <div class="card-header" data-background-color="green">
       <h4 class="title">Calculated Ratios <span class="pull-right">{{ $userProfileFirm->name_of_firm }}</span></h4>
       {{--    <p class="category">Apply new loan</p> --}}
   </div>
   <div class="card-content">
    <div class="col-md-12 input">
       
        <div class="tab-content tab-design" style="padding-top:20px;padding-left: 5px;">
            <?php
            $counter = 0;
            $isAnyThresholdBreached = false;
            $isAnyExpressionInvalid = false;
            ?>
            <table width="99%" style="margin-left: 5px;">
                <tr><td colspan="3"></td></tr>
                <tr>
                    @foreach($bl_year as $blyear)
                    <?php
                    $financialDataExpression = null;
                    $key_blyear = str_replace('(Provisional)', '', $blyear);

                    if($financialDataExpressionsMap->offsetExists($key_blyear)){
                        $financialDataExpression = $financialDataExpressionsMap->offsetGet($key_blyear);
                    }

                    $financialDataRecord = null;

                    if($financialDataMap->offsetExists($key_blyear)){
                        $financialDataRecord = $financialDataMap->offsetGet($key_blyear);
                    }

                    $showTextFieldsForFormula = false;

                    if(isset($showFormulaText) && $showFormulaText){
                        $showTextFieldsForFormula = true;
                    }
                    ?>
                    <td style="width: 33%" align="center">
                        {!! Form::label($blyear, $blyear) !!}

                        <table>
                            <tr>
                                <td>
                                    <table class="table table-condensed table-bordered">
                                        <?php $entryNumCounter = 0; ?>
                                        @foreach($financialGroups as $group)
                                        <tr><td colspan="2" align="center"><b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b></td></tr>
                                        @foreach($group->financialEntries as $entry)
                                        {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][ratio_id]', $entry->id)!!}
                                        @if(isset($financialDataRecord))
                                        {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][id]', $financialDataRecord->id)!!}
                                        {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][loan_id]', $financialDataRecord->loan_id)!!}
                                        {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][period]', $financialDataRecord->period)!!}
                                        @else
                                        {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][loan_id]', $loanId)!!}
                                        {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][period]', str_replace('(Provisional)', '', $blyear))!!}
                                        @endif
                                        <?php
                                        $expressionValue = "";
                                        $processExpression = true;
                                        $isInvalidExpression = false;
                                        $isThresholdBreached = false;
                                        $isCombinedThreshold = $entry->hasCombinedTolerance();

                                        $tooltipText = "";
                                        if($entry->hasFormula()){
                                            $tooltipText = "Formula: " . $entry->formula_reference . " = ". $entry->formula;
                                        }else{
                                            $tooltipText = "Field: "  . $entry->formula_reference;
                                        }
                                        if(isset($financialDataExpression) && $financialDataExpression->offsetExists($entry->formula_reference)){
                                            $storedValue = $financialDataExpression->offsetGet($entry->formula_reference);

                                            if(isset($storedValue)){
                                                $expressionValue = $storedValue->getValue();

                                                $isInvalidExpression = $storedValue->isInvalidExpression();
                                                if($isInvalidExpression && $expressionValue==0){
                                                    $expressionValue = " ";
                                                }

                                                if($isInvalidExpression){
                                                    $isAnyExpressionInvalid = true;
                                                }

                                                if(!$isInvalidExpression && $storedValue->hasThreshold() && $storedValue->isThresholdBreached()){
                                                    $isThresholdBreached = true;
                                                    $isAnyThresholdBreached = true;
                                                }
                                            }else{
                                                $expressionValue = " ";
                                                $isInvalidExpression = true;
                                                $isAnyExpressionInvalid = true;
                                            }
                                        }else{
                                            $expressionValue = " ";
                                            $processExpression = false;
                                                //$isInvalidExpression = true;
                                                //$isAnyExpressionInvalid = true;
                                        }
                                        ?>

                                        @if($isInvalidExpression)
                                        <tr class="ratio-warning">
                                            @else
                                            @if($isThresholdBreached)
                                            <tr class="ratio-danger">

                                                @elseif(!$isCombinedThreshold)
                                                <tr>
                                                    @endif
                                                    @endif
                                                    @if(!$isCombinedThreshold)
                                                    <td width="50%" style="padding:5px;">
                                                        @else
                                                        <td width="50%" style="padding:5px;" colspan="2">
                                                            @endif
                                                            @if($processExpression)
                                                            {!! Form::label($entry->attribute, $entry->entry) !!}
                                                            @if($entry->percentage)
                                                            <span align = "center">(%) </span>
                                                            @endif
                                                            @else
                                                            <span style="visibility: hidden">{!! Form::label($entry->attribute, $entry->entry) !!}</span>
                                                            @endif
                                                            <!-- <sup><a href="#" data-toggle="tooltip" data-placement="top" title="{{$tooltipText}}">?</a></sup> -->
                                                        </td>
                                                        @if(!$isCombinedThreshold && $processExpression)
                                                        <td data-align="center" data-halign="center" align="center" valign="center">
                                                            {!! Form::label($entry->attribute, $expressionValue) !!}
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    <?php $entryNumCounter++; ?>
                                                    @endforeach
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <?php $counter++; ?>
                                @endforeach
                            </tr></table>

                            <br/>
                            <div class="cold-md-12" style="margin-left:20px;">
                                <fieldset class="fsStyle">

                                    <legend class="legendStyle" >
                                        <a data-toggle="collapse" data-target="#demo">Ratios Color Coding Legend</a>
                                    </legend>
                                    <div class="row collapse in" id="demo" style="margin-left:auto;">

                                        <div class="col-md-1" style="border: 1px solid #c0c0c0;">
                                            <p>&nbsp;</p>
                                        </div>

                                        <div class="col-md-3 vcenter">
                                            <label for="activity_from_date" class="labelStyle">No Calculation Errors</label>
                                        </div>

                                        <div class="col-md-1 ratio-warning">
                                            <p>&nbsp;</p>
                                        </div>

                                        <div class="col-md-3 vcenter">
                                            <label for="activity_from_date" class="labelStyle">Insufficient/Incorrect Inputs</label>
                                        </div>


                                        <div class="col-md-1 ratio-danger">
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="col-md-2 vcenter">
                                            <label for="activity_from_date" class="labelStyle">Tolerance Breaches</label>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12" style="margin-left:20px;">
                                    {!! Form::button('<i class="fa fa-reply"></i> Back', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div8','$loanType','$endUseList', $amount, $loanTenure, '$loanId'); return false;", 'value'=> 'Back', 'style' => 'margin-top:3px;margin-left:20px;' )) !!}
                                    {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:4px;margin-left:20px;' )) !!}
                                    @if($user->isSME() || $user->isBankUser())
                                    {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:4px;margin-left:20px;' )) !!}
                                    @endif
                                    {{--<a href="{{{URL::to('/loans/analyst-profit-loss/' . $loanId)}}}" class="btn btn-danger btn-md active" role="button">Back</a>--}}
                                    @if(Auth::user()->isAnalyst())
                                    @if($isAnyThresholdBreached || $isAnyExpressionInvalid)
                                    {!! Form::button('Ignore Warnings/Tolerance Breaches and Proceed', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div10','$loanType','$endUseList', $amount, $loanTenure, '$loanId'); return false;", 'value'=> 'Back', 'style' => 'margin-left:20px;' )) !!}
                                    @else
                                    {!! Form::button('Continue', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div10','$loanType','$endUseList', $amount, $loanTenure, '$loanId'); return false;", 'value'=> 'Back', 'style' => 'margin-left:20px;' )) !!}
                                    @endif
                                    @endif
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