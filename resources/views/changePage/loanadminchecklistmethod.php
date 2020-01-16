//  public function getChecklist($loanType, $endUseList = null, $amount = null, $loanTenure = null, $loanId = null)
//  {

//   $loan = null;
//   $model = null;
//   $praposalApproved = Config::get('constants.CONST_LOAN_STATUS_TYPE_24');
//   $praposalRejected = Config::get('constants.CONST_LOAN_STATUS_TYPE_23');
//   $validLoanHelper = new validLoanUrlhelper();

//   $user = Auth::getUser();
//   if (isset($loanId)) {
//     $validLoan = $validLoanHelper->isValidLoan($loanId);
//     if (!$validLoan) {
//       return view('loans.error');
//     }
//     $loan = Loan::find($loanId);
//     $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
//     $userProfileFirm = UserProfile::with('user')->find($userPr->id);
//     if (isset($loan) && isset($user)) {

//      $loan=LoansStatus::where('loan_id', '=', $loanId)->first();
//    }
//  }
//  $subViewType = 'loans._createCheckList';
//  $formaction = 'Loans\LoansController@postCreatechecklist';
//  return view('loans.createedit', compact('subViewType', 'formaction','userProfileFirm', 'loan', 'loanId', 'loanType', 'endUseList', 'amount', 'loanTenure', 'validLoanHelper', 'bankApprovalStatus_1', 'bankApprovalStatus_2'));
// }

//   *
//    * Save the Approval result by bank user
//    * @param Request $request
//    *
//    * @return Response
   
//   public function postCreatechecklist(Request $request)
//   {
//     $input = Input::all();
//     $id = isset($input['id']) ? $input['id'] : null;
//     $loanId = isset($input['loanId']) ? $input['loanId'] : null;
//     $loanType = isset($input['type']) ? $input['type'] : null;
//     $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
//     $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
//     $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
//     $user = Auth::getUser();


//     LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'praposalApproved' => $input['loan_status'],'remark'=>$input['remark']]);
//     if($input['loan_status']=='Y'){
//       $loansStatus = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '23']);
//       $loansStatus->save();
//     }else{
//       $loansStatusNo = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '24']);
//       $loansStatusNo->save();
//     }

