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
                      <td>
                        <div>
                          {!! Form::label('name_of_firm','Name of Firm: ') !!}<br>
                          {!! Form::text('name_of_firm',@$name_of_firm) !!}
                        </div>
                      </td>
                      <td>
                        <div>
                          {!! Form::label('firm_pan','PAN No of Firm: ') !!}<br>
                          {!! Form::text('firm_pan',@$firm_pan) !!}
                        </div>
                      </td>
                      <td>
                        <div>
                          {!! Form::label('entity_type','Type of Legal Entity: ') !!}<br>
                          {!! Form::text('owner_entity_type',@$chosenEntity, ['id' => 'owner_entity_type'])
                          !!}
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div style=" width: 10px;">
                         {!! Form::label('sector','Sector (Manufacturing/Services)') !!}<br>
                         {!! Form::select('com_industry_segment', @$industryTypes, null, [ 'id' => 'industry_segment'])!!}
                       </div>
                     </td>  
                     <td>
                      <div>
                        {!! Form::label('legal_entity_type','Type of Legal Entity') !!} <br>
                        @if(isset($mobileEntityType))
                        {!! Form::select('legal_entity_type',$entityTypes,$mobileEntityType, ['id' => 'legal_entity_type']) !!}
                        @else
                        {!! Form::select('legal_entity_type',$entityTypes,$chosenEntity, ['id' => 'legal_entity_type']) !!}
                        @endif
                      </div>
                    </td>
                    <td>
                      <div>
                        {!! Form::label('gst','Customers (B2B, B2C)') !!}<br>
                        @if(isset($praposalBackground->com_business_type))
                        {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], $praposalBackground->com_business_type, ['id'=>'com_business_type' ,$setDisable])!!}
                        @else
                        {!! Form::select('com_business_type', [''=>'Select Business Type','Manufacturing'=>'Manufacturing', 'B2B'=>'Services B2B', 'B2C'=>'Services B2C', 'Trading'=>'Trading'], null, ['id'=>'com_business_type' ,$setDisable])!!}
                        @endif
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" > <center><b>Exposer Details</b> </center>
                    </td>
                  </tr>
                  <tr>
                   <td>
                     <div style=" width: 200px;">
                       {!! Form::label('gst','Business Address') !!}<br>
                       {!! Form::text('business_address', $userProfileFirm->address, array('class' => 'readonly-text', 'id'=>'business_address', 'placeholder'=>'', $setDisable)) !!}
                     </div>
                   </td>
                   <td>
                    <div>
                     {!! Form::label('Loan Amount','Loan Amount') !!}<label><span class="small"> ( <i class="fa fa-rupee"></i> Lacs )</span></label><br>
                     <label>Existing Amount : </label>             {!! Form::text('amount', (isset($praposalBackground->amount) && isset($praposalBackground->amount))? @$praposalBackground->amount : null, array( 'id'=>'amount', 'placeholder'=>'Existing', $setDisable)) !!} <br>
                     <label>Praposed Amount :</label>            {!! Form::text('praposedAmount', (isset($praposalBackground->praposedAmount) && isset($praposalBackground->praposedAmount))? @$praposalBackground->praposedAmount : null, array( 'id'=>'praposedAmount', 'placeholder'=>'Proposed', $setDisable)) !!} <br>
                     <label>Total  Amount :</label>{!! Form::text('finalAmount', (isset($praposalBackground->finalAmount) && isset($praposalBackground->finalAmount))? @$praposalBackground->finalAmount : null, array( 'id'=>'finalAmount', 'placeholder'=>'total', $setDisable)) !!}
                   </div>
                 </td>
                 <td>
                   <div>
                    {!! Form::label('gst','Tenor') !!}<br>
                    <label>Existing Tenor :</label> {!! Form::text('existingTenor',(isset($praposalBackground->existingTenor) && isset($praposalBackground->existingTenor))? @$praposalBackground->existingTenor : null, array('id'=>'existingTenor', 'placeholder'=>'Existing', $setDisable)) !!}   <br>
                    <label> Praposed Tenor :</label> {!! Form::text('praposedTenor', (isset($praposalBackground->praposedTenor) && isset($praposalBackground->praposedTenor))? @$praposalBackground->praposedTenor : null, array( 'id'=>'praposedTenor', 'placeholder'=>'Proposed', $setDisable)) !!}  <br>
                    {{--   <label>Total Tenor : </label> {!! Form::text('totalTenor', (isset($praposalBackground->totalTenor) && isset($praposalBackground->totalTenor))? @$praposalBackground->totalTenor : null, array( 'id'=>'totalTenor', 'placeholder'=>'Total', $setDisable)) !!}</label>  --}}
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div>
                    {!! Form::label('Interest Rate','Interest Rate') !!}<br>
                    Existing Interest Rate :      {!! (isset($praposalBackground->existingInterestRate) && isset($praposalBackground->existingInterestRate))? @$praposalBackground->existingInterestRate : null  !!}<br>
                    Praposed Interest Rate :    {!! (isset($praposalBackground->praposedInterestRate) && isset($praposalBackground->praposedInterestRate))? @$praposalBackground->praposedInterestRate : null !!}<br>
                    {{-- <label>Total Interest Rate :   {!! Form::text('totalInterestRate', (isset($praposalBackground->totalInterestRate) && isset($praposalBackground->totalInterestRate))? @$praposalBackground->totalInterestRate : null, array( 'id'=>'totalInterestRate', 'placeholder'=>'Total', $setDisable)) !!}</label> --}}
                  </div>
                </td>
                <td>
                  <div>
                   {!! Form::label('Any delays in servicing in last 6 mths','Any delays in servicing in last 6 mths') !!}<br>           
                   @if(@$praposalBackground->dealy == '1')
                   {{ 'Yes' }}
                   @else
                   {{ 'No' }}
                   @endif
                 </label>
               </div>
             </td>
             <td>
              <div>
               {!! Form::label('Date of  disbursement', 'Date of  disbursement') !!}<br>
               {!! Form::text('disbursement_date', (isset($praposalBackground->disbursement_date) && isset($praposalBackground->disbursement_date))? @$praposalBackground->disbursement_date : null, array('class' => 'readonly-text', 'id'=>'date', 'placeholder'=>'', $setDisable)) !!}
             </div>
           </td>
         </tr>
         <tr>
          <td>
           {!! Form::label('Security','Security') !!}<br>
           {!! Form::text('security',@$praposalBackground->security, array('class' => 'readonly-text', 'id'=>'security', 'placeholder'=>'', $setDisable)) !!}
         </td>
         <td colspan="2">
          <div>
            {!! Form::label('Purpose of Loan','Purpose of Loan') !!}<br>
            {!! Form::textarea('loan_purpose',(isset($praposalBackground->loan_purpose) && isset($praposalBackground->loan_purpose))? @$praposalBackground->loan_purpose : null,[ 'class' => 'readonly-text','rows' => 2, 'cols' => 40]) !!}
          </div>
        </td>
      </tr>  
    </tbody>
  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
      </html>
