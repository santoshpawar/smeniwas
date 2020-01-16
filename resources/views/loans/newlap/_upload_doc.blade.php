<div role="tabpanel_sub">
    <ul class="nav nav-pills responsive" role="tablist" id="procedures">
        <li id="li_sub1" class="active"><a id="lnkLoanDtls1" href="#"><span class="text">Company KYC & Financials</span></a></li>
        <li id="li_sub2"><a id="lnkLoanDtls2" href="#"><span class="text">Promotor KYC & Financials</span></a></li>
        <li id="li_sub3"><a id="lnkLoanDtls3" href="#"><span class="text">Business/Contracts</span></a></li>
        <li id="li_sub4"><a id="lnkLoanDtls4" href="#"><span class="text">Security Documents</span></a></li>
    </ul>
</div>

<div id="divTab_sub1" class="collapse">

    <br><br>
    <div id="yearQue37" class="form-group">
        <div id="finreports" class="panel panel-info">
            <div class="panel-heading">Financials Reports/Balance Sheets</div>

            <div style="padding-left: 10px;">
                @foreach($bl_year as $blyear)
                    <div class="form-group">
                        {!! Form::label('blpl_file', $blyear) !!}
                        {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::file('blpl_file_'.$blyear, ['class' => 'form-control upload_details'] ) !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr/>


    <div id="yearQue37" class="form-group">
        @for($i=1; $i < 4; $i++)
            @if($i == 1)
                <div id="bnkst_<?php echo $i ?>" class="panel panel-info">
                <div class="panel-heading">Bank Statement</div>
            @else
                <div id="bnkst_<?php echo $i ?>" class="panel panel-info collapse">
                <div class="panel-heading">Bank Statement -  {{$i}}</div>
            @endif


            <div style="padding-left: 10px;">
                <div class="form-group">
                    {!! Form::label('','Name of Bank') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::text('bankname_'.$i, null, ['class' => 'form-control', 'size' => '5x5']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('','Period for Month/Year') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::text('stmt_period_'.$i, null, ['class' => 'form-control', 'size' => '5x5']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('','Upload File') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('bnk_file_'.$blyear, ['class' => 'form-control upload_details'] ) !!}
                </div>
                    <hr/>
            </div>
        </div>
        @endfor

        <div class="form-group">
            {!! Form::button('Add Bank', ['class' => 'btn btn-primary add_promo_button', 'id' => 'add_tab1_kyc']) !!}
            {!! Form::button('Delete', ['class' => 'btn btn-warning rem_promo_button collapse', 'id' => 'rem_tab1_kyc']) !!}
        </div>
    </div>

    <hr/>

    <div id="yearQue37" class="form-group">
        <div id="cibil" class="panel panel-info">
            <div class="panel-heading">CIBIL Report</div>

            <div style="padding-left: 10px;">

                <div id="Que41" class="form-group">
                    {!! Form::label('AssetsFA', 'CIBIL report (optional)') !!}
                    {!! Form::file('cibilreport_file', ['class' => 'form-control upload_details', 'id'=>'cibilreport_file']) !!}
                </div>
                <hr>
            </div>
        </div>
    </div>

    <hr/>

    <div id="yearQue37" class="form-group">
        <div id="kycdetails" class="panel panel-info">
            <div class="panel-heading">KYC Details</div>

            <div style="padding-left: 10px;">
                <div class="form-group">
                    {!! Form::label(null,'PAN Card') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('pancard_file', ['class' => 'form-control upload_details', 'id'=>'pancard_file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label(null,'VAT Registration Certificate') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('vatregistration_file', ['class' => 'form-control upload_details', 'id'=>'vatregistration_file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label(null,'Shop and Establishment Certificate') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('shopestablish_file', ['class' => 'form-control upload_details', 'id'=>'shopestablish_file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label(null,'Address Proof of Company Business') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('addressproof_company_file', ['class' => 'form-control upload_details', 'id'=>'addressproof_company_file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label(null,'KYC Details Extra field 1') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('optional_file1', ['class' => 'form-control upload_details', 'id'=>'optional_file1']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label(null,'KYC Details Extra field 2') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('optional_file1', ['class' => 'form-control upload_details', 'id'=>'optional_file1']) !!}
                </div>
                <hr>
            </div>
        </div>
    </div>

</div>


<div id="divTab_sub2" class="collapse">

    <br><br>
    <div id="yearQue37" class="form-group">
        <div id="bankstmt" class="panel panel-info">
            <div class="panel-heading">Bank Statement</div>

            <div style="padding-left: 10px;">

                <div id="Que39" class="form-group">
                    {!! Form::label('AssetsFA', 'Bank Statements') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('bankstatement_file', ['class' => 'form-control upload_details','id'=>'bankstatement_file']) !!}
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div id="yearQue37" class="form-group">
        <div id="financials" class="panel panel-info">
            <div class="panel-heading">Financials</div>

            <div style="padding-left: 10px;">

                <div id="Que41" class="form-group">
                    {!! Form::label('AssetsFA', 'Networth Certificate') !!}
                    {!! Form::file('promoternetworth_file', ['class' => 'form-control upload_details', 'id'=>'promoternetworth_file']) !!}
                </div>

                <div id="Que41" class="form-group">
                    {!! Form::label('AssetsFA', 'CIBIL report (optional)') !!}
                    {!! Form::file('promoter_cibilreport_file', ['class' => 'form-control upload_details', 'id'=>'promoter_cibilreport_file']) !!}
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div id="yearQue37" class="form-group">
        <div id="kycdetailspr" class="panel panel-info">
            <div class="panel-heading">KYC Details</div>

            <div style="padding-left: 10px;">

                <div class="form-group">
                    {!! Form::label(null,'PAN Card of Promoter') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::file('pan_promoter_file', ['class' => 'form-control upload_details', 'id'=>'pan_promoter_file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label(null,'Address Proof') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {{--{!! Form::select('promoter_proof_address', $addressTypes, null, ['id' => 'address_types', 'class' => 'form-control']) !!}--}}
                    {!! Form::select('promoter_proof_address', array(' ' => 'Please select','0' => 'Electricity Bill', '1' => 'Aadhar Card', '2' => 'Ration Card','3' => 'Passport'), null, ['id' => 'promoter_proof_address', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::file('promoter_proof_address_file', ['class' => 'form-control upload_details', 'id'=>'promoter_proof_address_file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label(null,'Identity Proof') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::select('promoter_identity_proof', array(' ' => 'Please select','0' => 'Passport', '1' => 'Driving License', '2' => 'Election Card'), null, ['id' => 'promoter_identity_proof', 'class' => 'form-control']) !!}
                </div>

                <div id="Que41" class="form-group">
                    {!! Form::label('AssetsFA', 'Visiting Card') !!}
                    {!! Form::file('visitingcard_file', ['class' => 'form-control upload_details', 'id'=>'visitingcard_file']) !!}
                </div>
            </div>
        </div>
    </div>

</div>


<div id="divTab_sub3" class="collapse">
    <br><br>
    <div id="CorporateDetails" class="panel panel-info">
        <div class="panel-heading">Corporate Details</div>
        <div id="Que45" class="form-group">
            {!! Form::label('AssetsFA', 'Corporate Presentation/Note on Business') !!}
            {!! Form::file('corporate_file', ['class' => 'form-control upload_details', 'id'=>'corporate_file']) !!}
        </div>

        <div id="Que48" class="form-group">
            {!! Form::label('AssetsFA', 'Certificate with E-commerce Company/Large Retailer/OEM') !!}
            {!! Form::file('ecommercesupply_file', ['class' => 'form-control upload_details', 'id'=>'ecommercesupply_file']) !!}
        </div>
    </div>

    <div id="equipcopy">
        @for($i=1; $i < 4; $i++)
            @if($i == 1)
                <div id="EquipCopy_<?php echo $i ?>" class="panel panel-info">
                <div class="panel-heading">Invoice Copy of Equipment Purchase</div>
            @else
                <div id="EquipCopy_<?php echo $i ?>" class="panel panel-info collapse">
                <div class="panel-heading">Invoice Copy of Equipment Purchase - {{$i}}</div>
            @endif


                <div style="padding-left: 10px;">
                    {!! Form::label('', 'Upload File') !!}
                    {!! Form::file('equipementcopy_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'equipementcopy_file_'.$i]) !!}
                    <br>
                </div>
            </div>
        @endfor
        <div class="form-group" align = "center">
            {!! Form::button('Add Invoice Copy of Equipment Purchase', ['class' => 'btn btn-primary add_promo_button', 'id' => 'add_equipmentbillcopy']) !!}
            {!! Form::button('Delete Invoice Copy of Equipment Purchase', ['class' => 'btn btn-warning rem_promo_button collapse', 'id' => 'rem_equipmentbillcopy']) !!}
        </div>
    </div>

    <div id="invcopy">
        @for($i=1; $i < 6; $i++)
            @if($i == 1)
                <div id="InvCopy_<?php echo $i ?>" class="panel panel-info">
                <div class="panel-heading">Copy of Invoice/Bill details</div>
            @else
                <div id="InvCopy_<?php echo $i ?>" class="panel panel-info collapse">
                <div class="panel-heading">Copy of Invoice/Bill details - {{$i}}</div>
            @endif


                <div style="padding-left: 10px;">
                    {!! Form::label('', 'Upload File') !!}
                    {!! Form::file('invoicecopy_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'invoicecopy_file_'.$i]) !!}
                    <br>
                </div>
            </div>
            @endfor
            <div class="form-group" align = "center">
                {!! Form::button('Add Copy of Invoice/Bill details', ['class' => 'btn btn-primary add_promo_button', 'id' => 'add_invoicecopy']) !!}
                {!! Form::button('Delete Copy of Invoice/Bill details', ['class' => 'btn btn-warning rem_promo_button collapse', 'id' => 'rem_invoicecopy']) !!}
            </div>
        </div>

</div>

<div id="divTab_sub4" class="collapse">
    <br><br>

    <div id="yearQue37" class="form-group">
    @for($i=1; $i < 4; $i++)
        @if($i == 1)
            <div id="security_doc_<?php echo $i ?>" class="panel panel-info">
            <div class="panel-heading">Security Document Details</div>
        @else
            <div id="security_doc_<?php echo $i ?>" class="panel panel-info collapse">
            <div class="panel-heading">Security Document Details - {{$i}}</div>
        @endif


            <div style="padding-left: 10px;">
                <div class="form-group">
                    {!! Form::label(null,'Type of Security') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::select('security_type_'.$i, array(' ' => 'Please select','0' => 'Land', '1' => 'Residential', '2' => 'Commercial'), null, ['id' => 'security_type_'.$i, 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('','Area') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::text('security_area_'.$i, null, ['class' => 'form-control', 'size' => '5x5']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('','City') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::text('security_city_'.$i, null, ['class' => 'form-control', 'size' => '5x5']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('','Pin Code') !!}
                    {!! Form::label(null,'*', ['class' => 'redmarks']) !!}
                    {!! Form::text('security_pincode_'.$i, null, ['class' => 'form-control', 'size' => '5x5']) !!}
                </div>

                <div id="Que46" class="form-group">
                    {!! Form::label('', 'Last Valuation Report of Property') !!}
                    {!! Form::file('security_lastvaluation_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'security_lastvaluation_file_'.$i]) !!}
                </div>

                <div id="Que46" class="form-group">
                    {!! Form::label('', 'Title Search of Property') !!}
                    {!! Form::file('security_titlesearch_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'security_titlesearch_file_'.$i]) !!}
                </div>

                <div id="Que46" class="form-group">
                    {!! Form::label('', 'Proper Tax Card copy') !!}
                    {!! Form::file('security_propertytax_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'security_propertytax_file_'.$i]) !!}
                </div>

                <div id="Que46" class="form-group">
                    {!! Form::label('', 'Occupation Certificate copy') !!}
                    {!! Form::file('security_occupation_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'security_occupation_file_'.$i]) !!}
                </div>

                <div id="Que46" class="form-group">
                    {!! Form::label('', 'Society Share Certificate copy') !!}
                    {!! Form::file('security_societyshare_file', ['class' => 'form-control upload_details', 'id'=>'security_societyshare_file']) !!}
                </div>

                <div id="Que46" class="form-group">
                    {!! Form::label('', 'Copy of 7 - 12 Extract') !!}
                    {!! Form::file('security_712extract_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'security_712extract_file_'.$i]) !!}
                </div>

                <div id="Que46" class="form-group">
                    {!! Form::label('', 'Copy of Last Sales/Purchase Deed') !!}
                    {!! Form::file('security_lastsaledeed_file_'.$i, ['class' => 'form-control upload_details', 'id'=>'security_lastsaledeed_file_'.$i]) !!}
                </div>
            </div>
        </div>
        @endfor
            <div class="form-group" align="center">
                {!! Form::button('Add Security Document Details', ['class' => 'btn btn-primary add_promo_button', 'id' => 'add_security']) !!}
                {!! Form::button('Delete Security Document Details', ['class' => 'btn btn-warning rem_promo_button collapse', 'id' => 'rem_security']) !!}
            </div>
        </div>
        </div>

    <div class="form-group" align="center">
        {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div4',$loanId); return false;", 'value'=> 'Back' )) !!}
        {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
        {!! Form::button('Exit', array('class' => 'inputBtn btn', 'onclick' => "showTab('Home',$loanId); return false;", 'value'=> 'Exit' )) !!}
    </div>
@section('footer')
    <script src="{{ URL::asset('js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(".upload_details").filestyle({buttonName: "btn-primary"});

        function showTab(tabid,loanid)
        {
            if(tabid == "Div1")
            {
                document.location = "{{URL::to('/loans/newlap/index/'.$loanId)}}";
            }
            else if(tabid == "Div2") {
                document.location = "{{URL::to('/loans/newlap/promoter/'.$loanId)}}";
            }
            else if(tabid == "Div3")
            {
                document.location = "{{URL::to('/loans/newlap/financial/'.$loanId)}}";
            }
            else if(tabid == "Div4")
            {
                document.location = "{{URL::to('/loans/newlap/business/'.$loanId)}}";
            }
            else if(tabid == "Div5")
            {
                document.location = "{{URL::to('/loans/newlap/uploaddoc/'.$loanId)}}";
            }
            else
            {
                document.location = "{{URL::to('/home#')}}";
            }
        }


        $(document).ready(function() {

            var add_tab1_kyc_count = 1; // Hidden Field Counter Variable
            var add_equipmentbillcopy_count = 1;
            var add_invoicecopy_count = 1;
            var add_security_count = 1;

            $('#divTab_sub1').show();
            $('#divTab_sub2').hide();
            $('#divTab_sub3').hide();
            $('#divTab_sub4').hide();


            $(lnkLoanDtls1).click(function()
            {
                $('#li_sub1').removeClass("active");
                $('#li_sub2').removeClass("active");
                $('#li_sub3').removeClass("active");
                $('#li_sub4').removeClass("active");

                $('#divTab_sub1').show();
                $('#divTab_sub2').hide();
                $('#divTab_sub3').hide();
                $('#divTab_sub4').hide();
                $('#li_sub1').addClass("active");
            });

            $(lnkLoanDtls2).click(function()
            {
                $('#li_sub1').removeClass("active");
                $('#li_sub2').removeClass("active");
                $('#li_sub3').removeClass("active");
                $('#li_sub4').removeClass("active");

                $('#divTab_sub2').show();
                $('#divTab_sub1').hide();
                $('#divTab_sub3').hide();
                $('#divTab_sub4').hide();
                $('#li_sub2').addClass("active");
            });

            $(lnkLoanDtls3).click(function()
            {
                $('#li_sub1').removeClass("active");
                $('#li_sub2').removeClass("active");
                $('#li_sub3').removeClass("active");
                $('#li_sub4').removeClass("active");

                $('#divTab_sub3').show();
                $('#divTab_sub1').hide();
                $('#divTab_sub2').hide();
                $('#divTab_sub4').hide();
                $('#li_sub3').addClass("active");
            });


            //=======================================================//


            $('#add_tab1_kyc').click(function()
            {
                add_tab1_kyc_count = add_tab1_kyc_count + 1;
                $('#bnkst_'+add_tab1_kyc_count).show();
                if(add_tab1_kyc_count == 3)
                {
                    $('#add_tab1_kyc').hide();
                }
                else
                {
                    $('#add_tab1_kyc').show();
                }

                if(add_tab1_kyc_count == 1)
                {
                    $('#rem_tab1_kyc').hide();
                }
                else
                {
                    $('#rem_tab1_kyc').show();
                }
            });

            $('#rem_tab1_kyc').click(function()
            {
                $('#bnkst_'+add_tab1_kyc_count).hide();
                add_tab1_kyc_count = add_tab1_kyc_count - 1;
                if(add_tab1_kyc_count == 3)
                {
                    $('#add_tab1_kyc').hide();
                }
                else
                {
                    $('#add_tab1_kyc').show();
                }

                if(add_tab1_kyc_count == 1)
                {
                    $('#rem_tab1_kyc').hide();
                }
                else
                {
                    $('#rem_tab1_kyc').show();
                }
            });

            //==========================================//
            $('#add_equipmentbillcopy').click(function() {

                add_equipmentbillcopy_count = add_equipmentbillcopy_count + 1;
                $('#EquipCopy_'+add_equipmentbillcopy_count).show();
                if(add_equipmentbillcopy_count == 3)
                {
                    $('#add_equipmentbillcopy').hide();
                }
                else
                {
                    $('#add_equipmentbillcopy').show();
                }

                if(add_equipmentbillcopy_count == 1)
                {
                    $('#rem_equipmentbillcopy').hide();
                }
                else
                {
                    $('#rem_equipmentbillcopy').show();
                }
            });

            $('#rem_equipmentbillcopy').click(function() {

                $('#EquipCopy_'+add_equipmentbillcopy_count).hide();
                add_equipmentbillcopy_count = add_equipmentbillcopy_count - 1;
                if(add_equipmentbillcopy_count == 3)
                {
                    $('#add_equipmentbillcopy').hide();
                }
                else
                {
                    $('#add_equipmentbillcopy').show();
                }

                if(add_equipmentbillcopy_count == 1)
                {
                    $('#rem_equipmentbillcopy').hide();
                }
                else
                {
                    $('#rem_equipmentbillcopy').show();
                }
            });

//==========================================//
            $('#add_invoicecopy').click(function() {

                add_invoicecopy_count = add_invoicecopy_count + 1;
                $('#InvCopy_'+add_invoicecopy_count).show();
                if(add_invoicecopy_count == 5)
                {
                    $('#add_invoicecopy').hide();
                }
                else
                {
                    $('#add_invoicecopy').show();
                }

                if(add_invoicecopy_count == 1)
                {
                    $('#rem_invoicecopy').hide();
                }
                else
                {
                    $('#rem_invoicecopy').show();
                }
            });

            $('#rem_invoicecopy').click(function() {

                $('#InvCopy_'+add_invoicecopy_count).hide();
                add_invoicecopy_count = add_invoicecopy_count - 1;
                if(add_invoicecopy_count == 5)
                {
                    $('#add_invoicecopy').hide();
                }
                else
                {
                    $('#add_invoicecopy').show();
                }

                if(add_invoicecopy_count == 1)
                {
                    $('#rem_invoicecopy').hide();
                }
                else
                {
                    $('#rem_invoicecopy').show();
                }
            });

            //==========================================//
            $('#add_security').click(function() {

                add_security_count = add_security_count + 1;
                $('#security_doc_'+add_security_count).show();
                if(add_security_count == 3)
                {
                    $('#add_security').hide();
                }
                else
                {
                    $('#add_security').show();
                }

                if(add_security_count == 1)
                {
                    $('#rem_security').hide();
                }
                else
                {
                    $('#rem_security').show();
                }
            });

            $('#rem_security').click(function() {

                $('#security_doc_'+add_security_count).hide();
                add_security_count = add_security_count - 1;
                if(add_security_count == 3)
                {
                    $('#add_security').hide();
                }
                else
                {
                    $('#add_security').show();
                }

                if(add_security_count == 1)
                {
                    $('#rem_security').hide();
                }
                else
                {
                    $('#rem_security').show();
                }
            });
//====================================================================

            $(lnkLoanDtls4).click(function()
            {
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

            $('#address_types').select2({
                allowClear: true,
                placeholder: "Select Address Type"
            });

            $('#kycdocument_file').next().children().first().val('{{$kycdocument_file}}');
            $('#pan_promoter_file').next().children().first().val('{{$pan_promoter_file}}');
            $('#proof_address_file').next().children().first().val('{{$proof_address_file}}');
            $('#bankstatement_file').next().children().first().val('{{$bankstatement_file}}');
            $('#cibilreport_file').next().children().first().val('{{$cibilreport_file}}');
            $('#visitingcard_file').next().children().first().val('{{$visitingcard_file}}');
            $('#promoternetworth_file').next().children().first().val('{{$promoternetworth_file}}');
            $('#propertypapers_file').next().children().first().val('{{$propertypapers_file}}');
            $('#corporate_file').next().children().first().val('{{$corporate_file}}');
            $('#networthcertificate_file').next().children().first().val('{{$networthcertificate_file}}');
            $('#otherdocument_file').next().children().first().val('{{$otherdocument_file}}');
            $('#ecommercesupply_file').next().children().first().val('{{$ecommercesupply_file}}');
        });
    </script>
@endsection