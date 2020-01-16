<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@extends('app_header')
<style type="text/css">
  .header-fixed-top{
        position: fixed;
    right: 0;
    left: 0;
    z-index: 1030;
    background: #fff;
        border-bottom: 5px solid #f3f3f3;
  }
  .phone_number {
    font-size: 20px;
    margin-left: 10px;
    line-height: 40px;
    vertical-align: middle;
    font-weight: bold;
    color: #2f5c99 !important;
    text-decoration: none;
    font-family: 'Tw Cen MT';
}
.card.reg {
    margin-top: 50px;
}
</style>
<header class="header-fixed-top">
  <div class="top-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <a href="http://smeniwas.com/">
            <img src="{{ asset('img/SMELogo.jpg') }}" alt="#" title="SME EXCHANGE.COM">

          </a>
        </div>
        <div class="col-md-9">
          <a href="/register/wizard/index" class="btn btn-warning btn-cons  pull-right" style="margin-left:10px;font-weight: bold;">Register New User</a>
      
          <a href="/auth/login" class="btn btn-success btn-cons pull-right" style="margin-left:10px;font-weight: bold;">Login</a>
          <a href="mailto:contact@smeniwas.com" class="phone_number pull-right">contact@smeniwas.com</a>
          <a href="tel:+91-22-20852054" class="phone_number pull-right">Call us: +91-22-20852054</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row"></div>
 
