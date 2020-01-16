<style type="text/css" media="screen">
textarea,
input,
select {
  outline: none;
  -webkit-appearance: none;
  border: 0px;
  outline: 0px;
}
</style>
<!doctype html>
<!--[if IE 7 ]>
  <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>
  <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>
  <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!-->
  <html lang="en-US">
  <!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />
    <title>SME Niwas</title>
    <link rel="stylesheet" href={{{URL::asset( "/css/bootstrap.css")}}} type="text/css" media="all" />
    <link rel="stylesheet" href={{{URL::asset( "/css/bootstrap-theme.css")}}} type="text/css" media="all" />
    <link rel="stylesheet" href={{{URL::asset( "/css/font-awesome.css")}}} type="text/css" media="all" />
  <link rel="stylesheet" href={{{URL::asset( "/css/sme.css")}}} type="text/css" media="all" /> {{--
  <link rel="stylesheet" href='{{{URL::asset("/css/dataTables.tableTools.css")}}}' type="text/css" media="all" />--}} {{--
  <link rel="stylesheet" href={{{URL::asset( "/css/dataTables.bootstrap.css")}}} type="text/css" media="all" />--}}
  <script type='text/javascript' src={{{URL::asset( '/js/jquery-1.11.2.min.js')}}}></script>
  {{--
  <style type="text/css">
    --
    }

    }

      {
        {
        --.content {
          --
        }
      }
        {
          {
          --overflow: hidden;
          --
        }
      }
        {
          {
          --page-break-inside: avoid;
          --
        }
      }
        {
          {
          --page-break-after: avoid;
          --
        }
      }
        {
          {
          --
        }
        --
      }
    }

      {
        {
        --
      </style>--}}
    </head>

    <body>
      <!--header:start-->
      <!--header:end-->
      <div class="row">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    {{--
      <p>&nbsp;</p>--}}
    </div>
    <div class="col-md-12">
    {{--
      <div class="tab-content " style="padding:10px;">--}}
        <div id="CompanyBackground">
          @if(Auth::user()->isAnalyst() || Auth::user()->isBankUser())
          <div class="col-md-7" style="margin-left: 32%;">
            <p class="user_name">Profile & Loan Details </p>
          </div>
          <div class="col-md-12">
            <div class="panel panel-success" style="width: 100%;border-color: #333;">
              <div class="panel-heading">User Details</div>
            {{--
              <div style="padding-left: 5px;padding-top: 10px;">--}}
                <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                  <table class="table table-bordered">
                    <tr>
                      <td style="width: 100px;">
                        <div style="margin-left: 10px;">
                          {!! Form::label('name_of_firm','Name of Firm: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('name_of_firm',$name_of_firm,['class' => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td style="width: 100px;">
                        <div style="margin-left: 10px;">
                          {!! Form::label('firm_pan','PAN No of Firm: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('firm_pan',$firm_pan,['class' => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('entity_type','Type of Legal Entity: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('owner_entity_type',$chosenEntity, ['id' => 'owner_entity_type','class' => 'readonly-text'])
                          !!}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('owner_name','Name of Owner/Director: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('owner_name',$owner_name,['class' => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('owner_email','Owners Email id: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('owner_email',$owner_email,['class' => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('address','Address: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::textarea('address',isset($address)? $address:null,array('class' =>'readonly-text','size'
                          => '30x2')) !!}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('owner_city','City: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('owner_city',$chosenCity,['class' => 'readonly-text', 'style' =>'width: 75%;'])
                          !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('owner_state','State: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('owner_state',$chosenState,['class' => 'readonly-text', 'style'=>'width: 75%;'])
                          !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('pincode','Pincode: ', ['class'=>'control-label']) !!}<br> {!! Form::text('pincode',$pincode,['class'
                          => 'readonly-text']) !!}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('contact_numbers','Contact Number 1: ',['class'=>'control-label'])!!}<br> {!! Form::text('contact1',$contact1,['class'
                          => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('contact_numbers','Contact Number 2: ',['class'=>'control-label']) !!} {!! Form::text('contact2',$contact2,['class'
                          => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('latest_turnover','Audited Turnover(In Lacs): ', ['class'=>'control-label']) !!}<br>                        {!! Form::text('latest_turnover',$latest_turnover,['class' => 'readonly-text'])!!}
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              {{--</div>--}}
            </div>
            @if(isset($referredUserID))
            <div class="panel panel-success" style="width: 100%;border-color: #333;">
              <div class="panel-heading">Channel Partner Details</div>
            {{--
              <div style="padding-left: 10px;padding-top: 10px;">--}}
                <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                  <table class="table table-bordered">
                    <tr>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('adv_name','Advisor Name: ', ['class'=>'control-label']) !!}<br> {!! Form::text('adv_name',$adv_name,['class'
                          => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('adv_mobile','Advisors Mobile No.: ', ['class'=>'control-label']) !!}<br> {!! Form::text('adv_mobile',$adv_mobile,['class'
                          => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('adv_email','Advisor Email Id: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('adv_email',$adv_email,['class' => 'readonly-text']) !!}
                        </div>
                      </td>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('adv_pan','Advisors PAN Number: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('adv_pan',$adv_pan,['class' => 'readonly-text']) !!}
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              {{--</div>--}}
            </div>
            @endif
            <div class="panel panel-success" style="width: 100%;border-color: #333;margin-top: 25px;page-break-after: avoid;">
              <div class="panel-heading">Loan Details</div>
            {{--
              <div style="padding-left: 10px;padding-top: 10px;">--}}
                <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                  <table class="table table-bordered">
                    <tr>
                      <td style="width: 400px;">
                        <div style="margin-left: 10px;">
                          {!! Form::label('end_use','End Use: ',['class'=>'control-label']) !!}<br> @if(isset($endUseList))
                          {!!Form::text('end_use',App\Helpers\FormatHelper::formatEndUseList($endUseList), ['class' => 'readonly-text','style'=>'width:
                          200px;']) !!} @endif
                        </div>
                      </td>
                      <td style="width: 400px;">
                        <div style="margin-left: 10px;">
                          {!! Form::label('loan_product','Loan Product: ', ['class'=>'control-label']) !!}<br> @if(isset($loanType))
                          {!! Form::text('loan_product',App\Helpers\FormatHelper::formatLoanType($loanType), ['class' => 'readonly-text','style'=>'width:
                          200px;']) !!} @endif
                        </div>
                      </td>
                      <td style="width: 130px;">
                        <div style="margin-left: 10px;">
                          {!! Form::label('amount','Amount (Rs Lacs): ', ['class'=>'control-label'])!!}<br> {!! Form::text('amount',
                          $amount, ['class' => 'readonly-text','style'=>'width:107px;']) !!}
                        </div>
                      </td>
                      <td style="width: 130px;">
                        <div style="margin-left: 10px;">
                          {!! Form::label('loan_tenure','Tenor in Years: ', ['class'=>'control-label']) !!}
                          <br> {!! Form::text('loan_tenure', $loanTenure, ['class' => 'readonly-text','style'=>'width: 90px;'])
                          !!}
                        </div>
                      </td>
                    </tr>
                    @if(isset($referredUserID))
                    <tr>
                      <td>
                        <div style="margin-left: 10px;">
                          {!! Form::label('adv_name','Channel Partner Reference: ', ['class'=>'control-label']) !!}<br> {!!
                            Form::text('adv_name',$adv_name,['class' => 'readonly-text']) !!}
                          </div>
                        </td>
                      </tr>
                      @endif
                    </table>
                  </div>
                {{--</div>--}}
              </div>
            </div>
            @endif
            <?php
            $LoanAgainstShare = $loan->getLoanAgainstShare()->get()->first();
            ?>
            <br>
            <br> {!! Form::model($loan) !!}
            <div class="col-md-7" style="margin-left: 32%;">
              <p class="user_name">Background - KYC Details </p>
            </div>
            @if($deletedQuestionHelper->isQuestionValid("A1"))
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;">
                <div class="panel-heading">KYC Details</div>
                <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                  <table class="table table-bordered">
                    <div class="row" id="divTab_sub2">
                      <tr>
                        <td>
                          @if($deletedQuestionHelper->isQuestionValid("A1.1"))
                          <div style="margin-left: 10px;">
                            {!! Form::label('com_business_type', 'Business Type: ') !!} {!! Form::text('com_business_type', null, ['class' => 'readonly-text'])!!}
                          </div>
                          @endif
                        </td>
                        <td>
                          @if($deletedQuestionHelper->isQuestionValid("A1.2"))
                          <div style="margin-left: 10px;">
                            {!! Form::label('com_vat','VAT: ') !!} {!! Form::text('com_vat', null, ['class' => 'readonly-text']) !!}
                          </div>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td>
                          @if($deletedQuestionHelper->isQuestionValid("A1.3"))
                          <div style="margin-left: 10px;">
                            {!! Form::label('com_cin_no','CIN: ') !!} {!! Form::text('com_cin_no', null, ['class' => 'readonly-text']) !!}
                          </div>
                          @endif
                        </td>
                      {{--
                      <td>
                        @if($deletedQuestionHelper->isQuestionValid("A1.4"))
                        <div style="margin-left: 10px;">
                          {!! Form::label('com_service_tax_no','Service Tax: ') !!} {!! Form::text('com_service_tax_no', null, ['class' => 'readonly-text'])
                          !!}
                        </div>
                        @endif
                      </td> --}}
                      <td>
                        @if($deletedQuestionHelper->isQuestionValid("A1.4"))
                        <div style="margin-left: 10px;">
                          {!! Form::label('gst','GST: ') !!} {!! Form::text('gst', null, ['class' => 'readonly-text']) !!}
                        </div>
                        @endif
                      </td>
                    </tr>
                  </div>
                </table>
              </div>
            </div>
          </div>
          @endif {{--======Start DivSub 2=============================================================================--}}
          <div class="col-md-7" style="  margin-left: 32%; margin-top: 25px;">
            <p class="user_name">Business Details
            </p>
          </div>
          @if($deletedQuestionHelper->isQuestionValid("A2"))
          <div class="col-md-12">
            <div class="panel panel-success" style="width: 100%;border-color: #333;">
              <div class="panel-heading">Business Background</div>
              <table class="table table-bordered">
                <tr>
                  <td>
                    @if($deletedQuestionHelper->isQuestionValid("A2.1"))
                    <div style="margin-left: 10px;margin-bottom: 20px;">
                      {!! Form::label('com_industry_segment', 'Select Industry Segment: ', ['style'=>'']) !!} {!! Form::text('com_industry_segment',
                      null, ['class' => 'readonly-text']) !!}
                    </div>
                    @endif
                  </td>
                  <td>
                    <div style="margin-left: 10px;margin-bottom: 20px;" id="manufacturing_location">
                      {!! Form::label('com_number_mfglocations', 'No of Manufacturing locations of your business: ',['style'=> '']) !!} @if($loan->com_number_mfglocations
                        == 'option_1') {!! Form::text('com_number_mfglocations', '1', ['class' => 'readonly-text']) !!} @elseif($loan->com_number_mfglocations
                          == 'option_2') {!! Form::text('com_number_mfglocations', '2 - 4', ['class' => 'readonly-text']) !!}
                        @elseif($loan->com_number_mfglocations == 'option_3') {!! Form::text('com_number_mfglocations', '>
                        4', ['class' => 'readonly-text']) !!} @endif
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      @if($deletedQuestionHelper->isQuestionValid("A2.3"))
                      <div style="margin-left: 10px;">
                        {!! Form::label('com_number_officebranch','No of Office Branches: ',['class'=>'control-label']) !!} {!! Form::text('com_number_officebranch',
                        null, ['class' => 'readonly-text'])!!}
                      </div>
                      @endif
                    </td>
                    <td>
                      @if($deletedQuestionHelper->isQuestionValid("A2.4"))
                      <div style="margin-left: 10px;">
                        {!! Form::label('com_co_business_old', 'How many years old is the business/company:') !!} {!! Form::text('com_co_business_old',
                        null, ['class' => 'readonly-text']) !!}
                      </div>
                      @endif
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <?php
            $getSalesAreaDetail = $loan->getSalesAreaDetails()->get()->first();
            ?>
            @if($deletedQuestionHelper->isQuestionValid("A2.5"))
            <div class="col-md-12" style="page-break-after: always; ">
              {{--
              <div class="panel panel-success" style="width: 100%;border-color: #333;page-break-after: always; ">--}} {{--
                <table class="table " style="border-color: #333;">--}} {!! Form::close() !!} {!! Form::model($getSalesAreaDetail) !!} {{--
                  <tr>--}} {{--
                    <td>--}} {{--
                      <div class="col-xs-12 col-sm-12 col-md-12" style="margin-left:-20px;">--}} {{--
                        <div class="col-md-12">--}} @if(isset($salesAreaDetails) && isset($salesAreaDetails->city_name) && $salesAreaDetails->sales_area_type
                        == 0)
                        <div class="panel panel-success" id="multiple_cities" style="width: 100%;border-color: #333;">
                          <div class="panel-heading">City Name</div>
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-6" id="one_city">
                                  {{--
                                    <div class="col-md-8" style="padding-left: 16px;margin-top: -20px;">--}}
                                      <div class="form-group">
                                        {!! Form::label('city_name', 'City Name: ') !!} {!! Form::text('city_name', isset($salesAreaDetails->city_name) ? $salesAreaDetails->city_name
                                        : null, ['class' => 'readonly-text'])!!}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @elseif(isset($salesAreaDetails) && $salesAreaDetails->sales_area_type == 1)
                              <div class="panel panel-success" id="multiple_cities" style="width: 100%;border-color: #333;">
                                <div class="panel-heading">City Names</div>
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      {!! Form::label('city_name_1', 'City Name 1: ') !!} {!! Form::text('city_name_1', isset($salesAreaDetails->city_name_1) ?
                                      $salesAreaDetails->city_name_1 : null, ['class' => 'readonly-text'])!!}
                                      <br/>
                                    </div>
                                    <div class="col-md-6">
                                      {!! Form::label('city_name_2', 'City Name 2: ') !!} {!! Form::text('city_name_2', isset($salesAreaDetails->city_name_2) ?
                                      $salesAreaDetails->city_name_2 : null, ['class' => 'readonly-text'])!!}
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @elseif(isset($salesAreaDetails) && $salesAreaDetails->sales_area_type == 2)
                              <div class="panel panel-success" id="multiple_states" style="width: 100%;border-color: #333;">
                                <div class="panel-heading">State Names</div>
                                <div class="panel-body">
                                  <div class="row">
                                    @if(isset($salesAreaDetails->multi_state_1))
                                    <div class="col-md-6">
                                      {!! Form::label('multi_state_1', 'State Name 1: ') !!} {!! Form::text('multi_state_1', isset($salesAreaDetails->state_name_1)
                                      ? $salesAreaDetails->state_name_1 : null, ['class' => 'readonly-text'])!!}
                                    </div>
                                    @endif @if(isset($salesAreaDetails) && isset($salesAreaDetails->multi_state_2) && $salesAreaDetails->multi_state_2 != null)
                                    <div class="col-md-6">
                                      {!! Form::label('multi_state_2', 'State Name 2: ') !!} {!! Form::text('multi_state_2', isset($salesAreaDetails->state_name_2)
                                      ? $salesAreaDetails->state_name_2 : null, ['class' => 'readonly-text'])!!}
                                    </div>
                                    @endif
                                  </div>
                                  @if(isset($salesAreaDetails) && isset($salesAreaDetails->multi_state_3) || isset($salesAreaDetails->multi_state_4))
                                  <div class="row">
                                    @if(isset($salesAreaDetails->multi_state_3) && $salesAreaDetails->multi_state_3 != null)
                                    <div class="col-md-6" id="state_name_3">
                                      {!! Form::label('multi_state_3', 'State Name 3: ') !!} {!! Form::text('multi_state_3', isset($salesAreaDetails->state_name_3)
                                      ? $salesAreaDetails->state_name_3 : null, ['class' => 'readonly-text'])!!}
                                    </div>
                                    @endif @if(isset($salesAreaDetails->multi_state_4) && $salesAreaDetails->multi_state_4 != null)
                                    <div class="col-md-6" id="state_name_4">
                                      {!! Form::label('multi_state_4', 'State Name 4: ') !!} {!! Form::text('multi_state_4', isset($salesAreaDetails->state_name_4)
                                      ? $salesAreaDetails->state_name_4 : null, ['class' => 'readonly-text'])!!}
                                    </div>
                                    @endif
                                  </div>
                                  @endif @if(isset($salesAreaDetails->multi_state_5) && $salesAreaDetails->multi_state_5 != null)
                                  <div class="row">
                                    <div class="col-md-6" id="state_name_5">
                                      {!! Form::label('multi_state_5', 'State Name 5: ') !!} {!! Form::text('multi_state_5', isset($salesAreaDetails->state_name_5)
                                      ? $salesAreaDetails->state_name_5 : null, ['class' => 'readonly-text'])!!}
                                    </div>
                                  </div>
                                  @endif
                                </div>
                              </div>
                            @endif {{--
                          </div>--}} {{--
                        </div>--}} {{--
                    </td>--}} {{--
                  </tr>--}} {{--
                </table>--}} {{--
              </div>--}}
            </div>
            <br> @endif @endif {!! Form::close() !!} {{--======Start DivSub 3=============================================================================--}}
            {!! Form::model($loan) !!}
            <div class="col-md-7" style="  margin-left: 28%; margin-top: 20px;   margin-bottom: 20px;">
              <p class="user_name">Background - Customer/Sales Details</p>
            </div>
            @if($deletedQuestionHelper->isQuestionValid("A3"))
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;">
                <div class="panel-heading">Customer/Sales Details</div>
                <table class="table table-bordered">
                  @if($deletedQuestionHelper->isQuestionValid("A3.1"))
                  <tr>
                    <td>
                      <div class="col-md-12" style="padding-bottom: 10px; ">
                        {!! Form::label(null,'Are your Sales? ',['style' =>'']) !!} {!! Form::text('com_your_salestype', isset($salesAreaDetails->com_your_salestype)
                        ? $salesAreaDetails->com_your_salestype : null, ['class' => 'readonly-text'])!!}
                      </div>
                    </td>
                  </tr>
                  @if(isset($comYourSalestype)&& $comYourSalestype == 'Export' || $comYourSalestype == 'Both')
                  <tr>
                    <td>
                      <div class="col-md-12" style="padding-bottom: 20px;">
                        <div id="AnnualValueExport" class="collapse">
                          <label style="">Annual Value of Exports( <i
                            class="fa fa-rupee"></i>
                            In Lacs )</label> {!! Form::text('com_annual_value_exports', isset($comAnnualValueExport)?
                            $comAnnualValueExport:null, array('class' => 'readonly-text')) !!}
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif @endif @if($deletedQuestionHelper->isQuestionValid("A3.2"))
                    <tr>
                      <td>
                        <div class="col-md-12" style="padding-bottom: 10px;">
                          {!! Form::label('com_your_salestoa','Are Your Sales to a?', ['class'=>'control-label','style' => '']) !!} {!! Form::text('com_your_salestoa',
                            isset($salesAreaDetails->com_your_salestoa) ? $salesAreaDetails->com_your_salestoa : null, ['class'
                            => 'readonly-text','style' => 'width: 100%;'])!!}
                          </div>
                        </td>
                      </tr>
                      @endif
                      <tr>
                        <td>
                          @if($deletedQuestionHelper->isQuestionValid("A3.4"))
                          <div class="col-md-12" style="padding-bottom: 15px;">
                            {!! Form::label('com_key_productservice_offered','Key Products/Services Offered (give brief description)',['style' => 'width:100%;
                              margin-left: 0px;']) !!} {!! Form::text('com_key_productservice_offered', isset($key_products_manufactured)?
                              $key_products_manufactured:null, array('class' => 'readonly-text', 'size' => '45x3','style' =>
                              'border: none; outline:none;')) !!}
                            </div>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  @endif {!! Form::close() !!} {{--======Start Of Promoter Tab.=============================================================================--}}
                  {{--======Start DivSub 1=============================================================================--}}
                  <?php
                  $promoterKycDetail = $loan->getPromoterKycDetails()->get()->all();
                  $promoterDetail = $loan->getPromoterDetails()->get()->first();
                  ?>
                  {!! Form::model($promoterKycDetail) !!}
                  <div class="col-md-7" style="margin-left: 28%; margin-top: 20px; margin-bottom: 20px;">
                    <p class="user_name">Promoter Details - KYC Details </p>
                  </div>
                  @for($formIndex=0; $formIndex
                    < $count; $formIndex++) <div class="col-md-12">
                      <div class="panel panel-success" style="width: 100%;border-color: #333;">
                        <div class="panel-heading">KYC Details</div>
                        <table class="table table-bordered">
                          <tr>
                            <td style="padding: 5px;">
                          {{--
                            <div class="col-md-4">--}} {!! Form::label('promoters.name','Name: ') !!} @if(isset($temp_array[$formIndex]['kyc_name']))
                              {!! Form::text('kyc_name',$temp_array[$formIndex]['kyc_name'], ['class' => 'readonly-text'])
                            !!} @else {!! Form::text('kyc_name',null, ['class' => 'readonly-text']) !!} @endif {{--
                          </div>--}}
                        </td>
                        <td style="padding: 5px;">
                          @if($deletedQuestionHelper->isQuestionValid("B1.3")) {{--
                          <div class="col-md-4">--}} {!! Form::label('promoters.pan','PAN: ', ['class'=>'control-label']) !!} @if(isset($temp_array[$formIndex]['kyc_pan']))
                            {!! Form::text('kyc_pan',$temp_array[$formIndex]['kyc_pan'], ['class' => 'readonly-text']) !!}
                            @else {!! Form::text('kyc_pan',null, ['class' =>'readonly-text']) !!} @endif {{--
                          </div>--}} @endif
                        </td>
                        <td style="padding: 5px;">
                          @if($deletedQuestionHelper->isQuestionValid("B1.2")) {{--
                          <div class="col-md-4">--}} {!! Form::label('promoters.din','DIN: ') !!} @if(isset($temp_array[$formIndex]['kyc_din']))
                            {!! Form::text('kyc_din',$temp_array[$formIndex]['kyc_din'], ['class' => 'readonly-text']) !!}
                            @else {!! Form::text('kyc_din',null, ['class' =>'readonly-text']) !!} @endif {{--
                          </div>--}} @endif
                        </td>
                        <td style="padding: 5px;">
                          @if($deletedQuestionHelper->isQuestionValid("B1.4")) {{--
                          <div class="col-md-4">--}} {!! Form::label('promoters.address_prooftype','Address Proof Type: ',['style' =>'width: 130%;'])
                          !!} @if(isset($temp_array[$formIndex]['kyc_address_proof'])) {!! Form::text('kyc_address_proof',$temp_array[$formIndex]['kyc_address_proof'],
                            ['class' => 'readonly-text']) !!} @else {!! Form::text('kyc_address_proof',null, ['class' =>'readonly-text'])
                            !!} @endif {{--
                          </div>--}} @endif
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 5px;">
                          @if($deletedQuestionHelper->isQuestionValid("B1.5")) {{--
                          <div class="col-md-4">--}} {!! Form::label('promoters.address_proof_id','ID: ') !!} @if(isset($temp_array[$formIndex]['kyc_proof_id']))
                            {!! Form::text('kyc_proof_id',$temp_array[$formIndex]['kyc_proof_id'], ['class' => 'readonly-text'])
                            !!} @else {!! Form::text('kyc_proof_id',null, ['class' =>'readonly-text']) !!} @endif {{--
                          </div>--}} @endif
                        </td>
                        <td style="padding: 5px;">
                          @if($deletedQuestionHelper->isQuestionValid("B1.6")) {{--
                          <div class="col-md-4">--}} {!! Form::label('address', 'Address: ') !!} @if(isset($temp_array[$formIndex]['kyc_address']))
                            {!! Form::text('kyc_address',$temp_array[$formIndex]['kyc_address'], array('class' => 'readonly-text','style'
                              => 'border: none; outline:none;')) !!} @else {!! Form::text('kyc_address',null, ['class' =>'readonly-text'])
                            !!} @endif {{--
                          </div>--}} @endif
                        </td>
                        <td style="padding: 5px;">
                          @if($deletedQuestionHelper->isQuestionValid("B1.7")) {{--
                          <div class="col-md-4">--}} {!! Form::label('state', 'State: ')!!} @if(isset($temp_array[$formIndex]['kyc_state'])) {!!
                            Form::text('kyc_state',$temp_array[$formIndex]['kyc_state'], array('class'=> 'readonly-text'))
                            !!} @else {!! Form::text('kyc_state',null, ['class' =>'readonly-text']) !!} @endif {{--
                          </div>--}} @endif
                        </td>
                        <td style="padding: 5px;">
                          @if($deletedQuestionHelper->isQuestionValid("B1.8")) {{--
                          <div class="col-md-4">--}} {!! Form::label('pin', 'Pincode: ')!!} @if(isset($temp_array[$formIndex]['kyc_pin'])) {!!
                            Form::text('kyc_pin',$temp_array[$formIndex]['kyc_pin'], array('class' => 'readonly-text')) !!}
                            @else {!! Form::text('kyc_pin',null, ['class' =>'readonly-text']) !!} @endif {{--
                          </div>--}} @endif
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                @endfor {!! Form::close() !!} {{--======Start DivSub 2 Promoter Tab=================================================================--}}
                {!! Form::model($promoterDetail) !!}
                <div class="col-md-7" style="margin-left: 30%;margin-top: 20px; margin-bottom: 20px;">
                  <p class="user_name">Promoter Details - Financial Details </p>
                </div>
                <div class="col-md-12">
                  <div class="panel panel-success" style="width: 100%;border-color: #333;">
                    <div class="panel-heading">Vehicles Owned( <i class="fa fa-rupee"></i> In Lacs )</div>
                    <table class="table table-bordered">
                      <tr>
                        <td>
                          @if($deletedQuestionHelper->isQuestionValid("B2.1"))
                          <div class="col-md-6">
                            <div style="margin-left: auto;">
                              {!! Form::label('vehiclesOwned','Vehicles Owned: ') !!} @if(isset($promoterDetail['fin_vehiclesowned'])) {!! Form::text('fin_vehiclesowned',
                                $promoterDetail['fin_vehiclesowned'], array('class' => 'readonly-text')) !!} @else {!! Form::text('fin_vehiclesowned',null
                                , ['class' => 'readonly-text']) !!} @endif
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-6">
                              <div style="margin-left: auto; margin-right: auto;">
                                {!! Form::label('fin_vehiclesowned_marketvalue','Market Value: ',['style' => '']) !!} {!! Form::text('fin_vehiclesowned_marketvalue',
                                null , ['class' => 'readonly-text']) !!}
                              </div>
                            </div>
                            @endif
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <br>
                  <div class="col-md-12">
                    <div class="panel panel-success" style="width: 100%;border-color: #333;">
                      <div class="panel-heading">Properties Owned( <i class="fa fa-rupee"></i> In Lacs )</div>
                      <table class="table table-bordered">
                  {{--
                  <tr>--}} {{--
                    <td colspan="4" class="text-center">--}} {{--
                      <h4 class="panel-title">--}} {{--
                        <label style="width:150%; margin-left: 15px;">Properties Owned( <i class="fa fa-rupee"></i> In Lacs--}}
                                                                          {{--)</label>--}} {{--
                      </h4>--}} {{--
                    </td>--}} {{--
                  </tr>--}}
                  <tr>
                    <td colspan="4">
                      @if($deletedQuestionHelper->isQuestionValid("B2.2")) {{--
                      <div class="col-md-12">--}}
                        <div style="padding:0px;">
                          {!! Form::label('fin_propertiesowned','Properties Owned: ') !!} {!! Form::text('fin_propertiesowned', null , ['class' =>
                          'readonly-text']) !!}
                        </div>
                      {{--</div>--}} @endif
                    </td>
                  </tr>
                  {{--
                  <div class="row"></div>--}} {{--
                  <tr>--}} 
                    @if($deletedQuestionHelper->isQuestionValid("B2.2"))
                    <?php $i = 0?> @for($formIndex=1; $formIndex
                      <=$countPropertyOwned; $formIndex++) <tr>
                        <td>
                          <div class="col-sm-8 col-lg-3">
                            <div class="form-group" style="margin-left: auto;">
                              @if(isset($existingPropertyOwned[$i]['property_type'])) {!! Form::label('property_type','Type of Property: ',['style' =>'width:130%;'])
                              !!} {!! Form::text('property_type',$existingPropertyOwned[$i]['property_type'],['class'=>'readonly-text'])
                              !!} @endif
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="col-sm-8 col-lg-3">
                            <div class="form-group" style="margin-left: auto;">
                              @if(isset($existingPropertyOwned[$i]['market_value'])) {!! Form::label('market_value','Market Value: ') !!} {!! Form::text('market_value',
                                $existingPropertyOwned[$i]['market_value'],['class' => 'readonly-text']) !!} @else {!! Form::label('market_value','Market
                                Value') !!} {!! Form::text('market_value', null,['class' => 'readonly-text']) !!} @endif
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-sm-8 col-lg-3">
                              <div class="form-group" style="margin-left: auto;">
                                @if(isset($existingPropertyOwned[$i]['location_city'])) {!! Form::label('location_city','Location City: ') !!} {!! Form::text('location_city',
                                  $existingPropertyOwned[$i]['location_city'] , ['class' =>'readonly-text']) !!} @else {!! Form::label('location_city','Location
                                  City: ') !!} {!! Form::text('location_city', null , ['class' =>'readonly-text']) !!} @endif
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="col-sm-8 col-lg-3">
                                <div class="form-group" style="margin-left: 10px;">
                                  {!! Form::label('mortgage_radio','Is it mortgaged? ') !!} @if(isset($existingPropertyOwned[$i]['is_mortgage'])) {!! Form::text('is_mortgage',
                                    $existingPropertyOwned[$i]['is_mortgage'] , ['class' =>'readonly-text']) !!} @else {!! Form::text('is_mortgage',
                                    null , ['class' =>'readonly-text']) !!} @endif
                                  </div>
                                </div>
                              </td>
                              <?php $i++;?> @endfor @endif
                            </tr>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                      <div class="panel panel-success" style="width: 100%;border-color: #333;page-break-after: always;">
                        <div class="panel-heading">Other Assets Owned( <i class="fa fa-rupee"></i> In Lacs )</div>
                        <table class="table table-bordered">
                  @if($deletedQuestionHelper->isQuestionValid("B2.3")) {{--
                  <tr>--}} {{--
                    <td colspan="3">--}} {{--
                      <h4>--}} {{--
                        <label style="width:150%; margin-left: 15px;">Other Assets Owned( <i class="fa fa-rupee"></i> In--}}
                        {{--Lacs )</label>--}} {{--
                      </h4>--}} {{--
                    </td>--}} {{--
                  </tr>--}}
                  <tr>
                    <td>
                      <div class="col-md-4">
                        <div style="margin-left: auto;">
                          {!! Form::label('fixed_deposits','Fixed Deposits') !!} {!! Form::text('fin_fixeddeposit', null, ['class' => 'readonly-text'])
                          !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-4">
                        <div style="margin-left: auto;">
                          {!! Form::label('mutual_funds','Mutual Funds') !!} {!! Form::text('fin_mutualfunds', null, ['class' => 'readonly-text'])
                          !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-3">
                        <div style="margin-left: auto;">
                          {!! Form::label('listed_shares_owned','Listed Shares Owned') !!} {!! Form::text('fin_listedshares', null, ['class' => 'readonly-text'])
                          !!}
                        </div>
                      </div>
                    </td>
                    @endif
                  </tr>
                </table>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;">
                <div class="panel-heading">Personal Loan/Overdraft( <i class="fa fa-rupee"></i> In Lacs )</div>
                <table class="table table-bordered">
                  {{--
                  <tr>--}} {{--
                    <td colspan="4"> --}} {{--
                      <h4>--}} {{--
                        <label style="width:150%; margin-left: 15px;">Personal Loan/Overdraft( <i--}}
                          {{--class="fa fa-rupee"></i> In Lacs )</label>--}} {{--
                      </h4><br>--}} {{--
                    </td>--}} {{--
                  </tr>--}} @if($deletedQuestionHelper->isQuestionValid("B2.5"))
                  <tr>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_personal_bank','Name of Bank',['style' =>'width: 130%;']) !!} {!! Form::text('pl_bankname', null, ['class'
                          => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_personal_emi','Monthly EMI') !!} {!! Form::text('pl_monthlyemi', null, ['class' => 'readonly-text','style'
                          =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_personal_outstanding','Amount Outstanding') !!} {!! Form::text('pl_amtoutstanding', null, ['class'
                          => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_personal_total','Total Liability') !!} {!! Form::text('pl_totalliability', null, ['class' => 'readonly-text','style'
                          =>'width: 90%;']) !!}
                        </div>
                      </div>
                      @endif
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;">
                <div class="panel-heading">Vehicle Loan( <i class="fa fa-rupee"></i> In Lacs )</div>
                <table class="table table-bordered">
                  {{--
                  <tr>--}} {{--
                    <td colspan='4'>--}} {{--
                      <h4>--}} {{--
                        <label style="width:100%; margin-left: 15px;">Vehicle Loan( <i class="fa fa-rupee"></i> In--}}
                          {{--Lacs--}}
                        {{--)</label>--}} {{--
                      </h4><br>--}} {{--
                    </td>--}} {{--
                  </tr>--}} @if($deletedQuestionHelper->isQuestionValid("B2.6"))
                  <tr>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_vehicle_bank','Name of Bank',['style' =>'width: 130%;']) !!} {!! Form::text('vloan_bankname',null,
                          ['class' => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_vehicle_emi','Monthly EMI') !!} {!! Form::text('vloan_monthlyemi', null, ['class' => 'readonly-text','style'
                          =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_vehicle_outstanding','Amount Outstanding') !!} {!! Form::text('vloan_amtoutstanding', null, ['class'
                          => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_vehicle_total','Total Liability') !!} {!! Form::text('vloan_totalliability', null, ['class' => 'readonly-text','style'
                          =>'width: 90%;']) !!}
                        </div>
                      </div>
                      @endif
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;">
                <div class="panel-heading">Mortgage Loan( <i class="fa fa-rupee"></i> In Lacs )</div>
                <table class="table table-bordered">
                  @if($deletedQuestionHelper->isQuestionValid("B2.7"))
                  <tr>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_mortgage_bank','Name of Bank')!!} {!! Form::text('mortloan_bankname', null, ['class' => 'readonly-text','style'
                          =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_mortgage_emi','Monthly EMI') !!} {!! Form::text('mortloan_monthlyemi', null, ['class' => 'readonly-text','style'
                          =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_mortgage_outstanding','Amount Outstanding') !!} {!! Form::text('mortloan_amtoutstanding', null, ['class'
                          => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_mortgage_total','Total Liability') !!} {!! Form::text('mortloan_totalliability', null, ['class' =>
                          'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                      @endif
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;">
                <div class="panel-heading">Other Market Borrowings Loan( <i class="fa fa-rupee"></i> In Lacs )</div>
                <table class="table table-bordered">
                  @if($deletedQuestionHelper->isQuestionValid("B2.8"))
                  <tr>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_others_bank','Name of Bank',['style' =>'width: 130%;']) !!} {!! Form::text('borrowloan_bankname', null,
                          ['class' => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_others_emi','Monthly EMI') !!} {!! Form::text('borrowloan_monthlyemi', null, ['class' => 'readonly-text','style'
                          =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_others_outstanding','Amount Outstanding') !!} {!! Form::text('borrowloan_amtoutstanding', null, ['class'
                          => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_others_total','Total Liability') !!} {!! Form::text('borrowloan_totalliability', null, ['class' =>
                          'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                      @endif
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;">
                <div class="panel-heading">Credit Card Details( <i class="fa fa-rupee"></i> In Lacs )</div>
                <table class="table table-bordered">
                  @if($deletedQuestionHelper->isQuestionValid("B2.9"))
                  <tr>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_credit_card_issuer','Name of Card Issuer',['style' =>'width: 130%;']) !!} {!! Form::text('cc_bankname',
                          null, ['class' => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="col-md-6">
                        <div class="form-group" style="margin-left: auto;">
                          {!! Form::label('liab_credit_card_outstanding','Amount Outstanding') !!} {!! Form::text('cc_amtoutstanding', null, ['class'
                          => 'readonly-text','style' =>'width: 90%;']) !!}
                        </div>
                      </div>
                      @endif
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <br> {{--======Start DivSub 3 Promoter Tab=================================================================--}}
            <div class="col-md-7" style="margin-left: 30%; margin-top: 20px; margin-bottom: 20px;">
              <p class="user_name">Promoter Details - Other Details </p>
            </div>
            <div class="col-md-12">
              <div class="panel panel-success" style="width: 100%;border-color: #333;page-break-after: always;">
                <div class="panel-heading">Other Details</div>
                <table class="table table-bordered">
                  <tr>
                    <td>
                      @if($deletedQuestionHelper->isQuestionValid("B3.1"))
                      <div class="col-md-4">
                        {!! Form::label('othr_eduprofdegree', 'Education/professional degree: ') !!} @if(isset($educationDegree)) @if($educationDegree
                          == 1) {!! Form::text('othr_eduprofdegree', 'Doctor/Engineer' , ['class' =>'readonly-text']) !!} @elseif($educationDegree
                            == 2) {!! Form::text('othr_eduprofdegree', 'CA/MBA/Lawyer' , ['class' =>'readonly-text']) !!} @elseif($educationDegree
                              == 3) {!! Form::text('othr_eduprofdegree', 'Graduate' , ['class' =>'readonly-text']) !!} @elseif($educationDegree
                                == 4) {!! Form::text('othr_eduprofdegree', 'Others' , ['class' =>'readonly-text']) !!} @endif @endif
                              </div>
                              @endif
                            </td>
                            <td>
                              @if($deletedQuestionHelper->isQuestionValid("B3.2"))
                              <div class="col-md-4">
                                {!! Form::label('othr_promoterare', 'Promoters are: ') !!} @if(isset($promotersAre)) @if($promotersAre == 1) {!! Form::text('othr_promoterare',
                                  '1st Generation Entrepreneurs', ['class' =>'readonly-text']) !!} @elseif($promotersAre == 2) {!!
                                  Form::text('othr_promoterare', '2nd Generation' , ['class' =>'readonly-text']) !!} @elseif($promotersAre
                                    == 3) {!! Form::text('othr_promoterare', '3rd or More Generation' , ['class' =>'readonly-text'])
                                    !!} @endif @endif
                                    <br>
                                  </div>
                                  @endif
                                </td>
                                <td>
                                  @if($deletedQuestionHelper->isQuestionValid("B3.3"))
                                  <div class="col-md-4">
                                    {!! Form::label('othr_noofindependent', 'No. of independent families involved in business: ') !!} {!! Form::text('othr_noofindependent',
                                    null , ['class' =>'readonly-text']) !!}
                                    <br>
                                  </div>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  @if($deletedQuestionHelper->isQuestionValid("B3.4"))
                                  <div class="col-md-6" style="padding:15px">
                                    {!! Form::label('othr_sourceofincome', 'Does promoter have other sources of income? (Interest, rental, others): ') !!} {!!
                                      Form::text('othr_sourceofincome', null, ['class' => 'readonly-text']) !!}
                                    </div>
                                    @endif
                                  </td>
                                  <td>
                                    @if($deletedQuestionHelper->isQuestionValid("B3.5"))
                                    <div class="col-md-3" style="padding: 15px">
                                      {!! Form::label('cibilScore', 'Do you know you CIBIL Score? ') !!} {!! Form::text('othr_doyouknowcibil', null, ['class' =>
                                      'readonly-text']) !!}
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-md-3" style="padding: 15px">
                                      <label for="cibilScore" style="width: 130%;">Your CIBIL Score</label> {!! Form::text('othr_cibilscore',
                                      null, ['class' => 'readonly-text']) !!}
                                    </div>
                                    @endif
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <br> {!! Form::close() !!} {{--======End Of Promoters Tab.=============================================================================--}}
                          {{--======Start Financial DivSub 1=============================================================================--}}
                          <?php
                          $getBalanceSheetDetail = $loan->getBalanceSheetDetails()->get()->first();
                          $getProfitLossDetail = $loan->getProfitLossDetails()->get()->first();
                          $getExistingLoanDetail = $loan->getExistingLoanDetails()->get()->first();
                          ?>
                          <div class="col-md-9">
                            <p class="user_name" style="margin-left: 30%;margin-top: 20px; margin-bottom: 20px;">Financials - Balance Sheet Details </p>
                          </div>
                          <div class="row" id="divTab_sub1">
                            <div class="col-sm-12">
                              <?php $counter = 0;?> @foreach($bl_year as $blyear)
                              <div class="col-lg-1" style="width:33%;float: left;">
                                <div class="panel panel-success" style="width: 100%;border-color: #ccc; border-right-width: 2px;">
                                  <!-- Default panel contents -->
                                  <div class="panel-heading" name={{$blyear}}>{{$blyear}}<span>&nbsp;( <span
                                    class="fa fa-inr">&nbsp; </span>Lacs )
                                  </span>
                                </div>
                                <div class="panel-body" style="padding:0px;">
                                  <!-- Table -->
                                  <table cellpadding="3" cellspacing="3" style="margin-bottom: 0px;">
                          {{--
                          <tr>--}} {{--
                            <td style="padding: 2px;">--}} {{--
                              <table style="margin-bottom: 0px;">--}} {{--
                                <tr>--}} {{--
                                  <td>--}} {{--
                                    <table>--}}
                                      <tr>
                                        <td style="padding: 3px;">
                                          {!! Form::label('Networth', 'Networth: ') !!}
                                        </td>
                                        <td>
                                          @if(isset($bl_details[$counter])) {!! Form::text('financial['.$counter.'][networth]', $bl_details[$counter]['networth'] ,array('class'
                                            =>'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][networth]',
                                            null , array('class' => 'readonly-text')) !!} @endif
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="padding: 3px;">
                                            {!! Form::label('TotalDebt', 'Total Debt: ') !!}
                                          </td>
                                          <td>
                                            @if(isset($bl_details[$counter])) {!!Form::text('financial['.$counter.'][total_debt]', $bl_details[$counter]['total_debt'],array('class'=>'readonly-text'))
                                            !!} @else {!!Form::text('financial['.$counter.'][total_debt]',null, array('class'
                                            => 'readonly-text')) !!} @endif
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="padding: 3px;">
                                            {!! Form::label('TermDebt', 'Term Debt: ') !!}
                                          </td>
                                          <td>
                                            @if(isset($bl_details[$counter])) {!! Form::text('financial['.$counter.'][term_debt]', $bl_details[$counter]['term_debt'],array('class'
                                              => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][term_debt]',
                                              null, array('class' => 'readonly-text')) !!} @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding: 3px;">
                                              {!! Form::label('Debtors', 'Debtors: ') !!}
                                            </td>
                                            <td>
                                              @if(isset($bl_details[$counter])) {!! Form::text('financial['.$counter.'][debtors]', $bl_details[$counter]['debtors'], array('class'
                                                => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][debtors]',
                                                null, array('class' => 'readonly-text')) !!} @endif
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="padding: 3px;">
                                                {!! Form::label('Inventory', 'Inventory: ') !!}
                                              </td>
                                              <td>
                                                @if(isset($bl_details[$counter])) {!! Form::text('financial['.$counter.'][inventory]', $bl_details[$counter]['inventory'],array('class'
                                                  => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][inventory]',
                                                  null, array('class' => 'readonly-text')) !!} @endif
                                                </td>
                                              </tr>
                                              <tr>
                                                <td style="padding: 3px;">
                                                  {!! Form::label('Creditors', 'Creditors: ') !!}
                                                </td>
                                                <td>
                                                  @if(isset($bl_details[$counter])) {!! Form::text('financial['.$counter.'][creditors]', $bl_details[$counter]['creditors'],array('class'
                                                    => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][creditors]',
                                                    null, array('class' => 'readonly-text')) !!} @endif
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td style="padding: 3px;">
                                                    {!! Form::label('NetFixedAssets', 'Net Fixed Assets: ') !!}
                                                  </td>
                                                  <td>
                                                    @if(isset($bl_details[$counter])) {!! Form::text('financial['.$counter.'][net_fixed_assets]', $bl_details[$counter]['net_fixed_assets'],
                                                      array('class' => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][net_fixed_assets]',
                                                      null, array('class' => 'readonly-text')) !!} @endif
                                                    </td>
                                                  </tr>
                                                </table>
                                    {{--</td>--}} {{--
                                </tr>--}} {{--
                              </table>--}} {{--
                            </td>--}} {{--
                          </tr>--}} {{--
                        </table>--}}
                      </div>
                    </div>
                  </div>
                  <?php $counter++;?> @endforeach
                </div>
              </div>
              <br> {{--========Start Financial DivSub 2==========================================================================--}}
              <div class="col-md-9">
                <p class="user_name" style="margin-left: 30%;margin-top: 20px; margin-bottom: 20px;">Financials - Profit & Loss Details </p>
              </div>
              <div class="row" id="divTab_sub2">
                <div class="col-md-12">
                  <?php $counter = 0;?> @foreach($bl_year as $blyear)
                  <div class="col-lg-1" style="width: 33%;float: left;">
                    <div class="panel panel-success" style="width: 100%;border-color: #ccc;border-right-width: 2px;">
                      <!-- Default panel contents -->
                      <div class="panel-heading" name={{$blyear}}>{{$blyear}}<span>&nbsp;( <span
                        class="fa fa-inr">&nbsp; </span>Lacs )
                      </span>
                    </div>
                    <div class="panel-body" style="">
                      <table cellpadding="3" cellspacing="3" style="margin-bottom: 0px;">
                          {{--
                          <tr>--}} {{--
                            <td style="padding: 2px;">--}} {{--
                              <table style="margin-bottom: 0px;">--}} {{--
                                <tr>--}} {{--
                                  <td>--}} {{--
                                    <table>--}}
                                      <tr>
                                        <td style="padding: 3px;">
                                          {!! Form::label('Revenue', 'Revenue: ') !!}
                                        </td>
                                        <td>
                                          @if(isset($pl_details[$counter])) {!! Form::text('financial['.$counter.'][revenue]', $pl_details[$counter]['revenue'], array('class'
                                            => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][revenue]',
                                            null, array('class' => 'readonly-text')) !!} @endif
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="padding: 3px;">
                                            {!! Form::label('OperatingProfit', 'EBITDA/Operating Profit: ') !!}
                                          </td>
                                          <td>
                                            @if(isset($pl_details[$counter])) {!! Form::text('financial['.$counter.'][ebitda_profit]', $pl_details[$counter]['ebitda_profit'],array('class'
                                              => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][ebitda_profit]',
                                              null, array('class' => 'readonly-text')) !!} @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding: 3px;">
                                              {!! Form::label('InterestExpense', 'Interest Expense: ') !!}
                                            </td>
                                            <td>
                                              @if(isset($pl_details[$counter])) {!! Form::text('financial['.$counter.'][interest_expense]', $pl_details[$counter]['interest_expense'],
                                                array('class' => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][interest_expense]',
                                                null, array('class' => 'readonly-text')) !!} @endif
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="padding: 3px;">
                                                {!! Form::label('PAT', 'PAT: ') !!}
                                              </td>
                                              <td>
                                                @if(isset($pl_details[$counter])) {!! Form::text('financial['.$counter.'][pat]', $pl_details[$counter]['pat'], array('class'
                                                  => 'readonly-text')) !!} @else {!! Form::text('financial['.$counter.'][pat]', null,
                                                  array('class' => 'readonly-text')) !!} @endif
                                                </td>
                                              </tr>
                                            </table>
                                    {{--</td>--}} {{--
                                </tr>--}} {{--
                              </table>--}} {{--
                            </td>--}} {{--
                          </tr>--}} {{--
                        </table>--}}
                      </div>
                      <!-- Table -->
                    </div>
                  </div>
                  <?php $counter++;?> @endforeach
                </div>
              </div>
              <br> {{--========Start Financial DivSub 3==========================================================================--}}
              {!! Form::model($loan) !!} {{--
              <div style="page-break-after: always;">--}} @for($formIndex=1; $formIndex
                <=$countLoanDetails; $formIndex++) <div class="col-md-12">
                  @if($formIndex == 2)
                  <div class="panel panel-success" style="width:100%;border-color: #333;page-break-after: always;">
                    @else
                    <div class="panel panel-success" style="width:100%;border-color: #333;">
                      @endif
                      <div class="panel-heading">Existing Loan Details - {{$formIndex}}</div>
                      {{--
                        <div class="panel-body">--}}
                          <table class="table table-bordered">
                            <tr>
                              <td>
                                <div class="col-md-4">
                                  <div style="margin-left: auto;">
                                    {!! Form::label('bankname','Bank Name: ') !!} @if(isset($existingloan_details[$formIndex-1])) {!! Form::text('bankname',
                                    $existingloan_details[$formIndex-1]['name'],array('class' => 'readonly-text')) !!} @else
                                    {!! Form::text('bankname', null, array('class' => 'readonly-text')) !!} @endif
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="col-md-4">
                                  <div style="margin-left: auto;">
                                    {!! Form::label('typeofloan','Type of Loan: ',['style' =>'width: 130%;']) !!} @if(isset($existingloan_details[$formIndex-1]))
                                    {!! Form::text('loantype', $existingloan_details[$formIndex-1]['loan_type'], array('class'
                                      => 'readonly-text')) !!} @else {!! Form::text('loantype', null, array('class' => 'readonly-text'))
                                      !!} @endif
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="col-md-4">
                                    <div style="margin-right: 15px;">
                                      {!! Form::label('', 'Outstanding Amount: ') !!} @if(isset($existingloan_details[$formIndex-1])) {!! Form::text('outstanding_amount',
                                        $existingloan_details[$formIndex-1]['amount_outstanding'], array('class' => 'readonly-text'))
                                      !!} @else {!! Form::text('outstanding_amount', null, array('class' => 'readonly-text'))
                                      !!} @endif
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="col-md-4">
                                    <div style="margin-left: auto;">
                                      {!! Form::label('monthlyemi_amount', 'Monthly EMI Amount: ' ) !!} @if(isset($existingloan_details[$formIndex-1])) {!! Form::text('monthlyemi_amount',
                                        $existingloan_details[$formIndex-1]['amount_monthlyemi'], array('class' => 'readonly-text'))
                                      !!} @else {!! Form::text('monthlyemi_amount', null, array('class' => 'readonly-text'))
                                      !!} @endif
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="col-md-4">
                                    <div style="margin-left: -10px;">
                                      {!! Form::label('', 'Balance Tenure: ') !!} @if(isset($existingloan_details[$formIndex-1])) {!! Form::text('balance_tenure',
                                        $existingloan_details[$formIndex-1]['balance_tenure'], array('class' => 'readonly-text'))
                                        !!} @else {!! Form::text('balance_tenure', null, array('class' => 'readonly-text')) !!}
                                        @endif
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-md-4">
                                      <div style="margin-right: 15px;">
                                        {!! Form::label('securityprovided','Security Provided: ') !!} @if(isset($existingloan_details[$formIndex-1])) {!! Form::text('securityprovided',
                                          $existingloan_details[$formIndex-1]['security_provided'], array('class' => 'readonly-text'))
                                          !!} @else {!! Form::text('securityprovided', null, array('class' => 'readonly-text')) !!}
                                          @endif
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              {{--</div>--}}
                            </div>
                          </div>
                  @endfor {{--
              </div>--}} @if(isset($loan->fin_numofexistingloan) && $loan->fin_numofexistingloan == 4) {{--
              <div class="col-md-12">--}} {{--
                <div class="panel panel-success" style="width:100%;border-color: #333;">--}} {{--
                  <div class="panel-heading">Other Loan Details</div>--}} {{--
                  <div class="panel-body">--}} {{--
                    <table class="table table-bordered" width="100%">--}} {{--
                      <tr>--}} {{--
                        <td>--}}
                          <div class="col-md-12">
                            <div id="existingLoanDetails_4" class="panel panel-success" style="width:100%;border-color: #333;">
                              <div class="panel-heading">Other Loan Details</div>
                              <table>
                                <tr>
                                  <td>
                                    <div class="col-sm-8 col-lg-6">
                                      <div class="form-group">
                                        {!! Form::label('','Outstanding Amount', ['class'=>'col-md-6 form-label']) !!}
                                        <div class="col-lg-12">
                                          {!! Form::text('other_outstandingamount', null, ['class' => 'readonly-text', 'id'=>'other_outstandingamount', 'placeholder'=>'Outstanding
                                          Amount ( In Lacs )',$setDisable]) !!}
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-sm-8 col-lg-6">
                                      <div class="form-group">
                                        {!! Form::label('','Total Monthly EMI', ['class'=>'form-label', 'style' => ' margin-left: 15px;']) !!}
                                        <div class="col-lg-12">
                                          {!! Form::text('other_totalmonthlyemi', null, ['class' => 'readonly-text', 'id'=>'other_totalmonthlyemi', 'placeholder'=>'Total
                                          Monthly EMI ( In Lacs )',$setDisable]) !!}
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            {{--</td>--}} {{--
                      </tr>--}} {{--
                    </table>--}} {{--
                    </div>--}} {{--
                  </div>--}} {{--
                </div>--}}
              </div>
              @endif {{--======Start Of Security Details Tab.=======================================================================--}}
              {{-- Share Start --}}
              <?php if ($companySharePledged != '') { ?>
              <br> {!! Form::model($LoanAgainstShare) !!}
              <div class="col-md-7" style="margin-left: 32%;">
                <p class="user_name">Loan Against Share Details</p>
              </div>
              <div class="col-md-12">
                <div class="panel panel-success" style="width: 100%;border-color: #333;">
                  <div class="panel-heading">Loan Against Share Details</div>
                  <div class="table-responsive" style="padding: 0px 0px 0px 0px;">
                    <table class="table table-bordered">
                      <div class="row" id="divTab_sub2">
                        <tr>
                          <td>
                            <div style="margin-left: 10px;">
                              {!! Form::label('dailyVolume', 'Daily Volume: ') !!} {!! Form::text('dailyVolume', null, ['class' => 'readonly-text'])!!}
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div style="margin-left: 10px;">
                              {!! Form::label('pramoterHolding','Pramoter Holding: ') !!} {!! Form::text('pramoterHolding', null, ['class' => 'readonly-text'])
                              !!}
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div style="margin-left: 10px;">
                              {!! Form::label('Percentage of Promoter holding pledges Current Quarter (in %)','Percentage of Promoter holding pledges Current
                                Quarter (in %): ') !!} {!! Form::text('currentQuarter', null, ['class' => 'readonly-text'])
                                !!}
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div style="margin-left: 10px;">
                                {!! Form::label('Percentage of Promoter holding pledges Previous Quarter (in %)','Percentage of Promoter holding pledges
                                  Previous Quarter (in %): ') !!} {!! Form::text('previousQuarter', null, ['class' => 'readonly-text'])
                                  !!}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div style="margin-left: 10px;">
                                  {!! Form::label('lowPrice','52 Week low Price ( Rs )') !!} {!! Form::text('lowPrice', null, ['class' => 'readonly-text'])
                                  !!}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div style="margin-left: 10px;">
                                  {!! Form::label('highPrice','52 Week high Price( Rs ) : ') !!} {!! Form::text('highPrice', null, ['class' => 'readonly-text'])
                                  !!}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div style="margin-left: 10px;">
                                  {!! Form::label('ratingAgencies','Rating Agencies') !!} {!! Form::text('ratingAgencies', null, ['class' => 'readonly-text'])
                                  !!}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div style="margin-left: 10px;">
                                  {!! Form::label('creditRatingof','Credit Rating of') !!} {!! Form::text('creditRatingof', null, ['class' => 'readonly-text'])
                                  !!}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div style="margin-left: 10px;">
                                  {!! Form::label('marketCapitalisation','Market Capitalisation') !!} {!! Form::text('marketCapitalisation', null, ['class'
                                  => 'readonly-text']) !!}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div style="margin-left: 10px;">
                                  {!! Form::label('lastOneMonthPrice','Last One Month Price') !!} {!! Form::text('lastOneMonthPrice', null, ['class' => 'readonly-text'])
                                  !!}
                                </div>
                              </td>
                            </tr>
                          </div>
                          {!! Form::close() !!}
                        </table>
                      </div>
                    </div>
                  </div>
                  <?php }?> {{-- share End --}} {{-- Security If Collatral Property Provided --}}
                  <?php
                  $getSecurityDetail = $loan->getSecurityDetails()->get()->first();
                  $getBuyerDetail = $loan->getBuyerDetails()->get();
                  ?>
                  @if($companySharePledged==null) {!! Form::model($getSecurityDetail) !!}
                  <div class="col-md-7">
                    <p class="user_name" style="margin-left: 40%;margin-top: 20px; margin-bottom: 20px;">
                    Security Details </p>
                  </div>
                  {{--<br>--}}
                  <table>
                    <tr>
                      <td>
                        @if($deletedQuestionHelper->isQuestionValid("E1"))
                        <div class="col-md-8" style="margin-left: 10px;">
                          {!! Form::label('is_collateral_property','Collateral Property: ') !!} @if($isCollateralProperty == 1) {!! Form::text('is_collateral_property',
                            'Yes', array('class' => 'readonly-text')) !!} @elseif($isCollateralProperty == 0) {!! Form::text('is_collateral_property',
                            'No', array('class' => 'readonly-text')) !!} @elseif($isCollateralProperty == null || $isCollateralProperty
                              == "") {!! Form::text('is_collateral_property', 'No', array('class' => 'readonly-text')) !!} @else
                              {!! Form::text('is_collateral_property', 'No', array('class' => 'readonly-text')) !!} @endif
                            </div>
                            @endif
                          </td>
                          <td>
                            @if($deletedQuestionHelper->isQuestionValid("E2"))
                            <div class="col-md-4" style="margin-left: 10px;">
                              {!! Form::label('othersecurity_type1','Other Security: ') !!} {!!Form::text('othersecurity_type', isset($business_object->othersecurity_type)
                                ? $business_object->othersecurity_type : null, ['id' => 'othersecurity_type','class'=>'readonly-text']
                                )!!}
                              </div>
                              @endif
                            </td>
                          </tr>
                        </table>
                        <br>
                        <div class="row" style="margin-left: auto;">
                          <!-- start E1 -->
                          @if($deletedQuestionHelper->isQuestionValid("E1"))
                          <div class="col-md-12">
                            <div class="panel panel-success" style="width:100%;border-color: #333;">
                              <div class="panel-heading">Type Of Security Offered - Collateral property
                              </div>
                              <table class="table table-bordered table-hover">
                                <tr>
                                  <td width="40%">
                                    <div class="col-md-6">
                                      {!! Form::label('collateral_type','Type of collateral offered: ',['style' =>'width: 130%;']) !!} {!! Form::text('collateral_type',
                                      null, ['class' =>'readonly-text']) !!}
                                    </div>
                                  </td>
                                  <td width="30%">
                                    <div class="col-md-3">
                                      {!! Form::label('city','City: ') !!} {!! Form::text('city', null, ['class' =>'readonly-text']) !!}
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="20%">
                                    <div class="col-md-3">
                                      {!! Form::label('propertyLand','Pin Code: ') !!} {!! Form::text('propertyLand', null, ['class' =>'readonly-text']) !!}
                                    </div>
                                  </td>
                                  <td width="40%">
                                    <div class="col-md-4">
                                      {!! Form::label('owner','Owner: ') !!} {!! Form::text('owner', null, ['class' =>'readonly-text']) !!}
                                    </div>
                                  </td>
                                  <td width="20%">
                                    <div class="col-md-2">
                                      {!! Form::label('latest_valuation','Latest Valuation: ') !!} {!! Form::text('latest_valuation', isset($business_object->latest_valuation)?
                                      $business_object->latest_valuation : null, ['class' => 'readonly-text'] )!!}
                                    </div>
                                  </td>
                                  <td width="20%">
                                    <div class="col-md-3">
                                      {!! Form::label('occupied_type','Property Land is ') !!} {!! Form::text('propertyIs', null, ['class' => 'readonly-text'])
                                      !!}
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                @endif @if($deletedQuestionHelper->isQuestionValid("E3")) {{--
                <div class="row" style="margin-left: auto;">
                  <div class="col-md-12">
                    <div class="panel panel-success" style="width:100%;border-color: #333;">
                      <div class="panel-heading">Details of Equipment being Purchased
                      </div>
                      <table class="table table-bordered table-hover">
                        <tr>
                          <td>
                            {!! Form::label('occupied_type','Type of Equipment: ',['style' =>'width: 130%;']) !!} {!! Form::text('equipment_type', null,
                            ['id' => 'type_of_equipment','class' =>'readonly-text']) !!}
                          </td>
                          <td>
                            {!! Form::label('occupied_type','Brief Description: ',['style' =>'width: 130%;']) !!} {!!Form::text('description', isset($business_object->description)
                            ? $business_object->description : null, ['class'=>'readonly-text','size' => '45x3','style' =>
                            'border: none; outline:none;'] )!!}
                          </td>
                        </tr>
                        <tr style="border-bottom: 1pt solid #ddd;">
                          <td>
                            {!! Form::label('occupied_type','Sourced: ') !!}<br> {!! Form::text('sourced_type', null, ['id'
                            => 'sourced_type','class' =>'readonly-text']) !!}
                          </td>
                          @if($equipmentType = 'Medical Equipment' || $equipmentType = 'Construction/Excavation Equipment' || $equipmentType = 'Transportation
                          Vehicles')
                          <td>
                            {!! Form::label('occupied_type','Name of Manufacturer: ',['style' =>'width: 130%;']) !!} {!!Form::text('manufacturer_name_mandatory',
                            null, ['class'=>'readonly-text'] )!!}
                          </td>
                          <td>
                            {!! Form::label('occupied_type','Year of Manufacture: ',['style' =>'width: 130%;']) !!} {!!Form::text('manufacture_year_mandatory',
                            null, ['class'=>'readonly-text'] )!!}
                          </td>
                          @else
                          <td>
                            {!! Form::label('occupied_type','Name of Manufacturer: ',['style' =>'width: 130%;']) !!} {!!Form::text('manufacturer_name',
                            null, ['class'=>'readonly-text'] )!!}
                          </td>
                          <td>
                            {!! Form::label('occupied_type','Year of Manufacture: ',['style' =>'width: 130%;']) !!} {!!Form::text('manufacture_year',
                            null, ['class'=>'readonly-text'] )!!}
                          </td>
                          @endif
                        </tr>
                      </table>
                      @if(isset($sourcedType) && $sourcedType == 'owned')
                      <table id="equipment_sourced_imported">
                        <tr>
                          <th margin-left="10px;">Invoice CIF Value (<span class="fa fa-inr"></span> in Lacs)
                          </th>
                          <th margin-left="10px;">Custom and Other Duty (<span class="fa fa-inr"></span> in Lacs)
                          </th>
                          <th margin-left="10px;">Invoice CIF Value (USD in thousands)
                          </th>
                        </tr>
                        <tr style="border-bottom: 1pt solid #ddd;">
                          <td margin-left="10px;">
                            {!!Form::text('invoice_cif_in_lacs', null, ['class'=>'readonly-text'] )!!}
                          </td>
                          <td margin-left="10px;">{!!Form::text('custom_duty', null, ['class'=>'readonly-text'] )!!}
                          </td>
                          <td margin-left="10px;">
                            {!!Form::text('invoice_cif_in_usd', null, ['class'=>'readonly-text'] )!!}
                          </td>
                        </tr>
                      </table>
                      @else
                      <table id="equipment_sourced_domestically_sourced">
                        <tr>
                          <th>
                            <span style="margin-left:10px;">Invoice Value</span> (
                            <span class="fa fa-inr"></span> in Lacs)
                          </th>
                        </tr>
                        <tr style="border-bottom: 1pt solid #ddd;">
                          <td>{!!Form::text('invoice_value', isset($business_object->invoice_value) ? $business_object->invoice_value
                            : null, ['class'=>'readonly-text','style' => 'margin-left:10px;'] )!!}
                          </td>
                        </tr>
                      </table>
                      @endif
                    </div>
                  </div>
                </div> --}} @endif {!! Form::close() !!}
                <!-- end E3 -->
                <!-- start E4 -->
                @if($deletedQuestionHelper->isQuestionValid("E4")) @if($isHideShowReceivableDiscount != false)
                <div class="row" style="margin-left:0px">
                  <!-- outer for start -->
                  @for($formIndexRec=0; $formIndexRec
                    < $maxReceivableDiscount; $formIndexRec++) <?php $colorstyle="" ; $buyerNameAttrName='buyer_name_' . $formIndexRec; $buyerNameAttrValue=null;
                  $avgMonthlySaleAttrName='avg_monthly_sale_' . $formIndexRec; $avgMonthlySaleAttrValue=null; $collapsedReceivables="collapse"
                  ; $receivablesPanelHeading="Details of Receivable Discounted" ; if ($formIndexRec==0 ) { $collapsedReceivables=""
                  ; $receivablesPanelHeading="Details of Receivable Discounted" ; } else { $collapsedReceivables="collapse"
                  ; if (isset($buyerNameAttrValue) && !empty($buyerNameAttrValue)) { $receivablesPanelHeading="Additional Details of Receivable Discounted - "
                  . $formIndexRec; } } if (isset($buyer_details[$formIndexRec])) { $buyerNameAttrValue=$buyer_details[$formIndexRec][
                    'buyer_name']; $avgMonthlySaleAttrValue=$buyer_details[$formIndexRec][ 'avg_monthly_sale']; $collapsedReceivables=""
                    ; $receivable_count=$formIndexRec; } ?>
                    @if($formIndexRec == 0 || $formIndexRec == 2 || $formIndexRec == 4 )
                    <?php $colorstyle = "style='padding:10px; background: cornsilk;'";?> @else
                    <?php $colorstyle = "style='padding:10px; background: #adadad;'";?> @endif @if($formIndexRec == 0)
                    <div class="col-md-12">
                      @endif
                      <div id="receivable_{{$formIndexRec}}" class="panel panel-success {{$collapsedReceivables}}" style='page-break-after: always;width:100%;border-color: #333;'>
                        <div class="panel-heading">{{$receivablesPanelHeading}}</div>
                        <table class="table table-bordered table-hover">
                          <tr style="border-bottom: 1px solid #ddd;">
                            <td>
                              <div class="col-md-5">
                                {!! Form::label('buyer_name','Name Of Buyer:',['style' =>'width: 130%;']) !!} {!! Form::text($buyerNameAttrName, $buyerNameAttrValue,
                                  ['class'=>'readonly-text'] )!!}
                                </div>
                              </td>
                              <td>
                                <div class="col-md-7">
                                  {!! Form::label('avg_monthly_sale','Average Monthly sales details for last 3 months:',['style' =>'width: 130%;']) !!} {!!
                                    Form::text($avgMonthlySaleAttrName,$avgMonthlySaleAttrValue, ['class'=>'readonly-text'] )!!}
                                  </div>
                                </td>
                              </tr>
                            </table>
                            <div id="clearfix" style="padding: 5px;">
                              <!-- inner for start -->
                              @for($formIndex=0; $formIndex
                                < $maxPaymentTerms; $formIndex++) <?php $invoiceDateAttrName='invoice_date_' . $formIndexRec . '_' . $formIndex; $invoiceDateAttrValue=null;
                              $invoiceAmountAttrName='amount_' . $formIndexRec . '_' . $formIndex; $invoiceAmountAttrValue=null;
                              $invoiceTermsAttrName='payment_terms_' . $formIndexRec . '_' . $formIndex; $invoiceTermsAttrValue=null;
                              $collapsedInvoices="collapse" ; if ($formIndex==0 ) { $collapsedInvoices="" ; $invoicesPanelHeading="Invoice Details"
                              ; } else { $collapsedInvoices="collapse" ; if (isset($avgMonthlySaleAttrValue) && !empty($avgMonthlySaleAttrValue))
                              { $invoicesPanelHeading="Invoice Details - " . $formIndex; } } if (isset($buyer_details[$formIndexRec])
                                && $buyer_details[$formIndexRec][ 'amount_' . ($formIndex + 1)]> 0) { $invoiceDateAttrValue = $buyer_details[$formIndexRec]['invoice_date_' . ($formIndex + 1)];
                              $invoiceAmountAttrValue = $buyer_details[$formIndexRec]['amount_' . ($formIndex + 1)]; $invoiceTermsAttrValue
                              = $buyer_details[$formIndexRec]['payment_terms_' . ($formIndex + 1)]; $collapsedInvoices = "";
                              if ($formIndexRec == 0) { $receivables0InvoiceCounter = $formIndex; } elseif ($formIndexRec ==
                                1) { $receivables1InvoiceCounter = $formIndex; } elseif ($formIndexRec == 2) { $receivables2InvoiceCounter
                                = $formIndex; } } $colorstyle = ""; ?> @if($formIndex == 0 || $formIndex == 2 || $formIndex ==
                                  4 )
                                  <?php $colorstyle = "style='padding:10px; background: cornsilk;'";?> @else
                                  <?php $colorstyle = "style='padding:10px; background: #adadad;'";?> @endif
                                  <div class="panel panel-success {{$collapsedInvoices}}" id="by_{{$formIndexRec}}_payment_terms_{{$formIndex}} " style="border-color: #333;">
                                    <div class="panel-heading">{{$invoicesPanelHeading}}</div>
                                    <table class="table table-bordered table-hover">
                                      <tr>
                                        <td>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              {!! Form::label('date_of_invoice','Date of Invoice',['style' =>'width: 130%;']) !!}
                                              <div class="col-md-12">
                                                {!! Form::text($invoiceDateAttrName, $invoiceDateAttrValue,['class' => 'readonly-text']) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              {!! Form::label('invoice_amount','Amount', ['class'=>'control-label', 'style' => ' margin-left: 15px;']) !!}
                                              <div class="col-md-12">
                                                {!! Form::text($invoiceAmountAttrName,$invoiceAmountAttrValue,['class' => 'readonly-text']) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              {!! Form::label('payment_terms','Payment Terms', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                              <div class="col-md-12">
                                                {!! Form::text($invoiceTermsAttrName, $invoiceTermsAttrValue, ['class' => 'readonly-text']) !!}
                                              </div>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                  @endfor
                                  <!-- inner for end -->
                                </div>
                                <!-- End of clearfix div -->
                              </div>
                              @endfor
                              <!-- outer for end -->
                            </div>
                            @endif
                          </div>
                          @endif @endif {{--======Start Of Input Balance sheet Tab.=======================================================================--}}
                          @if(Auth::user()->isAnalyst() || Auth::user()->isAdmin() || Auth::user()->isBankUser()) @if(isset($financialDataRecordsID)
                          && $financialDataRecordsID != null)
                          <div class="col-md-7" style="  margin-left: 35%; margin-top: 25px;  margin-bottom: 20px;">
                            <p class="user_name">Input Balance Sheet</p>
                          </div><br> {!! Form::model($financialDataRecords) !!}
                          <?php $counter = 0;?>
                          <table width="33%;" style="page-break-after: always;">
                            <tr>
                              <td colspan="2"></td>
                            </tr>
                            <tr>
                              @foreach($bl_year as $blyear)
                              <?php
                              $financialDataExpression = null;
                              if ($financialDataExpressionsMap->offsetExists($blyear)) {
                                $financialDataExpression = $financialDataExpressionsMap->offsetGet($blyear);
                              }
                              $financialDataRecord = null;
                              if ($financialDataMap->offsetExists($blyear)) {
                                $financialDataRecord = $financialDataMap->offsetGet($blyear);
                              }
                              $showTextFieldsForFormula = false;
                              if (isset($showFormulaText) && $showFormulaText) {
                                $showTextFieldsForFormula = true;
                              }
                              ?>
                              <td align="center">&nbsp;</td>
                              <td align="center">
                                {!! $blyear !!} <small>(Rs. Lacs) </small>
                                <table border="1" style="margin-bottom: 0px; width : 33%;margin:0;float: left;page-break-after: always;">
                                  <tr>
                                    <td valign="top" style="  font-size: 12px;">
                                      <table class="table table-bordered table-hover">
                                        @foreach($financialGroups as $group)
                                        <tr>
                                          @if(!$group->header)
                                          <td>
                                            <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                                          </td>
                                          <td style="padding:5px;"><b>Amount  </b></td>
                                          @else
                                          <td colspan="2" align="center">
                                            <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                                          </td>
                                          @endif
                                        </tr>
                                        @foreach($group->financialEntries as $entry) @if(isset($financialDataRecord)) {!! Form::hidden('financial['.$counter.'][id]',$financialDataRecord->id)!!}
                                        {!! Form::hidden('financial['.$counter.'][loan_id]', $financialDataRecord->loan_id)!!} {!!
                                          Form::hidden('financial['.$counter.'][period]',$financialDataRecord->period)!!} @else {!!Form::hidden('financial['.$counter.'][loan_id]',$loanId)!!}
                                          {!! Form::hidden('financial['.$counter.'][period]',$blyear)!!} @endif
                                          <tr>
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
                                              {!! Form::label($entry->attribute,$entry->entry,['style' => 'width:110px;']) !!}
                                              <!-- <sup><a href="#" data-toggle="tooltip" data-placement="top" title="{{$tooltipText}}">?</a></sup> -->
                                            </td>
                                            <td style="padding:5px;">
                                              @if(!$entry->hasFormula() || $showTextFieldsForFormula) {!! Form::text('financial['.$counter.']['.$entry->attribute.']',$expressionValue,
                                                array('id'=>'financial_'.$counter.'_'.$entry->attribute.'', 'class'=>'readonly-text','onKeyDown'=>'limitText(this);','onKeyUp'=>'limitText(this);',
                                                'style' => 'width: 140px;')) !!} {{--'onKeyDown'=>'numericValidation(this.value)')--}}
                                              @else {!! Form::label($entry->attribute, $expressionValue, array('id' =>'financial_'.$counter.'_'.$entry->attribute.'_label'))
                                              !!} {!! Form::hidden('financial['.$counter.']['.$entry->attribute.']', $expressionValue,
                                              ['id' =>'financial_'.$counter.'_'.$entry->attribute.''])!!} @endif
                                            </td>
                                          </tr>
                                          @endforeach @endforeach
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <?php $counter++;?> @endforeach
                              </tr>
                            </table>
                            {!! Form::close() !!} @else @endif {{--======Start Of Input P & L Tab.=======================================================================--}}
                            @if(isset($financialDataRecordsPLID) && $financialDataRecordsPLID != null)
                            <div class="col-md-7" style="  margin-left: 35%; margin-top: 25px;  margin-bottom: 20px;">
                              <p class="user_name">Profit & Loss Statement</p>
                            </div><br> {!! Form::model($financialDataRecordsPL) !!}
                            <?php $counter = 0;?>
                            <table width="33%;" style='page-break-after: always;'>
                              <tr>
                                <td colspan="3"></td>
                              </tr>
                              <tr>
                                @foreach($bl_year as $blyear)
                                <?php
                                $financialDataExpression = null;
                                if ($financialDataExpressionsMapPL->offsetExists($blyear)) {
                                  $financialDataExpression = $financialDataExpressionsMapPL->offsetGet($blyear);
                                }
                                $financialDataRecord = null;
                                if ($financialDataMapPL->offsetExists($blyear)) {
                                  $financialDataRecord = $financialDataMapPL->offsetGet($blyear);
                                }
                                $showTextFieldsForFormula = false;
                                if (isset($showFormulaText) && $showFormulaText) {
                                  $showTextFieldsForFormula = true;
                                }
                                ?>
                                <td align="center">&nbsp;</td>
                                <td align="center">
                                  {!! $blyear !!} <small>(Rs. Lacs) </small>
                                  <table border="1" style="margin-bottom: 0px; width : 33%;margin:0;float: left;">
                                    <tr>
                                      <td valign="top" style="  font-size: 12px;">
                                        <table class="table table-bordered table-hover">
                                          @foreach($financialGroupsPL as $group)
                                          <tr>
                                            @if(!$group->header)
                                            <td>
                                              <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                                            </td>
                                            <td style="padding:5px;"><b>Amount  </b></td>
                                            @else
                                            <td colspan="2" align="center">
                                              <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                                            </td>
                                            @endif
                                          </tr>
                                          @foreach($group->financialEntries as $entry) @if(isset($financialDataRecord)) {!! Form::hidden('financial['.$counter.'][id]',
                                          $financialDataRecordsPL->id)!!} {!! Form::hidden('financial['.$counter.'][loan_id]',$financialDataRecordsPL->loan_id)!!}
                                          {!! Form::hidden('financial['.$counter.'][period]',$financialDataRecordsPL->period)!!} @else
                                          {!! Form::hidden('financial['.$counter.'][loan_id]', $loanId)!!} {!! Form::hidden('financial['.$counter.'][period]',
                                          $blyear)!!} @endif
                                          <tr>
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
                                              {!! Form::label($entry->attribute,$entry->entry,['style' => 'width:110px;']) !!}
                                              <!-- <sup><a href="#" data-toggle="tooltip" data-placement="top" title="{{$tooltipText}}">?</a></sup> -->
                                            </td>
                                            <td style="padding:5px;">
                                              @if(!$entry->hasFormula() || $showTextFieldsForFormula) {!! Form::text('financial['.$counter.']['.$entry->attribute.']',$expressionValue,array('id'=>'financial_'.$counter.'_'.$entry->attribute.'','class'=>'readonly-text','onKeyDown'=>'limitText(this);','onKeyUp'=>'limitText(this);','style'
                                              => 'width: 140px;')) !!} {{--'onKeyDown'=>'numericValidation(this.value)')--}} @else
                                              {!! Form::label($entry->attribute,$expressionValue,array('id'=>'financial_'.$counter.'_'.$entry->attribute.'_label'))
                                              !!} {!! Form::hidden('financial['.$counter.']['.$entry->attribute.']', $expressionValue,
                                              ['id'=>'financial_'.$counter.'_'.$entry->attribute.''])!!} @endif
                                            </td>
                                          </tr>
                                          @endforeach @endforeach
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <?php $counter++;?> @endforeach
                              </tr>
                            </table>
                            {!! Form::close() !!} @else @endif {{-- Cashflow start --}}
                            <div class="col-md-7" style="  margin-left: 35%; margin-top: 25px;  margin-bottom: 20px;">
                              <p class="user_name">Cashflow Statement</p>
                            </div><br>
                            <?php $counterCF = 0; ?>
                            <table width="100%;" style='page-break-after: always;'>
                              <tr>
                                <td colspan="3"></td>
                              </tr>
                              <tr>

                                @foreach($bl_year as $blyear)
                                <?php
                                $financialDataExpression = null;
                                $key_blyear = str_replace('(Provisional)', '', $blyear);
                                if ($financialDataExpressionsMapCF->offsetExists($key_blyear)) {
                                  $financialDataExpression = $financialDataExpressionsMapCF->offsetGet($key_blyear);
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
                                  {!! $blyear !!} <small>(Rs. Lacs) </small>
                                  <table border="1" style="margin-bottom: 0px; width : 100%;margin:0;float: left;">
                                    <tr>
                                      <td valign="top" colspan="1" style="  font-size: 12px;">
                                        <table class="table table-bordered table-hover">
                                          @foreach($financialGroupsCF as $group)
                                          <tr class="cf-group-header">
                                            @if(!$group->header)
                                            <td>
                                              <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                                            </td>
                                            <td style="padding:5px;"><b>Amount ( <span class="fa fa-inr">&nbsp; </span>Lacs ) </b></td>
                                            @else
                                            <td colspan="2" align="center">
                                              <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                                            </td>
                                            @endif
                                          </tr>
                                          @foreach($group->financialEntries as $entry) @if(isset($financialDataRecord)) {!! Form::hidden('financial['.$counterCF.'][id]',
                                          $financialDataRecord->id)!!} {!! Form::hidden('financial['.$counterCF.'][loan_id]', $financialDataRecord->loan_id)!!}
                                          {!! Form::hidden('financial['.$counterCF.'][period]', $financialDataRecord->period)!!} @else
                                          {!! Form::hidden('financial['.$counterCF.'][loan_id]', $loanId)!!} {!! Form::hidden('financial['.$counterCF.'][period]',
                                          str_replace('(Provisional)', '', $blyear))!!} @endif
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
                                              {!! Form::label($entry->attribute, $entry->entry,['style' => 'width:110px;']) !!}
                                              <!-- <sup><a href="#" data-toggle="tooltip" data-placement="top" title="{{$tooltipText}}">?</a></sup> -->
                                            </td>
                                            <td style="padding:5px;">
                                              {!! Form::label($entry->attribute, $expressionValue,array('id'=>'financial_'.$counterCF.'_'.$entry->attribute.'_label'))
                                              !!} {!! Form::hidden('financial['.$counterCF.']['.$entry->attribute.']',$expressionValue,
                                              ['id' =>'financial_'.$counterCF.'_'.$entry->attribute.''])!!}
                                            </td>
                                          </tr>
                                          @endforeach @endforeach
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <?php $counterCF++; ?> @endforeach

                              </tr>
                            </table>
                          </div>
                          {{-- Cashflow End --}} {{--======Start Of Calculated Ratios Tab.=======================================================================--}}
                          @if(isset($financialDataRecordsPLID) && $financialDataRecordsPLID != null)
                          <div class="col-md-7" style="  margin-left: 35%; margin-top: 25px;  margin-bottom: 20px;">
                            <p class="user_name">Calculated Ratios</p>
                          </div><br> {!! Form::model($financialDataRecordsPL) !!}
                          <?php
                          $counter = 0;
                          $isAnyThresholdBreached = false;
                          $isAnyExpressionInvalid = false;
                          ?>
                          <table width="33%" style="page-break-after: always;">
                            <tr>
                              <td colspan="3"></td>
                            </tr>
                            <tr>
                              @foreach($bl_year as $blyear)
                              <?php
                              $financialDataExpression = null;
                              if ($financialDataExpressionsMapCal->offsetExists($blyear)) {
                                $financialDataExpression = $financialDataExpressionsMapCal->offsetGet($blyear);
                              }
                              $financialDataRecord = null;
                              if ($financialDataMapCal->offsetExists($blyear)) {
                                $financialDataRecord = $financialDataMapCal->offsetGet($blyear);
                              }
                              $showTextFieldsForFormula = false;
                              if (isset($showFormulaText) && $showFormulaText) {
                                $showTextFieldsForFormula = true;
                              }
                              ?>
                              <td align="center">&nbsp;</td>
                              <td align="center">
                                {!! Form::label($blyear, $blyear) !!}
                                <table border="1" style="margin-bottom: 0px; width : 33%;margin:0;float: left;">
                                  <tr>
                                    <td valign="top" style="  font-size: 12px;">
                                      <table class="table table-bordered">
                                        <?php $entryNumCounter = 0;?> @foreach($financialGroupsCal as $group)
                                        <tr>
                                          <td colspan="2" align="center">
                                            <b>@if($group->visible == 1) {{{ $group->name }}} @else {{{''}}} @endif </b>
                                          </td>
                                        </tr>
                                        @foreach($group->financialEntries as $entry) {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][ratio_id]',
                                          $entry->id)!!} @if(isset($financialDataRecord)) {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][id]',
                                          $financialDataRecord->id)!!} {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][loan_id]',
                                          $financialDataRecord->loan_id)!!} {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][period]',
                                          $financialDataRecord->period)!!} @else {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][loan_id]',
                                          $loanId)!!} {!! Form::hidden('financial['.$counter.']['.$entryNumCounter.'][period]', $blyear)!!}
                                          @endif
                                          <?php
                                          $expressionValue = "";
                                          $isInvalidExpression = false;
                                          $isThresholdBreached = false;
                                          $tooltipText = "";
                                          if ($entry->hasFormula()) {
                                            $tooltipText = "Formula: " . $entry->formula_reference . " = " . $entry->formula;
                                          } else {
                                            $tooltipText = "Field: " . $entry->formula_reference;
                                          }
                                          if (isset($financialDataExpression) && $financialDataExpression->offsetExists($entry->formula_reference)) {
                                            $storedValue = $financialDataExpression->offsetGet($entry->formula_reference);
                                            if (isset($storedValue)) {
                                              $expressionValue = $storedValue->getValue();
                                              $isInvalidExpression = $storedValue->isInvalidExpression();
                                              if ($isInvalidExpression && $expressionValue == 0) {
                                                $expressionValue = " ";
                                              }
                                              if ($isInvalidExpression) {
                                                $isAnyExpressionInvalid = true;
                                              }
                                              if (!$isInvalidExpression && $storedValue->hasThreshold() && $storedValue->isThresholdBreached()) {
                                                $isThresholdBreached = true;
                                                $isAnyThresholdBreached = true;
                                              }
                                            } else {
                                              $expressionValue = " ";
                                              $isInvalidExpression = true;
                                              $isAnyExpressionInvalid = true;
                                            }
                                          } else {
                                            $expressionValue = " ";
                                            $isInvalidExpression = true;
                                            $isAnyExpressionInvalid = true;
                                          }
                                          ?>
                                          @if($isInvalidExpression)
                                          <tr class="ratio-warning">
                                            @else @if($isThresholdBreached)
                                            <tr class="ratio-danger">
                                              @else
                                              <tr>
                                                @endif @endif
                                                <td width="50%">
                                                  {!! Form::label($entry->attribute, $entry->entry,['style' => 'width: 110px;']) !!} @if($entry->percentage)
                                                  <span align="center">(%) </span> @endif
                                                </td>
                                                <td data-align="center" data-halign="center" align="center" valign="center">
                                                  {!! Form::label($entry->attribute, $expressionValue,['style' => 'width: 140px;']) !!}
                                                </td>
                                              </tr>
                                              <?php $entryNumCounter++;?> @endforeach @endforeach
                                            </table>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                    <?php $counter++;?> @endforeach
                                  </tr>
                                </table>
                                {!! Form::close() !!} @else @endif
                                <?php if ($bscNscCode =='') { ?>  
                                <div class="col-md-7" style="  margin-left: 35%; margin-top: 25px;  margin-bottom: 20px;">
                                  <p class="user_name">Liquidity Test Model</p>
                                </div><br>
                                <table class="table table-bordered">
                                  <tr>
                                    <td>
                                      {!! Form::label('Weightage',null, ['class'=>'control-label']) !!}
                                    </td>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::label('Name',null, ['class'=>'control-label']) !!}
                                      </div>
                                    </td>
                                    <td colspan="2" class="text-center">
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::label('Score',null, ['class'=>'control-label']) !!}
                                      </div>
                                    </td>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::label('Criteria Value (%)',null, ['class'=>'control-label']) !!}
                                      </div>
                                    </td>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::label('Effective Score',null, ['class'=>'control-label']) !!}
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::label('20%',null, ['class'=>'control-label','id'=>'calWeight1']) !!}
                                      </div>
                                    </td>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::label('closing cash balance at end of period (Closing Cash balance of laster Quarter/Month)',null, ['class'=>'control-label'])
                                        !!}
                                      </div>
                                    </td>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::label( @$cashCriteria->calculatedScore1 )!!}
                                      </div>
                                    </td>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::select('selectSources1', array('' => 'Select Source','100' => '>20% of Total Sources', '75' => '0% - 20% of Sources)','50'
                                          => '0% -15% of sources','0' => '
                                          <-15% of sources '), @$cashCriteria->selectSources1, ['disabled ']) !!}
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                          {!! Form::label( @$cashCriteria->lastCashBalance )!!}
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                         {!! Form::label( @$cashCriteria->effectivScore1 )!!}
                                       </div>
                                     </td>
                                   </tr>
                                   
                                   <tr>
                                    <td>
                                      <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                       {!! Form::label('20% ',null, ['class '=>'control-label ','id '=>'calWeight2 ']) !!}
                                     </div>
                                   </td>
                                   <td>
                                    <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                      {!! Form::label('closing cash balance v/s Capital Invested ',null, ['class '=>'control-label ']) !!}
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                      {!! Form::label(  @$cashCriteria->calculatedScore2) !!}
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                     {!! Form::select('selectSources2 ', array(' ' => 'Select Source ','100 ' => '>20% of promoter capital', '75' => '0% - 20% of promoter capital)','50' => '0% -15% of promoter capital','0'
                                      => '
                                      <-15% of promoter capital '), @$cashCriteria->selectSources2,[    'disabled ' ]) !!}
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                     {!! Form::label(@$cashCriteria->cashVSinvest )!!}
                                   </div>
                                 </td>
                                 <td>
                                  <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                    {!! Form::label( @$cashCriteria->effectivScore2  )!!}
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                
                                <tr>
                                  <td>
                                    <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                     {!! Form::label('30% ',null, ['class '=>'control-label ','id '=>'calWeight3 ']) !!}
                                   </div>
                                 </td>
                                 <td>
                                  <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                    {!! Form::label('Lowest closing balance as a % of capital invested ',null, ['class
                                    '=>'control-label ']) !!}
                                  </div>
                                </td>
                                <td>
                                  <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                   {!! Form::label( @$cashCriteria->calculatedScore3  )!!}
                                 </div>
                               </td>
                               <td>
                                <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                 {!! Form::select('selectSources3 ', array(' ' => 'Select Source ','100 ' => 'Positive
                                  ', '75 ' => '>- 10% -
                                  <0%of capital invested ','50 ' => '-10% - 25% of capital invested ','0 ' => '< -25% of capital invested
                                  '),@$cashCriteria->selectSources3,['disabled ']) !!}
                                </div>
                              </td>
                              <td>
                                <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                 {!! Form::label(  @$cashCriteria->lowstClosingBalance  )!!}
                               </div>
                             </td>
                             <td>
                              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                                {!! Form::label( @$cashCriteria->effectivScore3   )!!}
                              </div>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>
                              <div class="col-border col-md-12 col-sm-12 col-xs-12">
                               {!! Form::label('30% ',null, ['class '=>'control-label ','id '=>'calWeight4 ']) !!}
                             </div>
                           </td>
                           <td>
                            <div class="col-border col-md-12 col-sm-12 col-xs-12">
                              {!! Form::label('Trend of closing balance (Manual) ',null, ['class '=>'control-label ']) !!}
                            </div>
                          </td>
                          <td>
                            <div class="col-border col-md-12 col-sm-12 col-xs-12">
                              {!! Form::label( @$cashCriteria->calculatedScore4  )!!}
                            </div>
                          </td>
                          <td>
                            <div class="col-border col-md-12 col-sm-12 col-xs-12">
                             {!! Form::select('selectSources4 ', array(' ' => 'Select Source ','100 ' => 'Always +ve ', '75
                              ' => '+ve Majority of time ','50 ' => '-ve Majority of time ','0 ' => 'Always -ve
                              '),@$cashCriteria->selectSources4,['disabled ']) !!}
                            </div>
                          </td>
                          <td>
                            <div class="col-border col-md-12 col-sm-12 col-xs-12">
                              {!! Form::label(  @$cashCriteria->trendClosingBalance   )!!}
                            </div>
                          </td>
                          <td>
                            <div class="col-border col-md-12 col-sm-12 col-xs-12">
                              {!! Form::label(  @$cashCriteria->effectivScore4   )!!}
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" class="text-center">
                            {!! Form::label('Cash Flow Score ','Cash Flow Score ', ['class '=>'control-label ']) !!}
                          </td>
                          <td>
                            <div class="col-border col-md-12 col-sm-12 col-xs-12">
                              {!! Form::label( @$cashCriteria->cashFlowScore  )!!}
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" class="text-center">
                            {!! Form::label('Final Remark ','Cash Flow Score ', ['class '=>'control-label ']) !!}
                          </td>
                          <td colspan="3" class="text-center">
                            <div class="col-border col-md-12 col-sm-12 col-xs-12">
                              {!! Form::label(  @$cashCriteria->liquidityRemark  )!!}
                            </div>
                          </td>
                        </tr>
                      </table>
                      {{--======Start Of Credit Model Tab.=======================================================================--}}
                      @if(isset($financialDataRecordsPLID) && $financialDataRecordsPLID != null)
                      <div class="col-md-7"
                      style="  margin-left: 35%; margin-top: 25px;  margin-bottom: 20px;">
                      <p class="user_name">Credit Model</p>
                    </div><br>
                    {!! Form::model($financialDataRecordsPL) !!}
                    <?php
                    $categoryCounter = 1;
                    $dimensionCounter = 1;
                    ?>
                    <table style="width: 250px;margin-left: 23px;">
                      <tr>
                        <td>
                          {!! Form::label('borrower_name ','Borrower Name ') !!}
                        </td>
                        <td>
                          {!! Form::label('borrower_name ', isset($userProfile)?
                          $userProfile->name_of_firm : '&nbsp; ') !!}
                        </td>
                      </tr>
                    </table>
                    <table style="margin-left: 15px;">
                      <tr>
                        <td style="width: 280px;">
                        </td>
                        <td style="width: 80px;">
                          {!! Form::label('category_weight ','% Weight ', ['class '=>'control-label '])
                          !!}
                        </td>
                        <td style="width: 60px;">
                          {!! Form::label('points ','Points ', ['class '=>'control-label ']) !!}
                        </td>
                        <td style="width: 95px;">
                          {!! Form::label('applicable ','Applicable ', ['class '=>'control-label ']) !!}
                        </td>
                        <td style="width: 100px;">
                          {!! Form::label('measure_value ','Value/Factor ', ['class '=>'control-label '])
                          !!}
                        </td>
                        <td style="width: 100px;">
                          {!! Form::label('applicable_points ','Applicable Points ',['class '=>'control-label ']) !!}
                        </td>
                      </tr>
                    </table>
                    @foreach($analystModelsCategoriesList as $creditCategory)
                    {{--Category Row --}}
                    <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                      <tr>
                        <td style="width: 75px;">
                          {{$creditCategory->label}}
                        </td>
                        <td style="width: 115px;">
                          {{$creditCategory->weight}}
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                      </tr>
                    </table>
                    @foreach($creditCategory->dimensions as $creditDimension)
                    {{--Dimension Row --}}
                    <table style="padding-top:5px;margin-left: 15px;">
                      <?php
                      $categoryStyle = "";
                      if (!isset($creditDimension->parent_dimension_id) || $creditDimension->dimension_type == 2) {
                        $categoryStyle = "background-color:#BFBFBF;";
                        ?>
                        <tr>
                          <td style="width: 300px; {{$categoryStyle}}">
                            {!! Form::label('dimension_label ',$creditDimension->label,
                            ['class '=>'control-label ']) !!}
                          </td>
                          <td style="width: 65px; {{$categoryStyle}}">
                            {!! Form::label('dimension_weight ',$creditDimension->weight,
                            ['class '=>'control-label ']) !!}
                            {!!
                              Form::hidden('category[ '.$categoryCounter.'][dimension][weight] ',
                              $creditDimension->weight)!!}
                            </td>
                            <?php
                          } else {
                            ?>
                            <tr>
                              <td style="width: 300px; {{$categoryStyle}}">
                                {!! Form::label('dimension_label ',$creditDimension->label,
                                ['class '=>'control-label ']) !!}
                              </td>
                              <td style="width: 65px; {{$categoryStyle}}">
                                {!! Form::label('dimension_weight ',$creditDimension->weight,
                                ['class '=>'control-label ']) !!}
                                {!!
                                  Form::hidden('category[ '.$categoryCounter.'][dimension][weight] ',
                                  $creditDimension->weight)!!}
                                </td>
                                <?php
                              }
                              ?>
                              @if(!$creditDimension->isParent())
                              <td style="width: 70px;">
                                {!! Form::label('points ', ($creditCategory->weight *
                                  ($creditDimension->weight / 100)), ['class '=>'control-label '])
                                  !!}
                                </td>
                                @if($creditDimension->hasRatio() && isset($creditDimension->selected_measure_id))
                                <td style="width: 80px;">
                                  @if($creditDimension->is_applicable == 1)
                                  {!!Form::label('analyst_model_rating_details[ '.$dimensionCounter.'][is_applicable_label]
                                  ','Yes ', ['class ' => 'readonly-text ']) !!}
                                  @else
                                  {!! Form::label('analyst_model_rating_details[ '.$dimensionCounter.'][is_applicable_label]
                                  ','No ', ['class ' => 'readonly-text ']) !!}
                                  @endif
                                </td>
                                <td style="width: 115px;">
                                  <?php
                                  $valueArray = $creditDimension->measures->lists('label ', 'id ')->all();
                                  $selectedValue = $creditDimension->selected_measure_id;
                                  if (isset($selectedValue)) {
                                    $firstValueOfArray = array_pull($valueArray, $selectedValue);
                                  } else {
                                    $firstValueOfArray = current($valueArray);
                                  }
                                  ?>
                                  {!! Form::text('analyst_model_rating_details[ '.$dimensionCounter.'][measure_id_label]', $firstValueOfArray, ['id ' =>'measureValue_ '.$dimensionCounter, 'class ' =>'readonly-text ', 'style ' => 'width:
                                    145%; ']) !!}
                                  </td>
                                  @else
                                  <td style="width: 80px;">
                                    @if($creditDimension->is_applicable == 1)
                                    {!!Form::label('analyst_model_rating_details[ '.$dimensionCounter.'][is_applicable]
                                    ','Yes ', ['class ' => 'readonly-text ']) !!}
                                    @else
                                    {!! Form::label('analyst_model_rating_details[ '.$dimensionCounter.'][is_applicable]
                                    ', 'No ', ['class ' => 'readonly-text ']) !!}
                                    @endif
                                  </td>
                                  <td style="width: 115px;">
                                    <?php
                                    $valueArray = $creditDimension->measures->lists('label ', 'id ')->all();
                                    $selectedValue = $creditDimension->selected_measure_id;
                                    if (isset($selectedValue)) {
                                      $firstValueOfArray = array_pull($valueArray, $selectedValue);
                                    } else {
                                      $firstValueOfArray = current($valueArray);
                                    }
                                    ?>
                                    {!! Form::text('analyst_model_rating_details[ '.$dimensionCounter.'][measure_id]',$firstValueOfArray, ['id ' =>'measureValue_ '.$dimensionCounter, 'class ' => 'readonly-text ', 'style ' => 'width: 145%; ']) !!}
                                  </td>
                                  <td>
                                    <span id = "calculated_measure_{{$dimensionCounter}}" class = "form-control-static" style = "width: 100%;"></span>
                                    {!! Form::hidden('analyst_model_rating_details[ '.$dimensionCounter.'][calculated_measure]
                                    ', null, ['id ' => 'calculated_measure_field_ '.$dimensionCounter])!!}
                                  </td>
                                  @endif
                                  @endif
                                  <?php $dimensionCounter += 1;?>
                                  @endforeach
                                </tr>
                              </table>
                              <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                <tr>
                                  <td style="width: 75px;">
                                    {!! Form::label('category_label ','Total Score - ' .$creditCategory->label, ['class'=>'control-label ','style ' => 'width: 100% ']) !!}
                                  </td>
                                  <td style="width: 135px;">
                                    {!! Form::hidden('category[ '.$categoryCounter.'][category_weight] ', ' ', ['id' => 'category_weight_field_ '.$categoryCounter])!!}
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                </tr>
                              </table>
                              <?php $categoryCounter += 1;?>
                              @endforeach
                              <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                <tr>
                                  <td style="width: 75px;">
                                    {!! Form::label('grand_total_label ','Grand Total ', ['class '=>'control-label ','style
                                    ' => 'width: 100% ']) !!}
                                  </td>
                                  <td style="width: 115px;">
                                    {!! Form::hidden('grand_total_weight ', ' ', ['id ' => 'grand_total_weight_field '])!!}
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td colspan="3"><span>{{ $analystFinalScore->final_score }}</span>
                                  </td>
                                </tr>
                              </table>
                              <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                <tr>
                                  <td style="width: 75px;">
                                    {!! Form::label('final_rating_text_label ','Our Rating ',  ['class '=>'control-label ']) !!}
                                  </td>
                                  <td style="width: 115px;">
                                    {!! Form::hidden('final_rating',  isset($ratingModel)?$ratingModel->final_rating:null, ['id ' =>  'final_rating ']) !!}
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td></td>
                                  <td></td>
                                  <td colspan="3"><span> {{ $analystFinalScore->final_rating }}</span>
                                  </td>
                                </tr>
                              </table>
                              {!! Form::close() !!}
                              @else
                              @endif
                              <?php } ?>
                              {{-- Credit model end --}}
                              {{-- Liquidity Model Start --}}

                              <?php
                              //if(isset($bscNscCode && companySharePledged))  
                              if ($bscNscCode !='' || $companySharePledged != '') { ?>  
                              {!! Form::hidden('ratings_id ', isset($ratingModel)?$ratingModel->id:null)!!}
                              {!! Form::hidden('loan_id ', $loanId)!!}
                              {!! Form::hidden('model_type ', Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT '))!!}
                              {!! Form::hidden('status ', 1)!!}
                              @if(isset($financialDataRecordsPLID) && $financialDataRecordsPLID != null)
                              <div class="col-md-7" style="  margin-left: 35%; margin-top: 25px;  margin-bottom: 20px;">
                                <p class="user_name">Liquidity Model</p>
                              </div><br>
                              {!! Form::model($financialDataRecordsPL) !!}
                              <?php
                              $categoryCounter = 1;
                              $dimensionCounter = 1;
                              ?>
                              <table style="width: 250px;margin-left: 23px;">
                                <tr>
                                  <td>
                                    {!! Form::label('borrower_name ','Borrower Name ') !!}
                                  </td>
                                  <td>
                                    {!! Form::label('borrower_name
                                    ', isset($userProfile)?  $userProfile->name_of_firm : '&nbsp; ') !!}
                                  </td>
                                </tr>
                              </table>
                              <table style="margin-left: 15px;">
                                <tr>
                                  <td style="width: 280px;">
                                  </td>
                                  <td style="width: 80px;">
                                    {!! Form::label('category_weight ','% Weight ', ['class '=>'control-label ']) !!}
                                  </td>
                                  <td style="width: 60px;">
                                    {!! Form::label('points ','Points ', ['class '=>'control-label ']) !!}
                                  </td>
                                  <td style="width: 95px;">
                                    {!! Form::label('applicable ','Applicable ', ['class '=>'control-label ']) !!}
                                  </td>
                                  <td style="width: 100px;">
                                    {!! Form::label('measure_value ','Value/Factor ', ['class '=>'control-label '])
                                    !!}
                                  </td>
                                  <td style="width: 100px;">
                                    {!! Form::label('applicable_points ','Applicable Points ',['class '=>'control-label ']) !!}
                                  </td>
                                </tr>
                              </table>
                              @foreach($liquidityModelsCategoriesList as $creditCategory)
                              {{--Category Row --}}
                              <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                <tr>
                                  <td style="width: 75px;">
                                    {{$creditCategory->label}}
                                  </td>
                                  <td style="width: 115px;">
                                    <span id = "category_weight_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;">{{$creditCategory->weight}}</span></B>
                                    {!! Form::hidden('category[ '.$categoryCounter.'][category_weight] ', $creditCategory->weight)!!}
                                  </td>
                                  <td>
                                    <span id = "category_points_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                  </td>
                                  <td>
                                    <span id = "category_calculated_measure_label_top_{{$categoryCounter}}" class = "control-label" style = "width: 100%;"></span>
                                  </td>
                                </tr>
                              </table>
                              @foreach($creditCategory->dimensions as $creditDimension)
                              {{--Dimension Row --}}
                              <table style="padding-top:5px;margin-left: 15px;">
                                <?php
                                $categoryStyle = "";
                                if (!isset($creditDimension->parent_dimension_id) || $creditDimension->dimension_type == 2) {
                                  $categoryStyle = "background-color:#BFBFBF;";
                                  ?>
                                  <tr>
                                    <td style="width: 300px; {{$categoryStyle}}">
                                      {!! Form::label('dimension_label ',$creditDimension->label,['class '=>'control-label ']) !!}
                                    </td>
                                    <td style="width: 65px; {{$categoryStyle}}">
                                      {!! Form::label('dimension_weight ',$creditDimension->weight, ['class '=>'control-label ']) !!}
                                      {!!
                                        Form::hidden('category[ '.$categoryCounter.'][dimension][weight] ', $creditDimension->weight)!!}
                                      </td>
                                      <?php } else {   ?>
                                      <tr>
                                        <td style="width: 300px; {{$categoryStyle}}">
                                          {!! Form::label('dimension_label ',$creditDimension->label, ['class '=>'control-label ']) !!}
                                        </td>
                                        <td style="width: 65px; {{$categoryStyle}}">
                                          {!! Form::label('dimension_weight ',$creditDimension->weight,  ['class '=>'control-label ']) !!}
                                          {!! Form::hidden('category[ '.$categoryCounter.'][dimension][weight] ', $creditDimension->weight)!!}
                                        </td>
                                        <?php }  ?>
                                        @if(!$creditDimension->isParent())
                                        <td style="width: 70px;">
                                          {!! Form::label('points
                                          ', ($creditCategory->weight * ($creditDimension->weight / 100)), ['class '=>'control-label ']) !!}
                                        </td>
                                        @if($creditDimension->hasRatio() && isset($creditDimension->selected_measure_id))
                                        <td style="width: 80px;">
                                          @if($creditDimension->is_applicable == 1)
                                          {!! Form::label('liquidity_model_rating_details[ '.$dimensionCounter.'][is_applicable_label]
                                          ','Yes ', ['class ' => 'readonly-text ']) !!}
                                          @else
                                          {!! Form::label('liquidity_model_rating_details[ '.$dimensionCounter.'][is_applicable_label]
                                          ', 'No ', ['class ' => 'readonly-text ']) !!}
                                          @endif
                                        </td>
                                        <td style="width: 115px;">
                                          <?php
                                          $valueArray = $creditDimension->measures->lists('label ', 'id ')->all();
                                          $selectedValue = $creditDimension->selected_measure_id;
                                          if (isset($selectedValue)) {
                                            $firstValueOfArray = array_pull($valueArray, $selectedValue);
                                          } else {
                                            $firstValueOfArray = current($valueArray);
                                          }
                                          ?>
                                          {!! Form::text('liquidity_model_rating_details[ '.$dimensionCounter.'][measure_id_label]
                                          ', $firstValueOfArray, ['id ' => 'measureValue_ '.$dimensionCounter, 'class ' => 'readonly-text ', 'style ' => 'width: 145%; ']) !!}
                                        </td>
                                        @else
                                        <td style="width: 80px;">
                                          @if(@$creditDimension->is_applicable == 1)
                                          {!! Form::label('liquidity_model_rating_details[ '.@$dimensionCounter.'][is_applicable]','Yes ', ['class ' => 'readonly-text ']) !!}
                                          @else
                                          {!! Form::label('liquidity_model_rating_details[ '.@$dimensionCounter.'][is_applicable]', 'No ', ['class ' => 'readonly-text ']) !!}
                                          @endif
                                        </td>
                                        <td style="width: 115px;">
                                          <?php
                                          $valueArray = @$creditDimension->measures->lists('label ', 'id ')->all();
                                          $selectedValue = @$creditDimension->selected_measure_id;
                                          if (isset($selectedValue)) {
                                            $firstValueOfArray = array_pull($valueArray, $selectedValue);
                                          } else {
                                            $firstValueOfArray = current($valueArray);
                                          }
                                          ?>
                                          {!! Form::text('liquidity_model_rating_details[ '.$dimensionCounter.'][measure_id]', @$firstValueOfArray, ['id ' => 'measureValue_ '.$dimensionCounter, 'class ' => 'readonly-text ', 'style ' => 'width: 145%; ']) !!}
                                        </td>
                                        @endif
                                        @endif
                                        <?php $dimensionCounter += 1;?>
                                        @endforeach
                                      </tr>
                                    </table>
                                    <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                      <tr>
                                        <td style="width: 75px;">
                                          {!! Form::label('category_label ','Total Score -
                                          ' . $creditCategory->label, ['class '=>'control-label ','style ' => 'width: 100% ']) !!}
                                        </td>
                                        <td style="width: 135px;"> {!! Form::hidden('category[
                                          '.$categoryCounter.'][category_weight] ', ' ', ['id ' => 'category_weight_field_ '.$categoryCounter])!!}
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                      </tr>
                                    </table>
                                    <?php $categoryCounter += 1;?>
                                    @endforeach
                                    <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                      <tr>
                                        <td style="width: 75px;">
                                          {!! Form::label('grand_total_label ','Grand Total ', ['class '=>'control-label
                                          ','style ' => 'width: 100% ']) !!}
                                        </td>
                                        <td style="width: 115px;">
                                          {!! Form::hidden('grand_total_weight ', ' ', ['id ' => 'grand_total_weight_field '])!!}
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                      </tr>
                                    </table>
                                    <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                      <tr>
                                        <td style="width: 75px;">
                                          {!! Form::label('final_rating_text_label ','Our Rating ',  ['class
                                          '=>'control-label ']) !!}
                                        </td>
                                        <td style="width: 115px;">
                                          {!! Form::hidden('final_rating
                                          ', isset($ratingModel)?$ratingModel->final_rating:null, ['id ' => 'final_rating ']) !!}
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                      </tr>
                                    </table>
                                    {!! Form::close() !!}
                                    @else
                                    @endif
                                    <?php } ?>
                                    {{-- Liquidity Model End --}}
                                    {{--======Start Of Collateral Model Tab.=======================================================================--}}
                                    <?php
                                    $companySharePledged=4;
                                    if ( $companySharePledged = 4 ) {
                                      if(isset($analystcollatralScoreProperty)){


                                        foreach ($analystcollatralScoreProperty as   $value) {
                                          ?>
                                          @if(isset($financialDataRecordsPLID) && $financialDataRecordsPLID != null)
                                          <div class="col-md-7"  style="  margin-left: 35%;   margin-bottom: 20px;">
                                            <p class="user_name">Collateral Model</p>
                                          </div><br>
                                          {!! Form::model($financialDataRecordsPL) !!}
                                          <?php
                                          $categoryCounter = 1;
                                          $dimensionCounter = 1;
                                          ?>
                                          <table style="width: 250px;margin-left: 23px;">
                                            <tr>
                                              <td>
                                                {!! Form::label('borrower_name ','Borrower Name ') !!}
                                              </td>
                                              <td>
                                                {!! Form::label('borrower_name
                                                ', isset($userProfile)? $userProfile->name_of_firm : '&nbsp; ') !!}
                                              </td>
                                            </tr>
                                          </table>
                                          <table style="width: 250px;margin-left: 23px;">
                                            <tr>
                                              <td>
                                                {!! Form::label('developer_funding ','Assesment for Developer
                                                funding ',['style ' => 'width: 100% ']) !!}
                                              </td>
                                              <td>
                                                @if(isset($ratingModelCol))
                                                {!! Form::label('developer_funding_type_yes_label ', 'Yes ') !!}
                                                @else
                                                {!! Form::label('developer_funding_type_no_label ', 'No ') !!}
                                                @endif
                                              </td>
                                            </tr>
                                          </table>
                                          <table style="margin-left: 100px;">
                                            <tr>
                                              <td style="width: 225px;">
                                              </td>
                                              <td style="width: 95px;">
                                                {!! Form::label('category_weight ','Weightages ', ['class
                                                '=>'control-label ']) !!}
                                              </td>
                                              <td style="width: 80px;">
                                                {!! Form::label('applicable ','Applicable ',
                                                ['class '=>'control-label ']) !!}
                                              </td>
                                              <td style="width: 95px;">
                                                {!! Form::label('points ','Final Weight ', ['class '=>'control-label '])  !!}
                                              </td>
                                              <td style="width: 115px;">
                                                {!! Form::label('measure_value ','Value/Factor ', ['class
                                                '=>'control-label ']) !!}
                                              </td>
                                              <td style="width: 100px;">
                                                {!! Form::label('applicable_points ','Score ', ['class '=>'control-label ']) !!}
                                              </td>
                                            </tr>
                                          </table>
                                          @foreach($analystModelsCategoriesListCol as $category)
                                          <table style="background-color:#B8CCE4;width: 750px;margin-left: 15px;">
                                            <tr>
                                              <td style="width: 90px;">
                                                {{$category->label}}
                                              </td>
                                              <td style="width: 115px;">
                                                {{$category->weight}}
                                              </td>
                                              <td>
                                              </td>
                                              <td>
                                              </td>
                                              <td>
                                              </td>
                                              <td>
                                              </td>
                                            </tr>
                                          </table>
                                          @foreach($category->dimensions as $dimension)
                                          <table style="padding-top:5px;margin-left: 15px;">
                                            <?php
                                            $categoryStyle = "";
                                            if (!isset($dimension->parent_dimension_id) || $dimension->dimension_type == 2) {
                                              $categoryStyle = "background-color:#BFBFBF;";
                                            }
                                            ?>
                                            <tr>
                                              <td style="width: 330px; {{$categoryStyle}}">
                                                {!! Form::label('dimension_label ',$dimension->label, ['class
                                                '=>'control-label ']) !!}
                                              </td>
                                              <td style="width: 90px; {{$categoryStyle}}">
                                                {!! Form::label('dimension_weight ',$dimension->weight, ['class
                                                '=>'control-label ']) !!}
                                                {!! Form::hidden('category[ '.$categoryCounter.'][dimension][weight] ', $dimension->weight)!!}
                                              </td>
                                              @if(!$dimension->isParent())
                                              <td style="width: 70px;">
                                                @if($dimension->is_applicable == 1)
                                                {!! Form::text('analyst_model_rating_details[
                                                  '.$dimensionCounter.'][is_applicable] ','Yes ', ['class ' => 'readonly-text ']) !!}
                                                  @else
                                                  {!! Form::text('analyst_model_rating_details[
                                                    '.$dimensionCounter.'][is_applicable] ', 'No ', ['class ' => 'readonly-text ']) !!}
                                                    @endif
                                                  </td>
                                                  <td>
                                                  </td>
                                                  <td>
                                                    <?php
                                                    $valueArray = $dimension->measures->lists('label ', 'id ')->all();
                                                    $selectedValue = $dimension->selected_measure_id;
                                                    if (isset($selectedValue)) {
                                                      $firstValueOfArray = array_pull($valueArray, $selectedValue);
                                                    } else {
                                                      $firstValueOfArray = current($valueArray);
                                                    }
                                                    ?>
                                                    {!! Form::text('analyst_model_rating_details[
                                                      '.$dimensionCounter.'][measure_id] ',$firstValueOfArray, [ 'class ' => 'readonly-text ']) !!}
                                                    </td>
                                                    <td>
                                                    </td>
                                                    @endif
                                                    <?php $dimensionCounter += 1;?>
                                                    @endforeach
                                                  </tr>
                                                </table>
                                                <?php $categoryCounter += 1;?>
                                                @endforeach
                                                <table style="margin-left: 15px;width: 750px;background-color:#B8CCE4;">
                                                  <tr>
                                                    <td style="width: 225px;">
                                                      {!! Form::label('grand_total_label ','Total Score
                                                      ',  ['class '=>'control-label ']) !!}
                                                    </td>
                                                    <td style="width: 95px;">
                                                      {!! Form::hidden('final_score
                                                      ', isset($ratingModelCol)?$ratingModelCol->final_score:null, ['id ' => 'grand_total_calculated_measure_field ']) !!}
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td><span>{{ $value->final_score }}</span>
                                                    </td>
                                                  </tr>
                                                </table>
                                                <table style="margin-left: 15px;width: 750px;">
                                                  <tr>
                                                    <td style="width: 100px;">
                                                      {!! Form::label('any_defect_label ','Any Defect ', ['class
                                                      '=>'control-label ']) !!}
                                                    </td>
                                                    <td style="width: 450px;">
                                                      @if(isset($ratingModelCol))
                                                      {!! Form::label('has_defect_label_yes ', 'Yes ', ['class
                                                      '=>'control-label ']) !!}
                                                      @else
                                                      {!! Form::label('has_defect_label_no ', 'No ', ['class
                                                      '=>'control-label ']) !!}
                                                      @endif
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                  </tr>
                                                </table>
                                                <table style="margin-left: 15px;width: 750px;background-color:#B8CCE4;">
                                                  <tr>
                                                    <td style="width: 225px;">
                                                      {!! Form::label('final_haircut ','Final Haircut ', ['class
                                                      '=>'control-label ']) !!}
                                                    </td>
                                                    <td style="width: 95px;">
                                                      {!! Form::hidden('final_haircut ', ' ', ['id ' => 'final_haircut '])  !!}
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>
                                                      <span>{{ $value->final_haircut }}</span>
                                                    </td>
                                                  </tr>
                                                </table>


                                                <table style="margin-left: 15px;width: 750px;background-color:#B8CCE4;">
                                                  <tr>
                                                    <td style="width: 225px;">
                                                      {!! Form::label('expectedSale ','Expected Sale Value
                                                      of property ', ['class '=>'control-label ']) !!}
                                                    </td>
                                                    <td style="width: 95px;">

                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>
                                                      <span>{{ $value->expectedSale }}</span>
                                                    </td>
                                                  </tr>
                                                </table>
                                                {!! Form::close() !!}
                                                @else
                                                @endif
                                                <?php
                                              }
                                            }
                                          }
                                          ?>
                                          @endif
                                          <br>
                                        {{--</div>--}}
                                      </div>
                                    </body>
                                    <script type="text/javascript">
                                      $(document).ready(function () {
                                        /*---- End Auto Population Function ------*/
                                      });
                                      var x = $('#sales_area_type ').val();
                                      if (x == '0 ') {
                                        $("#one_city").show();
                                        $("#multiple_cities").hide();
                                        $("#multiple_states").hide();
                                      } else if (x == '1 ') {
                                        $("#one_city").hide();
                                        $("#multiple_cities").show();
                                        $("#multiple_states").hide();
                                      } else if (x == '2 ') {
                                        $("#one_city").hide();
                                        $("#multiple_cities").hide();
                                        $("#multiple_states").show();
                                      } else if (x == '3 ') {
                                        $("#one_city").hide();
                                        $("#multiple_cities").hide();
                                        $("#multiple_states").hide();
                                      }
  //For showing annual value of export in editing of file
  var current_comYourSalestype = "{{ $comYourSalestype }}";
  if (current_comYourSalestype == 'Export ' || current_comYourSalestype == 'Both ') {
    $("#AnnualValueExport").show();
  }
  else {
    $("#AnnualValueExport").hide();
  }
  //End of showing annual value of export in editing of file
  //For showing Deatils of compettitors of export in editing of file
  //End of showing Deatils of compettitors of export in editing of file
</script>
</html>
