<div>
    <div id="divMenuNavg">
        <p style="font-size: 16pt; color: #000;">
            Loan Against Property
        </p>
    <div id="divTabs">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="left" colspan="2">
                    <div style="width: 680px;">
                        <div style="border-bottom: solid 1px #999; text-align: center; width: 600px; margin: auto;">
                            Level 1
                        </div>
                        <div style="border-left: solid 1px #999; height: 15px; text-align: center; position: relative;
                                left: 40px; float: left">
                        </div>
                        <div style="border-right: solid 1px #999; height: 15px; text-align: center; position: relative;
                                right: 40px; float: right">
                        </div>
                        <br />
                        <div id="divLevel1">
                            <ul class="tabs" style="padding-top: 5px;">
                                @if ($sub_view_type == "loans.lap._generalinfo")
                                    <li id="divTab-Div9" class="current">
                                @else
                                    <li id="divTab-Div9">
                                @endif
                                    <a id="lnkGenInfo" class="current" href="/loans/lap/index/{{$loanId}}"><span
                                                class="text">General Information Required</span></a> </li>

                                @if ($sub_view_type == "loans.lap._requirements")
                                    <li id="divTab-Div1" class="current">
                                @else
                                    <li id="divTab-Div9">
                                @endif
                                    @if(isset($loanId))
                                        <a id="lnkLoanDtls" href="/loans/lap/requirements/{{$loanId}}"><span class="text">Loan Requirements
                                        Details</span></a> </li>
                                    @else
                                            <span class="text">Loan Requirements
                                        Details</span></li>
                                    @endif
                                @if ($sub_view_type == "loans.lap._collateral")
                                    <li id="divTab-Div2" class="current">
                                @else
                                    <li id="divTab-Div2">
                                @endif
                                    @if(isset($loanId))
                                        <a id="lnkAppDtls" href="/loans/lap/collateral/{{$loanId}}"><span class="text">Security being Provided</span></a></li>
                                    @else
                                        <span class="text">Security being Provided</span>
                                    @endif
                                @if ($sub_view_type == "loans.lap._existing_lenderdetails")
                                    <li id="divTab-Div3" class="current">
                                @else
                                    <li id="divTab-Div3">
                                @endif
                                    @if(isset($loanId))
                                        <a id="lnkFinancial" href="/loans/lap/existing-lender/{{$loanId}}"><span class="text">Existing Lender
                                            Details</span></a> </li>
                                    @else
                                        <span class="text">Existing Lender Details</span>
                                    @endif
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 15px; width: 48%;" align="left">
                    <div style="width: 370px;">
                        <div style="border-bottom: solid 1px #999; text-align: center; width: 290px; margin: auto;">
                            Level 2
                        </div>
                        <div style="border-left: solid 1px #999; height: 15px; text-align: center; position: relative;
                                left: 40px; float: left">
                        </div>
                        <div style="border-right: solid 1px #999; height: 15px; text-align: center; position: relative;
                                right: 40px; float: right">
                        </div>
                        <br />
                        <div id="divLevel2">
                            <ul class="tabs" style="padding-top: 5px;">
                                @if ($sub_view_type == "loans.lap._balancesheet_details")
                                    <li id="divTab-Div4" class="current">
                                @else
                                    <li id="divTab-Div4">
                                @endif

                                @if(isset($loanId))
                                  <a id="A1" class="current" href="/loans/lap/balancesheet-details/{{$loanId}}"><span class="text">Balance
                                        Sheet Details </span></a></li>
                                @else
                                    <span class="text">Balance Sheet Details</span>
                                @endif

                                @if ($sub_view_type == "loans.lap._pl_details")
                                    <li id="divTab-Div5" class="current">
                                @else
                                    <li id="divTab-Div5">
                                @endif

                                @if(isset($loanId))
                                    <a id="A2" href="/loans/lap/pl-details/{{$loanId}}"><span class="text">P & L Details </span></a></li>
                                @else
                                    <span class="text">P & L Details </span>
                                @endif

                                @if ($sub_view_type == "loans.lap._upload_itreturn")
                                    <li id="divTab-Div6" class="current">
                                @else
                                    <li id="divTab-Div6">
                                @endif

                                @if(isset($loanId))
                                    <a id="A3" href="/loans/lap/upload-itreturn/{{$loanId}}"><span class="text">Upload IT Return</span></a></li>
                                @else
                                    <span class="text">Upload IT Return </span>
                                @endif
                            </ul>
                        </div>
                    </div>
                </td>
                <td align="left" style="padding-top: 15px; width: 52%">
                    <div style="width: 310px;">
                        <div style="border-bottom: solid 1px #999; text-align: center; width: 230px; margin: auto;">
                            Level 3
                        </div>
                        <div style="border-left: solid 1px #999; height: 15px; text-align: center; position: relative;
                                left: 40px; float: left">
                        </div>
                        <div style="border-right: solid 1px #999; height: 15px; text-align: center; position: relative;
                                right: 40px; float: right">
                        </div>
                        <br />
                        <div id="divLevel3">
                            <ul class="tabs" style="padding-top: 5px;">
                                @if ($sub_view_type == "loans.lap._promoter_details/{{$loanId}}")
                                    <li id="divTab-Div7" class="current">
                                @else
                                    <li id="divTab-Div7">
                                @endif

                                @if(isset($loanId))
                                    <a id="A4" href="/loans/lap/promoter-details/{{$loanId}}"><span class="text">Promoters / Directors Details</span></a></li>
                                @else
                                    <span class="text">Promoters / Directors Details</span>
                                @endif

                                @if ($sub_view_type == "loans.lap._upload_details")
                                    <li id="divTab-Div8" class="current">
                                @else
                                    <li id="divTab-Div8" class="last">
                                @endif

                                @if(isset($loanId))
                                    <a id="A5" href="/loans/lap/upload-details/{{$loanId}}"><span class="text">Upload Details</span></a></li>
                                @else
                                    <span class="text">Upload Details</span>
                                @endif
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="leftSection">
    <div id="divTabsContent">
        <div class="form">
            <div class="fieldSection">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            @include($sub_view_type)
        </div>
    </div>
</div>
</div>
</div>