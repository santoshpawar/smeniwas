
@extends('app_header')
@section('head-content')
  <?php $user = Auth::user(); ?>

  @section('content')
    <div class="wrapper">
      @include('home.home_sidebar')
      <div class="main-panel">
        @include('loans.dashboardNavbar')


        <div class="content">
          <div class="clearfix_responsive"></div>
          <div class="container-fluid">
            
            @if(Auth::guest())
              {!! Form::open(['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal' ]) !!}
            @else
              @if ($subViewType == "register.sme._form_register")
                {!! Form::model($userProfile,['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
              @elseif($subViewType == "register.sme._form_subsidiary")
                @if(Auth::user()->user_profile != null && Auth::user()->userProfile()->get()->first() != null)
                  {!! Form::model(Auth::user()->userProfile(),['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
                @else
                  {!! Form::model(null,['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
                @endif
              @else
                {!! Form::model(Auth::user()->userProfile,['method' =>'POST','action' => $formaction, 'id' => 'form', 'role'=>'form', 'class'=>'form-horizontal'] ) !!}
              @endif
            @endif

            @include('register.sme._form_register_master',array('sub_view_type' => $subViewType));

            {!! Form::close() !!}


          </div>

        </div>


        <script type="text/javascript">
        $("#lnkSMEDtls").click(function (e) {
          e.preventDefault();
          window.location.href = window.location.origin+'/register/sme/details';
        });
        $("#lnkAppDtls").click(function (e) {
          e.preventDefault();
          window.location.href = window.location.origin+'/register/sme/promoter';
        });
        $("#lnkFinancial").click(function (e) {
          e.preventDefault();
          window.location.href = window.location.origin+'/register/sme/financial';
        });
        $("#lnkBanking").click(function (e) {
          e.preventDefault();
          window.location.href = window.location.origin+'/register/sme/subsidiary';
        });
        $("#lnkLoanDtls").click(function (e) {
          e.preventDefault();
          window.location.href = window.location.origin+'/register/sme';
        });
        //        $('#is_subsidiary').change(function(){
        //          alert( $('#is_subsidiary :selected').val());
        //        });

        function validateForm(currentTab){
          // alert(currentTab);
          var valid = true;
          var div = currentTab;
          $(div).find('input:text, input:password, input:file, select, textarea, input:radio, input:checkbox').each(function() {
            if($(this).attr('type')=='file'){
              if($(this).is(':visible') && $(this).data('mandatory') == 'M'){
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


        $(document).ready(function(){
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








        </script>

      @endsection
