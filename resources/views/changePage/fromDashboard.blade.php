 <div class="wrapper">
  <div class="sidebar" data-color="purple" data-image="{{ asset('/images/sidebar-1.jpg') }}">
    <div class="logo">
       <a href="/home"><img style="background-color: white;height: 77px;width:219px" src="{{ asset('/images/smeLogo.png') }}"></a>
    </div>
    <div class="sidebar-wrapper">
      <div id="tab" class="btn-group leftside_tab" role="group">
        @if($sub_view_type == "loans._choose_loan")
        @else
        @if(isset($companySharePledged))
        <?php  $sideUrl=$endUseList.'/'.$loanType.'/'.$amount.'/'.$loanTenure.'/'.$companySharePledged.'/'.$bscNscCode.'/'.$loanId; ?>
        @else
        <?php   $sideUrl=$endUseList.'/'.$loanType.'/'.$amount.'/'.$loanTenure.'/'.$loanId;  ?>
        @endif
                <ul class="nav">
          @if(Auth::user()->isAnalyst() || Auth::user()->isBankUser() || Auth::user()->isAdmin() || Auth::user()->isApproveUser() || Auth::user()->isLoanAdmin())
          <li>
           <a style="width:100%;" href="{{{URL::to('loans/profile-loan-details/'.$sideUrl)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._profile_loan_details" ? 'active' : ''}}}"  role="button"><i class="material-icons">contacts</i>Profile & Loan Details</a>
         </li>
         @endif
         <li>
           <a style="width:100%;" href="{{{URL::to('loans/company-background/'.$sideUrl)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._company_background" ? 'active' : ''}}}" role="button"><i class="material-icons ">person</i>Background<div class="ripple-container"></div></a>
         </li>
         <li>
           <a style="width:100%;" href="{{{URL::to('loans/promoter/'.$sideUrl)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._promoter" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'promoter_details')}}}  " role="button"><i class="material-icons">content_paste</i>Promoter Details</a>
         </li>
         <li>
           <a style="width:100%;" href="{{{URL::to('loans/financial/'.$sideUrl)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._financial" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'financials')}}}  " role="button"><i class="material-icons">library_books</i>Business Financials</a>
         </li>

         <li>
           @if(isset($companySharePledged))
           <a style="width:100%;" href="{{{URL::to('loans/application/'.$sideUrl)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._application_LAS" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'security_details')}}}" role="button"><i class="material-icons">security</i>Security Details</a>
           @else
           <a style="width:100%;" href="{{{URL::to('loans/application/'.$sideUrl)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._application" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'security_details')}}}" role="button"><i class="material-icons">security</i>Security Details</a>
           @endif
         </li>
         <li>
           <a style="width:100%;" href="{{{URL::to('loans/uploaddoc/'.$sideUrl)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._upload_doc" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'upload_documents')}}}" role="button"><i class="material-icons">file_upload</i>Upload Documents</a>
         </li>
         @endif
      
         @if(Auth::user()->isAnalyst() || Auth::user()->isBankUser() || Auth::user()->isAdmin() || Auth::user()->isApproveUser() || Auth::user()->isLoanAdmin())
         <li>
           <a  class="btn btn-large btn-success btn-space lefttabbtn {{{(isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_GS')) ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'google_search')}}}" href="{{{ URL::to('/loans/analyst-google-search/' . $loanId)}}}" role="button"><i class="material-icons">search</i>Google Search</a> </li>
         </li>
         <li>
           <a  class="btn btn-large btn-success btn-space lefttabbtn {{{(isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_BS')) ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'input_blsheet')}}}" href="{{{ URL::to('/loans/analyst-balance-sheet/' . $loanId)}}}" role="button"><i class="material-icons">format_list_numbered</i>Input Balance Sheet</a> </li>
         </li>
         <li>
           <a  class="btn btn-large btn-success btn-space lefttabbtn {{{(isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_PL')) ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'input_p&l')}}}" href="{{{ URL::to('/loans/analyst-profit-loss/' . $loanId)}}}" role="button"><i class="material-icons">account_balance_wallet</i>Input P & L</a></li>
         </li>
         <li>
           <a  class="btn btn-large btn-success btn-space lefttabbtn {{{(isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_CF')) ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'cashflow')}}}" href="{{{ URL::to('/loans/analyst-cashflow/' . $loanId)}}}" role="button"><i class="material-icons">call_missed_outgoing</i>Cashflow</a></li>
         </li>
         <li>
           <a class="btn btn-large btn-success btn-space lefttabbtn {{{(isset($groupType) && $groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO')) ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'calculated_ratios')}}}" href="{{{ URL::to('/loans/analyst-calculated-ratios/' . $loanId)}}}" role="button"><i class="material-icons">aspect_ratio</i>Calculated Ratios</a></li>
         </li>

         <li>

           @if(@$loan->companySharePledged!='')
           <a class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sub_view_type == "loans.financial._analyst_credit_model" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'credit_model')}}}" href="{{{ URL::to('/loans/liquidity-model/' . $loanId)}}}" role="button"><i class="material-icons">payment</i>Share Pledge Model</a></li>
           @else
           <a class="btn btn-large btn-success btn-space lefttabbtn {{{ !$sub_view_type == "loans.financial._analyst_credit_model" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'credit_model')}}}" href="{{{ URL::to('/loans/credit-model/' . $loanId)}}}" role="button"><i class="material-icons">payment</i>Credit Model</a></li>
           @endif
         </li>

          <li>

           @if(@$loan->companySharePledged=='')
           
           <a class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sub_view_type == "loans.financial._cash_flow_model" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'credit_model')}}}" href="{{{ URL::to('/loans/data-cash-flow-model/' . $loanId)}}}" role="button"><i class="material-icons">payment</i>Liquidity Test Model</a></li>
           @endif
         </li>

         <li>
           @if($validLoanHelper->collateralModel($loanId))
           <a class="btn btn-large btn-success btn-space lefttabbtn {{{ @$sub_view_type == "loans.financial._analyst_collateral_model" ? 'active' : ''}}} {{{$validLoanHelper->CurrentTabStatus($loanId,'collateral_model')}}}" href="{{{ URL::to('/loans/collateral-model/' . $loanId)}}}" role="button"><i class="material-icons">payment</i>Collateral Model</a></li>
           @endif
         </li>
         @endif
          <li>
           @if(Auth::user()->isAnalyst() || Auth::user()->isApproveUser())


           <a style="width:100%;" href="{{{URL::to('loans/praposal/company-background/'.$loanType.'/'.$endUseList.'/'.$amount.'/'.$loanTenure.'/'.$loanId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._bank_approval" ? 'active' : ''}}} " role="button"><i class="material-icons">account_balance</i>Proposal Background</a>
           @endif
         </li>

         <li>
           @if(Auth::user()->isAnalyst() || Auth::user()->isApproveUser() || Auth::user()->isBankUser() || Auth::user()->isLoanAdmin())


           <a style="width:100%;" href="{{{URL::to('loans/praposal/details/'.$loanType.'/'.$endUseList.'/'.$amount.'/'.$loanTenure.'/'.$loanId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._bank_approval" ? 'active' : ''}}} " role="button"><i class="material-icons">account_balance</i>Proposal Details</a>
           @endif
         </li> 
         <li>
           @if(Auth::user()->isAnalyst() || Auth::user()->isApproveUser() || Auth::user()->isBankUser() || Auth::user()->isLoanAdmin())


           <a style="width:100%;" href="{{{URL::to('loans/praposal/finsummary/'.$loanType.'/'.$endUseList.'/'.$amount.'/'.$loanTenure.'/'.$loanId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._bank_approval" ? 'active' : ''}}} " role="button"><i class="material-icons">account_balance</i>Proposal Finance Summery</a>
           @endif
         </li>
          <li>
           @if(Auth::user()->isAnalyst() || Auth::user()->isApproveUser() || Auth::user()->isBankUser() || Auth::user()->isLoanAdmin())


           <a style="width:100%;" href="{{{URL::to('loans/praposal/checklist/'.$loanType.'/'.$endUseList.'/'.$amount.'/'.$loanTenure.'/'.$loanId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._bank_approval" ? 'active' : ''}}} " role="button"><i class="material-icons">account_balance</i>Proposal Checklist</a>
           @endif
         </li>

         <li>
           @if(Auth::user()->isApproveUser())


           <a style="width:100%;" href="{{{URL::to('loans/praposal/approver/'.$loanType.'/'.$endUseList.'/'.$amount.'/'.$loanTenure.'/'.$loanId)}}}" class="btn btn-large btn-success btn-space lefttabbtn {{{$sub_view_type == "loans._bank_approval" ? 'active' : ''}}} " role="button"><i class="material-icons">account_balance</i>Approval</a>
           @endif
         </li>
       </ul>
     </div>
   </div>
 </div>

 <div class="main-panel">
   @include('loans.dashboardNavbar')
