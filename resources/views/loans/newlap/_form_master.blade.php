<div class="container">
    <ul class="breadcrumbs">
        <li><a href="/home">Home</a></li>
        <li class="current">LAP</li>
    </ul><!-- end breadcrumbs -->
</div><!-- end container -->
<div class="container">
    <div role="tabpanel">
        <ul class="nav nav-pills responsive" role="tablist" id="procedures">
            @if ($sub_view_type == "loans.newlap._company_background")
                <li id="divTab-Div1" class="active">
            @else
                <li id="divTab-Div1">
            @endif
                <a id="lnkLoanDtls" href="{{ URL::to('/loans/newlap/index/' . $loanId)}}"><span class="text">Company/Business Background</span></a>     </li>

            @if ($sub_view_type == "loans.newlap._promoter")
                <li id="divTab-Div2" class="active">
            @else
                <li id="divTab-Div2">
            @endif

                <a id="lnkSMEDtls" href="{{ URL::to('/loans/newlap/promoter/' . $loanId)}}"><span class="text">Promoter/Director Details</span></a> </li>

            @if ($sub_view_type == "loans.newlap._financial")
                <li id="divTab-Div3" class="active">
            @else
                <li id="divTab-Div3">
            @endif
                    <a id="lnkAppDtls" href="{{ URL::to('/loans/newlap/financial/' . $loanId)}}"><span class="text">Financial Information Co</span></a> </li>

            @if ($sub_view_type == "loans.newlap._business")
                <li id="divTab-Div4" class="active">
            @else
                <li id="divTab-Div4">
            @endif

                <a id="lnkFinancial" href="{{ URL::to('/loans/newlap/business/' . $loanId)}}"><span class="text">Business Operational Details</span></a> </li>

            @if ($sub_view_type == "loans.newlap._upload_doc")
                <li id="divTab-Div5" class="active">
            @else
                <li id="divTab-Div5" class="last">
            @endif

                <a id="lnkBanking" href="{{ URL::to('/loans/newlap/uploaddoc/' . $loanId)}}"><span class="text">Upload Documents</span></a> </li>

            {{-- Add tabs for view by the analyst only --}}
            @if(Auth::user()->isAnalyst() || Auth::user()->isAdmin())
                @if (isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_BS'))
                    <li id="divTab-Div5" class="active">
                @else
                    <li id="divTab-Div5" class="last">
                @endif
                <a id="lnkBanking" href="{{ URL::to('/loans/newlap/analyst-balance-sheet/' . $loanId)}}"><span class="text">Input Balance Sheet</span></a> </li>

                @if (isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_PL'))
                    <li id="divTab-Div5" class="active">
                @else
                    <li id="divTab-Div5" class="last">
                @endif
                <a id="lnkBanking" href="{{ URL::to('/loans/newlap/analyst-profit-loss/' . $loanId)}}">
                    <span
                    class="text">Input P & L</span></a></li>

                @if (isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO'))
                    <li id="divTab-Div5" class="active">
                @else
                    <li id="divTab-Div5" class="last">
                @endif
                <a id="lnkBanking" href="{{ URL::to('/loans/newlap/analyst-calculated-ratios/' . $loanId)}}">
                <span class="text">Calculated Ratios</span></a></li>

                @if ($sub_view_type == "loans.newlap._upload_doc")
                    <li id="divTab-Div5" class="active">
                @else
                    <li id="divTab-Div5" class="last">
                @endif
                    <a id="lnkBanking" href="{{ URL::to('/loans/newlap/uploaddoc/' . $loanId)}}">
                    <span class="text">Credit Model</span></a></li>

                @if ($sub_view_type == "loans.newlap._upload_doc")
                    <li id="divTab-Div5" class="active">
                @else
                    <li id="divTab-Div5" class="last">
                @endif
                <a id="lnkBanking" href="{{ URL::to('/loans/newlap/uploaddoc/' . $loanId)}}">
                <span class="text">Collateral Model</span></a></li>

                @if ($sub_view_type == "loans.newlap._upload_doc")
                    <li id="divTab-Div5" class="active">
                @else
                    <li id="divTab-Div5" class="last">
                @endif
                <a id="lnkBanking" href="{{ URL::to('/loans/newlap/uploaddoc/' . $loanId)}}">
                <span class="text">Rating</span></a></li>
            @endif

        </ul><!-- end tablist -->
    </div><!-- end tabpanel -->
    <!-- Tab panes -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{--<div class="tab-content responsive col-xs-12 col-md-8 col-lg-9">--}}
    <div class="tab-content responsive">
        @include($sub_view_type)
    </div><!-- end tab-content -->
    {{--<div class="rightSection col-xs-12 col-md-4 col-lg-3">
        <div class="box">
            <div class="middle">
                <h2>
                    Need Help?</h2>
                <ul class="needHelp">
                    <li><span class="icon tel"></span><span class="text">Telephone (toll free) <span
                                    class="number">1-800-103-7690<br>
    <span>Monday-Saturday : 10am to 6pm</span></span> </span></li>
                    <li><span class="icon email"></span><span class="text">E-mail <a class="mail" href="mailto:contact@smeniwas.com">
                               contact@smeniwas.com</a> </span></li>
                </ul>
            </div>
            <div class="bottom">
            </div>
        </div>
    </div>--}}<!-- end rightSection -->
</div><!-- end container -->
