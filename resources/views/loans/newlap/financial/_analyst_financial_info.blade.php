<?php $counter = 0; ?>
<table>
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
    <td align="center">&nbsp;</td>
    <td align="center">
    {!! Form::label($blyear, $blyear) !!}

    <table border="0">
        <tr>
            <td valign="top" colspan="4">
                <table class="table table-condensed table-bordered table-hover">
                    @foreach($financialGroups as $group)
                        <tr>
                            @if(!$group->header)
                             <td style="padding:5px;"><b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b></td><td style="padding:5px;"><b>Amount (in Lakhs)   </b></td>
                            @else
                                <td colspan="2" align="center"><b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b></td>
                            @endif
                        </tr>

                        @foreach($group->financialEntries as $entry)
                            @if(isset($financialDataRecord))
                                {!! Form::hidden('financial['.$counter.'][id]', $financialDataRecord->id)!!}
                                {!! Form::hidden('financial['.$counter.'][loan_id]', $financialDataRecord->loan_id)!!}
                                {!! Form::hidden('financial['.$counter.'][period]', $financialDataRecord->period)!!}
                            @else
                                {!! Form::hidden('financial['.$counter.'][loan_id]', $loanId)!!}
                                {!! Form::hidden('financial['.$counter.'][period]', $blyear)!!}
                            @endif
                            <tr>
                                <?php
                                    $expressionValue = " ";
                                    $tooltipText = "";
                                    if($entry->hasFormula()){
                                        $tooltipText = "Formula: " . $entry->formula_reference . " = ". $entry->formula;
                                    }else{
                                        $tooltipText = "Field: "  . $entry->formula_reference;
                                    }
                                    if(isset($financialDataExpression) && $financialDataExpression->offsetExists($entry->formula_reference)){
                                        $storedValue = $financialDataExpression->offsetGet($entry->formula_reference);
                                        $expressionValue = $storedValue->getValue();
                                    }

                                    if(!isset($expressionValue) || $expressionValue == ""){
                                        $expressionValue = " ";
                                    }
                                ?>
                                <td width="50%" style="padding:5px;">
                                    {!! Form::label($entry->attribute, $entry->entry) !!}
                                    <!-- <sup><a href="#" data-toggle="tooltip" data-placement="top" title="{{$tooltipText}}">?</a></sup> -->
                                </td>
                                <td style="padding:5px;">
                                    @if(!$entry->hasFormula() || $showTextFieldsForFormula)
                                     {!! Form::text('financial['.$counter.']['.$entry->attribute.']',$expressionValue, array('class' => 'form-control')) !!}
                                    @else
                                     {!! Form::label($entry->attribute, $expressionValue) !!}
                                     {!! Form::hidden('financial['.$counter.']['.$entry->attribute.']', $expressionValue)!!}
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
    </tr></table>

<br/>
<div class="form-group">
    {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div1'); return false;", 'value'=> 'Back' )) !!}
    {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
</div>

@section('footer')
    <script>
        $('a').tooltip();
    </script>
@endsection