<?php
      $counter = 0;
      $isAnyThresholdBreached = false;
      $isAnyExpressionInvalid = false;
?>
<table width="99%">
    <tr><td colspan="3"></td></tr>
    <tr>
@foreach($bl_year as $blyear)
    <?php
            $financialDataExpression = null;

            if($financialDataExpressionsMap->offsetExists($blyear)){
                $financialDataExpression = $financialDataExpressionsMap->offsetGet($blyear);
            }

            $financialDataRecord = null;

            if($financialDataMap->offsetExists($blyear)){
                $financialDataRecord = $financialDataMap->offsetGet($blyear);
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
                                 {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][period]', $blyear)!!}
                            @endif
                                <?php
                                    $expressionValue = "";
                                    $isInvalidExpression = false;
                                    $isThresholdBreached = false;

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
                                        }
                                    }
                                ?>

                            @if($isInvalidExpression)
                               <tr class="ratio-warning">
                            @else
                                @if($isThresholdBreached)
                                 <tr class="ratio-danger">

                                @else
                                 <tr class="success">
                                @endif
                            @endif
                                <td width="50%" style="padding:5px;">
                                    {!! Form::label($entry->attribute, $entry->entry) !!}
                                    @if($entry->percentage)
                                        <span align = "center">(%) </span>
                                    @endif
                                   <!-- <sup><a href="#" data-toggle="tooltip" data-placement="top" title="{{$tooltipText}}">?</a></sup> -->
                                </td>
                                <td data-align="center" data-halign="center" align="center" valign="center">
                                    {!! Form::label($entry->attribute, $expressionValue) !!}
                                </td>
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
<div class="cold-md-12">
    <fieldset class="fsStyle">



        <legend class="legendStyle">
            <a data-toggle="collapse" data-target="#demo">Ratios Color Coding Legend</a>
        </legend>
        <div class="row collapse in" id="demo">

            <div class="col-md-1 alert-success">
                <p>&nbsp;</p>
            </div>

            <div class="col-md-2 vcenter">
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
<div class="form-group">
    <a href="{{{URL::to('/loans/newlap/analyst-profit-loss/' . $loanId)}}}" class="btn btn-danger btn-md active" role="button">Back</a>
    @if($isAnyThresholdBreached || $isAnyExpressionInvalid)
        <a href="{{{URL::to('/loans/newlap/uploaddoc/' . $loanId)}}}" class="btn btn-danger btn-md active" role="button">Ignore Warnings/Tolerance Breaches and Proceed</a>
    @else
        <a href="{{{URL::to('/loans/newlap/uploaddoc/' . $loanId)}}}" class="btn btn-danger btn-md active" role="button">Continue</a>
    @endif
</div>

@section('footer')
    <script>
        $('a').tooltip();
    </script>
@endsection