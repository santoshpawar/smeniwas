  <style>
         .sharePop {
    background: #083b82;
    font-size: 16px;
    padding: 5px;
    color: white;
    animation: blinker 7s linear infinite;
}
    @keyframes blinker {
      50% { opacity: 0; }
  }
  .form-control {

    padding: 7px 15px !important;
    
}

</style>

{!! isset($companySharePledged) ? "<div class='sharePop text-center'>Please provide information regarding  <strong>".$companySharePledged."</strong> who's share are being pledged</div>":""  !!}

@if(isset($companySharePledged))
{!! Form::hidden('companySharePledged', $companySharePledged) !!}
@endif
@if(isset($bscNscCode))
{!! Form::hidden('bscNscCode', $bscNscCode) !!}
@endif

@section('style')

@stop


<?php
$removeMandatory=null;
$user = Auth::getUser();


if ($user->isAnalyst()) {
  $setDisable=null;
}elseif($user->isBankUser()){
  $setDisable='disabled';

}
//$loanSecurityShare=null;
$endUseList = Session::get('end_use');
$loanId = Session::get('loanId');
$amount = Session::get('loan_amount');
$loanTenure = Session::get('loan_tenure');
$loanType = Session::get('type');
$pre_fix = "";
if (!App::isLocal()){
  $pre_fix = "smeniwas/public";
}

