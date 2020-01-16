<div class="col-md-10">
    <div class="tab-content tab-design" style="padding-top:20px;">

            <div class="btn-group leftside_tab" data-toggle="tab" style="margin-left:10px;">
                <a id="lnkLoanDtls1" href="#" class="btn btn-large btn-success btn-space active" style="font-size: 14px !important;">Company KYC & Financials</a>
                <a id="lnkLoanDtls2" href="#" class="btn btn-large btn-success btn-space {{{ $user->isAnalyst() ? '' : 'disabled'}}}" style="font-size: 14px !important;">Promotor KYC & Financials</a>
                <a id="lnkLoanDtls3" href="#" class="btn btn-large btn-success btn-space {{{ $user->isAnalyst() ? '' : 'disabled'}}}" style="font-size: 14px !important;">Business/Contracts</a>
                <a id="lnkLoanDtls4" href="#" class="btn btn-large btn-success btn-space {{{ $user->isAnalyst() ? '' : 'disabled'}}}" style="font-size: 14px !important;">Security Documents</a>
            </div>


        <div id="divTab_sub1" class="collapse" style="margin-left:25px;margin-right:25px;">
            <br><br>
            <!-- start F1.1 -->
            @if($deletedQuestionHelper->isQuestionValid("F1.1"))
                <div id="yearQue37" class="form-group">
                    <div id="finreports" class="panel panel-success">
                        <div class="panel-heading">Financials Reports/Balance Sheets</div>

                        <div style="padding: 10px;">
                            <div class="row">
                                <?php $i = 0; ?>
                                @foreach($bl_year as $blyear)
                                    <?php $i++; ?>
                                    @if($i <= 2)
                                    <div class="col-sm-12 col-lg-4">
                                        {!! Form::label('blpl_file', $blyear) !!}
                                        @if($i<=1)
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::file('finyear_file'.$i.'_path', ['class' => 'form-control upload_details','id'=>'blplfile_'.$i ,'data-mandatory'=>''.$mandatoryField.'' ,$setDisable] ) !!}
                                        @else
                                            {!! Form::file('finyear_file'.$i.'_path', ['class' => 'form-control upload_details','id'=>'blplfile_'.$i ,$setDisable] ) !!}
                                        @endif
                                        {!! Form::hidden('fin_year_'.$i, 0, array('id' => 'fin_year_'.$i)) !!}
                                        @if(isset($blplfile['finyear_file'.$i.'_path']))
                                            <a href='{{ $blplfile['finyear_file'.$i.'_path'] }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- end F1.1 -->
            <div id="yearQue37" class="form-group">
                <!-- start F1.2 -->
                @if($deletedQuestionHelper->isQuestionValid("F1.2"))
                    @for($formindex=1; $formindex < $max_cmpny_bank_stmt; $formindex++)
                        @if($formindex == 1)
                            <div id="bnkst_<?php echo $formindex ?>" class="panel panel-success">
                                <div class="panel-heading">Bank Statement</div>
                        @else
                            <div id="bnkst_<?php echo $formindex ?>" class="panel panel-success collapse">
                                <div class="panel-heading">Bank Statement -  {{$formindex}}</div>
                        @endif
                            <div style="padding: 10px;">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        @if(isset($model['bank_name'.$formindex]))
                                            {!! Form::label('','Name of Bank') !!}
                                            {!! Form::text('bank_name'.$formindex, $model['bank_name'.$formindex], ['class' => 'form-control', 'size' => '5x5',$setDisable]) !!}
                                        @else
                                            {!! Form::label('','Name of Bank') !!}
                                            {!! Form::text('bank_name'.$formindex, null, ['class' => 'form-control', 'size' => '5x5',$setDisable]) !!}
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        @if(isset($model['bank_period'.$formindex]))
                                            {!! Form::label('','Period for Month/Year') !!}
                                            {!! Form::text('bank_period'.$formindex, $model['bank_period'.$formindex], ['class' => 'form-control', 'size' => '5x5',$setDisable]) !!}
                                        @else
                                            {!! Form::label('','Period for Month/Year') !!}
                                            {!! Form::text('bank_period'.$formindex, null, ['class' => 'form-control', 'size' => '5x5',$setDisable]) !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label('','Upload File') !!}
                                        {!! Form::file('bank_file'.$formindex.'_path', ['class' => 'form-control upload_details','id'=>'bank_file'.$formindex.'_path',$setDisable] ) !!}

                                        @if(isset($cmpnybankstmt_file['bank_file'.$formindex.'_path']))
                                            <a href='{{ $cmpnybankstmt_file['bank_file'.$formindex.'_path'] }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor

                        <div class="form-group">
                            {!! Form::button('Add Bank', ['class' => 'btn btn-primary add_promo_button', 'id' =>'add_tab1_kyc','style' =>'  margin-left: 14px;']) !!}
                            {!! Form::button('Delete', ['class' => 'btn btn-warning rem_promo_button collapse','id' => 'rem_tab1_kyc']) !!}
                            {!! Form::hidden('num_bank', 1, array('id' => 'num_bank')) !!}
                        </div>
                    </div>

                    <div id="yearQue37" class="form-group">
                        <div id="cibil" class="panel panel-success">
                            <div class="panel-heading">CIBIL Report</div>

                            <div style="padding: 10px;">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <div id="Que41" class="">
                                            {!! Form::label('AssetsFA', 'CIBIL report (optional)') !!}
                                            {!! Form::file('cibilreport_file_path', ['class' => 'form-control upload_details',
                                            'id'=>'cibilreport_file',$setDisable]) !!}
                                        </div>
                                        @if(isset($cibilreport_file))
                                            <a href='{{ $cibilreport_file }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                <!-- end F1.2 -->

                <!-- start F1.3 -->
                @if($deletedQuestionHelper->isQuestionValid("F1.3"))
                    <div id="yearQue37" class="form-group">
                        <div id="kycdetails" class="panel panel-success">
                            <div class="panel-heading">KYC Details</div>
                            <div style="padding: 10px;">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label(null,'PAN Card') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                        {!! Form::file('kycDetails[1][pancard_file_path]', ['class' => 'form-control upload_details',
                                        'id'=>'pancard_file','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}

                                        {!! Form::hidden('pan_card_check1', 0, array('id' => 'pan_card_check1')) !!}

                                        @if(isset($pancard_file))
                                            <a href='{{ $pancard_file }}' class="btn">Download File</a>

                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label(null,'VAT Registration Certificate') !!}
                                        {!! Form::file('kycDetails[1][vatreg_file_path]', ['class' => 'form-control
                                        upload_details', 'id'=>'vatregistration_file',$setDisable]) !!}
                                        @if(isset($vatregistration_file))
                                            <a href='{{ $vatregistration_file }}' class="btn">Download File</a>

                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label(null,'Shop and Establishment Certificate') !!}
                                        {!! Form::file('kycDetails[1][shopestablish_file_path]', ['class' => 'form-control upload_details',
                                        'id'=>'shopestablish_file',$setDisable]) !!}
                                        @if(isset($shopestablish_file))
                                            <a href='{{ $shopestablish_file }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label(null,'Address Proof of Company Business') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                        {!! Form::file('kycDetails[1][addproof_file_path]', ['class' => 'form-control
                                        upload_details', 'id'=>'addressproof_company_file','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}

                                        {!! Form::hidden('addressproof_company_file_check', 0, array('id' => 'addressproof_company_file_check')) !!}

                                        @if(isset($addressproof_company_file))
                                            <a href='{{ $addressproof_company_file }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label(null,'KYC Details Extra field 1') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => 'color: red;']) !!}
                                        {!! Form::file('kycDetails[1][kyc_extra_file1_path]', ['class' => 'form-control upload_details',
                                        'id'=>'optional_file1','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}

                                        {!! Form::hidden('optional_file1_check', 0, array('id' => 'optional_file1_check')) !!}

                                        @if(isset($optional_file1))
                                            <a href='{{ $optional_file1 }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label(null,'KYC Details Extra field 2') !!}
                                        {!! Form::file('kycDetails[1][kyc_extra_file2_path]', ['class' => 'form-control upload_details',
                                        'id'=>'optional_file2',$setDisable]) !!}
                                        @if(isset($optional_file2))
                                            <a href='{{ $optional_file2 }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- end F1.3 -->
                </div>


                <div id="divTab_sub2" class="collapse" style="margin-left:25px;margin-right:25px;">
                    <br><br>
                    <!-- start F2.1 -->
                    @if($deletedQuestionHelper->isQuestionValid("F2.1"))
                        <div id="yearQue37" class="form-group">
                            <div id="bankstmt" class="panel panel-success">
                                <div class="panel-heading">Bank Statement</div>

                                <div style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            @if($loanType == 'UBL')
                                            <div id="Que39" class="">
                                                {!! Form::label('AssetsFA', 'Bank Statements') !!}
                                                {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                {!! Form::file('prom_bank_stmt_file_path', ['class' => 'form-control
                                                upload_details','id'=>'bankstatement_file',$setDisable]) !!}
                                            </div>
                                             @else
                                                <div id="Que39" class="">
                                                    {!! Form::label('AssetsFA', 'Bank Statements') !!}
                                                    {!! Form::file('prom_bank_stmt_file_path', ['class' => 'form-control
                                                    upload_details','id'=>'bankstatement_file',$setDisable]) !!}
                                                </div>
                                            @endif
                                            @if(isset($bankstatement_file))
                                                    <a href='{{ $bankstatement_file }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end F2.1 -->
                    @endif

                    <!-- start F2.2 -->
                    @if($deletedQuestionHelper->isQuestionValid("F2.2"))
                        <div id="yearQue37" class="form-group">
                            <div id="financials" class="panel panel-success">
                                <div class="panel-heading">Financials</div>
                                <div style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label('AssetsFA', 'Networth Certificate') !!}
                                            {!! Form::file('prom_networth_file_path', ['class' => 'form-control upload_details','id'=>'promoternetworth_file',$setDisable]) !!}

                                            {!! Form::hidden('networth_file_check', 0, array('id' => 'networth_file_check')) !!}
                                            @if(isset($promoternetworth_file))
                                                    <a href='{{ $promoternetworth_file }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label('AssetsFA', 'CIBIL report (optional)') !!}
                                            {!! Form::file('prom_cibilreport_file_path', ['class' => 'form-control upload_details','id'=>'promoter_cibilreport_file',$setDisable]) !!}
                                            @if(isset($promoter_cibilreport_file))
                                                <a href='{{ $promoter_cibilreport_file }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- end F2.2 -->

                    <!-- start F2.3 -->
                    @if($deletedQuestionHelper->isQuestionValid("F2.3"))
                        <div id="yearQue37" class="form-group">
                            <div id="kycdetailspr" class="panel panel-success">
                                <div class="panel-heading">KYC Details</div>
                                <div style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label(null,'Address Proof') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::select('prom_kyc_addproof_name', array('' => 'Please select','Electricity Bill' =>
                                            'Electricity Bill', 'Aadhar Card' => 'Aadhar Card', 'Ration Card' => 'Ration Card','Passport' => 'Passport'), $model['prom_kyc_addproof_name'],
                                            ['id' => 'promoter_proof_address', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label(null,'') !!}
                                            {!! Form::file('prom_kyc_addproof_file_path', ['class' => 'form-control upload_details',
                                            'id'=>'promoter_proof_address_file','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}

                                            {!! Form::hidden('prom_kyc_addproof_file_path_check', 0, array('id' => 'prom_kyc_addproof_file_path_check')) !!}

                                            @if(isset($promoter_proof_address_file))
                                                <a href='{{ $promoter_proof_address_file }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label(null,'Identity Proof') !!}
                                            {!! Form::select('prom_idproof_name', array('' => 'Please select','Passport' =>
                                            'Passport', 'Driving License' => 'Driving License', 'Election Card' => 'Election Card','PAN' => 'PAN'), $model['prom_idproof_name'], ['id' =>
                                            'promoter_identity_proof', 'class' => 'form-control', 'style' => 'width: 100%;','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}
                                        </div>

                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label('AssetsFA', 'Identity Proof') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::file('prom_idproof_file_path', ['class' => 'form-control upload_details',
                                            'id'=>'identityproof_file','data-mandatory'=>''.$mandatoryField.'',$setDisable]) !!}

                                            {!! Form::hidden('identity_proof_file_check', 0, array('id' => 'identity_proof_file_check')) !!}

                                            @if(isset($identity_proof_file))
                                                <a href='{{ $identity_proof_file }}' class="btn">Download File</a>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label('AssetsFA', 'Visiting Card') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::file('prom_visiting_file_path', ['class' => 'form-control upload_details',
                                            'id'=>'visitingcard_file',$setDisable]) !!}

                                            {!! Form::hidden('visitingcard_file_check', 0, array('id' => 'visitingcard_file_check')) !!}

                                            @if(isset($visitingcard_file))
                                                <a href='{{ $visitingcard_file }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label(null,'PAN Card of Promoter') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::file('prom_pancard_file_path', ['class' => 'form-control upload_details',
                                            'id'=>'pan_promoter_file','data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}

                                            {!! Form::hidden('pan_promoter_file_check', 0, array('id' => 'pan_promoter_file_check')) !!}

                                            @if(isset($pan_promoter_file))
                                                <a href='{{ $pan_promoter_file }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- end F2.3 -->
                </div>


                <div id="divTab_sub3" class="collapse" style="margin-left:25px;margin-right:25px;">
                    <br><br>
                    <div id="CorporateDetails" class="panel panel-success">
                        <div class="panel-heading">Corporate Details</div>
                        <div style="padding: 10px;">
                            <div class="row">
                                <!-- start F3.1 -->
                                @if($deletedQuestionHelper->isQuestionValid("F3.1"))
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label('AssetsFA', 'Corporate Presentation/Note on Business') !!}
                                        {!! Form::file('business_corporate_file_path', ['class' => 'form-control upload_details',
                                        'id'=>'corporate_file',$setDisable,$setDisable]) !!}
                                        @if(isset($corporate_file))
                                            <a href='{{ $corporate_file }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                @endif
                                <!-- end F3.1 -->
                                <!-- start F3.2 -->
                                 @if($deletedQuestionHelper->isQuestionValid("F3.2"))
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label('AssetsFA', 'Certificate with E-commerce Company/Large Retailer/OEM', array('style' => 'font-size: 13px;')) !!}
                                        {!! Form::file('business_cert_ecom_file_path', ['class' => 'form-control upload_details',
                                        'id'=>'ecommercesupply_file',$setDisable,$setDisable,$setDisable]) !!}
                                        @if(isset($ecommercesupply_file))
                                            <a href='{{ $ecommercesupply_file }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                @endif
                                <!-- end F3.2 -->
                            </div>
                        </div>
                    </div>

                    <!-- start F3.3 -->
                    @if($deletedQuestionHelper->isQuestionValid("F3.3"))
                        <div id="equipcopy">
                            @for($i=1; $i < $maxInvoiceCopyofEquipmentPurchase; $i++)
                                @if($i == 1)
                                    <div id="EquipCopy_<?php echo $i ?>" class="panel panel-success">
                                        <div class="panel-heading">Invoice Copy of Equipment Purchase</div>
                                @else
                                    <div id="EquipCopy_<?php echo $i ?>" class="panel panel-success collapse">
                                        <div class="panel-heading">Invoice Copy of Equipment Purchase - {{$i}}</div>
                                @endif

                                    <div class="row" style="padding: 10px;">
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label('', 'Upload File') !!}
                                            {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                            {!! Form::file('equipementPurchase[business_invoice_equi'.$i.'_file_path]', ['class' => 'form-control upload_details', 'id'=>'equipementcopy_file_'.$i ,$setDisable]) !!}

                                            {!! Form::hidden('equipementcopy_file_check_'.$i, 0, array('id' => 'equipementcopy_file_check_'.$i)) !!}

                                            @if(isset($equipmentPurchaseCopy['business_invoice_equi'.$i.'_file_path']))
                                                <a href='{{ $equipmentPurchaseCopy['business_invoice_equi'.$i.'_file_path'] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endfor
                            <div class="form-group">
                                {!! Form::button('Add Invoice Copy of Equipment Purchase', ['class' => 'btn btn-primary add_promo_button', 'id' => 'add_equipmentbillcopy',$setDisable]) !!}
                                {!! Form::button('Delete Invoice Copy of Equipment Purchase', ['class' => 'btn btn-warning rem_promo_button collapse', 'id' => 'rem_equipmentbillcopy',$setDisable]) !!}
                                {!! Form::hidden('num_equi_purchase', 1, array('id' => 'num_equi_purchase')) !!}
                            </div>
                        </div>
                    @endif
                    <!-- end F3.3 -->

                    <!-- start F3.4 -->
                    @if($deletedQuestionHelper->isQuestionValid("F3.4"))
                        <div id="invcopy">
                        @for($i=1; $i < $maxInvoiceBillDetails; $i++)
                            @if($i == 1)
                                <div id="InvCopy_<?php echo $i ?>" class="panel panel-success">
                                    <div class="panel-heading">Copy of Invoice/Bill details</div>
                            @else
                                <div id="InvCopy_<?php echo $i ?>" class="panel panel-success collapse">
                                    <div class="panel-heading">Copy of Invoice/Bill details- {{$i}}</div>
                            @endif
                                <div class="row" style="padding: 10px;">
                                    <div class="col-sm-12 col-lg-6">
                                        {!! Form::label('', 'Upload File') !!}
                                        {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                        {!! Form::file('invoiceBillFile[business_invoice_bill'.$i.'_file_path]', ['class' => 'form-control upload_details', 'id'=>'invoicecopy_file_'.$i,$setDisable]) !!}

                                        {!! Form::hidden('invoicecopy_file_check_'.$i, 0, array('id' => 'invoicecopy_file_check_'.$i)) !!}
                                        @if(isset($invoiceCopy['business_invoice_bill'.$i.'_file_path']))
                                            <a href='{{ $invoiceCopy['business_invoice_bill'.$i.'_file_path'] }}' class="btn">Download File</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endfor
                            <div class="form-group">
                                {!! Form::button('Add Copy of Invoice/Bill details', ['class' => 'btn btn-primary add_promo_button', 'id' => 'add_invoicecopy',$setDisable]) !!}
                                {!! Form::button('Delete Copy of Invoice/Bill details', ['class' => 'btn btn-warning rem_promo_button collapse', 'id' => 'rem_invoicecopy',$setDisable]) !!}
                                {!! Form::hidden('num_invoice_detail', 1, array('id' => 'num_invoice_detail')) !!}
                            </div>
                        </div>
                    @endif
                    <!-- end F4 -->
                </div>

                <div id="divTab_sub4" class="collapse" style="margin-left:25px;margin-right:25px;">
                    <br><br>
                    <!-- start F3.4 -->
                    @if($deletedQuestionHelper->isQuestionValid("F4"))
                        <div id="yearQue37" class="form-group">
                        @for($i=1; $i < $maxSecurityDocument; $i++)
                            @if($i == 1)
                                <div id="security_doc_<?php echo $i ?>" class="panel panel-success">
                                    <div class="panel-heading">Security Document Details - Please Upload Available Documents</div>
                            @else
                                <div id="security_doc_<?php echo $i ?>" class="panel panel-success collapse">
                                    <div class="panel-heading">Security Document Details- {{$i}}</div>
                            @endif

                                <div style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            {!! Form::label('', 'Last Property Valuation Report')!!}
                                            {!! Form::file('security_lastvaluation_file[last_pro_val_report'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastvaluation_file_'.$i,$setDisable]) !!}

                                            {!! Form::hidden('last_pro_val_report_'.$i, 0, array('id' => 'last_pro_val_report_'.$i)) !!}
                                            @if(isset($lastValuation[$i-1]))
                                            {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $lastValuation[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                                <a href='{{ $lastValuation[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div id="Que46" class="">
                                                {!! Form::label('', 'Property Title Search Report') !!}
                                                {!! Form::file('security_titlesearch_file[pro_title_search_report'.$i.'_path]', ['class' => 'form-control upload_details', 'id'=>'security_titlesearch_file_'.$i,$setDisable]) !!}

                                            </div>
                                            {!! Form::hidden('pro_title_search_report_'.$i, 0, array('id' => 'pro_title_search_report_'.$i)) !!}
                                            @if(isset($titleSearch[$i-1]))
                                                {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $titleSearch[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                                <a href='{{ $titleSearch[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div id="Que46" class="">
                                                {!! Form::label('', 'Proper Tax Card copy') !!}
                                                {!! Form::file('security_propertytax_file[pro_tax_card'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'security_propertytax_file_'.$i,$setDisable]) !!}
                                            </div>
                                            {!! Form::hidden('pro_tax_card_'.$i, 0, array('id' => 'pro_tax_card_'.$i)) !!}
                                            @if(isset($propertyTax[$i-1]))
                                                {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $propertyTax[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                                <a href='{{ $propertyTax[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div id="Que46" class="">
                                                {!! Form::label('', 'Occupation Certificate copy') !!}
                                                {!! Form::file('security_occupation_file[oc'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'security_occupation_file_'.$i,$setDisable]) !!}
                                            </div>
                                            {!! Form::hidden('oc_'.$i, 0, array('id' => 'oc_'.$i)) !!}
                                            @if(isset($occupation[$i-1]))
                                                {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',array('file_name' => $occupation[$i-1]),array('class' => 'btn',$setDisable)) !!}--}}
                                                <a href='{{ $occupation[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div id="Que46" class="">
                                                {!! Form::label('', 'Society Share Certificate copy') !!}
                                                {!! Form::file('security_societyshare_file[society_share_cert'.$i.'_path]', ['class' =>'form-control upload_details','id'=>'security_societyshare_file_'.$i,$setDisable]) !!}
                                            </div>
                                            {!! Form::hidden('society_share_cert_'.$i, 0, array('id' => 'society_share_cert_'.$i)) !!}
                                            @if(isset($socityShare[$i-1]))
                                                {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                                {{--array('file_name' => $socityShare[$i-1]),--}}
                                                {{--array('class' => 'btn',$setDisable)) !!}--}}
                                                <a href='{{ $socityShare[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div id="Que46" class="">
                                                {!! Form::label('', 'Copy of 7 - 12 Extract') !!}
                                                {!! Form::file('security_712extract_file[copy_7_12_extract'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'security_712extract_file_'.$i,$setDisable]) !!}
                                            </div>
                                            {!! Form::hidden('copy_7_12_extract_'.$i, 0, array('id' => 'copy_7_12_extract_'.$i)) !!}
                                            @if(isset($extractFile[$i-1]))
                                                {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                                {{--array('file_name' => $extractFile[$i-1]),--}}
                                                {{--array('class' => 'btn',$setDisable)) !!}--}}
                                                <a href='{{ $extractFile[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            @if($loanType == 'LAP')
                                                <div id="Que46" class="">
                                                    {!! Form::label('', 'Copy of Last Sales/Purchase Deed')!!}
                                                    {!! Form::label(null,$removeMandatory, ['style' => '  color: red;']) !!}
                                                    {!! Form::file('security_lastsaledeed_file[copy_last_sales_pur'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastsaledeed_file_'.$i,'data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}
                                                </div>
                                            @else
                                                <div id="Que46" class="">
                                                    @if($isQuestionMandatory->isMandatory('avl_doc_name_1','Sale /Purchase Deed'))
                                                        {!! Form::label('', 'Copy of Last Sales/Purchase Deed')!!}
                                                        {!! Form::file('security_lastsaledeed_file[copy_last_sales_pur'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastsaledeed_file_'.$i,'data-mandatory'=>''.$mandatoryField.'' ,$setDisable]) !!}
                                                    @else
                                                        {!! Form::label('', 'Copy of Last Sales/Purchase Deed')!!}
                                                        {!! Form::file('security_lastsaledeed_file[copy_last_sales_pur'.$i.'_path]',['class' => 'form-control upload_details','id'=>'security_lastsaledeed_file_'.$i,$setDisable]) !!}
                                                    @endif
                                                </div>
                                            @endif
                                                {!! Form::hidden('copy_last_sales_pur_'.$i, 0, array('id' => 'copy_last_sales_pur_'.$i)) !!}
                                            @if(isset($lastSaledeed[$i-1]))
                                                {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                                {{--array('file_name' => $lastSaledeed[$i-1]),--}}
                                                {{--array('class' => 'btn',$setDisable)) !!}--}}
                                                    <a href='{{ $lastSaledeed[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div id="Que46" class="">
                                                {!! Form::label('', 'Municipal Plan') !!}
                                                {!! Form::file('muncipal_plan[municipal_plan'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'muncipal_plan_'.$i,$setDisable]) !!}
                                            </div>
                                            {!! Form::hidden('municipal_plan_count_'.$i, 0, array('id' => 'municipal_plan_count_'.$i)) !!}
                                            @if(isset($muncipalFile[$i-1]))
                                                {{--{!! HTML::linkAction('Pdf\DownloadFileController@getIndex', 'Download file',--}}
                                                {{--array('file_name' => $muncipalFile[$i-1]),--}}
                                                {{--array('class' => 'btn',$setDisable)) !!}--}}
                                                <a href='{{ $muncipalFile[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div id="Que46" class="">
                                                {!! Form::label('', 'Electricity Bill') !!}
                                                {!! Form::file('electricity_bill[electricity_bill_'.$i.'_path]', ['class'=> 'form-control upload_details','id'=>'electricity_bill_'.$i,'data-mandatory'=>''.$mandatoryField.'',$setDisable]) !!}
                                            </div>
                                            {!! Form::hidden('electricity_bill_count_'.$i, 0, array('id' => 'electricity_bill_count_'.$i)) !!}
                                            @if(isset($electricityBill[$i-1]))
                                                <a href='{{ $electricityBill[$i-1] }}' class="btn">Download File</a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endfor
                        <div class="form-group">
                            {!! Form::button('Add Security Document Details', ['class' =>
                            'btn btn-primary add_promo_button', 'id' => 'add_security',$setDisable]) !!}
                            {!! Form::button('Delete Security Document Details', ['class' =>
                            'btn btn-warning rem_promo_button collapse', 'id' =>'rem_security',$setDisable]) !!}
                            {!! Form::hidden('num_security_doc', 1, array('id' => 'num_security_doc')) !!}
                        </div>
                    </div>
                    {{--</div>--}}
                    @endif
                </div>
                <!-- end F4 -->
                <div class="row">
                    <div class="col-md-12" style="margin-left:20px;">
                        {{--{!! Form::button('Save & Next Section <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}--}}
                        <div id="currentSection">
                            {!! Form::button('<i class="fa fa-reply"></i> Previous', array('class' => 'btn btn-success btn-cons sme_button','id'=>'backIn', 'value'=> 'Previous', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            {!! Form::button('Next <i class="fa fa-share"></i>', array('class' => 'btn btn-success btn-cons sme_button','id'=>'nextIn', 'value'=> 'NextIn', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            {!! Form::button('Proceed to Submission <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-success btn-cons sme_button', 'value'=> 'Save','id'=>'saveDetails', 'style' => 'margin-top:20px;margin-left:20px;',$setDisable )) !!}
                            @if($user->isSME() || $user->isBankUser())
                                {!! Form::button('<i class="fa fa-comments"></i> Raise Query ', array('class' => 'btn btn-success btn-cons sme_button', 'id'=>'raise_query', 'onclick' => "raiseQuery(); return false;", 'value'=> 'RaiseQuery', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                            @endif
                            {!! Form::button('Exit <i class="fa fa-sign-out"></i>', array('class' => 'btn btn-success btn-cons sme_button', 'onclick' => "showTab('Home'); return false;", 'value'=> 'Exit', 'style' => 'margin-top:20px;margin-left:20px;' )) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('footer')

<link rel="stylesheet" href={{{URL::asset("/css/sme.css")}}} type="text/css" media="all" />
<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function() {
        var cnt = 1;
        $('#divTab_sub1').show();
        $('#divTab_sub2').hide();
        $('#divTab_sub3').hide();
        $('#divTab_sub4').hide();
        $('#saveDetails').hide();
        $('#raise_query').hide();


        $(lnkLoanDtls1).click(function () {

            $('#divTab_sub1').show();
            $('#currentSection').show();
            cnt=1;
            $('#divTab_sub2').hide();
            $('#divTab_sub3').hide();
            $('#divTab_sub4').hide();
            $('#nextIn').show();
            $('#backIn').hide();
            $(this).addClass("active").siblings().removeClass("active");
            $('#saveDetails').hide();
            $('#raise_query').hide();
        });

        $(lnkLoanDtls2).click(function () {

            $('#divTab_sub2').show();
            $('#currentSection').show();
            cnt=2;
            $('#divTab_sub1').hide();
            $('#divTab_sub3').hide();
            $('#divTab_sub4').hide();
            $('#backIn').show();
            $(this).addClass("active").siblings().removeClass("active");
            $('#saveDetails').hide();
            $('#raise_query').hide();
        });

        $(lnkLoanDtls3).click(function () {

            $('#divTab_sub3').show();
            $('#currentSection').show();
            cnt=3;
            $('#divTab_sub1').hide();
            $('#divTab_sub2').hide();
            $('#divTab_sub4').hide();
            $('#backIn').show();
            $(this).addClass("active").siblings().removeClass("active");
            $('#saveDetails').hide();
            $('#raise_query').hide();
        });

        $(lnkLoanDtls4).click(function () {

            $('#divTab_sub4').show();
            cnt=4;
            $('#divTab_sub1').hide();
            $('#divTab_sub2').hide();
            $('#divTab_sub3').hide();
            $('#currentSection').show();
            $('#nextIn').hide();
            $('#backIn').show();
            $(this).addClass("active").siblings().removeClass("active");
            $('#saveDetails').show();
            $('#raise_query').show();
        });

        /*---- end toggle function*/
        if(cnt==1){
            $('#backIn').hide();
        }
        $("#nextIn").click(function (){
            //alert(cnt);
            if(cnt==1){
               // alert(cnt);
                if($('#divTab_sub'+cnt).css('display') == 'block'){
                    if(validateForm('#divTab_sub'+cnt,'#promter')){
                        $('#divTab_sub'+cnt).hide();
                        $('#lnkLoanDtls'+cnt).removeClass('active');
                        cnt++;
                        $('#lnkLoanDtls'+cnt).removeClass('disabled');
                        $('#lnkLoanDtls'+cnt).addClass('active');
                        $('#divTab_sub'+cnt).show();
                        $('#currentSection').show();
                        $('#backIn').show();
                        $('#saveDetails').hide();
                        $('#raise_query').hide();
                    }
                }

            }
            else if(cnt==2){
                if($('#divTab_sub'+cnt).css('display') == 'block'){
                    if(validateForm('#divTab_sub'+cnt,'#promter')){
                        $('#divTab_sub'+cnt).hide();
                        $('#currentSection').hide();
                        $('#lnkLoanDtls'+cnt).removeClass('active');
                        cnt++;
                        $('#lnkLoanDtls'+cnt).removeClass('disabled');
                        $('#lnkLoanDtls'+cnt).addClass('active');
                        $('#divTab_sub'+cnt).show();
                        $('#currentSection').show();
                        $('#backIn').show();
                        $('#saveDetails').hide();
                        $('#raise_query').hide();
                    }
                }
            }
            else if(cnt==3){
                if($('#divTab_sub'+cnt).css('display') == 'block'){
                    if(validateForm('#divTab_sub'+cnt,'#promter')){
                        $('#divTab_sub'+cnt).hide();
                        $('#currentSection').show();
                        $('#lnkLoanDtls'+cnt).removeClass('active');
                        cnt++;
                        $('#lnkLoanDtls'+cnt).removeClass('disabled');
                        $('#lnkLoanDtls'+cnt).addClass('active');
                        $('#divTab_sub'+cnt).show();
                        $('#backIn').show();
                        $('#nextIn').hide();
                        $('#saveDetails').show();
                        $('#raise_query').show();
                    }
                }
            }
            else if(cnt==4){
                if($('#divTab_sub'+cnt).css('display') == 'block'){
                    if(validateForm('#divTab_sub'+cnt,'#promter')){
                        $('#divTab_sub'+cnt).hide();
                        //$('#currentSection').show();
                        $('#lnkLoanDtls'+cnt).removeClass('active');
                        cnt++;
                        $('#lnkLoanDtls'+cnt).removeClass('disabled');
                        $('#lnkLoanDtls'+cnt).addClass('active');
                        $('#divTab_sub'+cnt).show();
                        $('#saveDetails').show();
                        $('#raise_query').show();
                    }
                }
            }
        });

        $("#backIn").click(function (){
            $('#nextIn').show();
            $('#divTab_sub'+cnt).hide();
            $('#lnkLoanDtls'+cnt).removeClass('active');
            cnt--;
            // alert(cnt);
            if(cnt==1){
                $('#backIn').hide();
            }
            $('#divTab_sub'+cnt).show();
            $('#lnkLoanDtls'+cnt).addClass('active');
            $('#lnkLoanDtls'+cnt).removeClass('disabled');
            $('#saveDetails').hide();
            $('#raise_query').hide();
        });

        $('#saveDetails').click(function (e){
            if(cnt==4){
                if(validateForm('#divTab_sub'+cnt,'#promter')){
                    return true;
                }else{
                    e.preventDefault();
                }
            }
        });

        $(".upload_details").filestyle({buttonName: "btn-primary"});
        var add_tab1_kyc_count = 1; // Hidden Field Counter Variable
        var add_equipmentbillcopy_count = 1;
        var add_invoicecopy_count = 1;
        var add_security_count = 1;

        //=======================================================//
        //----------Company - Financials Reports/Balance Sheets ----------//
        var jArrayTemp = <?php echo json_encode($blplfile ); ?>;
        var i = 1;
        $.each( jArrayTemp, function( index, value ){
            value = getFileName(value);
            //console.log(value);
            $('#fin_year_'+i).val(1);
            $('#blplfile_' + i).next().children().first().val(value);
            i++;
            if(value !=''){
                $('#lnkLoanDtls1').removeClass('disabled');
            }
        });
        //----------Company - Bank Statement----------//
        var existing_records = {{count($cmpnybankstmt_file)}};
        var jArray= <?php echo json_encode($cmpnybankstmt_file ); ?>;
        var i = 1;
        $.each( jArray, function( index, value ){
            $('#bnkst_' + i).show();
            value = getFileName(value);
            $('#'+index).next().children().first().val(value);
            if(i==3){
                $('#rem_tab1_kyc').show();
                add_tab1_kyc_count = i;
            }
            $("#num_bank").val(i);
            i++;
        });

        var a = $("#num_bank").val();
        if(a > 1){
            for (var j = 2; j <= a; j++) {
                $('#bnkst_' + j).show();
                if(j == 2){
                    $('#rem_tab1_kyc').show();
                }
                if (j == 3) {
                    $('#add_tab1_kyc').hide();
                }
                add_tab1_kyc_count = j;
            }
        }

        $('#add_tab1_kyc').click(function () {
            add_tab1_kyc_count = add_tab1_kyc_count + 1;
            $('#num_bank').val(add_tab1_kyc_count);
            $('#bnkst_' + add_tab1_kyc_count).show();
            if (add_tab1_kyc_count == 3) {
                $('#add_tab1_kyc').hide();
            }
            else {
                $('#add_tab1_kyc').show();
            }

            if (add_tab1_kyc_count == 1) {
                $('#rem_tab1_kyc').hide();
            }
            else {
                $('#rem_tab1_kyc').show();
            }
        });

        $('#rem_tab1_kyc').click(function () {
            $('#bnkst_' + add_tab1_kyc_count).hide();
            add_tab1_kyc_count = add_tab1_kyc_count - 1;
            $('#num_bank').val(add_tab1_kyc_count);
            if (add_tab1_kyc_count == 3) {
                $('#add_tab1_kyc').hide();
            }
            else {
                $('#add_tab1_kyc').show();
            }

            if (add_tab1_kyc_count == 1) {
                $('#rem_tab1_kyc').hide();
            }
            else {
                $('#rem_tab1_kyc').show();
            }
        });

        //---------Company - CIBIL Report----------//
        var temp = '{{$cibilreport_file}}';
        temp = getFileName(temp);
        $('#cibilreport_file').next().children().first().val(temp);

        //-----Company - KYC Details------------//
        var temp = '{{$pancard_file}}';
        temp = getFileName(temp);
        $('#pancard_file').next().children().first().val(temp);
        if($('#pancard_file').next().children().first().val() !=''){
            $('#pan_card_check1').val(1);
        }else{
            $('#pan_card_check1').val(0);
        }

        var temp = '{{$vatregistration_file}}';
        temp = getFileName(temp);
        $('#vatregistration_file').next().children().first().val(temp);

        var temp = '{{$shopestablish_file}}';
        temp = getFileName(temp);
        $('#shopestablish_file').next().children().first().val(temp);

        var temp = '{{$addressproof_company_file}}';
        temp = getFileName(temp);
        $('#addressproof_company_file').next().children().first().val(temp);
        if($('#addressproof_company_file').next().children().first().val() !=''){
            $('#addressproof_company_file_check').val(1);

        }else{
            $('#addressproof_company_file_check').val(0);

        }

        var temp = '{{$optional_file1}}';
        temp = getFileName(temp);
        $('#optional_file1').next().children().first().val(temp);
        if($('#optional_file1').next().children().first().val()!=''){
            $('#optional_file1_check').val(1);
        }else{
            $('#optional_file1_check').val(0);
        }

        var temp = '{{$optional_file2}}';
        temp = getFileName(temp);
        $('#optional_file2').next().children().first().val(temp);

        //--------Promoter Kyc - Bank Statement-------//
        var temp = '{{$bankstatement_file}}';
        temp = getFileName(temp);
        $('#bankstatement_file').next().children().first().val(temp);

        //-----Promoter Kyc - Financials ----//
        var temp = '{{$promoternetworth_file}}';
        temp = getFileName(temp);
        $('#promoternetworth_file').next().children().first().val(temp);
        if($('#promoternetworth_file').next().children().first().val()!=''){
            $('#networth_file_check').val(1);
        }else{
            $('#networth_file_check').val(0);
        }

        var temp = '{{$promoter_cibilreport_file}}';
        temp = getFileName(temp);
        $('#promoter_cibilreport_file').next().children().first().val(temp);

        //--------Promoter Kyc - KYC Details--------//
        var temp = '{{$promoter_proof_address_file}}';
        temp = getFileName(temp);
        $('#promoter_proof_address_file').next().children().first().val(temp);
        if($('#promoter_proof_address_file').next().children().first().val() != ''){
            $('#prom_kyc_addproof_file_path_check').val(1);
            $('#lnkLoanDtls2').removeClass('disabled');
        }else{
            $('#prom_kyc_addproof_file_path_check').val(0);
        }

        var temp = '{{$visitingcard_file}}';
        temp = getFileName(temp);
        $('#visitingcard_file').next().children().first().val(temp);
        if($('#visitingcard_file').next().children().first().val() !=''){
            $('#visitingcard_file_check').val(1);
        }else{
            $('#visitingcard_file_check').val(0);
        }

        var temp = '{{$pan_promoter_file}}';
        temp = getFileName(temp);
        $('#pan_promoter_file').next().children().first().val(temp);
        if($('#pan_promoter_file').next().children().first().val() !=''){
            $('#pan_promoter_file_check').val(1);
            $('#lnkLoanDtls3').removeClass('disabled');
        }else{
            $('#pan_promoter_file_check').val(0);
        }

        var temp = '{{$identity_proof_file}}';
        temp = getFileName(temp);
        $('#identityproof_file').next().children().first().val(temp);
        if($('#identityproof_file').next().children().first().val() !=''){
            $('#identity_proof_file_check').val(1);
        }else{
            $('#identity_proof_file_check').val(0);
        }

        //---------Business/Contracts------------//
        var temp = '{{$corporate_file}}';
        temp = getFileName(temp);
        $('#corporate_file').next().children().first().val(temp);

        var temp = '{{$ecommercesupply_file}}';
        temp = getFileName(temp);
        $('#ecommercesupply_file').next().children().first().val(temp);

        //=============================================================//
        var existing_equipmentbillcopy = {{count($equipmentPurchaseCopy)}};
        var jArray = <?php echo json_encode($equipmentPurchaseCopy ); ?>;

        for(var j=1; j <= existing_equipmentbillcopy; j++){
            $('#EquipCopy_' + j).collapse('show');
            jArray['business_invoice_equi'+ j +'_file_path'] = getFileName(jArray['business_invoice_equi'+ j +'_file_path']);
            $('#equipementcopy_file_' + j).next().children().first().val(jArray['business_invoice_equi'+ j +'_file_path']);
            if($('#equipementcopy_file_check_'+j).val()!=''){

                $('#equipementcopy_file_check_'+j).val(1);
                $('#lnkLoanDtls3').removeClass('disabled');
            }

            $('#equipementcopy_file_check_'+j).val(1);
            add_equipmentbillcopy_count = j;
            if(j==2){
                $('#rem_equipmentbillcopy').show();
            }
            if(j==3){
                $('#add_equipmentbillcopy').hide();
            }
        }

        $('#add_equipmentbillcopy').click(function () {
            add_equipmentbillcopy_count = add_equipmentbillcopy_count + 1;
            $('#num_equi_purchase').val(add_equipmentbillcopy_count);
            $('#EquipCopy_' + add_equipmentbillcopy_count).collapse('show');
            if (add_equipmentbillcopy_count == 3) {
                $('#add_equipmentbillcopy').hide();
            }
            else {
                $('#add_equipmentbillcopy').show();
            }
            if (add_equipmentbillcopy_count == 1) {
                $('#rem_equipmentbillcopy').hide();
            }
            else {
                $('#rem_equipmentbillcopy').show();
            }
        });

        $('#rem_equipmentbillcopy').click(function () {
            $('#EquipCopy_' + add_equipmentbillcopy_count).collapse('hide');
            add_equipmentbillcopy_count = add_equipmentbillcopy_count - 1;
            $('#num_equi_purchase').val(add_equipmentbillcopy_count);
            if (add_equipmentbillcopy_count == 3) {
                $('#add_equipmentbillcopy').hide();
            }
            else {
                $('#add_equipmentbillcopy').show();
            }

            if (add_equipmentbillcopy_count == 1) {
                $('#rem_equipmentbillcopy').hide();
            }
            else {
                $('#rem_equipmentbillcopy').show();
            }
        });

        //==========================================//
        var existingInvoiceCopy = {{count($invoiceCopy)}};
        var jArray = <?php echo json_encode($invoiceCopy ); ?>;
        console.log();
        for(k = 1; k <= existingInvoiceCopy;k++){
            $('#InvCopy_' + k).collapse('show');
            jArray['business_invoice_bill'+ k +'_file_path'] = getFileName(jArray['business_invoice_bill'+ k +'_file_path']);
            $('#invoicecopy_file_' + k).next().children().first().val(jArray['business_invoice_bill'+ k +'_file_path']);
            if($('#invoicecopy_file_' + k).next().children().first().val()!=''){
                $('#invoicecopy_file_check_' + k).val(1);
                $('#lnkLoanDtls3').removeClass('disabled');
            }


            add_invoicecopy_count = k;
            if(k==2){
                $('#rem_invoicecopy').show();
            }
            if(k==5){
                $('#add_invoicecopy').hide();
            }
        }

        $('#add_invoicecopy').click(function () {
            add_invoicecopy_count = add_invoicecopy_count + 1;
            $('#num_invoice_detail').val(add_invoicecopy_count);
            $('#InvCopy_' + add_invoicecopy_count).collapse('show');
            if (add_invoicecopy_count == 5) {
                $('#add_invoicecopy').hide();
            }
            else {
                $('#add_invoicecopy').show();
            }

            if (add_invoicecopy_count == 1) {
                $('#rem_invoicecopy').hide();
            }
            else {
                $('#rem_invoicecopy').show();
            }
        });

        $('#rem_invoicecopy').click(function () {

            $('#InvCopy_' + add_invoicecopy_count).collapse("hide");
            add_invoicecopy_count = add_invoicecopy_count - 1;
            $('#num_invoice_detail').val(add_invoicecopy_count);
            if (add_invoicecopy_count == 5) {
                $('#add_invoicecopy').hide();
            }
            else {
                $('#add_invoicecopy').show();
            }

            if (add_invoicecopy_count == 1) {
                $('#rem_invoicecopy').hide();
            }
            else {
                $('#rem_invoicecopy').show();
            }
        });

        //==========================================//
        var existingSecurityFiles = {{$existingSecurityFiles}};
        var jArray1 = <?php echo json_encode($lastValuation ); ?>;
        var jArray2 = <?php echo json_encode($titleSearch ); ?>;
        var jArray3 = <?php echo json_encode($propertyTax ); ?>;
        var jArray4 = <?php echo json_encode($occupation ); ?>;
        var jArray5 = <?php echo json_encode($socityShare ); ?>;
        var jArray6 = <?php echo json_encode($extractFile); ?>;
        var jArray7 = <?php echo json_encode($lastSaledeed ); ?>;
        var jArray8 = <?php echo json_encode($muncipalFile ); ?>;
        var jArray9 = <?php echo json_encode($electricityBill ); ?>;
        for(i=1;i<=existingSecurityFiles;i++) {

            $('#security_doc_' + i).collapse('show');
            add_security_count = i;
            if(jArray1.length) {
                jArray1[i - 1] = getFileName(jArray1[i - 1]);
                $('#security_lastvaluation_file_' + i).next().children().first().val(jArray1[i - 1]);
                if ($('#security_lastvaluation_file_' + i).next().children().first().val() != '') {
                    $('#last_pro_val_report_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#last_pro_val_report_' + i).val(0);
                }
            }

            if(jArray2.length) {
                jArray2[i - 1] = getFileName(jArray2[i - 1]);
                $('#security_titlesearch_file_' + i).next().children().first().val(jArray2[i - 1]);
                if ($('#security_titlesearch_file_' + i).next().children().first().val() != '') {
                    $('#pro_title_search_report_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#pro_title_search_report_' + i).val(0);
                }
            }

            if(jArray3.length!=0) {
                jArray3[i - 1] = getFileName(jArray3[i - 1]);
                $('#security_propertytax_file_' + i).next().children().first().val(jArray3[i - 1]);
                if ($('#security_propertytax_file_' + i).next().children().first().val() != '') {
                    $('#pro_tax_card_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#pro_tax_card_' + i).val(0);
                }
            }

            if(jArray4.length!=0) {
                jArray4[i - 1] = getFileName(jArray4[i - 1]);
                $('#security_occupation_file_' + i).next().children().first().val(jArray4[i - 1]);
                if ($('#security_occupation_file_' + i).next().children().first().val() != '') {
                    $('oc_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('oc_' + i).val(0);
                }
            }

            if(jArray5.length!=0) {
                jArray5[i - 1] = getFileName(jArray5[i - 1]);
                $('#security_societyshare_file_' + i).next().children().first().val(jArray5[i - 1]);
                if ($('#security_societyshare_file_' + i).next().children().first().val() != '') {
                    $('#society_share_cert_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#society_share_cert_' + i).val(0);
                }
            }

            if(jArray6.length!=0) {
                jArray6[i - 1] = getFileName(jArray6[i - 1]);
                $('#security_712extract_file_' + i).next().children().first().val(jArray6[i - 1]);
                if ($('#security_712extract_file_' + i).next().children().first().val() != '') {
                    $('#copy_7_12_extract_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#copy_7_12_extract_' + i).val(0);
                }
            }

            if(jArray7.length!=0) {
                jArray7[i - 1] = getFileName(jArray7[i - 1]);
                $('#security_lastsaledeed_file_' + i).next().children().first().val(jArray7[i - 1]);
                if ($('#security_lastsaledeed_file_' + i).next().children().first().val() != '') {
                    $('#copy_last_sales_pur_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#copy_last_sales_pur_' + i).val(0);
                }
            }

            if(jArray8.length!=0) {
                jArray8[i - 1] = getFileName(jArray8[i - 1]);
                $('#muncipal_plan_' + i).next().children().first().val(jArray8[i - 1]);
                if ($('#muncipal_plan_' + i).next().children().first().val() != '') {
                    $('#municipal_plan_count_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#municipal_plan_count_' + i).val(0);
                }
            }

            if(jArray9.length!=0) {
                jArray9[i - 1] = getFileName(jArray9[i - 1]);
                $('#electricity_bill_' + i).next().children().first().val(jArray9[i - 1]);
                if ($('#electricity_bill_' + i).next().children().first().val() != '') {
                    $('#electricity_bill_count_' + i).val(1);
                    $('#lnkLoanDtls4').removeClass('disabled');
                } else {
                    $('#electricity_bill_count_' + i).val(0);
                }
            }

             if(i==3) {
                $('#add_security').hide();
             }
             if(i==2){
                $('#rem_security').show();
             }
             $('#num_security_doc').val(i);
        }
         var a = $('#num_security_doc').val();
         for(i=2;i<=a;i++){
            $('#security_doc_' + i).collapse('show');
            if(i==3){
                $('#add_security').hide();
            }
            if(i==2){
                $('#rem_security').show();
            }
            add_security_count = i;
         }

         $('#add_security').click(function () {
            add_security_count = add_security_count + 1;
            $('#num_security_doc').val(add_security_count);
            $('#security_doc_' + add_security_count).collapse('show');
            if (add_security_count == 3) {
                $('#add_security').hide();
            }
            else {
                $('#add_security').show();
            }
            if (add_security_count == 1) {
                $('#rem_security').hide();
            }
            else {
                $('#rem_security').show();
            }
         });

         $('#rem_security').click(function () {

         $('#security_doc_' + add_security_count).collapse('hide');
            add_security_count = add_security_count - 1;
            $('#num_security_doc').val(add_security_count);
            if (add_security_count == 3) {
                $('#add_security').hide();
            }
            else {
                $('#add_security').show();
            }
            if (add_security_count == 1) {
                $('#rem_security').hide();
            }
            else {
               $('#rem_security').show();
            }
        });

//====================================================================//

        $(lnkLoanDtls4).click(function () {
            $('#li_sub1').removeClass("active");
            $('#li_sub2').removeClass("active");
            $('#li_sub3').removeClass("active");
            $('#li_sub4').removeClass("active");

            $('#divTab_sub4').show();
            $('#divTab_sub1').hide();
            $('#divTab_sub2').hide();
            $('#divTab_sub3').hide();
            $('#li_sub4').addClass("active");
        });

        $('#promoter_proof_address').select2({
            allowClear: true,
            placeholder: "Select Address Type"
        });
        $('#promoter_identity_proof').select2({
            allowClear: true,
            placeholder: "Select Identity Proof"
        });

    });

    function getFileName(value){
        var res = value.split("/");
        var newRes = res[(res.length)-1];
        var newRes = newRes.split("?");
        return newRes[(newRes.length)-2];
    }
</script>
@endsection