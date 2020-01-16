<div class="card">
 <div class="card-header" data-background-color="green">
  <h4 class="title">Liquidity Test Model <span class="pull-right">{{ $loanUserProfile->name_of_firm }}</span></h4>
</div>

<?php 
 //echo  $effectiveDate = date('m-Y', strtotime("+3 months", strtotime($startingTime)));

 ?>
<div class="card-content">
  <div class="col-md-12 input">
    <div class="tab-content tab-design" style="padding-top:20px;padding-right: 5px;padding-left: 5px;">
     <div class="row" style="margin-left: auto;">
      <div class="col-sm-4">
        <div class="form-group">
          {!! Form::label('', 'Opening cash balance',['class'=>'form-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
          {!! Form::text('opening_cash_balance',  isset($opening_cash_balance) ? $opening_cash_balance : null, array('class' => 'form-control amount','placeholder'=>'Outstanding Amount','data-mandatory'=>'M' ,$setDisable)) !!}
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          {!! Form::label('', 'Initial Capital Invested',['class'=>'form-label']) !!}<span class="small">( <i class="fa fa-rupee"></i> Lacs )</span>
          {!! Form::text('capital_Invested',  isset($capital_Invested) ? $capital_Invested : null, array('class' => 'form-control amount','placeholder'=>'Outstanding Amount','data-mandatory'=>'M' ,$setDisable)) !!}
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group" style="margin-left: 15px;">
          {!! Form::label('selectPeriod','Monthly / Quarterly / Yearly', ['class'=>'control-label']) !!}
          @if(isset($period_name))
          {!! Form::select('period_name', array('' => 'Select Period',  'quarterly' => 'Quarterly','annualy' => 'Yearly'),$period_name,['id' => 'period_name', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
          @else
          {!! Form::select('period_name', array('' => 'Select Period', 'quarterly' => 'Quarterly','annualy' => 'Yearly'),null,['id' => 'period_name', 'class'=>'form-control','data-mandatory'=>'M' ,$setDisable]) !!}
          @endif
        </div>
      </div>



      <div class="col-md-4">
        <div class="form-group" style="margin-left: 15px;">
          {!! Form::label('no_of_period','No of Months / Quarters / Years', ['class'=>'control-label']) !!}
          {!! Form::text('no_of_period', isset($no_of_period) ? $no_of_period : null, array('class' => 'form-control amount','placeholder'=>'Outstanding Amount','data-mandatory'=>'M' ,$setDisable)) !!}
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group" style="margin-left: 15px;">
          {!! Form::label('startingTime','Starting From', ['class'=>'control-label']) !!}
          {!! Form::text('startingTime',  isset($startingTime) ? $startingTime : null, array('class' => 'form-control ','id'=>'fromDateStat','data-mandatory'=>'M' ,$setDisable)) !!}
        </div>
      </div>
      

    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12" style="margin-left:20px;">


    @if($user->isSME() || $user->isBankUser())
    {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
    @endif
    {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
    @if(Auth::user()->isAnalyst())
    {!! Form::submit('Save & Continue', array('class' => 'btn btn-success btn-cons sme_button', 'value'=>
    'Next', 'style' => 'margin-top:20px;margin-left:20px;')) !!}

    @endif
  </div>
</div>
</div>
</div>

<script>
  jQuery(document).ready(function ($) {

   /* $('#fromDateStat').datepicker({
      changeMonth: true,
      changeYear: true,
     // showButtonPanel: true,
     dateFormat: 'MM-yy',
     yearRange: '2016:2030',
     monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
     monthNamesShort: ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"],
     onClose: function(dateText, inst) {
      var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
      $(this).datepicker('setDate', new Date(year, month, 1));
    },
  })*/

  //$( "#period_name" ).change(function() {


   // if($( "#period_name").val() == 'monthly'){
      //$("#fromDateStat").val('');
      $('#fromDateStat').show();
      $('#fromDateStat').datepicker({
       changeMonth: true,
       changeYear: true,
       showButtonPanel: true,
       dateFormat: 'yy-mm',
       yearRange: '2016:2030',
         //monthNames: ["1","2","3","4","5","6","7","8","9","10","11","12"],
         //monthNamesShort: ["Jan","Feb","March","April","May","June","July","Aug","Sept","Oct","Nov","Dec"],
         onClose: function(dateText, inst) {
          var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
          var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
          $(this).datepicker('setDate', new Date(year, month, 1));
        },
      })
      $("#fromDateStat").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
          my: "center top",
          at: "center bottom",
          of: $(this)
        });

      });
   // }

     

  //});

} );






</script>