$message = Session::get('message');
?>
<div class="container-fluid">
  <div class="row">
    <div class="card">
      <div class="card-header" data-background-color="green">
        <h4 class="title">Background Details <span class="pull-right">{{ $userProfile->name_of_firm }}</span></h4>
        {{--    <p class="category">Apply new loan</p> --}}
      </div>

      <div class="card-content">
       
       
        <div class="col-md-12">
          <!-- start E3 -->
          <div class="row" style="margin-left:10px">
            <div class="col-md-12">
              <div id="Que35" class="form-group">
                <div class="panel panel-success">
                  <div class="panel-heading">Security Details</div>
                  <div class="row" style="padding:10px">

                    <div class="col-md-6">

                      {!! Form::label('Daily Volume on BSE/NSE','Daily Volume on BSE/NSE ') !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('dailyVolume',  isset($loanSecurityShare->dailyVolume)? $loanSecurityShare->dailyVolume : null, ['class' =>'form-control amount','placeholder' => 'Daily Volume on BSE/NSE',$setDisable]) !!}
                    </div>
                    <div class="col-md-6">
                      {!! Form::label('Promoter Holding','Promoter Holding (in %)') !!}
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('pramoterHolding', isset($loanSecurityShare->pramoterHolding)? $loanSecurityShare->pramoterHolding : null, ['class'=>'form-control amount', 'placeholder' => 'Promoter Holding','data-mandatory'=>'M',$setDisable ] )!!}
                    </div>
                  </div>
                  <div class="row" style="padding:10px">

                    <div class="col-md-3">
                      {!! Form::label('Percentage of Promoter holding pledges Current Quarter','Percentage of Promoter holding pledges Current Quarter (in %)') !!}
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('currentQuarter', isset($loanSecurityShare->currentQuarter)? $loanSecurityShare->currentQuarter : null, ['class'=>'form-control amount', 'placeholder' => 'Current Quarter' ,$setDisable] )!!}
                    </div>
                    <div class="col-md-3">
                      {!! Form::label('Percentage of Promoter holding pledges Previous Quarter','Percentage of Promoter holding pledges Previous Quarter (in %)') !!}
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('previousQuarter', isset($loanSecurityShare->previousQuarter)? $loanSecurityShare->previousQuarter : null, ['class'=>'form-control amount', 'placeholder' => 'Previous Quarter','data-mandatory'=>'M' ,$setDisable ] )!!}
                    </div>
                    <div class="col-md-3">
                      {!! Form::label('52 Week  high Price','52 Week  high Price') !!}<span class="small">( <i class="fa fa-rupee"></i> Rs )</span>
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('highPrice', isset($loanSecurityShare->highPrice)? $loanSecurityShare->highPrice : null, ['class'=>'form-control amount', 'placeholder' => '52 Week  high Price','data-mandatory'=>'M' ,$setDisable ] )!!}
                    </div>
                    <div class="col-md-3">
                      {!! Form::label(' 52 Week low Price',' 52 Week low Price ') !!}<span class="small">( <i class="fa fa-rupee"></i> Rs )</span>
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('lowPrice', isset($loanSecurityShare->lowPrice)? $loanSecurityShare->lowPrice : null, ['class'=>'form-control amount', 'placeholder' => '52 Week low Price','data-mandatory'=>'M' ,$setDisable] )!!}
                    </div>
                  </div>

                  <div class="row" style="padding:10px">

                    <div class="col-md-6">
                      {!! Form::label('Last one Month Average Price') !!}<span class="small">( <i class="fa fa-rupee"></i> Rs )</span>
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('lastOneMonthPrice', isset($loanSecurityShare->lastOneMonthPrice)? $loanSecurityShare->lastOneMonthPrice : null, ['class'=>'form-control amount', 'placeholder' => 'Last One Month Average Price (in Rs)','data-mandatory'=>'M' ,$setDisable ] )!!}
                    </div>
                    <div class="col-md-6">
                      {!! Form::label('Market Capitalisation','Market Capitalisation') !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::text('marketCapitalisation', isset($loanSecurityShare->marketCapitalisation)? $loanSecurityShare->marketCapitalisation : null, ['class'=>'form-control amount', 'placeholder' => 'Market Capitalisation','data-mandatory'=>'M',$setDisable ] )!!}
                    </div>

                    <div class="col-md-6">
                      {!! Form::label('Credit Rating of','Credit Rating of') !!}
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::select('creditRatingof', $craditRating,isset($loanSecurityShare->creditRatingof)? $loanSecurityShare->creditRatingof : null,  ['id' => 'craditRating', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M' ,$setDisable]) !!}
                      {{-- isset($salesAreaDetails->city_name) ? $salesAreaDetails->city_name : null --}}
                    </div>

                    <div class="col-md-6">
                      {!! Form::label('Rating Agency','Rating Agency') !!}
                      {!! Form::label(null, $removeMandatory, ['class' => 'redmarks']) !!}
                      {!! Form::select('ratingAgencies', $ratingAgencies,isset($loanSecurityShare->ratingAgencies)? $loanSecurityShare->ratingAgencies : null, ['id' => 'ratingAgencies', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M' ,$setDisable ]) !!}
                    </div>

                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-12" style="margin-left:20px;">
                      {{--{!! Form::button('<i class="fa fa-reply"></i> Back', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Div4', '$loanType', '$endUseList', $amount, $loanTenure, $loanId); return false;", 'value'=> 'Back', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}--}}


                      {!! Form::button('Save/Next Section <i class="fa fa-share"></i>', ['type' => 'submit', 'class' => 'btn btn-alert btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable]) !!}
                      {{--<a data-toggle="modal" href="#myModal" class="btn btn-success btn-cons sme_button" id="nextIn" style="margin-top:20px;margin-left:20px;">Save & Submit <i class="fa fa-floppy-o"></i></a>--}}

                      {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @if (!empty($errors) && isset($message))
    <script>
    $(function() {
      $('#myModal').modal('show');
    });
    </script>
  @endif
  @section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('/css/datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      var cnt = 1;
      /*---- end toggle function*/
      $("#nextIn").click(function (e){
        if(validateForm('#divTab_sub')){
          return true;
        }else{
          e.preventDefault();
        }
      });
    });
    $('#craditRating').select2({
      allowClear: true,
      placeholder: "Select Rating"
    });
    $('#ratingAgencies').select2({
      allowClear: true,
      placeholder: "Select Rating Agency"
    });
    $(function () {

      $('#datepicker_0').datepicker();
      $('#datepicker_1').datepicker();
      $('#datepicker_2').datepicker();
      $('#datepicker_3').datepicker();
      $('#datepicker_4').datepicker();
    });
    </script>
  @endsection
