<div id="divTC-Div5">
    <div class="form-group">
        {!! Form::label(null,'P &amp; L Details ') !!}
        {!! Form::label(null, '*', ['class' => 'redmarks']) !!}
        {!! Form::hidden('loan_id', $loanId ) !!}
    </div>
    <hr/>
    <div class="">

    </div>
    <div class="fieldSection">
        <table width="99%" border="0" cellpadding="4" cellspacing="4">
            <tr>
                <td valign="top" align="center" style="width: 33%">
                    FY 2012-13<br />
                    <table id="divPLYR1213" width="100%" border="0" cellpadding="4" cellspacing="4" style="border: solid 1px #999;">
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
                                Revenue <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left" style="width: 34%">
                                <input type="text" id="revenue[]" class="textbox"  />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                EBITDA/Operating Profit <span class="redmarks">*</span><label class="mainTitle tooltipRef"
                                                                                              tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtEBITDAOperating01" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                Interest Expense<span class="redmarks">*</span><label class="mainTitle tooltipRef"
                                                                                      tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtProfit01" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                PAT<span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtPAT01" class="textbox" />
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top" align="center" style="width: 33%">
                    FY 2011-12<br />
                    <table id="divPLYR1112" width="100%" border="0" cellpadding="4" cellspacing="4" style="border: solid 1px #999;">
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
                                Revenue <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left" style="width: 34%">
                                <input type="text" id="revenue[]" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                EBITDA/Operating Profit <span class="redmarks">*</span><label class="mainTitle tooltipRef"
                                                                                              tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtEBITDAOperating02" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                Interest Expense<span class="redmarks">*</span><label class="mainTitle tooltipRef"
                                                                                      tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtProfit02" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                PAT<span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtPAT02" class="textbox" />
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top" align="center" style="width: 33%">
                    FY 2010-11<br />
                    <table id="divPLYR1011" width="100%" border="0" cellpadding="4" cellspacing="4" style="border: solid 1px #999;">
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
                                Revenue <span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left" style="width: 34%">
                                <input type="text" id="revenue[]" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                EBITDA/Operating Profit <span class="redmarks">*</span><label class="mainTitle tooltipRef"
                                                                                              tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtEBITDAOperating03" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                Interest Expense<span class="redmarks">*</span><label class="mainTitle tooltipRef"
                                                                                      tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtProfit03" class="textbox" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                PAT<span class="redmarks">*</span><label class="mainTitle tooltipRef" tip="INR in Lakhs">
                                    (?)</label>
                            </td>
                            <td align="left">
                                <input type="text" id="txtPAT03" class="textbox" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="fieldsGroup" style="width: 100%">
            <label class="mainTitle">
                (All <span class="redmarks">*</span> marked fields are mandatory)
            </label>
        </div>
    </div>
    <div class="form-group">
        {!! Form::button('Back', ['class' => 'inputBtn btn', 'onclick' => 'showTab("Div4"); return false;']) !!}
        {!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}
    </div>
</div>