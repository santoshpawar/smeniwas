<?php
 

?>
<div class="row">
  <div class="card">
    <div class="card-header" data-background-color="green">
        <h3 class="title">Profile Details</h3>
      {{-- <p class="category">Apply new loan</p> --}}
  </div>
  <div class="card-content">
    <div class="col-md-12" id="divTab_sub">
         @include('errors')
        <div role="tabpanel">
            <div id="divTC-Div1">
                <div class="row">
                    <div class="panel panel-success ">
                        <div class="panel-heading"><label>User Registration Detailsssss</label></div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::hidden('id',null) !!}
                                    {!! Form::hidden('user_id',null) !!}
                                    {!! Form::label('name_of_firm','Name of Firm', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileAppFirm_Name))
                                        {!! Form::text('name_of_firm',$mobileAppFirm_Name,['class' => 'form-control','placeholder' => 'Name of Firm','data-mandatory'=>'M',$setDisable]) !!}
                                        @else
                                        {!! Form::text('name_of_firm',null,['class' => 'form-control','placeholder' => 'Name of Firm','data-mandatory'=>'M',$setDisable]) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('firm_pan','PAN  No of Firm', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileFirmPan))
                                        {!! Form::text('firm_pan',$mobileFirmPan,['class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                        @else
                                        {!! Form::text('firm_pan',$firm_pan,['class' => 'form-control','data-mandatory'=>'M',$setDisable]) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('entity_type','Type of Legal Entity', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileEntityType))
                                        {!! Form::select('owner_entity_type',$entityTypes,$mobileEntityType, ['id' => 'owner_entity_type','class' => 'form-control', 'style' => ' width: 260px;','data-mandatory'=>'M']) !!}
                                        @else
                                        {!! Form::select('owner_entity_type',$entityTypes,$chosenEntity, ['id' => 'owner_entity_type','class' => 'form-control', 'style' => ' width: 260px;','data-mandatory'=>'M']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('owner_name','Name of Owner/Director', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileOwnerName))
                                        {!! Form::text('owner_name',$mobileOwnerName,['class' => 'form-control','placeholder' => 'Name of Owner/Director','data-mandatory'=>'M']) !!}
                                        @else
                                        {!! Form::text('owner_name',null,['class' => 'form-control','placeholder' => 'Name of Owner/Director','data-mandatory'=>'M']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('owner_email','Owners Email id ', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileEmail))
                                        {!! Form::text('owner_email',$mobileEmail,['class' => 'form-control','placeholder'=>'Email id','data-mandatory'=>'M',$setDisable]) !!}
                                        @else
                                        {!! Form::text('owner_email',$owner_email,['class' => 'form-control','placeholder'=>'Email id','data-mandatory'=>'M',$setDisable]) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('address','Address', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileAddress))
                                        {!! Form::textarea('address',isset($mobileAddress)? $mobileAddress:null,array('class' => 'form-control','placeholder' => 'Address', 'size' => '40x1','data-mandatory'=>'M')) !!}
                                        @else
                                        {!! Form::textarea('address',isset($address)? $address:null,array('class' => 'form-control','placeholder' => 'Address', 'size' => '40x1','data-mandatory'=>'M')) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('owner_city','City', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileCity))
                                        {!! Form::select('owner_city',$cities,$mobileCity,['id' => 'owner_city', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M']) !!}
                                        @else
                                        {!! Form::select('owner_city',$cities,$chosenCity,['id' => 'owner_city', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M']) !!}
                                        @endif
                                    </div>
                                    <div class="col-md-12 collapse" id="custom_cityName">
                                        {!! Form::label('city','City Name') !!}
                                        {{--{!! Form::label(null,'*', ['class' => 'redmarks', 'style' => 'color: red;']) !!}--}}
                                        {!! Form::text('city_other', isset($userProfile->city_other) ? $userProfile->city_other : null, ['id'=>'custom_cityNamebox','class' =>'form-control','placeholder' => 'Enter City Name', 'size' => '5x5','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('owner_state','State', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileState))
                                        {!! Form::select('owner_state',$states,$mobileState,['id' => 'owner_state', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M']) !!}
                                        @else
                                        {!! Form::select('owner_state',$states,$chosenState,['id' => 'owner_state', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('pincode','Pincode', ['class'=>'control-label']) !!}
                                    <div class="col-md-12" style="padding-left: 0px;">
                                        @if(isset($mobilePincode))
                                        {!! Form::text('pincode',$mobilePincode,['class' => 'form-control amount', 'maxlength' => 6,'placeholder' => 'Pincode','data-mandatory'=>'M']) !!}
                                        @else
                                        {!! Form::text('pincode',null,['class' => 'form-control amount', 'maxlength' => 6,'placeholder' => 'Pincode','data-mandatory'=>'M']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('contact_numbers','Contact Numbers', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        <div class="col-md-6" style="padding-left: 0px;padding-right: 5px;">
                                            @if(isset($mobileContact))
                                            {!! Form::text('contact1',$mobileContact,['class' => 'form-control amount','placeholder' => 'No. 1', 'width' => '2x2', 'maxlength' => 10,'data-mandatory'=>'M']) !!}
                                            @else
                                            {!! Form::text('contact1',null,['class' => 'form-control amount','placeholder' => 'No. 1', 'width' => '2x2', 'maxlength' => 10,'data-mandatory'=>'M']) !!}
                                            @endif
                                        </div>
                                        <div class="col-md-6" style="padding-left: 0px;padding-right: 5px;">
                                            {!! Form::text('contact2',null,['class' => 'form-control amount','placeholder' => 'No. 2', 'width' => '2x2', 'maxlength' => 10]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('latest_turnover','Latest Audited Turnover (Rs. In Lacs)', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($mobileAuditedTurnover))
                                        {!! Form::text('latest_turnover',$mobileAuditedTurnover,['class' => 'form-control amount', 'placeholder' => 'Rs. In Lacs','data-mandatory'=>'M']) !!}
                                        @else
                                        {!! Form::text('latest_turnover',null,['class' => 'form-control amount', 'placeholder' => 'Rs. In Lacs','data-mandatory'=>'M']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group collapse">
                                    {!! Form::label('purpose_of_loan','Purpose Of Loan', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::select('owner_purpose_of_loan',$purpose_of_loan, $chosenPurposeOfLoan, ['id' => 'owner_purpose_of_loan', 'class' => 'form-control', 'style' => 'width:260px;','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group collapse">
                                    {!! Form::label('required_amount','Req. Amount (Rs. In Lacs)', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('required_amount',null,['class' => 'form-control amount','placeholder' => 'Rs. In Lacs','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: -5px;">
                            <div class="col-md-12" style="margin-left:20px;   margin-bottom: 10px;">
                                {!! Form::button('Back', array('id' => 'btnBackSME', 'class' => 'btn btn-success btn-cons sme_button','onclick' => 'location.href="../../home"')) !!}
                                {!! Form::submit('Save ', ['class' => 'btn btn-alert btn-cons sme_button','id'=>'saveDetails']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @section('footer')
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sme.css') }}" rel="stylesheet">
    <script src="{{asset('/js/select2.min.js') }}" type="text/javascript"></script>


    <script type="text/javascript">

        $('#owner_entity_type').select2({
            allowClear: true,
            placeholder: "Select Entity Type",
            width:'100%'
        });
        $('#owner_city').select2({
            allowClear: true,
            placeholder: "Select City"
        });
        $('#owner_state').select2({
            allowClear: true,
            placeholder: "Select State"
        });
        $('#owner_purpose_of_loan').select2({
            allowClear: true,
            placeholder: "Select Purpose Of Loan",
            width:'100%'
        });
        $('#sme_client').select2({
            allowClear: true,
            placeholder: "Select Option"
        });
        $('#user_type').select2({
            allowClear: true,
            placeholder: "Select Option"
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
        $(document).ready(function() {
            $('#saveDetails').click(function (e){
                if(validateForm('#divTab_sub')){
                    return true;
                }else{
                    e.preventDefault();
                }
            });
        });




    </script>
    @endsection