</header>
@section('content')
{{-- @if (count($errors) > 0)
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif --}}
<div class="container-fluid">
  <div class="row">
    <div class="card reg" >

  
      <div class="card-content">

        <div class="col-md-12">
              @include('errors')
          <div class="col-md-12 col-lg-12">
            <div class="container-fluid main-container" style="margin-bottom:15px;">
              <div class="col-md-12 col-lg-12">
                <div class="tab-content tab-design">
                  <div class="tab-pane active" id="CompanyBackground" style="margin-left:20px;">
                    <div class="row">
                      {!! Form::model($userProfile,['method' =>'POST','action' => $formaction] ) !!}
                      {!! Form::hidden('id',null) !!}
                      {!! Form::hidden('user_id',null) !!}
                      {!! Form::hidden('sme_client',null) !!}
                      {!! Form::hidden('password','password') !!}
                      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="container" id="ownertab" style="max-width: 100%;   margin-bottom: -25px;">
                          <div role="tabpanel">
                            <div id="divTC-Div1">
                              <div class="row">
                                <div class="panel panel-success ">
                                  <div class="panel-heading"><label>Registration Wizard - Owner</label></div><br>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('name_of_firm','Name of Firm', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::text('name_of_firm',null,['class' => 'form-control']) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('owner_entity_type','Type of Legal Entity', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::select('owner_entity_type',$entityTypes,$chosenEntity, ['id' => 'owner_entity_type','class' => 'form-control', 'style' => ' width: 100%;']) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('owner_name','Name of Owner/Director', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::text('owner_name',null,['class' => 'form-control']) !!}
                                        </div>
                                      </div>
                                    </div>
                                  </div><br>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('firm_pan','PAN  No of Firm', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::text('firm_pan',null,['class' => 'form-control', 'maxlength' => 10]) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('owner_email','Promoters Email id ', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::text('owner_email',null,['class' => 'form-control']) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('address','Address', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::textarea('address',isset($address)? $address:null,array('class' => 'form-control','placeholder' => 'Address', 'size' => '40x2')) !!}
                                        </div>
                                      </div>
                                    </div>
                                  </div><br>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('contact_numbers','Contact Numbers', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          <div class="col-md-6">
                                            {!! Form::text('contact1',null,['class' => 'form-control','placeholder' => 'No. 1', 'maxlength' => 10]) !!}
                                          </div>
                                          <div class="col-md-6">
                                            {!! Form::text('contact2',null,['class' => 'form-control','placeholder' => 'No. 2', 'maxlength' => 10]) !!}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-group required">
                                        {!! Form::label('owner_city','City', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::select('owner_city',$cities,$chosenCity,['id' => 'owner_city', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
                                        </div>
                                      </div>
                                      <div class="col-md-12 collapse" id="custom_cityName" style="padding-left: 0px;">
                                        {!! Form::label('city','City Name', ['style' => '  margin-left: 15px;']) !!}
                                        {!! Form::label(null,'*', ['class' => 'redmarks', 'style' => 'color: red;']) !!}
                                        {!! Form::text('city_other', null, ['class' =>'form-control','placeholder' => 'Enter City Name', 'size' => '5x5','style'=>'  margin-left: 15px; width: 92%']) !!}
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-group required">
                                        {!! Form::label('owner_state','State', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::select('owner_state',$states,$chosenState,['id' => 'owner_state', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="form-group required">
                                        {!! Form::label('pincode','Pincode', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::text('pincode',null,['class' => 'form-control', 'maxlength' => 6]) !!}
                                        </div>
                                      </div>
                                    </div>
                                  </div><br>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('latest_turnover','Latest Audited Turnover', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::text('latest_turnover',null,['class' => 'form-control', 'placeholder' => '(Rs In Lacs)']) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('purpose_of_loan','Purpose Of Loan', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::select('owner_purpose_of_loan',$purpose_of_loan, $chosenPurposeOfLoan, ['id' => 'owner_purpose_of_loan', 'class' => 'form-control', 'style' => 'width:100%;']) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('required_amount','Required Amount ', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::text('required_amount',null,['class' => 'form-control', 'placeholder' => '(Rs In Lacs)']) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group required">
                                        {!! Form::label('Nature_of_Business_Activity','Nature of Business Activity', ['class'=>'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                          {!! Form::select('Nature_of_Business_Activity',$natureOfBusinessActivity,$chosenEntityActivity, ['id' => 'Nature_of_Business_Activity','class' => 'form-control', 'style' => ' width: 100%;']) !!}
                                        </div>
                                      </div>
                                    </div>
                                  </div><br>
                                  <div class="row" style="margin-bottom: -5px;">
                                    <div class="col-md-12" style="margin-left:20px;   margin-bottom: 15px; margin-top: 5px;">
                                      <input data-toggle="modal" class="btn btn-success btn-cons sme_button" name="proceedNext" type="submit" value="Save" id="Save" style="margin-right: 10px;">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {!! Form::close() !!}
                      </div>
                      {!! Form::model($userProfile,['method' =>'POST','action' => 'Register\RegistrationWizardController@postAdvisor'] ) !!}
                      {!! Form::hidden('id',null) !!}
                      {!! Form::hidden('user_id',null) !!}
                      {!! Form::hidden('password','password') !!}
                      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      </div>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog" style="position: absolute;left: 35%;top: 35%;">--}}
          {{--<div class="modal-content">--}}
            {{--<div class="modal-body" style="text-align: center">--}}
              {{--<h4>Thank you for registering with us.<br>--}}
              {{--Your login credentials will be mailed on your registered email id.</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-footer" style="text-align: center">--}}
              {{--<div class="btn-group">--}}
                {{--<input class="btn btn-success btn-cons sme_button" name="proceedNext" type="submit" value="Yes" id="submit" style="margin-right: 10px;">--}}
                {{--<a href={{URL::to("/")}} class="btn btn-primary" name="proceedNext" value="yes" style="margin-right: 10px;">OK  <span class="glyphiconglyphicon-check"></span></a>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div><!-- /.modal-content -->--}}
        {{--</div><!-- /.modal-dalog -->--}}
      {{--</div><!-- /.modal -->--}}
      <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
      <script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#owner_entity_type').select2({
            allowClear: true,
            placeholder: "Select Entity Type"
          });
          $('#owner_city').select2({
            allowClear: true,
            placeholder: "Select City"
          });
          $('#owner_state').select2({
            allowClear: true,
            placeholder: "Select State"
          });
          $('#owner_entity_type_sme').select2({
            allowClear: true,
            placeholder: "Select Entity Type"
          });
          $('#Nature_of_Business_Activity').select2({
            allowClear: true,
            placeholder: "Select Business Activity"
          });
          $('#owner_city_sme').select2({
            allowClear: true,
            placeholder: "Select City"
          });
          $('#owner_state_sme').select2({
            allowClear: true,
            placeholder: "Select State"
          });
          $('#owner_purpose_of_loan').select2({
            allowClear: true,
            placeholder: "Select Purpose Of Loan"
          });
          $('#owner_purpose_of_loan_sme').select2({
            allowClear: true,
            placeholder: "Select Purpose Of Loan"
          });
          $('#sme_client').select2({
            allowClear: true,
            placeholder: "Select Option"
          });
          $('#end_use').select2({
            allowClear: true,
            placeholder: "Select End Use"
          });
          if(($("#owner_city").val() == 'Other')){
            $('#custom_cityName').collapse("show");
          }else{
            $('#custom_cityName').collapse("hide");
          }
          $("#owner_city").change(function () {
            if(($(this).val()) == 'Other'){
              $('#custom_cityName').collapse("show");
            }else{
              $('#custom_cityName').collapse("hide");
            }
          });
          if(($("#owner_city_sme").val() == 'Other')){
            $('#custom_cityNameSme').collapse("show");
          }else{
            $('#custom_cityNameSme').collapse("hide");
          }
          $("#owner_city_sme").change(function () {
            if(($(this).val()) == 'Other'){
              $('#custom_cityNameSme').collapse("show");
            }else{
              $('#custom_cityNameSme').collapse("hide");
            }
          });
          $("#sme_client").change(function () {
            if($(this).val() == '0') {
              $("#advisorownertab").collapse("hide");
            } else if($(this).val() == '1') {
              $("#advisorownertab").collapse("show");
            } else if($(this).val() == '2') {
              $("#advisorownertab").collapse("hide");
            }
          });
          $('[data-usertype="MSME "]').click( function () {
            $("#ownertab").collapse("show");
            $("#advisortab").collapse("hide");
            $(this).addClass('active');
            $(this).next().removeClass('active');
            $("#user_type").val('MSME ');
            goToByScroll("ownertab");
          });
          $('[data-usertype="Channel Partner "]').click( function () {
            $("#ownertab").collapse("hide");
            $("#advisortab").collapse("show");
            $(this).addClass('active');
            $(this).prev().removeClass('active');
            $("#user_type").val('Channel Partner ');
            goToByScroll("advisortab");
          });
        });
        $(function() {
          $('button').click(function() {
            var classname = $(this).attr('data-usertype');
          //                alert(classname);
          if(classname == 'Owner  ')
          {
            $('button.Channel Partner').attr('disabled', 'disabled');
            $('button.MSME').attr('disabled', false);
          }
          else
          {
            $('button.MSME').attr('disabled', 'disabled');
            $('button.Channel Partner').attr('disabled', false);
          }
        });
        });
        function goToByScroll(id){
        // Remove "link" from the ID
        id = id.replace("link", "");
        // Scroll
        $('html,body').animate({
          scrollTop: $("#"+id).offset().top},
          'slow');
      }
      @if (count($errors) > 0)
        //        alert($("#user_type").val())
        if($("#user_type").val() == 'MSME ') {
          $("#ownertab").collapse("show");
        }
        else {
          $("#advisortab").collapse("show");
        }
        @endif
      </script>
      @endsection