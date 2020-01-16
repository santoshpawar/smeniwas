<div id="divTC-Div4">
<div class="fieldSection">

    <div class="form-group">
        {!! Form::label(null,'Balance Sheet Details') !!}
        {!! Form::label(null, '*', ['class' => 'redmarks']) !!}
        {!! Form::hidden('loan_id', $loanId ) !!}
    </div>
    <hr/>

    <table width="99%" border="0" cellpadding="4" cellspacing="4">
        @foreach($bl_year as $blyear)

        <tr>
            <td valign="top" align="left" style="width: 33%; padding-left: 10px; padding-bottom: 20px;">
                <b><?=$blyear?></b><br />
                Have you uploaded your Balance sheet on RoC website? &nbsp;


                {!! Form::select('is_subsidiary', array('placeholder' => '--select--', '1' => 'Yes', '0' => 'No'),['id' => 'is_subsidiary','class' => 'form-control']); !!}
                <span class="redmarks">*</span><br />
                <br />
                <table id="divBalan_<?=$blyear?>" width="100%" border="0" cellpadding="4" cellspacing="4"
                       style="border: solid 1px #999; display:block;">
                    <tr>
                        <td style="border-bottom: dotted 1px #a4a5a3; padding-top: 10px;">
                            &nbsp;
                        </td>
                        <td style="border-bottom: dotted 1px #a4a5a3; padding-top: 10px; font-size: 9pt;">
                            Amount (<img src="../App_Themes/SME/Images/rupee-symbol.png" alt="" title="" />
                            in Lacs)
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="width: 66%">
                            Networth <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">(?)</label>
                        </td>
                        <td align="left" style="width: 34%">
                            <input type="text" id="txtNetworth_<?=$blyear?>" class="textbox" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            Total Debt <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">(?)</label>
                        </td>
                        <td align="left">
                            <input type="text" id="txtTotalDebt_<?=$blyear?>" class="textbox" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            Term Debt <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">(?)</label>
                        </td>
                        <td align="left">
                            <input type="text" id="txtTermDebt_<?=$blyear?>" class="textbox" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            Debtors <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">(?)</label>
                        </td>
                        <td align="left">
                            <input type="text" id="txtDebtors_<?=$blyear?>" class="textbox" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            Inventory <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">(?)</label>
                        </td>
                        <td align="left">
                            <input type="text" id="txtInventory_<?=$blyear?>" class="textbox" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            Creditors <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">(?)</label>
                        </td>
                        <td align="left">
                            <input type="text" id="txtCreditors_<?=$blyear?>" class="textbox" />
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            Net Fixed Assets <span class="redmarks">*</span><label class="mainTitle tooltipRef"
                                                                                   tip="INR in Lakhs">(?)</label>
                        </td>
                        <td align="left">
                            <input type="text" id="txtNetFixedAssets_<?=$blyear?>" class="textbox" />
                        </td>
                    </tr>
                </table>
            </td>

        </tr>

        @endforeach



    </table>
</div>

<div class="formButton" style="padding-top:20px; padding-bottom:20px;">
    <input id="Button8" type="button" value="Back" class="inputBtn" onclick="showTab('Div3'); return false;" />
    <input id="Button1" type="button" value="Save & Continue" class="inputBtn" onclick="validation_div4('Accept'); return false;" />
</div>
</div>