//    // $loansStatus->save();
//     $redirectUrl = 'home';
//     return Redirect::to($redirectUrl)->withInput();
//   }




  /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanProduct
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @param $companyCode
   * @param $exchangeCode
   * @return Response
   *///  $endUseList, $loanProduct , $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId
    //

   public function getChecklist( $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
   {

    $endUseList = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }

    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loanType = null;
    
    $user = null;
    $userProfile = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;


    }


    $states = MasterData::states();
    $choosenSales = null;
    $userType = MasterData::userType();
    $industryTypes = MasterData::industryTypes(false);
    $businessVintage = MasterData::businessVintage();
    $choosenUserType = null;
    $loanApplicationId = null;
    $chosenproductType = null;
    $existingCompanyDeails = null;
    $existingCompanyDeailsCount = 0;
    $maxCompanyDetails = Config::get('constants.CONST_MAX_COMPANY_DETAIL');
    $newCompanyDeailsNum = $maxCompanyDetails - $existingCompanyDeailsCount;

    $loansStatus = null;
    $loan = null;
    $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');
    $setDisable = null;
    $status = null;
    $user = null;
    $userProfile = null;
    $isRemoveMandatory = MasterData::removeMandatory();
    $entityTypes = MasterData::entityTypes();
    $chosenEntity = null;
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
    //        $removeMandatory  = $this->getMandatory($user);
    //        dd($removeMandatory,$setDisable);
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = $this->getIsDisabled($user);

  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateRatios();
  //dd($bl_year, $groupType, $financialGroups, $financialDataExpressionsMap);
    $financialDataMap = new Collection();
    $showFormulaText = true;
    $financialProfitLoss = ProfitLoss::where('loan_id', '=', $loanId)->get();
    $ratios = Ratio::where('loan_id', '=', $loanId)->get();
  
       // $subViewType = 'loans._checklist';
       // $formaction = 'Loans\LoansController@postPraposalChecklist';

      $subViewType = 'loans._createCheckList';
      $formaction = 'Loans\LoansController@postCreatechecklist';

 
       $validLoanHelper = new validLoanUrlhelper();
 
       $loan = Loan::find($loanId);
       $loanUser = User::find($loan->user_id);
       $loanUserProfile = $loanUser->userProfile();


       $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');

       $setDisable = '';
       $isRemoveMandatory = MasterData::removeMandatory();
       $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
       $removeMandatoryHelper = new validLoanUrlhelper();
       $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
       if (isset($loanId)) {
        $validLoan = $validLoanHelper->isValidLoan($loanId);
        if (!$validLoan) {
          return view('loans.error');
        }
        $status = $validLoanHelper->getTabStatus($loanId, 'background');
        if ($status == 'Y' && $setDisable != 'disabled') {
          $setDisable = 'disabled';
        }
      }
  //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
      $validLoanHelper = new validLoanUrlhelper();
  //getting borrowers profile
      if (isset($loanId)) {
        $loan = Loan::find($loanId);
        $loanUser = User::find($loan->user_id);
        $loanUserProfile = $loanUser->userProfile();
        // @$loanadminchecklist=LoanAdminChecklists::where('loan_id', '=', $loanId)->first();
        @$praposalChecklist=PraposalChecklists::where('loan_id', '=', $loanId)->first();
        @$promoterDetails=PromoterDetails::where('loan_id', '=', $loanId)->first();
      }
      $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
      $userProfileFirm = UserProfile::with('user')->find($userPr->id);



      return view('loans.praposalCreditEdit', compact(
        'subViewType',
        'loan',
        'praposalChecklist',
        'loanId',
        'endUseList',
        'loanType',
        'amount',
        'loanTenure',
        'promoterDetails',
        'formaction',
        'removeMandatory ',
        'bl_year',
        'businessVintage',
        'setDisable',
        'ratioBreachesDescrip',
        'financialGroups',
        'groupType',
        'com_business_type',
        'financialDataExpressionsMap',
        'showFormulaText',
        'financialDataMap',
        'validLoanHelper',
        'userProfileFirm',
        'refreanceCheckDescription',
        'loanUserProfile',
        'companySharePledged',
        'bscNscCode',
        'financialProfitLoss',
        'ratios',
        'typeofEntity'
      ));
    }

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */ // 
  public function postCreatechecklist(Request $request)
  {
   $input = Input::all();
   $loanId = isset($input['loanId']) ? $input['loanId'] : null;
   $loanType = isset($input['type']) ? $input['type'] : null;
   $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
   $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
   $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //if loan is selected
   $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
   $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    //$id = $input['id'];
   $loan = null;
   $fieldsArr = [];
   $rulesArr = [];
   $messagesArr = [];
   $user = Auth::getUser();
   $userProfile = Auth::getUser()->userProfile();

   $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
   if ($validator->fails()) {
    return Redirect::back()->withErrors($validator)->withInput();
  } else {
  //$user = Auth::getUser();
  //$userProfile =  Auth::getUser()->userProfile();
    $input['user_id'] = $user->id;
    if (isset($loanId)) {
      if (isset($loans)) {
        $salesAreaDetailId = $loans->id;
      } else {
        $salesAreaDetailId = null;
      }
    }

    $user = Auth::user();
    if (isset($user)) {
      $userID = $user->id;
      $userEmail = $user->email;
    }
    if (isset($userID)) {
      $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
      ->where('status', 0)
      ->first();
    }

    //new


  }

  $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'sentApprovar' => 'Y']);
  $loansStatus = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '22']);
  $loansStatus->save();
  
  $loan = PraposalChecklists::updateOrCreate(['loan_id' => $loanId], [
   
   // 'moa' => @$input['moa'],
      // 'moa' => @$input['moa'],

    //kyc of business start here

   'moa_applicable1' => @$input['moa_applicable1'],
   'moa_document1' => @$input['moa_document1'],
   'moa_discrepancies1' => @$input['moa_discrepancies1'],
   'moa_remark1' => @$input['moa_remark1'],
   //'moa_attachment1' => @$input['moa_attachment1'],

   'cor_applicable1' => @$input['cor_applicable1'],
   'cor_document1' => @$input['cor_document1'],
   'cor_discrepancies1' => @$input['cor_discrepancies1'],
   'cor_remark1' => @$input['cor_remark1'],
   //'cor_attachment1' => @$input['cor_attachment1'],


   'pan_applicable1' => @$input['pan_applicable1'],
   'pan_document1' => @$input['pan_document1'],
   'pan_discrepancies1' => @$input['pan_discrepancies1'],
   'pan_remark1' => @$input['pan_remark1'],
   //'pan_attachment1' => @$input['pan_attachment1'],


   'shopcertificate_applicable1' => @$input['shopcertificate_applicable1'],
   'shopcertificate_document1' => @$input['shopcertificate_document1'],
   'shopcertificate_discrepancies1' => @$input['shopcertificate_discrepancies1'],
   'shopcertificate_remark1' => @$input['shopcertificate_remark1'],
   //'shopcertificate_attachment1' => @$input['shopcertificate_attachment1'],


   'gstcertificate_applicable1' => @$input['gstcertificate_applicable1'],
   'gstcertificate_document1' => @$input['gstcertificate_document1'],
   'gstcertificate_discrepancies1' => @$input['gstcertificate_discrepancies1'],
   'gstcertificate_remark1' => @$input['gstcertificate_remark1'],
   //'gstcertificate_attachment1' => @$input['gstcertificate_attachment1'],


   'ghumastalicence_applicable1' => @$input['ghumastalicence_applicable1'],
   'ghumastalicence_document1' => @$input['ghumastalicence_document1'],
   'ghumastalicence_discrepancies1' => @$input['ghumastalicence_discrepancies1'],
   'ghumastalicence_remark1' => @$input['ghumastalicence_remark1'],
   //'ghumastalicence_attachment1' => @$input['ghumastalicence_attachment1'],


   'rentagreement_applicable1' => @$input['rentagreement_applicable1'],
   'rentagreement_document1' => @$input['rentagreement_document1'],
   'rentagreement_discrepancies1' => @$input['rentagreement_discrepancies1'],
   'rentagreement_remark1' => @$input['rentagreement_remark1'],
   //'rentagreement_attachment1' => @$input['rentagreement_attachment1'],


   'udyogadhar_applicable1' => @$input['udyogadhar_applicable1'],
   'udyogadhar_document1' => @$input['udyogadhar_document1'],
   'udyogadhar_discrepancies1' => @$input['udyogadhar_discrepancies1'],
   'udyogadhar_remark1' => @$input['udyogadhar_remark1'],
   //'udyogadhar_attachment1' => @$input['udyogadhar_attachment1'],


   'electricitybill_applicable1' => @$input['electricitybill_applicable1'],
   'electricitybill_document1' => @$input['electricitybill_document1'],
   'electricitybill_discrepancies1' => @$input['electricitybill_discrepancies1'],
   'electricitybill_remark1' => @$input['electricitybill_remark1'],
   //'electricitybill_attachment1' => @$input['electricitybill_attachment1'],


   'cibilofentity_applicable1' => @$input['cibilofentity_applicable1'],
   'cibilofentity_document1' => @$input['cibilofentity_document1'],
   'cibilofentity_discrepancies1' => @$input['cibilofentity_discrepancies1'],
   'cibilofentity_remark1' => @$input['cibilofentity_remark1'],
   //'cibilofentity_attachment1' => @$input['cibilofentity_attachment1'],


   'other1_applicable1' => @$input['other1_applicable1'],
   'other1_document1' => @$input['other1_document1'],
   'other1_remarks' => @$input['other1_remarks'],

   //  //kyc of promoter start below
    'pan2_applicable1' => @$input['pan2_applicable1'],
    'pan2_document1' => @$input['pan2_document1'],
    'pan2_discrepancies1' => @$input['pan2_discrepancies1'],
    'pan2_remark2' => @$input['pan2_remark2'],
    //'pan2_attachment1' => @$input['pan2_attachment1'],

    'addressproof_applicable1' => @$input['addressproof_applicable1'],
    'addressproof_document1' => @$input['addressproof_document1'],
    'addressproof_discrepancies1' => @$input['addressproof_discrepancies1'],
    'addressproof_remark2' => @$input['addressproof_remark2'],
    //'addressproof_attachment1' => @$input['addressproof_attachment1'],

    'networthcertificate_applicable1' => @$input['networthcertificate_applicable1'],
    'networthcertificate_document1' => @$input['networthcertificate_document1'],
    'networthcertificate_discrepancies1' => @$input['networthcertificate_discrepancies1'],
    'networthcertificate_remark2' => @$input['networthcertificate_remark2'],
    //'networthcertificate_attachment1' => @$input['networthcertificate_attachment1'],

    'cibilofpromoter_applicable1' => @$input['cibilofpromoter_applicable1'],
    'cibilofpromoter_document1' => @$input['cibilofpromoter_document1'],
    'cibilofpromoter_discrepancies1' => @$input['cibilofpromoter_discrepancies1'],
    'cibilofpromoter_remark2' => @$input['cibilofpromoter_remark2'],
    //'cibilofpromoter_attachment1' => @$input['cibilofpromoter_attachment1'],

    'other2_applicable1' => @$input['other2_applicable1'],
    'other2_document1' => @$input['other2_document1'],
    'other2_remarks' => @$input['other2_remarks'],

    
   //  //kyc of loan documents

    'acceptedtermsheet_applicable1' => @$input['acceptedtermsheet_applicable1'],
    'acceptedtermsheet_document1' => @$input['acceptedtermsheet_document1'],
    'acceptedtermsheet_discrepancies1' => @$input['acceptedtermsheet_discrepancies1'],
    'acceptedtermsheet_remark3' => @$input['acceptedtermsheet_remark3'],

    'loanagreement_applicable1' => @$input['loanagreement_applicable1'],
    'loanagreement_document1' => @$input['loanagreement_document1'],
    'loanagreement_discrepancies1' => @$input['loanagreement_discrepancies1'],
    'loanagreement_remark3' => @$input['loanagreement_remark3'],

    'personalguarantee_applicable1' => @$input['personalguarantee_applicable1'],
    'personalguarantee_document1' => @$input['personalguarantee_document1'],
    'personalguarantee_discrepancies1' => @$input['personalguarantee_discrepancies1'],
    'personalguarantee_remark3' => @$input['personalguarantee_remark3'],

    'signatureverification_applicable1' => @$input['signatureverification_applicable1'],
    'signatureverification_document1' => @$input['signatureverification_document1'],
    'signatureverification_discrepancies1' => @$input['signatureverification_discrepancies1'],
    'signatureverification_remark3' => @$input['signatureverification_remark3'],

    'dpn_applicable1' => @$input['dpn_applicable1'],
    'dpn_document1' => @$input['dpn_document1'],
    'dpn_discrepancies1' => @$input['dpn_discrepancies1'],
    'dpn_remark3' => @$input['dpn_remark3'],

    'boardresolve_applicable1' => @$input['boardresolve_applicable1'],
    'boardresolve_document1' => @$input['boardresolve_document1'],
    'boardresolve_discrepancies1' => @$input['boardresolve_discrepancies1'],
    'boardresolve_remark3' => @$input['boardresolve_remark3'],
    // 'boardresolve_attachment1' => @$input['boardresolve_attachment1'],

    'other3_applicable1' => @$input['other3_applicable1'],
    'other3_document1' => @$input['other3_document1'],
    'other3_remarks' => @$input['other3_remarks'],

   //  //kyc of security start

    'mortgagedocument_applicable1' => @$input['mortgagedocument_applicable1'],
    'mortgagedocument_document1' => @$input['mortgagedocument_document1'],
    'mortgagedocument_discrepancies1' => @$input['mortgagedocument_discrepancies1'],
    'mortgagedocument_remark4' => @$input['mortgagedocument_remark4'],

    'hypothicationagreement_applicable1' => @$input['hypothicationagreement_applicable1'],
    'hypothicationagreement_document1' => @$input['hypothicationagreement_document1'],
    'hypothicationagreement_discrepancies1' => @$input['hypothicationagreement_discrepancies1'],
    'hypothicationagreement_remark4' => @$input['hypothicationagreement_remark4'],

    'escrowagreement_applicable1' => @$input['escrowagreement_applicable1'],
    'escrowagreement_document1' => @$input['escrowagreement_document1'],
    'escrowagreement_discrepancies1' => @$input['escrowagreement_discrepancies1'],
    'escrowagreement_remark4' => @$input['escrowagreement_remark4'],

    'nachagreement_applicable1' => @$input['nachagreement_applicable1'],
    'nachagreement_document1' => @$input['nachagreement_document1'],
    'nachagreement_discrepancies1' => @$input['nachagreement_discrepancies1'],
    'nachagreement_remark4' => @$input['nachagreement_remark4'],

    'pdc_applicable1' => @$input['pdc_applicable1'],
    'pdc_document1' => @$input['pdc_document1'],
    'pdc_discrepancies1' => @$input['pdc_discrepancies1'],
    'pdc_remark4' => @$input['pdc_remark4'],

    'pdccoveringletter_applicable1' => @$input['pdccoveringletter_applicable1'],
    'pdccoveringletter_document1' => @$input['pdccoveringletter_document1'],
    'pdccoveringletter_discrepancies1' => @$input['pdccoveringletter_discrepancies1'],
    'pdccoveringletter_remark4' => @$input['pdccoveringletter_remark4'],


    'other4_applicable1' => @$input['other4_applicable1'],
    'other4_document1' => @$input['other4_document1'],
    'other4_remarks' => @$input['other4_remarks'],
   
   
 ] );

    // //new
    // if ($request->hasFile('img'))
    //   {
    //     $image =$request->file('img');
    //     $image_size =$image->getClientsize();
    //     $image_ext =$image->getClientOriginalExtension();
    //     $new_image_name= rand(123456,999999).".".$image_ext;
    //     $destination_path =public_path('/images');
    //     $image->move($destination_path,$new_image_name);


    //     $tab1 =new tab1;
    //     $tab1->image_name= $new_image_name;
    //     $tab1->image_size= $image_size;

    //     if($tab1->save())
    //     {
    //       // return redirect()->back()->with('msg','Image upload successfully');
    //     return Redirect::to($redirectUrl)->with('message', 'Checklist has beed successfully saved');
    //     }

    //   }
    //   else
    //   {
    //     return back()->with('msg','Please select any image file');
    //   }
  
  // $redirectUrl = 'home';

  $redirectUrl = $this->generateRedirectURL('loans/praposal/createchecklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);

 

  return Redirect::to($redirectUrl)->with('message', 'Checklist has beed successfully saved');

}
