<?php
$user = Auth::user();
//dd($companySharePledged);
?>
@extends('app_header')
@section('head-content')
  <!-- Laravel Javascript Validation -->
  <script type="text/javascript" src="{{ asset('/js/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js_new/jquery.validate.js') }}"></script>
  <link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
  <script>
  function showTab(tabid,loanType,endUseList, amount, loanTenure,loanId) {
    //if(validateForm(currentTab)) {
      var locationURL = "{{URL::to('/home#')}}";
    
       var suffix = "/" + loanType + "/" + endUseList + "/" + amount + "/" + loanTenure +  "/";
     
   
      if (loanId && loanId.length > 0) {
        suffix += loanId;
      }
       
      if (tabid == "Div1") {
        locationURL = "{{URL::to('/loans/company-background/')}}" + suffix;
      } else if (tabid == "Div2") {
        locationURL = "{{URL::to('/loans/promoter/')}}" + suffix;
      } else if (tabid == "Div3") {
        locationURL = "{{URL::to('/loans/financial/')}}" + suffix;
      } /*else if (tabid == "Div4") {
        locationURL = "{{URL::to('/loans/business/')}}" + suffix;
      } */ else if (tabid == "Div5") {
      locationURL = "{{URL::to('/loans/application/')}}" + suffix;
    } else if (tabid == "Div6") {
      locationURL = "{{URL::to('/loans/uploaddoc/')}}" + suffix;
    } else if (tabid == "Div7") {
      locationURL = "{{URL::to('/loans/analyst-balance-sheet/')}}" + "/" + loanId;
    } else if (tabid == "Div8") {
      locationURL = "{{URL::to('/loans/analyst-profit-loss/')}}" + "/" + loanId;
    } else if (tabid == "Div9") {
      locationURL = "{{URL::to('/loans/analyst-calculated-ratios/')}}" + "/" + loanId;
    } else if (tabid == "Div10") {
      locationURL = "{{URL::to('/loans/credit-model/')}}" + "/" + loanId;
    } else if (tabid == "Div11") {
      locationURL = "{{URL::to('/loans/collateral-model/')}}" + "/" + loanId;
    } else if (tabid == "Div12") {
      locationURL = "{{URL::to('/loans/profile-loan-details/')}}" + suffix;
    } else if (tabid == "Div13") {
      locationURL = "{{URL::to('/loans/second-collateral-model/')}}" + "/" + loanId;
    } else if (tabid == "Div14") {
      locationURL = "{{URL::to('/loans/third-collateral-model/')}}"  + "/" + loanId;
    } 
    alert(locationURL);
    document.location = locationURL;
  //}
}
function validateForm(currentTab){
  // alert(currentTab);
  var valid = true;
  var div = currentTab;
  $(div).find('input:text, input:password, input:file, select, textarea, input:radio, input:checkbox').each(function() {
    if($(this).attr('type')=='file'){
      if($(this).is(':visible') && $(this).data('mandatory') == 'M'){
        console.log($(this).next().children().first().val().length);
        if ($(this).val().length == 0 && $(this).next().children().first().val().length <= 0) {
          $(this).next().children().first().css("border", "1px solid red")
          valid = false;
        }
        else {
          $(this).next().children().first().css("border", "")
        }
      }
    }else {
      if ($(this).is(':visible') && $(this).data('mandatory') == 'M' && $(this).attr('disabled') != 'disabled') {
        if ($(this).val().length == 0) {
          $(this).css("border", "1px solid red")
          valid = false;
        } else {
          $(this).css("border", "")
        }
      }
    }
  });
  $(div).find('select').each(function() {
    if($(this).next().is(':visible') && $(this).data('mandatory') == 'M') {
      if ($(this).children(":selected").val() == "") {
        $(this).next().css({
          "border" : "1px solid red",
          "border-radius" : "4px"
        });
        valid = false;
      } else {
        $(this).next().css({
          "border" : "",
          "border-radius" : ""
        });
      }
    }
  });
  return valid;
}
jQuery(document).ready(function($){
  //called when key is pressed in textbox
  $(".amount").keypress(function(e){
    if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57))
    {
      //display error message
      $(this).css("border", "1px solid red");
      return false;
    }
    else
    {
      $(this).css("border", "");
      var points = 0;
      var ws_text = $(this).val().split('.');
      points = ws_text[1];
      points = points.length;
      if (points >= 1)
      {
        $(this).css("border", "1px solid red");
        alert("One decimal places only allowed");
        $(this).css("border", "");
        return false;
      }
      $(this).css("border", "");
    }
  });
});
function showCompanyTab(tabid,loanType, loanId) {
  var locationURL = "{{URL::to('/home#')}}";
  if(tabid == "DivComp") {
    locationURL = "{{URL::to('/loans/company_background/')}}";
  }
  document.location = locationURL;
}
function raiseQuery(){
  var locationURL = "{{URL::to('/home#')}}";
  locationURL = "{{URL::to('/messaging')}}";
  window.open(
    locationURL,
    '_blank'
  );
}
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var $_Tawk_API={},$_Tawk_LoadStart=new Date();
(function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5593ca1fb1707075778657af/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
@endsection
@section('firm')
  @if (isset($loanUserProfile))
    <div class="firm-name-background" style="display: none;">
      <div class="firm-name-wrap">
        {{$loanUserProfile->name_of_firm}}
      </div>
    </div>
  @endif
@endsection
{{-- FormAction: Loans\LoansController@postIndex --}}
@section('content')
  @if ($subViewType == "loans._existing_lenderdetails")
    {!! Form::model($existingLenders,['method' =>'POST','action' => $formaction] ) !!}
  @elseif($subViewType=='loans._upload_itreturn')
    {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'files'=>true] ) !!}
  @elseif($subViewType=='loans._upload_doc')
    {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'files'=>true,'enctype'=>'multipart/form-data'] ) !!}
    @elseif($subViewType=='loans._createCheckList')
    {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'files'=>true,'enctype'=>'multipart/form-data'] ) !!}


  @elseif($subViewType=='loans._choose_loan')
    {!! Form::model($loan,['method' =>'POST','id'=>'chooseLoan','action' => $formaction, 'role'=> 'form'] ) !!}
  @elseif($subViewType=='loans._business' && isset($model)))
    {!! Form::model($model, ['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}
  @elseif($subViewType=='loans._promoter' && isset($model)))
    {!! Form::model($model, ['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}
  @elseif($subViewType=='loans._application' && isset($model)))
    {!! Form::model($model, ['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}
  @elseif($subViewType=='loans._application_LAS' && isset($model)))
    {!! Form::model($model, ['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}
  @elseif($subViewType=='loans._profile_loan_details'))
    {!! Form::model($loan, ['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}
  @elseif($subViewType=='loans.home._bank_approval'))
    {!! Form::model($loan, ['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}

    @elseif($subViewType=='loans._createCheckList'))
    {!! Form::model($loan, ['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}

  @else
    {!! Form::model($loan,['method' =>'POST','action' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form', 'onsubmit' => "return validate()"] ) !!}
    {{--{!! Form::model($loan,['method' =>'POST','url' => $formaction, 'class'=>'form-horizontal', 'role'=> 'form'] ) !!}--}}
  @endif
  {!! Form::hidden('loanId', $loanId) !!}
  {!! Form::hidden('type', $loanType) !!}
  @if(isset($amount))
    {!! Form::hidden('loan_amount', $amount) !!}
  @endif
  @if(isset($loanTenure))
    {!! Form::hidden('loan_tenure', $loanTenure) !!}
  @endif
  {{-- Added for loan against Share --}}
  @if(isset($companySharePledged))
    {!! Form::hidden('companySharePledged',$companySharePledged) !!}
  @endif
  @if(isset($bscNscCode))
    {!! Form::hidden('bscNscCode',$bscNscCode) !!}
  @endif
  @if(isset($endUseList))
    {!! Form::hidden('end_use', $endUseList) !!}
  @endif
  {{-- All Subview Forms --}}
  @include('loans._form_master',array('sub_view_type' => $subViewType));
  {!! Form::close() !!}
@endsection
