<div role="tabpanel_sub">
    <ul class="nav nav-pills responsive" role="tablist" id="procedures">
        <li id="li_sub1" class="active"><a id="lnkLoanDtls1" href="#"><span class="text">Balance Sheet Details</span></a></li>
        <li id="li_sub2"><a id="lnkLoanDtls2" href="#"><span class="text">Profit and Loss Details</span></a></li>
        <li id="li_sub3"><a id="lnkLoanDtls3" href="#"><span class="text">Other Details</span></a></li>
    </ul>
</div>



{{--========Start DivSub 1==========================================================================--}}
<div id="divTab_sub1" class="collapse">
    {!! Form::label('KYCDetails', 'Balance Sheet Details') !!}

    <div>
    <?php $counter = 0; ?>
        <table width="100%" border="1" cellpadding="4" cellspacing="4">
            <tr>
        @foreach($bl_year as $blyear)
            <td style="padding: 5px;">
            <table>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td align="center" colspan="2" style="border-bottom: solid;border-bottom-width: thin;">
                                    {!! Form::label($blyear, $blyear.' (') !!}
                                    {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
                                    {!! Form::label('export_amount',' In Lacs )') !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('Networth', 'Networth') !!}
                                </td>
                                <td>
                                    {!! Form::text('financial['.$counter.'][net_worth]', null, array('class' => 'form-control')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('TotalDebt', 'Total Debt') !!}
                                </td>
                                <td>
                                    {!! Form::text('financial['.$counter.'][total_debt]', null, array('class' => 'form-control')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('TermDebt', 'Term Debt') !!}
                                </td>
                                <td>
                                    {!! Form::text('financial['.$counter.'][term_debt]', null, array('class' => 'form-control')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('Debtors', 'Debtors') !!}
                                </td>
                                <td>
                                    {!! Form::text('financial['.$counter.'][debtors]', null, array('class' => 'form-control')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('Inventory', 'Inventory') !!}
                                </td>
                                <td>
                                    {!! Form::text('financial['.$counter.'][inventory]', null, array('class' => 'form-control')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('Creditors', 'Creditors') !!}
                                </td>
                                <td>
                                    {!! Form::text('financial['.$counter.'][creditors]', null, array('class' => 'form-control')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::label('NetFixedAssets', 'Net Fixed Assets') !!}
                                </td>
                                <td>
                                    {!! Form::text('financial['.$counter.'][nfs_assets]', null, array('class' => 'form-control')) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>

        @endforeach
            </tr></table>
    </div>
</div>



{{--========Start DivSub 2==========================================================================--}}
<div id="divTab_sub2" class="collapse">
    {!! Form::label('KYCDetails', 'Profit and Loss Details') !!}
    <table width="100%" border="1" cellpadding="4" cellspacing="4">
        <tr>
        @foreach($bl_year as $blyear)
                <td style="padding: 5px;">
                    <table>
                    <tr>
                        <td valign="top">
                            <table>
                                <tr>
                                    <td align="center" colspan="2" style="border-bottom: solid;border-bottom-width: thin;">
                                        {!! Form::label($blyear, $blyear.' (') !!}
                                        {!! Form::label('', '', ['class' => 'fa fa-inr'] ) !!}
                                        {!! Form::label('export_amount',' In Lacs )') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('Revenue', 'Revenue') !!}
                                    </td>
                                    <td>
                                        {!! Form::text('financial['.$counter.'][revenue]', null, array('class' => 'form-control')) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('OperatingProfit', 'EBITDA/Operating Profit') !!}
                                    </td>
                                    <td>
                                        {!! Form::text('financial['.$counter.'][op_profit]', null, array('class' => 'form-control')) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('InterestExpense', 'Interest Expense') !!}
                                    </td>
                                    <td>
                                        {!! Form::text('financial['.$counter.'][interest_expense]', null, array('class' => 'form-control')) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::label('PAT', 'PAT') !!}
                                    </td>
                                    <td>
                                        {!! Form::text('financial['.$counter.'][pat]', null, array('class' => 'form-control')) !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            @endforeach
        </tr>
    </table>
</div>


{{--========Start DivSub 3==========================================================================--}}
<div id="divTab_sub3" class="collapse">
<div class="row">
    <br>
</div>
<div class="panel panel-info">
    <div class="panel-heading">Fixed Asset Details</div>
    <div class="panel-body">

        <div class="row">
            <div class="col-sm-6 col-lg-5">
                <div class="form-group required">
                    {!! Form::label('AssetsFA', 'Total Gross Fixed Assets',['class'=>'col-md-6 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::text('gross_assets', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-7">
                <div class="form-group required">

                    {!! Form::label('AssetsFA', 'Gross Value of Plant & Machinery (before depreciation)',['class'=>'col-md-8 control-label'] ) !!}
                    <div class="col-md-4">
                        {!! Form::text('gross_value_of_plant', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <br>
</div>

<div class="panel panel-info">
    <div class="panel-heading">Existing Loan Details</div>

    <div class="row collapse in" id="existingLoanDiv">
        <div class="col-sm-8 col-lg-6">
            <div class="form-group">
                {!! Form::label('propertiesOwned','Number of Existing Loan', ['class'=>'col-md-6 control-label']) !!}

                <div class="col-xs-4">
                    {!! Form::select('propertiesOwned', array(' ' => 'Select No.of Existing Loan','0' => 'None', '1' => '1', '2' => '2', '3' => '3', '4' => 'Greater than 3'),null,['id' => 'no_of_existingloan', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
    @for($formIndex=1; $formIndex <= 3; $formIndex++)
        <div id="existingLoanDetails_{{$formIndex}}" class="panel panel-info collapse" width="80%">
            <div class="panel-heading">Loan Details - {{$formIndex}}</div>
            <div class="row">
                <br>
            </div>
        <div class="row" style="padding: 2px;">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group required">
                    {!! Form::label('bankname','Name',['class'=>'col-md-2 control-label']) !!}
                    <div class="col-md-8">
                        {!! Form::text('bankname', $choosenApproxValue, array('class' => 'form-control','placeholder'=>'Name of Bank/NBFC')) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group required">
                    {!! Form::label('typeofloan','Type of Loan', ['class'=>'col-md-4 control-label' , 'id' => 'label_typeofloan']) !!}
                    <div class="col-md-8">
                        {!! Form::select('loantype', array(' ' => 'Please select','0' => 'Unsecured Loan', '1' => 'Secured Term Loan ', '2' => 'CC / OD', '3' => 'Loan against Property'), null, ['id' => 'loantype', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="form-group required">
                    {!! Form::label('', 'Amount',['class'=>'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('outstanding_amount', null, array('class' => 'form-control','placeholder'=>'Outstanding Amount')) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="padding: 2px;">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group required" id="monthlyemi_amount">
                    {!! Form::label('', 'Amount',['class'=>'col-md-2 control-label'] ) !!}
                    <div class="col-md-8">
                        {!! Form::text('monthlyemi_amount', null, array('class' => 'form-control','placeholder'=>'Monthly EMI Amount')) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4" style="padding-left: 0px !important;">
                <div class="form-group required" id="balance_tenure">
                    {!! Form::label('', 'Balance Tenure',['class'=>'col-md-5 control-label']) !!}
                    <div class="col-md-7">
                        {!! Form::text('balance_tenure', null, array('class' => 'form-control','placeholder'=>'Balance Tenure (months)')) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="form-group required" id="securityprovided">
                    {!! Form::label('securityprovided','Security Provided', ['id' => 'label_securityprovided','class'=>'col-md-5 control-label']) !!}
                    <div class="col-md-7">
                        {!! Form::select('securityprovided', array(' ' => 'Please select','0' => 'None', '1' => 'Only Current Assets', '2' => 'Only Fixed Assets', '3' => 'Collateral Property', '4' => 'Specific Equipments', '5' => 'Collateral Property + Other Assets'), null, ['id' => 'securityprovided', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endfor

        <div id="existingLoanDetails_4" class="panel panel-info collapse" width="80%">
            <div class="panel-heading">Other Loan Details</div>
            <div class="row">
                <br>
            </div>
            <div class="row">
                <div class="col-sm-8 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('','Outstanding Amount', ['class'=>'col-md-6 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('other_outstandingamount', null, ['class' => 'form-control', 'id'=>'other_outstandingamount', 'placeholder'=>'Outstanding Amount ( In Lacs )']) !!}
                        </div>

                    </div>
                </div>

                <div class="col-sm-8 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('','Total Monthly EMI', ['class'=>'col-md-4 control-label']) !!}

                        <div class="col-md-6">
                            {!! Form::text('other_totalmonthlyemi', null, ['class' => 'form-control', 'id'=>'other_totalmonthlyemi', 'placeholder'=>'Total Monthly EMI ( In Lacs )']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>
</div>
<div class="row">
    <br>
</div>
    <div class="form-group" align="center">
        {!! Form::button('Back', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div2',$loanId); return false;", 'value'=> 'Back' )) !!}
        {{--{!! Form::submit('Save', ['class' => 'inputBtn btn']) !!}--}}
        {!! Form::button('Next', array('class' => 'inputBtn btn', 'onclick' => "showTab('Div4',$loanId); return false;", 'value'=> 'Next' )) !!}
        {!! Form::button('Exit', array('class' => 'inputBtn btn', 'onclick' => "showTab('Home',$loanId); return false;", 'value'=> 'Exit' )) !!}
    </div>
</div>




@section('footer')
    <script>
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

        $(document).ready(function () {

            $('#divTab_sub1').show();
            $('#divTab_sub2').hide();
            $('#divTab_sub3').hide();



            $(lnkLoanDtls1).click(function()
            {
                $('#li_sub1').removeClass("active");
                $('#li_sub2').removeClass("active");
                $('#li_sub3').removeClass("active");

                $('#divTab_sub1').show();
                $('#divTab_sub2').hide();
                $('#divTab_sub3').hide();
                $('#li_sub1').addClass("active");
            });

            $(lnkLoanDtls2).click(function()
            {
                $('#li_sub1').removeClass("active");
                $('#li_sub2').removeClass("active");
                $('#li_sub3').removeClass("active");

                $('#divTab_sub2').show();
                $('#divTab_sub1').hide();
                $('#divTab_sub3').hide();
                $('#li_sub2').addClass("active");
            });

            $(lnkLoanDtls3).click(function()
            {
                $('#li_sub1').removeClass("active");
                $('#li_sub2').removeClass("active");
                $('#li_sub3').removeClass("active");

                $('#divTab_sub3').show();
                $('#divTab_sub1').hide();
                $('#divTab_sub2').hide();
                $('#li_sub3').addClass("active");
            });


//==============================================================//
            $("#no_of_existingloan").change(function() {
                var loanCount = $(this).val();

                if(loanCount == 0){
                    $("#existingLoanDetails_").collapse("hide");
                    for(var index = 4; index >= 1; index--){
                        $("#existingLoanDetails_"+index).collapse("hide");
                    }
                }else{
                    if(loanCount == 4) {
                        $("#existingLoanDetails_4").collapse("show");
                        loanCount = 3;
                    }


                    $("#existingLoanDetails_").collapse("show");
                    for(var index = 1; index <= loanCount; index++){
                        $("#existingLoanDetails_"+index).collapse("show");
                    }

                    for(var index = 4; index > loanCount; index--){
                        $("#existingLoanDetails_"+index).collapse("hide");
                    }
                }

                if($(this).val() === ' ')
                {
                    $("#existingLoanDetails").collapse("hide");
                }
                else
                {
                    $("#existingLoanDetails").collapse("show");
                }
            });

//==============================================================//



            $('#loan_tenure').select2({
                allowClear: true,
                placeholder: "Select Tenure Year"
            });


            $('#state').select2({
                allowClear: true,
                placeholder: "Select State"
            });
            $('#relationshipWithApplicant').select2({
                allowClear: true,
                placeholder: "Select Relationship"
            });
            $(".third_party").hide();
            $("#label_third_party").prev().hide();
            $("#label_third_party").hide();

            $('#property_types').select2({
                allowClear: true,
                placeholder: "Select Property Type"
            });
            $("#commercial_type").hide();
            $("#residential_type").hide();
            $("#land_type").hide();
            $("#state").next().children().show();

            $('#property_types').change(function (){
                //$("span.selection:not(:first)").hide();
                // $("#state").next().children().show();

                if(this.value === 'Commercial') {
                    $("#commercial_type").show();
                    $('#commercial_types').select2({
                        allowClear: true,
                        placeholder: "Select Commercial Type"
                    });
                    $("#residential_type").hide();
                    $("#land_type").hide();

                } else if(this.value === 'Residential' ){
                    $("#residential_type").show();
                    $('#residential_types').select2({
                        allowClear: true,
                        placeholder: "Select Residential Type"
                    });
                    $("#commercial_type").hide();
                    $("#land_type").hide();
                } else if(this.value === 'Land Non-Agri') {
                    $("#land_type").show();
                    $('#land_types').select2({
                        allowClear: true,
                        placeholder: "Select Land Type"
                    });
                    $("#residential_type").hide();
                    $("#commercial_type").hide();

                } else if (this.value === 'Land Agri') {
                    $("#land_type").hide();
                    $("#residential_type").hide();
                    $("#commercial_type").hide();
                } else if(this.value === 'Industrial') {
                    $("#land_type").hide();
                    $("#residential_type").hide();
                    $("#commercial_type").hide();
                }


            });
            if($('#property_types').val()== 'Commercial'){
                $("#commercial_type").show();
                $('#commercial_types').select2({
                    allowClear: true,
                    placeholder: "Select Commercial Type"
                });
                $("#residential_type").hide();
                $("#land_type").hide();
            }
            if($('#property_types').val()== 'Residential'){
                $("#residential_type").show();
                $('#residential_types').select2({
                    allowClear: true,
                    placeholder: "Select Residential Type"
                });
                $("#commercial_type").hide();
                $("#land_type").hide();
            }
            if($('#property_types').val()== 'Land Non-Agri'){
                $("#land_type").show();
                $('#land_types').select2({
                    allowClear: true,
                    placeholder: "Select Land Type"
                });
                $("#residential_type").hide();
                $("#commercial_type").hide();
            }

            if($("#owner_type").val() == 'Third Party'){
                $(".third_party").show();
            }
            $('#owner_type').select2({
                allowClear: true,
                placeholder: "Select Owner"
            });
            $("#owner_type").change(function() {
                if($(this).val() === 'Third Party') {
                    $(".third_party").fadeIn();
                    $("#label_third_party").prev().show();
                    $("#label_third_party").fadeIn();
                    $('#state_third_party').select2({
                        allowClear: true,
                        placeholder: "Select State"
                    });
                } else if($(this).val() === 'Self') {
                    $(".third_party").fadeOut();
                    $("#label_third_party").prev().hide();
                    $("#label_third_party").hide();
                }else{
                    $(".third_party").hide();
                    $("#label_third_party").prev().hide();
                    $("#label_third_party").hide();
                }
            });





        });

    </script>
@endsection