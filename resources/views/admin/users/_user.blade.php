<div id="manageUser" class="hidediv">
    <div role="tabpanel" class="tab-pane active" id="registration">

        <div class="form-group">
            {!! $errors->first('roles','<span class="help-block">:message</span>') !!}
            {!! Form::label('roles','Roles') !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::select('roles[]',$roles, $userRoles, ['id' => 'roles', 'class' => 'form-control','multiple' =>
            'multiple', 'onchange'=>'check_dd();','data-mandatory'=>'M']) !!}
        </div>

        @if(isset($chosenBankName) && $chosenBankName != NULL)
        <div id="bankName" class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
            {!! $errors->first('bank_id','<span class="help-block">:message</span>') !!}
            {!! Form::label('bank_id','Bank Name') !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            <br>
            {!! Form::select('bank_id',$bankName, $chosenBankName, ['id' => 'bank_names', 'class' => 'form-control',
            'style' => 'width:100%','data-mandatory'=>'M']) !!}
        </div>
        @else
        <div id="bankName" class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}" style="display:none;">
            {!! $errors->first('bank_id','<span class="help-block">:message</span>') !!}
            {!! Form::label('bank_id','Bank Name') !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            <br>
            {!! Form::select('bank_id',$bankName, $chosenBankName, ['id' => 'bank_name', 'class' => 'form-control',
            'style' => 'width:100%','data-mandatory'=>'M']) !!}
        </div>
        @endif

        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
            {!! Form::hidden('id',null) !!}
            {!! $errors->first('username','<span class="help-block">:message</span>') !!}
            {!! Form::label('username','User ID ', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::text('username',null,['class' => 'form-control','data-mandatory'=>'M']) !!}
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! $errors->first('email','<span class="help-block">:message</span>') !!}
            {!! Form::label('email','Email', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::email('email',null,['class' => 'form-control','data-mandatory'=>'M']) !!}
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
            {!! Form::label('password','Password', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::input('password', 'password',null,['class' => 'form-control']) !!}
            {!! Form::label('password_confirmation','Confirm Password', ['class' => '']) !!}
            {!! Form::label(null,$removeMandatory, ['style' => ' color: red;']) !!}
            {!! Form::input('password', 'password_confirmation',null,['class' => 'form-control']) !!}
        </div>

        <div class="center-align"></div>

        <div class="row">
            {!! Form::button('Save <i class="fa fa-floppy-o"></i>', array('class' => 'btn btn-success btn-cons
            sme_button','style' => 'margin-top:20px;margin-left:20px;','type'=>'submit' )) !!}
            <a href="{{URL::to("/admin/users")}}" class="btn btn-success btn-cons sme_button"
               style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
        </div>
    </div>
    {{--<div class="form-group">--}}
    {{--{!! Form::submit('Save & Continue', ['class' => 'inputBtn btn']) !!}--}}
    {{--</div>--}}
</div>
<!--##########################  user profile Tab ##########################-->
<div id="userProfile" class="hidediv" style="display: none">
    <div role="tabpanel" class="tab-pane active" >

        <div class="form-group">                
            <div class="col-md-12">
                <div class="form-group">                      
                    {!! Form::label('name_of_firm','Name of Firm ', ['class' => '']) !!}
                    {!! Form::text('name_of_firm' ,isset($userProfile->name_of_firm)? $userProfile->name_of_firm:null,['class' => 'form-control','readonly'=>'readonly','placeholder' => 'Name of Firm']) !!}                        
                </div>                
                <div class="form-group">                      
                    {!! Form::label('firm_pan','PAN  No of Firm', ['class' => '']) !!}
                    {!! Form::text('firm_pan',isset($user->username)? $user->username:null,['class' => 'form-control','readonly'=>'readonly']) !!}                     
                </div>

                <div class="form-group">                      
                    {!! Form::label('owner_entity_type','Type of Legal Entity', ['class' => '']) !!}
                    {!! Form::text('owner_entity_type',isset($userProfile->owner_entity_type)? $userProfile->owner_entity_type:null,['class' => 'form-control','readonly'=>'readonly']) !!}                     
                </div>

                <div class="form-group">                      
                    {!! Form::label('owner_name','Name of Owner/Director', ['class' => '']) !!}
                    {!! Form::text('owner_name',isset($userProfile->owner_name)? $userProfile->owner_name:null,['class' => 'form-control','readonly'=>'readonly']) !!}                     
                </div>

                <div class="form-group">                      
                    {!! Form::label('address','Address', ['class' => '']) !!}
                    {!! Form::textarea('address',isset($userProfile->address)? $userProfile->address:null,array('class' => 'form-control','placeholder' => 'Address','readonly'=>'readonly', 'size' => '40x1')) !!}                   
                </div>

                <div class="form-group">                      
                    {!! Form::label('owner_city','City', ['class' => '']) !!}
                    {!! Form::text('owner_city',isset($userProfile->owner_city)? $userProfile->owner_city:null,['readonly'=>'readonly','class' => 'form-control']) !!}                     
                </div>

                <div class="form-group">                      
                    {!! Form::label('owner_state','State', ['class' => '']) !!}
                    {!! Form::text('owner_state',isset($userProfile->owner_state)? $userProfile->owner_state:null,['readonly'=>'readonly','class' => 'form-control']) !!}                     
                </div>
                <div class="form-group">                      
                    {!! Form::label('pincode','Pin code', ['class' => '']) !!}
                    {!! Form::text('pincode',isset($userProfile->pincode)? $userProfile->pincode:null,['class' => 'form-control amount','readonly'=>'readonly', 'maxlength' => 10,'placeholder' => 'Pincode']) !!}                 
                </div>

                <div class="form-group">    

                    <div class="col-md-12" style="padding-left: 0;"  >
                        {!! Form::label('contact1','Contact Numbers', ['class' => '']) !!}
                    </div>
                    <div class="col-md-6" style="padding-left: 0;">
                        <div class="form-group"> 
                            {!! Form::text('contact1',isset($userProfile->contact1)? $userProfile->contact1:null,['class' => 'form-control amount','readonly'=>'readonly', 'maxlength' => 10,'placeholder' => 'NO 1']) !!}    
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left: 0;">
                        <div class="form-group"> 
                            {!! Form::text('contact1',isset($userProfile->contact1)? $userProfile->contact1:null,['class' => 'form-control amount','readonly'=>'readonly', 'maxlength' => 10,'placeholder' => 'NO 1']) !!}    
                        </div>
                    </div>
                </div>

                <div class="form-group">                      
                    {!! Form::label('latest_turnover','Latest Audited Turnover (Rs. In Lacs)', ['class' => '']) !!}
                    {!! Form::text('latest_turnover',isset($userProfile->latest_turnover)? $userProfile->latest_turnover:null,['class' => 'form-control amount','readonly'=>'readonly', 'maxlength' => 10,'placeholder' => 'Pincode']) !!}                 
                </div>
                <div class="row">                   
                    <a href="{{URL::to("/admin/users")}}" class="btn btn-success btn-cons sme_button"
                       style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
                </div>

            </div>
        </div>


    </div>

</div>
<!--##########################  user Mobile Data Tab ##########################-->
<div id="mobileData" class="hidediv" style="display: none">
    <div role="tabpanel" class="tab-pane active" >
        
        @if(isset($mobileAppEmail))
        @if(count($mobileAppEmail)>0)
        <div class="form-group">
            @if(isset($mobileAppEmail->status) && $mobileAppEmail->status == '1')
                <div class="col-md-12">
                    {!! Form::label('contact1','This application form is applied for loan.', ['class' => '', 'style' => 'margin-left: 10px;font-size: 18px;']) !!}
                    <br>
                </div>
            @endif

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('Firm_Name','Name of Firm ', ['class' => '']) !!}
                    {!! Form::text('Firm_Name' ,isset($mobileAppEmail->Firm_Name)? $mobileAppEmail->Firm_Name:null,['class' => 'form-control','readonly'=>'readonly','placeholder' => 'Name of Firm']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('EntityType','Type of Legal Entity', ['class' => '']) !!}
                    {!! Form::text('EntityType' ,isset($mobileAppEmail->EntityType)? $mobileAppEmail->EntityType:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('BusinessType','Type of Business', ['class' => '']) !!}
                    {!! Form::text('BusinessType' ,isset($mobileAppEmail->BusinessType)? $mobileAppEmail->BusinessType:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('KeyProduct','Key Product of Business', ['class' => '']) !!}
                    {!! Form::text('KeyProduct' ,isset($mobileAppEmail->KeyProduct)? $mobileAppEmail->KeyProduct:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('AuditedTurnover','Audited Turnover of Business', ['class' => '']) !!}
                    {!! Form::text('AuditedTurnover' ,isset($mobileAppEmail->AuditedTurnover)? $mobileAppEmail->AuditedTurnover.' Lacs':null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('FirmPan','PAN  No of Firm', ['class' => '']) !!}
                    {!! Form::text('FirmPan' ,isset($mobileAppEmail->FirmPan)? $mobileAppEmail->FirmPan:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('FirmRegNo','Firm Reg. No', ['class' => '']) !!}
                    {!! Form::text('FirmRegNo' ,isset($mobileAppEmail->FirmRegNo)? $mobileAppEmail->FirmRegNo:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('OwnerName','Owner Name', ['class' => '']) !!}
                    {!! Form::text('OwnerName' ,isset($mobileAppEmail->OwnerName)? $mobileAppEmail->OwnerName:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('Email','Firm Email', ['class' => '']) !!}
                    {!! Form::text('Email' ,isset($mobileAppEmail->Email)? $mobileAppEmail->Email:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('Address','Address', ['class' => '']) !!}
                    {!! Form::textarea('Address',isset($mobileAppEmail->Address)? $mobileAppEmail->Address:null,array('class' => 'form-control','readonly'=>'readonly','placeholder' => 'Address', 'size' => '40x1')) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('City','City', ['class' => '']) !!}
                    {!! Form::text('City' ,isset($mobileAppEmail->City)? $mobileAppEmail->City:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('State','State', ['class' => '']) !!}
                    {!! Form::text('State' ,isset($mobileAppEmail->State)? $mobileAppEmail->State:null,['readonly'=>'readonly','class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('Pincode','Pin Code', ['class' => '']) !!}
                    {!! Form::text('Pincode',isset($mobileAppEmail->Pincode)? $mobileAppEmail->Pincode:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Pincode']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('Contact','Contact No.', ['class' => '']) !!}
                    {!! Form::text('Contact',isset($mobileAppEmail->Contact)? $mobileAppEmail->Contact:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Contact No.']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('CibilScore','Cibil Score', ['class' => '']) !!}
                    {!! Form::text('CibilScore',isset($mobileAppEmail->CibilScore)? $mobileAppEmail->CibilScore:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Cibil Score']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('LenderName','Lender Name', ['class' => '']) !!}
                    {!! Form::text('LenderName',isset($mobileAppEmail->LenderName)? $mobileAppEmail->LenderName:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Lender Name']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('OutstandingAmt','Outstanding Amount', ['class' => '']) !!}
                    {!! Form::text('OutstandingAmt',isset($mobileAppEmail->OutstandingAmt)? $mobileAppEmail->OutstandingAmt.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Outstanding Amount']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('MonthlyEmi','Monthly Emi', ['class' => '']) !!}
                    {!! Form::text('MonthlyEmi',isset($mobileAppEmail->MonthlyEmi)? $mobileAppEmail->MonthlyEmi.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Monthly Emi']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('Liability','Liability', ['class' => '']) !!}
                    {!! Form::text('Liability',isset($mobileAppEmail->Liability)? $mobileAppEmail->Liability.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Liability']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('Degree','Degree', ['class' => '']) !!}
                    {!! Form::text('Degree',isset($mobileAppEmail->Degree)? $mobileAppEmail->Degree:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Degree']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('PromoType','Promoter Type', ['class' => '']) !!}
                    {!! Form::text('PromoType',isset($mobileAppEmail->PromoType)? $mobileAppEmail->PromoType:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Promoter Type']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('Independent','Number of independent families involved in business', ['class' => '']) !!}
                    {!! Form::text('Independent',isset($mobileAppEmail->Independent)? $mobileAppEmail->Independent:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Families involved in business']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('OwnedVehicle','Vehicles Owned', ['class' => '']) !!}
                    {!! Form::text('OwnedVehicle',isset($mobileAppEmail->OwnedVehicle)? $mobileAppEmail->OwnedVehicle:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Vehicles Owned']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('MarketValue','Vehicles Market Value', ['class' => '']) !!}
                    {!! Form::text('MarketValue',isset($mobileAppEmail->MarketValue)? $mobileAppEmail->MarketValue.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Vehicles Market Value']) !!}
                </div>
            </div>


            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('OwnedProperty','Properties Owned', ['class' => '']) !!}
                    {!! Form::text('OwnedProperty',isset($mobileAppEmail->OwnedProperty)? $mobileAppEmail->OwnedProperty:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Properties Owned']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('CustomerNature','Customer Nature', ['class' => '']) !!}
                    {!! Form::text('CustomerNature',isset($mobileAppEmail->CustomerNature)? $mobileAppEmail->CustomerNature:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer Nature']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('OfficePremiseOwned','Office Premise Owned', ['class' => '']) !!}
                    {!! Form::text('OfficePremiseOwned',isset($mobileAppEmail->OfficePremiseOwned)? $mobileAppEmail->OfficePremiseOwned.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Office Premise Owned']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('OfficePremiseRented','Office Premise Rented', ['class' => '']) !!}
                    {!! Form::text('OfficePremiseRented',isset($mobileAppEmail->OfficePremiseRented)? $mobileAppEmail->OfficePremiseRented.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Office Premise Rented']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('ManufacturePremise','Manufacture Premise', ['class' => '']) !!}
                    {!! Form::text('ManufacturePremise',isset($mobileAppEmail->ManufacturePremise)? $mobileAppEmail->ManufacturePremise.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Manufacture Premise']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('BankName','Major Loans Of Business - Bank Name', ['class' => '']) !!}
                    {!! Form::text('BankName',isset($mobileAppEmail->BankName)? $mobileAppEmail->BankName:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Bank name']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('Amount','Major Loans Of Business - Amount', ['class' => '']) !!}
                    {!! Form::text('Amount',isset($mobileAppEmail->Amount)? $mobileAppEmail->Amount.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Amount']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <br>
                {!! Form::label('contact1','Customers With Sales Amount', ['class' => '', 'style' => 'margin-left: 14px;font-size: 15px;']) !!}
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('cust1','Customer 1 Name', ['class' => '']) !!}
                    {!! Form::text('cust1',isset($mobileAppEmail->cust1)? $mobileAppEmail->cust1:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 1 Name']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('sale1','Customer 1 Annual Sales Amount', ['class' => '']) !!}
                    {!! Form::text('sale1',isset($mobileAppEmail->sale1)? $mobileAppEmail->sale1.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 1 Sales Amount']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('year1','Customer 1 Relationship Since (Year)', ['class' => '']) !!}
                    {!! Form::text('year1',isset($mobileAppEmail->year1)? $mobileAppEmail->year1:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 1 Name Relationship Year']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('cust2','Customer 2 Name', ['class' => '']) !!}
                    {!! Form::text('cust2',isset($mobileAppEmail->cust2)? $mobileAppEmail->cust2:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 2 Name']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('sale2','Customer 2 Annual Sales Amount', ['class' => '']) !!}
                    {!! Form::text('sale2',isset($mobileAppEmail->sale2)? $mobileAppEmail->sale2.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 2 Amount']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('year2','Customer 2 Relationship Since (Year)', ['class' => '']) !!}
                    {!! Form::text('year2',isset($mobileAppEmail->year2)? $mobileAppEmail->year2:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 2 Relationship Year']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('cust3','Customer 3 Name', ['class' => '']) !!}
                    {!! Form::text('cust3',isset($mobileAppEmail->cust3)? $mobileAppEmail->cust3:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 3 Name']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('sale3','Customer 3 Annual Sales Amount', ['class' => '']) !!}
                    {!! Form::text('sale3',isset($mobileAppEmail->sale3)? $mobileAppEmail->sale3.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 3 Amount']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('year3','Customer 3 Relationship Since (Year)', ['class' => '']) !!}
                    {!! Form::text('year3',isset($mobileAppEmail->year3)? $mobileAppEmail->year3:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Customer 3 Relationship Year']) !!}
                </div>
            </div>
            <div class="col-md-12" style="padding-left: 0;">
                <br>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    {!! Form::label('CashSales','Cash Sales', ['class' => '']) !!}
                    {!! Form::text('CashSales',isset($mobileAppEmail->CashSales)? $mobileAppEmail->CashSales:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Cash Sales']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('LoanPurpose','Purpose Of Loan', ['class' => '']) !!}
                    {!! Form::text('LoanPurpose',isset($mobileAppEmail->LoanPurpose)? $mobileAppEmail->LoanPurpose:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Purpose Of Loan']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::label('ReqAmt','Required Amount', ['class' => '']) !!}
                    {!! Form::text('ReqAmt',isset($mobileAppEmail->ReqAmt)? $mobileAppEmail->ReqAmt.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Required Amount']) !!}
                </div>
            </div>
            @if(isset($mobileAppEmail->PropType))
                <div class="col-md-12">
                    <div class="col-md-4">
                        {!! Form::label('PropType','Type of collateral offered', ['class' => '']) !!}
                        {!! Form::text('PropType',isset($mobileAppEmail->PropType)? $mobileAppEmail->PropType:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Type of collateral offered']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('ColAddress','Collateral Address', ['class' => '']) !!}
                        {!! Form::text('ColAddress',isset($mobileAppEmail->ColAddress)? $mobileAppEmail->ColAddress:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Collateral Address']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('ColCity','Collateral City', ['class' => '']) !!}
                        {!! Form::text('ColCity',isset($mobileAppEmail->ColCity)? $mobileAppEmail->ColCity:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Collateral City']) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        {!! Form::label('ColPincode','Collateral Pincode', ['class' => '']) !!}
                        {!! Form::text('ColPincode',isset($mobileAppEmail->ColPincode)? $mobileAppEmail->ColPincode:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Collateral Pincode']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('LatestVal','Collateral Latest Value', ['class' => '']) !!}
                        {!! Form::text('LatestVal',isset($mobileAppEmail->LatestVal)? $mobileAppEmail->LatestVal.' Lacs':null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Collateral Latest Value']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('CollateralType','Collateral Type', ['class' => '']) !!}
                        {!! Form::text('CollateralType',isset($mobileAppEmail->CollateralType)? $mobileAppEmail->CollateralType:null,['readonly'=>'readonly','class' => 'form-control amount', 'maxlength' => 10,'placeholder' => 'Collateral Type']) !!}
                    </div>
                </div>
            @else
            @endif

                {{--<div class="col-sm-12 col-lg-6">--}}
                    {{--{!! Form::label(null,'PAN Card') !!}--}}

                    {{--@if(isset($pancard_file))--}}
                        {{--<a href='{{ $pancard_file }}' class="btn">Download File</a>--}}
                    {{--@endif--}}
                {{--</div>--}}

            <div class="row">
                <a href="{{URL::to("/admin/users")}}" class="btn btn-success btn-cons sme_button"
                   style="margin-top:20px;margin-left:20px;"><i class="fa fa-sign-out"></i>Exit</a>
            </div>

        </div>
        @endif
        @endif

    </div>

</div>




 
<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
<script>
        $(document).ready(function () {
$('#roles').select2({
allowClear: true,
        placeholder: "Select Role"
});
//            $("#bank_name").select2().select2("val", null);
        $('#bank_name').select2({
allowClear: true,
        placeholder: "Select Bank Name"
});
        $('#bank_names').select2({
allowClear: true,
        placeholder: "Select Bank Name"
});
});
{{--var currentUserRole = "{{ $userRoles }}"; --}}
{{--if (currentUserRole != null || currentUserRole != '')--}}
{{--{--}}
{{--$('#bank_name').select2({--}}
{{--allowClear: true, --}}
{{--placeholder: "Select Bank Name"--}}
{{--}); --}}
{{--}--}}
{{-- else--}}
{{--{--}}
{{--$("#bank_name").select2().select2("val", null); --}}
{{--$('#bank_name').select2({--}}
{{--allowClear: true, --}}
{{--placeholder: "Select Bank Name"--}}
{{--}); --}}
{{--}--}}

//                $('#roles').change(function() {
//                    var x = document.getElementById("roles");
//                    var optionVal = new Array();
//                    for (var i = 0; i < x.length; i++) {
//                        if (x.options[ i ].selected)
//                        optionVal.push(x.options[i].value);
//                    }//                    alert(optionVal)
////                    alert(optionVal.indexOf('6'));
//
//                })

function check_dd() {
var x = document.getElementById("roles");
        var optionVal = new Array();
        for (var i = 0; i < x.length; i++) {
if (x.options[i].selected) {
optionVal.push(x.options[i].value);
}
}
if (optionVal.indexOf('6') >= 0) {
document.getElementById('bankName').style.display = 'block';
} else {
document.getElementById('bankName').style.display = 'none';
}
}

@if (count($errors) > 0)
        var x = document.getElementById("roles");
        var optionVal = new Array();
        for (var i = 0; i < x.length; i++) {
if (x.options[i].selected) {
optionVal.push(x.options[i].value);
}
}
if (optionVal.indexOf('6') >= 0) {
document.getElementById('bankName').style.display = 'block';
} else {
document.getElementById('bankName').style.display = 'none';
}
@endif

        @if (isset($user))
        @foreach($userRoles as $value)
        @if ($value == '6')
        document.getElementById('bankName').style.display = 'block';
        @endif
        @endforeach
        @endif




///############################## tab function ##################################
        $('.leftside_tab a').click(function () {

$('.leftside_tab a').removeClass("active");
        $(this).addClass("active");
        var slider = $(this).data('id');
        $('.hidediv').hide();
        $("#" + slider).show();
        // $("#" + slider).animate({width: 'toggle'}, 1000);
        //                   $("#"+slider).show( "blind", 1000 );

});
</script>
 