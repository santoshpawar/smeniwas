

<div class="container-fluid">
   <div class="row">
       <div class="card">
           <div class="card-header" data-background-color="green">
               <h4 class="title">Profile and Loan Details <span class="pull-right">{{ $userProfile->name_of_firm }}</span></h4>
               {{--    <p class="category">Apply new loan</p> --}}
           </div>
           <div class="card-content">
            <div class="col-md-12 content">
                <div class="row">
                    <div class="panel panel-success ">
                        <div class="panel-heading"><label>User Details</label></div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::hidden('id',null) !!}
                                    {!! Form::hidden('user_id',null) !!}
                                    {!! Form::label('name_of_firm','Name of Firm', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('name_of_firm',$name_of_firm,['class' => 'form-control','readonly','placeholder' => 'Name of Firm','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('firm_pan','PAN  No of Firm', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('firm_pan',$firm_pan,['class' => 'form-control','readonly','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('entity_type','Type of Legal Entity', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('owner_entity_type',$chosenEntity, ['id' => 'owner_entity_type','readonly','class' => 'form-control','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('owner_name','Name of Owner/Director', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('owner_name',$owner_name,['class' => 'form-control','readonly','placeholder' => 'Name of Owner/Director','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('owner_email','Owners Email id ', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('owner_email',$owner_email,['class' => 'form-control','readonly','placeholder'=>'Email id','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('address','Address', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::textarea('address',isset($address)? $address:null,array('class' => 'form-control','readonly','placeholder' => 'Address', 'size' => '40x1','data-mandatory'=>'M')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('owner_city','City', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('owner_city',$chosenCity,['id' => 'owner_city','readonly', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('owner_state','State', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('owner_state',$chosenState,['id' => 'owner_state','readonly', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('pincode','Pincode', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('pincode',$pincode,['class' => 'form-control amount','readonly', 'maxlength' => 6,'placeholder' => 'Pincode','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-8">
                                <div class="form-group">
                                    {!! Form::label('contact_numbers','Contact Numbers', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        <div class="col-md-6" style="padding-left: 0px;width: 50%;">
                                            {!! Form::text('contact1',$contact1,['class' => 'form-control','readonly','placeholder' => 'No. 1', 'width' => '2x2', 'maxlength' => 10,'data-mandatory'=>'M']) !!}
                                        </div>
                                        <div class="col-md-6" style="padding-right: 10px;width: 50%;">
                                            {!! Form::text('contact2',$contact2,['class' => 'form-control','readonly','placeholder' => 'No. 2', 'width' => '2x2', 'maxlength' => 10]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('latest_turnover','Latest Audited Turnover (Rs. In Lacs)', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('latest_turnover',$latest_turnover,['class' => 'form-control amount','readonly', 'placeholder' => 'Rs. In Lacs','data-mandatory'=>'M']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                @if(isset($referredUserID))
                <div class="row">
                    <div class="panel panel-success ">
                        <div class="panel-heading" style="background-color: #ccc;"><label>Channel Partner Details</label></div><br>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('adv_name','Advisor Name', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('adv_name',$adv_name,['class' => 'form-control','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('adv_mobile','Advisors Mobile No. ', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('adv_mobile',$adv_mobile,['class' => 'form-control','readonly', 'maxlength' => 10]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('adv_email','Advisor Email Id', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('adv_email',$adv_email,['class' => 'form-control','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('adv_pan','Advisors PAN Number', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('adv_pan',$adv_pan,['class' => 'form-control','readonly', 'maxlength' => 10]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <br>
                <div class="row">
                    <div class="panel panel-success ">
                        <div class="panel-heading" style="background-color: #ccc;"><label>Loan Details</label></div><br>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('end_use','End Use:',['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($endUseList))
                                        {!! Form::text('end_use',App\Helpers\FormatHelper::formatEndUseList($endUseList), ['id' => 'end_use','readonly', 'class' => 'form-control']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('loan_product','Loan Product:', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        @if(isset($loanType))
                                        {!! Form::text('loan_product',App\Helpers\FormatHelper::formatLoanType($loanType), ['id' => 'loan_product','readonly', 'class' => 'form-control']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('amount','Amount (Rs Lacs):', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('amount', $amount, ['id' => 'amount','readonly', 'class' => 'form-control amount','placeholder' => 'Amount (Rs Lacs)']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('loan_tenure','Tenor in Years:', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('loan_tenure', $loanTenure, ['id' => 'loan_tenure','readonly', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                          <div class="row">
                      <div class="col-md-12" style="margin-left:20px;">
                        <div id="currentSection">
                         
                           <a href="{{ URL::previous() }}" class="btn btn-alert btn-cons sme_button">Next</a>
                        </div>
                    </div>
                </div>




                        </div>
                        @if(isset($referredUserID))
                        <div class="row" style="margin-left: 10px; margin-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('adv_name','Channel Partner Reference', ['class'=>'control-label', 'style' => 'margin-left: 15px;']) !!}
                                    <div class="col-md-12">
                                        {!! Form::text('adv_name',$adv_name,['class' => 'form-control','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>



<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/sme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">


</script>

